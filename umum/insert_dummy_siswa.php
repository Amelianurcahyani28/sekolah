<?php
include 'koneksi.php';

// Cek apakah tabel ada
$result = mysqli_query($conn, "SHOW TABLES LIKE 'siswa'");
if (mysqli_num_rows($result) == 0) {
    // Buat tabel jika belum ada
    $query = "CREATE TABLE IF NOT EXISTS siswa (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        nama_anak VARCHAR(100) NOT NULL,
        jenis_kelamin ENUM('Laki-laki','Perempuan') NOT NULL,
        tanggal_lahir DATE NOT NULL,
        nama_ortu VARCHAR(100) NOT NULL,
        no_hp VARCHAR(20) DEFAULT NULL,
        alamat TEXT DEFAULT NULL,
        tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (mysqli_query($conn, $query)) {
        echo "Tabel 'siswa' berhasil dibuat!<br>";
    } else {
        echo "Gagal membuat tabel: " . mysqli_error($conn) . "<br>";
        exit;
    }
} else {
    echo "Tabel 'siswa' sudah ada.<br>";
}

// Cek struktur tabel
echo "<b>Struktur tabel:</b><br>";
$result = mysqli_query($conn, "DESCRIBE siswa");
while ($row = mysqli_fetch_assoc($result)) {
    echo "- " . $row['Field'] . " (" . $row['Type'] . ")<br>";
}

// Data dummy siswa
$siswa = [
    ['nama_anak' => 'Ahmad Fauzi', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '2019-05-15', 'nama_ortu' => 'Budi Santoso', 'no_hp' => '081234567890', 'alamat' => 'Jl. Merdeka No. 10, Jakarta'],
    ['nama_anak' => 'Siti Aminah', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '2019-08-22', 'nama_ortu' => 'Hasan Wijaya', 'no_hp' => '081234567891', 'alamat' => 'Jl. Sudirman No. 25, Jakarta'],
    ['nama_anak' => 'Muhammad Rizki', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '2019-03-10', 'nama_ortu' => 'Ahmad Susanto', 'no_hp' => '081234567892', 'alamat' => 'Jl. Thamrin No. 5, Jakarta'],
    ['nama_anak' => 'Putri Dewi', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '2019-11-05', 'nama_ortu' => 'Wati Lestari', 'no_hp' => '081234567893', 'alamat' => 'Jl. Gatot Subroto No. 15, Jakarta'],
    ['nama_anak' => 'Bima Satria', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '2019-07-20', 'nama_ortu' => 'Dedi Kurniawan', 'no_hp' => '081234567894', 'alamat' => 'Jl. Ahmad Yani No. 30, Jakarta'],
    ['nama_anak' => 'Nadia Rahmawati', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '2019-02-14', 'nama_ortu' => 'Rahmadhani', 'no_hp' => '081234567895', 'alamat' => 'Jl. Pahlawan No. 8, Jakarta'],
    ['nama_anak' => 'Farhan Pratama', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '2019-09-28', 'nama_ortu' => 'Pratama Jaya', 'no_hp' => '081234567896', 'alamat' => 'Jl. Diponegoro No. 12, Jakarta'],
    ['nama_anak' => 'Ayu Lestari', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '2019-06-18', 'nama_ortu' => 'Lestari Dewi', 'no_hp' => '081234567897', 'alamat' => 'Jl. Asia Afrika No. 20, Jakarta'],
];

echo "<br><b>Menambahkan data siswa:</b><br>";
$success = 0;
$failed = 0;

foreach ($siswa as $data) {
    $query = "INSERT INTO siswa (nama_anak, jenis_kelamin, tanggal_lahir, nama_ortu, no_hp, alamat) 
              VALUES ('{$data['nama_anak']}', '{$data['jenis_kelamin']}', '{$data['tanggal_lahir']}', '{$data['nama_ortu']}', '{$data['no_hp']}', '{$data['alamat']}')";
    
    if (mysqli_query($conn, $query)) {
        echo "✓ {$data['nama_anak']}<br>";
        $success++;
    } else {
        echo "✗ {$data['nama_anak']} - Gagal: " . mysqli_error($conn) . "<br>";
        $failed++;
    }
}

echo "<br><b>Total: Berhasil: $success, Gagal: $failed</b><br>";
echo "<a href='datasiswa.php'>Lihat Data Siswa</a>";
?>