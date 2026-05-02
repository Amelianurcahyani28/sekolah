<?php include 'header.php'; ?>
<?php include '../admin/koneksi.php'; ?>

<?php
$data = mysqli_query($conn, "SELECT * FROM artikel ORDER BY tanggal DESC");
?>

<style>
/* ============================================
   TK Maessar Bayan - Artikel Page Style
   Konsisten dengan Home Page Design
   ============================================ */

/* Variabel Warna Utama */
:root {
    /* Warna Pastel Ceria */
    --pastel-pink: #ffb6c1;
    --pastel-purple: #dda0dd;
    --pastel-blue: #87ceeb;
    --pastel-yellow: #ffeaa7;
    --pastel-green: #98d8c8;
    --pastel-orange: #ffcc80;
    --pastel-peach: #ffdab9;
    --pastel-mint: #b2fba5;

    /* Warna Ceria */
    --cute-pink: #ff85a2;
    --cute-purple: #b19cd9;
    --cute-blue: #7ec8e3;
    --cute-yellow: #ffd93d;
    --cute-coral: #ff7f7f;

    /* Warna Utama */
    --primary-green: #a5d6a7;
    --light-green: #e8f5e9;
    --dark-green: #2e7d32;
    --soft-white: #f9fbf9;
}

/* BASE STYLES */
body {
    font-family: 'Quicksand', sans-serif;
    background: linear-gradient(135deg, #fff5f5 0%, #f0f9ff 50%, #f5fff0 100%);
    color: #444;
    overflow-x: hidden;
}

/* Decorative Background */
body::before {
    content: '';
    position: fixed;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background-image:
        radial-gradient(circle at 20% 30%, rgba(255, 182, 193, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(135, 206, 235, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(221, 160, 221, 0.1) 0%, transparent 50%);
    pointer-events: none;
    z-index: -1;
}

/* ARTICLE PAGE STYLES */
.article-page {
    padding: 80px 0 50px;
    position: relative;
}

.article-page h2 {
    text-align: center;
    margin-bottom: 15px;
    color: var(--dark-green);
    font-size: 3rem;
    font-weight: 800;
    text-shadow: 3px 3px 0 rgba(0,0,0,0.1);
    letter-spacing: 1px;
    position: relative;
}

.article-page h2::before,
.article-page h2::after {
    content: '🌟';
    position: absolute;
    top: -10px;
    font-size: 2rem;
    animation: sparkle 2s ease-in-out infinite;
}

.article-page h2::before { left: -40px; }
.article-page h2::after { right: -40px; animation-delay: 1s; }

@keyframes sparkle {
    0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.7; }
    50% { transform: scale(1.2) rotate(180deg); opacity: 1; }
}

.article-page .subtitle {
    text-align: center;
    margin-bottom: 40px;
    color: var(--cute-purple);
    font-size: 1.2rem;
    font-weight: 500;
}

/* Article Cards */
.article-card {
    background: var(--soft-white);
    border-radius: 25px;
    border: 3px solid var(--pastel-pink);
    box-shadow: 0 10px 30px rgba(255, 133, 162, 0.15);
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
}

.article-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(255, 133, 162, 0.25);
    border-color: var(--cute-pink);
}

.article-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
    border-bottom: 2px dashed var(--pastel-pink);
}

.article-card-body {
    padding: 25px;
}

.article-card h3 {
    font-size: 1.6rem;
    margin-bottom: 12px;
    color: var(--dark-green);
    font-weight: 700;
}

.article-card p {
    color: #555;
    line-height: 1.7;
    margin-bottom: 20px;
}

.article-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 700;
    margin-bottom: 15px;
    background: linear-gradient(135deg, var(--pastel-yellow), var(--pastel-orange));
    color: #7a5200;
    box-shadow: 0 3px 10px rgba(255, 234, 167, 0.3);
}

.article-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    flex-wrap: wrap;
    gap: 10px;
}

