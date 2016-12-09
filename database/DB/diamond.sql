-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2016 at 12:37 PM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diamond`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sheba` varchar(100) DEFAULT NULL,
  `card_no` varchar(100) DEFAULT NULL,
  `bank_name` varchar(250) DEFAULT NULL,
  `account_no` varchar(250) DEFAULT NULL,
  `beneficiary` varchar(250) DEFAULT NULL,
  `meta` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `user_id`, `sheba`, `card_no`, `bank_name`, `account_no`, `beneficiary`, `meta`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 6, 'IRS234', NULL, 'مسکن', '123', 'طه مهدی کامکار', '{"branch_name":"\\u0634\\u0639\\u0628\\u0647 \\u0646\\u06cc\\u0627\\u0648\\u0631\\u0627\\u0646","branch_code":"\\u06f1\\u06f2\\u06f3\\u06f1"}', '2016-10-21 10:46:46', '2016-11-13 09:42:58', NULL, 1, NULL, NULL),
(2, 0, 'IR18923902138019123098', NULL, 'اقتصاد نوین', '12312312313', 'جعفر اسکندریی', '{"branch_name":"\\u0635\\u0628\\u0627","branch_code":"\\u06f3\\u06f1"}', '2016-11-15 20:09:17', '2016-11-15 20:35:14', NULL, 1, NULL, NULL),
(3, 6, 'IRS234', '6219432312322332', 'سامان', '۱۲۳۴', 'سینا حجازی', '{"branch_name":"\\u0634\\u0639\\u0628\\u0647 \\u0646\\u06cc\\u0627\\u0648\\u0631\\u0627\\u0646","branch_code":"\\u06f1\\u06f2\\u06f3\\u06f1"}', '2016-10-21 10:46:46', '2016-10-21 10:46:46', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE IF NOT EXISTS `branches` (
  `id` int(11) unsigned NOT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `plural_title` varchar(250) DEFAULT NULL,
  `singular_title` varchar(250) DEFAULT NULL,
  `header_title` varchar(250) DEFAULT NULL,
  `template` varchar(250) DEFAULT NULL,
  `hint` varchar(250) DEFAULT '',
  `allowed_meta` varchar(250) DEFAULT '',
  `features` varchar(250) DEFAULT '',
  `icon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `slug`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `plural_title`, `singular_title`, `header_title`, `template`, `hint`, `allowed_meta`, `features`, `icon`) VALUES
(1, 'statics', '2016-10-12 12:58:18', '2016-11-26 08:27:11', NULL, 1, NULL, NULL, 'صفحات ایستا', 'صفحه‌ی ایستا', 'بخش فارسی', 'post', '', '', 'title , header , text , abstract , image , category ', 'file-text-o'),
(2, 'blog', '2016-10-15 00:32:22', '2016-10-16 11:06:28', NULL, 1, NULL, NULL, 'مطالب فارسی', 'مطلب', 'بخش فارسی', 'post', '', 'title2:text', 'image, text , abstract , rss , comment  , category , searchable , preview , digest , schedule , keyword , title , header , gallery', 'file-text-o');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) unsigned NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `abstract` longtext,
  `hint` varchar(250) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `slug`, `title`, `abstract`, `hint`, `image`, `created_at`, `updated_at`, `created_by`, `updated_by`, `branch_id`) VALUES
(2, NULL, 'info', 'اطلاعات عمومی', NULL, NULL, '', '2016-10-12 15:34:30', '2016-10-15 00:35:58', 1, NULL, 2),
(3, NULL, 'persian_static_pages', 'صفحات ایستا فارسی', NULL, NULL, '', '2016-11-26 08:28:00', '2016-11-26 08:28:00', 4, NULL, 1),
(4, NULL, 'english_static_pages', 'صفحات ایستا انگلیسی', NULL, NULL, '', '2016-11-26 08:33:32', '2016-11-26 08:33:32', 4, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) unsigned NOT NULL,
  `slug` varchar(10) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `meta` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `slug`, `title`, `meta`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(2, 'USD', 'دلار آمریکا', '[]', '2016-10-21 15:53:54', '2016-10-29 13:06:38', NULL, 1, NULL, 3),
(3, 'EUR', 'یورو', '"[]"', '2016-10-21 15:54:07', '2016-10-21 15:54:07', NULL, 1, NULL, NULL),
(4, 'UAD', 'درهم امارات متحده عربی', '[]', '2016-10-21 15:54:36', '2016-10-26 14:49:24', NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(250) DEFAULT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `can_online` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `title`, `slug`, `icon`, `can_online`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, 'واحد فروش', 'sales', 'shopping-basket', 1, '2016-10-23 20:18:17', '2016-10-23 20:20:33', NULL, 1, NULL, NULL),
(2, 'خدمات', 'services', 'ambulance', 0, '2016-10-23 20:22:01', '2016-10-23 20:22:01', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE IF NOT EXISTS `logins` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `IP` varchar(250) DEFAULT NULL,
  `browser` varchar(250) DEFAULT NULL,
  `os` varchar(250) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) unsigned NOT NULL,
  `slug` varchar(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `card_id` int(11) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `original_invoice` int(11) NOT NULL,
  `amount_invoiced` int(11) NOT NULL DEFAULT '0',
  `amount_paid` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `meta` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `slug`, `user_id`, `product_id`, `card_id`, `type`, `original_invoice`, `amount_invoiced`, `amount_paid`, `status`, `meta`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, '14250848', 5, 1, NULL, 'new', 3234000, 3234000, 3224000, 1, '{"rate":"14000","initial_charge":"231"}', '2016-10-24 15:46:53', '2016-11-20 15:49:03', NULL, 5, NULL, NULL),
(3, '14250812', 5, 1, NULL, 'new', 4354000, 4350000, NULL, 2, '{"rate":"14000","initial_charge":"311"}', '2016-11-14 15:20:34', '2016-11-19 16:04:29', NULL, 1, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) unsigned NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `amount_declared` int(11) NOT NULL DEFAULT '0',
  `amount_confirmed` int(11) NOT NULL DEFAULT '0',
  `payment_method` varchar(20) DEFAULT '',
  `direction` varchar(100) DEFAULT NULL COMMENT 'charge / pay',
  `meta` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `checked_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `checked_by` int(11) NOT NULL DEFAULT '0',
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `user_id`, `amount_declared`, `amount_confirmed`, `payment_method`, `direction`, `meta`, `created_at`, `updated_at`, `checked_at`, `deleted_at`, `created_by`, `updated_by`, `checked_by`, `deleted_by`) VALUES
(1, 1, 5, 1000, 2000, 'site_credit', 'income', '{"payment_date":"2016\\/11\\/17 12:32","account_no":"","bank_name":"","card_no":"","own_account_id":"","depositor":"","receiver":"\\u062c\\u0639\\u0641\\u0631","sender":"\\u0627\\u0635\\u063a\\u0631","tracking_no":"","cheque_date":"","cheque_no":"","description":"\\u0622\\u0632\\u0645\\u0627\\u06cc\\u0634 \\u0627\\u0648\\u0644\\u06cc\\u0647"}', '2016-11-17 20:32:55', '2016-11-17 20:32:55', '2016-11-17 20:32:55', NULL, 1, NULL, 1, NULL),
(2, 1, 5, 10000, 10000, 'site_credit', 'outcome', '{"payment_date":"","account_no":"","bank_name":"","card_no":"","own_account_id":"","depositor":"","receiver":"","sender":"","tracking_no":"","cheque_date":"","cheque_no":"","description":""}', '2016-11-18 04:22:49', '2016-11-18 20:02:32', '2016-11-18 20:02:32', NULL, 1, NULL, 1, NULL),
(3, 1, 5, 3000, 2000, 'site_credit', 'income', '{"payment_date":"","account_no":"","bank_name":"","card_no":"","own_account_id":"","depositor":"","receiver":"","sender":"","tracking_no":"","cheque_date":"","cheque_no":"","description":"\\u062a\\u0648\\u0636\\u06cc\\u062d\\u0627\\u062a"}', '2016-11-18 04:33:41', '2016-11-18 06:32:35', '2016-11-18 04:33:41', NULL, 1, NULL, 1, NULL),
(4, 1, 5, 10000, 10000, 'cash', 'income', '{"payment_date":"2016-11-17 12:24","account_no":"","bank_name":"","card_no":"","own_account_id":"","depositor":"","receiver":"\\u062d\\u0633\\u0646\\u0639\\u0644\\u06cc","sender":"\\u062c\\u0639\\u0641\\u0631","tracking_no":"","cheque_date":"","cheque_no":"","description":"\\u062f\\u0631\\u06cc\\u0627\\u0641\\u062a \\u0627\\u0632 \\u062d\\u0633\\u0646\\u0639\\u0644\\u06cc \\u0628\\u0647 \\u062c\\u0639\\u0641\\u0631. \\u0631\\u0648\\u0632 \\u06f2\\u06f8 \\u0622\\u0628\\u0627\\u0646\\u060c \\u0633\\u0627\\u0639\\u062a \\u06f1\\u06f2:\\u06f2\\u06f3"}', '2016-11-18 06:35:52', '2016-11-18 20:02:20', '2016-11-18 20:02:20', NULL, 1, NULL, 1, NULL),
(5, 1, 5, 10000, 1742, 'shetab', 'income', '{"payment_date":"2016\\/10\\/22 23:12","account_no":"","bank_name":"","card_no":"6219862302302023","own_account_id":"2","depositor":"","receiver":"","sender":"","tracking_no":"\\u06f1\\u06f2\\u06f3\\u06f4\\u06f5\\u06f6\\u06f7\\u06f8\\u06f9\\u06f0","cheque_date":"","cheque_no":"","description":""}', '2016-11-18 07:08:39', '2016-11-18 19:47:24', '2016-11-18 19:47:24', NULL, 1, NULL, 1, NULL),
(6, 1, 5, 3208258, 3208258, 'cheque', 'income', '{"payment_date":"","account_no":"\\u06f1\\u06f2\\u06f3\\u06f1\\u06f2\\u06f3\\u06f1\\u06f2\\u06f3\\u06f1\\u06f3","bank_name":"\\u0628\\u0627\\u0646\\u06a9 \\u0633\\u0631\\u0645\\u0627\\u06cc\\u0647","card_no":"","own_account_id":"2","depositor":"","receiver":"","sender":"","tracking_no":"","cheque_date":"2016\\/10\\/22","cheque_no":"\\u06f1\\u06f2\\u06f3","description":""}', '2016-11-18 20:32:23', '2016-11-18 20:37:56', '2016-11-18 20:37:56', NULL, 1, NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) unsigned NOT NULL,
  `branch` varchar(100) NOT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `abstract` longtext,
  `text` longtext,
  `category_id` int(11) NOT NULL,
  `keywords` longtext CHARACTER SET utf8 COLLATE utf8_bin,
  `featured_image` varchar(250) DEFAULT NULL,
  `is_draft` tinyint(1) NOT NULL DEFAULT '0',
  `meta` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `published_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `branch`, `slug`, `title`, `abstract`, `text`, `category_id`, `keywords`, `featured_image`, `is_draft`, `meta`, `created_at`, `updated_at`, `deleted_at`, `published_at`, `created_by`, `updated_by`, `deleted_by`, `published_by`) VALUES
(2, 'blog', '', 'آذربایجان شرقی', 'چکیده۲', '<p>متن</p>', 2, 'کلیدواژه', '', 1, '{"title2":"assets\\/photos\\/posts\\/CjhuijfXEAEQ8UW.jpg","post_photos":[{"src":"\\/assets\\/photos\\/posts\\/photo_2016-10-08_00-48-16.jpg","label":"\\u0639\\u06a9\\u0633 \\u0637\\u0627\\u0647\\u0627","link":"\\u0644\\u06cc\\u0646\\u06a9 \\u0637\\u0627\\u0647\\u0627"}]}', '2016-10-15 14:43:12', '2016-11-13 10:12:24', NULL, NULL, 1, NULL, 1, NULL),
(3, 'Foolan', 'test', NULL, NULL, NULL, 0, NULL, NULL, 0, '{"seyed":"ali","folan":"124"}', '2016-10-16 02:34:18', '2016-10-16 04:42:47', NULL, NULL, 1, NULL, NULL, NULL),
(4, 'foolan', NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, '"[]"', '2016-10-16 04:22:11', '2016-10-16 04:22:11', NULL, NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) unsigned NOT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `description` text,
  `currency` varchar(5) DEFAULT NULL,
  `card_price` decimal(15,0) NOT NULL DEFAULT '0',
  `initial_charge` int(9) NOT NULL DEFAULT '0',
  `inventory` int(9) NOT NULL DEFAULT '0',
  `inventory_low_alarm` int(9) NOT NULL DEFAULT '0',
  `inventory_low_action` int(9) NOT NULL DEFAULT '0',
  `meta` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `slug`, `title`, `description`, `currency`, `card_price`, `initial_charge`, `inventory`, `inventory_low_alarm`, `inventory_low_action`, `meta`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`) VALUES
