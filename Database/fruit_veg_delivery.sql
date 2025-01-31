-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 31, 2025 at 03:13 PM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fruit_veg_delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

DROP TABLE IF EXISTS `admin_logs`;
CREATE TABLE IF NOT EXISTS `admin_logs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `admin_id` int NOT NULL,
  `action` varchar(255) NOT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `added_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `added_on`) VALUES
(1, 1, 2, 3, '2025-01-31 09:36:18'),
(2, 2, 5, 1, '2025-01-31 09:36:18'),
(3, 1, 3, 2, '2025-01-31 09:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`customer_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_name`, `email`, `phone`, `address`, `created_at`) VALUES
(1, 'John Doe', 'johndoe@example.com', '123-456-7890', '123 Main St, Springfield', '2025-01-30 21:46:12');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 5, 'Cantell', 'abdulmajeedsualihu2000@gmail.com', 'dasde', '2025-01-31 08:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `address` text NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `order_number` varchar(50) NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `expected_delivery` date DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  UNIQUE KEY `order_number` (`order_number`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_price`, `address`, `payment_method`, `status`, `order_number`, `order_date`, `created_at`, `expected_delivery`) VALUES
(1, 7, 1.50, 'Kumasi-Ashanti', 'Mobile Money', 'Pending', '', '2025-01-31 11:12:38', '2025-01-31 11:17:12', NULL),
(2, 7, 4.35, 'ssa', 'Cash on Delivery', 'Pending', 'ORD-679CB4632EAE5', '2025-01-31 11:30:43', '2025-01-31 11:30:43', '2025-02-07'),
(3, 7, 1.80, '21', 'Mobile Money', 'Delivered', 'ORD-679CB4BDEC39E', '2025-01-31 11:32:13', '2025-01-31 11:32:13', '2025-02-07'),
(4, 7, 0.75, 'ere', 'Cash on Delivery', 'Shipped', 'ORD-679CB741444D8', '2025-01-31 11:42:57', '2025-01-31 11:42:57', '2025-02-07'),
(5, 6, 4.25, 'Kumawu', 'Cash on Delivery', 'Pending', 'ORD-679CE1F10F943', '2025-01-31 14:45:05', '2025-01-31 14:45:05', '2025-02-07'),
(6, 6, 6.00, 'Tamale', 'Credit Card', 'Pending', 'ORD-679CE3C283432', '2025-01-31 14:52:50', '2025-01-31 14:52:50', '2025-02-07'),
(7, 6, 4.25, 'Sekyere', 'Mobile Money', 'Pending', 'ORD-679CE4591A547', '2025-01-31 14:55:21', '2025-01-31 14:55:21', '2025-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 3, 2, 5.00),
(2, 1, 5, 1, 15.50),
(3, 1, 3, 2, 5.00),
(4, 1, 5, 1, 15.50),
(5, 1, 1, 1, 0.00),
(6, 0, 2, 1, 0.00),
(7, 2, 4, 2, 0.00),
(8, 2, 2, 1, 0.00),
(9, 3, 4, 1, 0.00),
(10, 4, 2, 1, 0.00),
(11, 5, 2, 1, 0.00),
(12, 5, 1, 1, 0.00),
(13, 5, 3, 1, 0.00),
(14, 6, 2, 8, 0.00),
(15, 7, 3, 1, 0.00),
(16, 7, 1, 1, 0.00),
(17, 7, 2, 1, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` enum('Fruit','Vegetable') NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `price`, `image`, `created_at`) VALUES
(1, 'Apple', 'Fruit', 1.50, 'apple.jpg', '2025-01-30 17:05:21'),
(2, 'Banana', 'Fruit', 0.75, 'banana.jpg', '2025-01-30 17:05:21'),
(3, 'Carrot', 'Vegetable', 2.00, 'carrot.jpg', '2025-01-30 17:05:21'),
(4, 'Tomato', 'Vegetable', 1.80, 'tomato.jpg', '2025-01-30 17:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int NOT NULL AUTO_INCREMENT,
  `setting_name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`setting_id`, `setting_name`, `value`) VALUES
(1, 'website_title', 'Fruit & Veg Delivery');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('customer','admin') DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `address` text NOT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `created_at`, `address`) VALUES
(1, 'John Doe', 'john@example.com', '$2y$10$abcdefghijklm...', 'customer', '2025-01-30 17:05:19', ''),
(2, 'Jane Smith', 'jane@example.com', '$2y$10$mnopqrstuvwx...', 'customer', '2025-01-30 17:05:19', ''),
(3, 'Admin', 'admin@example.com', '$2y$10$1234567890abcd...', 'admin', '2025-01-30 17:05:19', ''),
(4, 'Ye Feng', 'admin_jeed@gmail.com', '$2y$10$OvATr1Jvyc8./erFJcZM4.F9q36FnXmj7G45UW7j0FjgbNWx5ov2a', 'customer', '2025-01-30 20:49:20', ''),
(5, 'Cantell', 'cantellkawai@gmail.com', '$2y$10$OrrgDq2iM2LI9DI5QOS2SeZiShi4BzJIT4U.pt7os.evLVloPOLC2', 'customer', '2025-01-30 22:13:12', ''),
(6, 'Ye Feng', 'cantell@gmail.com', '$2y$10$gQJLD0E1YKP.lQCFMQSDieesK77H1oaTpg3hRvehA0AYKtKH6KR22', 'customer', '2025-01-31 09:39:44', ''),
(7, 'Abdulmajeed Sualihu', 'can@gmail.com', '$2y$10$oPrW9w6EqQBJRZbBLgln3.ovqegophAMqYWB/iuuIYEqyhckB1hEW', 'customer', '2025-01-31 10:49:10', ''),
(8, 'cantell', 'cant@gmail.com', '$2y$10$9OKlhnWRpIA/xBfh/jr4JORkz62HsTWbO5KxNiF3ijIq/apB5nPda', 'customer', '2025-01-31 14:56:05', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
