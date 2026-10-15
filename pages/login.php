<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Jika user sudah login, langsung arahkan ke dashboard masing-masing
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    $role = $_SESSION['role'];
    if ($role === 'admin') header("Location: index.php?page=admin_dashboard");
    elseif ($role === 'doctor') header("Location: index.php?page=doctor_dashboard");
    elseif ($role === 'officer') header("Location: index.php?page=queue_management");
    else header("Location: index.php?page=dashboard"); // Default ke pasien
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = 'Email dan Password wajib diisi!';
    } else {
        try {
            // Cek pengguna di database
            $stmt = $pdo->prepare("SELECT id, email, password, role FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // AUTO-SEED: Jika akun demo bawaan belum ada di database, buatkan otomatis ke database!
            if (!$user && in_array($email, ['admin@ihis.com', 'doctor@ihis.com', 'officer@ihis.com', 'patient@ihis.com']) && $password === 'password') {
                $role_map = [
                    'admin@ihis.com' => 'admin',
                    'doctor@ihis.com' => 'doctor',
                    'officer@ihis.com' => 'officer',
                    'patient@ihis.com' => 'patient'
                ];
                $auto_role = $role_map[$email];
                $hashed_pw = password_hash('password', PASSWORD_BCRYPT);
                
                $stmt_insert = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
                $stmt_insert->execute([$email, $hashed_pw, $auto_role]);
                $new_id = $pdo->lastInsertId();

                if ($auto_role === 'patient') {
                    $mrn = 'MR-' . date('Y') . '-' . str_pad($new_id, 4, '0', STR_PAD_LEFT);
                    $stmt_pt = $pdo->prepare("INSERT INTO patients (user_id, mrn, nik, full_name, birth_date, gender) VALUES (?, ?, ?, ?, '1995-05-12', 'M')");
                    $stmt_pt->execute([$new_id, $mrn, '3201234567890001', 'Muhammad Budi Santoso']);
                } elseif ($auto_role === 'doctor') {
                    $stmt_doc = $pdo->prepare("INSERT INTO doctors (user_id, full_name, specialty, fee, status) VALUES (?, 'dr. Budi Santoso, Sp.PD', 'Penyakit Dalam', 250000, 'ACTIVE')");
                    $stmt_doc->execute([$new_id]);
                }

                // Ambil ulang user yang baru saja otomatis dibuat
                $stmt->execute([$email]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            // Verifikasi password (Bcrypt atau Plaintext fallback untuk dev/demo data)
            $is_valid = false;
            if ($user) {
                if (password_verify($password, $user['password']) || $password === $user['password'] || ($password === 'password' && (empty($user['password']) || $user['password'] === 'admin123'))) {
                    $is_valid = true;
                }
            }

            if ($is_valid) {
                
                // Simpan ID dan Role ke Session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['user_role'] = $user['role'];

                // --- LOGIKA UNTUK MENAMPILKAN NAMA DI HEADER ---
                $user_name = 'Pengguna';
                if ($user['role'] === 'patient') {
                    $stmt_name = $pdo->prepare("SELECT full_name FROM patients WHERE user_id = ?");
                    $stmt_name->execute([$user['id']]);
                    $user_name = $stmt_name->fetchColumn() ?: 'Pasien';
                } elseif ($user['role'] === 'doctor') {
                    $stmt_name = $pdo->prepare("SELECT full_name FROM doctors WHERE user_id = ?");
                    $stmt_name->execute([$user['id']]);
                    $user_name = $stmt_name->fetchColumn() ?: 'Dokter';
                } elseif ($user['role'] === 'officer' || $user['role'] === 'admin') {
                    $user_name = ucfirst($user['role']);
                }
                
                // Simpan nama ke session agar terbaca di includes/header.php
                $_SESSION['user_name'] = $user_name; 
                // -----------------------------------------------

                // Redirect sesuai role
                if ($user['role'] === 'admin') {
                    header("Location: index.php?page=admin_dashboard");
                } elseif ($user['role'] === 'doctor') {
                    header("Location: index.php?page=doctor_dashboard");
                } elseif ($user['role'] === 'officer') {
                    header("Location: index.php?page=queue_management");
                } else {
                    header("Location: index.php?page=dashboard"); // Pasien
                }
                exit();
            } else {
                $error = 'Email atau password salah!';
            }
        } catch (PDOException $e) {
            $error = 'Terjadi kesalahan sistem: ' . $e->getMessage();
        }
    }
}
?>

<!-- Pop-up Notifikasi Sukses (Floating Toast) -->
<?php if (isset($_SESSION['success_message'])): ?>
    <div id="toast-success" class="toast-floating">
        <svg class="toast-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
        </svg>
        <span><?= htmlspecialchars($_SESSION['success_message']) ?></span>
    </div>

    <style>
        .toast-floating {
            position: fixed;
            bottom: 30px;
            left: 50%;
            transform: translate(-50%, 60px);
            z-index: 9999;
            background-color: rgb(25, 135, 84);
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 8px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.2), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            font-weight: 500;
            white-space: nowrap;
            opacity: 0;
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), opacity 0.4s ease;
        }
        .toast-floating.show {
            opacity: 1;
            transform: translate(-50%, 0);
        }
        .toast-icon {
            width: 20px;
            height: 20px;
            stroke: #ffffff;
            flex-shrink: 0;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toast = document.getElementById("toast-success");
            if (toast) {
                setTimeout(() => toast.classList.add("show"), 100);
                setTimeout(() => toast.classList.remove("show"), 4100);
            }
        });
    </script>
    <?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<!-- Container Form Login -->
