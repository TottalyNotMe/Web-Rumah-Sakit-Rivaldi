<?php
// pages/articles.php
?>
<div class="container page-wrapper" style="max-width: 1140px; margin: 40px auto; padding: 0 20px;">
    
    <!-- Hero / Header -->
    <div class="page-header" style="text-align: center; margin-bottom: 45px; background: linear-gradient(135deg, #0b2541, #1e40af); color: white; padding: 50px 20px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);">
        <span style="background: rgba(255,255,255,0.15); padding: 6px 16px; border-radius: 20px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 12px;">Pusat Edukasi & Informasi Medis</span>
        <h1 style="color: white; font-size: 36px; font-weight: 800; margin-bottom: 15px;">Artikel & Tips Kesehatan Terpercaya</h1>
        <p style="color: #cbd5e1; font-size: 16px; max-width: 680px; margin: 0 auto; line-height: 1.6;">
            Disusun dan ditinjau langsung oleh dokter spesialis kami untuk memberikan panduan hidup sehat, pencegahan penyakit, dan inovasi medis terkini.
        </p>
    </div>

    <!-- Filter Kategori Artikel -->
    <div style="display: flex; justify-content: center; gap: 10px; margin-bottom: 35px; flex-wrap: wrap;">
        <button class="filter-article-btn active" onclick="filterArticles('all', this)" style="border: none; padding: 8px 18px; border-radius: 20px; font-weight: 600; cursor: pointer; background: #0b2541; color: white;">Semua Topik</button>
        <button class="filter-article-btn" onclick="filterArticles('jantung', this)" style="border: 1px solid #cbd5e1; padding: 8px 18px; border-radius: 20px; font-weight: 600; cursor: pointer; background: white; color: #475569;">Jantung & Vaskular</button>
        <button class="filter-article-btn" onclick="filterArticles('anak', this)" style="border: 1px solid #cbd5e1; padding: 8px 18px; border-radius: 20px; font-weight: 600; cursor: pointer; background: white; color: #475569;">Kesehatan Anak</button>
        <button class="filter-article-btn" onclick="filterArticles('nutrisi', this)" style="border: 1px solid #cbd5e1; padding: 8px 18px; border-radius: 20px; font-weight: 600; cursor: pointer; background: white; color: #475569;">Gizi & Nutrisi</button>
        <button class="filter-article-btn" onclick="filterArticles('gaya_hidup', this)" style="border: 1px solid #cbd5e1; padding: 8px 18px; border-radius: 20px; font-weight: 600; cursor: pointer; background: white; color: #475569;">Gaya Hidup Sehat</button>
    </div>

    <!-- Grid Artikel -->
    <div class="articles-grid" id="articleList" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 28px;">
        
        <!-- Artikel 1 -->
        <div class="article-card" data-cat="jantung" style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="position: relative; height: 200px; overflow: hidden;">
                <img src="https://images.unsplash.com/photo-1628348068343-c6a848d2b6dd?auto=format&fit=crop&w=600&q=80" alt="Jantung" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 12px; left: 12px; background: #e11d48; color: white; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Jantung</span>
            </div>
            <div style="padding: 22px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="font-size: 12px; color: #64748b; margin-bottom: 8px; display: flex; align-items: center; gap: 12px;">
                    <span><i class="fa-regular fa-calendar"></i> 14 Okt 2026</span>
                    <span><i class="fa-solid fa-user-doctor"></i> Ditinjau dr. Budi Santoso</span>
                </div>
                <h3 style="font-size: 19px; color: #0f172a; font-weight: 700; line-height: 1.4; margin-bottom: 12px;">5 Gejala Awal Serangan Jantung yang Sering Diabaikan</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Nyeri dada bukan satu-satunya tanda bahaya. Ketahui gejala tersembunyi seperti sesak nafas tiba-tiba, keringat dingin, dan nyeri punggung...
                </p>
                <a href="javascript:void(0)" onclick="alert('Membuka detail artikel: 5 Gejala Awal Serangan Jantung')" style="display: inline-flex; align-items: center; gap: 6px; color: #0d6efd; font-weight: 700; font-size: 14px; text-decoration: none;">
                    Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Artikel 2 -->
        <div class="article-card" data-cat="anak" style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="position: relative; height: 200px; overflow: hidden;">
                <img src="https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?auto=format&fit=crop&w=600&q=80" alt="Anak" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 12px; left: 12px; background: #0284c7; color: white; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Anak</span>
            </div>
            <div style="padding: 22px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="font-size: 12px; color: #64748b; margin-bottom: 8px; display: flex; align-items: center; gap: 12px;">
                    <span><i class="fa-regular fa-calendar"></i> 10 Okt 2026</span>
                    <span><i class="fa-solid fa-user-doctor"></i> Ditinjau dr. Siti Aminah</span>
                </div>
                <h3 style="font-size: 19px; color: #0f172a; font-weight: 700; line-height: 1.4; margin-bottom: 12px;">Jadwal Imunisasi Dasar Lengkap untuk Bayi & Balita</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Panduan komprehensif bagi orang tua mengenai vaksinasi wajib mulai dari Hepatitis B, BCG, DPT, hingga MMR demi perlindungan buah hati...
                </p>
                <a href="javascript:void(0)" onclick="alert('Membuka detail artikel: Jadwal Imunisasi Dasar Lengkap')" style="display: inline-flex; align-items: center; gap: 6px; color: #0d6efd; font-weight: 700; font-size: 14px; text-decoration: none;">
                    Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Artikel 3 -->
        <div class="article-card" data-cat="nutrisi" style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="position: relative; height: 200px; overflow: hidden;">
                <img src="https://images.unsplash.com/photo-1490645935967-10de6ba17061?auto=format&fit=crop&w=600&q=80" alt="Nutrisi" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 12px; left: 12px; background: #16a34a; color: white; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Gizi</span>
            </div>
            <div style="padding: 22px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="font-size: 12px; color: #64748b; margin-bottom: 8px; display: flex; align-items: center; gap: 12px;">
                    <span><i class="fa-regular fa-calendar"></i> 05 Okt 2026</span>
                    <span><i class="fa-solid fa-user-doctor"></i> Tim Nutrisi RS</span>
                </div>
                <h3 style="font-size: 19px; color: #0f172a; font-weight: 700; line-height: 1.4; margin-bottom: 12px;">Pola Makan Rendah Indeks Glikemik bagi Pasien Diabetes</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Mengatur asupan karbohidrat kompleks, serat sayuran, serta protein seimbang dapat menjaga stabilitas kadar gula darah harian Anda...
                </p>
                <a href="javascript:void(0)" onclick="alert('Membuka detail artikel: Pola Makan Pasien Diabetes')" style="display: inline-flex; align-items: center; gap: 6px; color: #0d6efd; font-weight: 700; font-size: 14px; text-decoration: none;">
                    Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Artikel 4 -->
        <div class="article-card" data-cat="gaya_hidup" style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="position: relative; height: 200px; overflow: hidden;">
                <img src="https://images.unsplash.com/photo-1506126613408-eca07ce68773?auto=format&fit=crop&w=600&q=80" alt="Meditasi" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 12px; left: 12px; background: #8b5cf6; color: white; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Mental Health</span>
            </div>
            <div style="padding: 22px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="font-size: 12px; color: #64748b; margin-bottom: 8px; display: flex; align-items: center; gap: 12px;">
                    <span><i class="fa-regular fa-calendar"></i> 28 Sep 2026</span>
                    <span><i class="fa-solid fa-user-doctor"></i> Psikiater Spesialis</span>
                </div>
                <h3 style="font-size: 19px; color: #0f172a; font-weight: 700; line-height: 1.4; margin-bottom: 12px;">Manajemen Stres dan Pengaruhnya Terhadap Imunitas Fisik</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Kadar hormon kortisol yang tinggi berkepanjangan dapat melemahkan respon imunitas tubuh. Kenali langkah relaksasi praktis...
                </p>
                <a href="javascript:void(0)" onclick="alert('Membuka detail artikel: Manajemen Stres')" style="display: inline-flex; align-items: center; gap: 6px; color: #0d6efd; font-weight: 700; font-size: 14px; text-decoration: none;">
                    Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Artikel 5 -->
        <div class="article-card" data-cat="jantung" style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="position: relative; height: 200px; overflow: hidden;">
                <img src="https://images.unsplash.com/photo-1530497610245-94d3c16cda28?auto=format&fit=crop&w=600&q=80" alt="Alat Medis" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 12px; left: 12px; background: #e11d48; color: white; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Teknologi Medis</span>
            </div>
            <div style="padding: 22px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="font-size: 12px; color: #64748b; margin-bottom: 8px; display: flex; align-items: center; gap: 12px;">
                    <span><i class="fa-regular fa-calendar"></i> 20 Sep 2026</span>
                    <span><i class="fa-solid fa-user-doctor"></i> Tim Bedah Jantung</span>
                </div>
                <h3 style="font-size: 19px; color: #0f172a; font-weight: 700; line-height: 1.4; margin-bottom: 12px;">Prosedur Kateterisasi Jantung: Manfaat dan Proses Pemulihan</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Tindakan invasif minimal tanpa bedah terbuka yang mampu mendeteksi sumbatan dan memasang ring jantung dalam hitungan jam...
                </p>
                <a href="javascript:void(0)" onclick="alert('Membuka detail artikel: Kateterisasi Jantung')" style="display: inline-flex; align-items: center; gap: 6px; color: #0d6efd; font-weight: 700; font-size: 14px; text-decoration: none;">
                    Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

        <!-- Artikel 6 -->
        <div class="article-card" data-cat="gaya_hidup" style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="position: relative; height: 200px; overflow: hidden;">
                <img src="https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?auto=format&fit=crop&w=600&q=80" alt="Tidur Sehat" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; top: 12px; left: 12px; background: #8b5cf6; color: white; padding: 4px 12px; border-radius: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase;">Pola Istirahat</span>
            </div>
            <div style="padding: 22px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="font-size: 12px; color: #64748b; margin-bottom: 8px; display: flex; align-items: center; gap: 12px;">
                    <span><i class="fa-regular fa-calendar"></i> 15 Sep 2026</span>
                    <span><i class="fa-solid fa-user-doctor"></i> dr. Wijaya, Sp.N</span>
                </div>
                <h3 style="font-size: 19px; color: #0f172a; font-weight: 700; line-height: 1.4; margin-bottom: 12px;">Pentingnya Sleep Hygiene untuk Mencegah Gangguan Neurologis</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Kurang tidur kronis berkorelasi dengan risiko penurunan memori, migrain kronis, dan gangguan metabolisme tubuh...
                </p>
                <a href="javascript:void(0)" onclick="alert('Membuka detail artikel: Sleep Hygiene')" style="display: inline-flex; align-items: center; gap: 6px; color: #0d6efd; font-weight: 700; font-size: 14px; text-decoration: none;">
                    Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>

    </div>

    <!-- Newsletter Box -->
    <div style="margin-top: 60px; background: #f8fafc; border: 2px dashed #cbd5e1; border-radius: 16px; padding: 35px 25px; text-align: center;">
        <i class="fa-solid fa-envelope-open-text" style="font-size: 40px; color: #0d6efd; margin-bottom: 15px;"></i>
        <h3 style="font-size: 22px; color: #0f172a; font-weight: 700; margin-bottom: 8px;">Dapatkan Tips Kesehatan Mingguan Gratis</h3>
        <p style="color: #64748b; max-width: 500px; margin: 0 auto 20px; font-size: 14px;">Berlangganan buletin resmi kami untuk mendapatkan rangkuman artikel dan tips kesehatan langsung ke email Anda.</p>
        <form onsubmit="event.preventDefault(); alert('Terima kasih telah berlangganan buletin kesehatan!');" style="display: flex; justify-content: center; gap: 10px; max-width: 480px; margin: 0 auto; flex-wrap: wrap;">
            <input type="email" placeholder="Masukkan alamat email Anda" required style="flex: 1; min-width: 240px; padding: 12px 16px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 14px; outline: none;">
            <button type="submit" style="background: #0b2541; color: white; border: none; padding: 12px 24px; border-radius: 8px; font-weight: 700; cursor: pointer;">Langganan</button>
        </form>
    </div>

</div>

<script>
    function filterArticles(category, btn) {
        const cards = document.querySelectorAll('.article-card');
        const buttons = document.querySelectorAll('.filter-article-btn');

        buttons.forEach(b => {
            b.style.background = 'white';
            b.style.color = '#475569';
            b.style.border = '1px solid #cbd5e1';
        });

        btn.style.background = '#0b2541';
        btn.style.color = 'white';
        btn.style.border = 'none';

        cards.forEach(card => {
            const cat = card.getAttribute('data-cat');
            if (category === 'all' || cat === category) {
                card.style.display = 'flex';
            } else {
                card.style.display = 'none';
            }
        });
    }
</script>
