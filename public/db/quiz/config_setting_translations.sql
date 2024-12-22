-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 08:19 PM
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
-- Dumping data for table `config_setting_translations`
--

INSERT INTO `config_setting_translations` (`id`, `setting_id`, `locale`, `name`, `closed_mass`, `meta_des`, `whatsapp_des`, `schema_address`, `schema_city`) VALUES
(1, 1, 'ar', 'بروفيل هب', 'عذرا جارى اجراء بعض التحديثات \r\nسنعود قريبا', 'بروفيل هب', 'اريد الاستفسار عن بروفيل هب', 'التجمع الخامس', 'القاهرة الجديدة'),
(2, 1, 'en', 'Profile Hub', 'Sorry, some updates are being made\r\nWe will be back soon', 'Profile Hub', 'Profile Hub', 'streetAddress', 'streetAddress');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
