-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2023 at 03:54 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `suigetsu`
--
CREATE DATABASE IF NOT EXISTS `suigetsu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `suigetsu`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int NOT NULL,
  `ad_name` varchar(100) NOT NULL,
  `ad_username` varchar(100) NOT NULL,
  `ad_password` varchar(100) NOT NULL,
  `ad_phone_num` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `ad_name`, `ad_username`, `ad_password`, `ad_phone_num`) VALUES
(1, 'Haziq', 'admin', '123', '01127725564');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CART_ID` varchar(10) NOT NULL,
  `clothesId` int NOT NULL,
  `QUANTITY` int NOT NULL,
  `customerId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CART_ID`, `clothesId`, `QUANTITY`, `customerId`) VALUES
('0388902971', 15, 1, 17),
('0499997454', 18, 1, 15),
('1008766714', 17, 1, 15),
('1460266170', 4, 1, 17),
('1565130828', 8, 1, 7),
('1794883528', 19, 1, 17),
('1794976415', 18, 1, 17),
('1987340613', 4, 7, 15),
('3250425736', 5, 1, 17),
('4351478426', 8, 1, 15),
('5644081183', 14, 1, 17),
('5927991854', 6, 1, 17),
('6972384282', 16, 1, 7),
('7209995039', 15, 1, 15),
('7817093472', 17, 1, 17),
('8020089204', 16, 1, 17),
('8644910033', 8, 1, 17),
('9067159012', 21, 1, 15);

-- --------------------------------------------------------

--
-- Table structure for table `clothes`
--

