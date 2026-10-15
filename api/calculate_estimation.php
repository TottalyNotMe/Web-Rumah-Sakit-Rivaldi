<?php
header('Content-Type: application/json');
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

$disease_id = isset($_POST['disease_id']) ? intval($_POST['disease_id']) : 0;
$room_class_id = isset($_POST['room_class_id']) ? intval($_POST['room_class_id']) : 0;
$days = isset($_POST['days']) ? intval($_POST['days']) : 0;
$payer_id = isset($_POST['payer_id']) ? intval($_POST['payer_id']) : 0;

if ($disease_id <= 0 || $room_class_id <= 0 || $days <= 0 || $payer_id <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'Mohon lengkapi semua pilihan dengan benar.']);
    exit;
}

$breakdown = [];
$subtotal = 0;

try {
    // 1. Kamar
    $stmtRoom = $pdo->prepare("SELECT class_name, price_per_day FROM room_classes WHERE id = ?");
    $stmtRoom->execute([$room_class_id]);
    $roomResult = $stmtRoom->fetch(PDO::FETCH_ASSOC);
    
    if ($roomResult) {
        $roomCost = $roomResult['price_per_day'] * $days;
        $subtotal += $roomCost;
        $breakdown[] = [
            'item' => 'Kamar ' . $roomResult['class_name'] . ' (' . $days . ' Hari)',
            'qty' => $days,
            'price' => $roomResult['price_per_day'],
            'total' => $roomCost
        ];
    }

    // 2. Medis
    $stmtMed = $pdo->prepare("
        SELECT ms.name, ms.price, ds.default_qty 
        FROM disease_services ds 
        JOIN medical_services ms ON ds.service_id = ms.id 
        WHERE ds.disease_id = ?
    ");
    $stmtMed->execute([$disease_id]);
    $medResults = $stmtMed->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($medResults as $med) {
        $itemTotal = $med['price'] * $med['default_qty'];
        $subtotal += $itemTotal;
        $breakdown[] = [
            'item' => $med['name'],
            'qty' => $med['default_qty'],
            'price' => $med['price'],
            'total' => $itemTotal
        ];
    }

    // 3. Asuransi
    $stmtPayer = $pdo->prepare("SELECT name, coverage_percentage, max_plafon FROM payer_policies WHERE id = ?");
    $stmtPayer->execute([$payer_id]);
    $payerResult = $stmtPayer->fetch(PDO::FETCH_ASSOC);

    $coverageAmount = 0;
    if ($payerResult) {
        $coverageAmount = $subtotal * ($payerResult['coverage_percentage'] / 100);
        if ($payerResult['max_plafon'] > 0 && $coverageAmount > $payerResult['max_plafon']) {
            $coverageAmount = $payerResult['max_plafon'];
        }
    }

    // 4. Total Pasien
    $patientTotal = max(0, $subtotal - $coverageAmount);

    echo json_encode([
        'status' => 'success',
        'data' => [
            'breakdown' => $breakdown,
            'subtotal' => $subtotal,
            'payer_name' => $payerResult['name'] ?? 'Umum',
            'coverage_amount' => $coverageAmount,
            'patient_total' => $patientTotal,
            'disclaimer' => 'Ini adalah nilai estimasi simulasi. Biaya aktual dapat berbeda berdasarkan kondisi riil pasien dan kebijakan rumah sakit yang berlaku.'
        ]
    ]);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Gagal menghitung: ' . $e->getMessage()]);
}
?>