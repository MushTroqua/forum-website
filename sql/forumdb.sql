-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 02:10 PM
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
(353756, 876695, 'jcodonuts', 'Sa frassatti po ', '2024-05-16'),
(416126, 823156, 'jcoSaturn', 'Hi There Anthony', '2024-05-04'),
(520625, 568707, NULL, NULL, NULL),
(548479, 568707, 'lanze', 'test', '2024-05-16'),
(870078, 568707, NULL, NULL, NULL),
(930317, 823156, 'AnthonyNetSec', 'jcoSaturn Hello!', '2024-05-04'),
(948369, 440601, 'lanze', 'Hello!', '2024-05-16'),
(949271, 823156, 'jcoSaturn', 'Yo what\'s up!', '2024-05-04'),
(968290, 568707, 'yrichi', 'hello!', '2024-05-16');

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
(2024114648, 'Audi', 'Endraca', '18', 'audiendraca@gmail.com', 'audi', '$2y$10$ohv5BCWIscvWwYsyHaDDueRSaOAnWw4XNHMtmMJyGLT6AETphEWcG'),
(2024336104, 'Lanze Gabrielle', 'Ibanez', '19', 'lanzeibanez@gmail.com', 'lanze', '$2y$10$LYT711hoADboZNR3YqQQtuIunqrmVnlQesI4z.Jv3j2KxLVvyArAC'),
(2024537559, 'Anjelico', 'Saturnino', '19', 'anjelicosaturnino19@gmail', 'jcoSaturn', '$2y$10$7gS6g7o..0/5uaog0srDqONlMqq.Im50Za8m532rG3u81aqAIgysC'),
(2024743932, 'Angellyne', 'Avenido', '21', 'angellyneavenido@gmail.co', 'yrichi', '$2y$10$uZeKcP2rfIEApawxYpX3e.P/zq9fXhAEdnxs9oLWiurlX8VBeyPc6'),
(2024756568, 'Jesus Anthony', 'Tolentino', '21', 'tolentinojesusanthony@gma', 'AnthonyNetSec', '$2y$10$5QkeF0.jXsSl1x877mGNEeo8caN9vZ9zH0uztMVXZK93AJn/M9D/m'),
(2024858105, 'Stephen Lance', 'Hao', '19', 'stephenhao@gmail.com', 'stephen', '$2y$10$t70sLYR2ZHip8qUqkkn2ue7viMuBoPcp04TowfFj9OwyY.ZKef9Eu'),
(2024955077, 'JCo', 'Saturnino', '6', 'jcosaturnino@gmail.com', 'jcodonuts', '$2y$10$WOoYc5/QtpDGQ9O4./MmZe5bcMqoiueHENIOdnsxQo9rTCEPd5ZEm');

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
(164029, 'lanze', 'Freshie here!', 'Ano ba pwede magawa sa UST?? It&#039;s been two weeks and di pa ako nakakaikot huhuhu. I&#039;m a COS Psych Freshie (hello fellow psych fellows!!!) :&gt;', '2024-05-16'),
(440601, NULL, NULL, NULL, NULL),
(493541, NULL, NULL, NULL, NULL),
(568707, 'jcoSaturn', 'This Forum is great!', 'Wow this forum is so great that I want to post alot on here! Kaway kaway sa mga UST Students dyan!', '2024-05-04'),
(802679, NULL, NULL, NULL, NULL),
(823156, 'AnthonyNetSec', 'Second post I LOVE UST', 'HELLO I AM A FRESHMAN', '2024-05-02'),
(848093, NULL, NULL, NULL, NULL),
(861974, NULL, NULL, NULL, NULL),
(876695, 'jcodonuts', 'CICS Freshie!', 'Saan po building naten? Too po ba nasa labas tayo ng campus??', '2024-05-16'),
(950953, 'yrichi', 'ABSC, Nasaan na kayo?!', 'Ang init init ng panahon, bat walang gumagalaw sa ABSC?? Tapos yung ibang classroom walang aircon, maawa kayo sa mga estudyante!', '2024-05-16'),
(953606, NULL, NULL, NULL, NULL);

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
