<?php
require_once 'includes/auth_helper.php';
require_patient();

$error = '';
$success = '';

// Get Poly list
$stmt = $pdo->query("SELECT id, name FROM poly ORDER BY name ASC");
$polys = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $doctor_id = $_POST['doctor_id'];
    $schedule_id = $_POST['schedule_id'];
    $app_date = $_POST['app_date'];
    $complaint = $_POST['complaint'];
    
    // Validate
    if(empty($doctor_id) || empty($schedule_id) || empty($app_date) || empty($complaint)){
        $error = 'Harap lengkapi semua isian.';
    } else {
        try {
            $pdo->beginTransaction();

            // Get patient id
            $stmt = $pdo->prepare("SELECT id FROM patients WHERE user_id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $patient = $stmt->fetch(PDO::FETCH_ASSOC);
            $patient_id = $patient['id'];

            // Get doctor fee
            $stmt = $pdo->prepare("SELECT fee FROM doctors WHERE id = ?");
            $stmt->execute([$doctor_id]);
            $fee = $stmt->fetchColumn();

            // Check if schedule is valid and has quota
            $stmt = $pdo->prepare("SELECT id, quota FROM doctor_schedules WHERE id = ?");
            $stmt->execute([$schedule_id]);
            $sched = $stmt->fetch(PDO::FETCH_ASSOC);
            
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE schedule_id = ? AND appointment_date = ? AND status != 'CANCELLED'");
            $stmt->execute([$schedule_id, $app_date]);
            $booked = $stmt->fetchColumn();
            
            if ($booked >= $sched['quota']) {
                throw new Exception("Kuota antrean untuk jadwal ini sudah penuh.");
            }

            // Booking code
            $booking_code = 'BKG-' . date('ymd') . '-' . rand(1000, 9999);
            
            // Queue number
            $stmt = $pdo->prepare("SELECT COUNT(*) FROM appointments WHERE doctor_id = ? AND appointment_date = ?");
            $stmt->execute([$doctor_id, $app_date]);
            $q_num = $stmt->fetchColumn() + 1;
            $queue_number = 'A' . str_pad($q_num, 3, '0', STR_PAD_LEFT);

            // Insert Appointment
            $stmt = $pdo->prepare("INSERT INTO appointments (booking_code, patient_id, doctor_id, schedule_id, appointment_date, queue_number, complaint, status) VALUES (?, ?, ?, ?, ?, ?, ?, 'PENDING')");
            $stmt->execute([$booking_code, $patient_id, $doctor_id, $schedule_id, $app_date, $queue_number, $complaint]);
            $app_id = $pdo->lastInsertId();

            // Insert Queue
            $stmt = $pdo->prepare("INSERT INTO queues (appointment_id, queue_number, status) VALUES (?, ?, 'WAITING')");
            $stmt->execute([$app_id, $queue_number]);

            $pdo->commit();
            $success = "Janji temu berhasil dibuat! Kode Booking Anda: <strong>$booking_code</strong>. Nomor Antrean: <strong>$queue_number</strong>. Silakan periksa menu Jadwal/Dashboard.";
            
            // Redirect after 3 seconds
            echo "<script>setTimeout(()=> { window.location.href = 'index.php?page=dashboard'; }, 4000);</script>";
            
        } catch(Exception $e) {
            if($pdo->inTransaction()) $pdo->rollBack();
            $error = $e->getMessage();
        }
    }
}
?>

