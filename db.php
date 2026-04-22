<?php
// Tworzymy połączenie z bazą danych
$mysqli = new mysqli('localhost', 'root', '', 'pumaflex');

// Sprawdzamy czy wystąpił błąd
if ($mysqli->connect_errno) {
    // Jeśli tak – zatrzymujemy program
    die('Błąd połączenia z bazą danych: ' . $mysqli->connect_error);
}
?>