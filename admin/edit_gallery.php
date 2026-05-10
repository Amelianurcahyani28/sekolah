<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../umum/login.php");
    exit;
}
include '../umum/koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$query = "SELECT * FROM gallery WHERE id = $id";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "<script>alert('Data foto tidak ditemukan!'); window.location='admin.php?page=gallery';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $judul = mysqli_real_escape_string($conn, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    $gambar = $data['gambar']; // Gambar lama sebagai default

    // Cek jika ada gambar baru yang diunggah
    if (!empty($_FILES['gambar']['name'])) {
        $target_dir = "../umum/foto/";
        
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $file_name = time() . '_' . basename($_FILES['gambar']['name']);
        $target_file = $target_dir . $file_name;

        if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
            // Hapus gambar lama jika ada
            if (!empty($gambar) && file_exists($target_dir . $gambar)) {
                @unlink($target_dir . $gambar);
            }
            $gambar = $file_name;
        } else {
            echo "<script>alert('Upload gambar baru gagal. Menggunakan gambar lama.');</script>";
        }
    }

    // UPDATE query menggunakan keterangan
    $query_update = "UPDATE gallery SET 
                        judul = '$judul', 
                        keterangan = '$deskripsi', 
                        gambar = '$gambar' 
                     WHERE id = $id";

    if (mysqli_query($conn, $query_update)) {
        echo "<script>
                alert('Foto gallery berhasil diupdate!');
                window.location='admin.php?page=gallery';
              </script>";
        exit;
    } else {
        $error_msg = "Gagal mengupdate foto: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gallery - Admin TK Maessar Bayan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --pastel-pink: #ffb6c1;
            --pastel-purple: #dda0dd;
            --cute-pink: #ff85a2;
            --cute-purple: #b19cd9;
        }
        body {
            background: linear-gradient(135deg, rgba(255,182,193,0.5) 0%, rgba(221,160,221,0.5) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Quicksand', sans-serif;
            margin: 0;
            padding: 20px;
        }
        .edit-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(255, 133, 162, 0.2);
            width: 100%;
            max-width: 600px;
            padding: 35px;
            position: relative;
        }
        .edit-card h4 {
            font-weight: 800;
            background: linear-gradient(45deg, var(--cute-pink), var(--cute-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .form-label {
            color: #555;
            font-weight: 600;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: var(--cute-pink);
            box-shadow: 0 0 0 0.25rem rgba(255, 133, 162, 0.25);
        }
        .btn-custom {
            background: linear-gradient(135deg, var(--cute-pink), var(--cute-purple));
            color: white;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 700;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 133, 162, 0.4);
            color: white;
        }
        .btn-batal {
            background: #f1f3f5;
            color: #495057;
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 700;
            border: none;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-batal:hover {
            background: #e2e6ea;
            color: #212529;
            transform: translateY(-2px);
        }
        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #adb5bd;
            font-size: 1.5rem;
            text-decoration: none;
            transition: color 0.3s ease;
            background: none;
            border: none;
            padding: 0;
            line-height: 1;
        }
        .close-btn:hover {
            color: var(--cute-pink);
        }
        .img-preview {
            max-width: 150px;
            border-radius: 10px;
            margin-top: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>

    <div class="edit-card">
        <a href="admin.php?page=gallery" class="close-btn" title="Tutup"><i class="fas fa-times-circle"></i></a>
        <h4 class="mb-4 text-center"><i class="fas fa-edit"></i> Edit Foto Gallery</h4>
        
        <?php if (isset($error_msg)): ?>
            <div class="alert alert-danger rounded-3"><?= $error_msg; ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Judul Foto</label>
                <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($data['judul']); ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Deskripsi / Keterangan</label>
                <input type="text" name="deskripsi" class="form-control" value="<?= htmlspecialchars($data['keterangan']); ?>" required>
            </div>
            
            <div class="mb-4">
                <label class="form-label">Ganti Foto (Opsional)</label>
                <input type="file" name="gambar" class="form-control" accept="image/*">
                <?php if (!empty($data['gambar'])) : ?>
                    <div class="mt-2 text-muted small">Foto saat ini:</div>
                    <img src="../umum/foto/<?= htmlspecialchars($data['gambar']); ?>" class="img-preview" alt="Foto Saat Ini">
                <?php endif; ?>
            </div>
            
            <div class="d-flex gap-3 mt-2">
                <a href="admin.php?page=gallery" class="btn btn-batal flex-fill">
                    <i class="fas fa-arrow-left"></i> Batal
                </a>
                <button type="submit" name="update" class="btn btn-custom flex-fill">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

</body>
</html>
