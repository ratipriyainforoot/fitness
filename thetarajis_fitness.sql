-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 17, 2023 at 01:25 PM
-- Server version: 10.3.38-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thetarajis_fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `address` text DEFAULT NULL,
  `user_type` enum('admin','subadmin','toll') NOT NULL DEFAULT 'subadmin',
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `gstin` varchar(255) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `name`, `email`, `mobile`, `address`, `user_type`, `password`, `image`, `gstin`, `status`) VALUES
(1, 'Fitness App', 'fitness@gmail.com', '8888787878', 'Kolkata', 'admin', '202cb962ac59075b964b07152d234b70', '5997gift1.jpg', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attribute_master`
--

CREATE TABLE `attribute_master` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attribute_master`
--

INSERT INTO `attribute_master` (`id`, `name`) VALUES
(1, 'Meal'),
(2, 'Snacks');

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `image`) VALUES
(1, 'Banner1', 'banner1.jpg'),
(2, 'Banner2', 'banner2.jpg'),
(3, 'Banner3', 'banner3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `nutrition_id` int(11) NOT NULL,
  `nutrition_value_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `dated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_master`
--

CREATE TABLE `category_master` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `category_master`
--

INSERT INTO `category_master` (`id`, `title`, `title_ar`) VALUES
(3, 'Weight Loose', 'فقدان الوزن'),
(4, 'Fitness Packages', 'حزم اللياقة البدنية'),
(5, 'Weight Gain', 'زيادة الوزن');

-- --------------------------------------------------------

--
-- Table structure for table `fitness_products`
--

CREATE TABLE `fitness_products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_name_ar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nutrition_id` text NOT NULL,
  `nutrition_value` text NOT NULL,
  `meals` varchar(255) NOT NULL,
  `snacks` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `description_ar` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `price` float NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `fitness_products`
--

INSERT INTO `fitness_products` (`id`, `category_id`, `product_name`, `product_name_ar`, `nutrition_id`, `nutrition_value`, `meals`, `snacks`, `description`, `description_ar`, `price`, `image`) VALUES
(1, 3, 'Nutrition AB', 'التغذية', '1,2,3', '1,2,3,4,5', '2', '5', 'Best Product for weight gain', 'أفضل منتج لزيادة الوزن', 200, '863Massachusetts.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `nutritional_items`
--

CREATE TABLE `nutritional_items` (
  `id` int(255) NOT NULL,
  `nutrition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nutritional_items`
--

INSERT INTO `nutritional_items` (`id`, `nutrition`) VALUES
(1, 'Calories'),
(2, 'Cholestrol'),
(3, 'Sugar'),
(4, 'Protein'),
(5, 'Calcium'),
(6, 'Sodium');

-- --------------------------------------------------------

--
-- Table structure for table `nutrition_value`
--

CREATE TABLE `nutrition_value` (
  `id` int(255) NOT NULL,
  `nutrition_id` int(11) NOT NULL,
  `nutrition_value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nutrition_value`
--

INSERT INTO `nutrition_value` (`id`, `nutrition_id`, `nutrition_value`) VALUES
(1, 1, '200g'),
(2, 1, '50g'),
(3, 2, '50g'),
(4, 2, '10g'),
(5, 3, '10g'),
(6, 3, '15g'),
(7, 4, '20g'),
(8, 4, '25g'),
(9, 5, '200g'),
(10, 5, '125g');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `nutrition_id` int(11) NOT NULL,
  `nutrition_value_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `dated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `country` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(40) NOT NULL,
  `dated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `dob`, `email`, `mobile`, `country`, `password`, `gender`, `dated`) VALUES
(1, 'Md', 'Kalam', '12-09-1990', 'k@gmail.com', '8878787676', '', '202cb962ac59075b964b07152d234b70', 'Male', '2023-01-09 15:58:29'),
(2, 'Vicky', 'Singh', '19-02-1994', 'vicky@gmail.com', '8240769550', '', '202cb962ac59075b964b07152d234b70', 'Male', '2023-01-21 07:36:55'),
(3, 'Vicky', 'Singh', 'February 19, 1994', 'a@gmail.com', '8240769550', '', '202cb962ac59075b964b07152d234b70', 'Male', '2023-02-01 16:47:47'),
(4, 'Kaushik', 'Talukder', 'February 01, 2023', 'talukderkaushik09@gmail.com', '79088881', 'Kuwait', '89b33f689bf7776375b43686182eaaa2', 'Male', '2023-02-01 16:53:25'),
(5, 'shabbir', 'saithji', 'January 06, 1993', 'shabbirsaithji@gmail.com', '94090552', 'Kuwait', 'e10adc3949ba59abbe56e057f20f883e', 'Male', '2023-02-13 10:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `landmark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`id`, `user_id`, `state`, `city`, `address`, `pincode`, `landmark`) VALUES
(1, 1, 'Jharkhand', 'Dhanbad', 'Dhanbad ', '828109', 'Eidgah'),
(2, 1, 'West Bengal', 'Kolkata', 'Tollygunj, Karunamoyee', '700087', 'Mahanayak Uttam Kumar'),
(3, 8, 'West Bengal', 'Kolkata', 'Tollygunj, Karunamoyee', '700087', 'Mahanayak Uttam Kumar'),
(4, 8, 'West Bengal', 'Kolkata', 'Tollygunj, Karunamoyee', '700087', 'Mahanayak Uttam Kumar'),
(5, 8, 'West Bengal', 'Kolkata', 'Tollygunj, Karunamoyee', '700087', 'Mahanayak Uttam Kumar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attribute_master`
--
ALTER TABLE `attribute_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_master`
--
ALTER TABLE `category_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fitness_products`
--
ALTER TABLE `fitness_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutritional_items`
--
ALTER TABLE `nutritional_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nutrition_value`
--
ALTER TABLE `nutrition_value`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attribute_master`
--
ALTER TABLE `attribute_master`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category_master`
--
ALTER TABLE `category_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fitness_products`
--
ALTER TABLE `fitness_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nutritional_items`
--
ALTER TABLE `nutritional_items`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nutrition_value`
--
ALTER TABLE `nutrition_value`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
