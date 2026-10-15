<?php
// Pastikan session aktif
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Otorisasi: Pastikan hanya user yang login yang bisa akses
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit();
}

$error = '';
$success = '';

// 1. Ambil data pasien terkait user yang sedang login
$user_id = $_SESSION['user_id'];
$stmt_patient = $pdo->prepare("SELECT * FROM patients WHERE user_id = ?");
$stmt_patient->execute([$user_id]);
$patient = $stmt_patient->fetch(PDO::FETCH_ASSOC);

if (!$patient) {
    $error = "Data profil pasien belum ditemukan. Silakan hubungi administrator.";
}

// 2. Ambil daftar dokter untuk dropdown
try {
    $stmt_doctors = $pdo->query("
        SELECT id AS doctor_id, full_name AS doctor_name, specialty 
        FROM doctors 
        WHERE status = 'ACTIVE'
        ORDER BY specialty ASC, full_name ASC
    ");
    $doctors = $stmt_doctors->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $doctors = [];
    $error = "Gagal mengambil data dokter: " . $e->getMessage();
}

// 3. Proses Form Submit
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $patient) {
    $doctor_id = $_POST['doctor_id'] ?? '';
    $appointment_date = $_POST['appointment_date'] ?? '';
    $complaint = trim($_POST['complaint'] ?? '');

    if (empty($doctor_id) || empty($appointment_date)) {
        $error = "Silakan pilih Dokter dan Tanggal Kunjungan!";
    } elseif ($appointment_date < date('Y-m-d')) {
        $error = "Tanggal kunjungan tidak boleh di masa lalu!";
    } else {
        try {
            $pdo->beginTransaction();

            // A. Tentukan Schedule ID secara otomatis (Opsional/Sederhana)
            // Mencari hari dari tanggal yang dipilih (Senin = Monday, dst)
            $day_of_week = date('l', strtotime($appointment_date)); 
            
            // Cek apakah dokter punya jadwal di hari tersebut
            $stmt_schedule = $pdo->prepare("SELECT id FROM doctor_schedules WHERE doctor_id = ? AND day_of_week = ? LIMIT 1");
            $stmt_schedule->execute([$doctor_id, $day_of_week]);
            $schedule_id = $stmt_schedule->fetchColumn();

            // B. Hitung urutan antrean harian
            $stmt_queue_count = $pdo->prepare("
                SELECT COUNT(*) FROM appointments 
                WHERE doctor_id = ? AND appointment_date = ?
            ");
            $stmt_queue_count->execute([$doctor_id, $appointment_date]);
            $queue_seq = $stmt_queue_count->fetchColumn() + 1;
            
            // Format queue number (misal: A-001)
            $queue_number = 'Q-' . str_pad($queue_seq, 3, '0', STR_PAD_LEFT);

            // C. Generate Booking Code unik
            $booking_code = 'BK' . date('Ymd', strtotime($appointment_date)) . rand(100, 999) . $patient['id'];

            // D. Insert ke tabel appointments
            // Sesuai skema: id, booking_code, patient_id, doctor_id, schedule_id, appointment_date, queue_number, status, complaint
            $stmt_insert = $pdo->prepare("
                INSERT INTO appointments 
                (booking_code, patient_id, doctor_id, schedule_id, appointment_date, queue_number, status, complaint) 
                VALUES (?, ?, ?, ?, ?, ?, 'PENDING', ?)
            ");
            
            // Note: schedule_id bisa NULL jika jadwal tidak ditemukan, sesuai skema FK (ON DELETE SET NULL)
            $stmt_insert->execute([
                $booking_code,
                $patient['id'],
                $doctor_id,
                $schedule_id ?: null,
                $appointment_date,
                $queue_number,
                $complaint
            ]);

            $pdo->commit();

            // Redirect dengan pesan sukses
            $_SESSION['success_message'] = "Janji temu berhasil! Kode: " . $booking_code;
            header("Location: index.php?page=appointments");
            exit();

        } catch (PDOException $e) {
            if ($pdo->inTransaction()) $pdo->rollBack();
            $error = "Gagal membuat janji temu: " . $e->getMessage();
        }
    }
}
?>

<div class="book-appointment-container" style="max-width: 650px; margin: 30px auto; padding: 25px; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
    <div class="form-header" style="margin-bottom: 20px; text-align: center;">
        <h2 style="color: #1e293b; font-size: 24px; margin-bottom: 5px;">Buat Janji Temu</h2>
        <p style="color: #64748b; font-size: 14px;">Pilih dokter dan jadwal kunjungan Anda</p>
    </div>

    <?php if ($error): ?>
        <div style="background:#fee2e2; color:#b91c1c; padding:12px; border-radius:6px; margin-bottom:20px; border: 1px solid #f87171; font-size:14px;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="index.php?page=book_appointment" method="POST" class="appointment-form">
        
        <?php if ($patient): ?>
        <div style="background: #f8fafc; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; color: #334155;">
            <strong>Pasien:</strong> <?= htmlspecialchars($patient['full_name']) ?> 
            <span style="color: #64748b;">(MRN: <?= htmlspecialchars($patient['mrn']) ?>)</span>
        </div>
        <?php endif; ?>

        <!-- Pilih Dokter -->
        <div class="form-group" style="margin-bottom: 18px;">
            <label for="doctor_id" style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155;">Dokter / Spesialisasi</label>
            <select name="doctor_id" id="doctor_id" required class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                <option value="">-- Pilih Dokter --</option>
                <?php foreach ($doctors as $doc): ?>
                    <option value="<?= $doc['doctor_id'] ?>">
                        <?= htmlspecialchars($doc['doctor_name']) ?> - Sp. <?= htmlspecialchars($doc['specialty']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Tanggal Kunjungan -->
        <div class="form-group" style="margin-bottom: 18px;">
            <label for="appointment_date" style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155;">Tanggal Kunjungan</label>
            <input type="date" name="appointment_date" id="appointment_date" min="<?= date('Y-m-d') ?>" required class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
        </div>

        <!-- Keluhan -->
        <div class="form-group" style="margin-bottom: 22px;">
            <label for="complaint" style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155;">Keluhan Utama (Opsional)</label>
            <textarea name="complaint" id="complaint" rows="3" placeholder="Jelaskan keluhan singkat Anda..." class="form-control" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; resize: vertical;"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; background-color: rgb(25, 135, 84); color: white; border: none; padding: 12px; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer;">
            Konfirmasi Janji Temu
        </button>
    </form>
</div>