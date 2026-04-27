<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar { background: #d81b60; color: white; width: 250px; height: 100vh; position: fixed; padding: 20px; }
        .content { margin-left: 250px; padding: 30px; background: #f8f9fa; min-height: 100vh; }
        .card-stat { border: none; border-radius: 15px; padding: 20px; color: white; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Accusoft</h3>
        <hr>
        <div class="nav flex-column mt-4">
            <a href="#" class="nav-link text-white bg-white bg-opacity-25 rounded mb-2">Dashboard</a>
            <a href="#" class="nav-link text-white mb-2">Data Siswa</a>
            <a href="#" class="nav-link text-white mb-2">Kelola Artikel</a>
            <a href="index.php" class="nav-link text-white mt-5 small">← Kembali ke Web</a>
        </div>
    </div>

    <div class="content text-dark">
        <h3>Dashboard Admin</h3>
        <div class="row mt-4 g-3">
            <div class="col-md-3">
                <div class="card card-stat bg-white text-dark shadow-sm">
                    <h6>Total Pendaftar</h6>
                    <h2>124</h2>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-stat shadow-sm" style="background:#d81b60">
                    <h6>Pesan Masuk</h6>
                    <h2>54</h2>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm mt-5">
            <div class="card-body">
                <h5 class="fw-bold mb-3">Pendaftar Terbaru</h5>
                <table class="table table-hover">
                    <thead><tr><th>Nama Anak</th><th>Ortu</th><th>Tgl Daftar</th></tr></thead>
                    <tbody>
                        <tr><td>Ahmad Fauzi</td><td>Bpk. Rizal</td><td>20 Okt 2023</td></tr>
                        <tr><td>Siti Aminah</td><td>Ibu Budi</td><td>22 Okt 2023</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>