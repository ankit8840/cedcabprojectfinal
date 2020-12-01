-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2020 at 09:08 AM
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
  `loc_distance` varchar(50) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`loc_id`, `loc_name`, `loc_distance`, `is_available`) VALUES
(1, 'charbagh', '0', 1),
(2, 'Indira nagar', '10', 1),
(3, 'BBD', '30', 1),
(4, 'Barabanki ', '60', 1),
(9, 'Faizabad', '100', 1),
(10, 'Basti', '150', 1),
(11, 'Gorakhpur', '210', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ride`
--

CREATE TABLE `tbl_ride` (
  `ride_id` int(50) NOT NULL,
  `ride_date` date NOT NULL DEFAULT current_timestamp(),
  `pickup` varchar(50) NOT NULL,
  `droploc` varchar(50) NOT NULL,
  `total_distance` varchar(50) NOT NULL,
  `luggage` varchar(50) NOT NULL,
  `total_fare` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  `customer_user_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_ride`
--

INSERT INTO `tbl_ride` (`ride_id`, `ride_date`, `pickup`, `droploc`, `total_distance`, `luggage`, `total_fare`, `status`, `customer_user_id`) VALUES
(1, '2020-11-26', 'charbagh', 'BBD', '30', '', '425', 2, 1),
(2, '2020-11-26', 'Indira nagar', 'Faizabad', '90', '100', '1621', 2, 6),
(3, '2020-11-27', 'charbagh', 'Faizabad', '100', '50', '1593', 2, 8),
(4, '2020-11-28', 'charbagh', 'Gorakhpur', '110', '200', '2310', 2, 8),
(5, '2020-11-28', 'charbagh', 'Gorakhpur', '110', '12', '2110', 2, 8),
(6, '2020-11-28', 'charbagh', 'BBD', '30', '', '425', 2, 8),
(7, '2020-11-28', 'charbagh', 'Gorakhpur', '110', '10', '2010', 2, 8),
(8, '2020-11-28', 'charbagh', 'BBD', '30', '10', '605', 2, 8),
(9, '2020-11-28', 'charbagh', 'BBD', '30', '', '425', 2, 8),
(10, '2020-11-28', 'charbagh', 'Gorakhpur', '110', '542', '2310', 2, 8),
(11, '2020-11-28', 'charbagh', 'BBD', '30', '', '425', 2, 8),
(12, '2020-11-28', 'charbagh', 'BBD', '30', '100', '755', 2, 10),
(13, '2020-11-30', 'charbagh', 'Indira nagar', '10', '200', '495', 2, 8),
(14, '2020-11-30', 'charbagh', 'BBD', '30', '10', '605', 2, 8),
(15, '2020-11-30', 'charbagh', 'Indira nagar', '10', '10', '405', 2, 8),
(16, '2020-11-30', 'Indira nagar', 'Faizabad', '90', '10', '1331', 1, 6),
(17, '2020-11-30', 'charbagh', 'BBD', '30', '10', '605', 2, 6),
(18, '2020-11-30', 'charbagh', 'BBD', '30', '10', '605', 2, 6),
(19, '2020-11-30', 'Indira nagar', 'BBD', '20', '20', '525', 1, 6),
(20, '2020-11-30', 'charbagh', 'BBD', '30', '', '425', 1, 1),
(21, '2020-11-30', 'Indira nagar', 'charbagh', '10', '78966789', '555', 2, 6),
(22, '2020-11-30', 'charbagh', 'BBD', '30', '100', '1115', 1, 10),
(23, '2020-11-30', 'charbagh', 'BBD', '30', '10', '605', 1, 10),
(24, '2020-11-30', 'charbagh', 'Indira nagar', '10', '10', '345', 1, 8),
(25, '2020-11-30', 'charbagh', 'BBD', '30', '10', '605', 1, 8),
(26, '2020-11-30', 'charbagh', 'Gorakhpur', '210', '200', '3460', 1, 13),
(27, '2020-12-01', 'charbagh', 'BBD', '30', '', '425', 2, 12),
(28, '2020-12-01', 'charbagh', 'BBD', '30', '', '425', 1, 12),
(29, '2020-12-01', 'charbagh', 'Gorakhpur', '210', '200', '3460', 1, 12),
(30, '2020-12-01', 'charbagh', 'Gorakhpur', '210', '200', '3460', 1, 12),
(31, '2020-12-01', 'Indira nagar', 'Gorakhpur', '200', '', '2145', 1, 12),
(32, '2020-12-01', 'Indira nagar', 'Barabanki', '10', '', '185', 1, 12),
(33, '2020-12-01', 'charbagh', 'Barabanki', '0', '', '50', 1, 12),
(34, '2020-12-01', 'charbagh', 'Barabanki', '0', '', '200', 1, 12);

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
(1, 'ankitdixit@gmail', 'ankit', '2020-11-24 18:36:35.210712', '9044329581', 1, '1234', 'user'),
(2, 'admin123', 'admin', '2020-11-24 18:42:49.499005', '9044329581', 1, '1234', 'admin'),
(10, 'anurakt@123', 'Anurakt', '2020-11-28 17:06:02.828504', '9598656605', 1, '12345', 'user'),
(12, 'abhishek@123', 'Abhishek', '2020-11-30 18:32:58.903824', '9140730465', 1, '1234', 'user'),
(13, 'shirin@123', 'shirin', '2020-11-30 19:56:35.188401', '88401234', 1, '1234', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`loc_id`);

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
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_ride`
--
ALTER TABLE `tbl_ride`
  MODIFY `ride_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
