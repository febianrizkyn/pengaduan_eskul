-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2026 at 06:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pengaduan_eskul`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Table structure for table `aspirasi`
--

CREATE TABLE `aspirasi` (
  `id_aspirasi` int(11) NOT NULL,
  `status` enum('Menunggu','Proses','Selesai') NOT NULL,
  `prioritas` enum('Rendah','Sedang','Tinggi') DEFAULT 'Sedang',
  `id_kategori` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `username_admin` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `aspirasi`
--

INSERT INTO `aspirasi` (`id_aspirasi`, `status`, `prioritas`, `id_kategori`, `feedback`, `username_admin`) VALUES
(1, 'Selesai', 'Rendah', 2, NULL, 'admin'),
(2, 'Selesai', 'Tinggi', 1, 'tet', 'admin'),
(3, 'Selesai', 'Sedang', 1, NULL, 'admin'),
(4, 'Selesai', 'Sedang', 2, 'ok', 'admin'),
(13, 'Selesai', 'Sedang', 1, NULL, 'admin'),
(14, 'Selesai', 'Tinggi', 1, 'okeee', 'admin'),
(15, 'Selesai', 'Tinggi', 4, 'done', 'admin'),
(16, 'Proses', 'Rendah', 2, 'sabar ya', 'admin'),
(17, 'Selesai', 'Tinggi', 6, 'done ya', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `input_aspirasi`
--

CREATE TABLE `input_aspirasi` (
  `id_pelaporan` int(11) NOT NULL,
  `nis` int(11) DEFAULT NULL,
  `id_kategori` int(11) DEFAULT NULL,
  `lokasi` varchar(50) DEFAULT NULL,
  `ket` varchar(50) DEFAULT NULL,
  `tgl_lapor` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `input_aspirasi`
--

INSERT INTO `input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `ket`, `tgl_lapor`) VALUES
(1, 10001, 2, 'tepa', 'kursi rusak', '2026-02-02 16:49:03'),
(2, 10001, 2, 'tepa', 'kursi rusak', '2026-02-02 16:49:07'),
(3, 12001, 2, 'kelas', '5FRF6FF', '2026-02-04 08:14:36'),
(4, 12001, 4, 'leb', 'CTY', '2026-02-04 08:17:22'),
(5, 12001, 4, 'leb', 'CTY', '2026-02-04 08:17:54'),
(6, 11001, 2, 'leb', 'yyrrrrrrr', '2026-02-06 15:05:13'),
(7, 11001, 2, 'leb', 'yyrrrrrrr', '2026-02-06 15:07:05'),
(8, 11001, 2, 'leb', 'yyrrrrrrr', '2026-02-06 15:07:18'),
(9, 11001, 2, 'leb', 'yyrrrrrrr', '2026-02-06 15:09:10'),
(10, 11001, 1, 'kelas', 'butuh wifi', '2026-02-06 15:09:50'),
(11, 10001, 1, 'lapang', 'tolong', '2026-04-08 14:13:19'),
(12, 10001, 2, 'wc', 'tolong', '2026-04-08 14:15:14'),
(13, 10001, 1, 'lapang', 'tolong aku', '2026-04-08 14:23:34'),
(14, 10001, 1, 'lapangan', 'woi', '2026-04-09 08:43:03'),
(15, 10001, 4, 'wc', 'tolong', '2026-04-09 10:28:41'),
(16, 10001, 2, 'lapang bola', 'gak ', '2026-04-10 22:18:26'),
(17, 10001, 6, 'lapang bola', 'tolongin', '2026-04-10 23:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `ket_kategori`) VALUES
(1, 'Fasilitas'),
(2, 'Kegiatan'),
(4, 'Keuangan'),
(5, 'Lainnya'),
(6, 'Barang');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `nama_siswa` varchar(60) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `username`, `nama_siswa`, `password`) VALUES
(10001, 'siswa', 'robi', '123'),
(11001, '', '', ''),
(12001, '', '', ''),
(12002, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `username_admin` (`username_admin`);

--
-- Indexes for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id_aspirasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  MODIFY `id_pelaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD CONSTRAINT `aspirasi_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `aspirasi_ibfk_2` FOREIGN KEY (`username_admin`) REFERENCES `admin` (`username`);

--
-- Constraints for table `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD CONSTRAINT `input_aspirasi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`),
  ADD CONSTRAINT `input_aspirasi_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
