<?php
require_once 'includes/auth_helper.php';
require_officer();

// Handle Status Update
if(isset($_POST['update_status'])) {
    $queue_id = $_POST['queue_id'];
    $new_status = $_POST['new_status'];
    
    $stmt = $pdo->prepare("UPDATE queues SET status = ? WHERE id = ?");
    $stmt->execute([$new_status, $queue_id]);
    
    // If status is 'CALLED', update appointment status to CHECKED-IN
    if($new_status == 'CALLED' || $new_status == 'IN_PROGRESS') {
        $stmt = $pdo->prepare("UPDATE appointments SET status = 'CHECKED-IN' WHERE id = (SELECT appointment_id FROM queues WHERE id = ?)");
        $stmt->execute([$queue_id]);
    }
    header("Location: index.php?page=queue_management");
    exit;
}

// Fetch all queues for today
$stmt = $pdo->query("SELECT q.id as queue_id, q.queue_number, q.status as queue_status, p.full_name as patient_name, d.full_name as doctor_name, po.name as poly_name, a.appointment_time
                     FROM queues q
                     JOIN appointments a ON q.appointment_id = a.id
                     JOIN patients p ON a.patient_id = p.id
                     JOIN doctors d ON a.doctor_id = d.id
                     JOIN poly po ON d.poly_id = po.id
                     WHERE a.appointment_date = CURDATE()
                     ORDER BY po.id, q.queue_number ASC");
$queues = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Group by Poly
$queues_by_poly = [];
foreach($queues as $q) {
    $queues_by_poly[$q['poly_name']][] = $q;
}
?>

<div class="container page-wrapper">
    <div class="page-header" style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2>Manajemen Antrean</h2>
            <p>Atur dan panggil antrean pasien hari ini.</p>
        </div>
        <a href="index.php?page=officer_dashboard" class="btn btn-light">&larr; Kembali ke Dashboard</a>
    </div>

    <?php if(empty($queues_by_poly)): ?>
        <div class="card" style="text-align: center; padding: 40px; color: var(--text-muted);">
            <h3>Belum ada antrean untuk hari ini.</h3>
            <p>Pasien yang mendaftar (booking) akan muncul di sini.</p>
        </div>
    <?php else: ?>
        <?php foreach($queues_by_poly as $poly_name => $poly_queues): ?>
        <div class="card" style="margin-bottom: 20px;">
            <h3 style="margin-bottom: 15px; border-bottom: 1px solid #e5e7eb; padding-bottom: 10px;">
                <i class="fa-solid fa-stethoscope"></i> <?= htmlspecialchars($poly_name) ?>
            </h3>
            <div class="table-responsive">
                <table class="table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="border-bottom: 2px solid #e5e7eb; text-align: left;">
                            <th style="padding: 12px; width: 10%;">No.</th>
                            <th style="padding: 12px; width: 25%;">Pasien</th>
                            <th style="padding: 12px; width: 25%;">Dokter</th>
                            <th style="padding: 12px; width: 15%;">Status</th>
                            <th style="padding: 12px; width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($poly_queues as $q): ?>
                        <tr style="border-bottom: 1px solid #e5e7eb; background: <?= $q['queue_status'] == 'CALLED' ? '#f0fdf4' : 'transparent' ?>;">
                            <td style="padding: 12px; font-size:1.2rem; font-weight:bold;"><?= htmlspecialchars($q['queue_number']) ?></td>
                            <td style="padding: 12px;"><?= htmlspecialchars($q['patient_name']) ?></td>
                            <td style="padding: 12px;"><?= htmlspecialchars($q['doctor_name']) ?></td>
                            <td style="padding: 12px;">
                                <?php
                                $status_color = '#6b7280';
                                if($q['queue_status'] == 'WAITING') $status_color = '#d97706';
                                if($q['queue_status'] == 'CALLED') $status_color = '#16a34a';
                                if($q['queue_status'] == 'IN_PROGRESS') $status_color = '#2563eb';
                                if($q['queue_status'] == 'COMPLETED') $status_color = '#059669';
                                if($q['queue_status'] == 'SKIPPED') $status_color = '#dc2626';
                                ?>
                                <span style="font-weight: 600; color: <?= $status_color ?>;"><?= $q['queue_status'] ?></span>
                            </td>
                            <td style="padding: 12px;">
                                <form method="POST" style="display: flex; gap: 5px;">
                                    <input type="hidden" name="queue_id" value="<?= $q['queue_id'] ?>">
                                    <?php if($q['queue_status'] == 'WAITING' || $q['queue_status'] == 'SKIPPED'): ?>
                                        <button type="submit" name="new_status" value="CALLED" class="btn btn-primary" style="padding: 5px 10px; font-size: 0.8rem;"><i class="fa-solid fa-bullhorn"></i> Panggil</button>
                                    <?php endif; ?>
                                    
                                    <?php if($q['queue_status'] == 'CALLED'): ?>
                                        <button type="submit" name="new_status" value="WAITING" class="btn btn-light" style="padding: 5px 10px; font-size: 0.8rem;"><i class="fa-solid fa-rotate-left"></i> Batal</button>
                                        <button type="submit" name="new_status" value="SKIPPED" class="btn btn-danger" style="padding: 5px 10px; font-size: 0.8rem;"><i class="fa-solid fa-forward-step"></i> Skip</button>
                                    <?php endif; ?>
                                    <input type="hidden" name="update_status" value="1">
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
