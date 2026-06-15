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
    <h2><span class="hl">Welcome</span> Back</h2>

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

    <form action="login.php" method="POST">
      <div class="mb-4">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" required>
      </div>
      <div class="mb-4">
        <label for="password" class="form-label">Password</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
          <button type="button" id="togglePass" style="background:var(--bg-primary);border:1px solid var(--border-color);color:var(--text-muted);border-radius:0 var(--radius-sm) var(--radius-sm) 0;padding:0 14px;cursor:pointer;">
            <i class="fas fa-eye" id="passIcon"></i>
          </button>
        </div>
      </div>
      <button type="submit" class="btn-battle">Login <i class="fas fa-arrow-right"></i></button>
    </form>

    <div class="auth-link">
      <p class="mb-0">Don't have an account? <a href="register-form.php">Create one</a></p>
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
