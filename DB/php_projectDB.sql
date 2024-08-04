-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2024 at 07:21 PM
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
-- Database: `php_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_ID` int(11) NOT NULL,
  `cat_name` varchar(50) NOT NULL,
  `cat_description` varchar(255) NOT NULL,
  `cat_type` varchar(10) NOT NULL,
  `cat_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `p_ID` int(11) NOT NULL,
  `p_title` varchar(20) DEFAULT NULL,
  `p_price` int(11) NOT NULL,
  `p_description` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `p_city` varchar(255) DEFAULT NULL,
  `p_region` varchar(255) DEFAULT NULL,
  `p_floor` int(11) DEFAULT NULL,
  `p_image_url` varchar(255) DEFAULT NULL,
  `p_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`p_ID`, `p_title`, `p_price`, `p_description`, `user_id`, `p_city`, `p_region`, `p_floor`, `p_image_url`, `p_type`) VALUES
(2, 'فيلاي القاهرة', 50000, 'فيلا في القاهرة', 1021, 'aqaba', 'jordan', 4, 'images/apt1.jpeg', 'villa'),
(4, 'ffff', 123, 'fsdafa', 1023, NULL, NULL, NULL, 'images/apt1.jpeg', NULL),
(5, 'property0101', 0, 'aqaba house', NULL, 'aqaba', 'jordan', 3, 'images/apt1.jpeg', 'house'),
(6, 'yasmeen\'s house', 20000, 'sea view', NULL, 'aqaba', 'jordan', 1, 'images/apt1.jpeg', 'villa'),
(7, 'dsgstjnj', 140, 'dbgs', NULL, 'dfzngfm', '\\fng', 7, 'images/apt1.jpeg', 'home'),
(10, 'vbnmhg', 0, 'wsretgdhfjhbf', NULL, 'szcxvbnm', 'dxcvbnmhjgg', 0, 'images/apt1.jpeg', '0');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `t_ID` int(11) NOT NULL,
  `t_userReview` varchar(150) NOT NULL,
  `t_rating` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `userFname` varchar(25) NOT NULL,
  `userLname` varchar(25) DEFAULT NULL,
  `userAdress` varchar(50) DEFAULT NULL,
  `userPW` varchar(10) DEFAULT NULL,
  `userMobile` varchar(10) DEFAULT NULL,
  `userEmail` varchar(50) DEFAULT NULL,
  `isAdmin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userFname`, `userLname`, `userAdress`, `userPW`, `userMobile`, `userEmail`, `isAdmin`) VALUES
(1010, '', 'testUser', 'aqaba', '2424', '2424', 'a@a', 1),
(1015, 'abd', 'abd', 'abd', 'abd', '1478523', 'abd@abd', 1),
(1017, 'ragad', 'rgd', 'aqba', '0258', '0147852', 'r@gmail.com', 0),
(1019, 'orange', 'aqaba', ' aqaba', '2024', '077777777', 'o@gmail.com', 1),
(1020, 'user1', 'test', 'aqaba', '24234', '077777777', 'a@w', 0),
(1022, 'user1', 'test', 'aqaba', '24234', '077777777', 'a@w', 0),
(1023, 'yasmeen', 'yasmmen', 'aqaba', '789', '01477885', 'y@gmail', 0),
(1024, 'new user', 'test', 'jo', '147', '08888888', 'b@gmail.com', 0),
(1025, 'user', 'test test', 'eeded', '032', '97461', 'r@q', 0),
(1026, 'user', 'test test', 'eeded', '032', '97461', 'r@q', 0),
(1027, 'zaina', 'alhelo', 'aqaba', '456', '1478', 'a@z', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_ID`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`p_ID`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`t_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `p_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `t_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1028;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
