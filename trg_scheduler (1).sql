-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2024 at 10:26 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trg_scheduler`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_type` enum('Meeting','Birthday & Anniversary','Non-Office') COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_datetime` datetime NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `incharge` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prepared_by` int(11) DEFAULT NULL,
  `status` enum('active','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `recurring` enum('none','daily','weekly','monthly') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_type`, `event_datetime`, `title`, `description`, `incharge`, `prepared_by`, `status`, `priority`, `recurring`, `created_at`, `updated_at`) VALUES
(1, 'Meeting', '2024-06-28 15:00:00', 'IT NETWORK', 'test', NULL, NULL, 'active', 'medium', 'daily', '2024-06-21 11:56:13', '2024-06-23 20:55:23'),
(3, 'Birthday & Anniversary', '2024-06-26 10:00:00', 'Alex\'s Birthday', 'birthday', NULL, NULL, 'active', 'medium', 'daily', '2024-06-21 12:22:26', '2024-06-23 20:55:17'),
(4, 'Meeting', '2024-06-25 05:02:00', 'test1', 'test1', NULL, NULL, 'active', 'medium', 'none', '2024-06-21 13:02:47', '2024-06-23 20:55:11'),
(5, 'Meeting', '2024-06-28 05:02:00', 'test 2', 'test 2', NULL, NULL, 'active', 'medium', 'none', '2024-06-21 13:02:56', '2024-06-23 20:55:03'),
(6, 'Meeting', '2024-06-27 05:03:00', 'test3', 'test3', NULL, NULL, 'active', 'medium', 'none', '2024-06-21 13:03:06', '2024-06-23 20:54:56'),
(7, 'Meeting', '2024-06-26 05:03:00', 'test 4', 'test 4', NULL, NULL, 'active', 'medium', 'none', '2024-06-21 13:03:18', '2024-06-23 20:54:47'),
(8, 'Meeting', '2024-06-25 05:03:00', 'test 5', 'test 5', 'test 5', NULL, 'active', 'medium', 'none', '2024-06-21 13:03:34', '2024-06-23 20:54:40'),
(9, 'Meeting', '2024-06-24 05:03:00', 'test 6', 'test 6', NULL, NULL, 'active', 'medium', 'none', '2024-06-21 13:04:03', '2024-06-23 20:54:05'),
(10, 'Birthday & Anniversary', '2024-06-28 00:00:00', 'bday 1', 'bday 1', NULL, NULL, 'active', 'medium', 'none', '2024-06-21 13:04:17', '2024-06-23 20:53:56'),
(11, 'Birthday & Anniversary', '2024-06-26 00:00:00', 'bday 2', 'bday 2', NULL, NULL, 'active', 'medium', 'none', '2024-06-21 13:04:28', '2024-06-23 20:53:48'),
(12, 'Birthday & Anniversary', '2024-06-26 00:00:00', 'bday 3', 'bday 3', NULL, NULL, 'active', 'medium', 'none', '2024-06-21 13:04:41', '2024-06-23 20:53:41'),
(17, 'Non-Office', '2024-06-25 12:00:00', 'PAMAMAGAYAG Novaliches', 'test', 'asd', 1, 'active', 'medium', 'daily', '2024-06-22 20:00:47', '2024-06-23 20:54:12'),
(18, 'Meeting', '2024-06-24 00:55:00', 'test', 'test', 'PMD IT', NULL, 'active', 'medium', 'none', '2024-06-23 08:55:13', '2024-06-23 20:53:30');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_06_21_022627_create_reminders_table', 1),
(7, '2024_06_21_022629_create_events_table', 1),
(8, '2024_06_21_022631_create_suguan_table', 1),
(9, '2024_06_24_061933_create_verseoftheweek_table', 2),
(10, '2024_06_24_074800_add_username_to_users_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reminder_datetime` datetime NOT NULL,
  `reminder` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `week_number` int(11) DEFAULT NULL,
  `verse_of_the_week` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `incharge` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `prepared_by` int(11) DEFAULT NULL,
  `status` enum('active','completed','cancelled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `priority` enum('low','medium','high') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reminders`
--

INSERT INTO `reminders` (`id`, `reminder_datetime`, `reminder`, `week_number`, `verse_of_the_week`, `incharge`, `prepared_by`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(1, '2024-06-17 22:49:00', 'test 1', 25, 'Never give up praying. And when you pray, keep alert and be thankful.\n\nColossians 4:2 Contemporary English Version', 'test', NULL, 'active', 'medium', '2024-06-21 06:49:46', '2024-06-22 19:58:23'),
(2, '2024-06-28 11:58:00', 'test 2', 25, 'Never give up praying. And when you pray, keep alert and be thankful.\n\nColossians 4:2 Contemporary English Version', 'test', 1, 'active', 'medium', '2024-06-22 19:58:48', '2024-06-23 20:53:04'),
(3, '2024-06-27 11:58:00', 'test 3', 25, 'asdsa', 'asd', 1, 'active', 'medium', '2024-06-22 19:58:59', '2024-06-23 20:52:59'),
(4, '2024-06-26 11:59:00', 'test 4', 25, 'asd', 'asd', 1, 'active', 'medium', '2024-06-22 19:59:12', '2024-06-23 20:52:53'),
(5, '2024-06-25 11:59:00', 'test 5', 25, 'tasdas', 'asd', 1, 'active', 'medium', '2024-06-22 19:59:25', '2024-06-23 20:52:48'),
(6, '2024-06-23 00:39:00', 'tet', NULL, 'st', '1', NULL, 'active', 'medium', '2024-06-23 08:39:30', '2024-06-23 08:39:30');

-- --------------------------------------------------------

--
-- Table structure for table `suguan`
--

CREATE TABLE `suguan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokal` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `suguan_datetime` datetime NOT NULL,
  `gampanin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prepared_by` int(11) DEFAULT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suguan`
--

INSERT INTO `suguan` (`id`, `name`, `lokal`, `district`, `suguan_datetime`, `gampanin`, `prepared_by`, `comments`, `created_at`, `updated_at`) VALUES
(1, 'Felix pareja', 'Maligaya', 'Caloocan North', '2024-06-26 18:00:00', 'Sugo 2', NULL, NULL, '2024-06-21 07:22:16', '2024-06-21 07:22:16'),
(2, 'Roland Kim Amaro', 'Bagong Buhay', 'CENTRAL', '2024-06-26 00:00:00', 'Sugo 2', NULL, NULL, '2024-06-21 07:22:50', '2024-06-21 07:22:50'),
(3, 'Ron de Guzman', 'Tandang Sora', 'CENTRAL', '2024-06-27 19:00:00', 'Sugo', NULL, NULL, '2024-06-21 07:29:05', '2024-06-21 07:29:05'),
(4, 'JM Hizon', 'Deparo', 'Caloocan North', '2024-06-27 00:00:00', 'Sugo', NULL, NULL, '2024-06-21 11:57:20', '2024-06-21 11:57:20'),
(5, 'Kyrt Jurada', 'Lawang Bato', 'Caloocan North', '2024-06-29 14:00:00', 'Sugo 2', NULL, NULL, '2024-06-21 13:13:48', '2024-06-21 13:24:28'),
(6, 'Carl Mariano', 'Mt Heights', 'Caloocan North', '2024-06-29 00:00:00', 'Reserba', 1, 'asd', '2024-06-22 20:01:26', '2024-06-22 20:01:26'),
(7, 'Teo Ramos', 'Caloocan', 'Camanava', '2024-06-30 10:00:00', 'Sugo 2', 1, 'asd', '2024-06-22 20:01:55', '2024-06-22 20:01:55'),
(8, 'Zion Mills', 'Balintawak', 'Camanava', '2024-06-30 06:00:00', 'Sugo 2', 1, 'asd', '2024-06-22 20:02:21', '2024-06-22 20:02:21'),
(9, 'test', 'test', 'Camanava', '2024-06-29 01:12:00', 'Sugo 2', NULL, NULL, '2024-06-23 09:12:54', '2024-06-23 09:12:54'),
(10, 'Alvin David', 'Fairview Ext.', 'QUEZON CITY', '2024-06-26 14:17:00', 'Sugo 2', NULL, NULL, '2024-06-23 22:18:11', '2024-06-23 22:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Felix Pareja', 'admin', 'felixpareja.pmdit07@gmail.com', NULL, '$2y$12$IpL1AXSs6boAdAcSLNqoUev3IQRrnHKaLg3OmnixdoLX0II4/uI/q', NULL, '2024-06-24 17:20:41', '2024-06-24 17:20:41'),
(2, 'Kim Amaro', 'kamaro', 'kamaro@gmail.com', NULL, '$2y$12$Z2b6bSFMWh4wA2yk7XseEOWhIZmKCiQ6SyA78G00lMLjQ.zDsKRiO', NULL, '2024-06-24 18:22:06', '2024-06-24 18:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `verseoftheweek`
--

CREATE TABLE `verseoftheweek` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `weeknumber` int(11) NOT NULL,
  `verse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verseoftheweek`
--

INSERT INTO `verseoftheweek` (`id`, `date`, `weeknumber`, `verse`, `content`, `created_at`, `updated_at`) VALUES
(1, '2024-06-24', 26, 'Colossians 4:2 Contemporary English Version', 'Never give up praying. And when you pray, keep alert and be thankful.', '2024-06-23 22:24:01', '2024-06-23 23:27:07'),
(2, '2024-06-25', 27, 'test111', 'test123', '2024-06-24 23:53:30', '2024-06-24 23:57:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suguan`
--
ALTER TABLE `suguan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- Indexes for table `verseoftheweek`
--
ALTER TABLE `verseoftheweek`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suguan`
--
ALTER TABLE `suguan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `verseoftheweek`
--
ALTER TABLE `verseoftheweek`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
