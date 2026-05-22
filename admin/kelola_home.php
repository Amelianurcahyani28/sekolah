<?php
include 'db.php';

$data = null;
if ($conn) {
    $cek  = mysqli_query($conn, "SELECT * FROM beranda LIMIT 1");
    $data = $cek ? mysqli_fetch_assoc($cek) : null;

    if (isset($_POST['update'])) {
        $judul      = mysqli_real_escape_string($conn, $_POST['judul']);
        $deskripsi  = mysqli_real_escape_string($conn, $_POST['deskripsi']);
        $foto       = $data['foto'] ?? '';

        $target_dir = "../umum/foto/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $fotos_lama = explode(',', $foto);
        $foto1_lama = $fotos_lama[0] ?? '';
        $foto2_lama = $fotos_lama[1] ?? '';
        $foto3_lama = $fotos_lama[2] ?? '';

        function process_upload($file_input, $old_file, $target_dir) {
            if (!empty($_FILES[$file_input]['name'])) {
                $fn = time() . '_' . $file_input . '_home_' . basename($_FILES[$file_input]['name']);
                if (move_uploaded_file($_FILES[$file_input]['tmp_name'], $target_dir . $fn)) {
                    if ($old_file && file_exists($target_dir . $old_file) && $old_file != 'foto_bersama.jpeg') {
                        @unlink($target_dir . $old_file);
                    }
                    return $fn;
                }
            }
            return $old_file;
        }

        $f1 = process_upload('foto1', $foto1_lama, $target_dir);
        $f2 = process_upload('foto2', $foto2_lama, $target_dir);
        $f3 = process_upload('foto3', $foto3_lama, $target_dir);

        $foto_arr = [];
        if ($f1) $foto_arr[] = $f1;
        if ($f2) $foto_arr[] = $f2;
        if ($f3) $foto_arr[] = $f3;
        
        $foto = implode(',', $foto_arr);

        $cek2 = mysqli_query($conn, "SELECT * FROM beranda LIMIT 1");
        if ($cek2 && mysqli_num_rows($cek2) > 0) {
            mysqli_query($conn, "UPDATE beranda SET judul='$judul', deskripsi='$deskripsi', foto='$foto' WHERE id=1");
        } else {
            mysqli_query($conn, "INSERT INTO beranda (id, judul, deskripsi, foto) VALUES (1, '$judul', '$deskripsi', '$foto')");
        }
        echo "<script>alert('Berhasil disimpan!');window.location='admin.php?page=home';</script>"; exit;
    }
}

$row = $data ?: ['judul' => 'TK Maessar Bayan', 'deskripsi' => 'Pendidikan usia dini yang menyenangkan', 'foto' => ''];
?>

