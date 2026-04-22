<?php
// Tworzymy połączenie z bazą danych (host, użytkownik, hasło, baza)
$conn = new mysqli("localhost", "root", "", "pumaflex");

// Sprawdzamy czy połączenie się udało
if ($conn->connect_error) {
    // Jeśli nie – kończymy program i wyświetlamy błąd
    die("Błąd połączenia: " . $conn->connect_error);
}

// Pobieramy dane z formularza (metoda POST)
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Tworzymy zapytanie SQL (UWAGA: podatne na SQL Injection!)
$sql = "INSERT INTO kontakt (name, email, message) 
        VALUES ('$name', '$email', '$message')";

// Wykonujemy zapytanie
if ($conn->query($sql) === TRUE) {
    // Jeśli się udało
    echo "Wiadomość została wysłana!";
} else {
    // Jeśli błąd – pokazujemy komunikat
    echo "Błąd: " . $conn->error;
}

// Zamykamy połączenie z bazą
$conn->close();
?>