<div class="booking-container container">
    <div class="booking-header">
        <h2>Buat Janji Temu Dokter</h2>
        <p>Pilih poli, dokter, dan waktu konsultasi yang sesuai dengan Anda.</p>
    </div>

    <?php if($error): ?>
        <div style="background:#fee2e2; color:#b91c1c; padding:15px; border-radius:8px; margin-bottom:15px; border: 1px solid #f87171;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if($success): ?>
        <div style="background:#dcfce7; color:#15803d; padding:15px; border-radius:8px; margin-bottom:15px; border: 1px solid #86efac;">
            <?= $success ?>
        </div>
    <?php else: ?>
        <form action="index.php?page=book_appointment" method="POST" class="booking-form" id="appointmentForm" style="background: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="poly_id" style="font-weight: 600; display: block; margin-bottom: 8px;">Pilih Poliklinik</label>
                <select id="poly_id" name="poly_id" required class="form-control" style="width: 100%; padding: 10px;" onchange="fetchDoctors()">
                    <option value="">-- Pilih Poli --</option>
                    <?php foreach($polys as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['name']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="doctor_id" style="font-weight: 600; display: block; margin-bottom: 8px;">Pilih Dokter Spesialis</label>
                <select id="doctor_id" name="doctor_id" required class="form-control" style="width: 100%; padding: 10px;" onchange="checkSchedule()" disabled>
                    <option value="">-- Pilih Dokter Terlebih Dahulu --</option>
                </select>
            </div>
            
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="app_date" style="font-weight: 600; display: block; margin-bottom: 8px;">Tanggal Kunjungan</label>
                <input type="date" id="app_date" name="app_date" required class="form-control" style="width: 100%; padding: 10px;" min="<?= date('Y-m-d') ?>" onchange="checkSchedule()" disabled>
            </div>
            
            <div id="schedule_info" style="margin-bottom: 20px; display: none; padding: 15px; border-radius: 8px; background: #f0fdf4; border: 1px solid #bbf7d0;">
                <input type="hidden" id="schedule_id" name="schedule_id" required>
                <p style="margin: 0; color: #166534;"><i class="fa-solid fa-clock"></i> <strong>Jadwal Tersedia:</strong> <span id="time_slot"></span></p>
                <p style="margin: 5px 0 0; color: #166534;"><i class="fa-solid fa-users"></i> <strong>Sisa Kuota:</strong> <span id="quota_slot"></span></p>
            </div>
            
            <div id="schedule_error" style="margin-bottom: 20px; display: none; padding: 15px; border-radius: 8px; background: #fee2e2; border: 1px solid #fecaca; color: #991b1b;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label for="complaint" style="font-weight: 600; display: block; margin-bottom: 8px;">Keluhan Utama</label>
                <textarea id="complaint" name="complaint" required class="form-control" style="width: 100%; padding: 10px; height: 100px; font-family: inherit;" placeholder="Jelaskan keluhan Anda..."></textarea>
            </div>
            
            <button type="submit" id="submitBtn" class="btn btn-primary btn-block" style="width: 100%; padding: 14px; font-size:1.1rem;" disabled>Konfirmasi Janji Temu</button>
        </form>
    <?php endif; ?>
</div>

<script>
function fetchDoctors() {
    const polyId = document.getElementById('poly_id').value;
    const docSelect = document.getElementById('doctor_id');
    const dateInput = document.getElementById('app_date');
    
    docSelect.innerHTML = '<option value="">Memuat dokter...</option>';
    docSelect.disabled = true;
    dateInput.disabled = true;
    resetScheduleInfo();
    
    if(!polyId) {
        docSelect.innerHTML = '<option value="">-- Pilih Dokter Terlebih Dahulu --</option>';
        return;
    }
    
    fetch(`api/get_doctors.php?poly_id=${polyId}`)
        .then(res => res.json())
        .then(data => {
            docSelect.innerHTML = '<option value="">-- Pilih Dokter --</option>';
            if(data.length === 0) {
                docSelect.innerHTML = '<option value="">Tidak ada dokter aktif di poli ini</option>';
            } else {
                data.forEach(d => {
                    docSelect.innerHTML += `<option value="${d.id}">${d.full_name} - ${d.specialty} (Rp ${parseInt(d.fee).toLocaleString('id-ID')})</option>`;
                });
                docSelect.disabled = false;
            }
        });
}

function checkSchedule() {
    const docId = document.getElementById('doctor_id').value;
    const dateVal = document.getElementById('app_date').value;
    const dateInput = document.getElementById('app_date');
    
    resetScheduleInfo();
    
    if(docId) {
        dateInput.disabled = false;
    }
    
    if(docId && dateVal) {
        fetch(`api/get_schedules.php?doctor_id=${docId}&date=${dateVal}`)
            .then(res => res.json())
            .then(data => {
                if(data.error) {
                    document.getElementById('schedule_error').style.display = 'block';
                    document.getElementById('schedule_error').innerText = data.error;
                } else {
                    document.getElementById('schedule_info').style.display = 'block';
                    document.getElementById('schedule_id').value = data.id;
                    document.getElementById('time_slot').innerText = `${data.start_time.substring(0,5)} - ${data.end_time.substring(0,5)}`;
                    document.getElementById('quota_slot').innerText = data.available;
                    
                    if(data.available > 0) {
                        document.getElementById('submitBtn').disabled = false;
                    } else {
                        document.getElementById('schedule_error').style.display = 'block';
                        document.getElementById('schedule_error').innerText = "Mohon maaf, kuota antrean untuk jadwal ini sudah penuh.";
                    }
                }
            });
    }
}

function resetScheduleInfo() {
    document.getElementById('schedule_info').style.display = 'none';
    document.getElementById('schedule_error').style.display = 'none';
    document.getElementById('schedule_id').value = '';
    document.getElementById('submitBtn').disabled = true;
}
</script>
