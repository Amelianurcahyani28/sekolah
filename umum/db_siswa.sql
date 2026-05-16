
-- Drop existing tables to ensure a clean slate (Optional, but good for standardization)
-- DROP TABLE IF EXISTS siswa;
-- DROP TABLE IF EXISTS artikel;
-- DROP TABLE IF EXISTS gallery;
-- DROP TABLE IF EXISTS perkembangan_anak;
-- DROP TABLE IF EXISTS profil;
-- DROP TABLE IF EXISTS beranda;
-- DROP TABLE IF EXISTS admin;

-- Table Siswa
CREATE TABLE IF NOT EXISTS siswa (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_anak VARCHAR(100) NOT NULL,
    jenis_kelamin ENUM('Laki-laki', 'Perempuan') NOT NULL,
    tanggal_lahir VARCHAR(100) DEFAULT NULL,
    nama_ayah VARCHAR(100) DEFAULT NULL,
    nama_ibu VARCHAR(100) DEFAULT NULL,
    no_hp_ortu VARCHAR(20) DEFAULT NULL,
    alamat TEXT DEFAULT NULL,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Artikel
CREATE TABLE IF NOT EXISTS artikel (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    isi TEXT DEFAULT NULL,
    kategori VARCHAR(50) DEFAULT NULL,
    gambar VARCHAR(200) DEFAULT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Gallery
CREATE TABLE IF NOT EXISTS gallery (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) DEFAULT NULL,
    deskripsi TEXT DEFAULT NULL,
    gambar VARCHAR(200) DEFAULT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Perkembangan Anak
CREATE TABLE IF NOT EXISTS perkembangan_anak (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama_anak VARCHAR(100) NOT NULL,
    prestasi TEXT DEFAULT NULL,
    foto VARCHAR(200) DEFAULT NULL,
    tanggal TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Profil
CREATE TABLE IF NOT EXISTS profil (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    tentang TEXT DEFAULT NULL,
    visi TEXT DEFAULT NULL,
    misi TEXT DEFAULT NULL,
    kepsek_nama VARCHAR(100) DEFAULT NULL,
    kepsek_quote TEXT DEFAULT NULL,
    kepsek_foto VARCHAR(255) DEFAULT NULL,
    foto_sekolah VARCHAR(255) DEFAULT NULL,
    foto_hero VARCHAR(255) DEFAULT NULL,
    alamat_sekolah TEXT DEFAULT NULL,
    no_telp VARCHAR(50) DEFAULT NULL,
    email VARCHAR(100) DEFAULT NULL
);

-- Table Beranda
CREATE TABLE IF NOT EXISTS beranda (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) DEFAULT NULL,
    deskripsi TEXT DEFAULT NULL
);

-- Table Admin
CREATE TABLE IF NOT EXISTS admin (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) DEFAULT NULL,
    last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO beranda (judul, deskripsi) VALUES ('TK Maessar Bayan', 'Pendidikan usia dini yang menyenangkan untuk anak-anak');
INSERT INTO profil (tentang, visi, misi, kepsek_nama, kepsek_quote, alamat_sekolah, no_telp, email) VALUES 
('TK Maessar Bayan adalah lembaga pendidikan anak usia dini yang berfokus pada perkembangan karakter dan potensi anak.', 
'Menjadi sekolah TK yang terbaik dengan pendidikan berkualitas.',
'Menyediakan pendidikan berkualitas dengan metode pembelajaran yang menyenangkan.',
'Hj. Siti Aisyah, S.Pd',
'Pendidikan adalah tiket masa depan bagi mereka yang menyiapkannya hari ini.',
'Jl. Maessar Bayan, Lombok Utara, NTB',
'(0370) 123456',
'info@maessarbayan.sch.id');

-- Insert default admin
INSERT INTO admin (username, password, nama_lengkap) VALUES ('maessarbayan', '298', 'Administrator PAUD');
