<?php
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : null;
$userId = isset($_SESSION['user_id']);
$current = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BattleBase — Tournament Manager</title>
  <link rel="icon" type="image/png" href="logo.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/custom.css">
</head>
<body>

<div id="preloader"><div class="loader-ring"></div></div>

<nav class="navbar navbar-expand-lg navbar-battle fixed-top">
  <div class="container">
    <a class="navbar-brand" href="index.php">
      <img src="logo.png" alt="BattleBase">
      <span class="brand-text">BattleBase</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="allScores.php">Scores</a></li>
        <li class="nav-item"><a class="nav-link" href="allTournaments.php">Tournaments</a></li>
        <li class="nav-item"><a class="nav-link" href="news.php">News</a></li>
        <li class="nav-item"><a class="nav-link" href="highlights.php">Highlights</a></li>
        <li class="nav-item"><a class="nav-link" href="players.php">Players</a></li>
      </ul>

      <div class="d-flex align-items-center gap-2">
        <?php if ($userId): ?>
          <a href="dashboard/<?= $role; ?>/dashboard.php" class="btn-battle-ghost" style="padding:.4rem 1rem">
            <i class="fas fa-user-circle"></i> <?= $username; ?>
          </a>
          <a href="logout.php" class="btn-battle" style="padding:.4rem 1rem">
            <i class="fas fa-sign-out-alt"></i> Logout
          </a>
        <?php else: ?>
          <a href="login-form.php" class="btn-battle-ghost" style="padding:.4rem 1rem">
            <i class="fas fa-sign-in-alt"></i> Login
          </a>
          <a href="register-form.php" class="btn-battle" style="padding:.4rem 1rem">
            <i class="fas fa-user-plus"></i> Register
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
<div style="padding-top: 64px;"></div>
