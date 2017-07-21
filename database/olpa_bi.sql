-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2017 at 05:51 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `olpa_bi`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `partylist_id` int(11) DEFAULT NULL,
  `status` varchar(80) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `student_id`, `position_id`, `partylist_id`, `status`, `time`, `date`) VALUES
(1, 1, 18, 8, 'active', '11:32:11', '2017-07-13'),
(2, 2, 3, 8, 'inactive', '19:38:59', '2017-07-13'),
(3, 3, 14, 8, 'active', '20:00:49', '2017-07-13'),
(4, 11, 27, 11, 'inactive', '20:02:53', '2017-07-13'),
(5, 2, 3, 9, 'active', '22:01:32', '2017-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `grade_section`
--

CREATE TABLE `grade_section` (
  `id` int(11) NOT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `section` varchar(255) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_section`
--

INSERT INTO `grade_section` (`id`, `grade`, `section`, `time`, `date`) VALUES
(2, 'Grade 7', 'John', '14:13:52', '2017-06-17'),
(3, 'Grade 8', 'Anthony', '18:35:52', '2017-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `partylist`
--

CREATE TABLE `partylist` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partylist`
--

INSERT INTO `partylist` (`id`, `name`, `time`, `date`) VALUES
(1, 'asdasd', NULL, NULL),
(8, 'asdasd', '23:43:37', '2017-06-14'),
(9, 'darken', '16:39:50', '2017-06-22'),
(10, 'saded', '16:39:54', '2017-06-22'),
(11, 'sadness', '16:48:46', '2017-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `name`) VALUES
(3, 'President'),
(14, 'asdasd'),
(15, 'asdasd'),
(16, 'asd'),
(17, 'ds'),
(18, 'asdasdasd'),
(19, 'asdasd'),
(20, 'asdasd'),
(21, 'darken'),
(22, 'asdasd'),
(23, 'asdasd'),
(24, 'asdasd'),
(25, 'asdasd'),
(26, 'asdasd'),
(27, 'kwarta ka?'),
(28, 'wla gd'),
(29, 'dareeee'),
(30, 'ewqeqwe'),
(31, 'eee'),
(32, 'dd'),
(33, 'asdasd'),
(34, 'darken'),
(35, 'darken'),
(36, 'darken'),
(37, 'dd'),
(38, 'dd'),
(39, 'dd'),
(40, 'ddr'),
(41, 'darkenwqe'),
(42, 'asdasdddd'),
(43, 'pindar'),
(44, 'darken123'),
(45, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ssg`
--

CREATE TABLE `ssg` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `time` time DEFAULT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ssg`
--

INSERT INTO `ssg` (`id`, `title`, `start_time`, `start_date`, `end_time`, `end_date`, `time`, `date`) VALUES
(1, 'asdewqe', '02:00:00', '2017-07-13', '04:00:01', '2017-07-15', '00:00:12', '2017-07-11'),
(2, 'aaaa', '00:33:00', '2017-07-14', '12:31:00', '2017-07-22', '22:50:30', '2017-07-12');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `middlename` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` varchar(80) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `grade_section_id` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `status` varchar(80) DEFAULT NULL,
  `remarks` varchar(80) DEFAULT NULL,
  `time_added` time DEFAULT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_id`, `firstname`, `middlename`, `lastname`, `email`, `gender`, `dob`, `mobile`, `grade_section_id`, `password`, `status`, `remarks`, `time_added`, `date_added`) VALUES
(1, 123, 'qwe', 'qwe', 'qwe', 'qwe@gmail.com', 'male', '2017-06-08', '123', 2, 'qwe', 'Active', 'Not Voted', NULL, NULL),
(2, 1321083, 'darken', 'dasd', 'sad', 'asd@gmail.com', 'male', '2017-06-05', '5454', 2, 'darken', 'Active', 'Not Voted', NULL, NULL),
(3, 123123, 'qwe', 'qwe', 'qwe', 'qwe', 'male', '2017-06-08', 'qwe', 3, 'qwe', 'Active', 'Not Voted', NULL, NULL),
(4, 123123, 'asd', 'asd', 'asd', 'asd', 'female', '2017-06-24', 'asd', 2, 'asd', 'Active', 'Not Voted', NULL, NULL),
(5, 1234, '123', '123', '123', '123', 'male', '2017-06-13', '123', 2, '123', 'Active', 'Not Voted', NULL, NULL),
(6, 12344, '123', '123qwe', 'qwe', 'qwe@gmail.com', 'male', '2017-06-15', '123131', 3, 'qwe', 'Active', 'Not Voted', NULL, NULL),
(7, 123123123, 'asd', 'asd', 'asd', 'sad', 'male', '2017-06-21', 'asd', 3, 'asd', 'Active', 'Not Voted', NULL, NULL),
(8, 1231233, '123', '123', '123', '123123', 'male', '2017-06-21', '123', 3, '123', 'Active', 'Not Voted', NULL, NULL),
(9, 23123231, 'asd', 'asd', 'asd', 'asd@gmail.com', 'male', '2017-06-23', 'asd', 3, 'asd', 'Active', 'Not Voted', NULL, NULL),
(10, 13210833, 'Pindar', 'Caluyo', 'Jimenez', 'pindarjimenez@gmail.com', 'male', '2017-06-14', '09089756216', 3, '123', 'Active', 'Not Voted', NULL, NULL),
(11, 23123231, 'asd', 'asd', 'asd', 'asd@gmail.com', 'male', '2017-06-23', 'asd', 3, 'asd', 'Active', 'Not Voted', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_section`
--
ALTER TABLE `grade_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partylist`
--
ALTER TABLE `partylist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ssg`
--
ALTER TABLE `ssg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `grade_section`
--
ALTER TABLE `grade_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `partylist`
--
ALTER TABLE `partylist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `ssg`
--
ALTER TABLE `ssg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
