<?php
// pages/lab_results.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<div class="container page-wrapper" style="max-width: 1100px; margin: 30px auto; padding: 0 20px;">
    
    <div class="page-header" style="background: white; padding: 25px 30px; border-radius: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.05); margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; border-left: 5px solid #10b981;">
        <div>
            <h2 style="margin: 0 0 5px; color: #0f172a; font-size: 24px;">Hasil Laboratorium & Radiologi</h2>
            <p style="margin: 0; color: #64748b; font-size: 14px;">Akses berkas pemeriksaan klinis, hematologi, radiologi, dan tes molekuler Anda.</p>
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="index.php?page=dashboard" class="btn btn-light" style="font-size: 13px;"><i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard</a>
            <button onclick="window.print()" class="btn btn-primary" style="font-size: 13px;"><i class="fa-solid fa-print"></i> Cetak Dokumen</button>
        </div>
    </div>

    <!-- Info Box -->
    <div style="background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px; padding: 16px 20px; margin-bottom: 25px; display: flex; align-items: center; gap: 15px;">
        <i class="fa-solid fa-circle-check" style="color: #0284c7; font-size: 24px;"></i>
        <div style="font-size: 13px; color: #1e40af;">
            <strong>Integrasi Laboratorium & PACS Terverifikasi:</strong> Seluruh hasil uji spesimen telah divalidasi oleh Dokter Spesialis Patologi Klinik & Radiologi berstandar ISO 15189.
        </div>
    </div>

    <!-- Table Lab Results -->
    <div style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid #e2e8f0; margin-bottom: 30px;">
        <h3 style="font-size: 17px; font-weight: 700; color: #0f172a; margin-bottom: 18px; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-vial" style="color: #10b981;"></i> Riwayat Uji Laboratorium Patologi
        </h3>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0; text-align: left; color: #64748b; font-size: 12px; text-transform: uppercase;">
                        <th style="padding: 12px 14px;">No. Order Lab</th>
                        <th style="padding: 12px 14px;">Tanggal Periksa</th>
                        <th style="padding: 12px 14px;">Jenis Pemeriksaan</th>
                        <th style="padding: 12px 14px;">Ringkasan Parameter Kunci</th>
                        <th style="padding: 12px 14px; text-align: center;">Status Verifikasi</th>
                        <th style="padding: 12px 14px; text-align: center;">Unduh</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 14px; font-weight: 700; color: #0284c7;"><code>LAB-2026-0891</code></td>
                        <td style="padding: 14px; color: #475569;">10 Okt 2026, 09:30</td>
                        <td style="padding: 14px; font-weight: 600; color: #0f172a;">Hematologi Rutin (Darah Lengkap 14 Parameter)</td>
                        <td style="padding: 14px; color: #334155; font-size: 13px;">
                            Hemoglobin: <strong>14.2 g/dL</strong> (Normal)<br>
                            Leukosit: <strong>7.200 /uL</strong> (Normal)<br>
                            Trombosit: <strong>265.000 /uL</strong> (Normal)
                        </td>
                        <td style="padding: 14px; text-align: center;">
                            <span style="background: #dcfce7; color: #15803d; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                                <i class="fa-solid fa-check-double"></i> VALID / FINAL
                            </span>
                        </td>
                        <td style="padding: 14px; text-align: center;">
                            <button onclick="alert('Mengunduh e-Hasil Resmi: LAB-2026-0891 (PDF Terenkripsi)')" class="btn btn-light" style="padding: 6px 12px; font-size: 12px; border-radius: 6px;">
                                <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i> PDF
                            </button>
                        </td>
                    </tr>

                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 14px; font-weight: 700; color: #0284c7;"><code>LAB-2026-0654</code></td>
                        <td style="padding: 14px; color: #475569;">15 Agu 2026, 08:15</td>
                        <td style="padding: 14px; font-weight: 600; color: #0f172a;">Kimia Darah & Profil Lipid Jantung</td>
                        <td style="padding: 14px; color: #334155; font-size: 13px;">
                            Kolesterol Total: <strong>185 mg/dL</strong> (Optimal)<br>
                            Trigliserida: <strong>130 mg/dL</strong> (Normal)<br>
                            Glukosa Puasa: <strong>95 mg/dL</strong> (Normal)
                        </td>
                        <td style="padding: 14px; text-align: center;">
                            <span style="background: #dcfce7; color: #15803d; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                                <i class="fa-solid fa-check-double"></i> VALID / FINAL
                            </span>
                        </td>
                        <td style="padding: 14px; text-align: center;">
                            <button onclick="alert('Mengunduh e-Hasil Resmi: LAB-2026-0654 (PDF Terenkripsi)')" class="btn btn-light" style="padding: 6px 12px; font-size: 12px; border-radius: 6px;">
                                <i class="fa-solid fa-file-pdf" style="color: #ef4444;"></i> PDF
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Table Radiology Results -->
    <div style="background: white; border-radius: 12px; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.04); border: 1px solid #e2e8f0;">
        <h3 style="font-size: 17px; font-weight: 700; color: #0f172a; margin-bottom: 18px; display: flex; align-items: center; gap: 8px;">
            <i class="fa-solid fa-x-ray" style="color: #0284c7;"></i> Riwayat Diagnostik Radiologi & Imaging
        </h3>
        
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                <thead>
                    <tr style="border-bottom: 2px solid #e2e8f0; text-align: left; color: #64748b; font-size: 12px; text-transform: uppercase;">
                        <th style="padding: 12px 14px;">No. Aksesi PACS</th>
                        <th style="padding: 12px 14px;">Tanggal Periksa</th>
                        <th style="padding: 12px 14px;">Modalitas Imaging</th>
                        <th style="padding: 12px 14px;">Kesan Ekspertise Radiolog</th>
                        <th style="padding: 12px 14px; text-align: center;">Status Ekspertise</th>
                        <th style="padding: 12px 14px; text-align: center;">Lihat Citra DICOM</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 14px; font-weight: 700; color: #0284c7;"><code>RAD-2026-0312</code></td>
                        <td style="padding: 14px; color: #475569;">15 Agu 2026, 10:45</td>
                        <td style="padding: 14px; font-weight: 600; color: #0f172a;">Thorax PA Digital (Foto Rontgen Dada)</td>
                        <td style="padding: 14px; color: #334155; font-size: 13px;">
                            Cor dan pulmo dalam batas normal. Tidak tampak infiltrat aktif maupun efusi pleura.
                        </td>
                        <td style="padding: 14px; text-align: center;">
                            <span style="background: #dcfce7; color: #15803d; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 700;">
                                DIBACA Sp.Rad
                            </span>
                        </td>
                        <td style="padding: 14px; text-align: center;">
                            <button onclick="alert('Membuka DICOM Web Viewer: Menampilkan citra rontgen resolusi tinggi 2048x2048')" class="btn btn-primary" style="padding: 6px 14px; font-size: 12px; border-radius: 6px;">
                                <i class="fa-solid fa-eye"></i> Buka DICOM
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
