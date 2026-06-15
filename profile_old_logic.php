<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login-form.php");
    exit();
}

$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT * FROM userinfo WHERE id = :id");
$stmt->execute([':id' => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    $_SESSION['error_message'] = "User not found. Please log in again.";
    header("Location: login-form.php");
    exit();
}

function editProfile($userId, $data) {
    global $conn;
    $stmt = $conn->prepare("UPDATE userinfo SET fullName = :fullName, email = :email, phone = :phone WHERE id = :id");
    $stmt->execute([
        ':fullName' => $data['fullname'],
        ':email' => $data['email'],
        ':phone' => $data['phone'],
        ':id' => $userId,
    ]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['success_message'] = "Profile updated successfully!";
        return true;
    } else {
        $_SESSION['success_message'] = "No changes were needed.";
        return true;
    }
}

function editTournament($tournamentId, $data) {
    global $conn;
    $stmt = $conn->prepare("UPDATE tournaments SET name = :name, sport = :sport, date = :date, location = :location 
        WHERE id = :id AND organiser_username = :organiser_username");
    $stmt->execute([
        ':name' => $data['name'],
        ':sport' => $data['sport'],
        ':date' => $data['date'],
        ':location' => $data['location'],
        ':id' => $tournamentId,
        ':organiser_username' => $_SESSION['username'],
    ]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['success_message'] = "Tournament updated successfully!";
        return true;
    } else {
        $_SESSION['error_message'] = "Failed to update tournament.";
        return false;
    }
}

function addPlayer($data) {
    global $conn;

    // Check if user has permission to add players (manager role)
    if ($_SESSION['role'] !== 'manager') {
        $_SESSION['error_message'] = "You do not have permission to add players.";
        return false;
    }

    $stmt = $conn->prepare("INSERT INTO players (name, email, team_id, contact_number) VALUES (:name, :email, :team_id, :contact_number)");
    $stmt->execute([
        ':name' => $data['name'],
        ':email' => $data['email'],
        ':team_id' => $data['team_id'],
        ':contact_number' => $data['contact_number'],
    ]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['success_message'] = "Player added successfully!";
        return true;
    } else {
        $_SESSION['error_message'] = "Failed to add player.";
        return false;
    }
}

function createTournament($data) {
    global $conn;

    // Check if user has permission to create tournaments (organiser role)
    if ($_SESSION['role'] !== 'organiser') {
        $_SESSION['error_message'] = "You do not have permission to create tournaments.";
        return false;
    }

    $stmt = $conn->prepare("INSERT INTO tournaments (name, sport, date, location, organiser_username) 
        VALUES (:name, :sport, :date, :location, :organiser_username)");
    $stmt->execute([
        ':name' => $data['name'],
        ':sport' => $data['sport'],
        ':date' => $data['date'],
        ':location' => $data['location'],
        ':organiser_username' => $_SESSION['username'],
    ]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['success_message'] = "Tournament created successfully!";
        return true;
    } else {
        $_SESSION['error_message'] = "Failed to create tournament.";
        return false;
    }
}

function showNotifications() {
    global $conn;
    $username = $_SESSION['username'];

    $stmt = $conn->prepare("SELECT * FROM notifications WHERE username = :username ORDER BY created_at DESC LIMIT 10");
    $stmt->execute([':username' => $username]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'edit_profile':
                editProfile($username, $_POST);
                break;
            case 'edit_tournament':
                editTournament($_POST['tournament_id'], $_POST);
                break;
            case 'add_player':
                addPlayer($_POST);
                break;
            case 'create_tournament':
                createTournament($_POST);
                break;
        }
        header("Location: profile.php");
        exit();
    }
}
