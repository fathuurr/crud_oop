-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2021 at 03:18 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `image` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `image`, `price`, `create_date`) VALUES
(1, 'Iphone 12', NULL, NULL, '2000.00', '2021-03-09 21:09:43'),
(2, 'galaxy s20', NULL, NULL, '3000.00', '2021-03-09 21:09:43'),
(6, 'Village Breach', 'apasoih ini', '', '1230.00', '2021-03-12 14:00:29'),
(7, 'muka gua', 'ooohhh', 'images/j1WuyuDU/ltmpt_photos.png', '900.00', '2021-03-13 16:11:29'),
(8, 'KEREEENN', 'ooohh gituuu', 'images/M3SipOf8/lamaran.jpeg', '9090.00', '2021-03-13 16:14:13'),
(9, 'test baru', 'test baru ajhh', 'images/UEOkfW0x/smt5_Page_3.jpg', '8000.00', '2021-03-29 03:21:11'),
(10, 'baru lagi', 'apaan kek', 'images/bPKFWzYR/smt5_final.jpg', '9000.00', '2021-03-29 03:52:33'),
(11, 'fitto goblok', 'fitto sipit pea', 'images/vvj0TkYT/smt5_Page_3.jpg', '90000.00', '2021-03-29 15:17:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
