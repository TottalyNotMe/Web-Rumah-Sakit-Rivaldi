<?php
// pages/home.php
?>
<!-- Hero Section -->
<section class="hero" style="position: relative; padding: 120px 0 140px; background: linear-gradient(135deg, rgba(11, 37, 65, 0.9), rgba(14, 116, 144, 0.75)), url('https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1920&q=80') center/cover; color: white;">
    <div class="container hero-content" style="max-width: 900px; text-align: center; margin: 0 auto;">
        <span style="background: rgba(255,255,255,0.2); padding: 6px 18px; border-radius: 50px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; display: inline-block; margin-bottom: 20px;">
            <i class="fa-solid fa-star" style="color: #facc15; margin-right: 6px;"></i> Rumah Sakit Berstandar Internasional JCI
        </span>
        <h1 style="font-size: 3.5rem; font-weight: 800; line-height: 1.2; margin-bottom: 20px; color: white; text-shadow: 0 4px 15px rgba(0,0,0,0.3);">
            Layanan Kesehatan Terpadu, Modern & Terpercaya
        </h1>
        <p style="font-size: 1.2rem; color: #e2e8f0; margin-bottom: 35px; line-height: 1.6;">
            Mengintegrasikan dokter spesialis terbaik, teknologi robotik canggih, pemantauan antrean real-time, dan rekam medis elektronik (EMR) dalam satu portal kesehatan.
        </p>
        <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
            <a href="index.php?page=book_appointment" class="btn" style="background: #0d6efd; color: white; padding: 14px 32px; border-radius: 50px; font-size: 1.05rem; font-weight: 700; text-decoration: none; box-shadow: 0 8px 20px rgba(13,110,253,0.4);">
                <i class="fa-solid fa-calendar-check" style="margin-right: 8px;"></i> Buat Janji Temu Dokter
            </a>
            <a href="index.php?page=queue" class="btn" style="background: rgba(255,255,255,0.15); border: 2px solid white; color: white; padding: 14px 28px; border-radius: 50px; font-size: 1.05rem; font-weight: 700; text-decoration: none;">
                <i class="fa-solid fa-tv" style="margin-right: 8px;"></i> Cek Antrean Virtual
            </a>
        </div>
    </div>
</section>

<!-- Smart Search Box -->
<section class="search-section" style="margin-top: -50px; position: relative; z-index: 20; padding: 0 20px;">
    <div class="container" style="max-width: 980px;">
        <div class="search-box" style="background: white; border-radius: 16px; padding: 30px; box-shadow: 0 15px 35px -5px rgba(0,0,0,0.12); border: 1px solid #e2e8f0;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
                <h3 style="margin: 0; font-size: 20px; font-weight: 800; color: #0f172a; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-magnifying-glass" style="color: #0d6efd;"></i> Cari Dokter, Layanan, atau Poliklinik
                </h3>
                <span style="font-size: 13px; color: #64748b;">Tersedia 45+ Dokter Spesialis</span>
            </div>
            <form action="index.php" method="GET" style="display: flex; gap: 12px; flex-wrap: wrap;">
                <input type="hidden" name="page" value="doctors">
                <input type="text" name="q" placeholder="Ketik nama dokter, spesialis (misal: Jantung, Anak, Bedah)..." style="flex: 1; min-width: 280px; padding: 14px 18px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none;">
                <button type="submit" class="btn btn-primary" style="padding: 14px 28px; border-radius: 8px; font-weight: 700; font-size: 15px;">
                    <i class="fa-solid fa-search"></i> Cari Sekarang
                </button>
            </form>
        </div>
    </div>
</section>

