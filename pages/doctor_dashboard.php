<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Otorisasi: Pastikan user login dan rolenya doctor
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'doctor') {
    header("Location: index.php?page=dashboard");
    exit();
}

try {
    // 1. Get Doctor ID & Info (PERBAIKAN SQL DI SINI)
    $stmt = $pdo->prepare("SELECT id, full_name, specialty FROM doctors WHERE user_id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$doctor) {
        die("<div style='padding:20px; text-align:center;'>Data profil dokter Anda belum lengkap di database. Silakan hubungi Admin.</div>");
    }
    
    $doctor_id = $doctor['id'];

    // 2. Get stats (Total)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE doctor_id = ? AND appointment_date = CURDATE()");
    $stmt->execute([$doctor_id]);
    $total_patients = $stmt->fetchColumn();

    // 3. Get stats (Waiting / Checked-In)
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE doctor_id = ? AND appointment_date = CURDATE() AND status IN ('PENDING', 'CHECKED-IN')");
    $stmt->execute([$doctor_id]);
    $waiting_patients = $stmt->fetchColumn();

    // 4. Get queue 
    $stmt = $pdo->prepare("
        SELECT a.id as appointment_id, a.queue_number, a.status, a.complaint, p.full_name as patient_name 
        FROM appointments a
        JOIN patients p ON a.patient_id = p.id
        WHERE a.doctor_id = ? AND a.appointment_date = CURDATE()
        ORDER BY FIELD(a.status, 'CHECKED-IN', 'PENDING', 'COMPLETED', 'CANCELLED'), a.queue_number ASC
    ");
    $stmt->execute([$doctor_id]);
    $queues = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>

<div class="container page-wrapper" style="max-width: 1000px; margin: 30px auto; padding: 0 20px;">
    
    <!-- HEADER BARU: Welcome Banner & Tombol Edit Profil -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; background: white; padding: 20px 25px; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #3b82f6; flex-wrap: wrap; gap: 15px;">
        <div>
            <h2 style="margin: 0 0 5px; font-size: 22px; color: #1e293b;">Selamat Bertugas, <?= htmlspecialchars($doctor['full_name']) ?>!</h2>
            <p style="margin: 0; color: #64748b; font-size: 15px;">
                Spesialis <?= htmlspecialchars($doctor['specialty']) ?> &bull; Jadwal Hari Ini: <strong><?= date('d F Y') ?></strong>
            </p>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="index.php?page=doctor_patients" style="background: #0284c7; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <i class="fa-solid fa-users"></i> Data Pasien Binaan
            </a>
            <a href="index.php?page=doctor_profile" style="background: #f59e0b; color: white; padding: 10px 18px; border-radius: 6px; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <i class="fa-solid fa-user-pen"></i> Edit Profil
            </a>
        </div>
    </div>

    <!-- BANNER BIRU BAWAAN ANDA -->
    <div class="page-header" style="margin-bottom: 25px; background: #3b82f6; color: white; padding: 30px; border-radius: 12px; text-align: center; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
        <h2 style="margin: 0 0 10px; font-size: 28px;">Dashboard Dokter</h2>
        <p style="margin: 0; opacity: 0.9;">Jadwal dan antrean pasien Anda hari ini.</p>
    </div>
    
    <!-- STATISTIK KARTU -->
    <div class="card-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
        <div class="card" style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-left: 4px solid #3b82f6;">
            <h3 style="color: #64748b; font-size: 1rem; margin: 0;">Total Pasien Hari Ini</h3>
            <div style="font-size: 2.5rem; font-weight: bold; margin-top: 10px; color: #0f172a;"><?= $total_patients ?></div>
        </div>
        <div class="card" style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05); border-left: 4px solid #16a34a;">
            <h3 style="color: #64748b; font-size: 1rem; margin: 0;">Menunggu Antrean</h3>
            <div style="font-size: 2.5rem; font-weight: bold; margin-top: 10px; color: #0f172a;"><?= $waiting_patients ?></div>
        </div>
    </div>
    
    <!-- TABEL ANTREAN -->
    <div class="card" style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
        <h3 style="margin-bottom: 20px; margin-top: 0; color: #1e293b;">Daftar Antrean</h3>
        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb; text-align: left; background: #f8fafc;">
                        <th style="padding: 12px 15px; color: #475569;">No. Antrean</th>
                        <th style="padding: 12px 15px; color: #475569;">Nama Pasien</th>
                        <th style="padding: 12px 15px; color: #475569;">Keluhan</th>
                        <th style="padding: 12px 15px; color: #475569;">Status</th>
                        <th style="padding: 12px 15px; color: #475569;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($queues) > 0): ?>
                        <?php foreach($queues as $q): ?>
                        <tr style="border-bottom: 1px solid #e5e7eb; transition: background 0.2s;">
                            <td style="padding: 15px; font-weight:bold; font-size:1.1rem; color: rgb(25, 135, 84);">
                                <?= htmlspecialchars($q['queue_number']) ?>
                            </td>
                            <td style="padding: 15px; font-weight: 500; color: #0f172a;">
                                <?= htmlspecialchars($q['patient_name']) ?>
                            </td>
                            <td style="padding: 15px; color: #64748b; font-size: 0.9rem;">
                                <?= htmlspecialchars($q['complaint'] ?? '-') ?>
                            </td>
                            <td style="padding: 15px;">
                                <span style="font-weight: 600; font-size: 0.75rem; padding: 5px 12px; border-radius: 20px;
                                    <?= $q['status'] == 'PENDING' ? 'background:#fef3c7; color:#d97706;' : '' ?>
                                    <?= $q['status'] == 'CHECKED-IN' ? 'background:#ede9fe; color:#7c3aed;' : '' ?>
                                    <?= $q['status'] == 'COMPLETED' ? 'background:#dcfce7; color:#16a34a;' : '' ?>
                                    <?= $q['status'] == 'CANCELLED' ? 'background:#fee2e2; color:#dc2626;' : '' ?>
                                "><?= htmlspecialchars($q['status']) ?></span>
                            </td>
                            <td style="padding: 15px;">
                                <?php if($q['status'] == 'CHECKED-IN' || $q['status'] == 'PENDING'): ?>
                                    <a href="index.php?page=doctor_encounter&id=<?= $q['appointment_id'] ?>" style="background: #3b82f6; color: white; text-decoration: none; padding: 8px 15px; border-radius: 6px; font-size: 13px; font-weight: 600; display: inline-block;">
                                        Periksa Pasien
                                    </a>
                                <?php else: ?>
                                    <span style="padding: 8px 15px; background: #f1f5f9; color: #94a3b8; border-radius: 6px; font-size: 13px; font-weight: 600; display: inline-block;">
                                        Selesai
                                    </span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" style="padding: 40px; text-align: center; color: #64748b;">Tidak ada jadwal pasien untuk hari ini.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>