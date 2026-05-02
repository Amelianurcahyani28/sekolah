<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../umum/login.php");
    exit;
}
include '../umum/koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = "SELECT * FROM siswa WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data tidak ditemukan!'); window.location='datasiswa.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Siswa - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { background: #d81b60; color: white; width: 250px; height: 100vh; position: fixed; padding: 20px; }
        .content { margin-left: 250px; padding: 30px; background: #f8f9fa; min-height: 100vh; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Accusoft</h3>
        <hr>
        <div class="nav flex-column mt-4">
            <a href="admin.php" class="nav-link text-white mb-2">Dashboard</a>
            <a href="datasiswa.php" class="nav-link text-white bg-white bg-opacity-25 rounded mb-2">Data Siswa</a>
            <a href="artikel.php" class="nav-link text-white mb-2">Kelola Artikel</a>
            <a href="../umum/index.php" class="nav-link text-white mt-5 small">← Kembali ke Web</a>
        </div>
    <div class="content text-dark">
        <h3 class="fw-bold">Edit Data Siswa</h3>
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body p-4">
                <form method="POST" action="proses_edit.php">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                    <h5 class="fw-bold text-primary mb-3">👶 Data Anak</h5>
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap Anak</label>
                        <input type="text" name="nama_anak" class="form-control" value="<?php echo htmlspecialchars($data['nama_anak']); ?>" required>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select" required>
                                <option value="Laki-laki" <?php if($data['jenis_kelamin']=='Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                                <option value="Perempuan" <?php if($data['jenis_kelamin']=='Perempuan') echo 'selected'; ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $data['tanggal_lahir']; ?>" required>
                        </div>
                    <hr>
                    <h5 class="fw-bold text-primary mb-3">👨‍👩‍👧 Data Orang Tua</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Ayah</label>
                            <input type="text" name="nama_ayah" class="form-control" value="<?php echo htmlspecialchars($data['nama_ayah']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Ibu</label>
                            <input type="text" name="nama_ibu" class="form-control" value="<?php echo htmlspecialchars($data['nama_ibu']); ?>" required>
                        </div>
                    <div class="mb-3">
                        <label class="form-label">Pekerjaan Orang Tua</label>
                        <input type="text" name="pekerjaan_ortu" class="form-control" value="<?php echo htmlspecialchars($data['pekerjaan_ortu']); ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. HP Ayah</label>
                            <input type="text" name="no_hp_ayah" class="form-control" value="<?php echo htmlspecialchars($data['no_hp_ayah']); ?>">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. HP Ibu</label>
                            <input type="text" name="no_hp_ibu" class="form-control" value="<?php echo htmlspecialchars($data['no_hp_ibu']); ?>">
                        </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control" rows="2"><?php echo htmlspecialchars($data['alamat']); ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat Orang Tua (jika berbeda)</label>
                        <textarea name="alamat_ortu" class="form-control" rows="2"><?php echo htmlspecialchars($data['alamat_ortu']); ?></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="datasiswa.php" class="btn btn-secondary">Batal</a>
                    </div>
                </form>
            </div>
    </div>
</body>
</html>
