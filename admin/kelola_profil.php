<?php
include 'db.php';

// Pastikan kolom ada
$checks = ['kepsek_foto','foto_sekolah','tentang','foto_hero'];
foreach ($checks as $col) {
    $r = mysqli_query($conn, "SHOW COLUMNS FROM profil LIKE '$col'");
    if ($r && mysqli_num_rows($r) === 0)
        mysqli_query($conn, "ALTER TABLE profil ADD $col VARCHAR(255) DEFAULT NULL");
}

$cek  = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
$data = $cek ? mysqli_fetch_assoc($cek) : null;

if (isset($_POST['update'])) {
    $tentang      = mysqli_real_escape_string($conn, $_POST['tentang']);
    $visi         = mysqli_real_escape_string($conn, $_POST['visi']);
    $misi         = mysqli_real_escape_string($conn, $_POST['misi']);
    $kepsek_nama  = mysqli_real_escape_string($conn, $_POST['kepsek_nama']);
    $kepsek_quote = mysqli_real_escape_string($conn, $_POST['kepsek_quote']);
    $kepsek_foto  = $data['kepsek_foto'] ?? '';
    $foto_sekolah = $data['foto_sekolah'] ?? '';

    $target_dir = "../umum/foto/";
    if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);

    if (!empty($_FILES['kepsek_foto']['name'])) {
        $fn = time() . '_kepsek_' . basename($_FILES['kepsek_foto']['name']);
        if (move_uploaded_file($_FILES['kepsek_foto']['tmp_name'], $target_dir . $fn)) {
            if ($kepsek_foto) @unlink($target_dir . $kepsek_foto);
            $kepsek_foto = $fn;
        }
    }
    if (!empty($_FILES['foto_sekolah']['name'])) {
        $fn2 = time() . '_sekolah_' . basename($_FILES['foto_sekolah']['name']);
        if (move_uploaded_file($_FILES['foto_sekolah']['tmp_name'], $target_dir . $fn2)) {
            if ($foto_sekolah) @unlink($target_dir . $foto_sekolah);
            $foto_sekolah = $fn2;
        }
    }

    $cek2 = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
    if ($cek2 && mysqli_num_rows($cek2) > 0) {
        mysqli_query($conn, "UPDATE profil SET tentang='$tentang',visi='$visi',misi='$misi',kepsek_nama='$kepsek_nama',kepsek_quote='$kepsek_quote',kepsek_foto='$kepsek_foto',foto_sekolah='$foto_sekolah'");
    } else {
        mysqli_query($conn, "INSERT INTO profil (tentang,visi,misi,kepsek_nama,kepsek_quote,kepsek_foto,foto_sekolah) VALUES ('$tentang','$visi','$misi','$kepsek_nama','$kepsek_quote','$kepsek_foto','$foto_sekolah')");
    }
    echo "<script>alert('Berhasil disimpan!');window.location='admin.php?page=profil';</script>";
}

$result = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
$row    = $result ? mysqli_fetch_assoc($result) : [];
$row    = $row ?: ['tentang'=>'','visi'=>'','misi'=>'','kepsek_nama'=>'','kepsek_quote'=>'','kepsek_foto'=>'','foto_sekolah'=>''];
?>

