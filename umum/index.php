<?php include 'header.php'; ?>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

* { box-sizing: border-box; }

body {
    font-family: 'Inter', sans-serif;
    background: #f8fafc;
    color: #1e293b;
    margin: 0;
}

/* ── NAVBAR OVERRIDE ── */
.navbar {
    background: rgba(255,255,255,0.95) !important;
    backdrop-filter: blur(12px);
    border-bottom: 1px solid #e2e8f0 !important;
    box-shadow: 0 1px 20px rgba(0,0,0,0.06);
    border-radius: 0 !important;
    padding: 14px 0;
}
.navbar-brand {
    font-family: 'Inter', sans-serif !important;
    font-weight: 800 !important;
    font-size: 1.3rem !important;
    background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
    -webkit-background-clip: text !important;
    -webkit-text-fill-color: transparent !important;
    background-clip: text !important;
}
.nav-link { font-weight: 500; color: #64748b !important; transition: color .2s; font-size: .9rem; }
.nav-link:hover, .nav-link.active { color: #6366f1 !important; }
.btn-daftar {
    background: linear-gradient(135deg, #6366f1, #8b5cf6) !important;
    color: white !important;
    border-radius: 8px !important;
    padding: 8px 20px !important;
    font-weight: 600 !important;
    font-size: .88rem !important;
    transition: opacity .2s, transform .2s !important;
    border: none !important;
}
.btn-daftar:hover { opacity: .88; transform: translateY(-1px); }

/* ── HERO ── */
.hero {
    min-height: 88vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #f0f4ff 0%, #fdf4ff 50%, #f0fdf4 100%);
    padding: 80px 0 60px;
    position: relative;
    overflow: hidden;
}
.hero::before {
    content: '';
    position: absolute;
    width: 500px; height: 500px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(99,102,241,.1) 0%, transparent 70%);
    top: -100px; right: -100px;
    pointer-events: none;
}
.hero::after {
    content: '';
    position: absolute;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(139,92,246,.08) 0%, transparent 70%);
    bottom: -80px; left: -80px;
    pointer-events: none;
}
.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: white;
    border: 1px solid #e0e7ff;
    color: #6366f1;
    font-size: .82rem;
    font-weight: 600;
    padding: 6px 14px;
    border-radius: 100px;
    margin-bottom: 24px;
    box-shadow: 0 2px 10px rgba(99,102,241,.12);
}
.hero-badge span { width: 8px; height: 8px; background: #6366f1; border-radius: 50%; display: inline-block; animation: blink 1.5s infinite; }
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.3} }

.hero h1 {
    font-size: clamp(2.2rem, 4vw, 3.4rem);
    font-weight: 800;
    line-height: 1.15;
    color: #0f172a;
    margin-bottom: 20px;
    letter-spacing: -1px;
}
.hero h1 .highlight {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.hero p.lead {
    font-size: 1.05rem;
    color: #64748b;
    line-height: 1.75;
    margin-bottom: 36px;
    max-width: 480px;
}
.btn-primary-custom {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: white;
    padding: 14px 28px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: .95rem;
    transition: all .3s;
    box-shadow: 0 4px 20px rgba(99,102,241,.35);
    border: none;
}
.btn-primary-custom:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(99,102,241,.45);
}
.btn-outline-custom {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: 1.5px solid #cbd5e1;
    color: #475569;
    padding: 14px 28px;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    font-size: .95rem;
    transition: all .3s;
    background: white;
}
.btn-outline-custom:hover {
    border-color: #6366f1;
    color: #6366f1;
    transform: translateY(-2px);
}

