-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2023 at 02:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sm3101`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `ID` int(11) NOT NULL,
  `CONTACT` varchar(50) DEFAULT NULL,
  `SYMPTOM` varchar(50) DEFAULT NULL,
  `PRESCRIPTION` varchar(255) DEFAULT NULL,
  `DATE` date NOT NULL,
  `empid` int(11) DEFAULT NULL,
  `studid` int(11) DEFAULT NULL,
  `incharge_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`ID`, `CONTACT`, `SYMPTOM`, `PRESCRIPTION`, `DATE`, `empid`, `studid`, `incharge_id`) VALUES
(1, '0912432452', 'Fever', 'Biogesic', '2023-11-01', 0, 1, 11),
(2, '09912345123', 'Asthma', 'Consult Specialist', '2023-11-02', 0, 2, 11),
(3, '09912345123', 'Flu', 'Biogesic', '2023-11-03', 0, 3, 11),
(4, '09084124433', 'Headache', 'Biogesic', '2023-11-04', 1, 0, 11),
(5, '0912432452', 'Sore Eyes', 'Go Home', '2023-11-05', 2, 0, 11),
(6, '09084124433', 'Flu', 'Bioflu', '2023-11-06', 3, 0, 12),
(7, '0908087709', 'Rashes', 'Ointment', '2023-11-07', 0, 4, 12),
(8, '09084124433', 'Flu', 'Biogesic', '2023-11-08', 0, 5, 12),
(9, '09080877091', 'Migrane', 'Rest', '2023-11-09', 0, 6, 12),
(10, '09084124433', 'Headache', 'Biogesic', '2023-11-10', 4, 0, 12),
(11, '09922925447', 'Heache', 'Biogesic', '2023-11-11', 5, 0, 13),
(12, '09579342821', 'Puyat', 'Rest ', '2023-11-12', 6, 0, 13),
(13, '09876546784', 'Fever', 'Bioflu', '2023-11-13', 0, 7, 13),
(14, '09648392719', 'Heache', 'Biogesic', '2023-11-14', 0, 8, 13),
(15, '09922925447', 'TLC', 'Sleep ', '2023-11-15', 0, 9, 13),
(16, '09579342821', 'Migrane', 'Sleep ', '2023-11-16', 7, 0, 14),
(17, '09579342821', 'Sleep-deprived', 'Sleep ', '2023-11-17', 8, 0, 14),
(18, '09876545632', 'TLC', 'Rest', '2023-11-18', 9, 0, 14),
(19, '09579342821', 'Nose bleed', 'Rest ', '2023-11-19', 0, 10, 14),
(20, '09922925440', 'TLC', 'Sleeping', '2023-11-20', 10, 0, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbempinfo`
--

CREATE TABLE `tbempinfo` (
  `empid` int(11) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `department` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbempinfo`
--

INSERT INTO `tbempinfo` (`empid`, `lastname`, `firstname`, `department`) VALUES
(1, 'aguila', 'nina', 'cics'),
(2, 'Reyes', 'Christopher', 'cics'),
(3, 'Sulit', 'Richelle', 'cics'),
(4, 'Suarez', 'Aileen', 'cics'),
(5, 'Caibigan', 'Ritchie', 'cics'),
(6, 'Sambitan', 'Krystel', 'cics'),
(7, 'Labiaga', 'Elenor', 'cics'),
(8, 'Libunao', 'Angelene', 'cics'),
(9, 'Bayyou', 'Demeke', 'cics'),
(10, 'Tumbaga', 'Jennelyn', 'cics'),
(11, 'Pratts', 'Dr. Camille', 'cics'),
(12, 'Guismundo', 'Dr. Marielle', 'cics'),
(13, 'Corpuz', 'Dr. Francisco', 'cics'),
(14, 'Balita', 'Dr. Eric', 'cics');

-- --------------------------------------------------------

--
-- Table structure for table `tbincharge`
--

CREATE TABLE `tbincharge` (
  `incharge_id` int(11) NOT NULL,
  `empid` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbincharge`
--

INSERT INTO `tbincharge` (`incharge_id`, `empid`) VALUES
(11, 11),
(12, 12),
(13, 13),
(14, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbstudinfo`
--

CREATE TABLE `tbstudinfo` (
  `studid` int(11) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `course` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbstudinfo`
--

INSERT INTO `tbstudinfo` (`studid`, `lastname`, `firstname`, `course`) VALUES
(1, 'parker', 'peter', 'bsit'),
(2, 'Tipan', 'Savior ', 'bsit'),
(3, 'Tenoso', 'Chrizelle', 'bsit'),
(4, 'Macalintal', 'Kyla', 'bsit'),
(5, 'Magpantay', 'Angelo', 'bsit'),
(6, 'Manalo', 'Ryan', 'bsit'),
(7, 'Encarnado', 'Mel', 'bsit'),
(8, 'Venerable', 'Mike', 'bsit'),
(9, 'Orense', 'Jon', 'bsit'),
(10, 'Torres', 'Michael', 'bsit');

-- --------------------------------------------------------

--
-- Table structure for table `tbusers`
--

CREATE TABLE `tbusers` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `incharge_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbusers`
--

INSERT INTO `tbusers` (`id`, `username`, `password`, `incharge_id`) VALUES
(1, 'camille', '123', 11),
(2, 'marie', '345', 12),
(3, 'fran', '222', 13),
(4, 'eric', '6678', 14);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `empid` (`empid`),
  ADD KEY `studid` (`studid`),
  ADD KEY `incharge_id` (`incharge_id`);

--
-- Indexes for table `tbempinfo`
--
ALTER TABLE `tbempinfo`
  ADD PRIMARY KEY (`empid`);

--
-- Indexes for table `tbincharge`
--
ALTER TABLE `tbincharge`
  ADD PRIMARY KEY (`incharge_id`),
  ADD KEY `empid` (`empid`);

--
-- Indexes for table `tbstudinfo`
--
ALTER TABLE `tbstudinfo`
  ADD PRIMARY KEY (`studid`);

--
-- Indexes for table `tbusers`
--
ALTER TABLE `tbusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incharge_id` (`incharge_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbempinfo`
--
ALTER TABLE `tbempinfo`
  MODIFY `empid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbincharge`
--
ALTER TABLE `tbincharge`
  MODIFY `incharge_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbstudinfo`
--
ALTER TABLE `tbstudinfo`
  MODIFY `studid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbusers`
--
ALTER TABLE `tbusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