<style>
.page-title { font-size: 1.4rem; font-weight: 800; color: #0f172a; margin-bottom: 4px; }
.page-sub   { font-size: .88rem; color: #64748b; margin-bottom: 28px; }
.mod-card   { background: white; border-radius: 16px; border: 1px solid #f1f5f9; padding: 24px; margin-bottom: 20px; }
.section-head { font-size: .88rem; font-weight: 700; color: #0f172a; margin-bottom: 16px; padding-bottom: 10px; border-bottom: 1px solid #f1f5f9; display: flex; align-items: center; gap: 6px; }
.form-label { font-size: .8rem; font-weight: 600; color: #374151; margin-bottom: 5px; display: block; }
.form-control, .form-select { border: 1.5px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; font-size: .88rem; color: #1e293b; transition: border-color .2s, box-shadow .2s; width: 100%; }
.form-control:focus, .form-select:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99,102,241, .12); outline: none; }
.btn-save   { background: linear-gradient(135deg, #6366f1, #8b5cf6); color: white; border: none; border-radius: 9px; padding: 11px 28px; font-size: .9rem; font-weight: 600; cursor: pointer; transition: all .2s; }
.btn-save:hover { opacity: .88; transform: translateY(-1px); }
.preview-img { width: 100%; max-width: 320px; border-radius: 12px; object-fit: cover; border: 2px solid #e2e8f0; margin-top: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
.hint       { font-size: .75rem; color: #94a3b8; margin-top: 4px; }
.row-custom { display: flex; flex-wrap: wrap; gap: 0; }
.col-8-custom { flex: 0 0 66.66%; max-width: 66.66%; padding-right: 16px; }
.col-4-custom { flex: 0 0 33.33%; max-width: 33.33%; }
@media(max-width: 768px) {
    .col-8-custom, .col-4-custom { flex: 0 0 100%; max-width: 100%; padding-right: 0; }
    .col-4-custom { margin-top: 20px; }
}
.mb-3 { margin-bottom: 16px; }
.mb-4 { margin-bottom: 24px; }
</style>

<p class="page-title">Kelola Home</p>
<p class="page-sub">Edit teks dan gambar utama yang tampil pada halaman depan (Home)</p>

<div class="mod-card">
    <form method="POST" enctype="multipart/form-data">
        <p class="section-head">🏠 Konten Halaman Utama</p>
        <div class="row-custom mb-4">
            <div class="col-8-custom">
                <div class="mb-3">
                    <label class="form-label">Judul Utama Halaman Home</label>
                    <input type="text" name="judul" class="form-control" value="<?= htmlspecialchars($row['judul']) ?>" required>
                    <p class="hint">Judul besar yang menarik perhatian pengunjung saat pertama kali masuk website.</p>
                </div>
                <div class="mb-3">
                    <label class="form-label">Deskripsi Singkat</label>
                    <textarea name="deskripsi" class="form-control" rows="5" required><?= htmlspecialchars($row['deskripsi']) ?></textarea>
                    <p class="hint">Deskripsi pendek mengenai sekolah PAUD Maessar Bayan.</p>
                </div>
            </div>
            <div class="col-4-custom">
                <?php 
                $fotos = explode(',', $row['foto'] ?? '');
                $foto1 = $fotos[0] ?? '';
                $foto2 = $fotos[1] ?? '';
                $foto3 = $fotos[2] ?? '';

                function get_preview($f) {
                    if (empty($f)) return "";
                    $img_src = "../umum/foto/".$f;
                    if (!file_exists($img_src) && $f != 'foto_bersama.jpeg') return "";
                    return $img_src;
                }
                ?>
                
                <div class="mb-3">
                    <label class="form-label">Gambar 1 (Utama)</label>
                    <input type="file" name="foto1" class="form-control" accept="image/*">
                    <?php if($src = get_preview($foto1)): ?>
                        <img src="<?= htmlspecialchars($src) ?>" class="preview-img" style="max-height:100px; width:auto; margin-top:5px;">
                    <?php elseif(empty($fotos[0])): ?>
                        <img src="../umum/foto/foto_bersama.jpeg" class="preview-img" style="max-height:100px; width:auto; margin-top:5px;">
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar 2 (Opsional Carousel)</label>
                    <input type="file" name="foto2" class="form-control" accept="image/*">
                    <?php if($src = get_preview($foto2)): ?>
                        <img src="<?= htmlspecialchars($src) ?>" class="preview-img" style="max-height:100px; width:auto; margin-top:5px;">
                    <?php endif; ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar 3 (Opsional Carousel)</label>
                    <input type="file" name="foto3" class="form-control" accept="image/*">
                    <?php if($src = get_preview($foto3)): ?>
                        <img src="<?= htmlspecialchars($src) ?>" class="preview-img" style="max-height:100px; width:auto; margin-top:5px;">
                    <?php endif; ?>
                </div>
                
                <p class="hint">Upload lebih dari 1 gambar agar otomatis menjadi carousel (berganti tiap 3 detik).</p>
            </div>
        </div>

        <button type="submit" name="update" class="btn-save" <?= !$conn ? 'disabled style="opacity: 0.6; cursor: not-allowed;"' : '' ?>>💾 Simpan Perubahan</button>
        <?php if (!$conn): ?>
        <small class="text-danger d-block mt-2">⚠️ Tombol dinonaktifkan karena koneksi database bermasalah.</small>
        <?php endif; ?>
    </form>
</div>
