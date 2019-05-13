-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2019 at 09:26 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wallscript`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(200) NOT NULL,
  `admin_password` varchar(300) NOT NULL,
  `admin_email` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_email`) VALUES
(1, 'admin', '63a401a18004e5c6a5b5bd3643fbb1d5', 'admin@thewallscript.com');

-- --------------------------------------------------------

--
-- Table structure for table `advertisments`
--

CREATE TABLE `advertisments` (
  `a_id` int(11) NOT NULL,
  `a_title` varchar(200) DEFAULT NULL,
  `a_desc` varchar(300) DEFAULT NULL,
  `a_url` text,
  `a_img` varchar(100) DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '1',
  `ad_type` enum('0','1') DEFAULT '0',
  `ad_code` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `advertisments`
--

INSERT INTO `advertisments` (`a_id`, `a_title`, `a_desc`, `a_url`, `a_img`, `status`, `ad_type`, `ad_code`) VALUES
(26, 'Balloon Networks', 'A DIGITAL MARKETING AGENCY - We make you High', 'http://www.balloonnetworks.com/', 'add_1454441861.jpg', '1', '0', NULL),
(31, 'Coca Cola', 'Refresh open happiness ', 'http://www.coca-cola.com/', 'add_1454620864.jpg', '1', '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `com_id` int(11) NOT NULL,
  `comment` text,
  `msg_id_fk` int(11) DEFAULT NULL,
  `uid_fk` int(11) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `created` int(11) DEFAULT '1269249260',
  `like_count` int(11) DEFAULT '0',
  `uploads` varchar(30) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_id`, `comment`, `msg_id_fk`, `uid_fk`, `ip`, `created`, `like_count`, `uploads`) VALUES
(6, 'Good one', 74, 10, '::1', 1454704877, 0, ''),
(34, 'Best comedy television show', 44, 4, '24.99.79.198', 1455914785, 0, ''),
(10, 'nice ', 74, 14, '24.99.79.198', 1455073877, 0, ''),
(11, 'reply', 108, 14, '24.99.79.198', 1455074235, 0, ''),
(52, 'awesome', 81, 2, '106.51.235.30', 1456022154, 0, ''),
(27, 'great work', 44, 5, '24.99.79.198', 1455914281, 0, ''),
(28, 'Ideas worth spreading', 89, 5, '24.99.79.198', 1455914336, 0, ''),
(39, 'It\'s a great post', 89, 9, '24.99.79.198', 1455915241, 0, ''),
(38, 'He participated in 3 different sports in Olympicss...Outstanding person', 89, 8, '24.99.79.198', 1455915155, 0, ''),
(31, 'Love the 4th series', 44, 8, '24.99.79.198', 1455914607, 0, ''),
(37, 'very much inspiring', 89, 11, '24.99.79.198', 1455915089, 0, ''),
(33, 'yeahh,...me too', 44, 9, '24.99.79.198', 1455914698, 0, ''),
(35, 'must watch video', 89, 4, '24.99.79.198', 1455914821, 0, ''),
(36, 'Planning to watch it again:P', 44, 11, '24.99.79.198', 1455914894, 0, ''),
(41, 'Should appreciate the whole team', 44, 2, '24.99.79.198', 1455915425, 0, ''),
(42, 'He is a sports champion', 89, 2, '24.99.79.198', 1455915484, 0, ''),
(43, 'Rocking show', 44, 3, '24.99.79.198', 1455915567, 0, ''),
(45, 'People with intellectual disabilities are invisible to wider population', 89, 3, '24.99.79.198', 1455915720, 0, ''),
(46, '7 best superheroes', 44, 6, '24.99.79.198', 1455915812, 0, ''),
(47, 'Congrats and have a bright future ahead', 89, 6, '24.99.79.198', 1455915844, 0, ''),
(48, 'Have fun', 44, 14, '24.99.79.198', 1455915956, 0, ''),
(49, 'great going TED', 89, 14, '24.99.79.198', 1455915991, 0, ''),
(50, 'all in a single web', 44, 7, '24.99.79.198', 1455916057, 0, ''),
(51, 'You are superhero..!!!!', 89, 7, '24.99.79.198', 1455916109, 0, ''),
(56, '????', 169, 64, '::1', 1552036000, 0, ''),
(57, 'date ???', 170, 62, '::1', 1552323436, 0, ''),
(58, 'first u try ??', 167, 62, '::1', 1552323449, 0, ''),
(59, 'test', 175, 67, '::1', 1552637082, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `con_id` int(11) NOT NULL,
  `newsfeedPerPage` int(3) DEFAULT NULL,
  `friendsPerPage` int(3) DEFAULT NULL,
  `photosPerPage` int(3) DEFAULT NULL,
  `groupsPerPage` int(3) DEFAULT NULL,
  `adminPerPage` int(3) DEFAULT NULL,
  `uploadImage` int(11) DEFAULT NULL,
  `bannerWidth` int(11) DEFAULT NULL,
  `profileWidth` int(11) DEFAULT NULL,
  `notificationPerPage` int(3) DEFAULT NULL,
  `friendsWidgetPerPage` int(4) DEFAULT NULL,
  `gravatar` enum('0','1') DEFAULT NULL,
  `forgot` varchar(30) DEFAULT NULL,
  `applicationName` varchar(100) NOT NULL,
  `applicationDesc` text NOT NULL,
  `language_labels` enum('0','1') DEFAULT '0',
  `upload` int(11) DEFAULT NULL,
  `applicationToken` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`con_id`, `newsfeedPerPage`, `friendsPerPage`, `photosPerPage`, `groupsPerPage`, `adminPerPage`, `uploadImage`, `bannerWidth`, `profileWidth`, `notificationPerPage`, `friendsWidgetPerPage`, `gravatar`, `forgot`, `applicationName`, `applicationDesc`, `language_labels`, `upload`, `applicationToken`) VALUES
(1, 20, 20, 30, 10, 25, 5120, 900, 250, 30, 8, '0', 'forgotkey', 'Alumni Management System for CSE department IUBAT', 'social communication among Alumni', '0', 500, 'MySecretToken');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE `conversation` (
  `c_id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`c_id`, `user_one`, `user_two`, `ip`, `time`) VALUES
(5, 1, 3, '::1', 1456607882),
(6, 1, 11, '::1', 1454892420),
(7, 1, 7, '::1', 1454892430),
(19, 76, 62, '::1', 1552459888),
(16, 61, 7, '115.78.238.233', 1456198846),
(10, 1, 10, '::1', 1454892604),
(14, 6, 14, '24.99.79.198', 1455754784),
(15, 1, 6, '24.99.79.198', 1455833273),
(17, 64, 63, '::1', 1552111110),
(18, 64, 62, '::1', 1552111204);

-- --------------------------------------------------------

--
-- Table structure for table `conversation_reply`
--

CREATE TABLE `conversation_reply` (
  `cr_id` int(11) NOT NULL,
  `reply` text,
  `user_id_fk` int(11) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `time` int(11) NOT NULL,
  `c_id_fk` int(11) NOT NULL,
  `read_status` int(11) DEFAULT '1',
  `lat` varchar(30) DEFAULT NULL,
  `lang` varchar(30) DEFAULT NULL,
  `uploads` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `conversation_reply`
--

INSERT INTO `conversation_reply` (`cr_id`, `reply`, `user_id_fk`, `ip`, `time`, `c_id_fk`, `read_status`, `lat`, `lang`, `uploads`) VALUES
(5, 'Hi', 1, '::1', 1454707062, 5, 1, '', '', '0'),
(6, 'hello\n', 1, '::1', 1454892420, 6, 1, '', '', '0'),
(7, 'How are you?', 1, '::1', 1454892430, 7, 1, '', '', '0'),
(8, 'Hello', 1, '::1', 1454892441, 8, 1, '', '', '0'),
(13, 'Collegehumar mistake', 1, '::1', 1454892604, 10, 1, '', '', '0'),
(31, 'Hi', 6, '24.99.79.198', 1455042298, 14, 0, '33.8960043', '-84.446896', '156'),
(32, 'hello...great', 14, '24.99.79.198', 1455072860, 14, 0, '', '', NULL),
(33, 'Hello', 1, '107.77.90.117', 1455128075, 8, 1, '', '', NULL),
(34, 'Hi', 1, '24.99.79.198', 1455131113, 15, 0, '', '', NULL),
(36, 'how are u doing', 6, '24.99.79.198', 1455306224, 14, 1, '', '', NULL),
(37, 'are u in group?\n', 6, '24.99.79.198', 1455306341, 14, 1, '', '', NULL),
(38, 'good one\n\n', 6, '24.99.79.198', 1455754784, 14, 0, '', '', NULL),
(39, 'hello', 6, '24.99.79.198', 1455833273, 15, 0, '', '', NULL),
(43, 'hi guy', 61, '115.78.238.233', 1456198825, 16, 1, '', '', NULL),
(44, 'hello', 61, '115.78.238.233', 1456198846, 16, 1, '', '', NULL),
(46, 'asdf sdf', 1, '::1', 1456607882, 5, 1, '', '', '203,204,205,206,207'),
(47, 'gms', 64, '::1', 1551763504, 17, 0, '', '', NULL),
(48, 'hello world', 64, '::1', 1551893945, 17, 0, '', '', NULL),
(49, 'its badhon ??', 63, '::1', 1551941076, 17, 0, '', '', NULL),
(50, 'its me', 64, '::1', 1551942887, 17, 1, '', '', '253'),
(51, 'where r u?\n', 64, '::1', 1551950582, 17, 1, '', '', NULL),
(52, '', 64, '::1', 1551950592, 17, 1, '', '', '270'),
(53, '', 64, '::1', 1551950614, 17, 1, '23.8880904', '90.3868409', NULL),
(54, 'ggggg', 64, '::1', 1552111094, 17, 1, '', '', NULL),
(55, '', 64, '::1', 1552111110, 17, 1, '', '', '272'),
(56, 'ggg', 64, '::1', 1552111172, 18, 0, '', '', NULL),
(57, 'ffff', 62, '::1', 1552111204, 18, 0, '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `friend_id` int(11) NOT NULL,
  `friend_one` int(11) DEFAULT NULL,
  `friend_two` int(11) DEFAULT NULL,
  `role` varchar(5) DEFAULT NULL,
  `created` int(13) DEFAULT '1411570461'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend_id`, `friend_one`, `friend_two`, `role`, `created`) VALUES
(1, 1, 1, 'me', 1453513601),
(2, 2, 2, 'me', 1453513668),
(3, 3, 3, 'me', 1453513683),
(4, 1, 2, 'fri', 1453513752),
(10, 3, 2, 'fri', 1453602012),
(11, 2, 1, 'fri', 1453610296),
(37, 3, 1, 'fri', 1454706987),
(12, 2, 3, 'fri', 1453610301),
(13, 4, 4, 'me', 1454622129),
(14, 5, 5, 'me', 1454622257),
(15, 6, 6, 'me', 1454622323),
(16, 7, 7, 'me', 1454622349),
(17, 8, 8, 'me', 1454622596),
(25, 8, 2, 'fri', 1454646473),
(24, 8, 1, 'fri', 1454646455),
(20, 8, 4, 'fri', 1454624632),
(21, 8, 6, 'fri', 1454624638),
(22, 8, 7, 'fri', 1454624641),
(23, 10, 10, 'me', 1454624769),
(26, 8, 3, 'fri', 1454646474),
(27, 9, 1, 'fri', 1454704115),
(28, 4, 1, 'fri', 1454704243),
(29, 4, 2, 'fri', 1454704246),
(30, 4, 6, 'fri', 1454704254),
(31, 10, 1, 'fri', 1454704480),
(32, 10, 2, 'fri', 1454704483),
(77, 6, 10, 'fri', 1455835980),
(78, 6, 2, 'fri', 1455835988),
(35, 7, 6, 'fri', 1454706329),
(36, 7, 3, 'fri', 1454706332),
(38, 1, 3, 'fri', 1454707004),
(39, 1, 6, 'fri', 1454707004),
(40, 1, 10, 'fri', 1454707005),
(41, 1, 4, 'fri', 1454707006),
(42, 1, 9, 'fri', 1454707007),
(43, 1, 8, 'fri', 1454707007),
(44, 5, 1, 'fri', 1454707366),
(45, 5, 2, 'fri', 1454707370),
(47, 11, 11, 'me', 1454709579),
(48, 11, 7, 'fri', 1454709596),
(49, 11, 8, 'fri', 1454709597),
(50, 11, 9, 'fri', 1454709597),
(51, 11, 4, 'fri', 1454709598),
(52, 11, 2, 'fri', 1454709599),
(53, 11, 3, 'fri', 1454709599),
(54, 11, 6, 'fri', 1454709600),
(55, 11, 10, 'fri', 1454709600),
(56, 1, 11, 'fri', 1454710082),
(69, 7, 1, 'fri', 1455139465),
(79, 6, 1, 'fri', 1455837224),
(67, 1, 14, 'fri', 1455075072),
(109, 1, 7, 'fri', 1455898440),
(110, 1, 5, 'fri', 1455898442),
(124, 62, 62, 'me', 1551720123),
(125, 63, 63, 'me', 1551722275),
(126, 63, 62, 'fri', 1551722329),
(127, 64, 64, 'me', 1551761336),
(128, 64, 63, 'fri', 1551761473),
(129, 64, 62, 'fri', 1551761476),
(130, 65, 65, 'me', 1551761642),
(131, 65, 62, 'fri', 1551761747),
(132, 65, 64, 'fri', 1551761756),
(133, 66, 66, 'me', 1551761914),
(134, 66, 63, 'fri', 1551762105),
(135, 66, 62, 'fri', 1551762109),
(136, 66, 64, 'fri', 1551762121),
(137, 66, 65, 'fri', 1551762133),
(138, 67, 67, 'me', 1551762189),
(139, 67, 64, 'fri', 1551762249),
(140, 67, 63, 'fri', 1551762253),
(141, 67, 62, 'fri', 1551762254),
(142, 67, 66, 'fri', 1551762259),
(143, 67, 65, 'fri', 1551762263),
(144, 68, 68, 'me', 1551762329),
(145, 68, 63, 'fri', 1551762440),
(146, 68, 62, 'fri', 1551762443),
(147, 68, 65, 'fri', 1551762448),
(148, 68, 64, 'fri', 1551762448),
(149, 69, 69, 'me', 1551762497),
(150, 70, 70, 'me', 1551762598),
(151, 70, 65, 'fri', 1551762713),
(152, 70, 64, 'fri', 1551762713),
(153, 70, 62, 'fri', 1551762714),
(154, 70, 63, 'fri', 1551762715),
(155, 70, 66, 'fri', 1551762730),
(156, 70, 67, 'fri', 1551762731),
(157, 71, 71, 'me', 1551762791),
(158, 71, 68, 'fri', 1551762891),
(159, 71, 63, 'fri', 1551762892),
(160, 71, 62, 'fri', 1551762893),
(161, 71, 65, 'fri', 1551762893),
(162, 71, 64, 'fri', 1551762894),
(163, 71, 70, 'fri', 1551762907),
(164, 71, 66, 'fri', 1551762909),
(165, 71, 67, 'fri', 1551762910),
(166, 72, 72, 'me', 1551762940),
(167, 72, 65, 'fri', 1551763098),
(168, 72, 64, 'fri', 1551763099),
(169, 72, 62, 'fri', 1551763099),
(170, 72, 63, 'fri', 1551763100),
(171, 72, 70, 'fri', 1551763104),
(172, 72, 66, 'fri', 1551763105),
(173, 72, 67, 'fri', 1551763106),
(174, 73, 73, 'me', 1551888549),
(175, 63, 70, 'fri', 1551888614),
(176, 63, 67, 'fri', 1551888620),
(177, 63, 66, 'fri', 1551888621),
(178, 63, 65, 'fri', 1551888622),
(179, 63, 64, 'fri', 1551888622),
(180, 64, 65, 'fri', 1551890146),
(181, 64, 66, 'fri', 1551890147),
(182, 64, 67, 'fri', 1551890148),
(183, 64, 70, 'fri', 1551890149),
(184, 62, 72, 'fri', 1551950684),
(185, 62, 63, 'fri', 1551950685),
(186, 62, 70, 'fri', 1551950685),
(187, 62, 66, 'fri', 1551950686),
(188, 62, 67, 'fri', 1551950687),
(189, 62, 64, 'fri', 1551950688),
(190, 62, 65, 'fri', 1551950689),
(191, 74, 74, 'me', 1552284302),
(192, 74, 62, 'fri', 1552284315),
(193, 74, 71, 'fri', 1552284316),
(194, 74, 73, 'fri', 1552284316),
(195, 74, 63, 'fri', 1552284317),
(196, 74, 67, 'fri', 1552284318),
(197, 75, 75, 'me', 1552298561),
(198, 76, 76, 'me', 1552459049),
(199, 67, 70, 'fri', 1552627216);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(200) NOT NULL,
  `group_desc` text NOT NULL,
  `uid_fk` int(11) NOT NULL,
  `group_created` int(11) NOT NULL,
  `group_pic` varchar(100) DEFAULT NULL,
  `group_bg` varchar(100) DEFAULT NULL,
  `group_ip` varchar(30) DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '1',
  `group_count` int(11) DEFAULT '0',
  `group_updates` int(11) DEFAULT '0',
  `group_bg_position` varchar(20) DEFAULT '0',
  `verified` enum('0','1') DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_desc`, `uid_fk`, `group_created`, `group_pic`, `group_bg`, `group_ip`, `status`, `group_count`, `group_updates`, `group_bg_position`, `verified`) VALUES
(1, 'Jquery', 'The Write Less, Do More, JavaScript Library.', 1, 1453525254, 'user1_14546482521.png', 'bg1_14546486221.jpg', '::1', '1', 4, 4, ' -261px;', '0'),
(2, 'The Big Bang Theory', 'Most popular TV show', 2, 1454621335, 'user2_14546470881.jpg', 'bg2_14568845661.jpg', '::1', '1', 6, 7, ' -44px;', '0'),
(4, 'test', 'test group', 6, 1455836374, NULL, NULL, '24.99.79.198', '1', 1, 2, '0', '0'),
(5, '1520 BATCH', 'all 1520 please connect with this group', 64, 1551949213, 'user64_15520332591.jpg', 'bg64_15519492851.jpg', '::1', '1', 3, 3, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE `group_users` (
  `group_user_id` int(11) NOT NULL,
  `group_id_fk` int(11) NOT NULL DEFAULT '0',
  `uid_fk` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') DEFAULT '1',
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `group_users`
--

INSERT INTO `group_users` (`group_user_id`, `group_id_fk`, `uid_fk`, `status`, `created`) VALUES
(1, 1, 1, '1', 1453525254),
(3, 1, 2, '1', 1453528932),
(4, 2, 2, '1', 1454621335),
(12, 2, 1, '1', 1454708787),
(7, 1, 9, '1', 1454704146),
(8, 1, 10, '1', 1454704488),
(9, 2, 10, '1', 1454704492),
(10, 2, 6, '1', 1454707085),
(11, 2, 5, '1', 1454707375),
(13, 2, 14, '0', 1455074145),
(16, 4, 6, '1', 1455836374),
(17, 5, 64, '1', 1551949213),
(18, 5, 62, '1', 1552033317),
(19, 5, 67, '1', 1552627232);

-- --------------------------------------------------------

--
-- Table structure for table `language_labels`
--

CREATE TABLE `language_labels` (
  `labelID` int(11) NOT NULL,
  `commonFriends` varchar(100) DEFAULT NULL,
  `commonGroups` varchar(100) DEFAULT NULL,
  `commonPhotos` varchar(100) DEFAULT NULL,
  `commonCreateGroup` varchar(100) DEFAULT NULL,
  `topMenuHome` varchar(100) DEFAULT NULL,
  `topMenuMessages` varchar(100) DEFAULT NULL,
  `topMenuNotifications` varchar(100) DEFAULT NULL,
  `topMenuSeeAll` varchar(100) DEFAULT NULL,
  `topMenuSettings` varchar(100) DEFAULT NULL,
  `topMenuLogout` varchar(100) DEFAULT NULL,
  `topMenuLogin` varchar(100) DEFAULT NULL,
  `topMenuJoin` varchar(100) DEFAULT NULL,
  `commonAbout` varchar(100) DEFAULT NULL,
  `commonRecentVisitors` varchar(100) DEFAULT NULL,
  `yourPhotos` varchar(100) DEFAULT NULL,
  `photosOfYours` varchar(100) DEFAULT NULL,
  `commonFollowers` varchar(100) DEFAULT NULL,
  `boxName` varchar(100) DEFAULT NULL,
  `boxUpdates` varchar(100) DEFAULT NULL,
  `boxWebcam` varchar(100) DEFAULT NULL,
  `boxLocation` varchar(100) DEFAULT NULL,
  `buttonUpdate` varchar(100) DEFAULT NULL,
  `buttonComment` varchar(100) DEFAULT NULL,
  `buttonFollow` varchar(100) DEFAULT NULL,
  `buttonFollowing` varchar(100) DEFAULT NULL,
  `buttonMessage` varchar(100) DEFAULT NULL,
  `buttonJoinGroup` varchar(100) DEFAULT NULL,
  `buttonUnfollowGroup` varchar(100) DEFAULT NULL,
  `buttonEditGroup` varchar(100) DEFAULT NULL,
  `buttonSaveSettings` varchar(100) DEFAULT NULL,
  `buttonSocialSave` varchar(100) DEFAULT NULL,
  `buttonLogin` varchar(100) DEFAULT NULL,
  `buttonSignUp` varchar(100) DEFAULT NULL,
  `buttonForgotButton` varchar(100) DEFAULT NULL,
  `buttonSetNewPassword` varchar(100) DEFAULT NULL,
  `buttonFacebook` varchar(100) DEFAULT NULL,
  `buttonGoogle` varchar(100) DEFAULT NULL,
  `buttonMicrosoft` varchar(100) DEFAULT NULL,
  `buttonLinkedin` varchar(100) DEFAULT NULL,
  `feedLike` varchar(100) DEFAULT NULL,
  `feedUnLike` varchar(100) DEFAULT NULL,
  `feedLikeThis` varchar(100) DEFAULT NULL,
  `feedShare` varchar(100) DEFAULT NULL,
  `feedUnshare` varchar(100) DEFAULT NULL,
  `feedShareThis` varchar(100) DEFAULT NULL,
  `feedComment` varchar(100) DEFAULT NULL,
  `feedDeleteUpdate` varchar(100) DEFAULT NULL,
  `feedPosted` varchar(100) DEFAULT NULL,
  `settingsTitle` varchar(100) DEFAULT NULL,
  `settingsUsername` varchar(100) DEFAULT NULL,
  `settingsEmail` varchar(100) DEFAULT NULL,
  `settingsName` varchar(100) DEFAULT NULL,
  `settingsPassword` varchar(100) DEFAULT NULL,
  `settingsChangePassword` varchar(100) DEFAULT NULL,
  `settingsOldPassword` varchar(100) DEFAULT NULL,
  `settingsNewPassword` varchar(100) DEFAULT NULL,
  `settingsConfirmPassword` varchar(100) DEFAULT NULL,
  `settingsGroup` varchar(100) DEFAULT NULL,
  `settingsGender` varchar(100) DEFAULT NULL,
  `settingsAboutMe` varchar(100) DEFAULT NULL,
  `settingsEmailAlerts` varchar(100) DEFAULT NULL,
  `socialTitle` varchar(100) DEFAULT NULL,
  `socialFacebook` varchar(100) DEFAULT NULL,
  `socialTwitter` varchar(100) DEFAULT NULL,
  `socialGoogle` varchar(100) DEFAULT NULL,
  `socialInstagram` varchar(100) DEFAULT NULL,
  `placeSearch` varchar(100) DEFAULT NULL,
  `placeComment` varchar(100) DEFAULT NULL,
  `placeUpdate` varchar(100) DEFAULT NULL,
  `placeEmailUsername` varchar(100) DEFAULT NULL,
  `placePassword` varchar(100) DEFAULT NULL,
  `placeEmail` varchar(100) DEFAULT NULL,
  `placeUsername` varchar(100) DEFAULT NULL,
  `loginTitle` varchar(100) DEFAULT NULL,
  `emailUsername` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `forgotPassword` varchar(100) DEFAULT NULL,
  `registrationTitle` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `agreeMessage` varchar(300) DEFAULT NULL,
  `resetPassword` varchar(300) DEFAULT NULL,
  `thankYou` varchar(100) DEFAULT NULL,
  `thankYouMessage` varchar(300) DEFAULT NULL,
  `buttonYou` varchar(100) DEFAULT NULL,
  `commonViewAll` varchar(30) DEFAULT NULL,
  `placeSendMessage` varchar(100) DEFAULT NULL,
  `notiFollowingYou` varchar(100) DEFAULT NULL,
  `notiLiked` varchar(30) DEFAULT NULL,
  `notiShared` varchar(30) DEFAULT NULL,
  `notiStatus` varchar(30) DEFAULT NULL,
  `msgDeleteConversation` varchar(30) DEFAULT NULL,
  `msgConversation` varchar(100) DEFAULT NULL,
  `msgStartConversation` varchar(100) DEFAULT NULL,
  `msgNoUpdates` varchar(100) DEFAULT NULL,
  `msgNoMoreUpdates` varchar(100) DEFAULT NULL,
  `msgNoFriends` varchar(100) DEFAULT NULL,
  `msgNoMoreFriends` varchar(100) DEFAULT NULL,
  `msgNoPhotos` varchar(100) DEFAULT NULL,
  `msgNoMorePhotos` varchar(100) DEFAULT NULL,
  `msgNoViews` varchar(100) DEFAULT NULL,
  `msgNoMoreViews` varchar(100) DEFAULT NULL,
  `msgNoGroups` varchar(100) DEFAULT NULL,
  `msgNoMoreGroups` varchar(100) DEFAULT NULL,
  `commonMembers` varchar(30) DEFAULT NULL,
  `msgNoMembers` varchar(100) DEFAULT NULL,
  `msgNoMoreMembers` varchar(100) DEFAULT NULL,
  `msgNoConversations` varchar(100) DEFAULT NULL,
  `terms` varchar(30) DEFAULT NULL,
  `notiIsFollowingGroup` varchar(100) DEFAULT NULL,
  `notiCommented` varchar(30) DEFAULT NULL,
  `msgNoFollowers` varchar(100) DEFAULT NULL,
  `msgNoMoreFollowers` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `language_labels`
--

INSERT INTO `language_labels` (`labelID`, `commonFriends`, `commonGroups`, `commonPhotos`, `commonCreateGroup`, `topMenuHome`, `topMenuMessages`, `topMenuNotifications`, `topMenuSeeAll`, `topMenuSettings`, `topMenuLogout`, `topMenuLogin`, `topMenuJoin`, `commonAbout`, `commonRecentVisitors`, `yourPhotos`, `photosOfYours`, `commonFollowers`, `boxName`, `boxUpdates`, `boxWebcam`, `boxLocation`, `buttonUpdate`, `buttonComment`, `buttonFollow`, `buttonFollowing`, `buttonMessage`, `buttonJoinGroup`, `buttonUnfollowGroup`, `buttonEditGroup`, `buttonSaveSettings`, `buttonSocialSave`, `buttonLogin`, `buttonSignUp`, `buttonForgotButton`, `buttonSetNewPassword`, `buttonFacebook`, `buttonGoogle`, `buttonMicrosoft`, `buttonLinkedin`, `feedLike`, `feedUnLike`, `feedLikeThis`, `feedShare`, `feedUnshare`, `feedShareThis`, `feedComment`, `feedDeleteUpdate`, `feedPosted`, `settingsTitle`, `settingsUsername`, `settingsEmail`, `settingsName`, `settingsPassword`, `settingsChangePassword`, `settingsOldPassword`, `settingsNewPassword`, `settingsConfirmPassword`, `settingsGroup`, `settingsGender`, `settingsAboutMe`, `settingsEmailAlerts`, `socialTitle`, `socialFacebook`, `socialTwitter`, `socialGoogle`, `socialInstagram`, `placeSearch`, `placeComment`, `placeUpdate`, `placeEmailUsername`, `placePassword`, `placeEmail`, `placeUsername`, `loginTitle`, `emailUsername`, `password`, `forgotPassword`, `registrationTitle`, `email`, `username`, `agreeMessage`, `resetPassword`, `thankYou`, `thankYouMessage`, `buttonYou`, `commonViewAll`, `placeSendMessage`, `notiFollowingYou`, `notiLiked`, `notiShared`, `notiStatus`, `msgDeleteConversation`, `msgConversation`, `msgStartConversation`, `msgNoUpdates`, `msgNoMoreUpdates`, `msgNoFriends`, `msgNoMoreFriends`, `msgNoPhotos`, `msgNoMorePhotos`, `msgNoViews`, `msgNoMoreViews`, `msgNoGroups`, `msgNoMoreGroups`, `commonMembers`, `msgNoMembers`, `msgNoMoreMembers`, `msgNoConversations`, `terms`, `notiIsFollowingGroup`, `notiCommented`, `msgNoFollowers`, `msgNoMoreFollowers`) VALUES
(1, 'друзья', 'группы', 'Фото', 'Создать группу', 'Главная', 'Сообщения', 'Уведомления', 'Увидеть все', 'настройки', 'Выйти', 'Авторизоваться', 'Присоединиться', 'Около', 'Последние посетители', 'Профиль фотографии', 'Фотографии', 'Последователи', 'Что происходит', 'Обновления', 'Веб-камера', 'Место нахождения', 'Обновить', 'Комментарий', 'следить', 'Следующий', 'Сообщение', 'Вступить в группу', 'Отписаться Группа', 'Изменить группу', 'Сохранить настройки', 'Социальная Сохранить', 'Авторизоваться', 'Зарегистрироваться', 'Забыли пароль', 'Установить новый пароль - сброс', 'Войти с Facebook', 'Вход с Google', 'Вход с Microsoft', 'Вход с LinkedIn', 'подобно', 'В отличие от', 'как это', 'Поделиться', 'из открытого списка', 'поделились этой', 'Комментарий', 'Удалить обновление', 'Опубликовано в', 'Настройки Название', 'имя пользователя', 'Эл. адрес', 'имя', 'пароль', 'Изменить пароль', 'Старый пароль', 'новый пароль', 'Подтвердите Пароль', 'группа', 'Пол', 'Обо мне', 'Уведомления по электронной почте', 'Социальная Заголовок', 'Социальные сети Facebook', 'Социальная Twitter', 'Социальная Google', 'Социальная Instagram', 'Поиск людей', 'Написать комментарий', 'Написать обновление.', 'Электронная почта или имя пользователя.', 'Введите пароль', 'Введите адрес электронной почты', 'Введите имя пользователя', 'Войти Название', 'Электронная почта или имя пользователя', 'пароль', 'Забыли пароль', 'Регистрация Название', 'Эл. адрес ', 'Электронная почта или имя пользователя', 'Регистрация Согласитесь сообщение', 'Сброс пароля', 'Спасибо!', 'Пожалуйста conirm сообщение', 'Вы', 'Посмотреть все', 'Отправить сообщение', 'после вас', 'понравилось', 'общий', 'положение дел', 'Удалить беседу', 'разговор', 'Начало разговора', 'Нет обновлений', 'Нет больше обновлений', 'Нет друзей', 'Нет больше друзей', 'Нет фото', 'Нет больше фотографий', 'Нет просмотров', 'Нет больше просмотров', 'Нет групп', 'Нет больше групп', 'члены', 'Нет участников', 'Нет больше членов', 'Нет цепочек', 'сроки', 'следующая группа', 'прокомментировал', 'Нет последователи', 'Нет больше последователей');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `message` text,
  `uid_fk` int(11) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `created` int(11) DEFAULT '1269249260',
  `uploads` text,
  `like_count` int(11) DEFAULT '0',
  `comment_count` int(11) DEFAULT '0',
  `share_count` int(11) DEFAULT '0',
  `group_id_fk` int(11) DEFAULT '0',
  `lat` varchar(30) DEFAULT NULL,
  `lang` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `message`, `uid_fk`, `ip`, `created`, `uploads`, `like_count`, `comment_count`, `share_count`, `group_id_fk`, `lat`, `lang`) VALUES
(71, 'Make people fall in love with your ideas.  http://9lessons.info', 1, '::1', 1454703505, '', 12, 0, 1, 0, '', ''),
(73, 'Action Comics http://techgnotic.deviantart.com/art/ACTION-COMICS-No-40-colored-152487480', 9, '::1', 1454704104, '', 0, 0, 0, 0, '', ''),
(72, 'Jquery Performance Tips https://vimeo.com/18846584', 2, '::1', 1454703898, '', 0, 0, 0, 1, '', ''),
(94, 'Dailymotion http://www.dailymotion.com/video/x3qo4am_top-5-dog-videos-feb-5-2016_animals', 8, '::1', 1454729260, '', 0, 0, 0, 0, '', ''),
(76, 'CHVRCHES - Leave A Trace (Goldroom Remix) https://soundcloud.com/chvrches/chvrches-leave-a-trace-goldroom-remix?utm_source=soundcloud&utm_campaign=share&utm_medium=twitter', 4, '::1', 1454704760, '', 0, 0, 0, 0, '', ''),
(43, 'Batman v Superman: Dawn of Justice https://www.youtube.com/watch?v=0WWzgGyAH6Y', 2, '::1', 1454648006, '', 6, 0, 1, 0, '', ''),
(44, 'The Big Bang Theory', 2, '::1', 1454648095, '208', 11, 12, 0, 2, '', ''),
(74, 'Visual jquery http://jqapi.com/', 9, '::1', 1454704212, '', 3, 2, 0, 1, '', ''),
(78, 'Cars https://www.instagram.com/p/1Hs_EJpVY1/?taken-by=9lessons', 3, '::1', 1454706969, '', 2, 1, 0, 0, '', ''),
(79, 'The Farm to Ballet Project https://www.kickstarter.com/projects/1571646663/the-farm-to-ballet-project?ref=category_recommended', 6, '::1', 1454707207, '', 3, 2, 1, 0, '', ''),
(81, 'My darling https://www.instagram.com/p/0MYtaNJVSi/?taken-by=9lessons', 1, '::1', 1454707337, '', 1, 1, 0, 2, '', ''),
(82, 'Peafowl https://www.flickr.com/photos/parismadrid/4790999949/in/photolist-8in8np-cEFmKE-p3nZtW-9g7Awf-9KN9xA-z5mCCE-7e3tpc-guzAoE-guAPTx-guzCym-9KKkAe-969wv7-guAuxG-e74ufA-71h5yz-6Q6aBT-i5FzJQ-nZCAAY-e2NJ3b-do9ZeP-e1YroV-dUu2Cv-75njiC-54dFJo-fn4stC-e7FtFx-5PJuZs-e8c2x9-6WAzTR-guAcJa-JMGH2-qqjoRs-ChwDbW-g2J5U-eaNeKQ-guAKnD-e22DZr-4X82Bq-6pN3dp-pHkYdP-i5Gcpg-guAp5N-pUgq45-bxrmCX-aNkfEp-JMxF3-6S5cN7-s56gyK-mSW5bT-by76qn', 5, '::1', 1454707609, '', 1, 0, 2, 0, '', ''),
(83, 'https://soundcloud.com/carmadamusic/realise-manilla_killa-remix', 11, '::1', 1454710048, '', 1, 4, 0, 0, '', ''),
(84, 'HTML5 Tutorial http://www.slideshare.net/SrinivasTamada/html5-css3-basics?qid=4eda3701-48c8-449e-8dd1-fad49de8e328&v=qf1&b=&from_search=1', 11, '::1', 1454710068, '', 0, 0, 0, 0, '', ''),
(93, 'Sony Conference Ustream http://www.ustream.tv/recorded/81044847', 2, '::1', 1454729107, '', 0, 0, 1, 0, '', ''),
(86, 'How To Draw A Dog Topical: \'Fuller House\' Cast Photo Edition http://www.funnyordie.com/browse/videos/all/exclusives/most_recent/all_time', 11, '::1', 1454710328, '', 2, 2, 1, 0, '', ''),
(115, 'Best Programming website in the world www.9lessons.info\n', 2, '106.51.235.30', 1456022012, '', 0, 0, 0, 0, '12.943194499999999', '77.617419'),
(89, 'ted http://www.ted.com/talks/matthew_williams_special_olympics_let_me_be_myself_a_champion', 1, '::1', 1454728826, '', 3, 12, 0, 0, '', ''),
(95, 'Snow Tiger Coub http://coub.com/view/2y6rr08w', 9, '::1', 1454729416, '', 0, 0, 0, 0, '', ''),
(97, 'Sketchfab https://sketchfab.com/models/5608e247fa99454ba34d80ccf6959b84', 3, '::1', 1454729655, '', 0, 0, 0, 0, '', ''),
(98, 'Kickstarter https://www.kickstarter.com/projects/1428999861/the-coffeemonsters-book-illustrations-made-from-co?ref=category_featured', 7, '::1', 1454729849, '', 0, 0, 0, 0, '', ''),
(100, 'iftttt.com https://ifttt.com/recipes/94447-at-sunset-turn-on-your-lights', 7, '::1', 1454730322, '', 0, 0, 0, 0, '', ''),
(101, 'FunnyOrDie http://www.funnyordie.com/videos/062f669609/steve-harvey-miss-universe-hug?_cc=__d___&_ccid=9417b87e6d1b691d', 7, '::1', 1454730385, '', 0, 0, 0, 0, '', ''),
(114, 'Balloon Networks - The New Age of Digital Marketing Agency www.balloonnetworks.com', 2, '106.51.235.30', 1456021950, '', 0, 0, 0, 0, '', ''),
(112, 'hello', 6, '24.99.79.198', 1455836385, '', 0, 0, 0, 4, '', ''),
(116, 'https://www.youtube.com/watch?v=YqeW9_5kURI', 2, '106.51.235.30', 1456022227, '', 0, 0, 0, 0, '12.9431339', '77.61744589999999'),
(117, 'wake up https://www.youtube.com/watch?v=IcrbM1l_BoI', 2, '106.51.235.30', 1456022313, '', 0, 0, 0, 0, '', ''),
(118, '<a href=\"http://www.balloonnetworks.com/\" target=\"_blank\">Digital Marketing Agency</a>', 2, '106.51.235.30', 1456022719, '', 0, 0, 0, 0, '', ''),
(121, 'Cant\'t feel my face https://soundcloud.com/ryancurtis/cant-feel-my-face-the-weeknd-cover-free-download', 2, '106.51.235.30', 1456023120, '', 0, 0, 0, 0, '', ''),
(122, 'http://www.slideshare.net/balloonnetworks/balloon-networks-digital-marketing-ppt', 2, '106.51.235.30', 1456023872, '', 1, 0, 0, 0, '', ''),
(123, 'http://www.deviantart.com/art/Mycena-leaiana-592035779 rggargrg', 2, '106.51.235.30', 1456024332, '', 1, 0, 0, 0, '', ''),
(125, 'Netra https://www.instagram.com/p/_RtivCOfNA/?taken-by=rajeshtamada', 2, '106.51.235.30', 1456024706, '', 2, 0, 0, 0, '', ''),
(134, 'The Wall Script http://www.thewallscript.com', 1, '207.11.113.30', 1456435936, '', 1, 1, 0, 0, '', ''),
(143, '\nসিঙ্গাপুরে কাদেরের চিকিৎসা শুরু\nঅনলাইন ডেস্ক', 63, '::1', 1551761184, '', 4, 0, 0, 0, '', ''),
(144, 'ইউএনবির খবরে বলা হয়, ওবায়দুল কাদেরকে বহনকারী এয়ার অ্যাম্বুলেন্স সোমবার বাংলাদেশ সময় রাত ৮টার দিকে সিঙ্গাপুরে পৌঁছায়। অ্যাম্বুলেন্সটি সিঙ্গাপুরের সেলেটার বিমানবন্দরে অবতরণ করে বলে জানান কাদেরের ব্যক্তিগত সচিব গৌতম চন্দ্র। তিনি আরও জানান, বিমানবন্দর থেকে বাংলাদেশ সময় ৮টা ৫০ মিনিটে মন্ত্রীকে মাউন্ট এলিজাবেথ হাসপাতালে নিয়ে যাওয়া হয় এবং সেখানে তাৎক্ষণিকভাবে তাঁর চিকিৎসা শুরু হয়।', 63, '::1', 1551761208, '', 5, 0, 0, 0, '', ''),
(145, 'p:0125', 63, '::1', 1551761244, '230', 5, 0, 0, 0, '', ''),
(146, '\nমার্চে কালবৈশাখী, এপ্রিলে ঘূর্ণিঝড়ের আশঙ্কা', 64, '::1', 1551761428, '', 4, 0, 0, 0, '', ''),
(147, 'মার্চ মাসে তিন–চার দিন হালকা থেকে মাঝারি এবং মাঝারি থেকে তীব্র মাত্রার কালবৈশাখী হওয়ার আশঙ্কা রয়েছে। এরপর এপ্রিলে বঙ্গোপসাগরে এক থেকে দুটি নিম্নচাপ সৃষ্টি এবং পরবর্তী সময় একটি ঘূর্ণিঝড়ের আশঙ্কা করছে আবহাওয়া দপ্তর।', 64, '::1', 1551761445, '', 3, 0, 1, 0, '', ''),
(148, 'পটুয়াখালীর সোনার চরে পর্যটনে নতুন সম্ভাবনা', 65, '::1', 1551761710, '', 4, 0, 0, 0, '', ''),
(149, 'চার কিলোমিটার সমুদ্রসৈকত। সাজানো–গোছানো বনভূমি। দ্বীপের মধ্য দিয়ে বয়ে যাওয়া আঁকাবাঁকা খাল। আছে পাখি, বন্য প্রাণী। আর চারপাশে নিরিবিলি পরিবেশ। এখানকার সূর্যোদয় ও সূর্যাস্তের দৃশ্য সবার চোখ জুড়িয়ে দেবে।', 65, '::1', 1551761726, '', 4, 0, 0, 0, '', ''),
(151, 'দেশে তৈরি কম দামের নতুন স্মার্টফোন বাজারে ছেড়েছে ওয়ালটন, যার মডেল ‘প্রিমো ডি নাইন’। সুদৃশ্য ডিজাইনের লাল ও কালো রঙের ফোনটির দাম ২ হাজার ৯৩০ টাকা। এই ফোনে ব্যবহৃত হয়েছে চার ইঞ্চির ডব্লিউভিজিএ ডিসপ্লে। ক্যাপাসিটিভ টাচ স্ক্রিনসমৃদ্ধ উজ্জ্বল পর্দার রেজুলেশন ৮০০ বাই ৪৮০ পিক্সেল। ফলে, ইন্টারনেট ব্রাউজিং, গেম খেলা কিংবা ভিডিও দেখা যাবে। রয়েছে এলইডি নোটিফিকেশন লাইটও।\n\nওয়ালটন কর্তৃপক্ষ জানিয়েছে, দেশে সংযোজিত হওয়ার কারণে কম দামে স্মার্টফোন দেওয়া যায়। এ ছাড়া ফোনের বিক্রয়োত্তর সেবাও নিশ্চিত করা যায়।', 66, '::1', 1551762025, '', 3, 0, 0, 0, '', ''),
(152, 'cox 15', 66, '::1', 1551762083, '239', 1, 0, 0, 0, '', ''),
(153, 'গোলের লড়াইটা ভালোই জমে উঠেছে জীবন ও সানডের। আজকের জোড়া গোলের পর সাত গোল নিয়ে মুক্তিযোদ্ধার স্ট্রাইকার বাল্লো ফামুসার সঙ্গে গোলদাতার শীর্ষে সানডে। তাঁর পিছু ছাড়ছেন না জীবন। ছয় গোল করে তৃতীয় স্থানে আছেন জাতীয় দলের স্ট্রাইকার।', 68, '::1', 1551762413, '', 0, 0, 0, 0, '', ''),
(154, 'আবাহনী লিমিটেডের নাইজেরিয়ান স্ট্রাইকার সানডে চিজোবাকে নতুন করে পরিচয় করিয়ে দেওয়ার কিছু নেই। বেশ কয়েক বছর ধরে ঘরোয়া ফুটবলে গোল মেশিন হিসেবে তাঁর পরিচিতি। ময়মনসিংহের রফিকউদ্দিন ভূঁইয়া স্টেডিয়ামে আজও করেছেন জোড়া গোল। তাঁর দুই গোলের কল্যাণেই সাইফ স্পোর্টিংয়ের বিপক্ষে ৩-১ গোলে জয় পেয়েছে আবাহনী লিমিটেড। আবাহনীর অন্য গোলটি নাবীব নেওয়াজ জীবনের।', 68, '::1', 1551762431, '', 0, 0, 0, 0, '', ''),
(155, 'দুটি বিশ্ববিদ্যালয়ে বিভিন্ন পদে ১৭০ জনকে নিয়োগ দেওয়া হবে। এর মধ্যে নোয়াখালী বিজ্ঞান ও প্রযুক্তি বিশ্ববিদ্যালয়ের ৫৩টি পদে ১৫৯ জনকে নিয়োগ দেওয়া হবে। এ ছাড়া নেত্রকোনায় অবস্থিত শেখ হাসিনা বিশ্ববিদ্যালয়ে ১১টি পদে কর্মকর্তা-কর্মচারী নিয়োগ দেওয়া হবে।', 70, '::1', 1551762675, '', 2, 0, 0, 0, '', ''),
(156, 'শেখ হাসিনা বিশ্ববিদ্যালয় নেবে ১১ জন\n\nএই বিশ্ববিদ্যালয়ে উপপরিচালক (অর্থ ও হিসাব) ১ জন, সহকারী পরিচালক (পরিকল্পনা ও উন্নয়ন) ১ জন, শাখা কর্মকর্তা ২ জন, প্রশাসনিক কর্মকর্তা/ ব্যক্তিগত কর্মকর্তা ১ জন, হিসাবরক্ষক ১ জন, অফিস সহকারী কাম কম্পিউটার অপারেটর ৪ জন, ডেসপাচ ক্লার্ক ১ জন, ড্রাইভার ২ জন, অফিস সহায়ক ৪ জন, ক্লিনার ২ জন, নিরাপত্তা প্রহরী ৩ জন।', 70, '::1', 1551762701, '', 2, 0, 0, 0, '', ''),
(157, 'সরকারের দুর্নীতির অভিযোগ তুলে দায়িত্ব থেকে সরে দাঁড়িয়েছেন কানাডার প্রধানমন্ত্রী জাস্টিন ট্রুডোর শীর্ষস্থানীয় মন্ত্রী জেন ফিলপট। তিনি বলেছেন, সরকারের দুর্নীতি তদন্ত পরিচালনার বিষয়ে আত্মবিশ্বাস হারিয়ে ফেলায় তিনি পদত্যাগ করছেন। গতকাল সোমবার এ ঘোষণা দেন তিনি। বিবিসি অনলাইনের এক প্রতিবেদনে এ তথ্য জানানো হয়।', 71, '::1', 1551762840, '', 0, 0, 0, 0, '', ''),
(158, 'সৌদি সাংবাদিক জামাল খাসোগি হত্যার ব্যাপারে ট্রাম্প প্রশাসন আরও তথ্য সরবরাহে ব্যর্থ হয়েছে বলে মন্তব্য করেছেন রিপাবলিকান ও ডেমোক্রেটিক সিনেটররা। এ ব্যাপারে তাঁরা হতাশা প্রকাশ করে যুক্তরাষ্ট্রকে খাসোগি হত্যার ঘটনায় আরও জোরালো ভূমিকা রাখার আহ্বান জানিয়েছেন।', 71, '::1', 1551762860, '', 0, 0, 0, 0, '', ''),
(159, 'try to help everyone', 71, '::1', 1551762880, '248', 0, 0, 0, 0, '', ''),
(160, 'আমি ৭১ দেখিনি! তবে\n\nআহতের শরীরে ইনটেনসিভ কেয়ারে, \nলাইফ সাপোর্টে ধুঁকপুকিয়ে বেঁচে থাকা\nমনুষ্যত্বকে মারা যেতে দেখেছি। \nবিবেকের লাশকাটা ঘরে, তখন\nহিস্যায় মত্ত লম্ফরত দেশপ্রেমিক\nদাঁত কেলিয়ে ভেংচি মারে।', 72, '::1', 1551763018, '', 1, 0, 0, 0, '', ''),
(161, 'এ কি স্বদেশ আমার? স্বাধীন জন্মভূমি? \nতবে প্রকাশ্য দিবালোকে কেন হায়েনারা করে রাহাজানি? \nতবে ওরাই কি রাজাকার? আল-বদর, পাকিস্তানি? \nযারা মানচিত্রের দেহ খুবলে\nনিজ দেশে বর্বরতায় ভোগ করে গণতন্ত্রের নগ্ন দেহখানি।', 72, '::1', 1551763031, '', 0, 0, 0, 0, '', ''),
(162, 'cheapest in bd right now', 72, '::1', 1551763082, '252', 1, 0, 0, 0, '', ''),
(163, ' Oral Part of Comprehensive Examination February 7, 2019 ', 64, '::1', 1551895675, '', 0, 0, 0, 0, '', ''),
(174, 'দেশে তৈরি কম দামে', 67, '::1', 1552627305, '', 0, 0, 0, 0, '', ''),
(175, 'text fcebook', 67, '::1', 1552637006, '', 0, 1, 0, 0, '', ''),
(165, 'domestic', 64, '::1', 1551947715, '255', 0, 0, 0, 0, '', ''),
(166, '', 64, '::1', 1551950394, '0', 0, 0, 0, 0, '', ''),
(167, 'try to help everyone', 64, '::1', 1551950457, '269', 1, 1, 0, 0, '', ''),
(170, 'All rights reserved by ONE MORE ZERO GROUP, BANGLADESH.\n\nAfter the colossal success of the preceding season, \'Wind of Change\' is proud to declare - Season 2! This incredible musical platform has already established itself as the grandest stage of Bangladesh and has also transcended the borders to become a global phenomenon. World-renowned musicians are eagerly joining the revolution as \'Wind of Change\' sets its sight to be the new benchmark for musical fusion globally.', 64, '::1', 1552045562, '', 1, 1, 0, 5, '', ''),
(169, 'The Islamic State of Iraq and the Levant, also known as the Islamic State of Iraq and Syria, the Islamic State of Iraq and al-Sham, officially as the Islamic State and by its Arabic language', 62, '::1', 1552033389, '', 3, 1, 0, 5, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `message_like`
--

CREATE TABLE `message_like` (
  `like_id` int(11) NOT NULL,
  `msg_id_fk` int(11) NOT NULL,
  `uid_fk` int(11) NOT NULL,
  `ouid_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `reactionType` int(2) DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `message_like`
--

INSERT INTO `message_like` (`like_id`, `msg_id_fk`, `uid_fk`, `ouid_fk`, `created`, `reactionType`) VALUES
(9, 71, 4, 1, 1454704840, 1),
(11, 74, 10, 9, 1454704871, 1),
(13, 44, 10, 2, 1454704886, 1),
(14, 43, 10, 2, 1454704890, 1),
(12, 71, 10, 1, 1454704882, 1),
(10, 43, 4, 2, 1454704850, 1),
(15, 43, 7, 2, 1454706340, 1),
(19, 43, 3, 2, 1454706577, 1),
(69, 71, 14, 1, 1455913605, 1),
(21, 78, 1, 3, 1454707017, 1),
(22, 74, 1, 9, 1454707026, 1),
(23, 43, 1, 2, 1454707029, 1),
(35, 108, 14, 14, 1455074214, 1),
(49, 83, 1, 11, 1455823995, 1),
(26, 78, 3, 3, 1454707247, 1),
(27, 74, 3, 9, 1454707253, 1),
(28, 43, 5, 2, 1454707618, 1),
(29, 81, 1, 1, 1454707632, 1),
(30, 82, 1, 5, 1454707641, 1),
(52, 111, 1, 1, 1455831840, 1),
(51, 86, 1, 11, 1455824041, 1),
(33, 79, 14, 6, 1455073821, 1),
(36, 44, 1, 2, 1455074921, 1),
(67, 111, 6, 1, 1455837151, 1),
(65, 86, 6, 11, 1455835838, 1),
(68, 71, 1, 1, 1455913559, 1),
(71, 44, 5, 2, 1455914235, 1),
(72, 71, 5, 1, 1455914287, 1),
(73, 44, 8, 2, 1455914596, 1),
(74, 71, 8, 1, 1455914615, 1),
(75, 71, 9, 1, 1455914674, 1),
(76, 44, 9, 2, 1455914684, 1),
(77, 44, 4, 2, 1455914752, 1),
(78, 89, 4, 1, 1455914793, 1),
(80, 71, 11, 1, 1455914862, 1),
(81, 44, 11, 2, 1455914875, 1),
(82, 44, 2, 2, 1455915337, 1),
(83, 71, 2, 1, 1455915498, 1),
(84, 44, 3, 2, 1455915570, 1),
(85, 89, 3, 1, 1455915574, 1),
(86, 71, 3, 1, 1455915633, 1),
(87, 71, 6, 1, 1455915850, 1),
(88, 44, 14, 2, 1455915918, 1),
(89, 44, 7, 2, 1455916029, 1),
(90, 71, 7, 1, 1455916115, 1),
(91, 89, 7, 1, 1455916155, 1),
(92, 133, 61, 61, 1456198762, 1),
(95, 79, 1, 6, 1456435908, 4),
(96, 125, 9, 2, 1456435987, 2),
(97, 123, 11, 2, 1456436010, 4),
(98, 122, 11, 2, 1456436022, 6),
(99, 79, 2, 6, 1456546143, 1),
(138, 134, 2, 1, 1456604559, 4),
(133, 125, 2, 2, 1456549452, 5),
(143, 144, 64, 63, 1551761536, 1),
(144, 143, 64, 63, 1551761538, 1),
(145, 145, 64, 63, 1551761540, 1),
(146, 145, 65, 63, 1551761738, 2),
(147, 144, 65, 63, 1551761739, 1),
(148, 143, 65, 63, 1551761742, 1),
(149, 146, 65, 64, 1551761773, 1),
(150, 147, 65, 64, 1551761775, 1),
(151, 146, 66, 64, 1551762141, 1),
(152, 149, 66, 65, 1551762143, 1),
(153, 145, 66, 63, 1551762146, 1),
(154, 144, 66, 63, 1551762150, 1),
(155, 143, 66, 63, 1551762153, 1),
(156, 148, 66, 65, 1551762156, 1),
(157, 149, 67, 65, 1551762272, 1),
(158, 146, 67, 64, 1551762276, 1),
(159, 148, 67, 65, 1551762279, 1),
(160, 147, 67, 64, 1551762282, 1),
(161, 151, 67, 66, 1551762284, 1),
(162, 145, 67, 63, 1551762286, 1),
(163, 143, 67, 63, 1551762288, 1),
(164, 144, 67, 63, 1551762291, 1),
(165, 156, 72, 70, 1551763129, 1),
(166, 155, 72, 70, 1551763131, 1),
(167, 148, 72, 65, 1551763134, 1),
(168, 151, 72, 66, 1551763137, 1),
(169, 152, 72, 66, 1551763145, 3),
(170, 144, 72, 63, 1551763148, 2),
(171, 146, 72, 64, 1551763151, 1),
(172, 145, 72, 63, 1551763154, 1),
(173, 160, 64, 72, 1551763452, 1),
(174, 162, 64, 72, 1551763454, 1),
(178, 147, 64, 64, 1551890613, 2),
(176, 148, 64, 65, 1551890601, 1),
(177, 149, 64, 65, 1551890603, 1),
(179, 156, 64, 70, 1551894396, 3),
(180, 155, 64, 70, 1551894398, 3),
(181, 151, 64, 66, 1551894402, 3),
(182, 169, 64, 62, 1552035990, 1),
(183, 169, 67, 62, 1552046386, 1),
(184, 169, 63, 62, 1552046405, 1),
(186, 149, 74, 65, 1552284349, 1),
(187, 170, 62, 64, 1552323427, 1),
(188, 167, 62, 64, 1552323441, 1);

-- --------------------------------------------------------

--
-- Table structure for table `message_share`
--

CREATE TABLE `message_share` (
  `share_id` int(11) NOT NULL,
  `msg_id_fk` int(11) NOT NULL,
  `uid_fk` int(11) NOT NULL,
  `ouid_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `message_share`
--

INSERT INTO `message_share` (`share_id`, `msg_id_fk`, `uid_fk`, `ouid_fk`, `created`) VALUES
(1, 3, 2, 1, 1453591591),
(2, 43, 3, 2, 1454706348),
(3, 82, 1, 5, 1454707644),
(4, 79, 14, 6, 1455073833),
(5, 106, 14, 8, 1455075104),
(6, 110, 1, 6, 1455131285),
(7, 109, 1, 6, 1455751805),
(10, 86, 1, 11, 1455824045),
(21, 82, 6, 5, 1455837161),
(20, 93, 6, 2, 1455836070),
(22, 71, 2, 1, 1456022068),
(23, 147, 65, 64, 1551761864);

-- --------------------------------------------------------

--
-- Table structure for table `profile_views`
--

CREATE TABLE `profile_views` (
  `uid_fk` int(11) NOT NULL DEFAULT '0',
  `view_uid_fk` int(11) NOT NULL DEFAULT '0',
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `profile_views`
--

INSERT INTO `profile_views` (`uid_fk`, `view_uid_fk`, `created`) VALUES
(1, 2, 1456517492),
(2, 1, 1456605823),
(2, 3, 1456884230),
(3, 2, 1453594503),
(3, 1, 1455915545),
(8, 2, 1454646423),
(8, 1, 1455914537),
(8, 3, 1454624628),
(8, 4, 1454646442),
(8, 6, 1454646439),
(8, 7, 1454624641),
(2, 8, 1455517453),
(1, 8, 1455916175),
(9, 1, 1454704143),
(4, 1, 1454704818),
(4, 2, 1454704823),
(4, 6, 1454704253),
(10, 1, 1454704490),
(10, 2, 1454704482),
(6, 8, 1455833778),
(6, 4, 1455832690),
(6, 1, 1455915765),
(7, 6, 1454706328),
(7, 3, 1454706331),
(7, 2, 1454706336),
(1, 3, 1454892411),
(5, 1, 1455914223),
(5, 2, 1454707369),
(1, 5, 1454707636),
(1, 7, 1454983325),
(11, 1, 1454709592),
(1, 11, 1455824020),
(7, 1, 1456526629),
(1, 9, 1454950989),
(1, 4, 1454892406),
(1, 10, 1454892408),
(1, 6, 1456435896),
(6, 14, 1455835652),
(14, 6, 1455306791),
(1, 14, 1455917975),
(14, 8, 1455075096),
(6, 11, 1455833186),
(6, 3, 1455833787),
(6, 10, 1455837137),
(6, 7, 1455834259),
(6, 2, 1455835985),
(2, 5, 1455898097),
(1, 48, 1455903639),
(1, 52, 1455910043),
(14, 1, 1455915966),
(2, 14, 1455918111),
(2, 56, 1456027617),
(58, 1, 1456086795),
(61, 7, 1456198802),
(9, 2, 1456435981),
(63, 62, 1551888608),
(64, 63, 1551890154),
(64, 62, 1552111163),
(65, 63, 1551761733),
(65, 62, 1551761749),
(65, 64, 1551761791),
(66, 63, 1551762102),
(66, 62, 1551762114),
(66, 64, 1551762129),
(66, 65, 1551762132),
(67, 64, 1552637206),
(67, 66, 1552637175),
(68, 63, 1551762437),
(68, 66, 1551762444),
(68, 65, 1551762454),
(70, 66, 1551762709),
(70, 62, 1551762717),
(70, 67, 1551762724),
(71, 68, 1551762887),
(71, 70, 1551762905),
(72, 66, 1551763094),
(72, 70, 1551763188),
(72, 67, 1551763116),
(72, 65, 1551763223),
(72, 63, 1551763312),
(64, 72, 1551763423),
(63, 70, 1551942668),
(63, 64, 1552046619),
(64, 70, 1551895241),
(64, 65, 1551950643),
(64, 66, 1551894405),
(62, 72, 1551950680),
(62, 64, 1552033287),
(67, 62, 1552035589),
(64, 67, 1552111075),
(64, 73, 1552284223),
(74, 65, 1552284359),
(76, 72, 1552459184),
(76, 62, 1552459885),
(67, 70, 1552637170);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE `template` (
  `t_id` int(11) NOT NULL,
  `t_file` varchar(30) DEFAULT NULL,
  `t_name` varchar(30) DEFAULT NULL,
  `t_order` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`t_id`, `t_file`, `t_name`, `t_order`) VALUES
(1, 'template_block_friends.php', 'FRIENDS', 1),
(2, 'template_block_recentViews.php', ' PROFILE VIEWS', 3),
(3, 'template_block_groups.php', 'GROUPS', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `profile_pic` varchar(200) DEFAULT NULL,
  `friend_count` int(11) DEFAULT '0',
  `status` int(1) DEFAULT '1',
  `name` varchar(150) DEFAULT NULL,
  `profile_pic_status` int(1) DEFAULT '0',
  `conversation_count` int(11) DEFAULT '0',
  `updates_count` int(11) DEFAULT '0',
  `first_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthday` varchar(20) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `hometown` varchar(200) DEFAULT NULL,
  `bio` text,
  `relationship` varchar(30) DEFAULT NULL,
  `timezone` varchar(10) DEFAULT NULL,
  `provider` varchar(10) DEFAULT NULL,
  `provider_id` varchar(200) DEFAULT NULL,
  `profile_bg` varchar(200) DEFAULT NULL,
  `group_count` int(11) DEFAULT '0',
  `last_login` int(13) DEFAULT NULL,
  `profile_bg_position` varchar(20) DEFAULT '0',
  `verified` enum('0','1') DEFAULT '0',
  `notification_created` int(11) DEFAULT NULL,
  `forgot_code` text,
  `photos_count` int(11) DEFAULT '0',
  `tour` enum('0','1') DEFAULT '0',
  `facebookProfile` varchar(200) DEFAULT NULL,
  `twitterProfile` varchar(200) DEFAULT NULL,
  `googleProfile` varchar(200) DEFAULT NULL,
  `instagramProfile` varchar(200) DEFAULT NULL,
  `emailNotifications` enum('0','1') DEFAULT '1',
  `email_activation` varchar(300) DEFAULT NULL,
  `userid` int(8) DEFAULT NULL,
  `work` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`, `profile_pic`, `friend_count`, `status`, `name`, `profile_pic_status`, `conversation_count`, `updates_count`, `first_name`, `last_name`, `gender`, `birthday`, `location`, `hometown`, `bio`, `relationship`, `timezone`, `provider`, `provider_id`, `profile_bg`, `group_count`, `last_login`, `profile_bg_position`, `verified`, `notification_created`, `forgot_code`, `photos_count`, `tour`, `facebookProfile`, `twitterProfile`, `googleProfile`, `instagramProfile`, `emailNotifications`, `email_activation`, `userid`, `work`) VALUES
(8, 'ramesh', '63a401a18004e5c6a5b5bd3643fbb1d5', 'admin@9lessons.info', 'user8_14547292081.png', 6, 2, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1456883110, '0', '1', 1454646629, NULL, 1, '1', NULL, NULL, NULL, NULL, '1', 'c728e639a35bc0ef2e3fd2297db5ce52', 0, ''),
(62, 'hasib', '5a56f51d054176646844f2f4fa0c0c8a', 'hasib@gmail.com', 'user62_15517210101.jpg', 7, 1, 'mahmudul hasib', 1, 0, 0, NULL, NULL, 'male', NULL, NULL, NULL, 'Better communication path creater to IELTS', NULL, NULL, NULL, NULL, 'bg62_15517210161.jpg', 1, 1552323420, ' -441.993px;', '1', 1552111043, NULL, 2, '1', NULL, NULL, NULL, NULL, '1', 'de4db1edb466316dfc886833a69310ef', 15203110, ''),
(63, 'naeem', '4eb73db4a69a65cb861e69fa99664da9', 'naeem@gmail.com', 'user63_15517222941.jpg', 6, 1, 'Naeem Hossen', 1, 1, 3, NULL, NULL, 'male', NULL, NULL, NULL, 'Anded a major role in the film.;.', NULL, NULL, NULL, NULL, 'bg63_15517223011.jpg', 0, 1552046398, ' -191px;', '1', 1552046409, NULL, 3, '1', NULL, NULL, NULL, NULL, '1', '21596b3c0b5a9a4f02e6d8b9ab0d45f9', 15203081, ''),
(64, 'badhon', '3a7ba420481ffecbf6625ce8b2a8603f', 'badhon@gmail.com', 'user64_15517613661.jpg', 6, 1, 'Badhon Ahmed', 1, 0, 6, NULL, NULL, 'male', NULL, NULL, NULL, 'Daraz', NULL, NULL, NULL, NULL, 'bg64_15517613701.jpg', 1, 1552637244, ' -240px;', '1', 1552573109, NULL, 12, '1', NULL, NULL, NULL, NULL, '1', 'ffb3cf600a6d65e06a4489a24a0ef07a', 15203040, ''),
(65, 'adnan', '51e127d6bff317c90f3e7832dd19b46a', 'adnan@gmail.com', 'user65_15517616671.jpg', 2, 1, 'adnan', 1, 0, 2, NULL, NULL, 'male', NULL, NULL, NULL, 'coy to communicate', NULL, NULL, NULL, NULL, 'bg65_15517616701.jpg', 0, 1551761658, ' -106px;', '1', 1551761796, NULL, 0, '1', NULL, NULL, NULL, NULL, '1', 'f2699f6b72beb0318ae2805218969cd0', 152031156, ''),
(66, 'royet', '1d4733a8f760ec739b07df7f524af646', 'royet@gmail.com', 'user66_15517619401.jpg', 4, 1, 'royet', 1, 0, 2, NULL, NULL, 'male', NULL, NULL, NULL, 'freelancer', NULL, NULL, NULL, NULL, 'bg66_15517619441.jpg', 0, 1552106050, ' -352px;', '1', 1551761924, NULL, 5, '1', NULL, NULL, NULL, NULL, '1', '35981776b601f451b9cc6a303c81f318', 15203074, ''),
(67, 'rony', 'a089141eb7cc08d5a315ce6f488f7e7d', 'rony@gmail.com', 'user67_15517622091.jpg', 6, 1, 'rony', 1, 0, 2, NULL, NULL, 'male', NULL, NULL, NULL, 'D2', NULL, NULL, NULL, NULL, 'bg67_15517622121.jpg', 1, 1552636991, ' -196px;', '1', 1552627236, NULL, 2, '1', NULL, NULL, NULL, NULL, '1', '9ff7a19a5ab1755d71df8e2675d50928', 15203012, ''),
(68, 'gaffar', 'c5e4951bb8a48032d676ee03d8b1e0b4', 'gaffar@gmail.com', 'user68_15517623531.jpg', 4, 1, 'gaffar', 1, 0, 2, NULL, NULL, 'male', NULL, NULL, NULL, 'footballer at kolabagan kria chakro', NULL, NULL, NULL, NULL, 'bg68_15517623561.jpg', 0, 1552106094, ' -456px;', '1', 1551762337, NULL, 2, '1', NULL, NULL, NULL, NULL, '1', 'dd04cf4f4a785bb8e2fba6488a6b35b0', 15203070, ''),
(69, 'rajaib', 'd0d3ce086204f9f04aa0067529ad8066', 'rajaib@gmail.com', NULL, 0, 2, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1551762497, '0', '1', NULL, NULL, 0, '0', NULL, NULL, NULL, NULL, '1', '517e3755023a53dbc1eba45a1b43eacd', 15203083, ''),
(70, 'rajibraja', 'f2a0a12f422088ead7185409123fb32c', 'rajibraja@gmail.com', 'user70_15517626151.jpg', 6, 1, 'rajibraja', 1, 0, 2, NULL, NULL, 'male', NULL, NULL, NULL, 'try lead my life in the way of islam', NULL, NULL, NULL, NULL, 'bg70_15517626181.jpg', 0, 1551762608, ' -227px;', '1', 1551762608, NULL, 0, '1', NULL, NULL, NULL, NULL, '1', 'e04a2c649432aa8e0a17f6c3e670e7b5', 15203084, ''),
(71, 'mahbub', '78e7751aa2349bafaaf04b79f5a08071', 'mahbub@gmail.com', 'user71_15517628101.jpg', 8, 1, NULL, 1, 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bg71_15517628141.jpg', 0, 1551762800, ' -188px;', '1', 1551762800, NULL, 1, '1', NULL, NULL, NULL, NULL, '1', '8bd1ccdcc60d8098d09b38a1ff36371e', 15203066, ''),
(72, 'saifur', '65b96186bcc6f288e49e617e0e6996a1', 'saifur@gmail.com', 'user72_15517629571.jpg', 7, 1, 'saifur', 1, 0, 3, NULL, NULL, 'male', NULL, NULL, NULL, 'Dhaka solution', NULL, NULL, NULL, NULL, 'bg72_15517629601.jpg', 0, 1552106131, ' -262px;', '1', 1551762949, NULL, 4, '1', NULL, NULL, NULL, NULL, '1', 'ad3af6f318100fd5239fbdca3b651a3f', 15203049, ''),
(73, 'masud', 'd8d3b94a448336989f05aa474460bda4', 'masud@gmail.com', NULL, 0, 1, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1551888562, '0', '1', 1551888562, NULL, 0, '1', NULL, NULL, NULL, NULL, '1', '9fe6671d337ed88003f74cee9c3959d3', 15203011, ''),
(74, 'rabbi', '10c5106872ffa6ab2e504dde33f24b0a', 'naeemhossen024@gmail.com', NULL, 5, 1, 'rabbi', 0, 0, 0, NULL, NULL, 'male', NULL, NULL, NULL, 'polite', NULL, NULL, NULL, NULL, NULL, 0, 1552284312, '0', '1', 1552284312, NULL, 0, '1', NULL, NULL, NULL, NULL, '1', 'f404310d2750a7d32bfe36483e074023', 15203087, ''),
(75, 'eva', '551702f7f59175cfeb1fe9de352d6948', 'eva@gmail.com', NULL, 0, 1, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1552298571, '0', '1', 1552298571, NULL, 0, '1', NULL, NULL, NULL, NULL, '1', '18334f3d1720024bf9be8437a2d58607', 15103239, ''),
(76, 'yyyyyy', '94e7d712742adbbb7a73a1d52a7cc1a9', 'f@gmail.com', NULL, 0, 2, NULL, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1552459180, '0', '0', 1552459059, NULL, 0, '1', NULL, NULL, NULL, NULL, '1', 'de18eec4d57bfeed5fe06be56bba2eb5', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_uploads`
--

CREATE TABLE `user_uploads` (
  `id` int(11) NOT NULL,
  `image_path` varchar(200) DEFAULT NULL,
  `uid_fk` int(11) DEFAULT NULL,
  `group_id_fk` int(11) DEFAULT '0',
  `image_type` enum('0','1','2') DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `user_uploads`
--

INSERT INTO `user_uploads` (`id`, `image_path`, `uid_fk`, `group_id_fk`, `image_type`) VALUES
(219, 'bg2_14568845661.jpg', 2, 2, '2'),
(6, 'user1_14540193131.jpeg', 1, 0, '2'),
(15, 'user2_14546147361.png', 2, 0, '2'),
(16, 'bg2_14546147411.jpg', 2, 0, '2'),
(93, 'user9_14547039351.jpeg', 9, 0, '2'),
(114, 'user11_14547096681.jpg', 11, 0, '2'),
(94, 'user4_14547042341.jpg', 4, 0, '2'),
(95, 'user10_14547044391.jpg', 10, 0, '2'),
(104, 'bg6_14547052031.jpg', 6, 0, '1'),
(111, 'user5_14547073581.jpg', 5, 0, '2'),
(216, 'user7_14568840981.jpg', 7, 0, '2'),
(110, 'user3_14547068351.jpg', 3, 0, '2'),
(61, 'user1_14546482521.png', 1, 1, '1'),
(144, 'user6_14549534061.png', 6, 0, '2'),
(223, 'bg1_14568847661.jpg', 1, 0, '2'),
(208, 'user1_14566090661.jpg', 2, 2, '0'),
(226, 'user62_15517210101.jpg', 62, 0, '2'),
(227, 'bg62_15517210161.jpg', 62, 0, '2'),
(228, 'user63_15517222941.jpg', 63, 0, '2'),
(229, 'bg63_15517223011.jpg', 63, 0, '2'),
(230, 'user63_15517612221.jpg', 63, 0, '0'),
(231, 'user64_15517613661.jpg', 64, 0, '2'),
(232, 'bg64_15517613701.jpg', 64, 0, '2'),
(233, 'user65_15517616671.jpg', 65, 0, '2'),
(234, 'bg65_15517616701.jpg', 65, 0, '2'),
(235, 'user66_15517619401.jpg', 66, 0, '2'),
(236, 'bg66_15517619441.jpg', 66, 0, '2'),
(239, 'user66_15517620701.jpg', 66, 0, '0'),
(240, 'user67_15517622091.jpg', 67, 0, '2'),
(241, 'bg67_15517622121.jpg', 67, 0, '2'),
(242, 'user68_15517623531.jpg', 68, 0, '2'),
(243, 'bg68_15517623561.jpg', 68, 0, '2'),
(244, 'user70_15517626151.jpg', 70, 0, '2'),
(245, 'bg70_15517626181.jpg', 70, 0, '2'),
(246, 'user71_15517628101.jpg', 71, 0, '2'),
(247, 'bg71_15517628141.jpg', 71, 0, '2'),
(248, 'user71_15517628691.jpg', 71, 0, '0'),
(249, 'user72_15517629571.jpg', 72, 0, '2'),
(250, 'bg72_15517629601.jpg', 72, 0, '2'),
(251, 'user72_15517630501.jpg', 72, 0, '0'),
(252, 'user72_15517630641.jpg', 72, 0, '0'),
(253, 'user64_15519428591.jpg', 64, 0, '1'),
(254, 'user64_15519428741.jpg', 64, 0, '1'),
(255, 'user64_15519476741.jpg', 64, 0, '0'),
(256, 'user64_15519484031.jpg', 64, 0, NULL),
(257, 'user64_15519490131.jpg', 64, 0, '0'),
(258, 'user64_15519490751.jpg', 64, 0, '0'),
(259, 'user64_15519492281.jpg', 64, 5, '1'),
(260, 'bg64_15519492851.jpg', 64, 5, '2'),
(261, 'user64_15519492961.jpg', 64, 5, '0'),
(262, 'user64_15519493231.jpg', 64, 5, '0'),
(263, 'user64_15519498761.jpg', 64, 5, '0'),
(264, 'user64_15519500731.jpg', 64, 5, '0'),
(268, 'user64_15519504211.jpg', 64, 0, '1'),
(269, 'user64_15519504431.jpg', 64, 0, '0'),
(270, 'user64_15519505901.jpg', 64, 0, '1'),
(271, 'user64_15520332591.jpg', 64, 5, '1'),
(272, 'user64_15521111081.jpg', 64, 0, '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `advertisments`
--
ALTER TABLE `advertisments`
  ADD PRIMARY KEY (`a_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `msg_id_fk` (`msg_id_fk`),
  ADD KEY `uid_fk` (`uid_fk`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`con_id`);

--
-- Indexes for table `conversation`
--
ALTER TABLE `conversation`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `user_one` (`user_one`),
  ADD KEY `user_two` (`user_two`);

--
-- Indexes for table `conversation_reply`
--
ALTER TABLE `conversation_reply`
  ADD PRIMARY KEY (`cr_id`),
  ADD KEY `user_id_fk` (`user_id_fk`),
  ADD KEY `c_id_fk` (`c_id_fk`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`friend_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`);

--
-- Indexes for table `group_users`
--
ALTER TABLE `group_users`
  ADD PRIMARY KEY (`group_id_fk`,`uid_fk`),
  ADD UNIQUE KEY `group_user_id` (`group_user_id`);

--
-- Indexes for table `language_labels`
--
ALTER TABLE `language_labels`
  ADD PRIMARY KEY (`labelID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `uid_fk` (`uid_fk`);

--
-- Indexes for table `message_like`
--
ALTER TABLE `message_like`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `uid_fk` (`uid_fk`),
  ADD KEY `msg_id_fk` (`msg_id_fk`);

--
-- Indexes for table `message_share`
--
ALTER TABLE `message_share`
  ADD PRIMARY KEY (`share_id`),
  ADD KEY `uid_fk` (`uid_fk`),
  ADD KEY `msg_id_fk` (`msg_id_fk`);

--
-- Indexes for table `profile_views`
--
ALTER TABLE `profile_views`
  ADD PRIMARY KEY (`uid_fk`,`view_uid_fk`);

--
-- Indexes for table `template`
--
ALTER TABLE `template`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_uploads`
--
ALTER TABLE `user_uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid_fk` (`uid_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advertisments`
--
ALTER TABLE `advertisments`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `conversation_reply`
--
ALTER TABLE `conversation_reply`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_users`
--
ALTER TABLE `group_users`
  MODIFY `group_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `language_labels`
--
ALTER TABLE `language_labels`
  MODIFY `labelID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `message_like`
--
ALTER TABLE `message_like`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `message_share`
--
ALTER TABLE `message_share`
  MODIFY `share_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `user_uploads`
--
ALTER TABLE `user_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=273;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
