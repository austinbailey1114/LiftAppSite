-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 23, 2017 at 10:50 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

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
(3, 178, 1, '2017-09-23 20:32:06', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lifts`
--

CREATE TABLE `lifts` (
  `id` int(11) NOT NULL,
  `weight` double NOT NULL,
  `reps` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lifts`
--

INSERT INTO `lifts` (`id`, `weight`, `reps`, `type`, `date`, `user`, `created_at`, `updated_at`) VALUES
(1, 45, 10, 1, '2017-09-23 16:50:00', 1, '0000-00-00 00:00:00', NULL),
(2, 100, 2, 1, '2017-09-23 16:57:21', 1, '0000-00-00 00:00:00', NULL),
(3, 334, 12, 1, '2017-09-23 17:31:03', 1, '0000-00-00 00:00:00', NULL),
(4, 155, 5, 1, '2017-09-23 18:10:32', 0, '0000-00-00 00:00:00', NULL),
(5, 155, 5, 1, '2017-09-23 18:11:15', 0, '0000-00-00 00:00:00', NULL),
(6, 100, 5, 1, '2017-09-23 18:11:46', 0, '0000-00-00 00:00:00', NULL),
(7, 155, 5, 1, '2017-09-23 18:12:10', 1, '0000-00-00 00:00:00', NULL),
(12, 10, 100, 1, '2017-09-23 19:26:31', 1, '0000-00-00 00:00:00', NULL);

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
(1, 'pull ups', 1, '2017-09-23 16:49:00', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lifts`
--
ALTER TABLE `lifts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lifttypes`
--
ALTER TABLE `lifttypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;