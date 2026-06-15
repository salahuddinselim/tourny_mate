<?php
require_once 'config.php';
include './components/shared/general-header.php';

$error = '';
$highlights = [];

try {
    $query = "SELECT id, title, video_file FROM highlights ORDER BY created_at DESC LIMIT 12";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $highlights = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error fetching highlights.";
    error_log("Highlights error: " . $e->getMessage());
}
?>

<section style="padding: 4rem 0; background: var(--bg-primary);">
    <div class="container">
        <div class="section-title">
            <h2>Highlights</h2>
            <p>Relive the best moments</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert-modern"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <div class="row g-4">
            <?php if (!empty($highlights)): ?>
                <?php foreach ($highlights as $highlight): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card-modern p-0 h-100">
                            <div style="position: relative; border-radius: var(--radius-md) var(--radius-md) 0 0; overflow: hidden;">
                                <video width="100%" height="220" controls style="object-fit: cover; display: block; background: #000;" preload="metadata">
                                    <source src="./uploads/videos/<?= htmlspecialchars($highlight['video_file']); ?>" type="video/mp4">
                                </video>
                            </div>
                            <div class="p-4">
                                <h4 style="color: var(--text-primary); font-weight: 700; font-size: 1.1rem; margin-bottom: 1rem;">
                                    <?= htmlspecialchars($highlight['title']); ?>
                                </h4>
                                <a href="view_highlight.php?highlight_id=<?= $highlight['id']; ?>" class="read-more">
                                    Watch Full <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12"><p style="color: var(--text-muted); text-align: center;">No highlights available.</p></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include './components/shared/general-footer.php'; ?>
