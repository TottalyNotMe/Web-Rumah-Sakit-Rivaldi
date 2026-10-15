<?php
// pages/promo.php
?>
<div class="container page-wrapper" style="max-width: 1140px; margin: 40px auto; padding: 0 20px;">
    
    <!-- Hero / Header -->
    <div class="page-header" style="text-align: center; margin-bottom: 45px; background: linear-gradient(135deg, #065f46, #059669); color: white; padding: 50px 20px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);">
        <span style="background: rgba(255,255,255,0.2); padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 12px;">Penawaran Spesial & Paket Sehat</span>
        <h1 style="color: white; font-size: 36px; font-weight: 800; margin-bottom: 15px;">Paket Medical Check-Up & Promo Layanan</h1>
        <p style="color: #d1fae5; font-size: 16px; max-width: 680px; margin: 0 auto; line-height: 1.6;">
            Deteksi dini adalah kunci pencegahan penyakit. Dapatkan potongan harga eksklusif untuk paket pemeriksaan kesehatan menyeluruh dan promo klinik spesialis.
        </p>
    </div>

    <!-- Promo Highlight Banner -->
    <div style="background: linear-gradient(135deg, #fef3c7, #fde68a); border: 2px solid #f59e0b; border-radius: 16px; padding: 25px 30px; margin-bottom: 40px; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
        <div style="display: flex; align-items: center; gap: 20px;">
            <div style="width: 60px; height: 60px; background: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 26px; flex-shrink: 0;">
                <i class="fa-solid fa-gift"></i>
            </div>
            <div>
                <h3 style="color: #92400e; font-size: 20px; font-weight: 800; margin-bottom: 4px;">Diskon Hari Kesehatan Nasional s/d 40%</h3>
                <p style="color: #b45309; font-size: 14px; margin: 0;">Gunakan kode voucher promo <strong>SEHAT2026</strong> saat registrasi atau pembayaran di kasir rumah sakit.</p>
            </div>
        </div>
        <a href="index.php?page=book_appointment" class="btn" style="background: #b45309; color: white; border-radius: 8px; padding: 12px 24px; font-weight: 700; text-decoration: none;">Klaim Promo</a>
    </div>

    <!-- Grid Paket Promo MCU -->
    <h2 style="color: #0f172a; font-size: 26px; font-weight: 800; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-notes-medical" style="color: #059669;"></i> Pilihan Paket Medical Check-Up (MCU)
    </h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 28px; margin-bottom: 50px;">
        
        <!-- Paket 1: Basic -->
        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                <span style="background: #e0f2fe; color: #0369a1; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Paket Esensial</span>
                <span style="color: #ef4444; font-weight: 700; font-size: 13px;">Hemat 25%</span>
            </div>
            <h3 style="font-size: 22px; color: #0f172a; font-weight: 800; margin-bottom: 8px;">MCU Basic Sehat</h3>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">Pemeriksaan kesehatan dasar untuk skrining tahunan usia produktif.</p>
            
            <div style="margin-bottom: 20px;">
                <span style="text-decoration: line-through; color: #94a3b8; font-size: 14px;">Rp 650.000</span><br>
                <span style="font-size: 28px; font-weight: 800; color: #059669;">Rp 487.500</span>
            </div>

            <ul style="list-style: none; padding: 0; margin: 0 0 25px; flex-grow: 1; font-size: 14px; color: #334155;">
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Pemeriksaan Dokter Umum</li>
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Darah Lengkap (CBC 14 Parameter)</li>
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Glukosa Puasa (Gula Darah)</li>
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Profil Lemak (Kolesterol Total)</li>
                <li style="padding: 8px 0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Rontgen Thorax Digital</li>
            </ul>

            <a href="index.php?page=book_appointment" class="btn btn-primary" style="width: 100%; text-align: center; border-radius: 8px; padding: 12px 0;">Pesan Paket Ini</a>
        </div>

        <!-- Paket 2: Jantung (Popular) -->
        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); border: 2px solid #059669; display: flex; flex-direction: column; position: relative;">
            <div style="position: absolute; top: -13px; left: 50%; transform: translateX(-50%); background: #059669; color: white; font-size: 11px; font-weight: 800; padding: 4px 16px; border-radius: 20px; text-transform: uppercase;">Paling Diminati</div>
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                <span style="background: #fef2f2; color: #dc2626; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Jantung Sehat</span>
                <span style="color: #ef4444; font-weight: 700; font-size: 13px;">Hemat 35%</span>
            </div>
            <h3 style="font-size: 22px; color: #0f172a; font-weight: 800; margin-bottom: 8px;">MCU Skrining Kardio</h3>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">Dirancang khusus untuk memantau ritme dan elastisitas arteri jantung.</p>
            
            <div style="margin-bottom: 20px;">
                <span style="text-decoration: line-through; color: #94a3b8; font-size: 14px;">Rp 2.100.000</span><br>
                <span style="font-size: 28px; font-weight: 800; color: #059669;">Rp 1.365.000</span>
            </div>

            <ul style="list-style: none; padding: 0; margin: 0 0 25px; flex-grow: 1; font-size: 14px; color: #334155;">
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Konsultasi Dokter Spesialis Jantung</li>
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Rekam Jantung EKG 12 Lead</li>
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Profil Lipid Lengkap (HDL, LDL, Trigliserida)</li>
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Tes Treadmill Elektrokardiogram</li>
                <li style="padding: 8px 0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Laporan Resume Medis Eksklusif</li>
            </ul>

            <a href="index.php?page=book_appointment" class="btn" style="background: #059669; color: white; width: 100%; text-align: center; border-radius: 8px; padding: 12px 0; font-weight: 700; text-decoration: none;">Pesan Paket Ini</a>
        </div>

        <!-- Paket 3: Platinum Executive -->
        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 15px;">
                <span style="background: #f3e8ff; color: #7e22ce; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">Komprehensif VIP</span>
                <span style="color: #ef4444; font-weight: 700; font-size: 13px;">Hemat 30%</span>
            </div>
            <h3 style="font-size: 22px; color: #0f172a; font-weight: 800; margin-bottom: 8px;">MCU Executive VIP</h3>
            <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">Pemeriksaan organ vital total mencakup USG Abdomen & Tumor Marker.</p>
            
            <div style="margin-bottom: 20px;">
                <span style="text-decoration: line-through; color: #94a3b8; font-size: 14px;">Rp 4.500.000</span><br>
                <span style="font-size: 28px; font-weight: 800; color: #059669;">Rp 3.150.000</span>
            </div>

            <ul style="list-style: none; padding: 0; margin: 0 0 25px; flex-grow: 1; font-size: 14px; color: #334155;">
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Pemeriksaan Sp. Penyakit Dalam & Sp. Mata</li>
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> USG Abdomen Lengkap (Hati, Empedu, Ginjal)</li>
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Tumor Marker (CEA, AFP)</li>
                <li style="padding: 8px 0; border-bottom: 1px dashed #e2e8f0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Fungsi Ginjal (Ureum, Kreatinin, Asam Urat)</li>
                <li style="padding: 8px 0;"><i class="fa-solid fa-check text-success" style="color:#10b981; margin-right:8px;"></i> Fasilitas Ruang Tunggu VIP & Makan Siang</li>
            </ul>

            <a href="index.php?page=book_appointment" class="btn btn-primary" style="width: 100%; text-align: center; border-radius: 8px; padding: 12px 0;">Pesan Paket Ini</a>
        </div>

    </div>

    <!-- Informasi Syarat & Ketentuan -->
    <div style="background: #f8fafc; border-radius: 12px; padding: 25px; border: 1px solid #e2e8f0;">
        <h4 style="font-size: 16px; color: #0f172a; font-weight: 700; margin-bottom: 10px;"><i class="fa-solid fa-circle-info" style="color: #0284c7;"></i> Syarat dan Ketentuan Promo MCU:</h4>
        <ul style="margin: 0; padding-left: 20px; color: #64748b; font-size: 14px; line-height: 1.8;">
            <li>Pasien diwajibkan berpuasa 10-12 jam sebelum pengambilan sampel darah (hanya diperkenankan air mineral).</li>
            <li>Promo berlaku setiap hari kerja (Senin - Sabtu) pukul 07.30 - 12.00 WIB.</li>
            <li>Hasil pemeriksaan laboratorium tersedia dalam waktu 1x24 jam dan dapat diakses langsung pada menu <strong>Hasil Lab</strong> di Patient Portal.</li>
            <li>Pemesanan dapat dilakukan maksimal 1 hari sebelum jadwal kedatangan.</li>
        </ul>
    </div>

</div>
