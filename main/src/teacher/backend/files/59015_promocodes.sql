-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: master.maindb.123rf.prv
-- Generation Time: Jun 08, 2023 at 01:59 AM
-- Server version: 5.7.28-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `123rf`
--

-- --------------------------------------------------------

--
-- Table structure for table `promocodes`
--

CREATE TABLE IF NOT EXISTS `promocodes` (
  `id` int(7) NOT NULL,
  `promocode` varchar(20) NOT NULL,
  `type` varchar(1) NOT NULL,
  `start_date` date NOT NULL,
  `expiry_date` date NOT NULL DEFAULT '0000-00-00',
  `discount` int(3) NOT NULL,
  `country` varchar(500) NOT NULL,
  `minvalue` decimal(7,2) NOT NULL,
  `package_type` text NOT NULL,
  `pricediscount` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0- no price cut; 1-price cut instead of extra credits',
  `promocode_generator_id` int(11) NOT NULL,
  `is_affiliate` tinyint(1) NOT NULL COMMENT 'affiliate use',
  `multiple_use` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=17637 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPRESSED;

--
-- Dumping data for table `promocodes`
--

INSERT INTO `promocodes` (`id`, `promocode`, `type`, `start_date`, `expiry_date`, `discount`, `country`, `minvalue`, `package_type`, `pricediscount`, `promocode_generator_id`, `is_affiliate`, `multiple_use`) VALUES
(16125, 'free10', 's', '2020-01-03', '2030-01-03', 100, 'US', 0.00, 'petite1', 0, 0, 0, 0),
(17630, 'free10', 's', '2020-01-03', '2030-01-03', 100, 'CA', 0.00, 'petite1', 0, 0, 0, 0),
(17631, 'free10', 's', '2020-01-03', '2030-01-03', 100, 'IE', 0.00, 'petite1', 0, 0, 0, 0),
(17632, 'free10', 's', '2020-01-03', '2030-01-03', 100, 'AU', 0.00, 'petite1', 0, 0, 0, 0),
(17633, 'free10', 's', '2020-01-03', '2030-01-03', 100, 'NZ', 0.00, 'petite1', 0, 0, 0, 0),
(17634, 'free10', 's', '2020-01-03', '2030-01-03', 100, 'IS', 0.00, 'petite1', 0, 0, 0, 0),
(17635, 'free10', 's', '2020-01-03', '2030-01-03', 100, 'NO', 0.00, 'petite1', 0, 0, 0, 0),
(17636, 'free10', 's', '2020-01-03', '2030-01-03', 100, 'LU', 0.00, 'petite1', 0, 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `promocodes`
--
ALTER TABLE `promocodes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `promocode` (`promocode`,`type`,`expiry_date`),
  ADD KEY `discount` (`discount`),
  ADD KEY `country` (`country`),
  ADD KEY `promocode_generator_id` (`promocode_generator_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `promocodes`
--
ALTER TABLE `promocodes`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17637;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
