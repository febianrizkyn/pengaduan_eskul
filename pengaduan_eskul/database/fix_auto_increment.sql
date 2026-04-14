-- =====================================================
-- FIX: Memperbaiki kolom id_pelaporan di tabel input_aspirasi
-- Jalankan file SQL ini di phpMyAdmin untuk memperbaiki error
-- =====================================================

-- Perbaiki tabel input_aspirasi agar id_pelaporan menjadi AUTO_INCREMENT
ALTER TABLE `input_aspirasi` 
MODIFY COLUMN `id_pelaporan` INT NOT NULL AUTO_INCREMENT;

-- Perbaiki tabel aspirasi agar id_aspirasi menjadi AUTO_INCREMENT
ALTER TABLE `aspirasi` 
MODIFY COLUMN `id_aspirasi` INT NOT NULL AUTO_INCREMENT;

-- Perbaiki tabel kategori agar id_kategori menjadi AUTO_INCREMENT
ALTER TABLE `kategori` 
MODIFY COLUMN `id_kategori` INT NOT NULL AUTO_INCREMENT;

-- =====================================================
-- Jika ALTER TABLE gagal karena constraint, coba cara berikut:
-- =====================================================

-- Cara alternatif: Hapus dan buat ulang tabel (DATA AKAN HILANG!)
-- Uncomment jika diperlukan:

/*
-- Hapus tabel lama
DROP TABLE IF EXISTS `input_aspirasi`;
DROP TABLE IF EXISTS `aspirasi`;

-- Buat ulang tabel input_aspirasi
CREATE TABLE `input_aspirasi` (
    `id_pelaporan` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nis` INT,
    `id_kategori` INT,
    `lokasi` VARCHAR(50) NOT NULL,
    `ket` TEXT NOT NULL,
    `tgl_lapor` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Buat ulang tabel aspirasi
CREATE TABLE `aspirasi` (
    `id_aspirasi` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `status` ENUM('Menunggu', 'Proses', 'Selesai') DEFAULT 'Menunggu',
    `prioritas` ENUM('Rendah', 'Sedang', 'Tinggi') DEFAULT 'Sedang',
    `id_kategori` INT,
    `feedback` TEXT,
    `username_admin` VARCHAR(30)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
*/

-- =====================================================
-- Selesai! Refresh halaman aplikasi setelah menjalankan SQL ini
-- =====================================================
