<?php
require_once 'includes/auth_helper.php';
require_patient();

// Get patient id
$stmt = $pdo->prepare("SELECT id FROM patients WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$patient = $stmt->fetch(PDO::FETCH_ASSOC);
$patient_id = $patient['id'];

// Get medical records
$stmt = $pdo->prepare("SELECT mr.*, d.full_name as doctor_name, a.appointment_date 
                       FROM medical_records mr 
                       JOIN doctors d ON mr.doctor_id = d.id 
                       LEFT JOIN appointments a ON mr.appointment_id = a.id
                       WHERE mr.patient_id = ? 
                       ORDER BY mr.created_at DESC");
$stmt->execute([$patient_id]);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container page-wrapper">
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2>Rekam Medis Elektronik (EMR)</h2>
            <p>Riwayat pemeriksaan kesehatan Anda.</p>
        </div>
        <a href="index.php?page=dashboard" class="btn btn-light">&larr; Kembali</a>
    </div>
    
    <div class="card">
        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb; text-align: left;">
                        <th style="padding: 12px;">Tanggal Kunjungan</th>
                        <th style="padding: 12px;">Dokter Pemeriksa</th>
                        <th style="padding: 12px;">Keluhan Utama</th>
                        <th style="padding: 12px;">Diagnosis</th>
                        <th style="padding: 12px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($records) > 0): ?>
                        <?php foreach($records as $mr): ?>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; font-weight: 500;">
                                <?= $mr['appointment_date'] ? date('d M Y', strtotime($mr['appointment_date'])) : date('d M Y', strtotime($mr['created_at'])) ?>
                            </td>
                            <td style="padding: 12px;"><?= htmlspecialchars($mr['doctor_name']) ?></td>
                            <td style="padding: 12px; color:var(--text-muted);"><?= htmlspecialchars(substr($mr['complaint'], 0, 50)) ?>...</td>
                            <td style="padding: 12px; font-weight: bold;"><?= htmlspecialchars($mr['diagnosis']) ?></td>
                            <td style="padding: 12px;">
                                <button class="btn btn-light" style="padding:4px 8px; font-size:12px;" onclick="alert('Fitur cetak resume medis sedang dalam pengembangan.')">Lihat Resume</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" style="padding: 20px; text-align: center; color: var(--text-muted);">Belum ada riwayat rekam medis.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
