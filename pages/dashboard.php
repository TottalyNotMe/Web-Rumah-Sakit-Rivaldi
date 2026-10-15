<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Otorisasi: Pastikan user login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit();
}

// Pengalihan berdasarkan Role (Hak Akses)
// Jika role bukan patient, arahkan ke dashboard masing-masing
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: index.php?page=admin_dashboard");
        exit();
    } elseif ($_SESSION['role'] === 'doctor') {
        header("Location: index.php?page=doctor_dashboard");
        exit();
    } elseif ($_SESSION['role'] === 'officer') {
        header("Location: index.php?page=officer_dashboard");
        exit();
    }
}

$user_id = $_SESSION['user_id'];
$patient = [];
$upcoming_app = null;
$total_visits = 0;

try {
    // 1. Ambil Data Pasien
    $stmt_patient = $pdo->prepare("SELECT id, full_name, mrn FROM patients WHERE user_id = ?");
    $stmt_patient->execute([$user_id]);
    $patient = $stmt_patient->fetch(PDO::FETCH_ASSOC);

    if ($patient) {
        $patient_id = $patient['id'];

        // 2. Ambil Jadwal Kunjungan Terdekat (Masa depan & Hari ini)
        $query_upcoming = "
            SELECT a.booking_code, a.appointment_date, a.queue_number, a.status, 
                   d.full_name AS doctor_name, p.name AS poly_name
            FROM appointments a
            JOIN doctors d ON a.doctor_id = d.id
            LEFT JOIN poly p ON d.poly_id = p.id
            WHERE a.patient_id = ? 
              AND a.appointment_date >= CURDATE() 
              AND a.status IN ('PENDING', 'CONFIRMED', 'CHECKED-IN')
            ORDER BY a.appointment_date ASC 
            LIMIT 1
        ";
        $stmt_up = $pdo->prepare($query_upcoming);
        $stmt_up->execute([$patient_id]);
        $upcoming_app = $stmt_up->fetch(PDO::FETCH_ASSOC);

        // 3. Hitung Total Kunjungan Selesai
        $stmt_count = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE patient_id = ? AND status = 'COMPLETED'");
        $stmt_count->execute([$patient_id]);
        $total_visits = $stmt_count->fetchColumn();
    }
} catch (PDOException $e) {
    // Tangani error database jika perlu
}

// Pisahkan nama depan untuk sapaan
$first_name = 'Pasien';
if ($patient && !empty($patient['full_name'])) {
    $name_parts = explode(' ', trim($patient['full_name']));
    $first_name = $name_parts[0];
}
?>

