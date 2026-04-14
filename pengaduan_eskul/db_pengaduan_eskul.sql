-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql302.infinityfree.com
-- Waktu pembuatan: 14 Apr 2026 pada 05.53
-- Versi server: 11.4.10-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('admin', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `aspirasi`
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
-- Dumping data untuk tabel `aspirasi`
--

INSERT INTO `aspirasi` (`id_aspirasi`, `status`, `prioritas`, `id_kategori`, `feedback`, `username_admin`) VALUES
(2, 'Selesai', 'Tinggi', 1, 'tet', 'admin'),
(4, 'Selesai', 'Sedang', 2, 'ok', 'admin'),
(14, 'Selesai', 'Tinggi', 1, 'okeee', 'admin'),
(16, 'Selesai', 'Rendah', 2, 'done ya dek', 'admin'),
(17, 'Selesai', 'Tinggi', 4, 'done ya', 'admin'),
(18, 'Selesai', 'Sedang', 4, 'Apa iya', 'admin'),
(20, 'Selesai', 'Sedang', 1, 'sabar', 'admin'),
(21, 'Selesai', 'Tinggi', 4, 'ok', 'admin'),
(22, 'Selesai', 'Sedang', 1, 'okee ya', 'admin'),
(23, 'Selesai', 'Rendah', 2, 'okee', 'admin'),
(24, 'Selesai', 'Tinggi', 4, 'fdafa', 'admin'),
(25, 'Selesai', 'Tinggi', 4, 'fdaf', 'admin'),
(26, 'Selesai', 'Tinggi', 4, 'ga ah', 'admin'),
(27, 'Selesai', 'Sedang', 1, NULL, 'admin'),
(28, 'Selesai', 'Tinggi', 4, NULL, 'admin'),
(29, 'Menunggu', 'Sedang', 2, NULL, NULL),
(30, 'Selesai', 'Tinggi', 1, 'gamau', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `input_aspirasi`
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
-- Dumping data untuk tabel `input_aspirasi`
--

INSERT INTO `input_aspirasi` (`id_pelaporan`, `nis`, `id_kategori`, `lokasi`, `ket`, `tgl_lapor`) VALUES
(6, 11001, 2, 'leb', 'yyrrrrrrr', '2026-02-06 15:05:13'),
(7, 11001, 2, 'leb', 'yyrrrrrrr', '2026-02-06 15:07:05'),
(8, 11001, 2, 'leb', 'yyrrrrrrr', '2026-02-06 15:07:18'),
(9, 11001, 2, 'leb', 'yyrrrrrrr', '2026-02-06 15:09:10'),
(10, 11001, 1, 'kelas', 'butuh wifi', '2026-02-06 15:09:50'),
(11, 10001, 1, 'lapang', 'tolong', '2026-04-08 14:13:19'),
(12, 10001, 2, 'wc', 'tolong', '2026-04-08 14:15:14'),
(13, 10001, 1, 'lapang', 'tolong aku', '2026-04-08 14:23:34'),
(14, 10001, 1, 'lapangan', 'woi', '2026-04-09 08:43:03'),
(16, 10001, 2, 'lapang bola', 'gak ', '2026-04-10 22:18:26'),
(17, 10001, 4, 'lapang bola', 'tolongin', '2026-04-10 23:03:20'),
(18, 10001, 4, 'lapang volly', 'bola ilang', '2026-04-11 11:41:14'),
(20, 10001, 1, 'lapang', '123', '2026-04-12 18:04:26'),
(21, 10001, 4, 'lapang basket', 'bola nya ko ilang', '2026-04-12 18:06:21'),
(22, 10001, 1, 'gudang', 'cons ilang', '2026-04-12 18:06:57'),
(24, 10001, 4, 'lapang', 'tolong', '2026-04-12 19:09:13'),
(25, 10001, 4, 'lapang basket', 'fsgsfgf', '2026-04-12 19:09:37'),
(26, 10001, 4, 'lapang volly', 'tolong lahhh', '2026-04-12 23:59:18'),
(27, 10001, 1, 'parkiran', 'hmm', '2026-04-13 22:59:16'),
(28, 10001, 4, 'wc', 'hmmmmmmmm', '2026-04-14 13:09:30'),
(29, 10001, 2, 'lapangan', 'tvhh', '2026-04-14 13:16:17'),
(30, 10001, 1, 'lapang', 'cepetan', '2026-04-14 15:08:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `ket_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `ket_kategori`) VALUES
(1, 'Fasilitas'),
(2, 'Kegiatan'),
(3, 'Keuangan'),
(4, 'Barang'),
(5, 'Lainnya'),
(6, 'Jadwal');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `nama_siswa` varchar(60) NOT NULL,
  `password` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nis`, `username`, `nama_siswa`, `password`) VALUES
(10001, 'siswa', 'robi', '123'),
(11001, 'rafa', '', '123'),
(12001, '', '', ''),
(12002, '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD PRIMARY KEY (`id_aspirasi`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `username_admin` (`username_admin`);

--
-- Indeks untuk tabel `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD PRIMARY KEY (`id_pelaporan`),
  ADD KEY `nis` (`nis`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `aspirasi`
--
ALTER TABLE `aspirasi`
  MODIFY `id_aspirasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  MODIFY `id_pelaporan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `aspirasi`
--
ALTER TABLE `aspirasi`
  ADD CONSTRAINT `aspirasi_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`),
  ADD CONSTRAINT `aspirasi_ibfk_2` FOREIGN KEY (`username_admin`) REFERENCES `admin` (`username`);

--
-- Ketidakleluasaan untuk tabel `input_aspirasi`
--
ALTER TABLE `input_aspirasi`
  ADD CONSTRAINT `input_aspirasi_ibfk_1` FOREIGN KEY (`nis`) REFERENCES `siswa` (`nis`),
  ADD CONSTRAINT `input_aspirasi_ibfk_2` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
