<?php
require_once __DIR__ . '/../config/database.php';

// Create table if not exists (Auto Setup)
try {
    $sql = "CREATE TABLE IF NOT EXISTS contact_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        phone VARCHAR(50),
        email VARCHAR(255) NOT NULL,
        category VARCHAR(100),
        message TEXT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
} catch (PDOException $e) {
    // Silently ignore if table creation fails due to permissions, assuming it might already exist
}

$status_msg = '';
$status_type = ''; // 'success' or 'error'

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contact'])) {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $category = htmlspecialchars(trim($_POST['category'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if (!empty($name) && !empty($email) && !empty($message)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, phone, email, category, message) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$name, $phone, $email, $category, $message]);
            $status_msg = "Terima kasih! Pesan Anda telah berhasil terkirim dan disimpan di database kami. Tim layanan kami akan merespons maksimal dalam 1x24 jam.";
            $status_type = "success";
        } catch (Exception $e) {
            $status_msg = "Maaf, terjadi kesalahan saat menyimpan pesan ke database. Error: " . $e->getMessage();
            $status_type = "error";
        }
    } else {
        $status_msg = "Mohon lengkapi kolom Nama, Email, dan Pesan dengan benar.";
        $status_type = "error";
    }
}

// Memastikan CSS tersambung aman via include PHP
$css_file = __DIR__ . '/../assets/css/contact.css';
?>
<style>
    <?php if(file_exists($css_file)) include $css_file; ?>
</style>

