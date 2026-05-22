<?php
include 'db.php';

if ($conn) {
    if (isset($_POST['tambah'])) {
        $nama_anak     = mysqli_real_escape_string($conn, $_POST['nama']);
        $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['ttl']);
        $alamat        = mysqli_real_escape_string($conn, $_POST['alamat']);
        $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
        $nama_ayah     = mysqli_real_escape_string($conn, $_POST['nama_ayah']);
        $nama_ibu      = mysqli_real_escape_string($conn, $_POST['nama_ibu']);
        $no_hp_ortu    = mysqli_real_escape_string($conn, $_POST['no_ortu']);
        if (mysqli_query($conn, "INSERT INTO siswa (nama_anak,jenis_kelamin,tanggal_lahir,nama_ayah,nama_ibu,no_hp_ortu,alamat) VALUES ('$nama_anak','$jenis_kelamin','$tanggal_lahir','$nama_ayah','$nama_ibu','$no_hp_ortu','$alamat')")) {
            echo "<script>alert('Siswa berhasil ditambahkan!');window.location='admin.php?page=siswa';</script>"; exit;
        }
    }

    if (isset($_POST['simpan_info'])) {
        $alamat_sekolah = mysqli_real_escape_string($conn, $_POST['alamat_sekolah']);
        $no_telp        = mysqli_real_escape_string($conn, $_POST['no_telp']);
        $email          = mysqli_real_escape_string($conn, $_POST['email']);
        $cek = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
        if ($cek && mysqli_num_rows($cek) > 0) {
            mysqli_query($conn, "UPDATE profil SET alamat_sekolah='$alamat_sekolah',no_telp='$no_telp',email='$email'");
        } else {
            mysqli_query($conn, "INSERT INTO profil (alamat_sekolah,no_telp,email) VALUES ('$alamat_sekolah','$no_telp','$email')");
        }
        echo "<script>alert('Info sekolah disimpan!');window.location='admin.php?page=siswa';</script>"; exit;
    }

    if (isset($_GET['hapus'])) {
        mysqli_query($conn, "DELETE FROM siswa WHERE id=" . (int)$_GET['hapus']);
        echo "<script>alert('Data dihapus!');window.location='admin.php?page=siswa';</script>"; exit;
    }

    $data = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id DESC");
} else {
    $data = false;
}
?>


