-- phpMyAdmin SQL Dump
-- version 4.0.10.16
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2016 at 07:54 AM
-- Server version: 5.5.46
-- PHP Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vbcl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE IF NOT EXISTS `admin_details` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email_id` varchar(100) NOT NULL,
  `primary_phone_number` varchar(13) NOT NULL,
  `secondary_phone_number` varchar(13) DEFAULT NULL,
  `role` varchar(10) NOT NULL,
  `is_enable` tinyint(1) NOT NULL,
  `product_line` varchar(250) DEFAULT NULL,
  `city` varchar(250) DEFAULT NULL,
  `stores` varchar(250) DEFAULT NULL,
  `image_url` varchar(1000) DEFAULT NULL,
  `image_thumbnail_url` varchar(1000) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(50) DEFAULT NULL,
  `valid_through` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `api_key` varchar(20) NOT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`admin_id`, `username`, `password`, `firstname`, `lastname`, `email_id`, `primary_phone_number`, `secondary_phone_number`, `role`, `is_enable`, `product_line`, `city`, `stores`, `image_url`, `image_thumbnail_url`, `created_on`, `created_by`, `updated_on`, `updated_by`, `valid_through`, `api_key`) VALUES
(1, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'Main', 'Administrator', 'pranita.s@lastlocal.in', '0000000000', '9999999999', 'admin', 1, 'all', '24', 'all', NULL, NULL, '2016-03-03 15:06:48', 'admin', '2016-03-03 15:06:48', 'admin', '2026-03-03 15:06:48', '0b3fefd82befab2c86a3'),
(2, 'neha', '5f4dcc3b5aa765d61d8327deb882cf99', 'neha', '', 'neha.m@lastlocal.in', '9930995285', '', 'rejected', 0, NULL, '2', NULL, NULL, NULL, '2016-03-08 16:09:23', 'neha', '2016-03-08 16:11:54', '2016-08-19 14:44:11', '2016-03-28 00:00:00', ''),
(3, 'vinitdhadda', '5f4dcc3b5aa765d61d8327deb882cf99', 'Vinit', 'Dhadda', 'dhadda@lastlocal.in', '9833115252', '', 'admin', 1, NULL, '2', NULL, NULL, NULL, '2016-07-15 05:16:05', 'vinitdhadda', '2016-07-15 05:16:24', 'admin', '2016-08-03 18:30:00', ''),
(4, 'pankajcse1983', '0dca848ac33d5e39441ed3fe0c9815a9', 'pankaj', 'gupta', 'pankajcse1983@gmail.com', '9702558122', '', 'admin', 1, NULL, '2', NULL, NULL, NULL, '2016-08-10 10:19:13', 'pankajcse1983', '0000-00-00 00:00:00', 'pankajcse1983', '2016-08-31 00:00:00', '3787b81beca825d17807'),
(5, 'mach.neha@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Neha', 'M', 'mach.neha@gmail.com', '9865321470', '', 'admin', 1, NULL, '10', NULL, NULL, NULL, '2016-08-19 09:15:01', 'mach.neha@gmail.com', '0000-00-00 00:00:00', '2016-08-19 14:46:34', '0000-00-00 00:00:00', '9558181d04f3837e05b7');

-- --------------------------------------------------------

--
-- Stand-in structure for view `atr_table`
--
CREATE TABLE IF NOT EXISTS `atr_table` (
`name` varchar(100)
,`value` varchar(100)
,`id` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE IF NOT EXISTS `attribute` (
  `attribute_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_name` varchar(100) NOT NULL,
  `attribute_type` varchar(100) DEFAULT NULL,
  `sort_order` int(10) unsigned DEFAULT NULL,
  `attribute_header` varchar(100) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`attribute_id`),
  UNIQUE KEY `attribute_name` (`attribute_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attribute_id`, `attribute_name`, `attribute_type`, `sort_order`, `attribute_header`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(34, 'Product name', 'GENERAL', 1, 'PRODUCT DETAILS', '2016-07-28 07:11:00', 'EXCEL', '2016-10-12 13:40:20', 'admin'),
(35, 'Price', 'GENERAL', 8, 'PRODUCT DETAILS', '2016-07-28 07:11:00', 'EXCEL', '2016-08-19 15:13:50', 'admin'),
(37, 'Description', 'GENERAL', 9, 'PRODUCT DETAILS', '2016-07-28 07:11:00', 'EXCEL', '2016-09-20 15:34:14', 'admin'),
(38, 'Material', 'GENERAL', 7, 'PRODUCT DETAILS', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha'),
(39, 'Brand', 'GENERAL', 5, 'PRODUCT DETAILS', '2016-07-28 07:11:00', 'EXCEL', '2016-09-20 15:33:37', 'admin'),
(40, 'Size', 'GENERAL', 4, 'PRODUCT DETAILS', '2016-08-29 16:21:36', NULL, '2016-09-20 15:33:52', 'admin'),
(41, 'Code', 'GENERAL', 2, 'PRODUCT DETAILS', '2016-08-29 16:21:36', NULL, '2016-10-12 13:40:01', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value`
--

