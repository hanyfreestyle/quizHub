-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 04:43 PM
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
-- Dumping data for table `app_card`
--

INSERT INTO `app_card` (`id`, `user_id`, `uuid`, `slug`, `card_name`, `lang`, `layout_id`, `template_id`, `first_name`, `last_name`, `prefix`, `middle_name`, `preferred_name`, `job_title`, `department`, `company_name`, `accreditations`, `bio`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 3, '691386cc-93fa-4ab1-8594-9eb912da7a8f', 'hany', 'هانى عربى', 'ar', 1, 1, 'هانى', 'درويش', NULL, 'محمد', 'شيكو', 'مصمم مواقع', 'المدير العام', 'نقطة القمة للتجارة والاستثمار', NULL, 'رجل أعمال ناجح وصاحب شركة رائدة في مجال التكنولوجيا، يركز على الابتكار وتقديم حلول متقدمة تلبي احتياجات العملاء.', 1, '2024-12-08 19:15:55', '2024-12-21 05:55:46'),
(2, 3, 'a708a23f-44aa-4652-9002-fa3d51afba88', 'eslamddddd', 'اسلام سلام', 'ar', 2, 5, 'اسلام', 'سلام', NULL, NULL, NULL, 'قبطان بحرى', NULL, NULL, NULL, 'ضابط أول متمرس بخبرة شاملة في المجال البحري تمتد لأكثر من 15 عامًا، يتطلع للانتقال إلى منصب قبطان بحري لتقديم مهاراته القيادية والفنية في توجيه السفن', 1, '2024-12-08 19:18:11', '2024-12-21 15:35:41'),
(3, 3, 'fda84037-6166-477e-ac79-b539b1f0aae6', 'yoyo', 'يوسف حبيبى', 'en', 2, 10, 'Youssef', 'Darwish', NULL, NULL, NULL, 'Web Master', NULL, 'Profile Hub', NULL, 'Student passionate about writing, expressing ideas through words. Enjoys crafting articles and short stories,', 1, '2024-12-09 13:05:58', '2024-12-21 15:42:28'),
(4, 3, '1e824365-9da1-43ea-9014-17dcb90753b9', 'hanydarwish', 'هانى درويش En', 'en', 2, 13, 'Hany', 'Darwish', NULL, NULL, NULL, 'Web Developer', NULL, 'Etman Group', NULL, 'Web developer specializing in building web applications with PHP and JavaScript, passionate about achieving high performance and seamless user experiences.', 1, '2024-12-11 13:07:06', '2024-12-21 12:33:42'),
(6, 4, 'd96d1c0a-7784-4776-81ff-195bc81c9d39', 'eslam', 'شخصى', 'ar', 1, 11, 'اسلام', 'سلام', NULL, 'لبيب', NULL, 'قبطان', NULL, NULL, NULL, 'ضابط أول متمرس بخبرة شاملة في المجال البحري تمتد لأكثر من 15 عامًا، يتطلع للانتقال إلى منصب قبطان بحري لتقديم مهاراته القيادية والفنية في توجيه السفن', 1, '2024-12-20 18:44:35', '2024-12-20 19:25:42');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
