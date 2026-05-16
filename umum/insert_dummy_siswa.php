<?php
include 'koneksi.php';

// Cek apakah tabel ada
$result = mysqli_query($conn, "SHOW TABLES LIKE 'siswa'");
if (mysqli_num_rows($result) == 0) {
    echo "Tabel 'siswa' belum ada. Silakan import file SQL terlebih dahulu.<br>";
    exit;
}


// Data dummy siswa
$siswa = [
    ['nama_anak' => 'Ahmad Fauzi', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '2019-05-15', 'nama_ayah' => 'Budi Santoso', 'nama_ibu' => 'Siti Aminah', 'no_hp_ortu' => '081234567890', 'alamat' => 'Jl. Merdeka No. 10, Jakarta'],
    ['nama_anak' => 'Siti Aminah', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '2019-08-22', 'nama_ayah' => 'Hasan Wijaya', 'nama_ibu' => 'Rini Astuti', 'no_hp_ortu' => '081234567891', 'alamat' => 'Jl. Sudirman No. 25, Jakarta'],
    ['nama_anak' => 'Muhammad Rizki', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '2019-03-10', 'nama_ayah' => 'Ahmad Susanto', 'nama_ibu' => 'Laila', 'no_hp_ortu' => '081234567892', 'alamat' => 'Jl. Thamrin No. 5, Jakarta'],
];

echo "<br><b>Menambahkan data siswa:</b><br>";
$success = 0;
$failed = 0;

foreach ($siswa as $data) {
    $query = "INSERT INTO siswa (nama_anak, jenis_kelamin, tanggal_lahir, nama_ayah, nama_ibu, no_hp_ortu, alamat) 
              VALUES ('{$data['nama_anak']}', '{$data['jenis_kelamin']}', '{$data['tanggal_lahir']}', '{$data['nama_ayah']}', '{$data['nama_ibu']}', '{$data['no_hp_ortu']}', '{$data['alamat']}')";
    
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