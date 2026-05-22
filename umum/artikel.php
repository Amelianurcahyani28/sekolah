<?php include 'header.php'; ?>
<?php include 'koneksi.php'; ?>
<?php
$data = $conn ? mysqli_query($conn, "SELECT * FROM artikel ORDER BY tanggal DESC") : false;
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
body { font-family:'Inter',sans-serif; background:#f8fafc; color:#1e293b; }

.page-hero {
    background: linear-gradient(135deg,#f0f4ff 0%,#fdf4ff 60%,#f0fdf4 100%);
    padding:60px 0 50px; border-bottom:1px solid #e2e8f0;
}
.page-label { font-size:.8rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#6366f1; margin-bottom:10px; }
.page-hero h1 { font-size:clamp(1.8rem,3vw,2.6rem); font-weight:800; color:#0f172a; letter-spacing:-.5px; margin-bottom:10px; }
.page-hero p { color:#64748b; font-size:1rem; margin:0; }

.artikel-section { padding:60px 0; }

.artikel-card {
    background:white; border-radius:18px;
    border:1px solid #f1f5f9; overflow:hidden;
    transition:all .3s ease; height:100%;
    display:flex; flex-direction:column;
}
.artikel-card:hover { transform:translateY(-6px); box-shadow:0 20px 50px rgba(0,0,0,.1); border-color:transparent; }
.artikel-card img { width:100%; height:200px; object-fit:cover; display:block; transition:transform .4s; }
.artikel-card:hover img { transform:scale(1.04); }
.artikel-body { padding:22px; flex:1; display:flex; flex-direction:column; }

.kategori-badge {
    display:inline-block; padding:4px 12px;
    border-radius:100px; font-size:.75rem; font-weight:700;
    margin-bottom:12px;
}
.badge-edukasi   { background:#ede9fe; color:#6d28d9; }
.badge-parenting { background:#fce7f3; color:#be185d; }
.badge-kesehatan { background:#dcfce7; color:#15803d; }
.badge-kegiatan  { background:#fef3c7; color:#b45309; }
.badge-default   { background:#f1f5f9; color:#475569; }

.artikel-body h5 { font-size:1.05rem; font-weight:700; color:#0f172a; margin-bottom:10px; line-height:1.4; }
.artikel-body p  { font-size:.88rem; color:#64748b; line-height:1.7; flex:1; margin-bottom:16px; }
.artikel-meta    { font-size:.78rem; color:#94a3b8; font-weight:500; border-top:1px solid #f1f5f9; padding-top:12px; margin-top:auto; }

.empty-state {
    text-align:center; padding:80px 30px;
    background:white; border-radius:20px;
    border:1.5px dashed #cbd5e1;
}
.empty-state .icon { font-size:3rem; margin-bottom:16px; }
.empty-state h4 { font-size:1.2rem; font-weight:700; color:#0f172a; margin-bottom:8px; }
.empty-state p  { font-size:.9rem; color:#64748b; margin:0; }

footer { background:#0f172a !important; color:#94a3b8 !important; padding:28px 0 !important; margin-top:0 !important; border-radius:0 !important; }
footer p { color:#94a3b8 !important; font-size:.88rem; margin:0; }
</style>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <p class="page-label">Informasi &amp; Edukasi</p>
        <h1>Artikel Terbaru</h1>
        <p>Baca artikel menarik tentang pendidikan anak, parenting, dan kesehatan</p>
    </div>
</div>

<!-- Artikel -->
<section class="artikel-section">
    <div class="container">
        <?php if (!$conn): ?>
        <div class="alert alert-warning text-center border-0 shadow-sm mb-4" style="border-radius: 12px; background: #fffbeb; color: #b45309; font-size: 0.9rem; padding: 12px 20px;">
            ⚠️ <strong>Koneksi Database Bermasalah:</strong> Silakan periksa konfigurasi database Anda di hosting. Halaman tetap dapat diakses dengan data default.
        </div>
        <?php endif; ?>
        <div class="row g-4">
            <?php if($data && mysqli_num_rows($data) > 0): ?>
                <?php while($row = mysqli_fetch_assoc($data)):
                    $kat = $row['kategori'];
                    $badgeClass = 'badge-default';
                    $label = ucfirst($kat);
                    if ($kat === 'edukasi')   { $badgeClass='badge-edukasi';   $label='📚 Edukasi'; }
                    elseif ($kat === 'parenting') { $badgeClass='badge-parenting'; $label='👨‍👩‍👧 Parenting'; }
                    elseif ($kat === 'kesehatan') { $badgeClass='badge-kesehatan'; $label='💪 Kesehatan'; }
                    elseif ($kat === 'kegiatan') { $badgeClass='badge-kegiatan'; $label='🎉 Kegiatan'; }
                    $excerpt = strip_tags($row['isi']);
                    if (strlen($excerpt) > 200) $excerpt = substr($excerpt, 0, 200) . '...';
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="artikel-card">
                        <?php if(!empty($row['gambar'])): ?>
                            <img src="foto/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['judul']) ?>">
                        <?php endif; ?>
                        <div class="artikel-body">
                            <span class="kategori-badge <?= $badgeClass ?>"><?= $label ?></span>
                            <h5><?= htmlspecialchars($row['judul']) ?></h5>
                            <p><?= htmlspecialchars($excerpt) ?></p>
                            <div class="artikel-meta">📅 <?= date('d M Y', strtotime($row['tanggal'])) ?></div>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            <?php else: ?>
            <div class="col-12">
                <div class="empty-state">
                    <div class="icon">📰</div>
                    <h4>Belum ada artikel</h4>
                    <p>Silakan kembali lagi nanti.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
