-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2019 at 09:52 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oms`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_handle`
--

CREATE TABLE `user_handle` (
  `server_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_handle`
--

INSERT INTO `user_handle` (`server_id`, `username`, `pass`) VALUES
(1, 'user1', 'pass1'),
(2, 'user2', 'pass2'),
(3, 'user3', 'pass3');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `server_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `contact_no` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`server_id`, `first_name`, `last_name`, `email`, `contact_no`) VALUES
(1, 'Md.', 'Imtiaz', 'mdimti@mail.com', '01237489512'),
(2, 'Md.', 'Fahim', 'fahim@mail.com', '01301478956'),
(3, 'MD.', 'Rafiq', 'raq@mail.com', '01214789356');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_handle`
--
ALTER TABLE `user_handle`
  ADD PRIMARY KEY (`server_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`server_id`),
  ADD UNIQUE KEY `email` (`email`,`contact_no`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_handle`
--
ALTER TABLE `user_handle`
  ADD CONSTRAINT `uhFKui` FOREIGN KEY (`server_id`) REFERENCES `user_info` (`server_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
