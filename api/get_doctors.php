<?php
require_once '../config/database.php';
header('Content-Type: application/json');

if (isset($_GET['poly_id'])) {
    $stmt = $pdo->prepare("SELECT id, full_name, specialty, fee FROM doctors WHERE poly_id = ? AND status = 'ACTIVE'");
    $stmt->execute([$_GET['poly_id']]);
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} else {
    echo json_encode([]);
}
?>
