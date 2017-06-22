-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2016 at 01:18 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `retail_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_details`
--

CREATE TABLE IF NOT EXISTS `admin_details` (
  `admin_id` int(10) unsigned NOT NULL,
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
  `api_key` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_details`
--

INSERT INTO `admin_details` (`admin_id`, `username`, `password`, `firstname`, `lastname`, `email_id`, `primary_phone_number`, `secondary_phone_number`, `role`, `is_enable`, `product_line`, `city`, `stores`, `image_url`, `image_thumbnail_url`, `created_on`, `created_by`, `updated_on`, `updated_by`, `valid_through`, `api_key`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Main1', 'Administrator1', 'pranita.s@lastlocal.in', '0000000000', '9999999999', 'admin', 1, 'all', '2', 'all', NULL, NULL, '2016-03-03 15:06:48', 'admin', '2016-03-03 15:06:48', 'admin', '2026-03-03 15:06:48', '4561ad02bb5333f58d75'),
(2, 'neha', '$2a$10$t3yo05Xc0S7.xfLtQnNmmOEoG0bQ1msRObpMhkw4ZBmiG9/Mt7kQa', 'neha', '', 'neha.m@lastlocal.in', '9930995285', '', 'admin', 1, NULL, '2', NULL, NULL, NULL, '2016-03-08 16:09:23', 'neha', '2016-03-08 16:11:54', 'admin', '2016-03-28 00:00:00', ''),
(3, 'vinitdhadda', '$2a$10$9qeXDtbWvD74x6kZHcvfkOIM3qiZ2QsGt.1d5oH0GVi6ErnNQAnoS', 'Vinit', 'Dhadda', 'dhadda@lastlocal.in', '9833115252', '', 'admin', 1, NULL, '2', NULL, NULL, NULL, '2016-07-15 05:16:05', 'vinitdhadda', '2016-07-15 05:16:24', '2016-08-03 13:32:25', '2016-08-03 18:30:00', ''),
(4, 'pankajcse1983', '95deb5011a8fe1ccf6552bb5bcda2ff0', 'pankaj', 'gupta', 'pankajcse1983@gmail.com', '9702558122', '879', 'rejected', 0, NULL, '1', NULL, NULL, NULL, '2016-08-03 10:16:11', 'pankajcse1983', '0000-00-00 00:00:00', '2016-08-03 15:46:39', '0000-00-00 00:00:00', '');

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
  `attribute_id` int(10) unsigned NOT NULL,
  `attribute_name` varchar(100) NOT NULL,
  `attribute_type` varchar(100) DEFAULT NULL,
  `sort_order` int(10) unsigned DEFAULT NULL,
  `attribute_header` varchar(100) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attribute_id`, `attribute_name`, `attribute_type`, `sort_order`, `attribute_header`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(34, 'Product name12', 'GENERAL', 3, 'PRODUCT DETAILS', '2016-07-28 07:11:00', 'EXCEL', '2016-08-03 15:58:34', 'admin'),
(35, 'Price', 'GENERAL', 4, 'PRODUCT DETAILS', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha'),
(36, 'Available Size', 'GENERAL', 5, 'PRODUCT DETAILS', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha'),
(37, 'Description', 'GENERAL', 6, 'PRODUCT DETAILS', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha'),
(38, 'Material', 'GENERAL', 7, 'PRODUCT DETAILS', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha'),
(39, 'Brand', 'GENERAL', 8, 'PRODUCT DETAILS', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_value`
--

CREATE TABLE IF NOT EXISTS `attribute_value` (
  `attribute_value_id` int(10) unsigned NOT NULL,
  `attribute_id` int(10) unsigned DEFAULT NULL,
  `product_id` int(10) unsigned DEFAULT NULL,
  `attribute_value` varchar(100) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17276 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attribute_value`
--

INSERT INTO `attribute_value` (`attribute_value_id`, `attribute_id`, `product_id`, `attribute_value`, `updated_by`, `updated_on`) VALUES
(17126, 34, 2723, 'Black Crisscross Mesh Paneled Pumps', 'neha', '2016-07-28 07:11:00'),
(17127, 35, 2723, '2499', 'neha', '2016-07-28 07:11:00'),
(17128, 36, 2723, '6.5, 7, 7.5', 'neha', '2016-07-28 07:11:00'),
(17129, 37, 2723, 'These pumps feature mesh-paneled straps and a crisscross vamp', 'neha', '2016-07-28 07:11:00'),
(17130, 38, 2723, 'Upper: 100% Polyurethane; Insole: 100% Polyurethane; Outsole: 100% Tpr; Lining: 100% Polyester', 'neha', '2016-07-28 07:11:00'),
(17131, 39, 2723, 'Aldo', 'neha', '2016-07-28 07:11:00'),
(17132, 34, 2724, 'Classic Faux Leather Pumps', 'neha', '2016-07-28 07:11:00'),
(17133, 35, 2724, '3000', 'neha', '2016-07-28 07:11:00'),
(17134, 36, 2724, '6.5, 7, 8', 'neha', '2016-07-28 07:11:00'),
(17135, 37, 2724, 'A pair of classic pumps crafted from supple faux leather with an almond toe', 'neha', '2016-07-28 07:11:00'),
(17136, 38, 2724, 'Upper 1 & Lining: 100% Polyester', 'neha', '2016-07-28 07:11:00'),
(17137, 39, 2724, 'Aldo', 'neha', '2016-07-28 07:11:00'),
(17138, 34, 2725, 'Brown Espadrille Wedge Sandals', 'neha', '2016-07-28 07:11:00'),
(17139, 35, 2725, '2999', 'neha', '2016-07-28 07:11:00'),
(17140, 36, 2725, '6, 7.5, 9', 'neha', '2016-07-28 07:11:00'),
(17141, 34, 2726, 'Velvet Strappy Sandals', 'neha', '2016-07-28 07:11:00'),
(17142, 35, 2726, '2500', 'neha', '2016-07-28 07:11:00'),
(17143, 36, 2726, '6.5, 7, 8', 'neha', '2016-07-28 07:11:00'),
(17144, 37, 2726, 'Made for the fancy affairs on your social calendar, these sandals are ready to hit the town!', 'neha', '2016-07-28 07:11:00'),
(17145, 38, 2726, 'Upper 1 & Lining: 100% Polyester', 'neha', '2016-07-28 07:11:00'),
(17146, 39, 2726, 'Aldo', 'neha', '2016-07-28 07:11:00'),
(17147, 34, 2727, 'Black Strappy Cork Sole Platform Wedges', 'neha', '2016-07-28 07:11:00'),
(17148, 35, 2727, '2800', 'neha', '2016-07-28 07:11:00'),
(17149, 36, 2727, '7, 8.5, 9', 'neha', '2016-07-28 07:11:00'),
(17150, 34, 2728, 'Ivory Satin Strappy Heels', 'neha', '2016-07-28 07:11:00'),
(17151, 35, 2728, '2399', 'neha', '2016-07-28 07:11:00'),
(17152, 36, 2728, '6.5, 7, 9', 'neha', '2016-07-28 07:11:00'),
(17153, 34, 2729, 'Faux Suede Ballet Flats', 'neha', '2016-07-28 07:11:00'),
(17154, 35, 2729, '1500', 'neha', '2016-07-28 07:11:00'),
(17155, 36, 2729, '7, 8, 9.5', 'neha', '2016-07-28 07:11:00'),
(17156, 37, 2729, 'A classic in and of itself, these ballet flats are a wear-anywhere-and-with-anything essential', 'neha', '2016-07-28 07:11:00'),
(17157, 38, 2729, 'Outsole: 100% Tpr ', 'neha', '2016-07-28 07:11:00'),
(17158, 39, 2729, 'Steve Madden', 'neha', '2016-07-28 07:11:00'),
(17159, 34, 2730, 'Pointed Ankle-Strap Flats', 'neha', '2016-07-28 07:11:00'),
(17160, 35, 2730, '1059', 'neha', '2016-07-28 07:11:00'),
(17161, 36, 2730, '5.5, 6, 7', 'neha', '2016-07-28 07:11:00'),
(17162, 34, 2731, 'Nude Quilted Faux Leather Ballet Flats', 'neha', '2016-07-28 07:11:00'),
(17163, 35, 2731, '999', 'neha', '2016-07-28 07:11:01'),
(17164, 36, 2731, '8.5, 9, 9.5', 'neha', '2016-07-28 07:11:01'),
(17165, 34, 2732, 'Toe-Post Sandals', 'neha', '2016-07-28 07:11:01'),
(17166, 35, 2732, '950', 'neha', '2016-07-28 07:11:01'),
(17167, 36, 2732, '9, 9.5, 10', 'neha', '2016-07-28 07:11:01'),
(17168, 37, 2732, 'Sandals with a toe post, ankle strap with a metal buckle and rubber soles', 'neha', '2016-07-28 07:11:01'),
(17169, 38, 2732, 'Upper: 100% Polyester; Lining & Insole: 100% Polyurethane', 'neha', '2016-07-28 07:11:01'),
(17170, 39, 2732, 'Steve Madden', 'neha', '2016-07-28 07:11:01'),
(17171, 34, 2733, 'Ribbed Faux Leather Sandals', 'neha', '2016-07-28 07:11:01'),
(17172, 35, 2733, '899', 'neha', '2016-07-28 07:11:01'),
(17173, 36, 2733, '6.5, 7, 7.5', 'neha', '2016-07-28 07:11:01'),
(17174, 34, 2734, 'White/Black Knit Baseball Tee', 'neha', '2016-07-28 07:11:01'),
(17175, 35, 2734, '449', 'neha', '2016-07-28 07:11:01'),
(17176, 36, 2734, 'XS, S, M, L', 'neha', '2016-07-28 07:11:01'),
(17177, 37, 2734, 'This short-sleeved boxy top will always look killer, no matter what you pair it with', 'neha', '2016-07-28 07:11:01'),
(17178, 38, 2734, '53% Cotton, 47% Polyester', 'neha', '2016-07-28 07:11:01'),
(17179, 39, 2734, 'H&M', 'neha', '2016-07-28 07:11:01'),
(17180, 34, 2735, 'Grey Side-Slit Marled Tee', 'neha', '2016-07-28 07:11:01'),
(17181, 35, 2735, '699', 'neha', '2016-07-28 07:11:01'),
(17182, 36, 2735, 'XS, S, M, L', 'neha', '2016-07-28 07:11:01'),
(17183, 34, 2736, 'Minimalist Basic Top', 'neha', '2016-07-28 07:11:01'),
(17184, 35, 2736, '579', 'neha', '2016-07-28 07:11:01'),
(17185, 36, 2736, 'XS,  M, L', 'neha', '2016-07-28 07:11:01'),
(17186, 37, 2736, 'An oversized knit top perfect for everyday-wear', 'neha', '2016-07-28 07:11:01'),
(17187, 38, 2736, '100% Rayon', 'neha', '2016-07-28 07:11:01'),
(17188, 39, 2736, 'H&M', 'neha', '2016-07-28 07:11:01'),
(17189, 34, 2737, 'No-Biggie Graohic Tee', 'neha', '2016-07-28 07:11:01'),
(17190, 35, 2737, '499', 'neha', '2016-07-28 07:11:01'),
(17191, 36, 2737, 'XS, S, M, L', 'neha', '2016-07-28 07:11:01'),
(17192, 34, 2738, 'Elephant Print Tee', 'neha', '2016-07-28 07:11:01'),
(17193, 35, 2738, '550', 'neha', '2016-07-28 07:11:01'),
(17194, 36, 2738, 'S, M, L', 'neha', '2016-07-28 07:11:01'),
(17195, 37, 2738, 'This soft knit tee features cuffed short sleeves and a fun elephant pattern', 'neha', '2016-07-28 07:11:01'),
(17196, 38, 2738, '50% Cotton, 50% Modal', 'neha', '2016-07-28 07:11:01'),
(17197, 39, 2738, 'Topshop', 'neha', '2016-07-28 07:11:01'),
(17198, 34, 2739, 'Please Do Not Tell Graphic Print Tee', 'neha', '2016-07-28 07:11:01'),
(17199, 35, 2739, '399', 'neha', '2016-07-28 07:11:01'),
(17200, 36, 2739, 'XS, S, M, L', 'neha', '2016-07-28 07:11:01'),
(17201, 37, 2739, 'A graphic tee with cuffed short sleeves, the text "please do not tell" in front', 'neha', '2016-07-28 07:11:01'),
(17202, 38, 2739, '62% Polyester, 38% Rayon', 'neha', '2016-07-28 07:11:01'),
(17203, 39, 2739, 'Topshop', 'neha', '2016-07-28 07:11:01'),
(17204, 34, 2740, 'Blue Angel Sleeved Blouse', 'neha', '2016-07-28 07:11:01'),
(17205, 35, 2740, '990', 'neha', '2016-07-28 07:11:01'),
(17206, 36, 2740, 'M, L', 'neha', '2016-07-28 07:11:01'),
(17207, 37, 2740, 'A semi-sheer blouse featuring a dolphin hem and long sleeves', 'neha', '2016-07-28 07:11:01'),
(17208, 38, 2740, '100% Polyester', 'neha', '2016-07-28 07:11:01'),
(17209, 39, 2740, 'Topshop', 'neha', '2016-07-28 07:11:01'),
(17210, 34, 2741, 'Mandarin Collar Pocket Blouse', 'neha', '2016-07-28 07:11:01'),
(17211, 35, 2741, '1259', 'neha', '2016-07-28 07:11:01'),
(17212, 36, 2741, 'XS, S, M, L', 'neha', '2016-07-28 07:11:01'),
(17213, 37, 2741, 'A semi-sheer blouse with long sleeves, a round high-low hem, and a button keyhole back', 'neha', '2016-07-28 07:11:01'),
(17214, 38, 2741, '100% Polyester', 'neha', '2016-07-28 07:11:01'),
(17215, 39, 2741, 'Topshop', 'neha', '2016-07-28 07:11:01'),
(17216, 34, 2742, 'Floral Peasant Top', 'neha', '2016-07-28 07:11:01'),
(17217, 35, 2742, '1100', 'neha', '2016-07-28 07:11:01'),
(17218, 36, 2742, 'XS, S, M, L', 'neha', '2016-07-28 07:11:01'),
(17219, 37, 2742, 'A peasant top featuring a paisley floral print with a self-tie closure', 'neha', '2016-07-28 07:11:01'),
(17220, 38, 2742, '100% Rayon', 'neha', '2016-07-28 07:11:01'),
(17221, 39, 2742, 'Topshop', 'neha', '2016-07-28 07:11:01'),
(17222, 34, 2743, 'Chic Frilly Top', 'neha', '2016-07-28 07:11:01'),
(17223, 35, 2743, '899', 'neha', '2016-07-28 07:11:01'),
(17224, 36, 2743, 'XS, S, M', 'neha', '2016-07-28 07:11:01'),
(17225, 37, 2743, 'A semi-sheer polyster top featuring layer frills in the front', 'neha', '2016-07-28 07:11:01'),
(17226, 38, 2743, '100% Polyester', 'neha', '2016-07-28 07:11:01'),
(17227, 39, 2743, 'Topshop', 'neha', '2016-07-28 07:11:01'),
(17228, 34, 2744, 'Tartan Flannel Shirt', 'neha', '2016-07-28 07:11:01'),
(17229, 35, 2744, '1200', 'neha', '2016-07-28 07:11:01'),
(17230, 36, 2744, 'S, M, L', 'neha', '2016-07-28 07:11:01'),
(17231, 34, 2745, 'Gold Layered Bar Pendant Necklace', 'neha', '2016-07-28 07:11:02'),
(17232, 35, 2745, '299', 'neha', '2016-07-28 07:11:02'),
(17233, 36, 2745, 'One Size', 'neha', '2016-07-28 07:11:02'),
(17234, 37, 2745, 'A layered necklace featuring a pendant on both the beaded chains', 'neha', '2016-07-28 07:11:02'),
(17235, 39, 2745, 'Forever 21', 'neha', '2016-07-28 07:11:02'),
(17236, 34, 2746, 'Gold Caged Cutout Jewellery Set', 'neha', '2016-07-28 07:11:02'),
(17237, 35, 2746, '599', 'neha', '2016-07-28 07:11:02'),
(17238, 36, 2746, 'One Size', 'neha', '2016-07-28 07:11:02'),
(17239, 37, 2746, 'This high polish set is complete with two geo cutout rings and a cutout midi ring', 'neha', '2016-07-28 07:11:02'),
(17240, 39, 2746, 'Forever 21', 'neha', '2016-07-28 07:11:02'),
(17241, 34, 2747, 'Goldclear Cubic Zirconia Earings', 'neha', '2016-07-28 07:11:02'),
(17242, 35, 2747, '350', 'neha', '2016-07-28 07:11:02'),
(17243, 36, 2747, 'One Size', 'neha', '2016-07-28 07:11:02'),
(17244, 37, 2747, 'A pair of studs featuring pearlescent faux stones', 'neha', '2016-07-28 07:11:02'),
(17245, 39, 2747, 'Forever 21', 'neha', '2016-07-28 07:11:02'),
(17246, 34, 2748, 'Red Leather Strap Watch', 'neha', '2016-07-28 07:11:02'),
(17247, 35, 2748, '750', 'neha', '2016-07-28 07:11:02'),
(17248, 36, 2748, 'One Size', 'neha', '2016-07-28 07:11:02'),
(17249, 37, 2748, 'A golden watch with a red leather strap', 'neha', '2016-07-28 07:11:02'),
(17250, 39, 2748, 'Harrods', 'neha', '2016-07-28 07:11:02'),
(17251, 34, 2749, 'Silver Necklace With Stone Beads', 'neha', '2016-07-28 07:11:02'),
(17252, 35, 2749, '500', 'neha', '2016-07-28 07:11:02'),
(17253, 36, 2749, 'One Size', 'neha', '2016-07-28 07:11:02'),
(17254, 37, 2749, 'A short chain necklace featuring a clustered faux stone bib', 'neha', '2016-07-28 07:11:02'),
(17255, 39, 2749, 'Harrods', 'neha', '2016-07-28 07:11:02'),
(17256, 34, 2750, 'Camel Fringed Faux Leather Bucket Bag', 'neha', '2016-07-28 07:11:02'),
(17257, 35, 2750, '1200', 'neha', '2016-07-28 07:11:02'),
(17258, 36, 2750, 'One Size', 'neha', '2016-07-28 07:11:02'),
(17259, 37, 2750, 'This one definitely fits the bill with its textured faux leather to give you a boho look', 'neha', '2016-07-28 07:11:02'),
(17260, 39, 2750, 'Zara', 'neha', '2016-07-28 07:11:02'),
(17261, 34, 2751, 'Coral Shoulder Bag', 'neha', '2016-07-28 07:11:02'),
(17262, 35, 2751, '700', 'neha', '2016-07-28 07:11:02'),
(17263, 36, 2751, 'One Size', 'neha', '2016-07-28 07:11:02'),
(17264, 34, 2752, 'Chained Faux Leather Crossbody', 'neha', '2016-07-28 07:11:02'),
(17265, 35, 2752, '1100', 'neha', '2016-07-28 07:11:02'),
(17266, 36, 2752, 'One Size', 'neha', '2016-07-28 07:11:02'),
(17267, 34, 2753, 'Faux Leather Drawstring Backpack', 'neha', '2016-07-28 07:11:02'),
(17268, 35, 2753, '1800', 'neha', '2016-07-28 07:11:02'),
(17269, 36, 2753, 'One Size', 'neha', '2016-07-28 07:11:02'),
(17270, 34, 2754, 'Classic Faux Leather Satchel', 'neha', '2016-07-28 07:11:02'),
(17271, 35, 2754, '2300', 'neha', '2016-07-28 07:11:02'),
(17272, 36, 2754, 'One Size', 'neha', '2016-07-28 07:11:02'),
(17273, 37, 2754, 'A large faux leather bag featuring an open-top with magnetic snap closure', 'neha', '2016-07-28 07:11:02'),
(17274, 38, 2754, ' Interior Zip & Patch Pockets', 'neha', '2016-07-28 07:11:02'),
(17275, 39, 2754, 'Harrods', 'neha', '2016-07-28 07:11:02');

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
,`category_id` int(10) unsigned
,`subcategory_id` int(10) unsigned
,`brand_name` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `favourite_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favourite_id`, `user_id`, `product_id`, `updated_on`) VALUES
(46, 7, 2748, '2016-07-28 07:59:49');

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
  `news_id` int(10) unsigned NOT NULL,
  `news_category` varchar(50) DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  `image_url` varchar(1000) DEFAULT NULL,
  `headline` varchar(250) DEFAULT NULL,
  `details` varchar(10000) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `market_news`
--

INSERT INTO `market_news` (`news_id`, `news_category`, `priority`, `image_url`, `headline`, `details`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(5, 'Market News', 0, NULL, 'Fashion Sale on!', 'Test', '2016-06-02 06:21:19', 'admin', '2016-06-02 06:21:19', 'admin'),
(6, 'Market News', 0, NULL, 'Flash Sale on our selected range of products', 'Test 2', '2016-06-02 06:30:35', 'admin', '2016-06-02 06:30:35', 'admin'),
(7, '2', 1, './assets/market_news_img/a456bf028e50e88ce2555a4e8dd2a7ae.jpg', 'pankaj', 'fdgdfg', '2016-08-03 10:06:40', 'admin', '2016-08-03 10:14:16', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `master_attribute_header`
--

CREATE TABLE IF NOT EXISTS `master_attribute_header` (
  `attribute_header_id` int(10) NOT NULL,
  `attribute_header_title` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_attribute_header`
--

INSERT INTO `master_attribute_header` (`attribute_header_id`, `attribute_header_title`, `is_active`) VALUES
(1, 'PRODUCT DETAILS', 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_attribute_type`
--

CREATE TABLE IF NOT EXISTS `master_attribute_type` (
  `attribute_type_id` int(11) NOT NULL,
  `attribute_type_title` varchar(50) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
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
  `id` int(11) NOT NULL,
  `city_name` varchar(30) NOT NULL,
  `is_active` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

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
(23, 'MADURAI', '1');

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
  `image_id` int(10) unsigned NOT NULL,
  `image_url` varchar(1000) DEFAULT NULL,
  `image_thumbnail_url` varchar(1000) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mood_images`
--

INSERT INTO `mood_images` (`image_id`, `image_url`, `image_thumbnail_url`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(1, '/resources/img/product/MD1.jpg', '/assets/home_page_images/MD1_thumbnail.jpg', '2016-06-02 11:02:19', 'admin', '2016-06-02 11:02:19', 'admin'),
(2, '/resources/img/product/MD3.jpg', '/assets/home_page_images/MD3_thumbnail.jpg', '2016-06-02 11:02:19', 'admin', '2016-06-02 11:02:19', 'admin'),
(3, '/resources/img/product/MD5.jpg', '/assets/home_page_images/MD5_thumbnail.jpg', '2016-06-02 11:02:19', 'admin', '2016-06-02 11:02:19', 'admin'),
(4, '/resources/img/product/MD2.jpg', '/assets/home_page_images/MD2_thumbnail.jpg', '2016-06-02 11:02:19', 'admin', '2016-06-02 11:02:19', 'admin'),
(5, '/resources/img/product/MD6.jpg', '/resources/home_page_images/MD6_thumbnail.jpg', '2016-06-02 11:02:19', 'admin', '2016-06-02 11:02:19', 'admin');

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
  `product_id` int(10) unsigned NOT NULL,
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
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2755 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `category_id`, `subcategory_id`, `description`, `is_hot`, `is_new`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_active`) VALUES
(2723, '1', 81, 107, '', '0', '0', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha', 1),
(2724, '2', 81, 107, '', '0', '0', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha', 1),
(2725, '3', 81, 107, '', '0', '0', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha', 1),
(2726, '4', 81, 107, '', '0', '0', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha', 1),
(2727, '5', 81, 107, '', '0', '0', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha', 1),
(2728, '6', 81, 107, '', '0', '0', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha', 1),
(2729, '7', 81, 108, '', '0', '0', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha', 1),
(2730, '8', 81, 108, '', '0', '0', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha', 1),
(2731, '9', 81, 108, '', '0', '0', '2016-07-28 07:11:00', 'EXCEL', '2016-07-28 07:11:00', 'neha', 1),
(2732, '10', 81, 108, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2733, '11', 81, 108, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2734, '12', 82, 109, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2735, '13', 82, 109, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2736, '14', 82, 109, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2737, '15', 82, 109, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2738, '16', 82, 109, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2739, '17', 82, 109, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2740, '18', 82, 110, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2741, '19', 82, 110, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2742, '20', 82, 110, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2743, '21', 82, 110, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2744, '22', 82, 110, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2745, '23', 83, 111, '', '0', '0', '2016-07-28 07:11:01', 'EXCEL', '2016-07-28 07:11:01', 'neha', 1),
(2746, '24', 83, 111, '', '0', '0', '2016-07-28 07:11:02', 'EXCEL', '2016-07-28 07:11:02', 'neha', 1),
(2747, '25', 83, 111, '', '0', '0', '2016-07-28 07:11:02', 'EXCEL', '2016-07-28 07:11:02', 'neha', 1),
(2748, '26', 83, 111, '', '0', '0', '2016-07-28 07:11:02', 'EXCEL', '2016-07-28 07:11:02', 'neha', 1),
(2749, '27', 83, 111, '', '0', '0', '2016-07-28 07:11:02', 'EXCEL', '2016-07-28 07:11:02', 'neha', 1),
(2750, '28', 83, 112, '', '0', '0', '2016-07-28 07:11:02', 'EXCEL', '2016-07-28 07:11:02', 'neha', 1),
(2751, '29', 83, 112, '', '0', '0', '2016-07-28 07:11:02', 'EXCEL', '2016-07-28 07:11:02', 'neha', 1),
(2752, '30', 83, 112, '', '0', '0', '2016-07-28 07:11:02', 'EXCEL', '2016-07-28 07:11:02', 'neha', 1),
(2753, '31', 83, 112, '', '0', '0', '2016-07-28 07:11:02', 'EXCEL', '2016-07-28 07:11:02', 'neha', 1),
(2754, '32', 83, 112, '', '0', '0', '2016-07-28 07:11:02', 'EXCEL', '2016-07-28 07:11:02', 'neha', 1);

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
  `catalog_id` int(10) unsigned NOT NULL,
  `catalog_title` varchar(200) DEFAULT NULL,
  `catalog_url` varchar(256) DEFAULT NULL,
  `catalog_size` varchar(20) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_catalog`
--

INSERT INTO `product_catalog` (`catalog_id`, `catalog_title`, `catalog_url`, `catalog_size`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(24, 'jb-2016-workwear-3', '/resources/pdf/jb-2016-workwear-3.pdf', '11729375', '2016-06-01 13:29:55', '1312pari', '2016-06-01 13:29:55', '1312pari'),
(25, 'SPORLOC_Product_Features1', './assets/product_catalog/SPORLOC_Product_Features1.pdf', '206.62', '2016-08-03 17:27:20', 'admin', '2016-08-03 11:57:20', 'admin'),
(41, 'SPORLOC_Product_Features', 'assets/product_catalog/product_catalog/SPORLOC_Product_Features.pdf', '211576', '2016-08-05 14:45:59', 'admin', '2016-08-05 09:15:59', 'admin'),
(42, 'SPORLOC_Product_Features1', 'assets/product_catalog/product_catalog/SPORLOC_Product_Features1.pdf', '211576', '2016-08-05 14:45:59', 'admin', '2016-08-05 09:15:59', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `category_id` int(10) unsigned NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `sort_order` int(3) NOT NULL,
  `image_url` varchar(1000) DEFAULT NULL,
  `image_thumbnail_url` varchar(1000) DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `is_active` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`category_id`, `category_name`, `description`, `sort_order`, `image_url`, `image_thumbnail_url`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_active`) VALUES
(81, 'Shoes', 'Added by EXCEL', 0, NULL, NULL, '2016-06-06 13:35:01', 'EXCEL', '2016-06-06 13:35:01', 'admin', 1),
(82, 'Tops', 'Added by EXCEL', 0, NULL, NULL, '2016-06-06 13:35:02', 'EXCEL', '2016-06-06 13:35:02', 'admin', 1),
(83, 'Accessories', 'Added by EXCEL updated by admin ', 0, './assets/img/jewel/Accessories.jpg', './assets/img/jewel/Accessories_thumbnail.jpg', '2016-06-06 13:35:03', 'EXCEL', '2016-08-03 16:04:13', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE IF NOT EXISTS `product_images` (
  `image_id` int(10) unsigned NOT NULL,
  `image_url` varchar(256) DEFAULT NULL,
  `image_thumbnail_url` varchar(256) DEFAULT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=310 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`image_id`, `image_url`, `image_thumbnail_url`, `product_id`, `created_on`, `created_by`, `updated_on`, `updated_by`) VALUES
(278, '/resources/img/product/21.jpg', '/resources/img/product/21_thumbnail.jpg', 2743, '2016-07-28 07:16:22', 'neha', '2016-07-28 07:16:22', 'neha'),
(279, '/resources/img/product/3.jpg', '/resources/img/product/3_thumbnail.jpg', 2725, '2016-07-28 07:16:22', 'neha', '2016-07-28 07:16:22', 'neha'),
(280, '/resources/img/product/13.jpg', '/resources/img/product/13_thumbnail.jpg', 2735, '2016-07-28 07:16:22', 'neha', '2016-07-28 07:16:22', 'neha'),
(281, '/resources/img/product/20.jpg', '/resources/img/product/20_thumbnail.jpg', 2742, '2016-07-28 07:16:22', 'neha', '2016-07-28 07:16:22', 'neha'),
(282, '/resources/img/product/2.jpg', '/resources/img/product/2_thumbnail.jpg', 2724, '2016-07-28 07:16:22', 'neha', '2016-07-28 07:16:22', 'neha'),
(283, '/resources/img/product/28.jpg', '/resources/img/product/28_thumbnail.jpg', 2750, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(284, '/resources/img/product/30.jpg', '/resources/img/product/30_thumbnail.jpg', 2752, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(285, '/resources/img/product/4.jpg', '/resources/img/product/4_thumbnail.jpg', 2726, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(286, '/resources/img/product/27.jpg', '/resources/img/product/27_thumbnail.jpg', 2749, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(287, '/resources/img/product/1.jpg', '/resources/img/product/1_thumbnail.jpg', 2723, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(288, '/resources/img/product/19.jpg', '/resources/img/product/19_thumbnail.jpg', 2741, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(289, '/resources/img/product/18.jpg', '/resources/img/product/18_thumbnail.jpg', 2740, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(290, '/resources/img/product/24.jpg', '/resources/img/product/24_thumbnail.jpg', 2746, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(291, '/resources/img/product/5.jpg', '/resources/img/product/5_thumbnail.jpg', 2727, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(292, '/resources/img/product/15.jpg', '/resources/img/product/15_thumbnail.jpg', 2737, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(293, '/resources/img/product/29.jpg', '/resources/img/product/29_thumbnail.jpg', 2751, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(294, '/resources/img/product/16.jpg', '/resources/img/product/16_thumbnail.jpg', 2738, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(295, '/resources/img/product/14.jpg', '/resources/img/product/14_thumbnail.jpg', 2736, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(296, '/resources/img/product/25.jpg', '/resources/img/product/25_thumbnail.jpg', 2747, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(297, '/resources/img/product/6.jpg', '/resources/img/product/6_thumbnail.jpg', 2728, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(298, '/resources/img/product/9.jpg', '/resources/img/product/9_thumbnail.jpg', 2731, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(299, '/resources/img/product/23.jpg', '/resources/img/product/23_thumbnail.jpg', 2745, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(300, '/resources/img/product/26.jpg', '/resources/img/product/26_thumbnail.jpg', 2748, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(301, '/resources/img/product/32.jpg', '/resources/img/product/32_thumbnail.jpg', 2754, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(302, '/resources/img/product/12.jpg', '/resources/img/product/12_thumbnail.jpg', 2734, '2016-07-28 07:16:23', 'neha', '2016-07-28 07:16:23', 'neha'),
(303, '/resources/img/product/7.jpg', '/resources/img/product/7_thumbnail.jpg', 2729, '2016-07-28 07:16:26', 'neha', '2016-07-28 07:16:26', 'neha'),
(304, '/resources/img/product/11.jpg', '/resources/img/product/11_thumbnail.jpg', 2733, '2016-07-28 07:16:26', 'neha', '2016-07-28 07:16:26', 'neha'),
(305, '/resources/img/product/31.jpg', '/resources/img/product/31_thumbnail.jpg', 2753, '2016-07-28 07:16:38', 'neha', '2016-07-28 07:16:38', 'neha'),
(306, '/resources/img/product/17.jpg', '/resources/img/product/17_thumbnail.jpg', 2739, '2016-07-28 07:16:38', 'neha', '2016-07-28 07:16:38', 'neha'),
(307, '/resources/img/product/8.jpg', '/resources/img/product/8_thumbnail.jpg', 2730, '2016-07-28 07:16:38', 'neha', '2016-07-28 07:16:38', 'neha'),
(308, '/resources/img/product/10.jpg', '/resources/img/product/10_thumbnail.jpg', 2732, '2016-07-28 07:16:39', 'neha', '2016-07-28 07:16:39', 'neha'),
(309, '/resources/img/product/22.jpg', '/resources/img/product/22_thumbnail.jpg', 2744, '2016-07-28 07:16:39', 'neha', '2016-07-28 07:16:39', 'neha');

-- --------------------------------------------------------

--
-- Table structure for table `product_subcategory`
--

CREATE TABLE IF NOT EXISTS `product_subcategory` (
  `subcategory_id` int(10) unsigned NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `image_url` varchar(1000) DEFAULT NULL,
  `image_thumbnail_url` varchar(1000) DEFAULT NULL,
  `sort_order` int(2) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_subcategory`
--

INSERT INTO `product_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`, `description`, `image_url`, `image_thumbnail_url`, `sort_order`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_active`) VALUES
(107, 'Heels', 81, 'Added by EXCEL', NULL, NULL, 0, '2016-06-06 13:35:01', 'EXCEL', '2016-06-06 13:35:01', 'admin', 1),
(108, 'Flats', 81, 'Added by EXCEL', NULL, NULL, 0, '2016-06-06 13:35:02', 'EXCEL', '2016-06-06 13:35:02', 'admin', 1),
(109, 'Tees', 82, 'Added by EXCEL', NULL, NULL, 0, '2016-06-06 13:35:02', 'EXCEL', '2016-06-06 13:35:02', 'admin', 1),
(110, 'Blouses', 82, 'Added by EXCEL', NULL, NULL, 0, '2016-06-06 13:35:03', 'EXCEL', '2016-06-06 13:35:03', 'admin', 1),
(111, 'Jewellery', 83, 'Added by EXCEL', NULL, NULL, 0, '2016-06-06 13:35:03', 'EXCEL', '2016-06-06 13:35:03', 'admin', 1),
(112, 'Bags', 83, 'Added by EXCEL', NULL, NULL, 0, '2016-06-06 13:35:03', 'EXCEL', '2016-06-06 13:35:03', 'admin', 1),
(113, 'pankaj', 82, 'Added by admin ', NULL, NULL, 2, '2016-08-03 16:08:48', 'admin', '0000-00-00 00:00:00', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `push_notification_data`
--

CREATE TABLE IF NOT EXISTS `push_notification_data` (
  `notification_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `message` varchar(256) DEFAULT NULL,
  `sent_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sent_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rfq_data`
--

CREATE TABLE IF NOT EXISTS `rfq_data` (
  `data_id` int(10) unsigned NOT NULL,
  `rfq_id` varchar(50) DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `requested_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_till` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rfq_status` varchar(100) DEFAULT NULL,
  `updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_by` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_activity_log`
--

CREATE TABLE IF NOT EXISTS `user_activity_log` (
  `activity_id` int(10) unsigned NOT NULL,
  `activity_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(50) NOT NULL,
  `event_type` varchar(1000) NOT NULL,
  `activity_comment` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=211 DEFAULT CHARSET=latin1;

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
(210, '2016-08-01 08:05:57', 18, '', 'Login', ' user logged in');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int(10) unsigned NOT NULL,
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
  `gmail_id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `username`, `password`, `firstname`, `lastname`, `email_id`, `primary_phone_number`, `user_type`, `user_permissions`, `image_url`, `image_thumbnail_url`, `company_name`, `is_enable`, `device_type`, `device_id`, `gcm_id`, `api_key`, `created_on`, `created_by`, `updated_on`, `updated_by`, `approved_on`, `approved_by`, `valid_through`, `OTP`, `OTP_timestamp`, `OTP_confirmed`, `fb_id`, `gmail_id`) VALUES
(6, 'pranita.sable91@gmail.com', '', 'Pranita', 'Sable', 'pranita.sable91@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 0, 'android', NULL, 'APA91bFTn1k1OAjLrZZYEhIRIqnNXsF1xJeL1db_IQ_tc0cac04Rme0Em12yZawM3GtMcl3JlVJ_nSkaqp_hGrZc2NfNrZrssXHzgkbG16HVU69_MtYkRVDkjhOGEevuPyVJyDs2OoUA', '46b569ebc4d63e097e2fc8d851e9f63d', '2016-07-15 11:52:21', 'user', '2016-07-15 11:52:21', 'user', '2016-05-08 18:30:00', NULL, '2016-05-08 18:30:00', '1094', '2016-07-15 17:22:21', 0, '12345', NULL),
(7, 'sourabh.b@lastlocal.in', '12345', 'SLastlocal', 'SLastlocal', 'sourabh.b@lastlocal.in', NULL, 'disabled', NULL, NULL, NULL, NULL, 0, 'android', NULL, '', '8ac2f744440cd8f9a2b580431d032aa7', '2016-05-09 00:00:00', 'user', '2016-08-03 09:48:13', 'admin', '2016-05-11 11:48:13', 'admin', '2016-08-31 00:00:00', '1270', '2016-07-27 16:42:43', 1, '236333276733350', NULL),
(8, 'kaustubha4u@gmail.com', '', 'Kaustubha', 'Panchal', 'kaustubha4u@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, '3898434-0395-0', '325a7e7174a5cdc0129581ef2dfec6cb', '2016-05-09 16:55:56', 'user', '2016-08-03 09:48:08', 'admin', '2016-05-09 16:55:56', NULL, '2016-05-09 16:55:56', '1319', '2016-05-09 21:47:06', 0, '10205788355501122', NULL),
(12, 'rishmalath@gmail.com', '', 'Rishma', 'Lath', 'rishmalath@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 0, 'android', NULL, 'APA91bEwGZQ4nRR2gAlsi-8egMLWKeqFQ4L55m57tkrLqf_vAh5snW3XMkHNZdLcZyDV2T3jWEKmju05mSKqyzvfhG6YVFdfBeUzV8nSB69lOdg1boz8OeLjb8PfJh0324NJD6gg_HS2', 'c5010cca9cfda4937ec36557eec0b8e5', '2016-07-15 12:06:32', 'user', '2016-07-15 12:19:05', 'user', '2016-07-15 12:06:32', NULL, '2016-07-15 12:06:32', '1737', '2016-07-15 17:49:05', 0, '10154979996123448', NULL),
(16, 'yashbaid87@gmail.com', '', 'Yash', 'Baid', 'yashbaid87@gmail.com', NULL, 'disabled', NULL, NULL, NULL, NULL, 0, 'android', NULL, 'APA91bFsJmMsJgKNnOkjmVUY6v72QhpjjF8qVix0gVFFiLNJIxFzo0FBrEwufitsqJwrUQMU6NwoFYiH0Z4eX8umokqFIpZ7vX--jDgqcXJDyG6XwflsiDs9-egnUBAjqS7r52gAZj6T', 'c0e2be09d8dbc05caab36652bd455856', '2016-07-25 09:06:15', 'user', '2016-08-03 09:47:57', 'admin', '2016-07-25 09:06:15', NULL, '2016-07-25 09:06:15', '1721', '2016-07-25 14:36:15', 1, '10154055505214093', NULL),
(17, 'baid@lastlocal.in', '1234567', 'yash', '', 'baid@lastlocal.in', NULL, 'pending', NULL, NULL, NULL, NULL, 0, 'android', NULL, 'APA91bFsJmMsJgKNnOkjmVUY6v72QhpjjF8qVix0gVFFiLNJIxFzo0FBrEwufitsqJwrUQMU6NwoFYiH0Z4eX8umokqFIpZ7vX--jDgqcXJDyG6XwflsiDs9-egnUBAjqS7r52gAZj6T', 'fb0aa13efb9ac71e1c09094d7102d798', '2016-07-25 09:06:56', 'user', '2016-07-25 09:06:56', 'user', '2016-07-25 09:06:56', NULL, '2016-07-25 09:06:56', '1845', '2016-07-25 14:36:56', 1, '', NULL),
(18, 'mach.neha@gmail.com', '123456', 'Neha', 'Mach', 'mach.neha@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bF6hKbn2-Qo0-EmJZlBsggBwyYXm-G73nLSZnzooxC1y9GHZhctxBPgQXw5T3-PrEtLzp3wRYnyd1e3mAnSlTiF4zywoVGcnjLYoa7rcT7BXQr2cNss-wN8eciyEXu4In2ym8_-', '0e826bdd15c58f918bb77a66d40afc96', '2016-07-25 09:12:13', 'user', '2016-07-27 09:51:36', 'user', '2016-07-25 09:12:13', NULL, '2026-09-25 09:12:13', '9401', '2016-07-28 14:01:24', 1, '1083402001724897', NULL),
(21, 'neha.m@lastlocal.in', '123456', 'neha', '', 'neha.m@lastlocal.in', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, 'APA91bHpVXRIs08CgDWVuCQUZViGO_-oAm0i8dbdcwf7cu6eHBvhF_vJwgHXH0ZE1FbW-PJxhP6KtEIA4xpsMTFdCMQXrRdnmLaWiEgodi71rQFrep-kD2v9ySv6r0YrRiqKW1Ynh901', '74691f61af3ead6035efd881435a3dea', '2016-07-25 09:16:07', 'user', '2016-07-25 09:16:07', 'user', '2016-07-25 09:16:07', NULL, '2026-07-25 09:16:07', '8008', '2016-07-25 14:46:07', 1, '', NULL),
(26, 'pranita.s@lastlocal.in', '123456', 'pranita', 'sable', 'pranita.s@lastlocal.in', NULL, 'pending', NULL, NULL, NULL, NULL, 0, 'android', NULL, '3898434-0395-0', '0e7a6b63ed9aa9e491e3b20440843273', '2016-07-25 09:31:56', 'user', '2016-07-25 09:31:56', 'user', '2016-07-25 09:31:56', NULL, '2016-07-25 09:31:56', '1927', '2016-07-25 15:01:56', 0, NULL, NULL),
(27, 'lastdevelopers@gmail.com', '', 'LastLocal', 'Devs', 'lastdevelopers@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 0, 'android', NULL, 'APA91bGI6qDwtdv_GdWRBWsq_UMDf6jUtdQApMiDZRiUwXMrNmTN-9i1YSFmTshppXAXsWef4XF5VYWt954YHZES6IBZ5nNzqR_vtzygOEr9uKi0o3K7GXA-cF-bsqBDphiPCPl5hP4A', 'cfe032bc8af64640b0c242cf27372a3b', '2016-07-27 10:04:43', 'user', '2016-07-28 15:15:59', 'user', '2016-07-25 10:58:34', NULL, '2016-07-25 10:58:34', '4525', '2016-07-27 15:34:43', 0, '312107082465323', NULL),
(40, 'kaustubha6899@gmail.com', '', 'pranita', 'sable', 'kaustubha6899@gmail.com', NULL, 'pending', NULL, NULL, NULL, NULL, 1, 'android', NULL, '3898434-0395-0', '74768333bc88ffc4bce3a6f22a66433b', '2016-07-28 08:38:50', 'user', '2016-07-28 08:38:50', 'user', '2016-07-28 08:38:50', NULL, '2026-07-28 08:38:50', '1261', '2016-07-28 14:08:50', 1, NULL, '78533');

-- --------------------------------------------------------

--
-- Structure for view `atr_table`
--
DROP TABLE IF EXISTS `atr_table`;

CREATE ALGORITHM=UNDEFINED DEFINER=`wc_user`@`%` SQL SECURITY DEFINER VIEW `atr_table` AS (select `a`.`attribute_name` AS `name`,`av`.`attribute_value` AS `value`,`p`.`product_id` AS `id` from ((`attribute_value` `av` join `attribute` `a` on((`a`.`attribute_id` = `av`.`attribute_id`))) join `product` `p` on((`p`.`product_id` = `av`.`product_id`))));

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `brands_data` AS select `p`.`product_id` AS `product_id`,`p`.`category_id` AS `category_id`,`p`.`subcategory_id` AS `subcategory_id`,`av`.`attribute_value` AS `brand_name` from ((((`product` `p` join `product_category` `pc`) join `product_subcategory` `ps`) join `attribute_value` `av`) join `attribute` `a`) where ((`pc`.`category_id` = `p`.`category_id`) and (`ps`.`subcategory_id` = `p`.`subcategory_id`) and (`p`.`product_id` = `av`.`product_id`) and `av`.`attribute_id` in (select distinct `a`.`attribute_id` from (`attribute` `a` join `attribute_value` `av`) where ((`a`.`attribute_name` like '%brand%') and (`av`.`attribute_id` = `a`.`attribute_id`))));

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
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_details`
--
ALTER TABLE `admin_details`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attribute_id`),
  ADD UNIQUE KEY `attribute_name` (`attribute_name`);

--
-- Indexes for table `attribute_value`
--
ALTER TABLE `attribute_value`
  ADD PRIMARY KEY (`attribute_value_id`),
  ADD UNIQUE KEY `atrtibute_id_product` (`attribute_id`,`product_id`),
  ADD KEY `fk_attribute_value_product` (`product_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favourite_id`),
  ADD UNIQUE KEY `uk_favourites` (`favourite_id`),
  ADD KEY `fk_user_details_favorites` (`user_id`),
  ADD KEY `fk_product_favorites` (`product_id`);

--
-- Indexes for table `market_news`
--
ALTER TABLE `market_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `master_city`
--
ALTER TABLE `master_city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mood_images`
--
ALTER TABLE `mood_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `fk_product_prod_subcategory` (`subcategory_id`),
  ADD KEY `fk_product_prod_category` (`category_id`);

--
-- Indexes for table `product_catalog`
--
ALTER TABLE `product_catalog`
  ADD PRIMARY KEY (`catalog_id`),
  ADD UNIQUE KEY `catalog_url` (`catalog_url`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`image_id`),
  ADD UNIQUE KEY `image_url` (`image_url`),
  ADD UNIQUE KEY `image_thumbnail_url` (`image_thumbnail_url`),
  ADD KEY `fk_product_images_product` (`product_id`);

--
-- Indexes for table `product_subcategory`
--
ALTER TABLE `product_subcategory`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD UNIQUE KEY `subcategory_name` (`subcategory_name`),
  ADD UNIQUE KEY `uk_prod_subcategory` (`category_id`,`subcategory_id`);

--
-- Indexes for table `push_notification_data`
--
ALTER TABLE `push_notification_data`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `fk_push_notification_data` (`user_id`);

--
-- Indexes for table `rfq_data`
--
ALTER TABLE `rfq_data`
  ADD PRIMARY KEY (`data_id`),
  ADD KEY `fk_rfq_data_user` (`user_id`),
  ADD KEY `fk_rfq_data_product` (`product_id`);

--
-- Indexes for table `user_activity_log`
--
ALTER TABLE `user_activity_log`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `fk_user_details_activity` (`user_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email_id` (`email_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_details`
--
ALTER TABLE `admin_details`
  MODIFY `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attribute_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `attribute_value`
--
ALTER TABLE `attribute_value`
  MODIFY `attribute_value_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17276;
--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favourite_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=47;
--
-- AUTO_INCREMENT for table `market_news`
--
ALTER TABLE `market_news`
  MODIFY `news_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `master_city`
--
ALTER TABLE `master_city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `mood_images`
--
ALTER TABLE `mood_images`
  MODIFY `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2755;
--
-- AUTO_INCREMENT for table `product_catalog`
--
ALTER TABLE `product_catalog`
  MODIFY `catalog_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `image_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=310;
--
-- AUTO_INCREMENT for table `product_subcategory`
--
ALTER TABLE `product_subcategory`
  MODIFY `subcategory_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=114;
--
-- AUTO_INCREMENT for table `push_notification_data`
--
ALTER TABLE `push_notification_data`
  MODIFY `notification_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rfq_data`
--
ALTER TABLE `rfq_data`
  MODIFY `data_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_activity_log`
--
ALTER TABLE `user_activity_log`
  MODIFY `activity_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=211;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
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
