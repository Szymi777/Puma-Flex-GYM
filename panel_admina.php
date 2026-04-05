<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: logowanie.php"); exit;
}

// Logika usuwania użytkownika
if (isset($_POST['delete_user_id']) && isset($_POST['reason'])) {
    $delUserId = (int)$_POST['delete_user_id'];
    $reason = trim($_POST['reason']);
    
    // Zabezpieczenie przed usunięciem samego siebie
    if ($delUserId !== $_SESSION['user_id'] && !empty($reason)) {
        // Pobierz email przed usunięciem
        $stmtMail = $pdo->prepare("SELECT email FROM users WHERE id = :id");
        $stmtMail->execute(['id' => $delUserId]);
        $userEmail = $stmtMail->fetchColumn();

        if ($userEmail) {
            $pdo->beginTransaction();
            try {
                // Dodaj log
                $stmtLog = $pdo->prepare("INSERT INTO deletion_logs (admin_id, deleted_user_email, reason) VALUES (:admin, :email, :reason)");
                $stmtLog->execute(['admin' => $_SESSION['user_id'], 'email' => $userEmail, 'reason' => $reason]);
                
                // Usuń użytkownika (CASCADE usunie jego rezerwacje w bazie)
                $stmtDel = $pdo->prepare("DELETE FROM users WHERE id = :id");
                $stmtDel->execute(['id' => $delUserId]);
                
                $pdo->commit();
            } catch (Exception $e) {
                $pdo->rollBack();
            }
        }
    }
    header("Location: panel_admina.php"); exit;
}

// Odczyt wszystkich użytkowników
$users = $pdo->query("SELECT id, name, email, role FROM users")->fetchAll();

include 'header.php';
?>
<main style="padding-top: 120px; min-height: 80vh; width: 90%; margin: 0 auto;">
    <h2 class="section-title">Panel <span>Administratora</span></h2>
    
    <div class="card" style="margin-bottom: 40px;">
        <h3>Zarządzanie Użytkownikami</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th><th>Imię</th><th>E-mail</th><th>Rola</th><th>Akcja</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($users as $u): ?>
                    <tr>
                        <td><?= $u['id'] ?></td>
                        <td><?= htmlspecialchars($u['name']) ?></td>
                        <td><?= htmlspecialchars($u['email']) ?></td>
                        <td><?= htmlspecialchars($u['role']) ?></td>
                        <td>
                            <?php if($u['id'] !== $_SESSION['user_id']): ?>
                                <form method="POST" style="display:flex; gap: 10px;">
                                    <input type="hidden" name="delete_user_id" value="<?= $u['id'] ?>">
                                    <label for="reason_<?= $u['id'] ?>" class="sr-only" style="display:none;">Powód usunięcia</label>
                                    <input type="text" id="reason_<?= $u['id'] ?>" name="reason" placeholder="Powód usunięcia" required style="padding: 5px; border-radius: 3px; border: 1px solid #444; background: #222; color: #fff;">
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 15px;">Usuń</button>
                                </form>
                            <?php else: ?>
                                <span style="color:#aaa;">Brak (Ty)</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php include 'footer.php'; ?>