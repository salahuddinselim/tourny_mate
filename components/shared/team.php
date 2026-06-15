<section class="section-pad" style="background:var(--bg-secondary);">
    <div class="container">
        <div class="section-title">
            <div class="label">The Crew</div>
            <h2>Meet Our <span class="hl">Team</span></h2>
            <p>The brilliant minds behind BattleBase</p>
        </div>
        <div class="row g-4 justify-content-center">
            <?php
            $team = [
                ["name" => "Salah Uddin Selim", "student_id" => "0112230512", "semester" => "7th trimester", "university" => "United International University", "image" => "photos/selim.jpg"],
                ["name" => "Afia Tasnim Ria", "student_id" => "0112231058", "semester" => "7th trimester", "university" => "United International University", "image" => "photos/afia.jpg"],
                ["name" => "Monirul Islam", "student_id" => "011222088", "semester" => "8th trimester", "university" => "United International University", "image" => "photos/Moni.jpg"]
            ];
            foreach ($team as $member):
            ?>
                <div class="col-md-4 col-lg-3">
                    <div class="card-battle text-center h-100">
                        <img src="<?= $member['image']; ?>" alt="<?= $member['name']; ?>" 
                             style="width:100px;height:100px;object-fit:cover;border-radius:50%;margin-bottom:1rem;border:3px solid var(--accent-orange);">
                        <h4 style="font-weight:700;color:var(--text-primary);font-size:1.05rem;"><?= $member['name']; ?></h4>
                        <p style="color:var(--text-muted);font-size:.85rem;margin-bottom:4px;"><i class="fas fa-id-card me-1" style="color:var(--accent-orange);"></i>ID: <?= $member['student_id']; ?></p>
                        <p style="color:var(--text-muted);font-size:.85rem;margin-bottom:4px;"><i class="fas fa-graduation-cap me-1" style="color:var(--accent-orange);"></i><?= $member['semester']; ?></p>
                        <p style="color:var(--text-muted);font-size:.85rem;"><i class="fas fa-university me-1" style="color:var(--accent-orange);"></i><?= $member['university']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
