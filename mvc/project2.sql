-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 08, 2021 at 02:40 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE `admin_details` (
  `adminId` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`adminId`, `username`, `password`, `status`, `createdAt`) VALUES
(1, 'Arunshi Gupta', '123', '1', '2021-04-29 13:50:25');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `entityTypeId` enum('product','category') NOT NULL,
  `name` varchar(64) NOT NULL,
  `code` varchar(20) NOT NULL,
  `inputType` varchar(20) NOT NULL,
  `backendType` varchar(64) NOT NULL,
  `sortOrder` int(4) NOT NULL,
  `backendModel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `entityTypeId`, `name`, `code`, `inputType`, `backendType`, `sortOrder`, `backendModel`) VALUES
(1, 'product', 'Color', '###', 'text', 'INT', 1, ''),
(4, 'category', 'Clothes', '***', 'textarea', 'VARCHAR', 0, '-');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_option`
--

CREATE TABLE `attribute_option` (
  `optionId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute_option`
--

INSERT INTO `attribute_option` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(10, 'brown', 1, 1),
(15, 'black', 1, 2),
(17, 'blue', 1, 3),
(19, 'white', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sortOrder` tinyint(4) NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandId`, `name`, `image`, `sortOrder`, `status`) VALUES
(1, 'Brand1', 'brand_1.png', 1, 1),
(2, 'Brand2', 'brand_2.png', 2, 1),
(3, 'Brand3', 'brand_3.png', 3, 1),
(4, 'Brand4', 'brand_4.png', 4, 1),
(5, 'Brand5', 'brand_5.png', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `sessionId` varchar(50) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `shippingAmount` decimal(10,2) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `customerId`, `sessionId`, `total`, `discount`, `paymentMethodId`, `shippingMethodId`, `shippingAmount`, `createdAt`) VALUES
(4, 0, '', '3926.00', '0.00', 10, 0, '0.00', '2021-04-22 15:32:08'),
(5, 0, '', '0.00', '0.00', 0, 0, '0.00', '2021-04-22 15:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `cartAddressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `addressId` int(11) NOT NULL,
  `address_type` tinyint(2) NOT NULL,
  `address` varchar(120) NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `sameAsBilling` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_address`
--

INSERT INTO `cart_address` (`cartAddressId`, `cartId`, `addressId`, `address_type`, `address`, `city`, `state`, `country`, `zipcode`, `sameAsBilling`) VALUES
(1, 2, 0, 1, 'abc', 'Ahmedabad', 'Gujarat', 'India', 380052, 0),
(2, 2, 0, 2, 'def', 'Surat', 'Gujarat', 'India', 380052, 1),
(3, 1, 0, 2, 'ghi', 'Gandhinagar', 'Gujarat', 'India', 380052, 0),
(4, 1, 0, 1, 'jkl', 'Bharuch', 'Gujarat', 'India', 380052, 0),
(5, 3, 0, 2, 'mno', 'Sabarmati', 'Gujarat', 'India', 380050, 0),
(6, 3, 0, 1, 'pqr		    ', 'Ahmedabad', 'Gujarat', 'India', 380052, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cartItemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `basePrice` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cartItemId`, `cartId`, `productId`, `quantity`, `basePrice`, `price`, `discount`, `createdAt`) VALUES
(1, 1, 1, 1, '0.00', '1963.00', '125.00', '2021-04-06 11:03:08'),
(2, 1, 1, 1, '0.00', '1963.00', '125.00', '2021-04-06 11:05:41'),
(3, 1, 1, 1, '0.00', '1963.00', '125.00', '2021-04-07 08:52:50'),
(4, 2, 1, 1, '0.00', '1963.00', '125.00', '2021-04-07 08:56:52'),
(11, 0, 1, 1, '1963.00', '1963.00', '125.00', '2021-04-22 12:02:02'),
(12, 4, 1, 2, '1963.00', '3926.00', '125.00', '2021-04-30 12:27:12');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `description` text NOT NULL,
  `parentId` int(5) NOT NULL,
  `path` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `status`, `description`, `parentId`, `path`) VALUES
(1, 'Bedroom', 1, 'Bedroom', 0, '1'),
(2, 'Living Room', 1, 'Living Room', 0, '2'),
(3, 'Kitchen', 1, 'Kitchen', 0, '3'),
(4, 'Beds', 1, 'Beds', 1, '1-4');

-- --------------------------------------------------------

--
-- Table structure for table `category_media`
--

