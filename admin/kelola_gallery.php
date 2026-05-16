<?php
include 'db.php';

if (isset($_POST['tambah'])) {
    $judul     = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    if ($_FILES['gambar']['name']) {
        $target_dir = "../umum/foto/";
        if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
        $file_name   = time() . '_' . basename($_FILES['gambar']['name']);
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            mysqli_query($conn, "INSERT INTO gallery (judul, deskripsi, gambar) VALUES ('$judul', '$deskripsi', '$file_name')");
            header("Location: ?page=gallery&status=success"); exit;
        } else {
            header("Location: ?page=gallery&status=failed"); exit;
        }
    }
}

if (isset($_GET['hapus'])) {
    $id  = $_GET['hapus'];
    $res = mysqli_query($conn, "SELECT * FROM gallery WHERE id=$id");
    $r   = mysqli_fetch_assoc($res);
    if ($r && $r['gambar']) @unlink("../umum/foto/" . $r['gambar']);
    mysqli_query($conn, "DELETE FROM gallery WHERE id=$id");
    header("Location: ?page=gallery"); exit;
}

$data = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");
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
.btn-edit{background:#fef3c7;color:#b45309;border:none;border-radius:7px;padding:5px 12px;font-size:.78rem;font-weight:600;cursor:pointer;text-decoration:none;transition:all .2s;}
.btn-edit:hover{background:#fde68a;}
.btn-del{background:#fee2e2;color:#dc2626;border:none;border-radius:7px;padding:5px 12px;font-size:.78rem;font-weight:600;cursor:pointer;text-decoration:none;transition:all .2s;}
.btn-del:hover{background:#fecaca;}
.alert-ok{background:#dcfce7;border:1px solid #bbf7d0;color:#15803d;padding:10px 16px;border-radius:10px;font-size:.88rem;margin-bottom:16px;}
.alert-err{background:#fee2e2;border:1px solid #fecaca;color:#dc2626;padding:10px 16px;border-radius:10px;font-size:.88rem;margin-bottom:16px;}
</style>

<p class="page-title">Kelola Gallery</p>
<p class="page-sub">Upload dan kelola foto-foto kegiatan sekolah</p>

<?php if(isset($_GET['status'])): ?>
    <?php if($_GET['status']==='success'): ?>
        <div class="alert-ok">✓ Foto berhasil diunggah.</div>
    <?php else: ?>
        <div class="alert-err">✗ Upload gagal. Periksa folder & izin file.</div>
    <?php endif; ?>
<?php endif; ?>

<!-- Form Tambah -->
<div class="mod-card">
    <h6>➕ Upload Foto Baru</h6>
    <form method="POST" enctype="multipart/form-data">
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Judul Foto</label>
                <input type="text" name="judul" class="form-control" placeholder="Judul foto" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Keterangan</label>
                <input type="text" name="deskripsi" class="form-control" placeholder="Keterangan singkat" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">File Foto</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" name="tambah" class="btn-save">Upload Foto</button>
    </form>
</div>

<!-- Tabel -->
<div class="mod-card">
    <h6>📋 Daftar Foto</h6>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr><th>#</th><th>Foto</th><th>Judul</th><th>Keterangan</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                <?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?php if($row['gambar']): ?><img src="../umum/foto/<?= htmlspecialchars($row['gambar']) ?>" class="thumb"><?php else: ?>-<?php endif; ?></td>
                    <td><strong><?= htmlspecialchars($row['judul']) ?></strong></td>
                    <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                    <td style="display:flex;gap:6px;">
                        <a href="edit_gallery.php?id=<?= $row['id'] ?>" class="btn-edit"><i class="fas fa-edit"></i> Edit</a>
                        <a href="?page=gallery&hapus=<?= $row['id'] ?>" class="btn-del" onclick="return confirm('Hapus foto ini?')"><i class="fas fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php if(mysqli_num_rows(mysqli_query($conn,"SELECT id FROM gallery"))==0): ?>
                <tr><td colspan="5" style="text-align:center;color:#94a3b8;padding:30px;">Belum ada foto</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
