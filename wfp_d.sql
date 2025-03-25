-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 25, 2025 at 03:18 PM
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
-- Database: `wfp_d`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Books', NULL, NULL),
(2, 'Appetizer', NULL, NULL),
(3, 'Main Course', NULL, NULL),
(4, 'Dessert', NULL, NULL),
(5, 'Beverage', NULL, NULL);

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
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `nutritions_fact` text NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `name`, `description`, `nutritions_fact`, `price`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Book Burger', 'Burger berbentuk buku dengan page 1', 'Protein: 25g, Carbs: 30g, Fat: 15g', 1500.00, 1, NULL, NULL),
(2, 'Novel Noodles', 'Mie spesial dengan stories edition', 'Protein: 10g, Carbs: 50g, Fat: 8g', 2500.00, 1, NULL, NULL),
(3, 'Dictionary Donut', 'Donat dengan kosakata di setiap gigitannya', 'Protein: 5g, Carbs: 40g, Fat: 20g', 1200.00, 1, NULL, NULL),
(4, 'Garlic Bread', 'Roti dengan bumbu bawang putih spesial', 'Protein: 5g, Carbs: 30g, Fat: 10g', 1800.00, 2, NULL, NULL),
(5, 'Spring Rolls', 'Rollade dengan isian sayuran segar', 'Protein: 8g, Carbs: 25g, Fat: 12g', 1600.00, 2, NULL, NULL),
(6, 'Steak Supreme', 'Steak daging premium kelas 1', 'Protein: 35g, Carbs: 10g, Fat: 25g', 5500.00, 3, NULL, NULL),
(7, 'Grilled Salmon', 'Salmon panggang dengan saus lemon', 'Protein: 30g, Carbs: 5g, Fat: 18g', 4800.00, 3, NULL, NULL),
(8, 'Chocolate Cake', 'Kue coklat dengan lelehan coklat premium', 'Protein: 6g, Carbs: 45g, Fat: 22g', 2200.00, 4, NULL, NULL),
(9, 'Ice Cream Delight', 'Es krim dengan 3 rasa berbeda', 'Protein: 4g, Carbs: 35g, Fat: 15g', 1500.00, 4, NULL, NULL),
(10, 'Fruity Juice', 'Jus buah segar dengan tambahan vitamin', 'Protein: 1g, Carbs: 20g, Fat: 0g', 1200.00, 5, NULL, NULL),
(11, 'Coffee Premium', 'Kopi premium dari biji pilihan', 'Protein: 0g, Carbs: 5g, Fat: 0g', 1800.00, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `food_orders`
--

CREATE TABLE `food_orders` (
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `food_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga_jual` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `food_orders`
--

INSERT INTO `food_orders` (`order_id`, `food_id`, `quantity`, `harga_jual`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1500.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(1, 10, 1, 1500.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(2, 2, 1, 2500.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(2, 4, 2, 2000.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(3, 6, 2, 6000.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(3, 3, 5, 6000.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(4, 7, 1, 4800.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(5, 6, 1, 5500.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(5, 8, 1, 2000.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(5, 11, 1, 1000.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(6, 9, 1, 1500.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(6, 5, 1, 1600.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(6, 1, 1, 500.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(7, 2, 2, 5000.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(7, 11, 1, 1200.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(7, 9, 1, 1000.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(8, 6, 1, 5500.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(8, 7, 1, 4300.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(9, 3, 3, 3600.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(9, 10, 1, 1200.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(9, 11, 1, 700.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(10, 6, 1, 5500.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(10, 10, 1, 1300.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_03_06_073958_create_categories_table', 1),
(6, '2025_03_06_074234_create_foods_table', 1),
(7, '2025_03_20_080919_create_orders_table', 1),
(8, '2025_03_20_081015_create_food_orders_table', 1),
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(13, '2025_03_06_073958_create_categories_table', 1),
(14, '2025_03_06_074234_create_foods_table', 1),
(15, '2025_03_20_080815_create_food_orders_table', 1),
(16, '2025_03_20_080919_create_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  `grand_total` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `tanggal`, `status`, `grand_total`, `created_at`, `updated_at`) VALUES
(1, '2025-01-05 12:30:00', 1, 3000.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(2, '2025-01-12 18:45:00', 1, 6500.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(3, '2025-01-25 20:15:00', 1, 12000.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(4, '2025-02-03 13:20:00', 1, 4800.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(5, '2025-02-14 19:30:00', 1, 8500.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(6, '2025-02-28 21:00:00', 1, 3600.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(7, '2025-03-10 14:45:00', 1, 7200.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(8, '2025-03-18 17:15:00', 1, 9800.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(9, '2025-03-25 20:30:00', 1, 5500.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36'),
(10, '2025-04-05 15:00:00', 1, 6800.00, '2025-03-25 07:06:36', '2025-03-25 07:06:36');

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
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

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
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foods_category_id_foreign` (`category_id`);

--
-- Indexes for table `food_orders`
--
ALTER TABLE `food_orders`
  ADD KEY `food_orders_order_id_foreign` (`order_id`),
  ADD KEY `food_orders_food_id_foreign` (`food_id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foods`
--
ALTER TABLE `foods`
  ADD CONSTRAINT `foods_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `food_orders`
--
ALTER TABLE `food_orders`
  ADD CONSTRAINT `food_orders_food_id_foreign` FOREIGN KEY (`food_id`) REFERENCES `foods` (`id`),
  ADD CONSTRAINT `food_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
