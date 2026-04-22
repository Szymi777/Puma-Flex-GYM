<?php
require 'db.php';
// Dołączamy header, który ma już wbudowane session_start()
include 'header.php';

// Pobieranie wszystkich karnetów z bazy danych
$stmt = $pdo->query("SELECT * FROM memberships");
$memberships = $stmt->fetchAll();
?>

<main style="padding-top: 120px; min-height: 80vh;">
    <section>
        <h2 class="section-title">Nasza <span>Oferta</span></h2>
        <div class="grid-container">
            <?php foreach($memberships as $plan): ?>
                <div class="card" style="text-align: center;">
                    <h3><?= htmlspecialchars($plan['name']) ?></h3>
                    <p style="font-size: 48px; color: var(--primary-color); margin: 20px 0; font-weight: bold;">
                        <?= htmlspecialchars($plan['price']) ?> zł
                    </p>
                    <p style="margin-bottom: 30px; font-size: 16px;">
                        <?= htmlspecialchars($plan['features']) ?>
                    </p>
                    
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <button class="btn" onclick="alert('Dziękujemy! Opcja płatności online wkrótce dostępna.')" style="width: 100%;">Wybierz ten plan</button>
                    <?php else: ?>
                        <a href="logowanie.php" class="btn" style="width: 100%;">Zaloguj się by kupić</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>