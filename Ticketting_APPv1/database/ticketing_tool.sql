-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2022 at 08:27 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ticketing_tool`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `eventName` varchar(50) NOT NULL,
  `eventType` varchar(20) NOT NULL,
  `eventCategory` varchar(255) NOT NULL,
  `noOfParticipants` int(11) NOT NULL,
  `dateOfEvent` varchar(20) NOT NULL,
  `endOfEventDate` varchar(20) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `primaryContactNumber` varchar(13) NOT NULL,
  `secondaryContactNumber` varchar(13) NOT NULL,
  `personalContactEmail` varchar(100) NOT NULL,
  `organizationName` varchar(255) NOT NULL,
  `organizationContactEmail` varchar(100) NOT NULL,
  `themeOfEvent` varchar(255) NOT NULL,
  `additionalEventCaption` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `eventName`, `eventType`, `eventCategory`, `noOfParticipants`, `dateOfEvent`, `endOfEventDate`, `firstName`, `lastName`, `primaryContactNumber`, `secondaryContactNumber`, `personalContactEmail`, `organizationName`, `organizationContactEmail`, `themeOfEvent`, `additionalEventCaption`, `created_at`, `updated_at`) VALUES
(1, 'DEVFEST', '', '', 0, '2022-10-23T06:53', '2022-10-23T20:50', 'BERNARD KUNGU', 'WANGANGA', '0719462331', '', 'gicehajunior76@gmail.com', '', '', 'themed', '', NULL, NULL),
(2, 'DevFest 2022', 'Meetup', 'Developers Meetup', 0, '2022-11-05T08:00', '2022-11-06T17:00', 'BERNARD KUNGU', 'WANGANGA', '0719462331', '', 'gicehajunior76@gmail.com', '', 'gicehajunior76@gmail.com', 'Developers meetup', '', NULL, NULL),
(3, 'DEVELOPERS FESTIVALS', 'Dev`s', 'Festival', 0, '2022-11-05T08:00', '2022-11-05T14:24', 'BERNARD KUNGU', 'WANGANGA', '0719462331', '', 'gicehajunior76@gmail.com', '', '', 'Developers Festivals', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `whoami` int(11) NOT NULL COMMENT '1 => admin,\r\n2 = > client,\r\n3 => taskers',
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` int(10) DEFAULT NULL,
  `password` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `whoami`, `username`, `email`, `contact`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, 'GicehaJunior', 'gicehajunior76@gmail.com', 719462331, '$2y$10$tD71uxdekGQ1TiNTyDsNlutBRMmrrLx148226dm1k0swdIgKGOIa.', '2022-03-15 22:43:59', '2022-03-15 22:43:59'),
(2, 2, 'Laban', 'labankiarie96@gmail.com', 722336262, '$2y$10$XIHTBPsQi8P50o6sUlAaHeYn9Bw9E/3kMGh/bDRgkP.lNDG3AO.wO', '2022-05-28 21:51:31', '2022-05-28 21:51:31'),
(3, 3, 'skmaina', 'skmaina2003@gmail.com', 719462331, '$2y$10$.xA.F0PhLH116iXuyvlYOOlp5r4Xwb4n1x0xfLZuJMpS5KJHIEnWi', '2022-05-28 22:16:38', '2022-05-28 22:16:38'),
(4, 2, 'lillian', 'lillianmwangi254@gmail.com', 2147483647, '$2y$10$OMK763rh2HYdctPm9WnsAuuYMiVrZ3evlGUnpQBJjSBQSEVoeS66q', '2022-05-28 22:18:05', '2022-05-28 22:18:05'),
(5, 4, 'SLU', 'bernard.kungu@slu.edu', 719462331, '$2y$10$aESH3utdZKvsPtqnDDqKcOt3dcijYrwg.rHzbH3J9oIZ4Oy/Ek8rK', '2022-05-29 18:15:07', '2022-05-29 18:15:07'),
(6, 2, 'erick', 'erickngugi07@gmail.com', 714180744, '$2y$10$24JCF02TMO6R5hGzepYDKeFthWm7FdcstsB7kwX7XCWuIl4iak2iu', '2022-05-29 18:37:04', '2022-05-29 18:37:04'),
(7, 2, 'dan', 'dancan455@gmail.com', 2147483647, '$2y$10$eZXSisqcCVZ.yKZ45dEQge5ruSMNoJuheo7AWL1okhBx5Z1PpdgMa', '2022-05-31 16:51:48', '2022-05-31 16:51:48'),
(8, 0, 'GicehaJunior76', 'gicehajnr70@gmail.com', 2147483647, '$2y$10$9/c03biB3TSP95knYQ6tguOwTMSrtNKbOie0LHJ5vccw2seRrIiiS', '2022-06-18 20:47:54', '2022-06-18 20:47:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
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
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
