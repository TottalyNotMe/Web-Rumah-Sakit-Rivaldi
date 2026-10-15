<?php
require_once __DIR__ . '/../config/database.php';

// CSS inclusion
$css_file = __DIR__ . '/../assets/css/careers.css';
?>
<style>
    <?php if(file_exists($css_file)) include $css_file; ?>
    .filter-bar-custom {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #ffffff;
        padding: 16px 24px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }
    .filter-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .filter-btn {
        background: #f1f5f9;
        border: 1px solid #cbd5e1;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        color: #475569;
        cursor: pointer;
        transition: all 0.2s;
    }
    .filter-btn:hover, .filter-btn.active {
        background: var(--primary-color, #0b2541);
        color: #ffffff;
        border-color: var(--primary-color, #0b2541);
    }
    .job-counter-badge {
        background: #e0f2fe;
        color: #0369a1;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 700;
    }
</style>

<div class="careers-page-container">
    <!-- HERO SECTION -->
    <section class="careers-hero">
        <div class="container fade-up-element visible">
            <div class="hero-text-content">
                <h6 style="color: #38bdf8; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;">Bergabunglah dengan Tim Kami</h6>
                <h1>Karir Medis & Non‑Medis Unggulan</h1>
                <p>Rumah Sakit kami berkomitmen pada standar internasional JCI, teknologi kedokteran terkini, serta jenjang karir yang inklusif dan berkelanjutan. Temukan posisi impian Anda sekarang.</p>
                <a href="#jobs" class="btn-submit" style="display: inline-block; padding: 14px 40px; font-size: 1.1rem; background: #0d6efd; color: #fff; border-radius: 50px; text-decoration: none; font-weight: 700; box-shadow: 0 10px 20px rgba(0,0,0,0.3);">Lihat 8 Lowongan Tersedia</a>
            </div>
        </div>
    </section>

    <!-- WHY JOIN US -->
    <section class="why-join-section">
        <div class="container fade-up-element">
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fa-solid fa-hospital" style="font-size: 28px; color: #0d6efd;"></i>
                        </div>
                        <h4>Fasilitas Terkini</h4>
                        <p>Laboratorium robotik, radiologi digital 3 Tesla, dan kamar operasi hybrid berstandar internasional.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fa-solid fa-graduation-cap" style="font-size: 28px; color: #0d6efd;"></i>
                        </div>
                        <h4>Pengembangan Karir</h4>
                        <p>Program fellowship dokter spesialis, sertifikasi internasional, dan beasiswa pendidikan lanjut.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fa-solid fa-heart-pulse" style="font-size: 28px; color: #0d6efd;"></i>
                        </div>
                        <h4>Kesejahteraan Unggul</h4>
                        <p>Asuransi kesehatan menyeluruh untuk keluarga, tunjangan kinerja, dan program work-life balance.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="fa-solid fa-users" style="font-size: 28px; color: #0d6efd;"></i>
                        </div>
                        <h4>Budaya Kolaboratif</h4>
                        <p>Bekerja dalam tim multidisiplin yang saling mendukung keselamatan pasien secara profesional.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CATEGORIES SECTION -->
    <section class="categories-section">
        <div class="container fade-up-element">
            <h2 class="text-center" style="color: #ffffff; margin-bottom: 40px;">Departemen Terbuka</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="category-box">
                        <i class="fa-solid fa-user-doctor" style="font-size: 38px; color: #38bdf8; margin-bottom: 15px;"></i>
                        <h4>Medis Klinis</h4>
                        <p>Dokter Spesialis Jantung, Bedah, Anak, Penyakit Dalam, dan Umum.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="category-box">
                        <i class="fa-solid fa-flask-vial" style="font-size: 38px; color: #38bdf8; margin-bottom: 15px;"></i>
                        <h4>Penunjang Medis</h4>
                        <p>Apoteker Klinis, Radiografer CT-Scan/MRI, Analis Laboratorium, Fisioterapis.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="category-box">
                        <i class="fa-solid fa-user-nurse" style="font-size: 38px; color: #38bdf8; margin-bottom: 15px;"></i>
                        <h4>Keperawatan</h4>
                        <p>Perawat Pelaksana ICU/ICCU, Kamar Operasi (OK), IGD, dan Rawat Inap VIP.</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="category-box">
                        <i class="fa-solid fa-laptop-code" style="font-size: 38px; color: #38bdf8; margin-bottom: 15px;"></i>
                        <h4>IT & Manajemen</h4>
                        <p>Fullstack Engineer EMR, Customer Service Frontdesk, Finance & Rekam Medis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- JOB BOARD SECTION -->
    <section class="jobs-section" id="jobs">
        <div class="container fade-up-element">
            <h2 class="text-center mb-3" style="color: var(--primary-color);">Lowongan Karir Terbuka</h2>
            <p class="text-center text-muted mb-4">Pilih kategori atau langsung lamar secara online melalui kanal resmi kami.</p>

            <div class="filter-bar-custom">
                <div class="filter-buttons">
                    <button class="filter-btn active" onclick="filterJobs('all')">Semua Posisi</button>
                    <button class="filter-btn" onclick="filterJobs('medis')">Medis Spesialis</button>
                    <button class="filter-btn" onclick="filterJobs('keperawatan')">Keperawatan</button>
                    <button class="filter-btn" onclick="filterJobs('penunjang')">Penunjang Medis</button>
                    <button class="filter-btn" onclick="filterJobs('manajemen')">IT & Operasional</button>
                </div>
                <div class="job-counter-badge" id="jobCounter">Menampilkan 8 Lowongan</div>
            </div>

            <div id="jobList">
                <!-- 1. Medis -->
                <div class="job-card" data-category="medis">
                    <div class="job-details">
                        <h3>Dokter Spesialis Kardiologi & Jantung (Full‑Time)</h3>
                        <div class="job-meta">
                            <span><i class="fa-solid fa-hospital"></i> Siloam Heart Center</span>
                            <span><i class="fa-solid fa-location-dot"></i> Jakarta Pusat (Pusat)</span>
                            <span><i class="fa-solid fa-clock"></i> Full-Time</span>
                            <span><i class="fa-solid fa-briefcase"></i> Pengalaman min. 3 Tahun</span>
                        </div>
                        <p style="color: #64748b; font-size: 0.95rem; margin-top: 5px;">Bertanggung jawab menangani diagnosis kardiovaskular, kateterisasi, dan intervensi jantung koroner.</p>
                    </div>
                    <div class="job-action">
                        <a href="https://wa.me/62811999888?text=Halo%20HRD,%20saya%20ingin%20melamar%20posisi%20Dokter%20Spesialis%20Kardiologi" target="_blank" class="btn-apply"><i class="fa-brands fa-whatsapp"></i> Lamar via WA</a>
                    </div>
                </div>

                <!-- 2. Medis -->
                <div class="job-card" data-category="medis">
                    <div class="job-details">
                        <h3>Dokter Spesialis Anak (Pediatri)</h3>
                        <div class="job-meta">
                            <span><i class="fa-solid fa-hospital"></i> Poliklinik Anak & Tumbuh Kembang</span>
                            <span><i class="fa-solid fa-location-dot"></i> Surabaya Barat</span>
                            <span><i class="fa-solid fa-clock"></i> Part-Time / Shift</span>
                            <span><i class="fa-solid fa-briefcase"></i> Memiliki STR & SIP Aktif</span>
                        </div>
                        <p style="color: #64748b; font-size: 0.95rem; margin-top: 5px;">Memberikan konsultasi tumbuh kembang anak, vaksinasi menyeluruh, dan rawat inap anak terpadu.</p>
                    </div>
                    <div class="job-action">
                        <a href="https://wa.me/62811999888?text=Halo%20HRD,%20saya%20ingin%20melamar%20posisi%20Dokter%20Spesialis%20Anak" target="_blank" class="btn-apply"><i class="fa-brands fa-whatsapp"></i> Lamar via WA</a>
                    </div>
                </div>

                <!-- 3. Keperawatan -->
                <div class="job-card" data-category="keperawatan">
                    <div class="job-details">
                        <h3>Perawat Ruang ICU & ICCU (Shift)</h3>
                        <div class="job-meta">
                            <span><i class="fa-solid fa-hospital"></i> Departemen Critical Care</span>
                            <span><i class="fa-solid fa-location-dot"></i> Jakarta Pusat & Surabaya</span>
                            <span><i class="fa-solid fa-clock"></i> 3 Shift Operasional</span>
                            <span><i class="fa-solid fa-certificate"></i> Memiliki Sertifikat ACLS / BTCLS</span>
                        </div>
                        <p style="color: #64748b; font-size: 0.95rem; margin-top: 5px;">Melakukan pemantauan intensif tanda vital pasien kritis, ventilasi mekanik, dan pemberian obat emergensi.</p>
                    </div>
                    <div class="job-action">
                        <a href="https://wa.me/62811999888?text=Halo%20HRD,%20saya%20ingin%20melamar%20posisi%20Perawat%20ICU" target="_blank" class="btn-apply"><i class="fa-brands fa-whatsapp"></i> Lamar via WA</a>
                    </div>
                </div>

                <!-- 4. Keperawatan -->
                <div class="job-card" data-category="keperawatan">
                    <div class="job-details">
                        <h3>Perawat Kamar Bedah / Instrumentator (OK)</h3>
                        <div class="job-meta">
                            <span><i class="fa-solid fa-hospital"></i> Central Operating Theatre</span>
                            <span><i class="fa-solid fa-location-dot"></i> Jakarta Pusat</span>
                            <span><i class="fa-solid fa-clock"></i> Full-Time</span>
                            <span><i class="fa-solid fa-briefcase"></i> D3/S1 Keperawatan + Sertifikat Bedah</span>
                        </div>
                        <p style="color: #64748b; font-size: 0.95rem; margin-top: 5px;">Mempersiapkan instrumen bedah steril, asisten dokter operator, dan sterilisasi alat medis.</p>
                    </div>
                    <div class="job-action">
                        <a href="https://wa.me/62811999888?text=Halo%20HRD,%20saya%20ingin%20melamar%20posisi%20Perawat%20Bedah" target="_blank" class="btn-apply"><i class="fa-brands fa-whatsapp"></i> Lamar via WA</a>
                    </div>
                </div>

                <!-- 5. Penunjang Medis -->
                <div class="job-card" data-category="penunjang">
                    <div class="job-details">
                        <h3>Apoteker Klinis & Farmasi Rawat Inap</h3>
                        <div class="job-meta">
                            <span><i class="fa-solid fa-hospital"></i> Instalasi Farmasi RS</span>
                            <span><i class="fa-solid fa-location-dot"></i> Bali & Jakarta</span>
                            <span><i class="fa-solid fa-clock"></i> Full-Time</span>
                            <span><i class="fa-solid fa-certificate"></i> Memiliki STRA Aktif</span>
                        </div>
                        <p style="color: #64748b; font-size: 0.95rem; margin-top: 5px;">Melakukan telaah resep dokter, rekonsiliasi obat, dispensing resep, dan konseling pasien pulang.</p>
                    </div>
                    <div class="job-action">
                        <a href="https://wa.me/62811999888?text=Halo%20HRD,%20saya%20ingin%20melamar%20posisi%20Apoteker%20Klinis" target="_blank" class="btn-apply"><i class="fa-brands fa-whatsapp"></i> Lamar via WA</a>
                    </div>
                </div>

                <!-- 6. Penunjang Medis -->
                <div class="job-card" data-category="penunjang">
                    <div class="job-details">
                        <h3>Radiografer (CT-Scan & MRI)</h3>
                        <div class="job-meta">
                            <span><i class="fa-solid fa-hospital"></i> Instalasi Radiologi & Diagnostik</span>
                            <span><i class="fa-solid fa-location-dot"></i> Medan & Surabaya</span>
                            <span><i class="fa-solid fa-clock"></i> Full-Time</span>
                            <span><i class="fa-solid fa-briefcase"></i> D3/D4 Radiologi</span>
                        </div>
                        <p style="color: #64748b; font-size: 0.95rem; margin-top: 5px;">Mengoperasikan modalitas canggih MRI 3.0T, CT-Scan 128 Slices, dan foto rontgen digital.</p>
                    </div>
                    <div class="job-action">
                        <a href="https://wa.me/62811999888?text=Halo%20HRD,%20saya%20ingin%20melamar%20posisi%20Radiografer" target="_blank" class="btn-apply"><i class="fa-brands fa-whatsapp"></i> Lamar via WA</a>
                    </div>
                </div>

                <!-- 7. Manajemen & IT -->
                <div class="job-card" data-category="manajemen">
                    <div class="job-details">
                        <h3>Senior Hospital Information System (HIS) Developer</h3>
                        <div class="job-meta">
                            <span><i class="fa-solid fa-laptop-code"></i> Departemen IT & Digital Health</span>
                            <span><i class="fa-solid fa-location-dot"></i> Head Office Jakarta</span>
                            <span><i class="fa-solid fa-clock"></i> Hybrid</span>
                            <span><i class="fa-solid fa-briefcase"></i> PHP, REST API, HL7/FHIR, MySQL</span>
                        </div>
                        <p style="color: #64748b; font-size: 0.95rem; margin-top: 5px;">Mengembangkan sistem rekam medis elektronik EMR terintegrasi, bridge SATUSEHAT Kemenkes, dan portal pasien.</p>
                    </div>
                    <div class="job-action">
                        <a href="https://wa.me/62811999888?text=Halo%20HRD,%20saya%20ingin%20melamar%20posisi%20HIS%20Developer" target="_blank" class="btn-apply"><i class="fa-brands fa-whatsapp"></i> Lamar via WA</a>
                    </div>
                </div>

                <!-- 8. Manajemen & Operasional -->
                <div class="job-card" data-category="manajemen">
                    <div class="job-details">
                        <h3>Customer Service & Patient Relations Officer</h3>
                        <div class="job-meta">
                            <span><i class="fa-solid fa-headset"></i> Layanan Pasien & Admission</span>
                            <span><i class="fa-solid fa-location-dot"></i> Jakarta Pusat</span>
                            <span><i class="fa-solid fa-clock"></i> Full-Time</span>
                            <span><i class="fa-solid fa-language"></i> Komunikasi Bahasa Inggris Aktif</span>
                        </div>
                        <p style="color: #64748b; font-size: 0.95rem; margin-top: 5px;">Menyambut pasien VIP, mengurus registrasi rawat inap, koordinasi klaim asuransi kesehatan, dan penanganan keluhan.</p>
                    </div>
                    <div class="job-action">
                        <a href="https://wa.me/62811999888?text=Halo%20HRD,%20saya%20ingin%20melamar%20posisi%20Customer%20Service" target="_blank" class="btn-apply"><i class="fa-brands fa-whatsapp"></i> Lamar via WA</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- HIRING PROCESS SECTION -->
    <section class="process-section">
        <div class="container fade-up-element">
            <h2 class="text-center mb-5" style="color: var(--primary-color);">Tahapan Proses Rekrutmen</h2>
            <div class="timeline-row">
                <div class="timeline-step">
                    <div class="timeline-icon"><i class="fa-solid fa-file-lines"></i></div>
                    <h5>1. Seleksi Berkas</h5>
                    <p>Pemeriksaan kualifikasi CV, STR/SIP, dan portofolio kandidat.</p>
                </div>
                <div class="timeline-step">
                    <div class="timeline-icon"><i class="fa-solid fa-comments"></i></div>
                    <h5>2. Wawancara HR & User</h5>
                    <p>Diskusi kompetensi, nilai-nilai etika medis, dan budaya rumah sakit.</p>
                </div>
                <div class="timeline-step">
                    <div class="timeline-icon"><i class="fa-solid fa-stethoscope"></i></div>
                    <h5>3. Uji Klinis / Teknis</h5>
                    <p>Tes keterampilan praktek penanganan medis atau studi kasus kerja.</p>
                </div>
                <div class="timeline-step">
                    <div class="timeline-icon"><i class="fa-solid fa-heart-pulse"></i></div>
                    <h5>4. Medical Check-Up</h5>
                    <p>Pemeriksaan kesehatan menyeluruh di RS kami secara gratis.</p>
                </div>
                <div class="timeline-step">
                    <div class="timeline-icon"><i class="fa-solid fa-handshake"></i></div>
                    <h5>5. Offering & Orientasi</h5>
                    <p>Penawaran kompensasi resmi dan pelatihan induksi karyawan baru.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL SECTION -->
    <section class="testimonial-section">
        <div class="container fade-up-element">
            <h2 class="text-center mb-5" style="color: var(--primary-color);">Suara Rekan Sejawat Kami</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="testi-card">
                        <p class="testi-text">"Bekerja di rumah sakit ini memberikan saya kesempatan menggunakan fasilitas Cath Lab tercanggih di Indonesia. Budaya saling menghargai antara dokter dan perawat sangat terasa."</p>
                        <div class="testi-author">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=150&q=80" alt="Dr. Siti">
                            <div>
                                <strong>dr. Siti Rahmawati, Sp.JP</strong><br>
                                <small style="color: #64748b;">Spesialis Jantung & Pembuluh Darah</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testi-card">
                        <p class="testi-text">"Saya mengawali karir sebagai perawat pelaksana, dan dengan beasiswa pelatihan dari manajemen, kini saya dipercaya menjadi Kepala Unit Perawatan Kritis ICU."</p>
                        <div class="testi-author">
                            <img src="https://images.unsplash.com/photo-1582750433449-648ed127bb54?auto=format&fit=crop&w=150&q=80" alt="Ns. Budi">
                            <div>
                                <strong>Ns. Budi Pratama, S.Kep</strong><br>
                                <small style="color: #64748b;">Kepala Ruang ICU & Kamar Bedah</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="testi-card">
                        <p class="testi-text">"Sistem kerja IT teratur dan modern, didukung infrastruktur digital yang matang. Kami benar-benar melihat dampak nyata teknologi yang kami buat terhadap keselamatan pasien."</p>
                        <div class="testi-author">
                            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=150&q=80" alt="Rina">
                            <div>
                                <strong>Rina Septiani, S.Kom</strong><br>
                                <small style="color: #64748b;">Healthcare System Architect</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FRAUD ALERT -->
    <section class="fraud-alert fade-up-element" style="background: #fef2f2; border-left: 5px solid #ef4444; padding: 25px 30px; margin: 40px auto; max-width: 1000px; border-radius: 8px; display: flex; align-items: center; gap: 20px;">
        <i class="fa-solid fa-triangle-exclamation" style="font-size: 36px; color: #ef4444;"></i>
        <p style="margin: 0; color: #991b1b; font-size: 15px;"><strong>Pemberitahuan Waspada Penipuan:</strong> Rumah Sakit kami tidak pernah memungut biaya apapun (tiket akomodasi, biaya tes, seragam, dsb) dalam seluruh proses rekrutmen. Seluruh komunikasi resmi hanya melalui kanal kontak HRD kami.</p>
    </section>
</div>

<script>
    function filterJobs(category) {
        const cards = document.querySelectorAll('.job-card');
        const buttons = document.querySelectorAll('.filter-btn');
        let count = 0;

        buttons.forEach(btn => btn.classList.remove('active'));
        if (event && event.target) {
            event.target.classList.add('active');
        }

        cards.forEach(card => {
            const cat = card.getAttribute('data-category');
            if (category === 'all' || cat === category) {
                card.style.display = 'flex';
                count++;
            } else {
                card.style.display = 'none';
            }
        });

        document.getElementById('jobCounter').innerText = 'Menampilkan ' + count + ' Lowongan';
    }

    // Scroll fade-in effect
    document.addEventListener("DOMContentLoaded", function(){
        const observer = new IntersectionObserver((entries)=>{
            entries.forEach(entry=>{ if(entry.isIntersecting){ entry.target.classList.add('visible'); observer.unobserve(entry.target);} });
        },{threshold:0.1, rootMargin:"0px 0px -50px 0px"});
        document.querySelectorAll('.fade-up-element').forEach(el=>observer.observe(el));
    });
</script>
