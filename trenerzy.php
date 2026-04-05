<?php 
require 'db.php';
include 'header.php'; 

$stmt = $pdo->query("SELECT * FROM trainers LIMIT 6");
$trainers = $stmt->fetchAll();
?>

<main style="padding-top: 120px;">
    <section>
        <h2 class="section-title">Nasi <span>Trenerzy</span></h2>
        <div class="grid-container">
            <?php foreach($trainers as $trainer): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($trainer['name']) ?></h3>
                    <p style="color: var(--primary-color); font-weight: bold; margin-bottom: 10px;">
                        <?= htmlspecialchars($trainer['specialization']) ?>
                    </p>
                    <p><?= htmlspecialchars($trainer['description']) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>