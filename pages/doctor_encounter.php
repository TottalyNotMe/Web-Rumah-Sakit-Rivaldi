<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'doctor') {
    header("Location: index.php?page=dashboard");
    exit();
}

$error = '';
$success = '';
$appointment_id = $_GET['id'] ?? 0;

// Ambil data janji temu, pasien, dan status asuransinya
try {
    $stmt = $pdo->prepare("
        SELECT a.*, p.id AS patient_id, p.full_name, p.mrn, p.insurance_provider, d.id AS doctor_id 
        FROM appointments a
        JOIN patients p ON a.patient_id = p.id
        JOIN doctors d ON a.doctor_id = d.id
        WHERE a.id = ? AND d.user_id = ?
    ");
    $stmt->execute([$appointment_id, $_SESSION['user_id']]);
    $appointment = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$appointment) {
        die("Data pasien tidak ditemukan atau bukan pasien Anda.");
    }
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Proses Form Pemeriksaan & Formula Dosen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $diagnosis = trim($_POST['diagnosis']);
    $treatment = trim($_POST['treatment']);
    $notes = trim($_POST['notes']);
    $is_inpatient = isset($_POST['is_inpatient']) ? true : false;
    
    try {
        $pdo->beginTransaction();

        // 1. Simpan Rekam Medis
        $stmt_mr = $pdo->prepare("
            INSERT INTO medical_records (patient_id, doctor_id, appointment_id, diagnosis, treatment, notes) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        $stmt_mr->execute([
            $appointment['patient_id'], 
            $appointment['doctor_id'], 
            $appointment_id, 
            $diagnosis, 
            $treatment, 
            $notes
        ]);

        // 2. IMPLEMENTASI FORMULA DOSEN (Penempatan Kamar berdasarkan BPJS & Penyakit)
        if ($is_inpatient) {
            $target_room_type = 'Kelas 2'; // Default
            
            $insurance = strtoupper($appointment['insurance_provider']);
            $is_cancer = (stripos($diagnosis, 'kanker') !== false || stripos($diagnosis, 'cancer') !== false);

            // LOGIKA FORMULA:
            if ($insurance === 'BPJS') {
                // Aturan 1: Semua pasien BPJS otomatis masuk Kelas 3, terlepas dari penyakitnya
                $target_room_type = 'Kelas 3';
            } else {
                // Aturan 2: Pasien Umum/Mandiri, jika penyakit parah (Kanker), disarankan VIP atau Kelas 1
                if ($is_cancer) {
                    $target_room_type = 'VIP'; // Harganya nanti lebih mahal di tagihan
                } else {
                    $target_room_type = 'Kelas 1';
                }
            }

            // Cari kamar yang kosong sesuai target tipe
            $stmt_room = $pdo->prepare("SELECT id FROM rooms WHERE type = ? AND status = 'AVAILABLE' LIMIT 1");
            $stmt_room->execute([$target_room_type]);
            $room_id = $stmt_room->fetchColumn();

            if ($room_id) {
                // Masukkan ke Rawat Inap (inpatient_admissions)
                $stmt_inpatient = $pdo->prepare("
                    INSERT INTO inpatient_admissions (patient_id, room_id, doctor_id, diagnosis, admission_date) 
                    VALUES (?, ?, ?, ?, CURDATE())
                ");
                $stmt_inpatient->execute([$appointment['patient_id'], $room_id, $appointment['doctor_id'], $diagnosis]);

                // Update status kamar jadi terisi
                $pdo->prepare("UPDATE rooms SET status = 'OCCUPIED' WHERE id = ?")->execute([$room_id]);
                
                $success .= " Pasien didaftarkan ke Rawat Inap ($target_room_type) sesuai formula. ";
            } else {
                $error .= "Kamar tipe $target_room_type penuh, pasien tidak bisa didaftarkan rawat inap otomatis. ";
            }
        }

        // 3. Update status antrean selesai
        $pdo->prepare("UPDATE appointments SET status = 'COMPLETED' WHERE id = ?")->execute([$appointment_id]);

        $pdo->commit();
        if(empty($error)) $success = "Pemeriksaan selesai!" . $success;

    } catch (PDOException $e) {
        if($pdo->inTransaction()) $pdo->rollBack();
        $error = "Terjadi kesalahan: " . $e->getMessage();
    }
}
?>

<div style="max-width: 800px; margin: 30px auto; padding: 25px; background: #fff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);">
    <h2 style="color: #1e293b; margin-bottom: 20px;">Form Pemeriksaan Medis</h2>
    
    <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 4px solid #3b82f6;">
        <p style="margin: 0 0 5px;"><strong>Nama Pasien:</strong> <?= htmlspecialchars($appointment['full_name']) ?> (MRN: <?= htmlspecialchars($appointment['mrn']) ?>)</p>
        <p style="margin: 0 0 5px;"><strong>Keluhan Awal:</strong> <?= htmlspecialchars($appointment['complaint'] ?? 'Tidak ada') ?></p>
        <p style="margin: 0;"><strong>Penjamin/Asuransi:</strong> <span style="background: #dcfce7; color: #16a34a; padding: 2px 8px; border-radius: 4px; font-weight: bold;"><?= htmlspecialchars($appointment['insurance_provider'] ?? 'Umum') ?></span></p>
    </div>

    <?php if ($success): ?>
        <div style="background:#dcfce7; color:#15803d; padding:15px; border-radius:8px; margin-bottom:20px;"><?= $success ?></div>
        <a href="index.php?page=doctor_dashboard" style="display:inline-block; padding:10px 20px; background:#3b82f6; color:#fff; border-radius:6px; text-decoration:none;">Kembali ke Dasbor</a>
    <?php else: ?>
        <form method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Diagnosis Penyakit *</label>
                <input type="text" name="diagnosis" required placeholder="Contoh: Kanker Paru, Demam Berdarah, dll..." style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
                <small style="color: #64748b;">(Info Dosen: Ketik "Kanker" untuk memicu formula harga & kamar VIP bagi non-BPJS)</small>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Tindakan / Resep *</label>
                <textarea name="treatment" required rows="3" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;"></textarea>
            </div>
            
            <div style="margin-bottom: 15px;">
                <label style="display:block; font-weight:bold; margin-bottom:5px;">Catatan Tambahan</label>
                <textarea name="notes" rows="2" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;"></textarea>
            </div>

            <div style="margin-bottom: 25px; padding: 15px; background: #fffbeb; border: 1px solid #fde68a; border-radius: 8px;">
                <label style="display: flex; align-items: center; cursor: pointer; font-weight: bold; color: #b45309;">
                    <input type="checkbox" name="is_inpatient" value="1" style="width: 20px; height: 20px; margin-right: 10px;">
                    Rekomendasikan Rawat Inap (Otomatis Masuk Kamar Sesuai Formula)
                </label>
            </div>
            
            <button type="submit" style="background: rgb(25, 135, 84); color: white; border: none; padding: 12px 20px; border-radius: 6px; font-weight: bold; width: 100%; cursor: pointer;">Simpan Pemeriksaan</button>
        </form>
    <?php endif; ?>
</div>