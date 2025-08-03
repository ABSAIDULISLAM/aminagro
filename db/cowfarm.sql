-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2020 at 05:43 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cowfarm`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int(11) NOT NULL,
  `DOB` date DEFAULT NULL,
  `age` int(11) DEFAULT '0',
  `weight` decimal(15,2) DEFAULT NULL,
  `height` decimal(15,2) DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` int(10) DEFAULT NULL,
  `animal_type` int(10) DEFAULT NULL,
  `pregnant_status` int(10) DEFAULT NULL COMMENT '0=>No, 1=>Yes',
  `before_no_of_pregnant` int(10) DEFAULT NULL,
  `pictures` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pregnancy_time` date DEFAULT NULL,
  `buy_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_price` decimal(15,2) DEFAULT NULL,
  `milk_ltr_per_day` decimal(15,2) DEFAULT NULL,
  `shade_no` int(10) DEFAULT NULL,
  `previous_vaccine_done` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vaccines` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buy_date` date DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `sale_status` int(3) NOT NULL DEFAULT '0' COMMENT '0=Available, 1=Sold',
  `note` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `DOB`, `age`, `weight`, `height`, `gender`, `color`, `animal_type`, `pregnant_status`, `before_no_of_pregnant`, `pictures`, `pregnancy_time`, `buy_from`, `buying_price`, `milk_ltr_per_day`, `shade_no`, `previous_vaccine_done`, `vaccines`, `buy_date`, `branch_id`, `sale_status`, `note`, `user_id`, `created_at`, `updated_at`) VALUES
(15, '2017-09-20', 934, '100.00', '100.00', 'Female', 1, 1, 1, 2, '311280420015601.jpg', '2020-09-30', 'India', '2000.00', '25.00', 2, 'Yes', '[\"1\",\"4\"]', '2020-03-25', 1, 1, 'Best Cow.', 1, '2020-03-25 17:11:19', '2020-04-28 07:56:01'),
(16, '2018-09-12', 577, '100.00', '500.00', 'Female', 1, 5, 1, 1, '144280420015504.jpg', '2020-06-23', 'India', '3000.00', '5.00', 3, 'No', '[\"4\"]', '2020-03-26', 1, 0, 'Good.', 1, '2020-03-25 18:52:13', '2020-04-28 07:55:04'),
(17, '2019-12-04', 129, '1000.00', '500.00', 'Male', 1, 4, 0, NULL, '305280420015453.jpg', NULL, 'USA', '5000.00', NULL, 1, 'Yes', '[\"3\",\"6\"]', '2020-03-25', 1, 0, 'Good Cow', 1, '2020-03-25 18:58:19', '2020-04-28 07:54:53'),
(18, '2019-01-01', 466, '300.00', '255.00', 'Female', 3, 8, 1, 2, '636280420015438.jpg', '2020-08-29', NULL, '5000.00', '60.00', 4, 'Yes', '[\"1\",\"4\"]', '2020-02-29', 1, 1, NULL, 1, '2020-03-26 17:27:51', '2020-04-28 07:54:38');

-- --------------------------------------------------------

--
-- Table structure for table `animal_type`
--

CREATE TABLE `animal_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animal_type`
--

INSERT INTO `animal_type` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'Holstein', '2020-02-07 11:56:37', '2020-03-25 14:21:50'),
(3, 'Friesian', '2020-02-07 11:58:32', '2020-03-25 14:27:44'),
(4, 'Brahman', '2020-03-25 14:25:02', '2020-03-25 14:25:02'),
(5, 'Mundi', '2020-03-25 14:26:10', '2020-03-25 14:26:10'),
(6, 'Jersey', '2020-03-25 14:27:19', '2020-03-25 14:27:19'),
(7, 'Holstein Friesian', '2020-03-25 14:28:02', '2020-03-25 14:28:02'),
(8, 'Sindi', '2020-03-25 14:29:10', '2020-03-25 14:29:10'),
(9, 'Sahiwal', '2020-03-26 17:31:05', '2020-03-26 17:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `branchs`
--

CREATE TABLE `branchs` (
  `id` int(11) NOT NULL,
  `branch_name` varchar(155) CHARACTER SET utf8 DEFAULT NULL,
  `branch_address` text CHARACTER SET utf8,
  `phone_number` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `setup_date` date DEFAULT NULL,
  `builders_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branchs`
--

INSERT INTO `branchs` (`id`, `branch_name`, `branch_address`, `phone_number`, `email`, `setup_date`, `builders_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Branch - 01', 'Uttara, Dhaka, Bangladesh', '017865567610', 'akh01@gmail.com', '2018-09-19', 'Aiyub Khan', 1, '2018-09-23 12:52:37', '2020-02-08 19:25:05'),
(2, 'Branch - 02', 'Gazipur, Dhaka, Bangladesh', '017865567611', 'akhn02@gmail.com', '2018-10-15', 'Aiyub Shaikh', 1, '2018-10-14 18:15:03', '2020-02-08 19:25:11'),
(3, 'Branch - 03', 'Uttara, Dhaka, Bangladesh', '01756000001', 'tajik@gmail.com', '2019-06-01', 'Mirza Khan', 1, '2019-08-01 23:44:36', '2020-02-08 19:25:21');

-- --------------------------------------------------------

--
-- Table structure for table `calf`
--

