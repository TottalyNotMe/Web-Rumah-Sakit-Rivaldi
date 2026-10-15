<?php
// pages/doctor_patients.php
require_once 'includes/auth_helper.php';
require_doctor();

// Ambil ID dokter yang login
$stmt_doc = $pdo->prepare("SELECT id, full_name, specialty FROM doctors WHERE user_id = ?");
$stmt_doc->execute([$_SESSION['user_id']]);
$doctor = $stmt_doc->fetch(PDO::FETCH_ASSOC);

if (!$doctor) {
    die("<div class='container' style='padding:40px; text-align:center;'>Data dokter Anda belum terdaftar.</div>");
}

$doctor_id = $doctor['id'];

// Search & Filter
$search = trim($_GET['q'] ?? '');
$params = [$doctor_id];
$where_search = "";
if ($search) {
    $where_search = "AND (p.full_name LIKE ? OR p.mrn LIKE ? OR p.nik LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

// Ambil daftar riwayat pasien yang pernah/akan diperiksa dokter ini
$query = "
    SELECT 
        p.id as patient_id,
        p.full_name,
        p.mrn,
        p.gender,
        p.birth_date,
        COUNT(a.id) as total_visits,
        MAX(a.appointment_date) as last_visit,
        MAX(a.id) as latest_appointment_id
    FROM appointments a
    JOIN patients p ON a.patient_id = p.id
    WHERE a.doctor_id = ? $where_search
    GROUP BY p.id, p.full_name, p.mrn, p.gender, p.birth_date
    ORDER BY last_visit DESC
";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$patient_list = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container page-wrapper" style="max-width: 1100px; margin: 30px auto; padding: 0 20px;">
    
    <div class="page-header" style="background: white; padding: 25px 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; border-left: 5px solid #0284c7;">
        <div>
            <h2 style="margin: 0 0 5px; color: #0f172a; font-size: 24px;">Daftar Pasien Binaan Dokter</h2>
            <p style="margin: 0; color: #64748b; font-size: 14px;">Dokter: <strong><?= htmlspecialchars($doctor['full_name']) ?></strong> (<?= htmlspecialchars($doctor['specialty']) ?>)</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="index.php?page=doctor_dashboard" class="btn btn-light" style="font-size: 13px;"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a>
        </div>
    </div>

    <!-- Filter & Search -->
    <div style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid #e2e8f0;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
            <form method="GET" action="index.php" style="display: flex; gap: 8px;">
                <input type="hidden" name="page" value="doctor_patients">
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cari nama pasien, MRN, NIK..." style="padding: 8px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; min-width: 280px;">
                <button type="submit" class="btn btn-primary" style="padding: 8px 16px; font-size: 13px;">Cari</button>
                <?php if($search): ?>
                    <a href="index.php?page=doctor_patients" class="btn btn-light" style="padding: 8px 14px; font-size: 13px;">Reset</a>
                <?php endif; ?>
            </form>
            <div style="font-size: 13px; color: #64748b;">Total Pasien Ditangani: <strong><?= count($patient_list) ?> Pasien</strong></div>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0; text-align: left; color: #64748b; font-size: 12px; text-transform: uppercase;">
                        <th style="padding: 12px 14px;">MRN</th>
                        <th style="padding: 12px 14px;">Nama Lengkap Pasien</th>
                        <th style="padding: 12px 14px;">Jenis Kelamin / Usia</th>
                        <th style="padding: 12px 14px; text-align: center;">Total Kunjungan</th>
                        <th style="padding: 12px 14px;">Kunjungan Terakhir</th>
                        <th style="padding: 12px 14px; text-align: center;">Aksi Medis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($patient_list)): ?>
                        <tr><td colspan="6" style="text-align: center; padding: 35px; color: #94a3b8;">Belum ada riwayat kunjungan pasien untuk pencarian ini.</td></tr>
                    <?php else: ?>
                        <?php foreach($patient_list as $pt): ?>
                            <?php
                            $age = '-';
                            if ($pt['birth_date']) {
                                $age = date_diff(date_create($pt['birth_date']), date_create('today'))->y . ' Thn';
                            }
                            ?>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 14px; font-weight: 700; color: #0284c7;"><code><?= htmlspecialchars($pt['mrn']) ?></code></td>
                                <td style="padding: 14px; font-weight: 600; color: #0f172a;"><?= htmlspecialchars($pt['full_name']) ?></td>
                                <td style="padding: 14px; color: #64748b;">
                                    <?= $pt['gender'] === 'M' ? '<i class="fa-solid fa-mars" style="color:#0284c7;"></i> Laki-laki' : '<i class="fa-solid fa-venus" style="color:#ec4899;"></i> Perempuan' ?> (<?= $age ?>)
                                </td>
                                <td style="padding: 14px; text-align: center;">
                                    <span style="background: #e0f2fe; color: #0369a1; padding: 3px 10px; border-radius: 20px; font-weight: 700; font-size: 12px;">
                                        <?= $pt['total_visits'] ?> Kali
                                    </span>
                                </td>
                                <td style="padding: 14px; color: #475569; font-size: 13px;">
                                    <?= date('d M Y', strtotime($pt['last_visit'])) ?>
                                </td>
                                <td style="padding: 14px; text-align: center;">
                                    <a href="index.php?page=doctor_encounter&appointment_id=<?= $pt['latest_appointment_id'] ?>" class="btn btn-primary" style="padding: 6px 14px; font-size: 12px; border-radius: 6px;">
                                        <i class="fa-solid fa-notes-medical"></i> Buka EMR / SOAP
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