.article-meta span {
    color: var(--cute-purple);
    font-size: 0.9rem;
    font-weight: 500;
}

/* No Articles State */
.no-articles {
    text-align: center;
    padding: 60px 30px;
    color: var(--cute-purple);
    background: var(--soft-white);
    border-radius: 25px;
    border: 2px dashed var(--pastel-pink);
    box-shadow: 0 10px 30px rgba(255, 133, 162, 0.15);
    position: relative;
}

.no-articles h4 {
    font-size: 1.8rem;
    margin-bottom: 15px;
    color: var(--dark-green);
}

.no-articles p {
    font-size: 1.1rem;
    margin-bottom: 0;
}

/* Decorative Elements */
.article-page::before {
    content: '🎈';
    position: absolute;
    top: 20px;
    left: 10%;
    font-size: 3rem;
    animation: float 4s ease-in-out infinite;
    opacity: 0.6;
}

.article-page::after {
    content: '💝';
    position: absolute;
    top: 40px;
    right: 10%;
    font-size: 2.5rem;
    animation: float 3.5s ease-in-out infinite;
    animation-delay: 1s;
    opacity: 0.6;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}

/* Responsive */
@media (max-width: 767px) {
    .article-card-body {
        padding: 20px;
    }
    .article-page h2 {
        font-size: 2.5rem;
    }
}
</style>

<div class="container article-page">
    <h2>📰 Artikel Terbaru</h2>
    <p class="subtitle">Baca artikel menarik tentang pendidikan anak, parenting, dan kesehatan</p>
    <div class="row gy-4">
        <?php if(mysqli_num_rows($data) > 0) : ?>
            <?php while($row = mysqli_fetch_assoc($data)) : ?>
                <?php
                $kategoriLabel = htmlspecialchars($row['kategori']);
                $badgeColor = 'background: var(--pastel-green); color: var(--dark-green);';
                if ($row['kategori'] === 'edukasi') {
                    $badgeColor = 'background: var(--pastel-yellow); color: #7a5200;';
                    $kategoriLabel = '📚 Edukasi';
                } elseif ($row['kategori'] === 'parenting') {
                    $badgeColor = 'background: var(--pastel-purple); color: #4a148c;';
                    $kategoriLabel = '👨‍👩‍👧 Parenting';
                } elseif ($row['kategori'] === 'kesehatan') {
                    $badgeColor = 'background: var(--pastel-mint); color: #1b5e20;';
                    $kategoriLabel = '💪 Kesehatan';
                } elseif ($row['kategori'] === 'kegitan' || $row['kategori'] === 'kegiatan') {
                    $badgeColor = 'background: var(--pastel-orange); color: #663c00;';
                    $kategoriLabel = '🎉 Kegiatan';
                }
                $excerpt = strip_tags($row['isi']);
                if (strlen($excerpt) > 220) {
                    $excerpt = substr($excerpt, 0, 220) . '...';
                }
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="article-card">
                        <?php if (!empty($row['gambar'])) : ?>
                            <img src="foto/<?= htmlspecialchars($row['gambar']); ?>" alt="<?= htmlspecialchars($row['judul']); ?>">
                        <?php endif; ?>
                        <div class="article-card-body">
                            <span class="article-badge" style="<?= $badgeColor; ?>"><?= $kategoriLabel; ?></span>
                            <h3><?= htmlspecialchars($row['judul']); ?></h3>
                            <p><?= htmlspecialchars($excerpt); ?></p>
                            <div class="article-meta">
                                <span><?= date('d M Y', strtotime($row['tanggal'])); ?></span>
                                <span><?= strlen($row['isi']); ?> kata</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="col-12">
                <div class="no-articles">
                    <h4>Belum ada artikel yang dipublikasikan.</h4>
                    <p>Silakan kembali lagi nanti atau hubungi admin untuk menambahkan konten.</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
