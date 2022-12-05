-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2022 at 11:10 PM
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
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `contact_phone` varchar(16) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `organization_name` varchar(100) DEFAULT NULL,
  `organization_email_address` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `authentication_mode` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `contact_phone`, `contact_email`, `organization_name`, `organization_email_address`, `address`, `authentication_mode`, `created_at`, `updated_at`) VALUES
(4, 'PETER MACHARIA', 'MWANGI', '1707980056', 'e.njuguna@homail.com', 'Google Africa', 'e.njuguna@homail.com', '', 1, NULL, NULL),
(8, 'GLADYS NYAMBURA', 'THUO', '19257596210', 'gladyskarani@att.net', 'Google Africa KE', 'gladyskarani@att.net', '', 4, NULL, NULL),
(9, 'LILLIAN', 'Njeri', ' 254719462331', 'lillianmwangi254@gmail.com', 'JKUAT NAIROBI', 'gladyskarani@att.net', '', 1, NULL, NULL);

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
  `maximumTickets` int(11) DEFAULT NULL,
  `ticket_charges` int(11) NOT NULL,
  `eventVenue` varchar(255) NOT NULL,
  `EventVenueAddress` varchar(255) NOT NULL,
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

INSERT INTO `events` (`id`, `eventName`, `eventType`, `eventCategory`, `noOfParticipants`, `maximumTickets`, `ticket_charges`, `eventVenue`, `EventVenueAddress`, `dateOfEvent`, `endOfEventDate`, `firstName`, `lastName`, `primaryContactNumber`, `secondaryContactNumber`, `personalContactEmail`, `organizationName`, `organizationContactEmail`, `themeOfEvent`, `additionalEventCaption`, `created_at`, `updated_at`) VALUES
(1, 'DEVFEST', '', '', 0, NULL, 0, 'MKU', '', '2022-10-23T06:53', '2022-10-23T20:50', 'BERNARD KUNGU', 'WANGANGA', '0719462331', '', 'gicehajunior76@gmail.com', '', '', 'themed', '', NULL, NULL),
(2, 'DevFest 2022', 'Meetup', 'Developers Meetup', 0, NULL, 0, 'KU', '', '2022-11-05T08:00', '2022-11-06T17:00', 'BERNARD KUNGU', 'WANGANGA', '0719462331', '', 'gicehajunior76@gmail.com', '', 'gicehajunior76@gmail.com', 'Developers meetup', '', NULL, NULL),
(3, 'DEVELOPERS FESTIVALS', 'Dev`s', 'Festival', 0, NULL, 0, 'UON', '', '2022-11-05T08:00', '2022-11-05T14:24', 'BERNARD KUNGU', 'WANGANGA', '0719462331', '', 'gicehajunior76@gmail.com', '', '', 'Developers Festivals', '', NULL, NULL),
(4, 'School Debate project', 'Debate', 'Education', 50, 50, 0, 'MMU', '', '2022-11-25T11:15', '2022-11-25T11:16', 'BERNARD KUNGU', 'WANGANGA', '0719462331', '', 'gicehajunior76@gmail.com', 'JKUAT', 'bernard.kungu@slu.edu', 'Education debate', '', NULL, NULL),
(5, 'TEST EVENT', 'TEST TYPE', 'TEST', 1500, 1600, 200, 'DeKUT', '', '2022-11-23T13:36', '2022-11-26T13:36', 'BERNARD KUNGU', 'WANGANGA', '0719462331', '', 'gicehajunior76@gmail.com', 'TEST ORG', 'test76@gmail.com', 'Test Event is  place to be.', '', NULL, NULL),
(6, 'TEST EVENT 2', 'TEST TYPE 2', 'TEST CATEGORY', 1600, 1600, 500, 'Strathmore', '', '2022-11-25T13:39', '2022-11-28T13:39', 'BERNARD KUNGU', 'WANGANGA', '0719462331', '', 'gicehajunior76@gmail.com', 'TEST ORG 2', '', 'test application ', '', NULL, NULL),
(7, 'DEVFEST 2023', 'Meetup', 'meetup', 10000, 10000, 200, 'USIU', 'NAIROBI 1069, Thika Road', '2023-01-04T14:04', '2023-01-07T14:04', 'BERNARD', 'KUNGU', ' 254719462331', '', 'gicehajunior76@gmail.com', 'Google', 'gicehajunior76@gmail.com', 'Google meetup and learn', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `job_reg_numbers` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `job_reg_numbers`, `created_at`, `updated_at`) VALUES
(1, 'HDB112-C007-00128/2018', '2022-11-13 21:06:12', '2022-11-13 21:06:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `whoami` int(11) NOT NULL COMMENT '1 => admin,\r\n2 = > client,\r\n3 => taskers',
  `jobRegNo` varchar(80) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(12) DEFAULT NULL,
  `password` longtext NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `whoami`, `jobRegNo`, `username`, `email`, `contact`, `password`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'GicehaJunior', 'gicehajunior76@gmail.com', '719462331', '$2y$10$tD71uxdekGQ1TiNTyDsNlutBRMmrrLx148226dm1k0swdIgKGOIa.', '2022-03-15 22:43:59', '2022-03-15 22:43:59'),
