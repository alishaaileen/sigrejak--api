-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2021 at 11:54 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigrejak`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Detail_Umat`
--

CREATE TABLE `Detail_Umat` (
  `id_umat` int(10) UNSIGNED NOT NULL,
  `tgl_baptis` date DEFAULT NULL,
  `tgl_komuni` date DEFAULT NULL,
  `tgl_penguatan` date DEFAULT NULL,
  `cara_menikah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tgl_menikah` date DEFAULT NULL,
  `file_akta_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_ktp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Keluarga`
--

CREATE TABLE `Keluarga` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_keluarga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lingkungan_diketuai` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Lingkungan`
--

CREATE TABLE `Lingkungan` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_lingkungan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_ketua_lingkungan` int(10) UNSIGNED NOT NULL,
  `paroki_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_03_09_095206_create_table_keluarga', 1),
(2, '2021_03_09_095305_create_table_admin', 1),
(3, '2021_03_09_095833_create_table_paroki', 1),
(4, '2021_03_09_100157_create_table_lingkungan', 1),
(5, '2021_03_09_100301_create_table_umat', 1),
(6, '2021_03_09_100400_create_table_detail_umat', 1);

-- --------------------------------------------------------

--
-- Table structure for table `Paroki`
--

CREATE TABLE `Paroki` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama_paroki` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_romo_paroki` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Umat`
--

CREATE TABLE `Umat` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_baptis` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_meninggal` int(11) NOT NULL,
  `status_umat_aktif` int(11) NOT NULL,
  `keluarga_id` int(10) UNSIGNED NOT NULL,
  `lingkungan_id` int(10) UNSIGNED DEFAULT NULL,
  `paroki_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Detail_Umat`
--
ALTER TABLE `Detail_Umat`
  ADD KEY `detail_umat_id_umat_foreign` (`id_umat`);

--
-- Indexes for table `Keluarga`
--
ALTER TABLE `Keluarga`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `keluarga_username_unique` (`username`),
  ADD UNIQUE KEY `keluarga_email_unique` (`email`);

--
-- Indexes for table `Lingkungan`
--
ALTER TABLE `Lingkungan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lingkungan_id_ketua_lingkungan_foreign` (`id_ketua_lingkungan`),
  ADD KEY `lingkungan_paroki_id_foreign` (`paroki_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Paroki`
--
ALTER TABLE `Paroki`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paroki_id_romo_paroki_foreign` (`id_romo_paroki`);

--
-- Indexes for table `Umat`
--
ALTER TABLE `Umat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `umat_keluarga_id_foreign` (`keluarga_id`),
  ADD KEY `umat_lingkungan_id_foreign` (`lingkungan_id`),
  ADD KEY `umat_paroki_id_foreign` (`paroki_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Keluarga`
--
ALTER TABLE `Keluarga`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Lingkungan`
--
ALTER TABLE `Lingkungan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Paroki`
--
ALTER TABLE `Paroki`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Umat`
--
ALTER TABLE `Umat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Detail_Umat`
--
ALTER TABLE `Detail_Umat`
  ADD CONSTRAINT `detail_umat_id_umat_foreign` FOREIGN KEY (`id_umat`) REFERENCES `Umat` (`id`);

--
-- Constraints for table `Lingkungan`
--
ALTER TABLE `Lingkungan`
  ADD CONSTRAINT `lingkungan_id_ketua_lingkungan_foreign` FOREIGN KEY (`id_ketua_lingkungan`) REFERENCES `Keluarga` (`id`),
  ADD CONSTRAINT `lingkungan_paroki_id_foreign` FOREIGN KEY (`paroki_id`) REFERENCES `Paroki` (`id`);

--
-- Constraints for table `Paroki`
--
ALTER TABLE `Paroki`
  ADD CONSTRAINT `paroki_id_romo_paroki_foreign` FOREIGN KEY (`id_romo_paroki`) REFERENCES `Admin` (`id`);

--
-- Constraints for table `Umat`
--
ALTER TABLE `Umat`
  ADD CONSTRAINT `umat_keluarga_id_foreign` FOREIGN KEY (`keluarga_id`) REFERENCES `Keluarga` (`id`),
  ADD CONSTRAINT `umat_lingkungan_id_foreign` FOREIGN KEY (`lingkungan_id`) REFERENCES `Lingkungan` (`id`),
  ADD CONSTRAINT `umat_paroki_id_foreign` FOREIGN KEY (`paroki_id`) REFERENCES `Paroki` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
