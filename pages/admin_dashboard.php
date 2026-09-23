<?php
require_once 'includes/auth_helper.php';
require_admin();

// Get real stats
$stmt = $pdo->query("SELECT COUNT(*) FROM patients");
$total_patients = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT SUM(total_amount) FROM invoices WHERE status = 'PAID' AND DATE(created_at) = CURDATE()");
$today_revenue = $stmt->fetchColumn() ?: 0;

$stmt = $pdo->query("SELECT COUNT(*) FROM rooms");
$total_rooms = $stmt->fetchColumn();

$stmt = $pdo->query("SELECT COUNT(*) FROM rooms WHERE status = 'OCCUPIED'");
$occupied_rooms = $stmt->fetchColumn();

$bor = $total_rooms > 0 ? round(($occupied_rooms / $total_rooms) * 100) : 0;
?>
<div class="container page-wrapper">
    <div class="page-header">
        <h2>Hospital Management Dashboard</h2>
        <p>Selamat datang, Administrator.</p>
    </div>
    
<div class="card-grid" style="margin-bottom:30px;">
    <div class="card">
        <h3 style="color:var(--text-muted); font-size:1rem;">Total Pasien Terdaftar</h3>
        <div style="font-size:2.5rem; font-weight:bold; margin-top:10px; color:var(--primary-color);"><?= number_format($total_patients) ?></div>
    </div>
    <div class="card">
        <h3 style="color:var(--text-muted); font-size:1rem;">Pendapatan Hari Ini</h3>
        <div style="font-size:2.5rem; font-weight:bold; margin-top:10px; color:#16a34a;">Rp <?= number_format($today_revenue, 0, ',', '.') ?></div>
    </div>
    <div class="card">
        <h3 style="color:var(--text-muted); font-size:1rem;">Tingkat Hunian Kamar (BOR)</h3>
        <div style="font-size:2.5rem; font-weight:bold; margin-top:10px; color:#ea580c;"><?= $bor ?>%</div>
    </div>
</div>

<h3>Statistik Kunjungan (7 Hari Terakhir)</h3>
<p style="color:var(--text-muted); margin-bottom: 20px; font-size:0.9rem;">Grafik Interaktif Native (Tanpa Library Tambahan)</p>

<!-- Native CSS & JS Interactive Chart -->
<div class="native-chart-container">
    <div class="chart-y-axis">
        <span>500</span>
        <span>400</span>
        <span>300</span>
        <span>200</span>
        <span>100</span>
        <span>0</span>
    </div>
    <div class="chart-area">
        <!-- Grid lines -->
        <div class="grid-line" style="bottom: 100%;"></div>
        <div class="grid-line" style="bottom: 80%;"></div>
        <div class="grid-line" style="bottom: 60%;"></div>
        <div class="grid-line" style="bottom: 40%;"></div>
        <div class="grid-line" style="bottom: 20%;"></div>
        <div class="grid-line" style="bottom: 0;"></div>
        
        <!-- Bars -->
        <div class="bar-container" onclick="showChartDetail('Senin', 350)">
            <div class="bar" style="height: 70%;"></div>
            <div class="x-label">Sen</div>
        </div>
        <div class="bar-container" onclick="showChartDetail('Selasa', 420)">
            <div class="bar" style="height: 84%; background-color: #2563eb;"></div>
            <div class="x-label">Sel</div>
        </div>
        <div class="bar-container" onclick="showChartDetail('Rabu', 280)">
            <div class="bar" style="height: 56%;"></div>
            <div class="x-label">Rab</div>
        </div>
        <div class="bar-container" onclick="showChartDetail('Kamis', 390)">
            <div class="bar" style="height: 78%;"></div>
            <div class="x-label">Kam</div>
        </div>
        <div class="bar-container" onclick="showChartDetail('Jumat', 450)">
            <div class="bar" style="height: 90%; background-color: #1d4ed8;"></div>
            <div class="x-label">Jum</div>
        </div>
        <div class="bar-container" onclick="showChartDetail('Sabtu', 210)">
            <div class="bar" style="height: 42%; background-color: #60a5fa;"></div>
            <div class="x-label">Sab</div>
        </div>
        <div class="bar-container" onclick="showChartDetail('Minggu', 120)">
            <div class="bar" style="height: 24%; background-color: #93c5fd;"></div>
            <div class="x-label">Min</div>
        </div>
    </div>
</div>

<div id="chart-info-box" class="chart-info-box">
    Klik salah satu diagram batang di atas untuk melihat detail kunjungan.
</div>

<script>
// Native Javascript interaction for the custom chart
function showChartDetail(day, value) {
    const infoBox = document.getElementById('chart-info-box');
    infoBox.innerHTML = '<strong>' + day + '</strong>: Ada <strong>' + value + '</strong> pasien yang mengunjungi rumah sakit.';
    infoBox.style.backgroundColor = '#dbeafe';
    infoBox.style.borderColor = '#bfdbfe';
    infoBox.style.color = '#1e40af';
    
    // Add small bump animation
    infoBox.style.transform = 'scale(1.02)';
    setTimeout(() => {
        infoBox.style.transform = 'scale(1)';
    }, 200);
}
</script>

</div>
