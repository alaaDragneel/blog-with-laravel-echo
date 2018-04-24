-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 21, 2018 at 09:30 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sec_theater_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `body`, `created_at`, `updated_at`) VALUES
(17, 2, 1, 'Mohamed Alaa', '2018-04-21 02:18:55', '2018-04-21 02:18:55'),
(19, 2, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-04-21 02:37:36', '2018-04-21 02:37:36'),
(20, 2, 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-04-21 02:37:41', '2018-04-21 02:37:41'),
(22, 2, 1, 'Alaa', '2018-04-21 04:05:18', '2018-04-21 04:05:18');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 2, 1, '2018-04-21 02:36:50', '2018-04-21 02:36:50');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2018_04_20_051825_create_permission_tables', 2),
(6, '2018_04_20_165355_create_posts_table', 3),
(7, '2018_04_20_165449_create_tags_table', 3),
(8, '2018_04_20_165508_create_post_tags_table', 3),
(9, '2018_04_20_165536_create_user_subscribed_tags_table', 3),
(10, '2018_04_20_165559_create_user_notifications_table', 3),
(11, '2018_04_20_165610_create_comments_table', 3),
(12, '2018_04_20_165625_create_replies_table', 3),
(13, '2018_04_20_165635_create_likes_table', 3),
(14, '2018_04_20_165648_create_saved_posts_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(1, 'App\\Models\\User', 18);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Add Users', 'web', '2018-04-20 04:04:24', '2018-04-20 04:04:24'),
(2, 'Edit Users', 'web', '2018-04-20 04:04:32', '2018-04-20 04:04:32'),
(3, 'Show Users', 'web', '2018-04-20 04:04:39', '2018-04-20 04:04:39'),
(4, 'Delete Users', 'web', '2018-04-20 04:04:46', '2018-04-20 04:04:46'),
(6, 'Add Tags', 'web', '2018-04-21 05:07:22', '2018-04-21 05:07:22'),
(7, 'Edit Tags', 'web', '2018-04-21 05:07:26', '2018-04-21 05:07:26'),
(8, 'Show Tags', 'web', '2018-04-21 05:07:31', '2018-04-21 05:07:31'),
(9, 'Delete Tags', 'web', '2018-04-21 05:07:36', '2018-04-21 05:07:36'),
(10, 'Add Posts', 'web', '2018-04-21 05:07:45', '2018-04-21 05:07:45'),
(11, 'Show Posts', 'web', '2018-04-21 05:07:51', '2018-04-21 05:07:51'),
(12, 'Edit Posts', 'web', '2018-04-21 05:07:59', '2018-04-21 05:07:59'),
(13, 'Delete Posts', 'web', '2018-04-21 05:08:16', '2018-04-21 05:08:16'),
(14, 'Change Posts Status', 'web', '2018-04-21 05:23:40', '2018-04-21 05:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `body` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `publish_date` varchar(255) DEFAULT NULL,
  `publish_time` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `later_publish` enum('yes','no') NOT NULL,
  `status` enum('approved','rejected','pending') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `image`, `slug`, `publish_date`, `publish_time`, `user_id`, `later_publish`, `status`, `created_at`, `updated_at`) VALUES
(2, 'PHP 7.2', '<h2>Introducing Laravel Horizon</h2><p><br></p><blockquote>Today I’m proud to announce Laravel Horizon, which combines a beautiful dashboard and code-driven configuration system for your Laravel Redis queues.</blockquote><p>In <strike>addition</strike> to a brand-new, code-driven configuration system, Horizon is a truly beautiful dashboard UI, and it’s totally open source and free for entire Laravel community. We’re launching the beta tomorrow. I hope you love it.</p><p>Today I’m proud to announce <b><u>Laravel Horizon</u></b>, which combines a beautiful dashboard and code-driven configuration system for your Laravel Redis queues.</p><p>In addition to a brand-new, code-driven configuration system, Horizon is a truly beautiful dashboard UI, and it’s totally open source and free for entire Laravel community. We’re launching the beta tomorrow. I hope you love it.</p><p><a href=\"http://127.0.0.1:8000/\">Today</a> I’m proud to announce Laravel Horizon, which combines a beautiful dashboard and code-driven configuration system for your Laravel Redis queues.</p><p>In addition to a brand-new, code-driven configuration system, Horizon is a truly beautiful dashboard UI, and it’s totally open source and free for entire Laravel community. We’re launching the beta tomorrow. I hope you love it.</p><p>Today I’m proud to announce Laravel Horizon, which combines a beautiful dashboard and code-driven configuration system for your Laravel Redis queues.</p><p>In addition to a brand-new, code-driven configuration system, Horizon is a truly beautiful dashboard UI, and it’s totally open source and free for entire Laravel community. We’re launching the beta tomorrow. I hope you love it.</p><p>Today I’m proud to announce Laravel Horizon, which combines a beautiful dashboard and code-driven configuration system for your Laravel Redis queues.</p><p>In addition to a brand-new, code-driven configuration system, Horizon is a truly beautiful dashboard UI, and it’s totally open source and free for entire Laravel community. We’re launching the beta tomorrow. I hope you love it.</p>', 'posts/822268_18-04-21-12-29-33_0cf6fc76afff365bc83e03125c7de493593fffc4.png', 'php-learning-7.2', '2018-04-21', '2:52', 1, 'yes', 'approved', '2018-04-20 22:29:33', '2018-04-21 04:51:12'),
(3, 'Learn Laravel', '<h2>This Is Dummy Data&nbsp;</h2><p><br></p><blockquote>This Is Dummy Data&nbsp;This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data </blockquote><blockquote>This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data&nbsp;<br></blockquote><p><br></p><p>This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data</p><p>This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data</p><p><br></p><p>This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data </p><p>This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data This Is Dummy Data&nbsp;</p>', 'posts/421885_18-04-21-06-31-28_57e25356a8b1d3d106f7ccbb5e889a19bd367800.jpg', 'laravel-learning', '2018-04-21', '6:40', 1, 'yes', 'pending', '2018-04-21 04:31:28', '2018-04-21 04:31:28'),
(4, 'Mohamed Zayed', '<p>wefwef</p>', 'posts/15112_18-04-21-07-05-23_57e25356a8b1d3d106f7ccbb5e889a19bd367800.jpg', 'php-learning-Alaa-wefewf', '2018-04-21', '7:27', 1, 'no', 'approved', '2018-04-21 05:05:23', '2018-04-21 05:27:02');

-- --------------------------------------------------------

--
-- Table structure for table `post_tags`
--

CREATE TABLE `post_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `post_tags`
--

INSERT INTO `post_tags` (`id`, `post_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(7, 3, 1, '2018-04-21 04:31:28', '2018-04-21 04:31:28'),
(8, 3, 2, '2018-04-21 04:31:28', '2018-04-21 04:31:28'),
(23, 2, 1, '2018-04-21 04:55:35', '2018-04-21 04:55:35'),
(24, 2, 2, '2018-04-21 04:55:35', '2018-04-21 04:55:35'),
(25, 4, 1, '2018-04-21 05:05:23', '2018-04-21 05:05:23'),
(26, 4, 2, '2018-04-21 05:05:23', '2018-04-21 05:05:23');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(10) UNSIGNED NOT NULL,
  `comment_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'web', '2018-04-20 04:09:35', '2018-04-20 04:09:35');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1);

-- --------------------------------------------------------

--
-- Table structure for table `saved_posts`
--

CREATE TABLE `saved_posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `saved_posts`
--

INSERT INTO `saved_posts` (`id`, `post_id`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 2, 1, '2018-04-21 02:37:51', '2018-04-21 02:37:51');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Alaa', '2018-04-20 16:38:32', '2018-04-20 16:38:32'),
(2, 'ALI', '2018-04-20 16:38:40', '2018-04-20 16:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` enum('user','admin') NOT NULL DEFAULT 'user',
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `type`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mohamed Zayed', 'admin@gmail.com', '$2y$10$1ArXi9C16RFdE4keCQxuCeohXyRxgSPJZckRx2QVNT9rJToWWoeaO', 'admin', 'users/813677_18-04-20-06-40-24_5a378b55d2b19de5e0e02392a9d2315a2368d8ae.jpg', 'VXF3duOkj5VbGnLwZiueYzw4tBgbaOtuJsm90qPSKFkQg0oTg7A4wBixU5yN', '2018-04-14 18:50:11', '2018-04-20 07:07:29'),
(18, 'Mohamed Zayed', 'm.reda@orbscope.com', '$2y$10$ddvoZkKzCb6.chke9jJ5T.7BrM2iEfNneLB.t1hcG7N.6OVJzEcvW', 'admin', NULL, 'msaB9GkKbr47IIGKBjSmLwhLVPOt5Rkqtb4Qr7ELqyccRZ2j50stxYnzSEwG', '2018-04-20 07:04:12', '2018-04-20 07:04:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `body` text NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_subscribed_tags`
--

CREATE TABLE `user_subscribed_tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_subscribed_tags`
--

INSERT INTO `user_subscribed_tags` (`id`, `user_id`, `tag_id`, `created_at`, `updated_at`) VALUES
(18, 1, 1, '2018-04-21 04:27:05', '2018-04-21 04:27:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_post_id_foreign` (`post_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `likes_post_id_foreign` (`post_id`),
  ADD KEY `likes_user_id_foreign` (`user_id`);

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
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_tags_post_id_foreign` (`post_id`),
  ADD KEY `post_tags_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replies_comment_id_foreign` (`comment_id`),
  ADD KEY `replies_user_id_foreign` (`user_id`);

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
-- Indexes for table `saved_posts`
--
ALTER TABLE `saved_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `saved_posts_post_id_foreign` (`post_id`),
  ADD KEY `saved_posts_user_id_foreign` (`user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `user_subscribed_tags`
--
ALTER TABLE `user_subscribed_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_subscribed_tags_user_id_foreign` (`user_id`),
  ADD KEY `user_subscribed_tags_tag_id_foreign` (`tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `post_tags`
--
ALTER TABLE `post_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `saved_posts`
--
ALTER TABLE `saved_posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_subscribed_tags`
--
ALTER TABLE `user_subscribed_tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `post_tags`
--
ALTER TABLE `post_tags`
  ADD CONSTRAINT `post_tags_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `post_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_comment_id_foreign` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `saved_posts`
--
ALTER TABLE `saved_posts`
  ADD CONSTRAINT `saved_posts_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saved_posts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD CONSTRAINT `user_notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_subscribed_tags`
--
ALTER TABLE `user_subscribed_tags`
  ADD CONSTRAINT `user_subscribed_tags_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_subscribed_tags_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
