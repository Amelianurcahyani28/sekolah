<?php include 'header.php'; ?>

<!-- HERO SECTION -->
<section class="py-5" style="background: linear-gradient(to bottom, #ffffff, #eef7ee);">
  <div class="container">
    <div class="row align-items-center">

      <!-- TEXT -->
      <div class="col-md-6">
        <h1 class="fw-bold display-5">
          Membentuk Generasi <br>
          <span style="color:#7bbf7b;">Cerdas & Berakhlak</span>
        </h1>
        <p class="text-muted">
          Pendidikan usia dini yang dirancang untuk menginspirasi kreativitas dan rasa percaya diri anak.
        </p>
        <a href="#" class="btn px-4 py-2" style="background:#ff8a80; color:white; border-radius:20px;">
          Hubungi Kami ☎
        </a>
      </div>

      <!-- IMAGE -->
      <div class="col-md-6 text-center">
        <div style="background:#f4c46c; border-radius:40px; padding:20px; display:inline-block;">
          <img src="barengan.jpeg" class="img-fluid" style="max-width:300px;">
        </div>
      </div>

    </div>
  </div>
</section>


<!-- FITUR -->
<section class="py-5">
  <div class="container text-center">
    <div class="row g-4">

      <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
          <div class="mb-3 fs-1">🎨</div>
          <h5 class="fw-bold">Kreatif</h5>
          <p class="text-muted">
            Program seni dan musik untuk mengasah imajinasi anak sejak dini.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
          <div class="mb-3 fs-1">🧠</div>
          <h5 class="fw-bold">Cerdas</h5>
          <p class="text-muted">
            Penguatan literasi dan numerasi dengan cara menyenangkan.
          </p>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm p-4 h-100">
          <div class="mb-3 fs-1">🏃</div>
          <h5 class="fw-bold">Aktif</h5>
          <p class="text-muted">
            Kegiatan outdoor untuk perkembangan fisik anak.
          </p>
        </div>
      </div>

    </div>
  </div>
</section>


<!-- ARTIKEL -->
<section class="py-5 bg-light">
  <div class="container text-center">
    <h3 class="fw-bold">Artikel & Tips Terbaru</h3>
    <p class="text-muted">Tips parenting dan edukasi anak</p>

    <div class="row g-4 mt-3">

      <!-- CARD -->
      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <img src="anak1.jpg" class="card-img-top">
          <div class="card-body text-start">
            <small class="badge bg-success">Tips Anak</small>
            <h6 class="fw-bold mt-2">Cara Melatih Kemandirian Anak</h6>
            <p class="text-muted small">Membiasakan anak mandiri sejak dini...</p>
            <a href="#" class="text-success">Baca Selengkapnya →</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <img src="anak2.jpg" class="card-img-top">
          <div class="card-body text-start">
            <small class="badge bg-success">Edukasi</small>
            <h6 class="fw-bold mt-2">Manfaat Mendongeng</h6>
            <p class="text-muted small">Meningkatkan imajinasi anak...</p>
            <a href="#" class="text-success">Baca Selengkapnya →</a>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card border-0 shadow-sm h-100">
          <img src="anak3.jpg" class="card-img-top">
          <div class="card-body text-start">
            <small class="badge bg-success">Aktivitas</small>
            <h6 class="fw-bold mt-2">Permainan Edukatif</h6>
            <p class="text-muted small">Permainan seru untuk anak...</p>
            <a href="#" class="text-success">Baca Selengkapnya →</a>
          </div>
        </div>
      </div>

    </div>

    <a href="artikel.php" class="btn mt-4 px-4" style="background:#7bbf7b; color:white; border-radius:20px;">
      Lihat Semua Artikel →
    </a>

  </div>
</section>


<!-- GALERI -->
<section class="py-5" style="background:#dfeee0;">
  <div class="container text-center">
    <h3 class="fw-bold">Kegiatan Kami</h3>
    <p class="text-muted">Berbagai aktivitas anak</p>

    <div class="row g-3 mt-3">
      <?php for($i=1;$i<=6;$i++): ?>
        <div class="col-md-4">
          <div style="background:black; height:150px; border-radius:10px;"></div>
        </div>
      <?php endfor; ?>
    </div>

    <a href="gallery.php" class="btn mt-4 px-4" style="background:#7bbf7b; color:white; border-radius:20px;">
      Lihat Galeri →
    </a>
  </div>
</section>


<!-- CTA -->
<section class="py-5 text-center">
  <div class="container">
    <h3 class="fw-bold">Siap Bergabung dengan Kami?</h3>
    <p class="text-muted">Mari bersama membentuk masa depan anak</p>
    <a href="daftar.php" class="btn px-4 py-2" style="background:#ff8a80; color:white; border-radius:20px;">
      Hubungi Kami ☎
    </a>
  </div>
</section>

<?php include 'footer.php'; ?>