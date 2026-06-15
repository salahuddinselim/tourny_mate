<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header('Location: /tourny_mate/login-form.php');
    exit;
}

require_once __DIR__ . '/../../utils.php';

$_SESSION['dp'] = $_SESSION['dp'] ?? null;

$defaultImage = "https://img.freepik.com/free-icon/user_318-563642.jpg";
$userImage = $_SESSION['dp'] ?: $defaultImage;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard — BattleBase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/tourny_mate/css/custom.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background: var(--bg-primary); }
        .navbar-dash { background: rgba(15,15,30,0.95) !important; backdrop-filter: blur(12px); border-bottom: 1px solid var(--border-color); padding: 0.75rem 0; }
        .navbar-dash .navbar-brand { font-weight: 800; font-size: 1.4rem; background: var(--gradient-primary); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; letter-spacing: 1px; }
        .navbar-dash .nav-link { color: var(--text-muted) !important; font-weight: 500; padding: 0.5rem 1rem !important; border-radius: 8px; transition: all 0.3s; }
        .navbar-dash .nav-link:hover { color: var(--text-primary) !important; background: rgba(255,255,255,0.05); }
        .profile-image { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; border: 2px solid var(--accent-green); }
        .profile-dropdown-toggle { color: var(--text-primary) !important; font-weight: 500; }
        .profile-dropdown-toggle::after { color: var(--text-muted); }
        .dropdown-menu { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-md); }
        .dropdown-item { color: var(--text-secondary); }
        .dropdown-item:hover { background: rgba(0,255,136,0.1); color: var(--accent-green); }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dash">
        <div class="container">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>dashboard/<?php echo $_SESSION['role']; ?>/dashboard.php">
                <i class="fas fa-shield-halved me-2"></i>BattleBase
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>index.php"><i class="fas fa-home me-1"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo BASE_URL; ?>dashboard/<?php echo $_SESSION['role']; ?>/nav/allNews.php"><i class="fas fa-newspaper me-1"></i>News/Blogs</a>
                    </li>
                </ul>
                <div class="dropdown ms-3">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle profile-dropdown-toggle"
                        id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="<?php echo htmlspecialchars($userImage); ?>" alt="Profile"
                            class="profile-image me-2">
                        <span><?php echo htmlspecialchars($_SESSION['username']); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>dashboard/<?php echo $_SESSION['role']; ?>/menu/profile/profile.php"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><hr class="dropdown-divider" style="border-color: var(--border-color);"></li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL; ?>logout.php"><i class="fas fa-sign-out-alt me-2"></i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
