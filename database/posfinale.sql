-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Jun 06, 2024 at 02:46 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `posfinale`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessright`
--

CREATE TABLE `accessright` (
  `accessID` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `accept` int(11) NOT NULL,
  `access` varchar(100) NOT NULL,
  `discounts` int(11) NOT NULL,
  `taxes` int(11) NOT NULL,
  `drawer` int(11) NOT NULL,
  `viewreceipts` int(11) NOT NULL,
  `refunds` int(11) NOT NULL,
  `Reprint` int(11) NOT NULL,
  `shift` int(11) NOT NULL,
  `Manageitem` int(11) NOT NULL,
  `costitem` int(11) NOT NULL,
  `settings` int(11) NOT NULL,
  `bViewsales` int(11) NOT NULL,
  `bmanageitem` int(11) NOT NULL,
  `bviewcost` int(11) NOT NULL,
  `bmanageemployee` int(11) NOT NULL,
  `bmanagecustomers` int(11) NOT NULL,
  `bmanagefeatured` int(11) NOT NULL,
  `bmanagebilling` int(11) NOT NULL,
  `bmanagepayment` int(11) NOT NULL,
  `bmanageloyalty` int(11) NOT NULL,
  `bmanagetaxes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accessright`
--

INSERT INTO `accessright` (`accessID`, `name`, `accept`, `access`, `discounts`, `taxes`, `drawer`, `viewreceipts`, `refunds`, `Reprint`, `shift`, `Manageitem`, `costitem`, `settings`, `bViewsales`, `bmanageitem`, `bviewcost`, `bmanageemployee`, `bmanagecustomers`, `bmanagefeatured`, `bmanagebilling`, `bmanagepayment`, `bmanageloyalty`, `bmanagetaxes`) VALUES
(36, 'asdasd', 0, 'pos,back_office', 1, 1, 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 1, 1, 1, 0, 0, 1, 0, 0),
(37, 'tbetset', 0, 'pos,back_office', 1, 0, 1, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(38, 't5nyr5fynmdrcy', 0, 'pos,back_office', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 0, 0, 0, 0),
(39, 'thbtcfunftuntfc', 0, 'pos,back_office', 0, 1, 0, 1, 1, 0, 1, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(40, 'r6un6drnur6un', 0, 'pos,back_office', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(41, 'goodshit', 1, 'pos,back_office', 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0),
(42, 'ayssss', 0, 'pos', 1, 0, 1, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(46, 'qwerty', 1, 'pos', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `clockInTime` datetime NOT NULL,
  `clockOutTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `userID`, `clockInTime`, `clockOutTime`) VALUES
