-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2024 at 11:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bamis15`
--

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL COMMENT 'Employee ID',
  `ename` varchar(255) NOT NULL COMMENT 'Employee''s Username',
  `descr` varchar(255) NOT NULL COMMENT 'Leave Reason',
  `fromdate` date NOT NULL,
  `todate` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `eid`, `ename`, `descr`, `fromdate`, `todate`, `status`) VALUES
(1, 2, 'williams', 'Other : Demo Test', '2021-07-01', '2021-07-02', 'Rejected'),
(2, 2, 'williams', 'Sabbatical : Testing after setting up dates', '2021-07-25', '2021-07-27', 'Pending'),
(4, 2, 'williams', 'Vacation : test after setting up interval days', '2021-07-25', '2021-08-04', 'Pending'),
(8, 2, 'williams', 'Casual : going on a vacation', '2021-07-27', '2021-08-03', 'Rejected'),
(9, 10, 'Khaled', 'Congé : I need some space', '2024-06-17', '2024-07-17', 'Pending'),
(10, 10, 'Khaled', 'Congé : Raison..', '2024-06-17', '2024-08-17', 'Accepted');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT 'employee',
  `gender` varchar(150) NOT NULL,
  `matricule` int(11) DEFAULT NULL,
  `domaine` varchar(50) DEFAULT NULL,
  `niveau` varchar(50) DEFAULT NULL,
  `grad` varchar(11) DEFAULT NULL,
  `fonction` varchar(255) DEFAULT NULL,
  `diplome` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `datenaissance` date DEFAULT NULL,
  `dateentree` date DEFAULT NULL,
  `dateretraite` date DEFAULT NULL,
  `agence` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `name`, `password`, `type`, `gender`, `matricule`, `domaine`, `niveau`, `grad`, `fonction`, `diplome`, `age`, `datenaissance`, `dateentree`, `dateretraite`, `agence`) VALUES
(1, 'Administateur', 'Bamis', '$2y$10$7rLSvRVyTQORapkDOqmkhetjF6H9lJHngr4hJMSM2lHObJbW5EQh6', 'admin', 'Female', 23421, 'Info', 'Licence', '12', 'GRH', 'Informatique', 23, '1999-01-01', '2024-06-10', '2024-06-30', 'Ksar'),
(2, 'Will Williams', 'williams', '$2y$10$NjAyZjNlNTlkOTMyMmIyYejMwaXLwOFJCppILaR0.AmyrNlmO0JS2', 'employee', 'Male', 333, 'aa', 'mm', '32', 're', 'comp', 11, '2001-01-01', '2009-01-01', '2070-01-01', 'Tvz'),
(7, 'Mohamed', 'Mohamed', '$2y$10$HwhILTwQOPqi5Kobt23.N.6rtzdtrZHmgYCJe9qReLgaiHMVB9r56', 'employee', 'Male', 222, 'Compta', 'Licence', '333', 'Compt', 'Com', 33, '2001-06-07', '2010-09-09', '2061-06-07', 'Ksar'),
(10, '', 'Khaled', '$2y$10$laEmoXyaSgnExI7NnUk0u.nod2jLsr2pyIBKS3tkrw.saQP5RQZ4q', 'employee', '', 122, 'domain', 'test', '222', 'test', 'test', 22, '2022-02-22', '2022-02-22', '2025-03-22', 'test');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
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
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
