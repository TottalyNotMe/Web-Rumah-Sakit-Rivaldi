<!-- File: public_html/pages/infrastructure.php -->
<style>
    .infra-hero {
        background: linear-gradient(rgba(0, 97, 242, 0.8), rgba(0, 97, 242, 0.8)), url('assets/images/infrastructure/hero-bg.jpg') center/cover;
        color: white;
        padding: 60px 20px;
        text-align: center;
        border-radius: 8px;
        margin-bottom: 40px;
    }
    .facility-card { background: #fff; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); overflow: hidden; transition: transform 0.3s ease; border: 1px solid #f0f0f0; }
    .facility-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px rgba(0,0,0,0.1); }
    .facility-image-placeholder { width: 100%; height: 200px; background-color: #e2e8f0; display: flex; align-items: center; justify-content: center; color: #64748b; font-weight: bold; }
    .status-badge { display: inline-block; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
    .status-available { background: #dcfce7; color: #166534; }
    .status-maintenance { background: #fee2e2; color: #991b1b; }
    .calc-container { background: #f8fafc; padding: 30px; border-radius: 12px; border: 1px solid #e2e8f0; }
    .result-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    .result-table th, .result-table td { padding: 12px 15px; border-bottom: 1px solid #e2e8f0; text-align: left; }
    .result-table th { background-color: #f1f5f9; font-weight: 600; }
    .result-table .text-right { text-align: right; }
    .result-table tr.total-row { font-weight: bold; font-size: 1.1rem; background-color: #e0f2fe; }
    .result-table tr.patient-total-row { font-weight: bold; font-size: 1.25rem; background-color: #dcfce7; color: #166534; }
</style>

<div class="container mx-auto px-4 py-8 max-w-7xl">
    <div class="infra-hero">
        <h1 class="text-4xl font-bold mb-4" style="font-size: 2.5rem; margin-bottom: 15px;">Infrastruktur & Fasilitas Medis</h1>
        <p class="text-lg">Kenyamanan dan teknologi medis terkini untuk mendukung kesembuhan Anda.</p>
    </div>

    <div style="display: flex; gap: 10px; margin-bottom: 30px; border-bottom: 1px solid #e2e8f0; padding-bottom: 15px;">
        <button onclick="switchTab('katalog')" style="padding: 10px 20px; background: #2563eb; color: white; border: none; border-radius: 5px; cursor: pointer;">Katalog Fasilitas</button>
        <button onclick="switchTab('kamar')" style="padding: 10px 20px; background: #e2e8f0; color: #1e293b; border: none; border-radius: 5px; cursor: pointer;">Info Rawat Inap</button>
        <button onclick="switchTab('kalkulator')" style="padding: 10px 20px; background: #16a34a; color: white; border: none; border-radius: 5px; cursor: pointer;">Simulasi Estimasi Biaya</button>
    </div>

    <!-- SECTION 1: KATALOG FASILITAS -->
    <div id="tab-katalog" class="tab-content" style="display: block;">
        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 20px; border-left: 4px solid #2563eb; padding-left: 10px;">Fasilitas Penunjang Medis</h2>
        <div id="facilities-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
            <p>Memuat data fasilitas...</p>
        </div>
    </div>

    <!-- SECTION 2: PERBANDINGAN KELAS KAMAR -->
    <div id="tab-kamar" class="tab-content" style="display: none;">
        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 20px; border-left: 4px solid #2563eb; padding-left: 10px;">Perbandingan Kelas Rawat Inap</h2>
        <div style="overflow-x: auto;">
            <table class="result-table" style="background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <thead>
                    <tr>
                        <th>Kelas Kamar</th>
                        <th>Tarif / Hari</th>
                        <th>Kapasitas</th>
                        <th>Fasilitas Utama</th>
                    </tr>
                </thead>
                <tbody id="rooms-table-body"></tbody>
            </table>
        </div>
    </div>

    <!-- SECTION 3: KALKULATOR ESTIMASI BIAYA -->
    <div id="tab-kalkulator" class="tab-content" style="display: none;">
        <h2 style="font-size: 1.5rem; font-weight: bold; margin-bottom: 10px; border-left: 4px solid #16a34a; padding-left: 10px;">Kalkulator Simulasi Biaya</h2>
        <p style="background: #fefce8; padding: 15px; border: 1px solid #fef08a; border-radius: 5px; margin-bottom: 25px; color: #854d0e;">
            <strong>Perhatian:</strong> Kalkulator ini hanya memberikan estimasi kasar berdasarkan skenario medis umum.
        </p>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <div class="calc-container">
                <form id="estimation-form">
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kategori Penyakit</label>
                        <select name="disease_id" id="calc-disease" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 5px;" required>
                            <option value="">Pilih Skenario Penyakit...</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Kelas Kamar</label>
                        <select name="room_class_id" id="calc-room" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 5px;" required>
                            <option value="">Pilih Kelas Kamar...</option>
                        </select>
                    </div>
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Perkiraan Lama Rawat (Hari)</label>
                        <input type="number" name="days" min="1" max="30" value="1" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 5px;" required>
                    </div>
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 5px;">Rencana Penjamin</label>
                        <select name="payer_id" id="calc-payer" style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 5px;" required>
                            <option value="">Pilih Penjamin...</option>
                        </select>
                    </div>
                    <button type="submit" style="width: 100%; padding: 12px; background: #16a34a; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;">
                        Hitung Estimasi
                    </button>
                </form>
            </div>

            <div>
                <div id="calc-results-container" style="display: none;">
                    <h3 style="font-size: 1.2rem; font-weight: bold; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; margin-bottom: 15px;">Rincian Estimasi Biaya</h3>
                    <table class="result-table">
                        <thead>
                            <tr>
                                <th>Layanan</th>
                                <th>Qty</th>
                                <th class="text-right">Harga</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody id="result-breakdown"></tbody>
                    </table>
                    <p id="result-disclaimer" style="margin-top: 15px; font-style: italic; color: #64748b; font-size: 0.9rem;"></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function switchTab(tabId) {
    document.querySelectorAll('.tab-content').forEach(el => el.style.display = 'none');
    document.getElementById('tab-' + tabId).style.display = 'block';
}

function formatRupiah(number) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(number);
}

document.addEventListener('DOMContentLoaded', () => {
    fetch('api/get_infrastructure.php')
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                const grid = document.getElementById('facilities-grid');
                grid.innerHTML = '';
res.data.facilities.forEach(fac => {
    let statusClass = fac.status_dummy === 'Tersedia' ? 'status-available' : 'status-maintenance';
    
    // LOGIKA GAMBAR: Jika ada image_path di database, tampilkan <img>. Jika kosong, pakai placeholder abu-abu.
    let imageDisplay = fac.image_path 
        ? `<img src="${fac.image_path}" alt="${fac.name}" style="width: 100%; height: 200px; object-fit: cover;">` 
        : `<div class="facility-image-placeholder">[Gambar: ${fac.name}]</div>`;

    grid.innerHTML += `
        <div class="facility-card">
            ${imageDisplay}
            <div style="padding: 20px;">
                <span style="font-size: 0.75rem; color: #2563eb; font-weight: bold; text-transform: uppercase;">${fac.category}</span>
                <h3 style="font-size: 1.2rem; font-weight: bold; margin: 5px 0 10px 0;">${fac.name}</h3>
                <p style="color: #475569; font-size: 0.9rem; margin-bottom: 15px;">${fac.description}</p>
                <div style="display: flex; justify-content: space-between; border-top: 1px solid #e2e8f0; padding-top: 15px;">
                    <span style="font-size: 0.85rem; color: #64748b;">${fac.capacity_info}</span>
                    <span class="status-badge ${statusClass}">${fac.status_dummy}</span>
                </div>
            </div>
        </div>
    `;
});

                const tbody = document.getElementById('rooms-table-body');
                const calcRoom = document.getElementById('calc-room');
                tbody.innerHTML = '';
                res.data.rooms.forEach(room => {
                    tbody.innerHTML += `
                        <tr>
                            <td style="font-weight: bold;">${room.class_name}</td>
                            <td style="color: #2563eb; font-weight: bold;">${formatRupiah(room.price_per_day)}</td>
                            <td>${room.bed_capacity} Bed / ${room.patients_per_room} Pasien</td>
                            <td style="font-size: 0.9rem;">${room.amenities}</td>
                        </tr>
                    `;
                    calcRoom.innerHTML += `<option value="${room.id}">${room.class_name} - ${formatRupiah(room.price_per_day)}/hari</option>`;
                });
            }
        });

    fetch('api/get_estimation_data.php')
        .then(response => response.json())
        .then(res => {
            if(res.status === 'success') {
                const calcDisease = document.getElementById('calc-disease');
                res.data.diseases.forEach(d => {
                    calcDisease.innerHTML += `<option value="${d.id}">${d.name} (${d.category})</option>`;
                });
                
                const calcPayer = document.getElementById('calc-payer');
                res.data.payers.forEach(p => {
                    calcPayer.innerHTML += `<option value="${p.id}">${p.name}</option>`;
                });
            }
        });
});

document.getElementById('estimation-form').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const btn = this.querySelector('button[type="submit"]');
    const originalText = btn.innerHTML;
    btn.innerHTML = 'Menghitung...';
    btn.disabled = true;

    fetch('api/calculate_estimation.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(res => {
        btn.innerHTML = originalText;
        btn.disabled = false;

        if(res.status === 'success') {
            document.getElementById('calc-results-container').style.display = 'block';
            const tbody = document.getElementById('result-breakdown');
            tbody.innerHTML = '';

            res.data.breakdown.forEach(item => {
                tbody.innerHTML += `
                    <tr>
                        <td>${item.item}</td>
                        <td>${item.qty}</td>
                        <td class="text-right">${formatRupiah(item.price)}</td>
                        <td class="text-right font-semibold">${formatRupiah(item.total)}</td>
                    </tr>
                `;
            });

            tbody.innerHTML += `
                <tr class="total-row">
                    <td colspan="3" class="text-right">Total Estimasi Bruto:</td>
                    <td class="text-right">${formatRupiah(res.data.subtotal)}</td>
                </tr>
                <tr style="background: #fef2f2; color: #dc2626;">
                    <td colspan="3" class="text-right">Manfaat Penjamin (${res.data.payer_name}):</td>
                    <td class="text-right">- ${formatRupiah(res.data.coverage_amount)}</td>
                </tr>
                <tr class="patient-total-row">
                    <td colspan="3" class="text-right">Perkiraan Biaya Pasien:</td>
                    <td class="text-right">${formatRupiah(res.data.patient_total)}</td>
                </tr>
            `;
            document.getElementById('result-disclaimer').innerText = res.data.disclaimer;
        } else {
            alert('Error: ' + res.message);
        }
    })
    .catch(err => {
        btn.innerHTML = originalText;
        btn.disabled = false;
        alert('Terjadi kesalahan jaringan.');
    });
});
</script>