-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 28, 2017 at 05:33 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `liftapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `bodyweights`
--

CREATE TABLE `bodyweights` (
  `id` int(11) NOT NULL,
  `weight` float NOT NULL,
  `user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bodyweights`
--

INSERT INTO `bodyweights` (`id`, `weight`, `user`, `date`, `created_at`, `updated_at`) VALUES
(1, 175, 0, '2017-09-23 19:48:26', NULL, NULL),
(2, 175, 1, '2017-09-23 19:50:51', NULL, NULL),
(3, 178, 1, '2017-09-23 20:32:06', NULL, NULL),
(4, 165, 1, '2017-09-25 14:14:55', NULL, NULL),
(5, 500, 1, '2017-09-27 18:58:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `foods`
--

CREATE TABLE `foods` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `calories` float NOT NULL,
  `fat` float NOT NULL,
  `carbs` float NOT NULL,
  `protein` float NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foods`
--

INSERT INTO `foods` (`id`, `user`, `name`, `calories`, `fat`, `carbs`, `protein`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 'Chocolate Drink', 100, 4, 5, 15, '2017-09-28 15:27:40', '0000-00-00 00:00:00', NULL),
(2, 1, 'Tortilla Chips, Tostitos, Blue Corn', 140, 7, 19, 2, '2017-09-28 15:28:01', '0000-00-00 00:00:00', NULL),
(3, 1, 'Oikos Triple Zero Yogurt - 1 container', 119.2, 0.43, 12.14, 16.41, '2017-09-28 15:32:51', '0000-00-00 00:00:00', NULL),
(4, 1, 'Oikos Triple Zero Yogurt - 1 container', 119.2, 0.43, 12.14, 16.41, '2017-09-28 15:33:01', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lifts`
--

CREATE TABLE `lifts` (
  `id` int(11) NOT NULL,
  `weight` double NOT NULL,
  `reps` int(11) NOT NULL,
  `type` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lifts`
--

INSERT INTO `lifts` (`id`, `weight`, `reps`, `type`, `date`, `user`, `created_at`, `updated_at`) VALUES
(28, 160, 6, 'Bench_press', '2017-09-27 19:23:09', 1, '0000-00-00 00:00:00', NULL),
(29, 175, 5, 'Bench_press', '2017-09-27 19:23:21', 1, '0000-00-00 00:00:00', NULL),
(30, 180, 6, 'Bench_press', '2017-09-27 19:23:28', 1, '0000-00-00 00:00:00', NULL),
(31, 190, 4, 'Bench_press', '2017-09-27 19:23:35', 1, '0000-00-00 00:00:00', NULL),
(32, 185, 5, 'Bench_press', '2017-09-27 19:23:47', 1, '0000-00-00 00:00:00', NULL),
(33, 195, 7, 'Bench_press', '2017-09-27 19:23:59', 1, '0000-00-00 00:00:00', NULL),
(34, 200, 5, 'Squat', '2017-09-27 19:24:10', 1, '0000-00-00 00:00:00', NULL),
(35, 190, 5, 'Squat', '2017-09-27 19:24:23', 1, '0000-00-00 00:00:00', NULL),
(36, 195, 5, 'Squat', '2017-09-27 19:24:36', 1, '0000-00-00 00:00:00', NULL),
(37, 220, 5, 'Squat', '2017-09-27 19:24:50', 1, '0000-00-00 00:00:00', NULL),
(38, 225, 5, 'Squat', '2017-09-27 19:25:05', 1, '0000-00-00 00:00:00', NULL),
(39, 210, 5, 'Squat', '2017-09-27 19:25:15', 1, '0000-00-00 00:00:00', NULL),
(40, 230, 6, 'Squat', '2017-09-27 19:25:25', 1, '0000-00-00 00:00:00', NULL),
(41, 280, 5, 'Deadlift', '2017-09-27 19:25:38', 1, '0000-00-00 00:00:00', NULL),
(42, 285, 5, 'Deadlift', '2017-09-27 19:25:46', 1, '0000-00-00 00:00:00', NULL),
(43, 285, 3, 'Deadlift', '2017-09-27 19:25:56', 1, '0000-00-00 00:00:00', NULL),
(44, 290, 6, 'Deadlift', '2017-09-27 19:26:04', 1, '0000-00-00 00:00:00', NULL),
(45, 290, 5, 'Deadlift', '2017-09-27 19:26:13', 1, '0000-00-00 00:00:00', NULL),
(46, 300, 5, 'Deadlift', '2017-09-27 19:26:23', 1, '0000-00-00 00:00:00', NULL),
(48, 200, 6, 'Bench_press', '2017-09-27 19:29:41', 1, '0000-00-00 00:00:00', NULL),
(49, 400, 1, 'Deadlift', '2017-09-27 19:39:09', 1, '0000-00-00 00:00:00', NULL),
(50, 170, 5, 'Bench_press', '2017-09-27 19:46:01', 1, '0000-00-00 00:00:00', NULL),
(52, 225, 4, 'Bench_press', '2017-09-28 01:47:17', 1, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lifttypes`
--

CREATE TABLE `lifttypes` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lifttypes`
--

INSERT INTO `lifttypes` (`id`, `name`, `user`, `created_at`, `updated_at`) VALUES
(25, 'Bench_press', 1, '2017-09-27 19:23:09', NULL),
(26, 'Squat', 1, '2017-09-27 19:24:10', NULL),
(27, 'Deadlift', 1, '2017-09-27 19:25:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Austin', '2017-09-23 16:48:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bodyweights`
--
ALTER TABLE `bodyweights`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foods`
--
ALTER TABLE `foods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lifts`
--
ALTER TABLE `lifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lifttypes`
--
ALTER TABLE `lifttypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bodyweights`
--
ALTER TABLE `bodyweights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `foods`
--
ALTER TABLE `foods`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lifts`
--
ALTER TABLE `lifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `lifttypes`
--
ALTER TABLE `lifttypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
