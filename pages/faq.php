<?php
// pages/faq.php
?>
<div class="container page-wrapper" style="max-width: 900px; margin: 40px auto; padding: 0 20px;">
    
    <!-- Hero Header -->
    <div class="page-header" style="text-align: center; margin-bottom: 40px; background: linear-gradient(135deg, #0b2541, #1e3a8a); color: white; padding: 45px 20px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);">
        <span style="background: rgba(255,255,255,0.15); padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 10px;">Bantuan & Panduan Layanan</span>
        <h1 style="color: white; font-size: 32px; font-weight: 800; margin-bottom: 12px;">Pertanyaan yang Sering Diajukan (FAQ)</h1>
        <p style="color: #cbd5e1; font-size: 15px; max-width: 600px; margin: 0 auto; line-height: 1.6;">
            Temukan jawaban cepat atas pertanyaan seputar janji temu dokter, pendaftaran pasien, asuransi kesehatan, antrean digital, dan hasil laboratorium.
        </p>
    </div>

    <!-- Search Box -->
    <div style="margin-bottom: 35px;">
        <div style="position: relative; max-width: 600px; margin: 0 auto;">
            <input type="text" id="faqSearch" onkeyup="searchFAQ()" placeholder="Ketik kata kunci (misal: booking, bpjs, lab, antrean)..." style="width: 100%; padding: 14px 20px 14px 45px; border-radius: 50px; border: 1px solid #cbd5e1; font-size: 15px; outline: none; box-shadow: 0 4px 10px rgba(0,0,0,0.03);">
            <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 18px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 16px;"></i>
        </div>
    </div>

    <!-- Accordion FAQ List -->
    <div id="faqContainer" style="display: flex; flex-direction: column; gap: 14px;">
        
        <!-- FAQ 1 -->
        <div class="faq-item" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
            <button onclick="toggleFaq(this)" style="width: 100%; text-align: left; background: none; border: none; padding: 20px 24px; font-size: 16px; font-weight: 700; color: #0f172a; display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                <span><i class="fa-solid fa-calendar-check" style="color: #0d6efd; margin-right: 10px;"></i> Bagaimana cara membuat janji temu (booking) dokter?</span>
                <i class="fa-solid fa-chevron-down faq-icon" style="color: #64748b; transition: transform 0.3s;"></i>
            </button>
            <div class="faq-answer" style="display: none; padding: 0 24px 20px; color: #475569; font-size: 14px; line-height: 1.7; border-top: 1px solid #f1f5f9;">
                Anda dapat membuat janji temu dengan mudah melalui menu <strong>Buat Janji</strong> di bagian atas website atau melalui <strong>Dashboard Pasien</strong>. Cukup pilih dokter spesialis, poliklinik, dan tanggal yang diinginkan, kemudian sistem akan secara otomatis menerbitkan Kode Booking dan Nomor Antrean Anda.
            </div>
        </div>

        <!-- FAQ 2 -->
        <div class="faq-item" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
            <button onclick="toggleFaq(this)" style="width: 100%; text-align: left; background: none; border: none; padding: 20px 24px; font-size: 16px; font-weight: 700; color: #0f172a; display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                <span><i class="fa-solid fa-id-card" style="color: #10b981; margin-right: 10px;"></i> Apakah saya perlu membawa dokumen fisik saat hari kunjungan?</span>
                <i class="fa-solid fa-chevron-down faq-icon" style="color: #64748b; transition: transform 0.3s;"></i>
            </button>
            <div class="faq-answer" style="display: none; padding: 0 24px 20px; color: #475569; font-size: 14px; line-height: 1.7; border-top: 1px solid #f1f5f9;">
                Pasien hanya perlu menunjukkan <strong>Kode Booking / Barcode</strong> yang tertera pada aplikasi atau kartu identitas (KTP/NIK). Seluruh riwayat medis rekam medis elektronik (EMR) Anda sudah terintegrasi secara digital dalam sistem rumah sakit kami.
            </div>
        </div>

        <!-- FAQ 3 -->
        <div class="faq-item" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
            <button onclick="toggleFaq(this)" style="width: 100%; text-align: left; background: none; border: none; padding: 20px 24px; font-size: 16px; font-weight: 700; color: #0f172a; display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                <span><i class="fa-solid fa-shield-halved" style="color: #f59e0b; margin-right: 10px;"></i> Apakah rumah sakit menerima asuransi swasta dan BPJS Kesehatan?</span>
                <i class="fa-solid fa-chevron-down faq-icon" style="color: #64748b; transition: transform 0.3s;"></i>
            </button>
            <div class="faq-answer" style="display: none; padding: 0 24px 20px; color: #475569; font-size: 14px; line-height: 1.7; border-top: 1px solid #f1f5f9;">
                Ya, kami bekerja sama dengan lebih dari 45 perusahaan asuransi nasional & multinasional serta melayani rujukan BPJS Kesehatan untuk poli rawat jalan dan rawat inap. Anda dapat melakukan verifikasi nomor polis atau rujukan langsung di loket pendaftaran petugas RS.
            </div>
        </div>

        <!-- FAQ 4 -->
        <div class="faq-item" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
            <button onclick="toggleFaq(this)" style="width: 100%; text-align: left; background: none; border: none; padding: 20px 24px; font-size: 16px; font-weight: 700; color: #0f172a; display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                <span><i class="fa-solid fa-flask" style="color: #8b5cf6; margin-right: 10px;"></i> Berapa lama hasil pemeriksaan laboratorium & radiologi keluar?</span>
                <i class="fa-solid fa-chevron-down faq-icon" style="color: #64748b; transition: transform 0.3s;"></i>
            </button>
            <div class="faq-answer" style="display: none; padding: 0 24px 20px; color: #475569; font-size: 14px; line-height: 1.7; border-top: 1px solid #f1f5f9;">
                Pemeriksaan laboratorium rutin (seperti Darah Lengkap, Glukosa, Urin) selesai dalam 1-2 jam. Hasil radiologi (Rontgen, USG, CT-Scan) dibaca oleh Dokter Spesialis Radiologi dalam 2-4 jam. Anda dapat mengunduh salinan berkas PDF langsung di portal pasien Anda kapan saja.
            </div>
        </div>

        <!-- FAQ 5 -->
        <div class="faq-item" style="background: white; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 6px rgba(0,0,0,0.03);">
            <button onclick="toggleFaq(this)" style="width: 100%; text-align: left; background: none; border: none; padding: 20px 24px; font-size: 16px; font-weight: 700; color: #0f172a; display: flex; justify-content: space-between; align-items: center; cursor: pointer;">
                <span><i class="fa-solid fa-truck-medical" style="color: #ef4444; margin-right: 10px;"></i> Bagaimana cara memesan layanan gawat darurat & ambulans 24 jam?</span>
                <i class="fa-solid fa-chevron-down faq-icon" style="color: #64748b; transition: transform 0.3s;"></i>
            </button>
            <div class="faq-answer" style="display: none; padding: 0 24px 20px; color: #475569; font-size: 14px; line-height: 1.7; border-top: 1px solid #f1f5f9;">
                Untuk keadaan darurat, Anda dapat langsung menghubungi Hotline Emergency kami di nomor <strong>1-500-911</strong> atau WhatsApp Siaga di <strong>0811-999-888</strong>. Tim medis darurat dan ambulans berfasilitas ICU lengkap siap diberangkatkan ke lokasi Anda.
            </div>
        </div>

    </div>

    <!-- Need More Help Banner -->
    <div style="margin-top: 50px; background: white; border-radius: 16px; padding: 30px; text-align: center; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
        <h3 style="color: #0f172a; font-size: 20px; font-weight: 800; margin-bottom: 8px;">Tidak Menemukan Jawaban yang Dicari?</h3>
        <p style="color: #64748b; font-size: 14px; margin-bottom: 20px;">Customer Service kami selalu siap membantu Anda 24 jam setiap hari.</p>
        <div style="display: flex; justify-content: center; gap: 15px; flex-wrap: wrap;">
            <a href="index.php?page=contact" class="btn btn-primary" style="padding: 10px 24px; border-radius: 8px; font-size: 14px;"><i class="fa-solid fa-envelope"></i> Kirim Pesan Pertanyaan</a>
            <a href="https://wa.me/62811999888" target="_blank" class="btn" style="background: #15803d; color: white; padding: 10px 24px; border-radius: 8px; font-size: 14px; text-decoration: none; font-weight: 600;"><i class="fa-brands fa-whatsapp"></i> Chat WhatsApp 24 Jam</a>
        </div>
    </div>

</div>

<script>
    function toggleFaq(btn) {
        const answer = btn.nextElementSibling;
        const icon = btn.querySelector('.faq-icon');
        const isOpen = answer.style.display === 'block';

        if (isOpen) {
            answer.style.display = 'none';
            icon.style.transform = 'rotate(0deg)';
        } else {
            answer.style.display = 'block';
            icon.style.transform = 'rotate(180deg)';
        }
    }

    function searchFAQ() {
        const query = document.getElementById('faqSearch').value.toLowerCase();
        const items = document.querySelectorAll('.faq-item');

        items.forEach(item => {
            const text = item.innerText.toLowerCase();
            if (text.includes(query)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });
    }
</script>
