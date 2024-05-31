-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 02:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `cash_management`
--

CREATE TABLE `cash_management` (
  `id` int(255) NOT NULL,
  `cashier_id` int(11) NOT NULL,
  `start_amount` int(11) NOT NULL,
  `payments` float(10,2) NOT NULL,
  `payment_refund` float(10,2) NOT NULL,
  `paid_in` float(10,2) NOT NULL,
  `paid_out` float(10,2) NOT NULL,
  `expected_amount` float(10,2) NOT NULL,
  `actual_cash` float(10,2) NOT NULL,
  `difference` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cash_management`
--

INSERT INTO `cash_management` (`id`, `cashier_id`, `start_amount`, `payments`, `payment_refund`, `paid_in`, `paid_out`, `expected_amount`, `actual_cash`, `difference`) VALUES
(1, 11, 100, 0.00, 0.00, 401.76, -71.90, 429.86, 430.00, 0.14),
(2, 11, 1000, 16.80, 0.00, 199.76, -70.00, 1146.56, 1146.56, 0.00),
(3, 11, 1000, 168.00, 0.00, 199.76, -70.00, 1297.76, 1300.00, 2.24),
(4, 11, 1000, 1680.00, 0.00, 400.00, -240.00, 2840.00, 3000.00, 160.00),
(5, 11, 1000, 16.80, 15.00, 100.00, -50.00, 1051.80, 1051.80, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'Caps'),
(3, 'Clothes'),
(1, 'Demo Category'),
(5, 'Kicks'),
(10, 'Necklace'),
(4, 'Pants'),
(6, 'Shorts '),
(8, 'Underwear');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` float NOT NULL,
  `type` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `name`, `value`, `type`) VALUES
(1, 'No Discount', 0, 'amount'),
(2, '5% Student Discount', 5, 'percent'),
(9, '10php Summer Discount ', 10, 'amount');

-- --------------------------------------------------------

--
-- Table structure for table `groceryitems`
--

