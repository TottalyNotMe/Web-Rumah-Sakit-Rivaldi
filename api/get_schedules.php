<?php
require_once '../config/database.php';
header('Content-Type: application/json');

if (isset($_GET['doctor_id']) && isset($_GET['date'])) {
    $doctor_id = $_GET['doctor_id'];
    $date = $_GET['date'];
    
    $dayOfWeek = date('l', strtotime($date));
    
    // Get schedule
    $stmt = $pdo->prepare("SELECT id, start_time, end_time, quota FROM doctor_schedules WHERE doctor_id = ? AND day_of_week = ?");
    $stmt->execute([$doctor_id, $dayOfWeek]);
    $schedule = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($schedule) {
        // Check booked
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE schedule_id = ? AND appointment_date = ? AND status != 'CANCELLED'");
        $stmt->execute([$schedule['id'], $date]);
        $booked = $stmt->fetchColumn();
        
        $schedule['available'] = $schedule['quota'] - $booked;
        echo json_encode($schedule);
    } else {
        echo json_encode(['error' => 'Dokter tidak memiliki jadwal pada hari tersebut.']);
    }
} else {
    echo json_encode(['error' => 'Invalid parameters.']);
}
?>
