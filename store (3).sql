-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220815.9c72103931
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2022 at 01:18 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `store`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressid` int(10) NOT NULL,
  `custid` int(10) NOT NULL,
  `city_id` int(11) NOT NULL,
  `address` text NOT NULL,
  `state` varchar(25) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `contactno` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressid`, `custid`, `city_id`, `address`, `state`, `pincode`, `contactno`) VALUES
(8, 16, 2, '64 Way Street', 'SA', '5084', 404359418);

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `bilid` int(10) NOT NULL,
  `custid` int(10) NOT NULL,
  `addressid` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `staffid` int(11) NOT NULL,
  `bill_no` varchar(25) NOT NULL,
  `entry_type` text NOT NULL,
  `purchdate` date NOT NULL,
  `delivdate` date NOT NULL,
  `total_amt` double(10,2) NOT NULL,
  `cardtype` varchar(20) NOT NULL,
  `cardno` varchar(5) NOT NULL,
  `expirydate` date NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`bilid`, `custid`, `addressid`, `city_id`, `staffid`, `bill_no`, `entry_type`, `purchdate`, `delivdate`, `total_amt`, `cardtype`, `cardno`, `expirydate`, `comment`, `status`) VALUES
(12, 18, 0, 2, 1, '11', 'Purchase', '2022-10-06', '0000-00-00', 20.00, '', '', '0000-00-00', 'First Delivery', 'Active'),
(13, 16, 8, 0, 0, '12', 'Invoice', '2022-10-06', '2022-10-09', 48.00, 'credit/debit', '54871', '0000-00-00', '', 'Active'),
(14, 16, 8, 0, 0, '13', 'Invoice', '2022-10-06', '2022-10-09', 1.00, 'credit/debit', '21453', '0000-00-00', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catid` int(11) NOT NULL,
  `sub_catid` int(11) NOT NULL,
  `catgory_title` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catid`, `sub_catid`, `catgory_title`, `description`, `status`) VALUES
(3, 0, 'Household', 'Household Items', 'Active'),
(5, 0, 'Groceries', 'Groceries', 'Active'),
(11, 0, 'Packaged foods', 'packaged foods', 'Active'),
(21, 5, 'Rice Products', 'Rice Products', 'Active'),
(28, 3, 'Kitchenware', 'Kitchenware', 'Active'),
(43, 5, 'Fruits', 'Fruits', 'Active'),
(44, 5, 'Vegetables', 'Vegetables', 'Active'),
(45, 11, 'Rusk', '', 'Active'),
(49, 11, 'Chocolates', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city` varchar(25) NOT NULL,
  `pincodes` text NOT NULL,
  `description` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city`, `pincodes`, `description`, `status`) VALUES
(2, 'Adelaide', '5742', '   This is test record commands', 'Active'),
(6, 'Melbourne', '5896', '   This is test record commands', 'Active'),
(7, 'Perth', '6870', '   This is test record commands', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `custid` int(11) NOT NULL,
  `cust_type` varchar(25) NOT NULL,
  `custname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mob_no` varchar(10) NOT NULL,
  `cpassword` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`custid`, `cust_type`, `custname`, `email`, `mob_no`, `cpassword`, `status`) VALUES
(16, 'Customer', 'Prince', 'princesisodiya333@gmail.com', '0420623086', 'e10adc3949ba59abbe56e057f20f883e', 'Active'),
(17, 'Seller', 'TryFood', 'TryFood12@gmail.com', '0452354785', '', 'Active'),
(18, 'Seller', 'FreshoFood', 'FreshoFood12@gmail.com', '0447483647', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prodid` int(10) NOT NULL,
  `catid` int(10) NOT NULL,
  `prodname` varchar(100) NOT NULL,
  `price` double(10,2) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `unit` varchar(25) NOT NULL,
  `stockstatus` varchar(20) NOT NULL,
  `prodspecif` text NOT NULL,
  `images` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prodid`, `catid`, `prodname`, `price`, `discount`, `unit`, `stockstatus`, `prodspecif`, `images`, `status`) VALUES
