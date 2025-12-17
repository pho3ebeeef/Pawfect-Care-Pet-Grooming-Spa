-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2025 at 09:44 AM
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
-- Database: `pawfect_care_pet_grooming_spa`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `pet_id` bigint(20) UNSIGNED NOT NULL,
  `pet_name` varchar(255) NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `groomer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `service_id` bigint(20) UNSIGNED DEFAULT NULL,
  `scheduled_at` datetime NOT NULL,
  `status` enum('pending','confirmed','in_progress','completed','no_show','cancelled') NOT NULL DEFAULT 'pending',
  `client_notes` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assignment_log`
--

CREATE TABLE `assignment_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `changed_by_user_id` bigint(20) UNSIGNED NOT NULL,
  `old_groomer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `new_groomer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `full_name`, `email`, `created_at`, `updated_at`) VALUES
(1, 6, 'Test Client', 'test@client.com', '2025-12-16 22:12:47', '2025-12-16 22:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `groomers`
--

CREATE TABLE `groomers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `employment_status` enum('active','inactive','terminated','probation') NOT NULL DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groomers`
--

INSERT INTO `groomers` (`id`, `user_id`, `full_name`, `email`, `employment_status`, `created_at`, `updated_at`) VALUES
(1, 4, 'Test Groomer', 'test@groomer.com', 'active', '2025-12-16 21:38:34', '2025-12-16 21:38:34');

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
(1, '2025_12_15_041613_create_user_table', 1),
(2, '2025_12_15_042117_create_client_table', 1),
(3, '2025_12_15_042435_create_pet_table', 1),
(4, '2025_12_15_042535_create_service_table', 1),
(5, '2025_12_15_042642_create_groomer_table', 1),
(6, '2025_12_15_042807_create_appointment_table', 1),
(7, '2025_12_15_042945_create_note_table', 1),
(8, '2025_12_15_043104_create_assignment_log_table', 1),
(9, '2025_12_15_052332_create_cache_table', 1),
(10, '2025_12_15_054125_create_sessions_table', 1),
(11, '2025_12_17_070331_add_species_to_pets_table', 2),
(12, '2025_12_17_070437_remove_species_from_appointments_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `appointment_id` bigint(20) UNSIGNED NOT NULL,
  `groomer_id` bigint(20) UNSIGNED NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `species` text NOT NULL,
  `breed` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pets`
--

INSERT INTO `pets` (`id`, `client_id`, `name`, `species`, `breed`, `created_at`, `updated_at`) VALUES
(1, 1, 'Marsha', 'Dog', 'Shih Tzu', '2025-12-16 22:58:14', '2025-12-16 22:58:14'),
(2, 1, 'Marsha', 'Dog', 'Shih Tzu', '2025-12-16 22:59:29', '2025-12-16 22:59:29'),
(3, 1, 'Marsha', 'Dog', 'Shih Tzu', '2025-12-16 22:59:56', '2025-12-16 22:59:56'),
(4, 1, 'Marsha', 'Dog', 'Shih Tzu', '2025-12-16 23:00:41', '2025-12-16 23:00:41'),
(5, 1, 'Marsha', 'Dog', 'Shih Tzu', '2025-12-16 23:02:30', '2025-12-16 23:02:30'),
(6, 1, 'Marsha', 'Dog', 'Shih Tzu', '2025-12-16 23:05:22', '2025-12-16 23:05:22');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `duration_minutes` smallint(5) UNSIGNED NOT NULL DEFAULT 60,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `duration_minutes`, `created_at`, `updated_at`) VALUES
(3, 'Full Groom Package', 'Bath, haircut, nail trim, ear cleaning', 1200.00, 60, '2025-12-16 22:18:18', '2025-12-16 22:18:18'),
(4, 'Quick Bath & Brush', 'Refresh between full grooms', 600.00, 60, '2025-12-16 22:18:18', '2025-12-16 22:18:18'),
(5, 'Pawdicure', 'Nail trim with paw balm massage', 350.00, 60, '2025-12-16 22:18:18', '2025-12-16 22:18:18'),
(6, 'Deluxe Spa Treatment', 'Aromatherapy bath with coat conditioning', 1800.00, 60, '2025-12-16 22:18:18', '2025-12-16 22:18:18'),
(7, 'De-Shedding Treatment', 'Coat thinning and brushing for heavy shedders', 950.00, 60, '2025-12-16 22:18:18', '2025-12-16 22:18:18'),
(8, 'Sensitive Skin Care', 'Hypoallergenic shampoo with soothing rinse', 1000.00, 60, '2025-12-16 22:18:18', '2025-12-16 22:18:18'),
(9, 'Teeth Brushing', 'Gentle dental cleaning for fresh breath', 250.00, 60, '2025-12-16 22:18:18', '2025-12-16 22:18:18'),
(10, 'Ear Cleaning', 'Safe removal of wax and debris', 200.00, 60, '2025-12-16 22:18:18', '2025-12-16 22:18:18'),
(11, 'Flea & Tick Treatment', 'Protective rinse to eliminate pests', 500.00, 60, '2025-12-16 22:18:18', '2025-12-16 22:18:18'),
(12, 'Bow or Bandana Styling', 'Playful accessory for a polished look', 150.00, 60, '2025-12-16 22:18:18', '2025-12-16 22:18:18');

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
  `role` enum('client','receptionist','groomer','admin') NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(4, 'Test Groomer', 'test@groomer.com', NULL, '$2y$12$VyfU50kCG6RRHROVS.wgBuack9ojWpTx/P8q9fyaJjixgPiEuVHGG', 'groomer', NULL, '2025-12-16 21:38:34', '2025-12-16 21:38:34'),