<div class="login-container" style="max-width: 450px; margin: 60px auto; padding: 30px; background: #ffffff; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
    
    <div style="text-align: center; margin-bottom: 25px;">
        <h2 style="color: #1e293b; font-size: 26px; margin-bottom: 5px;">Masuk ke Akun</h2>
        <p style="color: #64748b; font-size: 14px;">Silakan login untuk mengakses layanan rumah sakit</p>
    </div>

    <?php if ($error): ?>
        <div style="background:#fee2e2; color:#b91c1c; padding:12px; border-radius:6px; margin-bottom:20px; border: 1px solid #f87171; text-align: center; font-size: 14px;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form action="index.php?page=login" method="POST">
        <div style="margin-bottom: 18px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 14px;">Email</label>
            <input type="email" name="email" required placeholder="Masukkan email Anda" style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; outline: none;">
        </div>
        
        <div style="margin-bottom: 25px;">
            <label style="display: block; margin-bottom: 6px; font-weight: 600; color: #334155; font-size: 14px;">Password</label>
            <input type="password" name="password" required placeholder="Masukkan password Anda" style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 15px; outline: none;">
        </div>

        <button type="submit" style="width: 100%; background: rgb(25, 135, 84); color: white; border: none; padding: 12px; border-radius: 6px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s;">
            Login
        </button>
    </form>

    <div style="margin-top: 25px; padding-top: 20px; border-top: 1px dashed #cbd5e1;">
        <p style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase; margin-bottom: 10px; letter-spacing: 0.5px;">Akun Demo Instan (Sekali Klik):</p>
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px;">
            <button type="button" onclick="fillLogin('admin@ihis.com', 'password')" style="background: #f1f5f9; border: 1px solid #cbd5e1; padding: 8px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; text-align: left;">
                <span style="display:block; color: #1e293b;">👑 Admin RS</span>
                <span style="color: #64748b; font-size: 11px;">admin@ihis.com</span>
            </button>
            <button type="button" onclick="fillLogin('doctor@ihis.com', 'password')" style="background: #f1f5f9; border: 1px solid #cbd5e1; padding: 8px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; text-align: left;">
                <span style="display:block; color: #0284c7;">🩺 Dokter Spesialis</span>
                <span style="color: #64748b; font-size: 11px;">doctor@ihis.com</span>
            </button>
            <button type="button" onclick="fillLogin('officer@ihis.com', 'password')" style="background: #f1f5f9; border: 1px solid #cbd5e1; padding: 8px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; text-align: left;">
                <span style="display:block; color: #d97706;">📋 Petugas Antrean</span>
                <span style="color: #64748b; font-size: 11px;">officer@ihis.com</span>
            </button>
            <button type="button" onclick="fillLogin('patient@ihis.com', 'password')" style="background: #f1f5f9; border: 1px solid #cbd5e1; padding: 8px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer; text-align: left;">
                <span style="display:block; color: #15803d;">👤 Pasien Utama</span>
                <span style="color: #64748b; font-size: 11px;">patient@ihis.com</span>
            </button>
        </div>
    </div>

    <script>
        function fillLogin(email, pass) {
            document.querySelector('input[name="email"]').value = email;
            document.querySelector('input[name="password"]').value = pass;
            // Langsung otomatis submit form dalam 1 kali klik!
            document.querySelector('form[action="index.php?page=login"]').submit();
        }
    </script>

    <div style="text-align: center; margin-top: 20px; font-size: 14px; color: #64748b;">
        Belum punya akun? <a href="index.php?page=register" style="color: rgb(25, 135, 84); text-decoration: none; font-weight: 600;">Daftar di sini</a>
    </div>
</div>