-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2022 at 12:30 AM
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
(8, 'GLADYS NYAMBURA', 'THUO', '19257596210', 'gicehajunior76@gmail.com', 'Google Africa KE', 'gladyskarani@att.net', '', 4, NULL, NULL),
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
  `PocFirstName` varchar(50) NOT NULL,
  `PocLastName` varchar(50) NOT NULL,
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

INSERT INTO `events` (`id`, `eventName`, `eventType`, `eventCategory`, `noOfParticipants`, `maximumTickets`, `ticket_charges`, `eventVenue`, `EventVenueAddress`, `dateOfEvent`, `endOfEventDate`, `PocFirstName`, `PocLastName`, `primaryContactNumber`, `secondaryContactNumber`, `personalContactEmail`, `organizationName`, `organizationContactEmail`, `themeOfEvent`, `additionalEventCaption`, `created_at`, `updated_at`) VALUES
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
(2, 'HDB111-C007-026/2018', '2022-12-05 01:15:45', '2022-12-05 01:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `ticketId` varchar(20) NOT NULL,
  `client_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `MaximumTickets` int(11) NOT NULL,
  `ticketCharges` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `ticketId`, `client_id`, `event_id`, `MaximumTickets`, `ticketCharges`, `payment_method`, `created_at`, `updated_at`) VALUES
(3, 'TID638D0F64C48B1', 8, 7, 652, 130400, 'Master Card', NULL, NULL),
(4, 'TID638D0FAA2DBC1', 9, 7, 8, 1600, 'Cash', NULL, NULL),
(5, 'TID638D194C8C7E6', 8, 7, 652, 130400, 'Paypal', NULL, NULL),
(6, 'TID638D1BA17D89D', 8, 7, 200, 40000, 'Cheque', NULL, NULL);

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
(16, 1, 'HDB111-C007-026/2018', 'Raja', 'rajtest784@gmail.com', '+12163148131', '$2y$10$GcYtvhsFthwv4G7vUVaQXumsWzFe2NNocMV5UM2ChuQPFQajZKRGi', '2022-12-05 02:04:34', '2022-12-05 02:04:34');

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
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
