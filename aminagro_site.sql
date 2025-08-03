-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 03, 2025 at 05:44 PM
-- Server version: 8.4.3
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aminagro_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `id` int NOT NULL,
  `DOB` date DEFAULT NULL,
  `age` int DEFAULT '0',
  `weight` decimal(15,2) DEFAULT NULL,
  `height` decimal(15,2) DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` int DEFAULT NULL,
  `animal_type` int DEFAULT NULL,
  `animal_breed` int DEFAULT NULL,
  `pregnant_status` int DEFAULT NULL COMMENT '0=>No, 1=>Yes',
  `before_no_of_pregnant` int DEFAULT NULL,
  `pictures` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pregnancy_time` date DEFAULT NULL,
  `buy_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_price` decimal(15,2) DEFAULT NULL,
  `milk_ltr_per_day` decimal(15,2) DEFAULT NULL,
  `shade_no` int DEFAULT NULL,
  `previous_vaccine_done` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vaccines` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buy_date` date DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `sale_status` int NOT NULL DEFAULT '0' COMMENT '0=Available, 1=Sold',
  `note` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `genderbn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Pragnant_Status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Caving_Date` date DEFAULT NULL,
  `Lactating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Non_Lactating` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Company_Name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Teeth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Purpose` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Bull_Stage` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`id`, `DOB`, `age`, `weight`, `height`, `gender`, `color`, `animal_type`, `animal_breed`, `pregnant_status`, `before_no_of_pregnant`, `pictures`, `pregnancy_time`, `buy_from`, `buying_price`, `milk_ltr_per_day`, `shade_no`, `previous_vaccine_done`, `vaccines`, `buy_date`, `branch_id`, `sale_status`, `note`, `user_id`, `genderbn`, `Pragnant_Status`, `Caving_Date`, `Lactating`, `Non_Lactating`, `Company_Name`, `Teeth`, `Purpose`, `Bull_Stage`, `created_at`, `updated_at`) VALUES
