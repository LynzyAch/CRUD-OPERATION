-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Feb 21, 2026 at 10:02 AM
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
-- Database: `labtrack_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrowers`
--

CREATE TABLE `borrowers` (
  `BorrowerID` int(11) NOT NULL,
  `Fullname` varchar(100) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `ContactNo` varchar(45) DEFAULT NULL,
  `Course` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

CREATE TABLE `passwordreset` (
  `ResetID` int(11) NOT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `ResetToken` varchar(255) DEFAULT NULL,
  `Expiration` datetime DEFAULT NULL,
  `Issued` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passwordreset`
--

INSERT INTO `passwordreset` (`ResetID`, `AdminID`, `ResetToken`, `Expiration`, `Issued`) VALUES
(1, 1, 'bf7d9ec3d963a4e4ee30e8e8901249285039f462621d12beb175af2071a66291', '2026-02-06 15:04:07', 0),
(2, 1, '96486e7afd7ffb13beb2379807ecdb03026ca6af4c9a64282a221ef9fcb110f6', '2026-02-06 15:07:08', 0),
(3, 1, '9f853713f7cfa4d7ed37fea7b99645eeaceb751c09400b19ac4877c211880f40', '2026-02-06 15:11:25', 0),
(4, 1, '01940649c619d3877f57de71b9fbee9e47fefb67954a984146f1c8d99a613f6c', '2026-02-06 15:12:44', 0),
(5, 1, '0618e09b985bf827fba2b8f3941b1fcfe13f24f111af3bec66312d288d64e72b', '2026-02-06 22:15:26', 1),
(6, 1, 'b5732d5aa2290300a19cbef26e110f3e1bc85512d2ea40b40bca6e313d559c58', '2026-02-06 22:18:06', 0),
(7, 1, 'ec2d3027fe1e144897815c1543352f46a1f2c379fca5dd35781bdc602d3b0a49', '2026-02-06 22:19:24', 0),
(8, 1, '15630aef6b22b7e86ead6f975c14ed940f30a7212e0cae56e5862e31903f6909', '2026-02-07 22:41:23', 1),
(9, 1, 'd7d9d32910eac738ba500d41ea11811f22959a4fdb4b3c58c5b355f4a3ee1134', '2026-02-08 20:24:12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resource`
--

CREATE TABLE `resource` (
  `ResourceID` int(11) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `ItemCategory` varchar(45) DEFAULT NULL,
  `Quantity` int(11) DEFAULT 0,
  `TotalQuantity` int(11) DEFAULT 0,
  `Status` varchar(45) DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `TransactionID` int(11) NOT NULL,
  `BorrowerID` int(11) DEFAULT NULL,
  `ResourceID` int(11) DEFAULT NULL,
  `AdminID` int(11) DEFAULT NULL,
  `DateOut` datetime DEFAULT current_timestamp(),
  `DateReturn` datetime DEFAULT NULL,
  `Status` varchar(45) DEFAULT 'Borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

CREATE TABLE `useraccount` (
  `AdminID` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`AdminID`, `username`, `password_hash`, `email`) VALUES
(1, 'Administrator', '$2y$10$dBcE87qVT..XzVS8FH9de.KDuIU0D4GM/z6lu/bsU3mbR7JSA61fS', 'cics_labtrack@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrowers`
--
ALTER TABLE `borrowers`
  ADD PRIMARY KEY (`BorrowerID`);

--
-- Indexes for table `passwordreset`
--
ALTER TABLE `passwordreset`
  ADD PRIMARY KEY (`ResetID`);

--
-- Indexes for table `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`ResourceID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`TransactionID`),
  ADD KEY `BorrowerID_idx` (`BorrowerID`),
  ADD KEY `ResourceID_idx` (`ResourceID`),
  ADD KEY `AdminID_idx` (`AdminID`);

--
-- Indexes for table `useraccount`
--
ALTER TABLE `useraccount`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrowers`
--
ALTER TABLE `borrowers`
  MODIFY `BorrowerID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `passwordreset`
--
ALTER TABLE `passwordreset`
  MODIFY `ResetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `resource`
--
ALTER TABLE `resource`
  MODIFY `ResourceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `TransactionID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `useraccount`
--
ALTER TABLE `useraccount`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `fk_Admin` FOREIGN KEY (`AdminID`) REFERENCES `useraccount` (`AdminID`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Borrower` FOREIGN KEY (`BorrowerID`) REFERENCES `borrowers` (`BorrowerID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Resource` FOREIGN KEY (`ResourceID`) REFERENCES `resource` (`ResourceID`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