<div class="dashboard-container" style="max-width: 1000px; margin: 30px auto; padding: 0 20px;">
    
    <!-- Bagian Sapaan -->
    <div style="background: linear-gradient(135deg, rgb(25, 135, 84) 0%, #10b981 100%); border-radius: 12px; padding: 30px; color: white; margin-bottom: 30px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
        <h1 style="margin: 0 0 10px; font-size: 28px;">Halo, <?= htmlspecialchars($first_name) ?>! 👋</h1>
        <p style="margin: 0; font-size: 16px; opacity: 0.9;">Selamat datang di Portal Pasien Rumah Sakit. Nomor Rekam Medis Anda: <strong><?= htmlspecialchars($patient['mrn'] ?? '-') ?></strong></p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
        
        <!-- Kolom Kiri: Info Janji Temu -->
        <div class="dashboard-card" style="background: white; padding: 25px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 2px 4px rgba(0,0,0,0.02);">
            <h2 style="font-size: 18px; color: #0f172a; margin: 0 0 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">Janji Temu Terdekat</h2>
            
            <?php if ($upcoming_app): ?>
                <div style="background: #f8fafc; padding: 15px; border-radius: 8px; border-left: 4px solid rgb(25, 135, 84);">
                    <p style="margin: 0 0 5px; color: #64748b; font-size: 13px;">Tanggal Kunjungan</p>
                    <p style="margin: 0 0 15px; color: #0f172a; font-weight: 600; font-size: 16px;">
                        <?= date('d F Y', strtotime($upcoming_app['appointment_date'])) ?>
                    </p>
                    
                    <p style="margin: 0 0 5px; color: #64748b; font-size: 13px;">Dokter & Poliklinik</p>
                    <p style="margin: 0 0 15px; color: #0f172a; font-weight: 600;">
                        <?= htmlspecialchars($upcoming_app['doctor_name']) ?> <br>
                        <span style="font-weight: normal; font-size: 14px; color: #475569;"><?= htmlspecialchars($upcoming_app['poly_name']) ?></span>
                    </p>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px; padding-top: 15px; border-top: 1px dashed #cbd5e1;">
                        <div>
                            <span style="display: block; font-size: 12px; color: #64748b;">No. Antrean</span>
                            <span style="font-size: 20px; font-weight: 800; color: rgb(25, 135, 84);"><?= htmlspecialchars($upcoming_app['queue_number']) ?></span>
                        </div>
                        <div style="text-align: right;">
                            <span style="display: block; font-size: 12px; color: #64748b;">Kode Booking</span>
                            <span style="font-family: monospace; font-weight: bold;"><?= htmlspecialchars($upcoming_app['booking_code']) ?></span>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div style="text-align: center; padding: 30px 10px; color: #64748b;">
                    <svg style="width: 48px; height: 48px; margin: 0 auto 10px; color: #cbd5e1;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <p style="margin: 0;">Tidak ada jadwal kunjungan mendatang.</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Kolom Kanan: Quick Actions & Statistik -->
        <div>
            <!-- Statistik Singkat -->
            <div style="display: flex; gap: 15px; margin-bottom: 24px;">
                <div style="flex: 1; background: white; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center;">
                    <p style="margin: 0 0 5px; font-size: 13px; color: #64748b;">Total Kunjungan</p>
                    <p style="margin: 0; font-size: 28px; font-weight: bold; color: #0f172a;"><?= $total_visits ?></p>
                </div>
                <div style="flex: 1; background: white; padding: 20px; border-radius: 12px; border: 1px solid #e2e8f0; text-align: center;">
                    <p style="margin: 0 0 5px; font-size: 13px; color: #64748b;">Status Member</p>
                    <p style="margin: 0; font-size: 16px; font-weight: bold; color: rgb(25, 135, 84); padding-top: 5px;">Aktif</p>
                </div>
            </div>

            <!-- Menu Aksi Cepat -->
            <div style="background: white; padding: 25px; border-radius: 12px; border: 1px solid #e2e8f0;">
                <h2 style="font-size: 18px; color: #0f172a; margin: 0 0 20px; border-bottom: 2px solid #f1f5f9; padding-bottom: 10px;">Layanan Pasien</h2>
                

                
                <a href="index.php?page=book_appointment" style="display: flex; align-items: center; padding: 12px 15px; margin-bottom: 10px; background: #f8fafc; border-radius: 8px; text-decoration: none; color: #334155; font-weight: 500; transition: background 0.2s;">
                    <span style="background: rgb(25, 135, 84); color: white; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; margin-right: 15px;">+</span>
                    Buat Janji Temu Baru
                </a>
                
                <a href="index.php?page=appointments" style="display: flex; align-items: center; padding: 12px 15px; margin-bottom: 10px; background: #f8fafc; border-radius: 8px; text-decoration: none; color: #334155; font-weight: 500; transition: background 0.2s;">
                    <span style="background: #3b82f6; color: white; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; margin-right: 15px;">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </span>
                    Riwayat Kunjungan
                </a>
            
                <a href="index.php?page=medical_records" style="display: flex; align-items: center; padding: 12px 15px; margin-bottom: 10px; background: #f8fafc; border-radius: 8px; text-decoration: none; color: #334155; font-weight: 500; transition: background 0.2s;">
                    <span style="background: #8b5cf6; color: white; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; margin-right: 15px;">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </span>
                    Rekam Medis & Hasil Lab
                </a>
                            <a href="index.php?page=profile" style="display: flex; align-items: center; padding: 12px 15px; background: #f8fafc; border-radius: 8px; text-decoration: none; color: #334155; font-weight: 500; transition: background 0.2s;">
                    <span style="background: #f59e0b; color: white; width: 32px; height: 32px; display: inline-flex; align-items: center; justify-content: center; border-radius: 6px; margin-right: 15px;">
                        <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </span>
                    Lengkapi Profil
                </a>
            </div>
        </div>
        
    </div>
</div>