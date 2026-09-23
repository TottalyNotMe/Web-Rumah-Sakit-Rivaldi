<?php
require_once 'includes/auth_helper.php';
require_admin();

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = (SELECT user_id FROM patients WHERE id = ?)");
    $stmt->execute([$id]);
    header("Location: index.php?page=admin_patients");
    exit;
}

// Pagination & Search
$search = isset($_GET['q']) ? $_GET['q'] : '';
$page_num = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$limit = 10;
$offset = ($page_num - 1) * $limit;

$where = "";
$params = [];
if ($search) {
    $where = "WHERE full_name LIKE ? OR mrn LIKE ? OR nik LIKE ?";
    $params = ["%$search%", "%$search%", "%$search%"];
}

// Count total
$stmt = $pdo->prepare("SELECT COUNT(*) FROM patients $where");
$stmt->execute($params);
$total_rows = $stmt->fetchColumn();
$total_pages = ceil($total_rows / $limit);

// Fetch data
$sql = "SELECT * FROM patients $where ORDER BY id DESC LIMIT $limit OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container page-wrapper">
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2>Manajemen Pasien</h2>
            <p>Kelola data pasien rumah sakit.</p>
        </div>
        <a href="index.php?page=register" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Pasien</a>
    </div>

    <div class="card">
        <form method="GET" action="index.php" style="margin-bottom: 20px; display: flex; gap: 10px;">
            <input type="hidden" name="page" value="admin_patients">
            <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cari Nama, MRN, atau NIK..." class="form-control" style="max-width: 300px;">
            <button type="submit" class="btn btn-primary">Cari</button>
            <?php if($search): ?>
                <a href="index.php?page=admin_patients" class="btn btn-light">Reset</a>
            <?php endif; ?>
        </form>

        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb; text-align: left;">
                        <th style="padding: 12px;">MRN</th>
                        <th style="padding: 12px;">Nama Lengkap</th>
                        <th style="padding: 12px;">NIK</th>
                        <th style="padding: 12px;">No. Telp</th>
                        <th style="padding: 12px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($patients) > 0): ?>
                        <?php foreach($patients as $p): ?>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px;"><?= htmlspecialchars($p['mrn']) ?></td>
                            <td style="padding: 12px; font-weight: 500;"><?= htmlspecialchars($p['full_name']) ?></td>
                            <td style="padding: 12px;"><?= htmlspecialchars($p['nik']) ?></td>
                            <td style="padding: 12px;"><?= htmlspecialchars($p['phone']) ?></td>
                            <td style="padding: 12px;">
                                <a href="#" class="btn btn-light" style="padding: 4px 8px; font-size: 0.8rem;">Edit</a>
                                <a href="index.php?page=admin_patients&delete=<?= $p['id'] ?>" onclick="return confirm('Hapus pasien ini? Semua data terkait (rekam medis, dll) akan terhapus.')" class="btn btn-danger" style="padding: 4px 8px; font-size: 0.8rem;">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="padding: 20px; text-align: center; color: var(--text-muted);">Belum ada data pasien.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if($total_pages > 1): ?>
        <div style="margin-top: 20px; display: flex; gap: 5px;">
            <?php for($i=1; $i<=$total_pages; $i++): ?>
                <a href="index.php?page=admin_patients&p=<?= $i ?>&q=<?= urlencode($search) ?>" class="btn <?= $i == $page_num ? 'btn-primary' : 'btn-light' ?>" style="padding: 4px 10px;"><?= $i ?></a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
