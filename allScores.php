<?php
try {
   require_once 'utils.php'; // Include utility functions
   include './components/shared/general-header.php';
   require_once 'config.php'; // Include the database connection

   // Declare the query
   $query = "
      SELECT 
          DATE(mp.match_day) AS match_date, mp.match_type, 
          mp.match_end,
          t1.id AS team_1_id, t1.name AS team_1_name, t1.logo AS team_1_logo, 
          t2.id AS team_2_id, t2.name AS team_2_name, t2.logo AS team_2_logo, 
          tts1.score AS team_1_score, tts2.score AS team_2_score, 
          tts1.wickets AS team_1_wickets, tts2.wickets AS team_2_wickets,
          tts1.goals AS team_1_goals, tts2.goals AS team_2_goals
      FROM match_played mp
      JOIN team t1 ON mp.team_1_id = t1.id
      JOIN team t2 ON mp.team_2_id = t2.id
      LEFT JOIN tournament_team_score tts1 ON mp.team_1_id = tts1.team_id AND mp.id = tts1.match_id
      LEFT JOIN tournament_team_score tts2 ON mp.team_2_id = tts2.team_id AND mp.id = tts2.match_id
      ORDER BY mp.match_day DESC";

   // Prepare the query
   $stmt = $conn->prepare($query);

   // Execute the query
   $stmt->execute();

   // Fetch scores grouped by match date
   $scores = [];
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      // Determine the winner or mark as scheduled
      if ($row['match_end'] == 1) { // Only process ended matches
         $isFootball = (strtolower($row['match_type']) === 'football');
         $team_1_metric = $isFootball ? $row['team_1_goals'] : $row['team_1_score'];
         $team_2_metric = $isFootball ? $row['team_2_goals'] : $row['team_2_score'];

         if ((int) $team_1_metric > (int) $team_2_metric) {
            $row['winner'] = $row['team_1_name'];
         } elseif ((int) $team_1_metric < (int) $team_2_metric) {
            $row['winner'] = $row['team_2_name'];
         } else {
            $row['winner'] = 'Draw';
         }
      } else {
         $row['winner'] = 'Scheduled';
      }
      $scores[$row['match_date']][] = $row;
   }
} catch (PDOException $e) {
   // Display the full error inside HTML for debugging
   echo "<div style='padding: 2rem; background: #f8d7da; border: 1px solid #f5c2c7; color: #842029; border-radius: 8px;'>";
   echo "<h4>Database Error</h4>";
   echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
   echo "<p><strong>File:</strong> " . htmlspecialchars($e->getFile()) . "</p>";
   echo "<p><strong>Line:</strong> " . htmlspecialchars($e->getLine()) . "</p>";
   echo "</div>";
   die();
}
?>
<section id="scores" style="padding: 3rem 0; background-color: #f8f9fa;">
   <div class="container">
      <h2 class="text-center mb-4" style="text-transform: uppercase; font-weight: bold; color: #333;">Latest Scores</h2>

      <!-- Display scores grouped by match date -->
      <?php if (!empty($scores)): ?>
         <?php foreach ($scores as $matchDate => $matches): ?>
            <div class="mb-4">
               <h4 class="text-primary" style="font-weight: bold;"><?= htmlspecialchars(date('F j, Y', strtotime($matchDate))); ?></h4>
               <div class="row">
                  <?php foreach ($matches as $match): ?>
                     <div class="col-md-6 mb-3">
                        <div class="card shadow-sm border-0" style="background-color: #fff; border-radius: 8px;">
                           <div class="card-body p-4">
                              <!-- Teams and Scores -->
                              <div class="d-flex justify-content-between align-items-center">
                                 <!-- Team 1 -->
                                 <div class="team text-center" style="flex: 1;">
                                    <img src="./uploads/logos/<?= htmlspecialchars($match['team_1_logo']); ?>" alt="<?= htmlspecialchars($match['team_1_name']); ?> Logo"
                                       style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
                                    <p style="margin-top: 0.5rem; font-weight: bold; font-size: 1rem;"><?= htmlspecialchars($match['team_1_name']); ?></p>
                                    <p style="font-size: 0.9rem; color: #555;">
                                       <?= htmlspecialchars(
                                          strtolower($match['match_type']) === 'football'
                                             ? ($match['team_1_goals'] ?? '0')
                                             : ($match['team_1_score'] ?? '0') . ' / ' . ($match['team_1_wickets'] ?? '0')
                                       ); ?>
                                    </p>
                                 </div>

                                 <!-- VS Section -->
                                 <div class="vs text-center" style="flex: 0.2; font-size: 1.5rem; font-weight: bold; color: #333;">
                                    VS
                                 </div>

                                 <!-- Team 2 -->
                                 <div class="team text-center" style="flex: 1;">
                                    <img src="./uploads/logos/<?= htmlspecialchars($match['team_2_logo']); ?>" alt="<?= htmlspecialchars($match['team_2_name']); ?> Logo"
                                       style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 2px solid #ddd;">
                                    <p style="margin-top: 0.5rem; font-weight: bold; font-size: 1rem;"><?= htmlspecialchars($match['team_2_name']); ?></p>
                                    <p style="font-size: 0.9rem; color: #555;">
                                       <?= htmlspecialchars(
                                          strtolower($match['match_type']) === 'football'
                                             ? ($match['team_2_goals'] ?? '0')
                                             : ($match['team_2_score'] ?? '0') . ' / ' . ($match['team_2_wickets'] ?? '0')
                                       ); ?>
                                    </p>
                                 </div>
                              </div>

                              <!-- Match Type and Winner -->
                              <p class="text-center mt-3" style="font-size: 0.95rem;">
                                 Match Type: <strong><?= htmlspecialchars($match['match_type']); ?></strong><br>
                                 Winner: <strong><?= htmlspecialchars($match['winner']); ?></strong>
                              </p>
                           </div>
                        </div>
                     </div>
                  <?php endforeach; ?>
               </div>
            </div>
         <?php endforeach; ?>
      <?php else: ?>
         <p class="text-center" style="font-size: 1.2rem; color: #555;">No scores available for the selected criteria.</p>
      <?php endif; ?>
   </div>
</section>

<!-- Custom CSS -->
<style>
   #scores .team img {
      border-radius: 50%;
      border: 2px solid #ddd;
   }

   #scores .vs {
      font-size: 2rem;
      font-weight: bold;
      color: #333;
   }

   #scores .card {
      border-radius: 8px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
   }

   #scores .card:hover {
      transform: scale(1.02);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
   }

   #scores .team p {
      margin: 0;
      font-size: 0.9rem;
      font-weight: 500;
   }
</style>

<?php
include './components/shared/general-footer.php';
?>
