<?php include 'header.php'; ?>
<?php include 'koneksi.php'; ?>

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

.perkembangan-section { padding:60px 0; }

.milestone-card {
    background:white;
    border-radius:24px;
    border:1px solid #f1f5f9;
    padding:32px;
    transition:all .3s cubic-bezier(0.4, 0, 0.2, 1);
    height:100%;
    position: relative;
    overflow: hidden;
}
.milestone-card:hover { 
    transform:translateY(-8px); 
    box-shadow:0 20px 40px rgba(99, 102, 241, 0.08); 
    border-color: #e0e7ff; 
}
.milestone-icon {
    width: 56px;
    height: 56px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-bottom: 24px;
    background: #f8fafc;
}
.milestone-card.physical .milestone-icon { background: #eff6ff; color: #3b82f6; }
.milestone-card.cognitive .milestone-icon { background: #fef2f2; color: #ef4444; }
.milestone-card.language .milestone-icon { background: #f0fdf4; color: #22c55e; }
.milestone-card.social .milestone-icon { background: #fdf4ff; color: #d946ef; }

.milestone-card h3 { font-size:1.25rem; font-weight:700; color:#0f172a; margin-bottom:12px; }
.milestone-card p { font-size:.95rem; color:#64748b; line-height: 1.6; margin-bottom: 20px; }

.milestone-list { list-style: none; padding: 0; margin: 0; }
.milestone-list li { 
    font-size: .88rem; 
    color: #475569; 
    padding-left: 24px; 
    position: relative; 
    margin-bottom: 8px;
}
.milestone-list li::before {
    content: "✓";
    position: absolute;
    left: 0;
    color: #6366f1;
    font-weight: 700;
}

footer { background:#0f172a !important; color:#94a3b8 !important; padding:28px 0 !important; margin-top:0 !important; border-radius:0 !important; }
footer p { color:#94a3b8 !important; font-size:.88rem; margin:0; }
</style>

<!-- Page Hero -->
<div class="page-hero">
    <div class="container">
        <p class="page-label">Tumbuh Kembang</p>
        <h1>Perkembangan Anak</h1>
        <p>Pantau dan dukung setiap tahapan perkembangan buah hati Anda bersama kami.</p>
    </div>
</div>

<!-- Section Prestasi Siswa -->
<section class="perkembangan-section">
    <div class="container">
        <div class="row mt-2 mb-4">
            <div class="col-12 text-center mb-5">
                <h2 class="fw-800" style="color: #0f172a; font-size: 2.2rem;">Kebanggaan Maessar Bayan</h2>
                <p class="text-muted">Apresiasi untuk setiap langkah kecil dan pencapaian luar biasa anak didik kami.</p>
            </div>
        </div>

        <div class="row g-4">
            <?php
            $prestasi = mysqli_query($conn, "SELECT * FROM perkembangan_anak ORDER BY id DESC");
            if(mysqli_num_rows($prestasi) > 0):
                while($row = mysqli_fetch_assoc($prestasi)):
            ?>
            <div class="col-sm-6 col-lg-4">
                <div class="card border-0 shadow-sm overflow-hidden h-100" style="border-radius: 18px; transition: transform .3s; background: white;">
                    <style>
                        .achievement-card:hover { transform: translateY(-5px); }
                        .achievement-img { height: 240px; width: 100%; object-fit: cover; display: block; transition: transform .4s; }
                        .achievement-card:hover .achievement-img { transform: scale(1.05); }
                        .achievement-body { padding: 20px; }
                        .achievement-name { font-size: 1.05rem; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
                        .achievement-desc { font-size: .88rem; color: #64748b; margin: 0; line-height: 1.5; }
                    </style>
                    <div class="achievement-card">
                        <?php if($row['foto'] != ""): ?>
                            <div style="overflow: hidden;">
                                <img src="foto/<?= htmlspecialchars($row['foto']) ?>" class="achievement-img" alt="<?= htmlspecialchars($row['nama_anak']) ?>">
                            </div>
                        <?php endif; ?>
                        <div class="achievement-body">
                            <h4 class="achievement-name"><?= htmlspecialchars($row['nama_anak']) ?></h4>
                            <p class="achievement-desc"><?= htmlspecialchars($row['prestasi']) ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                endwhile;
            else:
            ?>
            <div class="col-12 text-center py-5">
                <div class="bg-white p-5 rounded-4 shadow-sm border" style="border: 1.5px dashed #cbd5e1 !important;">
                    <p class="text-muted m-0">Belum ada foto prestasi yang ditambahkan.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>
