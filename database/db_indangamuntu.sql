-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 05:26 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_indangamuntu`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appId` int(3) NOT NULL,
  `citizenIc` bigint(12) NOT NULL,
  `scheduleId` int(10) NOT NULL,
  `appSymptom` varchar(100) NOT NULL,
  `appComment` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'process'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appId`, `citizenIc`, `scheduleId`, `appSymptom`, `appComment`, `status`) VALUES
(86, 920517105553, 40, 'Pening Kepala', 'Bila doktor free?', 'done');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `icEmployee` bigint(12) NOT NULL,
  `password` varchar(20) NOT NULL,
  `employeeId` int(3) NOT NULL,
  `employeeFirstName` varchar(50) NOT NULL,
  `employeeLastName` varchar(50) NOT NULL,
  `employeeAddress` varchar(100) NOT NULL,
  `employeePhone` varchar(15) NOT NULL,
  `employeeEmail` varchar(20) NOT NULL,
  `employeeDOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`icEmployee`, `password`, `employeeId`, `employeeFirstName`, `employeeLastName`, `employeeAddress`, `employeePhone`, `employeeEmail`, `employeeDOB`) VALUES
(123456789, '123', 123, 'Employee', 'Sehgal', 'kuala lumpur', '0173567758', 'dsehgal@gmail.com', '1990-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `employeeschedule`
--

CREATE TABLE `employeeschedule` (
  `scheduleId` int(11) NOT NULL,
  `scheduleDate` date NOT NULL,
  `scheduleDay` varchar(15) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `bookAvail` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employeeschedule`
--

INSERT INTO `employeeschedule` (`scheduleId`, `scheduleDate`, `scheduleDay`, `startTime`, `endTime`, `bookAvail`) VALUES
(40, '2015-12-13', 'Sunday', '09:00:00', '10:00:00', 'notavail'),
(41, '2015-12-13', 'Sunday', '10:00:00', '11:00:00', 'available'),
(42, '2015-12-13', 'Sunday', '11:00:00', '12:00:00', 'available'),
(43, '2015-12-14', 'Monday', '11:00:00', '12:00:00', 'available'),
(44, '2015-12-13', 'Sunday', '01:00:00', '02:00:00', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `citizen`
--

CREATE TABLE `citizen` (
  `id` bigint(12) NOT NULL,
  `password` varchar(20) NOT NULL,
  `citizenFirstName` varchar(20) NOT NULL,
  `citizenLastName` varchar(20) NOT NULL,
  `citizenMaritialStatus` varchar(10) NOT NULL,
  `citizenDOB` date NOT NULL,
  `citizenGender` varchar(10) NOT NULL,
  `citizenAddress` varchar(100) NOT NULL,
  `citizenPhone` varchar(15) NOT NULL,
  `citizenEmail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `citizen`
--

INSERT INTO `citizen` (`id`, `password`, `citizenFirstName`, `citizenLastName`, `citizenMaritialStatus`, `citizenDOB`, `citizenGender`, `citizenAddress`, `citizenPhone`, `citizenEmail`) VALUES
(920517105553, '123', 'Mohd', 'Mazlan', 'single', '1992-05-17', 'male', 'NO 153 BLOK MURNI\r\nKOLEJ CANSELOR UNIVERSITI PUTRA MALAYSIA', '173567758', 'lan.psis@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appId`),
  ADD UNIQUE KEY `scheduleId_2` (`scheduleId`),
  ADD KEY `citizenIc` (`citizenIc`),
  ADD KEY `scheduleId` (`scheduleId`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`icEmployee`);

--
-- Indexes for table `employeeschedule`
--
ALTER TABLE `employeeschedule`
  ADD PRIMARY KEY (`scheduleId`);

--
-- Indexes for table `citizen`
--
ALTER TABLE `citizen`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appId` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `employeeschedule`
--
ALTER TABLE `employeeschedule`
  MODIFY `scheduleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_4` FOREIGN KEY (`citizenIc`) REFERENCES `citizen` (`id`),
  ADD CONSTRAINT `appointment_ibfk_5` FOREIGN KEY (`scheduleId`) REFERENCES `employeeschedule` (`scheduleId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
