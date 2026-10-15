<?php
// pages/forgot_password.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$msg = '';
$msg_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    if (!empty($email)) {
        // Simulasi pengiriman token reset
        $msg = "Tautan pemulihan kata sandi telah dikirimkan ke alamat email <strong>" . htmlspecialchars($email) . "</strong>. Silakan periksa folder Kotak Masuk atau Spam Anda.";
        $msg_type = 'success';
    } else {
        $msg = "Silakan masukkan alamat email yang terdaftar!";
        $msg_type = 'danger';
    }
}
?>
<div class="container page-wrapper" style="max-width: 500px; margin: 60px auto; padding: 0 20px;">
    
    <div style="background: white; border-radius: 16px; padding: 35px 30px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.08); border: 1px solid #e2e8f0; text-align: center;">
        
        <div style="width: 70px; height: 70px; background: #eff6ff; color: #0284c7; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; margin: 0 auto 20px;">
            <i class="fa-solid fa-key"></i>
        </div>

        <h2 style="font-size: 24px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Lupa Kata Sandi?</h2>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 25px; line-height: 1.6;">
            Masukkan alamat email yang terhubung dengan akun pasien atau staf Anda. Kami akan mengirimkan tautan reset kata sandi terverifikasi.
        </p>

        <?php if($msg): ?>
            <div style="background: <?= $msg_type === 'success' ? '#dcfce7' : '#fee2e2' ?>; color: <?= $msg_type === 'success' ? '#15803d' : '#b91c1c' ?>; padding: 14px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; text-align: left; border: 1px solid <?= $msg_type === 'success' ? '#86efac' : '#f87171' ?>;">
                <?= $msg ?>
            </div>
        <?php endif; ?>

        <form action="index.php?page=forgot_password" method="POST" style="text-align: left;">
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Alamat Email Terdaftar</label>
                <div style="position: relative;">
                    <input type="email" name="email" required placeholder="contoh: pasien@email.com" style="width: 100%; padding: 12px 14px 12px 42px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
                    <i class="fa-solid fa-envelope" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 15px; border-radius: 8px; font-weight: 700; margin-bottom: 20px;">
                <i class="fa-solid fa-paper-plane"></i> Kirim Tautan Pemulihan
            </button>
        </form>

        <div style="border-top: 1px solid #f1f5f9; padding-top: 20px; font-size: 14px; color: #64748b;">
            Ingat kata sandi Anda? <a href="index.php?page=login" style="color: #0d6efd; font-weight: 700; text-decoration: none;">Masuk ke Akun</a>
        </div>

    </div>

</div>
