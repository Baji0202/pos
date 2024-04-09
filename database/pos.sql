-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Mar 29, 2024 at 01:58 PM
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
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cash_management`
--

CREATE TABLE `cash_management` (
  `transaction_id` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cash_in_hand` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clothingitems`
--

CREATE TABLE `clothingitems` (
  `id` int AUTO_INCREMENT PRIMARY KEY NOT NULL,
  `Barcode` varchar(20) NOT NULL,
  `ItemName` varchar(255) NOT NULL,
  `Brand` varchar(255) DEFAULT NULL,
  `Size` varchar(10) DEFAULT NULL,
  `Color` varchar(50) DEFAULT NULL,
  `Material` varchar(255) DEFAULT NULL,
  `Category` varchar(50) NOT NULL,
  `Style` varchar(255) DEFAULT NULL,
  `Price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clothingitems`
--

INSERT INTO `clothingitems` (`id`,`Barcode`, `ItemName`, `Brand`, `Size`, `Color`, `Material`, `Category`, `Style`, `Price`) VALUES
('1','001122334455', 'White Canvas Sneakers', 'Sole Mates', '40', 'White', 'Canvas', 'Shoes', 'Sneakers', 999.75),
('2','112233445566', 'Black Fitness Leggings', 'FitActive', 'Small', 'Black', 'Polyester-Spandex Blend', 'Pants', 'Leggings', 499.95),
('3','123456789012', 'Red Cotton T-Shirt', 'ActiveWear Co.', 'Medium', 'Red', '100% Cotton', 'Shirt', 'Crewneck', 199.99),
('4','221133445566', 'Black Beanie Hat', 'Headwear Co.', 'One Size', 'Black', 'Acrylic Knit', 'Accessory', 'Beanie', 199.75),
('5','334455667788', 'White Button-Up Shirt', 'Formal Wear', 'Medium', 'White', 'Cotton-Polyester Blend', 'Shirt', 'Button-Up', 599.99),
('6','445566778899', 'Blue Denim Jacket', 'Denim & Co.', 'Medium', 'Blue', 'Denim', 'Jacket', 'Trucker Jacket', 1499.99),
('7','556677889900', 'Khaki Chino Shorts', 'Leisure Wear', 'Large', 'Khaki', 'Cotton Twill', 'Shorts', 'Chino', 349.95),
('8','778899001122', 'Floral Print Dress', 'Summer Styles', 'Large', 'Multicolor', 'Rayon', 'Dress', 'A-Line', 1299.50),
('9','889900112233', 'Pink Sports Bra', 'FitActive', 'Medium', 'Pink', 'Nylon-Spandex Blend', 'Activewear', 'Sports Bra', 799.95),
('10','987654321098', 'Blue Denim Jeans', 'Denim & Co.', '32', 'Blue', 'Cotton Blend', 'Pants', 'Straight Leg', 899.75);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(50) NOT NULL,
  `customer_fname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `discount_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`discount_id`, `name`, `value`) VALUES
(8, '20% Student Discount', 0.8);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `item_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `size` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`item_id`, `name`, `color`, `size`, `type`) VALUES
(1, 'T-Shirt', 'Red', 'M', 'Shirt'),
(2, 'Jeans', 'Blue', '32', 'Pants'),
(3, 'Dress', 'Black', 'S', 'Dress');

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
(1, 'logged in', '2024-03-25 20:46:38', 3),
(2, 'logged in', '2024-03-25 20:47:40', 3),
(3, 'logged in', '2024-03-25 20:50:13', 3),
(4, 'logged in', '2024-03-25 20:59:03', 3),
(7, 'Inserted a new user,user_id: 8', '2024-03-26 00:32:50', 3),
(8, 'Inserted a new user,user_id: 9', '2024-03-26 00:32:50', 3),
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
(20, 'Inserted a new user,user_id: 10', '2024-03-26 03:59:07', 3),
(21, 'Deleted user, user_id: 10', '2024-03-26 04:01:33', 3),
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
(39, 'Inserted a new user,user_id: 11', '2024-03-26 06:39:32', 3),
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
(55, 'logged in', '2024-03-29 03:36:53', 11);

-- --------------------------------------------------------

--
-- Table structure for table `open_ticket`
--

CREATE TABLE `open_ticket` (
  `oTicket_id` int(11) NOT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` int(11) NOT NULL,
  `date` datetime DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `bill_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `refunds`
--

CREATE TABLE `refunds` (
  `transaction_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `refund_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(3, 'ram@gmail.com', '$2y$10$WrYXNQJFdmpazF4qnHl7Fed0KISJ8IPDx5W50rGSl34bxfIu.r9Vy', 'Admin', 'ram', 'ocampo'),
(8, 'neil@gmail.com', '$2y$10$oTqZut5q9pvBzpFc56RmIOTUjC1VCeEHtsTEL8fd5tRqNIASCdg4S', 'Admin', 'niel', 'lapuz'),
(11, 'j@gmail.com', '$2y$10$bXKCEA8T8vbrDQjiit86Z.M3GBljK2T5xrRYdC.OaWh608NIbkPui', 'Cashier', 'jun', 'cadenas');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `discount_id` (`discount_id`);

--
-- Indexes for table `cash_management`
--
ALTER TABLE `cash_management`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `clothingitems`
--
ALTER TABLE `clothingitems`
  ADD PRIMARY KEY (`Barcode`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`discount_id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_ibfk_1` (`user_id`);

--
-- Indexes for table `open_ticket`
--
ALTER TABLE `open_ticket`
  ADD PRIMARY KEY (`oTicket_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `bill_id` (`bill_id`);

--
-- Indexes for table `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cash_management`
--
ALTER TABLE `cash_management`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `discount_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `item_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `refunds`
--
ALTER TABLE `refunds`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`discount_id`) REFERENCES `discount` (`discount_id`);

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `open_ticket`
--
ALTER TABLE `open_ticket`
  ADD CONSTRAINT `open_ticket_ibfk_1` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `item` (`item_id`);

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_2` FOREIGN KEY (`payment_id`) REFERENCES `payment_method` (`payment_id`),
  ADD CONSTRAINT `receipt_ibfk_3` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`);

--
-- Constraints for table `refunds`
--
ALTER TABLE `refunds`
  ADD CONSTRAINT `refunds_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
