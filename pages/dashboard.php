<?php
require_once 'includes/auth_helper.php';
require_patient();

// Get patient id
$stmt = $pdo->prepare("SELECT id FROM patients WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$patient = $stmt->fetch(PDO::FETCH_ASSOC);
$patient_id = $patient['id'];

// Get next appointment
$stmt = $pdo->prepare("SELECT a.id, a.appointment_date, a.status, d.full_name as doctor_name, s.start_time, s.end_time
                       FROM appointments a 
                       JOIN doctors d ON a.doctor_id = d.id 
                       LEFT JOIN doctor_schedules s ON a.schedule_id = s.id
                       WHERE a.patient_id = ? AND a.status IN ('PENDING', 'CONFIRMED', 'CHECKED-IN') 
                       ORDER BY a.appointment_date ASC LIMIT 1");
$stmt->execute([$patient_id]);
$next_app = $stmt->fetch(PDO::FETCH_ASSOC);

// Get queue if today
$queue = null;
if ($next_app && $next_app['appointment_date'] == date('Y-m-d')) {
    $stmt = $pdo->prepare("SELECT queue_number, status FROM queues WHERE appointment_id = ?");
    $stmt->execute([$next_app['id']]);
    $queue = $stmt->fetch(PDO::FETCH_ASSOC);
}

// Get unpaid bills
$stmt = $pdo->prepare("SELECT COUNT(id) as unpaid_count FROM invoices WHERE patient_id = ? AND status = 'UNPAID'");
$stmt->execute([$patient_id]);
$unpaid = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="container dashboard-container">
    <div class="dashboard-header">
        <h2>Halo, <?= htmlspecialchars($_SESSION['user_name']) ?></h2>
        <p>Selamat datang di Patient Portal IHIS.</p>
    </div>

    <div class="dashboard-grid">
        <!-- Antrean -->
        <div class="dashboard-card card-blue">
            <h3>Antrean Hari Ini</h3>
            <?php if($queue): ?>
                <div class="card-value"><?= htmlspecialchars($queue['queue_number']) ?></div>
                <p>Status: <strong><?= $queue['status'] ?></strong></p>
                <?php if($queue['status'] == 'CALLED'): ?>
                    <p style="color:#16a34a; font-weight:bold; margin-top:5px;">Silakan menuju ruangan poli sekarang!</p>
                <?php endif; ?>
            <?php else: ?>
                <div class="card-value" style="font-size:2rem; margin-top:10px;">-</div>
                <p>Tidak ada antrean hari ini</p>
            <?php endif; ?>
        </div>
        
        <!-- Janji Temu -->
        <div class="dashboard-card card-green">
            <h3>Janji Temu Berikutnya</h3>
            <?php if($next_app): ?>
                <div class="card-highlight"><?= htmlspecialchars($next_app['doctor_name']) ?></div>
                <p><?= $next_app['appointment_date'] ?> - <?= $next_app['appointment_time'] ?></p>
                <p class="status-confirmed" style="color: <?= $next_app['status'] == 'CONFIRMED' ? '#16a34a' : '#d97706' ?>">
                    Status: <?= $next_app['status'] ?>
                </p>
            <?php else: ?>
                <div class="card-highlight">Belum ada janji temu</div>
                <a href="index.php?page=book_appointment" style="color:var(--primary-color); font-weight:bold; margin-top:10px; display:block;">Buat Janji &rarr;</a>
            <?php endif; ?>
        </div>

        <!-- Rekam Medis -->
        <a href="index.php?page=medical_records" class="dashboard-card card-purple clickable">
            <div class="card-icon"><i class="fa-solid fa-file-medical"></i></div>
            <h3>Rekam Medis (EMR)</h3>
            <p>Lihat riwayat pemeriksaan terakhir</p>
        </a>

        <!-- Tagihan -->
        <a href="index.php?page=billing" class="dashboard-card card-orange clickable">
            <div class="card-icon"><i class="fa-solid fa-file-invoice-dollar"></i></div>
            <h3>Tagihan & Billing</h3>
            <?php if($unpaid['unpaid_count'] > 0): ?>
                <p style="color:red; font-weight:bold;">Ada <?= $unpaid['unpaid_count'] ?> tagihan tertunda</p>
            <?php else: ?>
                <p>Tidak ada tagihan tertunda</p>
            <?php endif; ?>
        </a>
    </div>
</div>
