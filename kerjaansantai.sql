-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2022 at 08:01 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kerjaansantai`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'REGISTER', '2022-12-10 03:10:41', '2022-12-10 03:10:41');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
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
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_08_19_000000_create_failed_jobs_table', 1),
(9, '2020_04_03_000000_create_users_table', 1),
(10, '2020_04_23_102829_create_permission_tables', 1),
(11, '2022_12_08_235817_create_category_table', 1),
(13, '2022_12_10_093230_create_task_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'permissions-create', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(2, 'permissions-read', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(3, 'permissions-update', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(4, 'permissions-delete', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(5, 'roles-create', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(6, 'roles-read', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(7, 'roles-update', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(8, 'roles-delete', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(9, 'users-create', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(10, 'users-read', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(11, 'users-update', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(12, 'users-delete', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42'),
(13, 'category-create', 'web', '2022-12-10 03:08:51', '2022-12-10 03:09:40'),
(14, 'category-read', 'web', '2022-12-10 03:08:56', '2022-12-10 03:09:31'),
(15, 'category-update', 'web', '2022-12-10 03:10:18', '2022-12-10 03:10:18'),
(16, 'category-delete', 'web', '2022-12-10 03:10:22', '2022-12-10 03:10:22'),
(17, 'task-read', 'web', '2022-12-10 05:06:35', '2022-12-10 05:06:35'),
(18, 'task-create', 'web', '2022-12-10 05:06:56', '2022-12-10 05:06:56'),
(19, 'task-update', 'web', '2022-12-10 05:07:04', '2022-12-10 05:07:04'),
(20, 'task-delete', 'web', '2022-12-10 05:07:10', '2022-12-10 05:07:10'),
(21, 'task-do', 'web', '2022-12-10 05:07:38', '2022-12-10 05:07:38');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'administrator', 'web', '2022-12-10 03:07:42', '2022-12-10 03:07:42');

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
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` char(100) NOT NULL,
  `description` longtext NOT NULL,
  `category` int(11) NOT NULL,
  `deadline` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `path_image` varchar(255) NOT NULL,
  `image1` varchar(255) NOT NULL,
  `path_image1` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `limit` int(11) NOT NULL,
  `status` enum('active','inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `description`, `category`, `deadline`, `image`, `path_image`, `image1`, `path_image1`, `price`, `limit`, `status`, `created_at`, `updated_at`) VALUES
(1, '34534', '<p>3453</p>', 1, 3453, 'Screenshot_5.png', 'public/images/zIYZ14hxnwFO4EQoF6OisSgeLPfSqlqA4Fsg6jbi.png', 'Screenshot_5.png', 'public/images/yzxRmEvWhJsNtuMGMiPd0zZig9ulF3TZ6e9pQjNC.png', 345, 3453, 'active', '2022-12-12 05:44:05', '2022-12-12 05:44:05'),
(2, '25434', '<p>34534</p>', 1, 3453, 'download.jpg', 'public/images/hxD6QBKRnwto1jj8c0URmDHpjsXzqzpr6f5TOHUP.jpg', 'Screenshot_5.png', 'public/images/i2W16ocQzSifNjev5NBV9Zz32NzqNx8l0FQpzBmG.png', 34534, 45, 'active', '2022-12-12 05:46:40', '2022-12-12 05:46:40'),
(3, '45645', '<p>4564</p>', 1, 6456, 'Screenshot_5.png', 'public/images/SAlddoRVizsZl45Le2AZH7EIp0nPoYbxq4xOPp4R.png', 'download.jpg', 'public/images/bCmUakn1j1061fJEZakeouypqiAlZa9deizKBBGb.jpg', 5645, 45645, 'active', '2022-12-12 05:47:36', '2022-12-12 05:47:36'),
(4, '34534', '<p>3453</p>', 1, 3453, 'Screenshot_5.png', 'public/images/wIeFSLEVbfsdI1VyFyw7ntIo3tNpMfRWI6ZVdjug.png', 'Screenshot_5.png', 'public/images\\php9E60.tmp', 345, 4534, 'active', '2022-12-12 05:55:19', '2022-12-12 05:55:19'),
(5, '4564', '<p>4564</p>', 1, 45645, 'Screenshot_5.png', 'public/images/oI0kfsDFqD4agchALGIx8aJIOZ6sx3LxCHvK3QXk.png', 'Screenshot_5.png', 'C:\\xampp7\\htdocs\\laravel\\laravel-starter/public/uploads\\php768D.tmp', 4564, 645, 'active', '2022-12-12 05:57:19', '2022-12-12 05:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', 'admin', '2022-12-10 03:07:42', '$2y$10$qkVb2O8qSBIdYF.D7vq3bOmwGR18RdfFbM7xpbYklk3oAf1ZBhDbO', NULL, '2022-12-10 03:07:42', '2022-12-10 03:07:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
