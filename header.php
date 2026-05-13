<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAUD Maessar Bayan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8fafc; }

        .navbar {
            background: rgba(255,255,255,0.95) !important;
            backdrop-filter: blur(12px);
            border-bottom: 1px solid #e2e8f0 !important;
            box-shadow: 0 1px 20px rgba(0,0,0,0.06);
            padding: 14px 0;
        }
        .navbar-brand {
            font-family: 'Inter', sans-serif !important;
            font-weight: 800 !important;
            font-size: 1.2rem !important;
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .nav-link {
            color: #64748b !important;
            font-weight: 500;
            font-size: .9rem;
            transition: color .2s;
            padding: 6px 14px !important;
        }
        .nav-link:hover, .nav-link.active { color: #6366f1 !important; }
        .btn-daftar {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white !important;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            font-size: .88rem;
            border: none;
            transition: opacity .2s, transform .2s;
            text-decoration: none;
        }
        .btn-daftar:hover { opacity: .88; transform: translateY(-1px); color: white !important; }
        .nav-admin {
            font-size: .82rem;
            color: #94a3b8 !important;
        }
        .nav-admin:hover { color: #ef4444 !important; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">Maessar Bayan</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center gap-1">
                <li class="nav-item"><a class="nav-link" href="umum/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="umum/profil.php">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="umum/gallery.php">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="umum/perkembangan.php">Perkembangan</a></li>
                <li class="nav-item"><a class="nav-link" href="umum/artikel.php">Artikel</a></li>
                <li class="nav-item ms-2"><a class="btn-daftar" href="umum/daftar.php">Daftar</a></li>
                <li class="nav-item ms-1"><a class="nav-link nav-admin" href="../admin/login.php">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>