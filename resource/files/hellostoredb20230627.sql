-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2023 at 11:54 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hellostoredb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL COMMENT 'ADMINS ID',
  `admin_name` varchar(64) NOT NULL,
  `admin_email` varchar(64) NOT NULL,
  `admin_image` text NOT NULL,
  `admin_password` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `admin_type` enum('Root Admin','Content Manager','Sales Manager','Technical Operator') NOT NULL,
  `admin_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `admin_name`, `admin_email`, `admin_image`, `admin_password`, `admin_type`, `admin_status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'HieuTran', 'hieu29dhxd@gmail.com', '', '123', 'Root Admin', 'Active', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'CATEGORIES ID',
  `category_name` varchar(64) NOT NULL,
  `category_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 'ÁO NAM', 'Active', '0', '2023-04-29 15:25:59', '2023-04-29 15:25:59'),
(2, 'QUẦN NAM', 'Active', '0', '2023-04-29 15:25:59', '2023-04-29 15:25:59'),
(3, 'PHỤ KIỆN', 'Active', '0', '2023-04-29 15:25:59', '2023-06-26 16:21:47'),
(18, 'test1', 'Active', '1', '2023-05-23 16:51:09', '2023-05-23 21:49:06'),
(22, 'test2', 'Active', '1', '2023-05-23 16:57:10', '2023-05-23 21:59:17'),
(26, 'test6555', 'Active', '1', '2023-05-23 16:57:28', '2023-05-23 21:12:39'),
(28, 'Áo Nam Test', 'Active', '1', '2023-05-29 11:08:45', '2023-06-26 15:54:25'),
(29, 'test', 'Active', '1', '2023-05-31 22:51:21', '2023-05-31 22:51:21'),
(30, 'adasdf', 'Active', '1', '2023-06-02 18:45:45', '2023-06-02 18:45:45'),
(31, 'test', 'Active', '1', '2023-06-03 01:54:42', '2023-06-03 01:54:42'),
(32, 'test1', 'Active', '1', '2023-06-03 01:57:32', '2023-06-03 01:57:32'),
(33, 'test2', 'Active', '1', '2023-06-03 01:57:36', '2023-06-03 01:57:36'),
(34, 'test3', 'Active', '1', '2023-06-03 01:57:40', '2023-06-03 01:57:40'),
(35, 'test4', 'Active', '1', '2023-06-03 01:57:44', '2023-06-03 01:57:44'),
(36, 'test5', 'Active', '1', '2023-06-03 01:57:47', '2023-06-03 01:57:47'),
(37, 'dadadada', 'Active', '1', '2023-06-26 16:56:13', '2023-06-26 16:56:13'),
(38, 'gagagaga', 'Active', '1', '2023-06-26 16:56:26', '2023-06-26 16:56:26');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(11) UNSIGNED NOT NULL COMMENT 'COUPON ID',
  `customer_id` int(11) NOT NULL,
  `discount_id` int(11) NOT NULL,
  `is_use` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `customer_id`, `discount_id`, `is_use`, `created_at`, `updated_at`) VALUES
(47, 2, 2, '1', '2023-06-27 15:04:34', '2023-06-27 16:28:54'),
(48, 2, 3, '1', '2023-06-27 15:04:35', NULL),
(49, 1, 1, '1', '2023-06-27 15:05:46', '2023-06-27 16:51:45'),
(50, 1, 2, '0', '2023-06-27 15:05:47', NULL),
(51, 1, 3, '0', '2023-06-27 15:05:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL COMMENT 'CUSTOMERS ID',
  `customer_name` varchar(128) NOT NULL,
  `customer_email` varchar(64) NOT NULL,
  `customer_mobile` varchar(16) NOT NULL,
  `customer_address` varchar(256) NOT NULL,
  `customer_password` varchar(128) NOT NULL,
  `customer_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `customer_image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_name`, `customer_email`, `customer_mobile`, `customer_address`, `customer_password`, `customer_status`, `is_delete`, `created_at`, `updated_at`, `customer_image`) VALUES
