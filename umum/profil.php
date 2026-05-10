<?php
include 'header.php';
include 'koneksi.php';

// Ambil data profil dari database
$data = mysqli_query($conn, "SELECT tentang, visi, misi, kepsek_nama, kepsek_quote, kepsek_foto, foto_sekolah, foto_hero FROM profil LIMIT 1");
$row = $data ? mysqli_fetch_assoc($data) : null;

$tentang     = $row['tentang']      ?? 'TK Maessar Bayan adalah lembaga pendidikan anak usia dini yang berfokus pada perkembangan karakter dan potensi anak. Kami menyediakan lingkungan belajar yang aman, nyaman, dan penuh warna untuk buah hati Anda. 🎨';
$visi      = $row['visi']       ?? 'Memiliki fasilitas ruang kelas yang memadai...';
$misi   = $row['misi']    ?? 'Terdapat area bermain yang aman dan nyaman...';
$kepsek_nama  = $row['kepsek_nama'] ?? 'Hj. Siti Aisyah, S.Pd';
$kepsek_quote = $row['kepsek_quote'] ?? 'Pendidikan adalah tiket masa depan bagi mereka yang menyiapkannya hari ini.';
$kepsek_foto  = !empty($row['kepsek_foto']) ? 'foto/' . $row['kepsek_foto'] : 'kepsek.jpeg';
$foto_sekolah = !empty($row['foto_sekolah']) ? 'foto/' . $row['foto_sekolah'] : 'sekolah.jpeg';
$foto_hero    = !empty($row['foto_hero']) ? 'foto/' . $row['foto_hero'] : '';

$escape = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
?>

