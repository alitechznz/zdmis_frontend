-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2025 at 05:01 AM
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
-- Database: `disaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `departmentName` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `institutionId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `districtName` varchar(255) NOT NULL,
  `regionId` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(11) NOT NULL,
  `divisionName` varchar(255) NOT NULL,
  `type` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `departmentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `location` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `latitude` decimal(10,7) NOT NULL,
  `longitude` decimal(10,7) NOT NULL,
  `reportedById` int(11) NOT NULL,
  `incidentTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incident_types`
--

CREATE TABLE `incident_types` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `createdBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `institutes`
--

CREATE TABLE `institutes` (
  `id` int(11) NOT NULL,
  `instituteName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `shortName` varchar(50) NOT NULL,
  `ministryId` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media_attachments`
--

CREATE TABLE `media_attachments` (
  `id` int(11) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `mediaType` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `incidentId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ministries`
--

CREATE TABLE `ministries` (
  `id` int(11) NOT NULL,
  `ministryName` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `voteNumber` varchar(50) NOT NULL,
  `shortName` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `incidentId` int(11) NOT NULL,
  `stakeholderId` int(11) NOT NULL,
  `notificationType` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL,
  `regionName` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(14) NOT NULL,
  `roleName` varchar(1000) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'false',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shehias`
--

CREATE TABLE `shehias` (
  `id` int(11) NOT NULL,
  `shehiaName` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `districtId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `subscription_type` enum('phone','email') NOT NULL,
  `status` enum('active','inactive') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `organizationId` int(11) NOT NULL,
  `isPrivate` tinyint(1) NOT NULL,
  `roleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weather_alerts`
--

CREATE TABLE `weather_alerts` (
  `id` int(11) NOT NULL,
  `alertType` varchar(50) NOT NULL,
  `severity` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `weatherDataId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weather_data`
--

CREATE TABLE `weather_data` (
  `id` int(11) NOT NULL,
  `dataType` varchar(50) NOT NULL,
  `value` float NOT NULL,
  `unit` varchar(10) NOT NULL,
  `sourceId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weather_notifications`
--

CREATE TABLE `weather_notifications` (
  `id` int(11) NOT NULL,
  `notificationMethod` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `weatherAlertId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `weather_sources`
--

CREATE TABLE `weather_sources` (
  `id` int(11) NOT NULL,
  `sourceName` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `sourceType` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `institutionId` (`institutionId`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `regionId` (`regionId`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departmentId` (`departmentId`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reportedById` (`reportedById`),
  ADD KEY `incidentTypeId` (`incidentTypeId`);

--
-- Indexes for table `incident_types`
--
ALTER TABLE `incident_types`
  ADD PRIMARY KEY (`id`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `institutes`
--
ALTER TABLE `institutes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ministryId` (`ministryId`);

--
-- Indexes for table `media_attachments`
--
ALTER TABLE `media_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidentId` (`incidentId`);

--
-- Indexes for table `ministries`
--
ALTER TABLE `ministries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `incidentId` (`incidentId`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shehias`
--
ALTER TABLE `shehias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `districtId` (`districtId`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `roleId` (`roleId`);

--
-- Indexes for table `weather_alerts`
--
ALTER TABLE `weather_alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weatherDataId` (`weatherDataId`);

--
-- Indexes for table `weather_data`
--
ALTER TABLE `weather_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sourceId` (`sourceId`);

--
-- Indexes for table `weather_notifications`
--
ALTER TABLE `weather_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `weatherAlertId` (`weatherAlertId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `weather_sources`
--
ALTER TABLE `weather_sources`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incident_types`
--
ALTER TABLE `incident_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institutes`
--
ALTER TABLE `institutes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media_attachments`
--
ALTER TABLE `media_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ministries`
--
ALTER TABLE `ministries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(14) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shehias`
--
ALTER TABLE `shehias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weather_alerts`
--
ALTER TABLE `weather_alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weather_data`
--
ALTER TABLE `weather_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weather_notifications`
--
ALTER TABLE `weather_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `weather_sources`
--
ALTER TABLE `weather_sources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_ibfk_1` FOREIGN KEY (`institutionId`) REFERENCES `institutes` (`id`);

--
-- Constraints for table `districts`
--
ALTER TABLE `districts`
  ADD CONSTRAINT `districts_ibfk_1` FOREIGN KEY (`regionId`) REFERENCES `regions` (`id`);

--
-- Constraints for table `divisions`
--
ALTER TABLE `divisions`
  ADD CONSTRAINT `divisions_ibfk_1` FOREIGN KEY (`departmentId`) REFERENCES `departments` (`id`);

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`reportedById`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `incidents_ibfk_2` FOREIGN KEY (`incidentTypeId`) REFERENCES `incident_types` (`id`);

--
-- Constraints for table `incident_types`
--
ALTER TABLE `incident_types`
  ADD CONSTRAINT `incident_types_ibfk_1` FOREIGN KEY (`createdBy`) REFERENCES `users` (`id`);

--
-- Constraints for table `institutes`
--
ALTER TABLE `institutes`
  ADD CONSTRAINT `institutes_ibfk_1` FOREIGN KEY (`ministryId`) REFERENCES `ministries` (`id`);

--
-- Constraints for table `media_attachments`
--
ALTER TABLE `media_attachments`
  ADD CONSTRAINT `media_attachments_ibfk_1` FOREIGN KEY (`incidentId`) REFERENCES `incidents` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`incidentId`) REFERENCES `incidents` (`id`);

--
-- Constraints for table `shehias`
--
ALTER TABLE `shehias`
  ADD CONSTRAINT `shehias_ibfk_1` FOREIGN KEY (`districtId`) REFERENCES `districts` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `roles` (`id`);

--
-- Constraints for table `weather_alerts`
--
ALTER TABLE `weather_alerts`
  ADD CONSTRAINT `weather_alerts_ibfk_1` FOREIGN KEY (`weatherDataId`) REFERENCES `weather_data` (`id`);

--
-- Constraints for table `weather_data`
--
ALTER TABLE `weather_data`
  ADD CONSTRAINT `weather_data_ibfk_1` FOREIGN KEY (`sourceId`) REFERENCES `weather_sources` (`id`);

--
-- Constraints for table `weather_notifications`
--
ALTER TABLE `weather_notifications`
  ADD CONSTRAINT `weather_notifications_ibfk_1` FOREIGN KEY (`weatherAlertId`) REFERENCES `weather_alerts` (`id`),
  ADD CONSTRAINT `weather_notifications_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
