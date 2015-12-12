-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 12, 2015 at 03:18 AM
-- Server version: 5.5.42
-- PHP Version: 5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cakephp`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) unsigned NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `content` text,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `commentsAllowed` tinyint(1) NOT NULL DEFAULT '1',
  `commentCount` int(10) NOT NULL DEFAULT '0',
  `user_id` bigint(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `content`, `date`, `publish`, `commentsAllowed`, `commentCount`, `user_id`) VALUES
(9, 'Gajesh', 'GAjesh Solanki', '2015-12-15 05:00:00', 1, 1, 0, 1),
(10, 'Solanki', 'assignment 3 of cake', '2015-12-01 18:17:47', 1, 1, 0, 3),
(11, 'gauti', 'kfkjjeojeoiewjfw', '2015-12-07 06:21:43', 1, 1, 0, 5),
(14, 'skhsahasjsajsad', 'saasjkjksjDL;asjdlkD', '2015-12-07 06:26:54', 1, 1, 0, 8);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) unsigned NOT NULL,
  `article_id` bigint(20) unsigned NOT NULL,
  `content` text NOT NULL,
  `date` date NOT NULL,
  `authorName` varchar(50) DEFAULT NULL,
  `authorEmail` varchar(50) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `article_id`, `content`, `date`, `authorName`, `authorEmail`, `approved`) VALUES
(1, 1, 'Hi, This is very informative article.', '2015-11-18', 'Parth Kheni', 'kheni.parth@gmail.com', 1),
(2, 1, 'Hi, This is new comment', '2015-12-03', 'Parth Kheni', 'kheni.parth@gmail.com', 1),
(3, 2, 'Hi, This is new comment', '2015-12-03', 'Parth Kheni', 'kheni.parth@gmail.com', 1),
(5, 1, 'first comment', '1970-01-01', 'gajesh', 'a@b.c', 1),
(6, 1, 'test 1', '1970-01-01', 'swapna', 'swapna@gmail.com', 1),
(7, 1, 'test 2', '1970-01-01', 'parth', 'sf', 0),
(8, 1, 'test 2', '1970-01-01', 'parth', 'sf', 0),
(9, 1, 'test 2', '1970-01-01', 'parth', 'sf', 0),
(10, 1, 'test 3', '1970-01-01', 'parth', 'swapna@gmail.com', 0),
(11, 1, 'sdf', '1970-01-01', 'parth', 'a@b.c', 0),
(12, 1, 'sdfa', '1970-01-01', 'parth', 'a@b.c', 0),
(13, 1, 'sdf sdf s f', '1970-01-01', 'parth', 'a@b.c', 0),
(14, 1, 'sdfs f', '1970-01-01', 'parth', 'a@b.c', 0),
(15, 1, 'sdfs f', '1970-01-01', 'parth', 'a@b.c', 0),
(16, 1, 'sdfs f', '1970-01-01', 'parth', 'a@b.c', 0),
(17, 1, '\r\ntime check', '1970-01-01', 'parth', 'sf', 0),
(18, 1, 'sf fs', '1970-01-01', 'parth', 'a@b.c', 0),
(19, 1, 'date check', '1970-01-01', 'parth', 'a@b.c', 0),
(20, 1, 's', '2015-12-04', 'parth', 'a@b.c', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$Wz1Udl.yR0Dri0uVQR75BuoPCpQekB1yLsdYEcylX/oMhU754wORm', 'admin'),
(2, 'parth', '$2y$10$KqGFzsW8q9Xv7Fmo1Ib6O.txcRVpY19c2CLWgjyOtrMODU06hFh6u', 'author');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
