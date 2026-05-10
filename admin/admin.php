<?php
ob_start();
session_start();

// Proteksi halaman admin
if (!isset($_SESSION['login'])) {
    header("Location: ../admin/login.php");
    exit;
}

$page = $_GET['page'] ?? 'beranda';

// Validasi page agar include aman
$allowedPages = ['beranda','profil','gallery','artikel','siswa'];
if (!in_array($page, $allowedPages, true)) {
    $page = 'beranda';
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin PAUD Maessar Bayan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --pastel-pink: #ffb6c1;
            --pastel-purple: #dda0dd;
            --pastel-blue: #87ceeb;
            --pastel-green: #98d8c8;
            --pastel-yellow: #ffeaa7;
            --cute-pink: #ff85a2;
            --cute-purple: #b19cd9;
        }

        body {
            font-family: 'Quicksand', sans-serif;
            background: linear-gradient(135deg, #fff5f5 0%, #f0f9ff 50%, #f5fff0 100%);
            min-height: 100vh;
            margin: 0;
            overflow-x: hidden;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #ffffff 0%, #fff9f9 100%);
            box-shadow: 2px 0 15px rgba(255, 133, 162, 0.15);
            border-right: 4px solid var(--pastel-pink);
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(45deg, var(--cute-pink), var(--cute-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            padding: 20px 0;
            border-bottom: 2px solid var(--pastel-pink);
            margin-bottom: 20px;
        }

        .nav-link {
            color: #555;
            font-weight: 600;
            padding: 12px 15px;
            border-radius: 15px;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }

        .nav-link:hover, .nav-link.active {
            background: linear-gradient(135deg, var(--pastel-pink), var(--pastel-purple));
            color: white;
        }

        .nav-link i {
            width: 30px;
        }

        .main-content {
            padding: 30px;
            min-height: 100vh;
        }

        .page-header {
            background: linear-gradient(135deg, var(--pastel-pink), var(--pastel-purple), var(--pastel-blue));
            padding: 40px;
            border-radius: 25px;
            color: white;
            margin-bottom: 30px;
            box-shadow: 0 10px 30px rgba(255, 133, 162, 0.3);
        }

        .page-header h2 {
            font-weight: 800;
            text-shadow: 2px 2px 0 rgba(0,0,0,0.1);
        }

        .card-admin {
            background: white;
            border: none;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(255, 133, 162, 0.15);
            transition: all 0.3s ease;
        }

        .card-admin:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255, 133, 162, 0.25);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        .icon-beranda { background: linear-gradient(135deg, #ffeaa7, #fdcb6e); color: #8b6914; }
        .icon-profil { background: linear-gradient(135deg, #dfe6e9, #b2bec3); color: #636e72; }
        .icon-gallery { background: linear-gradient(135deg, #b2fba5, #6bce7a); color: #1e5631; }
        .icon-artikel { background: linear-gradient(135deg, #ffb6c1, #ff85a2); color: #c0392b; }
        .icon-siswa { background: linear-gradient(135deg, #87ceeb, #7ec8e3); color: #2980b9; }

        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.08);
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255, 133, 162, 0.25);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            background: linear-gradient(45deg, var(--cute-pink), var(--cute-purple));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .stat-label {
            color: #666;
            font-weight: 600;
        }

        .btn-admin {
            background: linear-gradient(135deg, var(--cute-pink), var(--cute-purple));
            color: white;
            border: none;
            border-radius: 15px;
            padding: 10px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(255, 133, 162, 0.4);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container-fluid p-0">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar p-4">
                <div class="text-center sidebar-brand">
                    🎈 Admin PAUD
                </div>
                <div class="nav flex-column mt-4">
                    <a href="?page=beranda" class="nav-link <?= $page == 'beranda' ? 'active' : '' ?>">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="?page=profil" class="nav-link <?= $page == 'profil' ? 'active' : '' ?>">
                        <i class="fas fa-user"></i> Kelola Profil
                    </a>
                    <a href="?page=gallery" class="nav-link <?= $page == 'gallery' ? 'active' : '' ?>">
                        <i class="fas fa-images"></i> Kelola Gallery
                    </a>
                    <a href="?page=artikel" class="nav-link <?= $page == 'artikel' ? 'active' : '' ?>">
                        <i class="fas fa-newspaper"></i> Kelola Artikel
                    </a>
                    <a href="?page=siswa" class="nav-link <?= $page == 'siswa' ? 'active' : '' ?>">
                        <i class="fas fa-users"></i> Kelola Siswa
                    </a>
                    <hr class="my-4" style="border-color: var(--pastel-pink);">
                    <a href="../umum/index.php" class="nav-link" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Lihat Website
                    </a>
                    <a href="logout.php" class="nav-link text-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 main-content">
                <?php
                switch($page) {
                    case 'beranda':
                        include 'kelola_beranda.php';
                        break;
                    case 'profil':
                        include 'kelola_profil.php';
                        break;
                    case 'gallery':
                        include 'kelola_gallery.php';
                        break;
                    case 'artikel':
                        include 'kelola_artikel.php';
                        break;
                    case 'siswa':
                        include 'kelola_siswa.php';
                        break;
                    default:
                        include 'kelola_beranda.php';
                }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

