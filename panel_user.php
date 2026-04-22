<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: logowanie.php"); exit;
}

$userId = $_SESSION['user_id'];

// DELETE Rezerwacji
if (isset($_POST['cancel_booking_id'])) {
    $bookingId = $_POST['cancel_booking_id'];
    $stmt = $pdo->prepare("DELETE FROM bookings WHERE id = :id AND user_id = :user_id");
    $stmt->execute(['id' => $bookingId, 'user_id' => $userId]);
    header("Location: panel_user.php"); exit;
}

// Pobieranie rezerwacji użytkownika
$stmt = $pdo->prepare("
    SELECT b.id, b.booking_time, c.name as class_name, t.name as trainer_name 
    FROM bookings b 
    LEFT JOIN classes c ON b.class_id = c.id 
    LEFT JOIN trainers t ON b.trainer_id = t.id 
    WHERE b.user_id = :user_id
");
$stmt->execute(['user_id' => $userId]);
$bookings = $stmt->fetchAll();

include 'header.php';
?>
<main style="padding-top: 120px; min-height: 80vh; width: 80%; margin: 0 auto;">
    <h2 class="section-title">Twój <span>Panel</span></h2>
    
    <div class="card">
        <h3>Twoje Rezerwacje</h3>
        <?php if(empty($bookings)): ?>
            <p>Nie masz żadnych rezerwacji. <a href="grafik.php" style="color: var(--primary-color);">Zapisz się na zajęcia!</a></p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Rodzaj</th>
                        <th>Data i czas</th>
                        <th>Akcja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($bookings as $b): ?>
                        <tr>
                            <td><?= $b['class_name'] ? "Zajęcia: " . htmlspecialchars($b['class_name']) : "Trening: " . htmlspecialchars($b['trainer_name']) ?></td>
                            <td><?= htmlspecialchars($b['booking_time']) ?></td>
                            <td>
                                <form method="POST" onsubmit="return confirm('Czy na pewno chcesz anulować?');">
                                    <input type="hidden" name="cancel_booking_id" value="<?= $b['id'] ?>">
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 12px;">Anuluj</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</main>
<?php include 'footer.php'; ?>