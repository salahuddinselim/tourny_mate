<?php
session_start();
require_once '../../../../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../../login-form.php");
    exit();
}

$teamId = $_GET['team_id'] ?? null;

if ($teamId) {
    $stmt = $conn->prepare("SELECT manager_id FROM team WHERE id = :team_id");
    $stmt->execute([':team_id' => $teamId]);
    $team = $stmt->fetch();

    if (!$team || $team['manager_id'] != $_SESSION['user_id']) {
        header("Location: my_team.php?error=unauthorized");
        exit();
    }

    $conn->beginTransaction();
    try {
        $stmt = $conn->prepare("DELETE FROM team_player WHERE team_id = :team_id");
        $stmt->execute([':team_id' => $teamId]);

        $stmt = $conn->prepare("DELETE FROM team WHERE id = :team_id AND manager_id = :manager_id");
        $stmt->execute([':team_id' => $teamId, ':manager_id' => $_SESSION['user_id']]);

        $conn->commit();
        header("Location: my_team.php?success=deleted");
    } catch (Exception $e) {
        $conn->rollBack();
        header("Location: my_team.php?error=delete_failed");
    }
    exit();
}

header("Location: my_team.php");
exit();
?>
