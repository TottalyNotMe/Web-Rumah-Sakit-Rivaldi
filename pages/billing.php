<?php
require_once 'includes/auth_helper.php';
require_patient();

// Ambil patient ID
$stmt = $pdo->prepare("SELECT id FROM patients WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$patient = $stmt->fetch(PDO::FETCH_ASSOC);
$patient_id = $patient['id'];

// Ambil data tagihan (PENDING/PAID)
$stmt = $pdo->prepare("SELECT i.*, a.booking_code, d.full_name as doctor_name, a.appointment_date 
                       FROM invoices i 
                       LEFT JOIN appointments a ON i.appointment_id = a.id
                       LEFT JOIN doctors d ON a.doctor_id = d.id
                       WHERE i.patient_id = ? ORDER BY i.created_at DESC");
$stmt->execute([$patient_id]);
$invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="billing-container container">
    <div class="billing-header">
        <h2>Tagihan & Pembayaran</h2>
        <p>Selesaikan tagihan Anda untuk mengonfirmasi janji temu.</p>
    </div>

    <?php if(empty($invoices)): ?>
        <div class="empty-state" style="text-align: center; padding: 50px;">
            <i class="fa-solid fa-file-invoice-dollar" style="font-size:3rem; color:#ccc; margin-bottom:15px;"></i>
            <p>Belum ada tagihan saat ini.</p>
        </div>
    <?php else: ?>
        <div class="invoice-list" style="display: grid; gap: 20px;">
            <?php foreach($invoices as $inv): ?>
                <div class="invoice-card" style="background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display: flex; justify-content: space-between; align-items: center;">
                    <div class="invoice-details">
                        <h3 style="margin-bottom: 5px;">Invoice: <?= htmlspecialchars($inv['invoice_number']) ?></h3>
                        <?php if($inv['booking_code']): ?>
                            <p class="text-muted" style="color: #6b7280; font-size: 0.9rem;">Kode Booking: <?= htmlspecialchars($inv['booking_code']) ?></p>
                            <p style="margin-top: 5px;"><strong>Konsultasi:</strong> <?= htmlspecialchars($inv['doctor_name']) ?> (<?= $inv['appointment_date'] ?>)</p>
                        <?php else: ?>
                            <p class="text-muted" style="color: #6b7280; font-size: 0.9rem;">Tagihan Lainnya</p>
                        <?php endif; ?>
                        
                        <div class="amount-box" style="margin-top: 10px; font-size: 1.1rem;">
                            <span class="label">Total Tagihan: </span>
                            <strong class="amount" style="color: var(--primary-color);">Rp <?= number_format($inv['total_amount'], 0, ',', '.') ?></strong>
                        </div>
                    </div>
                    
                    <div class="invoice-actions" style="text-align: right;">
                        <?php if($inv['status'] === 'PENDING'): ?>
                            <div class="status-badge status-unpaid" style="background: #fef3c7; color: #d97706; padding: 4px 10px; border-radius: 20px; display: inline-block; margin-bottom: 10px; font-weight: 600; font-size: 0.85rem;">Belum Dibayar</div><br>
                            <button class="btn btn-primary btn-pay" onclick="payWithMidtrans('<?= $inv['invoice_number'] ?>', <?= $inv['total_amount'] ?>)">
                                <i class="fa-solid fa-credit-card"></i> Bayar Sekarang
                            </button>
                        <?php else: ?>
                            <div class="status-badge status-paid" style="background: #dcfce7; color: #16a34a; padding: 4px 10px; border-radius: 20px; display: inline-block; margin-bottom: 10px; font-weight: 600; font-size: 0.85rem;">Lunas</div><br>
                            <a href="#" class="btn btn-light" style="border:1px solid #ccc;">
                                <i class="fa-solid fa-download"></i> Unduh Kuitansi
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
function payWithMidtrans(invoiceNumber, amount) {
    // Simulasi respons dari server untuk token snap
    // Pada aplikasi nyata, Anda melakukan AJAX POST ke server PHP Anda, 
    // lalu server memanggil Midtrans API, dan mereturn Snap Token.
    
    alert("Simulasi Midtrans Triggered untuk Invoice: " + invoiceNumber + "\n\nDalam mode produksi/nyata, popup Midtrans Snap akan muncul di sini menggunakan data-client-key.");
    
    // Contoh pemanggilan Snap API nyata (jika punya token):
    /*
    snap.pay('DUMMY_SNAP_TOKEN', {
        onSuccess: function(result){
            alert("Pembayaran Berhasil!"); 
            // Kirim AJAX ke update status database
        },
        onPending: function(result){ alert("Menunggu Pembayaran!"); },
        onError: function(result){ alert("Pembayaran Gagal!"); }
    });
    */
    
    // Simulate Success for demo purposes:
    if(confirm("Simulasikan pembayaran BERHASIL untuk demo ini?")) {
        window.location.href = "api/midtrans_notification.php?order_id=" + invoiceNumber + "&status_code=200";
    }
}
</script>
