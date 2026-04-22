<?php
// Uruchamiamy sesję (musi być na samej górze)
session_start();

// Sprawdzamy czy użytkownik jest zalogowany
if (!isset($_SESSION['user_id'])) {
    // Jeśli nie – przekierowanie do logowania
    header('Location: login.php');
    exit; // zatrzymanie dalszego wykonywania
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil | Puma Flex</title>
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
<div class="hero">
        <!-- Wyświetlamy dane użytkownika z sesji -->
    <h1>Witaj, <?= htmlspecialchars($_SESSION['user_login']) ?>!</h1>

    <!-- htmlspecialchars zabezpiecza przed XSS -->

    <h1>Twoje ID w bazie: <?= htmlspecialchars($_SESSION['user_id']) ?></h1>

    <!-- Link do wylogowania -->
    <h1><a href="logout.php">Wyloguj się</a></h1>
</div></body>
</html>
