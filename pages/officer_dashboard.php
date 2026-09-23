<?php
require_once 'includes/auth_helper.php';
require_officer();

// Get queue summary for today
$stmt = $pdo->query("SELECT q.status, COUNT(*) as count 
                     FROM queues q 
                     JOIN appointments a ON q.appointment_id = a.id 
                     WHERE a.appointment_date = CURDATE() 
                     GROUP BY q.status");
$queue_stats = [];
foreach($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
    $queue_stats[$row['status']] = $row['count'];
}

$waiting = $queue_stats['WAITING'] ?? 0;
$in_progress = $queue_stats['IN_PROGRESS'] ?? 0;
$completed = $queue_stats['COMPLETED'] ?? 0;

// Get upcoming queues
$stmt = $pdo->query("SELECT q.queue_number, q.status, p.full_name as patient_name, p.mrn, d.full_name as doctor_name, a.appointment_time
                     FROM queues q
                     JOIN appointments a ON q.appointment_id = a.id
                     JOIN patients p ON a.patient_id = p.id
                     JOIN doctors d ON a.doctor_id = d.id
                     WHERE a.appointment_date = CURDATE() AND q.status IN ('WAITING', 'CALLED')
                     ORDER BY q.queue_number ASC
                     LIMIT 5");
$upcoming_queues = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container page-wrapper">
    <div class="page-header">
        <h2>Dashboard Petugas</h2>
        <p>Pantau antrean pasien dan operasional harian.</p>
    </div>
    
    <div class="card-grid" style="margin-bottom:30px;">
        <div class="card">
            <h3 style="color:var(--text-muted); font-size:1rem;">Menunggu</h3>
            <div style="font-size:2.5rem; font-weight:bold; margin-top:10px; color:#d97706;"><?= $waiting ?></div>
        </div>
        <div class="card">
            <h3 style="color:var(--text-muted); font-size:1rem;">Sedang Diperiksa</h3>
            <div style="font-size:2.5rem; font-weight:bold; margin-top:10px; color:var(--primary-color);"><?= $in_progress ?></div>
        </div>
        <div class="card">
            <h3 style="color:var(--text-muted); font-size:1rem;">Selesai Hari Ini</h3>
            <div style="font-size:2.5rem; font-weight:bold; margin-top:10px; color:#16a34a;"><?= $completed ?></div>
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="card" style="grid-column: span 2;">
            <div style="display: flex; justify-content: space-between; margin-bottom: 20px; align-items: center;">
                <h3>Antrean Berikutnya</h3>
                <a href="index.php?page=queue_management" class="btn btn-primary">Kelola Antrean</a>
            </div>
            
            <div class="table-responsive">
                <table class="table" style="width:100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e5e7eb; text-align: left;">
                            <th style="padding: 10px;">No. Antrean</th>
                            <th style="padding: 10px;">Pasien</th>
                            <th style="padding: 10px;">Dokter</th>
                            <th style="padding: 10px;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(count($upcoming_queues) > 0): ?>
                            <?php foreach($upcoming_queues as $q): ?>
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 10px; font-weight:bold; font-size: 1.1rem;"><?= htmlspecialchars($q['queue_number']) ?></td>
                                <td style="padding: 10px;">
                                    <?= htmlspecialchars($q['patient_name']) ?> <br>
                                    <small style="color:var(--text-muted)"><?= htmlspecialchars($q['mrn']) ?></small>
                                </td>
                                <td style="padding: 10px;"><?= htmlspecialchars($q['doctor_name']) ?></td>
                                <td style="padding: 10px;">
                                    <span style="background: <?= $q['status'] == 'CALLED' ? '#dcfce7' : '#fef3c7' ?>; color: <?= $q['status'] == 'CALLED' ? '#16a34a' : '#d97706' ?>; padding: 2px 8px; border-radius: 10px; font-size: 0.75rem; font-weight: 600;">
                                        <?= $q['status'] ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" style="padding: 20px; text-align: center; color: var(--text-muted);">Belum ada antrean masuk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="card">
            <h3>Aksi Cepat</h3>
            <div style="margin-top: 15px; display: flex; flex-direction: column; gap: 10px;">
                <a href="index.php?page=register" class="btn btn-light" style="text-align:left; border:1px solid #e5e7eb;"><i class="fa-solid fa-user-plus"></i> Registrasi Pasien</a>
                <a href="index.php?page=book_appointment" class="btn btn-light" style="text-align:left; border:1px solid #e5e7eb;"><i class="fa-solid fa-calendar-plus"></i> Buat Janji</a>
                <a href="index.php?page=billing" class="btn btn-light" style="text-align:left; border:1px solid #e5e7eb;"><i class="fa-solid fa-cash-register"></i> Pembayaran</a>
            </div>
        </div>
    </div>
</div>
