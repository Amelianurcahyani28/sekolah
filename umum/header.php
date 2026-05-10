<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAUD Maessar Bayan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; background-color: #f9fbf9; }
        .navbar { background-color: #ffffff; border-bottom: 3px solid #b2d8b2; }
        .nav-link { color: #555; font-weight: 600; }
        .nav-link:hover, .nav-link.active { color: #6fb36f; }
        .btn-daftar { background-color: #ff9a9e; color: white; border-radius: 20px; padding: 8px 20px; border: none; }
        .bg-pastel-green { background-color: #b2d8b2; } /* Warna Gbr 8 */
        .text-pastel-green { color: #6fb36f; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-pastel-green" href="index.php">Maessar Bayan</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="profil.php">Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                <li class="nav-item"><a class="nav-link" href="artikel.php">Artikel</a></li>
                <li class="nav-item ms-lg-3"><a class="btn-daftar" href="daftar.php">Daftar</a></li>
                <li class="nav-item"><a class="nav-link text-danger small ms-3" href="../admin/login.php">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>