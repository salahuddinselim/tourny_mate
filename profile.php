<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login-form.php");
    exit();
}
include './components/shared/general-header.php';
?>

<div class="container my-5">
    <div class="profile-header text-center">
        <div class="profile-picture">
            <img src="https://img.freepik.com/free-icon/user_318-875902.jpg" alt="User Profile Picture" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover;">
        </div>
        <h1 class="mt-3">
            <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>
        </h1>
    </div>

    <div class="row text-center mt-4">
        <div class="col-md-3">
            <div class="stat-box p-3 border rounded">
                <p><a href="allTournaments.php" class="text-decoration-none">Tournament</a></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box p-3 border rounded">
                <p>Matches</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box p-3 border rounded">
                <p><a href="players.php" class="text-decoration-none">Teams</a></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box p-3 border rounded">
                <p>Sport</p>
            </div>
        </div>
    </div>

    <div class="mt-5">
        <h3>Profile Information</h3>
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Username:</strong> <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?></li>
            <li class="list-group-item"><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?></li>
            <li class="list-group-item"><strong>Phone:</strong> <?php echo htmlspecialchars($_SESSION['phone'] ?? ''); ?></li>
        </ul>
    </div>
</div>

<?php
include './components/shared/general-footer.php';
?>
