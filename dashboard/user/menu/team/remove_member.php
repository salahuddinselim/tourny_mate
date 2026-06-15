<?php
session_start();
require_once '../../../../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../../login-form.php");
    exit();
}

$teamId = $_GET['team_id'] ?? null;
$memberId = $_GET['user_id'] ?? null;

if ($teamId && $memberId) {
    $stmt = $conn->prepare("SELECT manager_id FROM team WHERE id = :team_id");
    $stmt->execute([':team_id' => $teamId]);
    $team = $stmt->fetch();

    if ($team && $team['manager_id'] == $_SESSION['user_id']) {
        $stmt = $conn->prepare("DELETE FROM team_player WHERE team_id = :team_id AND user_id = :user_id");
        $stmt->execute([':team_id' => $teamId, ':user_id' => $memberId]);
    }
}

header("Location: my_team.php");
exit();
?>