CREATE TABLE IF NOT EXISTS `attribute_value` (
  `attribute_value_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `attribute_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `attribute_value` varchar(100) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  PRIMARY KEY (`attribute_value_id`),
  UNIQUE KEY `atrtibute_id_product` (`attribute_id`,`product_id`),
  KEY `fk_attribute_value_product` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18701 ;

--
-- Dumping data for table `attribute_value`
--

INSERT INTO `attribute_value` (`attribute_value_id`, `attribute_id`, `product_id`, `attribute_value`, `updated_by`, `updated_on`) VALUES
(17480, 34, NULL, '', 'admin', '2016-10-24 18:28:16'),
(17481, 35, NULL, '', 'admin', '2016-10-24 18:28:16'),
(17483, 37, NULL, '', 'admin', '2016-10-24 18:28:16'),
(17484, 38, NULL, '', 'admin', '2016-08-19 15:33:50'),
(17485, 39, NULL, '', 'admin', '2016-10-24 18:28:16'),
(17702, 39, 2823, 'Aquant', 'admin', '2016-09-01 15:05:18'),
(17703, 34, 2823, 'Wall-hung Basin', 'admin', '2016-09-01 15:05:18'),
(17704, 40, 2823, '410 x 270 x 140 mm', 'admin', '2016-09-01 15:05:18'),
(17705, 41, 2823, '1519L', 'admin', '2016-09-01 15:05:18'),
(17706, 37, 2823, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-09-01 15:05:18'),
(17708, 39, 2824, 'Aquant', 'admin', '2016-09-01 15:05:18'),
(17709, 34, 2824, 'Wall-hung Basin', 'admin', '2016-09-01 15:05:18'),
(17710, 40, 2824, '410 x 270 x 140 mm', 'admin', '2016-09-01 15:05:18'),
(17711, 41, 2824, '1520R', 'admin', '2016-09-01 15:05:18'),
(17712, 37, 2824, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-09-01 15:05:18'),
(17714, 39, 2825, 'Aquant', 'admin', '2016-09-01 15:05:18'),
(17715, 34, 2825, 'Artistic Basin', 'admin', '2016-09-01 15:05:18'),
(17716, 40, 2825, '410 x 410 x 123 mm', 'admin', '2016-09-01 15:05:18'),
(17717, 41, 2825, '1521', 'admin', '2016-09-01 15:05:18'),
(17718, 37, 2825, 'Table Mounted Wash Basin', 'admin', '2016-09-01 15:05:18'),
(17720, 39, 2826, 'Aquant', 'admin', '2016-09-01 15:05:18'),
(17721, 34, 2826, 'Artistic Basin', 'admin', '2016-09-01 15:05:18'),
(17722, 40, 2826, '460 x 160 mm', 'admin', '2016-09-01 15:05:18'),
(17723, 41, 2826, '1526', 'admin', '2016-09-01 15:05:18'),
(17724, 37, 2826, 'Table Mounted Wash Basin', 'admin', '2016-09-01 15:05:18'),
(17726, 39, 2827, 'Aquant', 'admin', '2016-09-01 15:05:18'),
(17727, 34, 2827, 'Wall-hung Basin', 'admin', '2016-09-01 15:05:18'),
(17728, 40, 2827, '330 x 295 x 125 mm', 'admin', '2016-09-01 15:05:18'),
(17729, 41, 2827, '1537', 'admin', '2016-09-01 15:05:18'),
(17730, 37, 2827, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-09-01 15:05:18'),
(17732, 39, 2828, 'Aquant', 'admin', '2016-09-01 15:05:18'),
(17733, 34, 2828, 'Artistic Basin', 'admin', '2016-09-01 15:05:18'),
(17734, 40, 2828, '480 x 370 x 130 mm', 'admin', '2016-09-01 15:05:18'),
(17735, 41, 2828, '1539', 'admin', '2016-09-01 15:05:18'),
(17736, 37, 2828, 'Table Mounted Wash Basin', 'admin', '2016-09-01 15:05:18'),
(17738, 39, 2829, 'Aquant', 'admin', '2016-09-01 15:05:19'),
(17739, 34, 2829, 'Artistic Basin', 'admin', '2016-09-01 15:05:19'),
(17740, 40, 2829, '550 x 450 x 150 mm ', 'admin', '2016-09-01 15:05:19'),
(17741, 41, 2829, '1554', 'admin', '2016-09-01 15:05:19'),
(17742, 37, 2829, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-09-01 15:05:19'),
(17744, 39, 2830, 'Aquant', 'admin', '2016-09-01 15:05:19'),
(17745, 34, 2830, 'Wall-hung Basin', 'admin', '2016-09-01 15:05:19'),
(17746, 40, 2830, '390 x 305 x 120 mm', 'admin', '2016-09-01 15:05:19'),
(17747, 41, 2830, '1555', 'admin', '2016-09-01 15:05:19'),
(17748, 37, 2830, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-09-01 15:05:19'),
(17750, 39, 2831, 'Aquant', 'admin', '2016-09-01 15:05:19'),
(17751, 34, 2831, 'Artistic Basin', 'admin', '2016-09-01 15:05:19'),
(17752, 40, 2831, '460 x 395 x 150 mm', 'admin', '2016-09-01 15:05:19'),
(17753, 41, 2831, '1556', 'admin', '2016-09-01 15:05:19'),
(17754, 37, 2831, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-09-01 15:05:19'),
(17756, 39, 2832, 'Aquant', 'admin', '2016-09-01 15:05:19'),
(17757, 34, 2832, 'Artistic Basin', 'admin', '2016-09-01 15:05:19'),
(17758, 40, 2832, '460 x 310 x 130 mm', 'admin', '2016-09-01 15:05:19'),
(17759, 41, 2832, '1564', 'admin', '2016-09-01 15:05:19'),
(17760, 37, 2832, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-09-01 15:05:19'),
(17762, 39, 2833, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17763, 34, 2833, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17764, 40, 2833, '610 x 390 x 130 mm', 'admin', '2016-10-24 18:28:07'),
(17765, 41, 2833, '1582', 'admin', '2016-10-24 18:28:07'),
(17766, 37, 2833, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17768, 39, 2834, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17769, 34, 2834, 'Wall-hung Basin', 'admin', '2016-10-24 18:28:07'),
(17770, 40, 2834, '440 x 365 x 150 mm', 'admin', '2016-10-24 18:28:07'),
(17771, 41, 2834, '1587', 'admin', '2016-10-24 18:28:07'),
(17772, 37, 2834, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17774, 39, 2835, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17775, 34, 2835, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17776, 40, 2835, '500 x 360 x 140 mm', 'admin', '2016-10-24 18:28:07'),
(17777, 41, 2835, '1594', 'admin', '2016-10-24 18:28:07'),
(17778, 37, 2835, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17780, 39, 2836, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17781, 34, 2836, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17782, 40, 2836, '810 x 465 x 115 mm', 'admin', '2016-10-24 18:28:07'),
(17783, 41, 2836, '1601', 'admin', '2016-10-24 18:28:07'),
(17784, 37, 2836, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17786, 39, 2837, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17787, 34, 2837, 'Wall-hung Basin', 'admin', '2016-10-24 18:28:07'),
(17788, 40, 2837, '440 x 430 x 150 mm', 'admin', '2016-10-24 18:28:07'),
(17789, 41, 2837, '1602', 'admin', '2016-10-24 18:28:07'),
(17790, 37, 2837, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17792, 39, 2838, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17793, 34, 2838, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17794, 40, 2838, '280 x 100 mm', 'admin', '2016-10-24 18:28:07'),
(17795, 41, 2838, '1603', 'admin', '2016-10-24 18:28:07'),
(17796, 37, 2838, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17798, 39, 2839, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17799, 34, 2839, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17800, 40, 2839, '405 x 330 x 130 mm', 'admin', '2016-10-24 18:28:07'),
(17801, 41, 2839, '1604', 'admin', '2016-10-24 18:28:07'),
(17802, 37, 2839, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17804, 39, 2840, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17805, 34, 2840, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17806, 40, 2840, '410 x 160 mm', 'admin', '2016-10-24 18:28:07'),
(17807, 41, 2840, '1605', 'admin', '2016-10-24 18:28:07'),
(17808, 37, 2840, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17810, 39, 2841, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17811, 34, 2841, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17812, 40, 2841, '500 x 440 x 160 mm', 'admin', '2016-10-24 18:28:07'),
(17813, 41, 2841, '1606', 'admin', '2016-10-24 18:28:07'),
(17814, 37, 2841, 'Semi Recessed Basin', 'admin', '2016-10-24 18:28:07'),
(17816, 39, 2842, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17817, 34, 2842, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17818, 40, 2842, '810 x 465 x 160 mm', 'admin', '2016-10-24 18:28:07'),
(17819, 41, 2842, '1609', 'admin', '2016-10-24 18:28:07'),
(17820, 37, 2842, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17822, 39, 2843, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17823, 34, 2843, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17824, 40, 2843, '1000 x 500 x 165 mm', 'admin', '2016-10-24 18:28:07'),
(17825, 41, 2843, '1612', 'admin', '2016-10-24 18:28:07'),
(17826, 37, 2843, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17828, 39, 2844, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17829, 34, 2844, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17830, 40, 2844, '600 x 480 x 195 mm', 'admin', '2016-10-24 18:28:07'),
(17831, 41, 2844, '1616', 'admin', '2016-10-24 18:28:07'),
(17832, 37, 2844, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17834, 39, 2845, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17835, 34, 2845, 'Wall-hung Basin', 'admin', '2016-10-24 18:28:07'),
(17836, 40, 2845, '450 x 345 x 135 mm', 'admin', '2016-10-24 18:28:07'),
(17837, 41, 2845, '1622', 'admin', '2016-10-24 18:28:07'),
(17838, 37, 2845, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17840, 39, 2846, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17841, 34, 2846, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17842, 40, 2846, '480 x 370 x 125 mm', 'admin', '2016-10-24 18:28:07'),
(17843, 41, 2846, '1626', 'admin', '2016-10-24 18:28:07'),
(17844, 37, 2846, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17846, 39, 2847, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17847, 34, 2847, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17848, 40, 2847, '570 x 430 x 150 mm', 'admin', '2016-10-24 18:28:07'),
(17849, 41, 2847, '1627', 'admin', '2016-10-24 18:28:07'),
(17850, 37, 2847, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17852, 39, 2848, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17853, 34, 2848, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17854, 40, 2848, '810 x 470 x 130 mm', 'admin', '2016-10-24 18:28:07'),
(17855, 41, 2848, '1628', 'admin', '2016-10-24 18:28:07'),
(17856, 37, 2848, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17858, 39, 2849, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17859, 34, 2849, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17860, 40, 2849, '620 x 480 x 170 mm', 'admin', '2016-10-24 18:28:07'),
(17861, 41, 2849, '1629', 'admin', '2016-10-24 18:28:07'),
(17862, 37, 2849, 'Semi Recessed Basin', 'admin', '2016-10-24 18:28:07'),
(17864, 39, 2850, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17865, 34, 2850, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17866, 40, 2850, '420 x 420 x 150 mm', 'admin', '2016-10-24 18:28:07'),
(17867, 41, 2850, '1630', 'admin', '2016-10-24 18:28:07'),
(17868, 37, 2850, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17870, 39, 2851, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(17871, 34, 2851, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(17872, 40, 2851, '610 x 470 x 130 mm', 'admin', '2016-10-24 18:28:07'),
(17873, 41, 2851, '1642', 'admin', '2016-10-24 18:28:07'),
(17874, 37, 2851, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(17876, 39, 2852, 'Aquant', 'admin', '2016-10-24 18:28:08'),
(17877, 34, 2852, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(17878, 40, 2852, '530 x 410 x 185 mm', 'admin', '2016-10-24 18:28:08'),
(17879, 41, 2852, '1646', 'admin', '2016-10-24 18:28:08'),
(17880, 37, 2852, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17882, 39, 2853, 'Aquant', 'admin', '2016-10-24 18:28:08'),
(17883, 34, 2853, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(17884, 40, 2853, '510 x 360 x 150 mm ', 'admin', '2016-10-24 18:28:08'),
(17885, 41, 2853, '1649', 'admin', '2016-10-24 18:28:08'),
(17886, 37, 2853, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17888, 39, 2854, 'Aquant', 'admin', '2016-10-24 18:28:08'),
(17889, 34, 2854, 'R Wall-hung Basin', 'admin', '2016-10-24 18:28:08'),
(17890, 40, 2854, '420 x 300 x 120 mm', 'admin', '2016-10-24 18:28:08'),
(17891, 41, 2854, '1650R', 'admin', '2016-10-24 18:28:08'),
(17892, 37, 2854, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17894, 39, 2855, 'Aquant', 'admin', '2016-10-24 18:28:08'),
(17895, 34, 2855, 'L Wall-hung Basin', 'admin', '2016-10-24 18:28:08'),
(17896, 40, 2855, '420 x 300 x 120 mm', 'admin', '2016-10-24 18:28:08'),
(17897, 41, 2855, '1651L', 'admin', '2016-10-24 18:28:08'),
(17898, 37, 2855, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17900, 39, 2856, 'Aquant', 'admin', '2016-10-24 18:28:08'),
(17901, 34, 2856, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(17902, 40, 2856, '600 x 380 x 150 mm', 'admin', '2016-10-24 18:28:08'),
(17903, 41, 2856, '1652', 'admin', '2016-10-24 18:28:08'),
(17904, 37, 2856, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17906, 39, 2857, 'Aquant', 'admin', '2016-10-24 18:28:08'),
(17907, 34, 2857, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(17908, 40, 2857, '320 x 280 x 130 mm', 'admin', '2016-10-24 18:28:08'),
(17909, 41, 2857, '1655', 'admin', '2016-10-24 18:28:08'),
(17910, 37, 2857, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17912, 39, 2858, 'Aquant', 'admin', '2016-10-24 18:28:08'),
(17913, 34, 2858, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(17914, 40, 2858, '605 x 490 x 195 mm', 'admin', '2016-10-24 18:28:08'),
(17915, 41, 2858, '1656', 'admin', '2016-10-24 18:28:08'),
(17916, 37, 2858, 'Semi Recessed Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17918, 39, 2859, 'Aquant', 'admin', '2016-10-24 18:28:08'),
(17919, 34, 2859, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(17920, 40, 2859, '550 x 365 x 120 mm', 'admin', '2016-10-24 18:28:08'),
(17921, 41, 2859, '1701', 'admin', '2016-10-24 18:28:08'),
(17922, 37, 2859, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17924, 39, 2860, 'Aquant', 'admin', '2016-10-24 18:28:08'),
(17925, 34, 2860, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(17926, 40, 2860, '800 x 390 x 120 mm', 'admin', '2016-10-24 18:28:08'),
(17927, 41, 2860, '1702', 'admin', '2016-10-24 18:28:08'),
(17928, 37, 2860, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17930, 39, 2861, 'Aquant', 'admin', '2016-10-24 18:28:08'),
(17931, 34, 2861, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(17932, 40, 2861, '600 x 385 x 120 mm', 'admin', '2016-10-24 18:28:08'),
(17933, 41, 2861, '1703', 'admin', '2016-10-24 18:28:08'),
(17934, 37, 2861, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17936, 39, 2862, 'Aquant', 'admin', '2016-10-24 18:28:08'),
(17937, 34, 2862, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(17938, 40, 2862, '650 x 420 x 110 mm', 'admin', '2016-10-24 18:28:08'),
(17939, 41, 2862, '1704', 'admin', '2016-10-24 18:28:08'),
(17940, 37, 2862, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17942, 39, 2863, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(17943, 34, 2863, 'New Darling Vanity Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17944, 40, 2863, '545 x 600 mm', 'admin', '2016-10-24 18:28:08'),
(17945, 41, 2863, '6470', 'admin', '2016-10-24 18:28:08'),
(17946, 37, 2863, 'Wall Mounted Vanity Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17948, 39, 2864, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(17949, 34, 2864, 'Starck 3 Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17950, 40, 2864, '600 x 450 mm', 'admin', '2016-10-24 18:28:08'),
(17951, 41, 2864, '30060', 'admin', '2016-10-24 18:28:08'),
(17952, 37, 2864, '', 'admin', '2016-10-24 18:28:08'),
(17954, 39, 2865, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(17955, 34, 2865, 'Starck 3 Vanity Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17956, 40, 2865, '', 'admin', '2016-10-24 18:28:08'),
(17957, 41, 2865, '30410', 'admin', '2016-10-24 18:28:08'),
(17958, 37, 2865, '', 'admin', '2016-10-24 18:28:08'),
(17960, 39, 2866, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(17961, 34, 2866, 'Starck 3 Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17962, 40, 2866, '', 'admin', '2016-10-24 18:28:08'),
(17963, 41, 2866, '30470', 'admin', '2016-10-24 18:28:08'),
(17964, 37, 2866, '', 'admin', '2016-10-24 18:28:08'),
(17966, 39, 2867, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(17967, 34, 2867, 'Starck 3 Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17968, 40, 2867, '', 'admin', '2016-10-24 18:28:08'),
(17969, 41, 2867, '30480', 'admin', '2016-10-24 18:28:08'),
(17970, 37, 2867, '', 'admin', '2016-10-24 18:28:08'),
(17972, 39, 2868, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(17973, 34, 2868, 'Starck 3 Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17974, 40, 2868, '', 'admin', '2016-10-24 18:28:08'),
(17975, 41, 2868, '30970', 'admin', '2016-10-24 18:28:08'),
(17976, 37, 2868, '', 'admin', '2016-10-24 18:28:08'),
(17978, 39, 2869, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(17979, 34, 2869, 'Starck 3 Semi Recessed Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17980, 40, 2869, '550 x 460 mm', 'admin', '2016-10-24 18:28:08'),
(17981, 41, 2869, '31055', 'admin', '2016-10-24 18:28:08'),
(17982, 37, 2869, 'Wall Mounted Semi Recessed Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17984, 39, 2870, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(17985, 34, 2870, 'Vero Semi Recessed Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17986, 40, 2870, '550 x 470 mm', 'admin', '2016-10-24 18:28:08'),
(17987, 41, 2870, '31455', 'admin', '2016-10-24 18:28:08'),
(17988, 37, 2870, 'Semi Recessed Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17990, 39, 2871, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(17991, 34, 2871, 'Vero Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17992, 40, 2871, '', 'admin', '2016-10-24 18:28:08'),
(17993, 41, 2871, '31555', 'admin', '2016-10-24 18:28:08'),
(17994, 37, 2871, '', 'admin', '2016-10-24 18:28:08'),
(17996, 39, 2872, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(17997, 34, 2872, '2nd Floor Wash Basin', 'admin', '2016-10-24 18:28:08'),
(17998, 40, 2872, '580 x 415 mm', 'admin', '2016-10-24 18:28:08'),
(17999, 41, 2872, '31758', 'admin', '2016-10-24 18:28:08'),
(18000, 37, 2872, '', 'admin', '2016-10-24 18:28:08'),
(18002, 39, 2873, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(18003, 34, 2873, 'Architec Above Counter Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18004, 40, 2873, '', 'admin', '2016-10-24 18:28:08'),
(18005, 41, 2873, '32042', 'admin', '2016-10-24 18:28:08'),
(18006, 37, 2873, '', 'admin', '2016-10-24 18:28:08'),
(18008, 39, 2874, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(18009, 34, 2874, 'Architec Above Counter Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18010, 40, 2874, '450 mm', 'admin', '2016-10-24 18:28:08'),
(18011, 41, 2874, '32045', 'admin', '2016-10-24 18:28:08'),
(18012, 37, 2874, 'Above Counter Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18014, 39, 2875, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(18015, 34, 2875, 'Architect Above Counter Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18016, 40, 2875, '500 mm', 'admin', '2016-10-24 18:28:08'),
(18017, 41, 2875, '32050', 'admin', '2016-10-24 18:28:08'),
(18018, 37, 2875, 'Above Counter Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18020, 39, 2876, 'Duravit', 'admin', '2016-10-24 18:28:08'),
(18021, 34, 2876, 'Bacino Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18022, 40, 2876, '', 'admin', '2016-10-24 18:28:08'),
(18023, 41, 2876, '32542', 'admin', '2016-10-24 18:28:08'),
(18024, 37, 2876, 'Above Counter Round Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18026, 39, 2877, 'Bali', 'admin', '2016-10-24 18:28:08'),
(18027, 34, 2877, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(18028, 40, 2877, '410 x 160 mm', 'admin', '2016-10-24 18:28:08'),
(18029, 41, 2877, '7051', 'admin', '2016-10-24 18:28:08'),
(18030, 37, 2877, 'Copper Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18032, 39, 2878, 'Bali', 'admin', '2016-10-24 18:28:08'),
(18033, 34, 2878, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(18034, 40, 2878, '420 x 150 mm', 'admin', '2016-10-24 18:28:08'),
(18035, 41, 2878, '7052', 'admin', '2016-10-24 18:28:08'),
(18036, 37, 2878, 'Copper Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18038, 39, 2879, 'Bali', 'admin', '2016-10-24 18:28:08'),
(18039, 34, 2879, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(18040, 40, 2879, '410 x 160 mm', 'admin', '2016-10-24 18:28:08'),
(18041, 41, 2879, '7053', 'admin', '2016-10-24 18:28:08'),
(18042, 37, 2879, 'Copper Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18044, 39, 2880, 'Bali', 'admin', '2016-10-24 18:28:08'),
(18045, 34, 2880, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(18046, 40, 2880, '420 x 160 mm', 'admin', '2016-10-24 18:28:08'),
(18047, 41, 2880, '7054', 'admin', '2016-10-24 18:28:08'),
(18048, 37, 2880, 'Gold Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18050, 39, 2881, 'Bali', 'admin', '2016-10-24 18:28:08'),
(18051, 34, 2881, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(18052, 40, 2881, '420 x 160 mm', 'admin', '2016-10-24 18:28:08'),
(18053, 41, 2881, '7055', 'admin', '2016-10-24 18:28:08'),
(18054, 37, 2881, 'Silver Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18056, 39, 2882, 'Bali', 'admin', '2016-10-24 18:28:08'),
(18057, 34, 2882, 'Artistic Basin', 'admin', '2016-10-24 18:28:08'),
(18058, 40, 2882, '410 x 170 mm', 'admin', '2016-10-24 18:28:08'),
(18059, 41, 2882, '7056', 'admin', '2016-10-24 18:28:08'),
(18060, 37, 2882, 'Silver Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18062, 39, 2883, 'Bali', 'admin', '2016-10-24 18:28:08'),
(18063, 34, 2883, 'Aquaria Counter Top Wash Basin Beige-Cream', 'admin', '2016-10-24 18:28:08'),
(18064, 40, 2883, '500 x 350 x 150 mm', 'admin', '2016-10-24 18:28:08'),
(18065, 41, 2883, '9037', 'admin', '2016-10-24 18:28:08'),
(18066, 37, 2883, 'Stone Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18068, 39, 2884, 'Bali', 'admin', '2016-10-24 18:28:08'),
(18069, 34, 2884, 'Baso Round  Counter Top Wash Basin Beige-Cream', 'admin', '2016-10-24 18:28:08'),
(18070, 40, 2884, '350 x 155 mm', 'admin', '2016-10-24 18:28:08'),
(18071, 41, 2884, '9048', 'admin', '2016-10-24 18:28:08'),
(18072, 37, 2884, 'Stone Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18074, 39, 2885, 'Bali', 'admin', '2016-10-24 18:28:08'),
(18075, 34, 2885, 'Cora Counter Top Wash Basin Beige-Cream', 'admin', '2016-10-24 18:28:08'),
(18076, 40, 2885, '500 x 400 x 155 mm', 'admin', '2016-10-24 18:28:08'),
(18077, 41, 2885, '9043', 'admin', '2016-10-24 18:28:08'),
(18078, 37, 2885, 'Stone Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18080, 39, 2886, 'Bali', 'admin', '2016-10-24 18:28:08'),
(18081, 34, 2886, 'Cora Counter Top Wash Basin Grey-Black', 'admin', '2016-10-24 18:28:08'),
(18082, 40, 2886, '500 x 400 x 155 mm', 'admin', '2016-10-24 18:28:08'),
(18083, 41, 2886, '9043', 'admin', '2016-10-24 18:28:08'),
(18084, 37, 2886, 'Stone Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18086, 39, 2887, 'Designer', 'admin', '2016-10-24 18:28:08'),
(18087, 34, 2887, 'Copper Hammered Vessel', 'admin', '2016-10-24 18:28:08'),
(18088, 40, 2887, '400 mm dia', 'admin', '2016-10-24 18:28:08'),
(18089, 41, 2887, '', 'admin', '2016-10-24 18:28:08'),
(18090, 37, 2887, 'Copper Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18092, 39, 2888, 'Designer', 'admin', '2016-10-24 18:28:08'),
(18093, 34, 2888, 'Copper Imprint Vessel with Chrome', 'admin', '2016-10-24 18:28:08'),
(18094, 40, 2888, '400 mm dia', 'admin', '2016-10-24 18:28:08'),
(18095, 41, 2888, '', 'admin', '2016-10-24 18:28:08'),
(18096, 37, 2888, 'Copper Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18098, 39, 2889, 'Designer', 'admin', '2016-10-24 18:28:08'),
(18099, 34, 2889, 'Copper Imprint Vessel with Chrome_2', 'admin', '2016-10-24 18:28:08'),
(18100, 40, 2889, '400 mm dia', 'admin', '2016-10-24 18:28:08'),
(18101, 41, 2889, '', 'admin', '2016-10-24 18:28:08'),
(18102, 37, 2889, 'Copper Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18104, 39, 2890, 'Designer', 'admin', '2016-10-24 18:28:08'),
(18105, 34, 2890, 'Copper Imprint Vessel with Copper', 'admin', '2016-10-24 18:28:08'),
(18106, 40, 2890, '400 mm dia', 'admin', '2016-10-24 18:28:08'),
(18107, 41, 2890, '', 'admin', '2016-10-24 18:28:08'),
(18108, 37, 2890, 'Copper Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18110, 39, 2891, 'Designer', 'admin', '2016-10-24 18:28:08'),
(18111, 34, 2891, 'Copper Vessel', 'admin', '2016-10-24 18:28:08'),
(18112, 40, 2891, '400 mm dia', 'admin', '2016-10-24 18:28:08'),
(18113, 41, 2891, '', 'admin', '2016-10-24 18:28:08'),
(18114, 37, 2891, 'Copper Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18116, 39, 2892, 'Designer', 'admin', '2016-10-24 18:28:08'),
(18117, 34, 2892, 'Mother of Pearl Boat Multi Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18118, 40, 2892, '550 x 350 mm', 'admin', '2016-10-24 18:28:08'),
(18119, 41, 2892, '', 'admin', '2016-10-24 18:28:08'),
(18120, 37, 2892, 'Mother of Pearl Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18122, 39, 2893, 'Designer', 'admin', '2016-10-24 18:28:08'),
(18123, 34, 2893, 'Mother of Pearl Round White Gold Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18124, 40, 2893, '420 mm dia', 'admin', '2016-10-24 18:28:08'),
(18125, 41, 2893, '', 'admin', '2016-10-24 18:28:08'),
(18126, 37, 2893, 'Mother of Pearl Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18128, 39, 2894, 'Designer', 'admin', '2016-10-24 18:28:08'),
(18129, 34, 2894, 'Mother of Pearl Square Lines Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18130, 40, 2894, '420 x 420 mm', 'admin', '2016-10-24 18:28:08'),
(18131, 41, 2894, '', 'admin', '2016-10-24 18:28:08'),
(18132, 37, 2894, 'Mother of Pearl Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18134, 39, 2895, 'Designer', 'admin', '2016-10-24 18:28:08'),
(18135, 34, 2895, 'Mother of Pearl Square White Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18136, 40, 2895, '420 x 420 mm', 'admin', '2016-10-24 18:28:08'),
(18137, 41, 2895, '', 'admin', '2016-10-24 18:28:08'),
(18138, 37, 2895, 'Mother of Pearl Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18140, 39, 2896, 'Designer', 'admin', '2016-10-24 18:28:08'),
(18141, 34, 2896, 'Silver Mud Basin', 'admin', '2016-10-24 18:28:08'),
(18142, 40, 2896, '430 mm dia', 'admin', '2016-10-24 18:28:08'),
(18143, 41, 2896, '', 'admin', '2016-10-24 18:28:08'),
(18144, 37, 2896, 'Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18146, 39, 2897, 'Designer', 'admin', '2016-10-24 18:28:08'),
(18147, 34, 2897, 'Teracotta Flower Basin', 'admin', '2016-10-24 18:28:08'),
(18148, 40, 2897, '420 mm dia', 'admin', '2016-10-24 18:28:08'),
(18149, 41, 2897, '', 'admin', '2016-10-24 18:28:08'),
(18150, 37, 2897, 'Counter Top Wash Basin', 'admin', '2016-10-24 18:28:08'),
(18152, 39, 2898, 'Queo', 'admin', '2016-10-24 18:28:08'),
(18153, 34, 2898, 'Chromo Blue', 'admin', '2016-10-24 18:28:08'),
(18154, 40, 2898, '630 x 630 mm', 'admin', '2016-10-24 18:28:08'),
(18155, 41, 2898, 'Q503145120', 'admin', '2016-10-24 18:28:08'),
(18156, 37, 2898, 'Monitored levels of temparature, lighting and 5 flows of water from the shower, body showers and Han', 'admin', '2016-10-24 18:28:08'),
(18158, 39, 2899, 'Queo', 'admin', '2016-10-24 18:28:08'),
(18159, 34, 2899, 'Chromo Green', 'admin', '2016-10-24 18:28:08'),
(18160, 40, 2899, '630 x 630 mm', 'admin', '2016-10-24 18:28:08'),
(18161, 41, 2899, 'Q503145120', 'admin', '2016-10-24 18:28:08'),
(18162, 37, 2899, 'Monitored levels of temparature, lighting and 5 flows of water from the shower, body showers and Han', 'admin', '2016-10-24 18:28:08'),
(18164, 39, 2900, 'Queo', 'admin', '2016-10-24 18:28:08'),
(18165, 34, 2900, 'Chromo Indigo', 'admin', '2016-10-24 18:28:08'),
(18166, 40, 2900, '630 x 630 mm', 'admin', '2016-10-24 18:28:08'),
(18167, 41, 2900, 'Q503145120', 'admin', '2016-10-24 18:28:08'),
(18168, 37, 2900, 'Monitored levels of temparature, lighting and 5 flows of water from the shower, body showers and Han', 'admin', '2016-10-24 18:28:08'),
(18170, 39, 2901, 'Queo', 'admin', '2016-10-24 18:28:08'),
(18171, 34, 2901, 'Chromo Orange', 'admin', '2016-10-24 18:28:08'),
(18172, 40, 2901, '630 x 630 mm', 'admin', '2016-10-24 18:28:08'),
(18173, 41, 2901, 'Q503145120', 'admin', '2016-10-24 18:28:08'),
(18174, 37, 2901, 'Monitored levels of temparature, lighting and 5 flows of water from the shower, body showers and Han', 'admin', '2016-10-24 18:28:08'),
(18176, 39, 2902, 'Queo', 'admin', '2016-10-24 18:28:08'),
(18177, 34, 2902, 'Chromo Purple', 'admin', '2016-10-24 18:28:08'),
(18178, 40, 2902, '630 x 630 mm', 'admin', '2016-10-24 18:28:08'),
(18179, 41, 2902, 'Q503145120', 'admin', '2016-10-24 18:28:08'),
(18180, 37, 2902, 'Monitored levels of temparature, lighting and 5 flows of water from the shower, body showers and Han', 'admin', '2016-10-24 18:28:08'),
(18182, 39, 2903, 'Queo', 'admin', '2016-10-24 18:28:08'),
(18183, 34, 2903, 'Chromo Red', 'admin', '2016-10-24 18:28:08'),
(18184, 40, 2903, '630 x 630 mm', 'admin', '2016-10-24 18:28:08'),
(18185, 41, 2903, 'Q503145120', 'admin', '2016-10-24 18:28:08'),
(18186, 37, 2903, 'Monitored levels of temparature, lighting and 5 flows of water from the shower, body showers and Han', 'admin', '2016-10-24 18:28:08'),
(18188, 39, 2904, 'Queo', 'admin', '2016-10-24 18:28:08'),
(18189, 34, 2904, 'Chromo Yellow', 'admin', '2016-10-24 18:28:08'),
(18190, 40, 2904, '630 x 630 mm', 'admin', '2016-10-24 18:28:08'),
(18191, 41, 2904, 'Q503145120', 'admin', '2016-10-24 18:28:08'),
(18192, 37, 2904, 'Monitored levels of temparature, lighting and 5 flows of water from the shower, body showers and Han', 'admin', '2016-10-24 18:28:08'),
(18194, 39, 2905, 'Queo', 'admin', '2016-10-24 18:28:08'),
(18195, 34, 2905, 'Chromo 3 Way thermostatic Divertor', 'admin', '2016-10-24 18:28:08'),
(18196, 40, 2905, '', 'admin', '2016-10-24 18:28:08'),
(18197, 41, 2905, 'Q503155220', 'admin', '2016-10-24 18:28:08'),
(18198, 37, 2905, 'Divertor with Thermostat and 3 function control', 'admin', '2016-10-24 18:28:08'),
(18200, 39, 2906, 'Queo', 'admin', '2016-10-24 18:28:08'),
(18201, 34, 2906, 'Chromo 4 Way thermostatic Divertor', 'admin', '2016-10-24 18:28:08'),
(18202, 40, 2906, '', 'admin', '2016-10-24 18:28:08'),
(18203, 41, 2906, 'Q503155320', 'admin', '2016-10-24 18:28:08'),
(18204, 37, 2906, 'Divertor with Thermostat and 4 function control', 'admin', '2016-10-24 18:28:08'),
(18206, 39, 2907, 'Queo', 'admin', '2016-10-24 18:28:09'),
(18207, 34, 2907, 'Chromo 5 Way thermostatic Divertor', 'admin', '2016-10-24 18:28:09'),
(18208, 40, 2907, '', 'admin', '2016-10-24 18:28:09'),
(18209, 41, 2907, 'Q503155420', 'admin', '2016-10-24 18:28:09'),
(18210, 37, 2907, 'Divertor with Thermostat and 5 function control', 'admin', '2016-10-24 18:28:09'),
(18212, 39, 2908, 'Queo', 'admin', '2016-10-24 18:28:09'),
(18213, 34, 2908, 'Chromo Built In Body Jets', 'admin', '2016-10-24 18:28:09'),
(18214, 40, 2908, '', 'admin', '2016-10-24 18:28:09'),
(18215, 41, 2908, 'Q503151620', 'admin', '2016-10-24 18:28:09'),
(18216, 37, 2908, 'Chrome Built in Body Jets for Body Massage', 'admin', '2016-10-24 18:28:09'),
(18218, 39, 2909, 'Queo', 'admin', '2016-10-24 18:28:09'),
(18219, 34, 2909, 'Chromo 3 Flow Shower ', 'admin', '2016-10-24 18:28:09'),
(18220, 40, 2909, '', 'admin', '2016-10-24 18:28:09'),
(18221, 41, 2909, 'Q503142220', 'admin', '2016-10-24 18:28:09'),
(18222, 37, 2909, '3 function overhead shower with Rain, Massage & Cascade flow', 'admin', '2016-10-24 18:28:09'),
(18224, 39, 2910, 'Queo', 'admin', '2016-10-24 18:28:09'),
(18225, 34, 2910, 'Chromo 3 Flow Shower ', 'admin', '2016-10-24 18:28:09'),
(18226, 40, 2910, '', 'admin', '2016-10-24 18:28:09'),
(18227, 41, 2910, 'Q503142220', 'admin', '2016-10-24 18:28:09'),
(18228, 37, 2910, '3 function overhead shower with Rain, Massage & Cascade flow', 'admin', '2016-10-24 18:28:09'),
(18230, 39, 2911, 'Queo', 'admin', '2016-10-24 18:28:09'),
(18231, 34, 2911, 'Chromo 3 Flow Shower ', 'admin', '2016-10-24 18:28:09'),
(18232, 40, 2911, '', 'admin', '2016-10-24 18:28:09'),
(18233, 41, 2911, 'Q503142220', 'admin', '2016-10-24 18:28:09'),
(18234, 37, 2911, '3 function overhead shower with Rain, Massage & Cascade flow', 'admin', '2016-10-24 18:28:09'),
(18236, 39, 2912, 'Queo', 'admin', '2016-10-24 18:28:09'),
(18237, 34, 2912, 'Chromo 3 Flow Shower ', 'admin', '2016-10-24 18:28:09'),
(18238, 40, 2912, '', 'admin', '2016-10-24 18:28:09'),
(18239, 41, 2912, 'Q503142220', 'admin', '2016-10-24 18:28:09'),
(18240, 37, 2912, '3 function overhead shower with Rain, Massage & Cascade flow', 'admin', '2016-10-24 18:28:09'),
(18242, 39, 2913, 'Queo', 'admin', '2016-10-24 18:28:09'),
(18243, 34, 2913, 'Chromo Hand Shower', 'admin', '2016-10-24 18:28:09'),
(18244, 40, 2913, '', 'admin', '2016-10-24 18:28:09'),
(18245, 41, 2913, 'Q503131320', 'admin', '2016-10-24 18:28:09'),
(18246, 37, 2913, 'Chrome slim handshower', 'admin', '2016-10-24 18:28:09'),
(18248, 39, 2914, 'Queo', 'admin', '2016-10-24 18:28:09'),
(18249, 34, 2914, 'Chromo Waterfall Shower Head', 'admin', '2016-10-24 18:28:09'),
(18250, 40, 2914, '', 'admin', '2016-10-24 18:28:09'),
(18251, 41, 2914, 'Q503142320', 'admin', '2016-10-24 18:28:09'),
(18252, 37, 2914, 'Cascade flow overhead shower', 'admin', '2016-10-24 18:28:09'),
(18254, 39, 2915, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18255, 34, 2915, 'Puzzle', 'admin', '2016-10-24 18:28:09'),
(18256, 40, 2915, '', 'admin', '2016-10-24 18:28:09'),
(18257, 41, 2915, 'RF5A9978C00', 'admin', '2016-10-24 18:28:09'),
(18258, 37, 2915, 'Modern & clean shower concept with a 2 flow shower(ceiling or wall mounted), round body jets & therm', 'admin', '2016-10-24 18:28:09'),
(18260, 39, 2916, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18261, 34, 2916, 'Puzzle', 'admin', '2016-10-24 18:28:09'),
(18262, 40, 2916, '', 'admin', '2016-10-24 18:28:09'),
(18263, 41, 2916, 'RF5A9978C00', 'admin', '2016-10-24 18:28:09'),
(18264, 37, 2916, 'Modern & clean shower concept with a 2 flow shower(ceiling or wall mounted), round body jets & therm', 'admin', '2016-10-24 18:28:09'),
(18266, 39, 2917, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18267, 34, 2917, 'Puzzle', 'admin', '2016-10-24 18:28:09'),
(18268, 40, 2917, '', 'admin', '2016-10-24 18:28:09'),
(18269, 41, 2917, 'RF5A9978C00', 'admin', '2016-10-24 18:28:09'),
(18270, 37, 2917, 'Modern & clean shower concept with a 2 flow shower(ceiling or wall mounted), round body jets & therm', 'admin', '2016-10-24 18:28:09'),
(18272, 39, 2918, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18273, 34, 2918, 'Puzzle', 'admin', '2016-10-24 18:28:09'),
(18274, 40, 2918, '', 'admin', '2016-10-24 18:28:09'),
(18275, 41, 2918, 'RF5A9978C00', 'admin', '2016-10-24 18:28:09'),
(18276, 37, 2918, 'Modern & clean shower concept with a 2 flow shower(ceiling or wall mounted), round body jets & therm', 'admin', '2016-10-24 18:28:09'),
(18278, 39, 2919, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18279, 34, 2919, 'Be Cool Bathtub', 'admin', '2016-10-24 18:28:09'),
(18280, 40, 2919, '1900 x 1100 x 420 mm', 'admin', '2016-10-24 18:28:09'),
(18281, 41, 2919, 'RW248052001', 'admin', '2016-10-24 18:28:09'),
(18282, 37, 2919, 'Air and water massage bathtub', 'admin', '2016-10-24 18:28:09'),
(18284, 39, 2920, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18285, 34, 2920, 'Duo Plus Bathtub ', 'admin', '2016-10-24 18:28:09'),
(18286, 40, 2920, '1800 x 800 x 400 mm', 'admin', '2016-10-24 18:28:09'),
(18287, 41, 2920, 'RW221670000', 'admin', '2016-10-24 18:28:09'),
(18288, 37, 2920, 'Drop-in bathtub with anti-slip base', 'admin', '2016-10-24 18:28:09'),
(18290, 39, 2921, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18291, 34, 2921, 'Duo Plus Bathtub ', 'admin', '2016-10-24 18:28:09'),
(18292, 40, 2921, '180 x 800 x 400 mm', 'admin', '2016-10-24 18:28:09'),
(18293, 41, 2921, 'RW221670000', 'admin', '2016-10-24 18:28:09'),
(18294, 37, 2921, 'Drop-in bathtub with anti-slip base', 'admin', '2016-10-24 18:28:09'),
(18296, 39, 2922, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18297, 34, 2922, 'Duo Plus Bathtub ', 'admin', '2016-10-24 18:28:09'),
(18298, 40, 2922, '180 x 800 x 400 mm', 'admin', '2016-10-24 18:28:09'),
(18299, 41, 2922, 'RW221670000', 'admin', '2016-10-24 18:28:09'),
(18300, 37, 2922, 'Drop-in bathtub with anti-slip base', 'admin', '2016-10-24 18:28:09'),
(18302, 39, 2923, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18303, 34, 2923, 'Easy Bathtub ', 'admin', '2016-10-24 18:28:09'),
(18304, 40, 2923, '1700 x 750 x 420 mm', 'admin', '2016-10-24 18:28:09'),
(18305, 41, 2923, 'RW248238001B', 'admin', '2016-10-24 18:28:09'),
(18306, 37, 2923, 'Water massage bathtub', 'admin', '2016-10-24 18:28:09'),
(18308, 39, 2924, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18309, 34, 2924, 'Easy Bathtub ', 'admin', '2016-10-24 18:28:09'),
(18310, 40, 2924, '1700 x 750 x 420 mm', 'admin', '2016-10-24 18:28:09'),
(18311, 41, 2924, 'RW26N020000', 'admin', '2016-10-24 18:28:09'),
(18312, 37, 2924, 'Drop-in bathtub ', 'admin', '2016-10-24 18:28:09'),
(18314, 39, 2925, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18315, 34, 2925, 'Element Bathtub ', 'admin', '2016-10-24 18:28:09'),
(18316, 40, 2925, '1800 x 800 x 426 mm', 'admin', '2016-10-24 18:28:09'),
(18317, 41, 2925, 'RW247976001', 'admin', '2016-10-24 18:28:09'),
(18318, 37, 2925, 'Rectangular acrylic one-piece bath with integrated panel and waste kit', 'admin', '2016-10-24 18:28:09'),
(18320, 39, 2926, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18321, 34, 2926, 'Element Bathtub Built In', 'admin', '2016-10-24 18:28:09'),
(18322, 40, 2926, '1800 x 800 x 426 mm', 'admin', '2016-10-24 18:28:09'),
(18323, 41, 2926, 'RW247704000', 'admin', '2016-10-24 18:28:09'),
(18324, 37, 2926, 'Drop-in bathtub', 'admin', '2016-10-24 18:28:09'),
(18326, 39, 2927, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18327, 34, 2927, 'Element Bathtub', 'admin', '2016-10-24 18:28:09'),
(18328, 40, 2927, '1801 x 800 x 426 mm', 'admin', '2016-10-24 18:28:09'),
(18329, 41, 2927, 'RW247976001', 'admin', '2016-10-24 18:28:09'),
(18330, 37, 2927, 'Rectangular acrylic one-piece bath with integrated panel and waste kit', 'admin', '2016-10-24 18:28:09'),
(18332, 39, 2928, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18333, 34, 2928, 'Georgia Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18334, 40, 2928, '1850 x 1000 x 420  mm', 'admin', '2016-10-24 18:28:09'),
(18335, 41, 2928, 'RW248069001', 'admin', '2016-10-24 18:28:09'),
(18336, 37, 2928, 'Air and water massage bathtub', 'admin', '2016-10-24 18:28:09'),
(18338, 39, 2929, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18339, 34, 2929, 'Georgia Drop In Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18340, 40, 2929, '1850 x 1000 x 420  mm', 'admin', '2016-10-24 18:28:09'),
(18341, 41, 2929, 'RW247566000', 'admin', '2016-10-24 18:28:09'),
(18342, 37, 2929, 'Drop-in bathtub', 'admin', '2016-10-24 18:28:09'),
(18344, 39, 2930, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18345, 34, 2930, 'Georgia Free Standing Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18346, 40, 2930, '1850 x 1000 x 580 mm', 'admin', '2016-10-24 18:28:09'),
(18347, 41, 2930, 'RW247566001', 'admin', '2016-10-24 18:28:09'),
(18348, 37, 2930, 'Free-standing bathtub', 'admin', '2016-10-24 18:28:09'),
(18350, 39, 2931, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18351, 34, 2931, 'Lun Plus Bathtub ', 'admin', '2016-10-24 18:28:09'),
(18352, 40, 2931, '1800 x 800 x 440 mm', 'admin', '2016-10-24 18:28:09'),
(18353, 41, 2931, 'RW221250001 ', 'admin', '2016-10-24 18:28:09'),
(18354, 37, 2931, 'Drop-in bathtub with anti-slip base and grips ', 'admin', '2016-10-24 18:28:09'),
(18356, 39, 2932, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18357, 34, 2932, 'Acquamass Gold Black', 'admin', '2016-10-24 18:28:09'),
(18358, 40, 2932, 'Depends on model', 'admin', '2016-10-24 18:28:09'),
(18359, 41, 2932, '', 'admin', '2016-10-24 18:28:09'),
(18360, 37, 2932, 'Turn your bathtubs into gold!', 'admin', '2016-10-24 18:28:09'),
(18362, 39, 2933, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18363, 34, 2933, 'Aquamass Gold White', 'admin', '2016-10-24 18:28:09'),
(18364, 40, 2933, 'Depends on model', 'admin', '2016-10-24 18:28:09'),
(18365, 41, 2933, '', 'admin', '2016-10-24 18:28:09'),
(18366, 37, 2933, 'Turn your bathtubs into gold!', 'admin', '2016-10-24 18:28:09'),
(18368, 39, 2934, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18369, 34, 2934, 'Aquamass ', 'admin', '2016-10-24 18:28:09'),
(18370, 40, 2934, 'Depends on model', 'admin', '2016-10-24 18:28:09'),
(18371, 41, 2934, '', 'admin', '2016-10-24 18:28:09'),
(18372, 37, 2934, 'Turn your bathtubs into gold!', 'admin', '2016-10-24 18:28:09'),
(18374, 39, 2935, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18375, 34, 2935, 'Baby Bath Tub ', 'admin', '2016-10-24 18:28:09'),
(18376, 40, 2935, '800 x 450 x 411 mm', 'admin', '2016-10-24 18:28:09'),
(18377, 41, 2935, 'BB 79', 'admin', '2016-10-24 18:28:09'),
(18378, 37, 2935, 'Small Sized tubs for the small ones', 'admin', '2016-10-24 18:28:09'),
(18380, 39, 2936, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18381, 34, 2936, 'Ballet', 'admin', '2016-10-24 18:28:09'),
(18382, 40, 2936, '1815 x 835 x 630 mm', 'admin', '2016-10-24 18:28:09'),
(18383, 41, 2936, '', 'admin', '2016-10-24 18:28:09'),
(18384, 37, 2936, 'Free Standing White Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18386, 39, 2937, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18387, 34, 2937, 'Baroc', 'admin', '2016-10-24 18:28:09'),
(18388, 40, 2937, '1750 x 810 x 580 mm', 'admin', '2016-10-24 18:28:09'),
(18389, 41, 2937, '', 'admin', '2016-10-24 18:28:09'),
(18390, 37, 2937, 'Free Standing White Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18392, 39, 2938, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18393, 34, 2938, 'Bricks', 'admin', '2016-10-24 18:28:09'),
(18394, 40, 2938, '1800 X 800 X 590 mm', 'admin', '2016-10-24 18:28:09'),
(18395, 41, 2938, 'BB 17', 'admin', '2016-10-24 18:28:09'),
(18396, 37, 2938, 'Free Standing White Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18398, 39, 2939, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18399, 34, 2939, 'Bubbles', 'admin', '2016-10-24 18:28:09'),
(18400, 40, 2939, '800 x 450 x 411 mm', 'admin', '2016-10-24 18:28:09'),
(18401, 41, 2939, '', 'admin', '2016-10-24 18:28:09'),
(18402, 37, 2939, 'Free Standing White Bath Tub With Chrome Legs', 'admin', '2016-10-24 18:28:09'),
(18404, 39, 2940, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18405, 34, 2940, 'Cellar', 'admin', '2016-10-24 18:28:09'),
(18406, 40, 2940, '1705 x 965 x 480 mm', 'admin', '2016-10-24 18:28:09'),
(18407, 41, 2940, '', 'admin', '2016-10-24 18:28:09'),
(18408, 37, 2940, 'Free Standing White Bath Tub With Wooden Legs', 'admin', '2016-10-24 18:28:09'),
(18410, 39, 2941, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18411, 34, 2941, 'Chateau', 'admin', '2016-10-24 18:28:09'),
(18412, 40, 2941, '1790 x 795 x 560 mm', 'admin', '2016-10-24 18:28:09'),
(18413, 41, 2941, '', 'admin', '2016-10-24 18:28:09'),
(18414, 37, 2941, 'Free Standing White Bath Tub With Chrome Legs', 'admin', '2016-10-24 18:28:09'),
(18416, 39, 2942, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18417, 34, 2942, 'Conrad', 'admin', '2016-10-24 18:28:09'),
(18418, 40, 2942, '1710 x 800 x 600 mm', 'admin', '2016-10-24 18:28:09'),
(18419, 41, 2942, '', 'admin', '2016-10-24 18:28:09'),
(18420, 37, 2942, 'Free Standing White Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18428, 40, NULL, '', 'admin', '2016-10-24 18:28:16'),
(18429, 41, NULL, '', 'admin', '2016-10-24 18:28:16'),
(18431, 35, 2823, '35000', 'admin', '2016-09-01 15:05:18'),
(18432, 35, 2824, '42000', 'admin', '2016-09-01 15:05:18'),
(18433, 35, 2825, '58000', 'admin', '2016-09-01 15:05:18'),
(18434, 35, 2826, '25000', 'admin', '2016-09-01 15:05:18'),
(18435, 35, 2827, '15000', 'admin', '2016-09-01 15:05:18'),
(18436, 35, 2828, '24500', 'admin', '2016-09-01 15:05:19'),
(18437, 35, 2829, '65000', 'admin', '2016-09-01 15:05:19'),
(18438, 35, 2830, '65800', 'admin', '2016-09-01 15:05:19'),
(18439, 35, 2831, '109000', 'admin', '2016-09-01 15:05:19'),
(18440, 35, 2832, '125000', 'admin', '2016-09-01 15:05:19'),
(18441, 35, 2833, '47500', 'admin', '2016-10-24 18:28:07'),
(18442, 35, 2834, '16580', 'admin', '2016-10-24 18:28:07'),
(18443, 35, 2835, '15000', 'admin', '2016-10-24 18:28:07'),
(18444, 35, 2836, '12000', 'admin', '2016-10-24 18:28:07'),
(18445, 35, 2837, '12560', 'admin', '2016-10-24 18:28:07'),
(18446, 35, 2838, '32560', 'admin', '2016-10-24 18:28:07'),
(18447, 35, 2839, '95200', 'admin', '2016-10-24 18:28:07'),
(18448, 35, 2840, '86500', 'admin', '2016-10-24 18:28:07'),
(18449, 35, 2841, '26500', 'admin', '2016-10-24 18:28:07'),
(18450, 35, 2842, '36500', 'admin', '2016-10-24 18:28:07'),
(18451, 35, 2843, '45600', 'admin', '2016-10-24 18:28:07'),
(18452, 35, 2844, '12500', 'admin', '2016-10-24 18:28:07'),
(18453, 35, 2845, '75200', 'admin', '2016-10-24 18:28:07'),
(18454, 35, 2846, '65230', 'admin', '2016-10-24 18:28:07'),
(18455, 35, 2847, '45620', 'admin', '2016-10-24 18:28:07'),
(18456, 35, 2848, '125420', 'admin', '2016-10-24 18:28:07'),
(18457, 35, 2849, '98520', 'admin', '2016-10-24 18:28:07'),
(18458, 35, 2850, '35600', 'admin', '2016-10-24 18:28:07'),
(18459, 35, 2851, '65320', 'admin', '2016-10-24 18:28:08'),
(18460, 35, 2852, '45620', 'admin', '2016-10-24 18:28:08'),
(18461, 35, 2853, '254620', 'admin', '2016-10-24 18:28:08'),
(18462, 35, 2854, '12560', 'admin', '2016-10-24 18:28:08'),
(18463, 35, 2855, '32560', 'admin', '2016-10-24 18:28:08'),
(18464, 35, 2856, '95200', 'admin', '2016-10-24 18:28:08'),
(18465, 35, 2857, '86500', 'admin', '2016-10-24 18:28:08'),
(18466, 35, 2858, '26500', 'admin', '2016-10-24 18:28:08'),
(18467, 35, 2859, '36500', 'admin', '2016-10-24 18:28:08'),
(18468, 35, 2860, '45600', 'admin', '2016-10-24 18:28:08'),
(18469, 35, 2861, '12500', 'admin', '2016-10-24 18:28:08'),
(18470, 35, 2862, '75200', 'admin', '2016-10-24 18:28:08'),
(18471, 35, 2863, '65230', 'admin', '2016-10-24 18:28:08'),
(18472, 35, 2864, '45620', 'admin', '2016-10-24 18:28:08'),
(18473, 35, 2865, '12560', 'admin', '2016-10-24 18:28:08'),
(18474, 35, 2866, '32560', 'admin', '2016-10-24 18:28:08'),
(18475, 35, 2867, '95200', 'admin', '2016-10-24 18:28:08'),
(18476, 35, 2868, '86500', 'admin', '2016-10-24 18:28:08'),
(18477, 35, 2869, '26500', 'admin', '2016-10-24 18:28:08'),
(18478, 35, 2870, '36500', 'admin', '2016-10-24 18:28:08'),
(18479, 35, 2871, '45600', 'admin', '2016-10-24 18:28:08'),
(18480, 35, 2872, '12500', 'admin', '2016-10-24 18:28:08'),
(18481, 35, 2873, '75200', 'admin', '2016-10-24 18:28:08'),
(18482, 35, 2874, '65230', 'admin', '2016-10-24 18:28:08'),
(18483, 35, 2875, '45620', 'admin', '2016-10-24 18:28:08'),
(18484, 35, 2876, '65000', 'admin', '2016-10-24 18:28:08'),
(18485, 35, 2877, '65800', 'admin', '2016-10-24 18:28:08'),
(18486, 35, 2878, '109000', 'admin', '2016-10-24 18:28:08'),
(18487, 35, 2879, '125000', 'admin', '2016-10-24 18:28:08'),
(18488, 35, 2880, '47500', 'admin', '2016-10-24 18:28:08'),
(18489, 35, 2881, '16580', 'admin', '2016-10-24 18:28:08'),
(18490, 35, 2882, '58000', 'admin', '2016-10-24 18:28:08'),
(18491, 35, 2883, '25000', 'admin', '2016-10-24 18:28:08'),
(18492, 35, 2884, '15000', 'admin', '2016-10-24 18:28:08'),
(18493, 35, 2885, '24500', 'admin', '2016-10-24 18:28:08'),
(18494, 35, 2886, '65000', 'admin', '2016-10-24 18:28:08'),
(18495, 35, 2887, '65800', 'admin', '2016-10-24 18:28:08'),
(18496, 35, 2888, '109000', 'admin', '2016-10-24 18:28:08'),
(18497, 35, 2889, '125000', 'admin', '2016-10-24 18:28:08'),
(18498, 35, 2890, '47500', 'admin', '2016-10-24 18:28:08'),
(18499, 35, 2891, '16580', 'admin', '2016-10-24 18:28:08'),
(18500, 35, 2892, '15000', 'admin', '2016-10-24 18:28:08'),
(18501, 35, 2893, '12000', 'admin', '2016-10-24 18:28:08'),
(18502, 35, 2894, '12560', 'admin', '2016-10-24 18:28:08'),
(18503, 35, 2895, '32560', 'admin', '2016-10-24 18:28:08'),
(18504, 35, 2896, '95200', 'admin', '2016-10-24 18:28:08'),
(18505, 35, 2897, '86500', 'admin', '2016-10-24 18:28:08'),
(18506, 35, 2898, '26500', 'admin', '2016-10-24 18:28:08'),
(18507, 35, 2899, '36500', 'admin', '2016-10-24 18:28:08'),
(18508, 35, 2900, '45600', 'admin', '2016-10-24 18:28:08'),
(18509, 35, 2901, '12500', 'admin', '2016-10-24 18:28:08'),
(18510, 35, 2902, '75200', 'admin', '2016-10-24 18:28:08'),
(18511, 35, 2903, '26500', 'admin', '2016-10-24 18:28:08'),
(18512, 35, 2904, '36500', 'admin', '2016-10-24 18:28:08'),
(18513, 35, 2905, '45600', 'admin', '2016-10-24 18:28:08'),
(18514, 35, 2906, '12500', 'admin', '2016-10-24 18:28:09'),
(18515, 35, 2907, '75200', 'admin', '2016-10-24 18:28:09'),
(18516, 35, 2908, '65230', 'admin', '2016-10-24 18:28:09'),
(18517, 35, 2909, '45620', 'admin', '2016-10-24 18:28:09'),
(18518, 35, 2910, '65000', 'admin', '2016-10-24 18:28:09'),
(18519, 35, 2911, '65800', 'admin', '2016-10-24 18:28:09'),
(18520, 35, 2912, '109000', 'admin', '2016-10-24 18:28:09'),
(18521, 35, 2913, '125000', 'admin', '2016-10-24 18:28:09'),
(18522, 35, 2914, '47500', 'admin', '2016-10-24 18:28:09'),
(18523, 35, 2915, '16580', 'admin', '2016-10-24 18:28:09'),
(18524, 35, 2916, '58000', 'admin', '2016-10-24 18:28:09'),
(18525, 35, 2917, '25000', 'admin', '2016-10-24 18:28:09'),
(18526, 35, 2918, '15000', 'admin', '2016-10-24 18:28:09'),
(18527, 35, 2919, '24500', 'admin', '2016-10-24 18:28:09'),
(18528, 35, 2920, '65000', 'admin', '2016-10-24 18:28:09'),
(18529, 35, 2921, '65800', 'admin', '2016-10-24 18:28:09'),
(18530, 35, 2922, '109000', 'admin', '2016-10-24 18:28:09'),
(18531, 35, 2923, '125000', 'admin', '2016-10-24 18:28:09'),
(18532, 35, 2924, '95200', 'admin', '2016-10-24 18:28:09'),
(18533, 35, 2925, '86500', 'admin', '2016-10-24 18:28:09'),
(18534, 35, 2926, '26500', 'admin', '2016-10-24 18:28:09'),
(18535, 35, 2927, '36500', 'admin', '2016-10-24 18:28:09'),
(18536, 35, 2928, '45600', 'admin', '2016-10-24 18:28:09'),
(18537, 35, 2929, '12500', 'admin', '2016-10-24 18:28:09'),
(18538, 35, 2930, '75200', 'admin', '2016-10-24 18:28:09'),
(18539, 35, 2931, '65230', 'admin', '2016-10-24 18:28:09'),
(18540, 35, 2932, '45620', 'admin', '2016-10-24 18:28:09'),
(18541, 35, 2933, '12560', 'admin', '2016-10-24 18:28:09'),
(18542, 35, 2934, '32560', 'admin', '2016-10-24 18:28:09'),
(18543, 35, 2935, '25000', 'admin', '2016-10-24 18:28:09'),
(18544, 35, 2936, '15000', 'admin', '2016-10-24 18:28:09'),
(18545, 35, 2937, '24500', 'admin', '2016-10-24 18:28:09'),
(18546, 35, 2938, '65000', 'admin', '2016-10-24 18:28:09'),
(18547, 35, 2939, '65800', 'admin', '2016-10-24 18:28:09'),
(18548, 35, 2940, '109000', 'admin', '2016-10-24 18:28:09'),
(18549, 35, 2941, '25000', 'admin', '2016-10-24 18:28:09'),
(18550, 35, 2942, '12560', 'admin', '2016-10-24 18:28:09'),
(18557, 39, 2945, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(18558, 34, 2945, 'Wall-hung Basin', 'admin', '2016-10-24 18:28:07'),
(18559, 40, 2945, '410 x 270 x 140 mm', 'admin', '2016-10-24 18:28:07'),
(18560, 41, 2945, '1519L', 'admin', '2016-10-24 18:28:07'),
(18561, 37, 2945, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(18562, 35, 2945, '35000', 'admin', '2016-10-24 18:28:07'),
(18563, 39, 2946, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(18564, 34, 2946, 'Wall-hung Basin', 'admin', '2016-10-24 18:28:07'),
(18565, 40, 2946, '410 x 270 x 140 mm', 'admin', '2016-10-24 18:28:07'),
(18566, 41, 2946, '1520R', 'admin', '2016-10-24 18:28:07'),
(18567, 37, 2946, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(18568, 35, 2946, '42000', 'admin', '2016-10-24 18:28:07'),
(18569, 39, 2947, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(18570, 34, 2947, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(18571, 40, 2947, '410 x 410 x 123 mm', 'admin', '2016-10-24 18:28:07'),
(18572, 41, 2947, '1521', 'admin', '2016-10-24 18:28:07'),
(18573, 37, 2947, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(18574, 35, 2947, '58000', 'admin', '2016-10-24 18:28:07'),
(18575, 39, 2948, 'Aquant', 'admin', '2016-10-24 18:28:07');
INSERT INTO `attribute_value` (`attribute_value_id`, `attribute_id`, `product_id`, `attribute_value`, `updated_by`, `updated_on`) VALUES
(18576, 34, 2948, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(18577, 40, 2948, '460 x 160 mm', 'admin', '2016-10-24 18:28:07'),
(18578, 41, 2948, '1526', 'admin', '2016-10-24 18:28:07'),
(18579, 37, 2948, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(18580, 35, 2948, '25000', 'admin', '2016-10-24 18:28:07'),
(18581, 39, 2949, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(18582, 34, 2949, 'Wall-hung Basin', 'admin', '2016-10-24 18:28:07'),
(18583, 40, 2949, '330 x 295 x 125 mm', 'admin', '2016-10-24 18:28:07'),
(18584, 41, 2949, '1537', 'admin', '2016-10-24 18:28:07'),
(18585, 37, 2949, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(18586, 35, 2949, '15000', 'admin', '2016-10-24 18:28:07'),
(18587, 39, 2950, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(18588, 34, 2950, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(18589, 40, 2950, '480 x 370 x 130 mm', 'admin', '2016-10-24 18:28:07'),
(18590, 41, 2950, '1539', 'admin', '2016-10-24 18:28:07'),
(18591, 37, 2950, 'Table Mounted Wash Basin', 'admin', '2016-10-24 18:28:07'),
(18592, 35, 2950, '24500', 'admin', '2016-10-24 18:28:07'),
(18593, 39, 2951, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(18594, 34, 2951, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(18595, 40, 2951, '550 x 450 x 150 mm ', 'admin', '2016-10-24 18:28:07'),
(18596, 41, 2951, '1554', 'admin', '2016-10-24 18:28:07'),
(18597, 37, 2951, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(18598, 35, 2951, '65000', 'admin', '2016-10-24 18:28:07'),
(18599, 39, 2952, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(18600, 34, 2952, 'Wall-hung Basin', 'admin', '2016-10-24 18:28:07'),
(18601, 40, 2952, '390 x 305 x 120 mm', 'admin', '2016-10-24 18:28:07'),
(18602, 41, 2952, '1555', 'admin', '2016-10-24 18:28:07'),
(18603, 37, 2952, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(18604, 35, 2952, '65800', 'admin', '2016-10-24 18:28:07'),
(18605, 39, 2953, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(18606, 34, 2953, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(18607, 40, 2953, '460 x 395 x 150 mm', 'admin', '2016-10-24 18:28:07'),
(18608, 41, 2953, '1556', 'admin', '2016-10-24 18:28:07'),
(18609, 37, 2953, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(18610, 35, 2953, '109000', 'admin', '2016-10-24 18:28:07'),
(18611, 39, 2954, 'Aquant', 'admin', '2016-10-24 18:28:07'),
(18612, 34, 2954, 'Artistic Basin', 'admin', '2016-10-24 18:28:07'),
(18613, 40, 2954, '460 x 310 x 130 mm', 'admin', '2016-10-24 18:28:07'),
(18614, 41, 2954, '1564', 'admin', '2016-10-24 18:28:07'),
(18615, 37, 2954, 'Table Mounted/ Wall Hung Wash Basin', 'admin', '2016-10-24 18:28:07'),
(18616, 35, 2954, '125000', 'admin', '2016-10-24 18:28:07'),
(18623, 39, 2956, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18624, 34, 2956, 'Chateau', 'admin', '2016-10-24 18:28:09'),
(18625, 40, 2956, '1790 x 795 x 560 mm', 'admin', '2016-10-24 18:28:09'),
(18626, 41, 2956, '', 'admin', '2016-10-24 18:28:09'),
(18627, 37, 2956, 'Free Standing White Bath Tub With Chrome Legs', 'admin', '2016-10-24 18:28:09'),
(18628, 35, 2956, '25000', 'admin', '2016-10-24 18:28:09'),
(18629, 39, 2957, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18630, 34, 2957, 'Ballet', 'admin', '2016-10-24 18:28:09'),
(18631, 40, 2957, '1815 x 835 x 630 mm', 'admin', '2016-10-24 18:28:09'),
(18632, 41, 2957, '', 'admin', '2016-10-24 18:28:09'),
(18633, 37, 2957, 'Free Standing White Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18634, 35, 2957, '15000', 'admin', '2016-10-24 18:28:09'),
(18635, 39, 2958, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18636, 34, 2958, 'Ballet', 'admin', '2016-10-24 18:28:09'),
(18637, 40, 2958, '1815 x 835 x 630 mm', 'admin', '2016-10-24 18:28:09'),
(18638, 41, 2958, '', 'admin', '2016-10-24 18:28:09'),
(18639, 37, 2958, 'Free Standing White Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18640, 35, 2958, '15000', 'admin', '2016-10-24 18:28:09'),
(18641, 39, 2959, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18642, 34, 2959, 'Georgia Free Standing Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18643, 40, 2959, '1850 x 1000 x 580 mm', 'admin', '2016-10-24 18:28:09'),
(18644, 41, 2959, 'RW247566001', 'admin', '2016-10-24 18:28:09'),
(18645, 37, 2959, 'Free-standing bathtub', 'admin', '2016-10-24 18:28:09'),
(18646, 35, 2959, '75200', 'admin', '2016-10-24 18:28:09'),
(18647, 39, 2960, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18648, 34, 2960, 'Chateau', 'admin', '2016-10-24 18:28:09'),
(18649, 40, 2960, '1790 x 795 x 560 mm', 'admin', '2016-10-24 18:28:09'),
(18650, 41, 2960, '', 'admin', '2016-10-24 18:28:09'),
(18651, 37, 2960, 'Free Standing White Bath Tub With Chrome Legs', 'admin', '2016-10-24 18:28:09'),
(18652, 35, 2960, '25000', 'admin', '2016-10-24 18:28:09'),
(18653, 39, 2961, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18654, 34, 2961, 'Easy Bathtub ', 'admin', '2016-10-24 18:28:09'),
(18655, 40, 2961, '1700 x 750 x 420 mm', 'admin', '2016-10-24 18:28:09'),
(18656, 41, 2961, 'RW248238001B', 'admin', '2016-10-24 18:28:09'),
(18657, 37, 2961, 'Water massage bathtub', 'admin', '2016-10-24 18:28:09'),
(18658, 35, 2961, '125000', 'admin', '2016-10-24 18:28:09'),
(18659, 39, 2962, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18660, 34, 2962, 'Georgia Free Standing Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18661, 40, 2962, '1850 x 1000 x 580 mm', 'admin', '2016-10-24 18:28:09'),
(18662, 41, 2962, 'RW247566001', 'admin', '2016-10-24 18:28:09'),
(18663, 37, 2962, 'Free-standing bathtub', 'admin', '2016-10-24 18:28:09'),
(18664, 35, 2962, '75200', 'admin', '2016-10-24 18:28:09'),
(18665, 39, 2963, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18666, 34, 2963, 'Ballet', 'admin', '2016-10-24 18:28:09'),
(18667, 40, 2963, '1815 x 835 x 630 mm', 'admin', '2016-10-24 18:28:09'),
(18668, 41, 2963, '', 'admin', '2016-10-24 18:28:09'),
(18669, 37, 2963, 'Free Standing White Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18670, 35, 2963, '15000', 'admin', '2016-10-24 18:28:09'),
(18671, 39, 2964, 'AcquaViva', 'admin', '2016-10-24 18:28:09'),
(18672, 34, 2964, 'Chateau', 'admin', '2016-10-24 18:28:09'),
(18673, 40, 2964, '1790 x 795 x 560 mm', 'admin', '2016-10-24 18:28:09'),
(18674, 41, 2964, '', 'admin', '2016-10-24 18:28:09'),
(18675, 37, 2964, 'Free Standing White Bath Tub With Chrome Legs', 'admin', '2016-10-24 18:28:09'),
(18676, 35, 2964, '25000', 'admin', '2016-10-24 18:28:09'),
(18677, 39, 2965, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18678, 34, 2965, 'Georgia Free Standing Bath Tub', 'admin', '2016-10-24 18:28:09'),
(18679, 40, 2965, '1850 x 1000 x 580 mm', 'admin', '2016-10-24 18:28:09'),
(18680, 41, 2965, 'RW247566001', 'admin', '2016-10-24 18:28:09'),
(18681, 37, 2965, 'Free-standing bathtub', 'admin', '2016-10-24 18:28:09'),
(18682, 35, 2965, '75200', 'admin', '2016-10-24 18:28:09'),
(18683, 39, 2966, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18684, 34, 2966, 'Easy Bathtub ', 'admin', '2016-10-24 18:28:09'),
(18685, 40, 2966, '1700 x 750 x 420 mm', 'admin', '2016-10-24 18:28:09'),
(18686, 41, 2966, 'RW248238001B', 'admin', '2016-10-24 18:28:09'),
(18687, 37, 2966, 'Water massage bathtub', 'admin', '2016-10-24 18:28:09'),
(18688, 35, 2966, '125000', 'admin', '2016-10-24 18:28:09'),
(18689, 39, 2967, 'Roca', 'admin', '2016-10-24 18:28:09'),
(18690, 34, 2967, 'Chateau', 'admin', '2016-10-24 18:28:09'),
(18691, 40, 2967, '1790 x 795 x 560 mm', 'admin', '2016-10-24 18:28:09'),
(18692, 41, 2967, '', 'admin', '2016-10-24 18:28:09'),
(18693, 37, 2967, 'Free Standing White Bath Tub With Chrome Legs', 'admin', '2016-10-24 18:28:09'),
(18694, 35, 2967, '25000', 'admin', '2016-10-24 18:28:09');

-- --------------------------------------------------------

--
-- Stand-in structure for view `attribute_view`
--
CREATE TABLE IF NOT EXISTS `attribute_view` (
`name` varchar(100)
,`value` varchar(100)
,`id` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `brands_data`
--
CREATE TABLE IF NOT EXISTS `brands_data` (
`product_id` int(10) unsigned
,`is_active` tinyint(1)
,`category_id` int(10) unsigned
,`subcategory_id` int(10) unsigned
,`brand_name` varchar(100)
);
-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `size_id` varchar(10) NOT NULL,
  `cart_status` varchar(100) NOT NULL,
  `quantity` int(10) NOT NULL,
  `price` varchar(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=159 ;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `size_id`, `cart_status`, `quantity`, `price`, `is_active`, `created_on`) VALUES
(1, 6, 2851, '1', 'www', 0, '', 0, '2016-09-06 10:42:06'),
(2, 6, 2850, '2', 'cart', 5, '35', 1, '2016-09-06 10:44:46'),
(3, 6, 2849, '3', 'cart', 5, '35', 1, '2016-09-06 10:44:49'),
(4, 6, 2848, '3', 'cart', 5, '35', 1, '2016-09-06 10:44:52'),
(5, 6, 2847, '2', 'cart', 5, '35', 1, '2016-09-06 10:44:57'),
(6, 6, 2846, '1', 'cart', 5, '35', 1, '2016-09-06 10:44:54'),
(7, 6, 2845, '2', 'cart', 5, '35', 1, '2016-09-06 10:45:09'),
(8, 6, 2844, '1', 'cart', 5, '35', 1, '2016-09-06 10:45:06'),
(9, 6, 2843, '1', 'cart', 1, '35', 1, '2016-09-06 10:45:03'),
(10, 6, 2842, '1', 'cart', 1, '35', 1, '2016-09-06 10:45:00'),
(11, 6, 2841, '1', 'cart', 1, '35', 1, '2016-09-06 10:44:43'),
(12, 6, 2840, '1', 'cart', 1, '35', 1, '2016-09-06 10:44:39'),
(13, 6, 1, '1', 'cart', 1, '121', 1, '2016-09-06 10:56:53'),
(14, 6, 1, '1', 'cart', 1, '35', 1, '2016-09-06 11:00:44'),
(15, 6, 1, '1', 'cart', 1, '35', 1, '2016-09-06 11:00:58'),
(16, 6, 1, '1', 'cart', 1, '35', 1, '2016-09-06 11:01:21'),
(17, 17, 2840, '', 'order_placed', 1, '35', 1, '2016-09-30 06:41:25'),
(18, 17, 1, '1', 'cart', 1, '35', 0, '2016-09-13 09:36:58'),
(20, 6, 1, '1', 'cart', 1, '35', 1, '2016-09-06 11:06:00'),
(22, 17, 2898, 'M', 'cart', 1, '35', 0, '2016-09-07 13:24:39'),
(23, 17, 2900, 'M', 'cart', 1, '35', 0, '2016-09-08 06:59:01'),
(24, 17, 2903, 'M', 'cart', 1, '35', 0, '2016-09-08 07:04:51'),
(25, 17, 2900, '', 'order_placed', 20, '35', 1, '2016-09-13 11:02:42'),
(26, 17, 2899, '', 'order_placed', 2, '35', 1, '2016-09-13 11:02:42'),
(27, 17, 2916, 'M', 'cart', 1, '35', 0, '2016-09-13 10:49:31'),
(28, 27, 2899, 'NA', 'cart', 1, '35', 1, '2016-09-12 14:32:33'),
(29, 27, 2904, '', 'cart', 3, '35', 0, '2016-10-27 08:26:10'),
(30, 27, 2899, 'NA', 'cart', 2, '35', 1, '2016-09-12 15:21:45'),
(31, 27, 2899, 'NA', 'cart', 1, '35', 1, '2016-09-12 15:21:47'),
(32, 27, 2899, 'NA', 'cart', 2, '35', 1, '2016-09-12 15:21:54'),
(33, 27, 2899, 'NA', 'cart', 3, '35', 1, '2016-09-12 15:21:56'),
(34, 27, 2899, 'NA', 'cart', 2, '35', 1, '2016-09-12 15:22:02'),
(35, 27, 2899, 'NA', 'cart', 1, '35', 1, '2016-09-12 15:22:03'),
(36, 27, 2904, '', 'cart', 4, '35', 0, '2016-10-27 08:24:09'),
(37, 27, 2906, 'NA', 'cart', 1, '35', 0, '2016-10-21 07:17:06'),
(38, 27, 2899, 'NA', 'cart', 2, '35', 1, '2016-09-13 08:05:49'),
(39, 27, 2899, 'NA', 'cart', 3, '35', 1, '2016-09-13 08:05:51'),
(40, 27, 2899, 'NA', 'cart', 2, '35', 1, '2016-09-13 08:06:00'),
(41, 27, 2899, 'NA', 'cart', 1, '35', 1, '2016-09-13 08:06:03'),
(42, 27, 2899, 'NA', 'cart', 2, '35', 1, '2016-09-13 08:07:46'),
(43, 27, 2899, 'NA', 'cart', 3, '35', 1, '2016-09-13 08:09:14'),
(44, 27, 2899, 'NA', 'cart', 2, '35', 1, '2016-09-13 08:09:15'),
(45, 27, 2899, 'NA', 'cart', 3, '35', 1, '2016-09-13 08:10:03'),
(46, 17, 2912, 'M', 'order_placed', 1, '35', 1, '2016-09-13 11:02:42'),
(47, 27, 2899, 'NA', 'cart', 4, '35', 1, '2016-09-13 08:10:44'),
(48, 27, 2899, 'NA', 'cart', 5, '35', 1, '2016-09-13 08:10:46'),
(49, 27, 2899, 'NA', 'cart', 6, '35', 1, '2016-09-13 08:10:49'),
(50, 27, 2899, 'NA', 'cart', 5, '35', 1, '2016-09-13 08:10:51'),
(51, 27, 2899, 'NA', 'cart', 4, '35', 1, '2016-09-13 08:10:53'),
(52, 27, 2899, 'NA', 'cart', 3, '35', 1, '2016-09-13 08:10:54'),
(53, 27, 2899, 'NA', 'cart', 2, '35', 1, '2016-09-13 08:11:19'),
(54, 27, 2899, 'NA', 'order_placed', 1, '35', 1, '2016-10-27 10:42:22'),
(55, 27, 2899, '', 'order_placed', 4, '35', 1, '2016-10-27 10:38:40'),
(56, 27, 2899, '', 'cart', 3, '35', 0, '2016-10-27 08:26:20'),
(57, 27, 2899, 'NA', 'cart', 2, '35', 0, '2016-10-27 08:25:07'),
(58, 27, 2899, 'NA', 'cart', 3, '35', 0, '2016-10-27 08:24:46'),
(59, 27, 2899, '', 'cart', 4, '35', 0, '2016-10-27 08:23:36'),
(60, 42, 2899, 'NA', 'order_placed', 2, '35', 1, '2016-09-13 13:38:57'),
(61, 42, 2899, 'NA', 'cart', 1, '35', 0, '2016-09-14 11:42:25'),
(62, 42, 1, 'XL', 'cart', 2, '35', 0, '2016-09-14 11:46:13'),
(63, 42, 2898, 'NA', 'cart', 2, '35', 0, '2016-09-14 11:59:22'),
(64, 42, 2906, 'NA', 'order_placed', 7, '35', 1, '2016-09-19 06:09:47'),
(65, 42, 2878, 'NA', 'cart', 1, '35', 1, '2016-09-19 06:26:04'),
(66, 21, 2899, 'NA', 'order_placed', 3, '35', 1, '2016-10-06 09:11:22'),
(67, 27, 2918, '', 'cart', 2, '35', 0, '2016-10-27 08:23:52'),
(68, 18, 2878, 'M', 'cart', 1, '35', 0, '2016-09-27 07:02:26'),
(69, 18, 2880, '', 'order_placed', 3, '35', 1, '2016-09-27 07:03:49'),
(70, 17, 2823, 'M', 'cart', 1, '35', 0, '2016-10-05 12:41:43'),
(71, 17, 2824, '', 'cart', 3, '35', 0, '2016-10-05 12:41:24'),
(72, 16, 2823, 'NA', 'order_placed', 2, '35', 1, '2016-10-06 09:06:53'),
(73, 16, 2920, 'NA', 'order_placed', 35, '35', 1, '2016-10-06 09:06:53'),
(74, 21, 2824, 'NA', 'order_placed', 2, '35', 1, '2016-10-06 09:12:28'),
(75, 18, 2824, 'NA', 'cart', 1, '35', 0, '2016-10-06 10:17:32'),
(76, 18, 2828, 'NA', 'cart', 1, '35', 0, '2016-10-06 10:15:12'),
(77, 18, 2828, 'NA', 'order_placed', 1, '35', 1, '2016-10-06 11:41:14'),
(78, 18, 2823, 'NA', 'cart', 1, '35', 0, '2016-10-06 10:33:09'),
(79, 18, 2836, 'NA', 'cart', 1, '35', 0, '2016-10-06 10:33:22'),
(80, 18, 2824, 'NA', 'cart', 2, '35', 0, '2016-10-06 11:36:00'),
(81, 18, 2838, 'NA', 'cart', 1, '35', 0, '2016-10-06 10:59:25'),
(82, 18, 2858, 'NA', 'cart', 1, '35', 0, '2016-10-06 10:59:31'),
(83, 18, 2827, 'NA', 'cart', 1, '35', 0, '2016-10-06 11:41:10'),
(84, 18, 2858, 'NA', 'order_placed', 1, '35', 1, '2016-10-06 11:41:14'),
(85, 18, 2829, 'NA', 'order_placed', 2, '35', 1, '2016-10-06 12:01:39'),
(86, 18, 2824, 'NA', 'cart', 1, '35', 0, '2016-10-12 12:48:28'),
(87, 17, 2865, '', 'cart', 2, '35', 0, '2016-10-07 05:35:12'),
(88, 17, 2865, 'M', 'order_placed', 1, '35', 1, '2016-10-07 05:36:19'),
(89, 17, 2872, 'M', 'cart', 1, '35', 0, '2016-10-07 05:57:09'),
(90, 17, 2872, 'M', 'order_placed', 1, '35', 1, '2016-10-07 05:57:27'),
(91, 42, 1, 'XL', 'cart', 2, '35', 1, '2016-10-07 06:04:30'),
(92, 42, 2, 'XL', 'order_placed', 2, '35', 1, '2016-10-07 06:28:01'),
(93, 42, 2, 'XL', 'cart', 2, '35', 0, '2016-10-07 06:32:05'),
(94, 42, 2, 'XL', 'cart', 2, '35', 0, '2016-10-07 06:32:26'),
(95, 21, 2898, 'NA', 'cart', 2, '35', 0, '2016-10-10 10:13:26'),
(96, 17, 2871, 'M', 'cart', 1, '35', 0, '2016-10-10 08:15:19'),
(97, 17, 2880, 'M', 'cart', 1, '35', 0, '2016-10-10 09:48:00'),
(98, 21, 2824, 'NA', 'order_placed', 1, '35', 1, '2016-10-10 10:13:48'),
(99, 17, 2872, 'M', 'cart', 1, '35', 0, '2016-10-12 07:56:10'),
(100, 17, 2872, '', 'order_placed', 2, '35', 1, '2016-10-12 07:58:13'),
(101, 21, 2834, 'NA', 'cart', 1, '35', 0, '2016-10-12 10:36:59'),
(102, 21, 2834, 'NA', 'cart', 1, '35', 0, '2016-10-12 10:37:10'),
(103, 21, 2834, 'NA', 'cart', 1, '35', 0, '2016-10-12 10:37:25'),
(104, 21, 2834, 'NA', 'order_placed', 2, '35', 1, '2016-10-12 10:37:47'),
(105, 17, 2833, 'M', 'order_placed', 1, '35', 1, '2016-10-12 11:27:54'),
(106, 17, 2833, '', 'cart', 7, '35', 0, '2016-10-27 09:11:41'),
(107, 17, 2838, '', 'cart', 4, '35', 0, '2016-10-27 09:09:25'),
(108, 21, 2834, 'NA', 'cart', 1, '35', 0, '2016-10-12 12:04:59'),
(109, 21, 2834, 'NA', 'order_placed', 1, '35', 1, '2016-10-12 13:00:14'),
(110, 21, 2834, 'M', 'order_placed', 1, '35', 1, '2016-10-17 08:22:42'),
(111, 21, 2933, 'NA', 'order_placed', 4, '35', 1, '2016-10-17 08:22:42'),
(112, 18, 2834, 'NA', 'cart', 6, '35', 0, '2016-10-20 10:41:14'),
(113, 18, 2932, 'NA', 'cart', 1, '35', 0, '2016-10-17 11:24:12'),
(114, 21, 2836, 'NA', 'order_placed', 2, '35', 1, '2016-10-17 11:22:13'),
(115, 18, 2838, 'NA', 'cart', 8, '35', 0, '2016-10-20 12:40:41'),
(116, 21, 2836, 'NA', 'order_placed', 1, '35', 1, '2016-10-19 08:12:03'),
(117, 21, 2835, 'NA', 'cart', 1, '35', 0, '2016-10-18 13:29:47'),
(118, 21, 2837, 'NA', 'cart', 1, '35', 0, '2016-10-17 11:36:37'),
(119, 21, 2838, 'NA', 'order_placed', 1, '35', 1, '2016-10-19 08:12:03'),
(120, 21, 2843, 'NA', 'cart', 2, '35', 0, '2016-10-17 11:36:35'),
(121, 21, 2850, 'NA', 'order_placed', 2, '35', 1, '2016-10-19 08:12:03'),
(122, 21, 2862, 'NA', 'order_placed', 3, '35', 1, '2016-10-19 08:12:03'),
(123, 21, 2865, 'NA', 'cart', 1, '35', 0, '2016-10-18 14:12:57'),
(124, 21, 2914, 'NA', 'cart', 2, '35', 0, '2016-10-20 04:58:52'),
(125, 16, 2845, 'NA', 'cart', 2, '35', 1, '2016-10-19 13:20:13'),
(126, 21, 2869, 'NA', 'order_placed', 1, '35', 1, '2016-10-20 04:59:33'),
(127, 47, 2834, '', 'order_placed', 1, '35', 1, '2016-10-20 06:53:56'),
(128, 21, 2836, 'NA', 'order_placed', 2, '35', 1, '2016-10-20 06:53:55'),
(129, 21, 2834, '', 'order_placed', 3, '35', 1, '2016-10-20 19:29:47'),
(130, 18, 2834, 'NA', 'cart', 2, '35', 1, '2016-10-20 12:40:44'),
(131, 47, 2833, '', 'cart', 3, '35', 1, '2016-10-26 07:16:00'),
(132, 47, 2836, '', 'cart', 3, '35', 1, '2016-10-26 07:16:04'),
(133, 21, 2837, '', 'cart', 2, '35', 0, '2016-10-20 19:29:43'),
(134, 21, 2910, 'NA', 'order_placed', 2, '35', 1, '2016-10-26 09:35:33'),
(135, 21, 2915, 'NA', 'order_placed', 4, '35', 1, '2016-10-26 09:35:33'),
(136, 21, 2877, '', 'cart', 3, '35', 0, '2016-10-24 09:51:44'),
(137, 21, 2847, 'NA', 'cart', 1, '35', 0, '2016-10-21 08:46:02'),
(138, 21, 2833, 'M', 'order_placed', 1, '35', 1, '2016-10-26 09:35:33'),
(139, 51, 2872, 'NA', 'cart', 2, '35', 1, '2016-10-25 06:21:09'),
(140, 49, 2853, '', 'order_placed', 1, '35', 1, '2016-10-26 06:33:36'),
(141, 49, 2839, '', 'cart', 3, '35', 0, '2016-10-26 06:33:35'),
(142, 49, 2877, 'M', 'cart', 1, '35', 1, '2016-10-26 06:44:21'),
(143, 27, 2846, '', 'cart', 6, '35', 0, '2016-10-27 08:25:43'),
(144, 27, 2850, '', 'order_placed', 2, '35', 1, '2016-10-27 10:38:40'),
(145, 27, 2847, '', 'cart', 8, '35', 0, '2016-10-27 08:27:36'),
(146, 17, 2834, '', 'cart', 8, '35', 0, '2016-10-27 08:50:59'),
(147, 17, 2837, '', 'order_placed', 8, '35', 1, '2016-10-27 09:36:33'),
(148, 17, 2844, 'M', 'cart', 1, '35', 0, '2016-10-27 09:12:59'),
(149, 17, 2842, 'M', 'order_placed', 1, '35', 1, '2016-10-27 09:36:33'),
(150, 47, 2900, 'M', 'cart', 1, '35', 1, '2016-10-27 10:13:10'),
(151, 47, 2838, 'M', 'cart', 1, '35', 1, '2016-10-27 10:13:21'),
(152, 47, 2923, 'M', 'cart', 1, '35', 1, '2016-10-27 10:13:39'),
(153, 27, 2833, 'M', 'order_placed', 1, '35', 1, '2016-10-27 10:42:22'),
(154, 21, 2834, 'NA', 'order_placed', 1, '35', 1, '2016-10-27 10:42:53'),
(155, 21, 2833, 'NA', 'order_placed', 1, '35', 1, '2016-10-27 10:46:21'),
(156, 21, 2836, 'NA', 'order_placed', 1, '35', 1, '2016-10-27 10:46:21'),
(157, 49, 2929, 'M', 'cart', 1, '35', 1, '2016-11-02 13:08:24'),
(158, 27, 2833, 'NA', 'cart', 1, '35', 1, '2016-11-04 14:27:15');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `favourite_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`favourite_id`),
  UNIQUE KEY `uk_favourites` (`favourite_id`),
  KEY `fk_user_details_favorites` (`user_id`),
  KEY `fk_product_favorites` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=128 ;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favourite_id`, `user_id`, `product_id`, `updated_on`) VALUES
(48, 42, 2899, '2016-08-30 14:50:00'),
(107, 16, 2845, '2016-10-19 18:49:26'),
(119, 51, 2872, '2016-10-25 11:49:32'),
(121, 49, 2877, '2016-10-26 12:14:25'),
(122, 17, 2842, '2016-10-27 14:42:45'),
(123, 17, 2899, '2016-10-27 15:06:15'),
(126, 21, 2899, '2016-10-27 16:52:30'),
(127, 49, 2929, '2016-11-02 18:38:22');

-- --------------------------------------------------------

--
-- Stand-in structure for view `general_search`
--
CREATE TABLE IF NOT EXISTS `general_search` (
`product_id` int(10) unsigned
,`concatdata` varchar(306)
);
-- --------------------------------------------------------

--
-- Table structure for table `market_news`
--

CREATE TABLE IF NOT EXISTS `market_news` (
  `news_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_category` varchar(50) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `image_url` varchar(1000) DEFAULT NULL,
  `headline` varchar(250) DEFAULT NULL,
  `details` varchar(10000) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `market_news`
--

INSERT INTO `market_news` (`news_id`, `news_category`, `priority`, `image_url`, `headline`, `details`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(5, 'Market News', 0, NULL, 'Fashion Sale on!', 'Test', '2016-06-02 06:21:19', 'admin', '2016-06-02 06:21:19', 'admin'),
(6, 'Market News', 0, NULL, 'Flash Sale on our selected range of products', 'Test 2', '2016-06-02 06:30:35', 'admin', '2016-06-02 06:30:35', 'admin'),
(7, '2', 1, './assets/market_news_img/748b827405315561d295aac092fc7820.gif', 'testing_lastlocal', 'hi', '2016-08-10 10:49:48', 'pankajcse1983', '2016-08-10 16:19:48', NULL),
(8, '1', 3, '', 'Testing add news', 'What exactly is shown on app', '2016-09-01 08:15:08', 'admin', '2016-09-01 13:45:08', NULL),
(9, '1', 1, '', 'Testing Admin News', 'Just checking how admin news is shown on iOS app', '2016-09-27 07:10:46', 'admin', '2016-09-27 12:40:46', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_attribute_header`
--

CREATE TABLE IF NOT EXISTS `master_attribute_header` (
  `attribute_header_id` int(10) NOT NULL AUTO_INCREMENT,
  `attribute_header_title` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `updated_by` varchar(45) NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by` varchar(45) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`attribute_header_id`),
  KEY `attribute_header_id` (`attribute_header_id`),
  KEY `attribute_header_id_2` (`attribute_header_id`),
  KEY `attribute_header_id_3` (`attribute_header_id`),
  KEY `attribute_header_id_4` (`attribute_header_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `master_attribute_header`
--

INSERT INTO `master_attribute_header` (`attribute_header_id`, `attribute_header_title`, `is_active`, `sort_order`, `updated_by`, `updated_on`, `created_by`, `created_on`) VALUES
(1, 'PRODUCT DETAILS', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00'),
(2, 'testing', 1, 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_attribute_type`
--

CREATE TABLE IF NOT EXISTS `master_attribute_type` (
  `attribute_type_id` int(11) NOT NULL,
  `attribute_type_title` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`attribute_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_attribute_type`
--

INSERT INTO `master_attribute_type` (`attribute_type_id`, `attribute_type_title`, `is_active`) VALUES
(1, 'GENERAL', 1),
(2, 'NUMBER', 1),
(3, 'CURRENCY', 1),
(4, 'DATE', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_city`
--

CREATE TABLE IF NOT EXISTS `master_city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(30) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `master_city`
--

INSERT INTO `master_city` (`id`, `city_name`, `is_active`) VALUES
(1, 'PUNE', '1'),
(2, 'MUMBAI', '1'),
(3, 'KOLKATA', '1'),
(4, 'DELHI', '1'),
(5, 'CHENNAI', '1'),
(6, 'BANGALORE', '1'),
(7, 'HYDERABAD', '1'),
(8, 'AHMEDABAD', '1'),
(9, 'SURAT', '1'),
(10, 'JAIPUR', '1'),
(11, 'LUCKNOW', '1'),
(12, 'KANPUR', '1'),
(13, 'NAGPUR', '1'),
(14, 'VISAKHAPATNAM', '1'),
(15, 'INDORE', '1'),
(16, 'BHOPAL', '1'),
(17, 'PATNA', '1'),
(18, 'VADODARA', '1'),
(19, 'GHAZIABAD', '1'),
(20, 'LUDHIANA', '1'),
(21, 'COIMBATORE', '1'),
(22, 'AGRA', '1'),
(23, 'MADURAI', '1'),
(24, 'All', '0');

-- --------------------------------------------------------

--
-- Table structure for table `master_market_news_category`
--

CREATE TABLE IF NOT EXISTS `master_market_news_category` (
  `news_category_id` int(11) NOT NULL,
  `news_category` varchar(50) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_market_news_category`
--

INSERT INTO `master_market_news_category` (`news_category_id`, `news_category`, `is_active`) VALUES
(1, 'Market News', '1'),
(2, 'Management News', '1'),
(3, 'Offers', '1');

-- --------------------------------------------------------

--
-- Table structure for table `master_news_priority`
--

CREATE TABLE IF NOT EXISTS `master_news_priority` (
  `news_priority` int(11) NOT NULL,
  `news_priority_title` varchar(50) NOT NULL,
  `news_priority_position` int(2) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_news_priority`
--

INSERT INTO `master_news_priority` (`news_priority`, `news_priority_title`, `news_priority_position`, `is_active`) VALUES
(1, 'High', 1, 1),
(2, 'Medium', 2, 1),
(3, 'Low', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_size`
--

CREATE TABLE IF NOT EXISTS `master_size` (
  `size_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`size_id`),
  KEY `size_id` (`size_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `master_size`
--

INSERT INTO `master_size` (`size_id`, `title`, `is_active`) VALUES
(1, 'XXXS', 1),
(2, 'XXS', 1),
(3, 'XS', 1),
(4, 'XS', 1),
(5, 'S', 1),
(6, 'M', 1),
(7, 'L', 1),
(8, 'XL', 1),
(9, 'XLL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_user_type`
--

CREATE TABLE IF NOT EXISTS `master_user_type` (
  `user_type_id` int(11) NOT NULL,
  `user_type` varchar(40) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_user_type`
--

INSERT INTO `master_user_type` (`user_type_id`, `user_type`, `is_active`) VALUES
(1, 'Retail', '1');

-- --------------------------------------------------------

--
-- Table structure for table `mood_images`
--

CREATE TABLE IF NOT EXISTS `mood_images` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_url` varchar(1000) DEFAULT NULL,
  `image_thumbnail_url` varchar(1000) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `mood_images`
--

INSERT INTO `mood_images` (`image_id`, `image_url`, `image_thumbnail_url`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(35, 'assets/img/home_page_images/580efe3cca159.JPG', 'assets/img/home_page_images/580efe3cca159_thumbnail.JPG', '2016-10-25 12:09:56', 'admin', '2016-10-25 12:09:56', 'admin'),
(36, 'assets/img/home_page_images/580efe3ce0a21.JPG', 'assets/img/home_page_images/580efe3ce0a21_thumbnail.JPG', '2016-10-25 12:09:56', 'admin', '2016-10-25 12:09:56', 'admin'),
(37, 'assets/img/home_page_images/580efe3cf2ad1.JPG', 'assets/img/home_page_images/580efe3cf2ad1_thumbnail.JPG', '2016-10-25 12:09:57', 'admin', '2016-10-25 12:09:57', 'admin'),
(38, 'assets/img/home_page_images/580efe3d10f40.JPG', 'assets/img/home_page_images/580efe3d10f40_thumbnail.JPG', '2016-10-25 12:09:57', 'admin', '2016-10-25 12:09:57', 'admin'),
(39, 'assets/img/home_page_images/580efe3d23977.jpg', 'assets/img/home_page_images/580efe3d23977_thumbnail.jpg', '2016-10-25 12:09:57', 'admin', '2016-10-25 12:09:57', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `mood_image_counter`
--

CREATE TABLE IF NOT EXISTS `mood_image_counter` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `counter` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `mood_image_counter`
--

INSERT INTO `mood_image_counter` (`id`, `counter`) VALUES
(1, 36);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pricing_table`
--
CREATE TABLE IF NOT EXISTS `pricing_table` (
`product_id` int(10) unsigned
,`product_name` varchar(100)
,`category_id` int(10) unsigned
,`subcategory_id` int(10) unsigned
,`description` varchar(250)
,`is_hot` varchar(10)
,`is_new` varchar(10)
,`created_on` datetime
,`created_by` varchar(50)
,`updated_on` datetime
,`updated_by` varchar(50)
,`Price` varchar(100)
);
-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `subcategory_id` int(10) unsigned DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `is_hot` varchar(10) DEFAULT NULL,
  `is_new` varchar(10) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`product_id`),
  KEY `fk_product_prod_subcategory` (`subcategory_id`),
  KEY `fk_product_prod_category` (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2969 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `category_id`, `subcategory_id`, `description`, `is_hot`, `is_new`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_active`) VALUES
(2823, '1', 95, 116, '', '0', '0', '2016-09-01 15:05:18', 'EXCEL', '2016-10-10 16:26:12', 'admin', 0),
(2824, '2', 95, 116, '', '0', '0', '2016-09-01 15:05:18', 'EXCEL', '2016-10-10 16:26:12', 'admin', 0),
(2825, '3', 95, 116, '', '0', '0', '2016-09-01 15:05:18', 'EXCEL', '2016-10-10 16:26:12', 'admin', 0),
(2826, '4', 95, 116, '', '0', '0', '2016-09-01 15:05:18', 'EXCEL', '2016-10-10 16:26:12', 'admin', 0),
(2827, '5', 95, 116, '', '0', '0', '2016-09-01 15:05:18', 'EXCEL', '2016-10-10 16:26:12', 'admin', 0),
(2828, '6', 95, 116, '', '0', '0', '2016-09-01 15:05:18', 'EXCEL', '2016-10-10 16:26:12', 'admin', 0),
(2829, '7', 95, 116, '', '0', '0', '2016-09-01 15:05:19', 'EXCEL', '2016-10-10 16:26:12', 'admin', 0),
(2830, '8', 95, 116, '', '0', '0', '2016-09-01 15:05:19', 'EXCEL', '2016-10-10 16:26:12', 'admin', 0),
(2831, '9', 95, 116, '', '0', '0', '2016-09-01 15:05:19', 'EXCEL', '2016-10-10 16:26:12', 'admin', 0),
(2832, '10', 95, 116, '', '0', '0', '2016-09-01 15:05:19', 'EXCEL', '2016-10-10 16:26:12', 'admin', 0),
(2833, '11', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2834, '12', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2835, '13', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2836, '14', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2837, '15', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2838, '16', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2839, '17', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2840, '18', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2841, '19', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2842, '20', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2843, '21', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2844, '22', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2845, '23', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2846, '24', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2847, '25', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2848, '26', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2849, '27', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2850, '28', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2851, '29', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2852, '30', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2853, '31', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2854, '32', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2855, '33', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2856, '34', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2857, '35', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2858, '36', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2859, '37', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2860, '38', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2861, '39', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2862, '40', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2863, '41', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2864, '42', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2865, '43', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2866, '44', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2867, '45', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2868, '46', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2869, '47', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2870, '48', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2871, '49', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2872, '50', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2873, '51', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2874, '52', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2875, '53', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2876, '54', 95, 116, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2877, '55', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2878, '56', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2879, '57', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2880, '58', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2881, '59', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2882, '60', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2883, '61', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2884, '62', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2885, '63', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2886, '64', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2887, '65', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2888, '66', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2889, '67', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2890, '68', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2891, '69', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2892, '70', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2893, '71', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2894, '72', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2895, '73', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2896, '74', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2897, '75', 95, 117, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2898, '76', 96, 118, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2899, '77', 96, 118, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2900, '78', 96, 118, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2901, '79', 96, 118, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2902, '80', 96, 118, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2903, '81', 96, 118, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2904, '82', 96, 118, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2905, '83', 96, 118, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2906, '84', 96, 118, '', '0', '0', '2016-10-24 18:28:08', 'EXCEL', '2016-10-24 18:28:08', 'admin', 1),
(2907, '85', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2908, '86', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2909, '87', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2910, '88', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2911, '89', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2912, '90', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2913, '91', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2914, '92', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2915, '93', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2916, '94', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2917, '95', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2918, '96', 96, 118, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2919, '97', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2920, '98', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2921, '99', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2922, '100', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2923, '101', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2924, '102', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2925, '103', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2926, '104', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2927, '105', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2928, '106', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2929, '107', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2930, '108', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2931, '109', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2932, '110', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2933, '111', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2934, '112', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2935, '113', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2936, '114', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2937, '115', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2938, '116', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2939, '117', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2940, '118', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2941, '119', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2942, '120', 97, 119, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2945, '1', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2946, '2', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2947, '3', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2948, '4', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2949, '5', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2950, '6', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2951, '7', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2952, '8', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2953, '9', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2954, '10', 95, 116, '', '0', '0', '2016-10-24 18:28:07', 'EXCEL', '2016-10-24 18:28:07', 'admin', 1),
(2956, '121', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2957, '122', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2958, '123', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2959, '124', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2960, '125', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2961, '126', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2962, '127', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2963, '128', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2964, '129', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2965, '130', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2966, '131', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1),
(2967, '132', 104, 123, '', '0', '0', '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_attribute_view`
--
CREATE TABLE IF NOT EXISTS `product_attribute_view` (
`id` int(10) unsigned
,`carat` varchar(100)
,`clarity` varchar(100)
,`price` varchar(100)
,`Colour` varchar(100)
,`Cut` varchar(100)
,`Polish` varchar(100)
,`Symmetry` varchar(100)
,`Fluor.` varchar(100)
);
-- --------------------------------------------------------

--
-- Table structure for table `product_catalog`
--

CREATE TABLE IF NOT EXISTS `product_catalog` (
  `catalog_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catalog_title` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `catalog_url` varchar(256) DEFAULT NULL,
  `catalog_size` varchar(20) DEFAULT NULL,
  `catalog_thumbnail` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `keywords` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`catalog_id`),
  UNIQUE KEY `catalog_url` (`catalog_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `product_catalog`
--

INSERT INTO `product_catalog` (`catalog_id`, `catalog_title`, `catalog_url`, `catalog_size`, `catalog_thumbnail`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_active`, `keywords`) VALUES
(24, 'jb-2016-workwear-3', 'assets/product_catalog/jb-2016-workwear-3.pdf', '11729375', 'assets/product_catalog/thumbnail/016d5042669b4be4618cb77738095609.jpg', '2016-06-01 13:29:55', '1312pari', '2016-06-01 13:29:55', '1312pari', 1, ''),
(26, 'Aquant_Bathroom_Fittings_Shower_Systems_Catalog_2015', 'assets/product_catalog/Aquant_Bathroom_Fittings_Shower_Systems_Catalog_2015.pdf', '14163.76', 'assets/product_catalog/thumbnail/016d5042669b4be4618cb77738095609.jpg', '2016-09-20 15:44:42', 'admin', '2016-09-20 15:44:42', 'admin', 1, ''),
(27, 'Bali_Onyx_Basins_Catalog_2015', 'assets/product_catalog/Bali_Onyx_Basins_Catalog_2015.pdf', '974.9', 'assets/product_catalog/thumbnail/016d5042669b4be4618cb77738095609.jpg', '2016-10-03 18:02:57', 'admin', '2016-10-03 18:02:57', 'admin', 1, ''),
(28, 'Shops_3-10-2016_15-2-91', 'assets/product_catalog/Shops_3-10-2016_15-2-91.pdf', '101.25', 'assets/product_catalog/thumbnail/016d5042669b4be4618cb77738095609.jpg', '2016-10-12 12:52:12', 'pankajcse1983', '2016-10-12 12:52:12', 'pankajcse1983', 1, ''),
(29, 'SPORLOC_Product_Features11', 'assets/product_catalog/SPORLOC_Product_Features11.pdf', '206.62', 'assets/product_catalog/thumbnail/de13459cee4c99f02e4e6366ec67af50.jpg', '2016-10-12 12:54:08', 'pankajcse1983', '2016-10-12 12:54:08', 'pankajcse1983', 1, ''),
(30, 'Aquant_Bathroom_Fittings_Shower_Systems_Catalog_2015', 'assets/product_catalog/abce/Aquant_Bathroom_Fittings_Shower_Systems_Catalog_2015.pdf', '524288', 'assets/product_catalog/thumbnail/016d5042669b4be4618cb77738095609.jpg', '2016-10-12 13:25:10', 'pankajcse1983', '2016-10-12 13:25:10', 'pankajcse1983', 1, ''),
(31, 'jb-2016-workwear-3', 'assets/product_catalog/abce/jb-2016-workwear-3.pdf', '11729375', 'assets/product_catalog/thumbnail/016d5042669b4be4618cb77738095609.jpg', '2016-10-12 13:25:10', 'pankajcse1983', '2016-10-12 13:25:10', 'pankajcse1983', 1, ''),
(32, 'SPORLOC_Product_Features1', 'assets/product_catalog/abce/SPORLOC_Product_Features1.pdf', '211576', 'assets/product_catalog/thumbnail/016d5042669b4be4618cb77738095609.jpg', '2016-10-12 13:25:10', 'pankajcse1983', '2016-10-12 13:25:10', 'pankajcse1983', 1, ''),
(33, 'chart', 'assets/product_catalog/d/chart.pdf', '10197', 'assets/product_catalog/thumbnail/6582b8b6d972e28ff3cc4d38c97a983f.jpg', '2016-10-12 14:45:00', 'pankajcse1983', '2016-10-12 14:45:00', 'pankajcse1983', 1, ''),
(34, 'chart', 'assets/product_catalog/2d/chart.pdf', '10197', 'assets/product_catalog/thumbnail/2cc33b32e0bc9c800da117bf3a92e81f.jpg', '2016-10-12 14:45:56', 'pankajcse1983', '2016-10-12 14:45:56', 'pankajcse1983', 1, ''),
(35, 'chart', 'assets/product_catalog/ss/chart.pdf', '10197', 'assets/product_catalog/thumbnail/14deb08263a49ad286af535ccc201a66.jpg', '2016-10-12 14:55:18', 'pankajcse1983', '2016-10-12 14:55:18', 'pankajcse1983', 1, ''),
(36, 'Shops_3-10-2016_15-2-95', 'assets/product_catalog/Shops_3-10-2016_15-2-95.pdf', '101.25', '', '2016-10-18 16:54:59', 'admin', '2016-10-18 16:54:59', 'admin', 1, ''),
(37, 'Shops_3-10-2016_15-2-96', 'assets/product_catalog/Shops_3-10-2016_15-2-96.pdf', '101.25', 'assets/product_catalog/thumbnail/29cc2b379445902e22e7c5c03c795088.jpg', '2016-10-18 17:13:57', 'admin', '2016-10-18 17:13:57', 'admin', 1, ''),
(38, 'Shops_3-10-2016_15-2-98', 'assets/product_catalog/Shops_3-10-2016_15-2-98.pdf', '101.25', 'assets/product_catalog/thumbnail/9b39278ffafeef3589aa0696634a8669.jpg', '2016-10-18 17:18:41', 'admin', '2016-10-18 17:18:41', 'admin', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `sort_order` int(3) NOT NULL,
  `image_url` varchar(1000) DEFAULT NULL,
  `image_thumbnail_url` varchar(1000) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`),
  UNIQUE KEY `category_name` (`category_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`, `description`, `sort_order`, `image_url`, `image_thumbnail_url`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_active`) VALUES
(95, 'Sanitary Ware', 'Added by EXCEL updated by admin updated by admin updated by admin updated by admin updated by admin ', 1, NULL, NULL, '2016-08-29 16:21:35', 'EXCEL', '2016-10-12 15:41:47', 'admin', 1),
(96, 'Bathroom Fittings', 'Added by EXCEL updated by admin updated by admin updated by admin ', 2, NULL, NULL, '2016-08-29 16:21:37', 'EXCEL', '2016-09-21 13:22:46', 'admin', 1),
(97, 'Wellness Products', 'Added by EXCEL updated by admin updated by admin updated by admin ', 3, NULL, NULL, '2016-08-29 16:21:37', 'EXCEL', '2016-09-21 13:23:06', 'admin', 1),
(102, 'Add Ons', 'Added by admin ', 4, NULL, NULL, '2016-10-18 14:53:17', 'admin', '0000-00-00 00:00:00', NULL, 1),
(103, 'Tiles', 'Added by admin ', 5, NULL, NULL, '2016-10-18 14:53:52', 'admin', '0000-00-00 00:00:00', NULL, 1),
(104, 'PNG Images', 'Added by EXCEL updated by admin updated by admin ', 6, NULL, NULL, '2016-10-24 18:28:09', 'EXCEL', '2016-10-25 16:43:57', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image_url` varchar(256) DEFAULT NULL,
  `image_thumbnail_url` varchar(256) DEFAULT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`image_id`),
  UNIQUE KEY `image_url` (`image_url`),
  UNIQUE KEY `image_thumbnail_url` (`image_thumbnail_url`),
  KEY `fk_product_images_product` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `image_url`, `image_thumbnail_url`, `product_id`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(98, 'assets/img/product/New_sd_up/76.jpg', 'assets/img/product/New_sd_up/76_thumb.jpg', 2898, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(99, 'assets/img/product/New_sd_up/77.jpg', 'assets/img/product/New_sd_up/77_thumb.jpg', 2899, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(100, 'assets/img/product/New_sd_up/78.jpg', 'assets/img/product/New_sd_up/78_thumb.jpg', 2900, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(101, 'assets/img/product/New_sd_up/79.jpg', 'assets/img/product/New_sd_up/79_thumb.jpg', 2901, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(102, 'assets/img/product/New_sd_up/80.jpg', 'assets/img/product/New_sd_up/80_thumb.jpg', 2902, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(103, 'assets/img/product/New_sd_up/81.jpg', 'assets/img/product/New_sd_up/81_thumb.jpg', 2903, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(104, 'assets/img/product/New_sd_up/82.jpg', 'assets/img/product/New_sd_up/82_thumb.jpg', 2904, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(105, 'assets/img/product/New_sd_up/83.jpg', 'assets/img/product/New_sd_up/83_thumb.jpg', 2905, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(106, 'assets/img/product/New_sd_up/84.jpg', 'assets/img/product/New_sd_up/84_thumb.jpg', 2906, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(107, 'assets/img/product/New_sd_up/85.jpg', 'assets/img/product/New_sd_up/85_thumb.jpg', 2907, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(108, 'assets/img/product/New_sd_up/86.jpg', 'assets/img/product/New_sd_up/86_thumb.jpg', 2908, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(109, 'assets/img/product/New_sd_up/87.jpg', 'assets/img/product/New_sd_up/87_thumb.jpg', 2909, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(110, 'assets/img/product/New_sd_up/88.jpg', 'assets/img/product/New_sd_up/88_thumb.jpg', 2910, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(111, 'assets/img/product/New_sd_up/89.jpg', 'assets/img/product/New_sd_up/89_thumb.jpg', 2911, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(112, 'assets/img/product/New_sd_up/90.Gif', 'assets/img/product/New_sd_up/90_thumb.Gif', 2912, '2016-08-30 15:59:27', 'admin', '2016-08-30 15:59:27', 'admin'),
(113, 'assets/img/product/New_sd_up/2.JPG', 'assets/img/product/New_sd_up/2_thumb.JPG', 2824, '2016-08-30 16:04:15', 'admin', '2016-08-30 16:04:15', 'admin'),
(114, 'assets/img/product/New_sd_up/3.JPG', 'assets/img/product/New_sd_up/3_thumb.JPG', 2825, '2016-08-30 16:04:15', 'admin', '2016-08-30 16:04:15', 'admin'),
(115, 'assets/img/product/Complied_testing-1/1.jpg', 'assets/img/product/Complied_testing-1/1_thumb.jpg', 2945, '2016-09-01 12:08:41', 'admin', '2016-10-20 17:59:47', 'admin'),
(116, 'assets/img/product/Complied_testing-1/10.JPG', 'assets/img/product/Complied_testing-1/10_thumb.JPG', 2954, '2016-09-01 12:08:41', 'admin', '2016-10-20 17:59:47', 'admin'),
(117, 'assets/img/product/Complied_testing-1/100.jpg', 'assets/img/product/Complied_testing-1/100_thumb.jpg', 2922, '2016-09-01 12:08:41', 'admin', '2016-10-20 17:59:47', 'admin'),
(118, 'assets/img/product/Complied_testing-1/101.jpg', 'assets/img/product/Complied_testing-1/101_thumb.jpg', 2923, '2016-09-01 12:08:41', 'admin', '2016-10-20 17:59:47', 'admin'),
(119, 'assets/img/product/Complied_testing-1/102.jpg', 'assets/img/product/Complied_testing-1/102_thumb.jpg', 2924, '2016-09-01 12:08:41', 'admin', '2016-10-20 17:59:47', 'admin'),
(120, 'assets/img/product/Complied_testing-1/103.jpg', 'assets/img/product/Complied_testing-1/103_thumb.jpg', 2925, '2016-09-01 12:08:41', 'admin', '2016-10-20 17:59:47', 'admin'),
(121, 'assets/img/product/Complied_testing-1/104.jpg', 'assets/img/product/Complied_testing-1/104_thumb.jpg', 2926, '2016-09-01 12:08:41', 'admin', '2016-10-20 17:59:47', 'admin'),
(122, 'assets/img/product/Complied_testing-1/105.jpg', 'assets/img/product/Complied_testing-1/105_thumb.jpg', 2927, '2016-09-01 12:08:41', 'admin', '2016-10-20 17:59:48', 'admin'),
(123, 'assets/img/product/Complied_testing-1/106.jpg', 'assets/img/product/Complied_testing-1/106_thumb.jpg', 2928, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(124, 'assets/img/product/Complied_testing-1/107.jpg', 'assets/img/product/Complied_testing-1/107_thumb.jpg', 2929, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(125, 'assets/img/product/Complied_testing-1/11.JPG', 'assets/img/product/Complied_testing-1/11_thumb.JPG', 2833, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(126, 'assets/img/product/Complied_testing-1/12.JPG', 'assets/img/product/Complied_testing-1/12_thumb.JPG', 2834, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(127, 'assets/img/product/Complied_testing-1/13.JPG', 'assets/img/product/Complied_testing-1/13_thumb.JPG', 2835, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(128, 'assets/img/product/Complied_testing-1/14.JPG', 'assets/img/product/Complied_testing-1/14_thumb.JPG', 2836, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(129, 'assets/img/product/Complied_testing-1/15.JPG', 'assets/img/product/Complied_testing-1/15_thumb.JPG', 2837, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(130, 'assets/img/product/Complied_testing-1/16.JPG', 'assets/img/product/Complied_testing-1/16_thumb.JPG', 2838, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(131, 'assets/img/product/Complied_testing-1/17.JPG', 'assets/img/product/Complied_testing-1/17_thumb.JPG', 2839, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(132, 'assets/img/product/Complied_testing-1/18.JPG', 'assets/img/product/Complied_testing-1/18_thumb.JPG', 2840, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(133, 'assets/img/product/Complied_testing-1/19.JPG', 'assets/img/product/Complied_testing-1/19_thumb.JPG', 2841, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(134, 'assets/img/product/Complied_testing-1/2.jpg', 'assets/img/product/Complied_testing-1/2_thumb.jpg', 2946, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(135, 'assets/img/product/Complied_testing-1/20.JPG', 'assets/img/product/Complied_testing-1/20_thumb.JPG', 2842, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(136, 'assets/img/product/Complied_testing-1/21.JPG', 'assets/img/product/Complied_testing-1/21_thumb.JPG', 2843, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(137, 'assets/img/product/Complied_testing-1/22.JPG', 'assets/img/product/Complied_testing-1/22_thumb.JPG', 2844, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(138, 'assets/img/product/Complied_testing-1/23.JPG', 'assets/img/product/Complied_testing-1/23_thumb.JPG', 2845, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(139, 'assets/img/product/Complied_testing-1/24.JPG', 'assets/img/product/Complied_testing-1/24_thumb.JPG', 2846, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(140, 'assets/img/product/Complied_testing-1/25.JPG', 'assets/img/product/Complied_testing-1/25_thumb.JPG', 2847, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(141, 'assets/img/product/Complied_testing-1/26.JPG', 'assets/img/product/Complied_testing-1/26_thumb.JPG', 2848, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(142, 'assets/img/product/Complied_testing-1/27.JPG', 'assets/img/product/Complied_testing-1/27_thumb.JPG', 2849, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(143, 'assets/img/product/Complied_testing-1/28.JPG', 'assets/img/product/Complied_testing-1/28_thumb.JPG', 2850, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(144, 'assets/img/product/Complied_testing-1/29.JPG', 'assets/img/product/Complied_testing-1/29_thumb.JPG', 2851, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(145, 'assets/img/product/Complied_testing-1/3.JPG', 'assets/img/product/Complied_testing-1/3_thumb.JPG', 2947, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(146, 'assets/img/product/Complied_testing-1/30.JPG', 'assets/img/product/Complied_testing-1/30_thumb.JPG', 2852, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(147, 'assets/img/product/Complied_testing-1/31.JPG', 'assets/img/product/Complied_testing-1/31_thumb.JPG', 2853, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(148, 'assets/img/product/Complied_testing-1/32.JPG', 'assets/img/product/Complied_testing-1/32_thumb.JPG', 2854, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(149, 'assets/img/product/Complied_testing-1/33.JPG', 'assets/img/product/Complied_testing-1/33_thumb.JPG', 2855, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(150, 'assets/img/product/Complied_testing-1/34.JPG', 'assets/img/product/Complied_testing-1/34_thumb.JPG', 2856, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(151, 'assets/img/product/Complied_testing-1/35.JPG', 'assets/img/product/Complied_testing-1/35_thumb.JPG', 2857, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(152, 'assets/img/product/Complied_testing-1/36.JPG', 'assets/img/product/Complied_testing-1/36_thumb.JPG', 2858, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(153, 'assets/img/product/Complied_testing-1/37.JPG', 'assets/img/product/Complied_testing-1/37_thumb.JPG', 2859, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(154, 'assets/img/product/Complied_testing-1/38.JPG', 'assets/img/product/Complied_testing-1/38_thumb.JPG', 2860, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(155, 'assets/img/product/Complied_testing-1/39.JPG', 'assets/img/product/Complied_testing-1/39_thumb.JPG', 2861, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(156, 'assets/img/product/Complied_testing-1/4.JPG', 'assets/img/product/Complied_testing-1/4_thumb.JPG', 2948, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(157, 'assets/img/product/Complied_testing-1/40.JPG', 'assets/img/product/Complied_testing-1/40_thumb.JPG', 2862, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(158, 'assets/img/product/Complied_testing-1/41.JPG', 'assets/img/product/Complied_testing-1/41_thumb.JPG', 2863, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(159, 'assets/img/product/Complied_testing-1/42.jpg', 'assets/img/product/Complied_testing-1/42_thumb.jpg', 2864, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(160, 'assets/img/product/Complied_testing-1/43.JPG', 'assets/img/product/Complied_testing-1/43_thumb.JPG', 2865, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(161, 'assets/img/product/Complied_testing-1/44.JPG', 'assets/img/product/Complied_testing-1/44_thumb.JPG', 2866, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(162, 'assets/img/product/Complied_testing-1/45.jpg', 'assets/img/product/Complied_testing-1/45_thumb.jpg', 2867, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(163, 'assets/img/product/Complied_testing-1/46.jpg', 'assets/img/product/Complied_testing-1/46_thumb.jpg', 2868, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(164, 'assets/img/product/Complied_testing-1/47.JPG', 'assets/img/product/Complied_testing-1/47_thumb.JPG', 2869, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(165, 'assets/img/product/Complied_testing-1/48.JPG', 'assets/img/product/Complied_testing-1/48_thumb.JPG', 2870, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(166, 'assets/img/product/Complied_testing-1/49.jpg', 'assets/img/product/Complied_testing-1/49_thumb.jpg', 2871, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(167, 'assets/img/product/Complied_testing-1/5.JPG', 'assets/img/product/Complied_testing-1/5_thumb.JPG', 2949, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(168, 'assets/img/product/Complied_testing-1/50.jpg', 'assets/img/product/Complied_testing-1/50_thumb.jpg', 2872, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(169, 'assets/img/product/Complied_testing-1/51.jpg', 'assets/img/product/Complied_testing-1/51_thumb.jpg', 2873, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(170, 'assets/img/product/Complied_testing-1/52.jpg', 'assets/img/product/Complied_testing-1/52_thumb.jpg', 2874, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(171, 'assets/img/product/Complied_testing-1/53.jpg', 'assets/img/product/Complied_testing-1/53_thumb.jpg', 2875, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(172, 'assets/img/product/Complied_testing-1/54.JPG', 'assets/img/product/Complied_testing-1/54_thumb.JPG', 2876, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(173, 'assets/img/product/Complied_testing-1/55.JPG', 'assets/img/product/Complied_testing-1/55_thumb.JPG', 2877, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(174, 'assets/img/product/Complied_testing-1/56.JPG', 'assets/img/product/Complied_testing-1/56_thumb.JPG', 2878, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(175, 'assets/img/product/Complied_testing-1/57.JPG', 'assets/img/product/Complied_testing-1/57_thumb.JPG', 2879, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(176, 'assets/img/product/Complied_testing-1/58.JPG', 'assets/img/product/Complied_testing-1/58_thumb.JPG', 2880, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(177, 'assets/img/product/Complied_testing-1/59.JPG', 'assets/img/product/Complied_testing-1/59_thumb.JPG', 2881, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(178, 'assets/img/product/Complied_testing-1/6.JPG', 'assets/img/product/Complied_testing-1/6_thumb.JPG', 2950, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(179, 'assets/img/product/Complied_testing-1/60.JPG', 'assets/img/product/Complied_testing-1/60_thumb.JPG', 2882, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(180, 'assets/img/product/Complied_testing-1/61.JPG', 'assets/img/product/Complied_testing-1/61_thumb.JPG', 2883, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:48', 'admin'),
(181, 'assets/img/product/Complied_testing-1/62.JPG', 'assets/img/product/Complied_testing-1/62_thumb.JPG', 2884, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(182, 'assets/img/product/Complied_testing-1/63.JPG', 'assets/img/product/Complied_testing-1/63_thumb.JPG', 2885, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(183, 'assets/img/product/Complied_testing-1/64.JPG', 'assets/img/product/Complied_testing-1/64_thumb.JPG', 2886, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(184, 'assets/img/product/Complied_testing-1/65.jpg', 'assets/img/product/Complied_testing-1/65_thumb.jpg', 2887, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(185, 'assets/img/product/Complied_testing-1/66.jpg', 'assets/img/product/Complied_testing-1/66_thumb.jpg', 2888, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(186, 'assets/img/product/Complied_testing-1/67.jpg', 'assets/img/product/Complied_testing-1/67_thumb.jpg', 2889, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(187, 'assets/img/product/Complied_testing-1/68.jpg', 'assets/img/product/Complied_testing-1/68_thumb.jpg', 2890, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(188, 'assets/img/product/Complied_testing-1/69.jpg', 'assets/img/product/Complied_testing-1/69_thumb.jpg', 2891, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(189, 'assets/img/product/Complied_testing-1/7.JPG', 'assets/img/product/Complied_testing-1/7_thumb.JPG', 2951, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(190, 'assets/img/product/Complied_testing-1/70.PNG', 'assets/img/product/Complied_testing-1/70_thumb.PNG', 2892, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(191, 'assets/img/product/Complied_testing-1/71.PNG', 'assets/img/product/Complied_testing-1/71_thumb.PNG', 2893, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(192, 'assets/img/product/Complied_testing-1/72.PNG', 'assets/img/product/Complied_testing-1/72_thumb.PNG', 2894, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(193, 'assets/img/product/Complied_testing-1/73.PNG', 'assets/img/product/Complied_testing-1/73_thumb.PNG', 2895, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(194, 'assets/img/product/Complied_testing-1/74.jpg', 'assets/img/product/Complied_testing-1/74_thumb.jpg', 2896, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(195, 'assets/img/product/Complied_testing-1/75.jpg', 'assets/img/product/Complied_testing-1/75_thumb.jpg', 2897, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(196, 'assets/img/product/Complied_testing-1/76.jpg', 'assets/img/product/Complied_testing-1/76_thumb.jpg', 2898, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(197, 'assets/img/product/Complied_testing-1/77.jpg', 'assets/img/product/Complied_testing-1/77_thumb.jpg', 2899, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(198, 'assets/img/product/Complied_testing-1/78.jpg', 'assets/img/product/Complied_testing-1/78_thumb.jpg', 2900, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(199, 'assets/img/product/Complied_testing-1/79.jpg', 'assets/img/product/Complied_testing-1/79_thumb.jpg', 2901, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(200, 'assets/img/product/Complied_testing-1/8.JPG', 'assets/img/product/Complied_testing-1/8_thumb.JPG', 2952, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(201, 'assets/img/product/Complied_testing-1/80.jpg', 'assets/img/product/Complied_testing-1/80_thumb.jpg', 2902, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(202, 'assets/img/product/Complied_testing-1/81.jpg', 'assets/img/product/Complied_testing-1/81_thumb.jpg', 2903, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(203, 'assets/img/product/Complied_testing-1/82.jpg', 'assets/img/product/Complied_testing-1/82_thumb.jpg', 2904, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(204, 'assets/img/product/Complied_testing-1/83.jpg', 'assets/img/product/Complied_testing-1/83_thumb.jpg', 2905, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(205, 'assets/img/product/Complied_testing-1/84.jpg', 'assets/img/product/Complied_testing-1/84_thumb.jpg', 2906, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(206, 'assets/img/product/Complied_testing-1/85.jpg', 'assets/img/product/Complied_testing-1/85_thumb.jpg', 2907, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(207, 'assets/img/product/Complied_testing-1/86.jpg', 'assets/img/product/Complied_testing-1/86_thumb.jpg', 2908, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(208, 'assets/img/product/Complied_testing-1/87.jpg', 'assets/img/product/Complied_testing-1/87_thumb.jpg', 2909, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(209, 'assets/img/product/Complied_testing-1/88.jpg', 'assets/img/product/Complied_testing-1/88_thumb.jpg', 2910, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(210, 'assets/img/product/Complied_testing-1/89.jpg', 'assets/img/product/Complied_testing-1/89_thumb.jpg', 2911, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(211, 'assets/img/product/Complied_testing-1/9.JPG', 'assets/img/product/Complied_testing-1/9_thumb.JPG', 2953, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(212, 'assets/img/product/Complied_testing-1/90.Gif', 'assets/img/product/Complied_testing-1/90_thumb.Gif', 2912, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(213, 'assets/img/product/Complied_testing-1/93.jpg', 'assets/img/product/Complied_testing-1/93_thumb.jpg', 2915, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(214, 'assets/img/product/Complied_testing-1/94.jpg', 'assets/img/product/Complied_testing-1/94_thumb.jpg', 2916, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(215, 'assets/img/product/Complied_testing-1/95.jpg', 'assets/img/product/Complied_testing-1/95_thumb.jpg', 2917, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(216, 'assets/img/product/Complied_testing-1/96.jpg', 'assets/img/product/Complied_testing-1/96_thumb.jpg', 2918, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(217, 'assets/img/product/Complied_testing-1/97.jpg', 'assets/img/product/Complied_testing-1/97_thumb.jpg', 2919, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(218, 'assets/img/product/Complied_testing-1/98.jpg', 'assets/img/product/Complied_testing-1/98_thumb.jpg', 2920, '2016-09-01 12:08:42', 'admin', '2016-10-20 17:59:49', 'admin'),
(219, 'assets/img/product/Complied_testing-1/99.jpg', 'assets/img/product/Complied_testing-1/99_thumb.jpg', 2921, '2016-09-01 12:08:43', 'admin', '2016-10-20 17:59:50', 'admin'),
(220, 'assets/img/product/Sample_PNG_images/121.png', 'assets/img/product/Sample_PNG_images/121_thumb.png', 2956, '2016-10-24 18:29:08', 'admin', '2016-10-24 18:29:08', 'admin'),
(221, 'assets/img/product/Sample_PNG_images/122.png', 'assets/img/product/Sample_PNG_images/122_thumb.png', 2957, '2016-10-24 18:29:08', 'admin', '2016-10-24 18:29:08', 'admin'),
(222, 'assets/img/product/Sample_PNG_images/123.png', 'assets/img/product/Sample_PNG_images/123_thumb.png', 2958, '2016-10-24 18:29:08', 'admin', '2016-10-24 18:29:08', 'admin'),
(223, 'assets/img/product/Sample_PNG_images/124.png', 'assets/img/product/Sample_PNG_images/124_thumb.png', 2959, '2016-10-24 18:29:08', 'admin', '2016-10-24 18:29:08', 'admin'),
(224, 'assets/img/product/Sample_PNG_images/125.png', 'assets/img/product/Sample_PNG_images/125_thumb.png', 2960, '2016-10-24 18:29:08', 'admin', '2016-10-24 18:29:08', 'admin'),
(225, 'assets/img/product/Sample_PNG_images/126.png', 'assets/img/product/Sample_PNG_images/126_thumb.png', 2961, '2016-10-24 18:29:08', 'admin', '2016-10-24 18:29:08', 'admin'),
(226, 'assets/img/product/Sample_PNG_images/127.png', 'assets/img/product/Sample_PNG_images/127_thumb.png', 2962, '2016-10-24 18:29:08', 'admin', '2016-10-24 18:29:08', 'admin'),
(227, 'assets/img/product/Sample_PNG_images/128.png', 'assets/img/product/Sample_PNG_images/128_thumb.png', 2963, '2016-10-24 18:29:08', 'admin', '2016-10-24 18:29:08', 'admin'),
(228, 'assets/img/product/Sample_PNG_images/129.png', 'assets/img/product/Sample_PNG_images/129_thumb.png', 2964, '2016-10-24 18:29:09', 'admin', '2016-10-24 18:29:09', 'admin'),
(229, 'assets/img/product/Sample_PNG_images/130.png', 'assets/img/product/Sample_PNG_images/130_thumb.png', 2965, '2016-10-24 18:29:09', 'admin', '2016-10-24 18:29:09', 'admin'),
(230, 'assets/img/product/Sample_PNG_images/131.png', 'assets/img/product/Sample_PNG_images/131_thumb.png', 2966, '2016-10-24 18:29:09', 'admin', '2016-10-24 18:29:09', 'admin'),
(231, 'assets/img/product/Sample_PNG_images/132.png', 'assets/img/product/Sample_PNG_images/132_thumb.png', 2967, '2016-10-24 18:29:09', 'admin', '2016-10-24 18:29:09', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `product_subcategory`
--

CREATE TABLE IF NOT EXISTS `product_subcategory` (
  `subcategory_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `sort_order` int(3) NOT NULL,
  `image_url` varchar(1000) DEFAULT NULL,
  `image_thumbnail_url` varchar(1000) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`subcategory_id`),
  UNIQUE KEY `subcategory_name` (`subcategory_name`),
  UNIQUE KEY `uk_prod_subcategory` (`category_id`,`subcategory_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=125 ;

--
-- Dumping data for table `product_subcategory`
--

INSERT INTO `product_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`, `description`, `sort_order`, `image_url`, `image_thumbnail_url`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_active`) VALUES
(116, 'Ceramic Basins', 95, 'updated by admin ', 1, NULL, NULL, '2016-08-29 16:21:35', 'EXCEL', '2016-09-21 13:24:38', 'admin', 1),
(117, 'Boutique Designer Counter Top Basins', 95, 'updated by admin ', 2, NULL, NULL, '2016-08-29 16:21:36', 'EXCEL', '2016-09-21 13:24:25', 'admin', 1),
(118, 'Luxury Shower Concepts', 96, 'Added by EXCEL updated by admin', 0, NULL, NULL, '2016-08-29 16:21:37', 'EXCEL', '2016-08-29 16:21:37', 'admin', 1),
(119, 'Bathtubs & Whirpools', 97, 'Added by EXCEL updated by admin', 0, NULL, NULL, '2016-08-29 16:21:37', 'EXCEL', '2016-08-29 16:21:37', 'admin', 1),
(123, 'Test', 104, 'Added by EXCEL updated by admin', 0, NULL, NULL, '2016-10-24 18:28:09', 'EXCEL', '2016-10-24 18:28:09', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `push_notification_data`
--

CREATE TABLE IF NOT EXISTS `push_notification_data` (
  `notification_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `message` varchar(256) DEFAULT NULL,
  `sent_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sent_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `fk_push_notification_data` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rfq_data`
--

CREATE TABLE IF NOT EXISTS `rfq_data` (
  `data_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rfq_id` varchar(50) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `requested_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `response_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `valid_till` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rfq_status` varchar(100) DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`data_id`),
  KEY `fk_rfq_data_user` (`user_id`),
  KEY `fk_rfq_data_product` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=60 ;

--
-- Dumping data for table `rfq_data`
--

INSERT INTO `rfq_data` (`data_id`, `rfq_id`, `user_id`, `product_id`, `requested_on`, `response_on`, `valid_till`, `rfq_status`, `updated_on`, `updated_by`) VALUES
(1, '2016-09-06-7', 7, 2824, '2016-09-06 13:04:12', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 13:04:12', NULL),
(2, '2016-09-06-7', 7, 2824, '2016-09-06 13:05:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 13:05:48', NULL),
(3, '2016-09-06-7', 7, 2824, '2016-09-06 13:06:15', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 13:06:15', NULL),
(4, '2016-09-06-17', 17, 2899, '2016-09-06 13:31:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 13:31:50', NULL),
(5, '2016-09-06-17', 17, 2901, '2016-09-06 13:31:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 13:31:50', NULL),
(6, '2016-09-06-17', 17, 2918, '2016-09-06 13:31:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 13:31:50', NULL),
(7, '2016-09-06-17', 17, 2918, '2016-09-06 13:31:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 13:31:50', NULL),
(8, '2016-09-06-17', 17, 2901, '2016-09-06 13:31:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 13:31:50', NULL),
(9, '2016-09-06-17', 17, 2899, '2016-09-06 13:31:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 13:31:50', NULL),
(10, '2016-09-06-7', 7, 2824, '2016-09-06 14:22:32', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 14:22:32', NULL),
(11, '2016-09-06-7', 7, 2824, '2016-09-06 14:22:43', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 14:22:43', NULL),
(12, '2016-09-06-7', 7, 2824, '2016-09-06 14:23:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 14:23:35', NULL),
(13, '2016-09-06-17', 17, 2918, '2016-09-06 14:29:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 14:29:11', NULL),
(14, '2016-09-06-7', 7, 2824, '2016-09-06 14:31:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 14:31:21', NULL),
(16, '2016-09-06-7', 7, 2918, '2016-09-06 14:32:01', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 14:32:01', NULL),
(17, '2016-09-06-17', 17, 2899, '2016-09-06 14:33:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-06 14:33:11', NULL),
(18, '2016-09-20-21', 21, 2899, '2016-09-20 15:22:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-20 15:22:51', NULL),
(19, '2016-09-20-42', 42, 2899, '2016-09-20 15:35:20', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-20 15:35:20', NULL),
(20, '2016-09-23-27', 27, 2899, '2016-09-23 19:09:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-23 19:09:11', NULL),
(21, '2016-09-26-27', 27, 2918, '2016-09-26 11:43:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-09-26 11:43:48', NULL),
(22, '2016-10-03-18', 18, 2880, '2016-10-03 17:31:10', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-03 17:31:10', NULL),
(23, '2016-10-06-17', 17, 2824, '2016-10-06 11:36:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-06 11:36:06', NULL),
(24, '2016-10-10-17', 17, 2878, '2016-10-10 15:18:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-10 15:18:47', NULL),
(25, '2016-10-10-17', 17, 2880, '2016-10-10 15:18:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-10 15:18:47', NULL),
(26, '2016-10-10-17', 17, 2883, '2016-10-10 15:18:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-10 15:18:47', NULL),
(27, '2016-10-10-17', 17, 2878, '2016-10-10 15:19:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-10 15:19:07', NULL),
(28, '2016-10-10-17', 17, 2880, '2016-10-10 15:19:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-10 15:19:07', NULL),
(29, '2016-10-10-17', 17, 2883, '2016-10-10 15:19:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-10 15:19:07', NULL),
(30, '2016-10-10-17', 17, 2878, '2016-10-10 15:19:07', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-10 15:19:07', NULL),
(31, '2016-10-10-21', 21, 2834, '2016-10-10 17:11:23', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-10 17:11:23', NULL),
(32, '2016-10-12-17', 17, 2834, '2016-10-12 13:53:52', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-12 13:53:52', NULL),
(33, '2016-10-12-18', 18, 2834, '2016-10-12 15:23:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-12 15:23:33', NULL),
(34, '2016-10-12-18', 18, 2839, '2016-10-12 15:23:33', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-12 15:23:33', NULL),
(35, '2016-10-12-21', 21, 2836, '2016-10-12 18:44:22', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-12 18:44:22', NULL),
(36, '2016-10-12-21', 21, 2836, '2016-10-12 18:46:11', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-12 18:46:11', NULL),
(37, '2016-10-12-21', 21, 2836, '2016-10-12 18:47:08', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-12 18:47:08', NULL),
(38, '2016-10-12-21', 21, 2836, '2016-10-12 18:53:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-12 18:53:53', NULL),
(39, '2016-10-12-17', 17, 2825, '2016-10-12 18:56:40', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-12 18:56:40', NULL),
(40, '2016-10-12-21', 21, 2825, '2016-10-12 19:08:21', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-12 19:08:21', NULL),
(41, '2016-10-12-21', 21, 2825, '2016-10-12 19:10:50', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-12 19:10:50', NULL),
(42, '2016-10-13-21', 21, 2834, '2016-10-13 11:01:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-13 11:01:53', NULL),
(43, '2016-10-17-21', 21, 2866, '2016-10-17 13:53:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-17 13:53:02', NULL),
(44, '2016-10-17-21', 21, 2872, '2016-10-17 13:53:02', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-17 13:53:02', NULL),
(45, '2016-10-17-18', 18, 2839, '2016-10-17 16:59:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-17 16:59:14', NULL),
(46, '2016-10-24-21', 21, 2915, '2016-10-24 16:32:14', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-24 16:32:14', NULL),
(47, '2016-10-25-27', 27, 2835, '2016-10-25 16:47:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-25 16:47:16', NULL),
(48, '2016-10-25-27', 27, 2835, '2016-10-25 16:47:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-25 16:47:16', NULL),
(49, '2016-10-25-27', 27, 2835, '2016-10-25 16:47:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-25 16:47:16', NULL),
(50, '2016-10-25-27', 27, 2835, '2016-10-25 16:47:16', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-25 16:47:16', NULL),
(51, '2016-10-25-27', 27, 2833, '2016-10-25 17:28:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-25 17:28:06', NULL),
(52, '2016-10-25-27', 27, 2833, '2016-10-25 17:28:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-25 17:28:06', NULL),
(53, '2016-10-25-27', 27, 2833, '2016-10-25 17:28:06', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-25 17:28:06', NULL),
(54, '2016-10-26-27', 27, 2833, '2016-10-26 12:10:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-26 12:10:04', NULL),
(55, '2016-10-26-27', 27, 2833, '2016-10-26 12:10:04', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-26 12:10:04', NULL),
(56, '2016-10-27-27', 27, 2833, '2016-10-27 16:17:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-27 16:17:53', NULL),
(57, '2016-10-27-27', 27, 2833, '2016-10-27 16:17:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-27 16:17:53', NULL),
(58, '2016-10-27-27', 27, 2833, '2016-10-27 16:17:53', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-27 16:17:53', NULL),
(59, '2016-10-27-21', 21, 2833, '2016-10-27 16:18:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'request', '2016-10-27 16:18:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_log`
--

CREATE TABLE IF NOT EXISTS `user_activity_log` (
  `activity_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `activity_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `event_type` varchar(1000) NOT NULL,
  `activity_comment` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`activity_id`),
  KEY `fk_user_details_activity` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=495 ;

--
-- Dumping data for table `user_activity_log`
--

INSERT INTO `user_activity_log` (`activity_id`, `activity_time`, `user_id`, `username`, `event_type`, `activity_comment`) VALUES
(79, '2016-06-01 14:43:51', 7, '', 'Login', ' user logged in'),
(80, '2016-06-02 08:15:23', 7, '', 'Login', ' user logged in'),
(82, '2016-06-02 09:30:26', 7, '', 'Login', ' user logged in'),
(83, '2016-06-02 10:57:25', 7, '', 'Login', ' user logged in'),
(91, '2016-06-03 09:26:03', 7, '', 'Login', ' user logged in'),
(92, '2016-06-03 13:45:54', 7, '', 'Login', ' user logged in'),
(93, '2016-06-03 13:53:49', 7, '', 'favourites', 'Product [24]Added to Favourites'),
(94, '2016-06-03 13:53:51', 7, '', 'favourites', 'Product [24]Removed From Favourites'),
(95, '2016-06-03 13:53:55', 7, '', 'favourites', 'Product [24]Added to Favourites'),
(96, '2016-06-03 14:23:28', 7, '', 'favourites', 'Product [28]Added to Favourites'),
(97, '2016-06-03 14:23:30', 7, '', 'favourites', 'Product [28]Removed From Favourites'),
(98, '2016-06-03 14:23:33', 7, '', 'favourites', 'Product [28]Added to Favourites'),
(99, '2016-06-03 15:06:16', 7, '', 'Login', ' user logged in'),
(103, '2016-06-04 07:08:07', 7, '', 'favourites', 'Product [23]Added to Favourites'),
(104, '2016-06-04 07:15:53', 7, '', 'favourites', 'Product [23]Removed From Favourites'),
(105, '2016-06-04 07:29:09', 7, '', 'favourites', 'Product [11]Added to Favourites'),
(106, '2016-06-06 14:38:25', 7, '', 'Login', ' user logged in'),
(107, '2016-06-06 15:03:39', 7, '', 'favourites', 'Product [2]Added to Favourites'),
(108, '2016-06-06 15:03:59', 7, '', 'favourites', 'Product [1]Added to Favourites'),
(109, '2016-06-06 15:16:01', 7, '', 'favourites', 'Product [26]Added to Favourites'),
(110, '2016-06-06 15:16:05', 7, '', 'favourites', 'Product [26]Removed From Favourites'),
(118, '2016-06-13 15:40:26', 7, '', 'Login', ' user logged in'),
(119, '2016-06-14 07:59:43', 7, '', 'Login', ' user logged in'),
(133, '2016-07-15 12:06:32', 12, '', 'Signup', 'New User Signed Up'),
(141, '2016-07-25 09:06:15', 16, '', 'Signup', 'New User Signed Up'),
(142, '2016-07-25 09:06:56', 17, '', 'Signup', 'New User Signed Up'),
(143, '2016-07-25 09:12:13', 18, '', 'Signup', 'New User Signed Up'),
(146, '2016-07-25 09:16:07', 21, '', 'Signup', 'New User Signed Up'),
(147, '2016-07-25 09:19:07', 21, '', 'Login', ' user logged in'),
(152, '2016-07-25 09:31:58', 26, '', 'Signup', 'New User Signed Up'),
(153, '2016-07-25 09:57:12', 21, '', 'Login', ' user logged in'),
(154, '2016-07-25 10:40:36', 8, '', 'Login', ' user logged in'),
(155, '2016-07-25 10:55:20', 21, '', 'favourites', 'Product [23]Added to Favourites'),
(156, '2016-07-25 10:58:34', 27, '', 'Signup', 'New User Signed Up'),
(157, '2016-07-25 10:59:44', 8, '', 'Login', ' user logged in'),
(163, '2016-07-25 11:32:08', 27, '', 'Login', ' user logged in'),
(164, '2016-07-25 11:33:13', 27, '', 'Login', ' user logged in'),
(165, '2016-07-25 11:40:25', 27, '', 'Login', ' user logged in'),
(166, '2016-07-25 12:37:28', 27, '', 'Login', ' user logged in'),
(174, '2016-07-25 13:20:37', 27, '', 'Login', ' user logged in'),
(177, '2016-07-25 13:22:12', 27, '', 'favourites', 'Product [24]Added to Favourites'),
(183, '2016-07-25 13:34:38', 27, '', 'Login', ' user logged in'),
(184, '2016-07-25 14:24:46', 27, '', 'Login', ' user logged in'),
(185, '2016-07-25 14:35:28', 27, '', 'Login', ' user logged in'),
(186, '2016-07-25 14:36:52', 27, '', 'favourites', 'Product [24]Removed From Favourites'),
(187, '2016-07-26 06:32:34', 18, '', 'Login', ' user logged in'),
(188, '2016-07-26 07:37:52', 18, '', 'Login', ' user logged in'),
(189, '2016-07-26 07:48:33', 27, '', 'Login', ' user logged in'),
(190, '2016-07-27 06:58:23', 18, '', 'Login', ' user logged in'),
(191, '2016-07-27 06:59:03', 18, '', 'favourites', 'Product [11]Added to Favourites'),
(192, '2016-07-27 06:59:20', 18, '', 'favourites', 'Product [17]Added to Favourites'),
(193, '2016-07-27 07:18:46', 18, '', 'Login', ' user logged in'),
(194, '2016-07-27 08:37:22', 18, '', 'Login', ' user logged in'),
(195, '2016-07-27 08:50:25', 18, '', 'favourites', 'Product [24]Added to Favourites'),
(196, '2016-07-27 08:50:27', 18, '', 'favourites', 'Product [24]Removed From Favourites'),
(197, '2016-07-27 09:51:36', 18, '', 'Login', ' user logged in'),
(198, '2016-07-27 10:03:52', 27, '', 'Login', ' user logged in'),
(199, '2016-07-27 10:04:43', 27, '', 'Login', ' user logged in'),
(200, '2016-07-27 10:06:34', 27, '', 'favourites', 'Product [23]Added to Favourites'),
(201, '2016-07-27 10:06:39', 27, '', 'favourites', 'Product [27]Added to Favourites'),
(202, '2016-07-27 10:23:03', 7, '', 'Login', ' user logged in'),
(203, '2016-07-27 10:33:05', 7, '', 'favourites', 'Product [23]Added to Favourites'),
(204, '2016-07-27 10:33:09', 7, '', 'favourites', 'Product [24]Added to Favourites'),
(205, '2016-07-27 11:13:23', 7, '', 'Login', ' user logged in'),
(206, '2016-07-27 11:14:32', 7, '', 'favourites', 'Product [27]Added to Favourites'),
(207, '2016-07-28 07:59:49', 7, '', 'favourites', 'Product [26]Added to Favourites'),
(208, '2016-07-28 08:38:50', 40, '', 'Login', ' user logged in'),
(209, '2016-07-28 08:38:50', 40, '', 'Signup', 'New User Signed Up'),
(210, '2016-08-29 15:22:48', 17, '', 'Login', ' user logged in'),
(211, '2016-08-29 15:23:44', 17, '', 'Login', ' user logged in'),
(212, '2016-08-29 15:23:48', 17, '', 'Login', ' user logged in'),
(213, '2016-08-29 15:26:02', 17, '', 'Login', ' user logged in'),
(214, '2016-08-29 15:35:30', 17, '', 'Login', ' user logged in'),
(215, '2016-08-29 15:57:22', 17, '', 'Login', ' user logged in'),
(216, '2016-08-29 16:11:21', 17, '', 'Login', ' user logged in'),
(217, '2016-08-29 17:42:14', 17, '', 'Login', ' user logged in'),
(218, '2016-08-29 18:24:51', 42, '', 'Signup', 'New User Signed Up'),
(219, '2016-08-29 18:27:03', 42, '', 'Login', ' user logged in'),
(220, '2016-08-30 14:19:12', 42, '', 'favourites', 'Product [77]Added to Favourites'),
(221, '2016-08-30 14:19:14', 42, '', 'favourites', 'Product [77]Removed From Favourites'),
(222, '2016-08-30 14:50:00', 42, '', 'favourites', 'Product [77]Added to Favourites'),
(223, '2016-08-31 15:10:17', 43, '', 'Signup', 'New User Signed Up'),
(224, '2016-08-31 15:10:53', 16, '', 'Login', ' user logged in'),
(225, '2016-08-31 15:26:53', 16, '', 'favourites', 'Product [77]Added to Favourites'),
(226, '2016-08-31 15:27:01', 16, '', 'favourites', 'Product [77]Removed From Favourites'),
(227, '2016-08-31 15:27:44', 16, '', 'favourites', 'Product [77]Added to Favourites'),
(228, '2016-08-31 15:33:02', 18, '', 'Login', ' user logged in'),
(229, '2016-08-31 15:33:43', 21, '', 'Login', ' user logged in'),
(230, '2016-08-31 15:34:21', 21, '', 'favourites', 'Product [81]Added to Favourites'),
(231, '2016-08-31 15:53:09', 18, '', 'Login', ' user logged in'),
(232, '2016-08-31 15:54:08', 18, '', 'Login', ' user logged in'),
(233, '2016-08-31 16:03:09', 27, '', 'Login', ' user logged in'),
(234, '2016-08-31 16:10:51', 40, '', 'Login', ' user logged in'),
(235, '2016-08-31 16:11:22', 40, '', 'Login', ' user logged in'),
(236, '2016-08-31 16:38:04', 18, '', 'Login', ' user logged in'),
(237, '2016-08-31 16:48:44', 17, '', 'favourites', 'Product [76]Added to Favourites'),
(238, '2016-08-31 16:51:35', 17, '', 'favourites', 'Product [76]Added to Favourites'),
(239, '2016-08-31 16:51:44', 17, '', 'favourites', 'Product [77]Added to Favourites'),
(240, '2016-08-31 16:51:50', 17, '', 'favourites', 'Product [79]Added to Favourites'),
(241, '2016-08-31 16:53:00', 18, '', 'Login', ' user logged in'),
(242, '2016-08-31 16:53:23', 18, '', 'Login', ' user logged in'),
(243, '2016-08-31 16:54:52', 18, '', 'Login', ' user logged in'),
(244, '2016-08-31 16:55:47', 18, '', 'Login', ' user logged in'),
(245, '2016-08-31 16:57:08', 18, '', 'Login', ' user logged in'),
(246, '2016-08-31 16:57:45', 18, '', 'Login', ' user logged in'),
(247, '2016-08-31 16:59:43', 18, '', 'Login', ' user logged in'),
(248, '2016-08-31 17:05:50', 18, '', 'Login', ' user logged in'),
(249, '2016-08-31 17:06:05', 18, '', 'Login', ' user logged in'),
(250, '2016-08-31 17:06:28', 44, '', 'Login', ' user logged in'),
(251, '2016-08-31 17:06:28', 44, '', 'Signup', 'New User Signed Up'),
(252, '2016-08-31 17:07:15', 44, '', 'Login', ' user logged in'),
(253, '2016-08-31 17:07:19', 44, '', 'Login', ' user logged in'),
(254, '2016-08-31 17:09:21', 44, '', 'Login', ' user logged in'),
(255, '2016-08-31 17:09:47', 44, '', 'Login', ' user logged in'),
(256, '2016-08-31 17:09:59', 45, '', 'Login', ' user logged in'),
(257, '2016-08-31 17:09:59', 45, '', 'Signup', 'New User Signed Up'),
(258, '2016-08-31 17:12:52', 46, '', 'Signup', 'New User Signed Up'),
(259, '2016-08-31 17:17:25', 27, '', 'Login', ' user logged in'),
(260, '2016-09-01 12:15:33', 42, '', 'favourites', 'Product [58]Added to Favourites'),
(261, '2016-09-01 13:09:34', 18, '', 'Login', ' user logged in'),
(262, '2016-09-01 13:14:40', 18, '', 'favourites', 'Product [78]Added to Favourites'),
(263, '2016-09-01 13:21:49', 18, '', 'Login', ' user logged in'),
(264, '2016-09-01 13:31:37', 18, '', 'favourites', 'Product [78]Removed From Favourites'),
(265, '2016-09-01 13:33:44', 18, '', 'favourites', 'Product [78]Added to Favourites'),
(266, '2016-09-01 13:33:50', 18, '', 'favourites', 'Product [78]Removed From Favourites'),
(267, '2016-09-01 13:46:47', 18, '', 'favourites', 'Product [77]Added to Favourites'),
(268, '2016-09-01 14:57:30', 18, '', 'favourites', 'Product [76]Added to Favourites'),
(269, '2016-09-01 14:57:45', 18, '', 'favourites', 'Product [76]Removed From Favourites'),
(270, '2016-09-01 15:23:49', 18, '', 'Login', ' user logged in'),
(271, '2016-09-01 15:25:02', 18, '', 'Login', ' user logged in'),
(272, '2016-09-01 16:07:13', 18, '', 'Login', ' user logged in'),
(273, '2016-09-01 16:07:20', 18, '', 'favourites', 'Product [77]Removed From Favourites'),
(274, '2016-09-02 13:48:32', 18, '', 'favourites', 'Product [77]Added to Favourites'),
(275, '2016-09-02 13:48:37', 18, '', 'favourites', 'Product [77]Removed From Favourites'),
(276, '2016-09-02 13:55:15', 42, '', 'favourites', 'Product [58]Removed From Favourites'),
(277, '2016-09-02 15:28:40', 21, '', 'Login', ' user logged in'),
(278, '2016-09-02 15:41:18', 17, '', 'Login', ' user logged in'),
(279, '2016-09-02 15:42:47', 17, '', 'favourites', 'Product [96]Added to Favourites'),
(280, '2016-09-02 18:16:32', 27, '', 'Login', ' user logged in'),
(281, '2016-09-05 15:54:10', 27, '', 'favourites', 'Product [77]Added to Favourites'),
(282, '2016-09-13 16:26:00', 42, '', 'Login', ' user logged in'),
(283, '2016-09-16 18:37:18', 7, '', 'Login', ' user logged in'),
(284, '2016-09-19 13:33:07', 27, '', 'Login', ' user logged in'),
(285, '2016-09-19 15:06:15', 27, '', 'Login', ' user logged in'),
(286, '2016-09-19 19:08:43', 21, '', 'Login', ' user logged in'),
(287, '2016-09-19 19:39:42', 42, '', 'favourites', 'Product [56]Added to Favourites'),
(288, '2016-09-19 19:40:33', 42, '', 'favourites', 'Product [56]Removed From Favourites'),
(289, '2016-09-19 19:44:19', 42, '', 'favourites', 'Product [78]Added to Favourites'),
(290, '2016-09-19 19:44:53', 42, '', 'favourites', 'Product [78]Removed From Favourites'),
(291, '2016-09-20 15:06:29', 21, '', 'Login', ' user logged in'),
(292, '2016-09-20 15:09:13', 21, '', 'favourites', 'Product [77]Added to Favourites'),
(293, '2016-09-20 15:38:37', 21, '', 'favourites', 'Product [76]Added to Favourites'),
(294, '2016-09-20 15:42:37', 18, '', 'Login', ' user logged in'),
(295, '2016-09-20 15:47:58', 21, '', 'Login', ' user logged in'),
(296, '2016-09-20 18:38:43', 21, '', 'favourites', 'Product [77]Removed From Favourites'),
(297, '2016-09-21 17:13:54', 27, '', 'Login', ' user logged in'),
(298, '2016-09-21 18:00:27', 27, '', 'Login', ' user logged in'),
(299, '2016-09-21 18:38:01', 21, '', 'Login', ' user logged in'),
(300, '2016-09-21 18:54:25', 21, '', 'Login', ' user logged in'),
(301, '2016-09-21 19:30:42', 27, '', 'Login', ' user logged in'),
(302, '2016-09-21 19:43:45', 27, '', 'Login', ' user logged in'),
(303, '2016-09-21 20:06:46', 27, '', 'Login', ' user logged in'),
(304, '2016-09-21 20:42:21', 27, '', 'Login', ' user logged in'),
(305, '2016-09-22 16:47:23', 27, '', 'Login', ' user logged in'),
(306, '2016-09-22 17:14:52', 27, '', 'Login', ' user logged in'),
(307, '2016-09-22 18:43:43', 27, '', 'Login', ' user logged in'),
(308, '2016-09-26 11:42:11', 27, '', 'favourites', 'Product [96]Added to Favourites'),
(309, '2016-09-26 11:59:59', 18, '', 'Login', ' user logged in'),
(310, '2016-09-26 12:03:32', 18, '', 'Login', ' user logged in'),
(311, '2016-09-27 11:50:59', 27, '', 'favourites', 'Product [94]Added to Favourites'),
(312, '2016-09-27 11:53:15', 18, '', 'Login', ' user logged in'),
(313, '2016-09-27 12:01:48', 18, '', 'Login', ' user logged in'),
(314, '2016-09-27 12:14:35', 18, '', 'Login', ' user logged in'),
(315, '2016-09-27 12:26:26', 18, '', 'favourites', 'Product [58]Added to Favourites'),
(316, '2016-09-27 12:26:37', 18, '', 'favourites', 'Product [56]Added to Favourites'),
(317, '2016-09-27 12:26:46', 18, '', 'favourites', 'Product [56]Removed From Favourites'),
(318, '2016-09-27 12:26:48', 18, '', 'favourites', 'Product [56]Added to Favourites'),
(319, '2016-09-27 12:32:01', 18, '', 'favourites', 'Product [56]Removed From Favourites'),
(320, '2016-09-28 17:49:40', 27, '', 'Login', ' user logged in'),
(321, '2016-09-28 18:04:59', 27, '', 'Login', ' user logged in'),
(322, '2016-09-28 18:58:14', 27, '', 'Login', ' user logged in'),
(323, '2016-09-29 15:28:36', 18, '', 'Login', ' user logged in'),
(324, '2016-09-29 16:47:12', 27, '', 'Login', ' user logged in'),
(325, '2016-09-29 20:02:54', 27, '', 'Login', ' user logged in'),
(326, '2016-10-03 13:40:04', 27, '', 'favourites', 'Product [2]Added to Favourites'),
(327, '2016-10-03 13:50:16', 18, '', 'Login', ' user logged in'),
(328, '2016-10-03 13:57:31', 18, '', 'Login', ' user logged in'),
(329, '2016-10-03 14:03:51', 18, '', 'Login', ' user logged in'),
(330, '2016-10-03 15:13:54', 17, '', 'favourites', 'Product [1]Added to Favourites'),
(331, '2016-10-03 15:13:57', 17, '', 'favourites', 'Product [1]Removed From Favourites'),
(332, '2016-10-03 15:13:59', 17, '', 'favourites', 'Product [1]Added to Favourites'),
(333, '2016-10-03 15:14:03', 17, '', 'favourites', 'Product [1]Removed From Favourites'),
(334, '2016-10-03 17:15:08', 18, '', 'Login', ' user logged in'),
(335, '2016-10-03 18:10:25', 18, '', 'favourites', 'Product [3]Added to Favourites'),
(336, '2016-10-03 18:10:33', 18, '', 'favourites', 'Product [3]Removed From Favourites'),
(337, '2016-10-03 18:35:33', 27, '', 'favourites', 'Product [2]Removed From Favourites'),
(338, '2016-10-03 19:04:47', 27, '', 'favourites', 'Product [1]Added to Favourites'),
(339, '2016-10-03 19:04:54', 27, '', 'favourites', 'Product [1]Removed From Favourites'),
(340, '2016-10-03 19:05:09', 27, '', 'favourites', 'Product [4]Added to Favourites'),
(341, '2016-10-03 19:05:13', 27, '', 'favourites', 'Product [5]Added to Favourites'),
(342, '2016-10-03 19:05:24', 27, '', 'favourites', 'Product [4]Removed From Favourites'),
(343, '2016-10-04 12:06:24', 18, '', 'Login', ' user logged in'),
(344, '2016-10-04 12:06:49', 18, '', 'Login', ' user logged in'),
(345, '2016-10-04 12:45:50', 21, '', 'Login', ' user logged in'),
(346, '2016-10-04 13:03:17', 21, '', 'favourites', 'Product [76]Removed From Favourites'),
(347, '2016-10-04 13:03:24', 21, '', 'favourites', 'Product [81]Removed From Favourites'),
(348, '2016-10-04 15:38:23', 17, '', 'Login', ' user logged in'),
(349, '2016-10-04 17:30:41', 27, '', 'favourites', 'Product [5]Removed From Favourites'),
(350, '2016-10-04 18:21:16', 21, '', 'Login', ' user logged in'),
(351, '2016-10-04 18:22:41', 18, '', 'Login', ' user logged in'),
(352, '2016-10-04 18:27:49', 18, '', 'Login', ' user logged in'),
(353, '2016-10-04 18:30:55', 21, '', 'Login', ' user logged in'),
(354, '2016-10-04 18:32:45', 21, '', 'favourites', 'Product [98]Added to Favourites'),
(355, '2016-10-04 18:32:52', 21, '', 'favourites', 'Product [98]Removed From Favourites'),
(356, '2016-10-05 17:43:45', 17, '', 'favourites', 'Product [2]Added to Favourites'),
(357, '2016-10-06 14:34:17', 16, '', 'Login', ' user logged in'),
(358, '2016-10-06 14:35:40', 16, '', 'favourites', 'Product [1]Added to Favourites'),
(359, '2016-10-06 14:36:24', 16, '', 'favourites', 'Product [101]Added to Favourites'),
(360, '2016-10-06 15:43:53', 18, '', 'favourites', 'Product [2]Added to Favourites'),
(361, '2016-10-06 17:33:12', 18, '', 'favourites', 'Product [2]Added to Favourites'),
(362, '2016-10-07 10:55:36', 17, '', 'favourites', 'Product [43]Added to Favourites'),
(363, '2016-10-07 10:55:48', 17, '', 'favourites', 'Product [43]Removed From Favourites'),
(364, '2016-10-07 11:25:25', 17, '', 'favourites', 'Product [44]Added to Favourites'),
(365, '2016-10-07 11:25:32', 17, '', 'favourites', 'Product [44]Removed From Favourites'),
(366, '2016-10-07 12:35:27', 17, '', 'Login', ' user logged in'),
(367, '2016-10-07 13:56:53', 17, '', 'Login', ' user logged in'),
(368, '2016-10-07 14:34:23', 17, '', 'favourites', 'Product [1]Added to Favourites'),
(369, '2016-10-07 14:34:28', 17, '', 'favourites', 'Product [2]Added to Favourites'),
(370, '2016-10-07 14:34:45', 17, '', 'favourites', 'Product [2]Removed From Favourites'),
(371, '2016-10-07 14:34:52', 17, '', 'favourites', 'Product [1]Removed From Favourites'),
(372, '2016-10-10 12:02:33', 21, '', 'Login', ' user logged in'),
(373, '2016-10-10 15:15:53', 17, '', 'favourites', 'Product [61]Added to Favourites'),
(374, '2016-10-10 15:16:42', 17, '', 'favourites', 'Product [56]Added to Favourites'),
(375, '2016-10-10 15:17:01', 17, '', 'favourites', 'Product [58]Added to Favourites'),
(376, '2016-10-10 15:19:36', 17, '', 'favourites', 'Product [58]Removed From Favourites'),
(377, '2016-10-10 15:19:57', 17, '', 'favourites', 'Product [56]Removed From Favourites'),
(378, '2016-10-10 15:20:20', 17, '', 'favourites', 'Product [61]Removed From Favourites'),
(379, '2016-10-10 15:31:07', 16, '', 'Login', ' user logged in'),
(380, '2016-10-10 15:36:38', 21, '', 'Login', ' user logged in'),
(381, '2016-10-10 15:36:53', 21, '', 'favourites', 'Product [2]Added to Favourites'),
(382, '2016-10-10 15:39:41', 21, '', 'favourites', 'Product [2]Removed From Favourites'),
(383, '2016-10-10 17:11:16', 21, '', 'favourites', 'Product [12]Added to Favourites'),
(384, '2016-10-10 17:52:19', 21, '', 'Login', ' user logged in'),
(385, '2016-10-10 18:36:32', 21, '', 'Login', ' user logged in'),
(386, '2016-10-10 18:49:02', 21, '', 'Login', ' user logged in'),
(387, '2016-10-12 12:58:32', 17, '', 'Login', ' user logged in'),
(388, '2016-10-12 13:29:32', 17, '', 'favourites', 'Product [44]Added to Favourites'),
(389, '2016-10-12 13:29:58', 17, '', 'favourites', 'Product [44]Removed From Favourites'),
(390, '2016-10-12 13:53:29', 17, '', 'favourites', 'Product [12]Added to Favourites'),
(391, '2016-10-12 15:06:27', 17, '', 'Login', ' user logged in'),
(392, '2016-10-12 15:23:16', 18, '', 'favourites', 'Product [12]Added to Favourites'),
(393, '2016-10-12 15:23:19', 18, '', 'favourites', 'Product [17]Added to Favourites'),
(394, '2016-10-12 15:59:35', 21, '', 'Login', ' user logged in'),
(395, '2016-10-12 16:06:42', 21, '', 'favourites', 'Product [12]Added to Favourites'),
(396, '2016-10-12 16:08:00', 21, '', 'favourites', 'Product [12]Removed From Favourites'),
(397, '2016-10-12 16:56:28', 17, '', 'Login', ' user logged in'),
(398, '2016-10-12 16:56:36', 17, '', 'favourites', 'Product [12]Removed From Favourites'),
(399, '2016-10-12 18:25:15', 21, '', 'Login', ' user logged in'),
(400, '2016-10-12 18:44:08', 21, '', 'favourites', 'Product [14]Added to Favourites'),
(401, '2016-10-12 18:52:36', 21, '', 'Login', ' user logged in'),
(402, '2016-10-13 11:01:44', 21, '', 'favourites', 'Product [12]Added to Favourites'),
(403, '2016-10-13 13:23:49', 21, '', 'Login', ' user logged in'),
(404, '2016-10-13 13:24:01', 21, '', 'favourites', 'Product [12]Removed From Favourites'),
(405, '2016-10-13 13:24:20', 21, '', 'favourites', 'Product [12]Added to Favourites'),
(406, '2016-10-13 13:35:32', 21, '', 'Login', ' user logged in'),
(407, '2016-10-13 13:44:00', 21, '', 'favourites', 'Product [44]Added to Favourites'),
(408, '2016-10-13 18:46:12', 21, '', 'Login', ' user logged in'),
(409, '2016-10-13 18:47:40', 21, '', 'favourites', 'Product [50]Added to Favourites'),
(410, '2016-10-13 18:47:53', 21, '', 'favourites', 'Product [14]Removed From Favourites'),
(411, '2016-10-17 13:52:50', 21, '', 'favourites', 'Product [11]Added to Favourites'),
(412, '2016-10-17 16:48:44', 18, '', 'favourites', 'Product [12]Removed From Favourites'),
(413, '2016-10-18 18:16:33', 21, '', 'Login', ' user logged in'),
(414, '2016-10-18 19:37:57', 21, '', 'Login', ' user logged in'),
(415, '2016-10-19 12:41:26', 47, '', 'Signup', 'New User Signed Up'),
(416, '2016-10-19 12:42:28', 48, '', 'Signup', 'New User Signed Up'),
(417, '2016-10-19 13:41:45', 21, '', 'favourites', 'Product [58]Added to Favourites'),
(418, '2016-10-19 18:01:19', 49, '', 'Signup', 'New User Signed Up'),
(419, '2016-10-19 18:48:13', 16, '', 'Login', ' user logged in'),
(420, '2016-10-19 18:49:26', 16, '', 'favourites', 'Product [23]Added to Favourites'),
(421, '2016-10-20 11:36:42', 47, '', 'Login', ' user logged in'),
(422, '2016-10-20 11:50:07', 21, '', 'Login', ' user logged in'),
(423, '2016-10-20 11:52:10', 21, '', 'Login', ' user logged in'),
(424, '2016-10-20 15:45:27', 18, '', 'Login', ' user logged in'),
(425, '2016-10-20 15:50:42', 18, '', 'Login', ' user logged in'),
(426, '2016-10-20 15:53:56', 27, '', 'Login', ' user logged in'),
(427, '2016-10-20 16:09:22', 18, '', 'Login', ' user logged in'),
(428, '2016-10-20 17:32:50', 18, '', 'favourites', 'Product [14]Added to Favourites'),
(429, '2016-10-20 17:33:45', 18, '', 'favourites', 'Product [12]Added to Favourites'),
(430, '2016-10-20 17:33:51', 18, '', 'favourites', 'Product [16]Added to Favourites'),
(431, '2016-10-20 18:29:37', 21, '', 'Login', ' user logged in'),
(432, '2016-10-20 21:08:59', 27, '', 'Login', ' user logged in'),
(433, '2016-10-21 00:58:22', 21, '', 'Login', ' user logged in'),
(434, '2016-10-21 12:20:06', 27, '', 'Login', ' user logged in'),
(435, '2016-10-21 12:24:08', 27, '', 'Login', ' user logged in'),
(436, '2016-10-21 14:06:41', 27, '', 'Login', ' user logged in'),
(437, '2016-10-21 14:57:43', 21, '', 'favourites', 'Product [11]Added to Favourites'),
(438, '2016-10-21 14:57:57', 21, '', 'favourites', 'Product [11]Removed From Favourites'),
(439, '2016-10-21 14:57:59', 21, '', 'favourites', 'Product [11]Added to Favourites'),
(440, '2016-10-21 15:04:15', 18, '', 'Login', ' user logged in'),
(441, '2016-10-21 15:09:27', 21, '', 'Login', ' user logged in'),
(442, '2016-10-24 11:23:33', 21, '', 'Login', ' user logged in'),
(443, '2016-10-24 12:17:55', 50, '', 'Signup', 'New User Signed Up'),
(444, '2016-10-24 12:20:52', 50, '', 'Login', ' user logged in'),
(445, '2016-10-24 13:36:49', 27, '', 'Login', ' user logged in'),
(446, '2016-10-24 16:11:21', 21, '', 'favourites', 'Product [105]Added to Favourites'),
(447, '2016-10-24 16:11:30', 21, '', 'favourites', 'Product [105]Removed From Favourites'),
(448, '2016-10-24 16:11:34', 21, '', 'favourites', 'Product [11]Removed From Favourites'),
(449, '2016-10-24 16:15:35', 27, '', 'Login', ' user logged in'),
(450, '2016-10-24 16:31:53', 21, '', 'favourites', 'Product [93]Added to Favourites'),
(451, '2016-10-24 16:46:10', 27, '', 'Login', ' user logged in'),
(452, '2016-10-24 16:47:20', 27, '', 'favourites', 'Product [11]Added to Favourites'),
(453, '2016-10-24 16:48:59', 27, '', 'favourites', 'Product [13]Added to Favourites'),
(454, '2016-10-24 18:35:01', 51, '', 'Signup', 'New User Signed Up'),
(455, '2016-10-24 18:38:07', 21, '', 'favourites', 'Product [130]Added to Favourites'),
(456, '2016-10-24 18:38:11', 21, '', 'favourites', 'Product [130]Removed From Favourites'),
(457, '2016-10-24 18:38:15', 21, '', 'favourites', 'Product [130]Added to Favourites'),
(458, '2016-10-24 18:40:14', 51, '', 'Login', ' user logged in'),
(459, '2016-10-24 18:40:16', 52, '', 'Signup', 'New User Signed Up'),
(460, '2016-10-25 11:46:32', 51, '', 'Login', ' user logged in'),
(461, '2016-10-25 11:49:32', 51, '', 'favourites', 'Product [50]Added to Favourites'),
(462, '2016-10-25 12:04:58', 27, '', 'Login', ' user logged in'),
(463, '2016-10-25 15:54:10', 27, '', 'Login', ' user logged in'),
(464, '2016-10-25 16:54:53', 27, '', 'favourites', 'Product [11]Added to Favourites'),
(465, '2016-10-26 11:47:48', 49, '', 'Login', ' user logged in'),
(466, '2016-10-26 12:14:25', 49, '', 'favourites', 'Product [55]Added to Favourites'),
(467, '2016-10-26 12:44:46', 47, '', 'Login', ' user logged in'),
(468, '2016-10-27 13:45:15', 27, '', 'Login', ' user logged in'),
(469, '2016-10-27 14:07:20', 21, '', 'Login', ' user logged in'),
(470, '2016-10-27 14:08:09', 21, '', 'Login', ' user logged in'),
(471, '2016-10-27 14:13:47', 17, '', 'Login', ' user logged in'),
(472, '2016-10-27 14:15:08', 17, '', 'Login', ' user logged in'),
(473, '2016-10-27 14:42:45', 17, '', 'favourites', 'Product [20]Added to Favourites'),
(474, '2016-10-27 14:48:33', 21, '', 'Login', ' user logged in'),
(475, '2016-10-27 15:06:15', 17, '', 'favourites', 'Product [77]Added to Favourites'),
(476, '2016-10-27 15:11:39', 21, '', 'Login', ' user logged in'),
(477, '2016-10-27 15:12:47', 17, '', 'Login', ' user logged in'),
(478, '2016-10-27 15:13:25', 17, '', 'Login', ' user logged in'),
(479, '2016-10-27 15:24:48', 49, '', 'Login', ' user logged in'),
(480, '2016-10-27 15:25:35', 27, '', 'Login', ' user logged in'),
(481, '2016-10-27 15:40:59', 47, '', 'Login', ' user logged in'),
(482, '2016-10-27 16:09:23', 49, '', 'Login', ' user logged in'),
(483, '2016-10-27 16:16:37', 27, '', 'favourites', 'Product [11]Added to Favourites'),
(484, '2016-10-27 16:16:49', 21, '', 'favourites', 'Product [11]Added to Favourites'),
(485, '2016-10-27 16:52:16', 21, '', 'Login', ' user logged in'),
(486, '2016-10-27 16:52:30', 21, '', 'favourites', 'Product [77]Added to Favourites'),
(487, '2016-10-27 17:03:09', 27, '', 'Login', ' user logged in'),
(488, '2016-11-02 18:38:22', 49, '', 'favourites', 'Product [107]Added to Favourites'),
(489, '2016-11-04 16:37:37', 21, '', 'Login', ' user logged in'),
(490, '2016-11-04 19:17:07', 21, '', 'Login', ' user logged in'),
(491, '2016-11-07 09:58:30', 53, '', 'Signup', 'New User Signed Up'),
(492, '2016-11-07 09:59:29', 53, '', 'Login', ' user logged in'),
(493, '2016-11-07 10:14:39', 54, '', 'Signup', 'New User Signed Up'),
(494, '2016-11-07 10:21:56', 54, '', 'Login', ' user logged in');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email_id` varchar(100) NOT NULL,
  `primary_phone_number` varchar(13) DEFAULT NULL,
  `user_type` varchar(25) DEFAULT NULL,
  `user_permissions` varchar(250) DEFAULT NULL,
  `image_url` varchar(1000) DEFAULT NULL,
  `image_thumbnail_url` varchar(1000) DEFAULT NULL,
  `company_name` varchar(200) DEFAULT NULL,
  `is_enable` tinyint(1) NOT NULL DEFAULT '0',
  `device_type` varchar(250) DEFAULT NULL,
  `device_id` varchar(250) DEFAULT NULL,
  `gcm_id` varchar(250) DEFAULT NULL,
  `api_key` varchar(250) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(50) DEFAULT NULL,
  `approved_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `approved_by` varchar(50) DEFAULT NULL,
  `valid_through` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `OTP` varchar(10) DEFAULT NULL,
  `OTP_timestamp` datetime DEFAULT NULL,
  `OTP_confirmed` tinyint(1) DEFAULT NULL,
  `fb_id` varchar(200) DEFAULT NULL,
  `gmail_id` varchar(200) DEFAULT NULL,
  `signup_flag` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email_id` (`email_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `username`, `password`, `firstname`, `lastname`, `email_id`, `primary_phone_number`, `user_type`, `user_permissions`, `image_url`, `image_thumbnail_url`, `company_name`, `is_enable`, `device_type`, `device_id`, `gcm_id`, `api_key`, `created_on`, `created_by`, `updated_on`, `updated_by`, `approved_on`, `approved_by`, `valid_through`, `OTP`, `OTP_timestamp`, `OTP_confirmed`, `fb_id`, `gmail_id`, `signup_flag`) VALUES
(6, 'pranita.sable91@gmail.com', '', 'Pranita', 'Sable', 'pranita.sable91@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bFTn1k1OAjLrZZYEhIRIqnNXsF1xJeL1db_IQ_tc0cac04Rme0Em12yZawM3GtMcl3JlVJ_nSkaqp_hGrZc2NfNrZrssXHzgkbG16HVU69_MtYkRVDkjhOGEevuPyVJyDs2OoUA', '46b569ebc4d63e097e2fc8d851e9f63d', '2016-07-15 11:52:21', 'user', '2016-07-15 11:52:21', 'user', '2016-05-08 18:30:00', NULL, '2026-08-29 18:24:48', '1094', '2016-07-15 17:22:21', 1, '12345', NULL, NULL),
(7, 'sourabh.b@lastlocal.in', '12345', 'SLastlocal', 'SLastlocal', 'sourabh.b@lastlocal.in', NULL, 'Retail', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bGZ5ArQZ6h_8oZhufhXeGqXSwSgUwqa4ub7muXdyFQNEsFio2XcZy-REXRkL7tS_d5WxfC0qqG1UiIN1BAnqEmnq-7pDQcbRnytHGzjzrLGYY_NsIazaAWwwbW5KUllTwHMxiKE', '8ac2f744440cd8f9a2b580431d032aa7', '2016-05-09 00:00:00', 'user', '2016-07-06 14:12:58', 'user', '2016-05-11 11:48:13', 'admin', '2026-12-29 18:24:48', '1270', '2016-07-27 16:42:43', 1, '236333276733350', NULL, NULL),
(8, 'kaustubha4u@gmail.com', '', 'Kaustubha', 'Panchal', 'kaustubha4u@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, '3898434-0395-0', '325a7e7174a5cdc0129581ef2dfec6cb', '2016-05-09 16:55:56', 'user', '2016-05-09 21:47:06', 'user', '2016-05-09 16:55:56', NULL, '2026-08-29 18:24:48', '1319', '2016-05-09 21:47:06', 1, '10205788355501122', NULL, NULL),
(12, 'rishmalath@gmail.com', '', 'Rishma', 'Lath', 'rishmalath@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bEwGZQ4nRR2gAlsi-8egMLWKeqFQ4L55m57tkrLqf_vAh5snW3XMkHNZdLcZyDV2T3jWEKmju05mSKqyzvfhG6YVFdfBeUzV8nSB69lOdg1boz8OeLjb8PfJh0324NJD6gg_HS2', 'c5010cca9cfda4937ec36557eec0b8e5', '2016-07-15 12:06:32', 'user', '2016-07-15 12:19:05', 'user', '2016-07-15 12:06:32', NULL, '2026-08-29 18:24:48', '1737', '2016-07-15 17:49:05', 1, '10154979996123448', NULL, NULL),
(16, 'yashbaid87@gmail.com', '', 'Yash', 'Baid', 'yashbaid87@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bGgI0aEYaZATcrdOnpF3gLRjdj6UlLg-YeGxvbglt3U4RlPIBSsKYz-kiiXri8QMfU6wORCT02MW-VEaP6qSo0NgJptAWolPVaVNPlEC_328ninEu1LUE8gIiqq2xPeGUfEp0EQ', 'c0e2be09d8dbc05caab36652bd455856', '2016-07-25 09:06:15', 'user', '2016-10-19 18:48:13', 'user', '2016-07-25 09:06:15', NULL, '2026-08-29 18:24:48', '1721', '2016-07-25 14:36:15', 1, '10154055505214093', NULL, NULL),
(17, 'baid@lastlocal.in', '1234567', 'LastLocal', 'LastLocal', 'baid@lastlocal.in', NULL, 'Retail', NULL, NULL, NULL, NULL, 1, '', '', 'APA91bE3LJGjgDYsB9PA_FfXHF389uJOH5eHL-EYtQ9GfKNlIXTDEBps4h8H9aHJiW9DzhXxLRpZUVmGSpK9QYqp-mdPI_5wkGaUIkone0GNMIaH0xhd4RcJoyxYjgbJgpoZGAGUgJDM', 'fb0aa13efb9ac71e1c09094d7102d798', '2016-07-25 09:06:56', 'user', '2016-10-27 15:12:12', 'user', '2016-07-25 09:06:56', NULL, '2026-08-29 18:24:48', '1845', '2016-07-25 14:36:56', 1, '', NULL, NULL),
(18, 'mach.neha@gmail.com', '', 'Neha123', '', 'mach.neha@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', '', 'APA91bGWpzylenhLh-FbjVXAdC1Wvn0mO3wRqfgrkEaiHx4ExCOjPjAQhvklhKrBCz2pz2UeSSqMJcSzA-XlsDQAWp-MBaQneQ0B1yEVIHEPMURhLBMk3Q4EBdwBTAhDY6qawXajurbZ', '0e826bdd15c58f918bb77a66d40afc96', '2016-07-25 09:12:13', 'user', '2016-10-21 15:07:28', 'user', '2016-07-25 09:12:13', NULL, '2026-08-29 18:24:48', '3244', '2016-09-27 12:00:34', 1, '1083402001724897', '117639545177782361327', NULL),
(21, 'neha.m@lastlocal.in', '123456', 'neha', '', 'neha.m@lastlocal.in', NULL, 'disabled', NULL, NULL, NULL, NULL, 1, 'android', '', '', '74691f61af3ead6035efd881435a3dea', '2016-07-25 09:16:07', 'user', '2016-10-27 15:11:26', 'user', '2016-07-25 09:16:07', NULL, '2026-08-29 18:24:48', '1556', '2016-10-20 18:22:50', 1, '', NULL, NULL),
(26, 'pranita.s@lastlocal.in', '123456', 'pranita', 'sable', 'pranita.s@lastlocal.in', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, '3898434-0395-0', '0e7a6b63ed9aa9e491e3b20440843273', '2016-07-25 09:31:56', 'user', '2016-07-25 09:31:56', 'user', '2016-07-25 09:31:56', NULL, '2026-08-29 18:24:48', '1927', '2016-07-25 15:01:56', 1, NULL, NULL, NULL),
(27, 'lastdevelopers@gmail.com', '', 'LastLocal', 'Devs', 'lastdevelopers@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'iOS', '(null)', 'APA91bF7bFmO0AcaTh2FI_CBerpaGevmwpt407u5gkGTjCj1K8ecWJGnFQr_W_n7GubQhEpeorgKv4RLzoxyTDAUZ_nSlPqOKd8paaM2ZK6_ZTaM1B5jhgT8wfiPV0uM6tz1XQ2Sx0pf', 'cfe032bc8af64640b0c242cf27372a3b', '2016-07-27 10:04:43', 'user', '2016-10-27 17:03:09', 'user', '2016-07-25 10:58:34', NULL, '2026-08-29 18:24:48', '3306', '2016-08-31 16:01:04', 1, '312107082465323', '118364028849857939886', NULL),
(40, 'kaustubha6899@gmail.com', '', 'pranita', 'sable', 'kaustubha6899@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, NULL, '74768333bc88ffc4bce3a6f22a66433b', '2016-07-28 08:38:50', 'user', '2016-08-31 16:11:22', 'user', '2016-07-28 08:38:50', NULL, '2026-07-28 08:38:50', '1261', '2016-07-28 14:08:50', 1, NULL, '78533', NULL),
(41, '', '', 'LastLocal', 'Devs', '', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'iOS', '(null)', NULL, '4eb45b5c7a75e1ce7bc07e1e7b0096eb', '2016-08-31 15:07:26', 'user', '2016-10-21 14:06:41', 'user', '2016-08-29 15:12:58', NULL, '2026-08-31 15:07:26', '1628', '2016-08-31 15:07:26', 1, '312107082465323', NULL, NULL),
(42, 'kaustubh.p@lastlocal.in', '123456', '', '', 'kaustubh.p@lastlocal.in', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bF34yllTKg5wI1Ragg5_emHpEd55Z-ajrDLdEwalAoawoEYOuaP9Ec0ORkBfhGpv9dC-OD1zlIJYrCGeAXYXHPdmpJYJIeVMEH4L8yd7EV9VnVJSdU38q-dWcWjYXJv2K9TwO7l', 'daf7b26dc04bae2615c9e78da506074a', '2016-08-29 18:24:48', 'user', '2016-08-29 18:24:48', 'user', '2016-08-29 18:24:48', NULL, '2026-08-29 18:24:48', '5662', '2016-08-29 18:24:48', 1, NULL, NULL, NULL),
(43, 'pankaj@ls.ss', '', '', 'pankaj', 'pankaj@ls.ss', NULL, 'pending', NULL, NULL, NULL, NULL, 1, '', '', NULL, 'e4ed8b11f2e1eeb4cfe8cb0bcd3ceb90', '2016-08-31 15:28:52', 'user', '2016-08-31 15:28:52', 'user', '2016-08-31 15:10:13', NULL, '2026-08-31 15:28:52', '2731', '2016-08-31 15:28:52', 1, NULL, NULL, NULL),
(44, 'pankaj@gmail.com', '', '', '', 'pankaj@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, '', '', NULL, '2a5473da5a25c013dccb3287f0e3d152', '2016-08-31 17:06:28', 'user', '2016-08-31 17:09:47', 'user', '2016-08-31 17:06:28', NULL, '2026-08-31 17:06:28', '4906', '2016-08-31 17:06:28', 1, '108340vcv001724898a', 'wsd', NULL),
(45, 'pankaj1@gmail.com', '', '', '', 'pankaj1@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, '', '', NULL, '9b84f17325a1e5bb3d7bd7e6dd1e8369', '2016-08-31 17:09:59', 'user', '2016-08-31 17:09:59', 'user', '2016-08-31 17:09:59', NULL, '2026-08-31 17:09:59', '7252', '2016-08-31 17:09:59', 1, NULL, 'wsd', NULL),
(46, 'panddkaj1@gmail.com', '', '', 'pankaj', 'panddkaj1@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, '', '', NULL, 'a7525b304add23cc2827de228b666391', '2016-08-31 17:13:02', 'user', '2016-09-01 18:38:11', 'user', '2016-08-31 17:12:48', NULL, '2026-08-31 17:13:02', '1021', '2016-09-01 18:38:11', 0, NULL, 'vb', NULL),
(47, 'raj.k@lastlocal.in', '123456', '', '', 'raj.k@lastlocal.in', NULL, 'pending', NULL, NULL, NULL, NULL, 1, '', '', NULL, 'd2fb56579130beb26e4cdb5d230e7772', '2016-10-19 13:26:57', 'user', '2016-10-19 13:26:57', 'user', '2016-10-19 12:41:19', NULL, '2026-10-19 13:26:57', '7415', '2016-10-19 13:26:57', 1, NULL, NULL, NULL),
(48, 'vivekbhadricha@gmail.com', '123456', '', '', 'vivekbhadricha@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bEt_doaBSz-7hZBGK6Dzylv32DNtP0BceOebxUpZq_onAe1AQYEu1DJVZNYCvt9qDHvXqEWNBjNxg_f_94pC_EOHbYWFLe8HRZt-aIaAVwuG67-RDORiW-n7gXrDSLQGjdRoIPS', '7995befba1fffd00a2843c4113d12fa6', '2016-10-19 12:42:24', 'user', '2016-10-19 12:42:24', 'user', '2016-10-19 12:42:24', NULL, '2026-10-19 12:42:24', '1794', '2016-10-19 12:43:05', 0, NULL, NULL, NULL),
(49, 'vinitdhadda@gmail.com', '123456', 'Vinit', 'Dhadda', 'vinitdhadda@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'iOS', '(null)', NULL, '66e8407c6e8dc34578237e00a4d07525', '2016-10-19 18:01:14', 'user', '2016-10-27 16:09:23', 'user', '2016-10-19 18:01:14', NULL, '2026-10-19 18:01:14', '1224', '2016-10-19 18:01:14', 1, '10154443472270250', '113653400976971799640', NULL),
(50, 'pankit@vbcl.in', 'becks99', '', '', 'pankit@vbcl.in', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bGM1B6-SEn5dbL6A7J15CErkLTu1dVXQ-FmL4FjLBzK18yyqBIw1Jg_dha2H6zNB2qYv85QAjw5122aiH_HGzowmrIyMXfWgzSfszY9ExBq3ZmC-74VXmPBxX_CdYxO1jPmwIHq', '4d118d152e740e37196c78861be78b78', '2016-10-24 12:17:51', 'user', '2016-10-24 12:17:51', 'user', '2016-10-24 12:17:51', NULL, '2026-10-24 12:17:51', '8103', '2016-10-24 12:19:56', 1, NULL, NULL, NULL),
(51, 'ruchir@vbcl.in', 'ruchir00', '', '', 'ruchir@vbcl.in', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bEGbbBDEEdIs3O1sEi8NLNvGS48ibtCgayL4_8go8VzIO5tfZEv8VtVo25dJHfoim95zhuf3DXtkiPQ8YKTxm0HDBvAoM91HDyu0L8vhh2zhuzML5J4SflVk2txevDmMhrF3bpf', '54af9d12d60bd323c19de51fabfbae21', '2016-10-24 18:34:58', 'user', '2016-10-24 18:34:58', 'user', '2016-10-24 18:34:58', NULL, '2026-10-24 18:34:58', '1273', '2016-10-24 18:34:58', 1, NULL, NULL, NULL),
(52, 'sunil@vbcl.in', 'swapnil', '', '', 'sunil@vbcl.in', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bEp2rpFHo5EUQGd4wuWg1735Jyzcfp6NfA8FG_har9fXhzZk95-xcaJO_xheox5G13a9EFvJ48J58_eRlJxyPKx61Oh572vgjSyfUQCiNxGDv3PL7mgp6UoyD593O0kbNwt_Bx3', '826ea939c4406a6999bad56f99336b5e', '2016-10-24 18:40:13', 'user', '2016-10-24 18:40:13', 'user', '2016-10-24 18:40:13', NULL, '2026-10-24 18:40:13', '1216', '2016-10-24 18:40:13', 0, NULL, NULL, NULL),
(53, 'd.nirash@gmail.com', 'dorai269', '', '', 'd.nirash@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bGSkgsEYyq0recOyQBJ90oXqMXvREu8f-8efwKzhefqE2UbWMpe2DKFsgzI9tJvtwBKaEJX_3aRXSQEBxGOlkAp8MsMq2bwWVBJi7ph-ZtvOoCxB4aLY1BJEabQZ_GxeWvTrYKS', 'a47d11ec5fc091d28d66648ba2469523', '2016-11-07 09:58:26', 'user', '2016-11-07 09:58:26', 'user', '2016-11-07 09:58:26', NULL, '2026-11-07 09:58:26', '2057', '2016-11-07 09:58:26', 1, NULL, NULL, NULL),
(54, 'aamirulislamwani@Gmail.com', '9419036494', 'Aamir', 'ul', 'aamirulislamwani@Gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bEpyHHgBGcOIXuB8C7VwyyhuoFrc7JciRfxp8hpBSOtpbSYKJRAZQnxEsfVJIwYp677eckfbbmHUSyaSo9N6f8tq6tmm2r6dA9TkWLGO-o6KS6FzPyZnJMQ5N-fhmkQXa9L-H4g', 'd12d50591ef5102debca29bd9de21336', '2016-11-07 10:14:36', 'user', '2016-11-07 10:21:56', 'user', '2016-11-07 10:14:36', NULL, '2026-11-07 10:14:36', '6501', '2016-11-07 10:20:28', 1, NULL, '113487565054157268931', NULL);

-- --------------------------------------------------------

--
-- Structure for view `atr_table`
--
DROP TABLE IF EXISTS `atr_table`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `atr_table` AS (select `a`.`attribute_name` AS `name`,`av`.`attribute_value` AS `value`,`p`.`product_id` AS `id` from ((`attribute_value` `av` join `attribute` `a` on((`a`.`attribute_id` = `av`.`attribute_id`))) join `product` `p` on((`p`.`product_id` = `av`.`product_id`))));

-- --------------------------------------------------------

--
-- Structure for view `attribute_view`
--
DROP TABLE IF EXISTS `attribute_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `attribute_view` AS (select `a`.`attribute_name` AS `name`,`av`.`attribute_value` AS `value`,`p`.`product_id` AS `id` from ((`attribute_value` `av` join `attribute` `a` on((`a`.`attribute_id` = `av`.`attribute_id`))) join `product` `p` on((`p`.`product_id` = `av`.`product_id`))));

-- --------------------------------------------------------

--
-- Structure for view `brands_data`
--
DROP TABLE IF EXISTS `brands_data`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `brands_data` AS select `p`.`product_id` AS `product_id`,`p`.`is_active` AS `is_active`,`p`.`category_id` AS `category_id`,`p`.`subcategory_id` AS `subcategory_id`,`av`.`attribute_value` AS `brand_name` from ((((`product` `p` join `product_category` `pc`) join `product_subcategory` `ps`) join `attribute_value` `av`) join `attribute` `a`) where ((`pc`.`category_id` = `p`.`category_id`) and (`ps`.`subcategory_id` = `p`.`subcategory_id`) and (`p`.`product_id` = `av`.`product_id`) and (`av`.`attribute_id` = (select distinct `a`.`attribute_id` from `attribute` where (`a`.`attribute_name` like '%brand%'))));

-- --------------------------------------------------------

--
-- Structure for view `general_search`
--
DROP TABLE IF EXISTS `general_search`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `general_search` AS select `p`.`product_id` AS `product_id`,concat(' ',`pc`.`category_name`,'  ',`psc`.`subcategory_name`,' ,',`a`.`attribute_name`,'=',`av`.`attribute_value`) AS `concatdata` from ((((`attribute_value` `av` join `attribute` `a` on((`a`.`attribute_id` = `av`.`attribute_id`))) join `product` `p` on((`p`.`product_id` = `av`.`product_id`))) join `product_category` `pc` on((`pc`.`category_id` = `p`.`category_id`))) join `product_subcategory` `psc` on((`psc`.`subcategory_id` = `p`.`subcategory_id`)));

-- --------------------------------------------------------

--
-- Structure for view `pricing_table`
--
DROP TABLE IF EXISTS `pricing_table`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pricing_table` AS select `p`.`product_id` AS `product_id`,`p`.`product_name` AS `product_name`,`p`.`category_id` AS `category_id`,`p`.`subcategory_id` AS `subcategory_id`,`p`.`description` AS `description`,`p`.`is_hot` AS `is_hot`,`p`.`is_new` AS `is_new`,`p`.`created_on` AS `created_on`,`p`.`created_by` AS `created_by`,`p`.`updated_on` AS `updated_on`,`p`.`updated_by` AS `updated_by`,`av`.`attribute_value` AS `Price` from ((`product` `p` join `attribute` `a`) join `attribute_value` `av`) where ((`p`.`product_id` = `av`.`product_id`) and (`a`.`attribute_id` = `av`.`attribute_id`) and (`av`.`attribute_id` = (select `attribute`.`attribute_id` from `attribute` where (`attribute`.`attribute_name` in ('price','Price')))));

-- --------------------------------------------------------

--
-- Structure for view `product_attribute_view`
--
DROP TABLE IF EXISTS `product_attribute_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_attribute_view` AS (select `attribute_view`.`id` AS `id`,max((case when (`attribute_view`.`name` = 'Carat') then `attribute_view`.`value` else NULL end)) AS `carat`,max((case when (`attribute_view`.`name` = 'Clarity') then `attribute_view`.`value` else NULL end)) AS `clarity`,max((case when (`attribute_view`.`name` = 'Price') then `attribute_view`.`value` else NULL end)) AS `price`,max((case when (`attribute_view`.`name` = 'Colour') then `attribute_view`.`value` else NULL end)) AS `Colour`,max((case when (`attribute_view`.`name` = 'Cut') then `attribute_view`.`value` else NULL end)) AS `Cut`,max((case when (`attribute_view`.`name` = 'Polish') then `attribute_view`.`value` else NULL end)) AS `Polish`,max((case when (`attribute_view`.`name` = 'Symmetry') then `attribute_view`.`value` else NULL end)) AS `Symmetry`,max((case when (`attribute_view`.`name` = 'Fluor.') then `attribute_view`.`value` else NULL end)) AS `Fluor.` from `attribute_view` group by `attribute_view`.`id` order by `attribute_view`.`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD CONSTRAINT `fk_attribute_value_attribute` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`attribute_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_attribute_value_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `fk_product_favorites` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_details_favorites` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_product_prod_category` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_product_prod_subcategory` FOREIGN KEY (`subcategory_id`) REFERENCES `product_subcategory` (`subcategory_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_images_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `product_subcategory`
--
ALTER TABLE `product_subcategory`
  ADD CONSTRAINT `fk_prod_subcategory` FOREIGN KEY (`category_id`) REFERENCES `product_category` (`category_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `push_notification_data`
--
ALTER TABLE `push_notification_data`
  ADD CONSTRAINT `fk_push_notification_data` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `rfq_data`
--
ALTER TABLE `rfq_data`
  ADD CONSTRAINT `fk_rfq_data_product` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rfq_data_user` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_activity_log`
--
ALTER TABLE `user_activity_log`
  ADD CONSTRAINT `fk_user_details_activity` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
