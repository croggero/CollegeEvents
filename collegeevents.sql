-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2017 at 12:51 AM
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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `cat_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`) VALUES
(1, 'Sports');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `location_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(75) NOT NULL,
  `rso_id` int(11) DEFAULT NULL,
  `permission` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `time`, `date`, `location_id`, `name`, `cat_id`, `description`, `img`, `phone`, `email`, `rso_id`, `permission`) VALUES
(1, '12:00:00', '2017-03-30', 1, 'Beginners Basket Weaving Class', 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis.', '/images/spiritsplash.jpg', '555555555', 'baskets@ucf.edu', 9, 3);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `loc_name` varchar(255) NOT NULL,
  `latt` float NOT NULL,
  `long` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `loc_name`, `latt`, `long`) VALUES
(1, 'Memory Mall', 28.5798, -81.2114);

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
  `admin_id` int(10) UNSIGNED NOT NULL,
  `uni_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `rsos`
--

INSERT INTO `rsos` (`id`, `name`, `active`, `admin_id`, `uni_id`) VALUES
(5, 'Testing', 0, 37, 1),
(6, 'Computer Programming', 0, 37, 1),
(7, 'Basketball', 0, 36, 1),
(8, 'golf', 0, 38, 3),
(9, 'Basket Weaving', 0, 36, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unis`
--

CREATE TABLE `unis` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `initials` tinytext NOT NULL,
  `location` varchar(64) NOT NULL,
  `num_student` int(11) NOT NULL,
  `superadmin_id` int(10) UNSIGNED DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `unis`
--

INSERT INTO `unis` (`id`, `name`, `initials`, `location`, `num_student`, `superadmin_id`, `updated_at`) VALUES
(1, 'University of Central Florida', 'UCF', 'Orlando', 65000, 36, '2017-03-26 03:23:38'),
(2, 'Florida State University', 'FSU', 'Tallhasee', 40000, NULL, '2017-03-26 03:18:01'),
(3, 'University of Florida', 'UF', 'Gainsville', 50000, 38, '2017-03-26 08:51:30'),
(4, 'University of Tampa', 'UT', 'Tampa', 15000, NULL, NULL);

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
(10, 'Connor Roggero', 'croggero7@gmail.com', 1, '$2y$10$EkDoHGRx5R.sGtJWICEchOTjM3h78z2sy4w4tYsYA7nWY8KQ8ob2m', 'qr6IMLZU4gDyN8SLG5lBL8HCtAUfItjPVC7hmtIJlXqA03Cw2Ln9rUgpxVLw', '2017-03-26 01:12:16', '2017-03-26 01:12:16', 1),
(36, 'Mickey Mouse', 'test@test.com', 1, '$2y$10$9TALmZiCYuk2pCae7ph/GeZpxKU/b5/cAi4RiF4YgGdNkEWXDVuke', 'IP9cMO8H6u5gRS4AANhOjGLHEzUE8gRcEiyxP9JXuf330UDPuzInKWurBtbh', '2017-03-26 03:23:38', '2017-03-26 03:23:38', 1),
(37, 'John', 'John@knights.ucf.edu', 1, '$2y$10$nidDty68EIOOPpd5etb66Orhzw/0PTEa6rpGdc4wXDLsir2zrjXpO', 'wUvPuzZmNmPoZOVBtmhYTnw3ob9UGruuoqYb1U2PV92OdG7eYqLmeACVU7s8', '2017-03-26 03:30:01', '2017-03-26 03:30:01', 1),
(38, 'Arnold Palmer', 'arnold@uf.edu', 3, '$2y$10$oJYCqSSNhP0gVbVvxXpNzuqu7fKoxym/juqQ55fQxTBai08VdSFbS', 'woKWtCpPLSPiAJtjAHgDj86w3YCM2Nw403DDZopkqLbIBs6RmgABlhvloxzU', '2017-03-26 08:51:30', '2017-03-26 08:51:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_rsos`
--

CREATE TABLE `user_rsos` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `rso_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_rsos`
--

INSERT INTO `user_rsos` (`user_id`, `rso_id`, `updated_at`, `created_at`) VALUES
(10, 5, '2017-03-26 19:55:16', NULL),
(10, 9, '2017-03-27 02:31:05', '2017-03-27 02:31:05'),
(36, 5, '2017-03-27 01:15:21', '2017-03-27 01:15:21'),
(36, 6, '2017-03-27 00:55:41', '2017-03-27 00:55:41'),
(36, 7, '2017-03-27 00:57:30', '2017-03-27 00:57:30'),
(36, 9, '2017-03-27 01:15:14', '2017-03-27 01:15:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `events_loc_fk` (`location_id`),
  ADD KEY `cat_id_fk` (`cat_id`),
  ADD KEY `event_rso_fk` (`rso_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `rso_admin_fk` (`admin_id`),
  ADD KEY `rso_uni_fk` (`uni_id`);

--
-- Indexes for table `unis`
--
ALTER TABLE `unis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `superadmin_id_fk` (`superadmin_id`);

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
  ADD PRIMARY KEY (`user_id`,`rso_id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`rso_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `unis`
--
ALTER TABLE `unis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `cat_id_fk` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `event_rso_fk` FOREIGN KEY (`rso_id`) REFERENCES `rsos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `events_loc_fk` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `rsos`
--
ALTER TABLE `rsos`
  ADD CONSTRAINT `rso_admin_fk` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `rso_uni_fk` FOREIGN KEY (`uni_id`) REFERENCES `unis` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `unis`
--
ALTER TABLE `unis`
  ADD CONSTRAINT `superadmin_id_fk` FOREIGN KEY (`superadmin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_per_id` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_uni_fk` FOREIGN KEY (`uni_id`) REFERENCES `unis` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;