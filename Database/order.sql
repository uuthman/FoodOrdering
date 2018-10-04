-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2018 at 12:54 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `order`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`) VALUES
(14, 'uthman', 'uthmanayinde6@gmail.com', 'e7d0fffddfce6b98ac74c094c998fe83');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) NOT NULL,
  `p_id` int(10) NOT NULL,
  `ip_add` varchar(250) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `qty` int(10) NOT NULL,
  `uniq_id` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(100) NOT NULL,
  `cat_title` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(1, 'Pet Drink'),
(2, 'stew'),
(3, 'Rice'),
(4, 'swallow');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_title` varchar(200) NOT NULL,
  `product_price` varchar(200) NOT NULL,
  `qty` int(11) NOT NULL,
  `trx_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `product_id`, `product_title`, `product_price`, `qty`, `trx_id`) VALUES
(38, 6, 1, 'coca-cola', '200', 1, '5bb686919ae30'),
(39, 6, 2, 'Maltina', '250', 1, '5bb686919ae30'),
(40, 6, 1, 'coca-cola', '200', 1, '5bb687ea42635'),
(41, 6, 2, 'Maltina', '250', 1, '5bb687ea42635'),
(42, 6, 6, 'Fanta', '200', 1, '5bb688d63ec52'),
(43, 6, 5, 'Amala', '300', 1, '5bb688d63ec52'),
(44, 6, 1, 'coca-cola', '200', 1, '5bb69647f3344'),
(45, 6, 2, 'Maltina', '250', 1, '5bb69647f3344'),
(46, 6, 3, 'Jollof Rice', '1000', 1, '5bb69647f3344'),
(47, 6, 4, 'Fried Rice', '1300', 1, '5bb69647f3344');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(100) NOT NULL,
  `product_cat` int(100) NOT NULL,
  `category` varchar(200) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` int(100) NOT NULL,
  `product_desc` text NOT NULL,
  `product_image` text NOT NULL,
  `product_keywords` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `category`, `product_title`, `product_price`, `product_desc`, `product_image`, `product_keywords`) VALUES
(1, 1, 'Pet', 'coca-cola', 200, '<p>Coca-Cola. Coca-Cola is the biggest-selling soft drink in history, as well as one of the most recognizable brands in the world.</p>\r\n', '294561.jpg', 'coca-cola is good drink'),
(2, 1, 'Pet', 'Maltina', 250, '<p>A healthy you is a&nbsp;<strong>happy</strong>&nbsp;you. It is richly packed with essential Vitamins and Minerals (Vitamin A, B1, B2, B3, B5, B6 and C, including Calcium) to keep your body and mind completely vitalized.</p>\r\n', '339352.jpg', 'maltina is good for the body'),
(3, 3, 'Rice', 'Jollof Rice', 1000, '<p>jollof rice is a very popular dish in nigeria which you will love&nbsp;</p>\r\n', '878455.jpg', 'jollof rice is a very sweet food '),
(4, 3, 'Rice', 'Fried Rice', 1300, '<p>fried rice is done by mixing rice and green pepper with other ingredient to make it delicious</p>\r\n', '503413.jpg', 'fried rice is a good food'),
(5, 4, 'swallow', 'Amala', 300, '<p>amala is done by usingyam flour to make a very good meal</p>\r\n', '926009.jpg', 'amala is good '),
(6, 0, 'Pet', 'Fanta', 200, '<p>Fanta is a brand of fruit-flavored carbonated drinks created by The&nbsp;<strong>Coca-Cola</strong>&nbsp;Company and marketed globally</p>\r\n', '507909.png', 'fanta is a good drink'),
(7, 2, 'stew', 'Efo', 290, '<p>efo is a nigeria delicacy that is eating widely by everyone&nbsp;</p>\r\n', '369158.jpg', 'efo is very delicious'),
(8, 2, 'stew', 'Chicken Stew', 1000, '<p>chicken stew can be taken with any type of food</p>\r\n', '709234.jpg', 'chicken stew is nice'),
(9, 1, 'Pet', 'Seven Up', 200, '<p>7 Up (stylized as 7up outside the U.S.) is a brand of lemon-lime-flavored&nbsp;<em>non</em>-caffeinated soft drink. The rights to the brand are held by Keurig Dr Pepper in the United States and by PepsiCo (or its licensees) in the rest of the world.</p>\r\n', '248050.png', 'seven up is good'),
(10, 4, 'swallow', 'Plantain', 200, '<p>plantain is very delicious food to eat</p>\r\n', '730746.jpg', 'plantain is nice'),
(11, 4, 'swallow', 'semovita', 200, '<p>nigeria dish</p>\r\n', '528583.jpg', 'semo is a good food');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `user_id` int(255) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mobile` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`user_id`, `first_name`, `last_name`, `email`, `mobile`) VALUES
(1, 'ayinde', 'uthman', 'uthmanayinde6@gmail.com', '090237464784'),
(4, 'bolu', 'odetayo', 'bolu@gmail.com', '090237464784');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(10) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(300) NOT NULL,
  `access` varchar(200) NOT NULL,
  `password` varchar(300) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `address1` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `first_name`, `last_name`, `email`, `access`, `password`, `mobile`, `address1`) VALUES
(3, 'tayo', 'uthman', 'uthmanayinde6@gmail.com', 'Staff', '350b38d33501f502775dd6ac5c06fe7a', 'iwo-road, ', ' iwo-road, olojo,olodo, ibadan'),
(4, 'bolu', 'odetayo', 'bolu@gmail.com', 'Student', 'b161cf37cdff9f632bc8d310876be2da', '0902374647', 'ibadan'),
(5, 'ayinde', 'odetayo', 'uth@gmail.com', 'Student', '8e5fda446d61535d6b9372c6a17d7331', '0902374647', 'ibadan'),
(6, 'olaiya', 'posi', 'posi@gmail.com', 'Student', '61e6fca519f16135f234a3e5bab575b0', '0902374647', 'ibadan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
