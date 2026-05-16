<?php
require_once "db.php";

echo "<h2>Setup Admin Table</h2>";

// 1. Create table
$sql = "CREATE TABLE IF NOT EXISTS admin (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) DEFAULT NULL,
    last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "✅ Tabel 'admin' berhasil dibuat atau sudah ada.<br>";
} else {
    echo "❌ Gagal membuat tabel: " . mysqli_error($conn) . "<br>";
}

// 2. Insert user
$username = "maessarbayan"; // 2 's'
$password = "298";
$nama = "Administrator PAUD";

// Clear existing users for a fresh setup
mysqli_query($conn, "DELETE FROM admin");

$insert = "INSERT INTO admin (username, password, nama_lengkap) VALUES ('$username', '$password', '$nama')";
if (mysqli_query($conn, $insert)) {
    echo "✅ User admin '$username' berhasil ditambahkan/diperbarui.<br>";
} else {
    echo "❌ Gagal menambahkan user: " . mysqli_error($conn) . "<br>";
}

// 3. List current users for verification
echo "<h3>Daftar Admin Saat Ini:</h3>";
$res = mysqli_query($conn, "SELECT username, password FROM admin");
if ($res && mysqli_num_rows($res) > 0) {
    echo "<table border='1' cellpadding='5' style='border-collapse:collapse;'>
            <tr><th>Username</th><th>Password</th></tr>";
    while($row = mysqli_fetch_assoc($res)) {
        echo "<tr><td>".$row['username']."</td><td>".$row['password']."</td></tr>";
    }
    echo "</table>";
} else {
    echo "Tabel kosong.";
}

echo "<br><a href='login.php' style='display:inline-block; padding:10px 20px; background:#6366f1; color:white; text-decoration:none; border-radius:5px;'>Ke Halaman Login</a>";
?>
