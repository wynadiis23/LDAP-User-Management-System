-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2019 at 03:00 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ldapmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fakultas` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`id`, `fakultas`) VALUES
('1', 'fib'),
('10', 'ftp'),
('11', 'pariwisata'),
('12', 'fisip'),
('13', 'fkp'),
('2', 'fk'),
('3', 'fh'),
('4', 'ft'),
('5', 'fp'),
('6', 'feb'),
('7', 'fapet'),
('8', 'fmipa'),
('9', 'fkh');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_06_29_165936_add_table_fakultas', 1),
(2, '2019_06_29_165957_add_table_prodi', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prodi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` int(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`id`, `prodi`, `kode`) VALUES
('1001', 'teknik_pertanian', 10),
('1002', 'teknologi_industri_pertanian', 10),
('1003', 'ilmu_dan_teknologi_pangan', 10),
('101', 'antropologi_budaya', 1),
('102', 'arkeologi', 1),
('103', 'ilmu_sejarah', 1),
('104', 'sastra_bali', 1),
('105', 'sastra_daerah', 1),
('106', 'sastra_indonesia', 1),
('107', 'sastra_inggris', 1),
('108', 'sastra_jawa_kuno', 1),
('109', 'sastra_jepang', 1),
('1101', 'destinasi_pariwisata', 11),
('1102', 'industri_perjanalan_wisata', 11),
('1201', 'administrasi_negara', 12),
('1202', 'hubungan_internasional', 12),
('1203', 'ilmu_komunikasi', 12),
('1204', 'ilmu_politik', 12),
('1205', 'ilmu_sosiologi', 12),
('1301', 'ilmu_kelautan', 13),
('1302', 'manajemen_sumberdaya_perairan', 13),
('201', 'pendidikan_dokter', 2),
('301', 'ilmu_hukum', 3),
('401', 'arsitektur', 4),
('402', 'elektro', 4),
('403', 'sipil', 4),
('404', 'mesin', 4),
('405', 'teknologi_informasi', 4),
('501', 'agribisnis', 5),
('502', 'agroekoteknologi', 5),
('503', 'arsitektur_pertanaman', 5),
('601', 'akuntansi', 6),
('602', 'ekonomi_pembangunan', 6),
('603', 'manajemen', 6),
('604', 'profesi_akuntan', 6),
('701', 'peternakan', 7),
('801', 'biologi', 8),
('802', 'kimia', 8),
('803', 'matematika', 8),
('804', 'fisika', 8),
('805', 'teknik_informatika', 8),
('806', 'farmasi', 8),
('901', 'kedokteran_hewan', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD UNIQUE KEY `fakultas_id_unique` (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD UNIQUE KEY `prodi_id_unique` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
