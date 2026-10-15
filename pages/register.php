<?php
// Pastikan session sudah dinyalakan jika belum ada di file utama
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nik = trim($_POST['nik']);
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if(empty($nik) || empty($nama) || empty($email) || empty($password)){
        $error = 'Semua kolom wajib diisi!';
    } else {
        try {
            // Check if email or NIK exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if($stmt->rowCount() > 0) {
                $error = 'Email sudah terdaftar!';
            } else {
                $stmt = $pdo->prepare("SELECT id FROM patients WHERE nik = ?");
                $stmt->execute([$nik]);
                if($stmt->rowCount() > 0) {
                    $error = 'NIK sudah terdaftar!';
                } else {
                    $pdo->beginTransaction();
                    
                    // Insert to users
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, 'patient')");
                    $stmt->execute([$email, $hashed_password]);
                    $user_id = $pdo->lastInsertId();

                    // Generate MRN
                    $mrn = 'MR-' . date('Y') . '-' . str_pad($user_id, 4, '0', STR_PAD_LEFT);

                    // Insert to patients
                    $stmt = $pdo->prepare("INSERT INTO patients (user_id, mrn, nik, full_name) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$user_id, $mrn, $nik, $nama]);

                    $pdo->commit();

                    // --- PERUBAHAN DI SINI ---
                    // Simpan pesan sukses di session dan redirect ke login
                    $_SESSION['success_message'] = 'Pendaftaran berhasil! Silakan login.';
                    header("Location: index.php?page=login");
                    exit();
                }
            }
        } catch(PDOException $e) {
            if($pdo->inTransaction()) $pdo->rollBack();
            $error = 'Terjadi kesalahan sistem: ' . $e->getMessage();
        }
    }
}
?>

<div class="register-container">
    <div class="register-header">
        <h2>Daftar Pasien Baru</h2>
        <p>Buat akun untuk kemudahan akses layanan RS</p>
    </div>

    <?php if($error): ?>
        <div style="background:#fee2e2; color:#b91c1c; padding:10px; border-radius:4px; margin-bottom:15px; border: 1px solid #f87171;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="index.php?page=register" method="POST" class="register-form">
        <div class="form-group">
            <label for="nik">NIK (Nomor Induk Kependudukan)</label>
            <input type="text" id="nik" name="nik" required class="form-control">
        </div>
        <div class="form-group">
            <label for="nama">Nama Lengkap (Sesuai KTP)</label>
            <input type="text" id="nama" name="nama" required class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
    </form>
    
    <div class="register-footer">
        Sudah punya akun? <a href="index.php?page=login">Masuk di sini</a>
    </div>
</div>