(1, '2021-02-01', 1539, 550.00, 55.00, 'Male', 7, 22, 23, 0, NULL, '', NULL, 'Ambari Hat', 297500.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-12-16', 1, 1, 'sdfsdf', 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '8', 'Fettaining', 'Bull', '2025-04-21 02:24:29', '2025-07-12 13:20:24'),
(2, '2020-08-01', 1715, 550.00, 58.00, 'Male', 3, 7, 26, 0, NULL, NULL, NULL, 'Borobari Hat', 226000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-24', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '6', 'Fettaining', 'Bull', '2025-04-12 18:41:53', '2025-04-20 21:10:04'),
(3, '2021-02-01', 1540, 550.00, 58.00, 'Male', 3, 7, 27, 0, NULL, NULL, NULL, 'Kaharul Hat', 168000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-26', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '6', 'Fettaining', 'Bull', '2025-04-21 19:21:53', '2025-04-21 19:21:53'),
(4, '2021-05-01', 1442, 500.00, 50.00, 'Male', 2, 7, 26, 0, NULL, NULL, NULL, 'Kaharul Hat', 213000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-26', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '6', 'Fettaining', 'Bull', '2025-04-12 18:48:26', '2025-04-15 03:10:22'),
(5, '2021-02-01', 1531, 450.00, 48.00, 'Male', 2, 7, 26, 0, NULL, NULL, NULL, 'Kaharul Hat', 144000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-26', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-12 18:51:49', '2025-04-16 20:18:38'),
(6, '2021-05-01', 1442, 420.00, 48.00, 'Male', 2, 7, 26, 0, NULL, NULL, NULL, 'Kaharul Hat', 138000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-26', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-12 18:55:09', '2025-04-12 18:55:09'),
(7, '2022-01-01', 1197, 580.00, 58.00, 'Male', 2, 7, 26, 0, NULL, NULL, NULL, 'Borobari Hat', 286506.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-26', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '6', 'Fettaining', 'Bull', '2025-04-12 19:05:11', '2025-04-12 19:05:11'),
(8, '2021-06-01', 1413, 380.00, 48.00, 'Male', 2, 7, 26, 0, NULL, NULL, NULL, 'Borobari Hat', 133000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-23', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '6', 'Fettaining', 'Bull', '2025-04-15 03:21:45', '2025-04-15 03:21:45'),
(9, '2021-05-01', 1444, 350.00, 46.00, 'Male', 0, 7, 26, 0, NULL, NULL, NULL, 'Kaharul Hat', 126000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-26', 1, 1, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-15 03:28:15', '2025-06-22 18:27:31'),
(10, '2021-05-01', 1444, 420.00, 48.00, 'Male', 2, 7, 26, 0, NULL, NULL, NULL, 'Kaharul Hat', 122000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-26', 1, 1, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-15 03:30:37', '2025-06-22 18:29:29'),
(11, '2021-05-01', 1444, 350.00, 46.00, 'Male', 2, 7, 26, 0, NULL, NULL, NULL, 'Borobari Hat', 123000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-23', 1, 1, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '2', 'Fettaining', 'Bull', '2025-04-15 03:34:07', '2025-06-22 18:31:15'),
(12, '2021-05-01', 1444, 420.00, 46.00, 'Male', 3, 7, 26, 0, NULL, NULL, NULL, 'Borobari Hat', 179000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-23', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-15 03:36:49', '2025-04-15 03:36:49'),
(13, '2022-04-01', 1109, 650.00, 62.00, 'Male', 3, 7, 27, 0, NULL, NULL, NULL, 'Kaharul Hat', 263433.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-26', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-15 03:42:08', '2025-04-15 03:42:08'),
(14, '2020-11-01', 1626, 280.00, 46.00, 'Male', 2, 7, 26, 0, NULL, NULL, NULL, 'Borobari Hat', 111000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-23', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-15 20:11:16', '2025-04-15 20:11:16'),
(15, '2020-11-01', 1626, 280.00, 46.00, 'Male', 2, 7, 26, 0, NULL, NULL, NULL, 'Borobari Hat', 105000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-23', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-15 20:14:30', '2025-04-15 20:14:30'),
(16, '2020-11-01', 1626, 350.00, 46.00, 'Male', 1, 29, 24, 0, NULL, NULL, NULL, 'Kaharul Hat', 135000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-26', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-15 20:18:54', '2025-04-15 20:18:54'),
(17, '2020-11-01', 1626, 380.00, 46.00, 'Male', 12, 29, 24, 0, NULL, NULL, NULL, 'Kaharul Hat', 139000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-26', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-15 20:21:04', '2025-04-15 20:21:04'),
(18, '2020-08-01', 1718, 550.00, 62.00, 'Male', 3, 7, 27, 0, NULL, NULL, NULL, 'Borobari Hat', 222500.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-30', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-15 20:25:29', '2025-04-15 20:25:29'),
(19, '2020-11-01', 1626, 420.00, 50.00, 'Male', 2, 7, 26, 0, NULL, NULL, NULL, 'Borobari Hat', 126000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-30', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Fettaining', 'Bull', '2025-04-15 20:37:26', '2025-04-15 20:37:26'),
(20, '2021-02-01', 1534, 600.00, 58.00, 'Female', 1, 7, 25, 0, NULL, '', NULL, 'Borobari Hat', 180000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-30', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Breeding', 'Heifer', '2025-04-15 20:41:52', '2025-04-15 20:45:17'),
(21, '2021-02-01', 1534, 350.00, 48.00, 'Female', 2, 7, 26, 0, NULL, '', NULL, 'Borobari Hat', 118000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-30', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Breeding', 'Heifer', '2025-04-15 20:44:09', '2025-04-16 20:26:25'),
(22, '2021-02-01', 1535, 350.00, 48.00, 'Female', 3, 7, 27, 1, NULL, NULL, NULL, 'Borobari Hat', 274871.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-30', 1, 0, NULL, 0, NULL, 'Yes', '2025-04-15', 'Yes', NULL, 'LTL', '4', 'Breeding', 'Cow', '2025-04-16 22:52:14', '2025-04-16 22:52:14'),
(23, '2020-01-01', 1932, 450.00, 55.00, 'Female', 3, 7, 27, 1, NULL, NULL, NULL, 'Borobari Hat', 313314.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-30', 1, 0, NULL, 0, NULL, 'Yes', NULL, 'Yes', NULL, 'ADL', '8', 'Breeding', 'Cow', '2025-04-16 23:07:42', '2025-04-16 23:07:42'),
(24, '2022-05-01', 1086, 350.00, 50.00, 'Female', 3, 7, 27, 1, NULL, NULL, NULL, 'Borobari Hat', 264934.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-30', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '4', 'Breeding', 'Cow', '2025-04-21 18:29:52', '2025-04-21 18:29:52'),
(25, '2020-01-01', 1937, 550.00, 55.00, 'Female', 3, 7, 27, 0, NULL, NULL, NULL, 'Borobari Hat', 254000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-11-30', 1, 0, NULL, 0, NULL, 'No', NULL, NULL, NULL, NULL, '8', 'Breeding', 'Cow', '2025-04-21 18:35:46', '2025-04-21 18:35:46'),
(26, '2022-05-01', 1086, 350.00, 48.00, 'Female', 3, 7, 27, 1, 2, NULL, NULL, 'Borobari Hat', 218814.00, NULL, 19, 'Yes', '', '2022-11-30', 1, 0, NULL, 0, NULL, 'Yes', NULL, 'Yes', NULL, 'LTL', '4', 'Breeding', 'Cow', '2025-04-21 18:38:03', '2025-04-21 18:38:03'),
(27, '2020-01-01', 1937, 450.00, 50.00, 'Female', 2, 7, 26, 0, NULL, NULL, NULL, 'Ambari Hat', 109000.00, NULL, 19, 'Yes', '[\"9\",\"11\"]', '2022-12-02', 1, 0, NULL, 0, NULL, 'No', NULL, 'No', 'Yes', NULL, '8', 'Fettaining', 'Cow', '2025-04-21 18:56:03', '2025-04-21 18:56:03'),
(28, '2020-01-01', 1937, 350.00, 48.00, 'Female', 4, 7, 26, 0, NULL, NULL, NULL, 'Ambari Hat', 87000.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-12-02', 1, 0, NULL, 0, NULL, 'No', NULL, 'No', NULL, NULL, '8', 'Fettaining', 'Cow', '2025-04-21 19:01:19', '2025-04-21 19:01:19'),
(29, '2020-11-01', 1632, 450.00, 50.00, 'Female', 1, 29, 24, 1, 2, NULL, NULL, 'Ambari Hat', 121574.00, NULL, 19, 'Yes', '[\"9\",\"10\",\"11\"]', '2022-12-02', 1, 0, NULL, 0, NULL, 'Yes', NULL, NULL, NULL, NULL, '8', 'Breeding', 'Cow', '2025-04-21 19:03:50', '2025-04-21 19:03:50'),
(1001, '2025-06-02', 27, 10.00, 200.00, 'Female', 11, 7, 27, 0, NULL, '742290625122324.webp_224290625124516.png', '2025-06-25', 'ab seller', 5000.00, 1.00, 21, 'Yes', '[\"9\",\"11\",\"16\"]', '2025-05-28', 1, 1, NULL, 0, NULL, 'No', '2025-06-08', '456', NULL, 'asdf', '5', 'Breeding', 'Bull', '2025-06-29 06:23:24', '2025-07-12 13:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `animal_groups`
--

CREATE TABLE `animal_groups` (
  `id` bigint UNSIGNED NOT NULL,
  `animal_id` bigint UNSIGNED DEFAULT NULL,
  `group_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `animal_groups`
--

INSERT INTO `animal_groups` (`id`, `animal_id`, `group_id`, `created_at`, `updated_at`) VALUES
(65, 5, 6, '2025-06-30 10:11:00', '2025-06-30 10:11:00');

-- --------------------------------------------------------

--
-- Table structure for table `animal_type`
--

CREATE TABLE `animal_type` (
  `id` int NOT NULL,
  `type_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `type` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `animal_type`
--

INSERT INTO `animal_type` (`id`, `type_name`, `type`, `created_at`, `updated_at`) VALUES
(7, 'হলস্টাইন ফ্রিজিয়ান', NULL, '2020-03-25 14:28:02', '2025-04-10 03:35:04'),
(14, 'দেশি গরু', NULL, '2025-03-03 21:22:09', '2025-03-03 21:22:09'),
(15, 'বলদ গরু', NULL, '2025-03-16 02:25:47', '2025-03-16 02:25:47'),
(22, 'ইন্ডিয়ান', NULL, '2025-04-10 03:27:02', '2025-04-10 03:34:27'),
(23, 'হরিয়ানা', 1, '2025-04-10 03:28:08', '2025-04-10 03:31:48'),
(24, 'শাহিওয়াল', 1, '2025-04-10 03:28:22', '2025-04-10 03:34:10'),
(25, 'শাহিওয়াল হলস্টাইন ফ্রিজিয়ান ক্রস', 1, '2025-04-10 03:29:06', '2025-04-10 03:33:41'),
(26, 'হলস্টাইন ফ্রিজিয়ান ক্রস', 1, '2025-04-10 03:29:19', '2025-04-10 03:35:47'),
(27, 'হলস্টাইন ফ্রিজিয়ান', 1, '2025-04-10 03:29:53', '2025-04-10 03:35:28'),
(28, 'হাসা গরু', NULL, '2025-04-10 03:30:34', '2025-04-10 03:30:52'),
(29, 'দেশি শাহিওয়াল', NULL, '2025-04-15 20:17:13', '2025-04-15 20:17:13');

-- --------------------------------------------------------

--
-- Table structure for table `beef_collection`
--

CREATE TABLE `beef_collection` (
  `id` int NOT NULL,
  `cow` int NOT NULL,
  `qty` varchar(155) NOT NULL,
  `unit` varchar(55) NOT NULL,
  `details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` varchar(155) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `branchs`
--

CREATE TABLE `branchs` (
  `id` int NOT NULL,
  `branch_name` varchar(155) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `branch_address` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `phone_number` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `setup_date` date DEFAULT NULL,
  `builders_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branchs`
--

INSERT INTO `branchs` (`id`, `branch_name`, `branch_address`, `phone_number`, `email`, `setup_date`, `builders_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Branch - 01', 'Tatuliya, Rangpur road, Fulbari, Dinajpur', '01774459511', 'aminagrofarm589@gmail.com', '2025-03-20', 'Ruhul Amin', 1, '2018-09-23 12:52:37', '2025-03-20 21:56:41');

-- --------------------------------------------------------

--
-- Table structure for table `buyer`
--

CREATE TABLE `buyer` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(155) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `balance` varchar(55) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buyer`
--

INSERT INTO `buyer` (`id`, `name`, `phone`, `address`, `balance`, `created_at`, `updated_at`) VALUES
(5, 'Jahangir', '01710053481', 'Bodorganj', '0', '2025-04-12 12:17:58', '2025-04-13 01:17:58'),
(6, 'Haydar', '01723631837', 'Bodorganj', '0', '2025-04-12 12:18:12', '2025-04-13 01:18:12'),
(7, 'Jamil', '01319530191', 'Kalir Hat', '0', '2025-03-21 03:47:44', '2025-03-21 03:47:44'),
(8, 'Aftabganj Hat', '00-00', 'Aftabganj', '0', '2025-03-21 03:48:31', '2025-03-21 03:48:31'),
(9, 'Ambari Hat', '00-00', 'Ambari', '0', '2025-03-21 03:49:01', '2025-03-21 03:49:01'),
(10, 'test', '01795828708', 'Chatoli', '5', '2025-07-12 13:20:24', '2025-07-12 13:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `buy_medicine`
--

CREATE TABLE `buy_medicine` (
  `id` int NOT NULL,
  `branch` int NOT NULL,
  `suppliers` int NOT NULL,
  `medicine` int NOT NULL,
  `quantity` varchar(55) NOT NULL,
  `unit` varchar(55) NOT NULL,
  `price` varchar(55) DEFAULT NULL,
  `description` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `date` varchar(155) NOT NULL,
  `purpose_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buy_medicine`
--

INSERT INTO `buy_medicine` (`id`, `branch`, `suppliers`, `medicine`, `quantity`, `unit`, `price`, `description`, `date`, `purpose_id`, `created_at`, `updated_at`) VALUES
(28, 1, 10, 16, '4', 'Piece', NULL, 'For Digestibillity', '2025-06-26', NULL, '2025-06-26 18:54:34', '2025-06-26 18:54:34'),
(29, 1, 10, 16, '4', 'Piece', NULL, 'For Digestibility', '2025-06-26', NULL, '2025-06-26 18:55:29', '2025-06-26 18:55:29'),
(30, 1, 10, 12, '2', 'KG', NULL, 'zsdf', '2025-07-25', NULL, '2025-07-12 07:47:26', '2025-07-12 07:47:26'),
(33, 1, 11, 1, '10', 'KG', NULL, 'asdf', '2025-07-09', NULL, '2025-07-12 09:04:49', '2025-07-12 09:04:49'),
(34, 1, 10, 1, '7', 'Piece', NULL, 'asdf', '2025-07-12', NULL, '2025-07-12 09:05:55', '2025-07-12 09:05:55'),
(35, 1, 12, 25, '2', 'Piece', NULL, 'asdf', '2025-07-08', NULL, '2025-07-12 09:09:52', '2025-07-12 09:09:52'),
(36, 1, 12, 1, '2', 'Piece', NULL, 'asdf', '2025-07-15', NULL, '2025-07-12 09:10:20', '2025-07-12 09:10:20'),
(37, 1, 12, 12, '1', 'Gram', NULL, 'asdf', '2025-07-04', NULL, '2025-07-12 11:48:55', '2025-07-12 11:48:55'),
(38, 1, 10, 10, '43', 'KG', NULL, '45', '2025-07-12', NULL, '2025-07-12 11:53:18', '2025-07-12 11:53:18'),
(39, 1, 9, 15, '43', '25 Kg Bosta', NULL, 'asdf', '2025-07-12', 14, '2025-07-12 11:54:13', '2025-07-12 11:54:13'),
(40, 1, 9, 16, '5', '25 Kg Bosta', NULL, 'asdf sadf', '2025-07-12', 13, '2025-07-12 12:19:20', '2025-07-12 12:19:20'),
(41, 1, 11, 10, '2', 'Piece', NULL, 'asdf', '2025-07-12', 13, '2025-07-12 12:32:27', '2025-07-12 12:32:27'),
(42, 1, 11, 11, '2', 'Piece', '10.2', 'asdf', '2025-07-12', 13, '2025-07-12 12:44:01', '2025-07-12 12:44:01'),
(43, 1, 11, 10, '2', 'KG', '50', 'fasdf', '2025-07-12', 13, '2025-07-12 13:26:26', '2025-07-12 13:26:26'),
(44, 1, 11, 12, '2', 'KG', '34', 'asdf', '2025-07-13', 14, '2025-07-13 05:02:04', '2025-07-13 05:02:04'),
(45, 1, 10, 12, '23', 'Piece', '19', 'asdf', '2025-07-13', 14, '2025-07-13 05:54:01', '2025-07-13 05:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `calf`
--

CREATE TABLE `calf` (
  `id` int NOT NULL,
  `DOB` date DEFAULT NULL,
  `animal_id` int DEFAULT NULL,
  `age` int DEFAULT '0',
  `weight` decimal(15,2) DEFAULT NULL,
  `height` decimal(15,2) DEFAULT NULL,
  `gender` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` int DEFAULT NULL,
  `animal_type` int DEFAULT NULL,
  `animal_breed` int DEFAULT NULL,
  `pictures` text COLLATE utf8mb4_unicode_ci,
  `buy_from` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `buying_price` decimal(15,2) DEFAULT NULL,
  `shade_no` int DEFAULT NULL,
  `previous_vaccine_done` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vaccines` text COLLATE utf8mb4_unicode_ci,
  `buy_date` date DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `sale_status` int NOT NULL DEFAULT '0' COMMENT '0=Available, 1=Sold',
  `note` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT '0',
  `father_id` int DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `claf_blood` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `collect_milk`
--

CREATE TABLE `collect_milk` (
  `id` int NOT NULL,
  `account_number` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_general_ci,
  `dairy_number` int DEFAULT NULL,
  `stall_no` int NOT NULL DEFAULT '0',
  `liter` decimal(15,2) DEFAULT NULL,
  `fate` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `liter_price` decimal(15,2) DEFAULT NULL,
  `total` decimal(15,2) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `branch_id` int NOT NULL,
  `added_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `collect_milk`
--

INSERT INTO `collect_milk` (`id`, `account_number`, `name`, `address`, `dairy_number`, `stall_no`, `liter`, `fate`, `liter_price`, `total`, `date`, `branch_id`, `added_by`, `created_at`, `updated_at`) VALUES
(18, '01', 'Others', NULL, 1, 19, 20.00, NULL, 60.00, 1200.00, '2025-03-23', 1, 1, '2025-03-23 21:53:59', '2025-03-23 21:53:59'),
(19, '01', 'Others', NULL, 1, 19, 20.00, NULL, 60.00, 1200.00, '2025-03-23', 1, 1, '2025-03-23 22:06:39', '2025-03-23 22:06:39'),
(22, '22', NULL, NULL, 3, 19, 50.00, NULL, 100.00, 5000.00, '2025-04-05', 1, 2, '2025-04-05 21:30:51', '2025-04-05 21:30:51'),
(23, '23', NULL, NULL, 1, 19, 20.00, '4', 100.00, 2000.00, '2025-04-06', 1, 2, '2025-04-06 23:59:35', '2025-04-06 23:59:35'),
(29, '29', NULL, NULL, 1, 19, 10.00, NULL, 10.00, NULL, '2025-04-10', 1, 2, '2025-04-10 18:01:05', '2025-04-10 18:01:05'),
(30, '30', NULL, NULL, 2, 19, 20.00, NULL, 10.00, NULL, '2025-04-10', 1, 2, '2025-04-10 18:01:05', '2025-04-10 18:01:05'),
(31, '31', NULL, NULL, 1, 19, 10.00, NULL, 10.00, NULL, '2025-04-10', 1, 2, '2025-04-10 18:01:36', '2025-04-10 18:01:36'),
(32, '32', NULL, NULL, 2, 19, 20.00, NULL, 10.00, NULL, '2025-04-10', 1, 2, '2025-04-10 18:01:36', '2025-04-10 18:01:36'),
(33, '33', NULL, NULL, 1, 19, 10.00, NULL, 10.00, NULL, '2025-04-10', 1, 2, '2025-04-10 18:02:28', '2025-04-10 18:02:28'),
(34, '34', NULL, NULL, 2, 19, 20.00, NULL, 10.00, NULL, '2025-04-10', 1, 2, '2025-04-10 18:02:28', '2025-04-10 18:02:28');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int NOT NULL,
  `color_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `created_at`, `updated_at`) VALUES
(1, 'Red', '2020-02-07 11:42:37', '2020-02-07 11:42:37'),
(2, 'Black', '2020-02-07 11:42:42', '2020-02-07 11:42:42'),
(3, 'Black & White', '2020-03-25 19:33:07', '2020-03-25 19:33:07'),
(4, 'Red & Black', '2020-03-25 19:33:22', '2020-03-25 19:33:22'),
(5, 'White Hasa', '2020-03-25 19:33:41', '2025-03-21 17:45:22'),
(6, 'Mixed', '2020-03-25 19:34:08', '2020-03-25 19:34:08'),
(7, 'Surma', '2025-03-21 17:43:37', '2025-03-21 17:43:37'),
(8, 'Pakra', '2025-03-21 17:43:59', '2025-03-21 17:43:59'),
(9, 'Red & White', '2025-03-21 17:44:43', '2025-03-21 17:44:43'),
(10, 'Red Hasa', '2025-03-21 17:45:03', '2025-03-21 17:45:03'),
(11, 'Deep Red', '2025-03-21 17:46:33', '2025-03-21 17:46:33'),
(12, 'Ash', '2025-03-21 17:47:21', '2025-03-21 17:47:21'),
(13, 'Deep Brown', '2025-03-21 17:48:05', '2025-03-21 17:48:05');

-- --------------------------------------------------------

--
-- Table structure for table `cow_feed`
--

CREATE TABLE `cow_feed` (
  `id` int NOT NULL,
  `shed_no` int DEFAULT NULL,
  `cow_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` text,
  `branch_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_feed`
--

INSERT INTO `cow_feed` (`id`, `shed_no`, `cow_id`, `date`, `note`, `branch_id`, `created_at`, `updated_at`) VALUES
(97, 19, 3, '2025-04-03', NULL, 1, '2025-04-03 19:17:02', '2025-04-03 19:17:02'),
(98, 19, 3, '2025-04-07', NULL, 1, '2025-04-07 19:04:50', '2025-04-07 19:04:50'),
(99, 19, 3, '2025-04-07', NULL, 1, '2025-04-07 19:14:45', '2025-04-07 19:14:45'),
(102, 19, 142540, '2025-04-10', NULL, 1, '2025-04-10 22:40:47', '2025-04-10 22:40:47'),
(103, 19, 1, '2025-06-28', NULL, 1, '2025-06-28 19:12:10', '2025-06-28 19:12:10'),
(104, 19, 24, '2025-06-29', 'dsf', 1, '2025-06-29 11:25:56', '2025-06-29 11:25:56'),
(105, 19, 26, '2025-06-29', 'dsf', 1, '2025-06-29 11:25:56', '2025-06-29 11:25:56'),
(106, 19, 27, '2025-06-29', 'dsf', 1, '2025-06-29 11:25:56', '2025-06-29 11:25:56'),
(107, 19, 2, '2025-06-01', NULL, 1, '2025-06-30 07:02:25', '2025-06-30 07:02:25'),
(108, 19, 3, '2025-06-01', NULL, 1, '2025-06-30 07:02:25', '2025-06-30 07:02:25'),
(109, NULL, 2, '2025-06-30', NULL, 1, '2025-06-30 07:24:01', '2025-06-30 07:24:01'),
(110, NULL, 3, '2025-06-30', NULL, 1, '2025-06-30 07:24:01', '2025-06-30 07:24:01'),
(111, 2, 2, '2025-06-29', NULL, 1, '2025-06-30 07:29:05', '2025-06-30 07:29:05'),
(112, 2, 3, '2025-06-29', NULL, 1, '2025-06-30 07:29:05', '2025-06-30 07:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `cow_feed_dtls`
--

CREATE TABLE `cow_feed_dtls` (
  `id` int NOT NULL,
  `feed_id` int DEFAULT NULL,
  `item_id` int DEFAULT NULL,
  `qty` decimal(15,2) DEFAULT NULL,
  `unit_id` int DEFAULT NULL,
  `time` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_feed_dtls`
--

INSERT INTO `cow_feed_dtls` (`id`, `feed_id`, `item_id`, `qty`, `unit_id`, `time`, `created_at`, `updated_at`) VALUES
(99, 97, 56, 1.00, 2, NULL, '2025-04-03 19:17:02', '2025-04-03 19:17:02'),
(100, 97, 75, 2.00, 1, NULL, '2025-04-03 19:17:02', '2025-04-03 19:17:02'),
(101, 97, 60, 1.00, 2, NULL, '2025-04-03 19:17:02', '2025-04-03 19:17:02'),
(102, 97, 61, 1.00, 3, NULL, '2025-04-03 19:17:02', '2025-04-03 19:17:02'),
(103, 98, 56, 1.00, 2, NULL, '2025-04-07 19:04:50', '2025-04-07 19:04:50'),
(104, 99, 56, 1.00, 2, NULL, '2025-04-07 19:14:45', '2025-04-07 19:14:45'),
(107, 102, 77, 1.00, 4, NULL, '2025-04-10 22:40:47', '2025-04-10 22:40:47'),
(108, NULL, 91, 2.00, 8, NULL, '2025-04-13 17:49:32', '2025-04-13 17:49:32'),
(109, NULL, 60, 1.00, 2, NULL, '2025-04-13 17:49:32', '2025-04-13 17:49:32'),
(110, NULL, 93, 5.00, 2, NULL, '2025-04-14 01:06:51', '2025-04-14 01:06:51'),
(111, NULL, 94, 5.00, 2, NULL, '2025-04-14 01:06:51', '2025-04-14 01:06:51'),
(112, NULL, 93, 1.00, 2, NULL, '2025-04-14 02:36:46', '2025-04-14 02:36:46'),
(113, NULL, 93, 1.00, 2, NULL, '2025-04-14 02:37:20', '2025-04-14 02:37:20'),
(114, NULL, 94, 1.00, 2, NULL, '2025-04-14 02:37:20', '2025-04-14 02:37:20'),
(115, NULL, 93, 1.00, 2, NULL, '2025-04-14 02:55:14', '2025-04-14 02:55:14'),
(116, NULL, 94, 1.00, 2, NULL, '2025-04-14 02:55:14', '2025-04-14 02:55:14'),
(117, NULL, 93, 1.00, 2, NULL, '2025-04-14 03:09:44', '2025-04-14 03:09:44'),
(118, NULL, 94, 1.00, 2, NULL, '2025-04-14 03:09:44', '2025-04-14 03:09:44'),
(119, NULL, 93, 1.00, 2, NULL, '2025-04-14 04:36:36', '2025-04-14 04:36:36'),
(120, NULL, 94, 1.00, 2, NULL, '2025-04-14 04:36:36', '2025-04-14 04:36:36'),
(121, NULL, 93, 9.00, 2, NULL, '2025-06-28 19:07:41', '2025-06-28 19:07:41'),
(122, NULL, 94, 1.00, 2, NULL, '2025-06-28 19:07:41', '2025-06-28 19:07:41'),
(123, 103, 101, 1.00, 2, NULL, '2025-06-28 19:12:10', '2025-06-28 19:12:10'),
(124, NULL, 94, 1.00, 2, NULL, '2025-06-28 19:16:51', '2025-06-28 19:16:51'),
(125, NULL, 93, 5.00, 2, NULL, '2025-06-29 10:39:16', '2025-06-29 10:39:16'),
(126, NULL, 94, 1.00, 2, NULL, '2025-06-29 10:39:16', '2025-06-29 10:39:16'),
(127, 104, 93, 5.00, 2, '12', '2025-06-29 11:25:56', '2025-06-29 11:25:56'),
(128, 104, 94, 1.00, 2, '11', '2025-06-29 11:25:56', '2025-06-29 11:25:56'),
(129, 105, 93, 5.00, 2, '12', '2025-06-29 11:25:56', '2025-06-29 11:25:56'),
(130, 105, 94, 1.00, 2, '11', '2025-06-29 11:25:56', '2025-06-29 11:25:56'),
(131, 106, 93, 5.00, 2, '12', '2025-06-29 11:25:56', '2025-06-29 11:25:56'),
(132, 106, 94, 1.00, 2, '11', '2025-06-29 11:25:56', '2025-06-29 11:25:56'),
(133, NULL, 104, 2.00, 2, NULL, '2025-06-29 11:34:44', '2025-06-29 11:34:44'),
(134, 107, 93, 5.00, 2, NULL, '2025-06-30 07:02:25', '2025-06-30 07:02:25'),
(135, 107, 104, 1.00, 2, NULL, '2025-06-30 07:02:25', '2025-06-30 07:02:25'),
(136, 108, 93, 5.00, 2, NULL, '2025-06-30 07:02:25', '2025-06-30 07:02:25'),
(137, 108, 104, 1.00, 2, NULL, '2025-06-30 07:02:25', '2025-06-30 07:02:25'),
(138, 109, 93, 5.00, 2, NULL, '2025-06-30 07:24:01', '2025-06-30 07:24:01'),
(139, 109, 104, 2.00, 2, NULL, '2025-06-30 07:24:01', '2025-06-30 07:24:01'),
(140, 110, 93, 5.00, 2, NULL, '2025-06-30 07:24:01', '2025-06-30 07:24:01'),
(141, 110, 104, 2.00, 2, NULL, '2025-06-30 07:24:01', '2025-06-30 07:24:01'),
(142, 111, 93, 5.00, 2, NULL, '2025-06-30 07:29:05', '2025-06-30 07:29:05'),
(143, 111, 104, 1.00, 2, NULL, '2025-06-30 07:29:05', '2025-06-30 07:29:05'),
(144, 112, 93, 5.00, 2, NULL, '2025-06-30 07:29:05', '2025-06-30 07:29:05'),
(145, 112, 104, 1.00, 2, NULL, '2025-06-30 07:29:05', '2025-06-30 07:29:05'),
(146, NULL, 93, 50.00, 2, NULL, '2025-07-09 05:45:07', '2025-07-09 05:45:07'),
(147, NULL, 104, 5.00, 2, NULL, '2025-07-09 05:45:07', '2025-07-09 05:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `cow_food`
--

CREATE TABLE `cow_food` (
  `id` int NOT NULL,
  `branch` int DEFAULT NULL,
  `supplier` text NOT NULL,
  `food` text NOT NULL,
  `quantity` text NOT NULL,
  `unit` text NOT NULL,
  `price` text NOT NULL,
  `date` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_food`
--

INSERT INTO `cow_food` (`id`, `branch`, `supplier`, `food`, `quantity`, `unit`, `price`, `date`, `description`, `created_at`, `updated_at`) VALUES
(101, 1, 'Kamrul Hasan', '56', '5', 'KG', '25', '2025-04-10', 'test', '2025-04-10 23:25:49', '2025-04-10 23:25:49'),
(103, 1, 'Kamrul Hasan', '60', '15', 'KG', '12', '2025-04-10', 'Dwv&', '2025-04-10 23:27:12', '2025-04-10 23:27:12'),
(104, 1, 'Kamrul Hasan', '93', '10', 'KG', '10', '2025-04-13', 'test', '2025-04-14 01:05:24', '2025-04-14 01:05:24'),
(105, 1, 'Arshad', '94', '20', 'KG', '20', '2025-04-13', 'test', '2025-04-14 01:06:27', '2025-04-14 01:06:27'),
(106, 1, 'Amin Auto', '93', '6500', 'KG', '10', '2025-04-13', 'Nij miller Gura', '2025-04-14 21:06:17', '2025-04-14 21:06:17'),
(107, 1, 'Kamrul Hasan', '104', '10', 'KG', '50', '2025-06-29', 'asdf', '2025-06-29 11:31:01', '2025-06-29 11:31:01'),
(108, 1, 'Other', '104', '10', 'KG', '19', '2025-06-08', 'dfg', '2025-06-29 11:39:24', '2025-06-29 11:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `cow_medicine_monitor`
--

CREATE TABLE `cow_medicine_monitor` (
  `id` int NOT NULL,
  `shed_no` int DEFAULT NULL,
  `cow_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `user_id` int NOT NULL,
  `branch_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_medicine_monitor`
--

INSERT INTO `cow_medicine_monitor` (`id`, `shed_no`, `cow_id`, `date`, `note`, `user_id`, `branch_id`, `created_at`, `updated_at`) VALUES
(9, 19, 3, '2025-04-07', NULL, 2, 1, '2025-04-07 18:35:27', '2025-04-07 18:35:27'),
(10, 19, 142540, '2025-04-11', NULL, 1, 1, '2025-04-12 02:08:54', '2025-04-12 02:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `cow_medicine_monitor_dtls`
--

CREATE TABLE `cow_medicine_monitor_dtls` (
  `id` int NOT NULL,
  `monitor_id` int DEFAULT NULL,
  `vaccine_id` int DEFAULT NULL,
  `remarks` text,
  `time` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_medicine_monitor_dtls`
--

INSERT INTO `cow_medicine_monitor_dtls` (`id`, `monitor_id`, `vaccine_id`, `remarks`, `time`, `created_at`, `updated_at`) VALUES
(7, 9, 10, NULL, NULL, '2025-04-07 18:35:27', '2025-04-07 18:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `cow_monitor`
--

CREATE TABLE `cow_monitor` (
  `id` int NOT NULL,
  `shed_no` int DEFAULT NULL,
  `cow_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `weight` decimal(15,2) NOT NULL DEFAULT '0.00',
  `height` decimal(15,2) NOT NULL DEFAULT '0.00',
  `milk` decimal(15,2) NOT NULL DEFAULT '0.00',
  `branch_id` int DEFAULT NULL,
  `health_score` int NOT NULL DEFAULT '0',
  `new_images` varchar(2000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cow_monitor_dtls`
--

CREATE TABLE `cow_monitor_dtls` (
  `id` int NOT NULL,
  `monitor_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `result` varchar(1000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `time` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cow_sale`
--

CREATE TABLE `cow_sale` (
  `id` int NOT NULL,
  `customer_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_number` varchar(255) DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `total_price` decimal(15,2) DEFAULT NULL,
  `total_paid` decimal(15,2) DEFAULT NULL,
  `due` decimal(15,2) DEFAULT NULL,
  `note` text,
  `date` date DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_sale`
--

INSERT INTO `cow_sale` (`id`, `customer_name`, `customer_number`, `email`, `address`, `total_price`, `total_paid`, `due`, `note`, `date`, `branch_id`, `created_at`, `updated_at`) VALUES
(34, 'Aftabganj Hat', NULL, NULL, 'Aftabgang', 142500.00, 142500.00, 0.00, 'For Meat Purpose', '2023-06-10', 1, '2025-06-22 18:27:31', '2025-06-22 18:27:31'),
(35, 'Aftabganj Hat', NULL, NULL, 'Aftabganj', 160500.00, 160500.00, 0.00, 'For Meat Purpose', '2023-06-10', 1, '2025-06-22 18:29:29', '2025-06-22 18:29:29'),
(36, 'Aftabganj Hat', NULL, NULL, 'Aftabganj', 147000.00, 147000.00, 0.00, 'For Meat Purpose', '2023-06-10', 1, '2025-06-22 18:31:15', '2025-06-22 18:31:15'),
(37, 'test', '01795282570', NULL, 'asdf', 200000.00, 80005.00, 119995.00, 'asdf', '2025-07-12', 1, '2025-07-12 13:20:24', '2025-07-12 13:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `cow_sale_dtls`
--

CREATE TABLE `cow_sale_dtls` (
  `id` int NOT NULL,
  `sale_id` int DEFAULT NULL,
  `cow_id` int DEFAULT NULL,
  `cow_type` int DEFAULT NULL COMMENT '1=Cow, 2=Calf',
  `shed_no` int DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_sale_dtls`
--

INSERT INTO `cow_sale_dtls` (`id`, `sale_id`, `cow_id`, `cow_type`, `shed_no`, `price`, `created_at`, `updated_at`) VALUES
(42, 34, 9, 1, 19, 142500.00, '2025-06-22 18:27:31', '2025-06-22 18:27:31'),
(43, 35, 10, 1, 19, 160500.00, '2025-06-22 18:29:29', '2025-06-22 18:29:29'),
(44, 36, 11, 1, 19, 147000.00, '2025-06-22 18:31:15', '2025-06-22 18:31:15'),
(45, 37, 1, 1, 19, 50000.00, '2025-07-12 13:20:24', '2025-07-12 13:20:24'),
(46, 37, 1001, 1, 21, 150000.00, '2025-07-12 13:20:24', '2025-07-12 13:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `cow_sale_payments`
--

CREATE TABLE `cow_sale_payments` (
  `id` int NOT NULL,
  `sale_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `pay_amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cow_sale_payments`
--

INSERT INTO `cow_sale_payments` (`id`, `sale_id`, `date`, `pay_amount`, `created_at`, `updated_at`) VALUES
(30, 28, '2025-04-18', 1000.00, '2025-04-18 21:46:32', '2025-04-18 21:46:32'),
(36, 34, '2023-06-10', 142500.00, '2025-06-22 18:27:31', '2025-06-22 18:27:31'),
(37, 35, '2023-06-10', 160500.00, '2025-06-22 18:29:29', '2025-06-22 18:29:29'),
(38, 36, '2023-06-10', 147000.00, '2025-06-22 18:31:15', '2025-06-22 18:31:15'),
(39, 37, '2025-07-12', 80005.00, '2025-07-12 13:20:24', '2025-07-12 13:20:24'),
(40, 37, '2025-06-29', 23800.00, '2025-07-12 13:22:29', '2025-07-12 13:22:29'),
(41, 37, '2025-07-15', 23800.00, '2025-07-12 13:22:41', '2025-07-12 13:22:41'),
(42, 37, '2025-08-05', 500000.00, '2025-07-12 13:22:54', '2025-07-12 13:22:54');

-- --------------------------------------------------------

--
-- Table structure for table `cow_vaccine_monitor`
--

CREATE TABLE `cow_vaccine_monitor` (
  `id` int NOT NULL,
  `shed_no` int DEFAULT NULL,
  `cow_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `note` varchar(3000) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `branch_id` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cow_vaccine_monitor_dtls`
--

CREATE TABLE `cow_vaccine_monitor_dtls` (
  `id` int NOT NULL,
  `monitor_id` int DEFAULT NULL,
  `vaccine_id` int DEFAULT NULL,
  `remarks` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `time` varchar(25) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dead_animal`
--

CREATE TABLE `dead_animal` (
  `id` int NOT NULL,
  `cow` varchar(155) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `date` date NOT NULL,
  `price` varchar(55) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dead_animal`
--

INSERT INTO `dead_animal` (`id`, `cow`, `description`, `date`, `price`, `created_at`, `updated_at`) VALUES
(5, '1', NULL, '2025-04-05', '1000', '2025-04-05 18:56:30', '2025-04-05 18:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `dead_calf`
--

CREATE TABLE `dead_calf` (
  `id` int NOT NULL,
  `calf` int NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `price` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'Manager', '2025-03-09 19:17:47', '2025-03-21 18:32:57'),
(4, 'Farm Labour', '2025-03-16 02:48:39', '2025-03-21 18:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `earning`
--

CREATE TABLE `earning` (
  `id` int NOT NULL,
  `purpose_id` int NOT NULL,
  `date` date NOT NULL,
  `amount` varchar(55) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `earning`
--

INSERT INTO `earning` (`id`, `purpose_id`, `date`, `amount`, `created_at`, `updated_at`) VALUES
(24, 4, '2024-03-10', '250000', '2025-03-21 03:51:01', '2025-03-21 03:51:01'),
(25, 2, '2025-03-23', '600', '2025-03-23 21:59:04', '2025-03-23 21:59:04'),
(26, 2, '2025-03-23', '600', '2025-03-23 22:03:14', '2025-03-23 22:03:14'),
(27, 2, '2025-03-23', '300', '2025-03-23 22:07:12', '2025-03-23 22:07:12'),
(28, 2, '2025-04-05', '50', '2025-04-05 22:39:12', '2025-04-05 22:39:12'),
(29, 4, '2025-04-08', '100000', '2025-04-09 01:46:21', '2025-04-09 01:46:21'),
(30, 4, '2024-10-03', '490000', '2025-04-13 01:22:23', '2025-04-13 01:22:23'),
(31, 4, '2023-06-20', '171100', '2025-04-13 01:27:43', '2025-04-13 01:27:43'),
(32, 4, '2023-06-20', '184000', '2025-04-15 03:07:55', '2025-04-15 03:07:55'),
(33, 4, '1970-01-01', '10000', '2025-04-18 21:44:41', '2025-04-18 21:44:41'),
(34, 4, '2025-04-18', '1000', '2025-04-18 21:46:32', '2025-04-18 21:46:32'),
(35, 4, '2025-04-18', '10000', '2025-04-18 21:51:27', '2025-04-18 21:51:27'),
(36, 4, '2025-04-18', '100000', '2025-04-18 21:52:55', '2025-04-18 21:52:55'),
(37, 4, '2025-04-18', '5000000', '2025-04-18 21:54:13', '2025-04-18 21:54:13'),
(38, 4, '2025-04-18', '1000', '2025-04-18 21:57:11', '2025-04-18 21:57:11'),
(39, 4, '2025-04-18', '10000000', '2025-04-18 22:04:25', '2025-04-18 22:04:25'),
(40, 4, '2023-06-10', '142500', '2025-06-22 18:27:31', '2025-06-22 18:27:31'),
(41, 4, '2023-06-10', '160500', '2025-06-22 18:29:29', '2025-06-22 18:29:29'),
(42, 4, '2023-06-10', '147000', '2025-06-22 18:31:15', '2025-06-22 18:31:15'),
(43, 4, '2025-07-12', '80005', '2025-07-12 13:20:24', '2025-07-12 13:20:24');

-- --------------------------------------------------------

--
-- Table structure for table `earning_purpose`
--

CREATE TABLE `earning_purpose` (
  `id` int NOT NULL,
  `purpose_name` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `earning_purpose`
--

INSERT INTO `earning_purpose` (`id`, `purpose_name`, `created_at`, `updated_at`) VALUES
(1, 'মাংস বিক্রয়', '2025-03-12 06:57:45', '0000-00-00 00:00:00'),
(2, 'দুধ বিক্রয়', '2025-03-12 07:10:14', '0000-00-00 00:00:00'),
(3, 'মাছ বিক্রি', '2025-03-12 07:11:01', '0000-00-00 00:00:00'),
(4, 'পশু বিক্রয়', '2025-03-12 07:14:05', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary`
--

CREATE TABLE `employee_salary` (
  `id` int NOT NULL,
  `employee_id` int DEFAULT NULL,
  `year` year DEFAULT NULL,
  `month` tinyint DEFAULT NULL,
  `salary` decimal(15,2) DEFAULT '0.00',
  `paydate` date DEFAULT NULL,
  `addition_money` decimal(15,2) DEFAULT NULL,
  `advance` varchar(55) DEFAULT NULL,
  `note` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `employee_salary`
--

INSERT INTO `employee_salary` (`id`, `employee_id`, `year`, `month`, `salary`, `paydate`, `addition_money`, `advance`, `note`, `created_at`, `updated_at`) VALUES
(25, 25, '2025', 1, 8000.00, '2025-04-06', NULL, NULL, NULL, '2025-04-06 20:06:37', '2025-04-06 20:06:37'),
(26, 25, '2025', 1, 8000.00, '2025-04-06', NULL, NULL, NULL, '2025-04-06 20:08:02', '2025-04-06 20:08:02');

-- --------------------------------------------------------

--
-- Table structure for table `employee_salary_advance_payment`
--

CREATE TABLE `employee_salary_advance_payment` (
  `id` int NOT NULL,
  `employee_id` int NOT NULL,
  `date` date NOT NULL,
  `advance` int NOT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int NOT NULL,
  `purpose_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT '0.00',
  `note` text,
  `food` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `purpose_id`, `date`, `amount`, `note`, `food`, `created_at`, `created_by`, `updated_at`) VALUES
(70, 7, '2025-03-21', 308000.00, '200 Bosta 55 kg per Bosta', 'Atob Bran 11000 KG', '2025-03-21 18:50:51', 1, '2025-03-21 18:50:51'),
(71, 7, '2025-03-21', 145000.00, '50 kg Bosta', 'DORB 5000 KG', '2025-03-21 18:52:39', 1, '2025-03-21 18:52:39'),
(72, 7, '2025-03-21', 400000.00, '20000 * 4 pala', 'Straw 80000 Piece', '2025-03-21 19:00:08', 1, '2025-03-21 19:00:08'),
(73, 7, '2025-03-23', 100.00, 'df', 'Atob Bran 20 Gram', '2025-03-23 19:42:38', 1, '2025-03-23 19:42:38'),
(74, 7, '2025-03-23', 100.00, 'dfg', 'Atob Bran 20 Gram', '2025-03-23 19:43:33', 1, '2025-03-23 19:43:33'),
(75, 7, '2025-03-23', 100.00, 'fdg', 'Atob Bran 20 Gram', '2025-03-23 19:43:58', 1, '2025-03-23 19:43:58'),
(76, 7, '2025-03-23', 100.00, 'test', 'Atob Bran 20 Gram', '2025-03-23 20:01:20', 1, '2025-03-23 20:01:20'),
(77, 8, '2025-03-23', 500.00, NULL, NULL, '2025-03-24 00:45:48', 1, '2025-03-24 00:45:48'),
(78, 11, '2025-04-06', 101.00, 'স্থায়ী খরচ', NULL, '2025-04-06 19:02:50', NULL, '2025-04-06 19:02:50'),
(79, 11, '2025-04-06', 100.00, NULL, NULL, '2025-04-06 19:07:10', 1, '2025-04-06 19:07:10'),
(80, 13, '2025-04-06', 100.00, NULL, NULL, '2025-04-06 19:22:46', 1, '2025-04-06 19:22:46'),
(81, 14, '2025-04-06', 50.00, 'test', NULL, '2025-04-06 19:32:40', 1, '2025-04-06 19:32:40'),
(82, 13, '2025-04-06', 400.00, 'Non Govt Does 2 mL\r\nGovt Does 6 mL', NULL, '2025-04-06 19:50:25', 1, '2025-04-06 19:50:25'),
(83, 13, '2025-04-06', 80.00, 'পশুর ৬ মাস বয়সে প্রথম টিকা দিতে হয়। গরু ও মহিষের জন্য টিকার মাত্রা হল ১ মিলি. এবং ছাগল ও ভেড়ার জন্য ০.৫ মিলি। ১ বছর অন্তর এ টিকা দিতে হয়। এ টিকা পশুর ঘাড়ের/গলার  চামড়ার নিচে দিতে হয়। তবে ৭ মাসের ঊর্দ্ধ বয়সের গর্ভবতী গরু/মহিষকে দেয়া যাবে না। ছাগল/ভেড়ার ক্ষেত্রে গর্ভধারণের ৩ মাস পরে  দেয়া যাবে না ।', NULL, '2025-04-06 20:00:14', 1, '2025-04-06 20:00:14'),
(84, 11, '2025-04-06', 0.00, NULL, NULL, '2025-04-06 20:05:05', NULL, '2025-04-06 20:05:05'),
(85, 15, '2025-04-06', 0.00, NULL, NULL, '2025-04-06 20:06:37', NULL, '2025-04-06 20:06:37'),
(86, 13, '2025-04-06', 50.00, 'গলাফুলা টিকা ১০০ মিলি তরল অবস্থায় বোতলে থাকে। পশুর ৬ মাস বয়সে প্রথম টিকা দিতে হয়। গরু ও মহিষের জন্য টিকার মাত্রা হল ২ মিলি. এবং ছাগল ও ভেড়ার জন্য ১ মিলি।  প্রতি ৬ মাস অন্তর টিকা দিতে হয়। এ টিকাও  পশুর ঘাড়ের চামড়ার নিচে দিতে হয়।', NULL, '2025-04-06 20:07:55', 1, '2025-04-06 20:07:55'),
(87, 15, '2025-04-06', 8000.00, NULL, NULL, '2025-04-06 20:08:02', 1, '2025-04-06 20:08:02'),
(88, 13, '2025-04-06', 40.00, 'বাদলা রোগের টিকা ১০০ মিলি তরল অবস্থায় বোতলে থাকে। পশুর ৬ মাস বয়সে প্রথম টিকা দিতে হয়। গরু ও মহিষের জন্য মাত্রা হল ৫ মিলি এবং ছাগল ও ভেড়ার জন্য ২ মিলি। প্রতি ৬ মাস অন্তর টিকা দিতে হয়। এ টিকা পশুর ঘাড়ের চামড়ার নিচে দিতে হয়। তবে এ রোগের টিকা   ২.৫-৩ বছর পরে আর গরু/ মহিষকে দেয়ার প্রয়োজন হয় না ।', NULL, '2025-04-06 20:11:20', 1, '2025-04-06 20:11:20'),
(89, 13, '2025-04-06', 2300.00, '২০ মিলি তরল ভেক্সিন থাকে। ৬ মাস পর পর দেওয়া হয়। ২-৩ বছরের ষাড়/গাভিকে দেওয়ার প্রয়োজন হয় না। গর্ভবতী গাভীকে দেওয়া যায় এবং দেওয়া উচিত।', NULL, '2025-04-06 20:15:55', 1, '2025-04-06 20:15:55'),
(90, 13, '2025-04-06', 75.00, 'ছাগলের বসন্তের টিকা ভায়ালে হিমায়িত অবস্থায় থাকে। ভায়ালের সাথে বিশুদ্ধ পানি থাকে। পানিতে এ টিকা গুলে ২ মিলি প্রতি ছাগলের লেজের গোড়াতে ত্বকের নিচে ইনজেকশন করতে হয়। ছাগলের ৫ মাস বয়সে প্রথম এ টিকা দিতে হয়।', NULL, '2025-04-06 20:21:52', 1, '2025-04-06 20:21:52'),
(91, 13, '2025-04-06', 70.00, 'ছাগলের পিপিআর ভ্যাকসিন ভায়ালে হিমায়িত অবস্থায় থাকে। ভায়ালের সাথে ১০০মিলি ডাইলুয়েন্ট থাকে। এ টিকা সরবরাহকৃত ডাইলুয়েন্টের ভেতর ভালো করে মিশিয়ে  প্রতিটি ছাগলকে ঘাড়ের চামড়ার নীচে ১ মিলি ইনজেকশন করে দিতে হয়। ছাগলের ৩ মাস বয়সে প্রথম এ টিকা দিতে হয়। এ টিকা এক বছর অন্তর দিতে হয়। উল্লে­খ্য, গর্ভবতী ছাগলকেও এ টিকা দেওয়া যায় ।', NULL, '2025-04-06 20:30:13', 1, '2025-04-06 20:30:13'),
(92, 13, '2025-04-06', 50.00, 'পশুকে কুকুরে কামড়ানোর পরে পোস্ট এক্সপোসার ভ্যাকসিন এআরভি (Anti Rabies vaccine/ ARV) দিতে হয়। বেসরকারি ওষুধ কোম্পানির র‌্যাবিসিন (Rabisin) ভ্যাকসিন পাওয়া যায়। মাত্রা হলো- ১ম দিন ৪ মিলি  ৪ স্থানে   ১ মিলি করে, ৭ম দিনে ৩ মিলি ৩ স্থানে ১ মিলি করে এবং ২১তম দিনে  ৩ স্থানে ১ মিলি করে ৩ মিলি মাংসে দিতে হয় ।', NULL, '2025-04-06 20:40:34', 1, '2025-04-06 20:40:34'),
(93, 14, '2025-04-06', 230.00, 'গরুর খাদ্য জনিত ত্রুটির কারনে পেট ফুলে গেলে ব্যবহার করা হয়। ছোট গরুতে ২৫০ মিলি ও বড় গরুতে ৫০০ মিলি একবারে খাওয়াতে হয়। প্রয়োজনে পুনোরায় খাওয়াতে হবে।', NULL, '2025-04-06 20:52:09', 1, '2025-04-06 20:52:09'),
(94, 12, '2025-04-06', 500.00, 'ডাক্তার ফি অনুদান', NULL, '2025-04-06 22:10:56', 2, '2025-04-06 22:10:56'),
(95, 7, '2025-04-06', 10.00, 'hh', 'Atob Bran 50 KG', '2025-04-06 23:54:23', 1, '2025-04-06 23:54:23'),
(96, 7, '2025-04-07', 100.00, 'test', 'Atob Bran 5 KG', '2025-04-07 19:13:01', 1, '2025-04-07 19:13:01'),
(97, 7, '2025-04-07', 3150.00, 'Arshad Vatainary', 'Toxin Binder (Zenifix) 1 25 Kg Bosta', '2025-04-07 21:30:43', 1, '2025-04-07 21:30:43'),
(98, 7, '2025-04-07', 1400.00, 'Atob Bran', 'Atob Bran 190 55 Kg Bosta', '2025-04-07 21:31:31', 1, '2025-04-07 21:31:31'),
(99, 7, '2025-04-07', 6.00, 'All Cost Included', 'Straw 80000 Piece', '2025-04-07 21:38:14', 1, '2025-04-07 21:38:14'),
(100, 7, '2025-04-07', 26.00, 'nij mill', 'Atob Bran 11000 KG', '2025-04-07 21:43:40', 1, '2025-04-07 21:43:40'),
(101, 14, '2025-04-07', 36.00, 'রুচি বৃদ্ধির ইঞ্জেকশন', NULL, '2025-04-07 21:53:37', 1, '2025-04-07 21:53:37'),
(102, 14, '2025-04-07', 125.00, 'পেট ফাপা/বদ হজমের কারনের ব্যবহার করা হয়।', NULL, '2025-04-07 22:25:39', 1, '2025-04-07 22:25:39'),
(103, 14, '2025-04-08', 10.00, 'dsfsdf', NULL, '2025-04-09 01:30:46', 1, '2025-04-09 01:30:46'),
(104, 14, '2025-04-09', 100.00, 'test', NULL, '2025-04-09 23:41:11', 1, '2025-04-09 23:41:11'),
(105, 14, '2025-04-09', NULL, 'test', NULL, '2025-04-09 23:49:28', 1, '2025-04-09 23:49:28'),
(106, 14, '2025-04-09', NULL, 'test', NULL, '2025-04-09 23:49:41', 1, '2025-04-09 23:49:41'),
(107, 7, '2025-04-10', 100.00, 'test', 'L-Lisine 20 Gram', '2025-04-10 22:23:04', 1, '2025-04-10 22:23:04'),
(108, 7, '2025-04-10', 10.00, 'sdfsd', 'DORB 1 KG', '2025-04-10 22:41:57', 1, '2025-04-10 22:41:57'),
(109, 7, '2025-04-10', 101.00, '1 vf', 'DORB 50 KG', '2025-04-10 22:50:15', 1, '2025-04-10 22:50:15'),
(110, 7, '2025-04-10', 10.00, 'test', 'Atob Bran 10 KG', '2025-04-10 22:56:23', 1, '2025-04-10 22:56:23'),
(111, 7, '2025-04-10', 10.00, 'test', 'Atob Bran 5 KG', '2025-04-10 23:20:36', 1, '2025-04-10 23:20:36'),
(112, 7, '2025-04-10', 25.00, 'test', 'Atob Bran 5 KG', '2025-04-10 23:25:49', 1, '2025-04-10 23:25:49'),
(113, 7, '2025-04-10', 10.00, 'UWzU1', 'DORB 10 KG', '2025-04-10 23:26:50', 1, '2025-04-10 23:26:50'),
(114, 7, '2025-04-10', 12.00, 'Dwv&', 'DORB 15 KG', '2025-04-10 23:27:12', 1, '2025-04-10 23:27:12'),
(115, 7, '2025-04-11', 2000000.00, 'ergasfg', NULL, '2025-04-12 03:14:19', 1, '2025-04-12 03:14:19'),
(116, 7, '2025-04-13', 10.00, 'test', 'atob 10 KG', '2025-04-14 01:05:24', 1, '2025-04-14 01:05:24'),
(117, 7, '2025-04-13', 20.00, 'test', 'chal 20 KG', '2025-04-14 01:06:27', 1, '2025-04-14 01:06:27'),
(118, 7, '2025-04-13', 10.00, 'Nij miller Gura', 'atob 6500 KG', '2025-04-14 21:06:17', 1, '2025-04-14 21:06:17'),
(119, 11, '2025-04-14', 5000.00, '৪০০০ ইট', NULL, '2025-04-14 21:26:16', 1, '2025-04-14 21:26:16'),
(120, 11, '2025-04-13', 3200.00, 'প্লেটর ভাড়া ২ ঘন্টা', NULL, '2025-04-14 21:28:18', 1, '2025-04-14 21:28:18'),
(121, 14, '2025-06-29', NULL, 'test des', NULL, '2025-06-29 07:11:12', 1, '2025-06-29 07:11:12'),
(122, 11, '2025-06-29', 111111.00, 'asdf', NULL, '2025-06-29 07:49:18', 1, '2025-06-29 07:49:18'),
(123, 7, '2025-06-29', 50.00, 'asdf', 'Bhushi 10 KG', '2025-06-29 11:31:01', 1, '2025-06-29 11:31:01'),
(124, 7, '2025-06-08', 19.00, 'dfg', 'Bhushi 10 KG', '2025-06-29 11:39:24', 1, '2025-06-29 11:39:24'),
(125, 13, '2025-07-12', NULL, NULL, NULL, '2025-07-12 07:43:26', 1, '2025-07-12 07:43:26'),
(126, 13, '2025-07-12', 4545.00, 'asdf', NULL, '2025-07-12 07:45:29', 1, '2025-07-12 07:45:29'),
(127, 14, '2025-07-12', NULL, 'asdf', NULL, '2025-07-12 08:53:25', 1, '2025-07-12 08:53:25'),
(128, 14, '2025-07-12', NULL, 'fg', NULL, '2025-07-12 12:33:59', 1, '2025-07-12 12:33:59'),
(129, 14, '2025-07-13', 437.00, 'asdf', NULL, '2025-07-13 05:54:01', 2, '2025-07-13 05:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_new`
--

CREATE TABLE `expenses_new` (
  `id` int NOT NULL,
  `purpose_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` int DEFAULT NULL,
  `note` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `food` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `status` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses_new`
--

INSERT INTO `expenses_new` (`id`, `purpose_id`, `date`, `amount`, `note`, `food`, `status`, `created_at`, `created_by`, `updated_at`) VALUES
(18, 16, '2025-06-22', 1600, NULL, NULL, 0, '2025-06-22 20:28:11', 1, '2025-06-22 20:28:11'),
(19, 19, '2025-06-16', 10000, NULL, NULL, 0, '2025-06-22 20:28:59', 1, '2025-06-22 20:28:59'),
(20, 13, '2025-06-21', 4000, NULL, NULL, 0, '2025-06-22 20:30:29', 1, '2025-06-22 20:30:29'),
(21, 8, '2025-05-26', 10, 'adf আমার', NULL, 0, '2025-06-29 07:01:26', 2, '2025-06-29 07:01:26'),
(22, 7, '2025-06-30', 10, 'test', NULL, 1, '2025-07-08 05:06:00', 2, '2025-07-08 05:06:00'),
(23, 14, '2025-07-09', NULL, 'test cost', NULL, NULL, '2025-07-12 08:18:44', 0, '2025-07-12 08:18:44'),
(24, 14, '2025-07-09', NULL, 'asdf', NULL, 0, '2025-07-12 09:04:49', 1, '2025-07-12 09:04:49'),
(25, 14, '2025-07-12', NULL, 'asdf', NULL, 0, '2025-07-12 09:05:55', 1, '2025-07-12 09:05:55'),
(26, 14, '2025-07-08', NULL, 'asdf', NULL, 0, '2025-07-12 09:09:52', 1, '2025-07-12 09:09:52'),
(27, 14, '2025-07-15', NULL, 'asdf', NULL, 0, '2025-07-12 09:10:20', 1, '2025-07-12 09:10:20'),
(28, 14, '2025-07-04', NULL, 'asdf', NULL, 0, '2025-07-12 11:48:55', 1, '2025-07-12 11:48:55'),
(29, 14, '2025-07-12', NULL, '45', NULL, 0, '2025-07-12 11:53:18', 1, '2025-07-12 11:53:18'),
(30, 14, '2025-07-12', NULL, 'asdf', NULL, 0, '2025-07-12 11:54:13', 1, '2025-07-12 11:54:13'),
(31, 14, '2025-07-12', NULL, 'asdf', NULL, 0, '2025-07-12 11:54:34', 1, '2025-07-12 11:54:34'),
(32, 14, '2025-07-12', NULL, 'asdf', NULL, 0, '2025-07-12 12:32:27', 1, '2025-07-12 12:32:27'),
(33, 14, '2025-07-12', 10, 'asdf', NULL, 0, '2025-07-12 12:44:01', 1, '2025-07-12 12:44:01'),
(34, 14, '2025-07-12', 100, 'fasdf', NULL, 0, '2025-07-12 13:26:26', 1, '2025-07-12 13:26:26'),
(35, 12, '2025-07-13', 68, 'asdf', NULL, 0, '2025-07-13 05:02:04', 1, '2025-07-13 05:02:04'),
(36, 14, '2025-07-13', 437, 'asdf', NULL, 0, '2025-07-13 05:54:01', 2, '2025-07-13 05:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `expense_purpose`
--

CREATE TABLE `expense_purpose` (
  `id` int NOT NULL,
  `purpose_name` varchar(255) DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `expense_purpose`
--

INSERT INTO `expense_purpose` (`id`, `purpose_name`, `branch_id`, `created_at`, `updated_at`) VALUES
(7, 'পশুর খাদ্য ক্রয়', 1, '2025-03-09 21:56:45', '2025-03-09 21:56:45'),
(8, 'Pregnancy Cost', 1, '2025-03-11 22:56:54', '2025-03-11 22:56:54'),
(11, 'স্থায়ী খরচ', 1, '2025-04-06 18:54:17', '2025-04-06 18:54:17'),
(12, 'অন্যান্য খরচ', 1, '2025-04-06 19:09:01', '2025-04-06 19:09:01'),
(13, 'ভ্যাক্সিন খরচ', 1, '2025-04-06 19:21:23', '2025-04-06 19:21:23'),
(14, 'মেডিসিন খরচ', 1, '2025-04-06 19:29:25', '2025-04-06 19:29:25'),
(15, 'মানব সম্পদ খরচ', 1, '2025-04-06 20:06:13', '2025-04-06 20:06:13'),
(16, 'ঘাসের জমির খরচ', 1, '2025-04-09 01:54:01', '2025-04-09 01:54:01'),
(17, 'মেডিসিন ক্রয় হিসাব', 1, '2025-04-14 21:10:18', '2025-04-14 21:10:18'),
(18, 'বিদ্যুৎ বিল', 1, '2025-04-14 21:11:36', '2025-04-14 21:11:36'),
(19, 'পাইপ ক্রয়', 1, '2025-04-14 21:12:51', '2025-04-14 21:12:51'),
(20, 'মিস্ত্রি এবং লেবার', 1, '2025-04-14 21:13:27', '2025-04-14 21:13:27');

-- --------------------------------------------------------

--
-- Table structure for table `fish_harvest`
--

CREATE TABLE `fish_harvest` (
  `id` int NOT NULL,
  `pond` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qty` varchar(55) NOT NULL,
  `price` varchar(55) DEFAULT NULL,
  `due_price` varchar(55) DEFAULT NULL,
  `pay_amount` varchar(55) DEFAULT NULL,
  `total_price` varchar(55) NOT NULL,
  `date` varchar(155) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fish_sell`
--

CREATE TABLE `fish_sell` (
  `id` int NOT NULL,
  `pond` int NOT NULL,
  `buyer` int NOT NULL,
  `fish_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qty` int NOT NULL,
  `unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` int NOT NULL,
  `total_price` int NOT NULL,
  `paid_amount` int NOT NULL,
  `date` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fish_stocking`
--

CREATE TABLE `fish_stocking` (
  `id` int NOT NULL,
  `fish_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qty` varchar(55) NOT NULL,
  `price` varchar(55) NOT NULL,
  `date` varchar(55) NOT NULL,
  `pond` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `food_items`
--

CREATE TABLE `food_items` (
  `id` int NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `stock` varchar(55) NOT NULL DEFAULT '0',
  `unit` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'KG',
  `food_id` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `food_items`
--

INSERT INTO `food_items` (`id`, `name`, `stock`, `unit`, `food_id`, `created_at`, `updated_at`) VALUES
(93, 'atob', '6400', 'KG', NULL, '2025-04-14 01:05:05', '2025-07-09 05:45:07'),
(94, 'chal', '5', 'KG', NULL, '2025-04-14 01:06:04', '2025-06-29 10:39:16'),
(95, 'mix', '10', 'KG', NULL, '2025-04-14 01:06:51', '2025-04-14 01:06:51'),
(100, 'mix 3', '2', 'KG', '93,94', '2025-04-14 04:36:36', '2025-04-14 04:36:36'),
(101, 'test mixed', '9', 'KG', '93,94', '2025-06-28 19:07:41', '2025-06-28 19:07:41'),
(102, 'test m 2', '1', 'KG', '94', '2025-06-28 19:16:51', '2025-06-28 19:16:51'),
(103, 'random', '6', 'KG', '93,94', '2025-06-29 10:39:16', '2025-06-29 10:39:16'),
(104, 'Bhushi', '5', 'KG', NULL, '2025-06-29 11:29:28', '2025-07-09 05:45:07'),
(105, 'gorur item khabar new', '2', 'KG', '104', '2025-06-29 11:34:44', '2025-06-29 11:34:44'),
(106, 'new test', '55', 'KG', '93,104', '2025-07-09 05:45:07', '2025-07-09 05:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `food_units`
--

CREATE TABLE `food_units` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `food_units`
--

INSERT INTO `food_units` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Gram', '2020-02-23 12:59:13', '2020-02-23 12:59:13'),
(2, 'KG', '2020-02-23 12:59:21', '2020-02-23 12:59:33'),
(3, 'Piece', '2025-03-04 18:40:17', '2025-03-04 18:40:17'),
(4, '25 Kg Bosta', '2025-03-10 07:10:37', '2025-03-21 19:14:14'),
(5, 'KG', '2025-03-12 21:05:16', '2025-03-21 19:13:15'),
(6, 'ML', '2025-03-21 19:12:48', '2025-03-21 19:12:48'),
(7, '50 Kg Bosta', '2025-03-21 19:14:26', '2025-03-21 19:14:26'),
(8, '55 Kg Bosta', '2025-03-21 19:14:40', '2025-03-21 19:14:40');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int NOT NULL,
  `group_name` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `group_name`, `created_at`, `updated_at`) VALUES
(6, 'test up', '2025-06-30 10:09:20', '2025-06-30 10:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `hatchery_expense_category`
--

CREATE TABLE `hatchery_expense_category` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hatchery_expense_category`
--

INSERT INTO `hatchery_expense_category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Test', '2025-03-02 18:22:17', '2025-03-02 18:22:17'),
(2, 'first', '2025-03-02 18:52:39', '2025-03-02 18:52:39'),
(3, 'laber', '2025-03-17 22:40:55', '2025-03-17 22:40:55'),
(4, 'Pukur Rent', '2025-03-17 22:41:05', '2025-03-17 22:41:05'),
(5, 'water', '2025-03-17 22:41:12', '2025-03-17 22:41:12');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `stock` int NOT NULL DEFAULT '0',
  `unit` varchar(55) DEFAULT NULL,
  `price` int DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `name`, `description`, `stock`, `unit`, `price`, `created_at`, `updated_at`) VALUES
(1, 'first', 'sdf test', 68, 'Piece', 0, '2025-07-12 12:44:01', '2025-07-12 12:44:01'),
(2, 'Test', 'test medicine', 55, 'Piece', 0, '2025-03-04 08:41:31', '2025-03-04 20:10:11'),
(12, 'Maglex 500ml', 'পেট ফাপার কারনে ব্যবহার করা হয়।', 27, 'Piece', 0, '2025-07-13 05:54:01', '2025-07-13 05:54:01'),
(15, 'Himivit', 'রুচি বৃদ্ধির ইঞ্জেকশন।', 52, 'Piece', 0, '2025-07-12 08:18:44', '2025-07-12 08:18:44'),
(16, 'Bovi Vet', 'পেট ফাপার কারনে ব্যবহার করা হয়।', 12, 'Piece', 0, '2025-06-26 05:55:29', '2025-06-26 18:55:29'),
(19, 'test 25', 'test', 101, 'Piece', 0, '2025-04-09 23:43:24', '2025-04-09 23:43:24'),
(22, 'without price', 'test', 50, 'Piece', 0, '2025-04-09 23:49:59', '2025-04-09 23:49:59'),
(23, 'test', 'test des sdf', 0, NULL, NULL, '2025-06-29 07:11:46', '2025-06-29 07:11:46'),
(24, 'Maglex 500ml', 'zsdf', 12, 'KG', 0, '2025-07-12 07:48:02', '2025-07-12 07:48:02'),
(25, 'new medicine', 'asdf', 0, NULL, NULL, '2025-07-12 08:53:25', '2025-07-12 08:53:25'),
(26, 'first', 'asdf', 10, 'KG', 0, '2025-07-12 09:04:49', '2025-07-12 09:04:49'),
(27, 'new medicine', 'asdf', 2, 'Piece', 0, '2025-07-12 09:09:52', '2025-07-12 09:09:52'),
(28, 'first', 'asdf', 1, 'Gram', 0, '2025-07-12 11:48:55', '2025-07-12 11:48:55'),
(29, 'first', '45', 43, 'KG', 0, '2025-07-12 11:53:18', '2025-07-12 11:53:18'),
(30, 'Himivit', 'asdf', 43, '25 Kg Bosta', 0, '2025-07-12 11:54:13', '2025-07-12 11:54:13'),
(31, 'first', 'asdf', 7, '25 Kg Bosta', 0, '2025-07-12 11:54:34', '2025-07-12 11:54:34'),
(32, 'q 34fgsd', 'fg', 0, NULL, NULL, '2025-07-12 12:33:59', '2025-07-12 12:33:59'),
(33, 'first', 'fasdf', 2, 'KG', 0, '2025-07-12 13:26:26', '2025-07-12 13:26:26'),
(34, 'Maglex 500ml', 'asdf', 2, 'KG', 0, '2025-07-13 05:02:04', '2025-07-13 05:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2025_06_30_103609_create_animal_groups_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `milk_due_collections`
--

CREATE TABLE `milk_due_collections` (
  `id` int NOT NULL,
  `sale_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `pay_amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `milk_due_collections`
--

INSERT INTO `milk_due_collections` (`id`, `sale_id`, `date`, `pay_amount`, `created_at`, `updated_at`) VALUES
(23, 18, '2025-03-23', 600.00, '2025-03-23 21:59:04', '2025-03-23 21:59:04'),
(24, 19, '2025-03-23', 600.00, '2025-03-23 22:03:14', '2025-03-23 22:03:14'),
(25, 20, '2025-03-23', 300.00, '2025-03-23 22:07:12', '2025-03-23 22:07:12'),
(26, 20, '2025-03-23', 200.00, '2025-03-23 22:08:12', '2025-03-23 22:08:12'),
(27, 20, '2025-03-23', 100.00, '2025-03-23 22:08:37', '2025-03-23 22:08:37'),
(28, 21, '2025-04-05', 50.00, '2025-04-05 22:39:12', '2025-04-05 22:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `monitoring_services`
--

CREATE TABLE `monitoring_services` (
  `id` int NOT NULL,
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
-- Table structure for table `permanent_expense`
--

CREATE TABLE `permanent_expense` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `status` int NOT NULL,
  `price` varchar(55) NOT NULL,
  `date` date NOT NULL,
  `cow` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permanent_expense`
--

INSERT INTO `permanent_expense` (`id`, `name`, `description`, `status`, `price`, `date`, `cow`, `created_at`, `updated_at`) VALUES
(21, 'Super Admin sdf asdf', 'asdf', 0, '511111', '2025-06-29', NULL, '2025-06-29 07:48:04', '2025-06-29 07:48:04'),
(22, 'Marketer', 'asdf', 1, '111111', '2025-06-29', NULL, '2025-06-29 07:49:18', '2025-06-29 07:49:18'),
(23, NULL, 'Expense on cow ID: 29', 0, '345345', '2025-06-10', 29, '2025-06-30 06:33:11', '2025-06-30 06:33:11'),
(24, NULL, 'Expense on cow ID: 1001', 0, '345345', '2025-06-10', 1001, '2025-06-30 06:33:11', '2025-06-30 06:33:11'),
(25, NULL, 'Expense on cow ID: 2', 0, '345345', '2025-06-10', 2, '2025-06-30 06:33:11', '2025-06-30 06:33:11'),
(26, NULL, 'Expense on cow ID: 4', 0, '345345', '2025-06-10', 4, '2025-06-30 06:33:11', '2025-06-30 06:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `pond`
--

CREATE TABLE `pond` (
  `id` int NOT NULL,
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pond`
--

INSERT INTO `pond` (`id`, `name`, `address`, `created_at`, `updated_at`) VALUES
(1, 'pond 1', 'demra,dhaka', '2025-03-02 17:56:17', '2025-03-02 17:56:17');

-- --------------------------------------------------------

--
-- Table structure for table `pregnancy_record`
--

CREATE TABLE `pregnancy_record` (
  `id` int UNSIGNED NOT NULL,
  `stall_no` int NOT NULL DEFAULT '0',
  `cow_id` int NOT NULL DEFAULT '0',
  `pregnancy_type_id` int NOT NULL DEFAULT '0',
  `semen_type` int DEFAULT NULL,
  `semen_push_date` date DEFAULT NULL,
  `pregnancy_start_date` date DEFAULT NULL,
  `semen_cost` decimal(10,0) DEFAULT NULL,
  `other_cost` decimal(10,0) DEFAULT NULL,
  `note` varchar(500) DEFAULT NULL,
  `status` int DEFAULT '1' COMMENT '1=Processing, 2=Delivered, 3=Failed',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pregnancy_record`
--

INSERT INTO `pregnancy_record` (`id`, `stall_no`, `cow_id`, `pregnancy_type_id`, `semen_type`, `semen_push_date`, `pregnancy_start_date`, `semen_cost`, `other_cost`, `note`, `status`, `created_at`, `updated_at`) VALUES
(15, 19, 1, 2, 7, '2025-03-23', '2025-03-23', 350, 150, NULL, 1, '2025-03-24 00:45:48', '2025-03-24 00:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `pregnancy_type`
--

CREATE TABLE `pregnancy_type` (
  `id` int UNSIGNED NOT NULL,
  `type_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

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
  `id` int NOT NULL,
  `milk_account_number` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `supplier_id` int DEFAULT NULL,
  `name` varchar(155) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `contact` varchar(155) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `address` varchar(155) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `litter` decimal(15,2) DEFAULT NULL,
  `rate` decimal(15,2) DEFAULT NULL,
  `total_amount` decimal(15,2) DEFAULT NULL,
  `paid` decimal(15,2) DEFAULT NULL,
  `due` decimal(15,2) DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `added_by` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_milk`
--

INSERT INTO `sale_milk` (`id`, `milk_account_number`, `supplier_id`, `name`, `contact`, `email`, `address`, `litter`, `rate`, `total_amount`, `paid`, `due`, `branch_id`, `date`, `added_by`, `created_at`, `updated_at`) VALUES
(18, '01', NULL, 'Others', NULL, 'Others@gmail.com', NULL, 10.00, 60.00, 600.00, 500.00, 100.00, 1, '2025-03-23', 1, '2025-03-23 21:59:04', '2025-03-23 22:01:14'),
(19, '01', NULL, 'Others', NULL, NULL, NULL, 10.00, 60.00, 600.00, 600.00, 0.00, 1, '2025-03-23', 1, '2025-03-23 22:03:14', '2025-03-23 22:03:14'),
(20, '01', NULL, 'Others', NULL, NULL, NULL, 10.00, 60.00, 600.00, 300.00, 300.00, 1, '2025-03-23', 1, '2025-03-23 22:07:12', '2025-04-05 21:35:37'),
(21, '22', NULL, 'hasan', NULL, NULL, NULL, 10.00, 100.00, 1000.00, 50.00, 950.00, 1, '2025-04-05', 2, '2025-04-05 22:39:12', '2025-04-05 22:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `sell_beef`
--

CREATE TABLE `sell_beef` (
  `id` int NOT NULL,
  `customer` int NOT NULL,
  `date` varchar(155) NOT NULL,
  `qty` varchar(55) NOT NULL,
  `price` varchar(55) NOT NULL,
  `total_price` varchar(55) NOT NULL,
  `due` varchar(55) NOT NULL,
  `branch` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sheds`
--

CREATE TABLE `sheds` (
  `id` int NOT NULL,
  `shed_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `branch_id` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '1=Alloted, 0=Empty',
  `Capacity` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sheds`
--

INSERT INTO `sheds` (`id`, `shed_number`, `description`, `branch_id`, `status`, `Capacity`, `created_at`, `updated_at`) VALUES
(19, 'Shed 1', 'For Big Bull & Cows', 1, 0, 60, '2025-03-21 03:16:30', '2025-07-12 13:20:24'),
(20, 'Shed 2', 'For Small Bull & Cows', 1, 0, 0, '2025-03-21 03:16:46', '2025-03-21 03:19:28'),
(21, 'Shed 3', 'For Medium Bull & Cows', 1, 0, 0, '2025-03-21 03:16:55', '2025-07-12 13:20:24'),
(22, 'Shed 4', 'For Quarantine', 1, 0, 0, '2025-03-21 03:18:13', '2025-04-12 19:07:05'),
(23, 'Shed 5', NULL, 1, 0, 50, '2025-03-23 18:17:51', '2025-04-12 19:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `sick_cow`
--

CREATE TABLE `sick_cow` (
  `id` int NOT NULL,
  `cow` varchar(155) NOT NULL,
  `description` text,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `spoiled_milk`
--

CREATE TABLE `spoiled_milk` (
  `id` int NOT NULL,
  `quantity` varchar(55) NOT NULL,
  `account` varchar(55) NOT NULL,
  `date` varchar(155) NOT NULL,
  `price` varchar(55) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spoiled_milk`
--

INSERT INTO `spoiled_milk` (`id`, `quantity`, `account`, `date`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, '6', '2000', '2025-02-27', '1000', 'test', '2025-04-05 09:04:11', '2025-04-05 22:04:11'),
(2, '10', '123', '2025-03-15', '1000', 'sell nah howar jonno', '2025-03-16 02:42:00', '2025-03-16 02:42:00'),
(4, '15', '1020', '2025-03-17', '1500', 'ki karona nosto,', '2025-03-18 05:24:29', '2025-03-18 05:24:29'),
(5, '5', '01', '2025-03-23', '50', 'ময়লা পড়ার কারনে দুধ নষ্ট হয়েছে', '2025-03-23 22:16:47', '2025-03-23 22:16:47');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int NOT NULL,
  `name` varchar(155) DEFAULT NULL,
  `company_name` varchar(250) DEFAULT NULL,
  `phn_number` varchar(55) DEFAULT NULL,
  `present_address` text,
  `mail_address` varchar(150) DEFAULT NULL,
  `profile_image` text,
  `branch_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `company_name`, `phn_number`, `present_address`, `mail_address`, `profile_image`, `branch_id`, `created_at`, `updated_at`) VALUES
(9, 'Kamrul Hasan', 'Shohoz Fintech Limited imited', '01747665006', 'suppler', 'jkconventionhall@gmail.com', '', 2, '2025-03-17 02:13:26', '2025-03-17 02:13:26'),
(10, 'Arshad', 'Arshad Veterinary', '01774487116', 'Sena Market, Fulbari', NULL, '', 1, '2025-03-21 18:02:23', '2025-03-21 18:02:23'),
(11, 'Sentu Haji', 'Vai Vai Store', '01712583511', 'Rail gate, Fulbari', NULL, '', 1, '2025-03-21 18:05:10', '2025-03-21 18:05:10'),
(12, 'Other', 'Random', '01774459511', 'Random', NULL, '', 1, '2025-03-21 18:07:07', '2025-03-21 18:07:07'),
(13, 'Amin Auto', 'Amin Auto Rice Industries', '01774459511', 'Tetulia, Rangpur Road, Fulbari', NULL, '', 1, '2025-03-21 18:08:15', '2025-03-21 18:08:15'),
(14, 'Hussain Mia', 'Istiak Traders', '01735520208', 'Aftabganj', NULL, '', 1, '2025-03-21 18:26:40', '2025-03-21 18:26:40'),
(15, 'Mehedul', 'MD Mehedul', '01785360344', 'Rangpur', NULL, '', 1, '2025-03-21 18:29:42', '2025-03-21 18:29:42');

-- --------------------------------------------------------

--
-- Table structure for table `system_control`
--

CREATE TABLE `system_control` (
  `system_key_id` int NOT NULL,
  `key` varchar(250) NOT NULL,
  `value` text NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `system_control`
--

INSERT INTO `system_control` (`system_key_id`, `key`, `value`, `status`, `created_at`, `updated_at`) VALUES
(70, 'system_config', '{\"currencySymbol\":\"tk.\",\"currencyPosition\":\"right\",\"currencySeparator\":\".\",\"currencyDisable\":\"on\",\"loginTitle\":\"Amin Auto Rice Industries\",\"topTitle\":\"Amin Auto Rice Industries\",\"copyrightText\":\"Amin Auto Rice Industries\",\"copyrightLink\":\"https:\\/\\/aminagrofarm.com\\/\",\"logo\":\"751280420015239.png\",\"super_admin_logo\":\"538280420015239.png\"}', 1, '2025-04-09 19:57:32', '2025-04-09 19:57:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_max_power`
--

CREATE TABLE `tbl_max_power` (
  `id` int NOT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `purchase_key` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `last_check_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'user@aminagrofarm.com',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_hint` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `branch_id` int DEFAULT NULL,
  `image` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nid` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `present_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parmanent_address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` int NOT NULL DEFAULT '0',
  `basic_salary` decimal(15,2) DEFAULT NULL,
  `gross_salary` decimal(15,2) DEFAULT NULL,
  `advance_payment` int NOT NULL DEFAULT '0',
  `joining_date` date DEFAULT NULL,
  `resign_date` date DEFAULT NULL,
  `resign_desc` text COLLATE utf8mb4_unicode_ci,
  `user_type` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `created_by` int DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `password_hint`, `branch_id`, `image`, `nid`, `phone_number`, `present_address`, `parmanent_address`, `designation`, `basic_salary`, `gross_salary`, `advance_payment`, `joining_date`, `resign_date`, `resign_desc`, `user_type`, `status`, `created_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Amin Agro Farm', 'aminagrofarm589@gmail.com', '$2y$10$zFGhKo0hNoGxPRX.N07zOuDYJllEyfp/gYTrsegI4uN7yxD44fv1y', '123456', NULL, '332161119010818.jpg', NULL, '012454121', 'Dhaka', 'Dhaka', 1, 50000.00, 60000.00, 0, '2019-11-01', NULL, NULL, 1, 1, NULL, NULL, NULL, '2025-03-21 03:55:59'),
(2, 'Mr. Rahman', 'admin@mail.com', '$2y$10$GK/qRNoj2XbAuV1FAPJByuVR..RL0MDQU5w01W8W2LaM7I5mp/iJW', '123456', NULL, '332161119010818.jpg', NULL, '012454121', 'Dhaka', 'Dhaka', 1, 50000.00, 60000.00, 0, '2019-11-01', NULL, NULL, 1, 1, NULL, NULL, NULL, '2025-03-20 21:58:39'),
(25, 'Test', NULL, '$2y$10$4Jz9wzw3VkiSkPhXY8odquiVnxRY4lJlzaobbwy4VFneDPMVDV6c6', '123456', 1, NULL, NULL, '01234569854', 'dhaka', NULL, 4, 8000.00, 8000.00, 0, '2025-04-06', NULL, NULL, 5, 1, 2, NULL, '2025-04-06 19:53:24', '2025-04-06 19:53:24');

-- --------------------------------------------------------

--
-- Table structure for table `users_type`
--

CREATE TABLE `users_type` (
  `id` int UNSIGNED NOT NULL,
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
(4, 'Marketing Executive', NULL, '2019-10-13 07:14:46', '2020-02-07 10:16:38'),
(5, 'staff', NULL, '2025-03-16 02:47:48', '2025-03-16 02:47:48'),
(6, 'labour', NULL, '2025-03-16 02:47:55', '2025-03-21 18:34:22');

-- --------------------------------------------------------

--
-- Table structure for table `vaccines`
--

CREATE TABLE `vaccines` (
  `id` int NOT NULL,
  `vaccine_name` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `months` int DEFAULT NULL COMMENT 'month digit',
  `repeat_vaccine` tinyint NOT NULL DEFAULT '0',
  `dose` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `price` int NOT NULL DEFAULT '0',
  `note` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vaccines`
--

INSERT INTO `vaccines` (`id`, `vaccine_name`, `months`, `repeat_vaccine`, `dose`, `price`, `note`, `created_at`, `updated_at`) VALUES
(9, 'F.M.D (খুরা)  (মাত্রা ১৬)', 120, 1, '2 ml & 6 ml', 400, 'ক্ষুরা রোগের টিকা বোতলে তরল অবস্থায় থাকে। পশুর ৪ মাস বয়সে প্রথম টিকা দিতে হয়। এ রোগের বিভিন্ন স্ট্রেইনের জন্য বিভিন্ন ভ্যাকসিন পাওয়া যায় যেমন- মনোভ্যালেন্ট, বাইভ্যালেন্ট ও ট্রাইভ্যালেন্ট, ইত্যাদি। গরু ও মহিষের জন্য ভ্যাকসিনের মাত্রা মনো হলে ৩, বাই হলে ৬ এবং ট্রাই হলে ৯ মিলি এবং ছাগল ও ভেড়ার জন্য গরুর অর্ধেক ডোজ দিতে হয়। প্রতি ৪ মাস অন্তর টিকা দিতে হয়। এ টিকা পশুর ঘাড়ের চামড়ার নিচে দিতে হয়। উল্লেখ্য, গর্ভবতী পশুকেও এ টিকা দেয়া যায়।', '2025-04-06 19:50:25', '2025-04-06 20:24:46'),
(10, 'Anthrax (তড়কা) (মাত্রা ১০০)', 365, 1, '1 ml', 80, 'পশুর ৬ মাস বয়সে প্রথম টিকা দিতে হয়। গরু ও মহিষের জন্য টিকার মাত্রা হল ১ মিলি. এবং ছাগল ও ভেড়ার জন্য ০.৫ মিলি। ১ বছর অন্তর এ টিকা দিতে হয়। এ টিকা পশুর ঘাড়ের/গলার  চামড়ার নিচে দিতে হয়। তবে ৭ মাসের ঊর্দ্ধ বয়সের গর্ভবতী গরু/মহিষকে দেয়া যাবে না। ছাগল/ভেড়ার ক্ষেত্রে গর্ভধারণের ৩ মাস পরে  দেয়া যাবে না ।', '2025-04-06 20:00:14', '2025-04-06 20:25:34'),
(11, 'H.S (গলাফুলা) (মাত্রা ৫০)', 180, 1, '1 mL', 50, 'গলাফুলা টিকা ১০০ মিলি তরল অবস্থায় বোতলে থাকে। পশুর ৬ মাস বয়সে প্রথম টিকা দিতে হয়। গরু ও মহিষের জন্য টিকার মাত্রা হল ২ মিলি. এবং ছাগল ও ভেড়ার জন্য ১ মিলি।  প্রতি ৬ মাস অন্তর টিকা দিতে হয়। এ টিকাও  পশুর ঘাড়ের চামড়ার নিচে দিতে হয়।', '2025-04-06 20:07:55', '2025-04-06 20:26:04'),
(12, 'B.Q (বাদলা) (মাত্রা ২০)', 180, 0, '5 mL', 40, 'বাদলা রোগের টিকা ১০০ মিলি তরল অবস্থায় বোতলে থাকে। পশুর ৬ মাস বয়সে প্রথম টিকা দিতে হয়। গরু ও মহিষের জন্য মাত্রা হল ৫ মিলি এবং ছাগল ও ভেড়ার জন্য ২ মিলি। প্রতি ৬ মাস অন্তর টিকা দিতে হয়। এ টিকা পশুর ঘাড়ের চামড়ার নিচে দিতে হয়। তবে এ রোগের টিকা   ২.৫-৩ বছর পরে আর গরু/ মহিষকে দেয়ার প্রয়োজন হয় না ।', '2025-04-06 20:11:20', '2025-04-06 20:25:15'),
(13, 'Lumpy (লাম্পি) (মাত্রা ১০)', 180, 1, '2ml', 2300, '২০ মিলি তরল ভেক্সিন থাকে। ৬ মাস পর পর দেওয়া হয়। ২-৩ বছরের ষাড়/গাভিকে দেওয়ার প্রয়োজন হয় না। গর্ভবতী গাভীকে দেওয়া যায় এবং দেওয়া উচিত।', '2025-04-06 20:15:55', '2025-04-06 20:26:25'),
(14, 'Goat Pox (ছাগলের বসন্ত) (মাত্রা ১০০)', 150, 1, '2ml', 75, 'ছাগলের বসন্তের টিকা ভায়ালে হিমায়িত অবস্থায় থাকে। ভায়ালের সাথে বিশুদ্ধ পানি থাকে। পানিতে এ টিকা গুলে ২ মিলি প্রতি ছাগলের লেজের গোড়াতে ত্বকের নিচে ইনজেকশন করতে হয়। ছাগলের ৫ মাস বয়সে প্রথম এ টিকা দিতে হয়।', '2025-04-06 20:21:52', '2025-04-06 20:27:29'),
(15, 'PPR (পিপিআর) (মাত্রা ১০০)', 120, 1, '1 mL', 70, 'ছাগলের পিপিআর ভ্যাকসিন ভায়ালে হিমায়িত অবস্থায় থাকে। ভায়ালের সাথে ১০০মিলি ডাইলুয়েন্ট থাকে। এ টিকা সরবরাহকৃত ডাইলুয়েন্টের ভেতর ভালো করে মিশিয়ে  প্রতিটি ছাগলকে ঘাড়ের চামড়ার নীচে ১ মিলি ইনজেকশন করে দিতে হয়। ছাগলের ৩ মাস বয়সে প্রথম এ টিকা দিতে হয়। এ টিকা এক বছর অন্তর দিতে হয়। উল্লে­খ্য, গর্ভবতী ছাগলকেও এ টিকা দেওয়া যায় ।', '2025-04-06 20:30:13', '2025-04-06 20:30:13'),
(16, 'Anti-Rabies (জলাতঙ্ক) (মাত্রা ১)', 365, 0, '3 ml & 4 ml', 50, 'পশুকে কুকুরে কামড়ানোর পরে পোস্ট এক্সপোসার ভ্যাকসিন এআরভি (Anti Rabies vaccine/ ARV) দিতে হয়। বেসরকারি ওষুধ কোম্পানির র‌্যাবিসিন (Rabisin) ভ্যাকসিন পাওয়া যায়। মাত্রা হলো- ১ম দিন ৪ মিলি  ৪ স্থানে   ১ মিলি করে, ৭ম দিনে ৩ মিলি ৩ স্থানে ১ মিলি করে এবং ২১তম দিনে  ৩ স্থানে ১ মিলি করে ৩ মিলি মাংসে দিতে হয় ।', '2025-04-06 20:40:34', '2025-04-06 20:42:18'),
(17, 'asdf', 45, 1, '345', 0, NULL, '2025-07-12 07:43:26', '2025-07-12 07:43:26'),
(18, 'asdf', 45, 1, 'asdf', 4545, 'asdf', '2025-07-12 07:45:29', '2025-07-12 07:45:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `animal_groups`
--
ALTER TABLE `animal_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `animal_type`
--
ALTER TABLE `animal_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `beef_collection`
--
ALTER TABLE `beef_collection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branchs`
--
ALTER TABLE `branchs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buyer`
--
ALTER TABLE `buyer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buy_medicine`
--
ALTER TABLE `buy_medicine`
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
-- Indexes for table `cow_food`
--
ALTER TABLE `cow_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cow_medicine_monitor`
--
ALTER TABLE `cow_medicine_monitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cow_medicine_monitor_dtls`
--
ALTER TABLE `cow_medicine_monitor_dtls`
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
-- Indexes for table `dead_animal`
--
ALTER TABLE `dead_animal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dead_calf`
--
ALTER TABLE `dead_calf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earning`
--
ALTER TABLE `earning`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `earning_purpose`
--
ALTER TABLE `earning_purpose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_salary`
--
ALTER TABLE `employee_salary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employee_salary_advance_payment`
--
ALTER TABLE `employee_salary_advance_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purpose_id` (`purpose_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `expenses_new`
--
ALTER TABLE `expenses_new`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expense_purpose`
--
ALTER TABLE `expense_purpose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fish_harvest`
--
ALTER TABLE `fish_harvest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fish_sell`
--
ALTER TABLE `fish_sell`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fish_stocking`
--
ALTER TABLE `fish_stocking`
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
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hatchery_expense_category`
--
ALTER TABLE `hatchery_expense_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `permanent_expense`
--
ALTER TABLE `permanent_expense`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pond`
--
ALTER TABLE `pond`
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
-- Indexes for table `sell_beef`
--
ALTER TABLE `sell_beef`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sheds`
--
ALTER TABLE `sheds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sick_cow`
--
ALTER TABLE `sick_cow`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spoiled_milk`
--
ALTER TABLE `spoiled_milk`
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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142542;

--
-- AUTO_INCREMENT for table `animal_groups`
--
ALTER TABLE `animal_groups`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `animal_type`
--
ALTER TABLE `animal_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `beef_collection`
--
ALTER TABLE `beef_collection`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `branchs`
--
ALTER TABLE `branchs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `buyer`
--
ALTER TABLE `buyer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `buy_medicine`
--
ALTER TABLE `buy_medicine`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `calf`
--
ALTER TABLE `calf`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1427;

--
-- AUTO_INCREMENT for table `collect_milk`
--
ALTER TABLE `collect_milk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cow_feed`
--
ALTER TABLE `cow_feed`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `cow_feed_dtls`
--
ALTER TABLE `cow_feed_dtls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT for table `cow_food`
--
ALTER TABLE `cow_food`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `cow_medicine_monitor`
--
ALTER TABLE `cow_medicine_monitor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cow_medicine_monitor_dtls`
--
ALTER TABLE `cow_medicine_monitor_dtls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cow_monitor`
--
ALTER TABLE `cow_monitor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `cow_monitor_dtls`
--
ALTER TABLE `cow_monitor_dtls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `cow_sale`
--
ALTER TABLE `cow_sale`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `cow_sale_dtls`
--
ALTER TABLE `cow_sale_dtls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `cow_sale_payments`
--
ALTER TABLE `cow_sale_payments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `cow_vaccine_monitor`
--
ALTER TABLE `cow_vaccine_monitor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cow_vaccine_monitor_dtls`
--
ALTER TABLE `cow_vaccine_monitor_dtls`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `dead_animal`
--
ALTER TABLE `dead_animal`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `dead_calf`
--
ALTER TABLE `dead_calf`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `earning`
--
ALTER TABLE `earning`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `earning_purpose`
--
ALTER TABLE `earning_purpose`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_salary`
--
ALTER TABLE `employee_salary`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `employee_salary_advance_payment`
--
ALTER TABLE `employee_salary_advance_payment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `expenses_new`
--
ALTER TABLE `expenses_new`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `expense_purpose`
--
ALTER TABLE `expense_purpose`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `fish_harvest`
--
ALTER TABLE `fish_harvest`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fish_sell`
--
ALTER TABLE `fish_sell`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `fish_stocking`
--
ALTER TABLE `fish_stocking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `food_items`
--
ALTER TABLE `food_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `food_units`
--
ALTER TABLE `food_units`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `hatchery_expense_category`
--
ALTER TABLE `hatchery_expense_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `milk_due_collections`
--
ALTER TABLE `milk_due_collections`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `monitoring_services`
--
ALTER TABLE `monitoring_services`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `permanent_expense`
--
ALTER TABLE `permanent_expense`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pond`
--
ALTER TABLE `pond`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pregnancy_record`
--
ALTER TABLE `pregnancy_record`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pregnancy_type`
--
ALTER TABLE `pregnancy_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sale_milk`
--
ALTER TABLE `sale_milk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `sell_beef`
--
ALTER TABLE `sell_beef`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sheds`
--
ALTER TABLE `sheds`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sick_cow`
--
ALTER TABLE `sick_cow`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `spoiled_milk`
--
ALTER TABLE `spoiled_milk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `system_control`
--
ALTER TABLE `system_control`
  MODIFY `system_key_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_max_power`
--
ALTER TABLE `tbl_max_power`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users_type`
--
ALTER TABLE `users_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vaccines`
--
ALTER TABLE `vaccines`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
