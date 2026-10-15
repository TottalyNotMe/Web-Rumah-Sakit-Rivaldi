<?php
// Untuk memastikan CSS selalu terpanggil dengan benar di server lokal Anda terlepas dari URL routing
$css_file = __DIR__ . '/../assets/css/about.css';
?>
<!-- Menyertakan CSS secara langsung agar 100% tersambung tanpa error path -->
<style>
    <?php if(file_exists($css_file)) include $css_file; ?>
</style>

<div class="about-page-container">

    <!-- 1. HERO BANNER -->
    <section class="about-hero-section">
        <div class="container">
            <h1>Rumah Sakit Internasional Sehat Selalu</h1>
            <p>Pusat rujukan medis terdepan di Asia Tenggara. Kami menggabungkan teknologi mutakhir dengan empati dan dedikasi penuh untuk kesembuhan Anda.</p>
        </div>
    </section>

    <!-- 2. DIRECTOR MESSAGE -->
    <section class="director-section container">
        <div class="director-card">
            <div class="director-img"></div>
            <div class="director-text">
                <h6>Sambutan Direktur Utama</h6>
                <h3>"Keselamatan Pasien Adalah Prioritas Mutlak Kami"</h3>
                <p class="mt-4" style="color: var(--text-muted); font-size: 1.1rem; text-align: justify;">
                    Sejak didirikan pada tahun 2005, Rumah Sakit Sehat Selalu terus berkomitmen untuk memberikan pelayanan kesehatan berkualitas global. Kami menyadari bahwa kesehatan adalah aset terbesar manusia, oleh karena itu kami terus berinvestasi pada talenta medis terbaik dan teknologi terbaru. 
                </p>
                <p style="color: var(--text-muted); font-size: 1.1rem; text-align: justify;">
                    Kepercayaan jutaan pasien yang telah kami layani menjadi pendorong semangat kami untuk tidak pernah berhenti berinovasi. Selamat datang di Rumah Sakit Sehat Selalu, tempat di mana sains dan kepedulian bertemu.
                </p>
                <div class="mt-4">
                    <h5 style="margin-bottom: 0;">Prof. Dr. dr. Budi Santoso, Sp.B(K)</h5>
                    <span style="color: var(--text-muted);">Direktur Utama & CEO</span>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. VISION & MISSION -->
    <section class="vm-section">
        <div class="container">
            <h2>Arah Strategis Kami</h2>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="vm-card">
                        <div class="vm-icon">
                            <!-- Eye / Vision Icon -->
                            <svg class="svg-icon svg-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </div>
                        <h3 style="color: white;">Visi Kami</h3>
                        <p style="color: #cbd5e1; font-size: 1.1rem; text-align: justify;">
                            Menjadi penyedia layanan kesehatan bertaraf internasional yang memadukan teknologi medis mutakhir dengan sentuhan kemanusiaan, diakui secara global atas keunggulan klinis dan keselamatan pasien.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="vm-card">
                        <div class="vm-icon">
                            <!-- Target / Mission Icon -->
                            <svg class="svg-icon svg-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="6"></circle><circle cx="12" cy="12" r="2"></circle></svg>
                        </div>
                        <h3 style="color: white;">Misi Kami</h3>
                        <ul style="color: #cbd5e1; font-size: 1.05rem; padding-left: 20px;">
                            <li class="mb-2">Menyelenggarakan layanan berstandar <strong>JCI</strong> dan <strong>WHO</strong>.</li>
                            <li class="mb-2">Mengintegrasikan riset dan inovasi genomik ke dalam praktik klinis.</li>
                            <li class="mb-2">Mengembangkan sumber daya manusia medis yang kompeten dan empatik.</li>
                            <li>Memberikan pengalaman holistik dan tanpa batas bagi pasien domestik maupun internasional.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. CORE VALUES -->
    <section class="values-section container">
        <h6 style="color: var(--secondary-color); font-weight: 700; letter-spacing: 1px;">CORE VALUES</h6>
        <h2 class="mb-5">Nilai-Nilai Dasar Kami (C.A.R.E)</h2>
        <div class="row">
            <div class="col-md-3 col-6 value-item">
                <div class="value-icon">
                    <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                </div>
                <h4>Compassion</h4>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Melayani setiap pasien dengan penuh empati, kepedulian, dan kehangatan layaknya keluarga.</p>
            </div>
            <div class="col-md-3 col-6 value-item">
                <div class="value-icon">
                    <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                </div>
                <h4>Accountability</h4>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Bertanggung jawab penuh atas setiap tindakan medis, menjunjung tinggi transparansi dan etika.</p>
            </div>
            <div class="col-md-3 col-6 value-item">
                <div class="value-icon">
                    <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                </div>
                <h4>Respect</h4>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Menghargai keberagaman, latar belakang, dan privasi setiap pasien tanpa diskriminasi.</p>
            </div>
            <div class="col-md-3 col-6 value-item">
                <div class="value-icon">
                    <svg viewBox="0 0 24 24" width="40" height="40" fill="none" stroke="currentColor" stroke-width="2"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon></svg>
                </div>
                <h4>Excellence</h4>
                <p style="color: var(--text-muted); font-size: 0.95rem;">Berkomitmen memberikan kualitas layanan medis terbaik yang melampaui ekspektasi global.</p>
            </div>
        </div>
    </section>

    <!-- 5. FACILITIES -->
    <section class="facilities-section">
        <div class="container">
            <h6 style="color: var(--secondary-color); font-weight: 700; letter-spacing: 1px; text-align: center;">INFRASTRUKTUR</h6>
            <h2 class="mb-5 text-center">Fasilitas Medis Center of Excellence</h2>
            <div class="facility-grid">
                
                <div class="fac-card">
                    <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="fac-img" alt="Operasi">
                    <div class="fac-body">
                        <h4>Smart Operating Theater</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem; margin:0;">Dilengkapi sistem navigasi bedah robotik, integrasi C-Arm 3D, dan aliran udara steril bertekanan positif tinggi.</p>
                    </div>
                </div>

                <div class="fac-card">
                    <img src="https://images.unsplash.com/photo-1530497610245-94d3c16cda28?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="fac-img" alt="Lab">
                    <div class="fac-body">
                        <h4>Laboratorium Genomik Terpadu</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem; margin:0;">Pusat riset dan diagnostik molekuler untuk mendeteksi DNA mutasi kanker dan penyakit langka secara dini.</p>
                    </div>
                </div>

                <div class="fac-card">
                    <img src="https://images.unsplash.com/photo-1519494080410-f9aa76cb4283?auto=format&fit=crop&w=800&q=80" class="fac-img" alt="ICU">
                    <div class="fac-body">
                        <h4>ICU / NICU Berstandar Level IV</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem; margin:0;">Unit perawatan intensif terlengkap dengan tele-monitoring tersentralisasi 24 jam penuh untuk observasi kritis.</p>
                    </div>
                </div>

                <div class="fac-card">
                    <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="fac-img" alt="Kamar">
                    <div class="fac-body">
                        <h4>Suite Rawat Inap Premium</h4>
                        <p style="color: var(--text-muted); font-size: 0.95rem; margin:0;">Fasilitas kamar VVIP dengan desain arsitektur <em>healing environment</em>, smart room control, dan layanan privat.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 6. STATS & ACCREDITATIONS -->
    <section class="stats-section">
        <div class="container">
            <div style="display: flex; flex-wrap: wrap; justify-content: space-around; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 50px; margin-bottom: 50px; width: 100%;">
                <div style="flex: 1; min-width: 150px; margin-bottom: 20px; text-align: center;">
                    <div style="display: flex; justify-content: center; align-items: baseline;">
                        <div class="stat-num counter" data-target="25">0</div>
                    </div>
                    <div class="stat-label">Tahun Mengabdi</div>
                </div>
                <div style="flex: 1; min-width: 150px; margin-bottom: 20px; text-align: center;">
                    <div style="display: flex; justify-content: center; align-items: baseline;">
                        <div class="stat-num counter" data-target="450">0</div>
                        <div class="stat-num" style="margin-left: 5px;">+</div>
                    </div>
                    <div class="stat-label">Dokter Konsultan</div>
                </div>
                <div style="flex: 1; min-width: 150px; margin-bottom: 20px; text-align: center;">
                    <div style="display: flex; justify-content: center; align-items: baseline;">
                        <div class="stat-num counter" data-target="60">0</div>
                        <div class="stat-num" style="margin-left: 5px;">+</div>
                    </div>
                    <div class="stat-label">Negara Asal Pasien</div>
                </div>
                <div style="flex: 1; min-width: 150px; margin-bottom: 20px; text-align: center;">
                    <div style="display: flex; justify-content: center; align-items: baseline;">
                        <div class="stat-num counter" data-target="150">0</div>
                        <div class="stat-num" style="margin-left: 5px;">K</div>
                    </div>
                    <div class="stat-label">Pasien Tertangani</div>
                </div>
            </div>

            <!-- Accreditations purely HTML/SVG no images -->
            <h4 style="color: white; margin-bottom: 30px; text-align: center;">Telah Memenuhi Standar Keselamatan Medis Tertinggi</h4>
            <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 50px;">
                <div style="text-align: center;">
                    <svg viewBox="0 0 24 24" width="40" height="40" stroke="currentColor" fill="none" stroke-width="1.5"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                    <div style="font-size: 0.85rem; margin-top:5px; color:#cbd5e1;">JCI Gold Seal</div>
                </div>
                <div style="text-align: center;">
                    <svg viewBox="0 0 24 24" width="40" height="40" stroke="currentColor" fill="none" stroke-width="1.5"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line></svg>
                    <div style="font-size: 0.85rem; margin-top:5px; color:#cbd5e1;">ISO 9001:2015</div>
                </div>
                <div style="text-align: center;">
                    <svg viewBox="0 0 24 24" width="40" height="40" stroke="currentColor" fill="none" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><line x1="8" y1="21" x2="16" y2="21"></line><line x1="12" y1="17" x2="12" y2="21"></line></svg>
                    <div style="font-size: 0.85rem; margin-top:5px; color:#cbd5e1;">HIMSS EMRAM</div>
                </div>
                <div style="text-align: center;">
                    <svg viewBox="0 0 24 24" width="40" height="40" stroke="currentColor" fill="none" stroke-width="1.5"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                    <div style="font-size: 0.85rem; margin-top:5px; color:#cbd5e1;">WHO Partner</div>
                </div>
            </div>
        </div>
    </section>

</div>

<script>
    // Vanilla JS Counter Animation using IntersectionObserver
    document.addEventListener("DOMContentLoaded", function() {
        const counters = document.querySelectorAll('.counter');
        const speed = 100;
        let animated = false;

        const animateCounters = () => {
            if(animated) return;
            animated = true;
            counters.forEach(counter => {
                const target = +counter.getAttribute('data-target');
                const updateCount = () => {
                    const count = +counter.innerText;
                    const inc = target / speed;

                    if (count < target) {
                        counter.innerText = Math.ceil(count + inc);
                        setTimeout(updateCount, 20);
                    } else {
                        counter.innerText = target;
                    }
                };
                updateCount();
            });
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.disconnect();
                }
            });
        }, { threshold: 0.3 }); // Trigger when 30% of the section is visible

        const statsSection = document.querySelector('.stats-section');
        if (statsSection) {
            observer.observe(statsSection);
        }
    });
</script>