(1, 'Nobita', 'nobita@gmail.com', '0123456789', 'Nam Địnhh', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Active', '0', '2023-04-30 14:01:53', '2023-05-19 11:58:09', 'customer_20230519100648.png'),
(2, 'Xeko', 'xeko@gmail.com', '123', 'Hà Nội', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Active', '0', '2023-05-03 09:24:35', '2023-05-19 10:10:37', 'customer_20230519101037.jpg'),
(3, 'doraemon', 'doraemon@gmail.com', '123', 'Thái Bình', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Active', '0', '2023-05-23 00:43:02', '2023-05-31 11:04:36', 'customer_20230523051226.png'),
(4, 'test mail', 'ccdtest01110@gmail.com', '123', 'số 1 Liễu Đề - Nghĩa Hưng', '6d9791b337e33667911e414a85983d8680c3bd67', 'Active', '0', '2023-06-26 12:59:47', NULL, 'no-image.png');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL COMMENT 'DISCOUNTS ID',
  `discount_code` varchar(256) NOT NULL,
  `price_discount_amount` double NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `discount_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `discount_condition` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `discount_code`, `price_discount_amount`, `quantity`, `discount_status`, `is_delete`, `created_at`, `updated_at`, `discount_condition`) VALUES
(1, 'hihihi', 50000, 0, 'Active', '0', NULL, '2023-06-27 15:05:20', 400000),
(2, 'hahaha', 100000, 0, 'Active', '0', NULL, '2023-06-27 15:04:12', 800000),
(3, 'keke', 10000, 8, 'Active', '0', '2023-05-26 16:57:03', '2023-06-27 15:04:22', 200000);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL COMMENT 'INVOICES ID',
  `invoice_id` varchar(128) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `transaction_amount` double NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_id`, `customer_id`, `order_id`, `transaction_amount`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, '6176', 1, 1, 679000, '0', '2023-05-09 14:21:55', NULL),
(2, '20230509142546', 1, 2, 295000, '0', '2023-05-09 14:25:46', NULL),
(3, '3124', 1, 3, 259000, '0', '2023-05-09 14:28:16', NULL),
(4, '20230509220135', 2, 4, 1110000, '0', '2023-05-09 22:01:35', NULL),
(5, '20230509224410', 2, 5, 590000, '0', '2023-05-09 22:44:10', NULL),
(6, '20230510213348', 2, 6, 1375000, '0', '2023-05-10 21:33:48', NULL),
(7, '20230510213634', 2, 7, 225000, '0', '2023-05-10 21:36:34', NULL),
(8, '7672', 1, 8, 225000, '0', '2023-05-10 21:42:54', NULL),
(9, '5694', 1, 9, 448000, '0', '2023-05-10 21:49:28', NULL),
(10, '9263', 2, 10, 815000, '0', '2023-05-11 12:25:21', NULL),
(11, '20230519161116', 1, 11, 1405000, '0', '2023-05-19 16:11:16', NULL),
(12, '6682', 1, 12, 245000, '0', '2023-05-19 20:03:19', NULL),
(13, '20230522154247', 2, 13, 1221000, '0', '2023-05-22 15:42:47', NULL),
(14, '20230526092238', 1, 14, 225000, '0', '2023-05-26 09:22:38', NULL),
(15, '20230526092619', 1, 15, 249000, '0', '2023-05-26 09:26:19', NULL),
(16, '20230526093053', 1, 16, 340000, '0', '2023-05-26 09:30:53', NULL),
(17, '20230526114513', 1, 17, 295000, '0', '2023-05-26 11:45:13', NULL),
(18, '20230531102602', 3, 18, 225000, '0', '2023-05-31 10:26:02', NULL),
(19, '20230603023850', 3, 19, 180000, '0', '2023-06-03 02:38:50', NULL),
(20, '20230622104400', 3, 20, 750000, '0', '2023-06-22 10:44:00', NULL),
(21, '20230622140024', 3, 21, 249000, '0', '2023-06-22 14:00:24', NULL),
(22, '20230622140133', 1, 22, 544000, '0', '2023-06-22 14:01:33', NULL),
(23, '20230622140346', 1, 23, 249000, '0', '2023-06-22 14:03:46', NULL),
(24, '20230622170503', 1, 24, 835000, '0', '2023-06-22 17:05:03', NULL),
(25, '9089', 1, 25, 295000, '0', '2023-06-22 17:07:17', NULL),
(26, '20230622171202', 1, 26, 155000, '0', '2023-06-22 17:12:02', NULL),
(27, '288', 1, 27, 554000, '0', '2023-06-26 16:28:55', NULL),
(28, '20230627161801', 2, 28, 875000, '0', '2023-06-27 16:18:01', NULL),
(29, '20230627162753', 2, 29, 590000, '0', '2023-06-27 16:27:53', NULL),
(30, '20230627162854', 2, 30, 1375000, '0', '2023-06-27 16:28:54', NULL),
(31, '5326', 1, 31, 468000, '0', '2023-06-27 16:51:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'ORDERS ID',
  `customer_id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `sub_total` double NOT NULL,
  `delivery_charge` double NOT NULL,
  `discount_amount` double NOT NULL,
  `grand_total` double NOT NULL,
  `payment_method` enum('VNPAY','Cash On Delivery') NOT NULL DEFAULT 'Cash On Delivery',
  `transaction_id` varchar(256) NOT NULL,
  `transaction_status` enum('Paid','Unpaid') NOT NULL DEFAULT 'Paid',
  `order_item_status` enum('Pending','Processing','Completed','Cancelled') NOT NULL DEFAULT 'Pending',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `order_date`, `sub_total`, `delivery_charge`, `discount_amount`, `grand_total`, `payment_method`, `transaction_id`, `transaction_status`, `order_item_status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-05-09 14:21:55', 749000, 0, 70000, 679000, 'Cash On Delivery', '14007768', 'Paid', 'Completed', '0', NULL, NULL),
(2, 1, '2023-05-09 14:25:46', 295000, 0, 0, 295000, 'Cash On Delivery', 'COD20230509142546', 'Paid', 'Completed', '0', NULL, NULL),
(3, 1, '2023-05-09 14:28:16', 259000, 0, 0, 259000, 'Cash On Delivery', '14007776', 'Unpaid', 'Cancelled', '0', NULL, NULL),
(4, 2, '2023-05-09 22:01:35', 1180000, 0, 70000, 1110000, 'Cash On Delivery', 'COD20230509220135', 'Paid', 'Completed', '0', NULL, NULL),
(5, 2, '2023-05-09 22:44:10', 590000, 0, 0, 590000, 'Cash On Delivery', 'COD20230509224410', 'Unpaid', 'Processing', '0', NULL, NULL),
(6, 2, '2023-05-10 21:33:48', 1375000, 0, 0, 1375000, 'Cash On Delivery', 'COD20230510213348', 'Unpaid', 'Pending', '0', NULL, NULL),
(7, 2, '2023-05-10 21:36:34', 295000, 0, 70000, 225000, 'Cash On Delivery', 'COD20230510213634', 'Unpaid', 'Pending', '0', NULL, NULL),
(8, 1, '2023-05-10 21:42:54', 295000, 0, 70000, 225000, 'Cash On Delivery', '14009275', 'Unpaid', 'Pending', '0', NULL, NULL),
(9, 1, '2023-05-10 21:49:28', 498000, 0, 50000, 448000, 'VNPAY', '14009282', 'Paid', 'Completed', '0', NULL, NULL),
(10, 2, '2023-05-11 12:25:21', 885000, 0, 70000, 815000, 'VNPAY', '14009734', 'Paid', 'Completed', '0', NULL, NULL),
(11, 1, '2023-05-19 16:11:16', 1475000, 0, 70000, 1405000, 'Cash On Delivery', 'COD20230519161116', 'Unpaid', 'Pending', '0', NULL, NULL),
(12, 1, '2023-05-19 20:03:19', 295000, 0, 50000, 245000, 'VNPAY', '14016866', 'Paid', 'Pending', '0', NULL, NULL),
(13, 2, '2023-05-22 15:42:47', 1291000, 0, 70000, 1221000, 'Cash On Delivery', 'COD20230522154247', 'Paid', 'Pending', '0', NULL, NULL),
(14, 1, '2023-05-26 09:22:38', 195000, 30000, 0, 225000, 'Cash On Delivery', 'COD20230526092238', 'Paid', 'Pending', '0', NULL, NULL),
(15, 1, '2023-05-26 09:26:19', 249000, 0, 0, 249000, 'Cash On Delivery', 'COD20230526092619', 'Paid', 'Pending', '0', NULL, NULL),
(16, 1, '2023-05-26 09:30:53', 390000, 0, 50000, 340000, 'Cash On Delivery', 'COD20230526093053', 'Paid', 'Pending', '0', NULL, NULL),
(17, 1, '2023-05-26 11:45:13', 295000, 0, 0, 295000, 'Cash On Delivery', 'COD20230526114513', 'Paid', 'Processing', '0', NULL, NULL),
(18, 3, '2023-05-31 10:26:02', 295000, 0, 70000, 225000, 'Cash On Delivery', 'COD20230531102602', 'Unpaid', 'Pending', '0', NULL, NULL),
(19, 3, '2023-06-03 02:38:50', 150000, 30000, 0, 180000, 'Cash On Delivery', 'COD20230603023850', 'Unpaid', 'Pending', '0', NULL, NULL),
(20, 3, '2023-06-22 10:44:00', 750000, 0, 0, 750000, 'Cash On Delivery', 'COD20230622104400', 'Paid', 'Completed', '0', NULL, '2023-06-22 13:04:47'),
(21, 3, '2023-06-22 14:00:24', 249000, 0, 0, 249000, 'Cash On Delivery', 'COD20230622140024', 'Unpaid', 'Pending', '0', '2023-06-22 14:00:24', '2023-06-22 14:00:24'),
(22, 1, '2023-06-22 14:01:33', 544000, 0, 0, 544000, 'Cash On Delivery', 'COD20230622140133', 'Unpaid', 'Pending', '0', '2023-06-22 14:01:33', '2023-06-22 14:01:33'),
(23, 1, '2023-06-22 14:03:46', 249000, 0, 0, 249000, 'Cash On Delivery', 'COD20230622140346', 'Unpaid', 'Pending', '0', '2023-06-22 14:03:46', '2023-06-22 14:03:46'),
(24, 1, '2023-06-22 17:05:03', 885000, 0, 50000, 835000, 'Cash On Delivery', 'COD20230622170503', 'Unpaid', 'Pending', '0', '2023-06-22 17:05:03', '2023-06-22 17:05:03'),
(25, 1, '2023-06-22 17:07:17', 295000, 0, 0, 295000, 'VNPAY', '14046583', 'Paid', 'Pending', '0', NULL, NULL),
(26, 1, '2023-06-22 17:12:02', 195000, 30000, 70000, 155000, 'Cash On Delivery', 'COD20230622171202', 'Unpaid', 'Pending', '0', '2023-06-22 17:12:02', '2023-06-22 17:12:02'),
(27, 1, '2023-06-26 16:28:55', 554000, 0, 0, 554000, 'VNPAY', '14049752', 'Paid', 'Completed', '0', NULL, '2023-06-26 16:48:40'),
(28, 2, '2023-06-27 16:18:01', 975000, 0, 100000, 875000, 'Cash On Delivery', 'COD20230627161801', 'Unpaid', 'Pending', '0', '2023-06-27 16:18:01', '2023-06-27 16:18:01'),
(29, 2, '2023-06-27 16:27:53', 590000, 0, 0, 590000, 'Cash On Delivery', 'COD20230627162753', 'Unpaid', 'Pending', '0', '2023-06-27 16:27:53', '2023-06-27 16:27:53'),
(30, 2, '2023-06-27 16:28:54', 1475000, 0, 100000, 1375000, 'Cash On Delivery', 'COD20230627162854', 'Unpaid', 'Pending', '0', '2023-06-27 16:28:54', '2023-06-27 16:28:54'),
(31, 1, '2023-06-27 16:51:45', 518000, 0, 50000, 468000, 'VNPAY', '14050894', 'Paid', 'Pending', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL COMMENT 'ORDER ITEMS ID',
  `customer_id` int(11) NOT NULL,
  `product_sc_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `customer_id`, `product_sc_id`, `order_id`, `product_price`, `product_quantity`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 195000, 1, '0', NULL, NULL),
(2, 1, 25, 1, 259000, 1, '0', NULL, NULL),
(3, 1, 16, 1, 295000, 1, '0', NULL, NULL),
(4, 1, 15, 2, 295000, 1, '0', NULL, NULL),
(5, 1, 24, 3, 259000, 1, '0', NULL, NULL),
(6, 2, 15, 4, 295000, 1, '0', NULL, NULL),
(7, 2, 12, 4, 295000, 2, '0', NULL, NULL),
(8, 2, 38, 4, 295000, 1, '0', NULL, NULL),
(9, 2, 15, 5, 295000, 1, '0', NULL, NULL),
(10, 2, 53, 5, 295000, 1, '0', NULL, NULL),
(11, 2, 14, 6, 295000, 1, '0', NULL, NULL),
(12, 2, 15, 6, 295000, 1, '0', NULL, NULL),
(13, 2, 18, 6, 295000, 1, '0', NULL, NULL),
(14, 2, 40, 6, 295000, 1, '0', NULL, NULL),
(15, 2, 6, 6, 195000, 1, '0', NULL, NULL),
(16, 2, 18, 7, 295000, 1, '0', NULL, NULL),
(17, 1, 53, 8, 295000, 1, '0', NULL, NULL),
(18, 1, 50, 9, 249000, 1, '0', NULL, NULL),
(19, 1, 47, 9, 249000, 1, '0', NULL, NULL),
(20, 2, 18, 10, 295000, 1, '0', NULL, NULL),
(21, 1, 18, 11, 295000, 4, '0', NULL, NULL),
(22, 1, 35, 11, 295000, 1, '0', NULL, NULL),
(23, 1, 35, 12, 295000, 1, '0', NULL, NULL),
(24, 2, 56, 13, 249000, 4, '0', NULL, NULL),
(25, 2, 53, 13, 295000, 1, '0', NULL, NULL),
(26, 1, 6, 14, 195000, 1, '0', NULL, NULL),
(27, 1, 70, 15, 249000, 1, '0', NULL, NULL),
(28, 1, 6, 16, 195000, 2, '0', NULL, NULL),
(29, 1, 53, 17, 295000, 1, '0', NULL, NULL),
(30, 3, 35, 18, 295000, 1, '0', NULL, NULL),
(31, 3, 112, 19, 150000, 1, '0', NULL, NULL),
(32, 3, 85, 20, 150000, 5, '0', NULL, NULL),
(33, 3, 28, 21, 249000, 1, '0', NULL, NULL),
(34, 1, 15, 22, 295000, 1, '0', NULL, NULL),
(35, 1, 28, 22, 249000, 1, '0', NULL, NULL),
(36, 1, 28, 23, 249000, 1, '0', NULL, NULL),
(37, 1, 20, 24, 295000, 1, '0', NULL, NULL),
(38, 1, 15, 25, 295000, 1, '0', NULL, NULL),
(39, 1, 2, 26, 195000, 1, '0', NULL, NULL),
(40, 1, 18, 27, 295000, 1, '0', NULL, NULL),
(41, 1, 128, 27, 259000, 1, '0', NULL, NULL),
(42, 2, 6, 28, 195000, 1, '0', NULL, NULL),
(43, 2, 15, 29, 295000, 5, '0', NULL, NULL),
(44, 2, 35, 30, 295000, 5, '0', NULL, NULL),
(45, 1, 24, 31, 259000, 2, '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'PRODUCTS ID',
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_summary` varchar(128) NOT NULL,
  `product_details` varchar(2048) NOT NULL,
  `product_master_image` text NOT NULL,
  `product_image_one` text DEFAULT NULL,
  `product_image_two` text DEFAULT NULL,
  `product_image_three` text DEFAULT NULL,
  `product_price` double NOT NULL,
  `product_discount_price` double DEFAULT NULL,
  `discount_start` datetime DEFAULT NULL,
  `discount_ends` datetime DEFAULT NULL,
  `product_type` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `product_featured` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `product_tags` varchar(256) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `virtual_price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `product_name`, `product_summary`, `product_details`, `product_master_image`, `product_image_one`, `product_image_two`, `product_image_three`, `product_price`, `product_discount_price`, `discount_start`, `discount_ends`, `product_type`, `product_featured`, `product_tags`, `is_delete`, `created_at`, `updated_at`, `virtual_price`) VALUES
(1, 1, 17, 'Áo T-Shirt Glaxy', 'Áo thun nam nữ Galaxy mang kiểu dáng unisex, form rộng, dáng suông', 'Áo được thêu logo thương hiệu ở mặt trước và tay áo, mặt sau là chữ in cùng hoạ tiết hình thêu nhỏ, là kiểu áo phông cổ tròn trendy của genz.', 'img-product-galaxy.jpg', 'img-product-galaxy-1.jpg', 'img-product-galaxy-2.jpg', 'img-product-galaxy-3.jpg', 195000, NULL, NULL, NULL, 'Active', 'NO', 'Áo T-Shirt Nam', '0', NULL, NULL, 350000),
(2, 1, 17, 'Áo T-Shirt Happen', 'Áo thun nam nữ Happen mang kiểu dáng unisex, form rộng, dáng suông', 'Áo được thêu logo thương hiệu ở mặt trước và tay áo, mặt sau là chữ in cùng hoạ tiết hình thêu nhỏ, là kiểu áo phông cổ tròn trendy của genz.', 'img-product-happen.jpg', 'img-product-happen-1.jpg', 'img-product-happen-2.jpg', 'img-product-happen-3.jpg', 295000, NULL, NULL, NULL, 'Active', 'NO', 'Áo T-Shirt Nam', '0', NULL, NULL, 350000),
(3, 1, 17, 'Áo T-Shirt Cross Cut', 'Áo thun nam nữ Cross Cut mang kiểu dáng unisex, form rộng, dáng suông', 'Áo được thêu logo thương hiệu ở mặt trước và tay áo, mặt sau là chữ in cùng hoạ tiết hình thêu nhỏ, là kiểu áo phông cổ tròn trendy của genz.', 'img-product-cross-cut.jpg', 'img-product-cross-cut-1.jpg', 'img-product-cross-cut-2.jpg', 'img-product-cross-cut-3.jpg', 295000, NULL, NULL, NULL, 'Active', 'NO', 'Áo T-Shirt Nam', '0', NULL, NULL, 350000),
(4, 1, 18, 'Áo Polo Zip Sleepy', 'Áo polo ngắn tay Zip Sleepy mang kiểu dáng unisex, form rộng, dáng suông có cổ.', 'Chất liệu vải Pc Gen mềm mịn, thoáng mát và thấm hút mồ hôi tốt, không co bai. Đường may tiêu chuẩn phù hợp với hàng dệt may.', 'img-product-zip-sleepy.jpg', 'img-product-zip-sleepy-1.jpg', 'img-product-zip-sleepy-2.jpg', 'img-product-zip-sleepy-3.jpg', 259000, NULL, NULL, NULL, 'Active', 'NO', 'Áo Polo Nam', '0', NULL, NULL, 350000),
(5, 1, 18, 'Áo Polo Universe', 'Áo polo ngắn tay Universe mang kiểu dáng unisex, form rộng, dáng suông có cổ.', 'Chất liệu vải Pc Gen mềm mịn, thoáng mát và thấm hút mồ hôi tốt, không co bai. Đường may tiêu chuẩn phù hợp với hàng dệt may.', 'img-product-universe.jpg', 'img-product-universe-1.jpg', 'img-product-universe-2.jpg', 'img-product-universe-3.jpg', 249000, NULL, NULL, NULL, 'Active', 'NO', 'Áo Polo Nam', '0', NULL, NULL, 350000),
(6, 1, 18, 'Áo Polo VietNamese City', 'Áo polo ngắn tay VietNamese City mang kiểu dáng unisex, form rộng, dáng suông có cổ.', 'Chất liệu vải Pc Gen mềm mịn, thoáng mát và thấm hút mồ hôi tốt, không co bai. Đường may tiêu chuẩn phù hợp với hàng dệt may.', 'img-product-vn-city.jpg', 'img-product-vn-city-1.jpg', 'img-product-vn-city-2.jpg', 'img-product-vn-city-3.jpg', 295000, NULL, NULL, NULL, 'Active', 'NO', 'Áo Polo Nam', '0', NULL, NULL, 350000),
(7, 2, 23, 'Quần Short Túi Chéo', 'Quần short đùi mang kiểu dáng unisex, form rộng, dáng suông.', 'Phần túi được kẻ chéo kèm hình in logo thương hiệu của shop, cạp chun kết hợp dây rút điều chỉnh độ rộng của quần, là kiểu quần ngắn suông treddy của genz.', 'img-product-tui-cheo.jpg', 'img-product-tui-cheo-1.jpg', 'img-product-tui-cheo-2.jpg', 'img-product-tui-cheo-3.jpg', 295000, NULL, NULL, NULL, 'Active', 'NO', 'Quần Short Nam', '0', NULL, NULL, 350000),
(8, 2, 23, 'Quần Short Thêu Symbol', 'Quần short đùi mang kiểu dáng unisex, form rộng, dáng suông.', 'Phần túi được kẻ chéo kèm hình in logo thương hiệu của shop, cạp chun kết hợp dây rút điều chỉnh độ rộng của quần, là kiểu quần ngắn suông treddy của genz.', 'img-product-symbol.jpg', 'img-product-symbol-1.jpg', 'img-product-symbol-2.jpg', 'img-product-symbol-3.jpg', 249000, NULL, NULL, NULL, 'Active', 'NO', 'Quần Short Nam', '0', NULL, NULL, 350000),
(9, 2, 24, 'Quần Baggy Jean Rách', 'Quần jean đùi mang kiểu dáng unisex, form rộng, dáng suông.', 'Phần túi được kẻ chéo kèm hình in logo thương hiệu của shop, cạp chun kết hợp dây rút điều chỉnh độ rộng của quần, là kiểu quần ngắn suông treddy của genz.', 'img-product-baggy-jean.jpg', 'img-product-baggy-jean-1.jpg', 'img-product-baggy-jean-2.jpg', 'img-product-baggy-jean-3.jpg', 295000, NULL, NULL, NULL, 'Active', 'NO', 'Quần Jean Nam', '0', NULL, NULL, 350000),
(10, 1, 19, 'Áo TankTop X Skel', 'Chất liệu vải 100% cotton mềm mịn, thoáng mát, thấm hút mồ hôi, không co bai', 'Áo TANKTOP X SKEL mang kiểu dáng unisex, form rộng, dáng suông. Áo được tráng gương tên thương hiệu ở 2 mặt áo, mặt sau có in hình nghệ thuật, là kiểu áo cổ tròn trendy của GenZ', 'img-product-tanktopxskel.jpg', 'img-product-tanktopxskel-1.jpg', 'img-product-tanktopxskel-2.jpg', 'img-product-tanktopxskel-3.jpg', 249000, NULL, NULL, NULL, 'Active', 'NO', 'Áo Tank Top Nam', '0', NULL, NULL, 350000),
(18, 1, 22, 'Áo hoodie test', 'hihihhiihih hâhda', '                                                                                                                                                                                aeghtrh                                                                                                                                                                ', 'product_master_20230525ADxTG.jpg', 'product_one_20230525ndGFt.jpg', 'product_two_20230525RIXZh.jpg', 'product_three_20230525kyaFe.jpg', 150000, NULL, NULL, NULL, 'Active', 'YES', 'hoodie', '0', '2023-05-24 23:41:58', '2023-05-25 13:04:34', 299000),
(19, 3, 32, 'Túi xách Gucci', 'hihihhiihih hâhda', '                                                                                                                                    123123                                                                                                                                                                ', 'product_master_20230525rhpIm.jpg', 'product_one_20230525VAlDx.jpg', 'product_two_20230525RnKqO.jpg', 'product_three_20230525QVEXH.jpg', 150000, NULL, NULL, NULL, 'Inactive', 'YES', 'tui gucci', '1', '2023-05-25 00:00:07', '2023-06-03 02:40:39', 299000),
(20, 1, 17, 'Áo T-shirt Application', 'Áo thun Application đang là sản phẩm hot trendding', '                                                                                        <div><div>*Áo thun của Application được làm từ chất liệu cotton cao cấp, mang lại sự thoải mái và thoáng khí cho người mặc. Thiết kế của áo thun Application thường đơn giản và tinh tế, với cổ tròn hoặc cổ bẻ cùng hai tay ngắn. Đặc biệt, mỗi chiếc áo thun Application được in hoặc thêu với những hình ảnh, logo hoặc thông điệp độc đáo, tạo nên sự cá nhân hóa và độc đáo cho người mặc.</div><div><span style=\"font-size: 0.875rem;\">*Ứng dụng của áo thun Application rất đa dạng. Với phong cách đơn giản và trẻ trung, chúng thích hợp cho cả nam và nữ trong các hoạt động hàng ngày, từ đi làm, hẹn hò đến dạo phố. Áo thun Application cũng là một lựa chọn phổ biến cho các sự kiện và hoạt động thể thao, nhờ vào sự thoải mái và tính linh hoạt của chúng.</span><br></div><div><span style=\"font-size: 0.875rem;\">*Được biết đến với chất lượng tuyệt vời và sự đổi mới trong thiết kế, Application đã tạo nên một cộng đồng người hâm mộ rộng lớn. Các tín đồ thời trang yêu thích sự độc đáo và phong cách của áo thun Application, và thường xuyên theo dõi những bộ sưu tập mới nhất của thương hiệu.</span><br></div><div><span style=\"font-size: 0.875rem;\">*Tóm lại, áo thun Application là một thương hiệu thời trang nổi tiếng với những thiết kế độc đáo, chất lượng tốt và phong cách trẻ trung. Chúng mang lại sự thoải mái và cá nhân hóa cho người mặc, trở thành một lựa chọn ưa thích trong tủ quần áo của nhiều người.</span><br></div></div>                                        ', 'product_master_20230602kVSRs.jpg', 'product_one_20230602dAaZP.jpg', 'product_two_20230602yNreA.jpg', 'product_three_20230602ZIVLE.jpg', 259000, NULL, NULL, NULL, 'Active', 'YES', 'áo thun, t-shirt, application', '0', '2023-06-02 17:52:56', '2023-06-02 18:05:10', 320000),
(21, 2, 23, 'Quần Short Tổ Ong Essentials', 'Quần Short Tổ Ong Essentials đang là sản phẩm hot trendding', '<div>* Quần Short Tổ Ong Essentials là một sản phẩm thiết kế độc đáo và sang trọng của thương hiệu thời trang cao cấp Tổ Ong. Được làm từ chất liệu vải cao cấp và được gia công tỉ mỉ, sản phẩm này không chỉ mang lại sự thoải mái cho người mặc mà còn tôn lên vẻ đẹp nam tính và phong cách của họ.</div><div><span style=\"font-size: 0.875rem;\">* Quần Short Tổ Ong Essentials có thiết kế đơn giản nhưng rất tinh tế với phom dáng ôm vừa vặn và chiều dài vừa đến đầu gối. Điểm nhấn của sản phẩm là họa tiết tổ ong trên nền vải màu đen, tạo nên một sự kết hợp hoàn hảo giữa sự sang trọng và phong cách thể thao.</span><br></div><div><span style=\"font-size: 0.875rem;\">* Sản phẩm có nhiều size phù hợp với từng dáng người, từ size S đến XXL, giúp khách hàng dễ dàng tìm được size phù hợp với mình. Quần Short Tổ Ong Essentials còn có nhiều tính năng tiện lợi như túi đựng đồ hai bên và dây rút điều chỉnh được độ rộng eo, giúp người mặc có thể điều chỉnh thoải mái để phù hợp với cơ thể của mình.</span><br></div><div><span style=\"font-size: 0.875rem;\">* Với Quần Short Tổ Ong Essentials, người mặc có thể dễ dàng kết hợp với áo thun, áo sơ mi hay áo khoác để tạo nên nhiều phong cách khác nhau, từ trẻ trung, năng động đến lịch lãm, sang trọng. Sản phẩm này sẽ là một lựa chọn hoàn hảo cho những người đàn ông yêu thích thời trang và tinh tế trong phong cách của mình.</span><br></div>', 'product_master_20230623Yoyle.jpg', 'product_one_20230623zLKer.jpg', 'product_two_20230623Nzxud.jpg', 'product_three_20230623ItbJV.jpg', 229000, NULL, NULL, NULL, 'Active', 'YES', 'Short, Essentials', '0', '2023-06-23 21:27:23', '2023-06-23 21:27:23', 299000),
(22, 3, 29, 'Mũ Miki Kaki', 'hihihhiihih hâhda', 'sfdvasdadsffasd adfasdfasdfa adfadsfadsfads', 'product_master_20230626qzFfL.jpg', 'product_one_20230626NvypY.jpg', 'product_two_20230626YhrDs.jpg', 'product_three_20230626yHxWC.jpg', 259000, NULL, NULL, NULL, 'Active', 'YES', 'Miki Kaki', '0', '2023-06-26 16:24:20', '2023-06-26 16:24:20', 312000);

-- --------------------------------------------------------

--
-- Table structure for table `products_sc`
--

CREATE TABLE `products_sc` (
  `id` int(11) NOT NULL COMMENT 'PRODUCTS SC ID',
  `product_id` int(11) NOT NULL,
  `product_size` varchar(10) NOT NULL,
  `product_color` varchar(20) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_status` enum('In Stock','Out of Stock') NOT NULL DEFAULT 'In Stock',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products_sc`
--

INSERT INTO `products_sc` (`id`, `product_id`, `product_size`, `product_color`, `product_quantity`, `product_status`, `is_delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'M', 'black', 100, 'In Stock', '0', NULL, NULL),
(2, 1, 'L', 'black', 99, 'In Stock', '0', NULL, NULL),
(3, 1, 'XL', 'black', 100, 'In Stock', '0', NULL, NULL),
(4, 1, 'M', 'white', 100, 'In Stock', '0', NULL, NULL),
(5, 1, 'L', 'white', 100, 'In Stock', '0', NULL, NULL),
(6, 1, 'XL', 'white', 95, 'In Stock', '0', NULL, NULL),
(7, 2, 'M', 'black', 50, 'In Stock', '0', NULL, NULL),
(8, 2, 'L', 'black', 50, 'In Stock', '0', NULL, NULL),
(9, 2, 'XL', 'black', 50, 'In Stock', '0', NULL, NULL),
(10, 2, 'M', 'beige', 50, 'In Stock', '0', NULL, NULL),
(11, 2, 'L', 'beige', 50, 'In Stock', '0', NULL, NULL),
(12, 2, 'XL', 'beige', 50, 'In Stock', '0', NULL, NULL),
(13, 2, 'M', 'brown', 50, 'In Stock', '0', NULL, NULL),
(14, 2, 'L', 'brown', 50, 'In Stock', '0', NULL, NULL),
(15, 2, 'XL', 'brown', 41, 'In Stock', '0', NULL, NULL),
(16, 3, 'M', 'brown', 10, 'In Stock', '0', NULL, NULL),
(17, 3, 'L', 'brown', 10, 'In Stock', '0', NULL, NULL),
(18, 3, 'XL', 'brown', 9, 'In Stock', '0', NULL, NULL),
(19, 3, 'M', 'black', 10, 'In Stock', '0', NULL, NULL),
(20, 3, 'L', 'black', 7, 'In Stock', '0', NULL, NULL),
(21, 3, 'XL', 'black', 10, 'In Stock', '0', NULL, NULL),
(22, 4, 'M', 'brown', 10, 'In Stock', '0', NULL, NULL),
(23, 4, 'L', 'brown', 10, 'In Stock', '0', NULL, NULL),
(24, 4, 'XL', 'brown', 8, 'In Stock', '0', NULL, NULL),
(25, 4, 'M', 'black', 10, 'In Stock', '0', NULL, NULL),
(26, 4, 'L', 'black', 10, 'In Stock', '0', NULL, NULL),
(27, 4, 'XL', 'black', 10, 'In Stock', '0', NULL, NULL),
(28, 5, 'L', 'black', 7, 'In Stock', '0', NULL, NULL),
(29, 5, 'XL', 'black', 11, 'In Stock', '0', NULL, NULL),
(30, 5, 'M', 'white', 12, 'In Stock', '0', NULL, NULL),
(31, 5, 'L', 'white', 13, 'In Stock', '0', NULL, NULL),
(32, 5, 'XL', 'white', 14, 'In Stock', '0', NULL, NULL),
(33, 6, 'M', 'green', 10, 'In Stock', '0', NULL, NULL),
(34, 6, 'L', 'green', 10, 'In Stock', '0', NULL, NULL),
(35, 6, 'XL', 'green', 5, 'In Stock', '0', NULL, NULL),
(36, 7, 'M', 'black', 10, 'In Stock', '0', NULL, NULL),
(37, 7, 'L', 'black', 10, 'In Stock', '0', NULL, NULL),
(38, 7, 'XL', 'black', 10, 'In Stock', '0', NULL, NULL),
(39, 7, 'M', 'brown', 10, 'In Stock', '0', NULL, NULL),
(40, 7, 'L', 'brown', 10, 'In Stock', '0', NULL, NULL),
(41, 7, 'XL', 'brown', 10, 'In Stock', '0', NULL, NULL),
(42, 7, 'M', 'beige', 10, 'In Stock', '0', NULL, NULL),
(43, 7, 'L', 'beige', 10, 'In Stock', '0', NULL, NULL),
(44, 7, 'XL', 'beige', 10, 'In Stock', '0', NULL, NULL),
(45, 8, 'M', 'black', 10, 'In Stock', '0', NULL, NULL),
(46, 8, 'L', 'black', 10, 'In Stock', '0', NULL, NULL),
(47, 8, 'XL', 'black', 10, 'In Stock', '0', NULL, NULL),
(48, 8, 'M', 'brown', 10, 'In Stock', '0', NULL, NULL),
(49, 8, 'L', 'brown', 10, 'In Stock', '0', NULL, NULL),
(50, 8, 'XL', 'brown', 10, 'In Stock', '0', NULL, NULL),
(51, 9, 'M', 'cyan', 10, 'In Stock', '0', NULL, NULL),
(52, 9, 'L', 'cyan', 10, 'In Stock', '0', NULL, NULL),
(53, 9, 'XL', 'cyan', 10, 'In Stock', '0', NULL, NULL),
(54, 10, 'M', 'black', 0, 'Out of Stock', '0', NULL, '2023-05-26 08:54:29'),
(55, 10, 'L', 'black', 0, 'Out of Stock', '0', NULL, NULL),
(56, 10, 'XL', 'black', 100, 'In Stock', '0', NULL, NULL),
(57, 10, 'XXL', 'black', 100, 'In Stock', '0', NULL, NULL),
(70, 10, 'M', 'white', 99, 'In Stock', '1', '2023-05-26 09:01:46', '2023-05-26 09:01:46'),
(71, 10, 'L', 'white', 99, 'In Stock', '1', '2023-05-26 09:01:46', '2023-05-26 09:01:46'),
(72, 10, 'M', 'white', 100, 'In Stock', '0', '2023-05-26 09:02:23', '2023-05-26 09:02:23'),
(73, 10, 'L', 'white', 100, 'In Stock', '0', '2023-05-26 09:02:23', '2023-05-26 09:02:23'),
(84, 18, 'L', 'brown', 5, 'In Stock', '0', '2023-06-01 12:30:04', '2023-06-04 14:44:24'),
(85, 18, 'L', 'aqua', 0, 'Out of Stock', '0', '2023-06-01 12:30:04', '2023-06-04 17:28:42'),
(86, 18, 'L', 'silver', 5, 'In Stock', '0', '2023-06-01 12:30:04', '2023-06-04 13:26:24'),
(87, 18, 'XL', 'brown', 5, 'In Stock', '0', '2023-06-01 12:30:04', '2023-06-04 13:26:36'),
(88, 18, 'XL', 'aqua', 5, 'In Stock', '0', '2023-06-01 12:30:04', '2023-06-04 13:26:46'),
(89, 18, 'XL', 'silver', 5, 'In Stock', '0', '2023-06-01 12:30:04', '2023-06-04 13:26:55'),
(90, 20, 'S', 'beige', 100, 'In Stock', '1', '2023-06-02 18:15:40', '2023-06-02 18:15:40'),
(91, 20, 'S', 'white', 100, 'In Stock', '1', '2023-06-02 18:15:40', '2023-06-02 18:15:40'),
(92, 20, 'M', 'beige', 0, 'Out of Stock', '1', '2023-06-02 18:15:59', '2023-06-02 18:24:10'),
(93, 20, 'M', 'white', 100, 'In Stock', '1', '2023-06-02 18:15:59', '2023-06-02 18:15:59'),
(94, 20, 'M', 'black', 100, 'In Stock', '1', '2023-06-02 18:15:59', '2023-06-02 18:15:59'),
(95, 20, 'M', 'brown', 100, 'In Stock', '1', '2023-06-02 18:16:35', '2023-06-02 18:16:35'),
(96, 20, 'XL', 'beige', 100, 'In Stock', '1', '2023-06-02 18:16:35', '2023-06-02 18:16:35'),
(97, 20, 'XL', 'white', 100, 'In Stock', '1', '2023-06-02 18:16:35', '2023-06-02 18:16:35'),
(98, 20, 'XL', 'black', 100, 'In Stock', '1', '2023-06-02 18:16:35', '2023-06-02 18:16:35'),
(99, 20, 'XL', 'brown', 100, 'In Stock', '1', '2023-06-02 18:16:35', '2023-06-02 18:16:35'),
(100, 20, 'M', 'beige', 100, 'In Stock', '0', '2023-06-03 01:50:02', '2023-06-03 01:50:02'),
(101, 20, 'M', 'white', 100, 'In Stock', '0', '2023-06-03 01:50:02', '2023-06-03 01:50:02'),
(102, 20, 'M', 'black', 100, 'In Stock', '0', '2023-06-03 01:50:02', '2023-06-03 01:50:02'),
(103, 20, 'M', 'gray', 100, 'In Stock', '0', '2023-06-03 01:50:02', '2023-06-03 01:50:02'),
(104, 20, 'L', 'beige', 100, 'In Stock', '0', '2023-06-03 01:50:02', '2023-06-03 01:50:02'),
(105, 20, 'L', 'white', 100, 'In Stock', '0', '2023-06-03 01:50:02', '2023-06-03 01:50:02'),
(106, 20, 'L', 'black', 100, 'In Stock', '1', '2023-06-03 01:50:02', '2023-06-03 01:50:02'),
(107, 20, 'L', 'gray', 100, 'In Stock', '0', '2023-06-03 01:50:02', '2023-06-03 01:50:02'),
(108, 20, 'XL', 'beige', 100, 'In Stock', '0', '2023-06-03 01:50:02', '2023-06-03 01:50:02'),
(109, 20, 'XL', 'white', 100, 'In Stock', '0', '2023-06-03 01:50:02', '2023-06-03 01:50:02'),
(110, 20, 'XL', 'gray', 100, 'In Stock', '0', '2023-06-03 01:50:02', '2023-06-03 01:50:02'),
(111, 19, 'one size', 'white', 100, 'In Stock', '0', '2023-06-03 02:38:10', '2023-06-03 02:38:10'),
(112, 19, 'one size', 'black', 100, 'In Stock', '0', '2023-06-03 02:38:10', '2023-06-03 02:38:10'),
(113, 20, 'XL', 'red', 15, 'In Stock', '0', '2023-06-03 10:34:02', '2023-06-03 10:34:02'),
(114, 20, 'S', 'red', 1, 'In Stock', '0', '2023-06-03 11:07:15', '2023-06-03 11:07:15'),
(115, 18, 'M', 'brown', 5, 'In Stock', '0', '2023-06-04 15:26:04', '2023-06-04 15:26:04'),
(116, 21, 'S', 'black', 50, 'In Stock', '0', '2023-06-23 21:28:31', '2023-06-23 21:28:31'),
(117, 21, 'S', 'brown', 50, 'In Stock', '0', '2023-06-23 21:28:31', '2023-06-23 21:28:31'),
(118, 21, 'S', 'white', 50, 'In Stock', '0', '2023-06-23 21:28:31', '2023-06-23 21:28:31'),
(119, 21, 'M', 'black', 50, 'In Stock', '0', '2023-06-23 21:28:31', '2023-06-23 21:28:31'),
(120, 21, 'M', 'brown', 50, 'In Stock', '0', '2023-06-23 21:28:31', '2023-06-23 21:28:31'),
(121, 21, 'M', 'white', 50, 'In Stock', '0', '2023-06-23 21:28:31', '2023-06-23 21:28:31'),
(122, 21, 'L', 'black', 50, 'In Stock', '0', '2023-06-23 21:28:31', '2023-06-23 21:28:31'),
(123, 21, 'L', 'brown', 49, 'In Stock', '0', '2023-06-23 21:28:31', '2023-06-23 21:28:31'),
(124, 21, 'L', 'white', 50, 'In Stock', '0', '2023-06-23 21:28:31', '2023-06-23 21:28:31'),
(125, 22, 'one size', 'beige', 40, 'In Stock', '0', '2023-06-26 16:25:55', '2023-06-26 16:25:55'),
(126, 22, 'one size', 'black', 40, 'In Stock', '0', '2023-06-26 16:25:55', '2023-06-26 16:25:55'),
(127, 22, 'one size', 'gray', 40, 'In Stock', '0', '2023-06-26 16:25:55', '2023-06-26 16:25:55'),
(128, 22, 'one size', 'teal', 2, 'In Stock', '0', '2023-06-26 16:25:55', '2023-06-26 16:29:58');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL COMMENT 'REVIEW ID',
  `customer_id` int(11) NOT NULL,
  `product_sc_id` int(11) NOT NULL,
  `review_details` varchar(512) NOT NULL,
  `rating` enum('1','2','3','4','5') NOT NULL DEFAULT '5',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `review_status` enum('Active','Inactive') DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `customer_id`, `product_sc_id`, `review_details`, `rating`, `is_delete`, `created_at`, `updated_at`, `order_id`, `review_status`) VALUES
(1, 1, 1, '5 sao nha shop', '5', '0', '2023-05-09 09:40:44', '2023-05-18 06:19:01', 1, 'Inactive'),
(9, 1, 53, 'ưng quá chừng - hiếu đánh giá', '5', '0', '2023-05-10 19:27:11', '2023-05-10 19:28:24', 8, 'Inactive'),
(10, 1, 25, 'anh hiếu đẹp zai', '5', '0', '2023-05-10 19:30:20', '2023-05-10 19:30:50', 1, 'Inactive'),
(11, 2, 53, 'quần đẹp quá shop - test đánh giá update', '3', '0', '2023-05-10 19:32:06', '2023-05-15 11:21:31', 5, 'Inactive'),
(12, 2, 15, 'ưngggggggggggggg quá chừngggggggggg', '4', '0', '2023-05-10 19:34:25', '2023-05-15 10:53:19', 4, 'Inactive'),
(13, 2, 18, 'hihi haha', '5', '0', '2023-05-11 05:17:10', '2023-05-11 05:17:19', 7, 'Inactive'),
(14, 2, 14, 'test update 5 sao', '5', '0', '2023-05-11 05:34:52', '2023-05-16 07:43:43', 6, 'Inactive'),
(15, 2, 12, 'update 5 sao', '5', '0', '2023-05-11 05:47:06', '2023-05-11 07:47:44', 4, 'Inactive'),
(16, 2, 18, 'danh gia  moi', '5', '0', '2023-05-11 12:33:16', '2023-05-22 11:16:29', 10, 'Active'),
(17, 1, 15, 'áo đẹp quá shop ơi', '1', '0', '2023-05-13 06:35:38', '2023-05-15 06:29:35', 2, 'Inactive'),
(18, 2, 15, 'hihi', '3', '0', '2023-05-15 07:44:35', '2023-05-15 10:53:08', 5, 'Inactive'),
(19, 2, 15, 'kkkkkkk', '5', '0', '2023-05-15 11:53:02', '2023-06-27 13:57:22', 6, 'Inactive'),
(20, 1, 16, 'iu shop', '5', '0', '2023-05-19 11:46:26', NULL, 1, 'Active'),
(21, 1, 24, '555555555', '5', '0', '2023-05-19 11:57:20', NULL, 3, 'Inactive'),
(22, 2, 56, 'danh gia ao tank top\n123', '4', '0', '2023-05-22 11:17:17', NULL, 13, 'Inactive'),
(23, 2, 53, 'danh gia moiiiiiiiiiii', '3', '0', '2023-05-22 11:24:55', NULL, 13, 'Inactive'),
(24, 1, 6, 'fafafafafafafafafa', '4', '0', '2023-05-26 04:23:20', '2023-05-26 04:25:22', 14, 'Inactive'),
(25, 1, 70, 'syjustyu', '5', '0', '2023-05-26 04:26:36', NULL, 15, 'Inactive'),
(26, 1, 6, 'ghdfghdghdfghdhdhhhd', '3', '0', '2023-05-26 09:31:10', '2023-05-26 09:31:10', 16, 'Inactive'),
(27, 3, 35, 'hihihi', '5', '0', '2023-06-02 18:32:09', '2023-06-02 18:32:50', 18, 'Inactive'),
(28, 3, 112, 'haha', '5', '0', '2023-06-03 02:39:21', '2023-06-03 02:39:21', 19, 'Inactive'),
(29, 1, 2, '5555555555lih', '5', '0', '2023-06-22 17:13:15', '2023-06-22 17:13:15', 26, 'Inactive'),
(30, 3, 85, 'hihihilllllll', '5', '0', '2023-06-24 14:01:20', '2023-06-24 14:01:36', 20, 'Active'),
(31, 2, 18, '555555', '5', '0', '2023-06-27 13:57:35', '2023-06-27 13:57:35', 6, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `shippings`
--

CREATE TABLE `shippings` (
  `id` int(11) NOT NULL COMMENT 'SHIPPING ID',
  `customer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `shipping_name` varchar(128) NOT NULL,
  `shipping_email` varchar(128) NOT NULL,
  `shipping_phone` varchar(128) NOT NULL,
  `shipping_address` varchar(512) NOT NULL,
  `shipping_city` varchar(128) NOT NULL,
  `shipping_zipcode` varchar(128) NOT NULL,
  `shipping_country` varchar(128) NOT NULL DEFAULT 'Việt Nam',
  `shipping_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `shipping_note` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shippings`
--

INSERT INTO `shippings` (`id`, `customer_id`, `order_id`, `shipping_name`, `shipping_email`, `shipping_phone`, `shipping_address`, `shipping_city`, `shipping_zipcode`, `shipping_country`, `shipping_status`, `is_delete`, `created_at`, `updated_at`, `shipping_note`) VALUES
(1, 1, 2, 'Trần Trung Hiếu', 'hieu29dhxd@gmail.com', '012345678', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, 'HIHI'),
(2, 1, 3, 'Trần Trung Hiếu', 'hieu29dhxd@gmail.com', '012345678', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(3, 2, 4, 'tester 01', 'test@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, 'shop oi giao nhanh cho minh nha'),
(4, 2, 5, 'tester 01', 'test@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(5, 2, 6, 'tester 01', 'test@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(6, 2, 7, 'tester 01', 'test@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(7, 1, 8, 'Trần Trung Hiếu', 'hieu29dhxd@gmail.com', '012345678', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, 'đồ rẻ quá shop, chắc phải mua cả cửa hàng mất'),
(8, 1, 9, 'Trần Trung Hiếu', 'hieu29dhxd@gmail.com', '012345678', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, 'quần cute quá shop ơi'),
(9, 2, 10, 'tester 01', 'test@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(10, 1, 11, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, 'xin chao'),
(11, 1, 12, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(12, 2, 13, 'Xeko', 'test@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, 'test review'),
(13, 1, 14, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(14, 1, 15, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(15, 1, 16, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(16, 1, 17, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(17, 3, 18, 'dorae mon', 'doraemon@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(18, 3, 19, 'doraemon', 'doraemon@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(19, 3, 20, 'doraemon', 'doraemon@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(20, 3, 21, 'doraemon', 'doraemon@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(21, 1, 22, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(22, 1, 23, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(23, 1, 24, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(24, 1, 25, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(25, 1, 26, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(26, 1, 27, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(27, 2, 28, 'Xeko', 'xeko@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(28, 2, 29, 'Xeko', 'xeko@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(29, 2, 30, 'Xeko', 'xeko@gmail.com', '123', 'số 112 Trần Đại Nghĩa, Hai Bà Trưng', 'Hà Nội', '80', 'Việt Nam', 'Active', '0', NULL, NULL, ''),
(30, 1, 31, 'Nobita', 'nobita@gmail.com', '0123456789', 'số 1 Liễu Đề - Nghĩa Hưng', 'Nam Đinh', '80', 'Việt Nam', 'Active', '0', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `shopcarts`
--

CREATE TABLE `shopcarts` (
  `id` int(11) NOT NULL COMMENT 'SHOPCART ID',
  `customer_id` int(11) NOT NULL,
  `product_sc_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `shopcarts`
--

INSERT INTO `shopcarts` (`id`, `customer_id`, `product_sc_id`, `quantity`, `is_delete`, `created_at`, `updated_at`) VALUES
(125, 3, 123, 1, '0', '2023-06-24 08:59:06', NULL),
(136, 2, 15, 6, '0', '2023-06-27 11:29:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `id` int(11) NOT NULL COMMENT 'SLIDER ID',
  `slider_title` varchar(128) NOT NULL,
  `slider_image` text NOT NULL,
  `slider_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `slider_sequence` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subcategories`
--

CREATE TABLE `subcategories` (
  `id` int(11) NOT NULL COMMENT 'SUBCATEGORIES ID',
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(128) NOT NULL,
  `subcategory_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `subcategory_banner` text NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subcategories`
--

INSERT INTO `subcategories` (`id`, `category_id`, `subcategory_name`, `subcategory_status`, `subcategory_banner`, `is_delete`, `created_at`, `updated_at`) VALUES
(17, 1, 'Áo T-Shirt', 'Active', 'subcategory_banner_20230531215638.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 21:56:38'),
(18, 1, 'Áo Polo', 'Active', 'subcategory_banner_20230531215756.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 21:57:56'),
(19, 1, 'Áo Tank Top', 'Active', 'subcategory_banner_20230531215855.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 21:58:55'),
(20, 1, 'Áo Khoác', 'Active', 'subcategory_banner_20230531215936.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 21:59:36'),
(21, 1, 'Áo Vest', 'Active', 'subcategory_banner_20230531220034.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 22:00:34'),
(22, 1, 'Áo Hoodie', 'Active', 'subcategory_banner_20230531220141.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 22:01:41'),
(23, 2, 'Quần Short', 'Active', 'subcategory_banner_20230531220236.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 22:02:36'),
(24, 2, 'Quần Jean', 'Active', 'subcategory_banner_20230531220333.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 22:03:33'),
(25, 2, 'Quần Jogger', 'Active', 'subcategory_banner_20230531220439.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 22:04:39'),
(26, 2, 'Quần Kaki', 'Active', 'subcategory_banner_20230531221601.png', '0', '2023-04-29 15:38:57', '2023-05-31 22:16:01'),
(27, 2, 'Quần Âu', 'Active', 'subcategory_banner_20230531221644.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 22:16:44'),
(28, 2, 'Quần Dài', 'Active', 'subcategory_banner_20230523224721.jpg', '1', '2023-04-29 15:38:57', '2023-05-23 22:47:21'),
(29, 3, 'Mũ(Nón)', 'Active', 'subcategory_banner_20230531221846.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 22:18:46'),
(30, 3, 'Tất(Vớ)', 'Active', 'subcategory_banner_20230531221921.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 22:19:21'),
(31, 3, 'Dây Nịt', 'Active', 'subcategory_banner_20230523224819.jpg', '1', '2023-04-29 15:38:57', '2023-05-23 22:48:19'),
(32, 3, 'Túi Đeo Chéo', 'Active', 'subcategory_banner_20230531223909.jpg', '0', '2023-04-29 15:38:57', '2023-05-31 22:39:09'),
(35, 1, 'test1', 'Active', 'subcategory_banner_20230523230351.jpg', '1', '2023-05-23 22:06:21', '2023-05-23 23:03:51'),
(39, 1, 'test2', 'Active', 'subcategory_banner_20230524001745.jpg', '1', '2023-05-24 00:17:45', '2023-05-24 00:17:45'),
(41, 2, 'test333', 'Active', 'subcategory_banner_20230526091554.jpg', '1', '2023-05-26 09:15:54', '2023-05-26 09:15:54'),
(42, 28, 'Áo Polo test', 'Active', 'subcategory_banner_20230529110951.jpg', '1', '2023-05-29 11:09:51', '2023-05-29 11:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL COMMENT 'WISHLIST ID',
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `is_delete` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `coupons_ibfk_1` (`customer_id`),
  ADD KEY `coupons_ibfk_2` (`discount_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_sc_id` (`product_sc_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subcategory_id` (`subcategory_id`);

--
-- Indexes for table `products_sc`
--
ALTER TABLE `products_sc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_sc_id` (`product_sc_id`);

--
-- Indexes for table `shippings`
--
ALTER TABLE `shippings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `shopcarts`
--
ALTER TABLE `shopcarts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `product_sc_id` (`product_sc_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ADMINS ID', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CATEGORIES ID', AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'COUPON ID', AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'CUSTOMERS ID', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'DISCOUNTS ID', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'INVOICES ID', AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ORDERS ID', AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ORDER ITEMS ID', AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRODUCTS ID', AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `products_sc`
--
ALTER TABLE `products_sc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PRODUCTS SC ID', AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'REVIEW ID', AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `shippings`
--
ALTER TABLE `shippings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SHIPPING ID', AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `shopcarts`
--
ALTER TABLE `shopcarts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SHOPCART ID', AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SLIDER ID';

--
-- AUTO_INCREMENT for table `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SUBCATEGORIES ID', AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'WISHLIST ID';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupons_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `coupons_ibfk_2` FOREIGN KEY (`discount_id`) REFERENCES `discounts` (`id`);

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `invoices_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_3` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_4` FOREIGN KEY (`product_sc_id`) REFERENCES `products_sc` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`),
  ADD CONSTRAINT `products_ibfk_3` FOREIGN KEY (`subcategory_id`) REFERENCES `subcategories` (`id`);

--
-- Constraints for table `products_sc`
--
ALTER TABLE `products_sc`
  ADD CONSTRAINT `products_sc_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_sc_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_sc_ibfk_3` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `products_sc_ibfk_4` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_sc_id`) REFERENCES `products_sc` (`id`);

--
-- Constraints for table `shippings`
--
ALTER TABLE `shippings`
  ADD CONSTRAINT `shippings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `shippings_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);

--
-- Constraints for table `shopcarts`
--
ALTER TABLE `shopcarts`
  ADD CONSTRAINT `shopcarts_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `shopcarts_ibfk_2` FOREIGN KEY (`product_sc_id`) REFERENCES `products_sc` (`id`);

--
-- Constraints for table `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `subcategories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `subcategories_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