(37, 28, 'Full Kitchen Utensils Set', 50.00, 4.00, '1 Pack', 'Avaiable', 'Chef Kitchen Cooking Utensils Set, Non-Stick Silicone Cooking Kitchen Utensils Spatula Set with Holder, Wooden Handle Silicone Kitchen Gadgets Utensil Set-Khaki', 'a:1:{i:0;s:28:\"166500669017379819225118.jpg\";}', 'Active'),
(38, 28, 'Pressure Cooker', 15.00, 2.00, '5 L', 'Avaiable', 'Big Pressure Cooker', 'a:1:{i:0;s:17:\"1665006780hh5.png\";}', 'Active'),
(39, 21, 'Rice', 10.00, 0.00, '2 Kg', 'Avaiable', 'Rice', 'a:1:{i:0;s:15:\"16650068817.png\";}', 'Active'),
(40, 21, 'Sunrice Jasmine Fragrant Rice 5kg', 12.00, 0.00, '5 kg', 'Avaiable', 'SunRice Jasmine Fragrant Rice delicately aromatic and fluffy ideal for Thai cuisine\r\n\r\nLong slender Fragrant grains define this classic rice variety When cooked the grains display a delicate fragrance Jasmine is the preferred rice in Southeast Asian cooking\r\nRefer to the Country of Origin labelling on the packaging', 'a:1:{i:0;s:22:\"1665007091kingkong.jpg\";}', 'Active'),
(42, 43, 'Macro Organic Banana Each', 1.00, 0.00, '1 Each', 'Avaiable', 'Bananas are sweet, delicious and pretty versatile fruits that can be added to desserts and Breakfast.\r\n\r\nFun Fact about Bananas - they are botanically considered as berries', 'a:1:{i:0;s:18:\"1665007363kela.jpg\";}', 'Active'),
(43, 44, 'Fresh Tomato ', 2.00, 0.00, '1 kg', 'Avaiable', 'Round in shape, with a bright red shiny skin and red pulp and whitish seeds. The tomato is actually a fruit but is considered a vegetable because of its uses. ', 'a:1:{i:0;s:17:\"1665007583tam.jpg\";}', 'Active'),
(44, 44, 'The Odd Bunch Avocado Prepacked 1kg', 6.00, 2.00, '1 kg', 'Avaiable', 'we support Aussie growers, buying more of our farmer\'s crop so we can bring you a range of Homebrand products of different shapes, sizes and within some slight skin blemishes. Do not worry though; quality is more than skin deep so you\'ll find we haven\'t compromised on the taste.', 'a:1:{i:0;s:17:\"1665007684ava.jpg\";}', 'Active'),
(45, 45, 'Only Organic Snack Teething Rusks 100g', 4.00, 0.00, '100g', 'Avaiable', '- Certified Organic\r\n\r\n- No artificial flavours or colours\r\n\r\n- No preservatives\r\n\r\nOur classic recipe for teething rusks will keep your baby busy for a long time as they are baked to create a hard rusk, perfect for babies teething as they encourage biting and chewing which aids in healthy tooth and gum development. Only Organic teething rusks have no added flavours or sugar so they are nice and plain for your babies developing taste buds.\r\n\r\n', 'a:1:{i:0;s:18:\"1665007820russ.jpg\";}', 'Active'),
(46, 49, 'Cadbury Dairy Milk Chocolate Caramello 55g Bar', 2.00, 0.00, '55g', 'Avaiable', 'Cadbury Dairy Milk Caramello Bar is smooth and creamy, made from 100% sustainably sourced cocoa.\r\nThe equivalent of a glass and a half of pure full cream dairy milk in every 200g of Cadbury Dairy Milk milk chocolate.', 'a:1:{i:0;s:19:\"1665008182dairy.jpg\";}', 'Active'),
(47, 43, 'Kanzi Apple Each', 2.00, 0.00, '1', 'Avaiable', 'Kanzi apples have a delicious sweet and tangy taste, with their flavour coming from the variety’s parents - the sweet Gala and the tangy Braeburn.  ', 'a:1:{i:0;s:17:\"1665009584sab.jpg\";}', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchid` int(10) NOT NULL,
  `prodid` int(10) NOT NULL,
  `typeid` int(10) NOT NULL,
  `custid` int(10) NOT NULL,
  `bilid` int(10) NOT NULL,
  `entry_type` varchar(25) NOT NULL,
  `qty` float(10,2) NOT NULL,
  `price` double(10,2) NOT NULL,
  `discount_price` float(10,2) NOT NULL,
  `comment` text NOT NULL,
  `purchasestatus` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchid`, `prodid`, `typeid`, `custid`, `bilid`, `entry_type`, `qty`, `price`, `discount_price`, `comment`, `purchasestatus`) VALUES
(41, 39, 0, 1, 12, 'Purchase', 2.00, 10.00, 0.00, '', 'Active'),
(42, 37, 0, 16, 13, 'Invoice', 1.00, 50.00, 4.00, '', 'Active'),
(43, 42, 0, 16, 14, 'Invoice', 1.00, 1.00, 0.00, '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(10) NOT NULL,
  `city_id` int(11) NOT NULL,
  `staff_type` varchar(25) NOT NULL,
  `staffname` varchar(25) NOT NULL,
  `loginid` varchar(30) NOT NULL,
  `apassword` varchar(255) NOT NULL,
  `emailid` varchar(30) NOT NULL,
  `contactno` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `city_id`, `staff_type`, `staffname`, `loginid`, `apassword`, `emailid`, `contactno`, `status`) VALUES
(1, 0, 'Admin', 'Mr. admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', '789456123', 'Active'),
(10, 2, 'Staff', 'Prince', 'Prince', 'e10adc3949ba59abbe56e057f20f883e', 'princesisodiya333@gmail.com', '0468393785', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `typeid` int(10) NOT NULL,
  `prodid` int(10) NOT NULL,
  `color` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `cost` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `unit` varchar(25) NOT NULL,
  `stockstatus` varchar(25) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`typeid`, `prodid`, `color`, `image`, `cost`, `discount`, `unit`, `stockstatus`, `status`) VALUES
(27, 41, '1', '1665009367sab.jpg', 2.00, 0.00, 'Kanzi Apple Each', 'Available', 'Active'),
(28, 41, '2', '1665009452sab.jpg', 4.00, 0.00, '2', 'Available', 'Active'),
(29, 47, '1', '1665009624sab.jpg', 2.00, 0.00, 'Kanzi Apple Each', 'Available', 'Active'),
(30, 47, '2', '1665009662sab.jpg', 4.00, 0.00, 'Kanzi Apple', 'Available', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressid`),
  ADD KEY `custid` (`custid`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`bilid`),
  ADD KEY `custid` (`custid`),
  ADD KEY `addressid` (`addressid`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`catid`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`custid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prodid`),
  ADD KEY `catid` (`catid`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchid`),
  ADD KEY `prodid` (`prodid`,`typeid`,`custid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`typeid`),
  ADD KEY `prodid` (`prodid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `bilid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `custid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prodid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `typeid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
