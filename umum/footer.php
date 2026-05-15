<?php
// Gunakan $conn yang sudah ada, atau buat koneksi baru jika belum ada
if (!isset($conn) || !$conn) {
    $conn = @mysqli_connect('localhost', 'root', '', 'db_tk_maessar');
}
$_f_profil = null;
if ($conn) {
    $_f_res    = mysqli_query($conn, "SELECT alamat_sekolah, no_telp, email FROM profil LIMIT 1");
    $_f_profil = $_f_res ? mysqli_fetch_assoc($_f_res) : null;
}
$_f_alamat = !empty($_f_profil['alamat_sekolah']) ? htmlspecialchars($_f_profil['alamat_sekolah']) : 'Jl. Maessar Bayan, Lombok Utara, NTB';
$_f_telp   = !empty($_f_profil['no_telp'])        ? htmlspecialchars($_f_profil['no_telp'])        : '(0370) 123456';
$_f_email  = !empty($_f_profil['email'])           ? htmlspecialchars($_f_profil['email'])          : 'info@maessarbayan.sch.id';
?>

<footer style="background:#0f172a; color:#94a3b8; margin-top:0; padding:60px 0 0;">
    <div class="container">
        <div class="row g-5 pb-5">

            <!-- Brand -->
            <div class="col-lg-4">
                <div style="font-size:1.2rem;font-weight:800;background:linear-gradient(135deg,#6366f1,#8b5cf6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:12px;">
                    Maessar Bayan
                </div>
                <p style="font-size:.88rem;line-height:1.8;color:#64748b;margin-bottom:20px;">
                    Lembaga pendidikan anak usia dini yang berfokus pada tumbuh kembang karakter, kreativitas, dan kecerdasan anak.
                </p>
                <!-- Medsos -->
                <div style="display:flex;gap:10px;">
                    <!-- Instagram -->
                    <a href="https://www.instagram.com/paudmaessarbayan/" title="Instagram" target="_blank" style="width:36px;height:36px;border-radius:10px;background:#1e293b;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all .2s;" onmouseover="this.style.background='#e1306c'" onmouseout="this.style.background='#1e293b'">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                    </a>
                    <!-- TikTok -->
                    <a href="https://www.tiktok.com/@kb.maessar.bayan" title="TikTok" target="_blank" style="width:36px;height:36px;border-radius:10px;background:#1e293b;display:flex;align-items:center;justify-content:center;text-decoration:none;transition:all .2s;" onmouseover="this.style.background='#010101'" onmouseout="this.style.background='#1e293b'">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="#94a3b8"><path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-2.88 2.5 2.89 2.89 0 0 1-2.89-2.89 2.89 2.89 0 0 1 2.89-2.89c.28 0 .54.04.79.1V9.01a6.27 6.27 0 0 0-.79-.05 6.34 6.34 0 0 0-6.34 6.34 6.34 6.34 0 0 0 6.34 6.34 6.34 6.34 0 0 0 6.33-6.34V8.75a8.16 8.16 0 0 0 4.77 1.52V6.82a4.85 4.85 0 0 1-1-.13z"/></svg>
                    </a>
                </div>
            </div>

            <!-- Menu -->
            <div class="col-6 col-lg-2">
                <p style="font-size:.8rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#475569;margin-bottom:16px;">Menu</p>
                <ul style="list-style:none;padding:0;margin:0;">
                    <?php foreach(['Home'=>'index.php','Profil'=>'profil.php','Gallery'=>'gallery.php','Artikel'=>'artikel.php','Daftar'=>'daftar.php'] as $label=>$href): ?>
                    <li style="margin-bottom:10px;">
                        <a href="<?= $href ?>" style="color:#64748b;text-decoration:none;font-size:.88rem;transition:color .2s;" onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#64748b'"><?= $label ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Kontak -->
            <div class="col-lg-5">
                <p style="font-size:.8rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;color:#475569;margin-bottom:16px;">Kontak</p>
                <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:14px;">
                    <li style="display:flex;align-items:flex-start;gap:12px;">
                        <span style="font-size:1rem;margin-top:1px;">📍</span>
                        <span style="font-size:.88rem;color:#64748b;line-height:1.6;"><?= $_f_alamat ?></span>
                    </li>
                    <li style="display:flex;align-items:center;gap:12px;">
                        <span style="font-size:1rem;">📞</span>
                        <a href="tel:<?= preg_replace('/[^0-9+]/','',$_f_telp) ?>" style="font-size:.88rem;color:#64748b;text-decoration:none;" onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#64748b'"><?= $_f_telp ?></a>
                    </li>
                    <li style="display:flex;align-items:center;gap:12px;">
                        <span style="font-size:1rem;">✉️</span>
                        <a href="mailto:<?= $_f_email ?>" style="font-size:.88rem;color:#64748b;text-decoration:none;" onmouseover="this.style.color='#6366f1'" onmouseout="this.style.color='#64748b'"><?= $_f_email ?></a>
                    </li>
                </ul>

                <!-- Google Maps -->
                <div style="margin-top:20px;border-radius:12px;overflow:hidden;border:1px solid #1e293b;">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d990.64!2d106.7424875!3d-6.6360607!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69cfc0628e241b%3A0xec19ef26982f7b90!2sPaud%20Maessar%20Bayan!5e0!3m2!1sid!2sid!4v1"
                        width="100%"
                        height="160"
                        style="border:0;display:block;filter:grayscale(20%) contrast(1.1);"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi PAUD Maessar Bayan">
                    </iframe>
                </div>
                <a href="https://www.google.com/maps/place/Paud+Maessar+Bayan/@-6.6360607,106.7424875,17z/data=!3m1!4b1!4m6!3m5!1s0x2e69cfc0628e241b:0xec19ef26982f7b90!8m2!3d-6.6360607!4d106.7450624!16s%2Fg%2F11ssrmcwp8?entry=ttu&g_ep=EgoyMDI2MDUxMC4wIKXMDSoASAFQAw%3D%3D" target="_blank" style="display:inline-flex;align-items:center;gap:6px;margin-top:10px;font-size:.78rem;color:#6366f1;text-decoration:none;font-weight:600;" onmouseover="this.style.opacity='.8'" onmouseout="this.style.opacity='1'">
                    🗺️ Buka di Google Maps →
                </a>
            </div>

        </div>

        <!-- Bottom Bar -->
        <div style="border-top:1px solid #1e293b;padding:20px 0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;">
            <p style="margin:0;font-size:.82rem;color:#475569;">© 2026 PAUD Maessar Bayan. All rights reserved.</p>
            <p style="margin:0;font-size:.82rem;color:#475569;">Ceria &amp; Berprestasi 🌟</p>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>