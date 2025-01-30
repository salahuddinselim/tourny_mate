<?php
try {
    include './components/shared/general-header.php';
    require_once 'config.php'; // Include the database connection

    // Get tournament ID from the query string
    $tournamentId = isset($_GET['tournament_id']) ? intval($_GET['tournament_id']) : 0;

    if ($tournamentId > 0) {
        // Fetch tournament details
        $query = "SELECT * FROM tournament WHERE id = :tournamentId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tournamentId', $tournamentId, PDO::PARAM_INT);
        $stmt->execute();
        $tournament = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$tournament) {
            throw new Exception("Tournament not found.");
        }

        // Fetch matches with team names and logos
        $matchesQuery = "
            SELECT m.*, 
                   t1.name AS team_1_name, t1.logo AS team_1_logo, 
                   t2.name AS team_2_name, t2.logo AS team_2_logo, 
                   COALESCE(tts1.goals, 0) AS team_1_goals, COALESCE(tts2.goals, 0) AS team_2_goals,
                   COALESCE(tts1.score, 0) AS team_1_score, COALESCE(tts2.score, 0) AS team_2_score
            FROM match_played m
            LEFT JOIN team t1 ON m.team_1_id = t1.id
            LEFT JOIN team t2 ON m.team_2_id = t2.id
            LEFT JOIN tournament_team_score tts1 ON m.team_1_id = tts1.team_id AND m.id = tts1.match_id
            LEFT JOIN tournament_team_score tts2 ON m.team_2_id = tts2.team_id AND m.id = tts2.match_id
            WHERE m.tournament_id = :tournamentId
            ORDER BY m.match_day ASC
        ";
        $matchesStmt = $conn->prepare($matchesQuery);
        $matchesStmt->bindParam(':tournamentId', $tournamentId, PDO::PARAM_INT);
        $matchesStmt->execute();
        $matches = $matchesStmt->fetchAll(PDO::FETCH_ASSOC);

        // Determine winners for ended matches
        foreach ($matches as &$match) {
            if ($match['match_end'] == 1) { // Check if the match has ended
                $isFootball = ($tournament['tour_type'] === 'football');
                $team_1_metric = $isFootball ? $match['team_1_goals'] : $match['team_1_score'];
                $team_2_metric = $isFootball ? $match['team_2_goals'] : $match['team_2_score'];

                if ($team_1_metric > $team_2_metric) {
                    $match['winner_name'] = $match['team_1_name'];
                } elseif ($team_1_metric < $team_2_metric) {
                    $match['winner_name'] = $match['team_2_name'];
                } else {
                    $match['winner_name'] = 'Draw';
                }
            }
        }
    } else {
        throw new Exception("Invalid tournament ID.");
    }
} catch (PDOException $e) {
    $error = "Database error: " . $e->getMessage();
} catch (Exception $e) {
    $error = $e->getMessage();
}
?>

<section id="tournament-details" style="padding: 3rem 0; background-color: #f8f9fa;">
    <div class="container">
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error); ?></div>
        <?php else: ?>
            <h2 class="text-center" style="text-transform: uppercase; font-weight: bold; margin-bottom: 2rem; color: #333;">
                <?= htmlspecialchars($tournament['name']); ?>
            </h2>
            <div class="card mb-4" style="box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Venue:</strong> <?= htmlspecialchars($tournament['venue']); ?></p>
                            <p><strong>Region:</strong> <?= htmlspecialchars($tournament['region']); ?></p>
                            <p><strong>District:</strong> <?= htmlspecialchars($tournament['district']); ?></p>
                            <p><strong>Area:</strong> <?= htmlspecialchars($tournament['area']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Type:</strong> <?= htmlspecialchars($tournament['tour_type']); ?></p>
                            <p><strong>Start Date:</strong> <?= htmlspecialchars($tournament['start_date']); ?></p>
                            <p><strong>End Date:</strong> <?= htmlspecialchars($tournament['end_date']); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4" style="border: none; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="card-body text-center">
                    <a href="points_table_mapper.php?tournament_id=<?= $tournamentId; ?>" class="btn btn-primary" style="padding: 0.75rem 1.5rem; font-size: 1rem; text-transform: uppercase; font-weight: bold;">
                        Show Points Table
                    </a>
                </div>
            </div>

            <h3 class="text-center" style="text-transform: uppercase; font-weight: bold; margin-bottom: 1.5rem; color: #007bff;">Matches</h3>
            <div class="row">
                <?php if (!empty($matches)): ?>
                    <?php foreach ($matches as $match): ?>
                        <div class="col-md-6 mb-4">
                            <div class="card" style="border: none; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="./uploads/logos/<?= htmlspecialchars($match['team_1_logo']); ?>" alt="<?= htmlspecialchars($match['team_1_name']); ?>" class="img-fluid" style="width: 50px; height: 50px; margin-right: 10px;">
                                        <h5 class="mb-0" style="font-size: 1rem; color: #333;">
                                            <?= htmlspecialchars($match['team_1_name']); ?>
                                        </h5>
                                    </div>
                                    <p class="text-center font-weight-bold mb-3">VS</p>
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="./uploads/logos/<?= htmlspecialchars($match['team_2_logo']); ?>" alt="<?= htmlspecialchars($match['team_2_name']); ?>" class="img-fluid" style="width: 50px; height: 50px; margin-right: 10px;">
                                        <h5 class="mb-0" style="font-size: 1rem; color: #333;">
                                            <?= htmlspecialchars($match['team_2_name']); ?>
                                        </h5>
                                    </div>
                                    <p class="mb-2"><strong>Date:</strong> <?= htmlspecialchars($match['match_day']); ?></p>
                                    <p class="mb-2"><strong>Type:</strong> <?= htmlspecialchars($match['match_type']); ?></p>
                                    <?php if ($match['match_end'] == 1): ?>
                                        <p class="mb-2"><strong>Score:</strong> <?= htmlspecialchars($isFootball ? $match['team_1_goals'] : $match['team_1_score']); ?> - <?= htmlspecialchars($isFootball ? $match['team_2_goals'] : $match['team_2_score']); ?></p>
                                        <p class="mb-0"><strong>Winner:</strong> <?= htmlspecialchars($match['winner_name']); ?></p>
                                    <?php else: ?>
                                        <p class="mb-0"><strong>Status:</strong> Scheduled</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-center w-100">No matches scheduled for this tournament.</p>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
include './components/shared/general-footer.php';
?>
