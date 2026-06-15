<?php
require_once 'config.php';
include './components/shared/general-header.php';

$error = '';
$news = [];

try {
    $query = "SELECT id, title, subtitle, main_image FROM news ORDER BY created_at DESC LIMIT 12";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error fetching news.";
    error_log("News error: " . $e->getMessage());
}
?>

<section style="padding: 4rem 0; background: var(--bg-primary);">
    <div class="container">
        <div class="section-title">
            <h2>Latest News</h2>
            <p>Stay updated with the latest from BattleBase</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert-modern"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="row g-4">
            <?php if (!empty($news)): ?>
                <?php foreach ($news as $item): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card-modern p-0 h-100">
                            <img src="./uploads/news/<?= htmlspecialchars($item['main_image']); ?>"
                                 alt="<?= htmlspecialchars($item['title']); ?>"
                                 style="width: 100%; height: 200px; object-fit: cover; border-radius: var(--radius-md) var(--radius-md) 0 0;">
                            <div class="p-4">
                                <h4 style="color: var(--text-primary); font-weight: 700; font-size: 1.2rem; margin-bottom: 0.5rem;">
                                    <?= htmlspecialchars($item['title']); ?>
                                </h4>
                                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">
                                    <?= htmlspecialchars($item['subtitle']); ?>
                                </p>
                                <a href="news-details.php?id=<?= $item['id']; ?>" class="read-more">
                                    Read More <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12"><p style="color: var(--text-muted); text-align: center;">No news available.</p></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include './components/shared/general-footer.php'; ?>
