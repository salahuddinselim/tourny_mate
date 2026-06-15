<?php
session_start();
require_once '../../../../config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../../../login-form.php");
    exit();
}

$tournamentId = $_GET['tournament_id'] ?? null;

if ($tournamentId) {
    $stmt = $conn->prepare("SELECT creator_id FROM tournament WHERE id = :id");
    $stmt->execute([':id' => $tournamentId]);
    $tournament = $stmt->fetch();

    if (!$tournament || $tournament['creator_id'] != $_SESSION['user_id']) {
        header("Location: tournament_organizer.php?error=unauthorized");
        exit();
    }

    try {
        $conn->beginTransaction();

        $conn->prepare("DELETE FROM tournament_team WHERE tournament_id = :tid")->execute([':tid' => $tournamentId]);
        $conn->prepare("DELETE FROM tournament_officials WHERE tournament_id = :tid")->execute([':tid' => $tournamentId]);
        $conn->prepare("DELETE FROM tournament_request WHERE tournament_id = :tid")->execute([':tid' => $tournamentId]);
        $conn->prepare("DELETE FROM match_played WHERE tournament_id = :tid")->execute([':tid' => $tournamentId]);
        $conn->prepare("DELETE FROM tournament_team_score WHERE tournament_id = :tid")->execute([':tid' => $tournamentId]);
        $conn->prepare("DELETE FROM tournament WHERE id = :tid AND creator_id = :uid")->execute([':tid' => $tournamentId, ':uid' => $_SESSION['user_id']]);

        $conn->commit();
        header("Location: tournament_organizer.php?success=1");
    } catch (PDOException $e) {
        $conn->rollBack();
        error_log("Delete tournament error: " . $e->getMessage());
        header("Location: tournament_organizer.php?error=delete_failed");
    }
    exit();
}

header("Location: tournament_organizer.php?error=1");
exit();
?>
