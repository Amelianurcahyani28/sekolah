<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!$conn) {
        echo "<script>
            alert('Gagal mengirim pendaftaran karena koneksi database bermasalah. Silakan hubungi admin atau periksa konfigurasi database Anda di hosting.');
            window.history.back();
        </script>";
        exit;
    }

    // 1. Tangkap data dari POST (sesuaikan dengan 'name' di daftar.php)
    $nama_anak      = mysqli_real_escape_string($conn, $_POST['nama_anak'] ?? '');
    $jenis_kelamin  = mysqli_real_escape_string($conn, $_POST['jenis_kelamin'] ?? '');
    $tanggal_lahir  = mysqli_real_escape_string($conn, $_POST['tanggal_lahir'] ?? '');
    $nama_ayah      = mysqli_real_escape_string($conn, $_POST['nama_ayah'] ?? '');
    $nama_ibu       = mysqli_real_escape_string($conn, $_POST['nama_ibu'] ?? '');
    $no_hp_ortu     = mysqli_real_escape_string($conn, $_POST['no_hp_ortu'] ?? '');
    $alamat         = mysqli_real_escape_string($conn, $_POST['alamat'] ?? '');

    // 2. Validasi (Jika ada yang kosong, balikkan ke form)
    if (empty($nama_anak) || empty($jenis_kelamin) || empty($tanggal_lahir)) {
        echo "<script>
            alert('Mohon isi data dengan lengkap!');
            window.history.back();
        </script>";
        exit;
    }

    // 3. Query INSERT (Disesuaikan PERSIIS dengan struktur tabel di phpMyAdmin kamu)
    $query = "INSERT INTO siswa (nama_anak, jenis_kelamin, tanggal_lahir, nama_ayah, nama_ibu, no_hp_ortu, alamat)
              VALUES (
                '$nama_anak',
                '$jenis_kelamin',
                '$tanggal_lahir',
                '$nama_ayah',
                '$nama_ibu',
                '$no_hp_ortu',
                '$alamat'
              )";

    // 4. Eksekusi
    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Pendaftaran Berhasil! Data sudah tersimpan di database.');
            window.location='daftar.php';
        </script>";
    } else {
        // Jika error, kode ini akan memberitahu kolom mana yang bikin masalah
        echo "Gagal menyimpan data. Pesan Error: " . mysqli_error($conn);
    }

} else {
    header('Location: daftar.php');
    exit;
}
?>