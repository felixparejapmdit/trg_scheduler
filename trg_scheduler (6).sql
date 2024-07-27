-- phpMyAdmin SQL Dump
-- version 5.2.1deb1ubuntu0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 27, 2024 at 09:23 AM
-- Server version: 8.0.35-0ubuntu0.23.04.1
-- PHP Version: 8.1.12-1ubuntu4.3

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
-- Table structure for table `broadcast_suguan`
--

CREATE TABLE `broadcast_suguan` (
  `id` bigint UNSIGNED NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tobebroadcast` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `broadcast_suguan`
--

INSERT INTO `broadcast_suguan` (`id`, `date`, `name`, `tobebroadcast`, `created_at`, `updated_at`) VALUES
(1, '2024-06-25 05:00:00', 'Alex Cruz at Medel Salise Jr.123', 'Axel (Filmed Preaching) (Webex 10 )', '2024-06-28 00:31:31', '2024-06-28 00:31:39'),
(2, '2024-06-26 04:00:00', 'Teo Ramos Jr. at Zion Mills', 'Axel (Filmed Preaching) (Webex 10 )', '2024-06-28 00:31:31', '2024-06-28 00:31:31'),
(3, '2024-06-26 19:00:00', 'Edcel Supnet', 'Temple WS (Webex 11 & 12)', '2024-06-28 00:31:31', '2024-06-28 00:31:31'),
(4, '2024-06-27 06:00:00', 'Raniel Respall at Cesar Solomon Jr.', 'Temple WS (Webex 12)', '2024-06-28 00:31:31', '2024-06-28 00:31:31'),
(5, '2024-06-27 19:00:00', 'Jhun Reyes', 'Temple WS (Webex 12)', '2024-06-28 00:31:31', '2024-06-28 00:31:31'),
(6, '2024-06-28 04:00:00', 'Jester Nicolas at Kim Amaro', 'Axel (Filmed Preaching) (Webex 10 )', '2024-06-28 00:31:31', '2024-06-28 00:31:31'),
(7, '2024-06-29 04:00:00', 'Carl Lawrence Mariano at Benny Ebreo', 'Axel (Filmed Preaching) (Webex 10 )', '2024-06-28 00:31:31', '2024-06-28 00:31:31'),
(8, '2024-06-29 18:00:00', 'Marvin Tindugan', 'Temple WS (Webex 11 & 12)', '2024-06-28 00:31:31', '2024-06-28 00:31:31'),
(9, '2024-06-30 06:00:00', 'Pat Balverde at Bryan Nipolo', 'Temple WS (Webex 12)', '2024-06-28 00:31:31', '2024-06-28 00:31:31'),
(10, '2024-06-30 10:00:00', 'Pat Balverde at Bryan Nipolo', 'Temple WS (Webex 12)', '2024-06-28 00:31:31', '2024-06-28 00:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`) VALUES
(1, 'Caloocan North'),
(2, 'Camanava'),
(3, 'CENTRAL'),
(4, 'Makati'),
(5, 'MAYNILA\n'),
(6, 'Metro Manila East'),
(7, 'Metro Manila South'),
(8, 'Quezon City');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `event_type` enum('Meeting','Birthday & Anniversary','Non-Office') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `event_datetime` datetime NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `incharge` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `prepared_by` int DEFAULT NULL,
  `status` enum('active','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `priority` enum('low','medium','high') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `recurring` enum('none','daily','weekly','monthly') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_type`, `event_datetime`, `title`, `description`, `incharge`, `prepared_by`, `status`, `priority`, `recurring`, `created_at`, `updated_at`) VALUES
(9, 'Meeting', '2024-07-24 10:00:00', 'Video System for the Central Office', 'Ka JM Hizon/Danrel Galvez', 'Ka Ron T. de Guzman', NULL, 'active', 'medium', 'none', '2024-06-21 13:04:03', '2024-07-18 03:53:05'),
(19, 'Birthday & Anniversary', '2024-07-27 12:00:00', 'HAPPY 110th ANNIVERSARY', 'CHURCH ANNIVERSARY', 'TRG', NULL, 'active', 'medium', 'none', '2024-07-22 03:40:47', '2024-07-23 05:08:01'),
(20, 'Meeting', '2024-07-23 10:00:00', 'DOMAIN CREATION FOR THE CENTRAL NETWORK', 'F. GUIANG\r\nCL. MARIANO\r\nJETH SAMSON', 'KA RTG', NULL, 'active', 'medium', 'none', '2024-07-22 03:43:56', '2024-07-22 03:43:56'),
(21, 'Meeting', '2024-07-26 12:00:00', 'DEV PROCEDURE', 'TEO RAMOS\r\nZION MILLS\r\nKIM AMARO\r\nBENNY EBREO\r\nJETHRO SAMSON', NULL, NULL, 'active', 'medium', 'none', '2024-07-22 03:46:24', '2024-07-22 03:46:24'),
(22, 'Non-Office', '2024-06-04 10:00:00', 'WORLD WIDE EVANGELICAL MISSION', 'PHILIPPINE ARENA', 'ALL DISTRICTS', NULL, 'active', 'medium', 'none', '2024-07-22 03:49:03', '2024-07-22 03:49:03'),
(24, 'Meeting', '2024-07-23 10:00:00', 'Powercraft Solution & Data Insfrastructure', 'VSAT ROOM/CCTV ROOM', 'FACILITIES', NULL, 'active', 'medium', 'none', '2024-07-22 07:19:06', '2024-07-22 08:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `locale_congregations`
--

CREATE TABLE `locale_congregations` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `district_id` int NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locale_congregations`
--

INSERT INTO `locale_congregations` (`id`, `name`, `district_id`, `updated_at`, `created_at`) VALUES
(1, 'Bagong Silang 4 Ext.', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(2, 'Bagong Silang 9', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(3, 'Bagong Silang I', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(4, 'Bagong Silang V', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(5, 'Brixtonville', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(6, 'Camarin', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(7, 'Deparo', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(8, 'F. Manalo', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(9, 'Lawang Bato', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(10, 'Maligaya', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(11, 'Mt. Heights', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(12, 'Palmera', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(13, 'Punturin', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(14, 'Saranay', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(15, 'St Dominic', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(16, 'Tala Estate', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(17, 'Tierra Nova', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(18, 'Vistan', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(19, 'Zamora Compound', 1, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(20, 'Bagbaguin', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(21, 'Balintawak', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(22, 'Caloocan', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(23, 'Catmon', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(24, 'Gen T De Leon', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(25, 'Grace Park', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(26, 'Kalandang', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(27, 'Karuhatan', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(28, 'Kaunlaran', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(29, 'Kaunlaran 3', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(30, 'Kaunlaran I', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(31, 'Kawal', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(32, 'Letre', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(33, 'Lingunan', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(34, 'M H Del Pilar', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(35, 'Malabon', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(36, 'Malinta', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(37, 'Mapulang Lupa', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(38, 'Maysan', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(39, 'Naval', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(40, 'Navotas', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(41, 'North Diversion', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(42, 'Panghulo', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(43, 'Parada', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(44, 'Polo', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(45, 'Sampaguita', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(46, 'Sangandaan- Caloocan', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(47, 'Skyline', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(48, 'Sta. Quiteria', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(49, 'Tandang Sora Caloocan', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(50, 'Tangos', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(51, 'Tinajeros', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(52, 'Valenzuela', 2, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(53, 'Bagbag Ext.', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(54, 'Bago Bantay', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(55, 'Bagong Buhay', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(56, 'BF Road', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(57, 'Bonifacio Drive', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(58, 'Caballero Ext.', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(59, 'Centerville Ext.', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(60, 'Commonwealth', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(61, 'Doña Faustina Housing', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(62, 'Freedom Ext.', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(63, 'Green Condo', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(64, 'Kaingin Ext', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(65, 'Luzon Avenue', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(66, 'Macabud', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(67, 'Mascap Ext', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(68, 'Mindanao Avenue', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(69, 'New Era University', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(70, 'New Era University - NELD 2', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(71, 'Pacita', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(72, 'Pansol Ext.', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(73, 'Pasong Tamo', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(74, 'Pasong Tamo Ext.', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(75, 'Pugad Lawin', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(76, 'Sagana', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(77, 'Saguingan', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(78, 'San Isidro - Landfill GWS', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(79, 'Sitio Laan Ext.', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(80, 'Southville', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(81, 'Tagumpay I', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(82, 'Tagumpay II', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(83, 'Tandang Sora, QC', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(84, 'Templo Central', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(85, 'Veterans Village 1', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(86, 'Veterans Village 2', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(87, 'Visayas Avenue', 3, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(88, 'Bagumbayan', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(89, 'Bel-Air', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(90, 'Better Living', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(91, 'BF Homes Parañaque', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(92, 'Central Signal', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(93, 'Evangelista', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(94, 'Fourth Estate', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(95, 'Guadalupe', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(96, 'Ibayo', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(97, 'Jackson', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(98, 'Lower Bicutan', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(99, 'Malibay', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(100, 'Mamamante', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(101, 'MIA Ext.(Pasay)', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(102, 'Multinational', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(103, 'North Signal', 4, '2024-07-27 08:55:16', '2024-07-27 08:55:16'),
(104, 'Palanan', 4, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(105, 'Parañaque', 4, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(106, 'Pasay', 4, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(107, 'Proprietarios', 4, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(108, 'Sacramento', 4, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(109, 'Severina 18', 4, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(110, 'Sunrise-La Paz', 4, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(111, 'UP 1', 4, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(112, 'UP-1 Tanyag Ext.', 4, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(113, 'Upper Bicutan', 4, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(114, 'Aplaya', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(115, 'Bambang', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(116, 'Barrio Obrero', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(117, 'Baseco', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(118, 'Binondo', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(119, 'Blumentritt', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(120, 'G. Tuazon', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(121, 'H. Lopez', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(122, 'Herbosa', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(123, 'Magsaysay', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(124, 'Paco', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(125, 'Pandacan', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(126, 'Punta', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(127, 'Quiapo', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(128, 'Sampaloc', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(129, 'San Nicolas', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(130, 'Solis', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(131, 'Syquia', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(132, 'Tayuman', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(133, 'Tundo', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(134, 'Washington', 5, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(135, 'Arenda Ext-Ilugin', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(136, 'Bagong Ilog', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(137, 'Barangka- Mandaluyong', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(138, 'Barangka- Marikina', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(139, 'Bayan-Bayanan', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(140, 'Buting', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(141, 'Calumpang', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(142, 'Concepcion', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(143, 'Cupang', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(144, 'De Castro', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(145, 'F. Manalo - San Juan', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(146, 'F. Manalo- Marikina', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(147, 'Hagonoy', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(148, 'Highway Hills', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(149, 'Ilugin', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(150, 'Karangalan Village', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(151, 'Kenneth Ext - Ilugin', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(152, 'Mandaluyong', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(153, 'Manggahan', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(154, 'Marikina Centro', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(155, 'Napindan', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(156, 'Parang', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(157, 'Pasig', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(158, 'Pateros', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(159, 'Pembo', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(160, 'Pinagsama', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(161, 'Pineda', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(162, 'Pulo', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(163, 'Sampaguita Village', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(164, 'San Juan', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(165, 'Santolan', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(166, 'SSS Village', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(167, 'SSS Village - Manzeta Extension', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(168, 'Taguig', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(169, 'Tipas', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(170, 'Ugong', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(171, 'Ususan', 6, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(172, 'Alabang', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(173, 'Almanza', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(174, 'BF International', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(175, 'BF Resort Village', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(176, 'CAA', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(177, 'Camella Homes', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(178, 'Camp Sampaguita', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(179, 'Cupang Muntinlupa', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(180, 'Golden Acres', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(181, 'Karunungan', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(182, 'Las Piñas', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(183, 'Madrigal', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(184, 'Moonwalk', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(185, 'Muntinlupa', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(186, 'NBP', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(187, 'NBP Ext.', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(188, 'Pamplona', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(189, 'Plaza Quezon', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(190, 'Saint Joseph', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(191, 'Sucat', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(192, 'Talon', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(193, 'Tunasan', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(194, 'Victoria', 7, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(195, 'Amparo', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(196, 'Araneta', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(197, 'Arayat Ext', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(198, 'B. Asuncion Ext.', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(199, 'Baesa', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(200, 'Baesa 2', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(201, 'Bagong Silangan', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(202, 'Batasan Hills 1', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(203, 'Batasan Hills II', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(204, 'Caballes GWS', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(205, 'Camp Site', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(206, 'Capitol', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(207, 'Carreon Village', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(208, 'Congress GWS', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(209, 'Cubao', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(210, 'Eco Park', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(211, 'Empire Ext.', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(212, 'Fairview', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(213, 'Galas', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(214, 'IBP', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(215, 'La Loma', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(216, 'Lagro', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(217, 'Lupang Pangako Ext', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(218, 'Manggahan', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(219, 'Martan', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(220, 'Murphy', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(221, 'Nagkaisang Nayon', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(222, 'North Fairview Ext', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(223, 'North Olympus Ext.', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(224, 'Novaliches', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(225, 'Palayan Ext.', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(226, 'Parco Ext', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(227, 'Payatas', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(228, 'Payatas II Ext', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(229, 'Pilot', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(230, 'Project 4', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(231, 'PROJECTS 2 & 3', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(232, 'R. Sanchez Ext.', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(233, 'Republic', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(234, 'Riverside', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(235, 'Rufo Ext.', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(236, 'San Francisco', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(237, 'Sauyo Ext', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(238, 'Silanganan', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(239, 'Sta Lucia', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(240, 'V. Luna', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(241, 'West Avenue Ext.', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17'),
(242, 'Zabarte', 8, '2024-07-27 08:55:17', '2024-07-27 08:55:17');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
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
(10, '2024_06_24_074800_add_username_to_users_table', 3),
(11, '2024_06_27_224205_create_broadcast_suguan_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `id` bigint UNSIGNED NOT NULL,
  `reminder_datetime` datetime NOT NULL,
  `reminder` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `week_number` int DEFAULT NULL,
  `verse_of_the_week` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `incharge` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prepared_by` int DEFAULT NULL,
  `status` enum('active','completed','cancelled') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `priority` enum('low','medium','high') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'medium',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suguan`
--

CREATE TABLE `suguan` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `district` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `suguan_datetime` datetime NOT NULL,
  `gampanin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prepared_by` int DEFAULT NULL,
  `comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suguan`
--

INSERT INTO `suguan` (`id`, `name`, `lokal`, `district`, `suguan_datetime`, `gampanin`, `prepared_by`, `comments`, `created_at`, `updated_at`) VALUES
(1, 'Felix M. Pareja', 'Maligaya', 'Caloocan North', '2024-06-26 18:00:00', 'Sugo 2', NULL, NULL, '2024-06-21 07:22:16', '2024-06-27 22:31:35'),
(2, 'Roland Kim Amaro', 'Bagong Buhay', 'CENTRAL', '2024-06-26 06:00:00', 'Sugo 2', NULL, NULL, '2024-06-21 07:22:50', '2024-06-28 00:35:14'),
(3, 'Ron de Guzman', 'Tandang Sora', 'CENTRAL', '2024-06-27 19:00:00', 'Sugo', NULL, NULL, '2024-06-21 07:29:05', '2024-06-21 07:29:05'),
(4, 'JM Hizon', 'Deparo', 'Caloocan North', '2024-06-27 00:00:00', 'Sugo', NULL, NULL, '2024-06-21 11:57:20', '2024-06-21 11:57:20'),
(5, 'Kyrt Jurada', 'Lawang Bato', 'Caloocan North', '2024-06-29 14:00:00', 'Sugo 2', NULL, NULL, '2024-06-21 13:13:48', '2024-06-21 13:24:28'),
(6, 'Carl Mariano', 'Mt Heights', 'Caloocan North', '2024-06-29 00:00:00', 'Reserba', 1, 'asd', '2024-06-22 20:01:26', '2024-06-22 20:01:26'),
(7, 'Teo Ramos', 'Caloocan', 'Camanava', '2024-06-30 10:00:00', 'Sugo 2', 1, 'asd', '2024-06-22 20:01:55', '2024-06-22 20:01:55'),
(8, 'Zion Mills', 'Balintawak', 'Camanava', '2024-06-30 06:00:00', 'Sugo 2', 1, 'asd', '2024-06-22 20:02:21', '2024-06-22 20:02:21'),
(9, 'test', 'test', 'Camanava', '2024-06-29 01:12:00', 'Sugo 2', NULL, NULL, '2024-06-23 09:12:54', '2024-06-23 09:12:54'),
(10, 'Alvin David', 'Fairview Ext.', 'QUEZON CITY', '2024-06-26 14:17:00', 'Sugo 2', NULL, NULL, '2024-06-23 22:18:11', '2024-06-23 22:18:11'),
(11, 'Felix Pareja', 'Maligaya', 'Caloocan North', '2024-07-10 19:30:00', 'Reserba', NULL, NULL, '2024-07-09 17:58:16', '2024-07-09 17:58:16'),
(12, 'Felix Pareja', 'Tandang Sora', 'CENTRAL', '2024-07-18 19:00:00', 'Sugo 2', NULL, NULL, '2024-07-17 07:46:16', '2024-07-17 07:55:55'),
(13, 'Felix Pareja', 'Bonifacio Drive', 'CENTRAL', '2024-07-20 06:00:00', 'Reserba', NULL, NULL, '2024-07-17 07:56:26', '2024-07-17 07:56:26'),
(14, 'Ronald Kim Amaro', 'Pacita', 'CENTRAL', '2024-07-17 19:00:00', 'Sugo 2', NULL, NULL, '2024-07-17 10:00:52', '2024-07-18 04:05:18'),
(15, 'Kyrt Jurada', 'Bagong Silang 9', 'Caloocan North', '2024-07-17 19:30:00', 'Reserba', NULL, NULL, '2024-07-17 10:01:17', '2024-07-17 10:01:17'),
(16, 'Kyrt Jurada', 'Vistan', 'Caloocan North', '2024-07-20 10:00:00', 'Reserba', NULL, NULL, '2024-07-17 10:01:36', '2024-07-17 10:01:36'),
(18, 'Marco Acuzar', 'Campsite', 'QUEZON CITY', '2024-07-20 18:00:00', 'Sugo 2', NULL, NULL, '2024-07-18 03:33:03', '2024-07-18 03:33:03'),
(19, 'Kaizer Agdaca', 'Bayan-bayanan', 'Camanava', '2024-07-20 06:00:00', 'Sugo 2', NULL, NULL, '2024-07-18 03:34:53', '2024-07-18 03:34:53'),
(20, 'Logen Camorro', 'Cupang', 'Metro Manila East', '2024-07-20 06:00:00', 'Sugo 2', NULL, NULL, '2024-07-18 03:37:13', '2024-07-18 03:37:13'),
(21, 'Alex Cruz', 'Viztan', 'Caloocan North', '2024-07-20 18:00:00', 'Reserba', NULL, NULL, '2024-07-18 03:38:52', '2024-07-18 03:38:52'),
(22, 'Roland Kim Amaro', 'NEU', 'CENTRAL', '2024-07-21 14:00:00', 'Sugo 2', NULL, NULL, '2024-07-18 03:42:58', '2024-07-18 03:42:58'),
(23, 'Carlo Aspili', 'Bayan-bayanan', 'Metro Manila East', '2024-07-21 10:00:00', 'Sugo 2', NULL, NULL, '2024-07-18 03:44:18', '2024-07-18 03:44:18'),
(24, 'Alvin David', 'Baesa-Sauyo ext.', 'QUEZON CITY', '2024-07-20 06:00:00', 'Reserba', NULL, NULL, '2024-07-18 03:44:47', '2024-07-18 03:45:19'),
(25, 'Paul Anthony Louis Bautista', 'Baesa 2', 'QUEZON CITY', '2024-07-21 10:00:00', 'Reserba', NULL, NULL, '2024-07-18 03:48:36', '2024-07-18 03:48:36'),
(26, 'Ronald de Guzman', 'NEU', 'CENTRAL', '2024-07-21 06:00:00', 'Sugo 1', NULL, NULL, '2024-07-18 03:49:19', '2024-07-18 03:49:19'),
(27, 'Emman Doctor', 'Palmera', 'Caloocan North', '2024-07-20 10:00:00', 'Sugo', NULL, NULL, '2024-07-18 03:49:31', '2024-07-18 03:49:31'),
(28, 'Benny Ceasar Ebreo', 'Mt. Heights', 'Caloocan North', '2024-07-21 10:00:00', 'Reserba 2', NULL, NULL, '2024-07-18 03:50:01', '2024-07-18 03:50:01'),
(29, 'Danrel Galvez', 'Pugad Lawin', 'CENTRAL', '2024-07-21 06:00:00', 'Reserba', NULL, NULL, '2024-07-18 03:50:45', '2024-07-18 03:50:45'),
(30, 'Randel Galvez', 'Zabarte', 'QUEZON CITY', '2024-07-21 10:00:00', 'Sugo 2', NULL, NULL, '2024-07-18 03:51:35', '2024-07-18 03:51:35'),
(31, 'Jayson Doronio', 'Caballero ext.', 'CENTRAL', '2024-07-20 11:00:00', 'Sugo 1', NULL, NULL, '2024-07-18 03:51:47', '2024-07-18 03:51:47'),
(32, 'Febert Eraño Guiang', 'Golden Acres', 'Metro Manila South', '2024-07-21 10:00:00', 'Reserba', NULL, NULL, '2024-07-18 03:53:23', '2024-07-18 03:53:23'),
(33, 'John Michael Hizon', 'F. Manalo', 'Caloocan North', '2024-07-21 06:00:00', 'Reserba 1', NULL, NULL, '2024-07-18 03:59:00', '2024-07-18 03:59:00'),
(34, 'Keith Carlo Mangubat', 'Campsite', 'QUEZON CITY', '2024-07-21 10:00:00', 'Reserba', NULL, NULL, '2024-07-18 04:05:30', '2024-07-18 04:05:30'),
(35, 'Carl Lawrence Mariano', 'Bagong Silang 4 ext.', 'Caloocan North', '2024-07-21 10:00:00', 'Reserba 1', NULL, NULL, '2024-07-18 04:06:30', '2024-07-18 04:06:30'),
(36, 'Rexon Duldulao', 'NEU', 'CENTRAL', '2024-07-20 06:00:00', 'Reserba', NULL, NULL, '2024-07-18 04:07:08', '2024-07-18 04:07:08'),
(37, 'Zion Phoenix Mills', 'Caloocan', 'Camanava', '2024-07-21 10:00:00', 'Reserba 2', NULL, NULL, '2024-07-18 04:07:16', '2024-07-18 04:07:16'),
(38, 'Jester Niko Nicolas', 'Batasan Hills1', 'QUEZON CITY', '2024-07-21 10:00:00', 'Reserba', NULL, NULL, '2024-07-18 04:09:01', '2024-07-18 04:09:01'),
(39, 'Gloverick Parungao', 'Bagumbayan', 'Makati', '2024-07-21 06:00:00', 'Sugo', NULL, NULL, '2024-07-18 04:10:10', '2024-07-18 04:10:10'),
(40, 'Teodorico Ramos Jr.', 'Lingunan', 'Camanava', '2024-07-21 06:00:00', 'Reserba 1', NULL, NULL, '2024-07-18 04:10:53', '2024-07-18 04:10:53'),
(41, 'Nehemias Dungca', 'Sitio Laan ext.', 'CENTRAL', '2024-07-20 10:00:00', 'Sugo 1', NULL, NULL, '2024-07-18 04:11:08', '2024-07-18 04:11:08'),
(42, 'Jorick Hernandez', 'kaunlaran 1', 'Camanava', '2024-07-20 06:00:00', 'Sugo', NULL, NULL, '2024-07-18 04:12:35', '2024-07-18 04:12:35'),
(43, 'Kyrt Jurada', 'Vistan', 'Caloocan North', '2024-07-20 10:00:00', 'Reserba', NULL, NULL, '2024-07-18 04:14:10', '2024-07-18 04:14:10'),
(46, 'Bryan Pusing', 'Zabarte-North Olympus', 'QUEZON CITY', '2024-07-20 06:00:00', 'Reserba', NULL, NULL, '2024-07-18 04:18:10', '2024-07-18 04:18:10'),
(47, 'Medel Salise Jr.', 'Novaliches', 'QUEZON CITY', '2024-07-20 06:00:00', 'Reserba 2', NULL, NULL, '2024-07-18 04:19:41', '2024-07-18 04:20:11'),
(48, 'Wilrenz Sumang', 'Almanza', 'Metro Manila South', '2024-07-20 14:00:00', 'Reserba', NULL, NULL, '2024-07-18 04:22:43', '2024-07-18 04:22:43'),
(49, 'Allaen Vejerano', 'Empire ext', 'QUEZON CITY', '2024-07-20 10:00:00', 'Reserba', NULL, NULL, '2024-07-18 04:23:46', '2024-07-18 04:23:46'),
(50, 'Jorick Hernandez', 'Lingunan', 'Camanava', '2024-07-25 16:00:00', 'Sugo', NULL, NULL, '2024-07-21 23:12:22', '2024-07-21 23:12:22'),
(51, 'Gloverick Parungao', 'Central Signal', 'Makati', '2024-07-24 20:00:00', 'Sugo', NULL, NULL, '2024-07-21 23:16:12', '2024-07-21 23:16:12'),
(53, 'Gloverick Parungao', 'Palanan', 'Makati', '2024-07-28 10:00:00', 'Sugo', NULL, NULL, '2024-07-22 00:28:25', '2024-07-22 00:28:25'),
(54, 'Jorick Hernandez', 'Catmon', 'Camanava', '2024-07-26 20:00:00', 'Reserba', NULL, NULL, '2024-07-22 00:29:41', '2024-07-22 00:29:41'),
(55, 'Felix Pareja', 'NEU', 'CENTRAL', '2024-07-25 19:00:00', 'Reserba', NULL, NULL, '2024-07-22 00:32:02', '2024-07-22 03:07:30'),
(56, 'Felix Pareja', 'Templo NEGH', 'CENTRAL', '2024-07-28 10:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 00:33:45', '2024-07-22 00:33:45'),
(57, 'kyrt Jurada', 'BS 1', 'Caloocan North', '2024-07-25 16:00:00', 'Reserba', NULL, NULL, '2024-07-22 00:35:28', '2024-07-22 00:35:28'),
(58, 'kyrt Jurada', 'BS 9', 'Caloocan North', '2024-07-28 10:00:00', 'Reserba', NULL, NULL, '2024-07-22 00:38:00', '2024-07-22 02:24:19'),
(60, 'John Louise Canque', 'Centerville Ext.', 'CENTRAL', '2024-07-28 06:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 01:22:45', '2024-07-22 01:22:45'),
(61, 'Ronald T. de Guzman', 'Sagana', 'CENTRAL', '2024-07-25 06:00:00', 'Sugo 1', NULL, NULL, '2024-07-22 01:26:13', '2024-07-22 01:26:13'),
(63, 'Ronald T. de Guzman', 'Green Condo', 'CENTRAL', '2024-07-28 06:00:00', 'Sugo 1', NULL, NULL, '2024-07-22 01:28:10', '2024-07-22 01:28:10'),
(64, 'Logen Camorro', 'Pembo', 'Metro Manila East', '2024-07-25 17:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 01:30:13', '2024-07-22 01:30:13'),
(65, 'Logen Camorro', 'Sampaguita Village', 'Metro Manila East', '2024-07-26 18:00:00', 'Reserba', NULL, NULL, '2024-07-22 01:31:44', '2024-07-22 01:31:44'),
(66, 'Benny Ceasar Ebrero', 'Camarin', 'Caloocan North', '2024-07-25 20:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 01:33:19', '2024-07-22 01:33:19'),
(67, 'Benny Ceasar Ebrero', 'Tierra Nova', 'Caloocan North', '2024-07-27 10:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 01:34:19', '2024-07-22 01:34:19'),
(68, 'Carl Lawrence Mariano', 'Lawang Bato', 'Caloocan North', '2024-07-25 18:30:00', 'Reserba', NULL, NULL, '2024-07-22 01:37:14', '2024-07-22 01:37:14'),
(69, 'Carl Lawrence Mariano', 'Tala Estate', 'Caloocan North', '2024-07-28 10:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 01:38:28', '2024-07-22 01:38:28'),
(70, 'Emman Doctor', 'BS 4 ext.', 'Caloocan North', '2024-07-24 18:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 01:41:13', '2024-07-22 01:41:13'),
(71, 'Emman Doctor', 'Camarin', 'Caloocan North', '2024-07-27 10:00:00', 'Reserba', NULL, NULL, '2024-07-22 01:42:32', '2024-07-22 01:42:32'),
(72, 'Medel Salise Jr.', 'Manggahan', 'QUEZON CITY', '2024-07-25 08:45:00', 'Sugo 2', NULL, NULL, '2024-07-22 01:45:16', '2024-07-22 01:45:16'),
(73, 'Medel Salise Jr.', 'Novaliches', 'QUEZON CITY', '2024-07-26 14:00:00', 'Reserba', NULL, NULL, '2024-07-22 01:46:07', '2024-07-22 01:46:07'),
(74, 'Teo Ramos', 'Letre', 'Camanava', '2024-07-25 19:45:00', 'Reserba', NULL, NULL, '2024-07-22 01:47:04', '2024-07-22 01:47:04'),
(75, 'Teo Ramos', 'Caloocan', 'Camanava', '2024-07-28 10:00:00', 'Reserba', NULL, NULL, '2024-07-22 01:48:17', '2024-07-22 01:48:17'),
(76, 'Kaizer Agdaca', 'Cupang', 'Metro Manila East', '2024-07-25 19:30:00', 'Sugo 2', NULL, NULL, '2024-07-22 01:50:19', '2024-07-22 01:50:19'),
(77, 'Kaizer Agdaca', 'SSS-Village-Manseta ext', 'Metro Manila East', '2024-07-28 14:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 01:52:15', '2024-07-22 01:52:15'),
(78, 'Bryan Pusing', 'Zabarte-North Olympus', 'QUEZON CITY', '2024-07-24 19:45:00', 'Sugo 2', NULL, NULL, '2024-07-22 01:55:09', '2024-07-22 01:55:09'),
(79, 'Alvin David', 'Cubao - Arayat ext.', 'QUEZON CITY', '2024-07-24 05:45:00', 'Sugo 2', NULL, NULL, '2024-07-22 01:59:03', '2024-07-22 01:59:03'),
(80, 'Alvin David', 'Batasan Hills 1', 'QUEZON CITY', '2024-07-28 06:00:00', 'Reserba', NULL, NULL, '2024-07-22 01:59:50', '2024-07-22 01:59:50'),
(81, 'Paul Bautista', 'Bagong Silanganan-asuscion ext.', 'QUEZON CITY', '2024-07-25 06:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 02:02:23', '2024-07-22 02:02:23'),
(82, 'Paul Bautista', 'Batasan hills 2', 'QUEZON CITY', '2024-07-28 10:00:00', 'Reserba', NULL, NULL, '2024-07-22 02:03:25', '2024-07-22 02:03:25'),
(83, 'Jayson Doronio', 'kaingin ext', 'CENTRAL', '2024-07-24 19:00:00', 'Sugo 1', NULL, NULL, '2024-07-22 02:04:37', '2024-07-22 02:04:37'),
(84, 'Nehemias Dungca', 'Pasong Tamo', 'CENTRAL', '2024-07-24 19:00:00', 'Sugo 1', NULL, NULL, '2024-07-22 02:05:46', '2024-07-22 02:05:46'),
(85, 'keith Mangubat', 'Nagkaisang Nayon', 'QUEZON CITY', '2024-07-24 05:45:00', 'Reserba', NULL, NULL, '2024-07-22 02:06:50', '2024-07-22 02:06:50'),
(86, 'keith Mangubat', 'Zabarte-North Olympus ext', 'QUEZON CITY', '2024-07-26 14:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 02:08:37', '2024-07-22 02:08:37'),
(87, 'Zion Mills', 'Caloocan', 'Camanava', '2024-07-25 05:45:00', 'Sugo 2', NULL, NULL, '2024-07-22 02:09:49', '2024-07-23 05:05:12'),
(88, 'Zion Mills', 'Sangandaan', 'Camanava', '2024-07-28 10:00:00', 'Reserba', NULL, NULL, '2024-07-22 02:11:06', '2024-07-23 05:05:45'),
(89, 'Jester Nicolas', 'Araneta', 'QUEZON CITY', '2024-07-25 05:45:00', 'Sugo 2', NULL, NULL, '2024-07-22 02:12:52', '2024-07-22 02:12:52'),
(90, 'Jester Nicolas', 'Batasan Hills 1', 'QUEZON CITY', '2024-07-28 10:00:00', 'Reserba', NULL, NULL, '2024-07-22 02:13:46', '2024-07-22 02:13:46'),
(91, 'Febert Guiang', 'C. Munti', 'Metro Manila South', '2024-07-28 10:00:00', 'Sugo 1', NULL, NULL, '2024-07-22 02:15:30', '2024-07-22 02:15:30'),
(92, 'JM Hizon', 'Saranay', 'Caloocan North', '2024-07-25 05:30:00', 'Sugo', NULL, NULL, '2024-07-22 02:17:18', '2024-07-22 02:17:18'),
(93, 'JM Hizon', 'BS 1', 'Caloocan North', '2024-07-28 06:00:00', 'Reserba', NULL, NULL, '2024-07-22 02:18:05', '2024-07-22 02:18:05'),
(94, 'Michael Samir Shohdy', 'Cupang', 'Metro Manila East', '2024-07-25 05:45:00', 'Sugo 2', NULL, NULL, '2024-07-22 02:42:06', '2024-07-22 02:42:06'),
(95, 'Michael Samir Shohdy', 'SSS-Village-Manseta ext', 'Metro Manila East', '2024-07-28 10:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 02:43:04', '2024-07-22 02:43:04'),
(96, 'Wilrenz Sumang', 'Camella Homes', 'Metro Manila South', '2024-07-24 20:00:00', 'Reserba', NULL, NULL, '2024-07-22 02:44:13', '2024-07-22 02:44:13'),
(97, 'Wilrenz Sumang', 'Alabang', 'Metro Manila South', '2024-07-28 10:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 02:45:00', '2024-07-22 02:45:00'),
(98, 'Marco Acuzar', 'West ave ext. San Francisco', 'QUEZON CITY', '2024-07-24 05:45:00', 'Reserba 1', NULL, NULL, '2024-07-22 05:00:43', '2024-07-22 05:00:43'),
(99, 'Marco Acuzar', 'Galas', 'QUEZON CITY', '2024-07-26 19:00:00', 'Sugo 1', NULL, NULL, '2024-07-22 05:02:05', '2024-07-22 05:02:05'),
(100, 'Alex Cruz', 'Vistan', 'Caloocan North', '2024-07-28 14:00:00', 'Reserba', NULL, NULL, '2024-07-22 05:21:26', '2024-07-22 05:21:26'),
(101, 'Kim Amaro', 'Visayas Ave', 'CENTRAL', '2024-07-24 18:45:00', 'Sugo 2', NULL, NULL, '2024-07-22 05:25:28', '2024-07-22 05:25:28'),
(103, 'Gene Fulminar', 'Pacita', 'CENTRAL', '2024-07-28 10:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 05:27:47', '2024-07-22 05:27:47'),
(104, 'Kim Amaro', 'Pansol ext.', 'CENTRAL', '2024-07-26 19:00:00', 'Reserba', NULL, NULL, '2024-07-22 05:30:51', '2024-07-22 05:30:51'),
(105, 'Danrel Galvez', 'Caballero', 'CENTRAL', '2024-07-26 14:00:00', 'Sugo 1', NULL, NULL, '2024-07-22 05:32:06', '2024-07-22 05:32:06'),
(106, 'Danrel Galvez', 'Luzon ave', 'CENTRAL', '2024-07-24 19:00:00', 'Sugo SL', NULL, NULL, '2024-07-22 05:33:04', '2024-07-22 05:33:04'),
(107, 'Carlo Aspili', 'Cupang', 'Metro Manila East', '2024-07-24 19:30:00', 'Sugo 2', NULL, NULL, '2024-07-22 06:18:44', '2024-07-22 06:18:44'),
(108, 'Carlo Aspili', 'SSS-Village', 'Metro Manila East', '2024-07-25 17:00:00', 'Sugo 2', NULL, NULL, '2024-07-22 06:19:48', '2024-07-22 06:19:48'),
(109, 'Carlo Aspili', 'SSS-Village-Manseta ext', 'Metro Manila East', '2024-07-27 18:20:00', 'Sugo 2', NULL, NULL, '2024-07-22 06:20:58', '2024-07-22 06:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', 'admin', 'felixpareja.pmdit07@gmail.com', NULL, '$2y$12$IpL1AXSs6boAdAcSLNqoUev3IQRrnHKaLg3OmnixdoLX0II4/uI/q', NULL, '2024-06-24 17:20:41', '2024-06-24 17:20:41'),
(2, 'Kim Amaro', 'kamaro', 'kamaro@gmail.com', NULL, '$2y$12$IpL1AXSs6boAdAcSLNqoUev3IQRrnHKaLg3OmnixdoLX0II4/uI/q', NULL, '2024-06-24 18:22:06', '2024-06-24 18:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `verseoftheweek`
--

CREATE TABLE `verseoftheweek` (
  `id` bigint UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `weeknumber` int NOT NULL,
  `verse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verseoftheweek`
--

INSERT INTO `verseoftheweek` (`id`, `date`, `weeknumber`, `verse`, `content`, `created_at`, `updated_at`) VALUES
(1, '2024-06-24', 26, 'Colossians 4:2 CEV', 'Never give up praying. And when you pray, keep alert and be thankful.', '2024-06-23 22:24:01', '2024-06-25 23:41:00'),
(2, '2024-06-25', 27, 'Colossians 4:2 CEV', 'Never give up praying. And when you pray, keep alert and be thankful.', '2024-06-24 23:53:30', '2024-07-02 15:13:51'),
(3, '2024-07-10', 28, 'Colossians 4:2 CEV', '\"Never give up praying. And when you pray, keep alert and be thankful.\"', '2024-07-09 17:59:38', '2024-07-09 17:59:55'),
(4, '2024-07-17', 29, 'Colossians 4:2 CEV', '\"Never give up praying. And when you pray, keep alert and be thankful.\"', '2024-07-17 07:42:54', '2024-07-17 07:43:16'),
(5, '2024-07-22', 30, 'Hebrews 6:10 NIV', 'God is not unjust; he will not forget your work and the love you have shown him as you have helped his people and continue to help them.', '2024-07-22 07:00:39', '2024-07-22 07:00:39');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `broadcast_suguan`
--
ALTER TABLE `broadcast_suguan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `locale_congregations`
--
ALTER TABLE `locale_congregations`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `broadcast_suguan`
--
ALTER TABLE `broadcast_suguan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locale_congregations`
--
ALTER TABLE `locale_congregations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `suguan`
--
ALTER TABLE `suguan`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `verseoftheweek`
--
ALTER TABLE `verseoftheweek`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
