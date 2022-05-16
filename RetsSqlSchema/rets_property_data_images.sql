-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 20, 2021 at 07:04 PM
-- Server version: 10.4.22-MariaDB-1:10.4.22+maria~bionic-log
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `retsmd2.0`
--

-- --------------------------------------------------------

--
-- Table structure for table `rets_property_data_images`
--

CREATE TABLE `rets_property_data_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mls_no` int(11) NOT NULL DEFAULT 1,
  `listingID` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'NULL',
  `image_directory` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` text COLLATE utf8mb4_unicode_ci,
  `s3_image_url` text COLLATE utf8mb4_unicode_ci,
  `image_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `downloaded_time` datetime NOT NULL,
  `is_download` tinyint(4) NOT NULL DEFAULT 0,
  `is_resized1` tinyint(4) NOT NULL DEFAULT 0,
  `is_resized2` tinyint(4) NOT NULL DEFAULT 0,
  `is_resized3` tinyint(4) NOT NULL DEFAULT 0,
  `sort_order_no` int(11) DEFAULT NULL,
  `mls_order` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'NULL',
  `is_uploaded_by_agent` tinyint(4) NOT NULL DEFAULT 0,
  `updated_time` datetime NOT NULL,
  `image_last_tried_time` timestamp NULL DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rets_property_data_images`
--
ALTER TABLE `rets_property_data_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rets_property_data_images`
--
ALTER TABLE `rets_property_data_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
