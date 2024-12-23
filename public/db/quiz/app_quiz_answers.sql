-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 23, 2024 at 07:45 PM
-- Server version: 8.0.39-cll-lve
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hoovereg_zien`
--

--
-- Dumping data for table `app_quiz_answers`
--

INSERT INTO `app_quiz_answers` (`id`, `question_id`, `answer`, `is_correct`) VALUES
(1, 1, 'من نفر', 1),
(2, 1, 'طيبة', 0),
(3, 1, 'منفيس', 0),
(4, 1, 'أبيدوس', 0),
(5, 2, 'بناه الأهرام', 1),
(6, 2, 'عصر الملوك العظام', 0),
(7, 2, 'عصر الفراعنة الذهبية', 0),
(8, 2, 'بداية الإمبراطورية', 0),
(9, 3, 'خفر ع', 1),
(10, 3, 'أوسر كاف', 0),
(11, 3, 'خوفو', 0),
(12, 3, 'مينا', 0),
(13, 4, 'خوفو', 1),
(14, 4, 'سنفرو', 0),
(15, 4, 'رمسيس الثاني', 0),
(16, 4, 'تحتمس الثالث', 0),
(17, 5, 'الغارات الليبية', 1),
(18, 5, 'الهكسوس', 0),
(19, 5, 'الأشوريين', 0),
(20, 5, 'الحيثيين', 0),
(21, 6, 'رمسيس الاول', 0),
(22, 6, 'ابو الهول', 0),
(23, 6, 'النبيل كاعبر', 1),
(24, 6, 'زوسر', 0),
(25, 7, 'خفر ع', 1),
(26, 7, 'رمسيس الاول', 0),
(27, 7, 'توت عنخ امون', 0),
(28, 7, 'احمس', 0),
(29, 8, 'العجل الذهبى', 0),
(30, 8, 'ابو الهول', 1),
(31, 8, 'تمثال الرأس الخضراء', 0),
(32, 8, 'تمثال رمسيس الاول', 0),
(33, 9, 'أوسر كاف', 1),
(34, 9, 'مينا', 0),
(35, 9, 'امن حتب', 0),
(36, 9, 'احمس', 0),
(37, 10, 'لانه استطاع هزيمة شعوب البحر المتوسط ،وتصدي للغارات الليبية التي كانت في الغرب', 1),
(38, 10, 'لانها تتكيف مع الظروف المناخية . من خلال جذورها العميقة وأوراقها صغيرة الحجم المغطاه بطبقة شمعية لتقليل الفاقد بالنتح', 0),
(39, 10, '.', 0),
(40, 10, '.', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
