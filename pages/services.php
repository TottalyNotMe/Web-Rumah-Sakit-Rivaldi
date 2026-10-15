<?php
// pages/services.php
?>
<div class="container page-wrapper" style="max-width: 1140px; margin: 40px auto; padding: 0 20px;">
    
    <!-- Hero / Header -->
    <div class="page-header" style="text-align: center; margin-bottom: 45px; background: linear-gradient(135deg, #0b2541, #1e40af); color: white; padding: 50px 20px; border-radius: 16px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1);">
        <span style="background: rgba(255,255,255,0.15); padding: 5px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; display: inline-block; margin-bottom: 10px;">Standar Internasional JCI</span>
        <h1 style="color: white; font-size: 36px; font-weight: 800; margin-bottom: 15px;">Layanan Medis & Center of Excellence</h1>
        <p style="color: #cbd5e1; font-size: 16px; max-width: 680px; margin: 0 auto; line-height: 1.6;">
            Didukung oleh peralatan medis termutakhir dan tim dokter subspesialis lintas-disiplin untuk memberikan penanganan tuntas pada kasus-kasus klinis kompleks.
        </p>
    </div>

    <!-- Center of Excellence Grid -->
    <h2 style="color: #0f172a; font-size: 26px; font-weight: 800; margin-bottom: 25px; display: flex; align-items: center; gap: 10px;">
        <i class="fa-solid fa-award" style="color: #0d6efd;"></i> Pusat Keunggulan Medis (Center of Excellence)
    </h2>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 28px; margin-bottom: 60px;">
        
        <!-- 1. Jantung -->
        <div style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="height: 190px; overflow: hidden; position: relative;">
                <img src="https://images.unsplash.com/photo-1628348068343-c6a848d2b6dd?auto=format&fit=crop&w=600&q=80" alt="Jantung" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; bottom: 12px; left: 12px; background: rgba(11,37,65,0.85); color: white; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 700;">Cath Lab 24 Jam</span>
            </div>
            <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="width: 48px; height: 48px; background: #fee2e2; color: #dc2626; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 15px;">
                    <i class="fa-solid fa-heart-pulse"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Pusat Jantung & Vaskular Terpadu</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Melayani angiografi, pemasangan stent/ring jantung, operasi bypass koroner (CABG), dan elektrofisiologi ablasi aritmia jantung secara cepat.
                </p>
                <div style="margin-top: auto; display: flex; gap: 10px;">
                    <a href="index.php?page=book_appointment" class="btn btn-primary" style="flex: 1; text-align: center; font-size: 13px;">Konsultasi Dokter</a>
                </div>
            </div>
        </div>

        <!-- 2. Onkologi / Kanker -->
        <div style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="height: 190px; overflow: hidden; position: relative;">
                <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=600&q=80" alt="Kanker" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; bottom: 12px; left: 12px; background: rgba(11,37,65,0.85); color: white; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 700;">LINAC Radiotherapy</span>
            </div>
            <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="width: 48px; height: 48px; background: #f3e8ff; color: #7e22ce; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 15px;">
                    <i class="fa-solid fa-dna"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Pusat Kanker Terpadu (Comprehensive Cancer)</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Kemoterapi terpadu dengan ruang rawat harian (day-care), terapi radiasi terarah berakurasi sub-milimeter, serta pemeriksaan imunohistokimia.
                </p>
                <div style="margin-top: auto; display: flex; gap: 10px;">
                    <a href="index.php?page=book_appointment" class="btn btn-primary" style="flex: 1; text-align: center; font-size: 13px;">Konsultasi Dokter</a>
                </div>
            </div>
        </div>

        <!-- 3. Bedah Saraf & Otak -->
        <div style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="height: 190px; overflow: hidden; position: relative;">
                <img src="https://images.unsplash.com/photo-1559757175-5700dde675bc?auto=format&fit=crop&w=600&q=80" alt="Otak" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; bottom: 12px; left: 12px; background: rgba(11,37,65,0.85); color: white; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 700;">Stroke Unit Siaga</span>
            </div>
            <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="width: 48px; height: 48px; background: #e0f2fe; color: #0284c7; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 15px;">
                    <i class="fa-solid fa-brain"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Pusat Otak & Saraf (Neuroscience Center)</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Protokol penanganan cepat Code Stroke Golden Period (< 4.5 jam), bedah mikroskopik saraf tulang belakang, dan rehabilitasi pasca stroke.
                </p>
                <div style="margin-top: auto; display: flex; gap: 10px;">
                    <a href="index.php?page=book_appointment" class="btn btn-primary" style="flex: 1; text-align: center; font-size: 13px;">Konsultasi Dokter</a>
                </div>
            </div>
        </div>

        <!-- 4. Ortopedi & Tulang -->
        <div style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="height: 190px; overflow: hidden; position: relative;">
                <img src="https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=600&q=80" alt="Tulang" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; bottom: 12px; left: 12px; background: rgba(11,37,65,0.85); color: white; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 700;">Artroskopi Minimal Invasif</span>
            </div>
            <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="width: 48px; height: 48px; background: #fef3c7; color: #d97706; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 15px;">
                    <i class="fa-solid fa-bone"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Pusat Ortopedi, Sendi & Olahraga</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Penggantian sendi lutut dan panggul (Joint Replacement), rekonstruksi cedera ligamen atlet (ACL), dan penanganan skoliosis tulang belakang.
                </p>
                <div style="margin-top: auto; display: flex; gap: 10px;">
                    <a href="index.php?page=book_appointment" class="btn btn-primary" style="flex: 1; text-align: center; font-size: 13px;">Konsultasi Dokter</a>
                </div>
            </div>
        </div>

        <!-- 5. Anak & Perinatologi -->
        <div style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="height: 190px; overflow: hidden; position: relative;">
                <img src="https://images.unsplash.com/photo-1576765608535-5f04d1e3f289?auto=format&fit=crop&w=600&q=80" alt="Anak" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; bottom: 12px; left: 12px; background: rgba(11,37,65,0.85); color: white; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 700;">NICU / PICU Level III</span>
            </div>
            <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="width: 48px; height: 48px; background: #dcfce7; color: #16a34a; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 15px;">
                    <i class="fa-solid fa-baby"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Pusat Kesehatan Ibu & Anak (Maternal Care)</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Klinik fertilitas & bayi tabung (IVF), persalinan nyaman tanpa rasa sakit (ERACS), dan perawatan intensif bayi prematur ekstrem.
                </p>
                <div style="margin-top: auto; display: flex; gap: 10px;">
                    <a href="index.php?page=book_appointment" class="btn btn-primary" style="flex: 1; text-align: center; font-size: 13px;">Konsultasi Dokter</a>
                </div>
            </div>
        </div>

        <!-- 6. Saluran Cerna (Digestive) -->
        <div style="background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; display: flex; flex-direction: column;">
            <div style="height: 190px; overflow: hidden; position: relative;">
                <img src="https://images.unsplash.com/photo-1551076805-e1869043e560?auto=format&fit=crop&w=600&q=80" alt="Digestive" style="width: 100%; height: 100%; object-fit: cover;">
                <span style="position: absolute; bottom: 12px; left: 12px; background: rgba(11,37,65,0.85); color: white; padding: 4px 12px; border-radius: 6px; font-size: 12px; font-weight: 700;">Endoskopi Digital HD</span>
            </div>
            <div style="padding: 24px; flex-grow: 1; display: flex; flex-direction: column;">
                <div style="width: 48px; height: 48px; background: #e0e7ff; color: #4338ca; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin-bottom: 15px;">
                    <i class="fa-solid fa-stethoscope"></i>
                </div>
                <h3 style="font-size: 20px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">Pusat Saluran Cerna & Hati (Digestive Center)</h3>
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 20px; flex-grow: 1;">
                    Gastroskopi, kolonoskopi beresolusi tinggi, pemecahan batu empedu tanpa operasi terbuka (ERCP), dan skrining polip usus.
                </p>
                <div style="margin-top: auto; display: flex; gap: 10px;">
                    <a href="index.php?page=book_appointment" class="btn btn-primary" style="flex: 1; text-align: center; font-size: 13px;">Konsultasi Dokter</a>
                </div>
            </div>
        </div>

    </div>

    <!-- Fasilitas Penunjang 24 Jam -->
    <div style="background: #ffffff; border-radius: 16px; padding: 35px; border: 1px solid #e2e8f0; box-shadow: 0 4px 15px rgba(0,0,0,0.04);">
        <h3 style="font-size: 22px; color: #0f172a; font-weight: 800; margin-bottom: 20px;"><i class="fa-solid fa-clock" style="color: #0d6efd;"></i> Layanan Penunjang Medis Siaga 24 Jam</h3>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
            <div style="background: #f8fafc; padding: 18px; border-radius: 10px; border-left: 4px solid #ef4444;">
                <h4 style="margin: 0 0 6px; font-size: 16px; color: #0f172a;">Gawat Darurat (IGD)</h4>
                <p style="margin: 0; color: #64748b; font-size: 13px;">Triage darurat dokter umum & spesialis on-call dengan ruang resusitasi.</p>
            </div>
            <div style="background: #f8fafc; padding: 18px; border-radius: 10px; border-left: 4px solid #0d6efd;">
                <h4 style="margin: 0 0 6px; font-size: 16px; color: #0f172a;">Laboratorium Otomatis</h4>
                <p style="margin: 0; color: #64748b; font-size: 13px;">Analisis spesimen darah, PCR, kultur mikroba dengan sistem barcode.</p>
            </div>
            <div style="background: #f8fafc; padding: 18px; border-radius: 10px; border-left: 4px solid #10b981;">
                <h4 style="margin: 0 0 6px; font-size: 16px; color: #0f172a;">Farmasi Rawat Jalan & Inap</h4>
                <p style="margin: 0; color: #64748b; font-size: 13px;">Penebusan resep obat terjamin asli, konseling apoteker, dan e-Prescription.</p>
            </div>
            <div style="background: #f8fafc; padding: 18px; border-radius: 10px; border-left: 4px solid #f59e0b;">
                <h4 style="margin: 0 0 6px; font-size: 16px; color: #0f172a;">Radiologi & CT 128 Slice</h4>
                <p style="margin: 0; color: #64748b; font-size: 13px;">Rontgen digital, USG 4D, MRI 3 Tesla untuk penegakan diagnosis akurat.</p>
            </div>
        </div>
    </div>

</div>
