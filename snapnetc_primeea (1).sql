-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2019 at 05:27 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `snapnetc_primeea`
--

-- --------------------------------------------------------

--
-- Table structure for table `agrolytics`
--

CREATE TABLE `agrolytics` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_name_id` int(10) DEFAULT NULL,
  `pag_objective` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'PAGroup Objectives',
  `cat_id` int(4) NOT NULL DEFAULT '1' COMMENT 'category_id',
  `sec_id` int(10) NOT NULL DEFAULT '1' COMMENT 'sector_id',
  `customer_id` int(11) NOT NULL DEFAULT '0',
  `prospect` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comp_objective` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initiative` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `op_rep` int(11) DEFAULT NULL,
  `day_of_week` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prog_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `lmodified_id` int(3) DEFAULT NULL,
  `third_party_access` int(10) DEFAULT NULL,
  `third_party_validity` int(10) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `agrolytics`
--

INSERT INTO `agrolytics` (`id`, `group_name_id`, `pag_objective`, `cat_id`, `sec_id`, `customer_id`, `prospect`, `comp_objective`, `status`, `initiative`, `user_id`, `op_rep`, `day_of_week`, `created_at`, `updated_at`, `prog_status`, `lmodified_id`, `third_party_access`, `third_party_validity`) VALUES
(1, 32, 'Increase revenue; collate accurate data on the platform.', 31, 12, 25, 'FCMB.123', 'Collate accurate data analytics of food items and also generate predictive reports\r\n\r\nTo subscribe on PA platform', 'Perpetual', 'To ensure subscriptions are renewed as at when due.w', 1, 5, NULL, '2018-07-24 15:15:30', '2019-03-29 04:47:46', '30', 1, NULL, 1),
(21, 69, 'pg obj', 30, 13, 24, 'pros', 'obj', 'Prospect', 'init', 1, 7, NULL, '2019-03-27 21:57:45', '2019-03-30 04:46:46', '75', NULL, NULL, 1),
(22, 71, 'dfdf', 34, 11, 23, 'prooos', 'obj', 'Perpetual', 'init', 1, 7, NULL, '2019-03-27 22:04:16', '2019-04-02 13:21:37', '63', NULL, NULL, 1),
(23, 70, 'Pag Objective.', 33, 11, 25, 'new prospect', 'Company objective', 'Perpetual', 'Initiative', 1, 7, NULL, '2019-03-28 09:26:14', '2019-03-30 04:55:18', '33', NULL, NULL, 1),
(24, 69, 'Pag Objective', 30, 10, 24, 'Prospect...', 'Company objective', 'Perpetual', 'Initiative', 1, 5, NULL, '2019-03-28 10:08:00', '2019-03-30 04:46:15', '33', NULL, NULL, 1),
(25, 70, 'cfhg', 34, 12, 25, 'jopiio', 'vhgcxf', 'Perpetual', 'ini', 1, 7, NULL, '2019-03-28 12:54:49', '2019-03-30 04:46:07', '81', NULL, NULL, 1),
(26, 71, 'pag obj', 33, 11, 24, 'test', 'obj', 'Perpetual', 'initi', 1, 7, NULL, '2019-03-29 04:50:18', '2019-04-01 11:24:08', '80', NULL, NULL, 1),
(10, 0, 'This is a tes', 30, 11, 25, 'FCMB', 'This is a tes', 'Perpetual', 'This is a tes', 1, 7, NULL, '2018-08-03 13:11:57', '2019-03-29 13:38:58', '43', 1, NULL, 1),
(20, 65, 'pagin-objective 123.', 30, 11, 26, 'propect', 'comp......', 'Perpetual', 'init', 1, 5, NULL, '2019-03-27 14:49:49', '2019-03-29 06:02:42', '85', NULL, NULL, 1),
(27, 69, 'test pag obj', 33, 10, 23, 'test prospect', 'tes comp obj', 'Perpetual', 'test initiative.', 11, 9, NULL, '2019-03-30 23:35:24', '2019-04-01 08:11:51', '75', NULL, NULL, 1),
(28, 70, 'po', 31, 11, 25, 'test p', 'co', 'Prospect', 'test init', 11, 10, NULL, '2019-03-30 23:39:08', '2019-03-31 02:08:18', 'Pending', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'SUBSCRIPTION ON THE PLATFORM', '2018-07-25 18:44:07', '2018-07-25 18:44:07'),
(2, 'CONSULTANCY', '2018-07-25 18:49:46', '2018-07-25 19:00:49'),
(3, 'ADVERTS 123.', '2018-07-25 19:01:05', '2019-03-25 10:24:08'),
(4, 'PARTNERSHIPSmmm', '2018-07-25 19:01:19', '2019-03-25 21:55:35'),
(6, 'DOWNLOADS', '2018-07-25 19:01:42', '2018-07-25 19:01:42'),
(12, 'testing ...', '2019-03-25 18:12:08', '2019-03-25 18:12:08'),
(13, 'ADVERTS 123.4', '2019-03-25 18:12:18', '2019-03-25 18:12:18'),
(14, 'ADVERTS 123.11', '2019-03-25 18:12:32', '2019-03-25 18:12:32'),
(15, 'DOWNLOADS1', '2019-03-25 18:13:09', '2019-03-25 18:13:09'),
(16, 'DOWNLOADS1', '2019-03-25 18:13:15', '2019-03-25 18:13:15'),
(24, 'cact2', '2019-03-25 21:03:02', '2019-03-25 21:03:02'),
(19, 'DOWNLOADS1', '2019-03-25 18:19:17', '2019-03-25 18:19:17'),
(20, 'DOWNLOADS1000', '2019-03-25 18:19:30', '2019-03-25 18:19:30'),
(26, 'cool849', '2019-03-25 21:03:29', '2019-03-25 21:03:42'),
(25, 'blah234', '2019-03-25 21:03:25', '2019-03-25 22:00:21'),
(23, 'cat 1...', '2019-03-25 21:02:58', '2019-03-26 21:02:29'),
(22, 'new item.', '2019-03-25 21:02:03', '2019-03-25 21:02:03'),
(27, 'nice....', '2019-03-25 21:03:48', '2019-03-26 16:35:04'),
(28, 'New Category.', '2019-03-26 04:32:50', '2019-03-26 04:32:50'),
(29, 'New Category.', '2019-03-26 04:33:10', '2019-03-26 04:33:10'),
(30, 'new data,', '2019-03-26 16:35:12', '2019-03-26 21:50:20'),
(31, 'another new data 123', '2019-03-26 16:35:18', '2019-03-26 22:48:41'),
(32, 'New Category. 123111', '2019-03-26 22:48:20', '2019-04-01 12:28:39'),
(33, 'new catjjkjk', '2019-03-28 09:30:09', '2019-04-01 13:02:20'),
(34, 'New Category....', '2019-03-28 09:33:27', '2019-03-28 09:33:27'),
(35, 'new cat123....', '2019-04-01 12:28:31', '2019-04-02 05:34:23'),
(36, 'another catmm,m', '2019-04-01 12:28:47', '2019-04-02 05:34:29'),
(37, 'another cat34578', '2019-04-01 12:28:59', '2019-04-01 12:29:05');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agro_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `agro_id`, `comment`, `type`, `created_at`, `updated_at`) VALUES
(40, '1', '1', 'another post', 1, '2019-03-30 03:52:13', '2019-03-30 03:52:13'),
(2, '1', '1', 'kjnjkjnnnnj', 1, '2018-08-01 02:18:31', '2019-03-30 03:51:00'),
(35, '1', '1', 'bhg vhjnm', 1, '2019-03-30 03:51:04', '2019-03-30 03:51:04'),
(4, '1', '10', 'efefef', 1, '2018-08-06 17:17:36', '2018-08-06 17:17:36'),
(5, '1', '10', 'fefefef3fef3', 1, '2018-08-06 17:18:20', '2018-08-06 17:18:20'),
(6, '1', '10', 'wdw', 1, '2018-08-06 17:19:45', '2018-08-06 17:19:45'),
(7, '1', '10', 'fbdg', 1, '2018-08-06 17:20:27', '2018-08-06 17:20:27'),
(8, '1', '10', 'fbdg', 1, '2018-08-06 17:20:57', '2018-08-06 17:20:57'),
(9, '1', '10', 'efefefef', 1, '2018-08-06 17:21:26', '2018-08-06 17:21:26'),
(10, '1', '10', 'efefefef', 1, '2018-08-06 17:21:34', '2018-08-06 17:21:34'),
(11, '1', '10', 'efefefef', 1, '2018-08-06 17:21:47', '2018-08-06 17:21:47'),
(12, '1', '10', 'efefefef', 1, '2018-08-06 17:22:11', '2018-08-06 17:22:11'),
(14, '321', '123', 'comments new updated. now...', 1, '2019-03-25 15:23:36', '2019-03-25 15:25:40'),
(15, '321', '123', 'comments new updated...', 1, '2019-03-25 15:23:46', '2019-03-25 15:23:46'),
(27, '1', '26', 'Your comment ...new', 1, '2019-03-30 02:15:36', '2019-03-30 02:15:36'),
(17, '1', '20', 'another test comment.', 1, '2019-03-29 06:01:57', '2019-03-29 06:01:57'),
(18, '1', '24', 'new comment.', 1, '2019-03-29 07:43:13', '2019-03-29 07:43:13'),
(28, '1', '26', 'new comment 2', 1, '2019-03-30 02:15:47', '2019-03-30 02:15:47'),
(20, '1', '25', 'Your comment here. new comment...', 1, '2019-03-29 14:13:40', '2019-03-29 14:13:40'),
(21, '1', '25', 'new comments here (edited).', 1, '2019-03-29 14:16:15', '2019-04-01 08:21:48'),
(22, '1', '24', 'test...', 1, '2019-03-29 14:17:11', '2019-03-29 14:17:11'),
(23, '1', '23', 'Your comment here. new 321', 1, '2019-03-29 14:18:29', '2019-03-29 14:18:29'),
(24, '1', '23', 'new 422.', 1, '2019-03-29 14:18:46', '2019-03-29 14:18:46'),
(25, '1', '26', 'new 231 edited', 1, '2019-03-30 01:46:34', '2019-03-30 03:40:25'),
(26, '1', '26', 'another new comment.....updated', 1, '2019-03-30 01:46:46', '2019-03-30 02:10:12'),
(37, '1', '1', '123', 1, '2019-03-30 03:51:19', '2019-03-30 03:51:19'),
(29, '1', '26', 'new 2343', 1, '2019-03-30 02:15:58', '2019-03-30 02:15:58'),
(30, '1', '26', 'new 343', 1, '2019-03-30 02:16:09', '2019-03-30 02:16:09'),
(31, '1', '26', 'another comment...', 1, '2019-03-30 02:16:21', '2019-03-30 02:16:21'),
(32, '1', '26', 'another test comment', 1, '2019-03-30 02:26:13', '2019-03-30 02:26:13'),
(33, '1', '26', 'new comment posted.', 1, '2019-03-30 02:59:24', '2019-03-30 03:40:01'),
(38, '1', '1', '345', 1, '2019-03-30 03:51:26', '2019-03-30 03:51:26'),
(41, '1', '1', 'another post...', 1, '2019-03-30 03:52:32', '2019-03-30 03:52:32'),
(42, '1', '21', 'new comment added', 1, '2019-03-30 03:56:37', '2019-03-30 03:56:37'),
(43, '1', '21', 'another new comment added.', 1, '2019-03-30 03:56:59', '2019-03-30 03:56:59'),
(44, '1', '21', 'new comment added.', 1, '2019-03-30 03:57:17', '2019-03-30 03:57:17'),
(45, '1', '1', 'Your comment ...', 1, '2019-03-30 04:54:49', '2019-03-30 04:54:49'),
(46, '1', '23', 'Your comment ...898', 1, '2019-03-30 04:55:48', '2019-03-30 04:55:48'),
(47, '1', '1', 'new comment ago', 1, '2019-03-30 11:48:51', '2019-03-30 11:48:51'),
(48, '1', '1', 'Your comment ...gvcgh', 1, '2019-03-30 11:57:23', '2019-03-30 11:57:23'),
(49, '1', '24', 'test comment', 1, '2019-03-30 21:57:28', '2019-03-30 21:57:28'),
(52, '9', '27', 'Your comment ...changed', 1, '2019-03-31 00:22:49', '2019-03-31 06:42:27'),
(51, '1', '23', 'test comment123', 1, '2019-03-30 21:58:11', '2019-03-30 21:58:27'),
(53, '9', '27', 'another comment', 1, '2019-03-31 00:23:03', '2019-03-31 00:23:03'),
(55, '11', '28', 'Your comment here. new posting ...', 1, '2019-04-01 04:02:39', '2019-04-01 04:02:39'),
(56, '11', '28', 'testing new comment added.', 1, '2019-04-01 04:06:17', '2019-04-01 04:06:17'),
(57, '11', '28', 'another comment added.', 1, '2019-04-01 04:06:27', '2019-04-01 04:06:27'),
(58, '11', '28', 'another new comment added.', 1, '2019-04-01 04:06:37', '2019-04-01 04:06:37'),
(59, '1', '25', 'Your comment here.test', 1, '2019-04-01 08:20:37', '2019-04-01 08:20:37'),
(60, '1', '25', 'more comments....', 1, '2019-04-01 08:21:09', '2019-04-01 08:21:09'),
(61, '1', '25', 'another comment.', 1, '2019-04-01 08:21:24', '2019-04-01 08:21:24'),
(62, '1', '26', 'Your comment here. tst', 1, '2019-04-01 10:49:42', '2019-04-01 10:49:42'),
(63, '1', '26', 'Your comment ...test2323', 1, '2019-04-01 10:50:57', '2019-04-02 13:14:23'),
(64, '1', '26', 'new comment.', 1, '2019-04-02 12:11:19', '2019-04-02 12:11:19'),
(65, '1', '22', 'new comment posted.', 1, '2019-04-02 13:22:47', '2019-04-02 13:22:47'),
(66, '1', '22', 'Your mmc.', 1, '2019-04-02 13:23:19', '2019-04-02 13:23:19');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_num` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `added_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `contact_email`, `address`, `phone_num`, `added_by`, `created_at`, `updated_at`) VALUES
(1, 'FCMB', 'olorundaolaoluwa@gmail.com', '1b Abayomi Shonuga Cresent, Off Dele Adedeji Str., Lekki Phase 1', '+2347036725298', '1', '2018-07-30 15:23:29', '2018-07-30 15:47:28'),
(5, 'test name', 'test email', 'adress', '879087980', '1', '2019-03-26 05:51:31', '2019-03-26 05:51:31'),
(3, 'PRIME AGROLYTICS----PLATFORM', 'email.xcom', 'address...1121....', 'my numbers ... new', '34', '2019-03-25 14:30:23', '2019-03-25 14:30:23'),
(4, 'PRIME AGROLYTICS----PLATFORM', 'email.xcom', 'address...1121....', 'my numbers ... new........', '34', '2019-03-25 14:44:28', '2019-03-25 14:44:28'),
(6, 'test name 12333', 'test email', 'adress', '879087980', '1', '2019-03-26 05:51:47', '2019-03-26 05:51:47'),
(11, 'hvhyuvuhy', 'vyvyuvy', 'yuvyuv', 'yvu', '1', '2019-03-26 06:05:43', '2019-03-26 06:05:43'),
(8, 'PRIME AGROLYTICS----PLATFO', 'email.xcom', 'address...1121....', 'my numbers ... new........', '1', '2019-03-26 05:52:17', '2019-03-26 05:52:17'),
(13, 'test name', 'test email', 'adress', '879087980', '1', '2019-03-26 06:18:42', '2019-03-26 06:18:42'),
(14, 'PRIME AGROLYTICS----PLATFORM', 'email.xcomm', 'address...1121....', 'my numbers ... new........', '1', '2019-03-26 06:55:20', '2019-03-26 06:55:20'),
(15, 'PRIME AGROLYTICS', 'email.xcom', 'address...1121....', 'my numbers ... new........', '1', '2019-03-26 09:33:22', '2019-03-26 09:33:22'),
(19, 'PRIME AGROLYTICS updated.', 'email.xcomm', 'address...1121....', 'my numbers ... new........', '1', '2019-03-26 09:34:59', '2019-03-26 09:34:59'),
(18, 'PRIME AGROLYTICS', 'email.xcomm', 'address...1121....', 'my numbers ... new........', '1', '2019-03-26 09:34:38', '2019-03-26 09:34:38'),
(20, 'PRIME AGROLYTICS----PLATFORM123', 'email.xcomm', 'address...1121....', 'my numbers ... new........', '1', '2019-03-26 16:39:13', '2019-03-26 16:39:13'),
(21, 'FCMB Bank', 'olorundaolaoluwa@gmail.com', '1b Abayomi Shonuga Cresent, Off Dele Adedeji Str., Lekki Phase 1', '+2347036725298', '1', '2019-03-26 16:39:48', '2019-03-26 16:39:48'),
(22, 'FCMB Bank', 'olorundaolaoluwa@gmail.com', '1b Abayomi Shonuga Cresent, Off Dele Adedeji Str., Lekki Phase 1', '+2347036725298', '1', '2019-03-26 16:40:09', '2019-03-26 16:40:09'),
(23, 'Customer A', 'vyvyuvy123', 'yuvyuvmmmm...', 'yvu...456', '9', '2019-03-26 21:05:14', '2019-03-31 06:13:35'),
(24, 'FCMB Bank..........788 mod', 'olorundaolaoluwa@gmail.com', '1b Abayomi Shonuga Cresent, Off Dele Adedeji Str., Lekki Phase 1', '+2347036725298', '1', '2019-03-26 21:43:01', '2019-03-26 21:49:31'),
(25, 'FCMB Bank......', 'olorundaolaoluwa@gmail.com', '1b Abayomi Shonuga Cresent, Off Dele Adedeji Str., Lekki Phase 1...', '+2347036725298', '1', '2019-03-26 21:43:29', '2019-03-28 13:29:28'),
(26, 'qqqq', 'qqqq', 'qqqq', '777777', '1', '2019-03-26 21:47:02', '2019-03-26 21:47:02'),
(27, 'nice', 'uhuh', 'uhuh', '67766776', '1', '2019-03-26 21:49:48', '2019-03-26 21:49:57');

-- --------------------------------------------------------

--
-- Table structure for table `group_names`
--

CREATE TABLE `group_names` (
  `id` int(10) NOT NULL,
  `group_name_id` int(10) DEFAULT '0',
  `name` varchar(150) NOT NULL,
  `created_at` varchar(100) NOT NULL,
  `updated_at` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_names`
