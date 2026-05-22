<?php
include 'db.php';

$editData = null;
if ($conn) {
    // Handle Upload & Insert
    if (isset($_POST['tambah'])) {
        $nama     = mysqli_real_escape_string($conn, $_POST['nama_anak']);
        $prestasi = mysqli_real_escape_string($conn, $_POST['prestasi']);
        
        $foto = "";
        if ($_FILES['foto']['name'] != "") {
            $foto = time() . "_" . $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], "../umum/foto/" . $foto);
        }

        if (mysqli_query($conn, "INSERT INTO perkembangan_anak (nama_anak, prestasi, foto) VALUES ('$nama', '$prestasi', '$foto')")) {
            echo "<script>alert('Data perkembangan berhasil ditambahkan!'); window.location='admin.php?page=perkembangan';</script>";
            exit;
        }
    }

    // Handle Update
    if (isset($_POST['update'])) {
        $id       = (int)$_POST['id'];
        $nama     = mysqli_real_escape_string($conn, $_POST['nama_anak']);
        $prestasi = mysqli_real_escape_string($conn, $_POST['prestasi']);
        
        if ($_FILES['foto']['name'] != "") {
            // Delete old photo
            $cek = mysqli_query($conn, "SELECT foto FROM perkembangan_anak WHERE id=$id");
            $row = $cek ? mysqli_fetch_assoc($cek) : null;
            if ($row && $row['foto'] != "" && file_exists("../umum/foto/" . $row['foto'])) {
                unlink("../umum/foto/" . $row['foto']);
            }
            
            $foto = time() . "_" . $_FILES['foto']['name'];
            move_uploaded_file($_FILES['foto']['tmp_name'], "../umum/foto/" . $foto);
            mysqli_query($conn, "UPDATE perkembangan_anak SET nama_anak='$nama', prestasi='$prestasi', foto='$foto' WHERE id=$id");
        } else {
            mysqli_query($conn, "UPDATE perkembangan_anak SET nama_anak='$nama', prestasi='$prestasi' WHERE id=$id");
        }
        
        echo "<script>alert('Data perkembangan berhasil diperbarui!'); window.location='admin.php?page=perkembangan';</script>";
        exit;
    }

    // Handle Delete
    if (isset($_GET['hapus'])) {
        $id = (int)$_GET['hapus'];
        $cek = mysqli_query($conn, "SELECT foto FROM perkembangan_anak WHERE id=$id");
        $row = $cek ? mysqli_fetch_assoc($cek) : null;
        if ($row && $row['foto'] != "" && file_exists("../umum/foto/" . $row['foto'])) {
            unlink("../umum/foto/" . $row['foto']);
        }
        mysqli_query($conn, "DELETE FROM perkembangan_anak WHERE id=$id");
        echo "<script>alert('Data berhasil dihapus!'); window.location='admin.php?page=perkembangan';</script>";
        exit;
    }

    if (isset($_GET['edit'])) {
        $id = (int)$_GET['edit'];
        $res = mysqli_query($conn, "SELECT * FROM perkembangan_anak WHERE id=$id");
        $editData = $res ? mysqli_fetch_assoc($res) : null;
    }

    $data = mysqli_query($conn, "SELECT * FROM perkembangan_anak ORDER BY id DESC");
} else {
    $data = false;
}
?>

