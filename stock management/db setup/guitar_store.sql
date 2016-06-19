-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 29, 2016 at 02:04 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `guitar_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `guitar`
--

CREATE TABLE IF NOT EXISTS `guitar` (
  `guitar_id` int(4) NOT NULL DEFAULT '0',
  `image_location` varchar(150) DEFAULT NULL,
  `brand` varchar(20) DEFAULT 'Aria',
  `model` varchar(10) DEFAULT NULL,
  `marked_price` int(6) DEFAULT NULL,
  PRIMARY KEY (`guitar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guitar`
--

INSERT INTO `guitar` (`guitar_id`, `image_location`, `brand`, `model`, `marked_price`) VALUES
(1, 'images/guitar1', 'Givson', 'Venus rose', 6500),
(2, 'images/guitar2', 'Aria', 'X22X89', 22000),
(3, 'images/guitar3', 'Aria', 'Country cl', 27000),
(4, 'images/guitar4', 'A', 'The dirnt', 32000);

-- --------------------------------------------------------

--
-- Table structure for table `guitar_purchase`
--

CREATE TABLE IF NOT EXISTS `guitar_purchase` (
  `order_id` int(5) NOT NULL DEFAULT '0',
  `guitar_id` int(4) NOT NULL DEFAULT '0',
  `colour` varchar(15) NOT NULL DEFAULT '',
  `make` date DEFAULT NULL,
  `quantity` int(3) DEFAULT NULL,
  PRIMARY KEY (`order_id`,`guitar_id`,`colour`),
  KEY `guiter_purchase_fk1` (`guitar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guitar_purchase`
--

INSERT INTO `guitar_purchase` (`order_id`, `guitar_id`, `colour`, `make`, `quantity`) VALUES
(1, 1, 'Red', '2016-01-01', 100),
(1, 1, 'Wine', '2015-05-16', 100),
(2, 2, 'navy blue', '2015-01-01', 2),
(3, 3, 'Wine red', '2016-03-15', 10),
(3, 4, 'Brown', '2016-03-15', 150);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `order_id` int(5) NOT NULL DEFAULT '0',
  `supplier_id` int(3) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `purchase_fk` (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`order_id`, `supplier_id`, `purchase_date`, `delivery_date`) VALUES
(1, 1, '2016-04-08', '2016-04-10'),
(2, 1, '2016-01-01', '2016-01-05'),
(3, 3, '2016-03-15', '2016-04-01');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE IF NOT EXISTS `stock` (
  `guitar_id` int(4) NOT NULL DEFAULT '0',
  `colour` varchar(15) NOT NULL DEFAULT '',
  `quantity` int(3) DEFAULT NULL,
  PRIMARY KEY (`guitar_id`,`colour`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`guitar_id`, `colour`, `quantity`) VALUES
(1, 'Red', 100),
(1, 'Wine', 100),
(2, 'navy blue', 2),
(3, 'Wine red', 150),
(4, 'Brown', 150);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(3) NOT NULL DEFAULT '0',
  `company_name` varchar(30) DEFAULT NULL,
  `country` varchar(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `phone` bigint(15) DEFAULT NULL,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `company_name`, `country`, `email`, `phone`) VALUES
(1, 'Aria Sellers', 'USA', 'purchase@ariasellers.com', 61414463),
(2, 'Mexico guitars', 'Mexico', 'purchase@ariasellers.com', 1234567),
(3, 'Music mash', 'India', 'purchase@ariasellers.com', 987),
(4, 'Welcome to paradise', 'China', 'purchase@ariasellers.com', 12357),
(5, 'Whole Sellers', 'South Korea', 'purchase@ariasellers.com', 6545765),
(6, 'Retail Sellers', 'Russia', 'purchase@ariasellers.com', 6545678765),
(7, 'Givisini', 'North Korea', 'purchase@ariasellers.com', 345676543),
(8, 'Armstrong stop', 'UK', 'purchase@ariasellers.com', 8765476),
(9, 'Tre cool', 'Finland', 'purchase@ariasellers.com', 456776);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(2) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `forename` varchar(30) DEFAULT NULL,
  `surname` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `forename`, `surname`, `password`, `role`) VALUES
(1, 'sirjan', 'Sirjan', 'Sharma', 'owner', 'OWNER'),
(2, 'cumberbatch', 'Benedict', 'Cumberbatch', 'staff', 'warehouse staff'),
(3, 'raja', 'Raja', 'Rasila', 'raja', 'warehouse staff');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `guitar_purchase`
--
ALTER TABLE `guitar_purchase`
  ADD CONSTRAINT `guiter_purchase_fk` FOREIGN KEY (`order_id`) REFERENCES `purchase` (`order_id`),
  ADD CONSTRAINT `guiter_purchase_fk1` FOREIGN KEY (`guitar_id`) REFERENCES `guitar` (`guitar_id`);

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_fk` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`supplier_id`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_fk` FOREIGN KEY (`guitar_id`) REFERENCES `guitar` (`guitar_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
