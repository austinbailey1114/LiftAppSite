-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 27, 2017 at 04:08 PM
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
(4, 165, 1, '2017-09-25 14:14:55', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lifts`
--

CREATE TABLE `lifts` (
  `id` int(11) NOT NULL,
  `weight` double NOT NULL,
  `reps` int(11) NOT NULL,
  `type` varchar(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lifts`
--

INSERT INTO `lifts` (`id`, `weight`, `reps`, `type`, `date`, `user`, `created_at`, `updated_at`) VALUES
(20, 155, 5, '1', '2017-09-26 00:10:00', 1, '0000-00-00 00:00:00', NULL),
(21, 155, 2, '2', '2017-09-26 00:10:47', 1, '0000-00-00 00:00:00', NULL),
(22, 200, 2, '2', '2017-09-26 00:11:29', 1, '0000-00-00 00:00:00', NULL),
(23, 100, 2, '2', '2017-09-26 00:11:37', 1, '0000-00-00 00:00:00', NULL),
(24, 155, 3, '2', '2017-09-26 00:17:01', 1, '0000-00-00 00:00:00', NULL),
(25, 100, 1, '1', '2017-09-26 00:17:07', 1, '0000-00-00 00:00:00', NULL),
(27, 100, 1, '2', '2017-09-26 01:05:48', 1, '0000-00-00 00:00:00', NULL),
(28, 200, 2, '2', '2017-09-26 13:54:13', 1, '0000-00-00 00:00:00', NULL),
(29, 100, 2, '1', '2017-09-26 17:07:36', 1, '0000-00-00 00:00:00', NULL),
(30, 50, 5, '6', '2017-09-26 18:38:10', 1, '0000-00-00 00:00:00', NULL),
(31, 60, 6, '6', '2017-09-26 18:41:33', 1, '0000-00-00 00:00:00', NULL),
(32, 155, 5, '2', '2017-09-26 18:47:12', 1, '0000-00-00 00:00:00', NULL),
(33, 150, 5, '2', '2017-09-26 20:50:40', 1, '0000-00-00 00:00:00', NULL),
(34, 400, 1, '8', '2017-09-27 00:14:11', 1, '0000-00-00 00:00:00', NULL),
(35, 200, 6, '8', '2017-09-27 00:15:52', 1, '0000-00-00 00:00:00', NULL),
(36, 100, 20, '8', '2017-09-27 12:46:22', 1, '0000-00-00 00:00:00', NULL);

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
(3, '2', 1, '2017-09-26 00:07:07', NULL),
(4, '8', 1, '2017-09-26 00:08:46', NULL),
(5, '1', 1, '2017-09-26 00:10:00', NULL),
(7, '6', 1, '2017-09-26 18:38:10', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `lifts`
--
ALTER TABLE `lifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `lifttypes`
--
ALTER TABLE `lifttypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
