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

-- --------------------------------------------------------

--
-- Table structure for table `app_quiz_questions`
--

CREATE TABLE `app_quiz_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `position` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_quiz_questions`
--

INSERT INTO `app_quiz_questions` (`id`, `question`, `position`, `created_at`, `updated_at`) VALUES
(1, 'اتخذ أول ملوك العصر العتيق عاصمة لمصر الموحدة هي مدينة', 0, '2024-12-22 15:44:09', '2024-12-22 15:44:09'),
(2, 'سمي عصر الدولة القديمة باسم عصر ؟', 0, '2024-12-22 16:08:48', '2024-12-22 16:08:48'),
(3, 'صاحب الهرم الأوسط هو الملك..', 0, '2024-12-22 16:09:31', '2024-12-22 20:06:41'),
(4, 'ثاني ملوك الأسرة ال  4 في مصر القديمة هو الملك ؟', 0, '2024-12-22 16:10:18', '2024-12-22 16:10:18'),
(5, 'أسس الملك أمنمحات الأول سلسلة حصون علي الحدود الغربية للدلتا للحماية من', 0, '2024-12-22 20:07:42', '2024-12-22 20:07:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_quiz_questions`
--
ALTER TABLE `app_quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_quiz_questions`
--
ALTER TABLE `app_quiz_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