<!-- Quick Action Highlights Bar -->
<section style="padding: 50px 0 20px;">
    <div class="container" style="max-width: 1140px;">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
            <a href="index.php?page=doctors" style="background: white; padding: 22px; border-radius: 12px; border: 1px solid #e2e8f0; text-decoration: none; display: flex; align-items: center; gap: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); transition: transform 0.2s;">
                <div style="width: 50px; height: 50px; background: #eff6ff; color: #0284c7; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">
                    <i class="fa-solid fa-user-doctor"></i>
                </div>
                <div>
                    <h4 style="margin: 0 0 4px; font-size: 16px; color: #0f172a; font-weight: 700;">Jadwal Dokter</h4>
                    <p style="margin: 0; color: #64748b; font-size: 13px;">Lihat profil & jam praktik</p>
                </div>
            </a>

            <a href="index.php?page=promo" style="background: white; padding: 22px; border-radius: 12px; border: 1px solid #e2e8f0; text-decoration: none; display: flex; align-items: center; gap: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); transition: transform 0.2s;">
                <div style="width: 50px; height: 50px; background: #fef3c7; color: #d97706; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">
                    <i class="fa-solid fa-gift"></i>
                </div>
                <div>
                    <h4 style="margin: 0 0 4px; font-size: 16px; color: #0f172a; font-weight: 700;">Paket MCU</h4>
                    <p style="margin: 0; color: #64748b; font-size: 13px;">Promo hemat hingga 40%</p>
                </div>
            </a>

            <a href="index.php?page=queue" style="background: white; padding: 22px; border-radius: 12px; border: 1px solid #e2e8f0; text-decoration: none; display: flex; align-items: center; gap: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); transition: transform 0.2s;">
                <div style="width: 50px; height: 50px; background: #dcfce7; color: #15803d; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">
                    <i class="fa-solid fa-list-ol"></i>
                </div>
                <div>
                    <h4 style="margin: 0 0 4px; font-size: 16px; color: #0f172a; font-weight: 700;">Antrean Poliklinik</h4>
                    <p style="margin: 0; color: #64748b; font-size: 13px;">Cek live status pemanggilan</p>
                </div>
            </a>

            <a href="index.php?page=hospitals" style="background: white; padding: 22px; border-radius: 12px; border: 1px solid #e2e8f0; text-decoration: none; display: flex; align-items: center; gap: 16px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03); transition: transform 0.2s;">
                <div style="width: 50px; height: 50px; background: #f3e8ff; color: #7e22ce; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 24px; flex-shrink: 0;">
                    <i class="fa-solid fa-hospital"></i>
                </div>
                <div>
                    <h4 style="margin: 0 0 4px; font-size: 16px; color: #0f172a; font-weight: 700;">Cabang RS</h4>
                    <p style="margin: 0; color: #64748b; font-size: 13px;">Lokasi & kontak darurat</p>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Layanan Unggulan & Center of Excellence -->
<section class="services-section" style="padding: 60px 0;">
    <div class="container" style="max-width: 1140px;">
        <div class="section-header" style="text-align: center; margin-bottom: 45px;">
            <span style="color: #0d6efd; font-weight: 700; text-transform: uppercase; font-size: 13px; letter-spacing: 1px;">Keunggulan Komprehensif</span>
            <h2 style="font-size: 32px; font-weight: 800; color: #0f172a; margin: 8px 0 12px;">Pusat Layanan Medis Terpadu</h2>
            <p style="color: #64748b; font-size: 16px; max-width: 650px; margin: 0 auto;">Pelayanan kesehatan komprehensif mulai dari pencegahan, diagnosa presisi, hingga rehabilitasi medik.</p>
        </div>

        <div class="services-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 28px;">
            <!-- Card 1 -->
            <div class="service-card" style="background: white; padding: 30px; border-radius: 14px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
                <div style="width: 60px; height: 60px; background: #fee2e2; color: #dc2626; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 20px;">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 10px;">Pusat Jantung & Vaskular</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Cath Lab siaga 24 jam untuk penanganan serangan jantung, angiografi, dan pemasangan ring jantung.</p>
                <a href="index.php?page=services" style="color: #0d6efd; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                    Pelajari Fasilitas <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- Card 2 -->
            <div class="service-card" style="background: white; padding: 30px; border-radius: 14px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
                <div style="width: 60px; height: 60px; background: #dcfce7; color: #16a34a; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 20px;">
                    <i class="fa-solid fa-notes-medical"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 10px;">Rekam Medis Digital (EMR)</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Akses hasil diagnosa ICD-10, catatan dokter, hasil tes laboratorium, dan riwayat resep secara aman.</p>
                <a href="index.php?page=medical_records" style="color: #0d6efd; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                    Buka EMR Pasien <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <!-- Card 3 -->
            <div class="service-card" style="background: white; padding: 30px; border-radius: 14px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
                <div style="width: 60px; height: 60px; background: #e0f2fe; color: #0284c7; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 26px; margin-bottom: 20px;">
                    <i class="fa-solid fa-truck-medical"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 10px;">Emergency & Ambulans 24 Jam</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">Unit gawat darurat dengan armada ambulans berfasilitas ICU lengkap siap jemput ke lokasi Anda.</p>
                <a href="index.php?page=contact" style="color: #0d6efd; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
                    Hubungi Emergency <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Berita & Artikel Terbaru Preview -->
