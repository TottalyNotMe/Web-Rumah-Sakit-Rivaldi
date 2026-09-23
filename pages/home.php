<!-- Hero Section -->
<section class="hero">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <h1>Perawatan Medis Berkualitas</h1>
        <p>Integrated Hospital Information System (IHIS) siap melayani kebutuhan kesehatan Anda dengan teknologi modern dan dokter spesialis terbaik.</p>
        <a href="index.php?page=book_appointment" class="btn btn-hero">Buat Janji Sekarang</a>
    </div>
</section>

<!-- Smart Search Box -->
<section class="search-section">
    <div class="container">
        <div class="search-box">
            <h2>Cari Layanan & Dokter</h2>
            <form action="index.php" method="GET" class="search-form">
                <input type="hidden" name="page" value="doctors">
                <input type="text" name="q" placeholder="Cari dokter, spesialisasi, atau layanan..." class="search-input">
                <button type="submit" class="btn btn-search">
                    <i class="fa-solid fa-search"></i> Cari
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Layanan Unggulan -->
<section class="services-section">
    <div class="container">
        <div class="section-header">
            <h2>Layanan Digital Kami</h2>
            <p>Akses layanan kesehatan lebih mudah melalui portal pasien kami.</p>
        </div>

        <div class="services-grid">
            <!-- Card 1 -->
            <div class="service-card">
                <div class="service-icon icon-blue">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
                <h3>Booking Dokter</h3>
                <p>Cari dokter spesialis dan atur jadwal pertemuan tanpa harus antre di rumah sakit.</p>
                <a href="index.php?page=doctors" class="service-link">Pelajari &rarr;</a>
            </div>

            <!-- Card 2 -->
            <div class="service-card">
                <div class="service-icon icon-green">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <h3>Rekam Medis (EMR)</h3>
                <p>Akses riwayat pemeriksaan, hasil laboratorium, dan radiologi Anda kapan saja.</p>
                <a href="index.php?page=medical_records" class="service-link">Pelajari &rarr;</a>
            </div>

            <!-- Card 3 -->
            <div class="service-card">
                <div class="service-icon icon-red">
                    <i class="fa-solid fa-video"></i>
                </div>
                <h3>Telekonsultasi</h3>
                <p>Konsultasi langsung dengan dokter pilihan Anda melalui video call dari rumah.</p>
                <a href="index.php?page=services" class="service-link">Pelajari &rarr;</a>
            </div>
        </div>
    </div>
</section>
