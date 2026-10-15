<?php
// Pastikan tidak ada spasi sebelum <?php jika file ini di-include
$error = '';
$doctors = [];

try {
    // Ambil data dokter yang berstatus ACTIVE beserta nama polikliniknya
    $query = "
        SELECT d.id, d.full_name, d.specialty, d.fee, p.name AS poly_name
        FROM doctors d
        LEFT JOIN poly p ON d.poly_id = p.id
        WHERE d.status = 'ACTIVE'
        ORDER BY p.name ASC, d.full_name ASC
    ";
    $stmt = $pdo->query($query);
    $doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Gagal memuat daftar dokter: " . $e->getMessage();
}
?>

<div class="doctors-page-container" style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
    
    <div class="page-header" style="text-align: center; margin-bottom: 40px;">
        <h1 style="color: #1e293b; font-size: 32px; margin-bottom: 10px;">Daftar Dokter Kami</h1>
        <p style="font-size: 16px; max-width: 600px; margin: 0 auto;">
            Temukan dokter spesialis terbaik kami yang siap membantu dan merawat kesehatan Anda dengan sepenuh hati.
        </p>
    </div>

    <?php if ($error): ?>
        <div style="background:#fee2e2; color:#b91c1c; padding:15px; border-radius:8px; border: 1px solid #f87171; text-align: center;">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php elseif (empty($doctors)): ?>
        <div style="text-align: center; padding: 50px; background: #f8fafc; border-radius: 8px; color: #64748b;">
            <svg style="width: 50px; height: 50px; margin: 0 auto 15px; color: #cbd5e1;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <p>Belum ada data dokter yang tersedia saat ini.</p>
        </div>
    <?php else: ?>
        <div class="doctors-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 24px;">
            <?php foreach ($doctors as $doc): ?>
                <div class="doctor-card" style="background: #ffffff; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); text-align: center; transition: transform 0.2s ease;">
                    
                    <!-- Avatar Dummy -->
                    <div class="doctor-avatar" style="width: 80px; height: 80px; background: #e0f2fe; border-radius: 50%; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; color: #0284c7;">
                        <svg style="width: 40px; height: 40px;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>

                    <!-- Info Dokter -->
                    <h3 style="font-size: 18px; color: #0f172a; margin: 0 0 4px; font-weight: 600;">
                        <?= htmlspecialchars($doc['full_name']) ?>
                    </h3>
                    <p style="color: #059669; font-size: 14px; font-weight: 500; margin: 0 0 8px;">
                        Spesialis <?= htmlspecialchars($doc['specialty']) ?>
                    </p>
                    
                    <!-- Poliklinik Badge -->
                    <div style="display: inline-block; background: #f1f5f9; color: #475569; padding: 4px 12px; border-radius: 999px; font-size: 12px; font-weight: 500; margin-bottom: 20px;">
                        <?= htmlspecialchars($doc['poly_name'] ?? 'Poli Umum') ?>
                    </div>

                    <!-- Tombol Aksi -->
                    <a href="index.php?page=book_appointment" class="btn-book" style="display: block; width: 100%; background: rgb(25, 135, 84); color: #ffffff; padding: 10px 0; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 600; transition: background 0.2s ease;">
                        Buat Janji Temu
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<style>
    /* Efek Hover untuk Card Dokter */
    .doctor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
    }
    
    /* Efek Hover untuk Tombol */
    .btn-book:hover {
        background: rgb(20, 110, 68) !important;
    }
</style>