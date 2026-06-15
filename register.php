<?php
session_start();

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username'] ?? '');
    $email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'] ?? '';
    $fullName = trim($_POST['fullname'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $role = 'user';

    $errors = [];

    if (!$user) $errors[] = "Username is required.";
    if (!$email) $errors[] = "A valid email address is required.";
    if (!$password) $errors[] = "Password is required.";
    if (!$fullName) $errors[] = "Full name is required.";
    if (!$phone) $errors[] = "Phone number is required.";

    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: register-form.php");
        exit();
    }

    try {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO userinfo (username, email, password_key, fullName, phone, role) 
                VALUES (:username, :email, :password_key, :fullName, :phone, :role)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':username' => $user,
            ':email' => $email,
            ':password_key' => $hashedPassword,
            ':fullName' => $fullName,
            ':phone' => $phone,
            ':role' => $role
        ]);

        $_SESSION['success'] = "You have successfully registered. Please login.";
        header("Location: login-form.php");
        exit();
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            $errors[] = "The username or email already exists. Please choose a different one.";
        } else {
            $errors[] = "An unexpected error occurred. Please try again.";
            error_log("Registration error: " . $e->getMessage());
        }

        $_SESSION['errors'] = $errors;
        header("Location: register-form.php");
        exit();
    }
}
?>
