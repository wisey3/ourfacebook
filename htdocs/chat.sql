-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 13, 2017 at 10:28 AM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sn_coursework`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(10) UNSIGNED NOT NULL,
  `from` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `to` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recd` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `from`, `to`, `message`, `sent`, `recd`) VALUES
(1, 19, 21, 'hey', '2017-03-09 14:34:50', 1),
(2, 19, 21, 'hey', '2017-03-09 14:35:32', 1),
(3, 19, 21, 'hey', '2017-03-09 14:36:21', 1),
(4, 19, 21, 'hey', '2017-03-09 14:37:47', 1),
(5, 19, 21, 'hey', '2017-03-09 14:38:26', 1),
(6, 19, 21, 'hey', '2017-03-09 14:38:37', 1),
(7, 19, 21, 'hey', '2017-03-09 14:39:13', 1),
(8, 19, 21, 'hey', '2017-03-09 14:39:53', 1),
(9, 19, 21, 'hey', '2017-03-09 14:40:58', 1),
(10, 19, 21, 'hey', '2017-03-09 14:42:06', 1),
(11, 19, 21, 'hey', '2017-03-09 14:43:33', 1),
(12, 19, 21, 'hey', '2017-03-09 14:44:35', 1),
(13, 19, 21, 'hey', '2017-03-09 14:45:19', 1),
(14, 19, 21, 'hey', '2017-03-09 14:48:19', 1),
(15, 19, 21, 'hey', '2017-03-09 14:50:05', 1),
(16, 19, 21, 'e', '2017-03-09 14:50:16', 1),
(17, 19, 21, 'whay', '2017-03-09 14:50:28', 1),
(18, 19, 21, 'hey', '2017-03-09 14:51:38', 1),
(19, 19, 20, 'why', '2017-03-09 14:52:02', 0),
(20, 21, 19, 'hey', '2017-03-09 14:53:12', 1),
(21, 19, 21, 'how are you', '2017-03-09 14:53:33', 1),
(22, 21, 19, 'hi', '2017-03-09 14:53:49', 1),
(23, 21, 19, 'how you doing', '2017-03-09 14:53:59', 1),
(24, 19, 21, 'hey', '2017-03-09 14:54:55', 1),
(25, 19, 21, 'hey', '2017-03-09 14:55:02', 1),
(26, 19, 21, 'hey', '2017-03-09 14:57:42', 1),
(27, 19, 21, 'what you upto', '2017-03-09 15:00:56', 1),
(28, 21, 19, 'yeah not much you', '2017-03-09 15:01:08', 1),
(29, 21, 19, 'hows life', '2017-03-09 15:01:18', 1),
(30, 19, 21, 'good you', '2017-03-09 15:01:27', 1),
(31, 21, 19, 'well its good to see things are going well', '2017-03-09 15:03:31', 1),
(32, 16, 19, 'hey', '2017-03-09 15:08:03', 1),
(33, 19, 16, 'how are you', '2017-03-09 15:08:14', 1),
(34, 19, 16, 'sup', '2017-03-09 15:08:55', 1),
(35, 21, 19, 'hey ell', '2017-03-09 15:10:01', 1),
(36, 19, 21, 'oh hey', '2017-03-09 15:10:07', 1),
(37, 21, 19, 'how you been', '2017-03-09 15:10:11', 1),
(38, 19, 21, 'hey', '2017-03-09 15:13:41', 1),
(39, 19, 21, 'hey', '2017-03-09 15:27:41', 1),
(40, 16, 19, 'Hey', '2017-03-09 15:33:46', 1),
(41, 19, 16, 'hey', '2017-03-09 15:33:49', 1),
(42, 16, 19, 'Whatup', '2017-03-09 15:33:49', 1),
(43, 19, 16, '?', '2017-03-09 15:33:54', 1),
(44, 19, 16, 'you actually online', '2017-03-09 15:33:57', 1),
(45, 16, 19, 'What\'s this cool website', '2017-03-09 15:34:02', 1),
(46, 19, 16, 'haha', '2017-03-09 15:34:06', 1),
(47, 19, 16, 'we should get rid of the list of friends on the profile page now', '2017-03-09 15:34:23', 1),
(48, 16, 19, 'So when you close this it does\'t save?', '2017-03-09 15:34:27', 1),
(49, 19, 16, 'i dont think so we can try', '2017-03-09 15:34:37', 1),
(50, 16, 19, 'Yeah just logged back in it\'s gone', '2017-03-09 15:34:58', 1),
(51, 19, 16, 'did it save', '2017-03-09 15:34:58', 1),
(52, 16, 19, 'na', '2017-03-09 15:35:01', 1),
(53, 19, 16, 'nope', '2017-03-09 15:35:02', 1),
(54, 16, 19, 'Can you do a group chat with the circle as well?', '2017-03-09 15:35:12', 1),
(55, 19, 16, 'it will save the unread messages', '2017-03-09 15:35:18', 1),
(56, 16, 19, 'Oh right', '2017-03-09 15:35:33', 1),
(57, 16, 19, 'That\'s decent actually', '2017-03-09 15:35:38', 1),
(58, 19, 16, 'theoretically yes, we would just need to put the circleids in', '2017-03-09 15:35:50', 1),
(59, 19, 16, 'if you log out ill send some messgaes and you can see', '2017-03-09 15:36:03', 1),
(60, 19, 16, 'so', '2017-03-09 15:36:12', 1),
(61, 16, 19, 'Yeah logging out now', '2017-03-09 15:36:16', 1),
(62, 19, 16, 'the little', '2017-03-09 15:36:21', 1),
(63, 19, 16, 'brown fox', '2017-03-09 15:36:23', 1),
(64, 19, 16, 'jumped over', '2017-03-09 15:36:27', 1),
(65, 19, 16, 'the', '2017-03-09 15:36:28', 1),
(66, 19, 16, 'lazy dog', '2017-03-09 15:36:30', 1),
(67, 19, 16, 'There you go', '2017-03-09 15:36:42', 1),
(68, 16, 19, 'Only got "the little"', '2017-03-09 15:37:10', 1),
(69, 19, 16, 'really', '2017-03-09 15:37:39', 1),
(70, 19, 16, 'oh shit', '2017-03-09 15:37:42', 1),
(71, 19, 16, 'i sent like', '2017-03-09 15:38:03', 1),
(72, 19, 16, '5', '2017-03-09 15:38:05', 1),
(73, 16, 19, 'Got "really"', '2017-03-09 15:44:18', 1),
(74, 19, 20, 'hey', '2017-03-09 15:45:51', 0),
(75, 19, 16, 'test', '2017-03-09 15:46:24', 1),
(76, 16, 19, 'J test', '2017-03-09 15:55:51', 1),
(77, 16, 18, 'Hi', '2017-03-09 15:56:16', 0),
(78, 16, 25, 'Hey', '2017-03-09 16:00:17', 1),
(79, 25, 16, 'Test', '2017-03-09 16:00:28', 1),
(80, 25, 16, 'a[sofdjsa', '2017-03-09 16:00:29', 1),
(81, 25, 16, 'asdojfnpasn', '2017-03-09 16:00:29', 1),
(82, 25, 16, 'asjgnpaskn', '2017-03-09 16:00:30', 1),
(83, 25, 16, 'pfskgnp', '2017-03-09 16:00:31', 1),
(84, 25, 16, 'cvlxnbln', '2017-03-09 16:00:32', 1),
(85, 19, 16, 'hey', '2017-03-09 16:15:07', 1),
(86, 19, 21, 'hey', '2017-03-09 16:15:19', 1),
(87, 21, 19, 'hey', '2017-03-09 16:15:45', 1),
(88, 19, 21, 'hey', '2017-03-09 16:16:08', 1),
(89, 19, 21, 'hey', '2017-03-09 16:16:26', 1),
(90, 19, 21, 'hey', '2017-03-09 16:16:54', 1),
(91, 21, 19, 'hi', '2017-03-09 16:17:07', 1),
(92, 21, 19, 'when', '2017-03-09 16:17:41', 1),
(93, 19, 21, 'how', '2017-03-09 16:17:54', 1),
(94, 19, 21, 'why is it so buggy', '2017-03-09 16:18:10', 1),
(95, 21, 19, 'not sure', '2017-03-09 16:18:21', 1),
(96, 19, 21, 'hmm', '2017-03-09 16:29:17', 1),
(97, 21, 19, 'hey', '2017-03-09 16:39:33', 1),
(98, 19, 21, 'hey', '2017-03-09 16:39:43', 1),
(99, 19, 21, 'hey', '2017-03-09 16:39:56', 1),
(100, 19, 21, 'b', '2017-03-09 16:40:03', 1),
(101, 19, 21, 'hey', '2017-03-09 16:40:22', 1),
(102, 19, 21, 'h', '2017-03-09 16:40:24', 1),
(103, 19, 21, 'h', '2017-03-09 16:40:25', 1),
(104, 19, 21, 'h', '2017-03-09 16:40:25', 1),
(105, 19, 21, 'h', '2017-03-09 16:40:36', 1),
(106, 19, 21, 'h', '2017-03-09 16:40:36', 1),
(107, 19, 21, 'hey', '2017-03-09 16:44:53', 1),
(108, 19, 21, 'hey', '2017-03-09 16:44:56', 1),
(109, 21, 19, 'ey', '2017-03-09 16:45:02', 1),
(110, 21, 19, 'hey', '2017-03-09 16:47:44', 1),
(111, 19, 21, 'hey', '2017-03-09 16:47:49', 1),
(112, 19, 21, 'hey', '2017-03-09 16:47:51', 1),
(113, 19, 21, 'how are you', '2017-03-09 16:47:55', 1),
(114, 21, 19, 'hey', '2017-03-09 16:48:06', 1),
(115, 19, 21, 'hey', '2017-03-09 16:49:18', 1),
(116, 19, 21, 'sup', '2017-03-09 16:49:47', 1),
(117, 19, 21, 'hey', '2017-03-09 16:50:25', 1),
(118, 19, 21, 'hi', '2017-03-09 16:50:54', 1),
(119, 19, 21, 'hey', '2017-03-09 16:51:22', 1),
(120, 19, 21, 'h', '2017-03-09 16:55:31', 1),
(121, 19, 21, 'hey', '2017-03-09 17:04:37', 1),
(122, 19, 21, 'whats new', '2017-03-09 17:04:59', 1),
(123, 19, 21, 'hi', '2017-03-09 17:07:55', 1),
(124, 19, 21, 'hey', '2017-03-09 17:10:28', 1),
(125, 19, 21, 'hey', '2017-03-09 17:11:45', 1),
(126, 19, 21, 'h', '2017-03-09 17:12:02', 1),
(127, 19, 16, 'ho', '2017-03-09 17:18:11', 1),
(128, 19, 16, 'h', '2017-03-09 17:18:43', 1),
(129, 19, 21, 'hi', '2017-03-09 17:24:00', 0),
(130, 19, 17, 'test', '2017-03-09 17:24:33', 0),
(131, 19, 16, 'hey', '2017-03-12 16:35:09', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
