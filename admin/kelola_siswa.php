<?php
include 'koneksi.php';

// ==========================================
// SIMPAN DATA SISWA
// ==========================================
if (isset($_POST['tambah'])) {

    $nama_anak      = mysqli_real_escape_string($conn, $_POST['nama']);
    $tanggal_lahir  = mysqli_real_escape_string($conn, $_POST['ttl']);
    $alamat         = mysqli_real_escape_string($conn, $_POST['alamat']);
    $jenis_kelamin  = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $nama_ayah      = mysqli_real_escape_string($conn, $_POST['nama_ayah']);
    $nama_ibu       = mysqli_real_escape_string($conn, $_POST['nama_ibu']);
    $no_hp_ortu     = mysqli_real_escape_string($conn, $_POST['no_ortu']);

    $query_tambah = "INSERT INTO siswa 
    (
        nama_anak,
        jenis_kelamin,
        tanggal_lahir,
        nama_ayah,
        nama_ibu,
        no_hp_ortu,
        alamat
    ) 
    
    VALUES 
    (
        '$nama_anak',
        '$jenis_kelamin',
        '$tanggal_lahir',
        '$nama_ayah',
        '$nama_ibu',
        '$no_hp_ortu',
        '$alamat'
    )";

    if (mysqli_query($conn, $query_tambah)) {

        echo "<script>
                alert('Siswa berhasil ditambahkan!');
                window.location='admin.php?page=siswa';
              </script>";
        exit;

    } else {

        echo "<div class='alert alert-danger'>
                Gagal menambah data: " . mysqli_error($conn) . "
              </div>";
    }
}

// ==========================================
// SIMPAN INFORMASI SEKOLAH
// ==========================================
if (isset($_POST['simpan_info'])) {

    $alamat_sekolah = mysqli_real_escape_string($conn, $_POST['alamat_sekolah']);
    $no_telp        = mysqli_real_escape_string($conn, $_POST['no_telp']);
    $email          = mysqli_real_escape_string($conn, $_POST['email']);

    // cek data di tabel profil
    $cek = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");

    if (mysqli_num_rows($cek) > 0) {

        $query_info = "UPDATE profil SET
                        alamat_sekolah='$alamat_sekolah',
                        no_telp='$no_telp',
                        email='$email'";

    } else {

        $query_info = "INSERT INTO profil
                        (alamat_sekolah, no_telp, email)
                        VALUES
                        ('$alamat_sekolah', '$no_telp', '$email')";
    }

    if (mysqli_query($conn, $query_info)) {

        echo "<script>
                alert('Informasi sekolah berhasil disimpan!');
                window.location='admin.php?page=siswa';
              </script>";
        exit;

    } else {

        echo "<div class='alert alert-danger'>
                Gagal menyimpan informasi sekolah: " . mysqli_error($conn) . "
              </div>";
    }
}

// ==========================================
// HAPUS DATA SISWA
// ==========================================
if (isset($_GET['hapus'])) {

    $id = mysqli_real_escape_string($conn, $_GET['hapus']);

    mysqli_query($conn, "DELETE FROM siswa WHERE id='$id'");

    echo "<script>
            alert('Data berhasil dihapus!');
            window.location='admin.php?page=siswa';
          </script>";
    exit;
}

// ==========================================
// AMBIL DATA SISWA
// ==========================================
$data = mysqli_query($conn, "SELECT * FROM siswa ORDER BY id DESC");

// ==========================================
// AMBIL INFO SEKOLAH DARI TABEL PROFIL
// ==========================================
$info = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
$infoSekolah = mysqli_fetch_assoc($info);
?>

<div class="page-header">
    <h2>👶 Kelola Siswa</h2>
    <p>Kelola data siswa PAUD Maessar Bayan</p>
</div>

