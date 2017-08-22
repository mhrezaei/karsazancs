-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2017 at 02:37 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `karsazan`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(11) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `slug`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `plural_title`, `singular_title`, `header_title`, `template`, `hint`, `allowed_meta`, `features`, `icon`) VALUES
(1, 'fa-statics', '2016-10-12 09:28:18', '2017-01-18 12:45:19', NULL, 1, NULL, NULL, 'صفحات ایستا', 'صفحه‌ی ایستا', 'بخش فارسی', 'post', '', '', 'title , header , text , abstract , image, digest', 'file-text-o'),
(4, 'fa-services', '2016-11-30 09:44:42', '2017-01-18 12:44:28', NULL, 4, NULL, NULL, 'خدمات ما', 'خدمت', 'بخش فارسی', 'post', '', '', 'title , text , image, digest', 'gift'),
(5, 'fa-faq', '2016-12-01 11:40:59', '2017-01-18 12:44:41', NULL, 4, NULL, NULL, 'سوالات رایج', 'سوال رایج', 'بخش فارسی', 'post', '', '', 'title , text, digest', 'commenting'),
(6, 'fa-news', '2016-12-05 07:12:02', '2017-01-18 12:44:13', NULL, 4, NULL, NULL, 'خبرها', 'خبر', 'بخش فارسی', 'post', '', '', 'image , text , title, digest', 'newspaper-o'),
(13, 'fa-slide-show', '2016-12-20 19:17:04', '2017-01-18 12:43:57', NULL, 4, NULL, NULL, 'اسلایدشو', 'اسلایدشو', 'بخش فارسی', 'post', '', 'link:text , button:text', 'title , text , image, digest', 'film'),
(15, 'fa-portfolio', '2016-12-20 19:50:21', '2017-01-18 12:46:17', NULL, 4, NULL, NULL, 'نمونه کارها', 'نمونه کار', 'بخش فارسی', 'post', '', '', 'title , text , image , gallery , digest, digest', 'truck');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `slug`, `title`, `abstract`, `hint`, `image`, `created_at`, `updated_at`, `created_by`, `updated_by`, `branch_id`) VALUES
(2, NULL, 'info', 'اطلاعات عمومی', NULL, NULL, '', '2016-10-12 12:04:30', '2016-10-14 21:05:58', 1, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `branch`, `slug`, `title`, `abstract`, `text`, `category_id`, `keywords`, `featured_image`, `is_draft`, `meta`, `created_at`, `updated_at`, `deleted_at`, `published_at`, `created_by`, `updated_by`, `deleted_by`, `published_by`) VALUES
(6, 'fa-statics', 'fa-index_slide', 'سریع، آسان، امن ', '', '<p>معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند</p>', 0, NULL, '/assets/photos/posts/main-title-bg.jpg', 0, '[]', '2016-11-30 09:17:07', '2016-11-30 09:53:47', NULL, '2016-11-30 09:17:07', 4, NULL, NULL, 4),
(7, 'fa-features', '', 'پشتیبانی سریع', NULL, '<p>معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '"[]"', '2016-11-30 09:31:26', '2016-11-30 09:31:26', NULL, '2016-11-30 09:31:26', 4, NULL, NULL, 4),
(8, 'fa-features', '', ' امنیت بالا ', NULL, '<p>معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند</p>', 0, NULL, '/assets/photos/posts/feature-2.png', 0, '[]', '2016-11-30 09:31:50', '2016-11-30 09:43:01', NULL, '2016-11-30 09:31:50', 4, NULL, NULL, 4),
(9, 'fa-features', '', ' سرعت بالای عملیات‌ها ', NULL, '<p>معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند</p>', 0, NULL, '/assets/photos/posts/feature-3.png', 0, '[]', '2016-11-30 09:32:04', '2016-11-30 09:42:39', NULL, '2016-11-30 09:32:04', 4, NULL, NULL, 4),
(10, 'fa-features', '', ' بهترین قیمت ', NULL, '<p>معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند</p>', 0, NULL, '/assets/photos/posts/feature-4.png', 0, '[]', '2016-11-30 09:32:17', '2016-11-30 09:42:19', NULL, '2016-11-30 09:32:17', 4, NULL, NULL, 4),
(11, 'fa-services', '', 'صدور ویزا کارت', NULL, '<p>صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '"[]"', '2016-11-30 09:46:29', '2016-11-30 09:46:29', NULL, '2016-11-30 09:46:29', 4, NULL, NULL, 4),
(12, 'fa-services', '', 'خرید با ویزا کارت', NULL, '<p>خرید با ویزا کارت خرید با ویزا کارت خرید با ویزا کارت خرید با ویزا کارت خرید با ویزا کارت</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '[]', '2016-11-30 09:46:34', '2016-12-01 07:37:22', NULL, '2016-11-30 09:46:34', 4, NULL, NULL, 4),
(13, 'fa-services', '', 'ساخت و نصب انواع کابینت', NULL, '<p>شارژ ویزا کارت شارژ ویزا کارت شارژ ویزا کارت شارژ ویزا کارت شارژ ویزا کارت</p>', 0, NULL, '/assets/photos/posts/132280163.jpg', 0, '[]', '2016-11-30 09:46:43', '2017-01-06 15:35:00', NULL, '2016-11-30 09:46:43', 4, NULL, NULL, 4),
(14, 'fa-services', '', 'انوع کف پوش', NULL, '<p>نصب و اجرای انوع کف پوش</p>', 0, NULL, '/assets/photos/posts/Untitled-3.png', 0, '[]', '2016-11-30 09:46:50', '2017-01-06 15:26:24', NULL, '2016-11-30 09:46:50', 4, NULL, NULL, 4),
(15, 'fa-services', '', 'صدور ویزا کارت', NULL, '<p>صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '"[]"', '2016-11-30 09:46:56', '2016-12-01 07:34:37', '2016-12-01 07:34:37', '2016-11-30 09:46:56', 4, NULL, 4, 4),
(16, 'fa-services', '', 'صدور ویزا کارت', NULL, '<p>صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '"[]"', '2016-11-30 09:47:03', '2016-12-01 07:34:33', '2016-12-01 07:34:33', '2016-11-30 09:47:03', 4, NULL, 4, 4),
(17, 'fa-services', '', 'صدور ویزا کارت', NULL, '<p>صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '"[]"', '2016-11-30 09:47:11', '2016-12-01 07:34:28', '2016-12-01 07:34:28', '2016-11-30 09:47:11', 4, NULL, 4, 4),
(18, 'fa-services', '', 'صدور ویزا کارت', NULL, '<p>صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت صدور ویزا کارت</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '"[]"', '2016-11-30 09:47:55', '2016-12-01 07:34:22', '2016-12-01 07:34:22', '2016-11-30 09:47:55', 4, NULL, 4, 4),
(19, 'fa-statics', 'fa-index_about', 'چند قدم ساده تا دریافت کارت مورد نظرتان', '', '<p>تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می&zwnj;رسد و قلم&zwnj;ها و اندازه&zwnj;بندی&zwnj;ها چگونه در نظر گرفته شده&zwnj;است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.</p>', 0, NULL, '', 0, '"[]"', '2016-11-30 09:54:02', '2016-11-30 09:54:02', NULL, '2016-11-30 09:54:02', 4, NULL, NULL, 4),
(20, 'fa-statics', 'fa-about_page', 'معرفی', '', '<p style="text-align: justify;">لورم ایپسوم یا طرح&zwnj;نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی&zwnj;معنی در صنعت چاپ، صفحه&zwnj;آرایی و طراحی گرافیک گفته می&zwnj;شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می&zwnj;رسد و قلم&zwnj;ها و اندازه&zwnj;بندی&zwnj;ها چگونه در نظر گرفته شده&zwnj;است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.<br /><br />لورم ایپسوم یا طرح&zwnj;نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی&zwnj;معنی در صنعت چاپ، صفحه&zwnj;آرایی و طراحی گرافیک گفته می&zwnj;شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می&zwnj;رسد و قلم&zwnj;ها و اندازه&zwnj;بندی&zwnj;ها چگونه در نظر گرفته شده&zwnj;است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.<br /><br />لورم ایپسوم یا طرح&zwnj;نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی&zwnj;معنی در صنعت چاپ، صفحه&zwnj;آرایی و طراحی گرافیک گفته می&zwnj;شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می&zwnj;رسد و قلم&zwnj;ها و اندازه&zwnj;بندی&zwnj;ها چگونه در نظر گرفته شده&zwnj;است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.<br /><br />&nbsp;&nbsp;&nbsp; نمونه&zwnj;ی نقل قول: از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.<br /><br />لورم ایپسوم یا طرح&zwnj;نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی&zwnj;معنی در صنعت چاپ، صفحه&zwnj;آرایی و طراحی گرافیک گفته می&zwnj;شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می&zwnj;رسد و قلم&zwnj;ها و اندازه&zwnj;بندی&zwnj;ها چگونه در نظر گرفته شده&zwnj;است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.</p>', 0, NULL, '', 0, '[]', '2016-12-01 06:44:33', '2016-12-01 06:50:53', NULL, '2016-12-01 06:44:33', 4, NULL, NULL, 4),
(21, 'fa-statics', 'fa-privacy', 'حریم شخصی', '', '<p>حریم شخصی حریم شخصی حریم شخصی حریم شخصی حریم شخصی</p>', 0, NULL, '', 0, '"[]"', '2016-12-01 07:38:38', '2016-12-01 07:38:38', NULL, '2016-12-01 07:38:38', 4, NULL, NULL, 4),
(22, 'fa-faq', '', 'چگونه کارت بگیرم؟', NULL, '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>', 0, NULL, NULL, 0, '"[]"', '2016-12-01 11:43:13', '2016-12-01 11:43:13', NULL, '2016-12-01 11:43:13', 4, NULL, NULL, 4),
(23, 'fa-faq', '', 'چگونه کارت را تمدید کنم؟', NULL, '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>', 0, NULL, NULL, 0, '"[]"', '2016-12-01 11:43:31', '2016-12-01 11:43:31', NULL, '2016-12-01 11:43:31', 4, NULL, NULL, 4),
(24, 'fa-faq', '', 'چگونه کارت را مسدود کنم؟', NULL, '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>', 0, NULL, NULL, 0, '"[]"', '2016-12-01 11:43:43', '2016-12-01 11:43:43', NULL, '2016-12-01 11:43:42', 4, NULL, NULL, 4),
(25, 'fa-faq', '', 'چگونه کارت را پس بدهم؟', NULL, '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>', 0, NULL, NULL, 0, '"[]"', '2016-12-01 11:43:57', '2016-12-01 11:43:57', NULL, '2016-12-01 11:43:57', 4, NULL, NULL, 4),
(26, 'fa-statics', 'term_of_service', 'شرایط و قوانین سایت', '', '<p>شرایط و قوانین سایت&nbsp;شرایط و قوانین سایت&nbsp;شرایط و قوانین سایت&nbsp;شرایط و قوانین سایت&nbsp;شرایط و قوانین سایت</p>', 0, NULL, '', 0, '"[]"', '2016-12-01 12:52:59', '2016-12-01 12:52:59', NULL, '2016-12-01 12:52:59', 4, NULL, NULL, 4),
(27, 'fa-news', '', 'قیمت ارز بار دیگر افزایش چشم‌گیری داشت', NULL, '<p style="box-sizing: inherit; font-stretch: normal; font-size: 16px; font-family: IRANSans, Tahoma, Arial, sans-serif; line-height: 2; margin: 0px 0px 16px; color: #000000; text-align: start;"><span style="font-size: 10pt;">لورم ایپسوم یا طرح&zwnj;نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی&zwnj;معنی در صنعت چاپ، صفحه&zwnj;آرایی و طراحی گرافیک گفته می&zwnj;شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می&zwnj;رسد و قلم&zwnj;ها و اندازه&zwnj;بندی&zwnj;ها چگونه در نظر گرفته شده&zwnj;است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.</span></p>\n<p style="box-sizing: inherit; font-stretch: normal; font-size: 16px; font-family: IRANSans, Tahoma, Arial, sans-serif; line-height: 2; margin: 0px 0px 16px; color: #000000; text-align: start;"><span style="font-size: 10pt;">لورم ایپسوم یا طرح&zwnj;نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی&zwnj;معنی در صنعت چاپ، صفحه&zwnj;آرایی و طراحی گرافیک گفته می&zwnj;شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می&zwnj;رسد و قلم&zwnj;ها و اندازه&zwnj;بندی&zwnj;ها چگونه در نظر گرفته شده&zwnj;است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.</span></p>\n<p style="box-sizing: inherit; font-stretch: normal; font-size: 16px; font-family: IRANSans, Tahoma, Arial, sans-serif; line-height: 2; margin: 0px 0px 16px; color: #000000; text-align: start;"><span style="font-size: 10pt;">لورم ایپسوم یا طرح&zwnj;نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی&zwnj;معنی در صنعت چاپ، صفحه&zwnj;آرایی و طراحی گرافیک گفته می&zwnj;شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می&zwnj;رسد و قلم&zwnj;ها و اندازه&zwnj;بندی&zwnj;ها چگونه در نظر گرفته شده&zwnj;است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.</span></p>', 0, NULL, '/assets/photos/posts/news.jpg', 0, '[]', '2016-12-05 07:13:20', '2016-12-05 07:26:30', NULL, '2016-12-05 07:13:20', 4, NULL, NULL, 4),
(28, 'fa-news', '', 'قیمت ارز بار دیگر افزایش چشم‌گیری داشت دو', NULL, '<p style="box-sizing: inherit; font-stretch: normal; font-size: 16px; font-family: IRANSans, Tahoma, Arial, sans-serif; line-height: 2; margin: 0px 0px 16px; color: #000000; text-align: start;"><span style="font-size: 10pt;">لورم ایپسوم یا طرح&zwnj;نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی&zwnj;معنی در صنعت چاپ، صفحه&zwnj;آرایی و طراحی گرافیک گفته می&zwnj;شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می&zwnj;رسد و قلم&zwnj;ها و اندازه&zwnj;بندی&zwnj;ها چگونه در نظر گرفته شده&zwnj;است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.</span></p>\n<p style="box-sizing: inherit; font-stretch: normal; font-size: 16px; font-family: IRANSans, Tahoma, Arial, sans-serif; line-height: 2; margin: 0px 0px 16px; color: #000000; text-align: start;"><span style="font-size: 10pt;">لورم ایپسوم یا طرح&zwnj;نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی&zwnj;معنی در صنعت چاپ، صفحه&zwnj;آرایی و طراحی گرافیک گفته می&zwnj;شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می&zwnj;رسد و قلم&zwnj;ها و اندازه&zwnj;بندی&zwnj;ها چگونه در نظر گرفته شده&zwnj;است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.</span></p>\n<p style="box-sizing: inherit; font-stretch: normal; font-size: 16px; font-family: IRANSans, Tahoma, Arial, sans-serif; line-height: 2; margin: 0px 0px 16px; color: #000000; text-align: start;"><span style="font-size: 10pt;">لورم ایپسوم یا طرح&zwnj;نما (به انگلیسی: Lorem ipsum) به متنی آزمایشی و بی&zwnj;معنی در صنعت چاپ، صفحه&zwnj;آرایی و طراحی گرافیک گفته می&zwnj;شود. طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه&zwnj;آرایی، نخست از متن&zwnj;های آزمایشی و بی&zwnj;معنی استفاده می&zwnj;کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می&zwnj;رسد و قلم&zwnj;ها و اندازه&zwnj;بندی&zwnj;ها چگونه در نظر گرفته شده&zwnj;است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می&zwnj;باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه&zwnj;آرایی می&zwnj;کنند تا مرحله طراحی و صفحه&zwnj;بندی را به پایان برند.</span></p>', 0, NULL, '/assets/photos/posts/news.jpg', 0, '[]', '2016-12-05 07:13:47', '2016-12-05 07:27:25', NULL, '2016-12-05 07:13:47', 4, NULL, NULL, 4),
(29, 'en-features', '', 'Best price', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat</p>', 0, NULL, '/assets/photos/posts/feature-4.png', 0, '"[]"', '2016-12-09 05:53:43', '2016-12-09 05:53:43', NULL, '2016-12-09 05:53:43', 4, NULL, NULL, 4),
(30, 'en-features', '', 'High-speed operations', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat</p>', 0, NULL, '/assets/photos/posts/feature-3.png', 0, '"[]"', '2016-12-09 05:54:17', '2016-12-09 05:54:17', NULL, '2016-12-09 05:54:17', 4, NULL, NULL, 4),
(31, 'en-features', '', 'High security', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat</p>', 0, NULL, '/assets/photos/posts/feature-2.png', 0, '"[]"', '2016-12-09 05:54:37', '2016-12-09 05:54:37', NULL, '2016-12-09 05:54:37', 4, NULL, NULL, 4),
(32, 'en-features', '', 'Fast Support', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '"[]"', '2016-12-09 05:55:05', '2016-12-09 05:55:05', NULL, '2016-12-09 05:55:05', 4, NULL, NULL, 4),
(33, 'en-news', '', 'Currency prices again rose significantly', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', 0, NULL, '/assets/photos/posts/news.jpg', 0, '"[]"', '2016-12-09 05:56:42', '2016-12-09 05:56:42', NULL, '2016-12-09 05:56:42', 4, NULL, NULL, 4),
(34, 'en-news', '', 'Currency prices again rose significantly 2', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>\n<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', 0, NULL, '/assets/photos/posts/news.jpg', 0, '"[]"', '2016-12-09 05:56:53', '2016-12-09 05:56:53', NULL, '2016-12-09 05:56:52', 4, NULL, NULL, 4),
(35, 'en-services', '', 'Renew Visa card', NULL, '<p>Renew Visa card&nbsp;Renew Visa card&nbsp;Renew Visa card&nbsp;Renew Visa card&nbsp;Renew Visa card</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '[]', '2016-12-09 05:57:51', '2016-12-09 06:01:15', NULL, '2016-12-09 05:57:51', 4, NULL, NULL, 4),
(36, 'en-services', '', 'Visa charge card', NULL, '<p>Visa charge card&nbsp;Visa charge card&nbsp;Visa charge card&nbsp;Visa charge card&nbsp;Visa charge card</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '"[]"', '2016-12-09 05:58:31', '2016-12-09 05:58:31', NULL, '2016-12-09 05:58:31', 4, NULL, NULL, 4),
(37, 'en-services', '', 'Buy with Visa Card', NULL, '<p>Buy with Visa Card&nbsp;Buy with Visa Card&nbsp;Buy with Visa Card&nbsp;Buy with Visa Card&nbsp;Buy with Visa Card</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '"[]"', '2016-12-09 05:58:56', '2016-12-09 05:58:56', NULL, '2016-12-09 05:58:56', 4, NULL, NULL, 4),
(38, 'en-services', '', 'Visa card', NULL, '<p>Visa card&nbsp;Visa card&nbsp;Visa card&nbsp;Visa card&nbsp;Visa card</p>', 0, NULL, '/assets/photos/posts/feature-1.png', 0, '"[]"', '2016-12-09 05:59:21', '2016-12-09 05:59:21', NULL, '2016-12-09 05:59:21', 4, NULL, NULL, 4),
(39, 'en-faq', '', 'How to give your card?', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', 0, NULL, NULL, 0, '"[]"', '2016-12-09 06:01:55', '2016-12-09 06:01:55', NULL, '2016-12-09 06:01:55', 4, NULL, NULL, 4),
(40, 'en-faq', '', 'How do I block a card?', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', 0, NULL, NULL, 0, '"[]"', '2016-12-09 06:02:11', '2016-12-09 06:02:11', NULL, '2016-12-09 06:02:11', 4, NULL, NULL, 4),
(41, 'en-faq', '', 'How do I renew my card?', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', 0, NULL, NULL, 0, '"[]"', '2016-12-09 06:02:25', '2016-12-09 06:02:25', NULL, '2016-12-09 06:02:25', 4, NULL, NULL, 4),
(42, 'en-faq', '', 'How do I get a card?', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', 0, NULL, NULL, 0, '"[]"', '2016-12-09 06:02:45', '2016-12-09 06:02:45', NULL, '2016-12-09 06:02:45', 4, NULL, NULL, 4),
(43, 'en-statics', 'en-term_of_service', 'Terms and conditions', NULL, '<p>Terms and conditions&nbsp;Terms and conditions&nbsp;Terms and conditions&nbsp;Terms and conditions&nbsp;Terms and conditions</p>', 0, NULL, '', 0, '"[]"', '2016-12-09 06:04:23', '2016-12-09 06:04:23', NULL, '2016-12-09 06:04:23', 4, NULL, NULL, 4),
(44, 'en-statics', 'en-privacy', 'privacy', NULL, '<p>privacy&nbsp;privacy&nbsp;privacy&nbsp;privacy&nbsp;privacy</p>', 0, NULL, '', 0, '"[]"', '2016-12-09 06:04:59', '2016-12-09 06:04:59', NULL, '2016-12-09 06:04:59', 4, NULL, NULL, 4),
(45, 'en-statics', 'en-about_page', 'About', NULL, '<p>About&nbsp;<span style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif;">About&nbsp;</span><span style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif;">About&nbsp;</span><span style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif;">About&nbsp;</span><span style="color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif;">About</span></p>', 0, NULL, '', 0, '"[]"', '2016-12-09 06:05:45', '2016-12-09 06:05:45', NULL, '2016-12-09 06:05:45', 4, NULL, NULL, 4),
(46, 'en-statics', 'en-index_about', 'A few simple steps to get the desired card', NULL, '<p>A few simple steps to get the desired card&nbsp;A few simple steps to get the desired card&nbsp;A few simple steps to get the desired card&nbsp;A few simple steps to get the desired card&nbsp;A few simple steps to get the desired card</p>', 0, NULL, '', 0, '"[]"', '2016-12-09 06:06:34', '2016-12-09 06:06:34', NULL, '2016-12-09 06:06:34', 4, NULL, NULL, 4),
(47, 'en-statics', 'en-index_slide', 'Fast, easy, safe', NULL, '<p>Consultants graphic designers for layout, the first experimental texts are meaningless to simply show your customer or client</p>', 0, NULL, '/assets/photos/posts/main-title-bg.jpg', 0, '"[]"', '2016-12-09 06:07:26', '2016-12-09 06:07:26', NULL, '2016-12-09 06:07:26', 4, NULL, NULL, 4),
(48, 'en-products', '', 'Visa card Classic', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', 0, NULL, NULL, 0, '"{\\"price\\":\\"300$\\",\\"color\\":\\"gray\\"}"', '2016-12-09 13:47:17', '2016-12-09 13:47:17', NULL, '2016-12-09 13:47:17', 4, NULL, NULL, 4),
(49, 'en-products', '', 'Visa card Electron', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', 0, NULL, NULL, 0, '"{\\"price\\":\\"200$\\",\\"color\\":\\"blue\\"}"', '2016-12-09 13:51:37', '2016-12-09 13:51:37', NULL, '2016-12-09 13:51:37', 4, NULL, NULL, 4),
(50, 'en-products', '', 'Visa card Travel', NULL, '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.</p>', 0, NULL, NULL, 0, '"{\\"price\\":\\"100$\\",\\"color\\":\\"green\\"}"', '2016-12-09 13:52:10', '2016-12-09 13:52:10', NULL, '2016-12-09 13:52:10', 4, NULL, NULL, 4),
(51, 'fa-slide-show', '', 'سریع، آسان، مدرن', NULL, '<p>همگام با طراحان روز جهان</p>', 0, NULL, '/assets/photos/posts/slideshow/Untitled-5.jpg', 0, '{"link":"http:\\/\\/google.com","button":"\\u0645\\u0634\\u0627\\u0647\\u062f\\u0647"}', '2016-12-20 19:19:17', '2017-01-17 09:52:18', NULL, '2016-12-20 19:19:16', 4, NULL, NULL, 4),
(52, 'en-slide_show', '', 'Fast, easy, safe', NULL, '<p>Consultants graphic designers for layout, the first experimental texts are meaningless to simply show your customer or client</p>', 0, NULL, '/assets/photos/posts/main-title-bg.jpg', 0, '"{\\"link\\":\\"http:\\\\\\/\\\\\\/google.com\\",\\"button\\":\\"more...\\"}"', '2016-12-20 19:20:20', '2016-12-20 19:20:20', NULL, '2016-12-20 19:20:20', 4, NULL, NULL, 4),
(53, 'fa-portfolio', '', 'نمومه کار ۱', NULL, '<p>توضیحات نمونه کار ۱</p>', 0, NULL, '/assets/photos/posts/gallery/news.jpg', 0, '{"post_photos":[{"src":"\\/assets\\/photos\\/posts\\/news.jpg","label":"\\u0646\\u0645\\u0648\\u0646\\u0647 \\u06cc\\u06a9","link":""},{"src":"\\/assets\\/photos\\/posts\\/news.jpg","label":"\\u0646\\u0645\\u0648\\u0646\\u0647 \\u062f\\u0648\\u0645","link":""}]}', '2016-12-20 19:57:29', '2017-01-22 18:22:40', NULL, '2016-12-20 19:57:29', 4, NULL, NULL, 4),
(54, 'fa-slide-show', '', 'طراحی روز دنیا', NULL, '<p>زیبا و راحت</p>', 0, NULL, '/assets/photos/posts/slideshow/Untitled-6.jpg', 0, '{"link":"","button":""}', '2017-01-06 15:09:50', '2017-01-17 09:52:08', NULL, '2017-01-06 15:09:50', 4, NULL, NULL, 4),
(55, 'fa-slide-show', '', 'کیفیت برتر', NULL, '<p>با استفاده از برترین مواد اولیه</p>', 0, NULL, '/assets/photos/posts/slideshow/Untitled-1.jpg', 0, '{"link":"","button":""}', '2017-01-06 15:11:21', '2017-01-17 09:51:54', NULL, '2017-01-06 15:11:21', 4, NULL, NULL, 4),
(56, 'fa-slide-show', '', 'ساده اما چشم نواز', NULL, '<p>با رنگ های متنوع</p>', 0, NULL, '/assets/photos//posts/slideshow/Untitled-3.jpg', 0, '{"link":"","button":""}', '2017-01-06 15:14:10', '2017-01-17 09:50:57', NULL, '2017-01-06 15:14:10', 4, NULL, NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `slug`, `title`, `category`, `data_type`, `default_value`, `custom_value`, `developers_only`, `is_resident`, `created_at`, `updated_at`) VALUES
(1, 'working_hours_begin', 'شروع ساعت اداری', 'template', 'text', '۱۱', '۱۱', 0, 0, NULL, '2016-10-21 02:38:56'),
(2, 'working_hours_end', 'پایان ساعت اداری', 'template', 'text', '', '', 0, 0, NULL, '2016-10-21 02:38:56'),
(3, 'working_days', 'روزهای کاری', 'template', 'text', 'tue', 'wed', 1, 0, NULL, '2016-10-14 01:38:07'),
(4, 'slogan', 'شعار سایت', 'template', 'textarea', 'هر زمان که از من خواسته شد، در شنیدن، ایجاد ارتباط و دادن توصیه‌ای که مفید می‌دانم به کارآفرینان دریغ نکنم.', 'هر زمان که از من خواسته شد، در شنیدن، ایجاد ارتباط و دادن توصیه‌ای که مفید می‌دانم به کارآفرینان دریغ نکنم.', 0, 0, '2016-10-14 08:30:58', '2016-10-21 02:37:43'),
(5, 'overall_power', 'فعالیت سایت', 'template', 'boolean', '0', '0', 0, 0, '2016-10-14 08:39:03', '2016-10-14 08:40:33'),
(6, 'site-opening', 'تاریخ افتتاح سایت', 'template', 'date', '2016-09-25', '2016-09-25', 0, 0, '2016-10-14 08:41:10', '2016-10-21 02:37:43'),
(7, 'site_logo', 'لوگوی رنگی سایت', 'template', 'photo', 'assets/photos/posts/CjhuijfXEAEQ8UW.jpg', 'assets/photos/posts/logo.png', 0, 0, '2016-10-14 08:43:30', '2016-12-01 10:51:40'),
(8, 'register_firms', 'سازمان‌های ثبت شرکت', 'database', 'array', 'سازمان ثبت اسناد و املاک کشور\r\nسازمان مدیریت و برنامه‌ریزی کشور\r\nاتاق بازرگانی، صنایع، معادن و کشاورزی جمهوری اسلامی ایران\r\nوزارت کشور ـ‌ شهرداری‌ها و دهیاری‌ها\r\nسازمان اوقاف و امور خیریه ـ بقعه\r\nسازمان اوقاف و امور خیریه ـ موقوفات\r\nحوزه‌ی علمیه\r\nوزارت آموزش و پرورش\r\nوزارت امور اقتصادی و دارایی\r\nوزارت تعاون، کار و رفاه اجتماعی\r\nوزارت بهداشت، درمان و آموزش پزشکی\r\nوزارت جهاد کشاورزی\r\nوزارت ارتباطات و فناوری اطلاعات\r\nوزارت جهاد کشاورزی\r\nوزارت ارتباطات و فناوری اطلاعات\r\nوزارت راه و شهرسازی\r\nشورای عالی مناطق آزاد', 'سازمان ثبت اسناد و املاک کشور\r\nسازمان مدیریت و برنامه‌ریزی کشور\r\nاتاق بازرگانی، صنایع، معادن و کشاورزی جمهوری اسلامی ایران\r\nوزارت کشور ـ‌ شهرداری‌ها و دهیاری‌ها\r\nسازمان اوقاف و امور خیریه ـ بقعه\r\nسازمان اوقاف و امور خیریه ـ موقوفات\r\nحوزه‌ی علمیه\r\nوزارت آموزش و پرورش\r\nوزارت امور اقتصادی و دارایی\r\nوزارت تعاون، کار و رفاه اجتماعی\r\nوزارت بهداشت، درمان و آموزش پزشکی\r\n\r\nوزارت جهاد کشاورزی\r\nوزارت ارتباطات و فناوری اطلاعات\r\nوزارت جهاد کشاورزی\r\nوزارت ارتباطات و فناوری اطلاعات\r\n\r\nوزارت راه و شهرسازی\r\nشورای عالی مناطق آزاد', 0, 1, '2016-10-19 01:18:13', '2016-10-21 02:13:40'),
(9, 'familization', 'نحوه‌ی آشنایی', 'database', 'array', 'دوست‌ها و آشنایان\r\nآگهی‌های تبلیغاتی\r\nرسانه‌های خبری\r\nشبکه‌های اجتماعی\r\nجست‌وجوی اینترنتی\r\nراه‌های دیگر', 'دوست‌ها و آشنایان\r\nآگهی‌های تبلیغاتی\r\nرسانه‌های خبری\r\nشبکه‌های اجتماعی\r\nجست‌وجوی اینترنتی\r\nراه‌های دیگر', 0, 1, '2016-10-19 02:30:03', '2016-10-21 02:44:13'),
(10, 'banks', 'بانک‌های کشور', 'database', 'array', NULL, 'ملی ایران\r\nملت\r\nسرمایه\r\nپاسارگاد\r\nحکمت ایرانیان\r\nسامان\r\nسپه\r\nتجارت\r\nصادرات ایران\r\nتوسعه صادرات ایران\r\nپست بانک\r\nاقتصاد نوین\r\nپارسیان\r\nصنعت و معدن\r\nمسکن\r\nکشاورزی\r\nرفاه', 0, 1, '2016-10-21 02:42:30', '2016-10-21 02:44:13'),
(11, 'site_logo_bw', 'لوگوی سیاه و سفید سایت', 'template', 'photo', NULL, 'assets/photos/posts/logo-bw.png', 0, 0, '2016-12-01 10:50:37', '2016-12-01 10:51:40'),
(12, 'facebook_account', 'اکانت فیس بوک', 'socials', 'text', NULL, 'kardan_face', 0, 0, '2016-12-01 10:55:02', '2016-12-01 10:58:31'),
(13, 'twitter_account', 'اکانت توئیتر', 'socials', 'text', NULL, 'kardan_tw', 0, 0, '2016-12-01 10:55:48', '2016-12-01 10:58:31'),
(14, 'gplus_account', 'اکانت گوگل پلاس', 'socials', 'text', NULL, 'kardan_gp', 0, 0, '2016-12-01 10:56:45', '2016-12-01 10:58:31'),
(15, 'telegram_account', 'اکانت تلگرام', 'socials', 'text', NULL, 'kardan_tel', 0, 0, '2016-12-01 10:57:17', '2016-12-01 10:58:30'),
(16, 'instagram_account', 'اکانت اینستاگرام', 'socials', 'text', NULL, 'kardan_ins', 0, 0, '2016-12-01 10:57:44', '2016-12-01 10:58:30'),
(18, 'fa-address', 'آدرس فارسی', 'contact', 'text', NULL, 'ایران - تهران - خیابان ولیعصر', 0, 0, '2016-12-09 14:31:52', '2016-12-09 14:35:53'),
(20, 'fa-phone', 'تلفن فارسی', 'contact', 'text', NULL, '۰۲۱۲۲۳۳۴۴۵۵', 0, 0, '2016-12-09 14:32:39', '2016-12-09 14:35:53'),
(22, 'fa-fax', 'فکس فارسی', 'contact', 'text', NULL, '۰۲۱۳۳۴۴۶۶۷۷', 0, 0, '2016-12-09 14:33:14', '2016-12-09 14:35:53'),
(24, 'fa-email', 'آدرس ایمیل فارسی', 'contact', 'text', NULL, 'info@dimondecard.com', 0, 0, '2016-12-09 14:34:03', '2016-12-09 14:35:53'),
(25, 'domain_name', 'آدرس دامنه سایت', 'database', 'text', 'yasnateam.com', 'karsazancs.com', 1, 1, '2016-12-20 20:42:22', '2016-12-21 02:10:59'),
(26, 'httpd', 'پروتکل ارتباط کاربر', 'database', 'text', 'http://', 'http://', 1, 1, '2016-12-20 20:45:46', '2016-12-20 21:52:59'),
(27, 'use_ip', 'ورود هوشمند کاربر به سایت با استفاده از IP', 'database', 'boolean', '0', '0', 1, 1, '2016-12-20 21:48:12', '2016-12-20 22:01:51'),
(28, 'fa_site_title', 'عنوان سایت', 'template', 'text', NULL, 'کارسازان', 0, 1, '2017-01-15 10:05:30', '2017-01-15 10:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `capital_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `title`, `parent_id`, `capital_id`) VALUES
(1, '2016-07-06 19:57:55', '2016-10-11 10:22:14', NULL, NULL, NULL, NULL, 'آذربایجان شرقی', 0, 37),
(2, '2016-07-06 19:57:55', '2016-10-04 13:00:48', NULL, NULL, NULL, NULL, 'آذربایجان غربی', 0, 52),
(3, '2016-07-06 19:57:55', '2016-07-12 00:51:29', NULL, NULL, NULL, NULL, 'اردبیل', 0, 69),
(4, '2016-07-06 19:57:55', '2016-07-06 21:05:19', NULL, NULL, NULL, NULL, 'اصفهان', 0, 81),
(5, '2016-07-06 19:57:55', '2016-07-06 21:05:30', NULL, NULL, NULL, NULL, 'البرز', 0, 108),
(6, '2016-07-06 19:57:55', '2016-07-06 21:06:45', NULL, NULL, NULL, NULL, 'ایلام', 0, 111),
(7, '2016-07-06 19:57:55', '2016-07-06 21:07:21', NULL, NULL, NULL, NULL, 'بوشهر', 0, 120),
(8, '2016-07-06 19:57:55', '2016-07-06 21:05:43', NULL, NULL, NULL, NULL, 'تهران', 0, 135),
(9, '2016-07-06 19:57:55', '2016-07-06 21:14:34', NULL, NULL, NULL, NULL, 'چهار محال و بختیاری', 0, 150),
(10, '2016-07-06 19:57:55', '2016-07-06 21:12:54', NULL, NULL, NULL, NULL, 'خراسان جنوبی', 0, 156),
(11, '2016-07-06 19:57:55', '2016-07-06 21:06:05', NULL, NULL, NULL, NULL, 'خراسان رضوی', 0, 191),
(12, '2016-07-06 19:57:55', '2016-07-06 21:13:03', NULL, NULL, NULL, NULL, 'خراسان شمالی', 0, 195),
(13, '2016-07-06 19:57:55', '2016-07-06 21:07:45', NULL, NULL, NULL, NULL, 'خوزستان', 0, 207),
(14, '2016-07-06 19:57:55', '2016-07-06 21:05:55', NULL, NULL, NULL, NULL, 'زنجان', 0, 233),
(15, '2016-07-06 19:57:55', '2016-07-06 21:08:00', NULL, NULL, NULL, NULL, 'سمنان', 0, 239),
(16, '2016-07-06 19:57:55', '2016-07-06 21:11:36', NULL, NULL, NULL, NULL, 'سیستان و بلوچستان', 0, 249),
(17, '2016-07-06 19:57:55', '2016-07-06 21:05:49', NULL, NULL, NULL, NULL, 'فارس', 0, 278),
(18, '2016-07-06 19:57:55', '2016-07-06 21:08:21', NULL, NULL, NULL, NULL, 'قزوین', 0, 297),
(19, '2016-07-06 19:57:55', '2016-07-06 21:05:36', NULL, NULL, NULL, NULL, 'قم', 0, 298),
(20, '2016-07-06 19:57:55', '2016-07-06 21:12:30', NULL, NULL, NULL, NULL, 'کردستان', 0, 305),
(21, '2016-07-06 19:57:55', '2016-07-06 21:09:03', NULL, NULL, NULL, NULL, 'کرمان', 0, 327),
(22, '2016-07-06 19:57:55', '2016-07-06 21:09:23', NULL, NULL, NULL, NULL, 'کرمانشاه', 0, 342),
(23, '2016-07-06 19:57:55', '2016-07-06 21:16:59', NULL, NULL, NULL, NULL, 'کهگیلویه و بویراحمد', 0, 474),
(24, '2016-07-06 19:57:55', '2016-07-06 21:11:14', NULL, NULL, NULL, NULL, 'گلستان', 0, 363),
(25, '2016-07-06 19:57:55', '2016-07-06 21:10:12', NULL, NULL, NULL, NULL, 'گیلان', 0, 372),
(26, '2016-07-06 19:57:55', '2016-07-06 21:12:08', NULL, NULL, NULL, NULL, 'لرستان', 0, 388),
(27, '2016-07-06 19:57:55', '2016-07-06 21:10:19', NULL, NULL, NULL, NULL, 'مازندران', 0, 403),
(28, '2016-07-06 19:57:55', '2016-07-06 21:10:34', NULL, NULL, NULL, NULL, 'مرکزی', 0, 418),
(29, '2016-07-06 19:57:55', '2016-07-06 21:10:48', NULL, NULL, NULL, NULL, 'هرمزگان', 0, 432),
(30, '2016-07-06 19:57:55', '2016-07-06 21:09:40', NULL, NULL, NULL, NULL, 'همدان', 0, 450),
(31, '2016-07-06 19:57:55', '2016-07-06 21:09:45', NULL, NULL, NULL, NULL, 'یزد', 0, 460),
(32, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'آذرشهر', 1, NULL),
(33, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'اسکو', 1, NULL),
(34, '2016-07-06 19:57:55', '2016-10-11 11:46:51', NULL, NULL, NULL, NULL, 'اهر', 1, NULL),
(35, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'بستان آباد', 1, NULL),
(36, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'بناب', 1, NULL),
(37, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'تبریز', 1, NULL),
(38, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'جلفا', 1, NULL),
(39, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'چاراویماق', 1, NULL),
(40, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'خدا آفرین', 1, NULL),
(41, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'سراب', 1, NULL),
(42, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'شبستر', 1, NULL),
(43, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'عجب شیر', 1, NULL),
(44, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'کلیبر', 1, NULL),
(45, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'مراغه', 1, NULL),
(46, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'مرند', 1, NULL),
(47, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'ملکان', 1, NULL),
(48, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'میانه', 1, NULL),
(49, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'ورزقان', 1, NULL),
(50, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'هریس', 1, NULL),
(51, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'هشترود', 1, NULL),
(52, '2016-07-06 19:57:55', '2016-10-04 12:43:47', NULL, NULL, NULL, NULL, 'ارومیه', 2, NULL),
(53, '2016-07-06 19:57:55', '2016-07-10 07:20:13', NULL, NULL, NULL, NULL, 'اشنویه', 2, NULL),
(54, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'بوکان', 2, NULL),
(55, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'پلدشت', 2, NULL),
(56, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'پیرانشهر', 2, NULL),
(57, '2016-07-06 19:57:55', '2016-10-04 12:59:20', NULL, NULL, NULL, NULL, 'تکاب', 2, NULL),
(58, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'چالدران', 2, NULL),
(59, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'چایپاره', 2, NULL),
(60, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'خوی', 2, NULL),
(61, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'سر دشت', 2, NULL),
(62, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'سلماس', 2, NULL),
(63, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'شاهین دژ', 2, NULL),
(64, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'شوط', 2, NULL),
(65, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'ماکو', 2, NULL),
(66, '2016-07-06 19:57:55', '2016-07-06 20:53:08', NULL, NULL, NULL, NULL, 'مهاباد', 2, NULL),
(67, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'میاندوآب', 2, NULL),
(68, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نقده', 2, NULL),
(69, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اردبیل', 3, NULL),
(70, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بیله سوار', 3, NULL),
(71, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'پارس آباد', 3, NULL),
(72, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خلخال', 3, NULL),
(73, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سرعین', 3, NULL),
(74, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کوثر', 3, NULL),
(75, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گرمی', 3, NULL),
(76, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مشگین شهر', 3, NULL),
(77, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نمین', 3, NULL),
(78, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نیر', 3, NULL),
(79, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'آران و بیدگل', 4, NULL),
(80, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اردستان', 4, NULL),
(81, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اصفهان', 4, NULL),
(82, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'برخوار', 4, NULL),
(83, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بوئین میاندشت', 4, NULL),
(84, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'تیران و کرون', 4, NULL),
(85, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'چادگان', 4, NULL),
(86, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خمینی شهر', 4, NULL),
(87, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خوانسار', 4, NULL),
(88, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خور و بیابانک', 4, NULL),
(89, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دهاقان', 4, NULL),
(90, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سمیرم', 4, NULL),
(91, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شاهین شهر و میمه', 4, NULL),
(92, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شهرضا', 4, NULL),
(93, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فریدن', 4, NULL),
(94, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فریدونشهر', 4, NULL),
(95, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فلاورجان', 4, NULL),
(96, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کاشان', 4, NULL),
(97, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گلپایگان', 4, NULL),
(98, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'لنجان', 4, NULL),
(99, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مبارکه', 4, NULL),
(100, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نائین', 4, NULL),
(101, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نجف آباد', 4, NULL),
(102, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نطنز', 4, NULL),
(104, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اشتهارد', 5, NULL),
(105, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ساوجبلاغ', 5, NULL),
(106, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'طالقان', 5, NULL),
(107, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فردیس', 5, NULL),
(108, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کرج', 5, NULL),
(109, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نظر آباد', 5, NULL),
(110, '2016-07-06 19:57:55', '2016-07-16 07:02:19', NULL, NULL, NULL, NULL, 'آبدانان', 6, NULL),
(111, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ایلام', 6, NULL),
(112, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ایوان', 6, NULL),
(113, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بدره', 6, NULL),
(114, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'چرداول', 6, NULL),
(115, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دره شهر', 6, NULL),
(116, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دهلران', 6, NULL),
(117, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سیروان', 6, NULL),
(118, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ملکشاهی', 6, NULL),
(119, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مهران', 6, NULL),
(120, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بوشهر', 7, NULL),
(121, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'تنگستان', 7, NULL),
(122, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'جم', 7, NULL),
(123, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دشتستان', 7, NULL),
(124, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دشتی', 7, NULL),
(125, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دیر', 7, NULL),
(126, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دیلم', 7, NULL),
(127, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'عسلویه', 7, NULL),
(128, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کنگان', 7, NULL),
(129, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گناوه', 7, NULL),
(130, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اسلامشهر', 8, NULL),
(131, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بهارستان', 8, NULL),
(132, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'پاکدشت', 8, NULL),
(133, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'پردیس', 8, NULL),
(134, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'پیشوا', 8, NULL),
(135, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'تهران', 8, NULL),
(136, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دماوند', 8, NULL),
(137, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رباط کریم', 8, NULL),
(138, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ری', 8, NULL),
(139, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شمیرانات', 8, NULL),
(140, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شهریار', 8, NULL),
(141, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فیروز کوه', 8, NULL),
(142, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'قدس', 8, NULL),
(143, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'قرچک', 8, NULL),
(144, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ملارد', 8, NULL),
(145, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ورامین', 8, NULL),
(146, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اردل', 9, NULL),
(147, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بروجن', 9, NULL),
(148, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بن', 9, NULL),
(149, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سامان', 9, NULL),
(150, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شهر کرد', 9, NULL),
(151, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فارسان', 9, NULL),
(152, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کوهرنگ', 9, NULL),
(153, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کیار', 9, NULL),
(154, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'لردگان', 9, NULL),
(155, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بشرویه', 10, NULL),
(156, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بیرجند', 10, NULL),
(157, '2016-07-06 19:57:55', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خوسف', 10, NULL),
(158, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'درمیان', 10, NULL),
(159, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'زیرکوه', 10, NULL),
(160, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سرایان', 10, NULL),
(161, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سربیشه', 10, NULL),
(162, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'طبس', 10, NULL),
(163, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فردوس', 10, NULL),
(164, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'قائنات', 10, NULL),
(165, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نهبندان', 10, NULL),
(166, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'باخرز', 11, NULL),
(167, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بجستان', 11, NULL),
(168, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بردسکن', 11, NULL),
(169, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بینالود', 11, NULL),
(170, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'تایباد', 11, NULL),
(171, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'تربت جام', 11, NULL),
(172, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'تربت حیدریه', 11, NULL),
(173, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'جغتای', 11, NULL),
(174, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'جوین', 11, NULL),
(175, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'چناران', 11, NULL),
(176, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خلیل آباد', 11, NULL),
(177, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خواف', 11, NULL),
(178, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خوشاب', 11, NULL),
(179, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'داورزن', 11, NULL),
(180, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'درگز', 11, NULL),
(181, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رشتخوار', 11, NULL),
(182, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'زاوه', 11, NULL),
(183, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سبزوار', 11, NULL),
(184, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سرخس', 11, NULL),
(185, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فریمان', 11, NULL),
(186, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فیروزه', 11, NULL),
(187, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'قوچان', 11, NULL),
(188, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کاشمر', 11, NULL),
(189, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کلات', 11, NULL),
(190, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گناباد', 11, NULL),
(191, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مشهد', 11, NULL),
(192, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مه ولات', 11, NULL),
(193, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نیشابور', 11, NULL),
(194, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اسفراین', 12, NULL),
(195, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بجنورد', 12, NULL),
(196, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'جاجرم', 12, NULL),
(197, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'راز و جرگلان', 12, NULL),
(198, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شیروان', 12, NULL),
(199, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فاروج', 12, NULL),
(200, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گرمه', 12, NULL),
(201, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مانه و سملقان', 12, NULL),
(202, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'آبادان', 13, NULL),
(203, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'آغاجاری', 13, NULL),
(204, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'امیدیه', 13, NULL),
(205, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اندیکا', 13, NULL),
(206, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اندیمشک', 13, NULL),
(207, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اهواز', 13, NULL),
(208, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ایذه', 13, NULL),
(209, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'باغ ملک', 13, NULL),
(210, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'باوی', 13, NULL),
(211, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بندر ماهشهر', 13, NULL),
(212, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بهبهان', 13, NULL),
(213, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'حمیدیه', 13, NULL),
(214, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خرمشهر', 13, NULL),
(215, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دزفول', 13, NULL),
(216, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دشت آزادگان', 13, NULL),
(217, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رامشیر', 13, NULL),
(218, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رامهرمز', 13, NULL),
(219, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شادگان', 13, NULL),
(220, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شوش', 13, NULL),
(221, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شوشتر', 13, NULL),
(222, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کارون', 13, NULL),
(223, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گتوند', 13, NULL),
(224, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'لالی', 13, NULL),
(225, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مسجد سلیمان', 13, NULL),
(226, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'هفتگل', 13, NULL),
(227, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'هندیجان', 13, NULL),
(228, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'هویزه', 13, NULL),
(229, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ابهر', 14, NULL),
(230, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ایجرود', 14, NULL),
(231, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خدابنده', 14, NULL),
(232, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خرمدره', 14, NULL),
(233, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'زنجان', 14, NULL),
(234, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سلطانیه', 14, NULL),
(235, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'طارم', 14, NULL),
(236, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ماهنشان', 14, NULL),
(237, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'آرادان', 15, NULL),
(238, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دامغان', 15, NULL),
(239, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سمنان', 15, NULL),
(240, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شاهرود', 15, NULL),
(241, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گرمسار', 15, NULL),
(242, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مهدی شهر', 15, NULL),
(243, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'میامی', 15, NULL),
(244, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ایرانشهر', 16, NULL),
(245, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'چاه بهار', 16, NULL),
(246, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خاش', 16, NULL),
(247, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دلگان', 16, NULL),
(248, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'زابل', 16, NULL),
(249, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'زاهدان', 16, NULL),
(250, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'زهک', 16, NULL),
(251, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سراوان', 16, NULL),
(252, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سرباز', 16, NULL),
(253, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سیب سوران', 16, NULL),
(254, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فنوج', 16, NULL),
(255, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'قصرقند', 16, NULL),
(256, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کنارک', 16, NULL),
(257, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مهرستان', 16, NULL),
(258, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'میرجاوه', 16, NULL),
(259, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نیک شهر', 16, NULL),
(260, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نیمروز', 16, NULL),
(261, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'هامون', 16, NULL),
(262, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'هیرمند', 16, NULL),
(263, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'آباده', 17, NULL),
(264, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ارسنجان', 17, NULL),
(265, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'استهبان', 17, NULL),
(266, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اقلید', 17, NULL),
(267, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بوانات', 17, NULL),
(268, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'پاسارگاد', 17, NULL),
(269, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'جهرم', 17, NULL),
(270, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خرامه', 17, NULL),
(271, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خرم بید', 17, NULL),
(272, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خنج', 17, NULL),
(273, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'داراب', 17, NULL),
(274, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رستم', 17, NULL),
(275, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'زرین دشت', 17, NULL),
(276, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سپیدان', 17, NULL),
(277, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سروستان', 17, NULL),
(278, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شیراز', 17, NULL),
(279, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فراشبند', 17, NULL),
(280, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فسا', 17, NULL),
(281, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فیروز آباد', 17, NULL),
(282, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'قیروکارزین', 17, NULL),
(283, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کازرون', 17, NULL),
(284, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کوار', 17, NULL),
(285, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گراش', 17, NULL),
(286, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'لارستان', 17, NULL),
(287, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'لامرد', 17, NULL),
(288, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مرودشت', 17, NULL),
(289, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ممسنی', 17, NULL),
(290, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مهر', 17, NULL),
(291, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نی ریز', 17, NULL),
(292, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'آبیک', 18, NULL),
(293, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'آوج', 18, NULL),
(294, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'البرز', 18, NULL),
(295, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بوئین زهرا', 18, NULL),
(296, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'تاکستان', 18, NULL),
(297, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'قزوین', 18, NULL),
(298, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'قم', 19, NULL),
(299, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بانه', 20, NULL),
(300, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بیجار', 20, NULL),
(301, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دهگلان', 20, NULL),
(302, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دیواندره', 20, NULL),
(303, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سروآباد', 20, NULL),
(304, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سقز', 20, NULL),
(305, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سنندج', 20, NULL),
(306, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'قروه', 20, NULL),
(307, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کامیاران', 20, NULL),
(308, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مریوان', 20, NULL),
(309, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ارزوئیه', 21, NULL),
(310, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'انار', 21, NULL),
(311, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بافت', 21, NULL),
(312, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بردسیر', 21, NULL),
(313, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بم', 21, NULL),
(314, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'جیرفت', 21, NULL),
(315, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رابر', 21, NULL),
(316, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'راور', 21, NULL),
(317, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رفسنجان', 21, NULL),
(318, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رودبار جنوب', 21, NULL),
(319, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ریگان', 21, NULL),
(320, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'زرند', 21, NULL),
(321, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سیرجان', 21, NULL),
(322, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شهر بابک', 21, NULL),
(323, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'عنبر آباد', 21, NULL),
(324, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فاریاب', 21, NULL),
(325, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فهرج', 21, NULL),
(326, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'قلعه گنج', 21, NULL),
(327, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کرمان', 21, NULL),
(328, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کوهبنان', 21, NULL),
(329, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کهنوج', 21, NULL),
(330, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'منوجان', 21, NULL),
(331, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'نرماشیر', 21, NULL),
(332, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اسلام آباد غرب', 22, NULL),
(333, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'پاوه', 22, NULL),
(334, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ثلاث باباجانی', 22, NULL),
(335, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'جوانرود', 22, NULL),
(336, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دالاهو', 22, NULL),
(337, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'روانسر', 22, NULL),
(338, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سر پل ذهاب', 22, NULL),
(339, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سنقر', 22, NULL),
(340, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'صحنه', 22, NULL),
(341, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'قصر شیرین', 22, NULL),
(342, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کرمانشاه', 22, NULL),
(343, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کنگاور', 22, NULL),
(344, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گیلانغرب', 22, NULL),
(345, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'هرسین', 22, NULL),
(346, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'باشت', 23, NULL),
(347, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بویر احمد', 23, NULL),
(348, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بهمئی', 23, NULL),
(349, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'چرام', 23, NULL),
(350, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'دنا', 23, NULL),
(351, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کهگیلویه', 23, NULL),
(352, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گچساران', 23, NULL),
(353, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'لنده', 23, NULL),
(354, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'آزاد شهر', 24, NULL),
(355, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'آق قلا', 24, NULL),
(356, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بندر گز', 24, NULL),
(357, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ترکمن', 24, NULL),
(358, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رامیان', 24, NULL),
(359, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'علی آباد', 24, NULL),
(360, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کردکوی', 24, NULL),
(361, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'کلاله', 24, NULL),
(362, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گالیکش', 24, NULL),
(363, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گرگان', 24, NULL),
(364, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گمیشان', 24, NULL),
(365, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'گنبد کاووس', 24, NULL),
(366, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مراوه تپه', 24, NULL),
(367, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'مینودشت', 24, NULL),
(368, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'آستارا', 25, NULL),
(369, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'آستانه اشرفیه', 25, NULL),
(370, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'املش', 25, NULL),
(371, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'بندر انزلی', 25, NULL),
(372, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رشت', 25, NULL),
(373, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رضوانشهر', 25, NULL),
(374, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رودبار', 25, NULL),
(375, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رودسر', 25, NULL),
(376, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'سیاهکل', 25, NULL),
(377, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'شفت', 25, NULL),
(378, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'صومعه سرا', 25, NULL),
(379, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'تالش', 25, NULL),
(380, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'فومن', 25, NULL),
(381, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'لاهیجان', 25, NULL),
(382, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'لنگرود', 25, NULL),
(383, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ماسال', 25, NULL),
(384, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'ازنا', 26, NULL),
(385, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'الیگودرز', 26, NULL),
(386, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'بروجرد', 26, NULL),
(387, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'پلدختر', 26, NULL),
(388, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'خرم آباد', 26, NULL),
(389, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'دلفان', 26, NULL),
(390, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'دورود', 26, NULL),
(391, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'دوره', 26, NULL),
(392, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'رومشکان', 26, NULL),
(393, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'سلسله', 26, NULL),
(394, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'کوهدشت', 26, NULL),
(395, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'آمل', 27, NULL),
(396, '2016-07-06 19:57:56', '2016-07-10 10:25:48', NULL, NULL, NULL, NULL, 'بابل', 27, NULL),
(397, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'بابلسر', 27, NULL),
(398, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'بهشهر', 27, NULL),
(399, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'تنکابن', 27, NULL),
(400, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'جویبار', 27, NULL),
(401, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'چالوس', 27, NULL),
(402, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'رامسر', 27, NULL),
(403, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'ساری', 27, NULL),
(404, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'سواد کوه', 27, NULL),
(405, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'سوادکوه شمالی', 27, NULL),
(406, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'سیمرغ', 27, NULL),
(407, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'عباس آباد', 27, NULL),
(408, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'فریدونکنار', 27, NULL),
(409, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'قائم شهر', 27, NULL),
(410, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'کلاردشت', 27, NULL),
(411, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'گلوگاه', 27, NULL),
(412, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'محمود آباد', 27, NULL),
(413, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'میاندورود', 27, NULL),
(414, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'نکا', 27, NULL),
(415, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'نور', 27, NULL),
(416, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'نوشهر', 27, NULL),
(417, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'آشتیان', 28, NULL),
(418, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'اراک', 28, NULL),
(419, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'تفرش', 28, NULL),
(420, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'خمین', 28, NULL),
(421, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'خنداب', 28, NULL),
(422, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'دلیجان', 28, NULL),
(423, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'زرندیه', 28, NULL),
(424, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'ساوه', 28, NULL),
(425, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'شازند', 28, NULL),
(426, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'فراهان', 28, NULL),
(427, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'کمیجان', 28, NULL),
(428, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'محلات', 28, NULL),
(429, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'ابوموسی', 29, NULL),
(430, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'بستک', 29, NULL),
(431, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'بشاگرد', 29, NULL),
(432, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'بندرعباس', 29, NULL),
(433, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'بندرلنگه', 29, NULL),
(434, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'پارسیان', 29, NULL),
(435, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'جاسک', 29, NULL),
(436, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'حاجی آباد', 29, NULL),
(437, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'خمیر', 29, NULL),
(438, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'رودان', 29, NULL),
(439, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'سیریک', 29, NULL),
(440, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'قشم', 29, NULL),
(441, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'میناب', 29, NULL),
(442, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'اسد آباد', 30, NULL),
(443, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'بهار', 30, NULL),
(444, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'تویسرکان', 30, NULL),
(445, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'رزن', 30, NULL),
(446, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'فامنین', 30, NULL),
(447, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'کبودرآهنگ', 30, NULL),
(448, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'ملایر', 30, NULL),
(449, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'نهاوند', 30, NULL),
(450, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'همدان', 30, NULL),
(451, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'ابرکوه', 31, NULL),
(452, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'اردکان', 31, NULL),
(453, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'بافق', 31, NULL),
(454, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'بهاباد', 31, NULL),
(455, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'تفت', 31, NULL),
(456, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'خاتم', 31, NULL),
(457, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'صدوق', 31, NULL),
(458, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'مهریز', 31, NULL),
(459, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'میبد', 31, NULL),
(460, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'یزد', 31, NULL),
(461, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'زیرآب', 27, NULL),
(462, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'نورآباد', 26, NULL),
(463, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'الشتر', 26, NULL),
(464, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'امیرکلا', 27, NULL),
(465, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'الوند', 18, NULL),
(466, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'رستم آباد', 25, NULL),
(467, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'منجیل', 25, NULL),
(468, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'طوالش', 25, NULL),
(469, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'برازجان', 7, NULL),
(470, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'خورموج', 7, NULL),
(471, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'اهرم', 7, NULL),
(472, '2016-07-06 19:57:56', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'ماهشهر', 13, NULL),
(473, '2016-07-06 19:57:56', '2016-07-06 20:53:10', NULL, NULL, NULL, NULL, 'کیش', 29, NULL),
(474, '2016-07-06 20:53:09', '2016-07-06 20:53:09', NULL, NULL, NULL, NULL, 'یاسوج', 23, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `customer_type`, `status`, `name_first`, `name_last`, `name_firm`, `code_melli`, `national_id`, `gender`, `email`, `mobile`, `password`, `city_id`, `province_id`, `familization`, `meta`, `roles`, `media`, `settings`, `newsletter`, `site_credit`, `remember_token`, `reset_token`, `password_force_change`, `created_at`, `updated_at`, `published_at`, `deleted_at`, `created_by`, `updated_by`, `published_by`, `deleted_by`, `destroyed_by`) VALUES
(1, 0, 99, 'طاها', 'کامکار', NULL, '0074715623', NULL, 1, 'chieftaha@gmail.com', '09122835030', '$2y$10$SbeU8U1wIp4NKHypaa3d/uGoQ9T79aX3mBzmrUvAAl2eIblrGXWXK', NULL, NULL, NULL, 'null', NULL, NULL, NULL, 1, 0, 'a9VrRZr5iizsbDkJNqmImzc2myi5qc72P4X4FEkiWfJf55Vpab19nXgLb4LG', NULL, 0, NULL, '2016-10-17 04:16:44', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 0, 99, 'نگین', 'شیرآقایی', NULL, NULL, NULL, 0, 'professor@gmail.com', '09359682654', '$2y$10$TMDPsleUjzbkFkFs.gUy7O5fg1yDLeGNqYTnfLfPGYhwrsYZuKqLG', NULL, NULL, NULL, '[]', 'eyJpdiI6Ijl4MGJ3VlRlak1lejZobU5OeVwvQUh3PT0iLCJ2YWx1ZSI6InBHc0FZaDU1TkJ0S2pYbkxEOThCRDlBalZZb3hoYnZmZTY2T0xjZmVCQ1N3enRURzhXdlRPeWxHRUsxb2JOT1BkOHd2OEZOYVpcLzJUOVFvc3hOa1U5RUc5aXBuNUVzdFRFZk9CR0Urc1pYZ0JUM1ZiSjFPQVlialVjd1BkOGQzckxsY1Zla3YxdzJaN3RxOUU1V3hNVHFIQnBic0ZjQ1Vta3hoTXJyMXQ0YitqNDIwVkI0S0V4ZHowVEdGWGJvUDYzYk9tUlFOVFE2RGMxRjAwS0x2Y3hmMVdHTGFlK1orSytKRXpJWEE3dlJXQ2ZYbkJ4dEJtXC9CS2RzWXErMVNYdTlyUDRuaEM1UFpoRm1TNE1UakJEQWVsY0twR1pDTlRqU1ZjS2xzTXdkUG9sYVk3K2VaTGRRTkY3QThvS1ZuTW5QcnpwUTBFSktWWGZ6bFdsSGJHeEhwNG4yTnd4VE9SaktpUVVJVlRISFwvT0JnMkdSZzVaU0F1SUt2S3lYYlJFYjlYREJiN1lIRlcxdFwvM3VFZXhWdjY3ZXNoSE9vc1B3WlBNRE0rSzI5UlJjYmFQcG93eXFnOWpLVHVmRWVGQ2x5QVAyZktlNXJEMGJ0U3NUWWNhZUJOSXFsTlQxamVaY0tyZ1MwakR2UXBScGxvYmpOQndQTkFcL0pUdjh2Z3ROVzF6aUZsN3lLTnhlenVhUDN6elhvM09vcHpZbzRoNjlEbEMrTW14TVFHYTJhVEhQSHVyaFpjVDVFb2FnK1AyRHBQTXordmVWNEFuTEZUMGtCS1BuZkk4OHRCckxhak5CdnVTZXVRVkJBdVwvWDB3cTRyS0NwQUVqZWdzTGtEb1pzZzZWVkx1WHA1UUdwQVBsYWwzWVQ3YXJweUVmRFJkSnZGeWZvVm9xeWloUE5iVDR0cFdHWTM1U0tqQVRVTWFCVXRBS3JucWhEZjU2QzB1XC96TW5FK3BaTzlBbUh6Qm04aVlOcjcwTjM3QlhaUHpSc1wvcDlldXhOZkw0WUpsbitjbW91OEh6dEpHMnZcL3NabEduSERoaW4zd21OOVVpRXhjVlZEZm1iOEl4ZGlQZkJObFZWejN6QVI4TEVcL2FsaFY4S2NZWVlybXp2THlKU2hINVY0RFJ6RndkdlwveGtmOWdlbjZBQmNXQnFZXC9WVWVmTXl0VzRhc0lCSDF3NVZydFlmMUNiMEJ1d3VJaGRST1UyT3B2XC9OZGhyS0dcL2NIdGtRMGRVVzNJYXM4elYxZVlLMnhOODZBaURVQ2h3XC9oTkczOWxmVDVyeHdodVNVREhhWXhmdEdNV2xEY3Y4OVFtSDY0ZHFoeFh3b1wvb0hSYjdxZ0xOWVNITTY2d0M4U2tnYmpxRElLSzRhS1NBNFdXMEdpYVV0akdJXC9IWHBMR3Z4b1YyTUVnWXhQNFNBa0RcLzNoRFJDc3hiRkRReEoyVkkzM2RURGxwc0pNR0pnNExQWDRISlU4STZxRlRRcDVyUHRxMThsK25EWFVVazVFR3RUK01xN2tkTzhhVGxWc0FZSDRlUGJMWndhXC9Hb0hyNHVVYVRjSVRKdCtvYmlMZ29tbGlNRFFEUk9TREFPeDlRMHR6VGlKOXZBa0ZhT1ptNzNaSUtUZnd4Mmo0dEdGS3NjTHhJQTB0UzJEc3RCTjByQVgrSVMydWVOVCtMWWpxZTlucz0iLCJtYWMiOiIxM2NhMzc2ZTRmMGVlZmQ4NDYyYzJiNTAwY2YzMjY3YWY1ZTIzODY5NTcyNTEwMDBkMTRiZjVkNDNkMjcwMGRjIn0=', NULL, NULL, 1, 0, NULL, NULL, 1, '2016-10-17 08:47:56', '2017-01-18 12:42:35', NULL, NULL, 1, NULL, NULL, 1, NULL),
(4, 0, 91, 'محمدهادی', 'رضایی', NULL, '0012071110', NULL, 0, 'mr.mhrezaei@gmail.com', '09122835012', '$2y$10$Twdxt5mHhJALw34u2m/qSeWv1MtMZYyNKCfjYGXXftD94NtDEav.6', NULL, NULL, NULL, '[]', 'eyJpdiI6IjV4MTNPMG1DeG5rZ2ZZYXFzcDRvMHc9PSIsInZhbHVlIjoiK3BYb0I4c1phc1E5aDVUNTFHaWkxU2FkRmhsS2luelNvUTFpMFkzT2NNQ1wvSFpOUVZ5XC9jUkE0bmV0VUZxaG1BazZOMnlhdHVvS1VJMDAwNmNLZHEyeFRBajJqaTUxS2NPOFJoOGlaMW15bUQ3VUxGUFg2YlFPUzdaSjExR21nSmJwMkJvTlpXOVR6bFpITlwvWGVEXC9RR2M4OGtITDR2eFVZOWk3NnRmU1Zibz0iLCJtYWMiOiJlMWU4YzY4MDIzOTU4OGUyYmEyMTY1NDg5MzMwNTQzODIzYjVjYWMyOGZmNWU5NmI2MTg1NmM3MTJiMmZjNzgxIn0=', NULL, NULL, 1, 0, 'pvLKjglxhyGpvtr82gW7pLgBVQqF7KlRcerqW5oDRHupo0K5ouTNy1xz8xee', NULL, 1, '2016-10-17 10:39:59', '2016-12-09 05:19:10', NULL, NULL, 3, NULL, NULL, NULL, NULL),
(5, 1, 8, 'الهه', 'مهرزادگان', '', '0322683394', '', 2, 'elaheh@mehrzadegan.com', '09359682653', '$2y$10$Y2SAQM/7rkLKabgOZy6u4.VFUN2MqkevtHqzAncYPaCNWGV1NDmYu', 135, NULL, 'شبکه‌های اجتماعی', '{"register_no":"","register_date":"2016\\/09\\/20","register_firm":"","economy_code":"","gazette_url":"","code_id":"5796","name_father":"\\u0645\\u062d\\u0645\\u062f","birth_date":"1983\\/09\\/28","marital":"1","education":"6","job":"\\u0622\\u0632\\u0627\\u062f","address":"\\u0646\\u0634\\u0627\\u0646\\u06cc","postal_code":"3435353635","telephone":"02122440439"}', NULL, NULL, NULL, 1, 6000, NULL, NULL, 1, '2016-10-20 11:21:05', '2016-11-18 01:03:41', NULL, NULL, 1, NULL, NULL, NULL, NULL),
(6, 2, 8, 'محمد جعفر', 'مصفا', 'تمیز نظیف منزل', '4608968882', '0041232323', 0, 'chieftaha@gmail.com1', '09359682652', '$2y$10$Fr9WqUgaEHjGTeNitN2IV.zxztMyIY.UpRpO4lp0y6rn5y2uz.reS', 218, NULL, 'رسانه‌های خبری', '{"register_no":"2323234","register_date":"2016\\/10\\/08","register_firm":"\\u0633\\u0627\\u0632\\u0645\\u0627\\u0646 \\u062b\\u0628\\u062a \\u0627\\u0633\\u0646\\u0627\\u062f \\u0648 \\u0627\\u0645\\u0644\\u0627\\u06a9 \\u06a9\\u0634\\u0648\\u0631","economy_code":"1111","gazette_url":"http:\\/\\/www.com","code_id":"","name_father":"","birth_date":"","marital":"","education":"0","job":"","address":"\\u0646\\u0634\\u0627\\u0646\\u06cc","postal_code":"1334567899","telephone":"02122440429"}', NULL, NULL, NULL, 1, 0, NULL, NULL, 1, '2016-10-20 12:45:05', '2016-11-13 06:56:51', '2016-10-20 12:45:04', NULL, 1, NULL, 1, 1, NULL),
(24, 0, 3, 'بلبلبل', 'حسینی', NULL, NULL, NULL, 0, 'yy@gg.com', '09361112030', '$2y$10$Twdxt5mHhJALw34u2m/qSeWv1MtMZYyNKCfjYGXXftD94NtDEav.6', NULL, NULL, NULL, '[]', NULL, NULL, NULL, 1, 0, NULL, NULL, 0, '2016-12-05 05:28:26', '2016-12-05 05:28:57', NULL, NULL, 0, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=475;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
