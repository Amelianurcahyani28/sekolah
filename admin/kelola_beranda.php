<?php
include 'koneksi.php';

if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $cek = mysqli_query($conn, "SELECT * FROM beranda LIMIT 1");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "UPDATE beranda SET judul='$judul', deskripsi='$deskripsi' WHERE id=1");
    } else {
        mysqli_query($conn, "INSERT INTO beranda VALUES('', '$judul', '$deskripsi')");
    }
    echo "<script>alert('Berhasil diperbarui!');</script>";
}

$data = mysqli_query($conn, "SELECT * FROM beranda ORDER BY id DESC");
$row = mysqli_fetch_assoc($data) ?? ['judul' => 'TK Maessar Bayan', 'deskripsi' => 'Pendidikan usia dini yang menyenangkan'];

$gallery_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM gallery"))['total'];
$artikel_total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM artikel"))['total'];
$siswa_total   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM siswa"))['total'];
?>

<style>
.page-title { font-size:1.4rem; font-weight:800; color:#0f172a; margin-bottom:4px; }
.page-sub   { font-size:.88rem; color:#64748b; margin-bottom:28px; }

.stat-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-bottom:28px; }
@media(max-width:640px){ .stat-grid{grid-template-columns:1fr;} }

.stat-box {
    background:white; border-radius:16px; border:1px solid #f1f5f9;
    padding:22px; text-decoration:none; display:block;
    transition:all .25s;
}
.stat-box:hover { transform:translateY(-4px); box-shadow:0 12px 30px rgba(0,0,0,.08); border-color:transparent; }
.stat-box .s-icon {
    width:42px; height:42px; border-radius:12px;
    display:flex; align-items:center; justify-content:center;
    font-size:1.1rem; margin-bottom:14px;
}
.s-purple { background:#ede9fe; }
.s-blue   { background:#e0f2fe; }
.s-green  { background:#dcfce7; }
.stat-box .s-num {
    font-size:2rem; font-weight:800;
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
    line-height:1;
}
.stat-box .s-lbl { font-size:.82rem; color:#64748b; font-weight:500; margin-top:4px; }

.mod-card { background:white; border-radius:16px; border:1px solid #f1f5f9; padding:24px; }
.mod-card h6 { font-size:.95rem; font-weight:700; color:#0f172a; margin-bottom:20px; display:flex; align-items:center; gap:8px; }

.form-label { font-size:.8rem; font-weight:600; color:#374151; margin-bottom:5px; }
.form-control, .form-select {
    border:1.5px solid #e2e8f0; border-radius:10px;
    padding:10px 14px; font-size:.88rem; color:#1e293b;
    transition:border-color .2s, box-shadow .2s;
}
.form-control:focus, .form-select:focus {
    border-color:#6366f1; box-shadow:0 0 0 3px rgba(99,102,241,.12); outline:none;
}
.btn-save {
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
    color:white; border:none; border-radius:9px;
    padding:10px 22px; font-size:.88rem; font-weight:600;
    cursor:pointer; transition:all .2s;
}
.btn-save:hover { opacity:.88; transform:translateY(-1px); }
</style>

<p class="page-title">Dashboard</p>
<p class="page-sub">Selamat datang di panel admin PAUD Maessar Bayan</p>

<!-- Stats -->
<div class="stat-grid">
    <a href="?page=gallery" class="stat-box">
        <div class="s-icon s-purple">🖼️</div>
        <div class="s-num"><?= $gallery_total ?></div>
        <div class="s-lbl">Foto Gallery</div>
    </a>
    <a href="?page=siswa" class="stat-box">
        <div class="s-icon s-blue">👶</div>
        <div class="s-num"><?= $siswa_total ?></div>
        <div class="s-lbl">Data Siswa</div>
    </a>
    <a href="?page=artikel" class="stat-box">
        <div class="s-icon s-green">📰</div>
        <div class="s-num"><?= $artikel_total ?></div>
        <div class="s-lbl">Artikel</div>
    </a>
</div>