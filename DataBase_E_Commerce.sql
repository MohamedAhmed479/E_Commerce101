-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2024 at 09:46 AM
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
-- Database: `e_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `idCoupon` int(11) NOT NULL,
  `Coupon` varchar(50) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `idDiscount` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`idCoupon`, `Coupon`, `created_at`, `idDiscount`, `status`) VALUES
(5, 'Almsry2024', '2024-02-01', 1, 'available'),
(6, 'Route2024', '2024-02-01', 4, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `idcustomer` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customeraddres` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`idcustomer`, `username`, `password`, `phone`, `modified_at`, `customeraddres`, `email`) VALUES
(17, 'Almsry', '$2y$10$rlTRuGu2AIQxNsktUvMRLu7gdLIHnSOiHGSuD4ONJJkWSh3YXqQCO', '+0201020129678', '2024-02-05 06:51:11', 'Egypt, Cairo, El Shorouk', 'almsry0852@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `amount` int(3) NOT NULL,
  `startsAt` datetime NOT NULL DEFAULT current_timestamp(),
  `endsAt` datetime NOT NULL,
  `minimumAmount` decimal(10,2) NOT NULL,
  `maximumDiscount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `discounts`
--

INSERT INTO `discounts` (`id`, `amount`, `startsAt`, `endsAt`, `minimumAmount`, `maximumDiscount`, `status`) VALUES
(1, 70, '2024-02-01 13:28:21', '2024-02-15 13:25:30', 2000.00, 3000.00, 'available'),
(4, 60, '2024-02-01 13:28:21', '2024-02-15 13:25:30', 2000.00, 3000.00, 'available');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderNumber` int(11) NOT NULL,
  `productCode` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `quantityproduct` int(11) NOT NULL,
  `priceEach` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderNumber` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `requiredDate` date NOT NULL,
  `shippedDate` date DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'in the cart',
  `comments` text DEFAULT NULL,
  `customerNumber` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `idCustomer` int(11) NOT NULL,
  `orderNumber` int(11) NOT NULL,
  `checkNumber` varchar(50) NOT NULL,
  `payday` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'incomplete',
  `city` varchar(50) NOT NULL,
  `postalCode` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `productCode` varchar(15) NOT NULL,
  `productName` varchar(70) NOT NULL,
  `productDescription` text NOT NULL,
  `quantityInStock` smallint(6) NOT NULL,
  `buyPrice` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `star` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`productCode`, `productName`, `productDescription`, `quantityInStock`, `buyPrice`, `image`, `star`) VALUES
('$_12323sada', 'Zara', 'Autumn shirt', 125, 1450.00, '65c06d33aa590.jpg', 4),
('$_12323sadadds', 'Nike', 'Autumn shirt', 50, 1250.00, '65c06e6681380.jpg', 3),
('$_123445', 'H&M', 'Autumn shirt', 150, 2000.00, 'f8.jpg', 2),
('$_123454565', 'Zara', 'Autumn shirt', 200, 1100.00, 'f4.jpg', 4),
('$_123456', 'Twon Team', 'Autumn shirt', 200, 1500.00, 'f1.jpg', 5),
('$_1234565', 'Adidas', 'Autumn shirt', 200, 1000.00, 'f2.jpg', 3),
('$_12345655', 'Nike', 'Autumn shirt', 200, 1200.00, 'f3.jpg', 2),
('$_12545655', 'Nike', 'Autumn shirt', 200, 1700.00, 'f7.jpg', 0),
('$_16545655', 'Adidas', 'Autumn shirt', 200, 1600.00, 'f6.jpg', 2),
('$_18945655', 'LC Waikiki', 'Autumn shirt', 200, 900.00, 'f5.jpg', 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`idCoupon`),
  ADD KEY `coupon_discount` (`idDiscount`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`idcustomer`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderNumber`,`productCode`),
  ADD KEY `productCode` (`productCode`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderNumber`),
  ADD KEY `customerNumber` (`customerNumber`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`checkNumber`),
  ADD KEY `payment_order` (`orderNumber`),
  ADD KEY `payment_order_1` (`idCustomer`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productCode`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `idCoupon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `idcustomer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `coupon_discount` FOREIGN KEY (`idDiscount`) REFERENCES `discounts` (`id`);

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `FG_product_code` FOREIGN KEY (`productCode`) REFERENCES `products` (`productCode`),
  ADD CONSTRAINT `orderdetails_customer` FOREIGN KEY (`orderNumber`) REFERENCES `orders` (`orderNumber`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_customer` FOREIGN KEY (`customerNumber`) REFERENCES `customers` (`idcustomer`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payment_order` FOREIGN KEY (`orderNumber`) REFERENCES `orders` (`orderNumber`),
  ADD CONSTRAINT `payment_order_1` FOREIGN KEY (`idCustomer`) REFERENCES `customers` (`idcustomer`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
