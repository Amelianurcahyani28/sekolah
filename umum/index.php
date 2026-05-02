<?php include 'header.php'; ?>

<style>
/* ============================================
   TK Maessar Bayan - Style CSS
   Desain Lucu & Menggemaskan untuk PAUD
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

/* NAVBAR override */
.navbar {
    background: linear-gradient(90deg, #ffffff 0%, #fff9f9 100%) !important;
    box-shadow: 0 4px 15px rgba(255, 133, 162, 0.15);
    border-bottom: 4px solid var(--pastel-pink) !important;
    border-radius: 0 0 20px 20px;
}
.navbar-brand {
    background: linear-gradient(45deg, var(--cute-pink), var(--cute-purple));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 1.5rem !important;
}

/* HERO SECTION - Lebih Colorful */
.hero-cute {
    background: linear-gradient(135deg, 
        var(--pastel-pink) 0%, 
        var(--pastel-purple) 50%, 
        var(--pastel-blue) 100%);
    padding: 80px 0;
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
}

/* Decorative elements */
.hero-cute::before,
.hero-cute::after {
    content: '★';
    position: absolute;
    font-size: 3rem;
    color: rgba(255, 255, 255, 0.3);
    animation: float 3s ease-in-out infinite;
}
.hero-cute::before { top: 20px; left: 10%; }
.hero-cute::after { bottom: 20px; right: 10%; animation-delay: 1.5s; }

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(10deg); }
}

.hero-cute .title-cute {
    font-size: 3rem;
    font-weight: 800;
    text-shadow: 3px 3px 0 rgba(0,0,0,0.1);
    margin-bottom: 20px;
    letter-spacing: 1px;
}

.text-gradient {
    background: linear-gradient(45deg, #fff9c4, #fff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-cute .subtitle-cute {
    font-size: 1.3rem;
    margin-bottom: 30px;
    font-weight: 500;
}

/* Hero decoration items */
.hero-cute .hero-decoration {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    z-index: 0;
}
.hero-cute .deco-item {
    position: absolute;
    font-size: 2.5rem;
    animation: float 3s infinite ease-in-out;
    filter: drop-shadow(0 3px 5px rgba(0,0,0,0.1));
}
.hero-cute .deco-balloon { top: 10%; left: 15%; animation-delay: 0s; }
.hero-cute .deco-star { top: 20%; right: 10%; animation-delay: 0.5s; }
.hero-cute .deco-heart { bottom: 15%; left: 20%; animation-delay: 1s; }
.hero-cute .deco-ribbon { bottom: 10%; right: 15%; animation-delay: 1.5s; }

/* Button Cute */
.hero-cute .btn-cute {
    display: inline-block;
    padding: 14px 32px;
    background: linear-gradient(135deg, var(--cute-pink), var(--cute-coral));
    color: white;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 700;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 6px 25px rgba(255, 127, 127, 0.5);
    position: relative;
    overflow: hidden;
}

.hero-cute .btn-cute::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s ease;
}

.hero-cute .btn-cute:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(255, 127, 127, 0.6);
    color: white;
}

.hero-cute .btn-cute:hover::before {
    left: 100%;
}

/* Bubble Chat Cute */
.bubble-chat {
    display: inline-flex;
    align-items: center;
    background: white;
    border-radius: 25px;
    padding: 12px 20px;
    margin-top: 25px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    position: relative;
}

.bubble-chat::before {
    content: '';
    position: absolute;
    top: -10px;
    left: 30px;
    border: 10px solid transparent;
    border-bottom-color: white;
    border-top: none;
}

.bubble-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    margin-right: 12px;
    object-fit: cover;
}

.bubble-text {
    color: #555;
    font-size: 0.95rem;
    font-weight: 600;
}

/* Hero Image */
.hero-image-wrap {
    position: relative;
}

.hero-img {
    border-radius: 30px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    border: 5px solid white;
    transform: rotate(-2deg);
    transition: transform 0.3s ease;
}

.hero-img:hover {
    transform: rotate(0deg) scale(1.02);
}

/* SECTION FITUR */
.section-fitur {
    padding: 70px 0;
    background: white;
    margin: 40px 0;
    border-radius: 30px;
    box-shadow: 0 10px 40px rgba(255, 133, 162, 0.15);
}

.section-title-cute {
    font-size: 2.5rem;
    font-weight: 800;
    color: #2d3436;
    margin-bottom: 10px;
}

