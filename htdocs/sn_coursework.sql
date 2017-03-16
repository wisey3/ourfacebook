-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2017 at 08:10 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sn_coursework`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE IF NOT EXISTS `album` (
`albumID` int(10) unsigned NOT NULL,
  `albumName` text NOT NULL,
  `userID` int(11) NOT NULL,
  `viewStatus` varchar(100) NOT NULL DEFAULT 'F',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`albumID`, `albumName`, `userID`, `viewStatus`, `date`) VALUES
(12, 'saasdfasd', 35, 'F', '2017-03-16 17:52:57'),
(13, 'asdfsdf', 35, 'E', '2017-03-16 17:53:00');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
`id` int(10) unsigned NOT NULL,
  `from` int(10) unsigned NOT NULL DEFAULT '0',
  `to` int(10) unsigned NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recd` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `circlemembership`
--

CREATE TABLE IF NOT EXISTS `circlemembership` (
`id` int(11) NOT NULL,
  `circleID` int(11) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `circlemembership`
--

INSERT INTO `circlemembership` (`id`, `circleID`, `userID`) VALUES
(5, 83, 35),
(6, 84, 35);

-- --------------------------------------------------------

--
-- Table structure for table `circles`
--

CREATE TABLE IF NOT EXISTS `circles` (
`id` int(11) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `circles`
--

INSERT INTO `circles` (`id`, `name`) VALUES
(79, 'test'),
(80, ',jbjb'),
(81, 'JJJ'),
(82, 'afasf'),
(83, 'JJJ'),
(84, 'New');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
`id` int(11) NOT NULL,
  `photoID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `albumID` int(11) unsigned NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
`photoID` int(11) NOT NULL,
  `albumID` int(11) unsigned NOT NULL,
  `userID` int(11) NOT NULL,
  `refLoc` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Relationships`
--

CREATE TABLE IF NOT EXISTS `Relationships` (
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  `last_action` int(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
`id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `sex` varchar(11) NOT NULL,
  `dob` date NOT NULL,
  `location` varchar(20) NOT NULL,
  `education` varchar(100) NOT NULL DEFAULT 'UCL',
  `date_joined` date NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `privacy` int(2) NOT NULL DEFAULT '3',
  `lastActive` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`, `sex`, `dob`, `location`, `education`, `date_joined`, `email`, `password`, `privacy`, `lastActive`) VALUES
(35, 'Justin Jude', 'Male', '1992-04-01', 'London', 'UCL', '2017-03-16', 'test11@email.com', '$2y$10$URDDJBmObCySBtVBDdFdl.Vu9bBjaHPyYEbIqvbhuhxpLoI508rjW', 3, '2017-03-16 19:10:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
 ADD PRIMARY KEY (`albumID`), ADD UNIQUE KEY `albumID` (`albumID`), ADD KEY `albumID_2` (`albumID`), ADD KEY `albumID_3` (`albumID`), ADD KEY `userID` (`userID`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `circlemembership`
--
ALTER TABLE `circlemembership`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `circleID` (`circleID`), ADD KEY `userID` (`userID`);

--
-- Indexes for table `circles`
--
ALTER TABLE `circles`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `id_2` (`id`), ADD KEY `id_3` (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `photoID` (`photoID`), ADD KEY `userID` (`userID`), ADD KEY `albumID` (`albumID`), ADD KEY `albumID_2` (`albumID`);

--
-- Indexes for table `photo`
--
ALTER TABLE `photo`
 ADD PRIMARY KEY (`photoID`), ADD UNIQUE KEY `photoID_2` (`photoID`), ADD KEY `photoID` (`photoID`), ADD KEY `albumID` (`albumID`), ADD KEY `userID` (`userID`), ADD KEY `albumID_2` (`albumID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Relationships`
--
ALTER TABLE `Relationships`
 ADD PRIMARY KEY (`user_1`,`user_2`), ADD KEY `user_1` (`user_1`), ADD KEY `user_2` (`user_2`), ADD KEY `user_2_2` (`user_2`), ADD KEY `user_1_2` (`user_1`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `id_2` (`id`), ADD KEY `id_3` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
MODIFY `albumID` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `circlemembership`
--
ALTER TABLE `circlemembership`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `circles`
--
ALTER TABLE `circles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=85;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `photo`
--
ALTER TABLE `photo`
MODIFY `photoID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=36;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `circlemembership`
--
ALTER TABLE `circlemembership`
ADD CONSTRAINT `circle` FOREIGN KEY (`circleID`) REFERENCES `circles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user` FOREIGN KEY (`userID`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`photoID`) REFERENCES `photo` (`photoID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`albumID`) REFERENCES `album` (`albumID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `photo`
--
ALTER TABLE `photo`
ADD CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`albumID`) REFERENCES `album` (`albumID`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `photo_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
