-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 09, 2020 at 06:05 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `worldapi`
--

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `created_at` varchar(12) NOT NULL DEFAULT '0',
  `updated_at` varchar(12) NOT NULL DEFAULT '0',
  `deleted_at` varchar(12) NOT NULL DEFAULT '0',
  `title` varchar(128) NOT NULL,
  `parent_id` varchar(12) NOT NULL,
  `content` varchar(512) NOT NULL,
  `level` varchar(12) NOT NULL DEFAULT '1',
  `owner_login` varchar(64) NOT NULL,
  `is_championship` varchar(64) NOT NULL DEFAULT 'N',
  `manager_login` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `created_at`, `updated_at`, `deleted_at`, `title`, `parent_id`, `content`, `level`, `owner_login`, `is_championship`, `manager_login`) VALUES
(1, '1581160265', '0', '0', 'test', '0', 'sdf', '1', '', 'N', ''),
(4, '1581160876', '0', '0', 'terer', '0', 'sdfsdf', '1', '', 'N', ''),
(5, '1581259512', '0', '0', 'new', '0', 'xcv', '1', 'test', 'N', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `created_at` varchar(11) NOT NULL DEFAULT '0',
  `updated_at` varchar(11) NOT NULL DEFAULT '0',
  `deleted_at` varchar(11) NOT NULL DEFAULT '0',
  `group_id` varchar(64) NOT NULL DEFAULT 'expert'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `created_at`, `updated_at`, `deleted_at`, `group_id`) VALUES
(1, 'test', '123', '1581148699', '0', '0', 'manager'),
(16, 'test2', 'test', '1581259043', '0', '0', 'expert');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
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
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
