<?php
header('Content-Type: application/json');
require_once '../config/database.php';

$response = ['status' => 'error', 'data' => []];

try {
    $stmtDis = $pdo->query("SELECT id, name, category FROM diseases ORDER BY name ASC");
    $diseases = $stmtDis->fetchAll(PDO::FETCH_ASSOC);

    $stmtPayer = $pdo->query("SELECT id, name, type, notes FROM payer_policies ORDER BY id ASC");
    $payers = $stmtPayer->fetchAll(PDO::FETCH_ASSOC);

    $response['status'] = 'success';
    $response['data'] = [
        'diseases' => $diseases,
        'payers' => $payers
    ];
} catch (PDOException $e) {
    $response['message'] = 'Database Error: ' . $e->getMessage();
}

echo json_encode($response);
?>