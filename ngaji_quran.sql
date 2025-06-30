-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 04:06 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngaji_quran`
--

-- --------------------------------------------------------

--
-- Table structure for table `ayat_terakhirs`
--

CREATE TABLE `ayat_terakhirs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_surah` varchar(255) NOT NULL,
  `nama_surah` varchar(255) NOT NULL,
  `ayat_terakhir` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ayat_terakhirs`
--

INSERT INTO `ayat_terakhirs` (`id`, `id_user`, `id_surah`, `nama_surah`, `ayat_terakhir`, `created_at`, `updated_at`) VALUES
(25, 2, '13', 'Ar-Ra\'d', '2', '2024-06-21 06:31:43', '2024-06-21 06:31:43'),
(26, 2, '13', 'Ar-Ra\'d', '4', '2024-06-21 06:42:39', '2024-06-21 06:42:39'),
(29, 2, '12', 'Yusuf', '10', '2024-06-21 07:02:06', '2024-06-21 07:02:06'),
(30, 2, '1', 'Al-Fatihah', '2', '2024-06-21 20:48:58', '2024-06-21 20:48:58');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(255) NOT NULL,
  `id_surah` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `id_user`, `id_surah`, `name`, `created_at`, `updated_at`) VALUES
(3, 1, '1', 'Al-Fatihah', '2024-06-20 08:33:58', '2024-06-20 08:33:58'),
(6, 1, '3', 'Ali \'Imran', '2024-06-20 08:39:30', '2024-06-20 08:39:30'),
(7, 2, '1', 'Al-Fatihah', '2024-06-20 19:19:45', '2024-06-20 19:19:45'),
(9, 2, '4', 'An-Nisa\'', '2024-06-20 19:20:41', '2024-06-20 19:20:41'),
(10, 6, '1', 'Al-Fatihah', '2024-06-20 20:40:42', '2024-06-20 20:40:42'),
(11, 6, '2', 'Al-Baqarah', '2024-06-20 20:40:46', '2024-06-20 20:40:46'),
(12, 6, '4', 'An-Nisa\'', '2024-06-20 21:15:47', '2024-06-20 21:15:47'),
(13, 7, '1', 'Al-Fatihah', '2024-06-20 22:59:41', '2024-06-20 22:59:41');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('rifki@gmail.com|127.0.0.1', 'i:1;', 1718951289),
('rifki@gmail.com|127.0.0.1:timer', 'i:1718951289;', 1718951289);

-- --------------------------------------------------------

--
-- Table structure for table `forkoms`
--

CREATE TABLE `forkoms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `pertanyaan` varchar(10000) NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forkoms`
--

