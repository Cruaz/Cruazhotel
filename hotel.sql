-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2024 at 02:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tubes_d_4_hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id_booking` varchar(255) NOT NULL,
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `CheckIn` date NOT NULL,
  `CheckOut` date NOT NULL,
  `Status` enum('Booked','CheckedIn','CheckedOut') NOT NULL,
  `total_harga` double NOT NULL,
  `diskon` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id_booking`, `id_users`, `CheckIn`, `CheckOut`, `Status`, `total_harga`, `diskon`) VALUES
('B002', 1, '2004-12-03', '2005-04-05', 'Booked', 81000, 10),
('B007', 1, '2004-12-03', '2005-04-05', 'Booked', 118226817.9, 10),
('B010', 1, '2024-12-18', '2024-12-19', 'Booked', 118226817.9, 10),
('B011', 2, '2024-12-18', '2024-12-19', 'Booked', 118226817.9, 10),
('B012', 2, '2024-12-16', '2024-12-17', 'Booked', 40500, 10),
('B013', 4, '2024-12-18', '2024-12-19', 'CheckedIn', 119110919.4, 10),
('B014', 6, '2024-12-25', '2024-12-26', 'CheckedOut', 11656178.16, 12),
('B015', 5, '2024-12-24', '2024-12-20', 'CheckedIn', 108455.6, 12),
('B016', 9, '2024-12-19', '2024-12-21', 'Booked', 45000, 10),
('B017', 13, '2024-12-18', '2024-12-19', 'Booked', 45000, 10),
('B018', 15, '2024-12-18', '2024-12-19', 'Booked', 45000, 10),
('B019', 17, '2024-12-18', '2024-12-20', 'Booked', 45000, 10),
('B020', 18, '2024-12-18', '2024-12-19', 'Booked', 45000, 10),
('B021', 6, '2024-12-15', '2024-12-20', 'Booked', 99999.9, 10),
('B022', 20, '2024-12-18', '2024-12-20', 'Booked', 45000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fasilitas`
--

CREATE TABLE `fasilitas` (
  `id_fasilitas` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `namaIcon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fasilitas`
--

INSERT INTO `fasilitas` (`id_fasilitas`, `deskripsi`, `nama`, `namaIcon`) VALUES
('F002', 'agahshagasfsfasfawfa', 'ayam', 'hhhhhhhhhhh'),
('F003', 'agahshagasfsfasfawfa', 'api', 'api'),
('F004', 'afsd', '13243', 'qadsfd'),
('F005', 'adaw', '1111', 'xawda');

-- --------------------------------------------------------

--
-- Table structure for table `galeries`
--

CREATE TABLE `galeries` (
  `id_image` varchar(255) NOT NULL,
  `id_jenises` varchar(255) DEFAULT NULL,
  `id_services` varchar(255) DEFAULT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galeries`
--

INSERT INTO `galeries` (`id_image`, `id_jenises`, `id_services`, `foto`) VALUES
('G001', 'JK002', NULL, 'tqJxrrnVqJTZTW53M7eVjMe2qE2ccib2QBrUbsf6.jpg'),
('G002', NULL, 'JS005', 'tOjMxANI42sW4gwZydyLXr5BHtHa0nI1siVLLA68.jpg'),
('G003', NULL, 'JS005', 'lqebIVMRlygxk3K8SUdkBJIMBsYdiWeosJAuBQ1m.jpg'),
('G004', NULL, 'JS005', 'TsTJQ17QeNoYN1Yar8XhXOYqqBmMrj2CLv7N83qa.jpg'),
('G005', NULL, 'JS005', 'GDYJYgAq5yFLeaKaxpgS5CuHatzOekhEKQojMpQw.jpg'),
('G006', NULL, 'JS005', 'xugjWTXmEg5H5FS7Agcp97JrR1IcNv5rcHXF2gq8.jpg'),
('G007', NULL, 'JS005', 'ujhNkHMRyfFXQK805RykeQgbVbJk4r4XOLRAqmzi.jpg'),
('G008', NULL, 'JS006', 'xPYDBsofcjHaAODigyoKf4xKNZL85saMvbmdQxgq.png');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kamars`
--

CREATE TABLE `jenis_kamars` (
  `id_jenis` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `kapasitas` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `KamarOverview` text NOT NULL,
  `Deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_kamars`
--

INSERT INTO `jenis_kamars` (`id_jenis`, `harga`, `kapasitas`, `nama`, `tipe`, `KamarOverview`, `Deskripsi`) VALUES
('JK001', 132, 12, 'adad', 'Luxury', 'adsffbvb', 'rwesfdfb'),
('JK002', 50000, 2, 'Kamar', 'Luxury', 'Oranng TInggal', 'Orang DIem'),
('JK003', 14214, 3131, 'afawa', 'Luxury', 'ads', 'adsfsd');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_services`
--

CREATE TABLE `jenis_services` (
  `id_service` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `nama` varchar(255) NOT NULL,
  `namaIcon` varchar(255) NOT NULL,
  `harga` double NOT NULL,
  `tipe` tinyint(1) NOT NULL,
  `ServiceOverview` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis_services`
--

INSERT INTO `jenis_services` (`id_service`, `deskripsi`, `nama`, `namaIcon`, `harga`, `tipe`, `ServiceOverview`) VALUES
('JS001', 'adsfdgfgh', 'adsffbvbnn', 'sfdgfgnh', 1345676788, 1, 'asfdgfhg'),
('JS002', 'gagagagdfasgsagasga', 'Ikan2', 'Ikan1', 500000, 0, 'agagagsgagsa'),
('JS003', 'gagagagdfasgsagasga', 'Ikan2', 'Ikan1', 500000, 0, 'agagagsgagsa'),
('JS004', 'asddx', 'qwedsfg', 'sadxvcb', 123345678, 0, 'asdcxv'),
('JS005', 'qewdsfgvcbn', 'dsfghjjkasdsfg', 'wqadsdcxv', 12345, 1, 'qwasdfvcbn'),
('JS006', 'dsfgcbvnm', 'dsfgbvnm', 'weefdghvbn', 1234567, 1, 'dsfcgvbgnm'),
('JS008', 'dsdxvc', '1111', 'hhhhhhhhhhh', 13245, 1, 'sdfbv');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kamars`
--

CREATE TABLE `kamars` (
  `id_kamar` int(11) NOT NULL,
  `id_jenises` varchar(255) NOT NULL,
  `Status` enum('Booked','Available','Maintenence') NOT NULL,
  `lantai` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamars`
--

INSERT INTO `kamars` (`id_kamar`, `id_jenises`, `Status`, `lantai`) VALUES
(2, 'JK002', 'Booked', 2),
(3, 'JK002', 'Maintenence', 5),
(4, 'JK002', 'Maintenence', 2),
(5, 'JK002', 'Maintenence', 2),
(6, 'JK002', 'Booked', 2),
(8, 'JK002', 'Booked', 2),
(9, 'JK002', 'Booked', 2),
(10, 'JK002', 'Booked', 2),
(11, 'JK002', 'Booked', 2),
(12, 'JK002', 'Booked', 2),
(13, 'JK002', 'Booked', 2),
(14, 'JK002', 'Booked', 2),
(15, 'JK002', 'Booked', 2),
(16, 'JK002', 'Booked', 2),
(17, 'JK002', 'Booked', 2),
(18, 'JK002', 'Booked', 2),
(19, 'JK002', 'Booked', 2),
(20, 'JK002', 'Booked', 4),
(21, 'JK002', 'Booked', 7);

-- --------------------------------------------------------

--
-- Table structure for table `kamar_bookeds`
--

CREATE TABLE `kamar_bookeds` (
  `id_kamar_booked` varchar(255) NOT NULL,
  `id_bookings` varchar(255) NOT NULL,
  `id_kamars` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamar_bookeds`
--

INSERT INTO `kamar_bookeds` (`id_kamar_booked`, `id_bookings`, `id_kamars`) VALUES
('KB005', 'B002', 13),
('KB006', 'B007', 4),
('KB012', 'B010', 11),
('KB014', 'B011', 20),
('KB016', 'B012', 19),
('KB017', 'B013', 5),
('KB019', 'B015', 9),
('KB020', 'B016', 16),
('KB021', 'B017', 10),
('KB022', 'B018', 12),
('KB023', 'B019', 6),
('KB024', 'B020', 10),
('KB025', 'B021', 3),
('KB026', 'B022', 13);

-- --------------------------------------------------------

--
-- Table structure for table `kamar_fasilitas`
--

CREATE TABLE `kamar_fasilitas` (
  `id_jeniss` varchar(255) NOT NULL,
  `id_fasilitass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kamar_fasilitas`
--

INSERT INTO `kamar_fasilitas` (`id_jeniss`, `id_fasilitass`) VALUES
('JK001', 'F002'),
('JK002', 'F002'),
('JK002', 'F003'),
('JK003', 'F002');

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
(4, '2024_10_09_062838_create_bookings_table', 1),
(5, '2024_10_09_062904_create_fasilitas_table', 1),
(6, '2024_10_09_062905_create_jenis_kamars_table', 1),
(7, '2024_10_09_062905_create_pemesanans_table', 1),
(8, '2024_10_09_062906_create_kamars_table', 1),
(9, '2024_10_09_062915_create_jenis_services_table', 1),
(10, '2024_10_09_062917_create_kamar_bookeds_table', 1),
(11, '2024_10_09_062918_create_services_table', 1),
(12, '2024_10_09_062956_create_kamar_fasilitas_table', 1),
(13, '2024_10_22_133947_create_galeries_table', 1),
(14, '2024_12_05_163119_create_personal_access_tokens_table', 1);

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
-- Table structure for table `pemesanans`
--

CREATE TABLE `pemesanans` (
  `id_pemesanan` varchar(255) NOT NULL,
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `Tgl_pemesanan` date NOT NULL,
  `Status` enum('Booked','Canceled','Done') NOT NULL,
  `total_harga` double NOT NULL,
  `diskon` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pemesanans`
--

INSERT INTO `pemesanans` (`id_pemesanan`, `id_users`, `Tgl_pemesanan`, `Status`, `total_harga`, `diskon`) VALUES
('P001', 7, '2024-12-17', 'Done', 31109999999.4, 10),
('P002', 6, '2004-12-23', 'Booked', 80999, 10),
('P003', 9, '2024-12-31', 'Canceled', 49999999, 10),
('P004', 2, '2024-12-17', 'Booked', 111461110.2, 10),
('P005', 9, '2024-12-19', 'Booked', 1211559109.2, 10),
('P006', 13, '2024-12-18', 'Booked', 1211109109.2, 10),
('P007', 15, '2024-12-18', 'Booked', 1211109109.2, 10),
('P008', 18, '2024-12-19', 'Booked', 1211559109.2, 10),
('P009', 20, '2024-12-19', 'Booked', 111461110.2, 10);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 1, 'Authentication Token', '6be2e24488ac57f1ca34b7a096bc03223b530a67687ec5ff6dd5634f29b43415', '[\"*\"]', '2024-12-15 10:23:44', NULL, '2024-12-14 21:07:33', '2024-12-15 10:23:44'),
(2, 'App\\Models\\User', 2, 'Authentication Token', 'f286413a8cb71a50f00d09d130ceaba548f8f7d368f8ab10856b35108eac3a5f', '[\"*\"]', '2024-12-15 10:24:49', NULL, '2024-12-15 10:24:24', '2024-12-15 10:24:49'),
(3, 'App\\Models\\User', 2, 'Authentication Token', 'b9f22a950baaaf5ddc7ca83692fd44f1144e3bd442f7718f4b33553b7a214435', '[\"*\"]', NULL, NULL, '2024-12-15 19:38:03', '2024-12-15 19:38:03'),
(4, 'App\\Models\\User', 2, 'Authentication Token', 'fee2d9d8283539b4755d7b5f77d817044a97c03e1627325a5edee178dd6de0c1', '[\"*\"]', NULL, NULL, '2024-12-16 08:58:25', '2024-12-16 08:58:25'),
(5, 'App\\Models\\User', 2, 'Authentication Token', 'dcf46f45683a4aba091876297db16097143c3bdb89ab0cc6c1ba94bef0c74fc2', '[\"*\"]', '2024-12-17 01:56:12', NULL, '2024-12-16 19:20:54', '2024-12-17 01:56:12'),
(6, 'App\\Models\\User', 2, 'Authentication Token', '22e9138dd0a771063f3f7b385ed177c0be6db8236aa097d3157e68afd93a4318', '[\"*\"]', '2024-12-17 08:30:27', NULL, '2024-12-17 02:12:49', '2024-12-17 08:30:27'),
(7, 'App\\Models\\User', 2, 'Authentication Token', 'b69bd0c5d14cf9acc0b010d12fa22d260c9117cac226f8a19fb1bc17052084ff', '[\"*\"]', '2024-12-17 08:32:45', NULL, '2024-12-17 08:25:59', '2024-12-17 08:32:45'),
(8, 'App\\Models\\User', 2, 'Authentication Token', '05fe906d689b6e1cf025bb14a3977f2ff9cfa13f0c84dbddd49ff70bc1d5e096', '[\"*\"]', '2024-12-17 08:37:26', NULL, '2024-12-17 08:33:50', '2024-12-17 08:37:26'),
(9, 'App\\Models\\User', 2, 'Authentication Token', 'd075dcbd7f79f371af505f9180d35fc9eda50ba9cc87224724a5a66963398621', '[\"*\"]', '2024-12-17 13:23:37', NULL, '2024-12-17 12:52:49', '2024-12-17 13:23:37'),
(10, 'App\\Models\\User', 2, 'Authentication Token', 'c7418cfa0df5b122aa136fc4802509aa6e342b031d861ea239ce39f1c8a1331d', '[\"*\"]', '2024-12-17 13:01:49', NULL, '2024-12-17 13:01:35', '2024-12-17 13:01:49'),
(11, 'App\\Models\\User', 9, 'Authentication Token', '5317a46e6644a4030f1a43a829b866bdb2aed034442010ccd568d68835e1feb6', '[\"*\"]', '2024-12-17 13:34:08', NULL, '2024-12-17 13:32:12', '2024-12-17 13:34:08'),
(12, 'App\\Models\\User', 9, 'Authentication Token', '2537ae2eced63b2c7c56e121a4d855b3af61ee3f6440b3d44ba6d32783d0f4d7', '[\"*\"]', '2024-12-17 14:11:38', NULL, '2024-12-17 13:36:21', '2024-12-17 14:11:38'),
(13, 'App\\Models\\User', 2, 'Authentication Token', 'df1d740b9ea00e91672949b51f06d7c73f0c3c9a9593fd17a7731307203e23e6', '[\"*\"]', '2024-12-17 15:27:13', NULL, '2024-12-17 15:03:10', '2024-12-17 15:27:13'),
(14, 'App\\Models\\User', 9, 'Authentication Token', '8778bb821729ab136211e47898915dbae768d2edf75ed9e48ffe4eb809c99b79', '[\"*\"]', '2024-12-17 15:37:01', NULL, '2024-12-17 15:27:22', '2024-12-17 15:37:01'),
(15, 'App\\Models\\User', 13, 'Authentication Token', '390902328301d7b1293797aed2534c87b7a23fb3903a0ef51ed40dbcfe0849d4', '[\"*\"]', NULL, NULL, '2024-12-17 16:46:22', '2024-12-17 16:46:22'),
(16, 'App\\Models\\User', 13, 'Authentication Token', '3adcdfedb6b3e9ca1cea2e29145be6fe2fd82b63f58cb117fc4bace0faf25ce9', '[\"*\"]', '2024-12-17 16:50:59', NULL, '2024-12-17 16:47:11', '2024-12-17 16:50:59'),
(17, 'App\\Models\\User', 14, 'Authentication Token', '4266f1567ce19f9b9c45b3c2405b7e51b8c618f39d41ad7dd5b0544715de867b', '[\"*\"]', '2024-12-17 17:00:54', NULL, '2024-12-17 16:57:28', '2024-12-17 17:00:54'),
(18, 'App\\Models\\User', 14, 'Authentication Token', 'e72e878da16e1d4c9ffc00ed24a4faf2af83f04bbb6d8969a9273e531ea90c7d', '[\"*\"]', '2024-12-17 17:01:51', NULL, '2024-12-17 17:01:02', '2024-12-17 17:01:51'),
(19, 'App\\Models\\User', 2, 'Authentication Token', '97b85e0fc34b78afdaa909fcc128c549096e616033f102276c6ca3b5e5dc9b54', '[\"*\"]', '2024-12-17 17:03:22', NULL, '2024-12-17 17:02:23', '2024-12-17 17:03:22'),
(20, 'App\\Models\\User', 15, 'Authentication Token', '10529adb97f9b5ad8b02df72f3a9e4b2cbbe374f6af786cdbb3d3bd6284bf4b5', '[\"*\"]', '2024-12-17 17:09:36', NULL, '2024-12-17 17:07:19', '2024-12-17 17:09:36'),
(21, 'App\\Models\\User', 16, 'Authentication Token', 'b4cafe42b868b6c5d31fca52e3e217574ce8b9a26c1d322ed37dfe9c81c5f42e', '[\"*\"]', '2024-12-17 17:13:42', NULL, '2024-12-17 17:12:35', '2024-12-17 17:13:42'),
(22, 'App\\Models\\User', 17, 'Authentication Token', 'b8318392cbf1eea525f035fd6c531c70a2703a5be3ddeb9644c75e7c22e9eda1', '[\"*\"]', '2024-12-17 17:15:51', NULL, '2024-12-17 17:14:07', '2024-12-17 17:15:51'),
(23, 'App\\Models\\User', 18, 'Authentication Token', '68738cf356c1625f8de5d946b38ca9d416a85124456fa579ccda5a0aa7ef5cee', '[\"*\"]', '2024-12-17 17:19:56', NULL, '2024-12-17 17:17:53', '2024-12-17 17:19:56'),
(24, 'App\\Models\\User', 2, 'Authentication Token', 'fba54925d69a7641e4e0c0a4c239eb815340ee5874c6c82b5b168a70fb3067f2', '[\"*\"]', '2024-12-17 17:28:24', NULL, '2024-12-17 17:20:14', '2024-12-17 17:28:24'),
(25, 'App\\Models\\User', 20, 'Authentication Token', '389e7aa88a4029ab9632447c81c621e1e83852fce36889cf89cf29d97eaba3c3', '[\"*\"]', '2024-12-17 17:35:27', NULL, '2024-12-17 17:33:17', '2024-12-17 17:35:27'),
(26, 'App\\Models\\User', 21, 'Authentication Token', '3a9b052560a4b7720519e9ced7a1d598bf34abc76f661727439b0c45b238ce10', '[\"*\"]', '2024-12-17 17:54:11', NULL, '2024-12-17 17:54:07', '2024-12-17 17:54:11'),
(27, 'App\\Models\\User', 21, 'Authentication Token', 'e700034f52bb523d9a9754d5728ed177128ba9fc0e33b22f85cb82cd228830dc', '[\"*\"]', '2024-12-17 17:58:47', NULL, '2024-12-17 17:54:17', '2024-12-17 17:58:47'),
(28, 'App\\Models\\User', 21, 'Authentication Token', '2532fd978ae2e41552be2f17edbd2cf95b00f584468983732930401118206124', '[\"*\"]', '2024-12-17 17:59:17', NULL, '2024-12-17 17:58:58', '2024-12-17 17:59:17'),
(29, 'App\\Models\\User', 21, 'Authentication Token', '47ccafa6c9640fedaf13bca202ddd2e6f64795404cf474499931f78cdcf5e418', '[\"*\"]', '2024-12-17 17:59:38', NULL, '2024-12-17 17:59:25', '2024-12-17 17:59:38'),
(30, 'App\\Models\\User', 21, 'Authentication Token', 'affadeae682d5ca5f4b657aebf5f2358a7acefa6e25f93c5add9d03fd2f2c772', '[\"*\"]', '2024-12-17 18:01:17', NULL, '2024-12-17 17:59:46', '2024-12-17 18:01:17'),
(31, 'App\\Models\\User', 21, 'Authentication Token', 'c5f89606c40bee707b8860ad3d8b83b4d69ed2df20d11f39bc6d61afd1caf6fd', '[\"*\"]', '2024-12-17 18:02:21', NULL, '2024-12-17 18:01:28', '2024-12-17 18:02:21'),
(32, 'App\\Models\\User', 21, 'Authentication Token', '4c365484120739defc4bc00d1a25060f2ffea8c2d9002ef5954dc2469bf4da42', '[\"*\"]', '2024-12-17 18:02:30', NULL, '2024-12-17 18:02:29', '2024-12-17 18:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id_pemesanan` varchar(255) NOT NULL,
  `id_services` varchar(255) NOT NULL,
  `Time-Jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id_pemesanan`, `id_services`, `Time-Jumlah`) VALUES
('P001', 'JS006', 10),
('P002', 'JS003', 10),
('P003', 'JS005', 10),
('P004', 'JS002', 10),
('P004', 'JS004', 10),
('P005', 'JS001', 10),
('P005', 'JS002', 10),
('P006', 'JS001', 10),
('P007', 'JS001', 10),
('P008', 'JS001', 10),
('P008', 'JS002', 10),
('P009', 'JS002', 10),
('P009', 'JS004', 10);

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
('mlxoaBXZAsONUrDk1rcjCEzXeXgI4LWxKdG3ISPD', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWFBJTGdBdGFhVWJ1QzFORW5ycW51Zzlxa1AzeFg0dmJFT2VyVWlnVSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1734483749),
('pziHmzh8wuZeJezgKXTzJmcxmlyV2R7kvCIOgO0t', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36 Edg/131.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2hvTjJ6cElLT3ZkU1pxekxtYjFST0ttenJpM1VrUXpiQ1NOTUdNeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9IZWxwIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1734483556);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `noTelp` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `role` tinyint(1) NOT NULL,
  `foto` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `email`, `noTelp`, `email_verified_at`, `password`, `remember_token`, `role`, `foto`) VALUES
(1, 'dawda', 'adwad@gmail.com', '1231312131', NULL, '$2y$12$6T1SiKJMSlsM8OApOR3zrOlBHyZw0d/hvFgWowZVjkOeHkcvABEYa', NULL, 0, '6oFO7nY5XnsYjW8iw7hEnWCLUpJERFl6ZC9C4aYu.webp'),
(2, 'asddfghjhj', 'Test@gmail.com', '0987654321', NULL, '$2y$12$o1l.Kaf37aPl3/Nd223hqezrAAHi1hLnSq6/ta3r4rr2PjZgebU9C', NULL, 1, 'YUNG81eim4fSe7NIu83fLErcQkTAFPpZgmja2AAJ.png'),
(3, '2134567', 'yudistirawirjananta@gmail.com', '123234545676890', NULL, '$2y$12$Z32M46Hfm6p4BGB.f.PGHuCxpX7qf4BHZDP0B6oWFiykeGYkIiEo6', NULL, 1, 'GvV6L3HOizEqCTADEcG8wNvGVlezIXymyIt2x7OI.png'),
(4, 'qwewdfs', 'iwynyudistirawir@gmail.com', '123234545676890', NULL, '$2y$12$twtvp8sEKcoHRcVu/sjK6Od3ACaPAmdC5beJB2dYfT7FA058z4ZSu', NULL, 1, 'Rk4Rcm7trwflyjhfkmCnCwTDgJl2mcEm6gRK3qK6.png'),
(5, '1ewadsfx', 'admin@admin.com', '12334546768789', NULL, '$2y$12$/eJKDCJ.FtzZUdDGsrNIHOardyXoHBkf9Z/SSEqxxVkEklj4ZyeDi', NULL, 0, 'R8fAOqwWXw2tUGfBjc2vS6iveIS8L2dU7sGSExt1.png'),
(6, 'ikan', 'ikan@ikan.com', '123234545676890', NULL, '$2y$12$qvfVK0Ygbqr4oBVo12xja.dM61Mbb6fimrV3THFMEAe9E0TCgri1W', NULL, 1, NULL),
(7, 'ffafa', 'lekong@gmail.com', '0987654321', NULL, '$2y$12$gJaeUzGDmQrCbiigpkBDOOB/7Jidc2u2q8gZH85J55EwQv64Ux/nW', NULL, 0, '4f9fV0ikTQLlvN7VNidA6W5gcgK6ZYj7MT4XdLmW.png'),
(9, 'admin@admin.com', 'babi@gmail.com', '3333345454', NULL, '$2y$12$SMmF4aqPWsXYgwABQBlhX.xsJ31l7jQEs4q3v/SRpa5mcIqUCx/du', NULL, 0, 'xZkGeyaWXau6a6PvBKlwUD5bUSNqIEZxsXllJypa.png'),
(11, 'tata', 'orang@gmail.com', '1234567890', NULL, '$2y$12$LX5lKpFagWunSVsQgwXuAeHbODOH3wtOFqYL2j2MnnmA05QS.RaBu', NULL, 0, 'WcHE1uDfSYeVteUFaqEfqgb7eT4FwVtps4UiKAAl.png'),
(13, 'ewdsffqadsf', 'burung@gmail.com', '133456712345', NULL, '$2y$12$qmmsIWDzhWIIR6LVCmIvkeLJbbHcwjSWuDAjl.DgN7M/TqTT6km8q', NULL, 0, 'A5kB1LyMzJGea7bN6DImQQg7UXBGVoOegmI0N2Pa.png'),
(14, 'fsgd', 'burung2@gmail.com', '12334546768789', NULL, '$2y$12$JtzSu.GNBKaJ9I/F1TUDVO03dq3N1zhfCpXJUz9bJtcIiHW/RWS6a', NULL, 0, '6nej0ZQvYVd6OiYbh93sfEP39xqG5YiSrp1Pfluc.png'),
(15, 'aifoawwam', 'hehe@gmail.com', '23456789121', NULL, '$2y$12$0i.RuRU7v30PvZfVhmtrLuBqSLiNxHfkhJ8ZSSX//8V/7BI0wtBVC', NULL, 0, '34JxRPeAjejDDCXei58GLIWOQxSS5loJWZz6dRlb.png'),
(16, 'samuell', 'samuell@gmail.com', '08987654321', NULL, '$2y$12$tXGcZni03kbo7t1Bxy9xG.iUNQIvbLeJWU60bQywEjCfgMQq/ueS.', NULL, 0, NULL),
(17, 'yesyes', 'yes@gmail.com', '08214121321', NULL, '$2y$12$D7CYMrZ6yEvmMmHLK44zfuOoyUjLyTHbbAluZSuWqRzHJxePCewBC', NULL, 0, NULL),
(18, 'eheheh', 'ehehehe@gmail.com', '08413213121', NULL, '$2y$12$xDd94ftcqlNid9L84xIW5uwNm.5M7KSK5XYK5xY57vkJmGPISjRPW', NULL, 0, 'RBZS4n4c9p1ZXJN385z9MeoZ4NwvcyKK0nJGdz7Q.png'),
(19, 'adfsgf', 'orangP@gmail.com', '12345677899', NULL, '$2y$12$gaIPhOVzyy.LF1zQ5yeG..lzVTAmaATj.Xr1xgthn3sxr5NSmqMSW', NULL, 0, 'tFv8Fynm4ddkLug4QzKpITSQBUpcxTIJwV3q2UIo.png'),
(20, 'dawdawww', 'ikangoreng@gmail.com', '08312311212', NULL, '$2y$12$dh/XbK/cV6a9Dem2P39Ch.wH/yKpVuOHKUYvBbPkt3g6dLT6DTozy', NULL, 0, 'lgwAVPrGGfBmJvWJVUGgsGpjuQQfIuCZtffUuOu2.png'),
(21, 'fafwafa', 'ayam@gmail.com', '1231312131', NULL, '$2y$12$shmTAHrvvmZyd3hswzVTZOKDFv6HUvvIffNaiklCKYd20wMkRf.Jm', NULL, 0, 'SzIoLUbzJdMPO3ljN07UFYYn28yel123QZGMl7JS.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `bookings_id_users_foreign` (`id_users`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fasilitas`
--
ALTER TABLE `fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `galeries`
--
ALTER TABLE `galeries`
  ADD PRIMARY KEY (`id_image`),
  ADD KEY `galeries_id_jenises_foreign` (`id_jenises`),
  ADD KEY `galeries_id_services_foreign` (`id_services`);

--
-- Indexes for table `jenis_kamars`
--
ALTER TABLE `jenis_kamars`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `jenis_services`
--
ALTER TABLE `jenis_services`
  ADD PRIMARY KEY (`id_service`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kamars`
--
ALTER TABLE `kamars`
  ADD PRIMARY KEY (`id_kamar`),
  ADD KEY `kamars_id_jenises_foreign` (`id_jenises`);

--
-- Indexes for table `kamar_bookeds`
--
ALTER TABLE `kamar_bookeds`
  ADD PRIMARY KEY (`id_kamar_booked`),
  ADD KEY `kamar_bookeds_id_bookings_foreign` (`id_bookings`),
  ADD KEY `kamar_bookeds_id_kamars_foreign` (`id_kamars`);

--
-- Indexes for table `kamar_fasilitas`
--
ALTER TABLE `kamar_fasilitas`
  ADD PRIMARY KEY (`id_jeniss`,`id_fasilitass`),
  ADD KEY `kamar_fasilitas_id_fasilitass_foreign` (`id_fasilitass`);

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
-- Indexes for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD PRIMARY KEY (`id_pemesanan`),
  ADD KEY `pemesanans_id_users_foreign` (`id_users`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id_pemesanan`,`id_services`),
  ADD KEY `services_id_services_foreign` (`id_services`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `galeries`
--
ALTER TABLE `galeries`
  ADD CONSTRAINT `galeries_id_jenises_foreign` FOREIGN KEY (`id_jenises`) REFERENCES `jenis_kamars` (`id_jenis`) ON DELETE CASCADE,
  ADD CONSTRAINT `galeries_id_services_foreign` FOREIGN KEY (`id_services`) REFERENCES `jenis_services` (`id_service`) ON DELETE CASCADE;

--
-- Constraints for table `kamars`
--
ALTER TABLE `kamars`
  ADD CONSTRAINT `kamars_id_jenises_foreign` FOREIGN KEY (`id_jenises`) REFERENCES `jenis_kamars` (`id_jenis`) ON DELETE CASCADE;

--
-- Constraints for table `kamar_bookeds`
--
ALTER TABLE `kamar_bookeds`
  ADD CONSTRAINT `kamar_bookeds_id_bookings_foreign` FOREIGN KEY (`id_bookings`) REFERENCES `bookings` (`id_booking`) ON DELETE CASCADE,
  ADD CONSTRAINT `kamar_bookeds_id_kamars_foreign` FOREIGN KEY (`id_kamars`) REFERENCES `kamars` (`id_kamar`) ON DELETE CASCADE;

--
-- Constraints for table `kamar_fasilitas`
--
ALTER TABLE `kamar_fasilitas`
  ADD CONSTRAINT `kamar_fasilitas_id_fasilitass_foreign` FOREIGN KEY (`id_fasilitass`) REFERENCES `fasilitas` (`id_fasilitas`) ON DELETE CASCADE,
  ADD CONSTRAINT `kamar_fasilitas_id_jeniss_foreign` FOREIGN KEY (`id_jeniss`) REFERENCES `jenis_kamars` (`id_jenis`) ON DELETE CASCADE;

--
-- Constraints for table `pemesanans`
--
ALTER TABLE `pemesanans`
  ADD CONSTRAINT `pemesanans_id_users_foreign` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_id_pemesanan_foreign` FOREIGN KEY (`id_pemesanan`) REFERENCES `pemesanans` (`id_pemesanan`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_id_services_foreign` FOREIGN KEY (`id_services`) REFERENCES `jenis_services` (`id_service`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