--

INSERT INTO `group_names` (`id`, `group_name_id`, `name`, `created_at`, `updated_at`) VALUES
(69, 0, 'Group A', '2019-03-30 05:19:28', '2019-03-30 05:19:37'),
(70, 0, 'Group B', '2019-03-30 05:19:42', '2019-03-30 05:19:42'),
(71, 0, 'Group C', '2019-03-30 05:19:47', '2019-03-30 05:19:47'),
(72, 0, 'Group D', '2019-03-30 05:19:51', '2019-03-30 05:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2018_07_24_110845_create_agrolytics_table', 1),
(6, '2018_07_24_152702_create_reports_table', 1),
(7, '2018_07_25_191146_create_categories_table', 2),
(9, '2018_07_30_100140_create_customers_table', 3),
(10, '2018_07_31_131321_create_comments_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('olorundaolaoluwa@gmail.com', '$2y$10$OsEBlZGzWbGPKJ52IN2OnOgU43l1Eq.UmaU7whpU6tIzrdYGzAAfC', '2018-07-25 07:05:10');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(10) UNSIGNED NOT NULL,
  `report` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `agro_id` int(11) NOT NULL,
  `day_week` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prog_status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `lmodified_id` int(3) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `report`, `user_id`, `agro_id`, `day_week`, `created_at`, `updated_at`, `status`, `prog_status`, `lmodified_id`) VALUES
