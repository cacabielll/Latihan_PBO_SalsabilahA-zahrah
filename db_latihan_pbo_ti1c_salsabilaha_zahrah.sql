-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 15, 2026 at 05:07 AM
-- Server version: 8.0.30
-- PHP Version: 8.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan_pbo_ti1c_salsabilaha'zahrah`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` int NOT NULL,
  `nama_film` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` tinyint NOT NULL,
  `harga_dasar_tiket` decimal(10,2) NOT NULL,
  `jenis_studio` enum('regular','imax','velvet') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe_audio` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Dolby Atmos, DTS, Stereo, dll.',
  `lokasi_baris` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Misal: A, B, VIP-1',
  `kacamata_3d_id` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nomor seri kacamata 3D',
  `efek_gerak_fitur` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Deskripsi efek gerak (4DX, dll.)',
  `bantal_selimut_pack` tinyint(1) DEFAULT NULL COMMENT '1 = tersedia, 0 = tidak',
  `layanan_butler` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Deskripsi layanan butler'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Tabel tiket bioskop — PBO TI1C Salsabilah A Zahrah';

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_audio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
(1, 'Avengers: Doomsday', '2026-06-20 10:00:00', 1, '40000.00', 'regular', 'Stereo', 'C', NULL, NULL, NULL, NULL),
(2, 'Avengers: Doomsday', '2026-06-20 13:00:00', 1, '40000.00', 'regular', 'Stereo', 'D', NULL, NULL, NULL, NULL),
(3, 'Mission Impossible 8', '2026-06-21 11:00:00', 1, '45000.00', 'regular', 'DTS', 'B', NULL, NULL, NULL, NULL),
(4, 'Mission Impossible 8', '2026-06-21 14:30:00', 1, '45000.00', 'regular', 'DTS', 'E', NULL, NULL, NULL, NULL),
(5, 'Inside Out 3', '2026-06-22 09:00:00', 1, '38000.00', 'regular', 'Stereo', 'A', NULL, NULL, NULL, NULL),
(6, 'Inside Out 3', '2026-06-22 12:00:00', 1, '38000.00', 'regular', 'Stereo', 'F', NULL, NULL, NULL, NULL),
(7, 'Wicked: Act Two', '2026-06-23 15:00:00', 1, '42000.00', 'regular', 'DTS', 'C', NULL, NULL, NULL, NULL),
(8, 'Wicked: Act Two', '2026-06-23 18:00:00', 1, '42000.00', 'regular', 'DTS', 'D', NULL, NULL, NULL, NULL),
(9, 'Avengers: Doomsday', '2026-06-20 11:00:00', 1, '85000.00', 'imax', 'Dolby Atmos', 'G', 'IMAX-3D-00123', NULL, NULL, NULL),
(10, 'Avengers: Doomsday', '2026-06-20 14:00:00', 1, '85000.00', 'imax', 'Dolby Atmos', 'H', 'IMAX-3D-00124', NULL, NULL, NULL),
(11, 'Mission Impossible 8', '2026-06-21 10:30:00', 1, '90000.00', 'imax', 'DTS:X', 'G', NULL, NULL, NULL, NULL),
(12, 'Mission Impossible 8', '2026-06-21 16:00:00', 1, '90000.00', 'imax', 'DTS:X', 'H', NULL, NULL, NULL, NULL),
(13, 'Oppenheimer Recut', '2026-06-24 13:00:00', 1, '95000.00', 'imax', 'Dolby Atmos', 'J', NULL, NULL, NULL, NULL),
(14, 'Oppenheimer Recut', '2026-06-24 17:00:00', 1, '95000.00', 'imax', 'Dolby Atmos', 'K', NULL, NULL, NULL, NULL),
(15, 'Tron: Ares', '2026-06-25 19:00:00', 1, '88000.00', 'imax', 'Dolby Atmos', 'L', 'IMAX-3D-00201', NULL, NULL, NULL),
(16, 'Avengers: Doomsday', '2026-06-20 19:00:00', 1, '150000.00', 'velvet', 'Dolby Atmos', 'VIP-1', NULL, NULL, 1, 'Full butler: snack & minuman diantar ke kursi'),
(17, 'Avengers: Doomsday', '2026-06-20 21:30:00', 1, '150000.00', 'velvet', 'Dolby Atmos', 'VIP-2', NULL, NULL, 1, 'Full butler: snack & minuman diantar ke kursi'),
(18, 'Wicked: Act Two', '2026-06-23 19:30:00', 1, '155000.00', 'velvet', 'Dolby Atmos', 'VIP-1', NULL, NULL, 1, 'Butler + akses pre-show lounge'),
(19, 'Wicked: Act Two', '2026-06-23 21:00:00', 1, '155000.00', 'velvet', 'Dolby Atmos', 'VIP-3', NULL, NULL, 1, 'Butler + akses pre-show lounge'),
(20, 'Oppenheimer Recut', '2026-06-24 20:00:00', 1, '160000.00', 'velvet', 'Dolby Atmos', 'VIP-2', NULL, NULL, 1, 'Butler on-demand'),
(21, 'Inside Out 3', '2026-06-22 17:00:00', 1, '145000.00', 'velvet', 'Dolby Atmos', 'VIP-1', NULL, NULL, 1, 'Butler + paket cemilan premium'),
(22, 'Tron: Ares', '2026-06-25 21:00:00', 1, '158000.00', 'velvet', 'Dolby Atmos', 'VIP-4', NULL, NULL, 1, 'Full butler: dinner diantar ke kursi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  ADD PRIMARY KEY (`id_tiket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  MODIFY `id_tiket` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
