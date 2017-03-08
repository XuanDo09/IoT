-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2017 at 10:46 AM
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
-- Table structure for table `templog`
--

CREATE TABLE IF NOT EXISTS `templog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `temperature` float NOT NULL,
  `humidity` float NOT NULL,
  `moisture` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=280 ;

--
-- Dumping data for table `templog`
--

INSERT INTO `templog` (`id`, `timeStamp`, `temperature`, `humidity`, `moisture`) VALUES
(1, '2017-03-07 10:44:11', 23, 54, 0),
(169, '2017-03-08 04:55:09', 25, 30, 35),
(170, '2017-03-08 05:26:05', 21, 21, 21),
(171, '2017-03-08 05:36:02', 23, 24, 25),
(277, '2017-03-08 05:38:24', 25, 26, 27),
(278, '2017-03-08 05:40:51', 48, 49, 50),
(279, '2017-03-08 05:44:38', 10, 23, 50);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'XuanDo', 'dtkx@gmail.com', '123456');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
