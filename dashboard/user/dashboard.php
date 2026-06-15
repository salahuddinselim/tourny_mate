<?php
require_once '../../config.php';
include '../../components/shared/user-header.php';

$userId = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT 
        (SELECT COUNT(*) FROM match_played WHERE official_1_id = :uid1 OR official_2_id = :uid2 OR official_3_id = :uid3) AS officiated_matches,
        (SELECT COUNT(*) FROM team_player tp JOIN match_played mp ON tp.team_id = mp.team_1_id OR tp.team_id = mp.team_2_id WHERE tp.user_id = :uid4) AS matches_played,
        (SELECT COUNT(*) FROM team WHERE manager_id = :uid5) AS managed_teams");
$stmt->bindParam(':uid1', $userId, PDO::PARAM_INT);
$stmt->bindParam(':uid2', $userId, PDO::PARAM_INT);
$stmt->bindParam(':uid3', $userId, PDO::PARAM_INT);
$stmt->bindParam(':uid4', $userId, PDO::PARAM_INT);
$stmt->bindParam(':uid5', $userId, PDO::PARAM_INT);
$stmt->execute();
$stats = $stmt->fetch(PDO::FETCH_ASSOC);

$stmtMatches = $conn->prepare("
    SELECT mp.id AS match_id, t1.name AS team_1_name, t2.name AS team_2_name, mp.match_day, 
        CASE 
            WHEN mp.official_1_id = :uid6 OR mp.official_2_id = :uid7 OR mp.official_3_id = :uid8 THEN 'Official'
            WHEN tp.user_id = :uid9 THEN 'Player'
            ELSE 'Other'
        END AS role
    FROM match_played mp
    LEFT JOIN team t1 ON mp.team_1_id = t1.id
    LEFT JOIN team t2 ON mp.team_2_id = t2.id
    LEFT JOIN team_player tp ON (tp.team_id = mp.team_1_id OR tp.team_id = mp.team_2_id)
    WHERE (mp.official_1_id = :uid10 OR mp.official_2_id = :uid11 OR mp.official_3_id = :uid12 OR tp.user_id = :uid13)
    ORDER BY mp.match_day ASC");
$stmtMatches->bindParam(':uid6', $userId, PDO::PARAM_INT);
$stmtMatches->bindParam(':uid7', $userId, PDO::PARAM_INT);
$stmtMatches->bindParam(':uid8', $userId, PDO::PARAM_INT);
$stmtMatches->bindParam(':uid9', $userId, PDO::PARAM_INT);
$stmtMatches->bindParam(':uid10', $userId, PDO::PARAM_INT);
$stmtMatches->bindParam(':uid11', $userId, PDO::PARAM_INT);
$stmtMatches->bindParam(':uid12', $userId, PDO::PARAM_INT);
$stmtMatches->bindParam(':uid13', $userId, PDO::PARAM_INT);
$stmtMatches->execute();
$matches = $stmtMatches->fetchAll(PDO::FETCH_ASSOC);

$stmtRequests = $conn->prepare("
    SELECT tr.id AS request_id, tr.tournament_id, tr.team_id, tr.status, t.name AS tournament_name, tm.name AS team_name
    FROM tournament_request tr
    JOIN tournament t ON tr.tournament_id = t.id
    JOIN team tm ON tr.team_id = tm.id
    WHERE tr.status = 'pending' AND tr.user_id = :user_id
    ORDER BY tr.created_at DESC");
$stmtRequests->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmtRequests->execute();
$requests = $stmtRequests->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['request_action'])) {
    $requestId = $_POST['request_id'];
    $action = $_POST['request_action'];

    if ($action === 'accept') {
        $stmtApprove = $conn->prepare("UPDATE tournament_request SET status = 'approved' WHERE id = :rid");
        $stmtApprove->bindParam(':rid', $requestId, PDO::PARAM_INT);
        $stmtApprove->execute();

        $stmtFetch = $conn->prepare("SELECT tournament_id, team_id FROM tournament_request WHERE id = :rid");
        $stmtFetch->bindParam(':rid', $requestId, PDO::PARAM_INT);
        $stmtFetch->execute();
        $request = $stmtFetch->fetch(PDO::FETCH_ASSOC);

        $stmtAddTeam = $conn->prepare("INSERT INTO tournament_team (tournament_id, team_id) VALUES (:tid, :tmid)");
        $stmtAddTeam->bindParam(':tid', $request['tournament_id'], PDO::PARAM_INT);
        $stmtAddTeam->bindParam(':tmid', $request['team_id'], PDO::PARAM_INT);
        $stmtAddTeam->execute();
    } elseif ($action === 'reject') {
        $stmtReject = $conn->prepare("UPDATE tournament_request SET status = 'rejected' WHERE id = :rid");
        $stmtReject->bindParam(':rid', $requestId, PDO::PARAM_INT);
        $stmtReject->execute();
    }

    header("Location: dashboard.php");
    exit();
}
?>

