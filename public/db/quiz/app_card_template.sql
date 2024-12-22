-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2024 at 04:44 PM
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
-- Dumping data for table `app_card_template`
--

INSERT INTO `app_card_template` (`id`, `uuid`, `card_id`, `layout_id`, `color`, `profile`, `cover`, `logo`, `config`, `is_active`) VALUES
(1, '8ed8a612-e440-46eb-93db-7c1d01253691', 1, 1, '#ff8000', 'images/card/202412/1734778332_7631.webp', 'images/card/202412/1734778353_4371.webp', NULL, '{\"mode\":\"1\",\"desk\":\"list\",\"mobile\":\"grid\",\"iRadius\":\"1\",\"iColor\":\"2\",\"iBorder\":\"1\",\"iName\":\"1\"}', 1),
(2, '986c3387-7008-4de1-82a6-c82c2fd6f139', 2, 1, '#dc3545', 'images/card/202412/1734778244_7373.webp', 'images/card/202412/1734778269_6569.webp', NULL, '{\"mode\":1,\"desk\":\"grid\",\"mobile\":\"grid\",\"iRadius\":1,\"iColor\":1,\"iBorder\":1,\"iName\":1}', 1),
(3, '868d5047-103b-409e-a4e5-25a5f19f0b7c', 3, 1, '#dc3545', 'images/card/202412/1734778495_5288.webp', 'images/card/202412/1734778515_2013.webp', NULL, '{\"mode\":1,\"desk\":\"grid\",\"mobile\":\"grid\",\"iRadius\":1,\"iColor\":1,\"iBorder\":1,\"iName\":1}', 1),
(4, 'df397ec5-c418-4fd5-bc14-fe787a6b0886', 4, 1, '#dc3545', 'images/card/202412/1734778416_4034.webp', 'images/card/202412/1734778443_1837.webp', NULL, '{\"mode\":1,\"desk\":\"grid\",\"mobile\":\"grid\",\"iRadius\":1,\"iColor\":1,\"iBorder\":1,\"iName\":1}', 1),
(5, '6d98bcf9-3e4d-4b8c-99da-ccf7060a43c5', 2, 2, '#dc3545', 'images/card/202412/1734787646_1506.webp', NULL, NULL, '{\"mode\":\"1\",\"desk\":\"list\",\"mobile\":\"list\",\"iRadius\":\"1\",\"iColor\":\"2\",\"iBorder\":\"1\",\"iName\":\"1\"}', 1),
(6, 'cf4a84e1-b1ac-468d-8a9d-da6d6c4c0072', 2, 3, '#dc3545', NULL, NULL, NULL, '{\"mode\":1,\"desk\":\"grid\",\"mobile\":\"grid\",\"iRadius\":1,\"iColor\":1,\"iBorder\":1,\"iName\":1}', 1),
(7, '006893db-d790-496d-aee3-e63cc9108f6c', 1, 2, '#dc3545', NULL, NULL, NULL, '{\"mode\":\"1\",\"desk\":\"list\",\"mobile\":\"list\",\"iRadius\":\"1\",\"iColor\":\"1\",\"iBorder\":\"1\",\"iName\":\"1\"}', 1),
(8, 'a0ba5296-600d-404a-b7cf-1fc3167e789b', 1, 3, '#008080', NULL, NULL, NULL, '{\"mode\":\"1\",\"desk\":\"grid\",\"mobile\":\"grid\",\"iRadius\":\"1\",\"iColor\":\"1\",\"iBorder\":\"1\",\"iName\":\"1\"}', 1),
(10, '31895497-f21a-48a8-911d-9b130faba812', 3, 2, '#dc3545', 'images/card/202412/1734794810_7874.webp', NULL, NULL, '{\"mode\":\"1\",\"desk\":\"grid\",\"mobile\":\"grid\",\"iRadius\":\"1\",\"iColor\":\"1\",\"iBorder\":\"1\",\"iName\":\"1\"}', 1),
(11, '04785c7d-55fc-45a8-96a1-4d159ddfc11e', 6, 1, '#dc3545', NULL, NULL, NULL, '{\"mode\":\"1\",\"desk\":\"grid\",\"mobile\":\"list\",\"iRadius\":\"1\",\"iColor\":\"2\",\"iBorder\":\"1\",\"iName\":\"1\"}', 1),
(12, '639f6dbc-df5c-4b7a-aaab-82f943d494af', 6, 2, '#dc3545', NULL, NULL, NULL, '{\"mode\":\"1\",\"desk\":\"list\",\"mobile\":\"grid\",\"iRadius\":\"1\",\"iColor\":\"2\",\"iBorder\":\"1\",\"iName\":\"1\"}', 1),
(13, '5e13c923-f927-45c1-bd75-e1f9cfeebe3e', 4, 2, '#dc3545', 'images/card/202412/1734784380_5272.webp', NULL, NULL, '{\"mode\":\"1\",\"desk\":\"grid\",\"mobile\":\"grid\",\"iRadius\":\"1\",\"iColor\":\"1\",\"iBorder\":\"1\",\"iName\":\"1\"}', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
