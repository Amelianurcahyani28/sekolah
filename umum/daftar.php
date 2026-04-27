<?php include 'header.php'; ?>
<div class="container my-5">
    <div class="row g-5">
        <!-- Kiri: Info Syarat -->
        <div class="col-md-5">
            <div class="card bg-pastel-green border-0 p-4 text-white rounded-4 shadow mb-4">
                <h5 class="fw-bold">📝 Syarat Pendaftaran</h5>
                <ul class="mt-3 small">
                    <li>Usia minimal 4 tahun (TK A)</li>
                    <li>Fotokopi Akta Kelahiran</li>
                    <li>Fotokopi KK & KTP Orang Tua</li>
                    <li>Pas Foto 3x4 (2 lembar)</li>
                </ul>
            </div>
            <div class="card border-0 p-4 shadow-sm rounded-4" style="border-left: 5px solid #ff9a9e !important;">
                <h5 class="fw-bold">💰 Biaya Pendidikan</h5>
                <p class="small text-muted">Berikut estimasi biaya masuk:</p>
                <div class="d-flex justify-content-between mb-1"><span>Uang Pangkal</span> <b>Rp 3.000.000</b></div>
                <div class="d-flex justify-content-between mb-1"><span>SPP Bulanan</span> <b>Rp 350.000</b></div>
                <div class="d-flex justify-content-between"><span>Perlengkapan</span> <b>Rp 350.000</b></div>
            </div>
        </div>
        
        <!-- Kanan: Form -->
        <div class="col-md-7">
            <div class="card border-0 shadow p-4 rounded-4">
                <h4 class="fw-bold mb-4">Formulir Pendaftaran</h4>
                <form>
                    <div class="mb-3">
                        <label class="form-label small">Nama Lengkap Anak</label>
                        <input type="text" class="form-control" placeholder="Contoh: Ahmad Fauzi">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label small">Jenis Kelamin</label>
                            <select class="form-select"><option>Laki-laki</option><option>Perempuan</option></select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label small">Tanggal Lahir</label>
                            <input type="date" class="form-control">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small">Nama Orang Tua / Wali</label>
                        <input type="text" class="form-control" placeholder="Nama Ayah / Ibu">
                    </div>
                    <button type="button" class="btn btn-daftar w-100 py-2">Kirim Pendaftaran</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>