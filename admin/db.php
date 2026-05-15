<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_tk_maessar";

$conn = mysqli_connect($host, $user, $pass, $db);

// cek koneksi
if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
    exit;
}
?>
