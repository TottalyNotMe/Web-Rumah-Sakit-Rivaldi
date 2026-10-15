<?php
header('Content-Type: application/json');
require_once '../config/database.php';

$response = ['status' => 'error', 'data' => []];

try {
    $stmtFac = $pdo->query("SELECT * FROM facilities WHERE is_active = 1 ORDER BY category ASC");
    $facilities = $stmtFac->fetchAll(PDO::FETCH_ASSOC);

    $stmtRoom = $pdo->query("SELECT * FROM room_classes WHERE is_active = 1 ORDER BY price_per_day DESC");
    $rooms = $stmtRoom->fetchAll(PDO::FETCH_ASSOC);

    $response['status'] = 'success';
    $response['data'] = [
        'facilities' => $facilities,
        'rooms' => $rooms
    ];
} catch (PDOException $e) {
    $response['message'] = 'Database Error: ' . $e->getMessage();
}

echo json_encode($response);
?>