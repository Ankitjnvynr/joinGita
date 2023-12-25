-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2023 at 12:31 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

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
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `dt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password`, `dt`) VALUES
(1, 'ankit', '$2y$10$T/TRXRBzWpoaAnFdQwh7VeePwVsCsFjziduV84dlSLNZtR8NDgUae', '2023-11-13 12:03:56');

-- --------------------------------------------------------

--
-- Table structure for table `masik_parvas`
--

CREATE TABLE `masik_parvas` (
  `id` int(10) UNSIGNED NOT NULL,
  `pic` text NOT NULL,
  `stat` varchar(50) DEFAULT '0',
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `hash_id` varchar(300) NOT NULL,
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
  `pic` text NOT NULL DEFAULT 'defaultuser.png',
  `dt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `hash_id`, `country`, `name`, `phone`, `whtsapp`, `email`, `dikshit`, `marital_status`, `state`, `district`, `tehsil`, `address`, `interest`, `occupation`, `education`, `dob`, `aniver_date`, `message`, `pic`, `dt`) VALUES
(2, 'e453aeaad07acfdb5afbd500a763eb1e', 'Australia', 'kamal', '8930840560', '968534', 'ankitbkana@outlook.com', 'No', 'Unmarried', 'ynr', 'hry', 'fg', 'fd', 'समन्वय समूह', 'Farmer', 'Graduation', '0000-00-00', '0000-00-00', '', 'logo.png', '2023-12-25 11:28:43'),
(4, '', 'India', 'PUNEET', '8708042248', '8708042248', 'ankit@gmail.com', 'No', 'Unmarried', 'KKR', 'HRY', 'THANESAR', 'SHANTI NAGAR', 'जीओ गीता', 'Private Job', 'Post Graduation', '1980-12-29', '0000-00-00', 'HI', 'logo.png', '2023-11-01 12:08:32'),
(6, '', '', 'Ankit', '7777777777', '7777777777', 'ankitbkana@outlook.com', 'No', 'Unmarried', '', '', 'rdr', 'vpo bakana', 'जीओ गीता', 'Doctor', 'LLB', '2023-10-12', '0000-00-00', '', 'defaultuser.png', '2023-10-28 06:57:58'),
(15, '', 'in', 'DEEPANSHU YADAV', '9996699409', '9996699409', 'yadavdeepanshu1446@gmail.com', 'No, but in', 'Married', 'Kurukshetra', 'State of Haryana', 'Thanesar', '1613 SECTOR 5 URBAN ESTATE', 'शिक्षा समूह', 'Student', 'CA', '2023-10-19', '0000-00-00', '', 'defaultuser.png', '2023-11-01 11:41:05'),
(19, '', 'in', 'ankit', '8930840561', '7777777777', 'ankitbkana@outlook.com', 'No', 'Unmarried', 'Panipat', 'State of Haryana', 'rdr', 'vpo bakana', 'सोशल मीडिया समूह', 'Govt. Job, Retired', 'Others', '2023-11-28', '0000-00-00', '', 'defaultuser.png', '2023-11-04 06:52:02'),
(20, '53c488af6c8b0a917119e5904ddd4f40', 'India', 'ankit', '8930840562', '8930840562', 'ankit@ankit.com', 'No', 'Unmarried', 'Dera Gopipur', 'Himachal Pradesh', 'dfgds', 'ff', 'मन्दिर सेवा समूह', 'Business', '12th Pass', '2023-11-01', '0000-00-00', '', 'defaultuser.png', '2023-11-13 07:07:26'),
(21, '4f6adfde43587953e9afa33c26cdd0e6', 'India', 'DEEPANSHU YADAV', '9896050480', '9896050480', 'yadavdeepanshu1446@gmail.com', 'Yes', 'Unmarried', 'Bahadurgarh', 'Haryana', 'Thanesar', '1613 SECTOR 5 URBAN ESTATE', 'प्रचार समूह', 'Private Job', 'M.Com', '2023-11-01', '0000-00-00', '', 'defaultuser.png', '2023-11-13 07:07:54'),
(24, '269da44c9951141752c3b9c1d3171a0e', 'Australia', 'DEEPANSHU YADAV', '7988031595', '7988031595', 'yadavdeepanshu1446@gmail.com', 'Yes', 'Unmarried', 'Cherrybrook', 'Cherrybrook', 'Thanesar', '1613 SECTOR 5 URBAN ESTATE', 'महिला समूह', 'Student', 'MBBS', '2023-09-04', '0000-00-00', '', 'defaultuser.png', '2023-11-13 07:09:09'),
(25, '71bad52254def9130106b7d2d8713848', 'New Zealand', 'Deep', '9996699444', '9996699444', 'yadavdeepanshu1446@gmail.com', 'No', 'Unmarried', 'Kaikohe', 'Northland', 'Thanesar', '1613 SECTOR 5 URBAN ESTATE', 'समन्वय समूह', 'Student', 'Post Graduation', '2023-10-31', '0000-00-00', '', 'GIEO GITA EDUCOURSES UPDATED.png', '2023-11-13 07:12:44'),
(27, '4fffd0e22f9b7c2cd51d1f5e583f2827', 'India', 'puneet sharma', '9728231111', '9728231111', 'puneet.kapilash@gmail.com', 'No', 'Unmarried', 'Thanesar', 'Haryana', 'Kurukshetra ', '1168', 'जीओ गीता', 'Private Job', 'Post Graduation', '1981-12-29', '0000-00-00', '', 'defaultuser.png', '2023-11-13 07:30:34'),
(28, '8ec374ccfa36aa9791fb2b60a5c18930', 'india', 'ankit', '8930840567', '8930840567', 'ankit@gmail.com', 'no', 'no', 'hry', 'ynr', 'rdr', 'rdr', 'no', 'business', '12th ', '0000-00-00', '0000-00-00', '', 'defaultuser.png', '2023-11-21 09:43:04'),
(30, '1e8c9e13b70de34f43676be0e6c5dd54', 'ssda', 'ddeep', '909090878', '909090878', 'yatfa@gmail.com', '', 'ni', '', 'yhh', 'ereer', 'edwe', 'sfsffer', 'geetrte', 'gegrretrg', '0000-00-00', '0000-00-00', '', 'defaultuser.png', '2023-11-21 09:45:57');

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
-- Indexes for table `masik_parvas`
--
ALTER TABLE `masik_parvas`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `masik_parvas`
--
ALTER TABLE `masik_parvas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
