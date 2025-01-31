-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2025 at 10:34 AM
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
-- Database: `ecom`
--

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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(5) NOT NULL,
  `userid` int(10) NOT NULL,
  `prodid` int(10) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `userid`, `prodid`, `quantity`) VALUES
(280, 8, 5, 8),
(281, 8, 21, 5),
(282, 8, 22, 7),
(283, 8, 24, 8),
(284, 8, 1, 6),
(285, 8, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Men', 'active', '2024-12-26 01:24:51', '2024-12-26 01:24:51'),
(4, 'Women', 'active', '2024-12-26 01:29:44', '2024-12-26 01:29:44'),
(6, 'women', 'deactive', '2024-12-26 02:49:18', '2024-12-26 02:49:18');

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
(4, '2024_12_25_114444_create_categories_table', 2),
(5, '2024_12_26_123746_create_products_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `prodid` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `price`, `qty`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Shirt', 'Red Color', 500.00, 12, '1735283681.download (1).jpg', 1, '2024-12-27 01:44:41', '2024-12-27 01:44:41'),
(2, 'Shirt', 'Red Color', 500.00, 12, '1735283813.download (1).jpg', 1, '2024-12-27 01:46:53', '2024-12-27 01:46:53'),
(3, 'Pant', 'Black', 700.00, 4, '1735283928.download (2).jpg', 1, '2024-12-27 01:48:48', '2024-12-27 01:48:48'),
(4, 'T-shirt', 'Blue', 450.00, 5, '1735284041.download (3).jpg', 1, '2024-12-27 01:50:41', '2024-12-27 01:50:41'),
(5, 'T-shirt', 'Blue', 450.00, 5, '1735284781.download (3).jpg', 1, '2024-12-27 02:03:01', '2024-12-27 02:03:01'),
(21, 'Blazer', 'Black', 10.00, 10, '1738242384.coat.jpg', 1, '2025-01-30 07:36:24', '2025-01-30 07:36:24'),
(22, 'long coat', 'Grey', 3000.00, 100, '1738242441.long coat.jpg', 1, '2025-01-30 07:37:21', '2025-01-30 07:37:21'),
(24, 'Laptop', 'Silver', 80000.00, 10, '1738243044.laptop-removebg-preview.png', 1, '2025-01-30 07:47:24', '2025-01-30 07:47:24'),
(25, 'iphone', 'NewBlue', 85000.00, 34, '1738243763.iphone-removebg-preview.png', 1, '2025-01-30 07:59:23', '2025-01-30 07:59:23'),
(26, 'hoodi', 'Black', 560.00, 12, '1738313799.hoodi.jpg', 1, '2025-01-31 03:26:39', '2025-01-31 03:26:39');

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
  `number` varchar(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `number`, `address`, `image`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@gmail.com', NULL, '$2y$12$rTdYnFtTbHTjKtntGyLD7OR32JBbXHYJWClXBAWp6MhOPRW/Pgc8S', '3442438889', 'sidhpur', NULL, 'admin', NULL, '2024-12-19 04:54:41', '2024-12-19 04:54:41'),
(3, 'rayfakhan', 'rayfa@gmail.com', NULL, '$2y$12$c9TkzhzEoScHw5afmByduew59Ly/A/wfH/Y24D33FKDNCGGWUlzxO', '4564566', 'kalol', 'users-profile/1735304592-download.png', 'customer', NULL, '2024-12-25 04:40:17', '2024-12-27 07:33:12'),
(5, 'akbar', 'akbar@gmail.com', NULL, '$2y$12$wzqPrrr3Lg71OCuMt9ClXeiWudep6q27edLWAtdPqayM3pnzmNhou', '54565465', 'chhapi', 'users-profile/1735304641-download (1).png', 'customer', NULL, '2024-12-25 04:47:25', '2024-12-27 07:34:01'),
(8, 'Farid', 'fluhar76@gmail.com', NULL, '$2y$12$zP2PPJUqcPg0BvoJ2eUtju6qpY9a2Lhx5uhv4PDnCKgKFlzZJGYNu', '9879879879', 'kalol', NULL, 'customer', NULL, '2025-01-08 06:14:32', '2025-01-08 06:14:32'),
(10, 'abc', 'abc@gmail.com', NULL, '$2y$12$he66vFAmobzRbiSdZeNPje5Ul0C94XD32euXaZ5v0.k3YyVw9dEs6', '9898989898', 'sidhpur', NULL, 'customer', NULL, '2025-01-21 07:57:15', '2025-01-21 07:57:15'),
(12, 'skype', 'skype@gmail.com', NULL, '$2y$12$eaj2y6Kdx8EelrSQdTiseeeTdx8KYNyrB0OVwvaZrzeM.t7JqFPUq', '987989898', 'american university', NULL, 'customer', NULL, '2025-01-25 01:40:22', '2025-01-25 01:40:22'),
(13, 'Tahir', 'tahir@gmail.com', NULL, '$2y$12$CTxqsrTPT0E91PDT07k0mubYdpQGIy1qT/FfigdRCGqjblS5KXJB6', '123456987', 'samapark 39b   mehsana', NULL, 'customer', NULL, '2025-01-25 01:50:30', '2025-01-25 01:50:30'),
(14, 'Rehman', 'rehman@gmail.com', NULL, '$2y$12$GjAGNBYaZqFICNd./l6d2eCmBgI3jPB9R3Tc3IVnnlmJDqpxqGKUa', '345334535', 'surpura', NULL, 'customer', NULL, '2025-01-25 02:07:02', '2025-01-25 02:07:02'),
(15, 'sehran', 'sehran@gmail.com', NULL, '$2y$12$g1VQkKXTB6ziXO3SoGm3z.YBuGSbIQ5gdK/SuOGe9t8uG/2xrXz72', '2434424', 'kalol', NULL, 'customer', NULL, '2025-01-25 02:16:49', '2025-01-25 02:16:49');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=286;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
