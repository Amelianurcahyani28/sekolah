<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_anak      = mysqli_real_escape_string($conn, $_POST['nama_anak']);
    $jenis_kelamin  = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $tanggal_lahir  = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $nama_ayah      = mysqli_real_escape_string($conn, $_POST['nama_ayah'] ?? '');
    $nama_ibu       = mysqli_real_escape_string($conn, $_POST['nama_ibu'] ?? '');
    $nama_ortu      = trim($nama_ayah . ' & ' . $nama_ibu, ' & ');
    $pekerjaan_ortu = mysqli_real_escape_string($conn, $_POST['pekerjaan_ortu'] ?? '');
    $no_hp          = mysqli_real_escape_string($conn, $_POST['no_hp_ayah'] ?? '');
    $no_hp_ayah     = mysqli_real_escape_string($conn, $_POST['no_hp_ayah'] ?? '');
    $no_hp_ibu      = mysqli_real_escape_string($conn, $_POST['no_hp_ibu'] ?? '');
    $alamat         = mysqli_real_escape_string($conn, $_POST['alamat'] ?? '');
    $alamat_ortu    = mysqli_real_escape_string($conn, $_POST['alamat_ortu'] ?? '');

    if (empty($nama_anak) || empty($jenis_kelamin) || empty($tanggal_lahir) || empty($nama_ayah) || empty($nama_ibu)) {
        echo "<script>alert('Semua field wajib diisi!'); window.location='daftar.php';</script>";
        exit;
    }

    $query = "INSERT INTO siswa (nama_anak, jenis_kelamin, tanggal_lahir, nama_ortu, nama_ayah, nama_ibu, pekerjaan_ortu, no_hp, no_hp_ayah, no_hp_ibu, alamat, alamat_ortu)
              VALUES ('$nama_anak', '$jenis_kelamin', '$tanggal_lahir', '$nama_ortu', '$nama_ayah', '$nama_ibu', '$pekerjaan_ortu', '$no_hp', '$no_hp_ayah', '$no_hp_ibu', '$alamat', '$alamat_ortu')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Pendaftaran berhasil!');
            window.location='daftar.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal mendaftar: " . mysqli_error($conn) . "');
            window.location='daftar.php';
        </script>";
    }
} else {
    header("Location: daftar.php");
    exit;
}
?>
