<?php
// pages/queue.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ambil info antrean hari ini jika user login sebagai pasien
$my_queue = null;
if (isset($_SESSION['user_id'])) {
    try {
        $stmt_me = $pdo->prepare("
            SELECT a.booking_code, a.queue_number, a.status, a.appointment_date, d.full_name as doctor_name, p.name as poly_name
            FROM appointments a
            JOIN patients pt ON a.patient_id = pt.id
            JOIN doctors d ON a.doctor_id = d.id
            LEFT JOIN poly p ON d.poly_id = p.id
            WHERE pt.user_id = ? AND a.appointment_date = CURDATE() AND a.status IN ('CHECKED-IN', 'PENDING')
            LIMIT 1
        ");
        $stmt_me->execute([$_SESSION['user_id']]);
        $my_queue = $stmt_me->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {}
}

// Simulasi antrean per poliklinik
$polys_queue = [
    [
        'poly' => 'Poliklinik Penyakit Dalam',
        'doctor' => 'dr. Budi Santoso, Sp.PD',
        'current' => 'A-018',
        'next' => 'A-019',
        'status' => 'Sedang Melayani',
        'color' => '#0d6efd',
        'room' => 'Ruang Poli 101'
    ],
    [
        'poly' => 'Poliklinik Jantung & Pembuluh Darah',
        'doctor' => 'dr. Siti Rahmawati, Sp.JP',
        'current' => 'B-009',
        'next' => 'B-010',
        'status' => 'Sedang Melayani',
        'color' => '#dc2626',
        'room' => 'Ruang Poli 104'
    ],
    [
        'poly' => 'Poliklinik Anak (Pediatri)',
        'doctor' => 'dr. Siti Aminah, Sp.A',
        'current' => 'C-014',
        'next' => 'C-015',
        'status' => 'Sedang Melayani',
        'color' => '#059669',
        'room' => 'Ruang Poli 102'
    ],
    [
        'poly' => 'Poliklinik Bedah Umum',
        'doctor' => 'dr. Andi Wijaya, Sp.B',
        'current' => 'D-006',
        'next' => 'D-007',
        'status' => 'Persiapan Konsultasi',
        'color' => '#d97706',
        'room' => 'Ruang Poli 105'
    ]
];
?>
<div class="container page-wrapper" style="max-width: 1100px; margin: 40px auto; padding: 0 20px;">
    
    <!-- Hero / Header -->
    <div class="page-header" style="text-align: center; margin-bottom: 35px; background: linear-gradient(135deg, #0b2541, #1e3a8a); color: white; padding: 45px 20px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);">
        <span style="background: rgba(255,255,255,0.15); padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 10px;">Live Virtual Queue Display</span>
        <h1 style="color: white; font-size: 32px; font-weight: 800; margin-bottom: 10px;">Monitor Antrean Pasien Real-Time</h1>
        <p style="color: #cbd5e1; font-size: 15px; max-width: 650px; margin: 0 auto; line-height: 1.6;">
            Pantau status pemanggilan nomor antrean poliklinik secara langsung tanpa harus berdesakan di ruang tunggu rumah sakit.
        </p>
        <div style="margin-top: 15px; font-size: 13px; color: #93c5fd;">
            <i class="fa-solid fa-clock"></i> Waktu Server: <strong id="liveClock"><?= date('H:i:s') ?> WIB</strong> &bull; <?= date('l, d F Y') ?>
        </div>
    </div>

    <!-- Kotak Antrean Saya (Jika ada) -->
    <?php if($my_queue): ?>
        <div style="background: linear-gradient(135deg, #eff6ff, #dbeafe); border: 2px solid #3b82f6; border-radius: 16px; padding: 25px 30px; margin-bottom: 35px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
            <div>
                <span style="background: #2563eb; color: white; padding: 4px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; text-transform: uppercase;">Nomor Antrean Anda Hari Ini</span>
                <h2 style="font-size: 36px; color: #1e3a8a; font-weight: 800; margin: 8px 0 4px;"><?= htmlspecialchars($my_queue['queue_number'] ?? 'A-023') ?></h2>
                <p style="margin: 0; color: #475569; font-size: 14px;">
                    <strong><?= htmlspecialchars($my_queue['poly_name'] ?? 'Poli Umum') ?></strong> &bull; <?= htmlspecialchars($my_queue['doctor_name']) ?> &bull; Kode Booking: <code><?= htmlspecialchars($my_queue['booking_code']) ?></code>
                </p>
            </div>
            <div style="text-align: right;">
                <span class="badge" style="background: #dcfce7; color: #15803d; padding: 8px 16px; border-radius: 20px; font-weight: 700; font-size: 13px;">Status: <?= htmlspecialchars($my_queue['status']) ?></span>
                <p style="margin: 8px 0 0; color: #64748b; font-size: 12px;">Mohon berada di dekat ruang poli 10 menit sebelum dipanggil.</p>
            </div>
        </div>
    <?php else: ?>
        <div style="background: white; border-radius: 12px; padding: 18px 24px; margin-bottom: 35px; border: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 15px;">
            <div style="display: flex; align-items: center; gap: 14px;">
                <i class="fa-solid fa-hospital-user" style="font-size: 24px; color: #0d6efd;"></i>
                <div>
                    <h4 style="margin: 0 0 2px; font-size: 15px; color: #0f172a;">Ingin Mendaftar Antrean Konsultasi Hari Ini?</h4>
                    <p style="margin: 0; color: #64748b; font-size: 13px;">Dapatkan nomor antrean digital langsung melalui form booking kami.</p>
                </div>
            </div>
            <a href="index.php?page=book_appointment" class="btn btn-primary" style="padding: 8px 20px; font-size: 13px; border-radius: 6px;">Ambil Antrean Dokter</a>
        </div>
    <?php endif; ?>

    <!-- Display Board Poliklinik -->
    <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 20px; display: flex; align-items: center; gap: 8px;">
        <i class="fa-solid fa-tv" style="color: #0d6efd;"></i> Layar Papan Pemanggilan Poliklinik
    </h3>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 20px; margin-bottom: 40px;">
        <?php foreach($polys_queue as $pq): ?>
            <div style="background: white; border-radius: 14px; padding: 22px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; border-top: 5px solid <?= $pq['color'] ?>; text-align: center;">
                <span style="font-size: 12px; font-weight: 700; color: #64748b; text-transform: uppercase;"><?= htmlspecialchars($pq['room']) ?></span>
                <h4 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 4px 0 2px;"><?= htmlspecialchars($pq['poly']) ?></h4>
                <p style="color: #64748b; font-size: 12px; margin-bottom: 18px;"><?= htmlspecialchars($pq['doctor']) ?></p>

                <div style="background: #f8fafc; border-radius: 10px; padding: 15px; margin-bottom: 15px;">
                    <span style="font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.5px;">Nomor Sedang Dipanggil</span>
                    <div style="font-size: 44px; font-weight: 900; color: <?= $pq['color'] ?>; line-height: 1.1; margin: 6px 0;"><?= htmlspecialchars($pq['current']) ?></div>
                    <span class="badge" style="background: #e0f2fe; color: #0369a1; font-size: 11px; padding: 3px 10px; border-radius: 20px;"><?= htmlspecialchars($pq['status']) ?></span>
                </div>

                <div style="display: flex; justify-content: space-between; font-size: 12px; color: #64748b; padding-top: 8px; border-top: 1px dashed #e2e8f0;">
                    <span>Antrean Selanjutnya:</span>
                    <strong style="color: #0f172a;"><?= htmlspecialchars($pq['next']) ?></strong>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Informasi Petunjuk Pasien -->
    <div style="background: #ffffff; border-radius: 14px; padding: 25px; border: 1px solid #e2e8f0; box-shadow: 0 4px 10px rgba(0,0,0,0.02);">
        <h4 style="font-size: 16px; font-weight: 700; color: #0f172a; margin-bottom: 12px;"><i class="fa-solid fa-bell" style="color: #f59e0b;"></i> Prosedur Pemanggilan Antrean:</h4>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 16px; font-size: 13px; color: #475569;">
            <div style="background: #f8fafc; padding: 12px 16px; border-radius: 8px;">
                <strong>1. Check-In Kedatangan:</strong> Lakukan konfirmasi check-in di frontdesk atau melalui portal maksimal 15 menit sebelum estimasi konsultasi.
            </div>
            <div style="background: #f8fafc; padding: 12px 16px; border-radius: 8px;">
                <strong>2. Suara Pemanggilan:</strong> Saat nomor Anda dipanggil, monitor dan sistem audio ruang poli akan mengumumkan nomor dan nama pasien.
            </div>
            <div style="background: #f8fafc; padding: 12px 16px; border-radius: 8px;">
                <strong>3. Lewat Panggilan:</strong> Pasien yang terlambat datang 3 kali pemanggilan akan dimasukkan ke urutan antrean cadangan setelah 2 pasien berikutnya.
            </div>
        </div>
    </div>

</div>

<script>
    // Update live clock
    setInterval(() => {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('id-ID') + ' WIB';
        const el = document.getElementById('liveClock');
        if(el) el.innerText = timeStr;
    }, 1000);
</script>
