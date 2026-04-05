<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puma Flex | Siłownia Premium</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav>
    <h1><a href="index.php">PUMA FLEX</a></h1>
    <ul>
        <li><a href="oferta.php">Oferta</a></li>
        <li><a href="trenerzy.php">Trenerzy</a></li>
        <li><a href="strefy.php">Strefy</a></li>
        <li><a href="grafik.php">Grafik</a></li>
        <?php if(isset($_SESSION['user_id'])): ?>
            <?php if($_SESSION['role'] === 'admin'): ?>
                <li><a href="panel_admina.php" style="color:#e74c3c;">Panel Admina</a></li>
            <?php else: ?>
                <li><a href="panel_user.php">Mój Profil</a></li>
            <?php endif; ?>
            <li><a href="wyloguj.php">Wyloguj</a></li>
        <?php else: ?>
            <li><a href="logowanie.php" class="btn" style="padding: 10px 20px;">Zaloguj się</a></li>
        <?php endif; ?>
    </ul>
</nav>