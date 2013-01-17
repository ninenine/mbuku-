-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 18, 2012 at 06:00 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mbuku_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `acc_type` int(4) NOT NULL,
  `status` int(1) NOT NULL,
  `datecreated` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `name`, `acc_type`, `status`, `datecreated`) VALUES
(1, 'Mandazi food', 2, 1, 1334748419),
(2, 'Kiatu shoes', 2, 0, 1334748419),
(3, 'some some', 1, 1, 1334752038);

-- --------------------------------------------------------

--
-- Table structure for table `acc_data`
--

CREATE TABLE IF NOT EXISTS `acc_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `field` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `acc_trans`
--

CREATE TABLE IF NOT EXISTS `acc_trans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) NOT NULL,
  `ammount` decimal(20,2) NOT NULL,
  `datemade` int(10) NOT NULL,
  `note` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `acc_type`
--

CREATE TABLE IF NOT EXISTS `acc_type` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `acc_type`
--

INSERT INTO `acc_type` (`id`, `type`) VALUES
(1, 'Client'),
(2, 'Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `type` int(4) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `datecreated` int(10) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `type`, `price`, `datecreated`, `description`) VALUES
(1, 'Sample Product 1', 1, 100.00, 1334760381, 'some some'),
(2, 'Sample Product 2', 2, 20000.00, 1334760417, 'kelelele');

-- --------------------------------------------------------

--
-- Table structure for table `prod_type`
--

CREATE TABLE IF NOT EXISTS `prod_type` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `prod_type`
--

INSERT INTO `prod_type` (`id`, `type`) VALUES
(1, 'type1'),
(2, 'type2');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `trans_type` int(4) NOT NULL,
  `status` int(1) NOT NULL,
  `ammount` decimal(20,2) NOT NULL,
  `datecreated` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uname` varchar(40) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `fullname` varchar(128) NOT NULL,
  `status` int(1) NOT NULL,
  `role` int(4) NOT NULL,
  `isonline` int(1) NOT NULL DEFAULT '0',
  `lastlogin` int(10) DEFAULT NULL,
  `datecreated` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `pass`, `fullname`, `status`, `role`, `isonline`, `lastlogin`, `datecreated`) VALUES
(1, 'root', '1a1dc91c907325c69271ddf0c944bc72', 'Davis Wainaina', 1, 1, 1, 1334746636, 1333479460),
(5, 'jkamau', '1a1dc91c907325c69271ddf0c944bc72', 'James Kamau', 1, 3, 1, 1334079988, 1334079883);

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE IF NOT EXISTS `user_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `field` varchar(50) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE IF NOT EXISTS `user_role` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`id`, `type`) VALUES
(1, 'Developer'),
(2, 'Administrator'),
(3, 'User');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