<style>
.page-title{font-size:1.4rem;font-weight:800;color:#0f172a;margin-bottom:4px;}
.page-sub{font-size:.88rem;color:#64748b;margin-bottom:28px;}
.mod-card{background:white;border-radius:16px;border:1px solid #f1f5f9;padding:24px;margin-bottom:20px;}
.mod-card h6{font-size:.95rem;font-weight:700;color:#0f172a;margin-bottom:20px;}
.form-label{font-size:.8rem;font-weight:600;color:#374151;margin-bottom:5px;}
.form-control,.form-select{border:1.5px solid #e2e8f0;border-radius:10px;padding:10px 14px;font-size:.88rem;color:#1e293b;transition:border-color .2s,box-shadow .2s;}
.form-control:focus,.form-select:focus{border-color:#6366f1;box-shadow:0 0 0 3px rgba(99,102,241,.12);outline:none;}
.btn-save{background:linear-gradient(135deg,#6366f1,#8b5cf6);color:white;border:none;border-radius:9px;padding:10px 22px;font-size:.88rem;font-weight:600;cursor:pointer;transition:all .2s;}
.btn-save:hover{opacity:.88;transform:translateY(-1px);}
.btn-save2{background:linear-gradient(135deg,#14b8a6,#06b6d4);color:white;border:none;border-radius:9px;padding:10px 22px;font-size:.88rem;font-weight:600;cursor:pointer;transition:all .2s;}
.btn-save2:hover{opacity:.88;}
.data-table{width:100%;border-collapse:collapse;font-size:.85rem;}
.data-table thead th{background:#f8fafc;color:#374151;font-weight:700;padding:11px 14px;text-align:left;border-bottom:1px solid #e2e8f0;font-size:.78rem;text-transform:uppercase;letter-spacing:.5px;}
.data-table tbody td{padding:11px 14px;border-bottom:1px solid #f1f5f9;color:#475569;vertical-align:middle;}
.data-table tbody tr:hover{background:#f8fafc;}
.data-table tbody tr:last-child td{border:none;}
.btn-edit{background:#fef3c7;color:#b45309;border:none;border-radius:7px;padding:5px 12px;font-size:.75rem;font-weight:600;cursor:pointer;text-decoration:none;display:inline-block;}
.btn-edit:hover{background:#fde68a;}
.btn-del{background:#fee2e2;color:#dc2626;border:none;border-radius:7px;padding:5px 12px;font-size:.75rem;font-weight:600;cursor:pointer;text-decoration:none;display:inline-block;}
.btn-del:hover{background:#fecaca;}
.jk-badge{display:inline-block;padding:3px 10px;border-radius:100px;font-size:.72rem;font-weight:700;}
.jk-l{background:#e0f2fe;color:#0369a1;}
.jk-p{background:#fce7f3;color:#be185d;}
</style>

<p class="page-title">Kelola Siswa</p>
<p class="page-sub">Kelola data siswa dan informasi kontak sekolah</p>

<!-- Form Tambah Siswa -->
<div class="mod-card">
    <h6>👶 Tambah Siswa Baru</h6>
    <form method="POST">
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Anak</label>
                <input type="text" name="nama" class="form-control" placeholder="Nama lengkap" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tempat, Tanggal Lahir</label>
                <input type="text" name="ttl" class="form-control" placeholder="Contoh: Lombok, 01-01-2020" required>
            </div>
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
                <label class="form-label">No HP Orang Tua</label>
                <input type="text" name="no_ortu" class="form-control" placeholder="08xxxxxxxxxx" required>
            </div>
        </div>
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" required></textarea>
        </div>
        <button type="submit" name="tambah" class="btn-save" <?= !$conn ? 'disabled style="opacity: 0.6; cursor: not-allowed;"' : '' ?>>💾 Simpan Data Siswa</button>
        <?php if (!$conn): ?>
        <small class="text-danger d-block mt-2">⚠️ Tombol dinonaktifkan karena koneksi database bermasalah.</small>
        <?php endif; ?>
    </form>
</div>



<!-- Tabel Siswa -->
<div class="mod-card">
    <h6>📋 Daftar Siswa</h6>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr><th>#</th><th>Nama</th><th>JK</th><th>Tgl Lahir</th><th>Orang Tua</th><th>No HP</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <?php $no=1; if($data && mysqli_num_rows($data)>0): while($row=mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= htmlspecialchars($row['nama_anak']) ?></strong><br><small style="color:#94a3b8"><?= htmlspecialchars($row['alamat']) ?></small></td>
                    <td><span class="jk-badge <?= $row['jenis_kelamin']==='Laki-laki'?'jk-l':'jk-p' ?>"><?= htmlspecialchars($row['jenis_kelamin']) ?></span></td>
                    <td><?= htmlspecialchars($row['tanggal_lahir']) ?></td>
                    <td><?= htmlspecialchars($row['nama_ayah']) ?> &amp; <?= htmlspecialchars($row['nama_ibu']) ?></td>
                    <td><?= htmlspecialchars($row['no_hp_ortu']) ?></td>
                    <td style="display:flex;gap:6px;">
                        <a href="edit_siswa.php?id=<?= $row['id'] ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                        <a href="admin.php?page=siswa&hapus=<?= $row['id'] ?>" class="btn-del" onclick="return confirm('Hapus data siswa ini?')"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="7" style="text-align:center;color:#94a3b8;padding:30px;">Belum ada data siswa</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
