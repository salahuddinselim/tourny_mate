<?php
require_once __DIR__ . '/../../utils.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<style>
    .sidebar-dash {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: var(--radius-lg);
        padding: 1.5rem !important;
    }
    .sidebar-dash h4 {
        color: var(--text-primary);
        font-weight: 700;
        font-size: 1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
        margin-bottom: 1rem;
    }
    .sidebar-dash .nav-link {
        color: var(--text-muted) !important;
        font-weight: 500;
        padding: 0.65rem 1rem !important;
        border-radius: var(--radius-sm);
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }
    .sidebar-dash .nav-link i {
        width: 20px;
        text-align: center;
        font-size: 1rem;
    }
    .sidebar-dash .nav-link:hover {
        color: var(--text-primary) !important;
        background: rgba(255,255,255,0.05);
    }
    .sidebar-dash .nav-link.active {
        background: var(--gradient-primary) !important;
        color: #fff !important;
    }
    .btn-menu-toggle {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        color: var(--text-primary);
        padding: 0.75rem 1.25rem;
        border-radius: var(--radius-sm);
        font-weight: 600;
        transition: all 0.3s;
        width: 100%;
    }
    .btn-menu-toggle:hover {
        background: var(--accent-green);
        color: var(--bg-primary);
    }
    .offcanvas-dash {
        background: var(--bg-primary) !important;
    }
    .offcanvas-dash .offcanvas-header {
        border-bottom: 1px solid var(--border-color);
    }
    .offcanvas-dash .offcanvas-title {
        color: var(--text-primary);
        font-weight: 700;
    }
    .offcanvas-dash .btn-close {
        filter: invert(1);
    }
    .offcanvas-dash .nav-link {
        color: var(--text-muted) !important;
        font-weight: 500;
        padding: 0.65rem 1rem !important;
        border-radius: var(--radius-sm);
    }
    .offcanvas-dash .nav-link:hover {
        color: var(--text-primary) !important;
        background: rgba(255,255,255,0.05);
    }
</style>

<button class="btn-menu-toggle d-lg-none mb-3" type="button" data-bs-toggle="offcanvas"
    data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu">
    <i class="fas fa-bars me-2"></i>Dashboard Menu
</button>

<div class="sidebar-dash d-none d-lg-block vh-100">
    <h4><i class="fas fa-gauge-high me-2"></i>Dashboard</h4>
    <ul class="nav nav-pills flex-column gap-1">
        <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>dashboard/<?php echo $_SESSION['role']; ?>/dashboard.php" 
               class="nav-link <?php echo $currentPage === 'dashboard.php' ? 'active' : ''; ?>">
                <i class="fas fa-chart-simple"></i>Statistics
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>dashboard/user/menu/team/my_team.php" 
               class="nav-link <?php echo $currentPage === 'my_team.php' ? 'active' : ''; ?>">
                <i class="fas fa-people-group"></i>My Team
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>dashboard/user/menu/tournament/tournament.php" 
               class="nav-link <?php echo $currentPage === 'tournament.php' ? 'active' : ''; ?>">
                <i class="fas fa-trophy"></i>Tournaments
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>dashboard/user/menu/news/news.php"
               class="nav-link <?php echo $currentPage === 'news.php' ? 'active' : ''; ?>">
                <i class="fas fa-newspaper"></i>My News & Blogs
            </a>
        </li>
        <li class="nav-item">
            <a href="<?php echo BASE_URL; ?>dashboard/user/menu/highlights/highlights.php"
               class="nav-link <?php echo $currentPage === 'highlights.php' ? 'active' : ''; ?>">
                <i class="fas fa-video"></i>Highlights
            </a>
        </li>
    </ul>
</div>

<div class="offcanvas offcanvas-start offcanvas-dash" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasMenuLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title fw-bold" id="offcanvasMenuLabel"><i class="fas fa-gauge-high me-2"></i>Dashboard Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>dashboard/<?php echo $_SESSION['role']; ?>/dashboard.php" 
                   class="nav-link <?php echo $currentPage === 'dashboard.php' ? 'active' : ''; ?>" 
                   data-bs-dismiss="offcanvas">
                    <i class="fas fa-chart-simple"></i>Statistics
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>dashboard/user/menu/team/my_team.php"
                   class="nav-link <?php echo $currentPage === 'my_team.php' ? 'active' : ''; ?>" 
                   data-bs-dismiss="offcanvas">
                    <i class="fas fa-people-group"></i>My Team
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>dashboard/user/menu/tournament/tournament.php"
                   class="nav-link <?php echo $currentPage === 'tournament.php' ? 'active' : ''; ?>" 
                   data-bs-dismiss="offcanvas">
                    <i class="fas fa-trophy"></i>Tournaments
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>dashboard/user/menu/news/news.php"
                   class="nav-link <?php echo $currentPage === 'news.php' ? 'active' : ''; ?>" 
                   data-bs-dismiss="offcanvas">
                    <i class="fas fa-newspaper"></i>My News & Blogs
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo BASE_URL; ?>dashboard/user/menu/highlights/highlights.php"
                   class="nav-link <?php echo $currentPage === 'highlights.php' ? 'active' : ''; ?>" 
                   data-bs-dismiss="offcanvas">
                    <i class="fas fa-video"></i>Highlights
                </a>
            </li>
        </ul>
    </div>
</div>
