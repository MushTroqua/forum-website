-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2024 at 04:01 PM
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
-- Database: `forumdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `CommentID` int(11) NOT NULL,
  `PostID` int(11) DEFAULT NULL,
  `Username` varchar(25) DEFAULT NULL,
  `CommentBody` longtext DEFAULT NULL,
  `CommentDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`CommentID`, `PostID`, `Username`, `CommentBody`, `CommentDate`) VALUES
(118310, 568707, 'AnthonyNetSec', 'Yoooo!! Pareee what\'s up!', '2024-05-04'),
(207091, 823156, 'jcoSaturn', 'Hello!!!', '2024-05-04'),
(289484, 823156, 'AnthonyNetSec', 'Hello whats up', '2024-05-04'),
(343730, 823156, 'jcoSaturn', 'What are you doing?', '2024-05-04'),
(416126, 823156, 'jcoSaturn', 'Hi There Anthony', '2024-05-04'),
(930317, 823156, 'AnthonyNetSec', 'jcoSaturn Hello!', '2024-05-04'),
(949271, 823156, 'jcoSaturn', 'Yo what\'s up!', '2024-05-04');

-- --------------------------------------------------------

--
-- Table structure for table `usercredentials`
--

CREATE TABLE `usercredentials` (
  `UserID` int(11) NOT NULL,
  `FirstName` varchar(25) DEFAULT NULL,
  `LastName` varchar(25) DEFAULT NULL,
  `Age` varchar(25) DEFAULT NULL,
  `Email` varchar(25) DEFAULT NULL,
  `Username` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usercredentials`
--

INSERT INTO `usercredentials` (`UserID`, `FirstName`, `LastName`, `Age`, `Email`, `Username`, `Password`) VALUES
(2024336104, 'Lanze Gabrielle', 'Ibanez', '19', 'lanzeibanez@gmail.com', 'lanze', '$2y$10$bJgf/ccF11tlsRPqiY0asOotPFv.K7Gln94s3ysHRODwFfF3GD7DK'),
(2024537559, 'Anjelico', 'Saturnino', '19', 'anjelicosaturnino19@gmail', 'jcoSaturn', '$2y$10$7gS6g7o..0/5uaog0srDqONlMqq.Im50Za8m532rG3u81aqAIgysC'),
(2024756568, 'Jesus Anthony', 'Tolentino', '21', 'tolentinojesusanthony@gma', 'AnthonyNetSec', '$2y$10$5QkeF0.jXsSl1x877mGNEeo8caN9vZ9zH0uztMVXZK93AJn/M9D/m'),
(2024858105, 'Stephen Lance', 'Hao', '19', 'stephenhao@gmail.com', 'stephen', '$2y$10$t70sLYR2ZHip8qUqkkn2ue7viMuBoPcp04TowfFj9OwyY.ZKef9Eu');

-- --------------------------------------------------------

--
-- Table structure for table `userpost`
--

CREATE TABLE `userpost` (
  `PostID` int(11) NOT NULL,
  `Username` varchar(25) DEFAULT NULL,
  `Title` varchar(255) DEFAULT NULL,
  `Body` longtext DEFAULT NULL,
  `Date_Submitted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userpost`
--

INSERT INTO `userpost` (`PostID`, `Username`, `Title`, `Body`, `Date_Submitted`) VALUES
(157634, 'AnthonyNetSec', 'First ever post of this Forum', 'Hi Welcome this is the first ever post of this Forum!', '2024-05-02'),
(568707, 'jcoSaturn', 'This Forum is great!', 'Wow this forum is so great that I want to post alot on here! Kaway kaway sa mga UST Students dyan!', '2024-05-04'),
(823156, 'AnthonyNetSec', 'Second post I LOVE UST', 'HELLO I AM A FRESHMAN', '2024-05-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `PostID` (`PostID`);

--
-- Indexes for table `usercredentials`
--
ALTER TABLE `usercredentials`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `userpost`
--
ALTER TABLE `userpost`
  ADD PRIMARY KEY (`PostID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `userpost` (`PostID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
