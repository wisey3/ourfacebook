-- phpMyAdmin SQL Dump
-- version 4.6.5.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 01, 2017 at 05:57 PM
-- Server version: 5.6.34
-- PHP Version: 7.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `sn_coursework`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`title`, `content`, `id`, `date`, `user_id`) VALUES
('sf', 'afdaf', 18, '2017-02-20', 9),
('other', 'adddd', 19, '2017-02-20', 10),
('safaf', 'dsfdsf', 20, '2017-02-20', 0),
('aaaaa', 'dfsf', 22, '2017-02-20', 0),
('assd', 'fsfs', 23, '2017-02-20', 0),
('ekljl', 'dfsdf', 26, '2017-02-21', 9),
('example', 'content', 29, '2017-02-21', 9),
('test3', 'test3content', 30, '2017-02-21', 13),
('test32', 'test32 content', 31, '2017-02-21', 13),
('hiii', 'hiii', 34, '2017-02-28', 12),
('hhh', 'kkjljl', 35, '2017-02-28', 12);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;