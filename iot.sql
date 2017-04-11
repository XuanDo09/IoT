-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2017 at 09:27 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `iot`
--

-- --------------------------------------------------------

--
-- Table structure for table `sensors`
--

CREATE TABLE IF NOT EXISTS `sensors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `sensors`
--

INSERT INTO `sensors` (`id`, `name`, `place`, `user`) VALUES
(1, 'Sensor Nguyen Van Cu', 'Nguyen Van Cu, Ho Chi Minh', 'xuando'),
(2, 'Sensor Dinh Tien Hoang', 'Dinh Tien Hoang, Ho Chi Minh', 'DTKX'),
(3, 'Sensor Ung Van Khiem', 'Ung Van Khiem, Ho Chi Minh', 'xd'),
(4, 'Sensor Tran Hung Dao', 'Tran Hung Dao, Ho Chi Minh', 'XuanDo'),
(5, 'Sensor Le Hong Phong', 'Le Hong Phong, Ho Chi Minh', 'DoXuan');

-- --------------------------------------------------------

--
-- Table structure for table `templog`
--

CREATE TABLE IF NOT EXISTS `templog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sensor` int(11) NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `temperature` float NOT NULL,
  `humidity` float NOT NULL,
  `moisture` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=715 ;

--
-- Dumping data for table `templog`
--

INSERT INTO `templog` (`id`, `id_sensor`, `timeStamp`, `temperature`, `humidity`, `moisture`) VALUES
(696, 1, '2017-04-03 07:39:58', 21, 21, 21),
(697, 1, '2017-04-11 04:06:52', 30, 65, 31),
(703, 1, '2017-04-11 06:46:01', 33.5, 56.1, 31.97),
(704, 2, '2017-04-11 06:47:05', 33.5, 56.1, 31.61),
(705, 3, '2017-04-11 06:48:03', 33.6, 56.1, 31.34),
(706, 4, '2017-04-11 06:50:01', 32.8, 56, 31.88),
(707, 5, '2017-04-11 06:50:55', 33.6, 55.9, 31.43),
(708, 5, '2017-04-11 06:56:02', 33.6, 55.9, 31.88),
(709, 5, '2017-04-11 07:01:08', 33.3, 55.9, 31.97),
(710, 5, '2017-04-11 07:06:15', 33.5, 56.1, 31.7),
(711, 5, '2017-04-11 07:11:20', 33.5, 56.2, 32.06),
(712, 1, '2017-04-11 07:16:03', 33.5, 56.5, 31.97),
(713, 1, '2017-04-11 07:17:30', 33.5, 56.9, 31.97),
(714, 1, '2017-04-11 07:22:36', 33.6, 57.5, 32.06);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('1','0') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created`, `status`) VALUES
(3, 'xuando', 'dtkx95@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-04-03 13:00:37', '1'),
(5, 'DTKX', 'xuando@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-04-03 13:47:29', '1'),
(7, 'xd', 'xd@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-04-03 13:53:30', '1'),
(12, 'XuanDo', 'dtkx@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-04-03 18:20:49', '1'),
(13, 'DoXuan', 'doxuan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2017-04-11 13:10:15', '1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