CREATE TABLE `clothes` (
  `clothesId` int NOT NULL,
  `clothes_title` varchar(100) NOT NULL,
  `clothes_description` varchar(100) NOT NULL,
  `clothes_image1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `clothes_price` decimal(5,2) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clothe_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'Available',
  `clothes_stock` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clothes`
--

INSERT INTO `clothes` (`clothesId`, `clothes_title`, `clothes_description`, `clothes_image1`, `clothes_price`, `date`, `clothe_status`, `clothes_stock`) VALUES
(4, 'T-SHIRT GUNDAM 1', 'All t-shirt are free size!', '648b6507cf748.PNG', '60.00', '2023-06-02 06:57:25', 'available', 200),
(5, 'T-SHIRT GUNDAM 2', 'All t-shirt are free size!', '648b61b6e284a.PNG', '100.00', '2023-06-04 15:33:07', 'available', 200),
(6, 'T-SHIRT GUNDAM 3', 'All t-shirt are free size!', 'gundam style1.jpg', '50.00', '2023-06-04 16:14:18', 'available', 200),
(8, 'T-SHIRT GUNDAM 4', 'All t-shirt are free size!', 'baju_tepung_gundam_limited_1632136234_ac2cec7b.jpg', '70.00', '2023-06-08 06:57:34', 'available', 200),
(14, 'T-SHIRT GUNDAM 5', 'All t-shirt are free size!', '648b625c3f9fe.PNG', '80.00', '2023-06-15 18:54:25', 'available', 200),
(15, 'T-SHIRT GUNDAM 6', 'All t-shirt are free size!', '648b628e5e955.PNG', '120.00', '2023-06-15 18:54:46', 'available', 200),
(16, 'T-SHIRT GUNDAM 7', 'All t-shirt are free size!', '648b627d9da1f.PNG', '120.00', '2023-06-15 18:55:06', 'available', 200),
(17, 'T-SHIRT GUNDAM 8', 'All t-shirt are free size!', '648b6273d9094.PNG', '75.00', '2023-06-15 18:55:27', 'available', 200),
(18, 'T-SHIRT GUNDAM 9', 'All t-shirt are free size!', 'b6.jfif', '130.00', '2023-06-15 18:55:50', 'available', 200),
(19, 'T-SHIRT GUNDAM 10', 'All t-shirt are free size!', '648b62ec6a968.PNG', '79.00', '2023-06-15 18:56:13', 'available', 200),
(20, 'T-SHIRT GUNDAM 11', 'All t-shirt are free size!', '648b64c9dca94.PNG', '89.00', '2023-06-15 18:56:28', 'available', 200),
(21, 'T-SHIRT GUNDAM 12', 'All t-shirt are free size!', '648b62f721bb8.PNG', '130.00', '2023-06-15 18:58:03', 'available', 200);

-- --------------------------------------------------------

--
-- Table structure for table `clothes_orders`
--

CREATE TABLE `clothes_orders` (
  `clothes_orderID` int NOT NULL,
  `clothes_orderQty` int NOT NULL,
  `clothes_orderTotalPrice` int NOT NULL,
  `ordersId` varchar(100) NOT NULL,
  `clothesId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `clothes_orders`
--

INSERT INTO `clothes_orders` (`clothes_orderID`, `clothes_orderQty`, `clothes_orderTotalPrice`, `ordersId`, `clothesId`) VALUES
(25, 3, 180, '5956548173', 4),
(26, 1, 100, '7642746612', 5),
(27, 3, 280, '8793019026', 6),
(28, 1, 280, '8793019026', 4),
(29, 1, 280, '8793019026', 8),
(30, 1, 280, '3187876869', 5),
(31, 1, 280, '3187876869', 4),
(32, 1, 280, '3187876869', 6),
(33, 1, 280, '3187876869', 8),
(34, 2, 120, '9843281972', 4),
(35, 1, 380, '8384698955', 16),
(36, 1, 380, '8384698955', 18),
(37, 1, 380, '8384698955', 21),
(38, 3, 410, '5884931832', 5),
(39, 1, 410, '5884931832', 4),
(40, 1, 410, '5884931832', 6),
(41, 1, 70, '3424286495', 8);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerId` int NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_phoneNo` varchar(12) NOT NULL,
  `customer_gender` char(6) NOT NULL,
  `customer_address` varchar(100) NOT NULL,
  `customer_postcode` char(5) NOT NULL,
  `customer_city` varchar(45) NOT NULL,
  `customer_state` varchar(100) NOT NULL,
  `customer_username` varchar(100) NOT NULL,
  `customer_password` varchar(100) NOT NULL,
  `admin_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerId`, `customer_name`, `customer_phoneNo`, `customer_gender`, `customer_address`, `customer_postcode`, `customer_city`, `customer_state`, `customer_username`, `customer_password`, `admin_id`) VALUES
(1, 'MUHAMMAD HAZIQ BIN MOHD FOZI', '01127725564', 'Male', 'kampung kelanang', '42700', 'klang', 'Johor', 'HAZIQ KOJEK', '$2y$10$n2sed3E4tFGThkia.sB3cuF8Q6jU73efhAFSbD9KDQ.lzdcCJxyC.', NULL),
(7, 'musya ', '017312381203', 'Male', 'asdasd', '40100', 'Kluang', 'Johor', 'musya123', '$2y$10$XDJuknudLvMz38wU5bWAe.MEdGJypgztoPElPkMnZ7cCKtzJhikzi', NULL),
(11, 'Muhammad Haziq Ahza Bin Ahmad Fozi', '01127725564', 'male', 'kampung kelanang', '42700', 'Banting', 'selangor', 'haziq_ahza', '$2y$10$0EL9Ak.2YyBu.WtJYTsfIuFvStOl8q6hmS9HHZDJGXm3Sh3srYhHi', NULL),
(12, 'Ahmad Akmal Bin Ahmad Marzuki', '0123909687', 'male', '110 Jalan Mawar', '43200', 'Taman Indah', 'Selangor', 'kemal', '$2y$10$VF8Wn7zrDktp.su4i83pxua3siX10I5knHkAtqcR3gZeLcD2uT9w2', NULL),
(13, 'Muhammad Faizzul Bin Razak', '0142103443', 'male', '10 Jalan Indah', '40200', 'Shah Alam', 'Selangor', 'uda', '$2y$10$3rzp9lZalsZrz9Zfg50xOufeoUAkNb9TmlgIioi20cyKkJ9awspmi', NULL),
(14, 'Hafizul Hayazi Bin Hafizuddin', '0198677644', 'male', '90 Jalan Cempaka 3/2', '40160', 'Taman Cempaka Indah', 'Selangor', 'john', '$2y$10$A5ePusJh7gAqp9KtMxv9uepo5/8f3GJQDJDi8488xoqIldXGMNpLa', NULL),
(15, 'Muhammad Syahir Aswad Bin Rosdi', '0168909823', 'male', ' 42 Jln Bunga Tanjong 2 Senawang Industrial Park', '70450', 'Seremban', 'Negeri Sembilan', 'panjang', '$2y$10$TDXqW/THwQ1nXhmiC68qeevo0IjJYcnB6UdbVCIEIPc90mgRxWq9C', NULL),
(16, 'Muhammad Ali Bin Hassan', '0178433244', 'male', '15 Jln Bukit Mewah 10A Taman Bukit Mewah', '43000', 'Kajang', 'Selangor', 'ali', '$2y$10$q2VoZi2.BLLKG6KKki2JxOBD1vlhk4elrmks3H6n7r3sPoGqo8hY6', NULL),
(17, 'Nur Qistina Aiysah ', '0125674498', 'Female', 'Lot 43 Jalan 243', '43100', 'Kampung Batu', 'Johor', 'Qistina123', '$2y$10$mZAt1JLen3Cg4Nv0le3WmuybWXT3M3pBzzWdna1fbSYh1E8WOEr4q', NULL),
(18, 'Ahmad Damien', '0154870833', 'male', 'No 231 Jalan Haji Karim', '69100', 'Ulu Belut', 'Kelantan', 'Damien1', '$2y$10$ewJQcJIvbKXf09SHXmazJuSKRwTArM/2omkDIL6LAuE0J03QYQfWO', NULL),
(19, 'Izmy Shah', '0134091566', 'male', 'No 3 Jalan Pak Siakap', '31000', 'Petaling Jaya', 'Selangor', 'Izmy_03', '$2y$10$Gs6c/IQrb4R4.0gsEm/mfeG5FrAeK6eAGJ0L85.qz56FDqq4K6yfG', NULL),
(20, 'Din ', '0165407180', 'Male', 'Ching chong', '43000', 'Chong ching', 'Labuan', 'Chin', '$2y$10$A65FDUfNEZi8j7.GS4SHyecZsVJA9SQxW5KiiblxPuoKEpRtl1ofi', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ordersId` varchar(100) NOT NULL,
  `ordersDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `orderStatus` varchar(100) NOT NULL,
  `customerId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ordersId`, `ordersDate`, `orderStatus`, `customerId`) VALUES
('3187876869', '2023-06-16 01:42:24', 'Accept', 7),
('3424286495', '2023-06-16 07:07:30', 'Reject', 20),
('5884931832', '2023-06-16 06:12:57', 'Pending', 17),
('5956548173', '2023-06-15 20:50:30', 'Accept', 7),
('7642746612', '2023-06-15 20:54:43', 'Completed', 7),
('8372051891', '2023-06-15 20:55:16', 'Completed', 7),
('8384698955', '2023-06-16 05:46:28', 'Pending', 17),
('8793019026', '2023-06-16 01:02:08', 'Reject', 7),
('9843281972', '2023-06-16 04:52:08', 'Pending', 11);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int NOT NULL,
  `payment_amount` decimal(9,2) NOT NULL,
  `receipt` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `payment_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ordersId` varchar(100) NOT NULL,
  `customerId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_amount`, `receipt`, `status`, `payment_date`, `ordersId`, `customerId`) VALUES
(23, '180.00', 'PDF-648bea16683281.32494027.pdf', 'Accept', '2023-06-16 04:50:30', '5956548173', 7),
(24, '180.00', 'PDF-648bea16683281.32494027.pdf', 'Accept', '2023-06-16 04:50:30', '5956548173', 7),
(25, '100.00', 'PDF-648beb13aa1410.38722448.pdf', 'Completed', '2023-06-16 04:54:43', '7642746612', 7),
(26, '100.00', 'PDF-648beb13aa1410.38722448.pdf', 'Accept', '2023-06-16 04:54:43', '7642746612', 7),
(27, '100.00', 'PDF-648beb348cdd37.08402484.pdf', 'Completed', '2023-06-16 04:55:16', '8372051891', 7),
(28, '100.00', 'PDF-648beb348cdd37.08402484.pdf', 'Accept', '2023-06-16 04:55:16', '8372051891', 7),
(29, '280.00', 'PDF-648c2510b7b126.91122125.pdf', 'Pending', '2023-06-16 09:02:08', '8793019026', 7),
(30, '280.00', 'PDF-648c2510b7b126.91122125.pdf', 'Reject', '2023-06-16 09:02:08', '8793019026', 7),
(31, '280.00', 'PDF-648c2e80d16f39.13291004.pdf', 'Accept', '2023-06-16 09:42:24', '3187876869', 7),
(32, '280.00', 'PDF-648c2e80d16f39.13291004.pdf', 'Pending', '2023-06-16 09:42:24', '3187876869', 7),
(33, '120.00', 'PDF-648c5af82e3ab3.28819834.pdf', 'Pending', '2023-06-16 12:52:08', '9843281972', 11),
(34, '120.00', 'PDF-648c5af82e3ab3.28819834.pdf', 'Pending', '2023-06-16 12:52:08', '9843281972', 11),
(35, '380.00', 'PDF-648c67b43cc825.02506711.pdf', 'Pending', '2023-06-16 13:46:28', '8384698955', 17),
(36, '380.00', 'PDF-648c67b43cc825.02506711.pdf', 'Pending', '2023-06-16 13:46:28', '8384698955', 17),
(37, '410.00', 'PDF-648c6de9b7aa54.46064548.pdf', 'Pending', '2023-06-16 14:12:57', '5884931832', 17),
(38, '410.00', 'PDF-648c6de9b7aa54.46064548.pdf', 'Pending', '2023-06-16 14:12:57', '5884931832', 17),
(39, '70.00', 'PDF-648c7ab237fea2.15089490.pdf', 'Completed', '2023-06-16 15:07:30', '3424286495', 20),
(40, '70.00', 'PDF-648c7ab237fea2.15089490.pdf', 'Reject', '2023-06-16 15:07:30', '3424286495', 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CART_ID`),
  ADD KEY `clothesId` (`clothesId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `clothes`
--
ALTER TABLE `clothes`
  ADD PRIMARY KEY (`clothesId`);

--
-- Indexes for table `clothes_orders`
--
ALTER TABLE `clothes_orders`
  ADD PRIMARY KEY (`clothes_orderID`),
  ADD KEY `clothesId` (`clothesId`),
  ADD KEY `ordersId` (`ordersId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ordersId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `ordersId` (`ordersId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `clothes`
--
ALTER TABLE `clothes`
  MODIFY `clothesId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `clothes_orders`
--
ALTER TABLE `clothes_orders`
  MODIFY `clothes_orderID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`clothesId`) REFERENCES `clothes` (`clothesId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `clothes_orders`
--
ALTER TABLE `clothes_orders`
  ADD CONSTRAINT `clothes_orders_ibfk_2` FOREIGN KEY (`clothesId`) REFERENCES `clothes` (`clothesId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `clothes_orders_ibfk_3` FOREIGN KEY (`ordersId`) REFERENCES `orders` (`ordersId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `customers` (`customerId`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`ordersId`) REFERENCES `orders` (`ordersId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
