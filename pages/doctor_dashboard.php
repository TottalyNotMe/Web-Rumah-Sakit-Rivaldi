<?php
require_once 'includes/auth_helper.php';
require_doctor();

// Get Doctor ID
$stmt = $pdo->prepare("SELECT id FROM doctors WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$doctor_id = $stmt->fetchColumn();

// Get stats
$stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE doctor_id = ? AND appointment_date = CURDATE()");
$stmt->execute([$doctor_id]);
$total_patients = $stmt->fetchColumn();

$stmt = $pdo->prepare("SELECT COUNT(*) FROM queues q JOIN appointments a ON q.appointment_id = a.id WHERE a.doctor_id = ? AND a.appointment_date = CURDATE() AND q.status IN ('WAITING', 'CALLED')");
$stmt->execute([$doctor_id]);
$waiting_patients = $stmt->fetchColumn();

// Get queue
$stmt = $pdo->prepare("SELECT q.id as queue_id, q.queue_number, q.status, p.full_name as patient_name, a.appointment_time, a.id as appointment_id 
                       FROM queues q
                       JOIN appointments a ON q.appointment_id = a.id
                       JOIN patients p ON a.patient_id = p.id
                       WHERE a.doctor_id = ? AND a.appointment_date = CURDATE()
                       ORDER BY q.queue_number ASC");
$stmt->execute([$doctor_id]);
$queues = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container page-wrapper">
    <div class="page-header">
        <h2>Dashboard Dokter</h2>
        <p>Jadwal dan antrean pasien Anda hari ini.</p>
    </div>
    <div class="card-grid" style="margin-bottom:30px;">
        <div class="card" style="border-left: 4px solid var(--primary-color);">
            <h3 style="color:var(--text-muted); font-size:1rem;">Total Pasien Hari Ini</h3>
            <div style="font-size:2.5rem; font-weight:bold; margin-top:10px; color:var(--text-main);"><?= $total_patients ?></div>
        </div>
        <div class="card" style="border-left: 4px solid #16a34a;">
            <h3 style="color:var(--text-muted); font-size:1rem;">Menunggu Antrean</h3>
            <div style="font-size:2.5rem; font-weight:bold; margin-top:10px; color:var(--text-main);"><?= $waiting_patients ?></div>
        </div>
    </div>
    
    <div class="card">
        <h3 style="margin-bottom: 15px;">Daftar Antrean</h3>
        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb; text-align: left;">
                        <th style="padding: 12px;">No. Antrean</th>
                        <th style="padding: 12px;">Nama Pasien</th>
                        <th style="padding: 12px;">Waktu</th>
                        <th style="padding: 12px;">Status</th>
                        <th style="padding: 12px;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($queues) > 0): ?>
                        <?php foreach($queues as $q): ?>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; font-weight:bold; font-size:1.1rem;"><?= htmlspecialchars($q['queue_number']) ?></td>
                            <td style="padding: 12px;"><?= htmlspecialchars($q['patient_name']) ?></td>
                            <td style="padding: 12px;"><?= substr($q['appointment_time'], 0, 5) ?></td>
                            <td style="padding: 12px;">
                                <span style="font-weight: 600; font-size: 0.8rem; padding: 3px 8px; border-radius: 10px;
                                    <?= $q['status'] == 'WAITING' ? 'background:#fef3c7; color:#d97706;' : '' ?>
                                    <?= $q['status'] == 'CALLED' ? 'background:#dcfce7; color:#16a34a;' : '' ?>
                                    <?= $q['status'] == 'IN_PROGRESS' ? 'background:#dbeafe; color:#2563eb;' : '' ?>
                                    <?= $q['status'] == 'COMPLETED' ? 'background:#f3f4f6; color:#6b7280;' : '' ?>
                                    <?= $q['status'] == 'SKIPPED' ? 'background:#fee2e2; color:#dc2626;' : '' ?>
                                "><?= $q['status'] ?></span>
                            </td>
                            <td style="padding: 12px;">
                                <?php if($q['status'] == 'CALLED' || $q['status'] == 'IN_PROGRESS' || $q['status'] == 'WAITING'): ?>
                                    <a href="index.php?page=doctor_encounter&app_id=<?= $q['appointment_id'] ?>&q_id=<?= $q['queue_id'] ?>" class="btn btn-primary" style="padding:6px 12px; font-size:12px;"><i class="fa-solid fa-stethoscope"></i> Periksa</a>
                                <?php else: ?>
                                    <button class="btn btn-light" style="padding:6px 12px; font-size:12px; opacity:0.5;" disabled>Periksa</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" style="padding: 20px; text-align: center; color: var(--text-muted);">Tidak ada jadwal pasien hari ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
