
-- Table Admin
CREATE TABLE IF NOT EXISTS admin (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    nama_lengkap VARCHAR(100) DEFAULT NULL,
    last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert default admin user
-- Username: maessarbayan
-- Password: 298
INSERT INTO admin (username, password, nama_lengkap) 
VALUES ('maessarbayan', '298', 'Administrator PAUD')
ON DUPLICATE KEY UPDATE username=username;
