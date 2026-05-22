<?php include 'header.php'; ?>
<?php include 'koneksi.php'; ?>
<?php
$query = $conn ? mysqli_query($conn, "SELECT * FROM profil LIMIT 1") : false;
$profil = $query ? mysqli_fetch_assoc($query) : null;
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
body { font-family:'Inter',sans-serif; background:#f8fafc; color:#1e293b; }

.page-hero {
    background: linear-gradient(135deg,#f0f4ff 0%,#fdf4ff 60%,#f0fdf4 100%);
    padding:60px 0 50px; border-bottom:1px solid #e2e8f0;
}
.page-label { font-size:.8rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#6366f1; margin-bottom:10px; }
.page-hero h1 { font-size:clamp(1.8rem,3vw,2.6rem); font-weight:800; color:#0f172a; letter-spacing:-.5px; margin-bottom:10px; }
.page-hero p { color:#64748b; font-size:1rem; margin:0; }

.daftar-section { padding:60px 0; }



/* Form Card */
.form-card { background:white; border-radius:18px; border:1px solid #f1f5f9; padding:36px; }
.form-card h4 { font-size:1.3rem; font-weight:700; color:#0f172a; margin-bottom:6px; }
.form-card .sub { font-size:.88rem; color:#64748b; margin-bottom:28px; }
.form-label { font-size:.82rem; font-weight:600; color:#374151; margin-bottom:6px; }
.form-control, .form-select {
    border:1.5px solid #e2e8f0; border-radius:10px;
    padding:10px 14px; font-size:.9rem; color:#1e293b;
    transition:border-color .2s, box-shadow .2s;
}
.form-control:focus, .form-select:focus {
    border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,.12); outline:none;
}
.btn-submit {
    background: linear-gradient(135deg,#6366f1,#8b5cf6);
    color:white; border:none; border-radius:10px;
    padding:13px 28px; font-size:.95rem; font-weight:600;
    width:100%; transition:all .3s; cursor:pointer;
    box-shadow:0 4px 20px rgba(99,102,241,.3);
}
.btn-submit:hover { opacity:.9; transform:translateY(-1px); box-shadow:0 8px 30px rgba(99,102,241,.4); }

footer { background:#0f172a !important; color:#94a3b8 !important; padding:28px 0 !important; margin-top:0 !important; border-radius:0 !important; }
footer p { color:#94a3b8 !important; font-size:.88rem; margin:0; }
</style>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <p class="page-label">Penerimaan Siswa Baru</p>
        <h1>Formulir Pendaftaran</h1>
        <p>Daftarkan putra-putri Anda dan bergabung bersama keluarga besar PAUD Maessar Bayan</p>
    </div>
</div>

<!-- Content -->
<section class="daftar-section">
    <div class="container">
        <?php if (!$conn): ?>
        <div class="alert alert-warning text-center border-0 shadow-sm mb-4" style="border-radius: 12px; background: #fffbeb; color: #b45309; font-size: 0.9rem; padding: 12px 20px;">
            ⚠️ <strong>Koneksi Database Bermasalah:</strong> Silakan periksa konfigurasi database Anda di hosting. Pendaftaran membutuhkan database yang online agar dapat disimpan.
        </div>
        <?php endif; ?>
        <div class="row g-4">

            <!-- Form Pendaftaran (Tengah) -->
            <div class="col-lg-8 offset-lg-2">
                <div class="form-card">
                    <h4>Data Pendaftaran</h4>
                    <p class="sub">Isi formulir berikut dengan lengkap dan benar</p>
                    <form method="POST" action="proses_daftar.php">
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap Anak</label>
                            <input type="text" name="nama_anak" class="form-control" placeholder="Nama lengkap anak" required>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control" required>
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Nama Ayah</label>
                                <input type="text" name="nama_ayah" class="form-control" placeholder="Nama ayah" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Nama Ibu</label>
                                <input type="text" name="nama_ibu" class="form-control" placeholder="Nama ibu" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">No. Telepon Orang Tua</label>
                            <input type="text" name="no_hp_ortu" class="form-control" placeholder="08123456789" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="alamat" class="form-control" rows="3" placeholder="Alamat lengkap" required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Kirim Pendaftaran →</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>

<?php include 'footer.php'; ?>