<style>
.page-title{font-size:1.4rem;font-weight:800;color:#0f172a;margin-bottom:4px;}
.page-sub{font-size:.88rem;color:#64748b;margin-bottom:28px;}
.mod-card{background:white;border-radius:16px;border:1px solid #f1f5f9;padding:24px;margin-bottom:20px;}
.mod-card h6{font-size:.95rem;font-weight:700;color:#0f172a;margin-bottom:20px;}
.form-label{font-size:.8rem;font-weight:600;color:#374151;margin-bottom:5px;}
.form-control{border:1.5px solid #e2e8f0;border-radius:10px;padding:10px 14px;font-size:.88rem;color:#1e293b;}
.btn-save{background:linear-gradient(135deg,#6366f1,#8b5cf6);color:white;border:none;border-radius:9px;padding:10px 22px;font-size:.88rem;font-weight:600;cursor:pointer;}
.btn-cancel{background:#e2e8f0;color:#475569;border:none;border-radius:9px;padding:10px 22px;font-size:.88rem;font-weight:600;cursor:pointer;text-decoration:none;display:inline-block;margin-left:8px;}
.data-table{width:100%;border-collapse:collapse;font-size:.85rem;}
.data-table thead th{background:#f8fafc;color:#374151;padding:11px 14px;text-align:left;border-bottom:1px solid #e2e8f0;}
.data-table tbody td{padding:11px 14px;border-bottom:1px solid #f1f5f9;vertical-align:middle;}
.img-prev{width:60px;height:60px;object-fit:cover;border-radius:8px;}
.btn-edit{background:#fef3c7;color:#b45309;border-radius:7px;padding:5px 12px;font-size:.75rem;font-weight:600;text-decoration:none;margin-right:10px;}
.btn-del{background:#fee2e2;color:#dc2626;border-radius:7px;padding:5px 12px;font-size:.75rem;font-weight:600;text-decoration:none;}
</style>

<p class="page-title">Kelola Perkembangan Anak</p>
<p class="page-sub">Tambahkan foto dan prestasi anak untuk ditampilkan di halaman utama</p>

<div class="mod-card">
    <h6><?= $editData ? '✏️ Edit Prestasi' : '🏆 Tambah Prestasi Baru' ?></h6>
    <form method="POST" enctype="multipart/form-data">
        <?php if($editData): ?>
            <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <?php endif; ?>
        
        <div class="row g-3 mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Anak</label>
                <input type="text" name="nama_anak" class="form-control" placeholder="Nama Lengkap" value="<?= $editData ? htmlspecialchars($editData['nama_anak']) : '' ?>" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Foto Anak <?= $editData ? '<small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small>' : '' ?></label>
                <input type="file" name="foto" class="form-control" <?= $editData ? '' : 'required' ?>>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Prestasi / Catatan Perkembangan</label>
            <textarea name="prestasi" class="form-control" rows="3" placeholder="Contoh: Juara 1 Lomba Mewarnai Se-Kecamatan" required><?= $editData ? htmlspecialchars($editData['prestasi']) : '' ?></textarea>
        </div>
        <button type="submit" name="<?= $editData ? 'update' : 'tambah' ?>" class="btn-save" <?= !$conn ? 'disabled style="opacity: 0.6; cursor: not-allowed;"' : '' ?>>
            <?= $editData ? '💾 Update Perkembangan' : '💾 Simpan Perkembangan' ?>
        </button>
        <?php if (!$conn): ?>
        <small class="text-danger d-block mt-2">⚠️ Tombol dinonaktifkan karena koneksi database bermasalah.</small>
        <?php endif; ?>
        <?php if($editData): ?>
            <a href="admin.php?page=perkembangan" class="btn-cancel">Batal</a>
        <?php endif; ?>
    </form>
</div>

<div class="mod-card">
    <h6>📋 Daftar Prestasi & Foto</h6>
    <div class="table-responsive">
        <table class="data-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nama Anak</th>
                    <th>Prestasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; if($data && mysqli_num_rows($data)>0): while($row=mysqli_fetch_assoc($data)): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td>
                        <?php if($row['foto'] != ""): ?>
                            <img src="../umum/foto/<?= $row['foto'] ?>" class="img-prev">
                        <?php else: ?>
                            <div class="img-prev bg-light d-flex align-items-center justify-content-center text-muted">No Img</div>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= htmlspecialchars($row['nama_anak']) ?></strong></td>
                    <td><?= htmlspecialchars($row['prestasi']) ?></td>
                    <td>
                        <a href="admin.php?page=perkembangan&edit=<?= $row['id'] ?>" class="btn-edit">Edit</a>
                        <a href="admin.php?page=perkembangan&hapus=<?= $row['id'] ?>" class="btn-del" onclick="return confirm('Hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; else: ?>
                <tr><td colspan="5" style="text-align:center;color:#94a3b8;padding:30px;">Belum ada data perkembangan</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
