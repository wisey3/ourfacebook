-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2017 at 05:47 PM
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
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
`id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `title` varchar(40) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `date`) VALUES
(5, 23, 'tafasdfa', 'asdhgsbsvf', '2017-03-01'),
(8, 23, 'asdfasf', 'asdgsgvsadvsd', '2017-03-01'),
(9, 23, 'fasfadsas', 'fasdfsadfsa', '2017-03-01'),
(10, 23, 'sdf asdf', 'safasfdsafa', '2017-03-01'),
(11, 23, 'afssfd', 'dsafasdfa', '2017-03-01'),
(12, 23, 'JJJ', 'dsafadfss', '2017-03-01'),
(13, 23, 'loonoo', 'ononon', '2017-03-01'),
(14, 23, ';nnnklok', 'knlkmkl', '2017-03-01'),
(15, 23, 'fcfcgfvjhbk', 'lkmlkjhggvj', '2017-03-01'),
(16, 23, 'lknlnl', 'lknlkmkml', '2017-03-01'),
(17, 23, ';knlnlk', 'hg fh ', '2017-03-01'),
(18, 23, 'fdgsdfdg', 'gdgfds', '2017-03-01'),
(19, 23, 'lknln', 'knvtxtrvbh', '2017-03-01'),
(20, 23, 'onon', 'ibgcftvyg', '2017-03-01'),
(21, 23, 'j k knkibvug', 'gvuhbjkn', '2017-03-01'),
(22, 23, 'lknlkm nl', 'lnkjljln', '2017-03-01'),
(23, 23, 'ljnknjknl', 'gfvjhb', '2017-03-01'),
(24, 23, 'iuggg', 'yvcfg', '2017-03-01'),
(25, 23, 'ddd', 'ddd', '2017-03-01'),
(26, 23, 'bsgfd', 'sdfgdsfdfg', '2017-03-01'),
(27, 23, 'sadasdf', 'fasdf', '2017-03-01'),
(28, 23, 'sfdasdfasdf', 'asfdsdffds', '2017-03-01'),
(29, 23, ' a sdfadsf', 'sadfasfd', '2017-03-01'),
(30, 23, 'asfasdf', 'sdafsdf', '2017-03-01'),
(31, 23, 'dsvsaf', 'fsdsdfsd', '2017-03-01'),
(32, 23, 'cd`z', 'c`czx', '2017-03-01'),
(33, 23, 'lnlnn', 'njnonon', '2017-03-01'),
(34, 23, 'sadfasf', 'asdfasf', '2017-03-01'),
(35, 23, 'aadsfsaf', 'dsafsadf', '2017-03-01'),
(36, 23, 'sadfasd', 'sdfasfdsf', '2017-03-01'),
(37, 23, 'JJJ1', 'JJJ1', '2017-03-01'),
(38, 23, 'sdadf', 'asfdasdf', '2017-03-01'),
(39, 23, 'New', 'asdfdsadsf', '2017-03-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