CREATE TABLE `calf` (
  `id` int(11) NOT NULL,
  `DOB` date DEFAULT NULL,
  `animal_id` int(155) DEFAULT NULL,
  `age` int(11) DEFAULT '0',
  `weight` decimal(15,2) DEFAULT NULL,
  `height` decimal(15,2) DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` int(10) DEFAULT NULL,
  `animal_type` int(10) DEFAULT NULL,
  `pictures` text COLLATE utf8mb4_unicode_ci,
  `buy_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_price` decimal(15,2) DEFAULT NULL,
  `shade_no` int(10) DEFAULT NULL,
  `previous_vaccine_done` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vaccines` text COLLATE utf8mb4_unicode_ci,
  `buy_date` date DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `sale_status` int(3) NOT NULL DEFAULT '0' COMMENT '0=Available, 1=Sold',
  `note` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calf`
--

INSERT INTO `calf` (`id`, `DOB`, `animal_id`, `age`, `weight`, `height`, `gender`, `color`, `animal_type`, `pictures`, `buy_from`, `buying_price`, `shade_no`, `previous_vaccine_done`, `vaccines`, `buy_date`, `branch_id`, `sale_status`, `note`, `user_id`, `created_at`, `updated_at`) VALUES
(3, '2020-01-01', 18, 101, '50.00', '100.00', 'Male', 3, 7, '580280420015615.jpg', 'Own', NULL, 8, 'Yes', '[\"1\",\"3\",\"6\"]', NULL, 1, 1, 'Good', 1, '2020-03-26 18:14:29', '2020-04-28 07:56:15'),
(4, '2020-01-28', 15, 89, '50.00', '55.00', 'Female', 3, 6, '685280420015623.jpg', 'Our Farm', NULL, 7, 'No', '[\"1\",\"4\"]', NULL, 1, 0, NULL, 0, '2020-04-26 13:31:49', '2020-04-28 07:56:23'),
(5, '2020-01-01', 15, 116, '45.00', '15.00', 'Male', 6, 8, '559280420015637.jpg', NULL, NULL, 5, 'No', '', NULL, 1, 0, NULL, 0, '2020-04-26 17:39:17', '2020-04-28 07:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `collect_milk`
--

CREATE TABLE `collect_milk` (
  `id` int(11) NOT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `dairy_number` int(11) DEFAULT NULL,
  `stall_no` int(11) NOT NULL DEFAULT '0',
  `liter` decimal(15,2) DEFAULT NULL,
  `fate` varchar(255) DEFAULT NULL,
  `liter_price` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `branch_id` int(11) NOT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `collect_milk`
--

INSERT INTO `collect_milk` (`id`, `account_number`, `name`, `address`, `dairy_number`, `stall_no`, `liter`, `fate`, `liter_price`, `total`, `date`, `branch_id`, `added_by`, `created_at`, `updated_at`) VALUES
(6, '04062020', 'Jamal', 'Test Address', 17, 1, '20.00', '0.05', '3.00', '60.00', '2020-04-06', 1, 1, '2020-04-06 05:58:53', '2020-04-06 06:07:40'),
(7, '04062020', 'Kamal', 'Test Address', 15, 2, '13.00', '0.25', '5.00', '65.00', '2020-04-06', 1, 1, '2020-04-06 06:07:05', '2020-04-06 06:07:05'),
(8, '04262020', 'Sundor', 'Test Address', 16, 3, '35.00', '0.4', '3.00', '105.00', '2020-04-26', 1, 1, '2020-04-25 18:19:05', '2020-04-25 18:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `color_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `created_at`, `updated_at`) VALUES
(1, 'Red', '2020-02-07 11:42:37', '2020-02-07 11:42:37'),
(2, 'Black', '2020-02-07 11:42:42', '2020-02-07 11:42:42'),
(3, 'Black & White', '2020-03-25 19:33:07', '2020-03-25 19:33:07'),
(4, 'Red & Black', '2020-03-25 19:33:22', '2020-03-25 19:33:22'),
(5, 'White', '2020-03-25 19:33:41', '2020-03-25 19:33:41'),
(6, 'Mixed', '2020-03-25 19:34:08', '2020-03-25 19:34:08');

-- --------------------------------------------------------

--
-- Table structure for table `cow_feed`
--