(2, 2, NULL, 'Laban', 'labankiarie96@gmail.com', '722336262', '$2y$10$XIHTBPsQi8P50o6sUlAaHeYn9Bw9E/3kMGh/bDRgkP.lNDG3AO.wO', '2022-05-28 21:51:31', '2022-05-28 21:51:31'),
(3, 3, NULL, 'skmaina', 'skmaina2003@gmail.com', '719462331', '$2y$10$.xA.F0PhLH116iXuyvlYOOlp5r4Xwb4n1x0xfLZuJMpS5KJHIEnWi', '2022-05-28 22:16:38', '2022-05-28 22:16:38'),
(4, 2, NULL, 'lillian', 'lillianmwangi254@gmail.com', '2147483647', '$2y$10$OMK763rh2HYdctPm9WnsAuuYMiVrZ3evlGUnpQBJjSBQSEVoeS66q', '2022-05-28 22:18:05', '2022-05-28 22:18:05'),
(5, 4, NULL, 'SLU', 'bernard.kungu@slu.edu', '719462331', '$2y$10$aESH3utdZKvsPtqnDDqKcOt3dcijYrwg.rHzbH3J9oIZ4Oy/Ek8rK', '2022-05-29 18:15:07', '2022-05-29 18:15:07'),
(6, 2, NULL, 'erick', 'erickngugi07@gmail.com', '714180744', '$2y$10$24JCF02TMO6R5hGzepYDKeFthWm7FdcstsB7kwX7XCWuIl4iak2iu', '2022-05-29 18:37:04', '2022-05-29 18:37:04'),
(7, 2, NULL, 'dan', 'dancan455@gmail.com', '2147483647', '$2y$10$eZXSisqcCVZ.yKZ45dEQge5ruSMNoJuheo7AWL1okhBx5Z1PpdgMa', '2022-05-31 16:51:48', '2022-05-31 16:51:48'),
(8, 0, NULL, 'GicehaJunior76', 'gicehajnr70@gmail.com', '2147483647', '$2y$10$9/c03biB3TSP95knYQ6tguOwTMSrtNKbOie0LHJ5vccw2seRrIiiS', '2022-06-18 20:47:54', '2022-06-18 20:47:54'),
(10, 3, NULL, 'gicehajunior76@gmail.com', 'milkakaranja63@gmail.com', '719462331', '$2y$10$GBp2wxm166qmKm2wlxRpYuwc9TxCqv6n5YqGbXWv061DBd7FBTC8q', '2022-11-12 18:54:37', '2022-11-12 18:54:37'),
(11, 3, NULL, 'EJ', 'e.njuguna@homail.com', '719462331', '$2y$10$0u38nm.aJFSdQED0XXcd3uSyGdN3fFdWTGP9GZ2DsImP1KTsY6VXG', '2022-11-12 18:58:04', '2022-11-12 18:58:04'),
(12, 3, NULL, 'GicehaJunior', 'srmargaretn@gmail.com', '719462331', '$2y$10$6PlgJPTwOrN.yI/HUxwileoa8NPHT2D36b43dwtNiZpWzY8IGTLCe', '2022-11-12 19:03:30', '2022-11-12 19:03:30'),
(13, 0, 'HDB112-C007-00128/2018', 'gjunior', 'bernard.kungu.jkuat@slu.edu', '719462331', '$2y$10$szmyljo.vvs3hihIm5uxJOasUW8IqqIFUmu1tfz9f2vGWfVh.zdqi', '2022-11-13 21:15:48', '2022-11-13 21:15:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
