-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 25, 2016 at 04:46 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wall_test`
--

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
  `placeOldPassword` varchar(100) DEFAULT NULL,
  `placeNewPassword` varchar(100) DEFAULT NULL,
  `placeConfirmPassword` varchar(100) DEFAULT NULL,
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
  `buttonYou` varchar(100) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=FIXED AUTO_INCREMENT=2 ;

--
-- Dumping data for table `language_labels`
--

INSERT INTO `language_labels` (`labelID`, `commonFriends`, `commonGroups`, `commonPhotos`, `commonCreateGroup`, `topMenuHome`, `topMenuMessages`, `topMenuNotifications`, `topMenuSeeAll`, `topMenuSettings`, `topMenuLogout`, `topMenuLogin`, `topMenuJoin`, `commonAbout`, `commonRecentVisitors`, `yourPhotos`, `photosOfYours`, `commonFollowers`, `boxName`, `boxUpdates`, `boxWebcam`, `boxLocation`, `buttonUpdate`, `buttonComment`, `buttonFollow`, `buttonFollowing`, `buttonMessage`, `buttonJoinGroup`, `buttonUnfollowGroup`, `buttonEditGroup`, `buttonSaveSettings`, `buttonSocialSave`, `buttonLogin`, `buttonSignUp`, `buttonForgotButton`, `buttonSetNewPassword`, `buttonFacebook`, `buttonGoogle`, `buttonMicrosoft`, `buttonLinkedin`, `feedLike`, `feedUnLike`, `feedLikeThis`, `feedShare`, `feedUnshare`, `feedShareThis`, `feedComment`, `feedDeleteUpdate`, `feedPosted`, `settingsTitle`, `settingsUsername`, `settingsEmail`, `settingsName`, `settingsPassword`, `settingsChangePassword`, `settingsOldPassword`, `settingsNewPassword`, `settingsConfirmPassword`, `settingsGroup`, `settingsGender`, `settingsAboutMe`, `settingsEmailAlerts`, `socialTitle`, `socialFacebook`, `socialTwitter`, `socialGoogle`, `socialInstagram`, `placeSearch`, `placeComment`, `placeUpdate`, `placeEmailUsername`, `placePassword`, `placeEmail`, `placeUsername`, `placeOldPassword`, `placeNewPassword`, `placeConfirmPassword`, `loginTitle`, `emailUsername`, `password`, `forgotPassword`, `registrationTitle`, `email`, `username`, `agreeMessage`, `resetPassword`, `thankYou`, `thankYouMessage`, `buttonYou`) VALUES
(1, 'ఫ్రెండ్స్', 'Groups', 'Photos', 'Create Group', 'Home', 'Messages', 'Notifications', 'See All', 'Settings', 'Logout', 'Login', 'Join', 'About', 'Recent Visitors', 'Your Photos', 'Photos of Yours', 'Followers', 'What''s Up?', 'Updates', 'Webcam', 'Location', 'Update', 'Comment', 'Follow', 'Following', 'Message', 'Join Group', 'Unfollow Group', 'Edit Group', 'Save Settings', 'Save', 'Login', 'Sign Up', 'Send Reset Instructions ', 'Set New Password', ' Sign in with Facebook', ' Sign in with Google', ' Sign in with Microsoft', ' Sign in with Linkedin', 'Like', 'Unlike', 'like this', 'Share', 'Unshare', 'share this', 'Comment', 'Delete update.', 'posted in', 'Profile Settings', 'Username', 'Email', 'Name', 'Password', 'Change Password', 'Old Password', 'New Password', 'Confirm Password', 'Group', 'Gender', 'About Me', 'Email Alerts', 'Social Connections', 'Facebook', 'Twitter', 'Google', 'Instagram', 'Search for people and groups', 'Write a comment..', 'Write your status..', 'Enter Email or Username', 'Enter Passsword', 'Enter Email', 'Enter Username', 'Old Password', 'New Password', 'Confirm Password', 'Login', 'Email or Username', 'Password', 'Forgot password?', 'Registration', 'Email', 'Username', 'By clicking Sign Up, you agree to our', 'Reset Pasword', 'Thank you!', 'Please confirm your email. ', 'You');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `language_labels`
--
ALTER TABLE `language_labels`
 ADD PRIMARY KEY (`labelID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `language_labels`
--
ALTER TABLE `language_labels`
MODIFY `labelID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
