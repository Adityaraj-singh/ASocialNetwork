-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 11:38 AM
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
-- Table structure for table `textposts`
--

CREATE TABLE `textposts` (
  `id` int(150) NOT NULL,
  `userid` int(150) NOT NULL,
  `usrname` text NOT NULL,
  `post_title` varchar(200) NOT NULL,
  `type` text NOT NULL,
  `post_content` mediumtext NOT NULL,
  `align` text NOT NULL DEFAULT 'Left',
  `time` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `likes` int(100) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `textposts`
--

INSERT INTO `textposts` (`id`, `userid`, `usrname`, `post_title`, `type`, `post_content`, `align`, `time`, `likes`) VALUES
(1, 1, 'changu', 'heyy', 'text', 'heyy this is the post', 'Left', '0000-00-00 00:00:00.000000', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `textposts`
--
ALTER TABLE `textposts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `textposts`
--
ALTER TABLE `textposts`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