<style>
    .stat-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 1.5rem; text-align: center; transition: transform 0.3s, box-shadow 0.3s; }
    .stat-card:hover { transform: translateY(-4px); box-shadow: var(--shadow-glow); }
    .stat-card .stat-icon { width: 56px; height: 56px; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem; font-size: 1.5rem; }
    .stat-card .stat-value { font-size: 2rem; font-weight: 800; margin-bottom: 0.25rem; }
    .stat-card .stat-label { color: var(--text-muted); font-size: 0.85rem; font-weight: 500; }
    .dash-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); overflow: hidden; }
    .dash-card .card-head { padding: 1rem 1.5rem; border-bottom: 1px solid var(--border-color); font-weight: 700; display: flex; align-items: center; gap: 0.75rem; }
    .dash-card .card-body { padding: 1.5rem; }
    .table-dash { color: var(--text-primary); border-color: var(--border-color); margin-bottom: 0; }
    .table-dash thead th { background: rgba(255,255,255,0.03); border-color: var(--border-color); color: var(--text-muted); font-weight: 600; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.5px; }
    .table-dash td { border-color: var(--border-color); vertical-align: middle; }
    .btn-dash { padding: 0.4rem 1rem; border-radius: var(--radius-sm); font-weight: 600; font-size: 0.85rem; transition: all 0.3s; }
    .quick-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-lg); overflow: hidden; text-align: center; transition: transform 0.3s; }
    .quick-card:hover { transform: translateY(-4px); }
    .quick-card .quick-head { padding: 1rem; font-weight: 700; font-size: 1rem; border-bottom: 1px solid var(--border-color); }
    .quick-card .quick-body { padding: 1.5rem; }
