<?php
// Pastikan session aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Otorisasi: Hanya user login yang bisa mengakses
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit();
}

$error = '';
$appointments = [];

try {
    $user_id = $_SESSION['user_id'];
    
    // 1. Dapatkan patient_id dari user yang sedang login
    $stmt_patient = $pdo->prepare("SELECT id FROM patients WHERE user_id = ?");
    $stmt_patient->execute([$user_id]);
    $patient = $stmt_patient->fetch(PDO::FETCH_ASSOC);

    if (!$patient) {
        $error = "Data profil pasien tidak ditemukan.";
    } else {
        // 2. Ambil riwayat janji temu pasien ini
        // Menggunakan JOIN ke tabel doctors dan poly sesuai struktur database
        $query = "
            SELECT 
                a.booking_code, 
                a.appointment_date, 
                a.queue_number, 
                a.status, 
                a.complaint,
                d.full_name AS doctor_name, 
                d.specialty,
                p.name AS poly_name
            FROM appointments a
            JOIN doctors d ON a.doctor_id = d.id
            LEFT JOIN poly p ON d.poly_id = p.id
            WHERE a.patient_id = ?
            ORDER BY a.appointment_date DESC, a.id DESC
        ";
        $stmt_app = $pdo->prepare($query);
        $stmt_app->execute([$patient['id']]);
        $appointments = $stmt_app->fetchAll(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    $error = "Terjadi kesalahan sistem: " . $e->getMessage();
}

// Fungsi untuk menentukan warna badge berdasarkan status
function getStatusBadge($status) {
    switch (strtoupper($status)) {
        case 'PENDING':
            return 'background-color: #fef3c7; color: #d97706;'; // Kuning
        case 'CONFIRMED':
            return 'background-color: #dbeafe; color: #2563eb;'; // Biru
        case 'CHECKED-IN':
            return 'background-color: #ede9fe; color: #7c3aed;'; // Ungu
        case 'COMPLETED':
            return 'background-color: #dcfce7; color: #16a34a;'; // Hijau
        case 'CANCELLED':
            return 'background-color: #fee2e2; color: #dc2626;'; // Merah
        default:
            return 'background-color: #f1f5f9; color: #475569;'; // Abu-abu
    }
}
?>

<div class="appointments-container" style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="color: #1e293b; font-size: 24px; margin-bottom: 5px;">Riwayat Janji Temu</h2>
            <p style="color: #64748b; font-size: 14px; margin: 0;">Daftar tiket antrean dan riwayat kunjungan Anda.</p>
        </div>
        <a href="index.php?page=book_appointment" style="background: rgb(25, 135, 84); color: #fff; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-flex; align-items: center; gap: 8px;">
            <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buat Janji Baru
        </a>
    </div>

    <!-- Tampilkan Pesan Sukses jika redirect dari pembuatan janji -->
    <?php if (isset($_SESSION['success_message'])): ?>
        <div style="background:#dcfce7; color:#15803d; padding:15px; border-radius:8px; margin-bottom:20px; border: 1px solid #86efac; display: flex; justify-content: space-between; align-items: center;">
            <div>
                <strong>Berhasil!</strong> <?= htmlspecialchars($_SESSION['success_message']) ?>
            </div>
            <button onclick="this.parentElement.style.display='none'" style="background:none; border:none; color:#15803d; font-size:20px; cursor:pointer;">&times;</button>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if ($error): ?>
        <div style="background:#fee2e2; color:#b91c1c; padding:15px; border-radius:8px; border: 1px solid #f87171; margin-bottom:20px;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if (empty($appointments) && !$error): ?>
        <div style="text-align: center; padding: 60px 20px; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); color: #64748b;">
            <svg style="width: 64px; height: 64px; margin: 0 auto 15px; color: #cbd5e1;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
            <p style="font-size: 16px;">Anda belum memiliki riwayat janji temu.</p>
        </div>
    <?php else: ?>
        <div style="display: grid; gap: 16px;">
            <?php foreach ($appointments as $app): ?>
                <?php 
                    // Format tanggal (misal: 15 Okt 2024)
                    $date_formatted = date('d M Y', strtotime($app['appointment_date']));
                ?>
                <div style="background: #ffffff; border-radius: 10px; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.04); border: 1px solid #f1f5f9; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 15px;">
                    
                    <!-- Info Kiri: Kode, Tanggal, Dokter -->
                    <div style="flex: 1 1 300px;">
                        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                            <span style="font-family: monospace; font-weight: 700; color: #0f172a; font-size: 16px;"><?= htmlspecialchars($app['booking_code']) ?></span>
                            <span style="padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; <?= getStatusBadge($app['status']) ?>">
                                <?= htmlspecialchars($app['status']) ?>
                            </span>
                        </div>
                        
                        <h3 style="margin: 0 0 4px; font-size: 16px; color: #1e293b;">
                            <?= htmlspecialchars($app['doctor_name']) ?> <span style="font-weight:normal; color:#64748b; font-size:14px;">(Sp. <?= htmlspecialchars($app['specialty']) ?>)</span>
                        </h3>
                        <p style="margin: 0; font-size: 14px; color: #64748b;">
                            <?= htmlspecialchars($app['poly_name']) ?> &bull; Tanggal: <strong><?= $date_formatted ?></strong>
                        </p>
                        
                        <?php if (!empty($app['complaint'])): ?>
                            <p style="margin: 10px 0 0; font-size: 13px; color: #475569; background: #f8fafc; padding: 8px; border-radius: 6px; border-left: 3px solid #cbd5e1;">
                                <strong>Keluhan:</strong> <?= htmlspecialchars($app['complaint']) ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Info Kanan: Nomor Antrean -->
                    <div style="text-align: center; background: #f8fafc; padding: 15px 25px; border-radius: 8px; min-width: 120px; border: 1px dashed #cbd5e1;">
                        <span style="display: block; font-size: 12px; color: #64748b; text-transform: uppercase; font-weight: 600; margin-bottom: 5px;">No. Antrean</span>
                        <span style="display: block; font-size: 28px; font-weight: 800; color: rgb(25, 135, 84);">
                            <?= htmlspecialchars($app['queue_number'] ?? '-') ?>
                        </span>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>