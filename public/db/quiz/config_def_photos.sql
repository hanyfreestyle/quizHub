-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 08:18 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_card`
--

--
-- Dumping data for table `config_def_photos`
--

INSERT INTO `config_def_photos` (`id`, `cat_id`, `photo`, `photo_thum_1`, `photo_thum_2`, `position`, `created_at`, `updated_at`) VALUES
(1, 'logo_light', 'images/def-photo/logo-light-TFSG0q5aaJ.webp', NULL, NULL, 0, '2024-12-13 18:38:38', '2024-12-13 18:38:38'),
(2, 'logo_dark', 'images/def-photo/logo-dark-eA04hqYH6r.webp', NULL, NULL, 0, '2024-12-13 18:38:59', '2024-12-13 18:38:59'),
(3, 'logo_icon', 'images/def-photo/logo-icon-tUNHhf1fTI.webp', NULL, NULL, 0, '2024-12-13 18:39:28', '2024-12-13 18:39:28');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
