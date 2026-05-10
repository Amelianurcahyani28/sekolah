<?php
// Kelola Artikel - Halaman Artikel Website
include 'koneksi.php';

// Pastikan kolom gambar ada di tabel artikel
$checkColumn = mysqli_query($conn, "SHOW COLUMNS FROM artikel LIKE 'gambar'");
if (!$checkColumn || mysqli_num_rows($checkColumn) === 0) {
    mysqli_query($conn, "ALTER TABLE artikel ADD gambar VARCHAR(200) DEFAULT NULL");
}

// Tambah artikel
if (isset($_POST['tambah'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $isi = mysqli_real_escape_string($conn, $_POST['isi']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);
    $gambar = null;

    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "../umum/foto/";
        
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_name = time() . '_' . basename($_FILES['gambar']['name']);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            $gambar = $file_name;
        } else {
            echo "<script>alert('Upload gambar artikel gagal. Artikel ditambahkan tanpa gambar.');</script>";
        }
    }

    if ($gambar) {
        mysqli_query($conn, "INSERT INTO artikel (judul, isi, kategori, gambar, tanggal) VALUES ('$judul', '$isi', '$kategori', '$gambar', NOW())");
    } else {
        mysqli_query($conn, "INSERT INTO artikel (judul, isi, kategori, tanggal) VALUES ('$judul', '$isi', '$kategori', NOW())");
    }

    echo "<script>alert('Artikel berhasil ditambahkan!');</script>";
}

// Hapus artikel
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM artikel WHERE id=$id");
    header("Location: ?page=artikel");
    exit;
}

// Ambil data artikel
$data = mysqli_query($conn, "SELECT * FROM artikel ORDER BY id DESC");
?>

<div class="page-header">
    <h2>📰 Kelola Artikel</h2>
    <p>Kelola artikel dan berita sekolah</p>
</div>

<div class="card-admin mb-4">
    <h5 class="mb-4"><i class="fas fa-plus-circle"></i> Tambah Artikel Baru</h5>
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Judul Artikel</label>
                    <input type="text" name="judul" class="form-control" placeholder="Judul artikel" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">Pilih Kategori</option>
                        <option value="edukasi">📚 Edukasi</option>
                        <option value="parenting">👨‍👩‍👧 Parenting</option>
                        <option value="kesehatan">💪 Kesehatan</option>
                        <option value="kegitan">🎉 Kegiatan</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Isi Artikel</label>
            <textarea name="isi" class="form-control" rows="6" placeholder="Tulis artikel di sini..." required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto Artikel</label>
            <input type="file" name="gambar" class="form-control" accept="image/*" required>
        </div>
        <button type="submit" name="tambah" class="btn btn-admin">
            <i class="fas fa-paper-plane"></i> Publikasikan
        </button>
    </form>
</div>

<div class="card-admin">
    <h5 class="mb-4"><i class="fas fa-list"></i> Daftar Artikel</h5>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Foto</th>
                    <th>Isi Singkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; while($row = mysqli_fetch_assoc($data)) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><strong><?= htmlspecialchars($row['judul']); ?></strong></td>
                    <td>
                        <?php 
                        $badgeClass = [
                            'edukasi' => 'bg-warning',
                            'parenting' => 'bg-secondary',
                            'kesehatan' => 'bg-success',
                            'kegitan' => 'bg-info'
                        ];
                        $badge = $badgeClass[$row['kategori']] ?? 'bg-primary';
                        ?>
                        <span class="badge <?= $badge; ?>"><?= htmlspecialchars($row['kategori']); ?></span>
                    </td>
                    <td>
                        <?php if (!empty($row['gambar'])) : ?>
                            <img src="../umum/foto/<?= htmlspecialchars($row['gambar']); ?>" width="100" alt="Foto Artikel">
                        <?php else : ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td><?= substr(htmlspecialchars($row['isi']), 0, 80); ?>...</td>
                    <td>
                        <a href="edit_artikel.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm me-2">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="?page=artikel&hapus=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                            <i class="fas fa-trash"></i> Hapus
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
                
                <?php if(mysqli_num_rows($data) == 0) : ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada artikel</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>