(1, NULL, 'کارت طلایی زمرد', 'این کارت قابلیت برداشت و شارژ نقدی را ندارد.', 'USD', '100000', 200, 3, 20, 10, '{"image":"assets\\/photos\\/posts\\/24k-prepaid-visa-rushcard-081716.png","max_purchasable":"0","is_extensible":"0","min_charge":"100","max_charge":"500","is_rechargeable":"0","expiry":"12"}', '2016-11-05 21:31:41', '2016-11-12 00:40:50', NULL, 1, NULL, 1),
(2, NULL, 'کارت طلایی جاویدان', 'با این کارت می‌توانید درهم امارات را خرید و فروش نمایید.', 'UAD', '70000', 40000, 5000, 30, 10, '{"image":"assets\\/photos\\/posts\\/24k-prepaid-visa-rushcard-081716.png","max_purchasable":"1","is_extensible":"1","min_charge":"20000","max_charge":"40000","is_rechargeable":"1","expiry":"0"}', '2016-11-06 21:15:40', '2016-11-13 10:17:52', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) unsigned NOT NULL,
  `currency_id` int(11) NOT NULL,
  `price_to_buy` decimal(10,0) DEFAULT NULL,
  `price_to_sell` decimal(10,0) DEFAULT NULL,
  `meta` longtext,
  `effective_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `currency_id`, `price_to_buy`, `price_to_sell`, `meta`, `effective_date`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 4, '12150', '12160', '"[]"', '2016-10-21 09:29:00', '2016-10-21 20:40:53', '2016-10-21 20:40:53', 1, NULL),
(2, 2, '10000', '12000', '"[]"', '2016-10-21 20:59:54', '2016-10-21 20:59:54', '2016-10-21 20:59:54', 1, NULL),
(3, 2, '12000', '14000', '"[]"', '2016-10-21 22:10:00', '2016-10-21 21:00:20', '2016-10-21 21:00:20', 1, NULL),
(4, 2, '20000', '20001', '"[]"', '2016-09-21 20:30:00', '2016-10-21 21:54:06', '2016-10-21 21:54:06', 1, NULL),
(5, 4, '12150', '12161', '"[]"', '2016-10-26 14:48:55', '2016-10-26 14:48:55', '2016-10-26 14:48:55', 1, NULL),
(6, 4, '12150', '12162', '"[]"', '2016-10-26 14:50:33', '2016-10-26 14:50:33', '2016-10-26 14:50:33', 1, NULL),
(7, 4, '12150', '13142', '"[]"', '2016-10-26 14:59:34', '2016-10-26 14:59:34', '2016-10-26 14:59:34', 1, NULL),
(8, 3, '45000', '47000', '"[]"', '2016-11-09 11:34:04', '2016-11-09 11:34:04', '2016-11-09 11:34:04', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) unsigned NOT NULL,
  `slug` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `category` varchar(250) DEFAULT NULL,
  `data_type` varchar(250) DEFAULT NULL,
  `default_value` longtext,
  `custom_value` longtext,
  `developers_only` tinyint(1) NOT NULL,
  `is_resident` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `slug`, `title`, `category`, `data_type`, `default_value`, `custom_value`, `developers_only`, `is_resident`, `created_at`, `updated_at`) VALUES
(1, 'working_hours_begin', 'شروع ساعت اداری', 'template', 'text', '۱۱', '۱۱', 0, 0, NULL, '2016-10-21 06:08:56'),
(2, 'working_hours_end', 'پایان ساعت اداری', 'template', 'text', '', '', 0, 0, NULL, '2016-10-21 06:08:56'),
(3, 'working_days', 'روزهای کاری', 'template', 'text', 'tue', 'wed', 1, 0, NULL, '2016-10-14 05:08:07'),
(4, 'slogan', 'شعار سایت', 'template', 'textarea', 'هر زمان که از من خواسته شد، در شنیدن، ایجاد ارتباط و دادن توصیه‌ای که مفید می‌دانم به کارآفرینان دریغ نکنم.', 'هر زمان که از من خواسته شد، در شنیدن، ایجاد ارتباط و دادن توصیه‌ای که مفید می‌دانم به کارآفرینان دریغ نکنم.', 0, 0, '2016-10-14 12:00:58', '2016-10-21 06:07:43'),
(5, 'overall_power', 'فعالیت سایت', 'template', 'boolean', '0', '0', 0, 0, '2016-10-14 12:09:03', '2016-10-14 12:10:33'),
(6, 'site-opening', 'تاریخ افتتاح سایت', 'template', 'date', '2016-09-25', '2016-09-25', 0, 0, '2016-10-14 12:11:10', '2016-10-21 06:07:43'),
(7, 'site_logo', 'لوگوی سایت', 'template', 'photo', 'assets/photos/posts/CjhuijfXEAEQ8UW.jpg', 'assets/photos/posts/CjhuijfXEAEQ8UW.jpg', 0, 0, '2016-10-14 12:13:30', '2016-10-21 06:07:43'),
(8, 'register_firms', 'سازمان‌های ثبت شرکت', 'database', 'array', 'سازمان ثبت اسناد و املاک کشور\r\nسازمان مدیریت و برنامه‌ریزی کشور\r\nاتاق بازرگانی، صنایع، معادن و کشاورزی جمهوری اسلامی ایران\r\nوزارت کشور ـ‌ شهرداری‌ها و دهیاری‌ها\r\nسازمان اوقاف و امور خیریه ـ بقعه\r\nسازمان اوقاف و امور خیریه ـ موقوفات\r\nحوزه‌ی علمیه\r\nوزارت آموزش و پرورش\r\nوزارت امور اقتصادی و دارایی\r\nوزارت تعاون، کار و رفاه اجتماعی\r\nوزارت بهداشت، درمان و آموزش پزشکی\r\nوزارت جهاد کشاورزی\r\nوزارت ارتباطات و فناوری اطلاعات\r\nوزارت جهاد کشاورزی\r\nوزارت ارتباطات و فناوری اطلاعات\r\nوزارت راه و شهرسازی\r\nشورای عالی مناطق آزاد', 'سازمان ثبت اسناد و املاک کشور\r\nسازمان مدیریت و برنامه‌ریزی کشور\r\nاتاق بازرگانی، صنایع، معادن و کشاورزی جمهوری اسلامی ایران\r\nوزارت کشور ـ‌ شهرداری‌ها و دهیاری‌ها\r\nسازمان اوقاف و امور خیریه ـ بقعه\r\nسازمان اوقاف و امور خیریه ـ موقوفات\r\nحوزه‌ی علمیه\r\nوزارت آموزش و پرورش\r\nوزارت امور اقتصادی و دارایی\r\nوزارت تعاون، کار و رفاه اجتماعی\r\nوزارت بهداشت، درمان و آموزش پزشکی\r\n\r\nوزارت جهاد کشاورزی\r\nوزارت ارتباطات و فناوری اطلاعات\r\nوزارت جهاد کشاورزی\r\nوزارت ارتباطات و فناوری اطلاعات\r\n\r\nوزارت راه و شهرسازی\r\nشورای عالی مناطق آزاد', 0, 1, '2016-10-19 04:48:13', '2016-10-21 05:43:40'),
(9, 'familization', 'نحوه‌ی آشنایی', 'database', 'array', 'دوست‌ها و آشنایان\r\nآگهی‌های تبلیغاتی\r\nرسانه‌های خبری\r\nشبکه‌های اجتماعی\r\nجست‌وجوی اینترنتی\r\nراه‌های دیگر', 'دوست‌ها و آشنایان\r\nآگهی‌های تبلیغاتی\r\nرسانه‌های خبری\r\nشبکه‌های اجتماعی\r\nجست‌وجوی اینترنتی\r\nراه‌های دیگر', 0, 1, '2016-10-19 06:00:03', '2016-10-21 06:14:13'),
(10, 'banks', 'بانک‌های کشور', 'database', 'array', NULL, 'ملی ایران\r\nملت\r\nسرمایه\r\nپاسارگاد\r\nحکمت ایرانیان\r\nسامان\r\nسپه\r\nتجارت\r\nصادرات ایران\r\nتوسعه صادرات ایران\r\nپست بانک\r\nاقتصاد نوین\r\nپارسیان\r\nصنعت و معدن\r\nمسکن\r\nکشاورزی\r\nرفاه', 0, 1, '2016-10-21 06:12:30', '2016-10-21 06:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `capital_id` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=475 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `title`, `parent_id`, `capital_id`) VALUES
(1, '2016-07-07 00:27:55', '2016-10-11 13:52:14', NULL, NULL, NULL, NULL, 'آذربایجان شرقی', 0, 37),
(2, '2016-07-07 00:27:55', '2016-10-04 16:30:48', NULL, NULL, NULL, NULL, 'آذربایجان غربی', 0, 52),
(3, '2016-07-07 00:27:55', '2016-07-12 05:21:29', NULL, NULL, NULL, NULL, 'اردبیل', 0, 69),
(4, '2016-07-07 00:27:55', '2016-07-07 01:35:19', NULL, NULL, NULL, NULL, 'اصفهان', 0, 81),
(5, '2016-07-07 00:27:55', '2016-07-07 01:35:30', NULL, NULL, NULL, NULL, 'البرز', 0, 108),
(6, '2016-07-07 00:27:55', '2016-07-07 01:36:45', NULL, NULL, NULL, NULL, 'ایلام', 0, 111),
(7, '2016-07-07 00:27:55', '2016-07-07 01:37:21', NULL, NULL, NULL, NULL, 'بوشهر', 0, 120),
(8, '2016-07-07 00:27:55', '2016-07-07 01:35:43', NULL, NULL, NULL, NULL, 'تهران', 0, 135),
(9, '2016-07-07 00:27:55', '2016-07-07 01:44:34', NULL, NULL, NULL, NULL, 'چهار محال و بختیاری', 0, 150),
(10, '2016-07-07 00:27:55', '2016-07-07 01:42:54', NULL, NULL, NULL, NULL, 'خراسان جنوبی', 0, 156),
(11, '2016-07-07 00:27:55', '2016-07-07 01:36:05', NULL, NULL, NULL, NULL, 'خراسان رضوی', 0, 191),
(12, '2016-07-07 00:27:55', '2016-07-07 01:43:03', NULL, NULL, NULL, NULL, 'خراسان شمالی', 0, 195),
(13, '2016-07-07 00:27:55', '2016-07-07 01:37:45', NULL, NULL, NULL, NULL, 'خوزستان', 0, 207),
(14, '2016-07-07 00:27:55', '2016-07-07 01:35:55', NULL, NULL, NULL, NULL, 'زنجان', 0, 233),
(15, '2016-07-07 00:27:55', '2016-07-07 01:38:00', NULL, NULL, NULL, NULL, 'سمنان', 0, 239),
(16, '2016-07-07 00:27:55', '2016-07-07 01:41:36', NULL, NULL, NULL, NULL, 'سیستان و بلوچستان', 0, 249),
(17, '2016-07-07 00:27:55', '2016-07-07 01:35:49', NULL, NULL, NULL, NULL, 'فارس', 0, 278),
(18, '2016-07-07 00:27:55', '2016-07-07 01:38:21', NULL, NULL, NULL, NULL, 'قزوین', 0, 297),
(19, '2016-07-07 00:27:55', '2016-07-07 01:35:36', NULL, NULL, NULL, NULL, 'قم', 0, 298),
(20, '2016-07-07 00:27:55', '2016-07-07 01:42:30', NULL, NULL, NULL, NULL, 'کردستان', 0, 305),
(21, '2016-07-07 00:27:55', '2016-07-07 01:39:03', NULL, NULL, NULL, NULL, 'کرمان', 0, 327),
(22, '2016-07-07 00:27:55', '2016-07-07 01:39:23', NULL, NULL, NULL, NULL, 'کرمانشاه', 0, 342),
(23, '2016-07-07 00:27:55', '2016-07-07 01:46:59', NULL, NULL, NULL, NULL, 'کهگیلویه و بویراحمد', 0, 474),
(24, '2016-07-07 00:27:55', '2016-07-07 01:41:14', NULL, NULL, NULL, NULL, 'گلستان', 0, 363),
(25, '2016-07-07 00:27:55', '2016-07-07 01:40:12', NULL, NULL, NULL, NULL, 'گیلان', 0, 372),
(26, '2016-07-07 00:27:55', '2016-07-07 01:42:08', NULL, NULL, NULL, NULL, 'لرستان', 0, 388),
(27, '2016-07-07 00:27:55', '2016-07-07 01:40:19', NULL, NULL, NULL, NULL, 'مازندران', 0, 403),
(28, '2016-07-07 00:27:55', '2016-07-07 01:40:34', NULL, NULL, NULL, NULL, 'مرکزی', 0, 418),
(29, '2016-07-07 00:27:55', '2016-07-07 01:40:48', NULL, NULL, NULL, NULL, 'هرمزگان', 0, 432),
(30, '2016-07-07 00:27:55', '2016-07-07 01:39:40', NULL, NULL, NULL, NULL, 'همدان', 0, 450),
(31, '2016-07-07 00:27:55', '2016-07-07 01:39:45', NULL, NULL, NULL, NULL, 'یزد', 0, 460),
(32, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'آذرشهر', 1, NULL),
(33, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'اسکو', 1, NULL),
(34, '2016-07-07 00:27:55', '2016-10-11 15:16:51', NULL, NULL, NULL, NULL, 'اهر', 1, NULL),
(35, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'بستان آباد', 1, NULL),
(36, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'بناب', 1, NULL),
(37, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'تبریز', 1, NULL),
(38, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'جلفا', 1, NULL),
(39, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'چاراویماق', 1, NULL),
(40, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'خدا آفرین', 1, NULL),
(41, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'سراب', 1, NULL),
(42, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'شبستر', 1, NULL),
(43, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'عجب شیر', 1, NULL),
(44, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'کلیبر', 1, NULL),
(45, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'مراغه', 1, NULL),
(46, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'مرند', 1, NULL),
(47, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'ملکان', 1, NULL),
(48, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'میانه', 1, NULL),
(49, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'ورزقان', 1, NULL),
(50, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'هریس', 1, NULL),
(51, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'هشترود', 1, NULL),
(52, '2016-07-07 00:27:55', '2016-10-04 16:13:47', NULL, NULL, NULL, NULL, 'ارومیه', 2, NULL),
(53, '2016-07-07 00:27:55', '2016-07-10 11:50:13', NULL, NULL, NULL, NULL, 'اشنویه', 2, NULL),
(54, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'بوکان', 2, NULL),
(55, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'پلدشت', 2, NULL),
(56, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'پیرانشهر', 2, NULL),
(57, '2016-07-07 00:27:55', '2016-10-04 16:29:20', NULL, NULL, NULL, NULL, 'تکاب', 2, NULL),
(58, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'چالدران', 2, NULL),
(59, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'چایپاره', 2, NULL),
(60, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'خوی', 2, NULL),
(61, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'سر دشت', 2, NULL),
(62, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'سلماس', 2, NULL),
(63, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'شاهین دژ', 2, NULL),
(64, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'شوط', 2, NULL),
(65, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'ماکو', 2, NULL),
(66, '2016-07-07 00:27:55', '2016-07-07 01:23:08', NULL, NULL, NULL, NULL, 'مهاباد', 2, NULL),
(67, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'میاندوآب', 2, NULL),
(68, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نقده', 2, NULL),
(69, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اردبیل', 3, NULL),
(70, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بیله سوار', 3, NULL),
(71, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'پارس آباد', 3, NULL),
(72, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خلخال', 3, NULL),
(73, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سرعین', 3, NULL),
(74, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کوثر', 3, NULL),
(75, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گرمی', 3, NULL),
(76, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مشگین شهر', 3, NULL),
(77, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نمین', 3, NULL),
(78, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نیر', 3, NULL),
(79, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'آران و بیدگل', 4, NULL),
(80, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اردستان', 4, NULL),
(81, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اصفهان', 4, NULL),
(82, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'برخوار', 4, NULL),
(83, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بوئین میاندشت', 4, NULL),
(84, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'تیران و کرون', 4, NULL),
(85, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'چادگان', 4, NULL),
(86, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خمینی شهر', 4, NULL),
(87, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خوانسار', 4, NULL),
(88, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خور و بیابانک', 4, NULL),
(89, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دهاقان', 4, NULL),
(90, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سمیرم', 4, NULL),
(91, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شاهین شهر و میمه', 4, NULL),
(92, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شهرضا', 4, NULL),
(93, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فریدن', 4, NULL),
(94, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فریدونشهر', 4, NULL),
(95, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فلاورجان', 4, NULL),
(96, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کاشان', 4, NULL),
(97, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گلپایگان', 4, NULL),
(98, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'لنجان', 4, NULL),
(99, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مبارکه', 4, NULL),
(100, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نائین', 4, NULL),
(101, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نجف آباد', 4, NULL),
(102, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نطنز', 4, NULL),
(104, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اشتهارد', 5, NULL),
(105, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ساوجبلاغ', 5, NULL),
(106, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'طالقان', 5, NULL),
(107, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فردیس', 5, NULL),
(108, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کرج', 5, NULL),
(109, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نظر آباد', 5, NULL),
(110, '2016-07-07 00:27:55', '2016-07-16 11:32:19', NULL, NULL, NULL, NULL, 'آبدانان', 6, NULL),
(111, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ایلام', 6, NULL),
(112, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ایوان', 6, NULL),
(113, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بدره', 6, NULL),
(114, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'چرداول', 6, NULL),
(115, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دره شهر', 6, NULL),
(116, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دهلران', 6, NULL),
(117, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سیروان', 6, NULL),
(118, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ملکشاهی', 6, NULL),
(119, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مهران', 6, NULL),
(120, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بوشهر', 7, NULL),
(121, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'تنگستان', 7, NULL),
(122, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'جم', 7, NULL),
(123, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دشتستان', 7, NULL),
(124, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دشتی', 7, NULL),
(125, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دیر', 7, NULL),
(126, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دیلم', 7, NULL),
(127, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'عسلویه', 7, NULL),
(128, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کنگان', 7, NULL),
(129, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گناوه', 7, NULL),
(130, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اسلامشهر', 8, NULL),
(131, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بهارستان', 8, NULL),
(132, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'پاکدشت', 8, NULL),
(133, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'پردیس', 8, NULL),
(134, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'پیشوا', 8, NULL),
(135, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'تهران', 8, NULL),
(136, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دماوند', 8, NULL),
(137, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رباط کریم', 8, NULL),
(138, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ری', 8, NULL),
(139, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شمیرانات', 8, NULL),
(140, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شهریار', 8, NULL),
(141, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فیروز کوه', 8, NULL),
(142, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'قدس', 8, NULL),
(143, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'قرچک', 8, NULL),
(144, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ملارد', 8, NULL),
(145, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ورامین', 8, NULL),
(146, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اردل', 9, NULL),
(147, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بروجن', 9, NULL),
(148, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بن', 9, NULL),
(149, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سامان', 9, NULL),
(150, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شهر کرد', 9, NULL),
(151, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فارسان', 9, NULL),
(152, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کوهرنگ', 9, NULL),
(153, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کیار', 9, NULL),
(154, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'لردگان', 9, NULL),
(155, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بشرویه', 10, NULL),
(156, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بیرجند', 10, NULL),
(157, '2016-07-07 00:27:55', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خوسف', 10, NULL),
(158, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'درمیان', 10, NULL),
(159, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'زیرکوه', 10, NULL),
(160, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سرایان', 10, NULL),
(161, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سربیشه', 10, NULL),
(162, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'طبس', 10, NULL),
(163, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فردوس', 10, NULL),
(164, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'قائنات', 10, NULL),
(165, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نهبندان', 10, NULL),
(166, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'باخرز', 11, NULL),
(167, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بجستان', 11, NULL),
(168, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بردسکن', 11, NULL),
(169, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بینالود', 11, NULL),
(170, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'تایباد', 11, NULL),
(171, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'تربت جام', 11, NULL),
(172, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'تربت حیدریه', 11, NULL),
(173, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'جغتای', 11, NULL),
(174, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'جوین', 11, NULL),
(175, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'چناران', 11, NULL),
(176, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خلیل آباد', 11, NULL),
(177, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خواف', 11, NULL),
(178, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خوشاب', 11, NULL),
(179, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'داورزن', 11, NULL),
(180, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'درگز', 11, NULL),
(181, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رشتخوار', 11, NULL),
(182, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'زاوه', 11, NULL),
(183, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سبزوار', 11, NULL),
(184, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سرخس', 11, NULL),
(185, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فریمان', 11, NULL),
(186, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فیروزه', 11, NULL),
(187, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'قوچان', 11, NULL),
(188, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کاشمر', 11, NULL),
(189, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کلات', 11, NULL),
(190, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گناباد', 11, NULL),
(191, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مشهد', 11, NULL),
(192, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مه ولات', 11, NULL),
(193, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نیشابور', 11, NULL),
(194, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اسفراین', 12, NULL),
(195, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بجنورد', 12, NULL),
(196, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'جاجرم', 12, NULL),
(197, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'راز و جرگلان', 12, NULL),
(198, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شیروان', 12, NULL),
(199, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فاروج', 12, NULL),
(200, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گرمه', 12, NULL),
(201, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مانه و سملقان', 12, NULL),
(202, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'آبادان', 13, NULL),
(203, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'آغاجاری', 13, NULL),
(204, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'امیدیه', 13, NULL),
(205, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اندیکا', 13, NULL),
(206, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اندیمشک', 13, NULL),
(207, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اهواز', 13, NULL),
(208, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ایذه', 13, NULL),
(209, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'باغ ملک', 13, NULL),
(210, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'باوی', 13, NULL),
(211, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بندر ماهشهر', 13, NULL),
(212, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بهبهان', 13, NULL),
(213, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'حمیدیه', 13, NULL),
(214, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خرمشهر', 13, NULL),
(215, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دزفول', 13, NULL),
(216, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دشت آزادگان', 13, NULL),
(217, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رامشیر', 13, NULL),
(218, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رامهرمز', 13, NULL),
(219, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شادگان', 13, NULL),
(220, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شوش', 13, NULL),
(221, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شوشتر', 13, NULL),
(222, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کارون', 13, NULL),
(223, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گتوند', 13, NULL),
(224, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'لالی', 13, NULL),
(225, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مسجد سلیمان', 13, NULL),
(226, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'هفتگل', 13, NULL),
(227, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'هندیجان', 13, NULL),
(228, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'هویزه', 13, NULL),
(229, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ابهر', 14, NULL),
(230, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ایجرود', 14, NULL),
(231, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خدابنده', 14, NULL),
(232, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خرمدره', 14, NULL),
(233, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'زنجان', 14, NULL),
(234, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سلطانیه', 14, NULL),
(235, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'طارم', 14, NULL),
(236, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ماهنشان', 14, NULL),
(237, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'آرادان', 15, NULL),
(238, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دامغان', 15, NULL),
(239, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سمنان', 15, NULL),
(240, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شاهرود', 15, NULL),
(241, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گرمسار', 15, NULL),
(242, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مهدی شهر', 15, NULL),
(243, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'میامی', 15, NULL),
(244, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ایرانشهر', 16, NULL),
(245, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'چاه بهار', 16, NULL),
(246, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خاش', 16, NULL),
(247, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دلگان', 16, NULL),
(248, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'زابل', 16, NULL),
(249, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'زاهدان', 16, NULL),
(250, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'زهک', 16, NULL),
(251, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سراوان', 16, NULL),
(252, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سرباز', 16, NULL),
(253, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سیب سوران', 16, NULL),
(254, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فنوج', 16, NULL),
(255, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'قصرقند', 16, NULL),
(256, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کنارک', 16, NULL),
(257, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مهرستان', 16, NULL),
(258, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'میرجاوه', 16, NULL),
(259, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نیک شهر', 16, NULL),
(260, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نیمروز', 16, NULL),
(261, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'هامون', 16, NULL),
(262, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'هیرمند', 16, NULL),
(263, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'آباده', 17, NULL),
(264, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ارسنجان', 17, NULL),
(265, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'استهبان', 17, NULL),
(266, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اقلید', 17, NULL),
(267, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بوانات', 17, NULL),
(268, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'پاسارگاد', 17, NULL),
(269, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'جهرم', 17, NULL),
(270, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خرامه', 17, NULL),
(271, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خرم بید', 17, NULL),
(272, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خنج', 17, NULL),
(273, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'داراب', 17, NULL),
(274, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رستم', 17, NULL),
(275, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'زرین دشت', 17, NULL),
(276, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سپیدان', 17, NULL),
(277, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سروستان', 17, NULL),
(278, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شیراز', 17, NULL),
(279, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فراشبند', 17, NULL),
(280, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فسا', 17, NULL),
(281, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فیروز آباد', 17, NULL),
(282, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'قیروکارزین', 17, NULL),
(283, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کازرون', 17, NULL),
(284, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کوار', 17, NULL),
(285, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گراش', 17, NULL),
(286, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'لارستان', 17, NULL),
(287, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'لامرد', 17, NULL),
(288, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مرودشت', 17, NULL),
(289, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ممسنی', 17, NULL),
(290, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مهر', 17, NULL),
(291, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نی ریز', 17, NULL),
(292, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'آبیک', 18, NULL),
(293, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'آوج', 18, NULL),
(294, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'البرز', 18, NULL),
(295, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بوئین زهرا', 18, NULL),
(296, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'تاکستان', 18, NULL),
(297, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'قزوین', 18, NULL),
(298, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'قم', 19, NULL),
(299, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بانه', 20, NULL),
(300, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بیجار', 20, NULL),
(301, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دهگلان', 20, NULL),
(302, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دیواندره', 20, NULL),
(303, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سروآباد', 20, NULL),
(304, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سقز', 20, NULL),
(305, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سنندج', 20, NULL),
(306, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'قروه', 20, NULL),
(307, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کامیاران', 20, NULL),
(308, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مریوان', 20, NULL),
(309, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ارزوئیه', 21, NULL),
(310, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'انار', 21, NULL),
(311, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بافت', 21, NULL),
(312, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بردسیر', 21, NULL),
(313, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بم', 21, NULL),
(314, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'جیرفت', 21, NULL),
(315, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رابر', 21, NULL),
(316, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'راور', 21, NULL),
(317, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رفسنجان', 21, NULL),
(318, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رودبار جنوب', 21, NULL),
(319, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ریگان', 21, NULL),
(320, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'زرند', 21, NULL),
(321, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سیرجان', 21, NULL),
(322, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شهر بابک', 21, NULL),
(323, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'عنبر آباد', 21, NULL),
(324, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فاریاب', 21, NULL),
(325, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فهرج', 21, NULL),
(326, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'قلعه گنج', 21, NULL),
(327, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کرمان', 21, NULL),
(328, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کوهبنان', 21, NULL),
(329, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کهنوج', 21, NULL),
(330, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'منوجان', 21, NULL),
(331, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'نرماشیر', 21, NULL),
(332, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اسلام آباد غرب', 22, NULL),
(333, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'پاوه', 22, NULL),
(334, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ثلاث باباجانی', 22, NULL),
(335, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'جوانرود', 22, NULL),
(336, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دالاهو', 22, NULL),
(337, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'روانسر', 22, NULL),
(338, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سر پل ذهاب', 22, NULL),
(339, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سنقر', 22, NULL),
(340, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'صحنه', 22, NULL),
(341, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'قصر شیرین', 22, NULL),
(342, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کرمانشاه', 22, NULL),
(343, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کنگاور', 22, NULL),
(344, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گیلانغرب', 22, NULL),
(345, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'هرسین', 22, NULL),
(346, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'باشت', 23, NULL),
(347, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بویر احمد', 23, NULL),
(348, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بهمئی', 23, NULL),
(349, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'چرام', 23, NULL),
(350, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'دنا', 23, NULL),
(351, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کهگیلویه', 23, NULL),
(352, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گچساران', 23, NULL),
(353, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'لنده', 23, NULL),
(354, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'آزاد شهر', 24, NULL),
(355, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'آق قلا', 24, NULL),
(356, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بندر گز', 24, NULL),
(357, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ترکمن', 24, NULL),
(358, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رامیان', 24, NULL),
(359, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'علی آباد', 24, NULL),
(360, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کردکوی', 24, NULL),
(361, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'کلاله', 24, NULL),
(362, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گالیکش', 24, NULL),
(363, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گرگان', 24, NULL),
(364, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گمیشان', 24, NULL),
(365, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'گنبد کاووس', 24, NULL),
(366, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مراوه تپه', 24, NULL),
(367, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'مینودشت', 24, NULL),
(368, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'آستارا', 25, NULL),
(369, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'آستانه اشرفیه', 25, NULL),
(370, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'املش', 25, NULL),
(371, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'بندر انزلی', 25, NULL),
(372, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رشت', 25, NULL),
(373, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رضوانشهر', 25, NULL),
(374, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رودبار', 25, NULL),
(375, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رودسر', 25, NULL),
(376, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'سیاهکل', 25, NULL),
(377, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'شفت', 25, NULL),
(378, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'صومعه سرا', 25, NULL),
(379, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'تالش', 25, NULL),
(380, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'فومن', 25, NULL),
(381, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'لاهیجان', 25, NULL),
(382, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'لنگرود', 25, NULL),
(383, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ماسال', 25, NULL),
(384, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'ازنا', 26, NULL),
(385, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'الیگودرز', 26, NULL),
(386, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'بروجرد', 26, NULL),
(387, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'پلدختر', 26, NULL),
(388, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'خرم آباد', 26, NULL),
(389, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'دلفان', 26, NULL),
(390, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'دورود', 26, NULL),
(391, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'دوره', 26, NULL),
(392, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'رومشکان', 26, NULL),
(393, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'سلسله', 26, NULL),
(394, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'کوهدشت', 26, NULL),
(395, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'آمل', 27, NULL),
(396, '2016-07-07 00:27:56', '2016-07-10 14:55:48', NULL, NULL, NULL, NULL, 'بابل', 27, NULL),
(397, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'بابلسر', 27, NULL),
(398, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'بهشهر', 27, NULL),
(399, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'تنکابن', 27, NULL),
(400, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'جویبار', 27, NULL),
(401, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'چالوس', 27, NULL),
(402, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'رامسر', 27, NULL),
(403, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'ساری', 27, NULL),
(404, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'سواد کوه', 27, NULL),
(405, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'سوادکوه شمالی', 27, NULL),
(406, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'سیمرغ', 27, NULL),
(407, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'عباس آباد', 27, NULL),
(408, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'فریدونکنار', 27, NULL),
(409, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'قائم شهر', 27, NULL),
(410, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'کلاردشت', 27, NULL),
(411, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'گلوگاه', 27, NULL),
(412, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'محمود آباد', 27, NULL),
(413, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'میاندورود', 27, NULL),
(414, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'نکا', 27, NULL),
(415, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'نور', 27, NULL),
(416, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'نوشهر', 27, NULL),
(417, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'آشتیان', 28, NULL),
(418, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'اراک', 28, NULL),
(419, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'تفرش', 28, NULL),
(420, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'خمین', 28, NULL),
(421, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'خنداب', 28, NULL),
(422, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'دلیجان', 28, NULL),
(423, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'زرندیه', 28, NULL),
(424, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'ساوه', 28, NULL),
(425, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'شازند', 28, NULL),
(426, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'فراهان', 28, NULL),
(427, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'کمیجان', 28, NULL),
(428, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'محلات', 28, NULL),
(429, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'ابوموسی', 29, NULL),
(430, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'بستک', 29, NULL),
(431, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'بشاگرد', 29, NULL),
(432, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'بندرعباس', 29, NULL),
(433, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'بندرلنگه', 29, NULL),
(434, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'پارسیان', 29, NULL),
(435, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'جاسک', 29, NULL),
(436, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'حاجی آباد', 29, NULL),
(437, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'خمیر', 29, NULL),
(438, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'رودان', 29, NULL),
(439, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'سیریک', 29, NULL),
(440, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'قشم', 29, NULL),
(441, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'میناب', 29, NULL),
(442, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'اسد آباد', 30, NULL),
(443, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'بهار', 30, NULL),
(444, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'تویسرکان', 30, NULL),
(445, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'رزن', 30, NULL),
(446, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'فامنین', 30, NULL),
(447, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'کبودرآهنگ', 30, NULL),
(448, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'ملایر', 30, NULL),
(449, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'نهاوند', 30, NULL),
(450, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'همدان', 30, NULL),
(451, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'ابرکوه', 31, NULL),
(452, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'اردکان', 31, NULL),
(453, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'بافق', 31, NULL),
(454, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'بهاباد', 31, NULL),
(455, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'تفت', 31, NULL),
(456, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'خاتم', 31, NULL),
(457, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'صدوق', 31, NULL),
(458, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'مهریز', 31, NULL),
(459, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'میبد', 31, NULL),
(460, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'یزد', 31, NULL),
(461, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'زیرآب', 27, NULL),
(462, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'نورآباد', 26, NULL),
(463, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'الشتر', 26, NULL),
(464, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'امیرکلا', 27, NULL),
(465, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'الوند', 18, NULL),
(466, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'رستم آباد', 25, NULL),
(467, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'منجیل', 25, NULL),
(468, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'طوالش', 25, NULL),
(469, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'برازجان', 7, NULL),
(470, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'خورموج', 7, NULL),
(471, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'اهرم', 7, NULL),
(472, '2016-07-07 00:27:56', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'ماهشهر', 13, NULL),
(473, '2016-07-07 00:27:56', '2016-07-07 01:23:10', NULL, NULL, NULL, NULL, 'کیش', 29, NULL),
(474, '2016-07-07 01:23:09', '2016-07-07 01:23:09', NULL, NULL, NULL, NULL, 'یاسوج', 23, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `talks`
--

CREATE TABLE IF NOT EXISTS `talks` (
  `id` int(11) unsigned NOT NULL,
  `ticket_id` int(11) DEFAULT NULL,
  `text` text,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `meta` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `talks`
--

INSERT INTO `talks` (`id`, `ticket_id`, `text`, `is_admin`, `meta`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 1, 'این نوشته باید به‌روز شود. بله ظاهراً می‌شود.', 0, NULL, '2016-10-27 07:07:48', '2016-10-27 07:15:31', 5, 1),
(2, 1, 'شاید بگین چه فکر جالبی، ولی از دید من یعنی با اینکه پول خدمتی که دریافت می‌کنم رو نقدا میدم باز تبلیغ هم تو حلقم می‌کنند. یه مدل کاملا ایرانی. t.co/xkXJj4GWGy', 1, NULL, '2016-10-27 07:08:50', '2016-10-27 07:08:50', 1, 1),
(3, 1, 'آها که این طور. عجب!', 0, '[]', '2016-10-27 20:16:10', '2016-10-27 20:16:10', 1, NULL),
(4, 2, 'این سایت کار نمی‌کند.', 0, NULL, '2016-10-28 14:16:31', '2016-10-28 14:16:31', 6, 1),
(5, 2, 'چرا کار می‌کند.', 1, '[]', '2016-10-28 14:16:42', '2016-10-28 14:16:42', 1, NULL),
(6, 2, 'پیام شما را به واحد خدمات انتقال می‌دهم و فوریتش را زیاد می‌کنم. اسمش را هم می‌گذارم «آزمایش انتقال واحد». با تشکر', 1, '[]', '2016-10-28 14:27:11', '2016-10-28 14:27:11', 1, NULL),
(7, 3, 'پیغام من کوش؟', 0, NULL, '2016-10-28 16:08:20', '2016-10-28 16:08:43', 6, 1),
(8, 2, 'آزمایش', 1, '[]', '2016-11-13 10:21:42', '2016-11-13 10:21:42', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department` varchar(250) DEFAULT NULL,
  `priority` tinyint(1) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `feedback` tinyint(1) NOT NULL DEFAULT '0',
  `meta` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `attended_at` timestamp NULL DEFAULT NULL,
  `archived_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `attended_by` int(11) DEFAULT NULL,
  `archived_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `department`, `priority`, `title`, `feedback`, `meta`, `created_at`, `updated_at`, `attended_at`, `archived_at`, `deleted_at`, `created_by`, `updated_by`, `attended_by`, `archived_by`, `deleted_by`) VALUES
