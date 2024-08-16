-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 10:03 AM
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
-- Database: `propertynexus`
--

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
(6, 'Penthouse in Al-Weib', 20000, 'A stunning penthouse with panoramic views of the city.', 1021, 'Amman', 'Al-Weibdeh', 4, 'images/154543781.jpg', 'rent'),
(10, 'Cottage in Wadi Rum', 9500, 'A charming desert cottage perfect for retreats.', 1024, 'Wadi rum', 'Protected Area', 0, 'images/380390480.jpg', 'buy'),
(11, 'Chalet in Dead Sea', 40000, 'A luxury chalet with direct access to the Dead Sea.', 1026, 'Dead sea', 'Resort Area', 0, 'images/387492230.jpg', 'rent'),
(12, 'Apartment', 180000, 'A spacious 2-bedroom apartment with modern amenities.', 1027, 'Amman', 'Al-Rabieh', 0, 'images/412904668.jpg', 'buy'),
(13, 'Commercial Warehouse', 800000, 'A large warehouse with easy access to the airport.', 1021, 'Irbid', 'Alhasan industrial', 0, 'images/412904889.jpg', 'rent'),
(17, 'Luxurious Apartment ', 120000, 'A spacious and luxurious 3-bedroom apartment located in the heart of Amman with stunning city views.', 1007, 'Amman', 'Jabal Amman', 5, 'images\\453827573.jpg', 'buy'),
(18, 'Cozy Villa in Aqaba', 250000, 'A beautiful villa near the Red Sea in Aqaba, featuring 4 bedrooms, a private garden, and a swimming pool.', 1024, 'Aqaba', 'Al-Hammamat Al-Tunisyya', 1, 'images/454171228.jpg', 'buy'),
(19, 'Modern Office Space ', 80000, 'Modern office space with open floor plan, suitable for startups and small businesses, located in downtown Irbid.', 1021, 'Irbid', 'Al-Husun', 3, 'images/486102267.jpg', 'rent'),
(20, 'Traditional House in', 60000, 'Charming traditional house with 2 bedrooms, a large kitchen, and a beautiful courtyard in historic Madaba.', 1028, 'Madaba', 'Al-Karak', 2, 'images/486102284.jpg', 'rent'),
(21, 'Elegant Studio in Za', 50000, 'An elegant and affordable studio apartment perfect for singles or young couples, situated in a convenient location in Zarqa.', 1028, 'Zarqa', 'Al-Zarqa Al-Jadida', 4, 'images/518847160.jpg', 'buy'),
(22, 'Luxurious Apartment ', 120000, 'A spacious and luxurious 3-bedroom apartment located in the heart of Amman with stunning city views.', 1021, 'Amman', 'Jabal Amman', 5, 'images/520240845.jpg', 'buy'),
(23, 'Cozy Villa in Aqaba', 250000, 'A beautiful villa near the Red Sea in Aqaba, featuring 4 bedrooms, a private garden, and a swimming pool.', 1027, 'Aqaba', 'Al-Hammamat Al-Tunisyya', 1, 'images/564663675.jpg', 'rent'),
(24, 'Modern Office Space ', 80000, 'Modern office space with open floor plan, suitable for startups and small businesses, located in downtown Irbid.', 1026, 'Irbid', 'Al-Husun', 3, 'images/583644155.jpg', 'buy'),
(25, 'Traditional House in', 60000, 'Charming traditional house with 2 bedrooms, a large kitchen, and a beautiful courtyard in historic Madaba.', 1027, 'Madaba', 'Al-Karak', 2, 'images/583644190.jpg', 'buy'),
(26, 'Elegant Studio in Za', 50000, 'An elegant and affordable studio apartment perfect for singles or young couples, situated in a convenient location in Zarqa.', 1021, 'Zarqa', 'Al-Zarqa Al-Jadida', 4, 'images/apt1.jpeg', 'rent'),
(27, 'Luxury Villa in Abdo', 450000, 'A spacious luxury villa with a private garden and pool.', 1028, 'Amman', 'Abdoun', 2, 'images/apt2.jpeg', 'Villa'),
(28, 'Modern Apartment in ', 120000, 'A modern 2-bedroom apartment close to shopping malls.', 1027, 'Amman', 'Sweifieh', 5, 'images/apt3.jpeg', 'Apartment'),
(29, 'Cozy Apartment in Ja', 95000, 'A cozy 1-bedroom apartment with a view of the city.', 1029, 'Amman', 'Jabal Amman', 3, 'images/apt4.jpeg', 'Apartment'),
(30, 'Family House in Dabo', 380000, 'A large family house with 4 bedrooms and a backyard.', 1030, 'Amman', 'Dabouq', 1, 'images/apt5.jpeg', 'House'),
(31, 'Commercial Office in', 250000, 'A 150 sqm office space in the heart of the business district.', 1031, 'Amman', 'Shmeisani', 8, 'images/apt6.jpeg', 'Office'),
(32, 'Traditional House in', 75000, 'A traditional stone house with historical significance.', 1032, 'Madaba', 'Central Madaba', 1, 'images/apt7.jpeg', 'House'),
(33, 'Seaside Villa in Aqa', 550000, 'A stunning villa with direct access to the Red Sea.', 1033, 'Aqaba', 'South Beach', 1, 'images/apt8.jpeg', 'Villa'),
(34, 'Land Plot in Jerash', 200000, 'A large plot of land perfect for agricultural use.', 1034, 'Jerash', 'North Jerash', 0, 'images/apt10.jpeg', 'Land'),
(35, 'Luxury Apartment in ', 200000, 'A luxurious 3-bedroom apartment in the new downtown area.', 1035, 'Amman', 'Abdali', 10, 'images/download.jpeg', 'Apartment'),
(36, 'Farmhouse in Ajloun', 180000, 'A beautiful farmhouse surrounded by olive trees.', 1036, 'Ajloun', 'West Ajloun', 1, 'images/453827573.jpg', 'House');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `t_ID` int(11) NOT NULL,
  `t_userReview` varchar(150) NOT NULL,
  `t_rating` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `created_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`t_ID`, `t_userReview`, `t_rating`, `userID`, `created_at`) VALUES
(5, 'Recommend!', 3, 1000, '2024-05-05'),
(6, 'Excellent service and very responsive. Highly recommend!', 5, 1001, '2024-05-06'),
(7, 'Good experience overall, but the property had some minor issues.', 4, 1003, '2024-05-07'),
(8, 'Average service. Could be better.', 2, 1002, '2024-07-01'),
(9, 'Awesome', 3, 1027, '2024-08-01'),
(11, 'The Property Nexus web app has an intuitive interface and made searching for properties effortless.', 5, 1024, '2024-06-01'),
(12, 'I appreciate the responsive design of Property Nexus; it works great on both my laptop and phone.', 4, 1007, '2024-08-02'),
(13, 'Excellent service! The Property Nexus app helped me find my dream home quickly.', 5, 1026, '2024-08-03'),
(14, 'I found the filtering options very useful. However, the map feature could be improved.', 4, 1000, '2024-08-04'),
(15, 'Great customer support and an easy-to-navigate website. Highly recommend Property Nexus!', 5, 1001, '2024-08-05'),
(16, 'The app’s performance is smooth, and the search results are accurate. Overall, a very reliable tool.', 5, 1002, '2024-08-06'),
(17, 'Found some minor bugs when using the app on an older phone, but overall a good experience.', 3, 1003, '2024-08-07'),
(18, 'Property Nexus saved me a lot of time and hassle during my property search.', 5, 1007, '2024-08-08'),
(19, 'I liked the detailed property listings and the ability to compare different options.', 4, 1027, '2024-08-09'),
(20, 'The app is user-friendly, but I wish there were more properties listed in rural areas.', 4, 1024, '2024-08-10');

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
  `isAdmin` tinyint(4) NOT NULL DEFAULT 0,
  `userImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userID`, `userFname`, `userLname`, `userAdress`, `userPW`, `userMobile`, `userEmail`, `isAdmin`, `userImage`) VALUES
(1000, 'Salameh', 'Yasin', 'Amman', '2024', '0777777777', 's@yaseen.com', 1, NULL),
(1001, 'Amro', 'al-wageei', 'Aqaba', '20@24', '077777', 'amro@aqaba', 1, NULL),
(1002, 'Hadeel', 'alshahwan', 'Amman', '2020', '0777', 'h@amman', 1, NULL),
(1003, 'Moamen', 'al-shoha', 'Irbid', '0024', '0777777', 'm@momen', 1, NULL),
(1007, 'ragad', 'alshobaki', 'Aqaba', '1234', '0799999999', 'r@orange', 1, 'images\\219969.png'),
(1024, 'Asal', 'Qasem', 'Amman', '14740', '0798765432', 'asal@gmail.com', 1, 'images\\icon-256x256.png'),
(1026, 'Ramia', 'ssshasan', 'maan', 'secure123', '0778765432', 'rania.salem@example.com', 0, 'images\\user(1).png'),
(1027, 'khaled', 'mohamad', 'jarash', 'Amman123', '0785678901', 'khaled@uuu', 1, 'images\\user.png'),
(1028, 'wateen', 'alshobaki', 'Aqaba', '2024', '0777777777', 'wateen@gmail.com', 0, NULL),
(1029, 'Ahmad', 'Al-Majali', 'Amman, Abdoun', 'password12', '0791234567', 'ahmad.majali@example.com', 0, NULL),
(1030, 'Laila', 'Haddad', 'Amman, Sweifieh', 'securePass', '0797654321', 'laila.haddad@example.com', 0, NULL),
(1031, 'Sami', 'Khalaf', 'Irbid, Al-Hashemi', 'myPass#321', '0789876543', 'sami.khalaf@example.com', 0, NULL),
(1032, 'Mona', 'Odeh', 'Zarqa, Al-Manshia', 'monaOdeh!$', '0786543210', 'mona.odeh@example.com', 0, NULL),
(1033, 'Yousef', 'Nasser', 'Aqaba, South Beach', 'YousefPass', '0771230987', 'yousef.nasser@example.com', 0, NULL),
(1034, 'Hanan', 'Bashir', 'Madaba, Central Madaba', 'Hanan2024!', '0777654321', 'hanan.bashir@example.com', 0, NULL),
(1035, 'Rami', 'Shahin', 'Amman, Jabal Amman', 'Rami!Shahi', '0794321098', 'rami.shahin@example.com', 0, NULL),
(1036, 'Sara', 'Tawfiq', 'Jerash, North Jerash', 'Sara@Jeras', '0783210987', 'sara.tawfiq@example.com', 0, NULL),
(1037, 'Omar', 'Abu Khalil', 'Amman, Shmeisani', 'Omar$Khali', '0790987654', 'omar.abukhalil@example.com', 0, NULL),
(1038, 'Nadia', 'Sabbagh', 'Ajloun, West Ajloun', 'NadiaPass#', '0776543219', 'nadia.sabbagh@example.com', 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`p_ID`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`t_ID`),
  ADD KEY `fk_user_testimonials` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `p_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `t_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1039;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `fk_user_reveiw` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `fk_user_testimonials` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