CREATE TABLE `groceryitems` (
  `barcode` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groceryitems`
--

INSERT INTO `groceryitems` (`barcode`, `name`, `category`, `price`) VALUES
('012345', 'Rice', 'Grains', 55.00),
('123456', 'Tomato', 'Vegetable', 30.00),
('345678', 'Apple', 'Fruit', 60.00),
('456789', 'Milk', 'Dairy', 120.00),
('567890', 'Eggs', 'Dairy', 80.00),
('678901', 'Carrot', 'Vegetable', 40.00),
('789012', 'Banana', 'Fruit', 50.00),
('789013', 'Broccoli', 'Vegetable', 70.00),
('890123', 'Bread', 'Bakery', 45.00),
('901234', 'Chicken', 'Meat', 150.00);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(255) NOT NULL,
  `action` varchar(60) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `action`, `timestamp`, `user_id`) VALUES
(9, 'logged in', '2024-03-26 00:33:45', 8),
(10, 'logged in', '2024-03-26 00:34:11', 8),
(11, 'logged in', '2024-03-26 00:35:51', 8),
(12, 'logged in', '2024-03-26 00:37:06', 8),
(13, 'logged in', '2024-03-26 00:37:18', 8),
(14, 'logged in', '2024-03-26 03:15:11', 8),
(15, 'logged in', '2024-03-26 03:25:21', 8),
(16, 'logged in', '2024-03-26 03:25:27', 8),
(17, 'logged in', '2024-03-26 03:26:40', 8),
(18, 'logged in', '2024-03-26 03:28:15', 8),
(19, 'Updated user, user_id: 9', '2024-03-26 03:52:44', 8),
(22, 'logged in', '2024-03-26 04:13:36', 8),
(23, 'logged in', '2024-03-26 04:14:05', 8),
(24, 'logged in', '2024-03-26 04:14:05', 8),
(25, 'logged in', '2024-03-26 04:41:48', 8),
(26, 'Added discount, discount_id: ', '2024-03-26 04:44:39', 8),
(27, 'logged in', '2024-03-26 04:46:31', 8),
(28, 'Added discount, discount_id: ', '2024-03-26 04:46:39', 8),
(29, 'logged in', '2024-03-26 04:47:35', 8),
(30, 'Deleted discount, user_id: 6', '2024-03-26 04:47:38', 8),
(31, 'Updated discount, discount_id: 4', '2024-03-26 04:51:55', 8),
(32, 'Updated discount, discount_id: 4', '2024-03-26 04:52:29', 8),
(33, 'Updated discount, discount_id: 4', '2024-03-26 04:54:29', 8),
(34, 'Updated discount, discount_id: 4', '2024-03-26 04:54:29', 8),
(35, 'Added discount, discount_id: ', '2024-03-26 04:54:44', 8),
(36, 'Deleted discount, user_id: 7', '2024-03-26 04:54:53', 8),
(37, 'Updated discount, discount_id: 4', '2024-03-26 04:57:29', 8),
(38, 'logged in', '2024-03-26 06:16:44', 8),
(40, 'logged in', '2024-03-26 06:40:05', 11),
(41, 'logged in', '2024-03-26 06:40:35', 11),
(42, 'logged in', '2024-03-26 06:42:00', 11),
(43, 'logged in', '2024-03-26 06:42:04', 11),
(44, 'logged in', '2024-03-26 06:42:04', 11),
(45, 'logged in', '2024-03-26 06:45:14', 11),
(46, 'logged in', '2024-03-26 06:46:03', 11),
(47, 'logged in', '2024-03-27 19:56:46', 11),
(48, 'logged in', '2024-03-28 04:44:04', 11),
(49, 'Logged out, user_id: 11', '2024-03-28 05:32:41', 11),
(50, 'logged in', '2024-03-28 05:34:15', 11),
(51, 'logged in', '2024-03-28 07:07:28', 11),
(52, 'logged in', '2024-03-28 18:41:41', 11),
(53, 'logged in', '2024-03-29 01:31:28', 11),
(54, 'logged in', '2024-03-29 02:32:17', 11),
(55, 'logged in', '2024-03-29 03:36:53', 11),
(56, 'logged in', '2024-04-09 02:30:21', 11),
(57, 'logged in', '2024-04-09 02:59:01', 11),
(58, 'logged in', '2024-04-09 05:44:12', 11),
(59, 'logged in', '2024-04-09 06:23:02', 11),
(60, 'logged in', '2024-04-09 06:31:57', 11),
(61, 'logged in', '2024-04-09 06:32:01', 11),
(62, 'logged in', '2024-04-09 06:40:08', 11),
(63, 'logged in', '2024-04-09 06:47:04', 11),
(64, 'logged in', '2024-04-09 06:47:05', 11),
(65, 'logged in', '2024-04-09 09:13:30', 11),
(66, 'logged in', '2024-04-09 09:27:23', 11),
(67, 'logged in', '2024-04-10 03:30:15', 11),
(68, 'logged in', '2024-04-10 05:16:07', 11),
(69, 'logged in', '2024-04-10 18:12:33', 11),
(70, 'logged in', '2024-04-10 19:44:56', 11),
(71, 'logged in', '2024-04-25 10:11:26', 11),
(72, 'logged in', '2024-04-25 17:35:45', 11),
(73, 'logged in', '2024-04-25 20:42:31', 11),
(74, 'Logged out, user_id: 11', '2024-04-25 22:47:53', 11),
(75, 'logged in', '2024-04-25 22:48:06', 8),
(76, 'Updated user, user_id: 8', '2024-04-25 22:48:20', 8),
(77, 'Updated user, user_id: 11', '2024-04-25 22:48:32', 8),
(78, 'Logged out, user_id: 8', '2024-04-25 22:52:35', 8),
(79, 'logged in', '2024-04-25 22:52:44', 11),
(80, 'Logged out, user_id: 11', '2024-04-25 23:04:18', 11),
(81, 'logged in', '2024-04-25 23:07:13', 11),
(82, 'Logged out, user_id: 11', '2024-04-25 23:27:03', 11),
(83, 'logged in', '2024-04-25 23:27:19', 8),
(84, 'Logged out, user_id: 8', '2024-04-25 23:28:20', 8),
(85, 'logged in', '2024-04-29 07:25:36', 11),
(86, 'logged in', '2024-04-29 07:32:57', 11),
(87, 'logged in', '2024-04-29 17:28:00', 11),
(88, 'Logged out, user_id: 11', '2024-04-29 17:30:32', 11),
(89, 'logged in', '2024-04-29 17:32:00', 11),
(90, 'logged in', '2024-05-10 17:45:25', 11),
(91, 'logged in', '2024-05-12 05:02:34', 11),
(92, 'Logged out, user_id: 11', '2024-05-12 07:38:06', 11),
(93, 'logged in', '2024-05-12 07:38:13', 11),
(94, 'logged in', '2024-05-12 07:41:50', 11),
(95, 'logged in', '2024-05-12 07:42:57', 11),
(96, 'logged in', '2024-05-14 02:46:21', 11),
(97, 'logged in', '2024-05-14 03:04:49', 11),
(98, 'logged in', '2024-05-14 04:33:22', 11),
(99, 'logged in', '2024-05-14 05:26:52', 11),
(100, 'logged in', '2024-05-14 22:51:24', 11),
(101, 'logged in', '2024-05-15 04:49:06', 11),
(102, 'logged in', '2024-05-15 19:18:31', 11),
(103, 'Logged out, user_id: 11', '2024-05-15 22:03:15', 11),
(104, 'Logged out, user_id: 11', '2024-05-15 22:03:15', 11),
(105, 'logged in', '2024-05-26 08:46:53', 11),
(106, 'logged in', '2024-05-26 22:51:48', 11),
(107, 'logged in', '2024-05-27 03:02:40', 11),
(108, 'logged in', '2024-05-27 04:46:11', 11),
(109, 'logged in', '2024-05-27 04:57:39', 11),
(110, 'logged in', '2024-05-27 05:13:41', 11),
(111, 'logged in', '2024-05-27 05:31:19', 11),
(112, 'logged in', '2024-05-27 05:43:07', 11),
(113, 'logged in', '2024-05-27 08:45:24', 11),
(114, 'logged in', '2024-05-27 08:50:26', 11),
(115, 'logged in', '2024-05-27 08:52:40', 11),
(116, 'logged in', '2024-05-27 09:02:30', 11),
(117, 'logged in', '2024-05-27 22:46:51', 11),
(118, 'logged in', '2024-05-27 22:52:21', 11),
(119, 'logged in', '2024-05-27 23:25:33', 11),
(120, 'logged in', '2024-05-28 02:32:55', 11),
(121, 'logged in', '2024-05-28 04:37:09', 11),
(122, 'logged in', '2024-05-28 04:42:44', 11),
(123, 'logged in', '2024-05-28 08:46:04', 11),
(124, 'logged in', '2024-05-28 19:08:17', 11),
(125, 'Logged out, user_id: 11', '2024-05-28 20:22:56', 11),
(126, 'logged in', '2024-05-28 20:32:20', 11),
(127, 'Logged out, user_id: 11', '2024-05-28 20:33:26', 11),
(128, 'logged in', '2024-05-28 20:35:38', 11),
(129, 'Logged out, user_id: 11', '2024-05-28 20:36:36', 11),
(130, 'logged in', '2024-05-28 20:44:00', 11),
(131, 'Logged out, user_id: 11', '2024-05-28 20:45:37', 11),
(132, 'logged in', '2024-05-28 21:02:01', 11),
(133, 'logged in', '2024-05-29 00:52:45', 11),
(134, 'logged in', '2024-05-29 05:19:48', 11),
(135, 'logged in', '2024-05-29 05:48:20', 11),
(136, 'Logged out, user_id: 11', '2024-05-29 05:54:27', 11),
(137, 'logged in', '2024-05-29 05:54:38', 11),
(138, 'logged in', '2024-05-30 11:05:58', 11),
(139, 'logged in', '2024-05-30 11:07:15', 11),
(140, 'logged in', '2024-05-30 11:26:14', 11),
(141, 'Logged out, user_id: 11', '2024-05-30 11:32:15', 11),
(142, 'logged in', '2024-05-30 11:32:20', 8),
(143, 'logged in', '2024-05-30 11:32:51', 11),
(144, 'logged in', '2024-05-30 11:33:25', 11),
(145, 'logged in', '2024-05-30 11:53:12', 11),
(146, 'logged in', '2024-05-30 21:50:23', 11),
(147, 'logged in', '2024-05-30 22:16:02', 11),
(148, 'logged in', '2024-05-30 22:19:13', 11),
(149, 'logged in', '2024-05-30 22:32:30', 11),
(150, 'Logged out, user_id: 11', '2024-05-30 23:13:43', 11),
(151, 'logged in', '2024-05-30 23:13:48', 11);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `open_ticket`
--

CREATE TABLE `open_ticket` (
  `oTicket_id` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `open_ticket`
--

INSERT INTO `open_ticket` (`oTicket_id`, `bill_id`, `status`) VALUES
(2, 41, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `low_stock_quantity` int(11) DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT 0,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `barcode`, `quantity`, `low_stock_quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`) VALUES
(27, 'Hotdog (Tender Juicy Original)', '8PLFZEU96BXR', 10, 1, 100.00, 110.00, 8, 3, '2024-05-29 16:32:20'),
(28, 'piatos cheese', '0P8OTIJHRV2U', 100, 10, 14.00, 17.00, 11, 0, '2024-05-30 22:48:19'),
(29, 'piatos roastbeef', 'YX3Z48HXDCTV', 100, 10, 14.00, 17.00, 11, 0, '2024-05-30 22:48:46'),
(30, 'piatos sourcream and onion', 'XTXYOLVKEFAN', 100, 10, 14.00, 17.00, 11, 0, '2024-05-30 22:49:46'),
(31, 'piatos nachoscheese', 'WFL1AY60PNXK', 100, 10, 14.00, 17.00, 11, 0, '2024-05-30 22:52:53'),
(32, 'piatos spicycheese', '6C17R3OBD05V', 100, 10, 14.00, 17.00, 11, 0, '2024-05-30 22:53:13'),
(33, 'piatos saltedpotato', '6Z2LCAXQ0W1D', 100, 10, 14.00, 17.00, 11, 0, '2024-05-30 22:53:32');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `id` varchar(255) NOT NULL,
  `sub_total` float(10,2) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `tax` varchar(45) NOT NULL,
  `total` float(10,2) NOT NULL,
  `pay_thru` varchar(45) NOT NULL,
  `paid_amount` float(10,2) NOT NULL,
  `change_amount` float(10,2) NOT NULL,
  `status` varchar(45) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`id`, `sub_total`, `discount`, `tax`, `total`, `pay_thru`, `paid_amount`, `change_amount`, `status`, `date`) VALUES
('REC17171293842620', 4.00, 'No Discount', '12', 4.48, 'Cash', 5.00, 0.52, 'sold', '2024-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_item`
--

CREATE TABLE `receipt_item` (
  `id` int(11) NOT NULL,
  `receipt_id` varchar(255) NOT NULL,
  `item_id` int(11) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refund`
--

CREATE TABLE `refund` (
  `id` int(11) NOT NULL,
  `receipt_item_id` int(11) NOT NULL,
  `reason` varchar(45) NOT NULL,
  `status` varchar(45) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) UNSIGNED NOT NULL,
  `product_id` int(11) UNSIGNED NOT NULL,
  `qty` int(11) NOT NULL,
  `price` decimal(25,2) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `tax_name` varchar(45) NOT NULL,
  `tax_percent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`id`, `tax_name`, `tax_percent`) VALUES
(2, 'vat', 12);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(45) NOT NULL,
  `fname` varchar(45) NOT NULL,
  `lname` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `role`, `fname`, `lname`) VALUES