/* Hero Image */
.hero-img-container {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 25px 60px rgba(0,0,0,.15);
}
.hero-img-container img {
    width: 100%;
    display: block;
    border-radius: 24px;
    transition: transform .5s ease;
}
.hero-img-container:hover img { transform: scale(1.03); }
.hero-img-badge {
    position: absolute;
    bottom: 20px; left: 20px;
    background: rgba(255,255,255,.95);
    backdrop-filter: blur(10px);
    border-radius: 12px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,.1);
}
.hero-img-badge .icon { font-size: 1.5rem; }
.hero-img-badge .text strong { display: block; font-size: .85rem; font-weight: 700; color: #0f172a; }
.hero-img-badge .text span { font-size: .75rem; color: #64748b; }

/* ── STATS ── */
.stats-section {
    padding: 50px 0;
    background: white;
    border-top: 1px solid #f1f5f9;
    border-bottom: 1px solid #f1f5f9;
}
.stat-item { text-align: center; padding: 10px; }
.stat-item .num {
    font-size: 2.2rem;
    font-weight: 800;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
}
.stat-item .label { font-size: .85rem; color: #64748b; margin-top: 4px; font-weight: 500; }
.stat-divider { width: 1px; background: #e2e8f0; height: 50px; margin: auto; }

/* ── PROGRAM ── */
.section-program {
    padding: 90px 0;
    background: #f8fafc;
}
.section-label {
    font-size: .8rem;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: #6366f1;
    margin-bottom: 12px;
}
.section-title {
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 800;
    color: #0f172a;
    letter-spacing: -.5px;
    margin-bottom: 14px;
}
.section-desc { color: #64748b; font-size: 1rem; line-height: 1.7; max-width: 500px; margin: 0 auto; }

.program-card {
    background: white;
    border-radius: 20px;
    padding: 32px 28px;
    height: 100%;
    border: 1px solid #f1f5f9;
    transition: all .35s ease;
    position: relative;
    overflow: hidden;
}
.program-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    border-radius: 20px 20px 0 0;
    opacity: 0;
    transition: opacity .35s;
}
.program-card.card-purple::before { background: linear-gradient(90deg, #6366f1, #8b5cf6); }
.program-card.card-pink::before { background: linear-gradient(90deg, #ec4899, #f43f5e); }
.program-card.card-teal::before { background: linear-gradient(90deg, #14b8a6, #06b6d4); }

.program-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 50px rgba(0,0,0,.09);
    border-color: transparent;
}
.program-card:hover::before { opacity: 1; }

.program-icon {
    width: 60px; height: 60px;
    border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.6rem;
    margin-bottom: 20px;
}
.icon-purple { background: #ede9fe; }
.icon-pink   { background: #fce7f3; }
.icon-teal   { background: #ccfbf1; }

.program-card h5 {
    font-size: 1.15rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 10px;
}
.program-card p {
    font-size: .9rem;
    color: #64748b;
    line-height: 1.7;
    margin: 0;
}

/* ── CTA ── */
.cta-section {
    padding: 90px 0;
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    position: relative;
    overflow: hidden;
    text-align: center;
}
.cta-section::before {
    content: '';
    position: absolute;
    width: 400px; height: 400px;
    border-radius: 50%;
    background: rgba(255,255,255,.07);
    top: -150px; right: -80px;
}
.cta-section::after {
    content: '';
    position: absolute;
    width: 300px; height: 300px;
    border-radius: 50%;
    background: rgba(255,255,255,.05);
    bottom: -100px; left: -60px;
}
.cta-section h2 {
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 800;
    color: white;
    margin-bottom: 14px;
    position: relative; z-index: 1;
}
.cta-section p {
    color: rgba(255,255,255,.8);
    font-size: 1rem;
    margin-bottom: 36px;
    position: relative; z-index: 1;
}
.btn-white {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: white;
    color: #6366f1;
    padding: 14px 32px;
    border-radius: 10px;
    font-weight: 700;
    text-decoration: none;
    font-size: .95rem;
    transition: all .3s;
    position: relative; z-index: 1;
    box-shadow: 0 4px 20px rgba(0,0,0,.15);
}
.btn-white:hover { color: #4f46e5; transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,.2); }

/* ── FOOTER OVERRIDE ── */
footer {
    background: #0f172a !important;
    color: #94a3b8 !important;
    padding: 28px 0 !important;
    margin-top: 0 !important;
    border-radius: 0 !important;
}
footer p { color: #94a3b8 !important; font-size: .88rem; margin: 0; }

/* ── RESPONSIVE ── */
@media (max-width: 768px) {
    .hero { padding: 60px 0 40px; min-height: auto; }
    .stat-divider { display: none; }
    .hero-img-container { margin-top: 40px; }
}
</style>

<!-- HERO -->
<section class="hero">
    <div class="container" style="position:relative;z-index:1;">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <div class="hero-badge">
                </div>
                <h1>
                    <strong>Paud Maessar Bayan</strong>
                </h1>

                <h1>
                    Tumbuh Bersama,<br>
                    <span class="highlight">Belajar dengan Ceria</span>
                </h1>
                <p class="lead">
                    PAUD Maessar Bayan hadir untuk menemani tumbuh kembang anak dengan pendekatan bermain yang menyenangkan, kreatif, dan penuh kasih sayang.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="hero-img-container">
                    <img src="barengan.jpeg" alt="Siswa PAUD Maessar Bayan">
                    <div class="hero-img-badge">
                        <span class="icon">🏫</span>
                        <div class="text">
                            <strong>PAUD Maessar Bayan</strong>
                            <span>Terakreditasi C & Terpercaya</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- PROGRAM -->
<section class="section-program">
    <div class="container">
        <div class="text-center mb-5">
            <p class="section-label">Program Kami</p>
            <h2 class="section-title">Program Unggulan</h2>
            <p class="section-desc">Dirancang untuk mengembangkan potensi anak secara menyeluruh — kognitif, fisik, dan emosional.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="program-card card-purple">
                    <div class="program-icon icon-purple">🎨</div>
                    <h5>Kreatif & Seni</h5>
                    <p>Program seni, musik, dan kerajinan tangan untuk mengasah imajinasi dan kreativitas anak sejak dini.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="program-card card-pink">
                    <div class="program-icon icon-pink">🧠</div>
                    <h5>Literasi & Numerasi</h5>
                    <p>Penguatan kemampuan membaca dan berhitung dengan metode bermain yang menyenangkan dan efektif.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="program-card card-teal">
                    <div class="program-icon icon-teal">🤸</div>
                    <h5>Gerak & Aktif</h5>
                    <p>Kegiatan fisik dan motorik yang meningkatkan kesehatan, koordinasi, dan kepercayaan diri anak.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <h2>Bergabunglah Bersama Kami 🌟</h2>
        <p>Daftarkan putra-putri Anda dan biarkan kami menemani perjalanan belajar terbaik mereka.</p>
        <a href="daftar.php" class="btn-white">
            Daftar Sekarang →
        </a>
    </div>
</section>

<?php include 'footer.php'; ?>