<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: ../umum/login.php"); exit; }
include '../umum/koneksi.php';

$id     = isset($_GET['id']) ? intval($_GET['id']) : 0;
$result = mysqli_query($conn, "SELECT * FROM gallery WHERE id=$id");
$data   = mysqli_fetch_assoc($result);
if (!$data) { echo "<script>alert('Data tidak ditemukan!');window.location='admin.php?page=gallery';</script>"; exit; }

if (isset($_POST['update'])) {
    $judul     = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar    = $data['gambar'];
    if (!empty($_FILES['gambar']['name'])) {
        $td = "../umum/foto/";
        if (!is_dir($td)) mkdir($td, 0777, true);
        $fn = time() . '_' . basename($_FILES['gambar']['name']);
        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $td.$fn)) {
            if ($gambar && file_exists($td.$gambar)) @unlink($td.$gambar);
            $gambar = $fn;
        }
    }
    if (mysqli_query($conn, "UPDATE gallery SET judul='$judul',keterangan='$deskripsi',gambar='$gambar' WHERE id=$id")) {
        echo "<script>alert('Berhasil diupdate!');window.location='admin.php?page=gallery';</script>"; exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery · Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
        body{font-family:'Inter',sans-serif;background:#f1f5f9;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;}
        .edit-wrap{background:white;border-radius:20px;border:1px solid #e2e8f0;width:100%;max-width:560px;overflow:hidden;box-shadow:0 10px 40px rgba(0,0,0,.08);}
        .edit-head{padding:24px 28px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;}
        .edit-head h4{font-size:1.1rem;font-weight:700;color:#0f172a;}
        .edit-head .back{display:inline-flex;align-items:center;gap:6px;font-size:.82rem;color:#64748b;text-decoration:none;font-weight:500;padding:6px 12px;border-radius:8px;border:1px solid #e2e8f0;transition:all .2s;}
        .edit-head .back:hover{border-color:#6366f1;color:#6366f1;}
        .edit-body{padding:28px;}
        .form-label{display:block;font-size:.8rem;font-weight:600;color:#374151;margin-bottom:5px;}
        .form-control{width:100%;border:1.5px solid #e2e8f0;border-radius:10px;padding:10px 14px;font-size:.88rem;color:#1e293b;font-family:'Inter',sans-serif;transition:border-color .2s,box-shadow .2s;outline:none;}
        .form-control:focus{border-color:#6366f1;box-shadow:0 0 0 3px rgba(99,102,241,.12);}
        .mb3{margin-bottom:16px;}
        .img-preview{width:100px;height:74px;border-radius:8px;object-fit:cover;border:1.5px solid #e2e8f0;margin-top:8px;}
        .hint{font-size:.75rem;color:#94a3b8;margin-top:4px;}
        .edit-foot{padding:20px 28px;border-top:1px solid #f1f5f9;display:flex;gap:12px;}
        .btn-save{background:linear-gradient(135deg,#6366f1,#8b5cf6);color:white;border:none;border-radius:9px;padding:10px 24px;font-size:.88rem;font-weight:600;cursor:pointer;flex:1;transition:all .2s;}
        .btn-save:hover{opacity:.88;transform:translateY(-1px);}
        .btn-cancel{background:#f8fafc;color:#475569;border:1.5px solid #e2e8f0;border-radius:9px;padding:10px 24px;font-size:.88rem;font-weight:600;text-decoration:none;flex:1;text-align:center;transition:all .2s;}
        .btn-cancel:hover{border-color:#6366f1;color:#6366f1;}
    </style>
</head>
<body>
<div class="edit-wrap">
    <div class="edit-head">
        <h4>🖼️ Edit Foto Gallery</h4>
        <a href="admin.php?page=gallery" class="back"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <form method="POST" enctype="multipart/form-data">
    <div class="edit-body">
        <div class="mb3">
            <label class="form-label">Judul Foto</label>
            <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($data['judul']) ?>" required>
        </div>
        <div class="mb3">
            <label class="form-label">Keterangan</label>
            <input type="text" name="deskripsi" class="form-control" value="<?= htmlspecialchars($data['keterangan']) ?>" required>
        </div>
        <div class="mb3">
            <label class="form-label">Ganti Foto (Opsional)</label>
            <input type="file" name="gambar" class="form-control" accept="image/*">
            <p class="hint">Biarkan kosong jika tidak ingin mengganti</p>
            <?php if(!empty($data['gambar'])): ?>
            <img src="../umum/foto/<?= htmlspecialchars($data['gambar']) ?>" class="img-preview" alt="Foto">
            <?php endif; ?>
        </div>
    </div>
    <div class="edit-foot">
        <a href="admin.php?page=gallery" class="btn-cancel">Batal</a>
        <button type="submit" name="update" class="btn-save">💾 Simpan Perubahan</button>
    </div>
    </form>
</div>
</body>
</html>
