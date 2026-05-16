<?php
include 'header.php';
include 'koneksi.php';

$data = mysqli_query($conn, "SELECT * FROM profil LIMIT 1");
$row = ($data && mysqli_num_rows($data) > 0) ? mysqli_fetch_assoc($data) : null;

$tentang      = $row['tentang']      ?? 'TK Maessar Bayan adalah lembaga pendidikan anak usia dini yang berfokus pada perkembangan karakter dan potensi anak.';
$visi         = $row['visi']         ?? 'Menjadi lembaga pendidikan anak usia dini yang unggul, berkarakter, dan berlandaskan nilai-nilai islami.';
$misi         = $row['misi']         ?? 'Menyelenggarakan pembelajaran yang menyenangkan dan inovatif untuk mengoptimalkan tumbuh kembang anak.';
$kepsek_nama  = $row['kepsek_nama']  ?? 'Hj. Siti Aisyah, S.Pd';
$kepsek_quote = $row['kepsek_quote'] ?? 'Pendidikan adalah tiket masa depan bagi mereka yang menyiapkannya hari ini.';

$kepsek_foto  = !empty($row['kepsek_foto']) ? 'foto/' . $row['kepsek_foto'] : 'foto/logo.jpeg'; 
$foto_hero    = !empty($row['foto_hero']) ? 'foto/' . $row['foto_hero'] : '';


$escape = fn($v) => htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
body { font-family: 'Inter', sans-serif; background: #f8fafc; color: #1e293b; }

/* Page Header */
.page-hero {
    background: linear-gradient(135deg, #f0f4ff 0%, #fdf4ff 60%, #f0fdf4 100%);
    padding: 60px 0 50px;
    border-bottom: 1px solid #e2e8f0;
}
.page-hero .page-label { font-size:.8rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#6366f1; margin-bottom:10px; }
.page-hero h1 { font-size: clamp(1.8rem,3vw,2.6rem); font-weight:800; color:#0f172a; letter-spacing:-.5px; margin-bottom:10px; }
.page-hero p { color:#64748b; font-size:1rem; margin:0; }

/* Content area */
.content-area { padding: 60px 0; }

/* Modern Card */
.mod-card {
    background: white;
    border-radius: 20px;
    border: 1px solid #f1f5f9;
    padding: 36px;
    margin-bottom: 28px;
    transition: box-shadow .3s;
}
.mod-card:hover { box-shadow: 0 12px 40px rgba(0,0,0,.07); }
.mod-card-label { font-size:.75rem; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#6366f1; margin-bottom:8px; }
.mod-card h3 { font-size:1.3rem; font-weight:700; color:#0f172a; margin-bottom:20px; }
.mod-card p { color:#64748b; line-height:1.8; font-size:.95rem; }

/* Info chips */
.info-chips { display:flex; flex-wrap:wrap; gap:12px; margin-top:24px; }
.chip {
    display:flex; align-items:center; gap:8px;
    background:#f8fafc; border:1px solid #e2e8f0;
    border-radius:10px; padding:10px 16px;
    font-size:.85rem; font-weight:600; color:#475569;
}
.chip span { font-size:1.1rem; }

/* Visi Misi grid */
.vm-grid { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
@media(max-width:768px){ .vm-grid{grid-template-columns:1fr;} }
.vm-box { border-radius:14px; padding:24px; }
.vm-box.visi { background:#ede9fe; }
.vm-box.misi { background:#e0f2fe; }
.vm-box .vm-icon { font-size:1.8rem; margin-bottom:10px; }
.vm-box h5 { font-size:1rem; font-weight:700; color:#0f172a; margin-bottom:8px; }
.vm-box p { font-size:.88rem; color:#475569; line-height:1.7; margin:0; white-space:pre-line; }

/* Kepsek Card */
.kepsek-card {
    background: white;
    border-radius: 20px;
    border: 1px solid #f1f5f9;
    padding: 32px 24px;
    text-align: center;
    position: sticky; top: 90px;
}
.kepsek-card img {
    width:120px; height:120px; border-radius:50%; object-fit:cover;
    border:4px solid #e0e7ff;
    margin-bottom:16px;
}
.kepsek-card h5 { font-size:1.1rem; font-weight:700; color:#0f172a; margin-bottom:4px; }
.kepsek-card .jabatan { font-size:.82rem; font-weight:600; color:#6366f1; margin-bottom:18px; }
.kepsek-card .quote {
    background:#f8fafc; border-left:3px solid #6366f1;
    border-radius:0 10px 10px 0;
    padding:14px 16px; font-size:.88rem;
    color:#64748b; font-style:italic; line-height:1.7; text-align:left;
}

/* Hero banner image */
.hero-banner { border-radius:20px; overflow:hidden; margin-bottom:40px; box-shadow:0 10px 40px rgba(0,0,0,.1); }
.hero-banner img { width:100%; display:block; max-height:340px; object-fit:cover; }

footer { background:#0f172a !important; color:#94a3b8 !important; padding:28px 0 !important; margin-top:0 !important; border-radius:0 !important; }
footer p { color:#94a3b8 !important; font-size:.88rem; margin:0; }
</style>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <p class="page-label">Tentang Kami</p>
        <h1>Profil PAUD Maessar Bayan</h1>
        <p>Mengenal lebih dekat lembaga pendidikan tercinta kami</p>
    </div>
</div>

<!-- Content -->
<div class="content-area">
    <div class="container">

        <?php if ($foto_hero): ?>
        <div class="hero-banner">
            <img src="<?= $escape($foto_hero) ?>" alt="Banner Sekolah">
        </div>
        <?php endif; ?>

        <div class="row g-4">
            <!-- Kolom Kiri -->
            <div class="col-lg-8">

                <!-- Tentang -->
                <div class="mod-card">
                    <p class="mod-card-label">Sekilas</p>
                    <h3>Tentang Kami</h3>
                    <p><?= $escape($tentang) ?></p>
                </div>

                <!-- Visi Misi -->
                <div class="mod-card">
                    <p class="mod-card-label">Arah & Tujuan</p>
                    <h3>Visi &amp; Misi</h3>
                    <div class="vm-grid">
                        <div class="vm-box visi">
                            <div class="vm-icon">🔭</div>
                            <h5>Visi</h5>
                            <p><?= $escape($visi) ?></p>
                        </div>
                        <div class="vm-box misi">
                            <div class="vm-icon">🎯</div>
                            <h5>Misi</h5>
                            <p><?= $escape($misi) ?></p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Kolom Kanan: Kepsek -->
            <div class="col-lg-4">
                <div class="kepsek-card">
                    <img src="<?= $escape($kepsek_foto) ?>" alt="Kepala Sekolah">
                    <h5><?= $escape($kepsek_nama) ?></h5>
                    <p class="jabatan">Kepala Sekolah</p>
                    <div class="quote"><?= $escape($kepsek_quote) ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>