(1, 'We move pass the stage', 1, 1, '2018-07-27', '2018-07-24 15:20:04', '2018-07-25 02:33:21', 'Pipeline', 'Pending', NULL),
(2, 'hjfjenmfefjeghb', 1, 1, '2018-07-24', '2018-07-24 16:55:06', '2018-07-24 16:55:06', 'Perpetual', 'Pending', NULL),
(3, 'The s', 1, 1, '2018-07-31', '2018-07-30 16:22:42', '2018-07-30 16:22:42', 'Perpetual', '80%', NULL),
(4, 'TYGEHGnbsjdhw', 1, 1, '2018-07-31', '2018-07-30 16:58:34', '2018-07-30 16:58:34', 'Perpetual', '30%', NULL),
(5, 'This is a progress', 1, 2, '2018-07-31', '2018-07-31 11:48:26', '2018-07-31 11:48:26', 'Perpetual', '50%', NULL),
(6, 'schnmhefjekhfe', 1, 3, '2018-08-23', '2018-08-01 02:42:56', '2018-08-01 02:42:56', 'Prospect', '70%', NULL),
(9, 'wwhjdwe', 1, 10, '2018-08-23', '2018-08-06 13:45:29', '2018-08-06 13:45:29', 'Perpetual', '0%', NULL),
(10, 'wwdwd', 1, 10, '2018-08-22', '2018-08-06 13:45:45', '2018-08-06 13:45:45', 'Perpetual', '0%', NULL),
(11, 'fvfdgrrgr', 1, 10, '2018-08-25', '2018-08-14 11:43:37', '2018-08-14 11:43:37', 'Perpetual', '0%', NULL),
(12, 'test demo report here ...', 1, 24, '2019-03-29', '2019-03-29 05:32:51', '2019-03-29 05:32:51', 'Perpetual', '100', NULL),
(13, 'another test report', 1, 26, '2019-03-29', '2019-03-29 05:35:11', '2019-03-29 05:35:11', 'Perpetual', '100', NULL),
(14, 'new report at 80% completion level.', 1, 26, '2019-03-29', '2019-03-29 05:55:44', '2019-03-29 05:55:44', 'Prospect', '80', NULL),
(15, 'another report at 75% completion', 1, 21, '2019-03-29', '2019-03-29 05:59:29', '2019-03-29 05:59:29', 'Prospect', '75', NULL),
(16, 'reporting at 55% completion', 1, 20, '2019-03-29', '2019-03-29 06:02:18', '2019-03-29 06:02:18', 'Perpetual', '55', NULL),
(17, 'Reporting at 85% completion', 1, 20, '2019-03-29', '2019-03-29 06:02:42', '2019-03-29 06:02:42', 'Perpetual', '85', NULL),
(18, 'another report at 33% level', 1, 24, '2019-03-29', '2019-03-29 07:43:00', '2019-03-29 07:43:00', 'Perpetual', '33', NULL),
(19, 'test', 1, 25, '2019-03-29', '2019-03-29 13:36:45', '2019-03-29 13:36:45', 'Perpetual', '81', NULL),
(20, 'test', 1, 10, '2019-03-29', '2019-03-29 13:38:58', '2019-03-29 13:38:58', 'Perpetual', '43', NULL),
(21, 'my report', 1, 23, '2019-03-30', '2019-03-30 04:55:18', '2019-03-30 04:55:18', 'Perpetual', '33', NULL),
(22, 'Report reviewed', 1, 26, '2019-03-30', '2019-03-30 08:38:11', '2019-03-30 08:38:11', 'Perpetual', '65', NULL),
(23, 'my test report....', 9, 27, '2019-03-31', '2019-03-31 00:22:22', '2019-04-01 03:24:27', 'Perpetual', '61', NULL),
(24, 'test 11 report.', 9, 27, '2019-03-31', '2019-03-31 11:35:36', '2019-04-01 03:24:03', 'Perpetual', '15', NULL),
(25, 'my test report', 9, 27, '2019-03-31', '2019-03-31 11:35:49', '2019-03-31 11:35:49', 'Perpetual', '59', NULL),
(26, 'hvhjvv', 9, 27, '2019-03-31', '2019-03-31 11:40:31', '2019-03-31 11:40:31', 'Perpetual', '78', NULL),
(27, 'a new report...modified.', 9, 27, '2019-04-01', '2019-04-01 03:24:43', '2019-04-01 03:56:33', 'Prospect', '19', NULL),
(28, 'another new report status...', 9, 27, '2019-04-01', '2019-04-01 03:25:06', '2019-04-01 03:25:06', 'Perpetual', '16', NULL),
(31, 'new report', 9, 27, '2019-04-01', '2019-04-01 03:29:36', '2019-04-01 03:29:36', 'Perpetual', '34', NULL),
(32, 'test report.', 9, 27, '2019-04-01', '2019-04-01 08:09:06', '2019-04-01 08:12:19', 'Perpetual', '56', NULL),
(34, 'another test report at 75%', 9, 27, '2019-04-01', '2019-04-01 08:11:51', '2019-04-01 08:11:51', 'Perpetual', '75', NULL),
(35, 'test report', 1, 26, '2019-04-01', '2019-04-01 10:50:01', '2019-04-01 10:50:01', 'Prospect', '32', NULL),
(36, 'test report', 1, 26, '2019-04-01', '2019-04-01 11:24:08', '2019-04-01 11:24:08', 'Perpetual', '80', NULL),
(37, 'new report', 1, 22, '2019-04-02', '2019-04-02 13:21:37', '2019-04-02 13:21:37', 'Perpetual', '63', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'sector 1. old updated.123---=', '2019-03-25 11:03:57', '2019-04-02 12:59:56'),
(2, 'sector 2.', '2019-03-25 11:04:07', '2019-03-25 11:04:07'),
(3, 'sector 3.', '2019-03-25 11:04:12', '2019-03-25 11:04:12'),
(4, 'sector 4.', '2019-03-25 11:04:18', '2019-03-25 11:04:18'),
(13, 'test name', '2019-03-26 05:49:41', '2019-03-26 05:49:41'),
(8, 'sector 900024.1', '2019-03-25 11:05:10', '2019-04-02 13:01:03'),
(9, 'sector 19.1....ABC.....XYZ', '2019-03-25 11:14:21', '2019-04-02 12:48:31'),
(10, 'New Sector.000123', '2019-03-25 21:23:01', '2019-04-02 12:47:28'),
(12, 'nhvhgvh...123', '2019-03-25 21:23:54', '2019-03-28 09:33:17'),
(14, 'New Sector to be added.-----123', '2019-04-02 12:48:06', '2019-04-02 12:48:17'),
(15, 'another new sector added.', '2019-04-02 12:49:01', '2019-04-02 12:49:01'),
(16, 'new app123--090', '2019-04-02 13:00:23', '2019-04-02 13:00:49'),
(17, 'another app 567.', '2019-04-02 13:00:36', '2019-04-02 13:00:36'),
(18, 'another post app....???', '2019-04-02 13:01:24', '2019-04-02 13:02:33'),
(21, 'another post app....??? added', '2019-04-02 13:10:21', '2019-04-02 13:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(166) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'prime_osp'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `type`) VALUES
(1, 'Olorunda Olaoluwa23', 'olorundaolaoluwa@gmail.com', '$2y$10$MAM5qYj1JShPgVI1ggztVujcvTzURP0e6kWJthaFxbDb4L8xbLWWC', 'ZOHZxXnzn43B4h6jvt4e4CBfCuUtH6vFknPSU7DZsiNNupDIrjcZZSCd1gLE', '2018-07-24 08:21:49', '2019-03-28 15:05:03', 'prime_admin'),
(2, 'John Doer', 'john@gmail.com', '$2y$10$MAM5qYj1JShPgVI1ggztVujcvTzURP0e6kWJthaFxbDb4L8xbLWWC', NULL, '2018-07-24 08:21:49', '2019-03-26 21:54:42', 'prime_admin'),
(3, 'Jane Doe Updated.', 'jane@gmail.com', '$2y$10$VgTqtEp4D0Hi.UZMG6iUBeju8OJNIFamZ3EA5iT4N1JVCrT.wuFKK', 'q3M2I9AdHHkS8xjBgVPvOrT6vci1txnC1nAPJ11wfx8Q7oq8tNn8LTWPvOlW', '2018-07-25 01:33:29', '2019-03-26 22:39:34', 'prime_admin'),
(4, 'Operation Rep 2', 'test@domain.com', '$2y$10$0rDuTiGDc/JmibddAdFlmeq7nx8lIKIU2QIDaw59pzRZjq1mlCW4S', NULL, '2019-03-26 08:04:35', '2019-03-27 07:56:38', 'prime_osp'),
(5, 'Operation Rep 1', 'test5@domain.com', '$2y$10$0qQpkWZKd.cp7uvyHtWUz.agpY3EVmeM/.hivyjSMPJsfvNKtKcH2', NULL, '2019-03-26 08:24:41', '2019-03-27 07:56:18', 'prime_osp'),
(6, 'test-user,,,,,', 'd@f.cl', '$2y$10$mnBUarqM2TeE5.x1yQtrU.HPY4i9wcgr0NB3jqYq2bW4QR3A1OmTO', NULL, '2019-03-26 21:56:38', '2019-03-27 04:57:52', 'prime_admin'),
(7, 'Akamukali Nnamdi Alexander', 'easymagic1@gmail.com', '$2y$10$.HRd2tBsK8a6RxW5ggZHu.uoeW1rQNiiPu1POcIeE/9amWPaoJpoW', NULL, '2019-03-26 22:43:56', '2019-03-27 07:54:16', 'prime_osp'),
(8, 'Ola Updated', 'olorundaolaoluwa21@gmail.com', '$2y$10$DqX2GvrlQopHg7V8PwIjuugA2pl1UOLcpLO3hG52UfhlnViSyGCHC', NULL, '2019-03-28 15:05:41', '2019-03-28 15:20:35', 'prime_osp'),
(9, 'User OSP 1', 'osp1@pa.com', '$2y$10$nqqZCOZDDr32oawCPmtPw.ijAL.fcvELu1PBYV6xMIU7lrnICUnfy', 'Lw7B2zfR6JyNw4nweWKpCdPoW0PhIEDjl2rmmbV7S0qUjn3SymzsRNUhGQfu', '2019-03-30 21:59:59', '2019-03-30 21:59:59', 'prime_osp'),
(10, 'User OSP 2', 'osp2@pa.com', '$2y$10$wZ63Jn9wrJZIP1eXiGsXTeqREp3rZf5MvflIdhLTD56hiZxAcTi3e', NULL, '2019-03-30 22:00:30', '2019-03-30 22:00:39', 'prime_osp'),
(11, 'User ADM 1', 'adm1@pa.com', '$2y$10$99O5dsu1ge1bGeZDC/.lPOdCWyuPaQ5G8dXIhJeTlGC0p.OdvsWYO', 'j5cIqFDl7rlNQnnxi3uYZ4KNgIdOGBUuRkn2R341LFC3NxW8yJxz4LuiJB4n', '2019-03-30 22:01:30', '2019-04-01 15:19:51', 'prime_admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agrolytics`
--
ALTER TABLE `agrolytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_names`
--
ALTER TABLE `group_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agrolytics`
--
ALTER TABLE `agrolytics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `group_names`
--
ALTER TABLE `group_names`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
