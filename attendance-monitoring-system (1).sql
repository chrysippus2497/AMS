-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2021 at 07:56 PM
-- Server version: 10.5.8-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance-monitoring-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_level` varchar(50) NOT NULL,
  `section` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `uid`, `course`, `year_level`, `section`, `date_time`, `time_stamp`) VALUES
(31, '12', 'BSIT', 'Fourth', 'IB', '2021-06-03', '2021-06-03 14:23:54'),
(32, '12', 'BSCE', 'Second', 'IA', '2021-06-03', '2021-06-03 14:50:55'),
(33, '12', 'BSIT', 'Third', 'IC', '2021-06-18', '2021-06-03 15:25:10');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `uid`, `course`, `code`, `date_added`) VALUES
(3, '12', 'BSCE', 'NED 117', '2021-06-02 14:06:14'),
(4, '12', 'BSCS', 'CS 3305', '2021-06-02 13:12:06'),
(5, '12', 'BSIT', 'ITE 101', '2021-06-02 13:12:08'),
(7, '25', 'BSCE', 'CE 335', '2021-06-02 14:09:04');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `uid`, `section`, `description`, `date_added`) VALUES
(1, '12', 'IA', '', '2021-06-03 11:32:07'),
(2, '12', 'IB', '', '2021-06-02 13:09:55'),
(3, '12', 'IC', '', '2021-06-02 13:09:56'),
(11, '25', 'A', '', '2021-06-02 14:09:26');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `course` varchar(50) NOT NULL,
  `year_level` varchar(50) NOT NULL,
  `section` varchar(255) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `uid`, `firstname`, `lastname`, `course`, `year_level`, `section`, `date_added`) VALUES
(1, '12', 'test', 'test', 'BSCE', 'Second', 'IA', '2021-06-02 14:28:14'),
(2, '12', 'rafael', 'aquino', 'BSCE', 'Second', 'IA', '2021-06-02 15:04:14'),
(3, '25', 'pd', 'crisostomo', 'BSCE', 'First', 'A', '2021-06-02 14:11:49'),
(4, '12', 'john', 'dela cruz', 'BSCE', 'First', 'IA', '2021-06-03 14:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance`
--

CREATE TABLE `student_attendance` (
  `id` int(11) NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `course` varchar(255) NOT NULL,
  `year_level` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_attendance`
--

INSERT INTO `student_attendance` (`id`, `created_by`, `firstname`, `lastname`, `course`, `year_level`, `section`, `status`, `date_time`) VALUES
(4, '12', 'test', 'test', 'BSCE', 'Second', 'IA', '', '2021-06-03'),
(5, '12', 'test', 'test', 'BSCE', 'Second', 'IA', '', '2021-06-04'),
(7, '12', 'test', 'test', 'BSCE', 'Second', 'IA', '', '2021-06-03'),
(8, '12', '', '', '', '', '', '', '2021-06-18');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `password`) VALUES
(12, 'Rafael', 'Aquino', 'admin', '$2y$10$zG7NG7Gk01Trrb1k9u1Rq.OTrvHswSMSmkGfiTSh17wPqH7qoznAW'),
(25, 'testname', 'testlname', 'testuname', '$2y$10$zG7NG7Gk01Trrb1k9u1Rq.OTrvHswSMSmkGfiTSh17wPqH7qoznAW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_attendance`
--
ALTER TABLE `student_attendance`
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
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_attendance`
--
ALTER TABLE `student_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