<!-- FORM TAMBAH SISWA -->
<div class="card-admin mb-4">

    <h5 class="mb-4">
        <i class="fas fa-user-plus"></i> Tambah Siswa Baru
    </h5>

    <form method="POST">

        <div class="row">

            <div class="col-md-6">
                <div class="mb-3">

                    <label class="form-label">Nama Anak</label>

                    <input type="text"
                        name="nama"
                        class="form-control"
                        required>

                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">

                    <label class="form-label">Tempat, Tanggal Lahir</label>

                    <input type="text"
                        name="ttl"
                        class="form-control"
                        required>

                </div>
            </div>

        </div>

        <div class="mb-3">

            <label class="form-label">Alamat Rumah</label>

            <textarea name="alamat"
                class="form-control"
                rows="2"
                required></textarea>

        </div>

        <div class="mb-3">

            <label class="form-label">Jenis Kelamin</label>

            <select name="jenis_kelamin"
                class="form-select"
                required>

                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>

            </select>

        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="mb-3">

                    <label class="form-label">Nama Ayah</label>

                    <input type="text"
                        name="nama_ayah"
                        class="form-control"
                        required>

                </div>
            </div>

            <div class="col-md-6">
                <div class="mb-3">

                    <label class="form-label">Nama Ibu</label>

                    <input type="text"
                        name="nama_ibu"
                        class="form-control"
                        required>

                </div>
            </div>

        </div>

        <div class="mb-3">

            <label class="form-label">No HP Orang Tua</label>

            <input type="text"
                name="no_ortu"
                class="form-control"
                required>

        </div>

        <button type="submit"
            name="tambah"
            class="btn btn-admin">

            <i class="fas fa-save"></i>
            Simpan Data Siswa

        </button>

    </form>

</div>

<!-- INFORMASI SEKOLAH -->
<div class="card-admin mb-4">

    <h5 class="mb-4">
        <i class="fas fa-school"></i> Informasi Sekolah
    </h5>

    <form method="POST">

        <div class="mb-3">

            <label class="form-label">Alamat Sekolah</label>

            <textarea name="alamat_sekolah"
                class="form-control"
                rows="2"><?= htmlspecialchars($infoSekolah['alamat_sekolah'] ?? ''); ?></textarea>

        </div>

        <div class="mb-3">

            <label class="form-label">No Telepon Sekolah</label>

            <input type="text"
                name="no_telp"
                class="form-control"
                value="<?= htmlspecialchars($infoSekolah['no_telp'] ?? ''); ?>">

        </div>

        <div class="mb-3">

            <label class="form-label">Email Sekolah</label>

            <input type="email"
                name="email"
                class="form-control"
                value="<?= htmlspecialchars($infoSekolah['email'] ?? ''); ?>">

        </div>

        <button type="submit"
            name="simpan_info"
            class="btn btn-success">

            <i class="fas fa-save"></i>
            Simpan Informasi Sekolah

        </button>

    </form>

</div>

<!-- TABEL SISWA -->
<div class="card-admin">

    <h5 class="mb-4">
        <i class="fas fa-users"></i> Daftar Siswa
    </h5>

    <div class="table-responsive">

        <table class="table table-hover">

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tgl Lahir</th>
                    <th>Alamat</th>
                    <th>Orang Tua</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

                <?php
                $no = 1;

                if (mysqli_num_rows($data) > 0) :
                    while ($row = mysqli_fetch_assoc($data)) :
                ?>

                <tr>

                    <td><?= $no++; ?></td>

                    <td>
                        <strong><?= htmlspecialchars($row['nama_anak']); ?></strong>
                    </td>

                    <td><?= htmlspecialchars($row['tanggal_lahir']); ?></td>

                    <td><?= htmlspecialchars($row['alamat']); ?></td>

                    <td>
                        <?= htmlspecialchars($row['nama_ayah']); ?>
                        &
                        <?= htmlspecialchars($row['nama_ibu']); ?>
                    </td>

                    <td><?= htmlspecialchars($row['no_hp_ortu']); ?></td>

                    <td>

                        <a href="edit_siswa.php?id=<?= $row['id']; ?>"
                            class="btn btn-warning btn-sm me-2">

                            <i class="fas fa-edit"></i>
                            Edit

                        </a>

                        <a href="admin.php?page=siswa&hapus=<?= $row['id']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin menghapus data siswa ini?')">

                            <i class="fas fa-trash"></i>
                            Hapus

                        </a>

                    </td>

                </tr>

                <?php
                    endwhile;
                else :
                ?>

                <tr>

                    <td colspan="7" class="text-center text-muted">
                        Belum ada data siswa
                    </td>

                </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

</div>