(5, 'Test Admin', 'test@admin.com', NULL, '$2y$12$a0lCFafgoKxHVHrXbaeoK.8aHKtiDlY1GZ5z47hXPZHMC/TnAvgu2', 'admin', NULL, '2025-12-16 21:53:09', '2025-12-16 21:53:09'),
(6, 'Test Client', 'test@client.com', NULL, '$2y$12$tMroEtTjj/NJMWC5tZs8TO6mcS01mh8YnbVN.EkEthqDMVo48Npry', 'client', NULL, '2025-12-16 22:12:46', '2025-12-16 22:12:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_client_id_foreign` (`client_id`),
  ADD KEY `appointments_pet_id_foreign` (`pet_id`),
  ADD KEY `appointments_groomer_id_foreign` (`groomer_id`),
  ADD KEY `appointments_service_id_foreign` (`service_id`);

--
-- Indexes for table `assignment_log`
--
ALTER TABLE `assignment_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignment_log_appointment_id_foreign` (`appointment_id`),
  ADD KEY `assignment_log_changed_by_user_id_foreign` (`changed_by_user_id`),
  ADD KEY `assignment_log_old_groomer_id_foreign` (`old_groomer_id`),
  ADD KEY `assignment_log_new_groomer_id_foreign` (`new_groomer_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`),
  ADD KEY `clients_user_id_foreign` (`user_id`);

--
-- Indexes for table `groomers`
--
ALTER TABLE `groomers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groomers_email_unique` (`email`),
  ADD KEY `groomers_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_appointment_id_foreign` (`appointment_id`),
  ADD KEY `notes_groomer_id_foreign` (`groomer_id`);

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pets_client_id_foreign` (`client_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_name_unique` (`name`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_index` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment_log`
--
ALTER TABLE `assignment_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groomers`
--
ALTER TABLE `groomers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_groomer_id_foreign` FOREIGN KEY (`groomer_id`) REFERENCES `groomers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_pet_id_foreign` FOREIGN KEY (`pet_id`) REFERENCES `pets` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointments_service_id_foreign` FOREIGN KEY (`service_id`) REFERENCES `services` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `assignment_log`
--
ALTER TABLE `assignment_log`
  ADD CONSTRAINT `assignment_log_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignment_log_changed_by_user_id_foreign` FOREIGN KEY (`changed_by_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignment_log_new_groomer_id_foreign` FOREIGN KEY (`new_groomer_id`) REFERENCES `groomers` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `assignment_log_old_groomer_id_foreign` FOREIGN KEY (`old_groomer_id`) REFERENCES `groomers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `groomers`
--
ALTER TABLE `groomers`
  ADD CONSTRAINT `groomers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_appointment_id_foreign` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notes_groomer_id_foreign` FOREIGN KEY (`groomer_id`) REFERENCES `groomers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pets`
--
ALTER TABLE `pets`
  ADD CONSTRAINT `pets_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
