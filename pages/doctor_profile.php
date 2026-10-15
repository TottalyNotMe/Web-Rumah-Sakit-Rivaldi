<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Otorisasi: Pastikan hanya dokter yang bisa akses
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'doctor') {
    header("Location: index.php?page=dashboard");
    exit();
}

$success = '';
$error = '';
$user_id = $_SESSION['user_id'];

// 1. Ambil daftar poliklinik untuk opsi Dropdown
$polys = [];
try {
    $stmt_poly = $pdo->query("SELECT id, name FROM poly ORDER BY name ASC");
    $polys = $stmt_poly->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Gagal memuat data poliklinik.";
}

// 2. Proses Simpan Pembaruan Profil
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $specialty = trim($_POST['specialty']);
    $poly_id = $_POST['poly_id'];
    $fee = str_replace(['Rp', '.', ','], '', $_POST['fee']); // Bersihkan format uang

    try {
        $stmt_update = $pdo->prepare("
            UPDATE doctors 
            SET full_name = ?, specialty = ?, poly_id = ?, fee = ?
            WHERE user_id = ?
        ");
        $stmt_update->execute([$full_name, $specialty, $poly_id, $fee, $user_id]);
        
        $success = "Profil dokter berhasil diperbarui!";
        $_SESSION['user_name'] = $full_name; // Update nama di header secara realtime
    } catch (PDOException $e) {
        $error = "Gagal memperbarui profil: " . $e->getMessage();
    }
}

// 3. Ambil Data Dokter Saat Ini
try {
    $stmt = $pdo->prepare("
        SELECT d.*, u.email 
        FROM doctors d 
        JOIN users u ON d.user_id = u.id 
        WHERE d.user_id = ?
    ");
    $stmt->execute([$user_id]);
    $doctor = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$doctor) {
        $error = "Data profil tidak ditemukan di database.";
    }
} catch (PDOException $e) {
    $error = "Gagal memuat profil: " . $e->getMessage();
}
?>

<div class="doctor-profile-container" style="max-width: 700px; margin: 40px auto; padding: 30px; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2 style="color: #1e293b; margin: 0; font-size: 24px;">Profil Dokter</h2>
        <a href="index.php?page=doctor_dashboard" style="color: #3b82f6; text-decoration: none; font-weight: 600; font-size: 14px;">&larr; Kembali ke Dasbor</a>
    </div>

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

    <form action="index.php?page=doctor_profile" method="POST">
        <!-- Info Akun (Read Only) -->
        <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e2e8f0;">
            <label style="display:block; font-size:12px; color:#64748b; margin-bottom:4px;">Email Akun (Tidak dapat diubah)</label>
            <div style="font-weight:600; color:#0f172a;"><?= htmlspecialchars($doctor['email'] ?? '-') ?></div>
        </div>

        <div style="margin-bottom: 18px;">
            <label style="display:block; font-weight:600; margin-bottom:6px; color:#334155;">Nama Lengkap (Beserta Gelar)</label>
            <input type="text" name="full_name" value="<?= htmlspecialchars($doctor['full_name'] ?? '') ?>" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 18px;">
            <div>
                <label style="display:block; font-weight:600; margin-bottom:6px; color:#334155;">Poliklinik</label>
                <select name="poly_id" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px; background: white;">
                    <option value="">-- Pilih Poliklinik --</option>
                    <?php foreach ($polys as $poly): ?>
                        <option value="<?= $poly['id'] ?>" <?= ($doctor['poly_id'] ?? '') == $poly['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($poly['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div>
                <label style="display:block; font-weight:600; margin-bottom:6px; color:#334155;">Spesialisasi</label>
                <input type="text" name="specialty" value="<?= htmlspecialchars($doctor['specialty'] ?? '') ?>" required placeholder="Contoh: Jantung, Anak, Umum" style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
            </div>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display:block; font-weight:600; margin-bottom:6px; color:#334155;">Tarif Konsultasi Dasar (Rp)</label>
            <input type="number" name="fee" value="<?= htmlspecialchars((int)($doctor['fee'] ?? 0)) ?>" required style="width:100%; padding:10px; border:1px solid #cbd5e1; border-radius:6px;">
            <small style="color: #64748b; margin-top: 5px; display: block;">*Tarif ini akan ditambahkan ke tagihan (invoice) pasien mandiri.</small>
        </div>

        <button type="submit" style="background: #3b82f6; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: 600; font-size: 15px; width: 100%; cursor: pointer;">
            Simpan Pembaruan Profil
        </button>
    </form>
</div>