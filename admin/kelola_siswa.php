<?php
// Kelola Siswa - Data Siswa TK
include 'koneksi.php';

// Tambah siswa
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $ttl = $_POST['ttl'];
    $alamat = $_POST['alamat'];
    $ortu = $_POST['ortu'];
    $no_ortu = $_POST['no_ortu'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    mysqli_query($conn, "INSERT INTO siswa 
    (nama_anak, tanggal_lahir, alamat, nama_ortu, no_hp, jenis_kelamin) 
    VALUES ('$nama', '$ttl', '$alamat', '$ortu', '$no_ortu', '$jenis_kelamin')");

    echo "<script>alert('Siswa berhasil ditambahkan!');</script>";
}

// Hapus siswa
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM siswa WHERE id=$id");
    echo "<script>window.location='?page=siswa';</script>";
    exit;
}

// Ambil data siswa
$data = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id DESC");
?>

<div class="page-header">
    <h2>👶 Kelola Siswa</h2>
    <p>Kelola data siswa TK Maessar Bayan</p>
</div>

<div class="card-admin mb-4">
    <h5 class="mb-4"><i class="fas fa-user-plus"></i> Tambah Siswa Baru</h5>
    <form method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Anak</label>
                    <input type="text" name="nama" class="form-control" placeholder="Nama lengkap siswa" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Tempat, Tanggal Lahir</label>
                    <input type="text" name="ttl" class="form-control" placeholder="Contoh: Jakarta, 1 Januari 2020" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap" required></textarea>
        </div>
          <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Orang Tua</label>
                    <input type="text" name="ortu" class="form-control" placeholder="Nama orang tua/wali" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">No. Telepon Orang Tua</label>
                    <input type="text" name="no_ortu" class="form-control" placeholder="Nomor yang dapat dihubungi" required>
                </div>
            </div>
        </div>
        <button type="submit" name="tambah" class="btn btn-admin">
            <i class="fas fa-save"></i> Simpan Data Siswa
        </button>
    </form>
</div>

<div class="card-admin">
    <h5 class="mb-4"><i class="fas fa-users"></i> Daftar Siswa</h5>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tgl Lahir</th>
                    <th>Alamat</th>
                    <th>Nama Ortu</th>
                    <th>No Telpon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong><?= htmlspecialchars($row['nama_anak']); ?></strong></td>
                     <td><?= htmlspecialchars($row['tanggal_lahir']); ?></td>
                     <td><?= htmlspecialchars($row['alamat']); ?></td>
                    <td><?= htmlspecialchars($row['nama_ortu']); ?></td>
                    <td><?= htmlspecialchars($row['no_hp']); ?></td>
                    <td>
                        <a href="?page=siswa&hapus=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
                
                <?php if(mysqli_num_rows($data) == 0) : ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data siswa</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>