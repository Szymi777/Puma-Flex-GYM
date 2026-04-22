<?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
        // jeśli nie ma danych w sesji – wracamy do logowania
        header('Location: login.php');
        exit;
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
        <li><a href="trenerzy.html">Trenerzy</a></li>
        <li><a href="karnety.html">Karnety</a></li>
        <li><a href="index.html#kontakt">Kontakt</a></li>
        <li><a href="welcome.php">Profil</a></li>
    </ul>
</nav>
<div class="hero">
<body>
    <h1>Witaj, <?= htmlspecialchars($_SESSION['user_login']) ?>!</h1>
    <h1>Twoje ID w bazie: <?= htmlspecialchars($_SESSION['user_id']) ?></h1>

    <h1><a href="logout.php">Wyloguj się</a></h1>
</body></div>
</html>
