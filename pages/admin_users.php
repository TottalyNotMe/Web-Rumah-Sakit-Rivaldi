<?php
// pages/admin_users.php
require_once 'includes/auth_helper.php';
require_admin();

$msg = '';
$msg_type = '';

// Handle tambah user baru
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_user') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'patient';
    $name = trim($_POST['full_name'] ?? '');

    if (!empty($email) && !empty($password) && !empty($name)) {
        try {
            $hashed = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $pdo->prepare("INSERT INTO users (email, password, role) VALUES (?, ?, ?)");
            $stmt->execute([$email, $hashed, $role]);
            $new_user_id = $pdo->lastInsertId();

            if ($role === 'patient') {
                $mrn = 'MR-' . date('Y') . '-' . str_pad($new_user_id, 4, '0', STR_PAD_LEFT);
                $stmt_p = $pdo->prepare("INSERT INTO patients (user_id, mrn, nik, full_name) VALUES (?, ?, ?, ?)");
                $stmt_p->execute([$new_user_id, $mrn, '32' . rand(10000000, 99999999), $name]);
            } elseif ($role === 'doctor') {
                $stmt_d = $pdo->prepare("INSERT INTO doctors (user_id, full_name, specialty, fee, status) VALUES (?, ?, 'Umum', 150000, 'ACTIVE')");
                $stmt_d->execute([$new_user_id, $name]);
            }

            $msg = "Pengguna baru berhasil ditambahkan!";
            $msg_type = 'success';
        } catch (PDOException $e) {
            $msg = "Gagal menambah user: " . $e->getMessage();
            $msg_type = 'danger';
        }
    }
}

// Handle hapus user
if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    if ($del_id != $_SESSION['user_id']) {
        try {
            $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
            $stmt->execute([$del_id]);
            $msg = "Pengguna berhasil dihapus.";
            $msg_type = 'success';
        } catch(PDOException $e) {
            $msg = "Gagal menghapus user: " . $e->getMessage();
            $msg_type = 'danger';
        }
    } else {
        $msg = "Anda tidak dapat menghapus akun Anda sendiri!";
        $msg_type = 'danger';
    }
}

// Fetch users
$search = trim($_GET['q'] ?? '');
$where = '';
$params = [];
if ($search) {
    $where = "WHERE email LIKE ? OR role LIKE ?";
    $params = ["%$search%", "%$search%"];
}

