-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2017 at 01:30 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`id`, `name`, `sex`, `dob`, `location`, `education`, `date_joined`, `email`, `password`, `privacy`, `lastActive`) VALUES
(23, 'Justin Jude', 'Male', '1995-11-01', 'London', 'UCL', '2017-03-14', 'justinjude@me.com', '$2y$10$Q5nrWNlBhohGSfXbcxGSyOqxDEuT1fd51bPQqvzSsiQlDNJkx4nBa', 3, '2017-03-14 12:39:31'),
(25, 'Frank Sinatra', 'Male', '1933-12-04', 'New York', 'UCL', '2017-02-14', 'test3@email.com', '$2y$10$N7qYk0CUgIQwqCWhZWDMM.HO7Rv8YXMzFeJJKv..aANhWBIcnAztO', 3, '2017-03-14 12:43:27'),
(26, 'Richard Dawkins', 'Male', '1994-12-03', 'London', 'UCL', '2017-02-14', 'test5@email.com', '$2y$10$geKza.B84swaSuVJCRvbteYQ8ATF7VId4XWx5JFvBdC8H1drFwPCC', 3, '2017-03-13 10:27:10'),
(27, 'Test', 'Male', '1993-11-04', 'London', 'UCL', '2017-02-21', 'test10@email.com', '$2y$10$U0lZkrz1P1lZqM80QUQXv.Avu36eAv9hrb6rYMWQbBRGxJ/rirrdq', 3, '2017-03-13 10:27:10'),
(28, 'Graham Roberts', 'Male', '1995-12-01', 'London', 'UCL', '2017-02-21', 'test@email.com', '$2y$10$yO9Stoy4YL7PdGtUM6fuwOCBvAKyjlsNDAX01YUXwiSD2TrcamXZ2', 3, '2017-03-14 12:59:24'),
(29, 'Newone', 'Male', '1992-12-03', 'London', 'UCL', '2017-03-01', 'test11@email.com', '$2y$10$PZP9k1.JcWN06qKcT.fZIegw90LSy355ZKvd13uzImf2Wskd7bGmy', 2, '2017-03-15 00:30:49'),
(30, 'test12', 'Male', '1993-03-02', 'London', 'UCL', '2017-03-01', 'test12@email.com', '$2y$10$6.5JZDP5d2uesE1NRWhH1.yD3RUNxDHReLUK.HSf..oWRGaMeQlfy', 3, '2017-03-13 10:27:10'),
(31, 'Nancy M', 'Female', '1992-05-04', 'London', 'UCL', '2017-03-06', 'test22@email.com', '$2y$10$aNhh3zKzT38Mm1LuCqtDw.zyaW.GJUDqQ5y9wW4zizWXnK9q5XXJW', 3, '2017-03-14 01:36:41'),
(32, 'KingsTest', 'Male', '1992-04-01', 'London', 'KCL', '2017-03-13', 'kings@email.com', '$2y$10$x5MKEHYub4oDRBoZbr5jqeaZxBdhqehAVVmQaMKH3NydRnVJQeaem', 3, '2017-03-14 12:35:29'),
(33, 'Kings2', 'Male', '1992-03-03', 'Newcastle', 'KCL', '2017-03-13', 'kings2@email.com', '$2y$10$P.c8FzoXxZSxZolBFunpa.6sVrSSEiNto7NSDiEv5k6MkmVyASVvG', 3, '2017-03-14 12:35:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
