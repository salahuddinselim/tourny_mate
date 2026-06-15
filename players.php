<?php
include 'components/shared/general-header.php';
require_once 'config.php';

$error = '';
$batsmen = [];
$bowlers = [];
$footballPlayers = [];

try {
    $batsmanQuery = "
        SELECT ind.user_id, u.fullName, u.dp, SUM(ind.runs) AS total_runs
        FROM individual_score ind
        JOIN userinfo u ON ind.user_id = u.id
        WHERE ind.runs IS NOT NULL
        GROUP BY ind.user_id
        ORDER BY total_runs DESC";
    $stmt = $conn->prepare($batsmanQuery);
    $stmt->execute();
    $batsmen = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $bowlerQuery = "
        SELECT ind.user_id, u.fullName, u.dp, SUM(ind.total_wickets) AS total_wickets
        FROM individual_score ind
        JOIN userinfo u ON ind.user_id = u.id
        WHERE ind.total_wickets IS NOT NULL
        GROUP BY ind.user_id
        ORDER BY total_wickets DESC";
    $stmt = $conn->prepare($bowlerQuery);
    $stmt->execute();
    $bowlers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $footballQuery = "
        SELECT ind.user_id, u.fullName, u.dp, SUM(ind.total_goals) AS total_goals
        FROM individual_score ind
        JOIN userinfo u ON ind.user_id = u.id
        WHERE ind.total_goals IS NOT NULL
        GROUP BY ind.user_id
        ORDER BY total_goals DESC";
    $stmt = $conn->prepare($footballQuery);
    $stmt->execute();
    $footballPlayers = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error fetching player data.";
    error_log("Players error: " . $e->getMessage());
}
?>

<section style="padding: 4rem 0; background: var(--bg-primary);">
    <div class="container">
        <div class="section-title">
            <h2>Players</h2>
            <p>Top performers across all tournaments</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert-modern"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Batsmen -->
        <div style="margin-bottom: 3rem;">
            <h3 style="color: var(--accent-green); font-weight: 700; margin-bottom: 1.5rem;">
                <i class="fas fa-baseball-ball me-2"></i>Cricket — Batsmen
            </h3>
            <div class="row g-4">
                <?php if (!empty($batsmen)): ?>
                    <?php foreach ($batsmen as $b): ?>
                        <div class="col-md-4 col-lg-3">
                            <a href="player_details.php?player_id=<?= $b['user_id']; ?>" class="text-decoration-none">
                                <div class="card-modern p-4 text-center h-100">
                                    <img src="<?= !empty($b['dp']) ? '/tourny_mate/uploads/user/' . htmlspecialchars($b['dp']) : 'https://img.freepik.com/free-vector/male-cricket-player_1308-83784.jpg?ga=GA1.1.1320900330.1735297158&semt=ais_hybrid'; ?>" 
                                         alt="<?= htmlspecialchars($b['fullName']); ?>"
                                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 3px solid var(--accent-green); margin-bottom: 1rem;">
                                    <h5 style="color: var(--text-primary); font-weight: 700; font-size: 1rem;"><?= htmlspecialchars($b['fullName']); ?></h5>
                                    <p style="color: var(--accent-green); font-weight: 700; font-size: 1.1rem; margin-bottom: 0;">🏏 <?= htmlspecialchars($b['total_runs']); ?> runs</p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12"><p style="color: var(--text-muted);">No data available.</p></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Bowlers -->
        <div style="margin-bottom: 3rem;">
            <h3 style="color: var(--accent-green); font-weight: 700; margin-bottom: 1.5rem;">
                <i class="fas fa-baseball-ball me-2"></i>Cricket — Bowlers
            </h3>
            <div class="row g-4">
                <?php if (!empty($bowlers)): ?>
                    <?php foreach ($bowlers as $b): ?>
                        <div class="col-md-4 col-lg-3">
                            <a href="player_details.php?player_id=<?= $b['user_id']; ?>" class="text-decoration-none">
                                <div class="card-modern p-4 text-center h-100">
                                    <img src="<?= !empty($b['dp']) ? '/tourny_mate/uploads/user/' . htmlspecialchars($b['dp']) : 'https://img.freepik.com/free-vector/male-cricket-player_1308-83784.jpg?ga=GA1.1.1320900330.1735297158&semt=ais_hybrid'; ?>" 
                                         alt="<?= htmlspecialchars($b['fullName']); ?>"
                                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 3px solid var(--accent-green); margin-bottom: 1rem;">
                                    <h5 style="color: var(--text-primary); font-weight: 700; font-size: 1rem;"><?= htmlspecialchars($b['fullName']); ?></h5>
                                    <p style="color: var(--accent-green); font-weight: 700; font-size: 1.1rem; margin-bottom: 0;">🎯 <?= htmlspecialchars($b['total_wickets']); ?> wickets</p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12"><p style="color: var(--text-muted);">No data available.</p></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Football -->
        <div>
            <h3 style="color: var(--accent-green); font-weight: 700; margin-bottom: 1.5rem;">
                <i class="fas fa-futbol me-2"></i>Football Players
            </h3>
            <div class="row g-4">
                <?php if (!empty($footballPlayers)): ?>
                    <?php foreach ($footballPlayers as $fp): ?>
                        <div class="col-md-4 col-lg-3">
                            <a href="player_details.php?player_id=<?= $fp['user_id']; ?>" class="text-decoration-none">
                                <div class="card-modern p-4 text-center h-100">
                                    <img src="<?= !empty($fp['dp']) ? '/tourny_mate/uploads/user/' . htmlspecialchars($fp['dp']) : 'https://img.freepik.com/free-vector/soccer-player-kicking-ball-vector_23-2147494008.jpg?ga=GA1.1.1320900330.1735297158&semt=ais_hybrid'; ?>" 
                                         alt="<?= htmlspecialchars($fp['fullName']); ?>"
                                         style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 3px solid var(--accent-green); margin-bottom: 1rem;">
                                    <h5 style="color: var(--text-primary); font-weight: 700; font-size: 1rem;"><?= htmlspecialchars($fp['fullName']); ?></h5>
                                    <p style="color: var(--accent-green); font-weight: 700; font-size: 1.1rem; margin-bottom: 0;">⚽ <?= htmlspecialchars($fp['total_goals']); ?> goals</p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12"><p style="color: var(--text-muted);">No data available.</p></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php include 'components/shared/general-footer.php'; ?>
