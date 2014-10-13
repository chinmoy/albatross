-- phpMyAdmin SQL Dump
-- version 2.11.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 09, 2014 at 10:12 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `albatross`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `catId` int(11) NOT NULL auto_increment,
  `cat` varchar(255) NOT NULL,
  `odr` int(11) NOT NULL,
  PRIMARY KEY  (`catId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`catId`, `cat`, `odr`) VALUES
(1, 'test', 1),
(2, 'test1', 0),
(5, 'CLI', 0);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `clientId` int(11) NOT NULL auto_increment,
  `client_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` tinytext NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY  (`clientId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clientId`, `client_name`, `address`, `email`, `phone`) VALUES
(1, 'test', '<p>aajjkjsb</p>\r\n<p>bkjfhkjlkj</p>\r\n<p>jhnkjnjnk</p>', 'a@a.com', '01818402122'),
(2, 'b', 'bb', 'bbb', '222'),
(3, 'c', '<p>ccjjjj</p>', 'ccc', '333');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rateId` int(11) NOT NULL auto_increment,
  `destination_name` varchar(255) NOT NULL,
  `country_code` varchar(25) NOT NULL,
  `area_code` varchar(25) NOT NULL,
  `rate` float NOT NULL,
  `effective_date` date NOT NULL,
  `previous_rate` float NOT NULL,
  `previous_effective_date` date NOT NULL,
  `client_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `seltype` int(11) NOT NULL,
  `tech_prefix` varchar(15) NOT NULL,
  `billing_increment` varchar(55) NOT NULL,
  `status` varchar(55) NOT NULL,
  PRIMARY KEY  (`rateId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rateId`, `destination_name`, `country_code`, `area_code`, `rate`, `effective_date`, `previous_rate`, `previous_effective_date`, `client_id`, `vendor_id`, `category`, `seltype`, `tech_prefix`, `billing_increment`, `status`) VALUES
(1, '2', '5', '', 4.6, '2014-09-21', 4, '2014-09-26', -1, -1, 0, 0, '', '', ''),
(2, 'dhaka ', 'bn', '', 7.6, '2014-09-21', 7.6, '2014-09-24', 2, 1, 1, 0, '', '', ''),
(3, 'dhaka ', 'bn', '', 7.6, '2014-09-24', 0, '0000-00-00', 2, 1, 0, 0, '', '', ''),
(4, '2', '5', '', 4, '2014-09-23', 0, '0000-00-00', 3, 1, 0, 0, '', '', ''),
(5, '2', '5', '', 4, '2014-09-23', 4, '2014-09-23', 3, 1, 2, 0, '', '', ''),
(6, 'ee', 'rr', 'rr', 5, '2014-09-21', 5, '2014-09-21', 3, 2, 1, 2, '', '', ''),
(7, '2', '5', '3', 4, '2014-09-21', 4, '2014-09-21', 2, -1, 1, 1, '', '', ''),
(8, 'India CLI', '91', '1', 0.0081, '0000-00-00', 0, '0000-00-00', -1, 1, 4, 2, '00#522', '1/1', 'Decreased'),
(9, 'India CLI', '91', '1', 0.0081, '0000-00-00', 0, '0000-00-00', -1, 1, 5, 2, '00#522', '1/1', 'Decreased'),
(10, 'India CLI', '912', '12', 0.0081, '1970-01-01', 0.0081, '0000-00-00', -1, 1, 5, 2, '00#5222', '1/12', 'Decreased'),
(11, '1', '3', '4', 2, '2014-10-06', 0, '0000-00-00', 1, -1, 5, 1, '5', '6', 'Decreased'),
(12, 'India CLI', '91', '1', 0.0081, '1970-01-01', 0, '0000-00-00', -1, 2, 5, 2, '00#522', '1/1', 'Decreased'),
(13, 'India CLI', '91', '1', 0.0081, '1970-01-01', 0, '0000-00-00', -1, 1, 5, 2, '00#522', '1/1', 'Decreased');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `Id` int(11) NOT NULL auto_increment,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`Id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorId` int(11) NOT NULL auto_increment,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY  (`vendorId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `vendor_name`, `vendor_address`, `email`, `phone`) VALUES
(1, 'thakral', '<p>dhaka</p>', 'qq', 'www'),
(2, 'business automation', '<p>dhaka</p>', '', ''),
(3, 'a', 'aajjkjsb \nbkjfhkjlkj\njhnkjnjnk', 'aaa', '111'),
(4, 'b', 'bb', 'bbb', '222'),
(5, 'c', 'cc', 'ccc', '333'),
(6, 'd', 'dd', 'ddd', '444'),
(7, 'e', 'ee', 'eee', '555');
