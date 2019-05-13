-- phpMyAdmin SQL Dump
-- version 4.4.3
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 02, 2016 at 03:18 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wallscript`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(200) NOT NULL,
  `admin_password` varchar(300) NOT NULL,
  `admin_email` varchar(300) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_email`) VALUES
(1, 'admin', '63a401a18004e5c6a5b5bd3643fbb1d5', 'admin@thewallscript.com');

-- --------------------------------------------------------

--
-- Table structure for table `advertisments`
--

CREATE TABLE IF NOT EXISTS `advertisments` (
  `a_id` int(11) NOT NULL,
  `a_title` varchar(200) DEFAULT NULL,
  `a_desc` varchar(300) DEFAULT NULL,
  `a_url` text,
  `a_img` varchar(100) DEFAULT NULL,
  `status` enum('0','1','2') DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `advertisments`
--

INSERT INTO `advertisments` (`a_id`, `a_title`, `a_desc`, `a_url`, `a_img`, `status`) VALUES
(26, 'Balloon Networks', 'A DIGITAL MARKETING AGENCY - We make you High', 'http://www.balloonnetworks.com/', 'add_1454441861.jpg', '1'),
(31, 'Coca Cola', 'Refresh open happiness ', 'http://www.coca-cola.com/', 'add_1454620864.jpg', '1');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `com_id` int(11) NOT NULL,
  `comment` text,
  `msg_id_fk` int(11) DEFAULT NULL,
  `uid_fk` int(11) DEFAULT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `created` int(11) DEFAULT '1269249260',
  `like_count` int(11) DEFAULT '0',
  `uploads` varchar(30) DEFAULT ''
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

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
(39, 'It''s a great post', 89, 9, '24.99.79.198', 1455915241, 0, ''),
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
(51, 'You are superhero..!!!!', 89, 7, '24.99.79.198', 1455916109, 0, '');

-- --------------------------------------------------------



--
-- Table structure for table `configurations`
--

CREATE TABLE IF NOT EXISTS `configurations` (
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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`con_id`, `newsfeedPerPage`, `friendsPerPage`, `photosPerPage`, `groupsPerPage`, `adminPerPage`, `uploadImage`, `bannerWidth`, `profileWidth`, `notificationPerPage`, `friendsWidgetPerPage`, `gravatar`, `forgot`, `applicationName`, `applicationDesc`, `language_labels`, `upload`, `applicationToken`) VALUES
(1, 20, 20, 30, 10, 25, 4096, 900, 250, 30, 8, '0', 'forgotkey', 'The WALLSCRIPT 8', 'The Social Networking Script', '0', 500, 'MySecretToken');

-- --------------------------------------------------------

--
-- Table structure for table `conversation`
--

CREATE TABLE IF NOT EXISTS `conversation` (
  `c_id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `ip` varchar(30) DEFAULT NULL,
  `time` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `conversation`
--

INSERT INTO `conversation` (`c_id`, `user_one`, `user_two`, `ip`, `time`) VALUES
(5, 1, 3, '::1', 1456607882),
(6, 1, 11, '::1', 1454892420),
(7, 1, 7, '::1', 1454892430),
(8, 1, 8, '::1', 1455128075),
(16, 61, 7, '115.78.238.233', 1456198846),
(10, 1, 10, '::1', 1454892604),
(14, 6, 14, '24.99.79.198', 1455754784),
(15, 1, 6, '24.99.79.198', 1455833273);

-- --------------------------------------------------------

--
-- Table structure for table `conversation_reply`
--

CREATE TABLE IF NOT EXISTS `conversation_reply` (
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
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

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
(46, 'asdf sdf', 1, '::1', 1456607882, 5, 1, '', '', '203,204,205,206,207');

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `friend_id` int(11) NOT NULL,
  `friend_one` int(11) DEFAULT NULL,
  `friend_two` int(11) DEFAULT NULL,
  `role` varchar(5) DEFAULT NULL,
  `created` int(13) DEFAULT '1411570461'
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

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
(110, 1, 5, 'fri', 1455898442);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `group_name`, `group_desc`, `uid_fk`, `group_created`, `group_pic`, `group_bg`, `group_ip`, `status`, `group_count`, `group_updates`, `group_bg_position`, `verified`) VALUES
(1, 'Jquery', 'The Write Less, Do More, JavaScript Library.', 1, 1453525254, 'user1_14546482521.png', 'bg1_14546486221.jpg', '::1', '1', 4, 4, ' -261px;', '0'),
(2, 'The Big Bang Theory', 'Most popular TV show', 2, 1454621335, 'user2_14546470881.jpg', 'bg2_14568845661.jpg', '::1', '1', 6, 7, ' -44px;', '0'),
(4, 'test', 'test group', 6, 1455836374, NULL, NULL, '24.99.79.198', '1', 1, 2, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE IF NOT EXISTS `group_users` (
  `group_user_id` int(11) NOT NULL,
  `group_id_fk` int(11) NOT NULL DEFAULT '0',
  `uid_fk` int(11) NOT NULL DEFAULT '0',
  `status` enum('0','1') DEFAULT '1',
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

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
(16, 4, 6, '1', 1455836374);

-- --------------------------------------------------------

--
-- Table structure for table `language_labels`
--

CREATE TABLE IF NOT EXISTS `language_labels` (
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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `language_labels`
--

INSERT INTO `language_labels` (`labelID`, `commonFriends`, `commonGroups`, `commonPhotos`, `commonCreateGroup`, `topMenuHome`, `topMenuMessages`, `topMenuNotifications`, `topMenuSeeAll`, `topMenuSettings`, `topMenuLogout`, `topMenuLogin`, `topMenuJoin`, `commonAbout`, `commonRecentVisitors`, `yourPhotos`, `photosOfYours`, `commonFollowers`, `boxName`, `boxUpdates`, `boxWebcam`, `boxLocation`, `buttonUpdate`, `buttonComment`, `buttonFollow`, `buttonFollowing`, `buttonMessage`, `buttonJoinGroup`, `buttonUnfollowGroup`, `buttonEditGroup`, `buttonSaveSettings`, `buttonSocialSave`, `buttonLogin`, `buttonSignUp`, `buttonForgotButton`, `buttonSetNewPassword`, `buttonFacebook`, `buttonGoogle`, `buttonMicrosoft`, `buttonLinkedin`, `feedLike`, `feedUnLike`, `feedLikeThis`, `feedShare`, `feedUnshare`, `feedShareThis`, `feedComment`, `feedDeleteUpdate`, `feedPosted`, `settingsTitle`, `settingsUsername`, `settingsEmail`, `settingsName`, `settingsPassword`, `settingsChangePassword`, `settingsOldPassword`, `settingsNewPassword`, `settingsConfirmPassword`, `settingsGroup`, `settingsGender`, `settingsAboutMe`, `settingsEmailAlerts`, `socialTitle`, `socialFacebook`, `socialTwitter`, `socialGoogle`, `socialInstagram`, `placeSearch`, `placeComment`, `placeUpdate`, `placeEmailUsername`, `placePassword`, `placeEmail`, `placeUsername`, `loginTitle`, `emailUsername`, `password`, `forgotPassword`, `registrationTitle`, `email`, `username`, `agreeMessage`, `resetPassword`, `thankYou`, `thankYouMessage`, `buttonYou`, `commonViewAll`, `placeSendMessage`, `notiFollowingYou`, `notiLiked`, `notiShared`, `notiStatus`, `msgDeleteConversation`, `msgConversation`, `msgStartConversation`, `msgNoUpdates`, `msgNoMoreUpdates`, `msgNoFriends`, `msgNoMoreFriends`, `msgNoPhotos`, `msgNoMorePhotos`, `msgNoViews`, `msgNoMoreViews`, `msgNoGroups`, `msgNoMoreGroups`, `commonMembers`, `msgNoMembers`, `msgNoMoreMembers`, `msgNoConversations`, `terms`, `notiIsFollowingGroup`, `notiCommented`, `msgNoFollowers`, `msgNoMoreFollowers`) VALUES
(1, 'друзья', 'группы', 'Фото', 'Создать группу', 'Главная', 'Сообщения', 'Уведомления', 'Увидеть все', 'настройки', 'Выйти', 'Авторизоваться', 'Присоединиться', 'Около', 'Последние посетители', 'Профиль фотографии', 'Фотографии', 'Последователи', 'Что происходит', 'Обновления', 'Веб-камера', 'Место нахождения', 'Обновить', 'Комментарий', 'следить', 'Следующий', 'Сообщение', 'Вступить в группу', 'Отписаться Группа', 'Изменить группу', 'Сохранить настройки', 'Социальная Сохранить', 'Авторизоваться', 'Зарегистрироваться', 'Забыли пароль', 'Установить новый пароль - сброс', 'Войти с Facebook', 'Вход с Google', 'Вход с Microsoft', 'Вход с LinkedIn', 'подобно', 'В отличие от', 'как это', 'Поделиться', 'из открытого списка', 'поделились этой', 'Комментарий', 'Удалить обновление', 'Опубликовано в', 'Настройки Название', 'имя пользователя', 'Эл. адрес', 'имя', 'пароль', 'Изменить пароль', 'Старый пароль', 'новый пароль', 'Подтвердите Пароль', 'группа', 'Пол', 'Обо мне', 'Уведомления по электронной почте', 'Социальная Заголовок', 'Социальные сети Facebook', 'Социальная Twitter', 'Социальная Google', 'Социальная Instagram', 'Поиск людей', 'Написать комментарий', 'Написать обновление.', 'Электронная почта или имя пользователя.', 'Введите пароль', 'Введите адрес электронной почты', 'Введите имя пользователя', 'Войти Название', 'Электронная почта или имя пользователя', 'пароль', 'Забыли пароль', 'Регистрация Название', 'Эл. адрес ', 'Электронная почта или имя пользователя', 'Регистрация Согласитесь сообщение', 'Сброс пароля', 'Спасибо!', 'Пожалуйста conirm сообщение', 'Вы', 'Посмотреть все', 'Отправить сообщение', 'после вас', 'понравилось', 'общий', 'положение дел', 'Удалить беседу', 'разговор', 'Начало разговора', 'Нет обновлений', 'Нет больше обновлений', 'Нет друзей', 'Нет больше друзей', 'Нет фото', 'Нет больше фотографий', 'Нет просмотров', 'Нет больше просмотров', 'Нет групп', 'Нет больше групп', 'члены', 'Нет участников', 'Нет больше членов', 'Нет цепочек', 'сроки', 'следующая группа', 'прокомментировал', 'Нет последователи', 'Нет больше последователей');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
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
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

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
(86, 'How To Draw A Dog Topical: ''Fuller House'' Cast Photo Edition http://www.funnyordie.com/browse/videos/all/exclusives/most_recent/all_time', 11, '::1', 1454710328, '', 2, 2, 1, 0, '', ''),
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
(118, '<a href="http://www.balloonnetworks.com/" target="_blank">Digital Marketing Agency</a>', 2, '106.51.235.30', 1456022719, '', 0, 0, 0, 0, '', ''),
(121, 'Cant''t feel my face https://soundcloud.com/ryancurtis/cant-feel-my-face-the-weeknd-cover-free-download', 2, '106.51.235.30', 1456023120, '', 0, 0, 0, 0, '', ''),
(122, 'http://www.slideshare.net/balloonnetworks/balloon-networks-digital-marketing-ppt', 2, '106.51.235.30', 1456023872, '', 1, 0, 0, 0, '', ''),
(123, 'http://www.deviantart.com/art/Mycena-leaiana-592035779 rggargrg', 2, '106.51.235.30', 1456024332, '', 1, 0, 0, 0, '', ''),
(125, 'Netra https://www.instagram.com/p/_RtivCOfNA/?taken-by=rajeshtamada', 2, '106.51.235.30', 1456024706, '', 2, 0, 0, 0, '', ''),
(134, 'The Wall Script http://www.thewallscript.com', 1, '207.11.113.30', 1456435936, '', 1, 1, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `message_like`
--

CREATE TABLE IF NOT EXISTS `message_like` (
  `like_id` int(11) NOT NULL,
  `msg_id_fk` int(11) NOT NULL,
  `uid_fk` int(11) NOT NULL,
  `ouid_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL,
  `reactionType` int(2) DEFAULT '1'
) ENGINE=MyISAM AUTO_INCREMENT=143 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

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
(133, 125, 2, 2, 1456549452, 5);

-- --------------------------------------------------------

--
-- Table structure for table `message_share`
--

CREATE TABLE IF NOT EXISTS `message_share` (
  `share_id` int(11) NOT NULL,
  `msg_id_fk` int(11) NOT NULL,
  `uid_fk` int(11) NOT NULL,
  `ouid_fk` int(11) DEFAULT NULL,
  `created` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

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
(22, 71, 2, 1, 1456022068);

-- --------------------------------------------------------

--
-- Table structure for table `profile_views`
--

CREATE TABLE IF NOT EXISTS `profile_views` (
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
(9, 2, 1456435981);

-- --------------------------------------------------------

--
-- Table structure for table `template`
--

CREATE TABLE IF NOT EXISTS `template` (
  `t_id` int(11) NOT NULL,
  `t_file` varchar(30) DEFAULT NULL,
  `t_name` varchar(30) DEFAULT NULL,
  `t_order` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `template`
--

INSERT INTO `template` (`t_id`, `t_file`, `t_name`, `t_order`) VALUES
(1, 'template_block_friends.php', 'FRIENDS', 1),
(2, 'template_block_recentViews.php', ' PROFILE VIEWS', 2),
(3, 'template_block_groups.php', 'GROUPS', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
  `email_activation` varchar(300) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`, `profile_pic`, `friend_count`, `status`, `name`, `profile_pic_status`, `conversation_count`, `updates_count`, `first_name`, `last_name`, `gender`, `birthday`, `location`, `hometown`, `bio`, `relationship`, `timezone`, `provider`, `provider_id`, `profile_bg`, `group_count`, `last_login`, `profile_bg_position`, `verified`, `notification_created`, `forgot_code`, `photos_count`, `tour`, `facebookProfile`, `twitterProfile`, `googleProfile`, `instagramProfile`, `emailNotifications`, `email_activation`) VALUES
(1, 'srinivas', '63a401a18004e5c6a5b5bd3643fbb1d5', 'srinivas.tamada@gmail.com', 'user1_14540193131.jpeg', 11, 1, 'Srinivas Tamada', 1, 0, 3, NULL, NULL, 'male', NULL, NULL, NULL, NULL, NULL, '-5', 'facebook', 1025751018, 'bg1_14568847661.jpg', 2, 1456884663, ' -68px;', '1', 1456715660, '9a8978dd03b9346ecc2970e3a1a3bb3e', 4, '1', NULL, NULL, NULL, NULL, '1', ''),
(2, 'rajesh', '63a401a18004e5c6a5b5bd3643fbb1d5', 'srinivas@9lessons.info', 'user2_14546147361.png', 2, 1, 'Rajesh Tamada', 1, 0, 11, NULL, NULL, 'male', NULL, NULL, NULL, 'Digital Marketing Expert', NULL, NULL, NULL, NULL, 'bg2_14546147411.jpg', 2, 1456884153, ' -86px;', '1', 1456721399, NULL, 3, '1', 'rajesh.tamada', 'rajesht9i', 'Rajeshtamada', 'rajeshtamada', '1', ''),
(3, 'arun', '63a401a18004e5c6a5b5bd3643fbb1d5', 'egglabs@gmail.com', 'user3_14547068351.jpg', 2, 1, 'Arun Kumar', 1, 1, 2, NULL, NULL, 'male', NULL, NULL, NULL, 'Mad of cars', NULL, NULL, NULL, NULL, 'bg3_14547064601.jpg', 0, 1455915653, ' -105px;', '1', 1453607442, NULL, 3, '1', NULL, NULL, NULL, NULL, '1', ''),
(4, 'karthik', '63a401a18004e5c6a5b5bd3643fbb1d5', 'srinivas@egglabs.in', 'user4_14547042341.jpg', 3, 1, 'Karthik Tamada', 1, 0, 1, NULL, NULL, 'male', NULL, NULL, NULL, 'Artist ', NULL, NULL, NULL, NULL, NULL, 0, 1455915174, '0', '0', 1454704221, NULL, 1, '1', NULL, NULL, NULL, NULL, '1', '3713ef7e58fd154be0e30fc89465ba64'),
(5, 'dinesh', '63a401a18004e5c6a5b5bd3643fbb1d5', 'dinesh@gmail.com', 'user5_14547073581.jpg', 2, 1, NULL, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1455914457, '0', '0', 1454707349, NULL, 1, '1', NULL, NULL, NULL, NULL, '1', '0f53e69971fe67daa3fee14ad4888e98'),
(6, 'superman', '84d961568a65073a3bcf0eb216b2a576', 'admin@9lessons.info', 'user6_14549534061.png', 3, 1, 'Superman', 1, 0, 2, NULL, NULL, 'female', NULL, NULL, NULL, 'Am the superhero', NULL, NULL, NULL, NULL, 'bg6_14547052031.jpg', 3, 1456181597, ' -167px;', '0', 1455833176, 'd2a27894398ce18565bf44c8e40cb4f9', 12, '1', 'jjjn', 'nmnn', ' nm ', 'ki', '0', '4994e9535048f09164c67eba11cfea66'),
(7, 'spiderman', '63a401a18004e5c6a5b5bd3643fbb1d5', 'srinivasx@inbox.com', 'user7_14568840981.jpg', 3, 1, NULL, 1, 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bg7_14565249081.jpg', 0, 1456883988, ' -261px;', '0', 1456526701, NULL, 1, '1', NULL, NULL, NULL, NULL, '1', '71037d755a8469e23171595f9d1b0f6b'),
(8, 'ramesh', '63a401a18004e5c6a5b5bd3643fbb1d5', 'admin@9lessons.info', 'user8_14547292081.png', 6, 1, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 1456883110, '0', '0', 1454646629, NULL, 1, '1', NULL, NULL, NULL, NULL, '1', 'c728e639a35bc0ef2e3fd2297db5ce52'),
(9, 'ravi', '63a401a18004e5c6a5b5bd3643fbb1d5', 'srinivas@inbox.com', 'user9_14547039351.jpeg', 3, 1, NULL, 1, 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1456435972, '0', '0', 1453607442, NULL, 2, '1', NULL, NULL, NULL, NULL, '1', ''),
(10, 'arunshekar', '63a401a18004e5c6a5b5bd3643fbb1d5', 'arun@9lessons.info', 'user10_14547044391.jpg', 2, 1, 'Arun Kumar Shekar', 1, 1, 0, NULL, NULL, 'male', NULL, NULL, NULL, 'Programming Expert', NULL, NULL, NULL, NULL, NULL, 2, 1455501404, '0', '0', 1454704397, NULL, 1, '1', NULL, NULL, NULL, NULL, '1', '7b3e0142681a603310e8227e9a61266f'),
(11, 'satish', '63a401a18004e5c6a5b5bd3643fbb1d5', 'srinivas.tamada@hotmail.com', 'user11_14547096681.jpg', 8, 1, 'Satish Tamada', 1, 1, 3, NULL, NULL, 'female', NULL, NULL, NULL, NULL, NULL, '-5', 'facebook', 2147483647, NULL, 0, 1456435996, '0', '0', 1454709586, NULL, 1, '1', NULL, NULL, NULL, NULL, '1', '67bf2490457ea88921cd9a8cf5054a2e');

-- --------------------------------------------------------

--
-- Table structure for table `user_uploads`
--

CREATE TABLE IF NOT EXISTS `user_uploads` (
  `id` int(11) NOT NULL,
  `image_path` varchar(200) DEFAULT NULL,
  `uid_fk` int(11) DEFAULT NULL,
  `group_id_fk` int(11) DEFAULT '0',
  `image_type` enum('0','1','2') DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=226 DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED;

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
(116, 'user8_14547292081.png', 8, 0, '2'),
(111, 'user5_14547073581.jpg', 5, 0, '2'),
(216, 'user7_14568840981.jpg', 7, 0, '2'),
(110, 'user3_14547068351.jpg', 3, 0, '2'),
(61, 'user1_14546482521.png', 1, 1, '1'),
(144, 'user6_14549534061.png', 6, 0, '2'),
(223, 'bg1_14568847661.jpg', 1, 0, '2'),
(208, 'user1_14566090661.jpg', 2, 2, '0');

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
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `advertisments`
--
ALTER TABLE `advertisments`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;

-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `con_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `conversation`
--
ALTER TABLE `conversation`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `conversation_reply`
--
ALTER TABLE `conversation_reply`
  MODIFY `cr_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `friend_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `group_users`
--
ALTER TABLE `group_users`
  MODIFY `group_user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `language_labels`
--
ALTER TABLE `language_labels`
  MODIFY `labelID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `message_like`
--
ALTER TABLE `message_like`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=143;
--
-- AUTO_INCREMENT for table `message_share`
--
ALTER TABLE `message_share`
  MODIFY `share_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `template`
--
ALTER TABLE `template`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `user_uploads`
--
ALTER TABLE `user_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=226;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

alter table `advertisments` add ad_type ENUM('0','1') DEFAULT '0';

alter table `advertisments` add ad_code text;
