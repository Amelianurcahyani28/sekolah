<?php
include 'koneksi.php';

// Tambah gallery
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];

    if ($_FILES['gambar']['name']) {
        $target_dir = "../umum/foto/";

        // Buat folder jika belum ada
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Biar nama file tidak bentrok
        $file_name = time() . '_' . basename($_FILES['gambar']['name']);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {

            // ✅ INSERT SUDAH BENAR
            mysqli_query($conn, "INSERT INTO gallery (judul, keterangan, gambar) 
            VALUES ('$judul', '$deskripsi', '$file_name')");

            echo "<script>alert('Foto berhasil ditambahkan!');</script>";
        } else {
            echo "<script>alert('Upload gagal!');</script>";
        }
    }
}

// Hapus gallery
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $data = mysqli_query($conn, "SELECT * FROM gallery WHERE id=$id");
    $row = mysqli_fetch_assoc($data);

    if ($row && $row['gambar']) {
        @unlink("../umum/foto/" . $row['gambar']);
    }

    mysqli_query($conn, "DELETE FROM gallery WHERE id=$id");
    header("Location: ?page=gallery");
    exit;
}

// Ambil data
$data = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");
?>

<div class="page-header">
    <h2>🖼️ Kelola Gallery</h2>
    <p>Kelola foto-foto kegiatan sekolah</p>
</div>

<div class="card-admin mb-4">
    <h5 class="mb-4">Tambah Foto</h5>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="judul" placeholder="Judul" required>
        <input type="text" name="deskripsi" placeholder="Deskripsi" required>
        <input type="file" name="gambar" required>
        <button type="submit" name="tambah">Upload</button>
    </form>
</div>

<div class="card-admin">
    <h5>Daftar Foto</h5>
    <table border="1" cellpadding="10">
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>

        <?php $no = 1; while($row = mysqli_fetch_assoc($data)) : ?>
        <tr>
            <td><?= $no++; ?></td>

            <td>
                <?php if($row['gambar']) : ?>
                    <img src="../umum/foto/<?= $row['gambar']; ?>" width="80">
                <?php else : ?>
                    Tidak ada foto
                <?php endif; ?>
            </td>

            <td><?= htmlspecialchars($row['judul']); ?></td>

            <!-- ✅ SUDAH PAKAI keterangan -->
            <td><?= htmlspecialchars($row['keterangan']); ?></td>

            <td>
                <a href="?page=gallery&hapus=<?= $row['id']; ?>" 
                onclick="return confirm('Yakin?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>