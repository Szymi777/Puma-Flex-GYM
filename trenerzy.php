<?php
require 'db.php';

// Pobranie danych
$result = $mysqli->query("SELECT * FROM trenerzy");
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Trenerzy | Puma Flex</title>
<link rel="icon" href="fafik.jpg" type="image/x-icon">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="style.css">
</head>

<body>

<nav>
    <h1><a href="index.html" class="logo">PUMA FLEX</a></h1>
    <ul>
        <li><a href="index.html#oferta">Oferta</a></li>
        <li><a href="trenerzy.php">Trenerzy</a></li>
        <li><a href="karnety.html">Karnety</a></li>
        <li><a href="index.html#kontakt">Kontakt</a></li>
        <li><a href="welcome.php">Profil</a></li>
    </ul>
</nav>

<section class="trenerzy-hero">
    <h2 class="section-title">Nasi <span>Trenerzy</span></h2>

    <div class="trainers">

        <?php while($row = $result->fetch_assoc()): ?>
            <div class="trainer">
                <img src="<?= htmlspecialchars($row['zdjecie']) ?>">

                <div class="trainer-info">
                    <h3><?= htmlspecialchars($row['imie_nazwisko']) ?></h3>
                    <p><?= htmlspecialchars($row['specjalizacja']) ?></p>
                    <p><?= htmlspecialchars($row['opis']) ?></p>
                </div>
            </div>
        <?php endwhile; ?>

    </div>
</section>

</body>
</html>
