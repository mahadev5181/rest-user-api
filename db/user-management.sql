-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2018 at 07:30 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `role` int(3) NOT NULL COMMENT '1:admin;2:user',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `role`, `created_date`) VALUES
(1, 'Mahadev Shetye', 'mahadevshetye@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bangalore', 1, '2018-06-05 17:26:46'),
(2, 'Codin3', 'info@coding4developers.com', '', 'Bulandshahr UP', 0, '2018-06-05 07:22:49'),
(3, 'Codin3', 'info@coding4developers.com', '1', 'Bulandshahr UP', 0, '2018-06-05 07:25:42'),
(5, 'Pankaj123', 'pankaj123@test.com', 'e10adc3949ba59abbe56e057f20f883e', 'pune', 1, '2018-06-05 11:22:32'),
(6, 'Pankaj', 'pankaj@test.com', '123456', 'bangaloire', 2, '2018-06-05 11:14:13'),
(7, 'test7777', 'test@testing.om', 'e10adc3949ba59abbe56e057f20f883e', 'goa', 2, '2018-06-05 14:28:06'),
(8, 'Admin', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 'bangaloire', 1, '2018-06-05 12:03:31'),
(9, '', '', 'd41d8cd98f00b204e9800998ecf8427e', '', 2, '2018-06-05 13:32:34'),
(10, 'nine name', 'nine@email.com', 'd41d8cd98f00b204e9800998ecf8427e', 'nine add', 1, '2018-06-05 15:18:02'),
(13, 'new user', 'new@new.com', '22af645d1859cb5ca6da0c484f1f37ea', 'new add', 2, '2018-06-05 15:16:28'),
(14, 'testing name', 'testimg@email.com', 'e10adc3949ba59abbe56e057f20f883e', '', 2, '2018-06-05 15:22:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
