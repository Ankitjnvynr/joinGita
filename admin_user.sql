-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2023 at 02:45 AM
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
-- Database: `join-gieo`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(300) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password`, `dt`) VALUES
(1, 'ankitbkana@outlook.c', '$2y$10$5xVG2YCa9vQqKZ1yAUThV.jvtzBCWunYIivGF4XJkCc8htmvP.akS', '2023-11-12 11:00:17'),
(2, 'ankit', '$2y$10$ZI/9A6RPF3hry/MNlM3SGOz5iS3hF1kt9F8tg63MpbtAxa8QC8PVK', '2023-11-12 11:02:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `country` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `whtsapp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `dikshit` varchar(10) NOT NULL,
  `marital_status` varchar(20) NOT NULL,
  `state` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `tehsil` varchar(100) NOT NULL,
  `address` varchar(50) NOT NULL,
  `interest` varchar(50) NOT NULL,
  `occupation` varchar(100) NOT NULL,
  `education` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `aniver_date` date DEFAULT NULL,
  `message` text NOT NULL,
  `pic` text NOT NULL DEFAULT 'defaultusers.png',
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `hash_id`, `country`, `name`, `phone`, `whtsapp`, `email`, `dikshit`, `marital_status`, `state`, `district`, `tehsil`, `address`, `interest`, `occupation`, `education`, `dob`, `aniver_date`, `message`, `pic`, `dt`) VALUES
(1, '', 'India', 'Ankit', '8930840560', '8930840560', 'ankitbkana@outlook.com', 'No', 'Married', 'Yamunanagar', 'Haryana', 'Radaur', 'VPO Bakana', 'जीओ गीता', 'Doctor', 'CA', '2023-11-10', '0000-00-00', '', 'defaultusers.png', '2023-11-10 15:22:18'),
(2, '', 'India', 'Ankit', '8930840561', '8930840560', 'ankitbkana@outlook.com', 'No', 'Married', 'Baddi', 'Himachal Pradesh', 'Radaur', 'VPO Bakana teh radaur dis yamauna nagar', 'विप्रजन समूह', 'Business', 'Graduation', '2023-11-11', '2023-11-11', '', 'defaultusers.png', '2023-11-11 16:54:00'),
(3, '', 'India', 'ankit', '8930840562', '8930840560', 'ankitbkana@gmail.com', 'No', 'Unmarried', 'Garacharma', 'Andaman and Nicobar Islands', 'Radaur', 'VPO Bakana teh radaur dis yamauna nagar', 'महिला समूह', 'Home Maker', '10th Pass', '2023-11-22', '0000-00-00', 'hello this is the message you can write here it may be a sugessign form  ', 'defaultusers.png', '2023-11-11 16:58:35'),
(4, '', 'India', 'Ankit', '8930840563', '8930840563', 'ankitbkana@outlook.com', 'No', 'Unmarried', 'Yamunanagar', 'Haryana', 'rdr', 'shd', 'ग्राम संपर्क समूह', 'Govt. Job, Retired', '12th Pass', '2023-11-24', '0000-00-00', 'ok', 'defaultusers.png', '2023-11-12 11:39:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
