<?php
require_once 'includes/auth_helper.php';
require_doctor();

if (!isset($_GET['app_id'])) {
    die("Appointment ID missing");
}
$app_id = $_GET['app_id'];
$q_id = $_GET['q_id'] ?? null;

// Get appointment & patient details
$stmt = $pdo->prepare("SELECT a.*, p.full_name as patient_name, p.mrn, p.birth_date, p.gender, p.id as patient_id, d.fee
                       FROM appointments a
                       JOIN patients p ON a.patient_id = p.id
                       JOIN doctors d ON a.doctor_id = d.id
                       WHERE a.id = ? AND a.doctor_id = (SELECT id FROM doctors WHERE user_id = ?)");
$stmt->execute([$app_id, $_SESSION['user_id']]);
$app = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$app) {
    die("Appointment tidak ditemukan atau bukan milik Anda.");
}

// Ensure doctor marks IN_PROGRESS if they just opened it
if ($q_id) {
    $stmt = $pdo->prepare("UPDATE queues SET status = 'IN_PROGRESS' WHERE id = ? AND status IN ('WAITING', 'CALLED')");
    $stmt->execute([$q_id]);
}

// Handle Form Submission
$success = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_emr'])) {
    $complaint = $_POST['complaint'];
    $bp = $_POST['bp'];
    $temp = $_POST['temp'];
    $hr = $_POST['hr'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];

    try {
        $pdo->beginTransaction();

        // 1. Save Medical Record
        $stmt = $pdo->prepare("INSERT INTO medical_records (patient_id, doctor_id, appointment_id, complaint, blood_pressure, temperature, heart_rate, diagnosis, treatment) 
                               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$app['patient_id'], $app['doctor_id'], $app_id, $complaint, $bp, $temp, $hr, $diagnosis, $treatment]);

        // 2. Update Queue & Appointment Status
        $stmt = $pdo->prepare("UPDATE appointments SET status = 'COMPLETED' WHERE id = ?");
        $stmt->execute([$app_id]);
        
        if ($q_id) {
            $stmt = $pdo->prepare("UPDATE queues SET status = 'COMPLETED' WHERE id = ?");
            $stmt->execute([$q_id]);
        }

        // 3. Generate Basic Invoice for Doctor Fee
        $inv_num = 'INV-' . date('ym') . '-' . str_pad($app_id, 4, '0', STR_PAD_LEFT);
        $fee = $app['fee'];
        
        // Check if invoice exists
        $stmt = $pdo->prepare("SELECT id FROM invoices WHERE appointment_id = ?");
        $stmt->execute([$app_id]);
        if($stmt->rowCount() == 0) {
            $stmt = $pdo->prepare("INSERT INTO invoices (invoice_number, patient_id, appointment_id, subtotal, total_amount, status) VALUES (?, ?, ?, ?, ?, 'UNPAID')");
            $stmt->execute([$inv_num, $app['patient_id'], $app_id, $fee, $fee]);
            $inv_id = $pdo->lastInsertId();
            
            $stmt = $pdo->prepare("INSERT INTO invoice_items (invoice_id, item_name, quantity, price, total_price) VALUES (?, 'Konsultasi Dokter', 1, ?, ?)");
            $stmt->execute([$inv_id, $fee, $fee]);
        }

        $pdo->commit();
        $success = "Pemeriksaan berhasil disimpan dan antrean diselesaikan.";
    } catch(PDOException $e) {
        $pdo->rollBack();
        die("Error: " . $e->getMessage());
    }
}
?>

<div class="container page-wrapper">
    <div class="page-header" style="display:flex; justify-content:space-between; align-items:center;">
        <div>
            <h2>Modul Pemeriksaan (EMR)</h2>
            <p>Pasien: <strong><?= htmlspecialchars($app['patient_name']) ?></strong> (<?= htmlspecialchars($app['mrn']) ?>)</p>
        </div>
        <a href="index.php?page=doctor_dashboard" class="btn btn-light">&larr; Kembali</a>
    </div>

    <?php if($success): ?>
        <div style="background:#dcfce7; color:#15803d; padding:15px; border-radius:8px; margin-bottom:20px; border: 1px solid #86efac;">
            <strong>Sukses!</strong> <?= htmlspecialchars($success) ?>
            <div style="margin-top: 10px;">
                <a href="index.php?page=doctor_dashboard" class="btn btn-primary">Kembali ke Dashboard</a>
            </div>
        </div>
    <?php elseif ($app['status'] == 'COMPLETED'): ?>
        <div style="background:#fef9c3; color:#a16207; padding:15px; border-radius:8px; margin-bottom:20px; border: 1px solid #fde047;">
            Pemeriksaan ini sudah selesai. Anda tidak dapat mengubah data lagi.
        </div>
    <?php else: ?>
        <form method="POST" action="index.php?page=doctor_encounter&app_id=<?= $app_id ?><?= $q_id ? "&q_id=$q_id" : '' ?>">
            <div style="background:#fff; padding:30px; border-radius:8px; box-shadow:0 2px 4px rgba(0,0,0,0.1);">
                <h3 style="margin-bottom:20px; border-bottom:1px solid #eee; padding-bottom:10px;">Catatan Klinis (SOAP Note)</h3>
                
                <div style="display:grid; grid-template-columns: 1fr; gap:20px;">
                    <div>
                        <label style="font-weight:bold; display:block; margin-bottom:5px;">Subjective (Keluhan)</label>
                        <textarea name="complaint" required style="width:100%; height:80px; border:1px solid #ccc; border-radius:4px; padding:10px; font-family:inherit;"><?= htmlspecialchars($app['complaint']) ?></textarea>
                    </div>
                    
                    <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 15px;">
                        <div>
                            <label style="font-weight:bold; display:block; margin-bottom:5px;">Tekanan Darah</label>
                            <input type="text" name="bp" placeholder="Contoh: 120/80" class="form-control" style="width:100%;">
                        </div>
                        <div>
                            <label style="font-weight:bold; display:block; margin-bottom:5px;">Suhu (C)</label>
                            <input type="number" step="0.1" name="temp" placeholder="36.5" class="form-control" style="width:100%;">
                        </div>
                        <div>
                            <label style="font-weight:bold; display:block; margin-bottom:5px;">Detak Jantung (bpm)</label>
                            <input type="number" name="hr" placeholder="80" class="form-control" style="width:100%;">
                        </div>
                    </div>
                    
                    <div>
                        <label style="font-weight:bold; display:block; margin-bottom:5px;">Assessment (Diagnosis)</label>
                        <input type="text" name="diagnosis" required class="form-control" style="width:100%;" placeholder="Contoh: ISPA, Dengue, dll.">
                    </div>
                    
                    <div>
                        <label style="font-weight:bold; display:block; margin-bottom:5px;">Plan (Tindakan & Resep)</label>
                        <textarea name="treatment" required style="width:100%; height:80px; border:1px solid #ccc; border-radius:4px; padding:10px; font-family:inherit;" placeholder="Tindakan medis yang dilakukan dan rencana selanjutnya..."></textarea>
                    </div>
                </div>
                
                <div style="margin-top:20px; text-align:right;">
                    <button type="submit" name="save_emr" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin? Data yang sudah disimpan tidak bisa diubah dan tagihan akan dibuat.')">Simpan & Selesai</button>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>
