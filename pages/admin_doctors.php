<?php
require_once 'includes/auth_helper.php';
require_admin();

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = (SELECT user_id FROM doctors WHERE id = ?)");
    $stmt->execute([$id]);
    header("Location: index.php?page=admin_doctors");
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
    $where = "WHERE d.full_name LIKE ? OR d.specialty LIKE ?";
    $params = ["%$search%", "%$search%"];
}

// Count total
$stmt = $pdo->prepare("SELECT COUNT(*) FROM doctors d $where");
$stmt->execute($params);
$total_rows = $stmt->fetchColumn();
$total_pages = ceil($total_rows / $limit);

// Fetch data
$sql = "SELECT d.*, p.name as poly_name FROM doctors d LEFT JOIN poly p ON d.poly_id = p.id $where ORDER BY d.id DESC LIMIT $limit OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container page-wrapper">
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2>Manajemen Dokter</h2>
            <p>Kelola data dokter dan spesialisasi.</p>
        </div>
        <button class="btn btn-primary" onclick="alert('Fitur tambah dokter akan diarahkan ke form pendaftaran dokter.')"><i class="fa-solid fa-plus"></i> Tambah Dokter</button>
    </div>

    <div class="card">
        <form method="GET" action="index.php" style="margin-bottom: 20px; display: flex; gap: 10px;">
            <input type="hidden" name="page" value="admin_doctors">
            <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cari Nama Dokter / Spesialis..." class="form-control" style="max-width: 300px;">
            <button type="submit" class="btn btn-primary">Cari</button>
            <?php if($search): ?>
                <a href="index.php?page=admin_doctors" class="btn btn-light">Reset</a>
            <?php endif; ?>
        </form>

        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb; text-align: left;">
                        <th style="padding: 12px;">Nama Dokter</th>
                        <th style="padding: 12px;">Poli</th>
                        <th style="padding: 12px;">Spesialisasi</th>
                        <th style="padding: 12px;">Tarif (Fee)</th>
                        <th style="padding: 12px;">Status</th>
                        <th style="padding: 12px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($doctors) > 0): ?>
                        <?php foreach($doctors as $d): ?>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px; font-weight: 500;"><?= htmlspecialchars($d['full_name']) ?></td>
                            <td style="padding: 12px;"><?= htmlspecialchars($d['poly_name']) ?></td>
                            <td style="padding: 12px;"><?= htmlspecialchars($d['specialty']) ?></td>
                            <td style="padding: 12px;">Rp <?= number_format($d['fee'], 0, ',', '.') ?></td>
                            <td style="padding: 12px;">
                                <span style="background: <?= $d['status'] == 'ACTIVE' ? '#dcfce7' : '#fee2e2' ?>; color: <?= $d['status'] == 'ACTIVE' ? '#16a34a' : '#dc2626' ?>; padding: 2px 8px; border-radius: 10px; font-size: 0.75rem; font-weight: 600;">
                                    <?= $d['status'] ?>
                                </span>
                            </td>
                            <td style="padding: 12px;">
                                <a href="#" class="btn btn-light" style="padding: 4px 8px; font-size: 0.8rem;">Edit</a>
                                <a href="index.php?page=admin_doctors&delete=<?= $d['id'] ?>" onclick="return confirm('Hapus dokter ini?')" class="btn btn-danger" style="padding: 4px 8px; font-size: 0.8rem;">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="padding: 20px; text-align: center; color: var(--text-muted);">Belum ada data dokter.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if($total_pages > 1): ?>
        <div style="margin-top: 20px; display: flex; gap: 5px;">
            <?php for($i=1; $i<=$total_pages; $i++): ?>
                <a href="index.php?page=admin_doctors&p=<?= $i ?>&q=<?= urlencode($search) ?>" class="btn <?= $i == $page_num ? 'btn-primary' : 'btn-light' ?>" style="padding: 4px 10px;"><?= $i ?></a>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
</div>
