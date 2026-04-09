<?php
$host = '127.0.0.1';
$db   = 'pumaflex_db';
$user = 'root'; // Zmień na dane produkcyjne
$pass = '';     // Zmień na dane produkcyjne
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Krytyczne dla bezpieczeństwa
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // W środowisku produkcyjnym logujemy błąd do pliku, nie na ekran!
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>