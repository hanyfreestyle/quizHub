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
-- Dumping data for table `app_card_data`
--

INSERT INTO `app_card_data` (`id`, `card_id`, `cat_id`, `input_id`, `input_key`, `label`, `value`, `position`, `is_active`) VALUES
(1, 1, 1, 2, 'Email', 'البريد الإلكتروني الشخصي', 'hany@hanydarwish.com', 11, 1),
(2, 1, 1, 4, 'Web', 'زيارة موقعنا الإلكتروني', 'https://hanydarwish.com/ar/index.html', 9, 1),
(3, 1, 1, 5, 'CompanyURL', 'الموقع الإلكتروني للشركة', 'https://hanydarwish.com/ar/index.html', 8, 1),
(4, 1, 1, 8, 'BlogURL', 'زيارة مساحة الكتابة الخاصة بنا', 'https://hanydarwish.com/ar/index.html', 12, 1),
(5, 1, 2, 13, 'Shopify', 'متجر Shopify', 'https://storename.myshopify.com', 14, 1),
(6, 1, 2, 14, 'WooCommerce', 'اشترِ الآن عبر WooCommerce', 'https://storename.woocommerce.com', 15, 1),
(7, 1, 2, 15, 'AmazonStore', 'قم بزيارة متجرنا على أمازون', 'https://www.amazon.com/stores/Womier/page/7A4EB5E1-D153-4875-84D2-6D79A733E852', 13, 1),
(8, 1, 2, 19, 'GitHub', 'استعرض مشاريعنا البرمجية', 'https://github.com/hanyfreestyle', 17, 1),
(9, 1, 2, 20, 'GitLab', 'مستودع GitLab', 'https://gitlab.com/user', 16, 1),
(10, 1, 2, 29, 'Dropbox', 'ملفات Dropbox', 'https://www.dropbox.com/user', 18, 1),
(11, 1, 1, 7, 'GoogleMap', 'اعثر علينا على خرائط جوجل', 'https://maps.app.goo.gl/QhRxZZKSD6FA1Kyu6', 19, 1),
(12, 1, 3, 30, 'Facebook', 'تابعنا على Facebook', 'https://www.facebook.com/hanydarwish.info', 2, 1),
(13, 1, 3, 31, 'Twitter', 'صفحتنا على Twitter', 'https://x.com/Freestyle4uHany', 20, 1),
(14, 1, 3, 32, 'LinkedIn', 'تابعنا على LinkedIn', 'https://www.linkedin.com/in/hany-mdarwish/', 21, 1),
(15, 1, 3, 33, 'Instagram', 'صفحتنا على Instagram', 'https://www.instagram.com/hanydarwishalex/', 22, 1),
(16, 1, 3, 34, 'YouTube', 'صفحتنا على YouTube', 'https://www.youtube.com/@SharkTankEgypt', 7, 1),
(17, 1, 3, 35, 'Pinterest', 'تابعنا على Pinterest', 'https://www.pinterest.com/username', 5, 1),
(18, 1, 4, 56, 'Slack', 'استكشف المزيد على Slack', 'https://yourworkspace.slack.com', 23, 1),
(19, 1, 4, 49, 'Messenger', 'تواصل معنا عبر Messenger', 'https://m.me/hanydarwish.info', 3, 1),
(20, 1, 4, 60, 'SnapchatChat', 'تواصل معنا عبر SnapchatChat', 'https://www.snapchat.com/add/username', 24, 1),
(21, 1, 1, 3, 'Phone', 'الهاتف المحمول', '+201221563252', 25, 1),
(22, 1, 1, 3, 'Phone', 'رقم الفاكس', '+2034810303', 10, 1),
(23, 1, 4, 47, 'WhatsApp', 'تواصل معنا عبر WhatsApp', '+201221563252', 1, 1),
(24, 1, 4, 48, 'Telegram', 'تواصل معنا عبر Telegram', '+201221563252', 4, 1),
(25, 1, 4, 51, 'Viber', 'تواصل معنا عبر Viber', '+201096393341', 6, 1),
(26, 2, 1, 3, 'Phone', 'رقم الجوال', '+201096393341', 1, 1),
(27, 2, 1, 2, 'Email', 'البريد الإلكتروني', 'eslamsallamm@gmail.com', 4, 1),
(28, 2, 1, 7, 'GoogleMap', 'انتقل إلى عنواننا', 'https://maps.app.goo.gl/omjYBx4gTWu7E5kK9', 10, 1),
(29, 2, 3, 30, 'Facebook', 'اكتشف المزيد على Facebook', 'https://www.facebook.com/Eslamsallamm', 2, 1),
(30, 2, 3, 31, 'Twitter', 'تابعنا على Twitter', 'https://x.com/user', 6, 1),
(31, 2, 3, 32, 'LinkedIn', 'تابعنا على LinkedIn', 'https://www.linkedin.com/in/user', 7, 1),
(32, 2, 4, 47, 'WhatsApp', 'تواصل معنا عبر WhatsApp', '+201096393341', 3, 1),
(33, 2, 4, 48, 'Telegram', 'تواصل معنا عبر Telegram', '+201096393341', 8, 1),
(34, 2, 4, 49, 'Messenger', 'تواصل معنا عبر Messenger', 'https://m.me/Eslamsallamm', 5, 1),
(35, 2, 4, 51, 'Viber', 'تواصل معنا عبر Viber', '+201096393341', 9, 1),
(36, 4, 1, 3, 'Phone', 'Cell Phone', '201221563252', 1, 1),
(37, 4, 1, 2, 'Email', 'Personal Email', 'hany@hanydarwish.com', 3, 1),
(38, 4, 1, 4, 'Web', 'Visit my website', 'https://hanydarwish.com/ar/index.html', 4, 1),
(39, 4, 3, 30, 'Facebook', 'Join us on Facebook', 'https://www.facebook.com/hanydarwish.info', 5, 1),
(40, 4, 4, 47, 'WhatsApp', 'Connect with us on WhatsApp', '+201221563252', 6, 1),
(41, 4, 1, 5, 'CompanyURL', 'Visit our official website', 'https://hanydarwish.com/ar/index.html', 7, 1),
(42, 4, 3, 33, 'Instagram', 'Our Instagram Page', 'https://www.instagram.com/user', 8, 1),
(43, 4, 3, 34, 'YouTube', 'YouTube', 'https://www.youtube.com/@username', 2, 1),
(44, 6, 4, 47, 'WhatsApp', 'تواصل معنا عبر WhatsApp', '+201096393341', 2, 1),
(45, 6, 1, 3, 'Phone', 'رقم الجوال', '+201096393341', 1, 1),
(46, 6, 3, 30, 'Facebook', 'صفحتنا على Facebook', 'https://www.facebook.com/Eslamsallamm', 3, 1),
(47, 6, 1, 2, 'Email', 'البريد الإلكتروني', 'eslamsallamm@gmail.com', 4, 1),
(48, 6, 3, 33, 'Instagram', 'صفحتنا على Instagram', 'https://www.instagram.com/user', 5, 1),
(49, 6, 4, 49, 'Messenger', 'ماسنجر', 'https://m.me/Eslamsallamm', 6, 1),
(50, 6, 3, 32, 'LinkedIn', 'تابعنا على LinkedIn', 'https://www.linkedin.com/in/eslam-sallam-306900184/', 7, 1),
(51, 6, 3, 31, 'Twitter', 'Twitter', 'https://x.com/Eslamsallamm', 8, 1),
(52, 6, 4, 48, 'Telegram', 'تواصل معنا عبر Telegram', '+201096393341', 9, 1),
(53, 6, 3, 33, 'Instagram', 'صفحتنا على Instagram', 'https://www.instagram.com/eslam_sallam', 10, 1),
(54, 6, 1, 7, 'GoogleMap', 'رابط خرائط جوجل', 'https://maps.app.goo.gl/gEwT8TMQ7xkcQWJZ6', 11, 1),
(55, 3, 4, 47, 'WhatsApp', 'Connect with us on WhatsApp', '+201208256945', 1, 1),
(56, 3, 1, 3, 'Phone', 'Cell Phone', '+201208256945', 2, 1),
(57, 3, 3, 30, 'Facebook', 'Our Facebook Page', 'https://www.facebook.com/100088703757407', 4, 1),
(58, 3, 3, 31, 'Twitter', 'Join us on Twitter', 'https://x.com/user', 5, 1),
(59, 3, 3, 33, 'Instagram', 'Our Instagram Page', 'https://www.instagram.com/user', 3, 1),
(60, 3, 3, 32, 'LinkedIn', 'Our LinkedIn Page', 'https://www.linkedin.com/in/user', 6, 1),
(61, 3, 1, 2, 'Email', 'Email', 'ema@ashasgdj.com', 7, 1),
(62, 3, 4, 60, 'SnapchatChat', 'SnapchatChat', 'https://www.snapchat.com/add/username', 8, 1),
(63, 3, 2, 19, 'GitHub', 'GitHub', 'https://github.com/user', 9, 1),
(64, 3, 4, 56, 'Slack', 'Slack', 'https://yourworkspace.slack.com', 10, 1),
(65, 3, 3, 34, 'YouTube', 'YouTube', 'https://www.youtube.com/@SharkTankEgypt', 11, 1),
(66, 3, 2, 14, 'WooCommerce', 'Shop our products', 'https://storename.woocommerce.com', 12, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
