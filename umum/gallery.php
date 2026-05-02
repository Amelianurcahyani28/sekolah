<?php include 'header.php'; ?>
<?php include '../admin/koneksi.php'; ?>

<?php
$data = mysqli_query($conn, "SELECT * FROM gallery ORDER BY id DESC");
?>

<style>
/* ============================================
   TK Maessar Bayan - Gallery Page Style
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

/* GALLERY PAGE STYLES */
.gallery-container {
    padding: 80px 0 50px;
    position: relative;
}

.gallery-container h2 {
    text-align: center;
    margin-bottom: 15px;
    color: var(--dark-green);
    font-size: 3rem;
    font-weight: 800;
    text-shadow: 3px 3px 0 rgba(0,0,0,0.1);
    letter-spacing: 1px;
    position: relative;
}

.gallery-container h2::before,
.gallery-container h2::after {
    content: '📸';
    position: absolute;
    top: -10px;
    font-size: 2rem;
    animation: sparkle 2s ease-in-out infinite;
}

.gallery-container h2::before { left: -40px; }
.gallery-container h2::after { right: -40px; animation-delay: 1s; }

@keyframes sparkle {
    0%, 100% { transform: scale(1) rotate(0deg); opacity: 0.7; }
    50% { transform: scale(1.2) rotate(180deg); opacity: 1; }
}

.gallery-container .subtitle {
    text-align: center;
    margin-bottom: 40px;
    color: var(--cute-purple);
    font-size: 1.2rem;
    font-weight: 500;
}

/* Gallery Items */
.gallery-item {
    background: var(--soft-white);
    border-radius: 25px;
    border: 3px solid var(--pastel-pink);
    box-shadow: 0 10px 30px rgba(255, 133, 162, 0.15);
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
    margin-bottom: 30px;
}

.gallery-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(255, 133, 162, 0.25);
    border-color: var(--cute-pink);
}

.gallery-item img {
    width: 100%;
    height: 220px;
    object-fit: cover;
    display: block;
    border-bottom: 2px dashed var(--pastel-pink);
    transition: transform 0.3s ease;
}

.gallery-item:hover img {
    transform: scale(1.05);
}

.caption {
    padding: 20px;
    text-align: center;
}

.caption h3 {
    font-size: 1.4rem;
    margin-bottom: 8px;
    color: var(--dark-green);
    font-weight: 700;
}

.caption p {
    font-size: 1rem;
    color: var(--cute-purple);
    line-height: 1.6;
    margin: 0;
}

/* No Gallery State */
.no-gallery {
    text-align: center;
    padding: 60px 30px;
    color: var(--cute-purple);
    background: var(--soft-white);
    border-radius: 25px;
    border: 2px dashed var(--pastel-pink);
    box-shadow: 0 10px 30px rgba(255, 133, 162, 0.15);
    position: relative;
}

.no-gallery h4 {
    font-size: 1.8rem;
    margin-bottom: 15px;
    color: var(--dark-green);
}

.no-gallery p {
    font-size: 1.1rem;
    margin-bottom: 0;
}

/* Decorative Elements */
.gallery-container::before {
    content: '🎨';
    position: absolute;
    top: 20px;
    left: 10%;
    font-size: 3rem;
    animation: float 4s ease-in-out infinite;
    opacity: 0.6;
}

.gallery-container::after {
    content: '🌈';
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
    .caption {
        padding: 15px;
    }
    .gallery-container h2 {
        font-size: 2.5rem;
    }
}
</style>

<div class="container gallery-container">
    <h2>📸 Gallery Kegiatan</h2>
    <p class="subtitle">Koleksi foto-foto kegiatan belajar mengajar dan acara sekolah</p>

    <div class="row">

        <?php if(mysqli_num_rows($data) > 0) : ?>
            
            <?php while($row = mysqli_fetch_assoc($data)) : ?>
            <div class="col-md-4 mb-4">
                <div class="gallery-item">
                    
                    <?php if(!empty($row['gambar'])) : ?>
                        <img src="foto/<?= htmlspecialchars($row['gambar']); ?>" 
                             alt="<?= htmlspecialchars($row['judul']); ?>">
                    <?php else : ?>
                        <p style="text-align:center;">Tidak ada gambar</p>
                    <?php endif; ?>

                    <div class="caption">
                        <h3><?= htmlspecialchars($row['judul']); ?></h3>
                        <p><?= htmlspecialchars($row['keterangan']); ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>

        <?php else : ?>
            <div class="col-12">
                <div class="no-gallery">
                    <h4>Belum ada foto kegiatan</h4>
                    <p>Silakan kembali lagi nanti atau hubungi admin untuk menambahkan foto kegiatan sekolah.</p>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>

<?php include 'footer.php'; ?>