$stmt = $pdo->prepare("SELECT id, email, role, created_at FROM users $where ORDER BY id DESC LIMIT 50");
$stmt->execute($params);
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container page-wrapper" style="max-width: 1100px; margin: 30px auto; padding: 0 20px;">
    
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center; background: white; padding: 25px 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 25px; flex-wrap: wrap; gap: 15px;">
        <div>
            <h2 style="margin: 0 0 5px; color: #0f172a; font-size: 24px;">Manajemen Hak Akses & Pengguna</h2>
            <p style="margin: 0; color: #64748b; font-size: 14px;">Kelola akun Administrator, Dokter Spesialis, Petugas Antrean, dan Pasien.</p>
        </div>
        <button onclick="document.getElementById('modalAddUser').style.display = 'block'" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 8px; padding: 10px 20px; font-size: 14px; border-radius: 8px;">
            <i class="fa-solid fa-user-plus"></i> Tambah Pengguna Baru
        </button>
    </div>

    <?php if($msg): ?>
        <div style="background: <?= $msg_type === 'success' ? '#dcfce7' : '#fee2e2' ?>; color: <?= $msg_type === 'success' ? '#15803d' : '#b91c1c' ?>; padding: 12px 18px; border-radius: 8px; margin-bottom: 20px; border: 1px solid <?= $msg_type === 'success' ? '#86efac' : '#f87171' ?>; font-size: 14px;">
            <?= htmlspecialchars($msg) ?>
        </div>
    <?php endif; ?>

    <!-- Modal Form Tambah User -->
    <div id="modalAddUser" style="display: none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); z-index: 9999; padding: 40px 20px; overflow-y: auto;">
        <div style="background: white; max-width: 480px; margin: 40px auto; border-radius: 14px; padding: 30px; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.2);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h3 style="margin: 0; font-size: 18px; color: #0f172a;">Tambah Pengguna Baru</h3>
                <button onclick="document.getElementById('modalAddUser').style.display = 'none'" style="background: none; border: none; font-size: 20px; cursor: pointer; color: #64748b;">&times;</button>
            </div>
            <form action="index.php?page=admin_users" method="POST">
                <input type="hidden" name="action" value="add_user">
                
                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Nama Lengkap</label>
                    <input type="text" name="full_name" required placeholder="Contoh: dr. Handoko atau Rina" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Alamat Email</label>
                    <input type="email" name="email" required placeholder="email@ihis.com" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                </div>

                <div style="margin-bottom: 15px;">
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Password</label>
                    <input type="password" name="password" required placeholder="Min. 6 Karakter" style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px;">
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; font-size: 13px; font-weight: 700; color: #334155; margin-bottom: 6px;">Role / Hak Akses</label>
                    <select name="role" required style="width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 14px; background: white;">
                        <option value="patient">Pasien</option>
                        <option value="doctor">Dokter</option>
                        <option value="officer">Petugas Antrean (Officer)</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" onclick="document.getElementById('modalAddUser').style.display = 'none'" class="btn btn-light" style="padding: 9px 16px;">Batal</button>
                    <button type="submit" class="btn btn-primary" style="padding: 9px 20px;">Simpan Akun</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Users -->
    <div style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid #e2e8f0;">
        <div style="margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
            <form method="GET" action="index.php" style="display: flex; gap: 8px;">
                <input type="hidden" name="page" value="admin_users">
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cari email / role..." style="padding: 8px 14px; border: 1px solid #cbd5e1; border-radius: 6px; font-size: 13px; min-width: 250px;">
                <button type="submit" class="btn btn-primary" style="padding: 8px 16px; font-size: 13px;">Cari</button>
            </form>
            <div style="font-size: 13px; color: #64748b;">Total: <strong><?= count($users) ?></strong> Akun Terdaftar</div>
        </div>

        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0; text-align: left; color: #64748b; font-size: 12px; text-transform: uppercase;">
                        <th style="padding: 12px 14px;">ID</th>
                        <th style="padding: 12px 14px;">Email Pengguna</th>
                        <th style="padding: 12px 14px;">Role Hak Akses</th>
                        <th style="padding: 12px 14px;">Terdaftar Sejak</th>
                        <th style="padding: 12px 14px; text-align: center;">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($users)): ?>
                        <tr><td colspan="5" style="text-align: center; padding: 30px; color: #94a3b8;">Tidak ada data pengguna ditemukan.</td></tr>
                    <?php else: ?>
                        <?php foreach($users as $u): ?>
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="padding: 14px; font-weight: 700; color: #0f172a;">#<?= $u['id'] ?></td>
                                <td style="padding: 14px; color: #334155; font-weight: 500;">
                                    <?= htmlspecialchars($u['email']) ?>
                                    <?php if($u['id'] == $_SESSION['user_id']): ?>
                                        <span style="background: #e0e7ff; color: #4338ca; padding: 2px 8px; border-radius: 10px; font-size: 11px; margin-left: 6px;">Akun Anda</span>
                                    <?php endif; ?>
                                </td>
                                <td style="padding: 14px;">
                                    <?php
                                    $roleBadge = [
                                        'admin' => ['bg' => '#fef3c7', 'color' => '#92400e', 'icon' => 'crown'],
                                        'doctor' => ['bg' => '#e0f2fe', 'color' => '#0369a1', 'icon' => 'user-doctor'],
                                        'officer' => ['bg' => '#fef2f2', 'color' => '#b91c1c', 'icon' => 'clipboard-user'],
                                        'patient' => ['bg' => '#dcfce7', 'color' => '#15803d', 'icon' => 'hospital-user'],
                                    ];
                                    $b = $roleBadge[$u['role']] ?? ['bg' => '#f1f5f9', 'color' => '#475569', 'icon' => 'user'];
                                    ?>
                                    <span style="background: <?= $b['bg'] ?>; color: <?= $b['color'] ?>; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 5px;">
                                        <i class="fa-solid fa-<?= $b['icon'] ?>"></i> <?= ucfirst($u['role']) ?>
                                    </span>
                                </td>
                                <td style="padding: 14px; color: #64748b; font-size: 13px;">
                                    <?= date('d M Y, H:i', strtotime($u['created_at'])) ?>
                                </td>
                                <td style="padding: 14px; text-align: center;">
                                    <?php if($u['id'] != $_SESSION['user_id']): ?>
                                        <a href="index.php?page=admin_users&delete=<?= $u['id'] ?>" onclick="return confirm('Hapus pengguna <?= htmlspecialchars($u['email']) ?>?')" class="btn btn-danger" style="padding: 5px 12px; font-size: 12px; border-radius: 6px;">
                                            <i class="fa-solid fa-trash"></i> Hapus
                                        </a>
                                    <?php else: ?>
                                        <span style="color: #94a3b8; font-size: 12px;">Aktif</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
