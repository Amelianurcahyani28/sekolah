<?php
// Kelola Beranda - Halaman Utama Website
include 'koneksi.php';

// Update konten beranda
if (isset($_POST['update'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    
    // Cek apakah data ada
    $cek = mysqli_query($conn, "SELECT * FROM beranda LIMIT 1");
    if (mysqli_num_rows($cek) > 0) {
        mysqli_query($conn, "UPDATE beranda SET judul='$judul', deskripsi='$deskripsi' WHERE id=1");
    } else {
        mysqli_query($conn, "INSERT INTO beranda VALUES('', '$judul', '$deskripsi')");
    }
    echo "<script>alert('Berhasil diperbarui!');</script>";
}

// Ambil data
$data = mysqli_query($conn, "SELECT * FROM beranda ORDER BY id DESC");
$row = mysqli_fetch_assoc($data) ?? ['judul' => 'TK Maessar Bayan', 'deskripsi' => 'Pendidikan usia dini yang menyenangkan'];

// Hitung total gallery
$gallery_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM gallery");
$gallery_row = mysqli_fetch_assoc($gallery_count);
$gallery_total = $gallery_row['total'];

// Hitung total artikel
$artikel_count = mysqli_query($conn, "SELECT COUNT(*) as total FROM artikel");
$artikel_row = mysqli_fetch_assoc($artikel_count);
$artikel_total = $artikel_row['total'];
?>

<div class="page-header">
    <h2>🎈 Kelola Beranda</h2>
    <p>Kelola konten halaman utama website</p>
</div>

<div class="row mt-4">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-number"><?php echo $gallery_total; ?></div>
            <div class="stat-label">Gallery Published</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-number">54</div>
            <div class="stat-label">Pendaftaran Baru</div>
        </div>
    </div>
    <div class="col-md-4">
        <a href="kelola_artikel.php" style="text-decoration: none; color: inherit; display: block;">
            <div class="stat-card">
                <div class="stat-number"><?php echo $artikel_total; ?></div>
                <div class="stat-label">Artikel Published</div>
            </div>
        </a>
    </div>
</div>