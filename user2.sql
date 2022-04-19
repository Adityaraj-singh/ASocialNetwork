-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 11:35 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `user2`
--

CREATE TABLE `user2` (
  `id` int(145) NOT NULL,
  `username` text NOT NULL,
  `email` varchar(145) NOT NULL,
  `password` varchar(200) NOT NULL,
  `profile_pic` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user2`
--

INSERT INTO `user2` (`id`, `username`, `email`, `password`, `profile_pic`) VALUES
(1, 'adityaraj', 'adityarsingh2ss4@gmail.com', 'sherlock007@', ''),
(3, 'changu', 'adityarsingh24@gmail.com', '8350f5da61dbca4c0c4f574fd838ba4f', '608fc2ece2d2b0.81711159.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user2`
--
ALTER TABLE `user2`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user2`
--
ALTER TABLE `user2`
  MODIFY `id` int(145) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
