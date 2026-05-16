<?php
ob_start();
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../admin/login.php");
    exit;
}
$page = $_GET['page'] ?? 'beranda';
$allowedPages = ['beranda','profil','gallery','artikel','siswa','perkembangan'];
if (!in_array($page, $allowedPages, true)) $page = 'beranda';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin PAUD Maessar Bayan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { box-sizing:border-box; }
        body { font-family:'Inter',sans-serif; background:#f1f5f9; margin:0; min-height:100vh; }

        /* Sidebar */
        .sidebar {
            width:240px; min-height:100vh; position:fixed; top:0; left:0;
            background:#0f172a; display:flex; flex-direction:column;
            z-index:100;
        }
        .sidebar-brand {
            padding:24px 20px 20px;
            border-bottom:1px solid rgba(255,255,255,.08);
        }
        .sidebar-brand .brand-name {
            font-size:1.1rem; font-weight:800; color:white;
            display:flex; align-items:center; gap:10px;
        }
        .brand-icon {
            width:36px; height:36px; border-radius:10px;
            background:linear-gradient(135deg,#6366f1,#8b5cf6);
            display:flex; align-items:center; justify-content:center;
            font-size:1rem;
        }
        .brand-sub { font-size:.72rem; color:#64748b; margin-top:3px; }

        .sidebar-nav { flex:1; padding:16px 12px; }
        .nav-section-label {
            font-size:.68rem; font-weight:700; letter-spacing:1.5px;
            text-transform:uppercase; color:#475569; padding:8px 10px 6px;
        }
        .sidebar-link {
            display:flex; align-items:center; gap:10px;
            padding:10px 12px; border-radius:10px;
            color:#94a3b8; font-size:.88rem; font-weight:500;
            text-decoration:none; transition:all .2s; margin-bottom:2px;
        }
        .sidebar-link i { width:18px; font-size:.9rem; }
        .sidebar-link:hover { background:rgba(255,255,255,.06); color:white; }
        .sidebar-link.active { background:linear-gradient(135deg,#6366f1,#8b5cf6); color:white; }

        .sidebar-footer { padding:16px 12px; border-top:1px solid rgba(255,255,255,.08); }

        /* Main */
        .main-wrapper { margin-left:240px; min-height:100vh; }

        .topbar {
            background:white; border-bottom:1px solid #e2e8f0;
            padding:14px 28px;
            display:flex; align-items:center; justify-content:space-between;
            position:sticky; top:0; z-index:50;
        }
        .topbar-title { font-size:1rem; font-weight:700; color:#0f172a; }
        .topbar-sub { font-size:.78rem; color:#94a3b8; margin-top:1px; }
        .topbar-user {
            display:flex; align-items:center; gap:10px;
            font-size:.85rem; font-weight:600; color:#475569;
        }
        .user-avatar {
            width:34px; height:34px; border-radius:50%;
            background:linear-gradient(135deg,#6366f1,#8b5cf6);
            display:flex; align-items:center; justify-content:center;
            color:white; font-size:.8rem; font-weight:700;
        }

        .main-content { padding:28px; }

        /* Content override for sub-pages */
        .card-admin {
            background:white; border-radius:16px;
            border:1px solid #e2e8f0; padding:24px;
            margin-bottom:20px;
        }
        .btn-admin {
            background:linear-gradient(135deg,#6366f1,#8b5cf6);
            color:white; border:none; border-radius:8px;
            padding:9px 20px; font-size:.88rem; font-weight:600;
            transition:all .2s; cursor:pointer;
        }
        .btn-admin:hover { opacity:.88; transform:translateY(-1px); color:white; }
        .stat-card {
            background:white; border-radius:16px; border:1px solid #e2e8f0;
            padding:22px; text-align:left;
        }
        .stat-number {
            font-size:2rem; font-weight:800;
            background:linear-gradient(135deg,#6366f1,#8b5cf6);
            -webkit-background-clip:text; -webkit-text-fill-color:transparent;
            background-clip:text;
        }
        .stat-label { font-size:.82rem; color:#64748b; font-weight:500; margin-top:4px; }
        .stat-icon {
            width:44px; height:44px; border-radius:12px;
            display:flex; align-items:center; justify-content:center;
            font-size:1.2rem; margin-bottom:14px;
        }
        .icon-beranda { background:#ede9fe; }
        .icon-profil  { background:#e0f2fe; }
        .icon-gallery { background:#dcfce7; }
        .icon-artikel { background:#fce7f3; }
        .icon-siswa   { background:#fef3c7; }

        @media(max-width:768px){
            .sidebar { transform:translateX(-100%); }
            .main-wrapper { margin-left:0; }
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<aside class="sidebar">
    <div class="sidebar-brand">
        <div class="brand-name">
            <div class="brand-icon">🎈</div>
            <div>
                <div>Admin PAUD</div>
                <div class="brand-sub">Maessar Bayan</div>
            </div>
        </div>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-section-label">Menu</div>
        <a href="?page=beranda" class="sidebar-link <?= $page=='beranda'?'active':'' ?>">
            <i class="fas fa-home"></i> Dashboard
        </a>
        <a href="?page=profil" class="sidebar-link <?= $page=='profil'?'active':'' ?>">
            <i class="fas fa-user-circle"></i> Kelola Profil
        </a>
        <a href="?page=gallery" class="sidebar-link <?= $page=='gallery'?'active':'' ?>">
            <i class="fas fa-images"></i> Kelola Gallery
        </a>
        <a href="?page=artikel" class="sidebar-link <?= $page=='artikel'?'active':'' ?>">
            <i class="fas fa-newspaper"></i> Kelola Artikel
        </a>
        <a href="?page=siswa" class="sidebar-link <?= $page=='siswa'?'active':'' ?>">
            <i class="fas fa-users"></i> Kelola Siswa
        </a>
        <a href="?page=perkembangan" class="sidebar-link <?= $page=='perkembangan'?'active':'' ?>">
            <i class="fas fa-chart-line"></i> Kelola Perkembangan
        </a>
    </nav>
    <div class="sidebar-footer">
        <a href="../index.php" class="sidebar-link" target="_blank">
            <i class="fas fa-external-link-alt"></i> Lihat Website
        </a>
        <a href="logout.php" class="sidebar-link" style="color:#f87171;">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</aside>

<!-- Main -->
<div class="main-wrapper">
    <div class="topbar">
        <div>
            <div class="topbar-title"><?= ucfirst($page) ?></div>
            <div class="topbar-sub">PAUD Maessar Bayan · Panel Admin</div>
        </div>
        <div class="topbar-user">
            <div class="user-avatar"><?= substr($_SESSION['admin_nama'] ?? 'A', 0, 1) ?></div>
            <?= $_SESSION['admin_nama'] ?? 'Admin' ?>
        </div>
    </div>
    <div class="main-content">
        <?php
        switch($page) {
            case 'beranda': include 'kelola_beranda.php'; break;
            case 'profil':  include 'kelola_profil.php';  break;
            case 'gallery': include 'kelola_gallery.php'; break;
            case 'artikel': include 'kelola_artikel.php'; break;
            case 'siswa':   include 'kelola_siswa.php';   break;
            case 'perkembangan': include 'kelola_perkembangan.php'; break;
            default:        include 'kelola_beranda.php';
        }
        ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
