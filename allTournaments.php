<?php
require_once 'config.php';
include './components/shared/general-header.php';

$error = '';
$scheduledTournaments = [];
$pastTournaments = [];

try {
    $scheduledStmt = $conn->prepare("SELECT id, name, venue, region, start_date, end_date FROM tournament WHERE end_date >= CURDATE() ORDER BY start_date ASC");
    $scheduledStmt->execute();
    $scheduledTournaments = $scheduledStmt->fetchAll(PDO::FETCH_ASSOC);

    $pastStmt = $conn->prepare("SELECT id, name, venue, region, start_date, end_date FROM tournament WHERE end_date < CURDATE() ORDER BY end_date DESC");
    $pastStmt->execute();
    $pastTournaments = $pastStmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Error fetching tournaments.";
    error_log("Tournaments error: " . $e->getMessage());
}
?>

<section style="padding: 4rem 0; background: var(--bg-primary);">
    <div class="container">
        <div class="section-title">
            <h2>Tournaments</h2>
            <p>Browse all tournaments</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="alert-modern"><?= htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <h3 style="color: var(--accent-green); font-weight: 700; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 1px;">
            <i class="fas fa-play-circle me-2"></i>Scheduled / Ongoing
        </h3>
        <div class="row g-4 mb-5">
            <?php if (!empty($scheduledTournaments)): ?>
                <?php foreach ($scheduledTournaments as $t): ?>
                    <div class="col-md-4">
                        <div class="card-modern p-4 h-100">
                            <div style="width: 50px; height: 50px; background: rgba(0,255,136,0.1); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                <i class="fas fa-trophy" style="color: var(--accent-green);"></i>
                            </div>
                            <h4 style="font-weight: 700; color: var(--text-primary);"><?= htmlspecialchars($t['name']); ?></h4>
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                <i class="fas fa-map-marker-alt me-1"></i> <?= htmlspecialchars($t['venue']); ?>
                                <?php if ($t['region']): ?> | <?= htmlspecialchars($t['region']); ?><?php endif; ?>
                            </p>
                            <p style="color: var(--text-muted); font-size: 0.85rem;">
                                <i class="fas fa-calendar-alt me-1"></i> <?= htmlspecialchars($t['start_date']); ?> → <?= htmlspecialchars($t['end_date']); ?>
                            </p>
                            <a href="view_tournament.php?tournament_id=<?= $t['id']; ?>" class="read-more" style="margin-top: auto;">
                                View Details <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12"><p style="color: var(--text-muted);">No ongoing tournaments.</p></div>
            <?php endif; ?>
        </div>

        <h3 style="color: var(--text-muted); font-weight: 700; margin-bottom: 1.5rem; text-transform: uppercase; letter-spacing: 1px;">
            <i class="fas fa-history me-2"></i>Past Tournaments
        </h3>
        <div class="row g-4">
            <?php if (!empty($pastTournaments)): ?>
                <?php foreach ($pastTournaments as $t): ?>
                    <div class="col-md-4">
                        <div class="card-modern p-4 h-100" style="opacity: 0.8;">
                            <div style="width: 50px; height: 50px; background: rgba(255,255,255,0.05); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                                <i class="fas fa-flag-checkered" style="color: var(--text-muted);"></i>
                            </div>
                            <h4 style="font-weight: 700; color: var(--text-primary);"><?= htmlspecialchars($t['name']); ?></h4>
                            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 0.5rem;">
                                <i class="fas fa-map-marker-alt me-1"></i> <?= htmlspecialchars($t['venue']); ?>
                            </p>
                            <p style="color: var(--text-muted); font-size: 0.85rem;">
                                <i class="fas fa-calendar-alt me-1"></i> <?= htmlspecialchars($t['start_date']); ?> → <?= htmlspecialchars($t['end_date']); ?>
                            </p>
                            <a href="points_table.php?tournament_id=<?= $t['id']; ?>" class="read-more" style="margin-top: auto;">
                                View Results <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12"><p style="color: var(--text-muted);">No past tournaments.</p></div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include './components/shared/general-footer.php'; ?>
