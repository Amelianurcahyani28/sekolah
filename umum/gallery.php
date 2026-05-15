<?php include 'header.php'; ?>
<?php include '../admin/db.php'; ?>
<?php
$data = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
body { font-family:'Inter',sans-serif; background:#f8fafc; color:#1e293b; }

.page-hero {
    background: linear-gradient(135deg,#f0f4ff 0%,#fdf4ff 60%,#f0fdf4 100%);
    padding:60px 0 50px;
    border-bottom:1px solid #e2e8f0;
}
.page-label { font-size:.8rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#6366f1; margin-bottom:10px; }
.page-hero h1 { font-size:clamp(1.8rem,3vw,2.6rem); font-weight:800; color:#0f172a; letter-spacing:-.5px; margin-bottom:10px; }
.page-hero p { color:#64748b; font-size:1rem; margin:0; }

.gallery-section { padding:60px 0; }

.gallery-card {
    background:white;
    border-radius:18px;
    border:1px solid #f1f5f9;
    overflow:hidden;
    transition:all .3s ease;
    height:100%;
}
.gallery-card:hover { transform:translateY(-6px); box-shadow:0 20px 50px rgba(0,0,0,.1); border-color:transparent; }
.gallery-card img { width:100%; height:220px; object-fit:cover; display:block; transition:transform .4s; }
.gallery-card:hover img { transform:scale(1.05); }
.gallery-caption { padding:18px 20px; }
.gallery-caption h5 { font-size:1rem; font-weight:700; color:#0f172a; margin-bottom:4px; }
.gallery-caption p { font-size:.85rem; color:#64748b; margin:0; }

.empty-state {
    text-align:center; padding:80px 30px;
    background:white; border-radius:20px;
    border:1.5px dashed #cbd5e1;
}
.empty-state .icon { font-size:3rem; margin-bottom:16px; }
.empty-state h4 { font-size:1.2rem; font-weight:700; color:#0f172a; margin-bottom:8px; }
.empty-state p { font-size:.9rem; color:#64748b; margin:0; }

footer { background:#0f172a !important; color:#94a3b8 !important; padding:28px 0 !important; margin-top:0 !important; border-radius:0 !important; }
footer p { color:#94a3b8 !important; font-size:.88rem; margin:0; }
</style>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <p class="page-label">Foto Kegiatan</p>
        <h1>Gallery</h1>
        <p>Koleksi foto kegiatan belajar dan acara sekolah</p>
    </div>
</div>

<!-- Gallery -->
<section class="gallery-section">
    <div class="container">
        <div class="row g-4">
            <?php if(mysqli_num_rows($data) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($data)): ?>
                <div class="col-sm-6 col-lg-4">
                    <div class="gallery-card">
                        <?php if(!empty($row['gambar'])): ?>
                            <img src="foto/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['judul']) ?>">
                        <?php endif; ?>
                        <div class="gallery-caption">
                            <h5><?= htmlspecialchars($row['judul']) ?></h5>
                            <p><?= htmlspecialchars($row['keterangan']) ?></p>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
            <div class="col-12">
                <div class="empty-state">
                    <div class="icon">📷</div>
                    <h4>Belum ada foto kegiatan</h4>
                    <p>Silakan kembali lagi nanti atau hubungi admin untuk menambahkan foto.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>