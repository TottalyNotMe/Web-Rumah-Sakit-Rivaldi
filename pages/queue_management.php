<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Otorisasi: Pastikan hanya officer atau admin yang bisa mengakses halaman ini
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'officer'])) {
    header("Location: index.php?page=dashboard");
    exit();
}

$success = '';
$error = '';

// Proses Update Status Antrean
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] == 'update_status') {
    $appointment_id = $_POST['appointment_id'] ?? '';
    $new_status = $_POST['new_status'] ?? '';

    if (!empty($appointment_id) && !empty($new_status)) {
        try {
            $stmt_update = $pdo->prepare("UPDATE appointments SET status = ? WHERE id = ?");
            $stmt_update->execute([$new_status, $appointment_id]);
            $success = "Status antrean berhasil diperbarui!";
        } catch (PDOException $e) {
            $error = "Gagal memperbarui status: " . $e->getMessage();
        }
    }
}

// Ambil Data Antrean HARI INI
$appointments = [];
try {
    $query = "
        SELECT 
            a.id AS appointment_id,
            a.booking_code,
            a.queue_number,
            a.status,
            a.complaint,
            p.full_name AS patient_name,
            p.mrn,
            d.full_name AS doctor_name,
            poly.name AS poly_name
        FROM appointments a
        JOIN patients p ON a.patient_id = p.id
        JOIN doctors d ON a.doctor_id = d.id
        LEFT JOIN poly ON d.poly_id = poly.id
        WHERE a.appointment_date = CURDATE()
        ORDER BY 
            FIELD(a.status, 'PENDING', 'CHECKED-IN', 'CONFIRMED', 'COMPLETED', 'CANCELLED'), 
            a.queue_number ASC
    ";
    $stmt = $pdo->query($query);
    $appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Gagal mengambil data antrean: " . $e->getMessage();
}

// Fungsi helper untuk warna badge status
function getQueueBadge($status) {
    switch (strtoupper($status)) {
        case 'PENDING': return 'background: #fef3c7; color: #d97706; border: 1px solid #fde68a;'; // Kuning
        case 'CHECKED-IN': return 'background: #ede9fe; color: #7c3aed; border: 1px solid #ddd6fe;'; // Ungu
        case 'COMPLETED': return 'background: #dcfce7; color: #16a34a; border: 1px solid #bbf7d0;'; // Hijau
        case 'CANCELLED': return 'background: #fee2e2; color: #dc2626; border: 1px solid #fecaca;'; // Merah
        default: return 'background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0;'; // Abu-abu
    }
}
?>

<div class="queue-management-container" style="max-width: 1100px; margin: 30px auto; padding: 0 20px;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <div>
            <h2 style="color: #1e293b; font-size: 24px; margin-bottom: 5px;">Manajemen Antrean Hari Ini</h2>
            <p style="color: #64748b; font-size: 15px; margin: 0;">Tanggal: <strong><?= date('d F Y') ?></strong></p>
        </div>
        <div>
            <button onclick="window.location.reload();" style="background: white; border: 1px solid #cbd5e1; color: #334155; padding: 8px 15px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; gap: 6px; font-weight: 500;">
                <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                Segarkan Data
            </button>
        </div>
    </div>

    <?php if ($success): ?>
        <div style="background:#dcfce7; color:#15803d; padding:12px 15px; border-radius:6px; margin-bottom:20px; border: 1px solid #86efac;">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div style="background:#fee2e2; color:#b91c1c; padding:12px 15px; border-radius:6px; margin-bottom:20px; border: 1px solid #f87171;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <div style="background: white; border-radius: 10px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #e2e8f0;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 15px; color: #475569; font-size: 14px; font-weight: 600;">No. Antrean</th>
                    <th style="padding: 15px; color: #475569; font-size: 14px; font-weight: 600;">Pasien</th>
                    <th style="padding: 15px; color: #475569; font-size: 14px; font-weight: 600;">Poli / Dokter</th>
                    <th style="padding: 15px; color: #475569; font-size: 14px; font-weight: 600;">Status</th>
                    <th style="padding: 15px; color: #475569; font-size: 14px; font-weight: 600; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($appointments)): ?>
                    <tr>
                        <td colspan="5" style="padding: 30px; text-align: center; color: #64748b;">
                            Tidak ada jadwal antrean untuk hari ini.
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($appointments as $app): ?>
                        <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;">
                            
                            <!-- Nomor Antrean -->
                            <td style="padding: 15px;">
                                <span style="font-size: 20px; font-weight: 800; color: rgb(25, 135, 84); display: block;">
                                    <?= htmlspecialchars($app['queue_number']) ?>
                                </span>
                                <span style="font-size: 12px; color: #94a3b8; font-family: monospace;">
                                    <?= htmlspecialchars($app['booking_code']) ?>
                                </span>
                            </td>

                            <!-- Info Pasien -->
                            <td style="padding: 15px;">
                                <div style="font-weight: 600; color: #0f172a; font-size: 15px; margin-bottom: 2px;">
                                    <?= htmlspecialchars($app['patient_name']) ?>
                                </div>
                                <div style="font-size: 13px; color: #64748b;">
                                    MRN: <?= htmlspecialchars($app['mrn']) ?>
                                </div>
                            </td>

                            <!-- Info Poli & Dokter -->
                            <td style="padding: 15px;">
                                <div style="font-size: 14px; color: #0f172a; font-weight: 500; margin-bottom: 2px;">
                                    <?= htmlspecialchars($app['poly_name']) ?>
                                </div>
                                <div style="font-size: 13px; color: #64748b;">
                                    <?= htmlspecialchars($app['doctor_name']) ?>
                                </div>
                            </td>

                            <!-- Status -->
                            <td style="padding: 15px;">
                                <span style="padding: 5px 12px; border-radius: 999px; font-size: 12px; font-weight: 600; <?= getQueueBadge($app['status']) ?>">
                                    <?= htmlspecialchars($app['status']) ?>
                                </span>
                            </td>

                            <!-- Aksi (Update Status) -->
                            <td style="padding: 15px; text-align: center;">
                                <form action="index.php?page=queue_management" method="POST" style="display: inline-flex; gap: 8px;">
                                    <input type="hidden" name="action" value="update_status">
                                    <input type="hidden" name="appointment_id" value="<?= $app['appointment_id'] ?>">
                                    
                                    <select name="new_status" style="padding: 6px; border: 1px solid #cbd5e1; border-radius: 4px; font-size: 13px; outline: none;">
                                        <option value="" disabled selected>Pilih Aksi...</option>
                                        <option value="CHECKED-IN" <?= $app['status'] == 'CHECKED-IN' ? 'disabled' : '' ?>>Hadir (Check-In)</option>
                                        <option value="COMPLETED" <?= $app['status'] == 'COMPLETED' ? 'disabled' : '' ?>>Selesai</option>
                                        <option value="CANCELLED" <?= $app['status'] == 'CANCELLED' ? 'disabled' : '' ?>>Batalkan</option>
                                    </select>
                                    
                                    <button type="submit" style="background: rgb(25, 135, 84); color: white; border: none; padding: 6px 12px; border-radius: 4px; font-size: 13px; cursor: pointer; font-weight: 500;">
                                        Simpan
                                    </button>
                                </form>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>