(8, 'admin@gmail.com', '$2y$10$oTqZut5q9pvBzpFc56RmIOTUjC1VCeEHtsTEL8fd5tRqNIASCdg4S', 'Admin', 'niel', 'lapuz'),
(11, 'cashier@gmail.com', '$2y$10$bXKCEA8T8vbrDQjiit86Z.M3GBljK2T5xrRYdC.OaWh608NIbkPui', 'Cashier', 'jun', 'cadenas');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`) VALUES
(1, 'Kevhin', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.png', 1, '2024-04-29 21:20:54'),
(2, 'John Walker', 'special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'no_image.png', 1, '2024-04-26 13:32:05'),
(3, 'Christopher', 'user', '12dea96fec20593566ab75692c9949596833adc9', 3, 'no_image.png', 1, '2024-04-28 15:54:01'),
(4, 'Natie Williams', 'natie', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 3, 'no_image.png', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Admin', 1, 1),
(2, 'special', 2, 1),
(3, 'User', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `barcode` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `quantity` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `low_stock_quantity` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `buy_price` decimal(25,2) DEFAULT NULL,
  `sale_price` decimal(25,2) NOT NULL,
  `categorie_id` int(11) UNSIGNED NOT NULL,
  `media_id` int(11) DEFAULT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `barcode`, `quantity`, `low_stock_quantity`, `buy_price`, `sale_price`, `categorie_id`, `media_id`, `date`) VALUES
(26, 'hotdog', '123456', '8', '1', 1.00, 15.00, 2, 0, '2024-04-29 19:36:57'),
(27, 'banana', '234567', '10', '2', 10.00, 5.00, 1, NULL, '2024-05-28 10:00:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cash_management`
--
ALTER TABLE `cash_management`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `groceryitems`
--
ALTER TABLE `groceryitems`
  ADD PRIMARY KEY (`barcode`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_ibfk_1` (`user_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `open_ticket`
--
ALTER TABLE `open_ticket`
  ADD PRIMARY KEY (`oTicket_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`),
  ADD KEY `media_id` (`media_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_item`
--
ALTER TABLE `receipt_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_id` (`receipt_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `refund`
--
ALTER TABLE `refund`
  ADD KEY `receipt_item_id` (`receipt_item_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `categorie_id` (`categorie_id`) USING BTREE,
  ADD KEY `media_id` (`media_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cash_management`
--
ALTER TABLE `cash_management`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `open_ticket`
--
ALTER TABLE `open_ticket`
  MODIFY `oTicket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `receipt_item`
--
ALTER TABLE `receipt_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receipt_item`
--
ALTER TABLE `receipt_item`
  ADD CONSTRAINT `receipt_item_ibfk_1` FOREIGN KEY (`receipt_id`) REFERENCES `receipt` (`id`),
  ADD CONSTRAINT `receipt_item_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `refund`
--
ALTER TABLE `refund`
  ADD CONSTRAINT `refund_ibfk_1` FOREIGN KEY (`receipt_item_id`) REFERENCES `receipt_item` (`id`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `SK` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user_level`) REFERENCES `user_groups` (`group_level`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
