<?php
require_once 'config.php';
include './components/shared/general-header.php';

$error = '';
$scores = [];

try {
    $query = "
        SELECT 
            DATE(mp.match_day) AS match_date, mp.match_type, 
            mp.match_end,
            t1.id AS team_1_id, t1.name AS team_1_name, t1.logo AS team_1_logo, 
            t2.id AS team_2_id, t2.name AS team_2_name, t2.logo AS team_2_logo, 
            tts1.score AS team_1_score, tts2.score AS team_2_score, 
            tts1.wickets AS team_1_wickets, tts2.wickets AS team_2_wickets,
            tts1.goals AS team_1_goals, tts2.goals AS team_2_goals
        FROM match_played mp
        JOIN team t1 ON mp.team_1_id = t1.id
        JOIN team t2 ON mp.team_2_id = t2.id
        LEFT JOIN tournament_team_score tts1 ON mp.team_1_id = tts1.team_id AND mp.id = tts1.match_id
        LEFT JOIN tournament_team_score tts2 ON mp.team_2_id = tts2.team_id AND mp.id = tts2.match_id
        ORDER BY mp.match_day DESC";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($row['match_end'] == 1) {
            $isFootball = (strtolower($row['match_type']) === 'football');
            $team_1_metric = $isFootball ? $row['team_1_goals'] : $row['team_1_score'];
            $team_2_metric = $isFootball ? $row['team_2_goals'] : $row['team_2_score'];

            if ((int) $team_1_metric > (int) $team_2_metric) {
                $row['winner'] = $row['team_1_name'];
            } elseif ((int) $team_1_metric < (int) $team_2_metric) {
                $row['winner'] = $row['team_2_name'];
            } else {
                $row['winner'] = 'Draw';
            }
        } else {
            $row['winner'] = 'Scheduled';
        }
        $scores[$row['match_date']][] = $row;
    }
} catch (PDOException $e) {
    $error = "Error fetching scores.";
    error_log("Scores error: " . $e->getMessage());
}
?>

<section style="padding: 4rem 0; background: var(--bg-primary);">
    <div class="container">
        <div class="section-title">
            <h2>Latest Scores</h2>
            <p>Live and recent match results</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert-modern"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if (!empty($scores)): ?>
            <?php foreach ($scores as $matchDate => $matches): ?>
                <h4 style="color: var(--accent-green); font-weight: 700; margin-bottom: 1.5rem;">
                    <i class="fas fa-calendar-day me-2"></i><?= htmlspecialchars(date('F j, Y', strtotime($matchDate))); ?>
                </h4>
                <div class="row g-4 mb-5">
                    <?php foreach ($matches as $match): ?>
                        <div class="col-md-6">
                            <div class="match-card p-0">
                                <div class="p-4">
                                    <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                                        <div style="flex: 1; text-align: center;">
                                            <div style="width: 64px; height: 64px; margin: 0 auto 0.5rem;">
                                                <img src="./uploads/logos/<?= htmlspecialchars($match['team_1_logo']); ?>" 
                                                     alt="<?= htmlspecialchars($match['team_1_name']); ?>"
                                                     style="width: 100%; height: 100%; object-fit: contain;">
                                            </div>
                                            <p style="color: var(--text-primary); font-weight: 600; font-size: 0.9rem; margin-bottom: 0.25rem;"><?= htmlspecialchars($match['team_1_name']); ?></p>
                                            <span class="score-badge">
                                                <?= htmlspecialchars(
                                                    strtolower($match['match_type']) === 'football'
                                                        ? ($match['team_1_goals'] ?? '0')
                                                        : ($match['team_1_score'] ?? '0') . '/' . ($match['team_1_wickets'] ?? '0')
                                                ); ?>
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; text-align: center;">
                                            <div style="font-size: 1.25rem; font-weight: 800; color: var(--accent-green); letter-spacing: 2px;">VS</div>
                                            <div style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; margin-top: 0.25rem;"><?= htmlspecialchars($match['match_type']); ?></div>
                                        </div>
                                        <div style="flex: 1; text-align: center;">
                                            <div style="width: 64px; height: 64px; margin: 0 auto 0.5rem;">
                                                <img src="./uploads/logos/<?= htmlspecialchars($match['team_2_logo']); ?>" 
                                                     alt="<?= htmlspecialchars($match['team_2_name']); ?>"
                                                     style="width: 100%; height: 100%; object-fit: contain;">
                                            </div>
                                            <p style="color: var(--text-primary); font-weight: 600; font-size: 0.9rem; margin-bottom: 0.25rem;"><?= htmlspecialchars($match['team_2_name']); ?></p>
                                            <span class="score-badge">
                                                <?= htmlspecialchars(
                                                    strtolower($match['match_type']) === 'football'
                                                        ? ($match['team_2_goals'] ?? '0')
                                                        : ($match['team_2_score'] ?? '0') . '/' . ($match['team_2_wickets'] ?? '0')
                                                ); ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div style="background: rgba(0,0,0,0.2); padding: 0.75rem 1rem; display: flex; justify-content: space-between; align-items: center;">
                                    <span style="color: var(--text-muted); font-size: 0.85rem;">
                                        <i class="fas fa-flag-checkered me-1"></i> <?= htmlspecialchars($match['winner']); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color: var(--text-muted); text-align: center;">No scores available.</p>
        <?php endif; ?>
    </div>
</section>

<?php include './components/shared/general-footer.php'; ?>
