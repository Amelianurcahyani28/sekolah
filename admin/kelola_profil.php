// TEST GIT
<?php
// Kelola Profil - Halaman Profil Website
include 'koneksi.php';

// Update konten profil
$cek = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
$data = mysqli_fetch_assoc($cek);

if (isset($_POST['update'])) {

    $tentang = $_POST['tentang'];
    $sarana = $_POST['sarana'];
    $prasarana = $_POST['prasarana'];
    $kepsek_nama = $_POST['kepsek_nama'];
    $kepsek_quote = $_POST['kepsek_quote'];

    $cek = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");

    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "UPDATE profil SET 
        tentang='$tentang',
        sarana='$sarana',
        prasarana='$prasarana',
        kepsek_nama='$kepsek_nama',
        kepsek_quote='$kepsek_quote'");
    } else {
        mysqli_query($conn, "INSERT INTO profil 
        (tentang, sarana, prasarana, kepsek_nama, kepsek_quote) 
        VALUES 
        ('$tentang', '$sarana', '$prasarana', '$kepsek_nama', '$kepsek_quote')");
    }

    echo "<script>alert('Berhasil diperbarui!');</script>";
}

// Ambil data
$data = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
$row = mysqli_fetch_assoc($data) ?? [
    'tentang' => 'TK Maessar Bayan adalah lembaga pendidikan anak usia dini...',
    'sarana' => 'Memiliki fasilitas ruang kelas yang memadai...',
    'prasarana' => 'Terdapat area bermain yang aman dan nyaman...',
    'kepsek_nama' => 'Hj. Siti Aisyah, S.Pd',
    'kepsek_quote' => 'Pendidikan adalah tiket masa depan...'
];
?>

<div class="page-header">
    <h2>👤 Kelola Profil</h2>
    <p>Kelola konten halaman profil sekolah</p>
</div>

<div class="card-admin mb-4">
    <h5 class="mb-4"><i class="fas fa-school"></i> Tentang Kami</h5>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Tentang Sekolah</label>
            <textarea name="tentang" class="form-control" rows="4" required><?= htmlspecialchars($row['tentang']); ?></textarea>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Sarana</label>
                    <textarea name="sarana" class="form-control" rows="3" required><?= htmlspecialchars($row['sarana']); ?></textarea>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Prasarana</label>
                    <textarea name="prasarana" class="form-control" rows="3" required><?= htmlspecialchars($row['prasarana']); ?></textarea>
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
                    <input type="text" name="kepsek_quote" class="form-control" value="<?= htmlspecialchars($row['kepsek_quote']); ?>" required>
                </div>
            </div>
        </div>
        
        <button type="submit" name="update" class="btn btn-admin">
            <i class="fas fa-save"></i> Simpan Perubahan
        </button>
    </form>
</div>