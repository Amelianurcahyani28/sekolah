<?php
include 'koneksi.php';

$nama  = $_POST['nama'];
$email = $_POST['email'];
$pesan = $_POST['pesan'];

$query = "INSERT INTO pesan (nama, email, pesan)
          VALUES ('$nama', '$email', '$pesan')";

if(mysqli_query($conn, $query)){
    echo "<script>
        alert('Pesan berhasil dikirim!');
        window.location='index.php';
    </script>";
}else{
    echo "Gagal: " . mysqli_error($conn);
}
?>