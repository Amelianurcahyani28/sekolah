<?php
// Kelola Profil - Halaman Profil Website
include 'koneksi.php';

// Pastikan tabel profil ada terlebih dahulu (opsional, tapi disarankan)
$checkTable = mysqli_query($conn, "SHOW TABLES LIKE 'profil'");
if ($checkTable && mysqli_num_rows($checkTable) === 0) {
    // Jika tabel profil belum ada, buat tabelnya
    mysqli_query($conn, "CREATE TABLE profil (
        id INT AUTO_INCREMENT PRIMARY KEY,
        visi TEXT,
        misi TEXT,
        kepsek_nama VARCHAR(100),
        kepsek_quote TEXT,
        kepsek_foto VARCHAR(200),
        foto_sekolah VARCHAR(200)
    )");
}

// Pastikan kolom kepsek_foto dan foto_sekolah ada di tabel profil
$checkColumn = mysqli_query($conn, "SHOW COLUMNS FROM profil LIKE 'kepsek_foto'");
if ($checkColumn && mysqli_num_rows($checkColumn) === 0) {
    mysqli_query($conn, "ALTER TABLE profil ADD kepsek_foto VARCHAR(200) DEFAULT NULL");
}
$checkColumnSekolah = mysqli_query($conn, "SHOW COLUMNS FROM profil LIKE 'foto_sekolah'");
if ($checkColumnSekolah && mysqli_num_rows($checkColumnSekolah) === 0) {
    mysqli_query($conn, "ALTER TABLE profil ADD foto_sekolah VARCHAR(200) DEFAULT NULL");
}

// Update konten profil
$cek = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
$data = $cek ? mysqli_fetch_assoc($cek) : null;

if (isset($_POST['update'])) {

    $tentang = $_POST['tentang'];
    $visi = $_POST['visi'];
    $misi = $_POST['misi'];
    $kepsek_nama = $_POST['kepsek_nama'];
    $kepsek_quote = $_POST['kepsek_quote'];
    $kepsek_foto = $data['kepsek_foto'] ?? '';
    $foto_sekolah = $data['foto_sekolah'] ?? '';

    // Proses upload foto kepsek
    if (!empty($_FILES['kepsek_foto']['name'])) {
        $target_dir = "../umum/foto/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_name = time() . '_kepsek_' . basename($_FILES['kepsek_foto']['name']);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES['kepsek_foto']['tmp_name'], $target_file)) {
            if (!empty($kepsek_foto) && file_exists($target_dir . $kepsek_foto)) {
                @unlink($target_dir . $kepsek_foto);
            }
            $kepsek_foto = $file_name;
        }
    }

    // Proses upload foto sekolah
    if (!empty($_FILES['foto_sekolah']['name'])) {
        $target_dir = "../umum/foto/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $file_name_sekolah = time() . '_sekolah_' . basename($_FILES['foto_sekolah']['name']);
        $target_file_sekolah = $target_dir . $file_name_sekolah;

        if (move_uploaded_file($_FILES['foto_sekolah']['tmp_name'], $target_file_sekolah)) {
            if (!empty($foto_sekolah) && file_exists($target_dir . $foto_sekolah)) {
                @unlink($target_dir . $foto_sekolah);
            }
            $foto_sekolah = $file_name_sekolah;
        }
    }

    $cek = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");

    if ($cek && mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "UPDATE profil SET 
        tentang='$tentang',
        visi='$visi',
        misi='$misi',
        kepsek_nama='$kepsek_nama',
        kepsek_quote='$kepsek_quote',
        kepsek_foto='$kepsek_foto',
        foto_sekolah='$foto_sekolah'");
    } else {
        mysqli_query($conn, "INSERT INTO profil 
        (tentang, visi, misi, kepsek_nama, kepsek_quote, kepsek_foto, foto_sekolah) 
        VALUES 
        ('$tentang', '$visi', '$misi', '$kepsek_nama', '$kepsek_quote', '$kepsek_foto', '$foto_sekolah')");
    }

    echo "<script>alert('Berhasil diperbarui!'); window.location='admin.php?page=profil';</script>";
}

// Ambil data
$result = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
$row = ($result ? mysqli_fetch_assoc($result) : null);

if (!$row) {
    $row = [
        'tentang' => 'TK Maessar Bayan adalah lembaga pendidikan anak usia dini...',
        'visi' => 'Memiliki fasilitas ruang kelas yang memadai...',
        'misi' => 'Terdapat area bermain yang aman dan nyaman...',
        'kepsek_nama' => 'Hj. Siti Aisyah, S.Pd',
        'kepsek_quote' => 'Pendidikan adalah tiket masa depan...',
        'kepsek_foto' => '',
        'foto_sekolah' => ''
    ];
}
?>

<div class="page-header">
    <h2>👤 Kelola Profil</h2>
    <p>Kelola konten halaman profil sekolah</p>
</div>

<div class="card-admin mb-4">
    <h5 class="mb-4"><i class="fas fa-school"></i> Tentang Kami</h5>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8">
                <div class="mb-3">
                    <label class="form-label">Tentang Sekolah</label>
                    <textarea name="tentang" class="form-control" rows="5" required><?= htmlspecialchars($row['tentang']); ?></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label">Foto Utama Sekolah (Opsional)</label>
                    <input type="file" name="foto_sekolah" class="form-control" accept="image/*">
                    <div class="mt-2 text-muted small">Foto saat ini:</div>
                    <?php 
                        $preview_sekolah = !empty($row['foto_sekolah']) ? "../umum/foto/" . htmlspecialchars($row['foto_sekolah']) : "../umum/sekolah.jpeg"; 
                    ?>
                    <img src="<?= $preview_sekolah; ?>" width="100%" style="max-width:200px" class="mt-2 border rounded shadow-sm" alt="Foto Sekolah">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Visi</label>
                    <textarea name="visi" class="form-control" rows="3" required><?= htmlspecialchars($row['visi']); ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Misi</label>
                    <textarea name="misi" class="form-control" rows="3" required><?= htmlspecialchars($row['misi']); ?></textarea>
                </div>
            </div>
        </div>
        
        <hr class="my-4">
        
        <h5 class="mb-4"><i class="fas fa-user-tie"></i> Kepala Sekolah</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nama Kepala Sekolah</label>
                    <input type="text" name="kepsek_nama" class="form-control" value="<?= htmlspecialchars($row['kepsek_nama']); ?>" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Quote</label>
                    <input type="text" name="kepsek_quote" class="form-control" value="<?= htmlspecialchars($row['kepsek_quote'] ?? ''); ?>" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="mb-3">
                    <label class="form-label">Foto Kepala Sekolah (Opsional)</label>
                    <input type="file" name="kepsek_foto" class="form-control" accept="image/*">
                    <?php if (!empty($row['kepsek_foto'])) : ?>
                        <div class="mt-2 text-muted small">Foto saat ini:</div>
                        <img src="../umum/foto/<?= htmlspecialchars($row['kepsek_foto']); ?>" width="100" class="mt-2 border rounded" alt="Foto Kepala Sekolah">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <button type="submit" name="update" class="btn btn-admin">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
    </form>
</div>