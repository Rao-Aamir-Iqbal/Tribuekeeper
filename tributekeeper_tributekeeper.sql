-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2023 at 02:52 AM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tributekeeper_tributekeeper`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_history`
--

CREATE TABLE `academic_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `diploma` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `from_year` varchar(255) NOT NULL,
  `to_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `academic_history`
--

INSERT INTO `academic_history` (`id`, `user_id`, `diploma`, `school`, `from_year`, `to_year`) VALUES
(1, 4, 'matric', 'ABC', '2020', '2022'),
(3, 4, 'fsc', 'bcd', '2022', '2024'),
(13, 2, 'matric', 'Govt AI Model High School', '2014', '2016'),
(14, 2, 'fsc', 'Punjab College', '2016', '2018'),
(17, 9, 'matric', 'bcd', '2022', '2023'),
(18, 12, 'bsc ', 'tat school', '2014', '2022'),
(20, 44, 'Test Diploma', 'Test', '2023', '2023'),
(22, 102, 'test', 'test', '2022', '2022'),
(25, 1, 'test', '123', '2022', '2022'),
(27, 117, 'Test', '123', '2022', '2023'),
(28, 117, 'Test', '123', '2023', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `ID` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `email` tinytext NOT NULL,
  `password` longtext NOT NULL,
  `date` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`ID`, `name`, `email`, `password`, `date`) VALUES
(5, 'Test Admin ', 'testadmin@gmail.com', '$2y$09$X2HDB1HO3pbvVz2VqFLHtey74mO7JHN7jwIITQkBLg3otyqFS8x.m', '18 Feb 2021');

-- --------------------------------------------------------

--
-- Table structure for table `admin_request`
--

