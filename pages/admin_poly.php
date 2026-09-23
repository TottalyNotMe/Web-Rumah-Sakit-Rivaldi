<?php
require_once 'includes/auth_helper.php';
require_admin();

// Handle Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM poly WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: index.php?page=admin_poly");
    exit;
}

// Handle Add/Edit
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_poly'])) {
    $name = trim($_POST['name']);
    $desc = trim($_POST['description']);
    $id = isset($_POST['poly_id']) ? intval($_POST['poly_id']) : 0;
    
    if($id > 0) {
        $stmt = $pdo->prepare("UPDATE poly SET name=?, description=? WHERE id=?");
        $stmt->execute([$name, $desc, $id]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO poly (name, description) VALUES (?, ?)");
        $stmt->execute([$name, $desc]);
    }
    header("Location: index.php?page=admin_poly");
    exit;
}

// Fetch all
$stmt = $pdo->query("SELECT * FROM poly ORDER BY name ASC");
$polys = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container page-wrapper">
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2>Manajemen Poliklinik</h2>
            <p>Kelola daftar poli di rumah sakit.</p>
        </div>
        <button class="btn btn-primary" onclick="showForm()"><i class="fa-solid fa-plus"></i> Tambah Poli</button>
    </div>

    <!-- Form Container (Hidden by default) -->
    <div id="poly-form-container" class="card" style="display: none; margin-bottom: 20px; border-left: 4px solid var(--primary-color);">
        <h3 id="form-title" style="margin-bottom: 15px;">Tambah Poli Baru</h3>
        <form method="POST" action="index.php?page=admin_poly">
            <input type="hidden" id="poly_id" name="poly_id" value="0">
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Nama Poli</label>
                <input type="text" id="poly_name" name="name" required class="form-control" style="width: 100%; max-width: 400px; padding: 8px;">
            </div>
            <div class="form-group" style="margin-bottom: 15px;">
                <label>Deskripsi</label>
                <textarea id="poly_desc" name="description" class="form-control" style="width: 100%; max-width: 400px; padding: 8px; min-height: 80px;"></textarea>
            </div>
            <button type="submit" name="save_poly" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-light" onclick="hideForm()">Batal</button>
        </form>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #e5e7eb; text-align: left;">
                        <th style="padding: 12px; width: 5%;">ID</th>
                        <th style="padding: 12px; width: 25%;">Nama Poli</th>
                        <th style="padding: 12px; width: 50%;">Deskripsi</th>
                        <th style="padding: 12px; width: 20%;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($polys) > 0): ?>
                        <?php foreach($polys as $p): ?>
                        <tr style="border-bottom: 1px solid #e5e7eb;">
                            <td style="padding: 12px;"><?= $p['id'] ?></td>
                            <td style="padding: 12px; font-weight: 500;"><?= htmlspecialchars($p['name']) ?></td>
                            <td style="padding: 12px; color: var(--text-muted);"><?= htmlspecialchars($p['description']) ?></td>
                            <td style="padding: 12px;">
                                <button onclick="editForm(<?= $p['id'] ?>, '<?= addslashes($p['name']) ?>', '<?= addslashes($p['description']) ?>')" class="btn btn-light" style="padding: 4px 8px; font-size: 0.8rem;">Edit</button>
                                <a href="index.php?page=admin_poly&delete=<?= $p['id'] ?>" onclick="return confirm('Hapus poli ini? Dokter dan jadwal terkait mungkin akan terpengaruh.')" class="btn btn-danger" style="padding: 4px 8px; font-size: 0.8rem;">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" style="padding: 20px; text-align: center; color: var(--text-muted);">Belum ada data poli.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function showForm() {
    document.getElementById('poly-form-container').style.display = 'block';
    document.getElementById('form-title').innerText = 'Tambah Poli Baru';
    document.getElementById('poly_id').value = '0';
    document.getElementById('poly_name').value = '';
    document.getElementById('poly_desc').value = '';
}

function hideForm() {
    document.getElementById('poly-form-container').style.display = 'none';
}

function editForm(id, name, desc) {
    document.getElementById('poly-form-container').style.display = 'block';
    document.getElementById('form-title').innerText = 'Edit Poli';
    document.getElementById('poly_id').value = id;
    document.getElementById('poly_name').value = name;
    document.getElementById('poly_desc').value = desc;
    window.scrollTo(0, 0);
}
</script>