CREATE TABLE `cow_feed` (
  `id` int(11) NOT NULL,
  `shed_no` int(155) DEFAULT NULL,
  `cow_id` int(155) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` text,
  `branch_id` int(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_feed`
--

INSERT INTO `cow_feed` (`id`, `shed_no`, `cow_id`, `date`, `note`, `branch_id`, `created_at`, `updated_at`) VALUES
(6, 1, 17, '2020-03-29', 'Next Week follow this routine.', 1, '2020-03-29 12:27:40', '2020-03-29 12:27:40'),
(7, 2, 15, '2020-03-15', 'Regular Same food until notice.', 1, '2020-03-29 13:28:47', '2020-03-29 13:31:23'),
(8, 3, 16, '2020-04-10', NULL, 1, '2020-04-10 05:21:45', '2020-04-10 05:21:45'),
(9, 4, 18, '2020-04-10', NULL, 1, '2020-04-10 05:22:25', '2020-04-10 05:22:25'),
(10, 7, 4, '2020-04-30', 'Follow this regular.', 1, '2020-04-26 13:33:05', '2020-04-26 13:33:05'),
(11, 5, 5, '2020-04-27', NULL, 1, '2020-04-26 17:43:04', '2020-04-26 17:43:04'),
(12, 7, 4, '2020-04-30', 'Follow this.', 1, '2020-04-29 04:30:11', '2020-04-29 04:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `cow_feed_dtls`
--

CREATE TABLE `cow_feed_dtls` (
  `id` int(11) NOT NULL,
  `feed_id` int(155) DEFAULT NULL,
  `item_id` int(155) DEFAULT NULL,
  `qty` decimal(15,2) DEFAULT NULL,
  `unit_id` int(155) DEFAULT NULL,
  `time` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_feed_dtls`
--

INSERT INTO `cow_feed_dtls` (`id`, `feed_id`, `item_id`, `qty`, `unit_id`, `time`, `created_at`, `updated_at`) VALUES
(11, 6, 1, '10.00', 1, '8:00 AM', '2020-03-29 12:27:40', '2020-03-29 12:27:40'),
(12, 6, 3, '1.00', 1, '10:00 AM', '2020-03-29 12:27:40', '2020-03-29 12:27:40'),
(13, 6, 2, '5.00', 2, '10:30 AM', '2020-03-29 12:27:40', '2020-03-29 12:27:40'),
(16, 7, 1, '10.00', 2, '8:00 AM', '2020-03-29 13:31:23', '2020-03-29 13:31:23'),
(17, 7, 3, '1.00', 2, '04:30 PM', '2020-03-29 13:31:23', '2020-03-29 13:31:23'),
(18, 7, 2, '5.00', 2, '10:30 AM', '2020-03-29 13:31:23', '2020-03-29 13:31:23'),
(19, 8, 1, '25.00', 2, '8:00 AM', '2020-04-10 05:21:45', '2020-04-10 05:21:45'),
(20, 8, 3, '20.00', 2, '10:00 AM', '2020-04-10 05:21:45', '2020-04-10 05:21:45'),
(21, 9, 2, '10.00', 2, '10:30 AM', '2020-04-10 05:22:25', '2020-04-10 05:22:25'),
(22, 10, 1, '5.00', 2, '8:00 AM', '2020-04-26 13:33:05', '2020-04-26 13:33:05'),
(23, 10, 3, '1.00', 2, '10:00 AM', '2020-04-26 13:33:05', '2020-04-26 13:33:05'),
(24, 10, 2, '5.00', 2, '4:50 PM', '2020-04-26 13:33:05', '2020-04-26 13:33:05'),
(25, 11, 1, '10.00', 2, '8:00 AM', '2020-04-26 17:43:04', '2020-04-26 17:43:04'),
(26, 11, 3, '20.00', 2, '04:30 PM', '2020-04-26 17:43:04', '2020-04-26 17:43:04'),
(27, 11, 2, '5.00', 1, '10:30 AM', '2020-04-26 17:43:04', '2020-04-26 17:43:04'),
(28, 12, 1, '10.00', 2, '8:00 AM', '2020-04-29 04:30:11', '2020-04-29 04:30:11'),
(29, 12, 3, '20.00', 2, '10:00 AM', '2020-04-29 04:30:11', '2020-04-29 04:30:11'),
(30, 12, 2, '10.00', 2, '10:30 AM', '2020-04-29 04:30:11', '2020-04-29 04:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `cow_monitor`
--

CREATE TABLE `cow_monitor` (
  `id` int(11) NOT NULL,
  `shed_no` int(155) DEFAULT NULL,
  `cow_id` int(155) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` text,
  `weight` decimal(15,2) NOT NULL DEFAULT '0.00',
  `height` decimal(15,2) NOT NULL DEFAULT '0.00',
  `milk` decimal(15,2) NOT NULL DEFAULT '0.00',
  `branch_id` int(3) DEFAULT NULL,
  `health_score` int(11) NOT NULL DEFAULT '0',
  `new_images` varchar(2000) CHARACTER SET utf8 DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_monitor`
--

INSERT INTO `cow_monitor` (`id`, `shed_no`, `cow_id`, `date`, `note`, `weight`, `height`, `milk`, `branch_id`, `health_score`, `new_images`, `user_id`, `created_at`, `updated_at`) VALUES
(13, 1, 17, '2020-04-13', 'All perfect.', '1200.00', '560.00', '0.00', 1, 90, '487160420110021.jpg_581160420110021.jpg', 1, '2020-04-12 19:32:49', '2020-04-16 17:00:31'),
(14, 1, 17, '2020-05-27', 'All perfect.', '1350.00', '600.00', '0.00', 1, 92, NULL, 1, '2020-04-12 19:34:12', '2020-04-12 19:34:12'),
(15, 2, 15, '2020-04-13', 'NO vaccine Done yet.', '500.00', '200.00', '35.00', 1, 72, NULL, 1, '2020-04-13 04:09:48', '2020-04-13 04:09:48'),
(16, 1, 17, '2020-04-22', 'Good Health', '1300.00', '580.00', '0.00', 1, 85, NULL, 1, '2020-04-14 18:06:44', '2020-04-14 18:06:44'),
(17, 1, 17, '2020-06-25', 'Everything perfect and alright.', '1500.00', '700.00', '0.00', 1, 97, '619160420115859.jpg', 1, '2020-04-16 17:58:59', '2020-04-16 18:11:29'),
(18, 7, 4, '2020-04-28', 'All ok but vaccine pending.', '100.00', '60.00', '0.00', 1, 70, '733260420082716.jpg_534260420082716.jpg', 1, '2020-04-26 14:27:16', '2020-04-26 14:27:16');

-- --------------------------------------------------------

--
-- Table structure for table `cow_monitor_dtls`
--

CREATE TABLE `cow_monitor_dtls` (
  `id` int(11) NOT NULL,
  `monitor_id` int(155) DEFAULT NULL,
  `service_id` int(155) DEFAULT NULL,
  `result` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `time` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_monitor_dtls`
--

INSERT INTO `cow_monitor_dtls` (`id`, `monitor_id`, `service_id`, `result`, `time`, `created_at`, `updated_at`) VALUES
(25, 14, 2, 'Done', '10:20 AM', '2020-04-12 19:34:12', '2020-04-12 19:34:12'),
(26, 14, 3, 'Done', '01:20 PM', '2020-04-12 19:34:12', '2020-04-12 19:34:12'),
(27, 14, 5, 'Done', '03:20 PM', '2020-04-12 19:34:12', '2020-04-12 19:34:12'),
(28, 15, 2, 'Done', '10:20 AM', '2020-04-13 04:09:48', '2020-04-13 04:09:48'),
(29, 16, 2, 'Done', '10:20 AM', '2020-04-14 18:06:44', '2020-04-14 18:06:44'),
(30, 16, 3, 'Done', '01:20 PM', '2020-04-14 18:06:44', '2020-04-14 18:06:44'),
(31, 16, 5, 'Done', '03:20 PM', '2020-04-14 18:06:44', '2020-04-14 18:06:44'),
(47, 13, 2, 'Done', '10:20 AM', '2020-04-16 17:00:31', '2020-04-16 17:00:31'),
(48, 13, 3, 'Done', '01:20 PM', '2020-04-16 17:00:31', '2020-04-16 17:00:31'),
(49, 13, 5, 'Done', '03:20 PM', '2020-04-16 17:00:31', '2020-04-16 17:00:31'),
(50, 18, 2, 'Good', '10:20 AM', '2020-04-26 14:27:16', '2020-04-26 14:27:16'),
(51, 18, 3, 'Not Done', '01:20 PM', '2020-04-26 14:27:16', '2020-04-26 14:27:16'),
(52, 18, 5, 'Not Done', '03:20 PM', '2020-04-26 14:27:16', '2020-04-26 14:27:16');

-- --------------------------------------------------------

--
-- Table structure for table `cow_sale`
--

CREATE TABLE `cow_sale` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_number` varchar(255) DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address` text,
  `total_price` decimal(15,2) DEFAULT NULL,
  `total_paid` decimal(15,2) DEFAULT NULL,
  `due` decimal(15,2) DEFAULT NULL,
  `note` text,
  `date` date DEFAULT NULL,
  `branch_id` int(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_sale`
--

INSERT INTO `cow_sale` (`id`, `customer_name`, `customer_number`, `email`, `address`, `total_price`, `total_paid`, `due`, `note`, `date`, `branch_id`, `created_at`, `updated_at`) VALUES
(6, 'Kamrul SIna', '+8812121212121212', 'sina@gmail.com', 'Test Address\r\nUSA-1212', '2000.00', '1500.00', '500.00', 'Good deal.', '2020-04-01', 1, '2020-03-31 18:05:43', '2020-04-05 12:59:33'),
(7, 'Johnson', '454545454', 'johnson@gmail.com', 'Test Address\r\nUSA-121212', '6000.00', '5300.00', '700.00', 'Good Deal thanks :)', '2020-04-05', 1, '2020-04-05 14:47:59', '2020-04-05 18:42:34');

-- --------------------------------------------------------

--
-- Table structure for table `cow_sale_dtls`
--

CREATE TABLE `cow_sale_dtls` (
  `id` int(11) NOT NULL,
  `sale_id` int(155) DEFAULT NULL,
  `cow_id` int(155) DEFAULT NULL,
  `cow_type` int(5) DEFAULT NULL COMMENT '1=Cow, 2=Calf',
  `shed_no` int(155) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_sale_dtls`
--

INSERT INTO `cow_sale_dtls` (`id`, `sale_id`, `cow_id`, `cow_type`, `shed_no`, `price`, `created_at`, `updated_at`) VALUES
(12, 6, 15, 1, 2, '2000.00', '2020-04-05 12:59:34', '2020-04-05 12:59:34'),
(13, 7, 18, 1, 4, '5000.00', '2020-04-05 14:47:59', '2020-04-05 14:47:59'),
(14, 7, 3, 2, 8, '1000.00', '2020-04-05 14:48:00', '2020-04-05 14:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `cow_sale_payments`
--

CREATE TABLE `cow_sale_payments` (
  `id` int(11) NOT NULL,
  `sale_id` int(155) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `pay_amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_sale_payments`
--

INSERT INTO `cow_sale_payments` (`id`, `sale_id`, `date`, `pay_amount`, `created_at`, `updated_at`) VALUES
(4, 6, '2020-04-01', '1500.00', '2020-04-05 16:48:20', '2020-03-31 18:05:43'),
(5, 7, '2020-04-05', '5300.00', '2020-04-05 14:48:00', '2020-04-05 14:48:00'),
(9, 7, '2020-04-28', '200.00', '2020-04-26 11:01:53', '2020-04-26 11:01:53'),
(10, 7, '2020-04-29', '500.00', '2020-04-26 11:07:39', '2020-04-26 11:07:39');

-- --------------------------------------------------------

--
-- Table structure for table `cow_vaccine_monitor`
--

CREATE TABLE `cow_vaccine_monitor` (
  `id` int(11) NOT NULL,
  `shed_no` int(155) DEFAULT NULL,
  `cow_id` int(155) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` varchar(3000) CHARACTER SET utf8 DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `branch_id` int(3) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_vaccine_monitor`
--

INSERT INTO `cow_vaccine_monitor` (`id`, `shed_no`, `cow_id`, `date`, `note`, `user_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(9, 1, 17, '2020-04-12', 'All done successfully.', 1, 1, '2020-04-12 04:57:40', '2020-04-12 04:57:40'),
(10, 1, 17, '2020-04-14', 'No problem successfully done :)', 1, 1, '2020-04-12 05:56:47', '2020-04-12 05:56:47'),
(11, 1, 17, '2020-04-15', 'Great.', 1, 1, '2020-04-12 06:12:29', '2020-04-12 06:12:29'),
(12, 1, 17, '2020-04-30', 'Done', 1, 1, '2020-04-12 06:13:08', '2020-04-12 06:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `cow_vaccine_monitor_dtls`
--

CREATE TABLE `cow_vaccine_monitor_dtls` (
  `id` int(11) NOT NULL,
  `monitor_id` int(155) DEFAULT NULL,
  `vaccine_id` int(155) DEFAULT NULL,
  `remarks` text,
  `time` varchar(25) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_vaccine_monitor_dtls`
--

INSERT INTO `cow_vaccine_monitor_dtls` (`id`, `monitor_id`, `vaccine_id`, `remarks`, `time`, `created_at`, `updated_at`) VALUES
(24, 9, 7, 'Done.', '10:20 AM', '2020-04-12 04:57:40', '2020-04-12 04:57:40'),
(25, 9, 1, 'Done', '11:20 AM', '2020-04-12 04:57:40', '2020-04-12 04:57:40'),
(26, 9, 2, 'Done', '04:30 PM', '2020-04-12 04:57:41', '2020-04-12 04:57:41'),
(27, 10, 3, 'Given 10 mm', '01:20 PM', '2020-04-12 05:56:47', '2020-04-12 05:56:47'),
(28, 11, 6, 'Done.', '02:20 PM', '2020-04-12 06:12:29', '2020-04-12 06:12:29'),
(29, 12, 6, 'With Extra', '04:20 PM', '2020-04-12 06:13:08', '2020-04-12 06:13:08');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Accountant', '2019-10-13 08:04:26', '2019-10-14 10:41:17'),
(2, 'Executive', '2019-10-13 08:04:53', '2020-02-07 10:15:51');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary`
--

CREATE TABLE `employee_salary` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `month` tinyint(4) DEFAULT NULL,
  `salary` decimal(15,2) DEFAULT '0.00',
  `paydate` date DEFAULT NULL,
  `addition_money` decimal(15,2) DEFAULT NULL,
  `note` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_salary`
--

INSERT INTO `employee_salary` (`id`, `employee_id`, `year`, `month`, `salary`, `paydate`, `addition_money`, `note`, `created_at`, `updated_at`) VALUES
(1, 2, 2019, 10, '60000.00', '2019-10-02', '5000.00', 'Nothing', '2019-11-17 16:47:54', '2019-11-17 16:47:54'),
(2, 18, 2019, 11, '20000.00', '2019-11-05', '5000.00', 'Nothing', '2019-11-17 16:48:14', '2019-11-17 16:48:14'),
(3, 2, 2020, 4, '50000.00', '2020-03-24', '200.00', 'Loan Money 200 USD.', '2020-03-24 07:52:50', '2020-03-24 07:54:15'),
(4, 19, 2020, 4, '150000.00', '2020-03-28', NULL, 'Success', '2020-03-28 17:23:10', '2020-03-28 17:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `purpose_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT '0.00',
  `note` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `purpose_id`, `date`, `amount`, `note`, `created_at`, `created_by`, `updated_at`) VALUES
(3, 5, '2020-02-28', '2000.00', NULL, '2019-09-30 10:35:36', 1, '2020-04-05 19:06:10'),
(4, 3, '2020-03-24', '5000.00', 'Raw Materials', '2019-11-17 17:18:59', 1, '2020-04-05 19:06:01'),
(5, 4, '2020-01-28', '500.00', 'Current month rent', '2020-03-28 17:11:36', 1, '2020-04-05 19:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `expense_purpose`
--

CREATE TABLE `expense_purpose` (
  `id` int(11) NOT NULL,
  `purpose_name` varchar(255) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_purpose`
--

INSERT INTO `expense_purpose` (`id`, `purpose_name`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'Snacks', 1, '2018-11-25 06:35:18', '2018-11-25 06:51:42'),
(2, 'Paper', 1, '2018-11-25 06:42:32', '2018-11-25 06:42:32'),
(3, 'Materials', 1, '2018-11-25 06:42:45', '2018-11-25 06:42:45'),
(4, 'Office Rent', 1, '2018-12-25 04:11:47', '2018-12-25 04:11:47'),
(5, 'Share Profit', 1, '2018-12-25 04:11:54', '2019-11-17 17:18:12'),
(6, 'Bucket', 1, '2020-02-08 19:54:25', '2020-02-08 19:54:25');

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Grass', '2020-02-24 18:08:23', '2020-02-24 18:08:54'),
(2, 'Water', '2020-02-24 18:08:58', '2020-02-24 18:08:58'),
(3, 'Salt', '2020-02-24 18:09:02', '2020-02-24 18:09:02');

-- --------------------------------------------------------

--
-- Table structure for table `food_units`
--

CREATE TABLE `food_units` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_units`
--

INSERT INTO `food_units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gram', '2020-02-23 12:59:13', '2020-02-23 12:59:13'),
(2, 'KG', '2020-02-23 12:59:21', '2020-02-23 12:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `milk_due_collections`
--

CREATE TABLE `milk_due_collections` (
  `id` int(11) NOT NULL,
  `sale_id` int(155) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `pay_amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `milk_due_collections`
--

INSERT INTO `milk_due_collections` (`id`, `sale_id`, `date`, `pay_amount`, `created_at`, `updated_at`) VALUES
(1, 7, '2020-04-26', '25.00', '2020-04-25 22:50:59', '2020-04-25 22:50:59'),
(5, 7, '2020-04-27', '10.00', '2020-04-26 07:29:53', '2020-04-26 07:29:53'),
(6, 7, '2020-04-28', '5.00', '2020-04-26 07:39:50', '2020-04-26 07:39:50'),
(8, 8, '2020-04-26', '25.00', '2020-04-26 09:24:26', '2020-04-26 09:24:26'),
(9, 8, '2020-04-28', '10.00', '2020-04-26 09:26:10', '2020-04-26 09:26:10'),
(10, 7, '2020-04-30', '5.00', '2020-04-26 11:10:46', '2020-04-26 11:10:46'),
(11, 9, '2020-04-29', '20.00', '2020-04-29 03:59:35', '2020-04-29 03:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_services`
--

CREATE TABLE `monitoring_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `monitoring_services`
--

INSERT INTO `monitoring_services` (`id`, `service_name`, `created_at`, `updated_at`) VALUES
(2, 'Monitoring', '2020-02-24 15:33:59', '2020-02-24 15:36:30'),
(3, 'Monthly Tika', '2020-02-24 15:35:23', '2020-02-24 15:36:10'),
(5, 'Weekly Tika', '2020-02-24 15:35:33', '2020-02-24 15:36:19');

-- --------------------------------------------------------

--
-- Table structure for table `pregnancy_record`
--

CREATE TABLE `pregnancy_record` (
  `id` int(10) UNSIGNED NOT NULL,
  `stall_no` int(11) NOT NULL DEFAULT '0',
  `cow_id` int(11) NOT NULL DEFAULT '0',
  `pregnancy_type_id` int(11) NOT NULL DEFAULT '0',
  `semen_type` int(11) DEFAULT NULL,
  `semen_push_date` date DEFAULT NULL,
  `pregnancy_start_date` date DEFAULT NULL,
  `semen_cost` decimal(10,0) DEFAULT NULL,
  `other_cost` decimal(10,0) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '1=Processing, 2=Delivered, 3=Failed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pregnancy_record`
--

INSERT INTO `pregnancy_record` (`id`, `stall_no`, `cow_id`, `pregnancy_type_id`, `semen_type`, `semen_push_date`, `pregnancy_start_date`, `semen_cost`, `other_cost`, `note`, `status`, `created_at`, `updated_at`) VALUES
(5, 3, 16, 2, 1, '2020-03-15', '2020-04-15', '150', '50', 'Everything is perfect and no problem. Data Updated', 1, '2020-04-22 06:09:22', '2020-04-22 18:16:03');

-- --------------------------------------------------------

--
-- Table structure for table `pregnancy_type`
--

CREATE TABLE `pregnancy_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `type_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pregnancy_type`
--

INSERT INTO `pregnancy_type` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'Automatic', '2020-04-17 05:13:04', NULL),
(2, 'By Collected Semen', '2020-04-17 05:13:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sale_milk`
--

CREATE TABLE `sale_milk` (
  `id` int(11) NOT NULL,
  `milk_account_number` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `supplier_id` int(155) DEFAULT NULL,
  `name` varchar(155) CHARACTER SET utf8 DEFAULT NULL,
  `contact` varchar(155) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(155) CHARACTER SET utf8 DEFAULT NULL,
  `litter` decimal(15,2) DEFAULT NULL,
  `rate` decimal(15,2) DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT NULL,
  `paid` decimal(15,2) DEFAULT NULL,
  `due` decimal(15,2) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_milk`
--

INSERT INTO `sale_milk` (`id`, `milk_account_number`, `supplier_id`, `name`, `contact`, `email`, `address`, `litter`, `rate`, `total_amount`, `paid`, `due`, `branch_id`, `date`, `added_by`, `created_at`, `updated_at`) VALUES
(7, '04262020', 5, 'Rahim Raja', '01356000000', 'rahim@gmail.com', 'Kalshi, Dhaka, Bangladesh', '15.00', '3.00', '45.00', '25.00', '20.00', 1, '2020-04-26', 1, '2020-04-25 22:50:59', '2020-04-26 05:33:03'),
(8, '04062020', 4, 'Mr. Asad Ullah', '01457000000', 'asad@gmail.com', 'shyamoli, Dhaka', '8.00', '5.00', '40.00', '25.00', '15.00', 1, '2020-04-26', 1, '2020-04-26 09:24:25', '2020-04-26 09:24:25'),
(9, '04062020', 5, 'Rahim Raja', '01356000000', 'rahim@gmail.com', 'Kalshi, Dhaka, Bangladesh', '4.00', '5.00', '20.00', '20.00', '0.00', 1, '2020-04-29', 1, '2020-04-29 03:59:35', '2020-04-29 03:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `sheds`
--

CREATE TABLE `sheds` (
  `id` int(11) NOT NULL,
  `shed_number` varchar(255) DEFAULT NULL,
  `description` text,
  `branch_id` int(11) DEFAULT NULL,
  `status` int(3) NOT NULL DEFAULT '0' COMMENT '1=Alloted, 0=Empty',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sheds`
--

INSERT INTO `sheds` (`id`, `shed_number`, `description`, `branch_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Stall-001', 'Strong One', 1, 1, '2020-02-08 20:19:52', '2020-03-25 18:58:19'),
(2, 'Stall-002', 'Weak One', 1, 0, '2020-02-08 20:20:11', '2020-04-05 12:59:34'),
(3, 'Stall-003', NULL, 1, 1, '2020-03-25 03:00:59', '2020-03-25 18:52:14'),
(4, 'Stall-004', 'Good', 1, 0, '2020-03-25 03:01:09', '2020-04-05 14:48:00'),
(5, 'Stall-005', 'Good', 1, 1, '2020-03-25 03:01:19', '2020-04-26 17:39:17'),
(7, 'Stall-006', 'Good', 1, 1, '2020-03-27 17:39:51', '2020-04-26 13:31:49'),
(8, 'Stall-007', 'Good', 1, 0, '2020-03-27 17:40:07', '2020-04-05 14:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(11) NOT NULL,
  `name` varchar(155) DEFAULT NULL,
  `company_name` varchar(250) DEFAULT NULL,
  `phn_number` varchar(55) DEFAULT NULL,
  `present_address` text,
  `mail_address` varchar(150) DEFAULT NULL,
  `profile_image` text,
  `branch_id` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `company_name`, `phn_number`, `present_address`, `mail_address`, `profile_image`, `branch_id`, `created_at`, `updated_at`) VALUES
(1, 'MD Rana', 'Xyz Limited', '01756000000', 'Uttara, Dhaka, Bangladesh', 'rana@gmail.com', '792080818081155.jpg', 1, '2018-07-05 01:04:46', '2020-02-16 10:48:49'),
(3, 'Shakil Hasan', 'HBO.CO', '01569000000', 'Dhanmondi, Bangladesh', 'shakil@gmail.com', '142280420015422.png', 1, '2018-07-05 01:10:36', '2020-04-28 07:54:22'),
(4, 'Mr. Asad Ullah', 'Web IT SOFT', '01457000000', 'shyamoli, Dhaka', 'asad@gmail.com', '603280420015409.png', 1, '2018-07-05 05:14:12', '2020-04-28 07:54:09'),
(5, 'Rahim Raja', 'Radisson Blu .Co', '01356000000', 'Kalshi, Dhaka, Bangladesh', 'rahim@gmail.com', '391080818081218.jpg', 1, '2018-07-13 22:52:37', '2020-02-16 10:49:44'),
(6, 'MD. Dsel', 'D.Sel Ltd', '01756000000', 'Dhaka', 'dd@gmail.com', '529280420015402.png', 1, '2019-03-30 04:05:27', '2020-04-28 07:54:02'),
(7, 'Piter', 'Piter Dairy Farm', '+898989898', 'Test Company USA', 'peter@yahoo.com', '222280420015415.png', 1, '2020-03-28 14:12:24', '2020-04-28 07:54:15');

-- --------------------------------------------------------

--
-- Table structure for table `system_control`
--

CREATE TABLE `system_control` (
  `system_key_id` int(11) NOT NULL,
  `key` varchar(250) NOT NULL,
  `value` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_control`
--

INSERT INTO `system_control` (`system_key_id`, `key`, `value`, `status`, `created_at`, `updated_at`) VALUES
(61, 'system_config', '{\"currencySymbol\":\"$\",\"currencyPosition\":\"left\",\"currencySeparator\":\".\",\"loginTitle\":\"Dairy Farm Management System\",\"topTitle\":\"KHAN DAIRY FARM\",\"copyrightText\":\"sakosys\",\"copyrightLink\":\"http:\\/\\/sakosys.com\",\"logo\":\"751280420015239.png\",\"super_admin_logo\":\"538280420015239.png\"}', 1, '2020-05-10 02:24:24', '2020-05-10 02:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_max_power`
--

CREATE TABLE `tbl_max_power` (
  `id` int(11) NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `purchase_key` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `last_check_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_hint` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` int(11) NOT NULL DEFAULT '0',
  `basic_salary` decimal(15,2) DEFAULT NULL,
  `gross_salary` decimal(15,2) DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `resign_date` date DEFAULT NULL,
  `resign_desc` text COLLATE utf8mb4_unicode_ci,
  `user_type` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `password_hint`, `branch_id`, `image`, `nid`, `phone_number`, `present_address`, `parmanent_address`, `designation`, `basic_salary`, `gross_salary`, `joining_date`, `resign_date`, `resign_desc`, `user_type`, `status`, `created_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mr. Hasibur Rahman', 'admin@gmail.com', '$2y$10$zFGhKo0hNoGxPRX.N07zOuDYJllEyfp/gYTrsegI4uN7yxD44fv1y', '123456', NULL, '332161119010818.jpg', NULL, '012454121', 'Dhaka', 'Dhaka', 1, '50000.00', '60000.00', '2019-11-01', NULL, NULL, 1, 1, NULL, NULL, NULL, '2020-04-29 15:52:41'),
(2, 'Mirza Tarek', 'tarek@gamil.com', '$2y$10$Gt.C96j17T/QPwt2w11Kf.RPPKtMcFfZXpCpeqZ4luXdESXcZYilG', '123456', 1, '505280420015312.png', '12345698574', '01756000001', 'Dhaka', 'Naogaon', 2, '30000.00', '50000.00', '2019-10-01', NULL, NULL, 4, 1, 1, NULL, '2019-10-13 11:09:31', '2020-04-28 07:53:12'),
(16, 'Muhammad Rezaul Arif', 'caara09bd@gmail.com', '$2y$10$K0fnOa8WG0udERlUdNnht.NoHoEZvRFWGISnwyfMjoAlYJAYDmCQq', '123456', 1, '302280420015329.png', '1234567', '01827864013', 'uttara,dhaka', 'uttara,dhaka', 2, '15000.00', '15000.00', '2019-10-01', NULL, NULL, 0, 1, 1, NULL, '2019-10-18 22:32:09', '2020-04-28 07:53:29'),
(17, 'Iqbal Hossain', 'iqbal@gmail.com', '$2y$10$dvcwUhO973Gggved4WRhk.DEP4Onc776iSJmGUB768tBKhT259vEW', '123456', 1, '864280420015305.png', '1234567', '01825458696', 'Nilkhet,Dhaka', 'Nilkhet,Dhaka', 1, '15000.00', '15000.00', '2019-10-08', NULL, NULL, 4, 1, 1, NULL, '2019-10-19 07:38:39', '2020-04-28 07:53:05'),
(18, 'Mr Robin Khan', 'robin@gmail.com', '$2y$10$SSgeOzMpCTFzG9IFWV70b.ShjdM6p1xGt1w6rdIr3aqevEZKMbl2S', '123456', 1, '706280420015319.png', NULL, '01756000000', 'Dhaka', 'Dhaka', 2, '20000.00', '20000.00', '2019-10-03', NULL, NULL, 4, 1, 1, NULL, '2019-11-16 07:05:23', '2020-04-28 07:53:19'),
(19, 'Renu Roy', 'renu@gmail.com', '$2y$10$frZjxHx9ms.p.6iiLNPCg.mWXVuZNnTtjFoyXhdBEQO3.i41u/64O', '123456', 1, '941280420015340.png', NULL, '01532232322', 'Dhaka', 'Dhaka', 1, '100000.00', '150000.00', '2019-11-01', NULL, NULL, 0, 1, 1, NULL, '2019-11-16 07:06:14', '2020-04-28 07:53:40'),
(20, 'Danaver', 'danaver@gmail.com', '$2y$10$X6vnwV/H4RGw6YUMoeY6OuwHEuEqHwKmB/wcutr.36H2AAX7GwL0K', '123456', 1, '552280420015256.png', '1212121212121212121', '1212121212121', 'Test Address', 'Same Address', 1, '500.00', '700.00', '2020-03-18', NULL, NULL, 2, 1, 1, NULL, '2020-03-22 15:25:57', '2020-05-03 11:52:04'),
(21, 'Hasan Mia', 'miahasan@gmail.com', '$2y$10$W5UHem1jKywbk4mXwo1RzOP4xlcvpuZPrnEVU3KF79JNUzbUGaMZS', '123456', 1, '244290420012529.png', '54444444444444444444444444444', '454545454545', 'Test Address', 'Test Address', 1, '1500.00', '2000.00', '2020-05-01', NULL, NULL, 3, 1, 1, NULL, '2020-04-28 19:25:30', '2020-04-29 03:15:34');

-- --------------------------------------------------------

--
-- Table structure for table `users_type`
--

CREATE TABLE `users_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_type`
--

INSERT INTO `users_type` (`id`, `user_type`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', NULL, '2019-06-23 14:27:18', NULL),
(2, 'Admin', '{\"AnimalController\":{\"index\":\"index\",\"create\":\"create\",\"store\":\"store\",\"edit\":\"edit\",\"update\":\"update\",\"destroy\":\"destroy\"},\"AnimalTypeController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\"},\"BranchController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\",\"updateStatus\":\"updateStatus\"},\"CalfController\":{\"index\":\"index\",\"create\":\"create\",\"store\":\"store\",\"edit\":\"edit\",\"update\":\"update\",\"destroy\":\"destroy\"},\"CollectMilkController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\"},\"MilkCollectReportControlller\":{\"index\":\"index\",\"store\":\"store\"},\"CowFeedController\":{\"index\":\"index\",\"create\":\"create\",\"store\":\"store\",\"edit\":\"edit\",\"update\":\"update\",\"destroy\":\"destroy\"},\"CowMonitorController\":{\"index\":\"index\",\"create\":\"create\",\"store\":\"store\",\"edit\":\"edit\",\"update\":\"update\",\"destroy\":\"destroy\"},\"CowVaccineMonitorController\":{\"index\":\"index\",\"create\":\"create\",\"store\":\"store\",\"edit\":\"edit\",\"update\":\"update\",\"destroy\":\"destroy\"},\"SaleCowController\":{\"index\":\"index\",\"create\":\"create\",\"store\":\"store\",\"edit\":\"edit\",\"update\":\"update\",\"destroy\":\"destroy\"},\"DesignationController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\"},\"EmployeeSalaryController\":{\"index\":\"index\",\"create\":\"create\",\"store\":\"store\",\"edit\":\"edit\",\"update\":\"update\",\"destroy\":\"destroy\"},\"ExpenseController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\"},\"ExpensePurposeController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\"},\"FoodItemController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\"},\"FoodUnitController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\"},\"HumanResourceController\":{\"index\":\"index\",\"userList\":\"userList\",\"create\":\"create\",\"store\":\"store\",\"edit\":\"edit\",\"update\":\"update\",\"destroy\":\"destroy\"},\"MonitoringServicesController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\"},\"SaleMilkController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\"},\"ShedController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\"},\"SupplierContoller\":{\"index\":\"index\",\"create\":\"create\",\"store\":\"store\",\"edit\":\"edit\",\"update\":\"update\",\"destroy\":\"destroy\",\"supplierFilter\":\"supplierFilter\"},\"UserTypeController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\"},\"VaccinesController\":{\"index\":\"index\",\"store\":\"store\",\"update\":\"update\",\"destroy\":\"destroy\"},\"EmployeeSalaryReportController\":{\"index\":\"index\",\"store\":\"store\"},\"MilkSaleReportControlller\":{\"index\":\"index\",\"store\":\"store\"},\"OfficeExpensReportController\":{\"index\":\"index\",\"store\":\"store\"},\"SaleCowReportController\":{\"index\":\"index\",\"cowSaleReportSearch\":\"cowSaleReportSearch\"},\"CowVaccineMonitorReportController\":{\"index\":\"index\",\"store\":\"store\",\"vaccineWiseMonitoringReport\":\"vaccineWiseMonitoringReport\",\"getVaccineWiseMonitoringReport\":\"getVaccineWiseMonitoringReport\"},\"SaleDueCollectionController\":{\"index\":\"index\",\"store\":\"store\",\"getSaleHistory\":\"getSaleHistory\"},\"AnimalStatisticsController\":{\"index\":\"index\"},\"AnimalPregnancyController\":{\"index\":\"index\"},\"MilkSaleDueCollectionController\":{\"index\":\"index\"}}', '2019-07-05 13:47:06', '2020-04-26 11:16:11'),
(3, 'Accountant', NULL, '2019-10-13 07:13:45', '2020-02-07 10:16:54'),
(4, 'Marketing Executive', NULL, '2019-10-13 07:14:46', '2020-02-07 10:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `id` int(11) NOT NULL,
  `vaccine_name` varchar(255) DEFAULT NULL,
  `months` int(11) DEFAULT NULL COMMENT 'month digit',
  `repeat_vaccine` tinyint(4) NOT NULL DEFAULT '0',
  `dose` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `note` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`id`, `vaccine_name`, `months`, `repeat_vaccine`, `dose`, `note`, `created_at`, `updated_at`) VALUES
(1, 'BDV', 60, 0, NULL, 'Push this after 2 Months', '2020-02-07 12:21:07', '2020-04-11 12:23:37'),
(2, 'BVD', 90, 1, '(Vial: 30 ml)', 'Every 3 Months', '2020-02-07 12:22:15', '2020-04-11 14:05:55'),
(3, 'PI3', 120, 0, '3ml, midneck injection push.', 'After 4 Months', '2020-03-24 19:48:12', '2020-04-11 14:05:31'),
(4, 'BRSV', 365, 0, NULL, 'Once a Year\r\n Use 2.0 ml using Injection.', '2020-03-24 19:48:30', '2020-04-11 13:57:39'),
(6, 'Vitamin A', 60, 1, 'Oral Single Table', 'Twice a Month', '2020-03-24 19:57:01', '2020-04-12 06:11:30'),
(7, 'Anthrax', 120, 1, 'Annually in endemic areas.', '4 months and  above', '2020-04-11 14:07:00', '2020-04-11 14:07:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `animal_type`
--
ALTER TABLE `animal_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchs`
--
ALTER TABLE `branchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calf`
--
ALTER TABLE `calf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collect_milk`
--
ALTER TABLE `collect_milk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cow_feed`
--
ALTER TABLE `cow_feed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cow_feed_dtls`
--
ALTER TABLE `cow_feed_dtls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cow_monitor`
--
ALTER TABLE `cow_monitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cow_monitor_dtls`
--
ALTER TABLE `cow_monitor_dtls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cow_sale`
--
ALTER TABLE `cow_sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cow_sale_dtls`
--
ALTER TABLE `cow_sale_dtls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cow_sale_payments`
--
ALTER TABLE `cow_sale_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cow_vaccine_monitor`
--
ALTER TABLE `cow_vaccine_monitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cow_vaccine_monitor_dtls`
--
ALTER TABLE `cow_vaccine_monitor_dtls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_salary`
--
ALTER TABLE `employee_salary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purpose_id` (`purpose_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `expense_purpose`
--
ALTER TABLE `expense_purpose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_items`
--
ALTER TABLE `food_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food_units`
--
ALTER TABLE `food_units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milk_due_collections`
--
ALTER TABLE `milk_due_collections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitoring_services`
--
ALTER TABLE `monitoring_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pregnancy_record`
--
ALTER TABLE `pregnancy_record`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pregnancy_type`
--
ALTER TABLE `pregnancy_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_milk`
--
ALTER TABLE `sale_milk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sheds`
--
ALTER TABLE `sheds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_control`
--
ALTER TABLE `system_control`
  ADD PRIMARY KEY (`system_key_id`);

--
-- Indexes for table `tbl_max_power`
--
ALTER TABLE `tbl_max_power`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_type`
--
ALTER TABLE `users_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccines`
--
ALTER TABLE `vaccines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `animal_type`
--
ALTER TABLE `animal_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `branchs`
--
ALTER TABLE `branchs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `calf`
--
ALTER TABLE `calf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `collect_milk`
--
ALTER TABLE `collect_milk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cow_feed`
--
ALTER TABLE `cow_feed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `cow_feed_dtls`
--
ALTER TABLE `cow_feed_dtls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `cow_monitor`
--
ALTER TABLE `cow_monitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `cow_monitor_dtls`
--
ALTER TABLE `cow_monitor_dtls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `cow_sale`
--
ALTER TABLE `cow_sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `cow_sale_dtls`
--
ALTER TABLE `cow_sale_dtls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `cow_sale_payments`
--
ALTER TABLE `cow_sale_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `cow_vaccine_monitor`
--
ALTER TABLE `cow_vaccine_monitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `cow_vaccine_monitor_dtls`
--
ALTER TABLE `cow_vaccine_monitor_dtls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee_salary`
--
ALTER TABLE `employee_salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `expense_purpose`
--
ALTER TABLE `expense_purpose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `food_units`
--
ALTER TABLE `food_units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `milk_due_collections`
--
ALTER TABLE `milk_due_collections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `monitoring_services`
--
ALTER TABLE `monitoring_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pregnancy_record`
--
ALTER TABLE `pregnancy_record`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `pregnancy_type`
--
ALTER TABLE `pregnancy_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sale_milk`
--
ALTER TABLE `sale_milk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sheds`
--
ALTER TABLE `sheds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `system_control`
--
ALTER TABLE `system_control`
  MODIFY `system_key_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `tbl_max_power`
--
ALTER TABLE `tbl_max_power`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `users_type`
--
ALTER TABLE `users_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
