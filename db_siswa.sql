
CREATE TABLE IF NOT EXISTS siswa (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    ttl VARCHAR(100) DEFAULT NULL,
    alamat TEXT DEFAULT NULL,
    ortu VARCHAR(100) DEFAULT NULL,
    no_ortu VARCHAR(20) DEFAULT NULL,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table Artikel
CREATE TABLE IF NOT EXISTS artikel (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) NOT NULL,
    isi TEXT DEFAULT NULL,
    kategori VARCHAR(50) DEFAULT NULL,
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

-- Table Profil
CREATE TABLE IF NOT EXISTS profil (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    tentang TEXT DEFAULT NULL,
    visi TEXT DEFAULT NULL,
    misi TEXT DEFAULT NULL,
    kepsek_nama VARCHAR(100) DEFAULT NULL,
    kepsek_quote TEXT DEFAULT NULL
);

-- Table Beranda
CREATE TABLE IF NOT EXISTS beranda (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(200) DEFAULT NULL,
    deskripsi TEXT DEFAULT NULL
);

-- Insert sample data
INSERT INTO beranda (judul, deskripsi) VALUES ('TK Maessar Bayan', 'Pendidikan usia dini yang menyenangkan untuk anak-anak');
INSERT INTO profil (tentang, visi, misi, kepsek_nama, kepsek_quote) VALUES 
('TK Maessar Bayan adalah lembaga pendidikan anak usia dini yang berfokus pada perkembangan karakter dan potensi anak.', 
'Menjadi sekolah TK yang terbaik dengan pendidikan berkualitas.',
'Menyediakan pendidikan berkualitas dengan metode pembelajaran yang menyenangkan.',
'Hj. Siti Aisyah, S.Pd',
'Pendidikan adalah tiket masa depan bagi mereka yang menyiapkannya hari ini.');
