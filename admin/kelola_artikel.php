<?php
include 'koneksi.php';

$checkColumn = mysqli_query($conn, "SHOW COLUMNS FROM artikel LIKE 'gambar'");
if (!$checkColumn || mysqli_num_rows($checkColumn) === 0) {
    mysqli_query($conn, "ALTER TABLE artikel ADD gambar VARCHAR(200) DEFAULT NULL");
}

if (isset($_POST['tambah'])) {
    $judul    = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi      = mysqli_real_escape_string($conn, $_POST['isi']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $gambar   = null;
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "../umum/foto/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $file_name   = time() . '_' . basename($_FILES['gambar']['name']);
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_dir . $file_name)) $gambar = $file_name;
    }
    if ($gambar) {
        mysqli_query($conn, "INSERT INTO artikel (judul, isi, kategori, gambar, tanggal) VALUES ('$judul', '$isi', '$kategori', '$gambar', NOW())");
    } else {
        mysqli_query($conn, "INSERT INTO artikel (judul, isi, kategori, tanggal) VALUES ('$judul', '$isi', '$kategori', NOW())");
    }
    echo "<script>alert('Artikel berhasil ditambahkan!');</script>";
}

if (isset($_GET['hapus'])) {
    mysqli_query($conn, "DELETE FROM artikel WHERE id=" . (int)$_GET['hapus']);
    header("Location: ?page=artikel"); exit;
}

$data = mysqli_query($conn, "SELECT * FROM artikel ORDER BY id DESC");
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
.data-table{width:100%;border-collapse:collapse;font-size:.88rem;}
.data-table thead th{background:#f8fafc;color:#374151;font-weight:700;padding:12px 14px;text-align:left;border-bottom:1px solid #e2e8f0;font-size:.8rem;text-transform:uppercase;letter-spacing:.5px;}
.data-table tbody td{padding:12px 14px;border-bottom:1px solid #f1f5f9;color:#475569;vertical-align:middle;}
.data-table tbody tr:hover{background:#f8fafc;}
.data-table tbody tr:last-child td{border:none;}
.thumb{width:70px;height:52px;border-radius:8px;object-fit:cover;}
.btn-edit{background:#fef3c7;color:#b45309;border:none;border-radius:7px;padding:5px 12px;font-size:.78rem;font-weight:600;cursor:pointer;text-decoration:none;display:inline-block;}
.btn-edit:hover{background:#fde68a;}
.btn-del{background:#fee2e2;color:#dc2626;border:none;border-radius:7px;padding:5px 12px;font-size:.78rem;font-weight:600;cursor:pointer;text-decoration:none;display:inline-block;}
.btn-del:hover{background:#fecaca;}
.kat-badge{display:inline-block;padding:3px 10px;border-radius:100px;font-size:.72rem;font-weight:700;}
.kat-edukasi{background:#ede9fe;color:#6d28d9;}
.kat-parenting{background:#fce7f3;color:#be185d;}
.kat-kesehatan{background:#dcfce7;color:#15803d;}
.kat-kegiatan{background:#fef3c7;color:#b45309;}
.kat-default{background:#f1f5f9;color:#475569;}
</style>

<p class="page-title">Kelola Artikel</p>
<p class="page-sub">Buat dan kelola artikel serta berita sekolah</p>

<!-- Form Tambah -->
<div class="mod-card">
    <h6>✏️ Tambah Artikel Baru</h6>
    <form method="POST" enctype="multipart/form-data">
        <div class="row g-3 mb-3">
            <div class="col-md-7">
                <label class="form-label">Judul Artikel</label>
                <input type="text" name="judul" class="form-control" placeholder="Judul artikel" required>
            </div>
            <div class="col-md-5">
                <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                    <option value="">Pilih Kategori</option>
                    <option value="edukasi">📚 Edukasi</option>
                    <option value="parenting">👨‍👩‍👧 Parenting</option>
                    <option value="kesehatan">💪 Kesehatan</option>
                    <option value="kegitan">🎉 Kegiatan</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Isi Artikel</label>
            <textarea name="isi" class="form-control" rows="5" placeholder="Tulis artikel di sini..." required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Artikel</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
        </div>
        <button type="submit" name="tambah" class="btn-save">🚀 Publikasikan</button>
    </form>
</div>

<!-- Tabel -->
<div class="mod-card">
    <h6>📋 Daftar Artikel</h6>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr><th>#</th><th>Judul</th><th>Kategori</th><th>Foto</th><th>Tanggal</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <?php $no=1; while($row=mysqli_fetch_assoc($data)):
                    $kat = $row['kategori'];
                    $bc = 'kat-default';
                    if ($kat==='edukasi') $bc='kat-edukasi';
                    elseif ($kat==='parenting') $bc='kat-parenting';
                    elseif ($kat==='kesehatan') $bc='kat-kesehatan';
                    elseif ($kat==='kegitan'||$kat==='kegiatan') $bc='kat-kegiatan';
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><strong><?= htmlspecialchars($row['judul']) ?></strong></td>
                    <td><span class="kat-badge <?= $bc ?>"><?= htmlspecialchars($kat) ?></span></td>
                    <td><?php if(!empty($row['gambar'])): ?><img src="../umum/foto/<?= htmlspecialchars($row['gambar']) ?>" class="thumb"><?php else: ?>-<?php endif; ?></td>
                    <td><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                    <td style="display:flex;gap:6px;">
                        <a href="edit_artikel.php?id=<?= $row['id'] ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                        <a href="?page=artikel&hapus=<?= $row['id'] ?>" class="btn-del" onclick="return confirm('Hapus artikel ini?')"><i class="fas fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if(mysqli_num_rows(mysqli_query($conn,"SELECT id FROM artikel"))==0): ?>
                <tr><td colspan="6" style="text-align:center;color:#94a3b8;padding:30px;">Belum ada artikel</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>