-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2017 at 07:19 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `collegeevents`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` tinyint(11) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`) VALUES
(1, 'Student'),
(2, 'Admin'),
(3, 'SuperAdmin');

-- --------------------------------------------------------

--
-- Table structure for table `rsos`
--

CREATE TABLE `rsos` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `admin_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `unis`
--

CREATE TABLE `unis` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `initials` tinytext NOT NULL,
  `location` varchar(64) NOT NULL,
  `num_student` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `unis`
--

INSERT INTO `unis` (`id`, `name`, `initials`, `location`, `num_student`) VALUES
(1, 'University of Central Florida', 'UCF', '4000 Central Florida Blvd, Orlando, FL 32816', 65000),
(2, 'Florida State University', 'FSU', '600 W College Ave, Tallahassee, FL 32306', 45000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uni_id` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `permission_id` tinyint(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `uni_id`, `password`, `remember_token`, `created_at`, `updated_at`, `permission_id`) VALUES
(6, 'Connor Roggero', 'test@test.com', 1, '$2y$10$I2GZmV6E/4f./AiFGLmpV.OwzMBdLLymfbksQylF50EfHdlCGZYw2', 'REqwwvASLBafjUowHmFOUQJ86EsBcHDg1mVaCfYiMv2NKOtXU0FXx7sya7l0', '2017-03-24 08:33:37', '2017-03-24 08:33:37', 1),
(7, 'Tony Stark', 'tony@knights.ucf.edu', 1, '$2y$10$O3Bzm0mQGJNeSeQPb1mVoOAB7HMev9bF39KoVVBIN2bnfXdYXuUaG', 'zpOCQ17avVD7SPJfe28ktqlPSEyUsmhvy8ByLKt4hIaE4F3WQyB5vOsYn9i0', '2017-03-24 08:34:16', '2017-03-24 08:34:16', 1),
(8, 'Mickey Mouse', 'disney@fsu.com', 2, '$2y$10$c5yQAs/d1CRwPOpnrE60weUB9FyeB7EO8hEdZyjk0pOcNyO60t1lC', NULL, '2017-03-24 10:06:50', '2017-03-24 10:06:50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_rsos`
--

CREATE TABLE `user_rsos` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `rso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rsos`
--
ALTER TABLE `rsos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rso_admin_fk` (`admin_id`);

--
-- Indexes for table `unis`
--
ALTER TABLE `unis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_uni_fk` (`uni_id`),
  ADD KEY `user_per_id` (`permission_id`);

--
-- Indexes for table `user_rsos`
--
ALTER TABLE `user_rsos`
  ADD KEY `rso_fk` (`rso_id`),
  ADD KEY `user_fk` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rsos`
--
ALTER TABLE `rsos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unis`
--
ALTER TABLE `unis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `rsos`
--
ALTER TABLE `rsos`
  ADD CONSTRAINT `rso_admin_fk` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_per_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_uni_fk` FOREIGN KEY (`uni_id`) REFERENCES `unis` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `user_rsos`
--
ALTER TABLE `user_rsos`
  ADD CONSTRAINT `rso_fk` FOREIGN KEY (`rso_id`) REFERENCES `rsos` (`id`),
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
