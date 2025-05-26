-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 04:11 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `att_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Gold'),
(2, 'Diamond'),
(3, 'Platinum');

-- --------------------------------------------------------

--
-- Table structure for table `jewellery_infor`
--

CREATE TABLE `jewellery_infor` (
  `id` int(11) NOT NULL,
  `productname` int(100) NOT NULL,
  `description` int(100) NOT NULL,
  `category` int(100) NOT NULL,
  `image` int(255) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `image`, `date`) VALUES
(37, 'Diamond Ring', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 50000.00, 2, 'ecea4cc50cdc3d03e9d003c1fc14f727.jpg', 0),
(38, 'Gold Ring', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', 40000.00, 1, 'c383524cb5b0eb09ab2c43d681382d14.jpg', 0),
(39, 'diamond Ring', 'diamond Ring ', 11111.00, 2, '627cc5bc135b7f660b7e42c3677cd58a.jpg', 0),
(40, 'Platinum Ring', 'Lorem Ipsum is simply dummy text of the printing and typesetting', 12000.00, 3, 'e0586d41b7d10c4244f51ec3032c7e3f.jpg', 0),
(41, 'Gold Earring ', 'Gold Earring  Lorem Ipsum is simply dummy text of the printing and typesetting', 22000.00, 1, 'ac4d7b50599fa87b5295718347166f51.jpg', 0),
(42, 'Gold Chain', 'Gold Chain Lorem Ipsum is simply dummy text of the printing and typesetting', 60000.00, 1, '969f47a1a2e0551c9ab734f0c7bbf84e.jpg', 0),
(43, 'Gold Ring', 'Gold Ring Lorem Ipsum is simply dummy text of the printing and typesetting', 49000.00, 1, 'd673bf83140a410068f5d74169995fbb.jpg', 0),
(44, 'Platinum Chain', 'Platinum Chain Lorem Ipsum is simply dummy text of the printing and typesetting', 13000.00, 3, 'd6678125e5c7e7f3de65299bfee3c452.jpg', 0),
(45, 'Platinum Earrings', 'Platinum Earrings Lorem Ipsum is simply dummy text of the printing and typesetting', 9999.00, 3, 'e81974e5019540f05b693ab2d9b4fc31.jpg', 0),
(46, 'Diamond Chain', 'Diamond Chain Lorem Ipsum is simply dummy text of the printing and typesetting', 200000.00, 2, 'ed2add38c6890ac0aa664693c8504be9.jpg', 0),
(47, 'Platinum Rings ', 'Platinum Rings Lorem Ipsum is simply dummy text of the printing and typesetting', 13500.00, 3, '2321540833535aec8c3a6709a6ab127f.jpg', 0),
(48, 'Ring Gold', 'Ring Gold', 35000.00, 1, '5505e3f7d678ddec6027668a484fbba2.jpg', 0),
(50, 'Gold Ring', 'Gold Ring', 20000.00, 1, '93ba5309786bab0a0f95f5e602d9feb4.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jewellery_infor`
--
ALTER TABLE `jewellery_infor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jewellery_infor`
--
ALTER TABLE `jewellery_infor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
