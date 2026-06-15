<?php
require_once 'config.php';

// Get team ID from query string
$team_id = intval($_GET['team_id'] ?? 0);

try {
    $stmt = $conn->prepare("SELECT u.id, u.fullName AS player_name FROM team_player tp JOIN userinfo u ON tp.user_id = u.id WHERE tp.team_id = :team_id");
    $stmt->execute([':team_id' => $team_id]);
    $players = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($players);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
