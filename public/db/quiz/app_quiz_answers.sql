-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 09:09 PM
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
-- Database: `app_quiz`
--

--
-- Dumping data for table `app_quiz_answers`
--

INSERT INTO `app_quiz_answers` (`id`, `question_id`, `answer`, `is_correct`) VALUES
(1, 1, 'من نفر', 1),
(2, 1, 'الجيزة', 0),
(3, 1, 'الاقصر', 0),
(4, 1, 'اسوان', 0),
(5, 2, 'بناه الأهرام', 1),
(6, 2, 'عصر الملوك العظام', 0),
(7, 2, 'عصر الفراعنة الذهبية', 0),
(8, 2, 'بداية الإمبراطورية', 0),
(9, 3, 'خفر ع', 1),
(10, 3, 'أوسر كاف', 0),
(11, 3, 'خوفو', 0),
(12, 3, 'أوسر كاف', 0),
(13, 4, 'خوفو', 1),
(14, 4, 'سنفرو', 0),
(15, 4, 'رمسيس الثاني', 0),
(16, 4, 'تحتمس الثالث', 0),
(17, 5, 'الغارات الليبية', 1),
(18, 5, 'الهكسوس', 0),
(19, 5, 'الأشوريين', 0),
(20, 5, 'الحيثيين', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
