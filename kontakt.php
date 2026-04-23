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


//wykonujemy zapytanie
if ($conn->query($sql) === TRUE) {
    // Jeśli się udało, wyświetlamy JS i przekierowujemy
    echo "<script>
        alert('Wiadomość została wysłana pomyślnie!');
        window.location.href = 'index.html#kontakt';
    </script>";
    //jeśli bład
} else {
    echo "Błąd: " . $conn->error;
}

// Zamykamy połączenie z bazą
$conn->close();
?>