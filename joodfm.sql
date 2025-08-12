-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2025 at 01:44 PM
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
-- Database: `joodfm`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_logos`
--

CREATE TABLE `client_logos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_logos`
--

INSERT INTO `client_logos` (`id`, `name`, `image`, `created_at`, `updated_at`) VALUES
(5, 'new', 'uploads/profiles/uho6g7TiQEOedCMdpVzcD5TCot5RNJZ2BsZDEa7t.jpg', '2025-07-30 14:22:31', '2025-07-31 05:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2014_10_12_000000_create_users_table', 2),
(6, '2025_06_23_092142_create_permission_tables', 3),
(7, '2025_06_16_110518_create_organizations_table', 4),
(8, '2025_06_20_094150_create_internals_table', 5),
(9, '2025_06_21_100704_create_invitations_table', 5),
(10, '2025_06_19_112321_create_organization_user_table', 6),
(11, '2025_06_24_070718_create_settings_table', 7),
(12, '2025_06_18_093346_create_categories_table', 8),
(13, '2025_06_18_093443_create_inventories_table', 9),
(14, '2025_06_26_090515_create_recipients_table', 10),
(15, '2025_06_18_093346_create_inventory_services_table', 11),
(16, '2025_06_30_120737_create_requests_table', 12),
(17, '2025_06_30_120935_create_donation_requests_table', 12),
(18, '2025_07_02_074401_create_attributes_table', 13),
(20, '2025_07_05_085453_create_subscribers_table', 14),
(21, '2025_07_10_075817_create_family_members_table', 15),
(22, '2025_07_10_091126_create_family_relations_table', 16),
(24, '2025_07_10_113345_create_attribute_options_table', 17),
(25, '2025_07_15_080629_create_invertory_items_table', 18),
(26, '2025_07_30_154640_create_client_logos_table', 19);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, '	App\\Models\\User', 1),
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 118),
(2, 'App\\Models\\User', 119),
(3, 'App\\Models\\User', 121),
(4, 'App\\Models\\User', 120),
(4, 'App\\Models\\User', 122),
(4, 'App\\Models\\User', 123),
(4, 'App\\Models\\User', 124),
(6, 'App\\Models\\User', 113),
(6, 'App\\Models\\User', 114),
(6, 'App\\Models\\User', 115),
(6, 'App\\Models\\User', 116),
(6, 'App\\Models\\User', 117);

-- --------------------------------------------------------

--
-- Table structure for table `module_lists`
--

CREATE TABLE `module_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_lists`
--

INSERT INTO `module_lists` (`id`, `name`, `created_at`, `updated_at`) VALUES
(6, 'organization', '2025-06-30 03:51:25', '2025-06-30 03:51:25'),
(7, 'internal', '2025-06-30 04:04:44', '2025-06-30 04:04:44'),
(8, 'invitation', '2025-06-30 04:06:27', '2025-06-30 04:06:27'),
(9, 'inventory', '2025-06-30 04:15:52', '2025-06-30 04:15:52'),
(10, 'service', '2025-06-30 04:17:14', '2025-06-30 04:17:14'),
(11, 'attribute', '2025-06-30 04:19:55', '2025-06-30 04:19:55'),
(12, 'request', '2025-06-30 04:20:21', '2025-06-30 04:20:21'),
(13, 'donor', '2025-06-30 04:20:29', '2025-06-30 04:20:29'),
(14, 'recipient', '2025-06-30 05:31:39', '2025-06-30 05:31:39'),
(15, 'family member', '2025-06-30 05:49:30', '2025-06-30 05:49:30'),
(16, 'permission', '2025-07-05 01:23:55', '2025-07-05 01:23:55'),
(18, 'role', '2025-07-05 01:44:30', '2025-07-05 01:44:30'),
(32, 'user', '2025-07-19 13:26:34', '2025-07-19 13:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1282, 'access organization', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1283, 'create organization', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1284, 'edit organization', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1285, 'view organization', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1286, 'delete organization', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1287, 'access internal', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1288, 'create internal', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1289, 'edit internal', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1290, 'view internal', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1291, 'delete internal', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1292, 'access invitation', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1293, 'create invitation', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1294, 'edit invitation', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1295, 'view invitation', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1296, 'delete invitation', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1297, 'access inventory', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1298, 'create inventory', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1299, 'edit inventory', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1300, 'view inventory', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1301, 'delete inventory', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1302, 'access service', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1303, 'create service', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1304, 'edit service', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1305, 'view service', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1306, 'delete service', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1307, 'access attribute', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1308, 'create attribute', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1309, 'edit attribute', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1310, 'view attribute', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1311, 'delete attribute', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1312, 'access request', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1313, 'create request', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1314, 'edit request', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1315, 'view request', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1316, 'delete request', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1317, 'access donor', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1318, 'create donor', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1319, 'edit donor', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1320, 'view donor', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1321, 'delete donor', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1322, 'access recipient', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1323, 'create recipient', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1324, 'edit recipient', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1325, 'view recipient', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1326, 'delete recipient', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1327, 'access family member', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1328, 'create family member', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1329, 'edit family member', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1330, 'view family member', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1331, 'delete family member', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1332, 'access permission', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1333, 'create permission', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1334, 'edit permission', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1335, 'view permission', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1336, 'delete permission', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1337, 'access role', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1338, 'create role', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1339, 'edit role', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1340, 'view role', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1341, 'delete role', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1342, 'access user', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1343, 'create user', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1344, 'edit user', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1345, 'view user', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1346, 'delete user', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1347, 'access setting', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1348, 'access site-setting', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1349, 'access donation-polices', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1350, 'access google-api', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46'),
(1351, 'access invitation-hours', 'web', '2025-07-19 08:53:46', '2025-07-19 08:53:46');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `guard_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-06-23 04:33:20', '2025-06-23 04:33:20'),
(2, 'internal', 'web', '2025-06-23 04:33:20', '2025-06-23 04:33:20'),
(3, 'donor', 'web', '2025-06-23 04:33:20', '2025-06-23 04:33:20'),
(4, 'recipient', 'web', '2025-06-23 04:33:20', '2025-06-23 04:33:20'),
(6, 'organization', 'web', '2025-06-23 04:33:20', '2025-06-23 04:33:20');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1282, 1),
(1282, 2),
(1283, 1),
(1284, 1),
(1285, 1),
(1286, 1),
(1287, 1),
(1287, 2),
(1288, 1),
(1289, 1),
(1290, 1),
(1291, 1),
(1292, 1),
(1293, 1),
(1294, 1),
(1295, 1),
(1296, 1),
(1297, 1),
(1298, 1),
(1299, 1),
(1300, 1),
(1301, 1),
(1302, 1),
(1303, 1),
(1304, 1),
(1305, 1),
(1306, 1),
(1307, 1),
(1308, 1),
(1309, 1),
(1310, 1),
(1311, 1),
(1312, 1),
(1313, 1),
(1314, 1),
(1315, 1),
(1316, 1),
(1317, 1),
(1318, 1),
(1319, 1),
(1320, 1),
(1321, 1),
(1322, 1),
(1323, 1),
(1324, 1),
(1325, 1),
(1326, 1),
(1327, 1),
(1328, 1),
(1329, 1),
(1330, 1),
(1331, 1),
(1332, 1),
(1333, 1),
(1334, 1),
(1335, 1),
(1336, 1),
(1337, 1),
(1338, 1),
(1339, 1),
(1340, 1),
(1341, 1),
(1342, 1),
(1343, 1),
(1344, 1),
(1345, 1),
(1346, 1),
(1347, 1),
(1348, 1),
(1349, 1),
(1350, 1),
(1351, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `val` longtext DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `val`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'site_title', 'joodfm', NULL, '2025-06-25 07:53:34', '2025-07-23 14:21:50'),
(2, 'site_logo_desktop', 'uploads/settings/1753299391_logo.png', NULL, '2025-06-25 04:45:46', '2025-07-23 14:36:31'),
(3, 'site_logo_mobile', 'uploads/settings/1753299155_logo-icon.jpg', NULL, '2025-06-25 04:45:46', '2025-07-23 14:32:35'),
(4, 'site_logo_icon', 'uploads/settings/1751095391_fav-icon.png', NULL, '2025-06-25 04:45:46', '2025-06-28 02:23:11'),
(5, 'site_favicon', 'uploads/settings/1753299235_fav.png', NULL, '2025-06-25 04:45:46', '2025-07-23 14:33:55'),
(6, 'admin_email', 'info@joodfm.com', NULL, '2025-06-26 03:11:24', '2025-07-23 14:21:50'),
(7, 'record_per_page', '20', NULL, '2025-06-26 03:11:24', '2025-06-26 03:13:37'),
(8, 'google_map_api', 'AIzaSyBuVuGK7NAlADnDUmzIn6xMd-z24dcXr_A', NULL, '2025-06-26 03:13:21', '2025-06-26 03:13:37'),
(9, 'google_map_radius', '100', NULL, '2025-06-27 01:26:22', '2025-06-27 01:26:22'),
(10, 'invitation_expire', '24', NULL, '2025-06-30 03:40:00', '2025-06-30 03:40:00'),
(11, 'google_map_zoom', '34', NULL, '2025-07-15 04:06:53', '2025-07-15 04:06:53'),
(12, 'donation_request_day_limit', '23', NULL, '2025-07-15 04:10:21', '2025-07-15 04:10:21'),
(13, 'donation_request_limit', '342', NULL, '2025-07-15 04:10:21', '2025-07-15 04:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) NOT NULL,
  `profile_image` varchar(191) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `profile_image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin1', 'admin@themesbrand.com', NULL, '$2y$10$jjEXi6mkMlYMg.20bRhbZOnr5UCSso0JJgYUjzeP5k4Jug9uohU3q', 'uploads/profiles/1753298528_logo.png', 'hXca4ZVl2DpajWYbfWyQQCK1HJnodfCkVAynNOEJAP67vlpFZ9uNZPtQKK34', '2025-06-23 04:17:58', '2025-07-23 14:22:08'),
(12, 'jamshedalam', 'org2@gmail.com', NULL, '$2y$10$zbYSejr7RuVxV4qePuT90eWDkQjqLysPfs37eyqFX.ZsqbYst8r7W', NULL, NULL, '2025-06-24 07:12:33', '2025-06-24 07:12:33'),
(15, 'int', 'int5@gmail.com', NULL, '$2y$10$B2ycMUb6ayvHyL9kfXYqduVrHGjh4I2SyK0YSUy3zifPyOwsKxg3y', NULL, NULL, '2025-06-24 08:35:36', '2025-06-24 08:35:36'),
(16, 'jamshedalam', 'int10@gmail.com', NULL, '$2y$10$IARQKH6alttOlx7mOdaz9OPt5gHwmWSMyBGKeoOYCnqHZoaWVJPES', NULL, NULL, '2025-06-24 08:36:48', '2025-06-24 08:36:48'),
(49, 'sds fweq', 'sdfdf@dfsdf.com', NULL, '$2y$10$jaF486wvV0nyc.01plPLs.ngnfyMD5DsBd6n2RF81QgnG0N1U45CK', NULL, NULL, '2025-06-28 08:32:28', '2025-06-28 08:32:28'),
(50, 'sda wewe', 'sasd@sdfsd.com', NULL, '$2y$10$vjk3wb5cPvdX0sH/cyOaNuVk.PHHYYr6pTCLCf1JfyVYM2rvagtuO', NULL, NULL, '2025-06-28 08:35:23', '2025-06-28 08:35:23'),
(53, 'dfdsf erere', 'sdasdas@gmail.com', NULL, '$2y$10$lS0mLvICDW5TWxJKNU422unObFyQS1oFOzTDSz3ywzOscQwH5zA6K', NULL, NULL, '2025-06-28 08:38:33', '2025-06-28 08:38:33'),
(61, 'jamshed alam', 'org16@gmail.com', NULL, '$2y$10$V4U9ZDd9AVUtTQcdQU.1VOUTDXxzrJ9yMaY.QhLpPIzUKBRDJknDe', NULL, NULL, '2025-07-01 04:31:05', '2025-07-01 04:31:05'),
(62, 'jamshed alam', 'rep2@gmail.com', NULL, '$2y$10$3Lm7wwjAKxVqKTn0zMkc5.N.bBsC5VA1NLDj4vXLikHxbcKk/aLju', NULL, NULL, '2025-07-01 05:46:31', '2025-07-01 05:46:31'),
(67, 'test', 'test@gmail.com', NULL, '$2y$10$mtXjuvKF0YD.G3tc55N...BpjqSqSN.Kmqt2c4RoBUpmfEAOQaGZa', NULL, NULL, '2025-07-03 05:32:50', '2025-07-03 05:32:50'),
(69, 'Ali', 'check11@gmail.com', NULL, '$2y$10$BDS6gGmQyqFCX3bZx5QQ0eTh0ESl3s1Rk6adX1deRlIRPLDj2H9YO', NULL, NULL, '2025-07-04 09:26:23', '2025-07-04 09:26:23'),
(71, 'jamshed alam', 'subs@gmail.com', NULL, '$2y$10$JPgtgjipAoggaF2CABfEsegAqIIn/l8M6ag7cf1t5ToULWYK6Rub2', NULL, NULL, '2025-07-05 05:12:54', '2025-07-05 05:12:54'),
(77, 'jamshed alam', 'subs1@gmail.com', NULL, '$2y$10$4FA2mGRS..kZhjY0OknG6ezf2t3f61imcPIvW4WJ5j/2uibseIQ1i', NULL, NULL, '2025-07-05 05:45:27', '2025-07-05 05:45:27'),
(78, 'jamshed alam', 'subs10@gmail.com', NULL, '$2y$10$vI8EubrPei7CVrtQG8M1wOPjMhS3J.sr8gfmLesJy9wDqqDKTHeta', NULL, NULL, '2025-07-05 05:46:32', '2025-07-05 05:46:32'),
(80, 'org', 'org20@gmail.com', NULL, '$2y$10$kdkDOutSwplePWUVQm/Y5.rrB.JkctSV4yMjpJs1orc8wcmtcmhkK', 'uploads/profiles/1751715363_1500x500.jpg', NULL, '2025-07-05 06:36:03', '2025-07-05 06:36:03'),
(82, 'org21@gmail.com', 'org21@gmail.com', NULL, '$2y$10$b3Q6fb314VcHTQC.E24iOe9w5ttF7ceyeqw/atk1hgFV7j6KWX3K2', 'uploads/profiles/1751888978_image-4.jpg', NULL, '2025-07-07 06:49:38', '2025-07-07 06:49:38'),
(84, 'test last', 'donor20@gmail.com', NULL, '$2y$10$NgtYM4cx1Xa4mhALjNe1R.PECb.w3Po0rERzL9T0Ja62T2xwAWCna', NULL, NULL, '2025-07-08 01:39:06', '2025-07-08 01:39:06'),
(85, 'jamshed alam', 'recep100@gmail.com', NULL, '$2y$10$gZHmeTXJBhI5PgYagxKtpuhc9gNCY.c//m2NsnBz2WT7zgapeWklW', NULL, NULL, '2025-07-08 02:35:21', '2025-07-08 02:35:21'),
(86, 'jamshed alam', 'vendor101@gmail.com', NULL, '$2y$10$zQw1ncs3okOaHZqJEQOWleQ5oZ9iLQdJnXrINwwn8ssRTiyytH5dy', NULL, NULL, '2025-07-08 02:38:25', '2025-07-08 02:38:25'),
(87, 'jamshed alam', 'subs100@gmial.com', NULL, '$2y$10$lWJ17Yj56fqjW8jhMkZcVeoF0gkzVikxqRwM4TN5eGBM79irlQv6K', NULL, NULL, '2025-07-08 03:13:21', '2025-07-08 03:13:21'),
(88, 'sdff dfsdf', 'sdasdasdsdsd@gmail.com', NULL, '$2y$10$qxHtCux3Nh0qJuYt9a9pteYAKGFPYo5F7z6GGvkfCpbZ/B7WpTdsu', NULL, NULL, '2025-07-08 03:15:11', '2025-07-08 03:15:11'),
(89, 'jamshed alam', 'vendor11111@gmail.com', NULL, '$2y$10$QVXvIbIBSs0D2h7Q4znlNuoMeRoW4k82ZDvLYMdE1hGvtCp0bj2kK', NULL, NULL, '2025-07-08 03:22:10', '2025-07-08 03:22:10'),
(90, 'jamshed alam', 'int123@gmail.com', NULL, '$2y$10$yhahVwqF8wQ/p42uZOyKO.85eqmCOJJOhxAyteCAIQvWiVRUGUHPS', NULL, NULL, '2025-07-08 03:27:08', '2025-07-08 03:27:08'),
(91, 'werwe` erter', 'asdasdsda@qweq.com', NULL, '$2y$10$/mR9X4Uio/7wXqSc9isy/.SDbL1dl81/.uucT8rX4KvZdmj0WBAZm', NULL, NULL, '2025-07-09 04:12:16', '2025-07-09 04:12:16'),
(92, 'sdasd erwer', 'sf24@gmail.com', NULL, '$2y$10$OcBiNkmIzyNrj6kNlKZx8ege8gSbNQcECb0JH02XChqezo/JmIzXO', NULL, NULL, '2025-07-09 05:11:24', '2025-07-09 05:11:24'),
(93, 'wee qeqwe', 'sdsadsad232123@gmail.com', NULL, '$2y$10$jI/LuKzMc0ceYEW8oAtEs..XkWHhBOp0jjRyRpfdFLMOGoiSxSR5a', NULL, NULL, '2025-07-09 05:19:20', '2025-07-09 05:19:20'),
(94, 'jamshed alam', 'vendor1@gmail.com', NULL, '$2y$10$yIMK/6nkqkLupXKKawIsIul7OyTSvMva/xTpspFDni1uE51MEg6Eq', NULL, NULL, '2025-07-09 06:21:55', '2025-07-09 06:21:55'),
(95, 'jamshed alam', 'sadsad342@gmail.com', NULL, '$2y$10$oLa2xXEXgdcniF3x5sx0neZ7t9ZhHdZpY/Lp9X0j/aWziGafKCAlu', NULL, NULL, '2025-07-09 06:24:31', '2025-07-09 06:24:31'),
(96, 'jamshed alam', 'sas234234@gmail.com', NULL, '$2y$10$vQS8uWErWY3cdErZxv7GrOnkZm7lghQOGC8JQF.5FEUm3EAkx/tQS', NULL, NULL, '2025-07-09 06:26:19', '2025-07-09 06:26:19'),
(97, 'jamshed alam', 'vendor343@gmail.com', NULL, '$2y$10$tsMf.N7gOCUYBZPghg9u7.BAPNClCe0eNxh/HXnBqozQsNRJ3TW5C', NULL, NULL, '2025-07-09 08:23:55', '2025-07-09 08:23:55'),
(98, 'jamshed alam', 'vendor344@gmail.com', NULL, '$2y$10$RU4dghbGe7G8R6yeDHs7/Oq06w.S4PtPMptu8sdjgU1sKHp/l1oKG', NULL, NULL, '2025-07-09 08:24:57', '2025-07-09 08:24:57'),
(99, 'werwer alam', 'adeel@gmail.com', NULL, '$2y$10$pTl6q/vJ94bkeEYEfHyeEuoZHqgFX4PJ/y6BteuoH7kFsEmo96NzW', NULL, NULL, '2025-07-09 09:11:53', '2025-07-09 09:11:53'),
(100, 'aweqw erer', 'wqweqw@gmail.com', NULL, '$2y$10$Y8ZIGgKijkmIKeg7xD9kUuxjSpV/aX9v.4PYkjH9JFT.il32C/Dre', NULL, NULL, '2025-07-09 09:14:08', '2025-07-09 09:14:08'),
(101, 'qqweqw weqwe', 'qweqwe8787@gmail.com', NULL, '$2y$10$oOxLAqMvslSHASpU6QolFup/tVoDDpDJf/kteWmMf3ARmVgdzQA/G', NULL, NULL, '2025-07-09 09:16:07', '2025-07-09 09:16:07'),
(102, 'jamshed alam', '423423qwwe@gmail.com', NULL, '$2y$10$mmMxqefq88ndATeAygsbaujcIWNBJObe3gJR.QO0mwb1b9JjlGI3m', NULL, NULL, '2025-07-09 09:17:44', '2025-07-09 09:17:44'),
(103, 'qweqwe wewer', '32423@gmail.com', NULL, '$2y$10$27hbi2AhhniTRfDRlqAPse/0oiHGrAxv5uqNQt4n..Kq6oOIclAI2', NULL, NULL, '2025-07-10 05:50:17', '2025-07-10 05:50:17'),
(104, 'jameel ahmed', 'jameel110@gmail.com', NULL, '$2y$10$B6gnP8PPJDg.21h07/wE8u.Is46RO9CjD6601tlv0rXfjo6/QYADu', NULL, NULL, '2025-07-11 06:07:06', '2025-07-11 06:07:06'),
(105, 'Jamshed Alam', 'werwer@gmail.com', NULL, '$2y$10$UQw/zaRlBzXMo.pSvcghZuYFxNyq6zo4X3ZsKp64uS9KKEOAHsorW', NULL, NULL, '2025-07-18 08:13:46', '2025-07-18 08:13:46'),
(106, 'Jamshed Alam', '1111@gmail.com', NULL, '$2y$10$/mu4.AlhW8cWwGUe0G7U7O5mLh7oVJjorw.dJAVojeriW4qJnGu42', NULL, NULL, '2025-07-19 02:14:00', '2025-07-19 02:14:00'),
(107, 'sdasd dfwerfe', '111444@gmail.com', NULL, '$2y$10$Ap5cTKVYKmZHYurTig5GQ.qYFaJeBnILSjJB1.vDTVSvGn.cV/Ye6', NULL, NULL, '2025-07-19 02:31:23', '2025-07-19 02:31:23'),
(108, 'sads eerw', '323434@gmail.com', NULL, '$2y$10$Ky0L12r0lpifuq9V1v8P5u9zv967lB9ApriHBpO7OJe7pouZt2Dpi', NULL, NULL, '2025-07-19 02:52:03', '2025-07-19 02:52:03'),
(109, 'sads eerw', '3234343@gmail.com', NULL, '$2y$10$McgH9bQ55Kt4JcOKVFPRhO/zmuI.0MyW8jym9gcy5LdKmPhsq2xG2', NULL, NULL, '2025-07-19 02:57:39', '2025-07-19 02:57:39'),
(110, 'first last', '233231@gmail.com', NULL, '$2y$10$RUBKBwU6FYAtEF4Tn4IIP.ZaorrYoxOQhgS8/88nHy6ZUy9WiT3m.', NULL, NULL, '2025-07-19 03:23:50', '2025-07-19 03:23:50'),
(111, 'erwere wewew', '534534@gmail.com', NULL, '$2y$10$TUnyI4EZZCZGoECKhc0P4u0aeGTkrR4zFVvGpzEd/s5NIGWtgg12S', NULL, NULL, '2025-07-19 03:25:55', '2025-07-19 03:25:55'),
(112, 'werwer 34345', '32423423@gmail.com', NULL, '$2y$10$SeAaswYumltV6Z6F3LlMNe9mvxy59wVAaO8Pl7ziWMak.4lTtPGZi', NULL, NULL, '2025-07-19 03:28:06', '2025-07-19 03:28:06'),
(116, 'Jamshed Alam', 'jam@gmail.com', NULL, '$2y$10$ylJu5lH2kKJ75rGLkqdDEuKN9Bw.Gp19Rh5bpvrF2bSp0KqEmPmES', '', 'MK94u4dH5khmDnAIvqf8rPG6XYTNpTMYPfxvtpfNZuGHyEZCJ9WA9285hsn5', '2025-07-19 06:39:37', '2025-07-19 06:39:37'),
(117, 'jamshed alam', 'asdasdadasd@gmail.com', NULL, '$2y$10$f2KFWYsg3J/gZ8iJhC/dbOR.cnnd.N6gjyUczZ.nanu3SLmphXNny', '', NULL, '2025-07-19 06:44:09', '2025-07-19 06:44:09'),
(118, 'jamshedalam', 'dads@dfsdfs.com', NULL, '$2y$10$60hUHA2oWt6whuBpIdXEbuEjhz4y86RHVnRpglQ2MipzTRAVHXRu.', NULL, NULL, '2025-07-19 08:45:20', '2025-07-19 08:45:20'),
(119, 'ewe4334', '43434343@gmail.com', NULL, '$2y$10$fVWhseR3RiRw4TMzfWJfpOXO1OjmXA8ZpeKJdwzOGXIM3nZN8KCfu', NULL, NULL, '2025-07-19 08:47:48', '2025-07-19 08:47:48'),
(120, 'fdf ewer', '45345@gmail.com', NULL, '$2y$10$KswQLCWhChobezmBNM4Y2OUMowesmQtBMF70HJ9ytPZEh/9V34UEK', NULL, NULL, '2025-07-21 07:17:18', '2025-07-21 07:17:18'),
(121, 'erewr erfwerw', '43453454@gmail.com', NULL, '$2y$10$3HQUun8izhszajit49VHE.wHekzPfskKwQJSpO8bC7y8z5ajG.xmW', NULL, NULL, '2025-07-21 10:13:59', '2025-07-21 10:13:59'),
(124, 'asdas ewer', '34234234@gmail.com', NULL, '$2y$10$yPeQplxJoCoBLVIP6fbYiu9Wh2jxOP6MDuA2khARBAvuEDJhoGu/O', NULL, NULL, '2025-07-22 04:52:52', '2025-07-22 04:52:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_logos`
--
ALTER TABLE `client_logos`
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
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `module_lists`
--
ALTER TABLE `module_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `client_logos`
--
ALTER TABLE `client_logos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `module_lists`
--
ALTER TABLE `module_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1352;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
