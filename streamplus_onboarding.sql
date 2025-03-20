-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2025 at 10:39 AM
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
-- Database: `streamplus_onboarding`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(180) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `subscription_type` enum('free','premium') DEFAULT 'free',
  `address_line1` varchar(255) DEFAULT NULL,
  `address_line2` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `credit_card_number` varchar(16) DEFAULT NULL,
  `expiration_date` varchar(7) DEFAULT NULL,
  `cvv` varchar(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `phone_number`, `subscription_type`, `address_line1`, `address_line2`, `city`, `postal_code`, `state`, `country`, `credit_card_number`, `expiration_date`, `cvv`, `created_at`) VALUES
(1, 'Mohamed Khalil', 'eng.mo7ammad88@gmail.com', '0585217903', 'free', 'Tecom', 'Internet City', 'Dubai', '123456', 'Dubai', 'AE', NULL, NULL, NULL, '2025-03-20 09:23:57'),
(2, 'Mohamed Khalil', 'eng.mo7ammad8888@gmail.com', '0585217903', 'premium', 'Tecom', 'Internet City', 'Dubai', '123456', 'دبي — Dubai', 'AE', '7894561232145698', '07/08', '999', '2025-03-20 09:24:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_users_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
