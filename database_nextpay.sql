-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Oct 31, 2016 at 11:55 AM
-- Server version: 5.6.33
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `nextpayi_whmcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblpaymentgateways`
--

CREATE TABLE IF NOT EXISTS `tblpaymentgateways` (
  `gateway` text NOT NULL,
  `setting` text NOT NULL,
  `value` text NOT NULL,
  `order` int(1) NOT NULL,
  KEY `gateway_setting` (`gateway`(32),`setting`(32)),
  KEY `setting_value` (`setting`(32),`value`(32))
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblpaymentgateways`
--

INSERT INTO `tblpaymentgateways` (`gateway`, `setting`, `value`, `order`) VALUES
('nextpay', 'name', 'درگاه پرداخت - nextpay', 4),
('nextpay', 'api_key', '', 0),
('nextpay', 'visible', 'on', 0),
('nextpay', 'type', 'invoices', 0),
('nextpay', 'Currencies', 'Toman', 0),
('nextpay', 'convertto', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