CREATE TABLE `category_media` (
  `mediaId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `icon` tinyint(4) NOT NULL,
  `base` tinyint(4) NOT NULL,
  `banner` tinyint(4) NOT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cms_table`
--

CREATE TABLE `cms_table` (
  `pageId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `identifier` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_table`
--

INSERT INTO `cms_table` (`pageId`, `title`, `identifier`, `content`, `status`, `createdAt`) VALUES
(1, 'Header', 1, '<b><u><font color=\"#000000\" style=\"background-color: rgb(255, 0, 0);\">Header</font></u></b>', 1, '2021-03-13 16:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `title` varchar(120) NOT NULL,
  `code` varchar(120) NOT NULL,
  `value` varchar(120) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `config_group`
--

CREATE TABLE `config_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config_group`
--

INSERT INTO `config_group` (`groupId`, `name`, `createdAt`) VALUES
(3, 'custom', '2021-04-05 13:14:54'),
(4, 'general', '2021-04-08 11:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` varchar(120) NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  `country` varchar(80) NOT NULL,
  `address_type` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`addressId`, `customerId`, `address`, `city`, `state`, `zipcode`, `country`, `address_type`) VALUES
(1, 3, 'abc', 'Ahmedabad', 'Gujarat', '380052', 'India', '2'),
(2, 3, 'def', 'Surat', 'Gujarat', '380052', 'India', '1'),
(3, 4, 'ghi', 'Gandhinagar', 'Gujarat', '380052', 'India', '2'),
(4, 4, 'jkl', 'Bharuch', 'Gujarat', '380052', 'India', '1'),
(6, 5, 'mno		    ', 'Sabarmati', 'Gujarat', '380052', 'India', '1'),
(7, 28, 'pqr', 'Ahmedabad', 'Gujarat', '380022', 'India', '2'),
(15, 0, 'C-905, Gurukul Park, Gurukul Road, Memnagar, Ahmedabad', 'Guj-Ahmedabad', 'Gujarat', '380052', 'India', '2'),
(16, 0, 'C-905, Gurukul Park, Gurukul Road, Memnagar, Ahmedabad', 'Guj-Ahmedabad', 'Gujarat', '380052', 'India', '1'),
(17, 35, 'C-905, Gurukul Park, Gurukul Road, Memnagar, Ahmedabad', 'Guj-Ahmedabad', 'Gujarat', '380052', 'India', '2'),
(18, 35, 'C-905, Gurukul Park, Gurukul Road, Memnagar, Ahmedabad', 'Guj-Ahmedabad', 'Gujarat', '380052', 'India', '1');

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `customerId` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `passwordhash` varchar(8) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `groupId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`customerId`, `fname`, `lname`, `email`, `passwordhash`, `mobile`, `status`, `createdAt`, `updatedAt`, `groupId`) VALUES
(3, 'Arunshi', 'Gupta', 'arunshigupta@gmail.com', '123', '0951042984', '1', '2021-02-16 20:12:00', '2021-04-30 15:58:34', 2),
(4, 'Maansi', 'Gupta', 'maansigupta30@gmail.com', '456', '9998033119', '1', '2021-02-16 21:50:30', '2021-04-30 15:59:16', 1),
(35, 'abc', 'abc', 'abc@gmail.com', '123', '9998722914', '1', '2021-04-30 16:04:42', '0000-00-00 00:00:00', 3);

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(80) NOT NULL,
  `default_type` tinyint(4) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`groupId`, `name`, `default_type`, `createdAt`) VALUES
(1, 'retail', 0, '2021-03-02 15:29:08'),
(2, 'wholesale', 1, '2021-03-02 15:34:34'),
(3, 'other group', 1, '2021-03-10 22:57:37');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `orderAddressId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `addressId` int(11) NOT NULL,
  `address_type` tinyint(2) NOT NULL,
  `address` varchar(120) NOT NULL,
  `city` varchar(80) NOT NULL,
  `state` varchar(80) NOT NULL,
  `country` varchar(80) NOT NULL,
  `zipcode` int(6) NOT NULL,
  `sameAsBilling` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`orderAddressId`, `orderId`, `addressId`, `address_type`, `address`, `city`, `state`, `country`, `zipcode`, `sameAsBilling`) VALUES
(1, 1, 0, 2, '42, Shiv Shakti Apartments', 'Surat', 'Gujarat', 'India', 380023, 0),
(2, 1, 0, 1, '42, Shiv Shakti Apartments', 'Surat', 'Gujarat', 'India', 380023, 0),
(3, 2, 0, 2, '42, Shiv Shakti Apartments', 'Surat', 'Gujarat', 'India', 380023, 0),
(4, 2, 0, 1, '42, Shiv Shakti Apartments', 'Surat', 'Gujarat', 'India', 380023, 0),
(5, 3, 0, 2, '42, Shiv Shakti Apartments', 'Surat', 'Gujarat', 'India', 380023, 0),
(6, 3, 0, 1, '42, Shiv Shakti Apartments', 'Surat', 'Gujarat', 'India', 380023, 0),
(7, 4, 0, 2, '42, Shiv Shakti Apartments', 'Surat', 'Gujarat', 'India', 380023, 0),
(8, 4, 0, 1, '42, Shiv Shakti Apartments', 'Surat', 'Gujarat', 'India', 380023, 0),
(9, 5, 0, 2, '43, Shiv Shakti Apartments', 'Surat', 'Gujarat', 'India', 380022, 1),
(10, 5, 0, 1, '42, Shiv Shakti Apartments', 'Surat', 'Gujarat', 'India', 380023, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `orderItemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`orderItemId`, `orderId`, `productId`, `quantity`, `price`, `discount`, `createdAt`) VALUES
(1, 1, 3, 1, '1154.29', '120.00', '2021-04-04 19:19:40'),
(2, 1, 6, 1, '1148.40', '125.00', '2021-04-04 19:19:40'),
(3, 1, 7, 1, '1237.62', '130.00', '2021-04-04 19:19:40'),
(4, 2, 3, 1, '1154.29', '120.00', '2021-04-04 19:24:09'),
(5, 2, 6, 1, '1148.40', '125.00', '2021-04-04 19:24:09'),
(6, 2, 7, 1, '1237.62', '130.00', '2021-04-04 19:24:09'),
(7, 3, 3, 1, '1154.29', '120.00', '2021-04-04 19:27:43'),
(8, 3, 6, 1, '1148.40', '125.00', '2021-04-04 19:27:43'),
(9, 3, 7, 1, '1237.62', '130.00', '2021-04-04 19:27:44'),
(10, 4, 3, 1, '1154.29', '120.00', '2021-04-04 20:33:18'),
(11, 4, 6, 1, '1148.40', '125.00', '2021-04-04 20:33:18'),
(12, 4, 7, 1, '1237.62', '130.00', '2021-04-04 20:33:19'),
(13, 5, 1, 1, '1963.00', '125.00', '2021-04-08 14:19:13');

-- --------------------------------------------------------

--
-- Table structure for table `order_table`
--

CREATE TABLE `order_table` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `discount` decimal(5,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `shippingAmount` decimal(10,2) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_table`
--

INSERT INTO `order_table` (`orderId`, `customerId`, `discount`, `total`, `shippingMethodId`, `paymentMethodId`, `shippingAmount`, `createdAt`) VALUES
(1, 3, '0.00', '3540.31', 6, 8, '50.00', '2021-04-04 22:49:40'),
(2, 3, '0.00', '3540.31', 6, 8, '50.00', '2021-04-04 22:54:09'),
(3, 3, '0.00', '3540.31', 6, 8, '50.00', '2021-04-04 22:57:43'),
(4, 3, '0.00', '3540.31', 6, 8, '50.00', '2021-04-05 00:03:17'),
(5, 3, '0.00', '1963.00', 8, 8, '70.00', '2021-04-08 17:49:13'),
(6, 1, '999.99', '10000.00', 1, 1, '15325.00', '2021-05-04 09:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `paymentMethodId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(60) NOT NULL,
  `description` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`paymentMethodId`, `name`, `code`, `description`, `status`, `createdAt`) VALUES
(7, 'Credit Card', 'creditecard1', 'For paying using credit card', '1', '2021-03-27 15:20:45'),
(8, 'Debit Card', 'debitcard2', 'For paying using debit card', '1', '2021-03-27 15:27:09'),
(10, 'Cash On Delivery', 'cod4', 'For paying cash after receiving the order  ', '1', '2021-03-27 09:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `sku` varchar(20) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `quantity` varchar(5) NOT NULL,
  `description` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedAt` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `sku`, `price`, `discount`, `quantity`, `description`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'Product 1', '#1722', '1000.00', '100.00', '1', 'Product 1', '1', '2021-05-03 09:05:03', '2021-05-03 09:47:21'),
(2, 'Product 2', '#857', '46437.00', '235.00', '1', 'Product 2', '1', '2021-05-03 09:05:03', '2021-05-03 09:05:03'),
(3, 'Product 3', '#9865', '95743.00', '436.00', '5', 'Product 3', '1', '2021-05-03 09:05:03', '2021-05-03 15:36:43'),
(4, 'Product 4', '#5986', '216426.00', '8456.00', '10', 'Product 4', '1', '2021-05-03 09:05:03', '2021-05-03 09:05:03'),
(5, 'Product 5', '#9457', '12497.00', '907.00', '5', 'Product 5', '1', '2021-05-03 09:05:03', '2021-05-03 09:05:03'),
(6, 'Product 6', '#0968', '5785.00', '100.00', '20', 'Product 6', '1', '2021-05-03 09:05:03', '2021-05-03 09:05:03'),
(7, 'Product 7', '#87567', '59683.00', '8756.00', '5', 'Product 7', '1', '2021-05-03 09:05:03', '2021-05-03 09:05:03'),
(8, 'Product 8', '#5876', '783587.00', '9483.00', '10', 'Product 8', '1', '2021-05-03 09:05:03', '2021-05-03 09:05:03'),
(9, 'Product 9', '#85622', '10000.00', '100.00', '1', 'Product 9', '1', '2021-05-03 09:05:03', '2021-05-03 09:05:03'),
(10, 'Product 10', '#59876', '99999.00', '999.00', '2', 'Product 10', '1', '2021-05-03 09:05:03', '2021-05-03 09:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `productId`, `categoryId`) VALUES
(10, 1, 1),
(11, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_group_price`
--

CREATE TABLE `product_group_price` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customerGroupId` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_group_price`
--

INSERT INTO `product_group_price` (`entityId`, `productId`, `customerGroupId`, `price`) VALUES
(1, 1, 1, '100.00'),
(2, 1, 2, '101.00'),
(3, 1, 3, '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `mediaId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `label` varchar(50) NOT NULL,
  `small` tinyint(2) NOT NULL,
  `thumb` tinyint(2) NOT NULL,
  `base` tinyint(2) NOT NULL,
  `gallery` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_methods`
--

CREATE TABLE `shipping_methods` (
  `shippingMethodId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(60) NOT NULL,
  `amount` varchar(6) NOT NULL,
  `description` varchar(150) NOT NULL,
  `status` varchar(20) NOT NULL,
  `createdAt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_methods`
--

INSERT INTO `shipping_methods` (`shippingMethodId`, `name`, `code`, `amount`, `description`, `status`, `createdAt`) VALUES
(5, 'Express Delivery', 'expressdelivery1', '100', '1 Day ', '1', '2021-03-27 15:18:14'),
(6, 'Platinum Delivery', 'platinumdelivery3', '50', '3 Days', '1', '2021-03-27 15:19:09'),
(7, 'Free delivery', 'freedelivery', '0', '7 days ', '1', '2021-03-27 15:20:00'),
(8, 'Gold Delivery', 'goldelivery2day', '70', '2 Days', '1', '2021-03-31 09:06:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeId` (`attributeId`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`cartAddressId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cartItemId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `category_media`
--
ALTER TABLE `category_media`
  ADD PRIMARY KEY (`mediaId`);

--
-- Indexes for table `cms_table`
--
ALTER TABLE `cms_table`
  ADD PRIMARY KEY (`pageId`),
  ADD UNIQUE KEY `identifier` (`identifier`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `config_group`
--
ALTER TABLE `config_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`addressId`);

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`orderAddressId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`orderItemId`);

--
-- Indexes for table `order_table`
--
ALTER TABLE `order_table`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`paymentMethodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoryId` (`categoryId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD PRIMARY KEY (`entityId`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`mediaId`);

--
-- Indexes for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  ADD PRIMARY KEY (`shippingMethodId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attribute_option`
--
ALTER TABLE `attribute_option`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `category_media`
--
ALTER TABLE `category_media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cms_table`
--
ALTER TABLE `cms_table`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `config_group`
--
ALTER TABLE `config_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `customer_details`
--
ALTER TABLE `customer_details`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `orderAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_table`
--
ALTER TABLE `order_table`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `paymentMethodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=636;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_group_price`
--
ALTER TABLE `product_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `mediaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `shipping_methods`
--
ALTER TABLE `shipping_methods`
  MODIFY `shippingMethodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD CONSTRAINT `attribute_option_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
