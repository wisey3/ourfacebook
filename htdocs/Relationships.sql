-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2017 at 01:21 PM
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
-- Table structure for table `Relationships`
--

CREATE TABLE IF NOT EXISTS `Relationships` (
  `user_1` int(11) NOT NULL,
  `user_2` int(11) NOT NULL,
  `last_action` int(11) NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Relationships`
--

INSERT INTO `Relationships` (`user_1`, `user_2`, `last_action`, `status`) VALUES
(23, 24, 23, 'accepted'),
(23, 25, 23, 'accepted'),
(23, 26, 23, 'accepted'),
(23, 27, 23, 'accepted'),
(24, 25, 24, 'accepted'),
(24, 26, 24, 'accepted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Relationships`
--
ALTER TABLE `Relationships`
 ADD PRIMARY KEY (`user_1`,`user_2`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