(1, 5, 'sales', 2, 'فعالیت سایتی', 0, '{"score":0,"first_replied_by":3,"first_replied_at":"2016-11-07 12:21:38"}', '2016-10-24 15:46:53', '2016-11-07 08:51:38', NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(2, 6, 'services', 3, 'آزمایش انتقال واحد', 0, '[]', '2016-10-26 12:15:11', '2016-11-13 10:21:33', NULL, NULL, NULL, 1, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL,
  `customer_type` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `name_first` varchar(250) DEFAULT NULL,
  `name_last` varchar(250) DEFAULT NULL,
  `name_firm` varchar(250) DEFAULT NULL,
  `code_melli` varchar(20) DEFAULT NULL,
  `national_id` varchar(20) DEFAULT NULL,
  `gender` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(250) DEFAULT NULL,
  `mobile` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `familization` varchar(250) DEFAULT NULL,
  `meta` longtext,
  `roles` longtext,
  `media` longtext,
  `settings` tinyint(4) DEFAULT NULL,
  `newsletter` tinyint(1) NOT NULL DEFAULT '1',
  `site_credit` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(250) DEFAULT NULL,
  `reset_token` varchar(250) DEFAULT NULL,
  `password_force_change` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `published_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `destroyed_by` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `customer_type`, `status`, `name_first`, `name_last`, `name_firm`, `code_melli`, `national_id`, `gender`, `email`, `mobile`, `password`, `city_id`, `province_id`, `familization`, `meta`, `roles`, `media`, `settings`, `newsletter`, `site_credit`, `remember_token`, `reset_token`, `password_force_change`, `created_at`, `updated_at`, `published_at`, `deleted_at`, `created_by`, `updated_by`, `published_by`, `deleted_by`, `destroyed_by`) VALUES
(1, 0, 99, 'طاها', 'کامکار', NULL, '0074715623', NULL, 1, 'chieftaha@gmail.com', '09122835030', '$2y$10$SbeU8U1wIp4NKHypaa3d/uGoQ9T79aX3mBzmrUvAAl2eIblrGXWXK', NULL, NULL, NULL, 'null', NULL, NULL, NULL, 1, 0, 'a9VrRZr5iizsbDkJNqmImzc2myi5qc72P4X4FEkiWfJf55Vpab19nXgLb4LG', NULL, 0, NULL, '2016-10-17 07:46:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 0, 99, 'نگین', 'شیرآقایی', NULL, NULL, NULL, 0, 'professor@gmail.com', '09359682654', '$2y$10$TMDPsleUjzbkFkFs.gUy7O5fg1yDLeGNqYTnfLfPGYhwrsYZuKqLG', NULL, NULL, NULL, '[]', 'eyJpdiI6InFHeGxtVW9yZzlpV3NMYkNPWFwvVU53PT0iLCJ2YWx1ZSI6IklhWHorMUVqRDFTM216Q2R0WHZcL1U5WkpmYWRNWWxcL1ZUTzJsbHJ1T2VvSktCcGRudEdrdVh5ZURoQzZqSDRldHQ4dnJieVJiTUp1STQxTlJpdHI1WWVQUW5Md3hrcEtzaEM0cUJOSW1PcCt3a01JQ3ZtWDBIa1JxdnFMakFwd2hOemhsMWhRXC9cL2lGS1BYXC9USGFjK1psMkwzY1V1YkpjQVQ1Y203Y0w2YW9yUzVETkM0TW4renB6NEJwOVhsSE1RXC9xRVIrZHN0cGxvSFJZU21rcENuWFBvaTl1TFRrcmVSZGFHSFwvNVZndU1lek9RblpXd1lSTkY5bXZIc21scGVJY0hcL24xRzV1UVVGc1dcL1d1TlwvbXJSMEtlemg1YnoyU3JIS3ZZUHNNZjExXC9obXg4a1pZd3R2Rmh5Q1g3V1NJQVdFUU04ZTlUbTQ3YTY0Qm1WSm5iOW1LcTRpVFg1b2pcLzlqUGdRQXhWdzFkMnM5RUNPRXZ6Ulk0OFJzXC9sY0ZYSzdQTktMTXBEWGpsRjl3bGRZUThWMGpFemM3d0E4ZXp0cnhxU1lHRHB5WllwNDdEWEdOTjVXK2FjUGdFbEVMOUVEWld5ZUcrRG5QakppNUZvcFVjdWZBVmhuWEZSVHVCaVVPb2FDMWxPWVNtR0tPc3A2cWw0Mm9zXC9JY1JUb2paVEtTbGxkTDFONWtjeTlrZXBsZENzMVVnM1h1ckdKXC9QdllEU1pMdlZMdWRtSUlcL05PbVBpOVFHVWRtK0FqbDVXeGcxeXhxTHVJeWZ4NFBGR29Va200OWxsY01LM2RUcWR2REtlaHNqUklISHByR3BrXC9LNG1HeFNxaVdhMk15YUlQVUtwOGJjQkQ5VVwvTGJpUEg4RjlDRmlXRnpDQjFSR0d3VVVIUEZyNmxZaEV5Z2huVEw2dWxoVTF4b3dyRFFPR0FyK1VEc2ZkdE5CTmhxemV5aVN3UUoyWUkyY1BxNEYySDRkOE9PRVZjZTJkVVRkTElMUTNtMk0zbW8zRDNKM0krRE1rdm9HdVdrMElTUk9YbWNDcEw2cng2d1VodHZhUTB0bUZvd3l0bWhud3lIUjVKQytGMlkxclRkZ0Y0ZHNOcmMrZnhZRnpxM202VTVseXdKemdUcGJDR0JYcVU2ckcya2RUXC9aRjdzdzJDWGVpNVg3dDhBc2gzdWtZXC9sUlNJMVhwcFwvRDJ6SzhlMERhXC9RTUpUekRoTUdtNTRmRXZOYVI2WjhcL2FQczJoVXdsTWFLOEYxUjRVVzhOdzhqUlUzN3NHYWhRTkNnMENsNnkyMkZOMkRNczJrSlNjU2RZb21LRXd2TGV3dWVyemhpbVlJMk94aW1EKzhqXC9cLzdJU1ZKaDdjeEg3cFQrTGVMeVZxYlhFV2ppM1czU3c0SHpndmtyNXJKZU5WNThtT2JcLzExSzhITU9ydHBZN3dna1RyUEVJM3BZbEx5MTF3WXhKODhQMTZ4Y3UrR2h3d3FPWmlpczR1Z2Y5SXNpcnRzUG1oajRETWl3ZG1jWXJvTzJCZUxieGdOdFhKZ2pmYVB5MUlxRE5MT0hTcHVxUVRyWWRTZWJ2WlB6b3VqaWhHbzdueUlJVHpoSHA5U3ZqTDhscGpNZWF1Q3UwVjB5c2hsUnA1Q3hFaUtzRWt1VXIycExBaDl6akhmRDNJT0cyMVwvSFZENm5LQ3NMSWJjQkhOOVd3WVp5dkpJMU13VTR0dzJjaVFtQnQrOXhSRlVPZz09IiwibWFjIjoiZmM5M2VhNWE5MjRjNzkzZWFhNzk4NWE3NjI5YzU2NTcxMWM2YWMwYzZhZTg5YmM4ZTQzZmQzZGRiMmM3ODA1OCJ9', NULL, NULL, 1, 0, NULL, NULL, 1, '2016-10-17 12:17:56', '2016-10-29 10:48:12', NULL, NULL, 1, NULL, NULL, 1, NULL),
(4, 0, 91, 'محمدهادی', 'رضایی', NULL, '0012071110', NULL, 0, 'mr.mhrezaei@gmail.com', '09122835012', '$2y$10$Twdxt5mHhJALw34u2m/qSeWv1MtMZYyNKCfjYGXXftD94NtDEav.6', NULL, NULL, NULL, '[]', 'eyJpdiI6IjV4MTNPMG1DeG5rZ2ZZYXFzcDRvMHc9PSIsInZhbHVlIjoiK3BYb0I4c1phc1E5aDVUNTFHaWkxU2FkRmhsS2luelNvUTFpMFkzT2NNQ1wvSFpOUVZ5XC9jUkE0bmV0VUZxaG1BazZOMnlhdHVvS1VJMDAwNmNLZHEyeFRBajJqaTUxS2NPOFJoOGlaMW15bUQ3VUxGUFg2YlFPUzdaSjExR21nSmJwMkJvTlpXOVR6bFpITlwvWGVEXC9RR2M4OGtITDR2eFVZOWk3NnRmU1Zibz0iLCJtYWMiOiJlMWU4YzY4MDIzOTU4OGUyYmEyMTY1NDg5MzMwNTQzODIzYjVjYWMyOGZmNWU5NmI2MTg1NmM3MTJiMmZjNzgxIn0=', NULL, NULL, 1, 0, NULL, NULL, 1, '2016-10-17 14:09:59', '2016-11-23 14:06:58', NULL, NULL, 3, NULL, NULL, NULL, NULL),
(5, 1, 8, 'الهه', 'مهرزادگان', '', '0322683394', '', 2, 'elaheh@mehrzadegan.com', '09359682653', '$2y$10$Y2SAQM/7rkLKabgOZy6u4.VFUN2MqkevtHqzAncYPaCNWGV1NDmYu', 135, NULL, 'شبکه‌های اجتماعی', '{"register_no":"","register_date":"2016\\/09\\/20","register_firm":"","economy_code":"","gazette_url":"","code_id":"5796","name_father":"\\u0645\\u062d\\u0645\\u062f","birth_date":"1983\\/09\\/28","marital":"1","education":"6","job":"\\u0622\\u0632\\u0627\\u062f","address":"\\u0646\\u0634\\u0627\\u0646\\u06cc","postal_code":"3435353635","telephone":"02122440439"}', NULL, NULL, NULL, 1, 6000, NULL, NULL, 1, '2016-10-20 14:51:05', '2016-11-18 04:33:41', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(6, 2, 8, 'محمد جعفر', 'مصفا', 'تمیز نظیف منزل', '4608968882', '0041232323', 0, 'chieftaha@gmail.com1', '09359682652', '$2y$10$Fr9WqUgaEHjGTeNitN2IV.zxztMyIY.UpRpO4lp0y6rn5y2uz.reS', 218, NULL, 'رسانه‌های خبری', '{"register_no":"2323234","register_date":"2016\\/10\\/08","register_firm":"\\u0633\\u0627\\u0632\\u0645\\u0627\\u0646 \\u062b\\u0628\\u062a \\u0627\\u0633\\u0646\\u0627\\u062f \\u0648 \\u0627\\u0645\\u0644\\u0627\\u06a9 \\u06a9\\u0634\\u0648\\u0631","economy_code":"1111","gazette_url":"http:\\/\\/www.com","code_id":"","name_father":"","birth_date":"","marital":"","education":"0","job":"","address":"\\u0646\\u0634\\u0627\\u0646\\u06cc","postal_code":"1334567899","telephone":"02122440429"}', NULL, NULL, NULL, 1, 0, NULL, NULL, 1, '2016-10-20 16:15:05', '2016-11-13 10:26:51', '2016-10-20 16:15:04', NULL, 1, NULL, 1, 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `title` (`plural_title`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_at` (`created_at`),
  ADD KEY `published_at` (`published_at`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `published_by` (`published_by`),
  ADD KEY `title` (`title`),
  ADD KEY `post_cat_id` (`category_id`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slug` (`slug`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `name` (`title`);

--
-- Indexes for table `talks`
--
ALTER TABLE `talks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
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
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=475;
--
-- AUTO_INCREMENT for table `talks`
--
ALTER TABLE `talks`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
