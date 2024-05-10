-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2024 at 10:47 AM
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
-- Database: `online counter`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `is_admin` tinyint(1) NOT NULL,
  `id` varchar(100) NOT NULL,
  `pw` char(100) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`is_admin`, `id`, `pw`, `name`) VALUES
(0, '1022140', '$2y$10$gJgajs9LgIFAiFWDas5BWudNGF3j5PCuPSV24kMREPtvnyrrYm8km', 'Delphina Emoin'),
(0, '1022148', '$2y$10$l27lRJ5yk/Doxtsj5meEyuLqYR7HFtUo/ScsaOJGR3DCiHh2eqvOS', 'Riya Jadhav'),
(0, '1022162', '$2y$10$K7AP0UN3s8.RW0il0/E6n.hleE6qGSpaUH6anCOGVcxcGdMnjLPam', 'Atharva Karle'),
(0, '1022166', '$2y$10$PIYauf4/FIujFWt8Q1.mSeoYjlpU7WPC0wAFICqwCyCt9u.fTelva', 'Sharvari Kulkarni'),
(1, 'admin', '$2y$10$MpzYsjQSdD/IIkDrJmNvoOTUbt9PiidFqfrgbC055Nr4lCo1Zwapq', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `purchased_items` text NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `payment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `user_id`, `email`, `purchased_items`, `total_amount`, `payment_date`) VALUES
(4, 1022148, 'rj@gmail.com', 'a:1:{i:0;a:3:{s:12:\"product_name\";s:6:\"Sheets\";s:5:\"price\";s:6:\"100.00\";s:8:\"quantity\";s:1:\"1\";}}', 100.00, '2024-03-03'),
(5, 1022148, 'rj@gmail.com', 'a:1:{i:0;a:3:{s:12:\"product_name\";s:6:\"Sheets\";s:5:\"price\";s:6:\"100.00\";s:8:\"quantity\";s:1:\"1\";}}', 100.00, '2024-03-03'),
(6, 1022148, 'dsg@gmail.com', 'a:1:{i:0;a:3:{s:12:\"product_name\";s:6:\"Sheets\";s:5:\"price\";s:6:\"100.00\";s:8:\"quantity\";s:1:\"1\";}}', 100.00, '2024-03-04'),
(7, 1022148, 'rj@gmail.com', 'a:2:{i:0;a:3:{s:12:\"product_name\";s:7:\"Id-card\";s:5:\"price\";s:6:\"200.00\";s:8:\"quantity\";s:1:\"1\";}i:1;a:3:{s:12:\"product_name\";s:14:\"Id-card holder\";s:5:\"price\";s:5:\"60.00\";s:8:\"quantity\";s:1:\"1\";}}', 260.00, '2024-03-04'),
(8, 1022148, 'rj@gmail.com', 'a:2:{i:0;a:3:{s:12:\"product_name\";s:7:\"Id-card\";s:5:\"price\";s:6:\"200.00\";s:8:\"quantity\";s:1:\"1\";}i:1;a:3:{s:12:\"product_name\";s:9:\"Hardbound\";s:5:\"price\";s:5:\"40.00\";s:8:\"quantity\";s:1:\"1\";}}', 240.00, '2024-03-09'),
(9, 1022148, 'ghi@gmail.com', 'a:2:{i:0;a:3:{s:12:\"product_name\";s:5:\"Print\";s:5:\"price\";s:4:\"2.00\";s:8:\"quantity\";s:1:\"1\";}i:1;a:3:{s:12:\"product_name\";s:5:\"Xerox\";s:5:\"price\";s:4:\"1.00\";s:8:\"quantity\";s:2:\"10\";}}', 12.00, '2024-04-02'),
(10, 1022148, 'ghi@gmail.com', 'a:1:{i:0;a:3:{s:12:\"product_name\";s:9:\"Hardbound\";s:5:\"price\";s:5:\"40.00\";s:8:\"quantity\";s:1:\"1\";}}', 40.00, '2024-04-02'),
(11, 1022140, 'abc@gmail.com', 'a:2:{i:0;a:3:{s:12:\"product_name\";s:6:\"Sheets\";s:5:\"price\";s:6:\"100.00\";s:8:\"quantity\";s:1:\"1\";}i:1;a:3:{s:12:\"product_name\";s:7:\"Id-card\";s:5:\"price\";s:6:\"200.00\";s:8:\"quantity\";s:1:\"1\";}}', 300.00, '2024-04-02'),
(12, 1022140, 'abc@gmail.com', 'a:1:{i:0;a:3:{s:12:\"product_name\";s:5:\"Xerox\";s:5:\"price\";s:4:\"1.00\";s:8:\"quantity\";s:2:\"34\";}}', 34.00, '2024-04-02'),
(13, 1022140, 'xyz@gmail.com', 'a:1:{i:0;a:3:{s:12:\"product_name\";s:9:\"Hardbound\";s:5:\"price\";s:5:\"40.00\";s:8:\"quantity\";s:1:\"1\";}}', 40.00, '2024-04-02'),
(14, 1022140, 'abc@gmail.com', 'a:1:{i:0;a:3:{s:12:\"product_name\";s:14:\"Id-card holder\";s:5:\"price\";s:5:\"60.00\";s:8:\"quantity\";s:1:\"1\";}}', 60.00, '2024-04-02'),
(15, 1022140, 'abc@gmail.com', 'a:1:{i:0;a:3:{s:12:\"product_name\";s:7:\"Id-card\";s:5:\"price\";s:6:\"200.00\";s:8:\"quantity\";s:1:\"1\";}}', 200.00, '2024-04-02'),
(16, 1022148, 'abc@gmail.com', 'a:1:{i:0;a:3:{s:12:\"product_name\";s:6:\"Sheets\";s:5:\"price\";s:6:\"100.00\";s:8:\"quantity\";s:1:\"1\";}}', 100.00, '2024-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `product_first`
--

CREATE TABLE `product_first` (
  `product_id` int(100) NOT NULL,
  `des` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` double(100,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_first`
--

INSERT INTO `product_first` (`product_id`, `des`, `image`, `price`) VALUES
(1, 'Xerox', 'xbimg.png', 1.00),
(2, 'Print', 'pbimg.png', 2.00),
(4, 'Sheets', 'sbimg.png', 100.00),
(5, 'Id-card', 'ibimg.png', 200.00),
(6, 'Id-card holder', 'ihbimg.png', 60.00),
(12, 'Hardbound', 'hbimg.png', 40.00);

-- --------------------------------------------------------

--
-- Table structure for table `product_second`
--

CREATE TABLE `product_second` (
  `user_id` char(100) NOT NULL,
  `des` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` double(100,2) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product_first`
--
ALTER TABLE `product_first`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_second`
--
ALTER TABLE `product_second`
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product_first`
--
ALTER TABLE `product_first`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_second`
--
ALTER TABLE `product_second`
  ADD CONSTRAINT `product_second_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `login` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
