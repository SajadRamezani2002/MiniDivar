-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2025 at 03:38 AM
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
-- Database: `minidivar`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `price` bigint(20) UNSIGNED DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `title`, `price`, `city`, `status`, `description`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'تست', 515615, 'Bochum', 'active', '.......................', 2, 7, '2025-12-01 07:00:05', '2025-12-01 07:05:37'),
(3, 'گوشی', 9200000, 'تهران', 'active', 'با سلام\r\nگوشی در حد آکبند کلا دو ماه کار کرده بدون کوچیکه تمرین باز شدگی و مشکلی', 9, 1, '2025-12-01 14:57:03', '2025-12-01 14:57:24'),
(4, 'فرش دستباف', 370000, 'بیرجند', 'active', 'فرش دستباف بدون کوچیکه تمرین پارکی و مشکلی کاملا سالم و با قدمت بالا', 9, 6, '2025-12-01 14:58:32', '2025-12-01 14:58:57'),
(5, 'موتور هندا 1403', 7800000, 'اصفهان', 'active', 'موتور هندا 1403 احسان\r\nدر حد بدون ضربه و تصادف تمامی مدارک کامل کارت سوخت ،موتور،سند و...', 9, 9, '2025-12-01 15:00:30', '2025-12-01 15:06:05'),
(6, 'سگ ژرمن', 370000, 'زاهدان', 'active', 'سلام\r\nسگ تربیت شده با نژاد جهت اطلاعات بیشتر تماس بگیرید فقط', 9, 15, '2025-12-01 15:02:22', '2025-12-01 15:06:07'),
(7, 'ماشین لیفان 620', 57000000, 'شیراز', 'active', 'با سلام\r\nماشین در حد با کارکرد پایین\r\nوضعیت بدنه بیرنگ شاسی پلمپ بدون کوچیکه تربن خط و خش\r\nبازدید=خرید', 9, 8, '2025-12-01 15:03:51', '2025-12-01 15:06:15'),
(8, 'کفش چرم', 80000, 'مشهد', 'active', 'با سلام\r\nکفش های چرم در تمامی سایز ها و مدل ها با ضمانت اصلی بودن', 9, 17, '2025-12-01 15:05:48', '2025-12-01 15:06:16'),
(9, 'لوستر', 2500000, 'تبریز', 'active', 'با سلام\r\nلوستر در تمامی طرح ها و اندازه\r\nبا نصب رایگان\r\nشرایط اقساط 👇 \r\n18 ماه بدون کارمزد از دم قسط\r\nجهت اطلاعات بیشتر تماس حاصل فرمایید.', 9, 5, '2025-12-01 15:08:36', '2025-12-01 15:10:08'),
(10, 'بلیط کنسرت', 50000, 'تهران', 'rejected', 'بلیط کنسرت مجید رضوی\r\nسالن دوم\r\nآخرین تایم صندلی شماره های 65و66\r\nفقط تماس', 9, 14, '2025-12-01 15:10:20', '2025-12-01 15:17:39'),
(11, 'سیمان و گچ', 10000, 'نهبندان', 'pending', 'با سلام\r\nمقدار 50عدد کیسه سیمان\r\nو 20عدد کیسه گچ \r\nبه قیمت خرید قبلی', 9, 21, '2025-12-01 15:11:59', '2025-12-01 15:11:59'),
(12, 'نیرو جهت نظافت', 100000, 'بابل', 'rejected', 'با سلام\r\nدو نفر نیرو جهت کار در مجموعه خدماتی و رفاهی طلوع سبز\r\nجهت اطلاع بیشتر و شرایط حقوق و کار تماس حاصل فرمایید', 9, 11, '2025-12-01 15:15:09', '2025-12-08 15:04:44'),
(13, 'ضیشیبذیلدالت', 53421, 'gvfzd', 'pending', 'sdfgfsczvbfgnhfdcvbgnhfdsxzcxvbgfds', 2, 13, '2025-12-05 06:58:35', '2025-12-05 08:30:46'),
(15, 'test image', 1, 'teh', 'pending', '......................................................................................................', 2, 11, '2025-12-06 04:56:01', '2025-12-06 04:56:01'),
(16, 'تست عکس 1', 745, 'لبیسزشط', 'active', 'تئالظبیزسشطسیبرلافغعلخمهنتاغلقبثی', 2, 11, '2025-12-06 04:59:01', '2025-12-08 15:04:47'),
(17, 'تست عکس 1', 745, 'لبیسزشط', 'pending', 'تئالظبیزسشطسیبرلافغعلخمهنتاغلقبثی', 2, 11, '2025-12-06 05:02:33', '2025-12-06 05:02:33'),
(18, 'تست عکس 2', 7452, 'تست', 'active', 'این تصویر برای تست است.........', 2, 7, '2025-12-06 05:03:39', '2025-12-06 06:11:56'),
(19, 'تست عکس 3', 12, 'berline', 'rejected', 'یسیبلائتنالبیسزبذلائتدال', 2, 14, '2025-12-06 05:14:56', '2025-12-06 05:24:12'),
(20, 'ماشین 12', 12525, 'تست', 'active', 'این تصویر برای تست است.........', 2, 8, '2025-12-06 05:20:02', '2025-12-06 06:11:29'),
(21, 'iphone 17', 1200000, 'تست', 'active', 'lkjuyf5s5rftgyuhjiklkjuyf5s5rftgyuhjiklkjuyf5s5rftgyuhjiklkjuyf5s5rftgyuhjiklkjuyf5s5rftgyuhjiklkjuyf5s5rftgyuhjiklkjuyf5s5rftgyuhjiklkjuyf5s5rftgyuhjiklkjuyf5s5rftgyuhjik', 10, 4, '2025-12-08 15:00:48', '2025-12-08 15:04:22');

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
('laravel-cache-7e9dcb047c9999721f7e4a3986c0cd3c', 'i:1;', 1765107709),
('laravel-cache-7e9dcb047c9999721f7e4a3986c0cd3c:timer', 'i:1765107709;', 1765107709),
('laravel-cache-c647e18a0b23d5586aaa784b0d113e52', 'i:1;', 1765188291),
('laravel-cache-c647e18a0b23d5586aaa784b0d113e52:timer', 'i:1765188291;', 1765188291),
('laravel-cache-f604e986aa5f1c241d0a5071583317fb', 'i:1;', 1764976246),
('laravel-cache-f604e986aa5f1c241d0a5071583317fb:timer', 'i:1764976246;', 1764976246);

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'کالای دیجیتال', NULL, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(2, 'موبایل', 1, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(3, 'لپ تاپ', 1, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(4, 'خانه', NULL, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(5, 'نور و روشنایی', 4, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(6, 'فرش', 4, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(7, 'وسایل نقلیه', NULL, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(8, 'ماشین', 7, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(9, 'موتور', 7, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(10, 'خدمات', NULL, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(11, 'نظافت', 10, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(12, 'آموزشی', 10, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(13, 'سرگرمی', NULL, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(14, 'بلیط', 13, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(15, 'حیوانات', 13, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(16, 'وسایل شخصی', NULL, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(17, 'کفش', 16, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(18, 'لوازم تحریر', 16, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(19, 'تجهیزات', NULL, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(20, 'ابزار', 19, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(21, 'مصالح ساختمانی', 19, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(22, 'اجتماعی', NULL, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(23, 'رویداد', 22, '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(24, 'گم شده ها', 22, '2025-12-01 06:58:33', '2025-12-01 06:58:33');

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
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ad_id` bigint(20) UNSIGNED NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `ad_id`, `file_path`, `created_at`, `updated_at`) VALUES
(5, 3, 'ads/hpfbp3xEvoJGLUqrba4SLz3PsIdrpGhgiG0AJvox.jpg', '2025-12-01 14:57:03', '2025-12-01 14:57:03'),
(6, 4, 'ads/pwCYZSVEXJJ5pVqhuPJHP5yuePi3Bvp0u3nAA96p.jpg', '2025-12-01 14:58:32', '2025-12-01 14:58:32'),
(7, 5, 'ads/rL3DCdU8bzkevxPxw3X6N8obubac480f3eyfYSFz.jpg', '2025-12-01 15:00:30', '2025-12-01 15:00:30'),
(8, 6, 'ads/krAQJ50NLNPykbH7XFRbxqiF3zkgywi8RiNdKaTY.jpg', '2025-12-01 15:02:22', '2025-12-01 15:02:22'),
(9, 7, 'ads/PXeE5abJuMLa8ksN4mQeZznakwBQE35sPEI7kRbx.jpg', '2025-12-01 15:03:51', '2025-12-01 15:03:51'),
(10, 8, 'ads/dIM6CiFiHiQ3k0MkKc6vxmF7hJ00J0Q5LG7tjmUj.jpg', '2025-12-01 15:05:48', '2025-12-01 15:05:48'),
(11, 8, 'ads/GIIjL4UbK4wXnh6O6qLT1Pjt611cxF6Zv7AFbUyQ.jpg', '2025-12-01 15:05:48', '2025-12-01 15:05:48'),
(12, 8, 'ads/efCunZdiN5TAzm6rwYfIQpNxmy6UJJ9lDpCgSyQX.jpg', '2025-12-01 15:05:48', '2025-12-01 15:05:48'),
(13, 9, 'ads/qk0rlO99uGHk9UjAfb3m7jBaelqmdBHBkJPAjgWW.jpg', '2025-12-01 15:08:36', '2025-12-01 15:08:36'),
(14, 9, 'ads/fPwFVTxGOFGB8Zsih4HPhvE3giLDk01N1jbOCLxz.jpg', '2025-12-01 15:08:36', '2025-12-01 15:08:36'),
(15, 9, 'ads/NAFqcBxNgLxHImF2BhyD8ohvjLQIPC7vutpWc5qO.jpg', '2025-12-01 15:08:36', '2025-12-01 15:08:36'),
(16, 10, 'ads/Ky5ib6eQZKXq774zhKKO62IrbTx1nJ8aKbgLEp8O.jpg', '2025-12-01 15:10:20', '2025-12-01 15:10:20'),
(17, 11, 'ads/YOGt131Ah2qq8QSw7ri02mS4L2xWjUZHHGLWGFqb.jpg', '2025-12-01 15:11:59', '2025-12-01 15:11:59'),
(18, 11, 'ads/xm0pNeajgzFUOH21o5Zr5KXa5KgH418bwBmKioL2.jpg', '2025-12-01 15:11:59', '2025-12-01 15:11:59'),
(19, 12, 'ads/1qUd14Sk0wHN86wzhaGXuS342MMr6MUPGDZ5fY1l.jpg', '2025-12-01 15:15:09', '2025-12-01 15:15:09'),
(20, 18, 'ads/ad_693372dbde28e7.23847729.jpg', '2025-12-06 05:03:39', '2025-12-06 05:03:39'),
(21, 19, 'ads/ad_69337580844919.70093012.jpg', '2025-12-06 05:14:56', '2025-12-06 05:14:56'),
(22, 20, 'ads/ad_693376b208f912.97661214.jpg', '2025-12-06 05:20:02', '2025-12-06 05:20:02'),
(23, 21, 'ads/ad_6936a1d10ae990.88233643.jpg', '2025-12-08 15:00:49', '2025-12-08 15:00:49');

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
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `Ads_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(28, '0001_01_01_000000_create_users_table', 1),
(29, '0001_01_01_000001_create_cache_table', 1),
(30, '0001_01_01_000002_create_jobs_table', 1),
(31, '2025_11_02_084213_create_categories_table', 1),
(32, '2025_11_02_084214_create_ads_table', 1),
(33, '2025_11_02_084214_create_images_table', 1),
(34, '2025_11_02_084215_create_messages_table', 1),
(35, '2025_11_14_010302_add_two_factor_columns_to_users_table', 1),
(36, '2025_11_14_010331_create_personal_access_tokens_table', 1);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` text NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
('5LwqgM0TMaEbc89aG6gHo9iQsyOr8ah7QdeDHpr4', NULL, '::1', '', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRFZacEdiM2J5Z0pLc2dWQkdIR3l2SUxaMkhzOW1NaDV1SVU3dEh6QyI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3QvTWluaURpdmFyL3B1YmxpYyI7czo1OiJyb3V0ZSI7czo5OiJhZHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1765186862),
('drWwNgT11F6ugtRKcbjLFoaz8VUDxigeoZlszlRI', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicXFjalliZFBNbnZ0NFpneWdMcnR1NFJTWndrbngxTzhXNkUxTzFhdiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJhZHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1765148814),
('gYp85mE91GaMrIvWmGxHdrgNs8jnSULGrVLI2YlY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWGVpNllhOVRmOEVZdXo2YW5GSXlibkpxWGc1R2tBTmxvczJRdlNReiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9mb3Jnb3QtcGFzc3dvcmQiO3M6NToicm91dGUiO3M6MTY6InBhc3N3b3JkLnJlcXVlc3QiO319', 1765191037),
('LYpYYvbjuOq7fKPRrB1cgXhXCQfITN5qdmwOuyl4', 2, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidnZRc241QTV4QmFTVDZ0UUpBZHpDS3kwdzhJRkRTU21kN1NVeXRoQSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly9sb2NhbGhvc3QvTWluaURpdmFyL3B1YmxpYyI7czo1OiJyb3V0ZSI7czo5OiJhZHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1764978962),
('sqPZYTtyB55QVYQn7u4OkWuOAD2dywgyHSNehS5J', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTk9XSVd0QWZJNDZhRmI3YWlnamZ1TXZuQmpheVFVTUd6QlJXV1RBOCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZHMvMjAiO3M6NToicm91dGUiO3M6ODoiYWRzLnNob3ciO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1764986516),
('ugx6BoGGE9PRwQBUb1UYruxBx27N4tRLlHUQxZYy', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/142.0.0.0 Safari/537.36 Edg/142.0.0.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMno5SmJHS2FEOTVJeGRNaHZsQ2NkbU1XZ3FXU2F4SXNRY2Q1S056YiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo5OiJhZHMuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEyJEQxd2NpWm03akFYMXBSb01pekdEOXVKZGVTYURwQWdVU2VTWXJBYlhiZU9zekc2UnRra1c2Ijt9', 1764986262),
('xHUKHd72RxIacUlqmUbSulfbMz40yn7LRVDXbTfw', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoicWR4dHRLN3ZqWlRGR1kzeUR1eTNINHNPaklyNnJRZVZIM2tJUU5BRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC8/Y2F0ZWdvcnlfaWQ9OCZzZWFyY2g9IjtzOjU6InJvdXRlIjtzOjk6ImFkcy5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1765109714);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `phone`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin@minidivar.test', NULL, '$2y$12$2OvvvG.1O.fKula7Vy4SIuZIMJvvWxwPwuL1Z3orh/0pSIRulxryG', NULL, NULL, NULL, NULL, NULL, NULL, '9120000000', 'admin', '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(2, 'Test User', 'test@minidivar.test', NULL, '$2y$12$D1wciZm7jAX1pRoMizGD9uJdeSaDpAgUSeSYrAbXbeOszG6RtkkW6', NULL, NULL, NULL, NULL, NULL, NULL, '9120000001', 'user', '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(3, 'Test User', 'test@example.com', '2025-12-01 06:58:33', '$2y$12$gvRlTt7hMEkFduXDX5d2LeXfpQ9MCRujWbjNvaJ1LywGZRNwAn4qC', NULL, NULL, NULL, '8lzoJjMD5J', NULL, NULL, '9123456789', 'admin', '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(4, 'Kane Johnston DDS', 'kristian.bartoletti@example.org', '2025-12-01 06:58:33', '$2y$12$wckchT9Qj42pmO/FV1B0u./bpBdsF4KSUcN3/Ykqtza45edwZYj..', NULL, NULL, NULL, 'sqJev4xFiH', NULL, NULL, '9680598439', 'user', '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(5, 'Lucas Hegmann', 'hoppe.alberto@example.org', '2025-12-01 06:58:33', '$2y$12$wckchT9Qj42pmO/FV1B0u./bpBdsF4KSUcN3/Ykqtza45edwZYj..', NULL, NULL, NULL, 'lg2nbEozBR', NULL, NULL, '9148245578', 'user', '2025-12-01 06:58:33', '2025-12-03 16:37:32'),
(6, 'Mrs. Eva Legros', 'paucek.david@example.com', '2025-12-01 06:58:33', '$2y$12$wckchT9Qj42pmO/FV1B0u./bpBdsF4KSUcN3/Ykqtza45edwZYj..', NULL, NULL, NULL, 'paw99TID7E', NULL, NULL, '9720343916', 'user', '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(7, 'Marlon Ankunding', 'kiara11@example.net', '2025-12-01 06:58:33', '$2y$12$wckchT9Qj42pmO/FV1B0u./bpBdsF4KSUcN3/Ykqtza45edwZYj..', NULL, NULL, NULL, '9P4QW7eXkA', NULL, NULL, '9341928314', 'user', '2025-12-01 06:58:33', '2025-12-01 06:58:33'),
(8, 'Mrs. Virginia Parisian', 'gwilliamson@example.net', '2025-12-01 06:58:33', '$2y$12$wckchT9Qj42pmO/FV1B0u./bpBdsF4KSUcN3/Ykqtza45edwZYj..', NULL, NULL, NULL, 'dY0MhyRTj9', NULL, NULL, '9561360572', 'banned', '2025-12-01 06:58:33', '2025-12-03 16:37:53'),
(9, 'سید عرفان حسینی', 'azangouie72@gmail.com', NULL, '$2y$12$jTVWBbKWAtdiBE4QPtdDJexJCUj5t74c9anjlHCcmmtZW8/v38sbG', NULL, NULL, NULL, 'vL84xBAzUqQEXm8S83dADEonLwvRue9ljOrWsuTz1qkRYfTHZEJIunptmxaP', NULL, NULL, '9903478120', 'user', '2025-12-01 14:55:11', '2025-12-01 14:55:11'),
(10, 'test1', 'admin@minidivar.test1', NULL, '$2y$12$3wih7/.Rwm5gFD.2UcxeGur8N09WPF3Ou9.b2udobYm0uDkC058dC', NULL, NULL, NULL, NULL, NULL, NULL, '9150000000', 'user', '2025-12-08 14:58:19', '2025-12-08 14:58:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ads_user_id_foreign` (`user_id`),
  ADD KEY `ads_category_id_foreign` (`category_id`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `images_ad_id_foreign` (`ad_id`);

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `messages_ads_id_foreign` (`Ads_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ad_id_foreign` FOREIGN KEY (`ad_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ads_id_foreign` FOREIGN KEY (`Ads_id`) REFERENCES `ads` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
