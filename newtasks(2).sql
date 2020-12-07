-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 07, 2020 at 02:26 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newtasks`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `loc_id` int(11) NOT NULL,
  `loc_name` varchar(50) NOT NULL,
  `loc_distance` int(50) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`loc_id`, `loc_name`, `loc_distance`, `is_available`) VALUES
(1, 'charbagh', 0, 1),
(2, 'Indira Nagar', 10, 1),
(18, 'Barabanki', 60, 1),
(19, 'Faizabad', 100, 1),
(20, 'Basti', 150, 1),
(21, 'Gorakhpur', 210, 1),
(28, 'BBD', 30, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `ride_id` int(50) NOT NULL,
  `ride_date` datetime NOT NULL DEFAULT current_timestamp(),
  `pickup` varchar(50) NOT NULL,
  `droploc` varchar(50) NOT NULL,
  `cartype` varchar(150) NOT NULL,
  `total_distance` varchar(50) NOT NULL,
  `luggage` varchar(50) NOT NULL DEFAULT '0',
  `total_fare` int(100) NOT NULL,
  `status` int(10) NOT NULL,
  `customer_user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ride`
--

INSERT INTO `tbl_ride` (`ride_id`, `ride_date`, `pickup`, `droploc`, `cartype`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) VALUES
(37, '2020-12-01 00:00:00', 'BBD', 'Gorakhpur', 'Micro', '180', '0', 1975, 2, 1),
(44, '2020-12-02 00:00:00', 'charbagh', 'Gorakhpur', 'Micro', '210', '0', 2230, 2, 1),
(48, '2020-12-02 00:00:00', 'BBD', 'Faizabad', 'Micro', '70', '0', 887, 2, 1),
(85, '2020-12-04 00:00:00', 'Gorakhpur', 'BBD', 'Mini', '180', '256', 3115, 0, 27),
(93, '2020-12-05 00:00:00', 'Barabanki', 'BBD', 'Micro', '30', '123', 1115, 0, 27),
(95, '2020-12-05 00:00:00', 'charbagh', 'BBD', 'Micro', '30', '0', 605, 3, 27),
(96, '2020-12-05 19:22:56', 'Indira Nagar', 'Barabanki', 'Mini', '50', '123', 1015, 2, 27),
(98, '2020-12-07 14:29:19', 'charbagh', 'Barabanki', 'Micro', '60', '0', 785, 1, 27),
(99, '2020-12-07 14:32:49', 'charbagh', 'Barabanki', 'Micro', '60', '0', 785, 0, 27),
(102, '2020-12-07 14:51:31', 'charbagh', 'Barabanki', 'Mini', '60', '0', 995, 2, 27);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(50) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` datetime(6) NOT NULL DEFAULT current_timestamp(6),
  `mobile` varchar(50) NOT NULL,
  `isblock` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(50) NOT NULL,
  `is_admin` varchar(155) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `name`, `date`, `mobile`, `isblock`, `password`, `is_admin`) VALUES
(2, 'admin123', 'admin', '2020-11-24 18:42:49.499005', '9044329581', 1, '1234', 'admin'),
(10, 'anurakt@123', 'Anurakt', '2020-11-28 17:06:02.828504', '9598656605', 1, '12345', 'user'),
(12, 'abhishek@123', 'Abhishek', '2020-11-30 18:32:58.903824', '9140730465', 1, '1234', 'user'),
(18, 'amit123', 'abhishek@123', '2020-12-02 15:43:37.147698', '9140730465', 1, '1234', 'user'),
(26, 'rohit@123', 'rohit', '2020-12-03 15:21:23.792024', '9140522236', 1, '1234', 'user'),
(27, 'ankit123', 'ANKIT', '2020-12-04 09:30:32.429442', '1234567891', 1, '1234', 'user'),
(31, 'sumit123', 'sumit', '2020-12-07 09:36:30.273237', '9140265897', 1, '1234', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`loc_id`),
  ADD UNIQUE KEY `loc_name` (`loc_name`);

--
-- Indexes for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  ADD PRIMARY KEY (`ride_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  MODIFY `ride_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
