<?php
    session_start();
    require 'db.php';
    $komunikat = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $login = trim($_POST['login'] ?? '');
        $haslo = trim($_POST['haslo'] ?? '');

        if ($login === '' || $haslo === '') {
            $komunikat = "Podaj login i hasło!";
        } else {
            $stmt = $mysqli->prepare("SELECT id, haslo FROM uzytkownicy WHERE login = ?");
            $stmt->bind_param('s', $login);
            $stmt->execute();
            $res = $stmt->get_result();

            if ($row = $res->fetch_assoc()) {
                if (password_verify($haslo, $row['haslo'])) {
                    // ✔ Zapisujemy dane do sesji
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['user_login'] = $login;

                    header('Location: welcome.php');
                    exit;
                } else {
                    $komunikat = "Niepoprawne hasło!";
                }
            } else {
                $komunikat = "Nie znaleziono takiego użytkownika!";
            }
            $stmt->close();
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logowanie | Puma Flex</title>
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
    <h1>Logowanie</h1>

    <form method="post">
        <label>Login: <input type="text" name="login"></label><br>
        <label>Hasło: <input type="password" name="haslo"></label><br><br>
        <button type="submit">Zaloguj</button>
    </form>

    <p style="color:darkred;"><?= htmlspecialchars($komunikat) ?></p>
    <h1><a class='kolorowy' href="register.php">Nie masz konta? Zarejestruj się</a></h1>
</body></div>
</html>