<div class="contact-page-container">

    <!-- HERO BANNER (DARK BACKGROUND) -->
    <section class="contact-hero">
        <div class="container fade-up-element visible">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="hero-text-content">
                        <h6 style="color: var(--secondary-color); font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;">Layanan Bantuan 24/7</h6>
                        <h1>Kami Mendengar & Peduli</h1>
                        <p>Pusat Bantuan & Layanan Pelanggan Internasional. Tim kami hadir untuk menjawab semua pertanyaan Anda secara profesional dan memastikan pengalaman medis terbaik bagi Anda dan keluarga.</p>
                        <a href="#directory" class="btn-submit" style="display: inline-block; padding: 14px 40px; width: auto; font-size: 1.1rem; box-shadow: 0 10px 20px rgba(0,0,0,0.3);">Hubungi Departemen Spesifik</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- INFO CARDS (Interactive) -->
    <section class="contact-info-section">
        <div class="container">
            <div class="row" style="position: relative; z-index: 10;">
                
                <div class="col-lg-4 mb-4">
                    <div class="info-card fade-up-element">
                        <div class="info-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        <h4>Lokasi Rumah Sakit</h4>
                        <p>Kawasan SCBD, Jl. Jendral Sudirman No. 123,<br>Jakarta Selatan 12190</p>
                        <strong style="font-size: 1rem; cursor: pointer;" onclick="window.location.hash='#transport'">Lihat Petunjuk Arah &rarr;</strong>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="info-card emergency fade-up-element" style="transition-delay: 0.1s;">
                        <div class="info-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        </div>
                        <h4>Ambulans & IGD 24 Jam</h4>
                        <p>Layanan Gawat Darurat (Bebas Pulsa)</p>
                        <strong style="color: var(--accent-color); font-size: 1.6rem;">1-500-111</strong>
                        <p class="mt-1" style="font-size: 0.85rem; font-weight: 600;">Telepon Segera jika Darurat</p>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="info-card fade-up-element" style="transition-delay: 0.2s;">
                        <div class="info-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        </div>
                        <h4>Email & Kerjasama</h4>
                        <p>Untuk administrasi asuransi, kemitraan korporat, dan rujukan pasien internasional.</p>
                        <strong style="font-size: 1.1rem;">info@sehatselalu.com</strong>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- DEPARTMENT DIRECTORY SECTION (CLICKABLE WHATSAPP) -->
    <section class="directory-section" id="directory">
        <div class="container fade-up-element">
            <div class="text-center mb-5">
                <h6 style="color: var(--secondary-color); font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">Direktori Telepon & WhatsApp</h6>
                <h2>Hubungi Departemen Spesifik</h2>
                <p class="text-muted">Klik salah satu departemen di bawah ini untuk terhubung langsung dengan staf kami via WhatsApp.</p>
            </div>
            
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <a href="https://wa.me/62811999888?text=Halo%2C%20saya%20ingin%20bertanya%20seputar%20Pusat%20Jantung" target="_blank" class="dir-card-link">
                        <div class="dir-card">
                            <div class="dir-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            </div>
                            <div class="dir-info">
                                <h5>Pusat Jantung</h5>
                                <p>Kateterisasi & Rawat Jalan</p>
                            </div>
                            <div class="dir-wa-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                Chat WA
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="https://wa.me/62811999888?text=Halo%2C%20saya%20ingin%20bertanya%20seputar%20Pusat%20Kanker" target="_blank" class="dir-card-link">
                        <div class="dir-card">
                            <div class="dir-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                            </div>
                            <div class="dir-info">
                                <h5>Pusat Kanker (Oncology)</h5>
                                <p>Kemoterapi & Radioterapi</p>
                            </div>
                            <div class="dir-wa-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                Chat WA
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="https://wa.me/62811999888?text=Halo%2C%20saya%20ingin%20membuat%20janji%20dengan%20Klinik%20Ibu%20Anak" target="_blank" class="dir-card-link">
                        <div class="dir-card">
                            <div class="dir-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                            </div>
                            <div class="dir-info">
                                <h5>Klinik Ibu & Anak</h5>
                                <p>Jadwal Obgyn & Dokter Anak</p>
                            </div>
                            <div class="dir-wa-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                Chat WA
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="https://wa.me/62811999888?text=Halo%2C%20saya%20ingin%20konsultasi%20mengenai%20Jadwal%20Bedah" target="_blank" class="dir-card-link">
                        <div class="dir-card">
                            <div class="dir-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            </div>
                            <div class="dir-info">
                                <h5>Jadwal Bedah (Surgery)</h5>
                                <p>Pemesanan Ruang Operasi</p>
                            </div>
                            <div class="dir-wa-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                Chat WA
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="https://wa.me/62811999888?text=Halo%2C%20saya%20ingin%20bertanya%20seputar%20Apotek" target="_blank" class="dir-card-link">
                        <div class="dir-card">
                            <div class="dir-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                            </div>
                            <div class="dir-info">
                                <h5>Apotek & Farmasi</h5>
                                <p>Penebusan & Pengiriman Obat</p>
                            </div>
                            <div class="dir-wa-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                Chat WA
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-lg-4">
                    <a href="https://wa.me/62811999888?text=Halo%2C%20saya%20ingin%20verifikasi%20Asuransi" target="_blank" class="dir-card-link">
                        <div class="dir-card">
                            <div class="dir-icon">
                                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                            </div>
                            <div class="dir-info">
                                <h5>Pusat Asuransi</h5>
                                <p>Verifikasi & Bantuan Klaim</p>
                            </div>
                            <div class="dir-wa-btn">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path></svg>
                                Chat WA
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- FORM & PHOTO SPLIT SECTION (CONNECTED TO DATABASE) -->
    <section class="contact-split-section container">
        <div class="row align-items-center">
            
            <!-- PHOTO GALLERY WITH OVERLAY -->
            <div class="col-lg-5 mb-5 mb-lg-0 fade-up-element">
                <div class="contact-image-wrapper">
                    <!-- New Professional Corporate Hospital Reception Photo -->
                    <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=1000&q=80" alt="Patient Experience Center">
                    <div class="image-overlay-box">
                        <h5>Patient Experience Center (PEC)</h5>
                        <p style="margin: 0; font-size: 0.95rem; color: var(--text-muted);">Di PEC, kami merancang pelayanan layaknya hotel bintang lima. Mulai dari penjemputan, pendaftaran, hingga konsultasi medis, kami menjamin privasi dan kenyamanan tanpa kompromi.</p>
                    </div>
                </div>
            </div>

            <!-- INTERACTIVE FORM CONNECTED TO DATABASE -->
            <div class="col-lg-7 fade-up-element" style="transition-delay: 0.2s;">
                <div class="contact-form-wrapper">
                    <h2>Ada yang bisa kami bantu?</h2>
                    <p>Silakan isi formulir di bawah ini. Pesan Anda akan langsung tersimpan di sistem kami, dan tim terkait akan menghubungi Anda kembali maksimal dalam 1x24 jam.</p>
                    
                    <?php if(!empty($status_msg)): ?>
                        <div style="padding: 15px; border-radius: 8px; margin-bottom: 20px; 
                            background: <?= $status_type === 'success' ? '#d1fae5' : '#fee2e2' ?>; 
                            color: <?= $status_type === 'success' ? '#065f46' : '#991b1b' ?>; 
                            border: 1px solid <?= $status_type === 'success' ? '#34d399' : '#f87171' ?>;">
                            <?= $status_msg ?>
                        </div>
                    <?php endif; ?>

                    <!-- Formulir POST ke halaman ini sendiri -->
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" id="name" name="name" placeholder=" " required>
                                    <label for="name">Nama Lengkap</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" id="phone" name="phone" placeholder=" " required>
                                    <label for="phone">Nomor Telepon / WhatsApp</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-floating">
                            <input type="email" id="email" name="email" placeholder=" " required>
                            <label for="email">Alamat Email Aktif</label>
                        </div>

                        <div class="form-floating">
                            <select id="category" name="category" required>
                                <option value="" disabled selected hidden></option>
                                <option value="Info Pendaftaran">Pertanyaan Umum / Info Pendaftaran</option>
                                <option value="Tanya Dokter">Tanya Dokter / Spesialis</option>
                                <option value="Saran & Keluhan">Saran & Keluhan Layanan</option>
                                <option value="Asuransi">Bantuan Klaim Asuransi</option>
                            </select>
                            <label for="category">Kategori Pesan</label>
                        </div>
                        
                        <div class="form-floating">
                            <textarea id="message" name="message" placeholder=" " required></textarea>
                            <label for="message">Detail Pesan Anda</label>
                        </div>
                        
                        <button type="submit" name="submit_contact" class="btn-submit">
                            <span>Kirim Pesan (Simpan ke DB)</span>
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </section>

    <!-- TRANSPORTATION GUIDE SECTION -->
    <section class="transport-section" id="transport">
        <div class="container fade-up-element">
            <div class="transport-box">
                <div class="transport-content">
                    <h2 style="color: white; margin-bottom: 30px;">Akses Transportasi & Parkir</h2>
                    
                    <div class="transport-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 12h20"></path><path d="M12 2v20"></path><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect></svg>
                        <div>
                            <h4 style="color: white; margin-bottom: 5px; font-size: 1.1rem;">Fasilitas Parkir Gedung (Valet)</h4>
                            <p style="color: rgba(255,255,255,0.8); font-size: 0.95rem; margin:0;">Gedung parkir 5 lantai tersedia dengan fasilitas valet khusus untuk pasien dan lansia di lobi utama. Biaya parkir maksimal Rp50.000,-/hari bagi penunggu pasien rawat inap.</p>
                        </div>
                    </div>
                    
                    <div class="transport-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22V8"></path><path d="M5 12H2a10 10 0 0 0 20 0h-3"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <div>
                            <h4 style="color: white; margin-bottom: 5px; font-size: 1.1rem;">Transportasi Publik (MRT / TransJakarta)</h4>
                            <p style="color: rgba(255,255,255,0.8); font-size: 0.95rem; margin:0;">Rumah sakit kami hanya berjarak 200 meter dari Stasiun MRT Istora Mandiri dan Halte TransJakarta Polda Metro Jaya. Tersedia fasilitas pedestrian yang nyaman.</p>
                        </div>
                    </div>

                    <div class="transport-item">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline></svg>
                        <div>
                            <h4 style="color: white; margin-bottom: 5px; font-size: 1.1rem;">Penjemputan Bandara (Pasien Internasional)</h4>
                            <p style="color: rgba(255,255,255,0.8); font-size: 0.95rem; margin:0;">Kami memfasilitasi antar-jemput bandara (Soekarno-Hatta) secara gratis untuk pasien yang melakukan prosedur operasi/rawat inap terjadwal. Harap konfirmasi H-3 sebelum keberangkatan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ ACCORDION SECTION -->
    <section class="faq-section">
        <div class="container fade-up-element">
            <div class="text-center mb-5">
                <h6 style="color: var(--secondary-color); font-weight: 700; letter-spacing: 1px; text-transform: uppercase;">FAQ</h6>
                <h2>Pertanyaan yang Sering Diajukan</h2>
            </div>
            
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    
                    <div class="faq-item" onclick="toggleFaq(this)">
                        <div class="faq-question">
                            Bagaimana cara mendaftar untuk Paket Medical Check-Up (MCU)?
                            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                        <div class="faq-answer">
                            <p class="pt-2">Pendaftaran MCU wajib dilakukan minimal H-2 sebelum kedatangan untuk memastikan kuota dokter spesialis. Anda harus berpuasa 10-12 jam sebelum pengambilan darah. Silakan chat via WhatsApp atau telepon ke Ext. 110 untuk melihat daftar harga paket (Basic, Executive, hingga Premium Genomic).</p>
                        </div>
                    </div>

                    <div class="faq-item" onclick="toggleFaq(this)">
                        <div class="faq-question">
                            Apakah saya bisa mendaftar rawat jalan secara online?
                            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                        <div class="faq-answer">
                            <p class="pt-2">Tentu bisa. Anda dapat melakukan pendaftaran dan memilih jadwal dokter secara langsung melalui menu <strong>Buat Janji (Book Appointment)</strong> di website ini, selambat-lambatnya H-1 sebelum jadwal periksa.</p>
                        </div>
                    </div>

                    <div class="faq-item" onclick="toggleFaq(this)">
                        <div class="faq-question">
                            Apa saja syarat dan dokumen yang harus dibawa untuk rawat inap?
                            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                        <div class="faq-answer">
                            <p class="pt-2">Untuk keperluan pendaftaran rawat inap, harap membawa <strong>KTP/Paspor asli</strong>, <strong>Surat Rujukan Dokter (jika ada)</strong>, dan <strong>Kartu Asuransi Pribadi/Perusahaan</strong>. Untuk pasien dengan penjaminan perusahaan (Company Guarantee), harap melampirkan Surat Jaminan (Guarantee Letter) yang sah.</p>
                        </div>
                    </div>

                    <div class="faq-item" onclick="toggleFaq(this)">
                        <div class="faq-question">
                            Asuransi apa saja yang diterima di rumah sakit ini?
                            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                        <div class="faq-answer">
                            <p class="pt-2">Kami bermitra dengan lebih dari 50 penyedia asuransi swasta nasional dan internasional ternama (AdMedika, Prudential, Allianz, Manulife, Bupa, dsb). Silakan hubungi <strong>Pusat Asuransi & Klaim</strong> kami untuk verifikasi pertanggungan detail polis (inpatient/outpatient) Anda.</p>
                        </div>
                    </div>

                    <div class="faq-item" onclick="toggleFaq(this)">
                        <div class="faq-question">
                            Bagaimana jam besuk / aturan mengunjungi pasien rawat inap?
                            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                        <div class="faq-answer">
                            <p class="pt-2">Jam besuk dibagi menjadi dua sesi: <strong>Pagi (10:00 - 12:00)</strong> dan <strong>Sore (17:00 - 19:00)</strong>. Maksimal pengunjung di dalam ruangan adalah 2 orang secara bergantian. Anak di bawah usia 12 tahun tidak diperkenankan masuk ke area perawatan intensif (ICU/NICU/PICU).</p>
                        </div>
                    </div>

                    <div class="faq-item" onclick="toggleFaq(this)">
                        <div class="faq-question">
                            Apakah tersedia layanan Telekonsultasi (Tanya Dokter via Video Call)?
                            <svg class="faq-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </div>
                        <div class="faq-answer">
                            <p class="pt-2">Ya, kami melayani Telekonsultasi eksklusif dengan dokter spesialis kami. Obat yang diresepkan pasca-telekonsultasi akan diantarkan langsung ke rumah Anda di hari yang sama (khusus area Jabodetabek). Silakan lakukan pendaftaran via menu Telemedicine.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>

<script>
    // FAQ Accordion Interactivity
    function toggleFaq(element) {
        document.querySelectorAll('.faq-item').forEach(item => {
            if (item !== element) item.classList.remove('active');
        });
        element.classList.toggle('active');
    }

    // Scroll Animation Observer (Fade Up)
    document.addEventListener("DOMContentLoaded", function() {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: "0px 0px -50px 0px" });

        document.querySelectorAll('.fade-up-element').forEach(el => observer.observe(el));
    });
</script>
