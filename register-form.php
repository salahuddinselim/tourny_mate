<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
$success = $_SESSION['success'] ?? '';
unset($_SESSION['errors'], $_SESSION['success']);
include './components/shared/general-header.php';
?>
<div class="auth-page">
  <div class="auth-card">
    <div class="logo-wrap">
      <img src="logo.png" alt="BattleBase">
    </div>
    <h2>Join <span class="hl">BattleBase</span></h2>

    <?php if (!empty($success)): ?>
      <div class="alert-gold">
        <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($success); ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
      <div class="alert-orange">
        <ul class="mb-0" style="list-style:none;padding:0;">
          <?php foreach ($errors as $e): ?>
            <li><i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($e); ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <form action="register.php" method="POST">
      <div class="mb-3">
        <label for="fullName" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="fullName" name="fullName" placeholder="John Doe" required>
      </div>
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="johndoe" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
      </div>
      <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="tel" class="form-control" id="phone" name="phone" placeholder="+1234567890" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="Min. 8 characters" required>
          <button type="button" id="togglePass" style="background:var(--bg-primary);border:1px solid var(--border-color);color:var(--text-muted);border-radius:0 var(--radius-sm) var(--radius-sm) 0;padding:0 14px;cursor:pointer;">
            <i class="fas fa-eye" id="passIcon"></i>
          </button>
        </div>
      </div>
      <button type="submit" class="btn-battle">Register <i class="fas fa-arrow-right"></i></button>
    </form>

    <div class="auth-link">
      <p class="mb-0">Already have an account? <a href="login-form.php">Login</a></p>
    </div>
  </div>
</div>

<script>
document.getElementById('togglePass')?.addEventListener('click', () => {
  const p = document.getElementById('password');
  const i = document.getElementById('passIcon');
  const is = p.type === 'password';
  p.type = is ? 'text' : 'password';
  i.className = is ? 'fas fa-eye-slash' : 'fas fa-eye';
});
</script>

<?php include './components/shared/general-footer.php'; ?>