<section style="padding: 40px 0 80px; background: #f8fafc;">
    <div class="container" style="max-width: 1140px;">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 35px; flex-wrap: wrap; gap: 15px;">
            <div>
                <span style="color: #0d6efd; font-weight: 700; text-transform: uppercase; font-size: 13px;">Edukasi Medis</span>
                <h2 style="font-size: 28px; font-weight: 800; color: #0f172a; margin-top: 4px;">Artikel & Tips Kesehatan Terkini</h2>
            </div>
            <a href="index.php?page=articles" class="btn btn-outline" style="border-radius: 8px; font-size: 14px; padding: 10px 20px;">
                Lihat Semua Artikel <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 24px;">
            <div style="background: white; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);">
                <img src="https://images.unsplash.com/photo-1628348068343-c6a848d2b6dd?auto=format&fit=crop&w=500&q=80" style="width: 100%; height: 180px; object-fit: cover;">
                <div style="padding: 20px;">
                    <span style="color: #e11d48; font-size: 12px; font-weight: 700; text-transform: uppercase;">Jantung</span>
                    <h4 style="font-size: 17px; font-weight: 700; margin: 8px 0; color: #0f172a;">5 Gejala Awal Serangan Jantung yang Sering Diabaikan</h4>
                    <p style="color: #64748b; font-size: 13px; line-height: 1.6; margin-bottom: 15px;">Ketahui tanda darurat seperti keringat dingin, sesak nafas mendadak, dan rasa tertekan di dada...</p>
                    <a href="index.php?page=articles" style="color: #0d6efd; font-size: 13px; font-weight: 700; text-decoration: none;">Baca Selengkapnya &rarr;</a>
                </div>
            </div>

            <div style="background: white; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);">
                <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=500&q=80" style="width: 100%; height: 180px; object-fit: cover;">
                <div style="padding: 20px;">
                    <span style="color: #16a34a; font-size: 12px; font-weight: 700; text-transform: uppercase;">Gizi & Nutrisi</span>
                    <h4 style="font-size: 17px; font-weight: 700; margin: 8px 0; color: #0f172a;">Pola Makan Rendah Indeks Glikemik bagi Pasien Diabetes</h4>
                    <p style="color: #64748b; font-size: 13px; line-height: 1.6; margin-bottom: 15px;">Mengatur kombinasi karbohidrat kompleks dan serat demi stabilitas kadar gula darah harian...</p>
                    <a href="index.php?page=articles" style="color: #0d6efd; font-size: 13px; font-weight: 700; text-decoration: none;">Baca Selengkapnya &rarr;</a>
                </div>
            </div>

            <div style="background: white; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.03);">
                <img src="https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?auto=format&fit=crop&w=500&q=80" style="width: 100%; height: 180px; object-fit: cover;">
                <div style="padding: 20px;">
                    <span style="color: #0284c7; font-size: 12px; font-weight: 700; text-transform: uppercase;">Kesehatan Anak</span>
                    <h4 style="font-size: 17px; font-weight: 700; margin: 8px 0; color: #0f172a;">Jadwal Imunisasi Dasar Lengkap untuk Bayi & Balita</h4>
                    <p style="color: #64748b; font-size: 13px; line-height: 1.6; margin-bottom: 15px;">Panduan vaksinasi wajib mulai dari Hepatitis B, BCG, DPT, hingga MMR untuk perlindungan anak...</p>
                    <a href="index.php?page=articles" style="color: #0d6efd; font-size: 13px; font-weight: 700; text-decoration: none;">Baca Selengkapnya &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</section>
