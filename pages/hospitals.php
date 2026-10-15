<?php
// pages/hospitals.php
?>
<div class="container page-wrapper" style="max-width: 1140px; margin: 40px auto; padding: 0 20px;">
    
    <!-- Hero / Header -->
    <div class="page-header" style="text-align: center; margin-bottom: 45px; background: linear-gradient(135deg, #0b2541, #1e3a8a); color: white; padding: 50px 20px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);">
        <span style="background: rgba(255,255,255,0.15); padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 10px;">Jaringan Layanan Terpadu</span>
        <h1 style="color: white; font-size: 36px; font-weight: 800; margin-bottom: 15px;">Cabang & Jaringan Rumah Sakit Kami</h1>
        <p style="color: #cbd5e1; font-size: 16px; max-width: 680px; margin: 0 auto; line-height: 1.6;">
            Hadir di berbagai kota strategis di Indonesia dengan fasilitas kedokteran terkini, tim medis berstandar internasional, dan layanan darurat 24 jam.
        </p>
    </div>

    <!-- Filter Lokasi Kota -->
    <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 35px; flex-wrap: wrap;">
        <button class="hosp-filter-btn active" onclick="filterHosp('all', this)" style="border: none; padding: 8px 20px; border-radius: 20px; font-weight: 600; cursor: pointer; background: #0b2541; color: white;">Semua Cabang</button>
        <button class="hosp-filter-btn" onclick="filterHosp('jakarta', this)" style="border: 1px solid #cbd5e1; padding: 8px 20px; border-radius: 20px; font-weight: 600; cursor: pointer; background: white; color: #475569;">Jabodetabek</button>
        <button class="hosp-filter-btn" onclick="filterHosp('surabaya', this)" style="border: 1px solid #cbd5e1; padding: 8px 20px; border-radius: 20px; font-weight: 600; cursor: pointer; background: white; color: #475569;">Jawa Timur</button>
        <button class="hosp-filter-btn" onclick="filterHosp('medan', this)" style="border: 1px solid #cbd5e1; padding: 8px 20px; border-radius: 20px; font-weight: 600; cursor: pointer; background: white; color: #475569;">Sumatera</button>
        <button class="hosp-filter-btn" onclick="filterHosp('bali', this)" style="border: 1px solid #cbd5e1; padding: 8px 20px; border-radius: 20px; font-weight: 600; cursor: pointer; background: white; color: #475569;">Bali & Nusa Tenggara</button>
    </div>

    <!-- Grid Rumah Sakit -->
    <div id="hospGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 28px;">
        
        <!-- Cabang 1: Jakarta Pusat (Pusat) -->
        <div class="hosp-card" data-region="jakarta" style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="height: 200px; position: relative; overflow: hidden;">
                <img src="https://images.unsplash.com/photo-1586773860418-d37222d8fce3?auto=format&fit=crop&w=600&q=80" alt="RS Jakarta" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 12px; left: 12px; background: #0b2541; color: white; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Pusat Rujukan Utama</span>
            </div>
            <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                <h3 style="font-size: 20px; color: #0f172a; font-weight: 800; margin-bottom: 8px;">IHIS Hospital SCBD Jakarta</h3>
                <p style="color: #64748b; font-size: 14px; margin-bottom: 15px; display: flex; align-items: flex-start; gap: 8px;">
                    <i class="fa-solid fa-location-dot" style="color: #ef4444; margin-top: 3px;"></i>
                    <span>Jl. Jend. Sudirman Kav. 52-53, Kawasan SCBD Lot 11, Jakarta Selatan</span>
                </p>
                
                <div style="margin-bottom: 20px; font-size: 13px; color: #475569; display: flex; flex-direction: column; gap: 6px; background: #f8fafc; padding: 12px; border-radius: 8px;">
                    <div><i class="fa-solid fa-phone" style="color: #0d6efd; width: 18px;"></i> <strong>Call Center:</strong> (021) 2999-8800</div>
                    <div><i class="fa-solid fa-truck-medical" style="color: #ef4444; width: 18px;"></i> <strong>IGD 24 Jam:</strong> 1-500-911</div>
                    <div><i class="fa-solid fa-bed-pulse" style="color: #10b981; width: 18px;"></i> <strong>Kapasitas:</strong> 350 Tempat Tidur / 40 ICU</div>
                </div>

                <div style="margin-top: auto; display: flex; gap: 10px;">
                    <a href="index.php?page=book_appointment" class="btn btn-primary" style="flex: 1; text-align: center; font-size: 13px; padding: 10px 0;">Buat Janji</a>
                    <a href="https://maps.google.com" target="_blank" class="btn btn-light" style="font-size: 13px; padding: 10px 14px;"><i class="fa-solid fa-map-location-dot"></i> Maps</a>
                </div>
            </div>
        </div>

        <!-- Cabang 2: Surabaya Barat -->
        <div class="hosp-card" data-region="surabaya" style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="height: 200px; position: relative; overflow: hidden;">
                <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?auto=format&fit=crop&w=600&q=80" alt="RS Surabaya" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 12px; left: 12px; background: #059669; color: white; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Akreditasi JCI</span>
            </div>
            <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                <h3 style="font-size: 20px; color: #0f172a; font-weight: 800; margin-bottom: 8px;">IHIS Hospital Darmo Surabaya</h3>
                <p style="color: #64748b; font-size: 14px; margin-bottom: 15px; display: flex; align-items: flex-start; gap: 8px;">
                    <i class="fa-solid fa-location-dot" style="color: #ef4444; margin-top: 3px;"></i>
                    <span>Jl. Raya Darmo No. 88, Wonokromo, Surabaya, Jawa Timur</span>
                </p>
                
                <div style="margin-bottom: 20px; font-size: 13px; color: #475569; display: flex; flex-direction: column; gap: 6px; background: #f8fafc; padding: 12px; border-radius: 8px;">
                    <div><i class="fa-solid fa-phone" style="color: #0d6efd; width: 18px;"></i> <strong>Call Center:</strong> (031) 5678-900</div>
                    <div><i class="fa-solid fa-truck-medical" style="color: #ef4444; width: 18px;"></i> <strong>IGD 24 Jam:</strong> 1-500-911</div>
                    <div><i class="fa-solid fa-bed-pulse" style="color: #10b981; width: 18px;"></i> <strong>Kapasitas:</strong> 220 Tempat Tidur / 25 ICU</div>
                </div>

                <div style="margin-top: auto; display: flex; gap: 10px;">
                    <a href="index.php?page=book_appointment" class="btn btn-primary" style="flex: 1; text-align: center; font-size: 13px; padding: 10px 0;">Buat Janji</a>
                    <a href="https://maps.google.com" target="_blank" class="btn btn-light" style="font-size: 13px; padding: 10px 14px;"><i class="fa-solid fa-map-location-dot"></i> Maps</a>
                </div>
            </div>
        </div>

        <!-- Cabang 3: Medan -->
        <div class="hosp-card" data-region="medan" style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="height: 200px; position: relative; overflow: hidden;">
                <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=600&q=80" alt="RS Medan" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 12px; left: 12px; background: #0284c7; color: white; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Pusat Jantung Sumatera</span>
            </div>
            <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                <h3 style="font-size: 20px; color: #0f172a; font-weight: 800; margin-bottom: 8px;">IHIS Hospital Medan Petisah</h3>
                <p style="color: #64748b; font-size: 14px; margin-bottom: 15px; display: flex; align-items: flex-start; gap: 8px;">
                    <i class="fa-solid fa-location-dot" style="color: #ef4444; margin-top: 3px;"></i>
                    <span>Jl. Imam Bonjol No. 9, Petisah Tengah, Medan, Sumatera Utara</span>
                </p>
                
                <div style="margin-bottom: 20px; font-size: 13px; color: #475569; display: flex; flex-direction: column; gap: 6px; background: #f8fafc; padding: 12px; border-radius: 8px;">
                    <div><i class="fa-solid fa-phone" style="color: #0d6efd; width: 18px;"></i> <strong>Call Center:</strong> (061) 4567-890</div>
                    <div><i class="fa-solid fa-truck-medical" style="color: #ef4444; width: 18px;"></i> <strong>IGD 24 Jam:</strong> 1-500-911</div>
                    <div><i class="fa-solid fa-bed-pulse" style="color: #10b981; width: 18px;"></i> <strong>Kapasitas:</strong> 200 Tempat Tidur / 20 ICU</div>
                </div>

                <div style="margin-top: auto; display: flex; gap: 10px;">
                    <a href="index.php?page=book_appointment" class="btn btn-primary" style="flex: 1; text-align: center; font-size: 13px; padding: 10px 0;">Buat Janji</a>
                    <a href="https://maps.google.com" target="_blank" class="btn btn-light" style="font-size: 13px; padding: 10px 14px;"><i class="fa-solid fa-map-location-dot"></i> Maps</a>
                </div>
            </div>
        </div>

        <!-- Cabang 4: Bali -->
        <div class="hosp-card" data-region="bali" style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="height: 200px; position: relative; overflow: hidden;">
                <img src="https://images.unsplash.com/photo-1512678080530-7760d81faba6?auto=format&fit=crop&w=600&q=80" alt="RS Bali" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 12px; left: 12px; background: #e11d48; color: white; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Medical Tourism Hub</span>
            </div>
            <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                <h3 style="font-size: 20px; color: #0f172a; font-weight: 800; margin-bottom: 8px;">IHIS Hospital Sunset Road Bali</h3>
                <p style="color: #64748b; font-size: 14px; margin-bottom: 15px; display: flex; align-items: flex-start; gap: 8px;">
                    <i class="fa-solid fa-location-dot" style="color: #ef4444; margin-top: 3px;"></i>
                    <span>Jl. Sunset Road No. 818, Kuta, Badung, Bali</span>
                </p>
                
                <div style="margin-bottom: 20px; font-size: 13px; color: #475569; display: flex; flex-direction: column; gap: 6px; background: #f8fafc; padding: 12px; border-radius: 8px;">
                    <div><i class="fa-solid fa-phone" style="color: #0d6efd; width: 18px;"></i> <strong>Call Center:</strong> (0361) 779-900</div>
                    <div><i class="fa-solid fa-truck-medical" style="color: #ef4444; width: 18px;"></i> <strong>IGD 24 Jam:</strong> 1-500-911</div>
                    <div><i class="fa-solid fa-bed-pulse" style="color: #10b981; width: 18px;"></i> <strong>Kapasitas:</strong> 180 Tempat Tidur / Layanan Multilingual</div>
                </div>

                <div style="margin-top: auto; display: flex; gap: 10px;">
                    <a href="index.php?page=book_appointment" class="btn btn-primary" style="flex: 1; text-align: center; font-size: 13px; padding: 10px 0;">Buat Janji</a>
                    <a href="https://maps.google.com" target="_blank" class="btn btn-light" style="font-size: 13px; padding: 10px 14px;"><i class="fa-solid fa-map-location-dot"></i> Maps</a>
                </div>
            </div>
        </div>

    </div>

</div>

<script>
    function filterHosp(region, btn) {
        const cards = document.querySelectorAll('.hosp-card');
        const buttons = document.querySelectorAll('.hosp-filter-btn');

        buttons.forEach(b => {
            b.style.background = 'white';
            b.style.color = '#475569';
            b.style.border = '1px solid #cbd5e1';
        });

        btn.style.background = '#0b2541';
        btn.style.color = 'white';
        btn.style.border = 'none';

        cards.forEach(card => {
            const reg = card.getAttribute('data-region');
            if (region === 'all' || reg === region) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
