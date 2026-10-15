<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// 1. Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?page=login");
    exit();
}

// 2. Pastikan yang login benar-benar terdaftar sebagai pasien
$stmt_check = $pdo->prepare("SELECT id FROM patients WHERE user_id = ?");
$stmt_check->execute([$_SESSION['user_id']]);
if (!$stmt_check->fetch()) {
    die("Akses Ditolak: Hanya pasien yang dapat mengakses halaman profil ini.");
}

$success = '';
$error = '';
$user_id = $_SESSION['user_id'];

// 1. Proses Simpan Data Profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $birth_date = !empty($_POST['birth_date']) ? $_POST['birth_date'] : null;
    $gender = !empty($_POST['gender']) ? $_POST['gender'] : null;
    $address = !empty($_POST['address']) ? trim($_POST['address']) : null;
    $phone = !empty($_POST['phone']) ? trim($_POST['phone']) : null;
    $blood_group = !empty($_POST['blood_group']) ? $_POST['blood_group'] : null;
    $insurance_provider = !empty($_POST['insurance_provider']) ? $_POST['insurance_provider'] : 'Umum';

    try {
        $stmt_update = $pdo->prepare("
            UPDATE patients 
            SET birth_date = ?, gender = ?, address = ?, phone = ?, blood_group = ?, insurance_provider = ?
            WHERE user_id = ?
        ");
        $stmt_update->execute([$birth_date, $gender, $address, $phone, $blood_group, $insurance_provider, $user_id]);
        $success = "Data profil berhasil disimpan!";
    } catch (PDOException $e) {
        $error = "Gagal menyimpan data: " . $e->getMessage();
    }
}

// 2. Ambil Data Profil Saat Ini
$stmt = $pdo->prepare("SELECT * FROM patients WHERE user_id = ?");
$stmt->execute([$user_id]);
$patient = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<div class="profile-container" style="max-width: 700px; margin: 30px auto; padding: 25px; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
    <h2 style="color: #1e293b; margin-bottom: 20px;">Lengkapi Profil Anda</h2>
    
    <?php if ($success): ?>
        <div style="background:#dcfce7; color:#15803d; padding:12px; border-radius:6px; margin-bottom:20px; border: 1px solid #86efac;">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>
    
    <?php if ($error): ?>
        <div style="background:#fee2e2; color:#b91c1c; padding:12px; border-radius:6px; margin-bottom:20px; border: 1px solid #f87171;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <!-- Info Dasar (Read-Only dari Registrasi) -->
    <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 25px; border: 1px solid #e2e8f0;">
        <div style="display: flex; gap: 20px;">
            <div style="flex: 1;">
                <label style="display:block; font-size:12px; color:#64748b; margin-bottom:4px;">Nomor Rekam Medis</label>
                <div style="font-weight:600; color:#0f172a;"><?= htmlspecialchars($patient['mrn']) ?></div>
            </div>
            <div style="flex: 1;">
                <label style="display:block; font-size:12px; color:#64748b; margin-bottom:4px;">NIK</label>
                <div style="font-weight:600; color:#0f172a;"><?= htmlspecialchars($patient['nik']) ?></div>
            </div>
            <div style="flex: 1;">
                <label style="display:block; font-size:12px; color:#64748b; margin-bottom:4px;">Nama Lengkap</label>
                <div style="font-weight:600; color:#0f172a;"><?= htmlspecialchars($patient['full_name']) ?></div>
            </div>
        </div>
    </div>

    <!-- Form Lengkapi Data -->
    <form action="index.php?page=profile" method="POST">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
            
            <div>
                <label style="display:block; font-weight:600; margin-bottom:6px; color:#334155;">Tanggal Lahir</label>
                <input type="date" name="birth_date" value="<?= htmlspecialchars($patient['birth_date'] ?? '') ?>" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
            </div>
            
            <div>
                <label style="display:block; font-weight:600; margin-bottom:6px; color:#334155;">Jenis Kelamin</label>
                <select name="gender" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
                    <option value="">-- Pilih --</option>
                    <option value="M" <?= ($patient['gender'] ?? '') === 'M' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="F" <?= ($patient['gender'] ?? '') === 'F' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>

            <div>
                <label style="display:block; font-weight:600; margin-bottom:6px; color:#334155;">Golongan Darah</label>
                <select name="blood_group" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
                    <option value="">-- Pilih --</option>
                    <option value="A" <?= ($patient['blood_group'] ?? '') === 'A' ? 'selected' : '' ?>>A</option>
                    <option value="B" <?= ($patient['blood_group'] ?? '') === 'B' ? 'selected' : '' ?>>B</option>
                    <option value="AB" <?= ($patient['blood_group'] ?? '') === 'AB' ? 'selected' : '' ?>>AB</option>
                    <option value="O" <?= ($patient['blood_group'] ?? '') === 'O' ? 'selected' : '' ?>>O</option>
                </select>
            </div>

            <div>
                <label style="display:block; font-weight:600; margin-bottom:6px; color:#334155;">Nomor Telepon</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($patient['phone'] ?? '') ?>" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
            </div>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display:block; font-weight:600; margin-bottom:6px; color:#334155;">Alamat Lengkap</label>
            <textarea name="address" rows="3" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;"><?= htmlspecialchars($patient['address'] ?? '') ?></textarea>
        </div>

        <!-- Bagian Penting untuk Formula Dosen -->
        <div style="margin-bottom: 25px; background: #eff6ff; padding: 15px; border-radius: 8px; border-left: 4px solid #3b82f6;">
            <label style="display:block; font-weight:bold; margin-bottom:6px; color:#1e3a8a;">Jenis Penjamin / Asuransi (Penting)</label>
            <select name="insurance_provider" required style="width:100%; padding:10px; border:1px solid #bfdbfe; border-radius:6px;">
                <option value="Umum" <?= ($patient['insurance_provider'] ?? '') === 'Umum' ? 'selected' : '' ?>>Umum / Mandiri</option>
                <option value="BPJS" <?= ($patient['insurance_provider'] ?? '') === 'BPJS' ? 'selected' : '' ?>>BPJS Kesehatan</option>
                <option value="Asuransi Swasta" <?= ($patient['insurance_provider'] ?? '') === 'Asuransi Swasta' ? 'selected' : '' ?>>Asuransi Swasta</option>
            </select>
            <small style="color: #475569; display:block; margin-top:5px;">*Penentuan fasilitas kamar rawat inap dan tagihan akan disesuaikan berdasarkan pilihan asuransi ini.</small>
        </div>

        <button type="submit" style="background: rgb(25, 135, 84); color: white; border: none; padding: 12px 20px; border-radius: 6px; font-weight: 600; width: 100%; cursor: pointer;">
            Simpan Pembaruan Profil
        </button>
    </form>
</div>