CREATE TABLE `admin_request` (
  `id` int(40) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `free_membership` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_request`
--

INSERT INTO `admin_request` (`id`, `user_id`, `free_membership`) VALUES
(4, 49, 'used'),
(6, 6, 'used');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(550) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `user_id`, `firstname`, `lastname`, `email`, `message`) VALUES
(6, 0, 'aamir', 'sdf', 'admin@gmail.com', 'asjkdh kshdf shf sjdfh'),
(7, 0, 'ali', 'asd', 'amillioninv@hotmail.com', 'asfg adfasdf');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(300) NOT NULL,
  `description` varchar(550) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `location` varchar(250) NOT NULL,
  `event_link` varchar(300) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `description`, `date`, `time`, `location`, `event_link`, `image`) VALUES
(7, 1, 'Test', 'test', '2023-05-31', '18:36:00', 'test', 'test', 'Upload2023050312959.png'),
(12, 49, 'eid', 'sadfsdf', '2023-05-23', '21:53:00', 'Islamabad, City', 'safd', 'Upload2023052488599.png'),
(13, 49, 'marrige', 'sadfsdf', '2021-06-14', '21:59:00', 'sadfaf', 'sadfasdf', 'Upload2023052477221.png'),
(14, 102, 'test', 'test', '2023-05-31', '18:34:00', 'test', 'test', 'Upload2023052930286.png'),
(15, 117, 'Test 123', '1234545464', '2023-05-30', '20:27:00', '545454', '4654654', 'Upload2023053042632.jpg'),
(16, 117, 'test123123', '1231313231', '2023-05-30', '20:32:00', 'test', '44646', 'Upload2023053011404.png'),
(17, 6, 'abc', 'llkewflwa', '2023-05-18', '22:56:00', 'sargodha, Pakistan', 'ytikfjh', 'Upload2023060377879.jpg'),
(18, 6, 'abc', 'llkewflwa', '2023-05-18', '22:56:00', 'sargodha, Pakistan', 'ytikfjh', 'Upload2023060345969.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `event_comments`
--

CREATE TABLE `event_comments` (
  `id` int(250) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(40) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `timestamp` timestamp(6) NULL DEFAULT NULL,
  `reply_id` int(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `family_member`
--

CREATE TABLE `family_member` (
  `id` int(11) NOT NULL,
  `selected_user_id` int(250) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `date_of_death` varchar(255) DEFAULT NULL,
  `email` tinytext DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `relationship` varchar(250) DEFAULT NULL,
  `He-is-your` varchar(250) DEFAULT NULL,
  `He-is-your-Parent-side` varchar(250) DEFAULT NULL,
  `You-are-his` varchar(250) DEFAULT NULL,
  `You-are-his-Parent-side` varchar(250) DEFAULT NULL,
  `She-is-your` varchar(255) DEFAULT NULL,
  `She-is-your-Parent-side` varchar(250) DEFAULT NULL,
  `You-are-her` varchar(255) DEFAULT NULL,
  `You-are-her-Parent-side` varchar(250) DEFAULT NULL,
  `They-are-your` varchar(250) DEFAULT NULL,
  `They-are-your-Parent-side` varchar(250) DEFAULT NULL,
  `You-are-their` varchar(250) DEFAULT NULL,
  `You-are-their-Parent-side` varchar(250) DEFAULT NULL,
  `parent_side_one` varchar(11) DEFAULT NULL,
  `parent_side_two` varchar(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `varify` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `family_member`
--

INSERT INTO `family_member` (`id`, `selected_user_id`, `firstname`, `middlename`, `lastname`, `suffix`, `date_of_birth`, `date_of_death`, `email`, `gender`, `relationship`, `He-is-your`, `He-is-your-Parent-side`, `You-are-his`, `You-are-his-Parent-side`, `She-is-your`, `She-is-your-Parent-side`, `You-are-her`, `You-are-her-Parent-side`, `They-are-your`, `They-are-your-Parent-side`, `You-are-their`, `You-are-their-Parent-side`, `parent_side_one`, `parent_side_two`, `user_id`, `image`, `varify`) VALUES
(14, NULL, 'USAMA', 'waheed', 'WAHEED', 'kljdsfg', '2023-01-01', '2023-01-01', 'usamawaheed990@gmail.com', 'm', 'father', 'father', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, '', NULL),
(28, 132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'm', 'father', 'father', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `home_town`
--

CREATE TABLE `home_town` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `interests`
--

CREATE TABLE `interests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `interest_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `interests`
--

INSERT INTO `interests` (`id`, `user_id`, `interest_name`) VALUES
(32, 4, 'Cricket'),
(38, 4, 'Hockey'),
(49, 2, 'Cricket'),
(51, 9, 'Cricket'),
(52, 9, 'ricket'),
(53, 12, 'kuch be'),
(55, 44, 'Test'),
(56, 44, 'Test2'),
(57, 102, 'test'),
(58, 1, 'Test1'),
(59, 1, 'Test2'),
(60, 117, 'Test1'),
(61, 117, 'Test2');

-- --------------------------------------------------------

--
-- Table structure for table `keepers`
--

CREATE TABLE `keepers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'admin',
  `kepper_ids` longtext NOT NULL COMMENT 'keeper of'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `keepers`
--

INSERT INTO `keepers` (`id`, `user_id`, `kepper_ids`) VALUES
(6, 102, '134'),
(7, 102, '135'),
(8, 1, '136'),
(9, 1, '137'),
(10, 1, '138'),
(11, 1, '139'),
(12, 1, '140'),
(13, 1, '141'),
(14, 49, '142');

-- --------------------------------------------------------

--
-- Table structure for table `mementose_comments`
--

CREATE TABLE `mementose_comments` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mementose_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mementose_comments`
--

INSERT INTO `mementose_comments` (`ID`, `user_id`, `mementose_id`, `comment`, `date`) VALUES
(36, 102, 66, 'test', '2023-05-29 09:01:37'),
(37, 93, 66, 'test123', '2023-05-29 09:04:02');

-- --------------------------------------------------------

--
-- Table structure for table `mementose_pictures`
--

CREATE TABLE `mementose_pictures` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_path` varchar(535) NOT NULL,
  `type` enum('2','3') NOT NULL COMMENT '2=Myself, 3=Public',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mementose_pictures`
--

INSERT INTO `mementose_pictures` (`ID`, `user_id`, `image_path`, `type`, `date`) VALUES
(50, 1, '168309265016451f4aa04d58.jpg', '3', '2023-05-03 10:44:10'),
(51, 1, '168309374116451f8ed9aada.jpg', '3', '2023-05-03 11:02:21'),
(52, 1, '168309374116451f8ed9d1c5.jpg', '3', '2023-05-03 11:02:21'),
(54, 1, '168309374116451f8eda08bd.jpg', '3', '2023-05-03 11:02:21'),
(55, 1, '1683098604164520becb225c.jpg', '2', '2023-05-03 12:23:24'),
(58, 6, '168335707216455fd901684e.jpg', '2', '2023-05-06 12:11:12'),
(59, 6, '168335707216455fd9017328.jpg', '2', '2023-05-06 12:11:12'),
(60, 6, '168335707216455fd9018489.jpg', '2', '2023-05-06 12:11:12'),
(61, 6, '168335707216455fd9018c1d.jpg', '2', '2023-05-06 12:11:12'),
(65, 49, '16848437891646cad0d070a5.png', '2', '2023-05-23 08:09:49'),
(67, 102, '1685364400164749eb0db3f1.jpg', '3', '2023-05-29 08:46:40'),
(68, 102, '168536482616474a05a2cc6d.jpg', '3', '2023-05-29 08:53:46'),
(69, 102, '168536482616474a05a32eae.jpg', '3', '2023-05-29 08:53:46'),
(70, 102, '168536482616474a05a3369c.jpg', '3', '2023-05-29 08:53:46'),
(71, 102, '168536482616474a05a352fc.jpg', '3', '2023-05-29 08:53:46'),
(72, 102, '168536482616474a05a36dc5.jpg', '3', '2023-05-29 08:53:46'),
(75, 117, '168545671716476074d550a5.jpg', '3', '2023-05-30 10:25:17'),
(76, 117, '168545671716476074d562d8.jpg', '3', '2023-05-30 10:25:17'),
(77, 117, '168545671716476074d567ed.jpg', '3', '2023-05-30 10:25:17'),
(78, 117, '168545671716476074d578b4.jpg', '2', '2023-05-30 10:25:17'),
(79, 117, '168545671716476074d582f1.jpg', '2', '2023-05-30 10:25:17'),
(80, 49, '16855262181647716ca90e85.jpg', '2', '2023-05-31 05:43:38'),
(81, 121, '168563395216478bba09d171.jpg', '3', '2023-06-01 11:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `mementose_videos`
--

CREATE TABLE `mementose_videos` (
  `ID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `video_path` varchar(535) NOT NULL,
  `type` enum('2','3') NOT NULL COMMENT '2=Myself, 3=Public',
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `mementose_videos`
--

INSERT INTO `mementose_videos` (`ID`, `user_id`, `video_path`, `type`, `date`) VALUES
(75, 1, '168544581516475dcb7233eb.mp4', '2', '2023-05-30 07:23:35'),
(76, 1, '168544581516475dcb724423.mp4', '2', '2023-05-30 07:23:35'),
(77, 1, '168544881916475e8730545b.mp4', '2', '2023-05-30 08:13:39'),
(78, 1, '168544881916475e87306e36.mp4', '2', '2023-05-30 08:13:39'),
(80, 117, '16854570791647608b7c587e.mp4', '2', '2023-05-30 10:31:19'),
(81, 117, '168545724216476095a8b1f9.mp4', '2', '2023-05-30 10:34:02');

-- --------------------------------------------------------

--
-- Table structure for table `memorial_comments`
--

CREATE TABLE `memorial_comments` (
  `id` int(250) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `log_uid` varchar(250) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `title` varchar(40) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `timestamp` timestamp(6) NULL DEFAULT NULL,
  `reply_id` int(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `ID` int(11) NOT NULL,
  `thread_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `is_read` enum('1','2') NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`ID`, `thread_id`, `sender_id`, `receiver_id`, `message`, `is_read`, `date`) VALUES
(6, 545, 65464, 65456, '56465', '1', '2023-05-30 08:30:55'),
(7, 6, 1, 1, 'dsfsdfsdfsdf', '', '2023-05-30 08:32:44'),
(8, 6, 1, 1, 'sdfsdfsdfsdf', '', '2023-05-30 08:32:49'),
(11, 6, 1, 1, 'gdgdfgd', '', '2023-05-30 08:41:52'),
(12, 7, 1, 6, 'dsfsdfdsf', '', '2023-05-30 08:42:32'),
(13, 7, 1, 6, 'dsfdsfdsfsdf', '', '2023-05-30 08:42:36'),
(14, 7, 1, 6, 'dfgdfgdfg', '', '2023-05-30 08:42:39'),
(15, 8, 1, 102, 'sdfsdf', '', '2023-05-30 08:45:16'),
(16, 8, 102, 102, 'dgfgdfg', '', '2023-05-30 08:45:23'),
(17, 8, 1, 102, '46546546', '', '2023-05-30 08:45:33'),
(18, 8, 102, 102, 'dfgdfgdfgdfgdfgdfgdfgdfgdfg', '', '2023-05-30 08:45:37'),
(19, 11, 117, 52, 'test', '', '2023-05-30 11:44:07'),
(23, 6, 1, 1, 'helo', '', '2023-06-02 05:46:54'),
(24, 6, 1, 1, 'dhigyiefg', '', '2023-06-03 03:24:05'),
(25, 6, 1, 1, 'dduwegdyugweyfdgwe', '', '2023-06-03 03:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `messages_threads`
--

CREATE TABLE `messages_threads` (
  `ID` int(11) NOT NULL,
  `sender_id` longtext NOT NULL,
  `receiver_id` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages_threads`
--

INSERT INTO `messages_threads` (`ID`, `sender_id`, `receiver_id`, `date`) VALUES
(6, '1', '1', '2023-05-30 08:26:15'),
(7, '1', '6', '2023-05-30 08:42:13'),
(8, '1', '102', '2023-05-30 08:44:53'),
(9, '117', '117', '2023-05-30 11:39:06'),
(10, '117', '111', '2023-05-30 11:41:46'),
(11, '117', '52', '2023-05-30 11:43:37'),
(12, '49', '49', '2023-06-01 02:15:25'),
(13, '121', '121', '2023-06-01 11:42:34'),
(14, '1', '133', '2023-06-03 06:21:16');

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE `milestones` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(550) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `user_id`, `description`, `year`) VALUES
(6, 4, 'test', '2025'),
(7, 4, 'marriage', '2023'),
(18, 2, 'Degree Completed', '2022'),
(19, 9, 'job', '2023'),
(20, 12, 'barbadi date', '2019'),
(21, 44, 'Test Milestones', '2023'),
(23, 102, 'test', '2022'),
(25, 1, 'Test', '2023'),
(26, 1, 'Test2', '2023'),
(27, 1, 'Test3', '2023'),
(29, 117, 'Test', '2023'),
(30, 117, 'Test', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `occupation`
--

CREATE TABLE `occupation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `company` varchar(255) NOT NULL,
  `from_year` varchar(255) NOT NULL,
  `to_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `occupation`
--

INSERT INTO `occupation` (`id`, `user_id`, `occupation`, `company`, `from_year`, `to_year`) VALUES
(5, 4, 'web', 'Eziline', '2023', '2023'),
(8, 4, 'seo', 'Softileo', '2022', '2023'),
(9, 4, 'web design', 'Softileo', '2022', '2023'),
(27, 2, 'Laravel', 'Eziline', '2022', '2022'),
(28, 2, 'PHP', 'Softileo', '2022', '2023'),
(30, 9, 'web', 'softileo', '2022', '2023'),
(31, 9, 'SEO', '1', '2022', '2023'),
(32, 12, 'student', 'softileo', '2010', '2022'),
(33, 2, 'web', 'softileo', '2022', '2024'),
(36, 44, 'Test Occupational', 'Test', '2023', '2023'),
(37, 44, 'Test Occupational 2', 'Test', '2023', '2023'),
(38, 102, 'test', 'test', '2022', '2022'),
(41, 1, 'test123', '123', '2020', '2022'),
(44, 117, 'Test', '123123', '2023', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `other_city`
--

CREATE TABLE `other_city` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_memorial`
--

CREATE TABLE `profile_memorial` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `memorial_textarea` varchar(255) DEFAULT NULL,
  `favorite_saying` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_memorial`
--

INSERT INTO `profile_memorial` (`id`, `user_id`, `memorial_textarea`, `favorite_saying`, `status`) VALUES
(4, 49, '    <p>testing memorials uiosuf</p>', 'asafaf', 1),
(5, 117, ' <p>Test</p>', 'test', 1),
(6, 1, ' wrwer', 'werwer', 1),
(7, 120, ' ', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(40) NOT NULL,
  `user_id` int(100) DEFAULT NULL,
  `amount` int(255) DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `amount`, `date`) VALUES
(4, 6, 2000, '2023-05-27 11:02:25'),
(5, 6, 2000, '2023-05-27 11:02:45'),
(6, 49, 2000, '2023-05-28 03:12:04'),
(7, 49, 2000, '2023-05-28 03:16:11'),
(8, 49, 2000, '2023-05-28 03:21:23'),
(9, 49, 2000, '2023-05-28 03:23:29'),
(10, 49, 2000, '2023-05-28 03:27:30'),
(11, 49, 2000, '2023-05-28 03:32:36'),
(12, 49, 2000, '2023-05-28 03:35:18'),
(13, 49, 2000, '2023-05-28 03:49:13'),
(14, 49, 2000, '2023-05-28 03:49:44'),
(15, 49, 2000, '2023-05-28 03:52:02'),
(16, 6, 2000, '2023-05-28 04:14:14'),
(18, 1, 2000, '2023-05-29 11:26:01'),
(19, 102, 2000, '2023-05-29 12:56:39'),
(20, 1, 2000, '2023-05-30 05:05:43'),
(21, 49, 2000, '2023-05-30 09:57:15'),
(22, 49, 2000, '2023-05-30 10:21:04'),
(23, 49, 2000, '2023-05-30 11:34:34'),
(24, 1, 2000, '2023-05-30 11:37:25'),
(25, 1, 2000, '2023-05-30 11:44:55'),
(26, 1, 2000, '2023-05-30 12:12:55'),
(27, 117, 2000, '2023-05-30 14:32:36'),
(28, 117, 2000, '2023-05-30 15:26:27'),
(29, 117, 2000, '2023-05-30 15:32:00'),
(30, 49, 2000, '2023-05-31 09:48:48'),
(31, 49, 2000, '2023-05-31 12:27:50'),
(32, 49, 2000, '2023-05-31 12:31:23'),
(33, 49, 2000, '2023-06-01 04:33:46'),
(34, 49, 2000, '2023-06-01 04:44:03'),
(35, 49, 2000, '2023-06-01 05:57:29'),
(36, 119, 2000, '2023-06-01 10:39:04'),
(37, 49, 2000, '2023-06-01 10:47:29'),
(38, 49, 2000, '2023-06-02 10:00:43'),
(39, 1, 2000, '2023-06-02 12:51:54'),
(40, 6, 2000, '2023-06-03 10:56:01'),
(41, 1, 2000, '2023-06-03 12:08:07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `firstname` varchar(535) NOT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `username` varchar(535) NOT NULL,
  `lastname` varchar(535) NOT NULL,
  `email` tinytext DEFAULT NULL,
  `password` longtext DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `cover_image` varchar(250) DEFAULT NULL,
  `otp_code` int(11) DEFAULT NULL,
  `token` int(11) DEFAULT NULL,
  `description` varchar(700) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `date_of_death` varchar(250) DEFAULT NULL,
  `gender` varchar(250) DEFAULT NULL,
  `religion` varchar(255) DEFAULT NULL,
  `kepper_ids` longtext DEFAULT NULL,
  `type` enum('1','2') NOT NULL,
  `status` enum('0','1','2') NOT NULL COMMENT '0: Not verified, 1: verified and 2: deactivated',
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `membership` enum('1','2') DEFAULT NULL COMMENT '1=Memberhsip, 2=Without Membersip'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `suffix`, `firstname`, `middlename`, `username`, `lastname`, `email`, `password`, `image`, `cover_image`, `otp_code`, `token`, `description`, `date_of_birth`, `date_of_death`, `gender`, `religion`, `kepper_ids`, `type`, `status`, `date`, `membership`) VALUES
(1, 'test', 'Test', '123', 'testsoftileo', 'Softileo Test', 'test@softileo.com', '$2y$10$AXtAoEUYVmpC8lmyoL0CU.BaO5u9k140VL5zUdT.vfaBMn3Qgk5ZW', 'Upload2023053193880.png', '1-200x200.jpg', 849931, 7926, NULL, '2023-05-02', NULL, 'female', 'Islam', '2,4,5', '1', '1', '2023-04-14 12:18:14', '1'),
(6, '', 'Usama', '', 'usamawaheed990@gmail.com', 'Waheed', 'usamawaheed990@gmail.com', '$2y$10$owK8eZUfRjuIpaR3RBnKp.8U4tt3hgVCpmkC2kRqEoNtxNwf6Hy7m', '9-200x200.jpg', 'Upload2023052846325.png', 721938, 6419, NULL, '', NULL, 'male', '', '', '1', '1', '2023-04-18 14:42:40', '1'),
(49, '', 'Aamir', '', 'Aamir123', 'Iqbal', 'amirraoiqbal@gmail.com', '$2y$10$FHr0XNWwVZtesVTlpff79exaJCehHZeD9lbHgnQ5d6R.89cdA4YA6', 'Upload2023060281400.jpg', '3-200x200.jpg', 476536, NULL, NULL, '', NULL, 'male', NULL, NULL, '1', '1', '2023-05-17 05:51:08', '1'),
(52, '', 'USAMA', 'waheed', 'klwqjel', 'WAHEED', 'usamawaheed990@gmail.com', '$2y$10$owK8eZUfRjuIpaR3RBnKp.8U4tt3hgVCpmkC2kRqEoNtxNwf6Hy7m', '9-200x200.jpg', NULL, 721938, 6419, NULL, '', NULL, 'male', '', '', '1', '1', '2023-04-18 14:42:40', '1'),
(102, '', 'Test Main test', 'Softileo 23', 'test8softileo', 'test test', 'test9@softileo.com', '$2y$10$5EOwWXcNYLCX7t1TpT1u7.j2S8bxvAxeH4H6DbsbwEEZ.qDf7Wib2', '5-200x200.jpg', 'Upload2023052959932.jpg', 492559, NULL, NULL, '2023-05-29', NULL, 'female', 'Islam', NULL, '1', '0', '2023-05-29 08:17:07', '1'),
(111, NULL, 'Usama', NULL, 'Usama', 'Waheed', 'usamawaheed990@hotmail.com', '$2y$10$ezSMkyaCBphfe0XMtg4qaOZYxYK76d9D9boGzlj5adJm4CHPYsUvO', NULL, NULL, 112684, NULL, NULL, NULL, NULL, 'male', NULL, NULL, '1', '0', '2023-05-30 04:06:10', '2'),
(112, NULL, 'Anwar', NULL, 'Usama', 'Ajmal', 'thecavapoochon@gmail.com', '$2y$10$QqcOQDtDiJHYDFolIVZzje8e0I4NaOTSpC9vzgLVHjkqFimVcnCC6', NULL, NULL, 856170, NULL, NULL, NULL, NULL, 'female', NULL, NULL, '1', '0', '2023-05-30 04:17:34', '2'),
(116, NULL, 'Test', 'Memorial', 'Test44261685455192', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1997-06-30', '2023-05-30', 'male', NULL, NULL, '2', '0', '2023-05-30 09:59:52', NULL),
(117, '', 'Test', 'Main', 'test7softileo', 'Profile Test', 'test7@softileo.com', '$2y$10$Muyg3fvP3oo6itjyDGDnKedDuzqw7KckovqDHcNhe4MRRgmsPQ4/e', '1-200x200.jpg', 'Upload2023053070339.png', 318439, NULL, NULL, '1995-10-16', NULL, 'male', NULL, NULL, '1', '0', '2023-05-30 10:00:48', '2'),
(119, NULL, 'mudassar', NULL, 'mudassar123', 'iqbal', 'test@gmail.com', '$2y$10$Ao3vmDMbskUBNfIQBWJsSe5s4p3lKxk9HnzaM7fXUn9VYQX50MoHi', NULL, NULL, 864942, NULL, NULL, NULL, NULL, 'male', NULL, NULL, '1', '0', '2023-06-01 06:34:45', '1'),
(120, NULL, 'Aaron', NULL, 'aaroncarr', 'Carr', 'aaron@disciplepress.com', '$2y$10$7U27oi94ePxCqeTZM.Dm5elgL3FLzypO.LKPvGr8F9ovBdbanSLPi', '6-200x200.jpg', 'Upload2023060147725.jpeg', 264501, NULL, NULL, NULL, NULL, 'male', NULL, NULL, '1', '0', '2023-06-01 11:20:20', '2'),
(121, NULL, 'Lucy', 'Blah', 'Lucy6731685633477', 'Lucy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1982-06-23', '2022-12-15', 'female', NULL, NULL, '2', '0', '2023-06-01 11:31:17', NULL),
(122, NULL, 'Test ', 'Memorial', 'Test17861685685049', 'Test ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02', '2023-06-02', 'male', NULL, NULL, '2', '0', '2023-06-02 01:50:49', NULL),
(123, NULL, 'Test', 'test', 'Test95251685699451', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02', '2023-06-02', 'male', NULL, NULL, '2', '0', '2023-06-02 05:50:51', NULL),
(124, NULL, 'Test', '46464', 'Test97301685699521', 'Test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02', '2023-06-02', 'male', NULL, NULL, '2', '0', '2023-06-02 05:52:01', NULL),
(126, NULL, 'test', '54', 'test@softileo.com', '5465464', 'test546464@softileo.com', '$2y$11$wRmqy6ZVd/dlerAPEi.HLOWWkYsbhqgnqAQ3Lpxs2dDCQ8SdjvbG.', NULL, NULL, 106562, NULL, NULL, '2023-06-02', NULL, 'male', NULL, NULL, '1', '1', '2023-06-02 05:56:59', '2'),
(128, NULL, 'Nadeem', 'ali', 'Nadeem12291685700078', 'Khan', 'test23@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02', NULL, 'male', NULL, NULL, '2', '0', '2023-06-02 06:01:18', NULL),
(129, NULL, '5345456', '', '534545678491685700153', '5665456', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02', '2023-06-02', 'male', NULL, NULL, '2', '0', '2023-06-02 06:02:33', NULL),
(130, NULL, '54544564', '', '564564654', '54545454', 'test564564654@softileo.com', '$2y$11$g8ggz5jEKDLJfekX6JqLie12/tEcF7bXW1rdwaWlQiYVJFDI366PC', NULL, NULL, NULL, NULL, NULL, '2023-06-02', NULL, 'male', NULL, NULL, '1', '0', '2023-06-02 06:03:06', '2'),
(131, NULL, 'hassan', '', 'hassan01685701277', 'ali', 'tester@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-15', NULL, 'male', NULL, NULL, '2', '0', '2023-06-02 06:21:17', NULL),
(132, NULL, 'test', 'softileo', 'test64701685702496', 'admin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-02', '2023-06-02', 'male', NULL, NULL, '2', '0', '2023-06-02 06:41:36', NULL),
(133, NULL, 'Test', '', 'Test3701685786570', 'Memorial', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-03', '2023-06-03', 'male', NULL, NULL, '2', '0', '2023-06-03 06:02:50', NULL),
(134, NULL, 'test43534', '', 'test4353474441685789389', '34534345', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-03', '2023-06-03', 'male', NULL, NULL, '2', '0', '2023-06-03 06:49:49', NULL),
(135, NULL, 'dfgdf', 'gdfgdfg', 'dfgdf78961685789501', 'dfgdfgdfg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-03', '2023-06-03', 'male', NULL, NULL, '2', '0', '2023-06-03 06:51:41', NULL),
(136, NULL, 'Ali', 'khan', 'Ali15201685790725', 'Raza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-01', '2023-06-03', 'male', NULL, NULL, '2', '0', '2023-06-03 07:12:05', '2'),
(137, NULL, 'test', '', 'test23701685791473', 'test', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-03', '2023-06-03', 'male', NULL, NULL, '2', '0', '2023-06-03 07:24:33', NULL),
(138, NULL, 'fsdf', 'sdfsdf', 'fsdf84231685792062', 'sdfsdfsdfdsf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-03', '2023-06-03', 'male', NULL, NULL, '2', '0', '2023-06-03 07:34:22', '2'),
(139, NULL, 'fsdfdsfsd', 'sdfsdffsdfsd', 'fsdfdsfsd18571685792080', 'sdfsdfsdfdsfsdfsdfsdff', 'sdfsdfsfsd@gmailsdfsdf.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-03', NULL, 'male', NULL, NULL, '2', '0', '2023-06-03 07:34:40', '2'),
(140, NULL, 'ertert', 'erter', 'ertert72791685792704', 'tertertert', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-03', '2023-06-03', 'male', NULL, NULL, '2', '0', '2023-06-03 07:45:04', '2'),
(141, NULL, 'ertert', 'erter', 'ertert98151685792790', 'tertertert', 'erterterert@soerter.com', NULL, NULL, NULL, NULL, NULL, NULL, '2023-06-03', NULL, 'male', NULL, NULL, '2', '0', '2023-06-03 07:46:30', '2'),
(142, NULL, 'ali', 'ahmad', 'ali9361685940347', 'ali', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-05-30', '2023-06-05', 'male', NULL, NULL, '2', '0', '2023-06-05 00:45:47', '2');

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE `user_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `language` varchar(50) NOT NULL DEFAULT 'english',
  `email_notifications` enum('0','1') NOT NULL DEFAULT '1',
  `keeper_news_updates` enum('0','1') NOT NULL DEFAULT '1',
  `privacy_view` enum('1','2','3','4','5') NOT NULL DEFAULT '1' COMMENT '"1" for Public, "2" for family, "3" for myself, "4" for password protected, "5" for private link sharing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`id`, `user_id`, `language`, `email_notifications`, `keeper_news_updates`, `privacy_view`) VALUES
(1, 2, 'english', '1', '1', '1'),
(2, 4, 'english', '1', '1', '1'),
(3, 5, 'english', '1', '1', '1'),
(4, 6, 'english', '0', '1', '5'),
(5, 7, 'english', '1', '1', '1'),
(6, 8, 'english', '1', '1', '1'),
(7, 9, 'english', '1', '1', '1'),
(8, 10, 'english', '1', '1', '1'),
(9, 11, 'english', '1', '1', '1'),
(10, 12, 'english', '1', '1', '1'),
(11, 13, 'english', '1', '1', '1'),
(12, 14, 'english', '1', '1', '1'),
(13, 15, 'english', '1', '1', '3'),
(14, 1, 'english', '1', '1', '3'),
(15, 46, 'english', '1', '1', '1'),
(16, 47, 'english', '1', '1', '1'),
(17, 49, 'english', '1', '1', '1'),
(18, 111, 'english', '1', '1', '1'),
(19, 112, 'english', '1', '1', '1'),
(20, 119, 'english', '1', '1', '1'),
(21, 120, 'english', '1', '1', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_history`
--
ALTER TABLE `academic_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `admin_request`
--
ALTER TABLE `admin_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_comments`
--
ALTER TABLE `event_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family_member`
--
ALTER TABLE `family_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_town`
--
ALTER TABLE `home_town`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interests`
--
ALTER TABLE `interests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `keepers`
--
ALTER TABLE `keepers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mementose_comments`
--
ALTER TABLE `mementose_comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mementose_pictures`
--
ALTER TABLE `mementose_pictures`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mementose_videos`
--
ALTER TABLE `mementose_videos`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `memorial_comments`
--
ALTER TABLE `memorial_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages_threads`
--
ALTER TABLE `messages_threads`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `milestones`
--
ALTER TABLE `milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occupation`
--
ALTER TABLE `occupation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `other_city`
--
ALTER TABLE `other_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_memorial`
--
ALTER TABLE `profile_memorial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_settings`
--
ALTER TABLE `user_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_history`
--
ALTER TABLE `academic_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admin_request`
--
ALTER TABLE `admin_request`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `event_comments`
--
ALTER TABLE `event_comments`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `family_member`
--
ALTER TABLE `family_member`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `home_town`
--
ALTER TABLE `home_town`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `interests`
--
ALTER TABLE `interests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `keepers`
--
ALTER TABLE `keepers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mementose_comments`
--
ALTER TABLE `mementose_comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `mementose_pictures`
--
ALTER TABLE `mementose_pictures`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `mementose_videos`
--
ALTER TABLE `mementose_videos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `memorial_comments`
--
ALTER TABLE `memorial_comments`
  MODIFY `id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `messages_threads`
--
ALTER TABLE `messages_threads`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `milestones`
--
ALTER TABLE `milestones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `occupation`
--
ALTER TABLE `occupation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `other_city`
--
ALTER TABLE `other_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profile_memorial`
--
ALTER TABLE `profile_memorial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(40) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `user_settings`
--
ALTER TABLE `user_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
