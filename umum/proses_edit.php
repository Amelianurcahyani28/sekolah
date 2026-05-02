<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

include 'koneksi.php';

if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $nama_anak = mysqli_real_escape_string($conn, $_POST['nama_anak']);
    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $tanggal_lahir = mysqli_real_escape_string($conn, $_POST['tanggal_lahir']);
    $nama_ayah = mysqli_real_escape_string($conn, $_POST['nama_ayah']);
    $nama_ibu = mysqli_real_escape_string($conn, $_POST['nama_ibu']);
    $pekerjaan_ortu = mysqli_real_escape_string($conn, $_POST['pekerjaan_ortu']);
    $no_hp_ayah = mysqli_real_escape_string($conn, $_POST['no_hp_ayah']);
    $no_hp_ibu = mysqli_real_escape_string($conn, $_POST['no_hp_ibu']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    
    $query = "UPDATE siswa SET 
        nama_anak = '$nama_anak',
        jenis_kelamin = '$jenis_kelamin',
        tanggal_lahir = '$tanggal_lahir',
        nama_ayah = '$nama_ayah',
        nama_ibu = '$nama_ibu',
        pekerjaan_ortu = '$pekerjaan_ortu',
        no_hp_ayah = '$no_hp_ayah',
        no_hp_ibu = '$no_hp_ibu',
        alamat = '$alamat'
    WHERE id = $id";
    
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data siswa berhasil diupdate!'); window.location='datasiswa.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate data!'); window.history.back();</script>";
    }
} else {
    header("Location: datasiswa.php");
    exit;
}
?>