INSERT INTO `forkoms` (`id`, `id_user`, `judul`, `pertanyaan`, `date`, `created_at`, `updated_at`) VALUES
(5, '2', 'testing', 'testing', '2024-06-19', '2024-06-19 20:26:26', '2024-06-19 20:26:26'),
(10, '2', 'testing', 'testing', '2024-06-19', '2024-06-20 01:35:27', '2024-06-20 01:35:27'),
(23, '7', '1', '1', '2024-06-21', '2024-06-20 23:18:05', '2024-06-20 23:18:05'),
(24, '7', '2', '2', '2024-06-21', '2024-06-20 23:18:19', '2024-06-20 23:18:19'),
(26, '1', 'tes admin', 'tes admin', '2024-06-21', '2024-06-20 23:28:21', '2024-06-20 23:28:21'),
(27, '1', 'sda', '...dasda', '2024-06-21', '2024-06-20 23:30:07', '2024-06-20 23:30:07'),
(28, '1', 'asd', '224134', '2024-06-21', '2024-06-20 23:30:20', '2024-06-21 08:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `forkoms_details`
--

CREATE TABLE `forkoms_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `id_forkom` varchar(255) NOT NULL,
  `tanggapan` varchar(10000) NOT NULL,
  `date` date NOT NULL DEFAULT '2024-06-19',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `forkoms_details`
--

INSERT INTO `forkoms_details` (`id`, `id_user`, `id_forkom`, `tanggapan`, `date`, `created_at`, `updated_at`) VALUES
(17, '1', '12', 'asas', '2024-06-19', '2024-06-20 03:17:27', '2024-06-20 03:17:27'),
(19, '1', '5', 'asadcsdf', '2024-06-19', '2024-06-20 03:23:20', '2024-06-20 03:23:20'),
(29, '7', '23', '1', '2024-06-21', '2024-06-20 23:18:30', '2024-06-20 23:18:30'),
(30, '7', '23', '2', '2024-06-21', '2024-06-20 23:18:35', '2024-06-20 23:18:35'),
(31, '7', '23', '3', '2024-06-21', '2024-06-20 23:18:39', '2024-06-20 23:18:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_19_022153_forum', 1),
(5, '2024_06_19_022536_forum_details', 2),
(6, '2024_06_20_132740_bookmarks', 3),
(7, '2024_06_21_101402_ayat_terakhirs', 4),
(8, '2024_06_21_101419_sosial_medias', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('mos6qMj2j0cKG1RDBfelXpX2MrXZBKHgWParqABs', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTUM2QmZSNUwwUFltNTg2MWY0Z0pNTURFdjl4d0pZdlF5NVNSYUk5NyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kaXNrdXNpIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1719031166);

-- --------------------------------------------------------

--
-- Table structure for table `sosial_medias`
--

CREATE TABLE `sosial_medias` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_user` varchar(255) NOT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `x` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sosial_medias`
--

INSERT INTO `sosial_medias` (`id`, `id_user`, `instagram`, `tiktok`, `facebook`, `x`, `created_at`, `updated_at`) VALUES
(6, '2', 'https://www.instagram.com/kodingbareng_', NULL, 'https://facebook.com/', 'https://facebook.com/', '2024-06-21 07:40:44', '2024-06-21 07:50:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `status` enum('Verified','Unverified','Pending') DEFAULT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `foto_profile` varchar(225) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `cv`, `status`, `role`, `foto_profile`, `email_verified_at`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, 'Verified', 'admin', 'assets/profile/3lDX6Tl9zu34gk4GDiCCIKtcCsmYgCMV5v0KYViRtz0A5VUh8QF077Cxh4aLv3OdAt2nJzlA2myJFjQq.jpg', NULL, '$2y$12$GDi64n4de8e0NbdL7qEAmeqRHmdEbbMvKvkXrP0xiE7HqSxAlBW6u', '2024-06-19 06:20:06', '2024-06-20 06:16:26'),
(2, 'user', 'user@gmail.com', 'assets/cv/fESg6wJAPnYImQUhuH35zuBEsODyghkz78fVTJeTbmdxfe1P9Z47M4dVJbG9HTX5VgSlwg26wHtagIfQ.pdf', 'Verified', 'user', 'assets/profile/PR9LwQopCbKUCSD9LbFH64cWjUNpMZ261IleNyKqAXunExSjJ3rb4hub5VcING52mpMkJjz1tvwVjLnE.jpg', NULL, '$2y$12$Rjp0uYQS8NUAiFC/SGRQIeBYO1avOQOei.0irdeLTxOkpJLBe7DOi', '2024-06-19 06:20:30', '2024-06-21 07:51:00'),
(6, 'udin', 'udin@gmail.com', NULL, 'Verified', 'user', NULL, NULL, '$2y$12$wTrcEI9QEq6xlNivxVE5J.M/MqK8tKbtex2hAphZZBcPf/0vPYld2', '2024-06-20 19:28:29', '2024-06-20 20:06:13'),
(7, 'fikri', 'fikri@gmail.com', 'assets/cv/g2NiHEZZWRNInF3vIGJnBHM8LRK27qNBinCsFIJU3xh1KNbzU47QtSpq84MAtsoVLvzL359xvdI9kuLP.pdf', 'Verified', 'user', 'assets/profile/07QRBS6nLTm2y8A7YMqxpTjc3wsftwa7L1MHVDsuM7VzD7WsKuzeVTvdzDmhCQWWBfKYu7SwHI1ua6xv.png', NULL, '$2y$12$K1tgCkoyW.iIi.Lin/VQMOus8RBJDuiv.WEczWFg1PV87/wVNUTZC', '2024-06-20 22:59:34', '2024-06-20 23:06:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ayat_terakhirs`
--
ALTER TABLE `ayat_terakhirs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `forkoms`
--
ALTER TABLE `forkoms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forkoms_details`
--
ALTER TABLE `forkoms_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sosial_medias`
--
ALTER TABLE `sosial_medias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ayat_terakhirs`
--
ALTER TABLE `ayat_terakhirs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `forkoms`
--
ALTER TABLE `forkoms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `forkoms_details`
--
ALTER TABLE `forkoms_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sosial_medias`
--
ALTER TABLE `sosial_medias`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