</style>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-lg-3">
            <?php include '../../components/shared/dashboard-menu.php'; ?>
        </div>

        <div class="col-lg-9">
            <div class="container p-0">
                <h3 style="color: var(--text-primary); font-weight: 800; margin-bottom: 0.25rem;">
                    <i class="fas fa-gauge-high me-2" style="color: var(--accent-green);"></i>Dashboard
                </h3>
                <p style="color: var(--text-muted); margin-bottom: 2rem;">Welcome back, <?= htmlspecialchars($_SESSION['username']); ?>!</p>

                <!-- Stats -->
                <div class="row g-4 mb-5">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: rgba(0,255,136,0.1);">
                                <i class="fas fa-running" style="color: var(--accent-green);"></i>
                            </div>
                            <div class="stat-value" style="color: var(--accent-green);"><?= $stats['matches_played'] ?? 0 ?></div>
                            <div class="stat-label">Matches as Player</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: rgba(0,212,255,0.1);">
                                <i class="fas fa-users-gear" style="color: #00d4ff;"></i>
                            </div>
                            <div class="stat-value" style="color: #00d4ff;"><?= $stats['managed_teams'] ?? 0 ?></div>
                            <div class="stat-label">Teams Managed</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon" style="background: rgba(255,215,0,0.1);">
                                <i class="fas fa-whistle" style="color: #ffd700;"></i>
                            </div>
                            <div class="stat-value" style="color: #ffd700;"><?= $stats['officiated_matches'] ?? 0 ?></div>
                            <div class="stat-label">Officiated Matches</div>
                        </div>
                    </div>
                </div>

                <!-- Upcoming Matches -->
                <div class="dash-card mb-4">
                    <div class="card-head">
                        <i class="fas fa-calendar-check" style="color: var(--accent-green);"></i> Your Upcoming Matches
                    </div>
                    <div class="card-body">
                        <table class="table table-dash table-hover">
                            <thead>
                                <tr>
                                    <th>Match</th>
                                    <th>Date</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($matches)): ?>
                                    <?php foreach ($matches as $match): ?>
                                        <tr>
                                            <td style="font-weight: 600;"><?= htmlspecialchars($match['team_1_name'] . ' vs ' . $match['team_2_name']); ?></td>
                                            <td><?= htmlspecialchars($match['match_day']); ?></td>
                                            <td><?= htmlspecialchars($match['role']); ?></td>
                                            <td>
                                                <a href="menu/tournament/view_match.php?match_id=<?= $match['match_id']; ?>" class="btn btn-dash" style="background: rgba(0,255,136,0.1); color: var(--accent-green);">View Match</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center" style="color: var(--text-muted);">No upcoming matches.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tournament Requests -->
                <div class="dash-card mb-4">
                    <div class="card-head">
                        <i class="fas fa-envelope" style="color: #00d4ff;"></i> Tournament Requests
                    </div>
                    <div class="card-body">
                        <table class="table table-dash table-hover">
                            <thead>
                                <tr>
                                    <th>Tournament</th>
                                    <th>Team</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($requests)): ?>
                                    <?php foreach ($requests as $request): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($request['tournament_name']); ?></td>
                                            <td><?= htmlspecialchars($request['team_name']); ?></td>
                                            <td><span style="color: var(--accent-green); font-weight: 600;"><?= htmlspecialchars($request['status']); ?></span></td>
                                            <td>
                                                <form method="POST" class="d-inline-block">
                                                    <input type="hidden" name="request_id" value="<?= $request['request_id']; ?>">
                                                    <button type="submit" name="request_action" value="accept" class="btn btn-dash" style="background: rgba(0,255,136,0.1); color: var(--accent-green);">Accept</button>
                                                </form>
                                                <form method="POST" class="d-inline-block">
                                                    <input type="hidden" name="request_id" value="<?= $request['request_id']; ?>">
                                                    <button type="submit" name="request_action" value="reject" class="btn btn-dash" style="background: rgba(255,68,68,0.1); color: #ff4444;">Reject</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="4" class="text-center" style="color: var(--text-muted);">No pending requests.</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="quick-card">
                            <div class="quick-head" style="background: rgba(0,255,136,0.1); color: var(--accent-green);">
                                <i class="fas fa-people-group me-2"></i>Manage Team
                            </div>
                            <div class="quick-body">
                                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.25rem;">View your team, add players, or create a new team.</p>
                                <a href="<?= BASE_URL; ?>dashboard/user/menu/team/my_team.php" class="btn" style="background: var(--accent-green); color: var(--bg-primary); font-weight: 700; width: 100%;">Go to My Team</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="quick-card">
                            <div class="quick-head" style="background: rgba(0,212,255,0.1); color: #00d4ff;">
                                <i class="fas fa-trophy me-2"></i>Tournaments
                            </div>
                            <div class="quick-body">
                                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.25rem;">Organize, join, or manage tournaments.</p>
                                <a href="<?= BASE_URL; ?>dashboard/user/menu/tournament/tournament.php" class="btn" style="background: #00d4ff; color: var(--bg-primary); font-weight: 700; width: 100%;">Explore Tournaments</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="quick-card">
                            <div class="quick-head" style="background: rgba(255,215,0,0.1); color: #ffd700;">
                                <i class="fas fa-newspaper me-2"></i>News & Updates
                            </div>
                            <div class="quick-body">
                                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.25rem;">Stay informed with the latest sports news.</p>
                                <a href="<?= BASE_URL; ?>dashboard/user/nav/allNews.php" class="btn" style="background: #ffd700; color: var(--bg-primary); font-weight: 700; width: 100%;">Read News</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../../components/shared/user-footer.php'; ?>
