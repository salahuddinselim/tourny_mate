<footer class="footer-battle">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-4">
        <h5><i class="fas fa-trophy me-2"></i>BattleBase</h5>
        <p style="color:var(--text-muted);font-size:.88rem;line-height:1.7;margin-bottom:1.25rem;">
          Where champions rise. The ultimate platform for tournament management, 
          live scores, and sports community.
        </p>
        <div>
          <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="social"><i class="fab fa-twitter"></i></a>
          <a href="#" class="social"><i class="fab fa-instagram"></i></a>
          <a href="#" class="social"><i class="fab fa-youtube"></i></a>
        </div>
      </div>
      <div class="col-md-2">
        <h5>Links</h5>
        <ul class="list-unstyled" style="line-height:2.2">
          <li><a href="index.php">Home</a></li>
          <li><a href="allScores.php">Scores</a></li>
          <li><a href="allTournaments.php">Tournaments</a></li>
          <li><a href="news.php">News</a></li>
          <li><a href="highlights.php">Highlights</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h5>Support</h5>
        <ul class="list-unstyled" style="line-height:2.2">
          <li><a href="contact.php">Contact Us</a></li>
          <li><a href="mailto:support@battlebase.com">support@battlebase.com</a></li>
          <li><span style="color:var(--text-muted);font-size:.88rem;"><i class="fas fa-phone me-1"></i> +1 (555) 123-4567</span></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h5>Newsletter</h5>
        <p style="color:var(--text-muted);font-size:.85rem;">Get the latest updates straight to your inbox.</p>
        <div class="input-group">
          <input type="email" class="form-control" placeholder="Email" style="background:var(--bg-primary);border:1px solid var(--border-color);color:var(--text-primary);border-radius:var(--radius-sm) 0 0 var(--radius-sm);font-size:.85rem;">
          <button class="btn-battle" style="border-radius:0 var(--radius-sm) var(--radius-sm) 0;padding:.45rem 1rem;font-size:.8rem;"><i class="fas fa-paper-plane"></i></button>
        </div>
      </div>
    </div>
    <div class="cpy">
      &copy; <?= date('Y'); ?> BattleBase. All rights reserved.
    </div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
window.addEventListener('load', () => document.body.classList.add('loaded'));
</script>
</body>
</html>
