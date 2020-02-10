-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2020 at 09:45 AM
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
-- Database: `ldapusermanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `fakultas`
--

CREATE TABLE `fakultas` (
  `fakultas_id` int(10) NOT NULL,
  `fakultas_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fakultas`
--

INSERT INTO `fakultas` (`fakultas_id`, `fakultas_name`, `created_at`, `updated_at`) VALUES
(1, 'fib', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(2, 'fk', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(3, 'fh', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(4, 'ft', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(5, 'fp', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(6, 'feb', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(7, 'fapet', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(8, 'fmipa', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(9, 'fkh', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(10, 'ftp', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(11, 'pariwisata', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(12, 'fisip', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(13, 'fkp', '2019-07-17 05:19:34', '0000-00-00 00:00:00'),
(14, 'fakultas_baru_xy', '2019-10-24 18:11:54', '2019-10-24 10:11:54'),
(15, 'bambang     x', '2019-12-03 22:11:38', '2019-12-03 22:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `prodi`
--

CREATE TABLE `prodi` (
  `prodi_id` int(11) NOT NULL,
  `prodi_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fakultas_id` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodi`
--

INSERT INTO `prodi` (`prodi_id`, `prodi_name`, `fakultas_id`, `created_at`, `updated_at`) VALUES
(101, 'antropologi_budaya', 1, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(102, 'arkeologi', 1, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(103, 'ilmu_sejarah', 1, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(104, 'sastra_bali', 1, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(105, 'sastra_daerah', 1, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(106, 'sastra_indonesia', 1, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(107, 'sastra_inggris', 1, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(108, 'sastra_jawa_kuno', 1, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(109, 'sastra_jepang', 1, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(110, 'teknologi_bawah_rumah_1', 1, '2019-08-04 01:29:12', '2019-08-03 17:29:12'),
(201, 'pendidikan_dokter', 2, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(301, 'ilmu_hukum', 3, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(401, 'arsitektur', 4, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(402, 'elektro', 4, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(403, 'sipil', 4, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(404, 'mesin', 4, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(405, 'teknologi_informasi', 4, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(501, 'agribisnis', 5, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(502, 'agroekoteknologi', 5, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(503, 'arsitektur_pertanaman', 5, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(601, 'akuntansi', 6, '2019-07-28 07:30:52', '0000-00-00 00:00:00'),
(602, 'ekonomi_pembangunan', 6, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(603, 'manajemen', 6, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(604, 'profesi_akuntan', 6, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(701, 'peternakan', 7, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(801, 'biologi', 8, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(802, 'kimia', 8, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(803, 'matematika', 8, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(804, 'fisika', 8, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(805, 'teknik_informatika', 8, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(806, 'farmasi', 8, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(807, 'barubarumang', 8, '2019-07-27 22:59:55', '2019-07-27 22:59:55'),
(901, 'kedokteran_hewan', 9, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1001, 'teknik_pertanian', 10, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1002, 'teknik_industri_pertanian', 10, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1003, 'ilmu_dan_teknologi_pangan', 10, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1101, 'destinasi_pariwisata', 11, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1102, 'industri_perjalanan_wisata', 11, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1201, 'administrasi_negara', 12, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1202, 'hubungan_internasional', 12, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1203, 'ilmu_komunikasi', 12, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1204, 'ilmu_politik', 12, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1205, 'ilmu_sosiologi', 12, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1301, 'ilmu_kelautan', 13, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1302, 'manajemen_sumber_daya_perairan', 13, '2019-07-17 04:32:45', '0000-00-00 00:00:00'),
(1401, 'prodi baru', 14, '2019-10-30 01:54:19', '2019-10-29 17:54:19'),
(1501, 'sz', 15, '2019-12-03 22:12:17', '2019-12-03 22:12:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fakultas`
--
ALTER TABLE `fakultas`
  ADD PRIMARY KEY (`fakultas_id`);

--
-- Indexes for table `prodi`
--
ALTER TABLE `prodi`
  ADD PRIMARY KEY (`prodi_id`),
  ADD KEY `fakultas_id` (`fakultas_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prodi`
--
ALTER TABLE `prodi`
  ADD CONSTRAINT `fakultas_id` FOREIGN KEY (`fakultas_id`) REFERENCES `fakultas` (`fakultas_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
