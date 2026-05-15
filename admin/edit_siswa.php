<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
include 'db.php';

$id     = isset($_GET['id']) ? intval($_GET['id']) : 0;
$result = mysqli_query($conn, "SELECT * FROM siswa WHERE id=$id");
$data   = mysqli_fetch_assoc($result);
if (!$data) { echo "<script>alert('Data tidak ditemukan!');window.location='admin.php?page=siswa';</script>"; exit; }

if (isset($_POST['update'])) {
    $nama_anak     = mysqli_real_escape_string($conn, $_POST['nama']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['ttl']);
    $alamat        = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $nama_ayah     = mysqli_real_escape_string($conn, $_POST['nama_ayah']);
    $nama_ibu      = mysqli_real_escape_string($conn, $_POST['nama_ibu']);
    $no_hp_ortu    = mysqli_real_escape_string($conn, $_POST['no_ortu']);
    if (mysqli_query($conn, "UPDATE siswa SET nama_anak='$nama_anak',jenis_kelamin='$jenis_kelamin',tanggal_lahir='$tanggal_lahir',nama_ayah='$nama_ayah',nama_ibu='$nama_ibu',no_hp_ortu='$no_hp_ortu',alamat='$alamat' WHERE id=$id")) {
        echo "<script>alert('Data berhasil diupdate!');window.location='admin.php?page=siswa';</script>"; exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Siswa · Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *{box-sizing:border-box;margin:0;padding:0;}
        body{font-family:'Inter',sans-serif;background:#f1f5f9;min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;}
        .edit-wrap{background:white;border-radius:20px;border:1px solid #e2e8f0;width:100%;max-width:680px;overflow:hidden;box-shadow:0 10px 40px rgba(0,0,0,.08);}
        .edit-head{padding:24px 28px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;justify-content:space-between;}
        .edit-head h4{font-size:1.1rem;font-weight:700;color:#0f172a;}
        .edit-head .back{display:inline-flex;align-items:center;gap:6px;font-size:.82rem;color:#64748b;text-decoration:none;font-weight:500;padding:6px 12px;border-radius:8px;border:1px solid #e2e8f0;transition:all .2s;}
        .edit-head .back:hover{border-color:#6366f1;color:#6366f1;}
        .edit-body{padding:28px;}
        .form-label{display:block;font-size:.8rem;font-weight:600;color:#374151;margin-bottom:5px;}
        .form-control,.form-select{width:100%;border:1.5px solid #e2e8f0;border-radius:10px;padding:10px 14px;font-size:.88rem;color:#1e293b;font-family:'Inter',sans-serif;transition:border-color .2s,box-shadow .2s;outline:none;}
        .form-control:focus,.form-select:focus{border-color:#6366f1;box-shadow:0 0 0 3px rgba(99,102,241,.12);}
        .mb3{margin-bottom:16px;}
        .row2{display:flex;gap:16px;}
        .col{flex:1;}
        @media(max-width:560px){.row2{flex-direction:column;}}
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
        <h4>👶 Edit Data Siswa</h4>
        <a href="admin.php?page=siswa" class="back"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>
    <form method="POST">
    <div class="edit-body">
        <div class="row2 mb3">
            <div class="col">
                <label class="form-label">Nama Anak</label>
                <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama_anak']) ?>" required>
            </div>
            <div class="col">
                <label class="form-label">Tempat, Tanggal Lahir</label>
                <input type="text" name="ttl" class="form-control" value="<?= htmlspecialchars($data['tanggal_lahir']) ?>" required>
            </div>
        </div>
        <div class="mb3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="Laki-laki" <?= $data['jenis_kelamin']=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $data['jenis_kelamin']=='Perempuan'?'selected':'' ?>>Perempuan</option>
            </select>
        </div>
        <div class="row2 mb3">
            <div class="col">
                <label class="form-label">Nama Ayah</label>
                <input type="text" name="nama_ayah" class="form-control" value="<?= htmlspecialchars($data['nama_ayah']) ?>" required>
            </div>
            <div class="col">
                <label class="form-label">Nama Ibu</label>
                <input type="text" name="nama_ibu" class="form-control" value="<?= htmlspecialchars($data['nama_ibu']) ?>" required>
            </div>
        </div>
        <div class="mb3">
            <label class="form-label">No. Telepon Orang Tua</label>
            <input type="text" name="no_ortu" class="form-control" value="<?= htmlspecialchars($data['no_hp_ortu']) ?>" required>
        </div>
        <div class="mb3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" required><?= htmlspecialchars($data['alamat']) ?></textarea>
        </div>
    </div>
    <div class="edit-foot">
        <a href="admin.php?page=siswa" class="btn-cancel">Batal</a>
        <button type="submit" name="update" class="btn-save">💾 Simpan Perubahan</button>
    </div>
    </form>
</div>
</body>
</html>
