<?php
require 'db.php';
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $stmt = $pdo->prepare("SELECT id, name, password_hash, role FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            
            header("Location: " . ($user['role'] === 'admin' ? 'panel_admina.php' : 'panel_user.php'));
            exit;
        } else {
            $error = 'Nieprawidłowy e-mail lub hasło.';
        }
    }
}
include 'header.php';
?>
<main style="padding-top: 150px; min-height: 80vh;">
    <h2 class="section-title">Logowanie <span>Użytkownika</span></h2>
    <div class="form-container">
        <?php if($error): ?><p style="color:var(--danger); margin-bottom:15px;"><?= $error ?></p><?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn" style="width: 100%;">Zaloguj</button>
        </form>
        <p style="margin-top: 20px; text-align: center;">Nie masz konta? <a href="rejestracja.php" style="color: var(--primary-color);">Zarejestruj się</a></p>
    </div>
</main>
<?php include 'footer.php'; ?>