-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2020 at 04:44 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lost and found1 management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(15) NOT NULL DEFAULT 'admin1',
  `admin_pswd` varchar(15) NOT NULL DEFAULT '123456789'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_pswd`) VALUES
('admin', '123456789'),
('admin1', '123456789');

-- --------------------------------------------------------

--
-- Table structure for table `admin_ph`
--

CREATE TABLE `admin_ph` (
  `admin_id` varchar(15) NOT NULL DEFAULT 'admin1',
  `admin_phno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `foundobj`
--

CREATE TABLE `foundobj` (
  `foundobj_id` int(15) NOT NULL,
  `foundobj_name` varchar(25) NOT NULL,
  `found-date` date NOT NULL,
  `f_brand` varchar(25) NOT NULL,
  `f_color` varchar(25) NOT NULL,
  `found_loc` varchar(25) NOT NULL,
  `admin_id` varchar(25) NOT NULL DEFAULT 'admin1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lostobj`
--

CREATE TABLE `lostobj` (
  `lostobj_id` int(15) NOT NULL,
  `lostobj_name` varchar(25) NOT NULL,
  `lost_date` varchar(25) NOT NULL,
  `l_brand` varchar(25) NOT NULL,
  `l_color` varchar(25) NOT NULL,
  `lost_loc` varchar(25) NOT NULL,
  `status1` varchar(25) NOT NULL,
  `admin_id` varchar(25) NOT NULL DEFAULT 'admin1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lostobj`
--

INSERT INTO `lostobj` (`lostobj_id`, `lostobj_name`, `lost_date`, `l_brand`, `l_color`, `lost_loc`, `status1`, `admin_id`) VALUES
(0, 'pencil', '2020-11-26', 'cello', 'red', 'canteen', '0', 'admin1'),
(1, 'book', '2020-11-28', 'classmate', 'blue', 'cse-b', '0', 'admin1'),
(2, 'pen', '2020-11-28', 'reynolds', 'white', 'cse-b', '0', 'admin1'),
(3, 'eraser', '2020-11-28', 'camalin', 'white', 'cse-b', '0', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` varchar(15) NOT NULL,
  `f_name` varchar(25) NOT NULL,
  `l_name` varchar(25) NOT NULL,
  `pass_word` varchar(25) NOT NULL,
  `notification` varchar(100) NOT NULL,
  `admin_id` varchar(15) NOT NULL DEFAULT 'admin1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `f_name`, `l_name`, `pass_word`, `notification`, `admin_id`) VALUES
('armin123', 'armin', 'arlert', '12345', '', 'admin1'),
('eren123', 'eren', 'jaegar', '12345', '', 'admin1'),
('erwin123', 'erwin', 'smith', '12345', '', 'admin1'),
('levi123', 'levi', 'ackerman', '12345', '', 'admin1'),
('ligh123', 'yagami', 'light', '12345', '', 'admin1'),
('mikasa123', 'mikasa', 'ackerman', '12345', '', 'admin1'),
('pd123', 'pd', '123', '12345', 'object not found yet', 'admin1'),
('pd@123', 'pd', '', '12345', 'object not found yet', 'admin1');

-- --------------------------------------------------------

--
-- Table structure for table `user_foundobj`
--

CREATE TABLE `user_foundobj` (
  `userid` varchar(15) NOT NULL,
  `foundobj_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_foundobj`
--

INSERT INTO `user_foundobj` (`userid`, `foundobj_id`) VALUES
('eren123', 15),
('eren123', 17),
('pd@123', 16);

-- --------------------------------------------------------

--
-- Table structure for table `user_lostobj`
--

CREATE TABLE `user_lostobj` (
  `userid` varchar(15) NOT NULL,
  `lostobj_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_lostobj`
--

INSERT INTO `user_lostobj` (`userid`, `lostobj_id`) VALUES
('eren123', 0),
('eren123', 2),
('eren123', 3),
('pd123', 1),
('pd123', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_ph`
--

CREATE TABLE `user_ph` (
  `userid` varchar(15) NOT NULL,
  `Phno` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_ph`
--

INSERT INTO `user_ph` (`userid`, `Phno`) VALUES
('armin123', 123456),
('eren123', 123456789),
('erwin123', 654321),
('levi123', 1234567891),
('ligh123', 753951),
('mikasa123', 1234567);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `admin_ph`
--
ALTER TABLE `admin_ph`
  ADD PRIMARY KEY (`admin_id`,`admin_phno`);

--
-- Indexes for table `foundobj`
--
ALTER TABLE `foundobj`
  ADD PRIMARY KEY (`foundobj_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `lostobj`
--
ALTER TABLE `lostobj`
  ADD PRIMARY KEY (`lostobj_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `user_foundobj`
--
ALTER TABLE `user_foundobj`
  ADD PRIMARY KEY (`userid`,`foundobj_id`);

--
-- Indexes for table `user_lostobj`
--
ALTER TABLE `user_lostobj`
  ADD PRIMARY KEY (`userid`,`lostobj_id`);

--
-- Indexes for table `user_ph`
--
ALTER TABLE `user_ph`
  ADD PRIMARY KEY (`userid`,`Phno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
