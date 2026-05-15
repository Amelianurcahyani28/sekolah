<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'db.php';

$keyword = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';

$query = "SELECT * FROM siswa";
if (!empty($keyword)) {
    $query .= " WHERE nama_anak LIKE '%$keyword%' OR nama_ayah LIKE '%$keyword%' OR nama_ibu LIKE '%$keyword%'";
}
$query .= " ORDER BY tanggal_daftar DESC";

$result = mysqli_query($conn, $query);

$countQuery = "SELECT COUNT(*) AS total FROM siswa";
$countResult = mysqli_query($conn, $countQuery);
$totalSiswa = ($countResult) ? mysqli_fetch_assoc($countResult)['total'] : 0;

if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    mysqli_query($conn, "DELETE FROM siswa WHERE id = $id");
    header("Location: datasiswa.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { background: #d81b60; color: white; width: 250px; height: 100vh; position: fixed; padding: 20px; }
        .content { margin-left: 250px; padding: 30px; background: #f8f9fa; min-height: 100vh; }
        .card-stat { border: none; border-radius: 15px; padding: 20px; color: white; }
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
            <a href="../index.php" class="nav-link text-white mt-5 small">← Kembali ke Web</a>
        </div>

    <div class="content text-dark">
        <h3 class="fw-bold">Data Siswa</h3>
        
        <div class="row mt-4 g-3">
            <div class="col-md-3">
                <div class="card card-stat shadow-sm" style="background:#d81b60">
                    <h6>Total Pendaftar</h6>
                    <h2><?php echo $totalSiswa; ?></h2>
                </div>
        </div>

        <div class="card border-0 shadow-sm mt-5">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h5 class="fw-bold mb-0">Daftar Siswa Terdaftar</h5>
                    <div class="d-flex gap-2">
                        <a href="tambah_siswa.php" class="btn btn-sm btn-success">+ Tambah Siswa</a>
                        <form method="GET" class="d-flex" style="max-width: 300px;">
                            <input type="text" name="cari" class="form-control form-control-sm me-2" placeholder="Cari nama..." value="<?php echo htmlspecialchars($keyword); ?>">
                            <button type="submit" class="btn btn-sm btn-outline-secondary">Cari</button>
                            <?php if (!empty($keyword)): ?>
                                <a href="datasiswa.php" class="btn btn-sm btn-outline-danger ms-2">Reset</a>
                            <?php endif; ?>
                        </form>
                    </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Anak</th>
                                <th>JK</th>
                                <th>Tgl Lahir</th>
                                <th>Ayah</th>
                                <th>Ibu</th>
                                <th>Pekerjaan Ortu</th>
                                <th>HP Ayah</th>
                                <th>HP Ibu</th>
                                <th>Alamat</th>
                                <th>Tgl Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($result) > 0): ?>
                                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_anak']); ?></td>
                                    <td><?php echo htmlspecialchars($row['jenis_kelamin']); ?></td>
                                    <td><?php echo htmlspecialchars($row['tanggal_lahir']); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_ayah'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($row['nama_ibu'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($row['pekerjaan_ortu'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_hp_ayah'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($row['no_hp_ibu'] ?? '-'); ?></td>
                                    <td><?php echo htmlspecialchars($row['alamat'] ?? '-'); ?></td>
                                    <td><?php echo date('d/m/Y', strtotime($row['tanggal_daftar'])); ?></td>
                                    <td>
                                        <a href="edit_siswa.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                                        <a href="?hapus=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="12" class="text-center text-muted">Tidak ada data siswa.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
        </div>
</body>
</html>
