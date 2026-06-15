<?php
require_once 'config.php';
include './components/shared/general-header.php';
?>

<!-- HERO -->
<section class="hero-battle">
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>
  <div class="orb orb-3"></div>
  <div class="hero-grid"></div>

  <div class="hero-content">
    <div class="hero-badge">
      <span class="dot"></span> Season 2025 Live
    </div>

    <h1>
      <span class="text-gold">Battle</span>
      <span class="text-orange">Base</span>
    </h1>

    <p class="hero-sub">
      Where champions rise. Manage tournaments, track live scores, 
      and stay ahead of the game — all in one arena.
    </p>

    <div class="hero-actions">
      <a href="allTournaments.php" class="btn-battle">
        <i class="fas fa-trophy"></i> View Tournaments
      </a>
      <a href="register-form.php" class="btn-battle-outline">
        <i class="fas fa-user-plus"></i> Get Started
      </a>
    </div>

    <div class="hero-stats">
      <div>
        <div class="hero-stat-val">26+</div>
        <div class="hero-stat-lbl">Tournaments</div>
      </div>
      <div>
        <div class="hero-stat-val">17+</div>
        <div class="hero-stat-lbl">Teams</div>
      </div>
      <div>
        <div class="hero-stat-val">15+</div>
        <div class="hero-stat-lbl">Matches</div>
      </div>
    </div>
  </div>
</section>

<?php
$news = [];
$upcoming = [];
$err = '';

try {
  $stmt = $conn->prepare("SELECT id, title, subtitle, main_image FROM news ORDER BY created_at DESC LIMIT 3");
  $stmt->execute();
  $news = $stmt->fetchAll(PDO::FETCH_ASSOC);

  $stmt = $conn->prepare("
    SELECT mp.match_day, mp.match_type, 
           t1.name AS t1_name, t1.logo AS t1_logo, 
           t2.name AS t2_name, t2.logo AS t2_logo
    FROM match_played mp
    JOIN team t1 ON mp.team_1_id = t1.id
    JOIN team t2 ON mp.team_2_id = t2.id
    WHERE mp.match_day >= CURDATE()
    ORDER BY mp.match_day ASC LIMIT 4");
  $stmt->execute();
  $upcoming = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  $err = "Unable to load data.";
  error_log("Index: " . $e->getMessage());
}
?>

<!-- UPCOMING MATCHES -->
<section class="section-pad" style="background:var(--bg-secondary);">
  <div class="container">
    <div class="section-title">
      <div class="label">Upcoming Battles</div>
      <h2>Next <span class="hl">Matches</span></h2>
      <p>Don't miss the next big game</p>
    </div>

    <?php if (!empty($upcoming)): ?>
      <div class="row g-4 justify-content-center">
        <?php foreach ($upcoming as $m): ?>
          <div class="col-md-6 col-lg-3 reveal">
            <div class="match-card h-100">
              <div class="d-flex align-items-center justify-content-center gap-3">
                <div class="text-center">
                  <img src="uploads/logos/<?= htmlspecialchars($m['t1_logo']); ?>" alt="" class="team-logo">
                  <p class="team-name"><?= htmlspecialchars($m['t1_name']); ?></p>
                </div>
                <span class="vs-badge">VS</span>
                <div class="text-center">
                  <img src="uploads/logos/<?= htmlspecialchars($m['t2_logo']); ?>" alt="" class="team-logo">
                  <p class="team-name"><?= htmlspecialchars($m['t2_name']); ?></p>
                </div>
              </div>
              <div class="match-meta">
                <i class="fas fa-calendar-alt"></i>
                <?= date('M j, g:i A', strtotime($m['match_day'])); ?>
                <span class="mx-1">|</span>
                <i class="fas fa-tag"></i> <?= htmlspecialchars($m['match_type']); ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p class="text-center" style="color:var(--text-muted);padding:3rem 0;">
        <i class="fas fa-calendar-xmark me-2"></i>No upcoming matches scheduled.
      </p>
    <?php endif; ?>
  </div>
</section>

<!-- LIVE BAR -->
<div id="live-bar">
  <div id="live-content">
    <span class="live-dot"></span>
    <span>Fetching live scores…</span>
  </div>
</div>

<!-- NEWS -->
<section class="section-pad" style="background:var(--bg-primary);">
  <div class="container">
    <div class="section-title">
      <div class="label">From the Press</div>
      <h2>Latest <span class="hl">News</span></h2>
      <p>Stay updated with the latest sports stories</p>
    </div>

    <?php if ($err): ?>
      <div class="alert-orange"><?= htmlspecialchars($err); ?></div>
    <?php endif; ?>

    <div class="row g-4">
      <?php if (!empty($news)): ?>
        <?php foreach ($news as $item): ?>
          <div class="col-md-6 col-lg-4 reveal">
            <div class="news-card h-100">
              <div class="img-wrap">
                <img src="uploads/news/<?= htmlspecialchars($item['main_image']); ?>" alt="">
              </div>
              <div class="body">
                <h3><?= htmlspecialchars($item['title']); ?></h3>
                <p><?= htmlspecialchars($item['subtitle'] ?? 'Breaking news from the BattleBase arena.'); ?></p>
                <a href="news-details.php?id=<?= $item['id']; ?>" class="read-more">
                  Read More <i class="fas fa-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <p class="text-center" style="color:var(--text-muted);padding:3rem 0;">No news available.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- HIGHLIGHTS -->
<section class="section-pad" style="background:var(--bg-secondary);">
  <div class="container">
    <div class="section-title">
      <div class="label">Best Moments</div>
      <h2>Video <span class="hl">Highlights</span></h2>
      <p>Relive the action</p>
    </div>

    <?php
    try {
      $stmt = $conn->prepare("SELECT id, title, video_file FROM highlights ORDER BY created_at DESC LIMIT 4");
      $stmt->execute();
      $highlights = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      $highlights = [];
    }
    ?>

    <div class="row g-4">
      <?php if (!empty($highlights)): ?>
        <?php foreach ($highlights as $h): ?>
          <div class="col-md-6 col-lg-3 reveal">
            <a href="view_highlight.php?highlight_id=<?= $h['id']; ?>" class="text-decoration-none">
              <div class="video-card">
                <video preload="metadata" style="height:200px;object-fit:cover;">
                  <source src="uploads/videos/<?= htmlspecialchars($h['video_file']); ?>" type="video/mp4">
                </video>
                <div class="caption">
                  <span><?= htmlspecialchars($h['title']); ?></span>
                  <div class="video-play"><i class="fas fa-play" style="font-size:.75rem;"></i></div>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12"><p class="text-center" style="color:var(--text-muted);padding:3rem 0;">No highlights available.</p></div>
      <?php endif; ?>
    </div>
  </div>
</section>

<script>
function reveal() {
  const els = document.querySelectorAll('.reveal');
  const h = window.innerHeight;
  els.forEach(e => { if (e.getBoundingClientRect().top < h - 80) e.classList.add('show'); });
}
window.addEventListener('scroll', reveal);
window.addEventListener('load', () => reveal());

function fetchLive() {
  var x = new XMLHttpRequest();
  x.open('GET', 'fetch_live_score.php', true);
  x.onload = function() { if (x.status === 200) document.getElementById('live-content').innerHTML = x.responseText; };
  x.send();
}
setInterval(fetchLive, 10000);
fetchLive();
</script>

<?php
include './components/shared/about.php';
include './components/shared/testimonials.php';
include './components/shared/team.php';
include './components/shared/contact.php';
include './components/shared/general-footer.php';
?>