<style>
.page-title{font-size:1.4rem;font-weight:800;color:#0f172a;margin-bottom:4px;}
.page-sub{font-size:.88rem;color:#64748b;margin-bottom:28px;}
.mod-card{background:white;border-radius:16px;border:1px solid #f1f5f9;padding:24px;margin-bottom:20px;}
.section-head{font-size:.88rem;font-weight:700;color:#0f172a;margin-bottom:16px;padding-bottom:10px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;gap:6px;}
.form-label{font-size:.8rem;font-weight:600;color:#374151;margin-bottom:5px;display:block;}
.form-control,.form-select{border:1.5px solid #e2e8f0;border-radius:10px;padding:10px 14px;font-size:.88rem;color:#1e293b;transition:border-color .2s,box-shadow .2s;width:100%;}
.form-control:focus,.form-select:focus{border-color:#6366f1;box-shadow:0 0 0 3px rgba(99,102,241,.12);outline:none;}
.btn-save{background:linear-gradient(135deg,#6366f1,#8b5cf6);color:white;border:none;border-radius:9px;padding:11px 28px;font-size:.9rem;font-weight:600;cursor:pointer;transition:all .2s;}
.btn-save:hover{opacity:.88;transform:translateY(-1px);}
.preview-img{width:90px;height:90px;border-radius:10px;object-fit:cover;border:2px solid #e2e8f0;margin-top:8px;}
.hint{font-size:.75rem;color:#94a3b8;margin-top:4px;}
.row{display:flex;flex-wrap:wrap;gap:0;}
.col-8{flex:0 0 66.66%;max-width:66.66%;padding-right:16px;}
.col-4{flex:0 0 33.33%;max-width:33.33%;}
.col-6{flex:0 0 50%;max-width:50%;padding-right:12px;}
.col-6:last-child{padding-right:0;}
@media(max-width:640px){.col-8,.col-4,.col-6{flex:0 0 100%;max-width:100%;padding-right:0;}}
.mb-3{margin-bottom:16px;}
.mb-4{margin-bottom:24px;}
.divider{border:none;border-top:1px solid #f1f5f9;margin:20px 0;}
</style>

<p class="page-title">Kelola Profil</p>
<p class="page-sub">Edit konten halaman profil sekolah</p>

<div class="mod-card">
    <form method="POST" enctype="multipart/form-data">

        <!-- Tentang & Foto Sekolah -->
        <p class="section-head">🏫 Tentang Sekolah</p>
        <div class="row mb-4">
            <div class="col-8">
                <div class="mb-3">
                    <label class="form-label">Deskripsi Sekolah</label>
                    <textarea name="tentang" class="form-control" rows="5"><?= htmlspecialchars($row['tentang']) ?></textarea>
                </div>
            </div>
            <div class="col-4">
                <label class="form-label">Foto Utama Sekolah</label>
                <input type="file" name="foto_sekolah" class="form-control" accept="image/*">
                <p class="hint">Biarkan kosong jika tidak ingin mengganti</p>
                <?php $ps = !empty($row['foto_sekolah']) ? "../umum/foto/".$row['foto_sekolah'] : "../umum/sekolah.jpeg"; ?>
                <img src="<?= htmlspecialchars($ps) ?>" class="preview-img" alt="Foto Sekolah">
            </div>
        </div>

        <!-- Visi Misi -->
        <hr class="divider">
        <p class="section-head">🔭 Visi &amp; Misi</p>
        <div class="row mb-4">
            <div class="col-6">
                <label class="form-label">Visi</label>
                <textarea name="visi" class="form-control" rows="4"><?= htmlspecialchars($row['visi']) ?></textarea>
            </div>
            <div class="col-6">
                <label class="form-label">Misi</label>
                <textarea name="misi" class="form-control" rows="4"><?= htmlspecialchars($row['misi']) ?></textarea>
            </div>
        </div>

        <!-- Kepala Sekolah -->
        <hr class="divider">
        <p class="section-head">👩‍🏫 Kepala Sekolah</p>
        <div class="row mb-4">
            <div class="col-6">
                <div class="mb-3">
                    <label class="form-label">Nama Kepala Sekolah</label>
                    <input type="text" name="kepsek_nama" class="form-control" value="<?= htmlspecialchars($row['kepsek_nama']) ?>">
                </div>
                <div class="mb-3">
                    <label class="form-label">Quote / Kata-kata</label>
                    <input type="text" name="kepsek_quote" class="form-control" value="<?= htmlspecialchars($row['kepsek_quote'] ?? '') ?>">
                </div>
            </div>
            <div class="col-6">
                <label class="form-label">Foto Kepala Sekolah</label>
                <input type="file" name="kepsek_foto" class="form-control" accept="image/*">
                <p class="hint">Biarkan kosong jika tidak ingin mengganti</p>
                <?php if(!empty($row['kepsek_foto'])): ?>
                <img src="../umum/foto/<?= htmlspecialchars($row['kepsek_foto']) ?>" class="preview-img" alt="Foto Kepsek">
                <?php endif; ?>
            </div>
        </div>

        <button type="submit" name="update" class="btn-save">💾 Simpan Perubahan</button>
    </form>
</div>
