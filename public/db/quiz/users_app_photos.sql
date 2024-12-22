-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 10:06 AM
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
-- Database: `app_crm_hoover`
--

--
-- Dumping data for table `users_app_photos`
--

INSERT INTO `users_app_photos` (`id`, `user_id`, `type`, `size`, `path`) VALUES
(33, 2, 'profile', 'xl', 'images/user-profile/profile_1733561939_xl.webp'),
(34, 2, 'profile', 'l', 'images/user-profile/profile_1733561939_l.webp'),
(35, 2, 'profile', 'm', 'images/user-profile/profile_1733561939_m.webp'),
(36, 2, 'profile', 's', 'images/user-profile/profile_1733561939_s.webp'),
(37, 2, 'banner', 'xl', 'images/user-profile/profile_1733562377_xl.webp'),
(38, 2, 'banner', 'l', 'images/user-profile/profile_1733562377_l.webp'),
(39, 2, 'banner', 'm', 'images/user-profile/profile_1733562377_m.webp'),
(40, 2, 'banner', 's', 'images/user-profile/profile_1733562378_s.webp');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