.section-fitur .subtitle-cute {
    font-size: 1.1rem;
    color: #636e72;
    margin-bottom: 20px;
}

.divider-cute {
    width: 150px;
    height: 8px;
    background: linear-gradient(90deg, var(--pastel-pink), var(--pastel-purple), var(--pastel-blue), var(--pastel-green));
    border-radius: 10px;
    margin: 0 auto 30px;
    box-shadow: 0 4px 15px rgba(255, 133, 162, 0.3);
}

/* Fitur Card */
.fitur-card {
    background: linear-gradient(145deg, #ffffff, #fff5f7);
    border: none;
    border-radius: 25px;
    padding: 30px 25px;
    box-shadow: 0 8px 25px rgba(255, 133, 162, 0.15);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    position: relative;
    overflow: hidden;
}

.fitur-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 6px;
    background: linear-gradient(90deg, var(--pastel-pink), var(--pastel-purple), var(--pastel-blue));
}

.fitur-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(255, 133, 162, 0.25);
}

.fitur-icon {
    font-size: 3rem;
    display: block;
    margin-bottom: 15px;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

.fitur-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #2d3436;
    margin-bottom: 12px;
}

.fitur-desc {
    font-size: 0.95rem;
    color: #636e72;
    line-height: 1.6;
}

.badge-new {
    background: linear-gradient(135deg, var(--cute-yellow), var(--pastel-orange));
    color: #8b6914;
    padding: 4px 10px;
    border-radius: 15px;
    font-size: 0.7rem;
    font-weight: 700;
    margin-left: 8px;
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Responsive */
@media (max-width: 768px) {
    .hero-cute .title-cute {
        font-size: 2rem;
    }
    
    .hero-cute {
        padding: 50px 0;
    }
    
    .bubble-chat {
        flex-direction: column;
        text-align: center;
    }
    
    .bubble-avatar {
        margin-right: 0;
        margin-bottom: 10px;
    }
    
    .section-title-cute {
        font-size: 1.8rem;
    }
}
</style>

<!-- HERO SECTION -->
<section class="hero-cute">
    <div class="hero-decoration">
        <span class="deco-item deco-balloon">🎈</span>
        <span class="deco-item deco-star">⭐</span>
        <span class="deco-item deco-heart">💖</span>
        <span class="deco-item deco-ribbon">🎀</span>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="title-cute">Membentuk Generasi <br><span class="text-gradient">Cerdas & Berakhlak</span> 🌟</h1>
                <p class="subtitle-cute">Pendidikan usia dini yang dirancang untuk menginspirasi kreativitas dan rasa percaya diri anak.</p>
                <div class="bubble-chat">
                    <img src="https://cdn.pixabay.com/photo/2017/01/31/13/14/animal-2023924_1280.png" alt="Maskot" class="bubble-avatar">
                    <div class="bubble-text">Hai, selamat datang di TK Maessar Bayan! Yuk, belajar sambil bermain! 🥰</div>
                </div>
            </div>
            <div class="col-md-6 text-center mt-4 mt-md-0">
                <div class="hero-image-wrap">
                    <img src="barengan.jpeg" class="img-fluid hero-img" alt="Siswa TK">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PROGRAM UNGGULAN -->
<section class="section-fitur">
    <div class="container text-center">
        <h2 class="section-title-cute">Program Unggulan 🌈</h2>
        <p class="subtitle-cute">Mengembangkan potensi anak secara optimal 🎓</p>
        <div class="divider-cute"></div>
        <div class="row g-4 mt-3">
            <div class="col-md-4">
                <div class="fitur-card h-100">
                    <span class="fitur-icon">🎨</span>
                    <h5 class="fitur-title">Kreatif <span class="badge-new">NEW!</span></h5>
                    <p class="fitur-desc">Program seni dan musik untuk mengasah imajinasi anak dengan berbagai kegiatan menarik.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fitur-card h-100">
                    <span class="fitur-icon">🧠</span>
                    <h5 class="fitur-title">Cerdas</h5>
                    <p class="fitur-desc">Penguatan literasi dan numerasi dengan metode pembelajaran yang menyenangkan dan interaktif.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="fitur-card h-100">
                    <span class="fitur-icon">🤸‍♂️</span>
                    <h5 class="fitur-title">Aktif</h5>
                    <p class="fitur-desc">Kegiatan olahraga dan permainan yang dirancang untuk meningkatkan kesehatan fisik dan koordinasi anak.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>