(66, 17, '2024-03-18 13:15:25', '2024-03-18 13:15:33'),
(67, 17, '2024-03-18 13:15:46', '2024-03-18 13:16:03'),
(69, 17, '2024-03-18 15:10:45', '2024-03-18 15:10:55'),
(70, 17, '2024-03-18 15:11:02', NULL),
(71, 17, '2024-03-19 05:41:22', NULL),
(72, 17, '2024-03-19 07:36:05', '2024-03-19 08:03:16'),
(73, 17, '2024-03-19 08:03:23', '2024-03-19 08:04:26'),
(74, 17, '2024-03-19 08:04:31', NULL),
(75, 17, '2024-03-26 08:09:15', '2024-03-26 10:02:50'),
(76, 17, '2024-03-26 10:02:52', '2024-03-26 10:17:50'),
(77, 17, '2024-03-26 10:17:56', '2024-03-26 10:41:14'),
(78, 17, '2024-03-26 10:41:20', '2024-03-26 11:19:42'),
(79, 17, '2024-03-26 12:37:33', '2024-03-26 12:37:36'),
(80, 17, '2024-03-26 12:37:41', '2024-03-26 13:43:59'),
(82, 17, '2024-03-26 19:08:30', '2024-03-26 19:08:40'),
(83, 17, '2024-03-26 19:08:58', NULL),
(84, 17, '2024-03-28 13:52:39', NULL),
(85, 17, '2024-03-30 09:53:22', NULL),
(86, 17, '2024-03-31 11:02:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_trail`
--

INSERT INTO `audit_trail` (`id`, `action`, `user`, `timestamp`) VALUES
(1, 'User logged in', 'admin@gmail.com', '2024-05-09 16:23:38'),
(2, 'User Logged Out', 'admin@gmail.com', '2024-05-09 16:46:29'),
(3, 'User logged in', 'admin@gmail.com', '2024-05-09 16:46:34'),
(4, 'User Logged Out', 'admin@gmail.com', '2024-05-09 16:47:22'),
(5, 'User logged in', 'admin@gmail.com', '2024-05-09 16:49:09'),
(6, 'User Deleted', 'admin@gmail.com', '2024-05-09 16:50:07'),
(7, 'User Deleted', 'admin@gmail.com', '2024-05-09 16:50:08'),
(8, 'User logged in', 'admin@gmail.com', '2024-05-09 16:56:59'),
(9, 'User logged in', 'admin@gmail.com', '2024-05-09 16:58:29'),
(10, 'User logged in', 'admin@gmail.com', '2024-05-09 17:01:06'),
(11, 'User Updated', 'admin@gmail.com', '2024-05-09 17:01:21'),
(12, 'User Updated', 'admin@gmail.com', '2024-05-09 17:02:04'),
(13, 'User Updated', 'admin@gmail.com', '2024-05-09 17:02:12'),
(14, 'User Updated', 'admin@gmail.com', '2024-05-09 17:02:16'),
(15, 'User Updated', 'admin@gmail.com', '2024-05-09 17:02:24'),
(16, 'User Updated', 'admin@gmail.com', '2024-05-09 17:26:44'),
(17, 'User Updated', 'admin@gmail.com', '2024-05-09 17:26:58'),
(18, 'User Updated', 'admin@gmail.com', '2024-05-09 17:27:04'),
(19, 'User Updated', 'admin@gmail.com', '2024-05-09 17:28:52'),
(20, 'User Updated', 'admin@gmail.com', '2024-05-09 17:29:20'),
(21, 'User Updated', 'admin@gmail.com', '2024-05-09 17:29:28'),
(22, 'User Updated', 'admin@gmail.com', '2024-05-09 17:29:38'),
(23, 'User Updated', 'admin@gmail.com', '2024-05-09 17:42:57'),
(24, 'User Updated', 'admin@gmail.com', '2024-05-09 17:43:04'),
(25, 'User Updated', 'admin@gmail.com', '2024-05-09 17:43:15'),
(26, 'User Updated', 'admin@gmail.com', '2024-05-09 18:13:49'),
(27, 'User Updated', 'admin@gmail.com', '2024-05-09 18:37:35'),
(28, 'User Updated', 'admin@gmail.com', '2024-05-09 18:37:44'),
(29, 'User logged in', 'admin@gmail.com', '2024-05-10 10:29:34'),
(30, 'User Deleted', 'admin@gmail.com', '2024-05-10 10:39:49'),
(31, 'User Deleted', 'admin@gmail.com', '2024-05-10 10:39:50'),
(32, 'User Deleted', 'admin@gmail.com', '2024-05-10 10:40:26'),
(33, 'User logged in', 'admin@gmail.com', '2024-05-12 12:09:34'),
(34, 'User logged in', 'admin@gmail.com', '2024-05-17 08:14:53'),
(35, 'User Deleted', 'admin@gmail.com', '2024-05-17 08:27:47'),
(36, 'User Updated', 'admin@gmail.com', '2024-05-17 09:41:41'),
(37, 'User Updated', 'admin@gmail.com', '2024-05-17 09:43:57'),
(38, 'User Updated', 'admin@gmail.com', '2024-05-17 09:44:27'),
(39, 'User Updated', 'admin@gmail.com', '2024-05-17 09:44:36'),
(40, 'User Updated', 'admin@gmail.com', '2024-05-17 10:03:01'),
(41, 'User Updated', 'admin@gmail.com', '2024-05-17 10:03:06'),
(42, 'User Updated', 'admin@gmail.com', '2024-05-17 10:03:11'),
(43, 'User Updated', 'admin@gmail.com', '2024-05-17 10:03:17'),
(44, 'User Updated', 'admin@gmail.com', '2024-05-17 10:03:22'),
(45, 'User logged in', 'admin@gmail.com', '2024-05-20 06:50:04'),
(46, 'User logged in', 'admin@gmail.com', '2024-05-28 03:59:42'),
(47, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:26:39'),
(48, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:22'),
(49, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:22'),
(50, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:25'),
(51, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:28'),
(52, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:29'),
(53, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:29'),
(54, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:30'),
(55, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:30'),
(56, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:31'),
(57, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:32'),
(58, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:33'),
(59, 'User Deleted', 'admin@gmail.com', '2024-05-28 06:42:33'),
(60, 'User Updated', 'admin@gmail.com', '2024-05-28 12:03:14'),
(61, 'User logged in', 'admin@gmail.com', '2024-05-29 03:30:17'),
(62, 'User logged in', 'admin@gmail.com', '2024-05-29 22:50:10'),
(63, 'User logged in', 'admin@gmail.com', '2024-05-30 14:18:59'),
(64, 'User logged in', 'admin@gmail.com', '2024-05-30 14:20:50');

-- --------------------------------------------------------

--
-- Table structure for table `cash_management`
--

CREATE TABLE `cash_management` (
  `id` int(11) NOT NULL,
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
(1, 11, 10000, 3130.40, 220.00, 100.00, -10.00, 13000.40, 14000.00, 999.60),
(2, 11, 10000, 3130.40, 220.00, 100.00, -10.00, 13000.40, 14000.00, 999.60);

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
(4, 'Bakery'),
(3, 'Beverages'),
(2, 'Dairy'),
(6, 'Dry Goods &amp; Canned Goods'),
(1, 'Fresh Produce'),
(8, 'Frozen Foods'),
(12, 'Health &amp; Beauty'),
(13, 'Household Items'),
(14, 'International Foods'),
(5, 'Meat and Poultry'),
(10, 'Seafood'),
(11, 'Snacks'),
(15, 'Specialty Diets');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `id` int(11) NOT NULL,
  `visits` int(11) NOT NULL,
  `tvisit` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `counter`
--

INSERT INTO `counter` (`id`, `visits`, `tvisit`, `date`) VALUES
(1, 1, 0, '2024-05-29 22:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `customer_account`
--

CREATE TABLE `customer_account` (
  `id` int(11) NOT NULL,
  `barcode_image` varchar(255) NOT NULL,
  `profpic` varchar(255) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Contact` double NOT NULL,
  `TotalVisits` int(11) NOT NULL,
  `LoyaltyPoints` int(11) NOT NULL,
  `TotalPurchase` int(11) NOT NULL,
  `Notes` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_account`
--

INSERT INTO `customer_account` (`id`, `barcode_image`, `profpic`, `FullName`, `Email`, `Address`, `Contact`, `TotalVisits`, `LoyaltyPoints`, `TotalPurchase`, `Notes`) VALUES
(1, '!2024650522563', 'pictureko.jpg', 'Cris', 'domingocris92@gmail.com', 'Cabiao, Nueva Ecija', 1234, 8, 12, 0, ''),
(2, '!2024256798172', '', 'test', 'test@gmail.com', 'Sta Rita, Bacolor', 123469, 3, 4, 0, ''),
(3, '!2024946824608', '', 'Shaira Mae', 'inlong@gmail.com', 'xxdiyan', 1234678, 0, 0, 0, ''),
(4, '!2024336070550', '', 'test2', 'test@gmail.com', 'test', 1, 0, 0, 0, ''),
(5, '!2024419584715', '', 'test3', 'test@gmail.com', 'test', 3, 0, 0, 0, ''),
(6, '!2024602547749', '', 'test5', 'test@gmail.com', 'test', 1, 0, 0, 0, ''),
(7, '!2024393039605', '', 'test4', 'test@gmail.com', 'test', 4, 0, 0, 0, ''),
(8, '!2024101409199', '', 'test8', 'teresa@gmail.com', 'test', 8, 0, 0, 0, ''),
(9, '!2024844503572', '', 'test9', 'test@gmail.com', 'test', 9, 0, 0, 0, ''),
(10, '!202444938289', '', 'test10', 'test@gmail.com', 'test', 10, 0, 0, 0, ''),
(11, '!2024650522563', '', 'Dexter', 'dexxx@gmail.com', 'Jaen, Nueva Ecija', 1234, 0, 0, 0, '');

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
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `userID` int(11) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `AppliedRole` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `accessID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`userID`, `Fullname`, `AppliedRole`, `Date`, `accessID`) VALUES
(2, 'ferrr', 'Administrator', '2024-03-01', 0),
(10, 'yiiiii', 'Manager', '2024-03-18', 25),
(12, 'gtrbtyb', 'Cashier', '2024-03-18', 24),
(13, 'ebtxdtntb', 'Cashier', '2024-03-18', 23);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `action` varchar(60) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `action`, `timestamp`, `user_id`) VALUES
(1, 'logged in', '2024-06-05 21:44:13', 11),
(2, 'logged in', '2024-06-05 21:44:13', 11),
(3, 'Logged out, user_id: 11', '2024-06-05 22:15:44', 11),
(4, 'logged in', '2024-06-05 22:16:01', 11),
(5, 'logged in', '2024-06-05 22:48:49', 11),
(6, 'logged in', '2024-06-06 01:28:42', 11),
(7, 'logged in', '2024-06-06 03:45:41', 11);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `file_name`, `file_type`) VALUES
(3, 'HotdogTenderJuicy.png', 'image/png');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `quantity` varchar(50) DEFAULT NULL,
  `low_stock_quantity` varchar(50) DEFAULT NULL,
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
(38, 'Hotdog (Tender Juicy Original)', '8PLFZEU96BXR', '56', '10', 100.00, 110.00, 8, 3, '2024-05-29 17:28:59');

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
-- Table structure for table `refund_items`
--

CREATE TABLE `refund_items` (
  `id` int(11) NOT NULL,
  `receipt_item_id` int(11) NOT NULL,
  `refund_quantity` int(11) NOT NULL,
  `cashier_id` int(11) NOT NULL,
  `timestamps` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reason` varchar(255) NOT NULL
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
-- Table structure for table `timecards`
--

CREATE TABLE `timecards` (
  `timeid` int(11) NOT NULL,
  `clockOut` datetime NOT NULL,
  `employeeID` varchar(100) NOT NULL,
  `store` varchar(100) DEFAULT NULL,
  `totalHours` varchar(100) NOT NULL,
  `clockIn` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timecards`
--

INSERT INTO `timecards` (`timeid`, `clockOut`, `employeeID`, `store`, `totalHours`, `clockIn`) VALUES
(1, '2024-03-22 07:14:00', '2', 'jabi', '330', '2024-03-08 07:14:00'),
(2, '2024-03-15 07:31:00', '7', 'mcdo', '144', '2024-03-09 07:31:00'),
(3, '2024-03-19 02:43:00', '2', NULL, '9', '2024-03-19 11:43:00'),
(4, '2024-03-19 21:43:00', '2', NULL, '12', '2024-03-19 09:43:00'),
(5, '2024-03-19 11:49:00', '10', NULL, '5', '2024-03-19 09:49:00'),
(6, '2024-03-19 21:55:00', '7', NULL, '12', '2024-03-19 09:55:00'),
(7, '2024-03-19 17:07:00', '10', NULL, '7', '2024-03-19 10:07:00'),
(8, '2024-03-19 11:11:00', '15', NULL, '1.02', '2024-03-19 10:10:00'),
(9, '2024-03-26 08:50:00', '7', NULL, '0.02', '2024-03-26 08:49:00'),
(10, '2024-03-26 08:51:00', '2', NULL, '0.03', '2024-03-26 08:49:00'),
(11, '2024-03-26 08:52:00', '2', NULL, '0.05', '2024-03-26 08:49:00'),
(12, '2024-03-26 08:53:00', '2', NULL, '0.07', '2024-03-26 08:49:00'),
(13, '2024-03-26 08:56:00', '2', NULL, '0.07', '2024-03-26 08:52:00'),
(14, '2024-03-26 08:53:00', '2', NULL, '0.03', '2024-03-26 08:51:00'),
(15, '2024-03-26 09:52:00', '2', NULL, '1', '2024-03-26 08:52:00'),
(16, '2024-03-26 11:52:00', '2', NULL, '3', '2024-03-26 08:52:00'),
(17, '2024-03-26 08:58:00', '2', NULL, '0.03', '2024-03-26 08:56:00'),
(18, '2024-03-26 19:09:00', '7', NULL, '0.07', '2024-03-26 19:05:00');

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
-- Table structure for table `usercredential`
--

CREATE TABLE `usercredential` (
  `userID` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `levelofaccess` int(11) NOT NULL,
  `accessID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usercredential`
--

INSERT INTO `usercredential` (`userID`, `username`, `password`, `levelofaccess`, `accessID`) VALUES
(17, 'fer', '$2y$10$22LvslwIbEiqNiab0pt1DO0/Q2bMMurAAtktijM3rDw3wQc6EV4F6', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userinformation`
--

CREATE TABLE `userinformation` (
  `userID` int(11) NOT NULL,
  `FirstName` text NOT NULL,
  `MiddleName` text NOT NULL,
  `LastName` text NOT NULL,
  `Address` text NOT NULL,
  `DateofBirth` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'Kevhin', 'Admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 1, 'no_image.png', 1, '2024-06-06 10:52:23'),
(2, 'John Walker', 'special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'no_image.png', 1, '2024-06-06 10:50:56'),
(3, 'Christopher', 'user', '12dea96fec20593566ab75692c9949596833adc9', 3, 'no_image.png', 1, '2024-04-28 15:54:01'),
(4, 'Natie Williams', 'natie', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8', 3, 'no_image.png', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usertb_account`
--

CREATE TABLE `usertb_account` (
  `id` int(11) NOT NULL,
  `barcode_image` varchar(255) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PassWord` varchar(255) NOT NULL,
  `FullName` varchar(50) NOT NULL,
  `usertype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertb_account`
--

INSERT INTO `usertb_account` (`id`, `barcode_image`, `Email`, `PassWord`, `FullName`, `usertype`) VALUES
(3, 'uploaded_image/barcodes_img/6640b17a8b2df.png', 'admin@gmail.com', '$2y$10$KspbJ0Ty57wJmmrFAdavyOblvOo07uk/iT.gJRKr40qVBEAw.WQOG', 'admin', 0);

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
(27, 'Hotdog (Tender Juicy Original)', '8PLFZEU96BXR', '10', '1', 100.00, 110.00, 8, 3, '2024-05-29 16:32:20'),
(28, 'piatos cheese', '0P8OTIJHRV2U', '100', '10', 14.00, 17.00, 11, 0, '2024-05-30 22:48:19'),
(29, 'piatos roastbeef', 'YX3Z48HXDCTV', '100', '10', 14.00, 17.00, 11, 0, '2024-05-30 22:48:46'),
(30, 'piatos sourcream and onion', 'XTXYOLVKEFAN', '100', '10', 14.00, 17.00, 11, 0, '2024-05-30 22:49:46'),
(31, 'piatos nachoscheese', 'WFL1AY60PNXK', '100', '10', 14.00, 17.00, 11, 0, '2024-05-30 22:52:53'),
(32, 'piatos spicycheese', '6C17R3OBD05V', '100', '10', 14.00, 17.00, 11, 0, '2024-05-30 22:53:13'),
(33, 'piatos saltedpotato', '6Z2LCAXQ0W1D', '100', '10', 14.00, 17.00, 11, 0, '2024-05-30 22:53:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessright`
--
ALTER TABLE `accessright`
  ADD PRIMARY KEY (`accessID`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_account`
--
ALTER TABLE `customer_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

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
  ADD KEY `item_id` (`item_id`),
  ADD KEY `receipt_id` (`receipt_id`);

--
-- Indexes for table `refund_items`
--
ALTER TABLE `refund_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `receipt_item_id` (`receipt_item_id`),
  ADD KEY `cashier_id` (`cashier_id`);

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
-- Indexes for table `timecards`
--
ALTER TABLE `timecards`
  ADD PRIMARY KEY (`timeid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `usercredential`
--
ALTER TABLE `usercredential`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `userinformation`
--
ALTER TABLE `userinformation`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_level` (`user_level`);

--
-- Indexes for table `usertb_account`
--
ALTER TABLE `usertb_account`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `accessright`
--
ALTER TABLE `accessright`
  MODIFY `accessID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `cash_management`
--
ALTER TABLE `cash_management`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `counter`
--
ALTER TABLE `counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_account`
--
ALTER TABLE `customer_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `receipt_item`
--
ALTER TABLE `receipt_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `refund_items`
--
ALTER TABLE `refund_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `timecards`
--
ALTER TABLE `timecards`
  MODIFY `timeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `usercredential`
--
ALTER TABLE `usercredential`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `userinformation`
--
ALTER TABLE `userinformation`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usertb_account`
--
ALTER TABLE `usertb_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `usercredential` (`userID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `receipt_item`
--
ALTER TABLE `receipt_item`
  ADD CONSTRAINT `receipt_item_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `receipt_item_ibfk_2` FOREIGN KEY (`receipt_id`) REFERENCES `receipt` (`id`);

--
-- Constraints for table `refund_items`
--
ALTER TABLE `refund_items`
  ADD CONSTRAINT `refund_items_ibfk_1` FOREIGN KEY (`receipt_item_id`) REFERENCES `receipt_item` (`id`),
  ADD CONSTRAINT `refund_items_ibfk_2` FOREIGN KEY (`cashier_id`) REFERENCES `user` (`user_id`);

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
