<?php
require_once 'config.php';

$tournamentId = $_GET['tournament_id'] ?? null;
$errors = [];
$tournament = null;

if ($tournamentId) {
  $query = "SELECT * FROM tournament WHERE id = :tournament_id";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':tournament_id', $tournamentId, PDO::PARAM_INT);
  $stmt->execute();
  $tournament = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$tournament) {
  $tournament = ['name' => 'Unknown Tournament', 'venue' => 'N/A', 'start_date' => 'N/A', 'end_date' => 'N/A', 'tour_type' => 'cricket'];
}

// Fetch existing teams in the tournament
$existing_teams = [];
if ($tournamentId) {
  $query = "
        SELECT t.id, t.name
        FROM team t
        JOIN tournament_team tt ON t.id = tt.team_id
        WHERE tt.tournament_id = :tournament_id
    ";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':tournament_id', $tournamentId, PDO::PARAM_INT);
  $stmt->execute();
  $existing_teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch teams not yet in the tournament
$available_teams = [];
if ($tournamentId) {
  $query = "
        SELECT t.id, t.name
        FROM team t
        WHERE t.id NOT IN (
            SELECT team_id FROM tournament_team WHERE tournament_id = :tournament_id
        )
    ";
  $stmt = $conn->prepare($query);
  $stmt->bindParam(':tournament_id', $tournamentId, PDO::PARAM_INT);
  $stmt->execute();
  $available_teams = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Fetch match data and calculate wins/losses
$points_table = [];
try {
  $query = "
  SELECT 
      mp.id AS match_id,
      mp.team_1_id, mp.team_2_id,
      mp.match_end,
      t1.name AS team_1_name,
      t2.name AS team_2_name,
      COALESCE(tts1.goals, 0) AS team_1_goals,
      COALESCE(tts2.goals, 0) AS team_2_goals,
      COALESCE(tts1.score, 0) AS team_1_score,
      COALESCE(tts2.score, 0) AS team_2_score
  FROM match_played mp
  JOIN team t1 ON mp.team_1_id = t1.id
  JOIN team t2 ON mp.team_2_id = t2.id
  LEFT JOIN tournament_team_score tts1 ON mp.team_1_id = tts1.team_id AND mp.id = tts1.match_id
  LEFT JOIN tournament_team_score tts2 ON mp.team_2_id = tts2.team_id AND mp.id = tts2.match_id
  WHERE mp.tournament_id = :tournament_id";

  $stmt = $conn->prepare($query);
  $stmt->bindValue(':tournament_id', $tournamentId, PDO::PARAM_INT);
  $stmt->execute();
  $matches = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Initialize points table
  foreach ($matches as $match) {
    // Skip matches that are not ended
    if ($match['match_end'] != 1) {
      continue;
    }

    $team_1_id = $match['team_1_id'];
    $team_2_id = $match['team_2_id'];

    // Determine sport type (football: use goals, cricket: use score)
    $is_football = ($tournament['tour_type'] === 'football');
    $team_1_metric = $is_football ? $match['team_1_goals'] : $match['team_1_score'];
    $team_2_metric = $is_football ? $match['team_2_goals'] : $match['team_2_score'];

    // Initialize teams in points table
    if (!isset($points_table[$team_1_id])) {
      $points_table[$team_1_id] = [
        'team_name' => $match['team_1_name'],
        'wins' => 0,
        'losses' => 0,
        'matches' => 0
      ];
    }
    if (!isset($points_table[$team_2_id])) {
      $points_table[$team_2_id] = [
        'team_name' => $match['team_2_name'],
        'wins' => 0,
        'losses' => 0,
        'matches' => 0
      ];
    }

    // Update matches played
    $points_table[$team_1_id]['matches']++;
    $points_table[$team_2_id]['matches']++;

    // Determine match result
    if ($team_1_metric > $team_2_metric) {
      $points_table[$team_1_id]['wins']++;
      $points_table[$team_2_id]['losses']++;
    } elseif ($team_1_metric < $team_2_metric) {
      $points_table[$team_2_id]['wins']++;
      $points_table[$team_1_id]['losses']++;
    } elseif ($team_1_metric == $team_2_metric) {
      $random_winner = rand(0, 1) == 0 ? $team_1_id : $team_2_id;
      $random_loser = $random_winner == $team_1_id ? $team_2_id : $team_1_id;

      $points_table[$random_winner]['wins']++;
      $points_table[$random_loser]['losses']++;
    }
  }

} catch (PDOException $e) {
  die("Error calculating points table: " . $e->getMessage());
}
?>
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <a href="javascript:history.back()" class="btn btn-secondary btn-lg">Go Back</a>
  </div>
  <h1 class="text-center"><?= htmlspecialchars($tournament['name']); ?></h1>

  <p class="text-center"><strong>Venue:</strong> <?= htmlspecialchars($tournament['venue']); ?></p>
  <p class="text-center"><strong>Dates:</strong> <?= htmlspecialchars($tournament['start_date']); ?> to <?= htmlspecialchars($tournament['end_date']); ?></p>

  <h3>Teams Participating</h3>
  <ul class="list-group mb-3">
    <?php if (!empty($existing_teams)): ?>
      <?php foreach ($existing_teams as $team): ?>
        <li class="list-group-item"><?= htmlspecialchars($team['name']); ?></li>
      <?php endforeach; ?>
    <?php else: ?>
      <li class="list-group-item text-muted">No teams added to this tournament yet.</li>
    <?php endif; ?>
  </ul>

  <h3>Match Results (Wins and Losses)</h3>
  <table class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>Team</th>
        <th>Wins</th>
        <th>Losses</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($points_table)): ?>
        <?php foreach ($points_table as $team): ?>
          <tr>
            <td><?= htmlspecialchars($team['team_name']); ?></td>
            <td><?= $team['wins']; ?></td>
            <td><?= $team['losses']; ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="3" class="text-center">No matches played yet.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>