<style>
    :root {
        --pastel-pink: #ffb6c1;
        --pastel-purple: #dda0dd;
        --pastel-blue: #87ceeb;
        --pastel-yellow: #ffeaa7;
        --pastel-green: #98d8c8;
        --pastel-orange: #ffcc80;
        --pastel-mint: #b2fba5;
        --cute-pink: #ff85a2;
        --cute-purple: #b19cd9;
        --cute-blue: #7ec8e3;
        --cute-yellow: #ffd93d;
    }

    body {
        font-family: 'Quicksand', sans-serif;
        background: linear-gradient(135deg, #fff5f5 0%, #f0f9ff 50%, #f5fff0 100%);
        color: #444;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: -50%; left: -50%;
        width: 200%; height: 200%;
        background-image:
            radial-gradient(circle at 20% 30%, rgba(255,182,193,0.15) 0%, transparent 50%),
            radial-gradient(circle at 80% 70%, rgba(135,206,235,0.15) 0%, transparent 50%),
            radial-gradient(circle at 50% 50%, rgba(221,160,221,0.10) 0%, transparent 50%);
        pointer-events: none;
        z-index: -1;
    }

    /* Hero */
    .profil-hero {
        background: linear-gradient(135deg, var(--pastel-pink) 0%, var(--pastel-purple) 50%, var(--pastel-blue) 100%);
        padding: 60px 0;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }
    .profil-hero::before, .profil-hero::after {
        content: '★';
        position: absolute;
        font-size: 3rem;
        color: rgba(255,255,255,0.4);
        animation: float 3s ease-in-out infinite;
    }
    .profil-hero::before { top: 20px; left: 10%; }
    .profil-hero::after  { bottom: 20px; right: 10%; animation-delay: 1.5s; }
    @keyframes float {
        0%,100% { transform: translateY(0) rotate(0deg); }
        50%      { transform: translateY(-15px) rotate(10deg); }
    }
    .profil-title    { font-size: 2.8rem; font-weight: 800; color: white; text-shadow: 3px 3px 0 rgba(0,0,0,0.1); margin-bottom: 10px; }
    .profil-subtitle { color: rgba(255,255,255,0.95); font-size: 1.2rem; font-weight: 500; }
    .divider-cute    { width: 120px; height: 6px; background: white; border-radius: 10px; margin: 20px auto 0; box-shadow: 0 4px 0 rgba(0,0,0,0.1); }
    .decoration-dot  { width: 14px; height: 14px; border-radius: 50%; display: inline-block; margin: 0 5px; box-shadow: 0 3px 8px rgba(0,0,0,0.15); }
    .dot-pink   { background: var(--pastel-pink); }
    .dot-purple { background: var(--pastel-purple); }
    .dot-blue   { background: var(--pastel-blue); }
    .dot-yellow { background: var(--pastel-yellow); }
    .dot-green  { background: var(--pastel-green); }

    /* Gambar Utama */
    .main-image-container {
        border-radius: 30px; overflow: hidden;
        box-shadow: 0 15px 40px rgba(255,133,162,0.25);
        margin-bottom: 40px; border: 6px solid white; position: relative;
    }
    .main-image-container::before {
        content: ''; position: absolute;
        top: -10px; left: -10px; right: -10px; bottom: -10px;
        border: 4px dashed var(--pastel-pink); border-radius: 35px; opacity: 0.5;
    }
    .main-image-container img { width: 100%; height: auto; display: block; transition: transform 0.5s ease; }
    .main-image-container:hover img { transform: scale(1.05); }

    /* Card Umum */
    .cute-card {
        background: white; border-radius: 25px; padding: 40px;
        box-shadow: 0 10px 30px rgba(255,133,162,0.15);
        margin-bottom: 30px; position: relative; overflow: hidden;
    }
    .cute-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 8px;
        background: linear-gradient(90deg, var(--pastel-pink), var(--pastel-purple), var(--pastel-blue), var(--pastel-green));
    }
    .section-title-cute {
        font-size: 1.9rem; font-weight: 800; color: #2d3436;
        margin-bottom: 20px; position: relative; display: inline-block;
    }
    .section-title-cute.pink::before   { content: '🎈'; margin-right: 10px; }
    .section-title-cute.pink::after    { content: '⭐'; margin-left: 10px; }
    .section-title-cute.purple::before { content: '🔭'; margin-right: 10px; }
    .section-title-cute.green::before  { content: '🎯'; margin-right: 10px; }

    .tentang-text { color: #555; line-height: 1.9; font-size: 1rem; }

    /* Sarana & Prasarana */
    .sarana-prasarana-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    @media (max-width: 768px) { .sarana-prasarana-grid { grid-template-columns: 1fr; } }

    .sp-box {
        border-radius: 18px; padding: 25px; position: relative; overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .sp-box:hover { transform: translateY(-5px); box-shadow: 0 15px 35px rgba(0,0,0,0.12); }
    .sp-box.sarana { background: linear-gradient(145deg, #fce4ec, #f8bbd0); }
    .sp-box.prasarana { background: linear-gradient(145deg, #e3f2fd, #bbdefb); }
    .sp-box-icon { font-size: 2.5rem; margin-bottom: 12px; display: block; }
    .sp-box-title { font-size: 1.3rem; font-weight: 800; color: #2d3436; margin-bottom: 10px; }
    .sp-box-text { color: #555; line-height: 1.8; font-size: 0.95rem; white-space: pre-line; }

    /* Info Cards */
    .info-card {
        border: none; border-radius: 20px; padding: 25px 20px; text-align: center;
        transition: all 0.4s cubic-bezier(0.175,0.885,0.32,1.275);
        margin-bottom: 20px; position: relative; overflow: hidden;
    }
    .info-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px; }
    .info-card:hover { transform: translateY(-8px) scale(1.02); }
    .info-card:nth-child(1) { background: linear-gradient(145deg, #e8f8f5, #d4edda); }
    .info-card:nth-child(1)::before { background: linear-gradient(90deg, var(--pastel-green), var(--pastel-mint)); }
    .info-card:nth-child(2) { background: linear-gradient(145deg, #fff8e1, #ffecb3); }
    .info-card:nth-child(2)::before { background: linear-gradient(90deg, var(--pastel-yellow), var(--pastel-orange)); }
    .info-card:nth-child(3) { background: linear-gradient(145deg, #e3f2fd, #bbdefb); }
    .info-card:nth-child(3)::before { background: linear-gradient(90deg, var(--pastel-blue), var(--cute-blue)); }
    .info-icon  { font-size: 3rem; margin-bottom: 12px; display: block; animation: bounce 2s infinite; }
    .info-title { font-weight: 700; color: #2d3436; font-size: 1.1rem; margin-bottom: 8px; }
    .info-desc  { color: #666; font-size: 0.9rem; margin-top: 5px; line-height: 1.5; }
    @keyframes bounce {
        0%,100% { transform: translateY(0); }
        50%      { transform: translateY(-8px); }
    }

    /* Kepsek Card */
    .kepsek-card {
        border: none; border-radius: 25px;
        background: linear-gradient(145deg, #ffffff, #fff5f7);
        padding: 30px; box-shadow: 0 10px 30px rgba(255,133,162,0.2);
        text-align: center; position: relative; overflow: hidden;
        transition: all 0.4s ease;
    }
    .kepsek-card::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 8px;
        background: linear-gradient(90deg, var(--pastel-pink), var(--pastel-purple), var(--pastel-blue));
    }
    .kepsek-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px rgba(255,133,162,0.3); }
    .kepsek-foto {
        width: 140px; height: 140px; border-radius: 50%; object-fit: cover;
        border: 6px solid var(--pastel-pink); box-shadow: 0 8px 25px rgba(255,133,162,0.4);
        margin-bottom: 15px; transition: transform 0.3s ease;
    }
    .kepsek-card:hover .kepsek-foto { transform: scale(1.05); }
    .kepsek-nama    { font-size: 1.4rem; font-weight: 700; color: #2d3436; margin-bottom: 5px; }
    .kepsek-jabatan { color: var(--cute-pink); font-weight: 700; font-size: 0.95rem; margin-bottom: 15px; }
    .kepsek-quote {
        font-style: italic; color: #666; font-size: 0.95rem; line-height: 1.7;
        position: relative; padding: 15px 20px;
        background: linear-gradient(135deg, #fff9fc, #f0f8ff); border-radius: 15px;
    }
    .kepsek-quote::before {
        content: '"'; font-size: 40px; color: var(--pastel-pink);
        position: absolute; left: 5px; top: -5px; font-family: Georgia, serif;
    }

    @media (max-width: 768px) {
        .profil-title { font-size: 2rem; }
        .profil-hero { padding: 45px 0; }
        .cute-card { padding: 25px; }
        .section-title-cute { font-size: 1.5rem; }
    }
</style>

<!-- Hero Section -->
<div class="profil-hero">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="profil-title">Profil PAUD Maessar Bayan</h2>
                <p class="profil-subtitle">Mengenal lebih dekat lembaga pendidikan tercinta 🌟</p>
                <div class="divider-cute"></div>
                <div class="mt-3">
                    <span class="decoration-dot dot-pink"></span>
                    <span class="decoration-dot dot-purple"></span>
                    <span class="decoration-dot dot-blue"></span>
                    <span class="decoration-dot dot-yellow"></span>
                    <span class="decoration-dot dot-green"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="container pb-5">

    <!-- Gambar Utama -->
   

    <!-- Foto Banner / Tambahan Atas Kolom -->
    <?php if ($foto_hero): ?>
    <div class="text-center mb-4">
        <img src="<?= $escape($foto_hero); ?>" alt="Banner TK Maessar Bayan" style="max-width: 100%; border-radius: 20px; box-shadow: 0 15px 40px rgba(255,133,162,0.25);">
    </div>
    <?php endif; ?>

    <div class="row">
        <!-- Kolom Kiri: Tentang + Visi Misi -->
        <div class="col-lg-8">

            <!-- Tentang Kami -->
            <div class="cute-card">
                <h3 class="section-title-cute pink">Tentang Kami</h3>
                <p class="tentang-text"><?= $escape($tentang); ?></p>

                <div class="row mt-4">
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-icon">👶</div>
                            <div class="info-title">Usia 3–6 Tahun</div>
                            <div class="info-desc">Program pendidikan untuk anak usia dini</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-icon">📚</div>
                            <div class="info-title">Kurikulum</div>
                            <div class="info-desc">Terintegrasi dengan karakter</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                            <div class="info-icon">🎯</div>
                            <div class="info-title">Tujuan</div>
                            <div class="info-desc">Generasi berakhlak mulia</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sarana & Prasarana -->
            <div class="cute-card">
                <h3 class="section-title-cute purple">Visi &amp; Misi</h3>
                <div class="sarana-prasarana-grid">
                    <div class="sp-box sarana">
                        <span class="sp-box-icon">🏫</span>
                        <div class="sp-box-title">Visi</div>
                        <p class="sp-box-text"><?= $escape($visi); ?></p>
                    </div>
                    <div class="sp-box prasarana">
                        <span class="sp-box-icon">🎠</span>
                        <div class="sp-box-title">Misi</div>
                        <p class="sp-box-text"><?= $escape($misi); ?></p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Kolom Kanan: Kepala Sekolah -->
        <div class="col-lg-4">
            <div class="kepsek-card">
                <img src="<?= $escape($kepsek_foto); ?>" class="kepsek-foto" alt="Kepala Sekolah">
                <h5 class="kepsek-nama"><?= $escape($kepsek_nama); ?></h5>
                <p class="kepsek-jabatan">👩‍🏫 Kepala Sekolah</p>
                <p class="kepsek-quote"><?= $escape($kepsek_quote); ?></p>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>