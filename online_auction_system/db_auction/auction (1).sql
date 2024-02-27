-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 10, 2023 at 04:59 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `auction`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction_seller_registration`
--

CREATE TABLE IF NOT EXISTS `auction_seller_registration` (
  `seller_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`seller_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `auction_seller_registration`
--

INSERT INTO `auction_seller_registration` (`seller_id`, `first_name`, `phone_number`, `email`, `password`, `address`) VALUES
(1, 'sijo', '8089123455', 'sijo@gmail.com', '787898', 'kochi'),
(21, 'binu', '8089123457', 'binu@gmail.com', '123456', 'kochi');

-- --------------------------------------------------------

--
-- Table structure for table `bidtable`
--

CREATE TABLE IF NOT EXISTS `bidtable` (
  `bid` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` varchar(10) NOT NULL,
  `p_id` varchar(10) NOT NULL,
  `rate` varchar(30) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`bid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `bidtable`
--

INSERT INTO `bidtable` (`bid`, `u_id`, `p_id`, `rate`, `status`) VALUES
(6, '2', '1', '2050', ''),
(7, '2', '1', '2025', ''),
(8, '2', '1', '2051', 'Paid'),
(9, '2', '1', '2040', '');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE IF NOT EXISTS `chat_messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_text` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` varchar(15) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`message_id`, `sender_id`, `receiver_id`, `message_text`, `timestamp`, `type`) VALUES
(37, 21, 2, 'halo', '2023-10-31 15:52:42', 'seller'),
(38, 2, 3, 'hai sijo', '2023-11-10 09:32:21', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `lid` int(11) NOT NULL AUTO_INCREMENT,
  `reg_id` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `l_type` varchar(100) NOT NULL,
  `l_status` varchar(255) DEFAULT 'pending',
  PRIMARY KEY (`lid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`lid`, `reg_id`, `username`, `password`, `l_type`, `l_status`) VALUES
(1, 0, 'admin', 'admin', 'admin', 'approved'),
(2, 2, 'crispy@gmail.com', '787898', 'user', 'approved'),
(3, 1, 'sijo@gmail.com', '787898', 'seller', 'approved'),
(4, 3, 'ak@gmail.com', '123456', 'user', 'approved'),
(7, 21, 'binu@gmail.com', '123456', 'seller', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` varchar(15) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `date` varchar(20) NOT NULL DEFAULT 'not declared',
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `sid`, `product_name`, `brand`, `image`, `description`, `price`, `date`) VALUES
(1, '1', 'Asian Antique Sandstone Sandstone Female Head ', 'sand stone', 'item1.jpg', 'Elegant Medieval sandstone sculpture female head from North India in an 11th century style of temples in the region of Madhya Pradesh. H 25 cm (10in.). Reference: The Art of India, by Calambur Sivaramamurti', '2023.00', 'Sold'),
(2, '1', 'GIRL ON CAROUSEL DOUBLE SIDED', 'Brush and ink and wash on paper', 'item2.JPG', 'Beautiful art piece. Unknown date', '1500.00', '2023-10-06'),
(3, '1', 'Zodiac dragon head,', 'bronze', 'item3.jpg', ' A bronze dragon head, one of the six missing heads from Beijingâ€™s Old Summer Palace â€œZodiac Clockâ€ fountain', '10000.00', 'not declared'),
(4, '21', 'dragon', 'bronze', 'cz1.jpg', 'very old ring ', '2023.00', 'not declared'),
(5, '21', 'magic lamp of alladin', 'bronze', 'Aladdin_Lamp.jpg', 'magic lamp during 400bc', '2023.00', 'not declared');

-- --------------------------------------------------------

--
-- Table structure for table `user_registration`
--

CREATE TABLE IF NOT EXISTS `user_registration` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_registration`
--

INSERT INTO `user_registration` (`user_id`, `first_name`, `phone_number`, `email`, `password`, `address`) VALUES
(2, 'crispy', '8089784512', 'crispy@gmail.com', '787898', 'kochi'),
(3, 'akshara', '8089123457', 'ak@gmail.com', '123456', 'kochi');
