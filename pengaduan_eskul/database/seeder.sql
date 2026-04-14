-- =====================================================
-- Database Seeder untuk Sistem Pengaduan Ekstrakulikuler
-- Database: db_pengaduan_eskul
-- =====================================================

-- Pastikan database sudah ada
-- CREATE DATABASE IF NOT EXISTS db_pengaduan_eskul;
-- USE db_pengaduan_eskul;

-- =====================================================
-- Buat tabel jika belum ada
-- =====================================================

-- Tabel Kategori
CREATE TABLE IF NOT EXISTS `kategori` (
    `id_kategori` INT AUTO_INCREMENT PRIMARY KEY,
    `ket_kategori` VARCHAR(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Admin
CREATE TABLE IF NOT EXISTS `admin` (
    `username` VARCHAR(30) PRIMARY KEY,
    `password` VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Siswa
CREATE TABLE IF NOT EXISTS `siswa` (
    `nis` INT PRIMARY KEY,
    `kelas` VARCHAR(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Aspirasi
CREATE TABLE IF NOT EXISTS `aspirasi` (
    `id_aspirasi` INT AUTO_INCREMENT PRIMARY KEY,
    `status` ENUM('Menunggu', 'Proses', 'Selesai') DEFAULT 'Menunggu',
    `prioritas` ENUM('Rendah', 'Sedang', 'Tinggi') DEFAULT 'Sedang',
    `id_kategori` INT,
    `feedback` TEXT,
    `username_admin` VARCHAR(30),
    FOREIGN KEY (`id_kategori`) REFERENCES `kategori`(`id_kategori`) ON DELETE SET NULL,
    FOREIGN KEY (`username_admin`) REFERENCES `admin`(`username`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabel Input Aspirasi
CREATE TABLE IF NOT EXISTS `input_aspirasi` (
    `id_pelaporan` INT AUTO_INCREMENT PRIMARY KEY,
    `nis` INT,
    `id_kategori` INT,
    `lokasi` VARCHAR(50) NOT NULL,
    `ket` TEXT NOT NULL,
    `tgl_lapor` DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`nis`) REFERENCES `siswa`(`nis`) ON DELETE SET NULL,
    FOREIGN KEY (`id_kategori`) REFERENCES `kategori`(`id_kategori`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- =====================================================
-- Insert Data Awal
-- =====================================================

-- Insert Kategori
INSERT INTO `kategori` (`ket_kategori`) VALUES
('Fasilitas'),
('Kegiatan'),
('Pembinaan'),
('Keuangan'),
('Lainnya')
ON DUPLICATE KEY UPDATE `ket_kategori` = VALUES(`ket_kategori`);

-- Insert Admin Default (password: admin123)
-- Password di-hash menggunakan password_hash('admin123', PASSWORD_DEFAULT)
INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi')
ON DUPLICATE KEY UPDATE `password` = VALUES(`password`);

-- Insert Siswa Sample
INSERT INTO `siswa` (`nis`, `kelas`) VALUES
(12001, 'XII IPA 1'),
(12002, 'XII IPA 2'),
(11001, 'XI IPS 1'),
(10001, 'X MIPA 1')
ON DUPLICATE KEY UPDATE `kelas` = VALUES(`kelas`);

-- =====================================================
-- Selesai!
-- Username: admin
-- Password: admin123
-- =====================================================
