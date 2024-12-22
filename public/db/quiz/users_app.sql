-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2024 at 09:02 PM
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
-- Dumping data for table `users_app`
--

INSERT INTO `users_app` (`id`, `uuid`, `name`, `email`, `phone`, `phone_code`, `whatsapp`, `whatsapp_code`, `country_id`, `city_id`, `status`, `is_active`, `is_archived`, `photo`, `photo_thum_1`, `email_verified_at`, `password`, `password_temp`, `last_login`, `recovery_code`, `recovery_count`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '6179486a-b084-4d20-b3b6-8ce7756d4b38', 'احمد عتمان', 'etmano@hotmail.com', '01223129660', 'eg', '01223129660', 'eg', 66, 3, 1, 1, 0, NULL, NULL, NULL, '$2y$10$ef5p96KOJnaZLB/OXWrfluqslVzih7317s9GDK7rMW.5rsZMNqu.2', NULL, '2024-04-13 23:53:55', NULL, NULL, NULL, '2024-04-06 22:00:00', '2024-04-13 21:53:55', NULL),
(2, '69058387-cb2c-4331-9941-27f7d5f8a2b6', 'هانى محمد محم ددرويش', 'hany@hanydarwish.com', '01221563252', 'eg', '01221563252', 'eg', 66, 3, 1, 1, 0, NULL, NULL, NULL, '$2y$10$vMuBcuT9iFJfLJaZUnDYleZqweuwPQ90AMaYd2qsbUfK.RfY2jA1G', NULL, '2024-04-13 23:52:28', NULL, NULL, NULL, '2024-04-07 14:58:44', '2024-04-13 21:52:28', NULL),
(3, '24b9e115-a203-4e83-b159-21bb99b2a638', 'hany darwish', 'hany.freestyle4u@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, '$2y$10$LA.I3gfNHIdNE2RQ0l5VBe1MzSmfdWJMNQ66W8Ev5gQXwZpcCvXbu', NULL, '2024-12-20 17:29:04', NULL, NULL, NULL, '2024-12-12 20:44:25', '2024-12-20 15:29:04', NULL),
(4, '676b6fb4-70b5-4c6c-a10e-5d2eae6da291', 'Eslam Sallam', 'eslamsallamm@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, 0, NULL, NULL, NULL, '$2y$10$K4s1IlWcecRH9KjiDJyizuAc8qgECcqsxCYNptzZVkrzAwkeJC06a', NULL, '2024-12-20 20:43:48', NULL, NULL, NULL, '2024-12-20 18:43:48', '2024-12-20 18:43:48', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
