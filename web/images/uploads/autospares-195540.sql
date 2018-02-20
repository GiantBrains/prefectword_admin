-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2018 at 04:28 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.1.13-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `autospares`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `land_mark` varchar(255) DEFAULT NULL,
  `telephone_1` varchar(255) DEFAULT NULL,
  `telephone_2` varchar(255) DEFAULT NULL,
  `county` int(11) DEFAULT NULL,
  `sub_county` int(11) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `first_name`, `last_name`, `country`, `land_mark`, `telephone_1`, `telephone_2`, `county`, `sub_county`, `city`, `zip_code`, `status`) VALUES
(2, 26, 'Steve', 'Bannon', 'Kenya', 'Nasa', '0733966136', NULL, 47, 27, 'nairobi', '00100', 1),
(3, 26, 'Steve', 'Bannon', 'Kenya', 'Corner Mosque', '0724100244', NULL, 47, 29, 'nairobi', '00100', 0),
(6, 17, 'mercy', 'waceke', 'Kenya', 'Shrine', '0723129622', NULL, 32, 127, 'nakuru', '20100', 1),
(7, 20, 'stephen', 'kariuki', 'Kenya', 'Shrine', '0714600700', NULL, 32, 116, 'subukia', 'subukia', 1),
(8, 24, 'George', 'Ndungu', 'Kenya', 'Shrine', '0791200200', NULL, 32, 116, 'subukia', '20100', 1),
(14, 30, 'Anthony', 'Gitau', 'Kenya', 'Kenyatta University', '07`12966136', NULL, 47, 28, 'Roysambu', '00100', 1),
(15, 2, 'Hello', 'Customer', 'Kenya', '', '0712966136', NULL, 32, 139, 'subukia', '20100', 1),
(16, 1, 'Anthony', 'Gitau', 'Kenya', 'stadium', '0712966136', NULL, 47, 29, 'Nairobi', '00100', 1),
(17, 3, 'manager', 'manager', 'Kenya', 'Stadium', '0712966136', NULL, 32, 91, 'Kihingo', '20100', 1),
(18, 4, 'nderitus@ymail.com', 'nderitus@ymail.com', 'Kenya', 'bla', '0723350672', NULL, 47, 6, 'n', '10101', 1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1506686275),
('admin', '4', 1512461478),
('admin', '6', 1512989818),
('client', '2', 1506686611),
('client', '5', 1512989461),
('client', '8', 1515582823),
('manager', '3', 1512400442);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'admin has all the rights in the system', NULL, NULL, 1506686275, 1506686275),
('admin-portal', 2, 'For all the users that can access the admin portal', NULL, NULL, NULL, NULL),
('client', 1, 'can add item to cart, remove item from cart, pay for an item, get discounts related to an item in cart', NULL, NULL, 1506686275, 1506686275),
('createItem', 2, 'Create a item', NULL, NULL, 1506686275, 1506686275),
('deleteItem', 2, 'can delete an item', NULL, NULL, NULL, NULL),
('manageOwnItem', 2, 'Manage own item', 'isClient', NULL, 1506686301, 1506686301),
('manager', 1, 'can create item, can edit item, can update item, can delete item', NULL, NULL, NULL, NULL),
('updateItem', 2, 'Update item', NULL, NULL, 1506686275, 1506686275);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'admin-portal'),
('manager', 'admin-portal'),
('manager', 'client'),
('manager', 'createItem'),
('manager', 'deleteItem'),
('manager', 'manageOwnItem'),
('admin', 'manager'),
('manageOwnItem', 'updateItem'),
('manager', 'updateItem');

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_rule`
--

INSERT INTO `auth_rule` (`name`, `data`, `created_at`, `updated_at`) VALUES
('isClient', 0x4f3a31393a226170705c726261635c436c69656e7452756c65223a333a7b733a343a226e616d65223b733a383a226973436c69656e74223b733a393a22637265617465644174223b693a313530363638363330313b733a393a22757064617465644174223b693a313530363638363330313b7d, 1506686301, 1506686301);

-- --------------------------------------------------------

--
-- Table structure for table `autoparts`
--

CREATE TABLE `autoparts` (
  `id` int(11) NOT NULL,
  `year_id` int(11) DEFAULT NULL,
  `make_id` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `part_id` int(11) DEFAULT NULL,
  `fitment_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  `visible` tinyint(1) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `fits` varchar(255) DEFAULT NULL,
  `pdt_img` varchar(255) DEFAULT NULL,
  `pdt_img2` varchar(255) DEFAULT NULL,
  `pdt_img3` varchar(255) DEFAULT NULL,
  `pdt_img4` varchar(255) DEFAULT NULL,
  `pdt_img5` varchar(255) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `warranty` int(11) DEFAULT NULL,
  `specifications` text,
  `description` text,
  `product_install_videos` text,
  `reviews` text,
  `questions` text,
  `vehicle_fitment` text,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `autoparts`
--

INSERT INTO `autoparts` (`id`, `year_id`, `make_id`, `model_id`, `part_id`, `fitment_id`, `brand_id`, `name`, `price`, `type`, `part`, `visible`, `product_code`, `fits`, `pdt_img`, `pdt_img2`, `pdt_img3`, `pdt_img4`, `pdt_img5`, `discount`, `warranty`, `specifications`, `description`, `product_install_videos`, `reviews`, `questions`, `vehicle_fitment`, `slug`, `created_at`, `updated_at`) VALUES
(1, 65, 8, 14, 10, 1, NULL, '2015 Audi A4  Brake Pad Set - front', 4000, 'Duralo Premium Ceramic Brake Pads - With Performance Shims', '70-00612 J5', 1, '70-00612 J5', 'Non-quattro - front', '2015-audi-a4-brake-pad-set-front.jpg', '2015-audi-a4-brake-pad-set-front-2.jpg', '2015-audi-a4-brake-pad-set-front-3.jpg', '2015-audi-a4-brake-pad-set-front-4.jpg', '2015-audi-a4-brake-pad-set-front-5.jpg', NULL, NULL, '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '2015-audi-a4-brake-pad-set-front', NULL, NULL),
(2, 65, 8, 14, 10, 2, NULL, '2015 Audi A4  Brake Pad Set - rear', 3300, 'Duralo Premium Ceramic Brake Pads - With Performance Shims', '70-00633 J5', 1, '70-00633 J5', 'Non-quattro - rear', '2015-audi-a4-brake-pad-set-rear.jpg', '2015-audi-a4-brake-pad-set-rear-2.jpg', '2015-audi-a4-brake-pad-set-rear-3.jpg', '2015-audi-a4-brake-pad-set-rear-4.jpg', '2015-audi-a4-brake-pad-set-rear-5.jpg', 32, 2, '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '2015-audi-a4-brake-pad-set-rear', NULL, NULL),
(3, 65, 8, 14, 10, 3, NULL, '2015 Audi A4  Brake Pad Set - Quattro - front', 4000, 'Duralo Premium Ceramic Brake Pads - With Performance Shims', '70-00612 J5', NULL, '70-00612 J5', 'Quattro - front', '2015-audi-a4-brake-pad-set-quattro-front.jpg', '2015-audi-a4-brake-pad-set-quattro-front-2.jpg', '2015-audi-a4-brake-pad-set-quattro-front-3.jpg', '2015-audi-a4-brake-pad-set-quattro-front-4.jpg', '2015-audi-a4-brake-pad-set-quattro-front-5.jpg', 25, 2, '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '2015-audi-a4-brake-pad-set-quattro-front', NULL, NULL),
(4, 65, 8, 14, 10, 4, NULL, '2015 Audi A4  Brake Pad Set - Quattro - rear', 3300, 'Duralo Premium Ceramic Brake Pads - With Performance Shim', '70-00633 J5', NULL, '70-00633 J5', 'Quattro - rear', '2015-audi-a4-brake-pad-set-quattro-rear.jpg', '2015-audi-a4-brake-pad-set-quattro-rear-2.jpg', '2015-audi-a4-brake-pad-set-quattro-rear-3.jpg', '2015-audi-a4-brake-pad-set-quattro-rear-4.jpg', '2015-audi-a4-brake-pad-set-quattro-rear-5.jpg', 15, 3, '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '2015-audi-a4-brake-pad-set-quattro-rear', NULL, NULL),
(5, 65, 8, 14, 9, 5, NULL, '2015 Acura ILX  Brake Pad and Rotor Kit', 7500, 'Duralo Premium Ceramic Brake Pads With Performance Shims and Drilled & Slotted Rotors Set', '71-92638 J2', 1, '71-92638 J2', 'Quattro', '2015-acura-ilx-brake-pad-and-rotor-kit.jpg', '2015-acura-ilx-brake-pad-and-rotor-kit-2.jpg', '2015-acura-ilx-brake-pad-and-rotor-kit-3.jpg', '2015-acura-ilx-brake-pad-and-rotor-kit-4.jpg', '2015-acura-ilx-brake-pad-and-rotor-kit-5.jpg', 20, 3, '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '2015-acura-ilx-brake-pad-and-rotor-kit', NULL, NULL);
INSERT INTO `autoparts` (`id`, `year_id`, `make_id`, `model_id`, `part_id`, `fitment_id`, `brand_id`, `name`, `price`, `type`, `part`, `visible`, `product_code`, `fits`, `pdt_img`, `pdt_img2`, `pdt_img3`, `pdt_img4`, `pdt_img5`, `discount`, `warranty`, `specifications`, `description`, `product_install_videos`, `reviews`, `questions`, `vehicle_fitment`, `slug`, `created_at`, `updated_at`) VALUES
(6, 65, 8, 15, 11, 6, 8, '2014 Audi A5  A/C Compressor', 1, 'New BUYAUTOPARTS Compressor w/ Clutch', '60-03802 NA', 1, '60-03802', 'Quattro', '2014-audi-a5-a-c-compressor.jpg', '2014-audi-a5-a-c-compressor-2.jpg', '2014-audi-a5-a-c-compressor-3.jpg', '2014-audi-a5-a-c-compressor-4.jpg', '2014-audi-a5-a-c-compressor-5.jpg', 22, 1, '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n', '2014-audi-a5-a-c-compressor', NULL, NULL),
(7, 65, 8, 15, 11, 7, 4, 'test', 200, '300', '234', NULL, '234', '123', 'test.jpg', 'test-2.jpg', 'test-3.jpg', '', '', 20, 2, '<p>test</p>\r\n', '<p>test</p>\r\n', '<p>test</p>\r\n', '<p>test</p>\r\n', '<p>test</p>\r\n', '<p>test</p>\r\n', 'test', NULL, NULL),
(8, 65, 8, 15, 12, 8, 1, 'PAds', 3, 'Product', 'Frontier', NULL, 'A002', 'well', 'pads.jpg', 'pads-2.jpg', 'pads-3.jpg', '', '', 1, 1, '<p><span style="color:#FF0000">Specifications -&nbsp;<span style="font-family:helvetica neue,helvetica,helvetica,arial,sans-serif; font-size:14px">We have received a request to reset the password for your account on SALS DELUXE LTD. Please click the link below to complete your password reset.</span></span></p>\r\n', '<p><span style="color:#0000FF">Description -&nbsp;<span style="font-family:helvetica neue,helvetica,helvetica,arial,sans-serif; font-size:14px">We have received a request to reset the password for your account on SALS DELUXE LTD. Please click the link below to complete your password reset.</span></span></p>\r\n', '', '', '', '', 'pads', NULL, NULL),
(9, 69, 92, 1443, 13, 10, 1, 'Brake Pads', 3, 'Product', 'Front', NULL, 'A002', 'All', 'brake-pads.jpg', 'brake-pads-2.jpg', 'brake-pads-3.jpg', '', '', 1, 2, '<p><span style="background-color:#FF0000">Specification</span></p>\r\n', '<p><span style="background-color:#0000CD">Description</span></p>\r\n', '', '', '', '', 'brake-pads', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'AEM'),
(2, 'aFe'),
(3, 'Airaid'),
(4, 'ARB'),
(5, 'ARNOTT'),
(6, 'BAK'),
(7, 'BedRug'),
(8, 'BILSTEIN'),
(9, 'Borgeson'),
(10, 'BORGWARNER'),
(11, 'BOSCH'),
(12, 'BULLY DOG'),
(13, 'DELPHI'),
(14, 'DENSO'),
(15, 'DIABLOSPORT'),
(16, 'DURALO'),
(17, 'EDGE'),
(18, 'EXEDY'),
(19, 'EXTANG'),
(20, 'FASS'),
(21, 'Firestone'),
(22, 'Flowmaster'),
(23, 'Garrett'),
(24, 'Holset'),
(25, 'Husky Liners'),
(26, 'Hypertech'),
(27, 'Injen'),
(28, 'K&N Engineering'),
(29, 'MagnaFlow'),
(30, 'Putco'),
(31, 'Rigid Industries'),
(32, 'S&B Filters'),
(33, 'Sachs'),
(34, 'SCT Tuners'),
(35, 'Stigan'),
(36, 'Superchips'),
(37, 'TruXedo'),
(38, 'USA Standard Gear'),
(39, 'Valeo'),
(40, 'Vision X'),
(41, 'Warn'),
(42, 'Yukon Gear and Axle');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `value`, `status`) VALUES
('1n114vf97qcp64gr0865bmbad3', 6, 'cart1', 'a:1:{i:6;O:20:"app\\models\\Autoparts":9:{s:36:"\0yii\\db\\BaseActiveRecord\0_attributes";a:30:{s:2:"id";i:6;s:7:"year_id";i:65;s:7:"make_id";i:8;s:8:"model_id";i:15;s:7:"part_id";i:11;s:10:"fitment_id";i:6;s:8:"brand_id";i:8;s:4:"name";s:28:"2014 Audi A5  A/C Compressor";s:5:"price";d:1;s:4:"type";s:37:"New BUYAUTOPARTS Compressor w/ Clutch";s:4:"part";s:11:"60-03802 NA";s:7:"visible";i:1;s:12:"product_code";s:8:"60-03802";s:4:"fits";N;s:7:"pdt_img";s:31:"2014-audi-a5-a-c-compressor.jpg";s:8:"pdt_img2";s:33:"2014-audi-a5-a-c-compressor-2.jpg";s:8:"pdt_img3";s:33:"2014-audi-a5-a-c-compressor-3.jpg";s:8:"pdt_img4";s:33:"2014-audi-a5-a-c-compressor-4.jpg";s:8:"pdt_img5";s:33:"2014-audi-a5-a-c-compressor-5.jpg";s:8:"discount";i:22;s:8:"warranty";i:1;s:14:"specifications";s:3704:"<table class="tab_innet_content_second" style="border-collapse:inherit; border-spacing:0px; border:0px; color:rgb(68, 68, 68); font-family:arial,verdana; font-size:12px; margin:0px; outline:0px; padding:0px; vertical-align:baseline">\r\n	<tbody>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Part Type</td>\r\n			<td style="vertical-align:top; width:560px">A/C Compressor</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Part Number</td>\r\n			<td style="vertical-align:top; width:560px">60-03802 NA</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Brand</td>\r\n			<td style="vertical-align:top; width:560px">BuyAutoParts</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Model Number</td>\r\n			<td style="vertical-align:top; width:560px">60-03802NA</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Condition</td>\r\n			<td style="vertical-align:top; width:560px">New BuyAutoParts Compressor w/ Clutch</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Warranty</td>\r\n			<td style="vertical-align:top; width:560px">\r\n			<div style="color: rgb(68, 68, 68); float: left;">FREE 1 Year Unlimited Mileage Warranty (Call for Extended Warranties)</div>\r\n			<strong><img src="https://www.buyautoparts.com/images/more.png" style="border:none; float:left; margin:10px 0px 0px 5px; outline:0px; padding:0px; vertical-align:baseline" /><em>More Information</em></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Weight</td>\r\n			<td style="vertical-align:top; width:560px">15 Pounds</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Box Dimensions</td>\r\n			<td style="vertical-align:top; width:560px">Height: 5.00&quot;<br />\r\n			Length: 5.00&quot;<br />\r\n			Width: 5.00&quot;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">OEM Cross Reference</td>\r\n			<td style="vertical-align:top; width:560px">\r\n			<div style="color: rgb(68, 68, 68); float: left; width: 600px;"><span style="color:rgb(69, 69, 69)">437100-8010</span><span style="color:rgb(69, 69, 69)">4371008010</span><span style="color:rgb(69, 69, 69)">43710080103D</span><span style="color:rgb(69, 69, 69)">447150-428</span><span style="color:rgb(69, 69, 69)">447150-4280</span></div>\r\n\r\n			<div style="color: rgb(68, 68, 68); float: left; width: 600px;"><span style="color:rgb(69, 69, 69)">447150-4283</span><span style="color:rgb(69, 69, 69)">447150-4286</span><span style="color:rgb(69, 69, 69)">447150428</span><span style="color:rgb(69, 69, 69)">4471504280</span><span style="color:rgb(69, 69, 69)">4471504283</span></div>\r\n\r\n			<div style="color: rgb(68, 68, 68); float: left; width: 600px;"><span style="color:rgb(69, 69, 69)">4471504286</span><span style="color:rgb(69, 69, 69)">8T0 260 805 E</span><span style="color:rgb(69, 69, 69)">8T0 260 805 N</span><span style="color:rgb(69, 69, 69)">8T0 260 805Q</span><span style="color:rgb(69, 69, 69)">8T0260805E</span></div>\r\n\r\n			<div style="color: rgb(68, 68, 68); float: left; width: 600px;"><span style="color:rgb(69, 69, 69)">8T0260805G</span><span style="color:rgb(69, 69, 69)">8T0260805N</span><span style="color:rgb(69, 69, 69)">8T0260805Q</span><span style="color:rgb(69, 69, 69)">60-03802NA</span></div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Anticipated Ship Time</td>\r\n			<td style="vertical-align:top; width:560px">Parts will ship within 1 business day if order is placed before 7:30 PM EST</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">UPC</td>\r\n			<td style="vertical-align:top; width:560px">704438735380</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n";s:11:"description";s:345:"<p>This 2014&nbsp;Audi&nbsp;A5&nbsp;A/C Compressor from BuyAutoParts.com is made with the highest quality and will ship within one business day. This is a New BuyAutoParts Compressor w/ Clutch and fits Quattro.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Orders over $99 qualify for free ground shipping.Buy Auto Parts</p>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<p>&nbsp;</p>\r\n";s:22:"product_install_videos";s:58:"<p>All the videos and photos connected with the item</p>\r\n";s:7:"reviews";s:23:"<p>Write a review</p>\r\n";s:9:"questions";s:866:"<div class="header3" style="color: rgb(68, 68, 68); float: left; margin: 0px; padding: 0px; font-family: &quot;Roboto condensed&quot;, sans-serif; font-size: 16px;"><strong>Do you have questions about this product?</strong>\r\n\r\n<p><em>Visit our&nbsp;<a href="https://www.buyautoparts.com/howto/how-to-buy-car-parts.htm" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; text-decoration-line: none; color: rgb(0, 173, 235);" target="_blank">Buyer&#39;s Guide</a>&nbsp;for more information. Or ask a question and get a response from our experts.</em></p>\r\n</div>\r\n\r\n<p>ASK A QUESTION<span style="color:rgb(69, 69, 69); font-family:roboto condensed,sans-serif; font-size:16px"><em>Average response time for Q&amp;A is less than 1 business day. For immediate response please call or chat with one of our specialists.</em></span></p>\r\n";s:15:"vehicle_fitment";s:5166:"<p><a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; text-decoration-line: none; font-family: &quot;Roboto condensed&quot;, sans-serif; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi A5</a><span style="color:rgb(69, 69, 69); font-family:roboto condensed,sans-serif; font-size:16px">&nbsp;Quattro</span><br />\r\n<a href="https://www.buyautoparts.com/partsdisplay/2012_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; text-decoration-line: none; font-family: &quot;Roboto condensed&quot;, sans-serif; color: rgb(0, 173, 235) !important;" target="_blank">2012 Audi A5</a><span style="color:rgb(69, 69, 69); font-family:roboto condensed,sans-serif; font-size:16px">&nbsp;Excl. Quattro</span><br />\r\n<a href="https://www.buyautoparts.com/partsdisplay/2013_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; text-decoration-line: none; font-family: &quot;Roboto condensed&quot;, sans-serif; color: rgb(0, 173, 235) !important;" target="_blank">2013 Audi A5</a><span style="color:rgb(69, 69, 69); font-family:roboto condensed,sans-serif; font-size:16px">&nbsp;Excl. Quattro</span><br />\r\n<a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; text-decoration-line: none; font-family: &quot;Roboto condensed&quot;, sans-serif; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi A5</a><span style="color:rgb(69, 69, 69); font-family:roboto condensed,sans-serif; font-size:16px">&nbsp;Excl. Quattro</span><br />\r\nClick here for a full list -</p>\r\n\r\n<ul style="list-style-type:none !important">\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2012_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2012 Audi A5</a>&nbsp;Quattro</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2013_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2013 Audi A5</a>&nbsp;Quattro</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2013_Audi/allroad.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2013 Audi allroad</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/allroad.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi allroad</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/Q5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi Q5</a>&nbsp;2.0L Engine - Non-Hybrid</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2013_Audi/S4.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2013 Audi S4</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/S4.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi S4</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2013_Audi/S5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2013 Audi S5</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/S5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi S5</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2015_Audi/S5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2015 Audi S5</a>&nbsp;All Models</li>\r\n</ul>\r\n";s:4:"slug";s:27:"2014-audi-a5-a-c-compressor";s:10:"created_at";N;s:10:"updated_at";N;}s:39:"\0yii\\db\\BaseActiveRecord\0_oldAttributes";a:30:{s:2:"id";i:6;s:7:"year_id";i:65;s:7:"make_id";i:8;s:8:"model_id";i:15;s:7:"part_id";i:11;s:10:"fitment_id";i:6;s:8:"brand_id";i:8;s:4:"name";s:28:"2014 Audi A5  A/C Compressor";s:5:"price";d:1;s:4:"type";s:37:"New BUYAUTOPARTS Compressor w/ Clutch";s:4:"part";s:11:"60-03802 NA";s:7:"visible";i:1;s:12:"product_code";s:8:"60-03802";s:4:"fits";N;s:7:"pdt_img";s:31:"2014-audi-a5-a-c-compressor.jpg";s:8:"pdt_img2";s:33:"2014-audi-a5-a-c-compressor-2.jpg";s:8:"pdt_img3";s:33:"2014-audi-a5-a-c-compressor-3.jpg";s:8:"pdt_img4";s:33:"2014-audi-a5-a-c-compressor-4.jpg";s:8:"pdt_img5";s:33:"2014-audi-a5-a-c-compressor-5.jpg";s:8:"discount";i:22;s:8:"warranty";i:1;s:14:"specifications";s:3704:"<table class="tab_innet_content_second" style="border-collapse:inherit; border-spacing:0px; border:0px; color:rgb(68, 68, 68); font-family:arial,verdana; font-size:12px; margin:0px; outline:0px; padding:0px; vertical-align:baseline">\r\n	<tbody>\r\n		<tr>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Part Type</td>\r\n			<td style="vertical-align:top; width:560px">A/C Compressor</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Part Number</td>\r\n			<td style="vertical-align:top; width:560px">60-03802 NA</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Brand</td>\r\n			<td style="vertical-align:top; width:560px">BuyAutoParts</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Model Number</td>\r\n			<td style="vertical-align:top; width:560px">60-03802NA</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Condition</td>\r\n			<td style="vertical-align:top; width:560px">New BuyAutoParts Compressor w/ Clutch</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Warranty</td>\r\n			<td style="vertical-align:top; width:560px">\r\n			<div style="color: rgb(68, 68, 68); float: left;">FREE 1 Year Unlimited Mileage Warranty (Call for Extended Warranties)</div>\r\n			<strong><img src="https://www.buyautoparts.com/images/more.png" style="border:none; float:left; margin:10px 0px 0px 5px; outline:0px; padding:0px; vertical-align:baseline" /><em>More Information</em></strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Weight</td>\r\n			<td style="vertical-align:top; width:560px">15 Pounds</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Box Dimensions</td>\r\n			<td style="vertical-align:top; width:560px">Height: 5.00&quot;<br />\r\n			Length: 5.00&quot;<br />\r\n			Width: 5.00&quot;</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">OEM Cross Reference</td>\r\n			<td style="vertical-align:top; width:560px">\r\n			<div style="color: rgb(68, 68, 68); float: left; width: 600px;"><span style="color:rgb(69, 69, 69)">437100-8010</span><span style="color:rgb(69, 69, 69)">4371008010</span><span style="color:rgb(69, 69, 69)">43710080103D</span><span style="color:rgb(69, 69, 69)">447150-428</span><span style="color:rgb(69, 69, 69)">447150-4280</span></div>\r\n\r\n			<div style="color: rgb(68, 68, 68); float: left; width: 600px;"><span style="color:rgb(69, 69, 69)">447150-4283</span><span style="color:rgb(69, 69, 69)">447150-4286</span><span style="color:rgb(69, 69, 69)">447150428</span><span style="color:rgb(69, 69, 69)">4471504280</span><span style="color:rgb(69, 69, 69)">4471504283</span></div>\r\n\r\n			<div style="color: rgb(68, 68, 68); float: left; width: 600px;"><span style="color:rgb(69, 69, 69)">4471504286</span><span style="color:rgb(69, 69, 69)">8T0 260 805 E</span><span style="color:rgb(69, 69, 69)">8T0 260 805 N</span><span style="color:rgb(69, 69, 69)">8T0 260 805Q</span><span style="color:rgb(69, 69, 69)">8T0260805E</span></div>\r\n\r\n			<div style="color: rgb(68, 68, 68); float: left; width: 600px;"><span style="color:rgb(69, 69, 69)">8T0260805G</span><span style="color:rgb(69, 69, 69)">8T0260805N</span><span style="color:rgb(69, 69, 69)">8T0260805Q</span><span style="color:rgb(69, 69, 69)">60-03802NA</span></div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">Anticipated Ship Time</td>\r\n			<td style="vertical-align:top; width:560px">Parts will ship within 1 business day if order is placed before 7:30 PM EST</td>\r\n		</tr>\r\n		<tr>\r\n			<td style="vertical-align:top; width:190px">UPC</td>\r\n			<td style="vertical-align:top; width:560px">704438735380</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n";s:11:"description";s:345:"<p>This 2014&nbsp;Audi&nbsp;A5&nbsp;A/C Compressor from BuyAutoParts.com is made with the highest quality and will ship within one business day. This is a New BuyAutoParts Compressor w/ Clutch and fits Quattro.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Orders over $99 qualify for free ground shipping.Buy Auto Parts</p>\r\n\r\n<div>&nbsp;</div>\r\n\r\n<p>&nbsp;</p>\r\n";s:22:"product_install_videos";s:58:"<p>All the videos and photos connected with the item</p>\r\n";s:7:"reviews";s:23:"<p>Write a review</p>\r\n";s:9:"questions";s:866:"<div class="header3" style="color: rgb(68, 68, 68); float: left; margin: 0px; padding: 0px; font-family: &quot;Roboto condensed&quot;, sans-serif; font-size: 16px;"><strong>Do you have questions about this product?</strong>\r\n\r\n<p><em>Visit our&nbsp;<a href="https://www.buyautoparts.com/howto/how-to-buy-car-parts.htm" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; vertical-align: baseline; text-decoration-line: none; color: rgb(0, 173, 235);" target="_blank">Buyer&#39;s Guide</a>&nbsp;for more information. Or ask a question and get a response from our experts.</em></p>\r\n</div>\r\n\r\n<p>ASK A QUESTION<span style="color:rgb(69, 69, 69); font-family:roboto condensed,sans-serif; font-size:16px"><em>Average response time for Q&amp;A is less than 1 business day. For immediate response please call or chat with one of our specialists.</em></span></p>\r\n";s:15:"vehicle_fitment";s:5166:"<p><a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; text-decoration-line: none; font-family: &quot;Roboto condensed&quot;, sans-serif; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi A5</a><span style="color:rgb(69, 69, 69); font-family:roboto condensed,sans-serif; font-size:16px">&nbsp;Quattro</span><br />\r\n<a href="https://www.buyautoparts.com/partsdisplay/2012_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; text-decoration-line: none; font-family: &quot;Roboto condensed&quot;, sans-serif; color: rgb(0, 173, 235) !important;" target="_blank">2012 Audi A5</a><span style="color:rgb(69, 69, 69); font-family:roboto condensed,sans-serif; font-size:16px">&nbsp;Excl. Quattro</span><br />\r\n<a href="https://www.buyautoparts.com/partsdisplay/2013_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; text-decoration-line: none; font-family: &quot;Roboto condensed&quot;, sans-serif; color: rgb(0, 173, 235) !important;" target="_blank">2013 Audi A5</a><span style="color:rgb(69, 69, 69); font-family:roboto condensed,sans-serif; font-size:16px">&nbsp;Excl. Quattro</span><br />\r\n<a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: 16px; vertical-align: baseline; text-decoration-line: none; font-family: &quot;Roboto condensed&quot;, sans-serif; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi A5</a><span style="color:rgb(69, 69, 69); font-family:roboto condensed,sans-serif; font-size:16px">&nbsp;Excl. Quattro</span><br />\r\nClick here for a full list -</p>\r\n\r\n<ul style="list-style-type:none !important">\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2012_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2012 Audi A5</a>&nbsp;Quattro</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2013_Audi/A5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2013 Audi A5</a>&nbsp;Quattro</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2013_Audi/allroad.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2013 Audi allroad</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/allroad.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi allroad</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/Q5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi Q5</a>&nbsp;2.0L Engine - Non-Hybrid</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2013_Audi/S4.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2013 Audi S4</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/S4.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi S4</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2013_Audi/S5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2013 Audi S5</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2014_Audi/S5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2014 Audi S5</a>&nbsp;All Models</li>\r\n	<li><a href="https://www.buyautoparts.com/partsdisplay/2015_Audi/S5.html" style="margin: 0px; padding: 0px; border: 0px; outline: 0px; font-size: inherit; vertical-align: baseline; text-decoration-line: none; font-weight: inherit; color: rgb(0, 173, 235) !important;" target="_blank">2015 Audi S5</a>&nbsp;All Models</li>\r\n</ul>\r\n";s:4:"slug";s:27:"2014-audi-a5-a-c-compressor";s:10:"created_at";N;s:10:"updated_at";N;}s:33:"\0yii\\db\\BaseActiveRecord\0_related";a:0:{}s:23:"\0yii\\base\\Model\0_errors";N;s:27:"\0yii\\base\\Model\0_validators";N;s:25:"\0yii\\base\\Model\0_scenario";s:7:"default";s:27:"\0yii\\base\\Component\0_events";a:0:{}s:30:"\0yii\\base\\Component\0_behaviors";a:0:{}s:12:"\0*\0_quantity";s:1:"3";}}', 0),
('mell665flg6tnot60stftie455', 4, 'cart1', 'a:0:{}', 0),
('monqkur8n8upeh7gcl4islgud5', 1, 'cart1', 'a:1:{i:1;O:20:"app\\models\\Autoparts":9:{s:36:"\0yii\\db\\BaseActiveRecord\0_attributes";a:30:{s:2:"id";i:1;s:7:"year_id";i:65;s:7:"make_id";i:8;s:8:"model_id";i:14;s:7:"part_id";i:10;s:10:"fitment_id";i:1;s:8:"brand_id";N;s:4:"name";s:35:"2015 Audi A4  Brake Pad Set - front";s:5:"price";d:4000;s:4:"type";s:58:"Duralo Premium Ceramic Brake Pads - With Performance Shims";s:4:"part";s:11:"70-00612 J5";s:7:"visible";i:1;s:12:"product_code";s:11:"70-00612 J5";s:4:"fits";s:19:"Non-quattro - front";s:7:"pdt_img";s:36:"2015-audi-a4-brake-pad-set-front.jpg";s:8:"pdt_img2";s:38:"2015-audi-a4-brake-pad-set-front-2.jpg";s:8:"pdt_img3";s:38:"2015-audi-a4-brake-pad-set-front-3.jpg";s:8:"pdt_img4";s:38:"2015-audi-a4-brake-pad-set-front-4.jpg";s:8:"pdt_img5";s:38:"2015-audi-a4-brake-pad-set-front-5.jpg";s:8:"discount";N;s:8:"warranty";N;s:14:"specifications";s:1295:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:11:"description";s:1295:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:22:"product_install_videos";s:1304:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:7:"reviews";s:1307:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:9:"questions";s:1295:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:15:"vehicle_fitment";s:1295:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:4:"slug";s:32:"2015-audi-a4-brake-pad-set-front";s:10:"created_at";N;s:10:"updated_at";N;}s:39:"\0yii\\db\\BaseActiveRecord\0_oldAttributes";a:30:{s:2:"id";i:1;s:7:"year_id";i:65;s:7:"make_id";i:8;s:8:"model_id";i:14;s:7:"part_id";i:10;s:10:"fitment_id";i:1;s:8:"brand_id";N;s:4:"name";s:35:"2015 Audi A4  Brake Pad Set - front";s:5:"price";d:4000;s:4:"type";s:58:"Duralo Premium Ceramic Brake Pads - With Performance Shims";s:4:"part";s:11:"70-00612 J5";s:7:"visible";i:1;s:12:"product_code";s:11:"70-00612 J5";s:4:"fits";s:19:"Non-quattro - front";s:7:"pdt_img";s:36:"2015-audi-a4-brake-pad-set-front.jpg";s:8:"pdt_img2";s:38:"2015-audi-a4-brake-pad-set-front-2.jpg";s:8:"pdt_img3";s:38:"2015-audi-a4-brake-pad-set-front-3.jpg";s:8:"pdt_img4";s:38:"2015-audi-a4-brake-pad-set-front-4.jpg";s:8:"pdt_img5";s:38:"2015-audi-a4-brake-pad-set-front-5.jpg";s:8:"discount";N;s:8:"warranty";N;s:14:"specifications";s:1295:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 0, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:11:"description";s:1295:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:22:"product_install_videos";s:1304:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(64, 224, 208)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:7:"reviews";s:1307:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(238, 130, 238)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:9:"questions";s:1295:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(255, 255, 0)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:15:"vehicle_fitment";s:1295:"<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">Shopping for Acura replacement parts? Looking to improve your Acura&rsquo;s performance? Browse our online Acura parts catalog to find Acura performance products to increase your vehicle&rsquo;s efficiency, or aftermarket Acura parts to get you up and running again.</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">At Advance Auto, we carry a great selection of new and used Acura components where you can buy manufacture-built OEM or aftermarket part. Advance Auto sells Acura auto parts online and in local stores all over the country.&nbsp;</span></span></span></p>\r\n\r\n<p><span style="font-size:14px"><span style="font-family:times new roman,times,serif"><span style="color:rgb(0, 0, 205)">We carry close to 13,335 Acura parts and accessories for the last 32 years and 16 different models of Acura cars - so you&#39;re sure to find what you need. Advance Auto is a price leader in new and used Acura online auto parts. Whether you want to order online, or visit a local store for Acura parts, Advance Auto can help you keep your Acura running.</span></span></span></p>\r\n";s:4:"slug";s:32:"2015-audi-a4-brake-pad-set-front";s:10:"created_at";N;s:10:"updated_at";N;}s:33:"\0yii\\db\\BaseActiveRecord\0_related";a:0:{}s:23:"\0yii\\base\\Model\0_errors";N;s:27:"\0yii\\base\\Model\0_validators";N;s:25:"\0yii\\base\\Model\0_scenario";s:7:"default";s:27:"\0yii\\base\\Component\0_events";a:0:{}s:30:"\0yii\\base\\Component\0_behaviors";a:0:{}s:12:"\0*\0_quantity";i:1;}}', 0),
('pok0k1idn9id9kudrh25a46282', 3, 'cart1', 'a:0:{}', 0),
('r349ctv61c69vp47s74i1ke00t', 8, 'cart1', 'a:0:{}', 0),
('sncketdt0jks92kroq2p0k7s67', 5, 'cart1', 'a:0:{}', 0),
('ue75pa5c5tmt4nvh7rl0kkbbt3', 2, 'cart1', 'a:0:{}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_payment`
--

CREATE TABLE `cart_payment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `item_price` double DEFAULT NULL,
  `item_quantity` int(11) DEFAULT NULL,
  `item_cost` double DEFAULT NULL,
  `cart_code` varchar(255) DEFAULT NULL,
  `cart_counter` int(11) DEFAULT '2000',
  `cart_cost` double DEFAULT NULL,
  `amount_paid` double DEFAULT NULL,
  `amount_sofar` double DEFAULT NULL,
  `method_of_payment` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `completed` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_payment`
--

INSERT INTO `cart_payment` (`id`, `user_id`, `item_id`, `item_name`, `item_price`, `item_quantity`, `item_cost`, `cart_code`, `cart_counter`, `cart_cost`, `amount_paid`, `amount_sofar`, `method_of_payment`, `status`, `active`, `completed`, `created_at`, `updated_at`) VALUES
(3, 1, 6, '2014 Audi A5  A/C Compressor', 1, 1, 1, 'WMU12768', 12768, 1, 1, 1, 'mpesa', NULL, 0, 1, NULL, NULL),
(4, 3, 6, '2014 Audi A5  A/C Compressor', 1, 1, 1, 'WMU12769', 12769, 1, 1, 1, 'mpesa', NULL, NULL, 1, NULL, NULL),
(5, 3, 6, '2014 Audi A5  A/C Compressor', 1, 2, 2, 'WMU12770', 12770, 2, 1, 2, 'mpesa', NULL, 0, 1, NULL, NULL),
(6, 4, 6, '2014 Audi A5  A/C Compressor', 1, 1, 1, 'WMU12771', 12771, 1, 1, 1, 'mpesa', NULL, NULL, 1, NULL, NULL),
(7, 3, 6, '2014 Audi A5  A/C Compressor', 1, 1, 1, 'WMU12772', 12772, 1, 1, 1, 'mpesa', NULL, NULL, 1, NULL, NULL),
(11, 4, 6, '2014 Audi A5  A/C Compressor', 1, 1, 1, 'WMU12774', 12774, 4, 4, 4, 'mpesa', NULL, NULL, 1, NULL, NULL),
(12, 4, 8, 'PAds', 3, 1, 3, 'WMU12774', 12774, 4, 4, 4, 'mpesa', NULL, NULL, 1, NULL, NULL),
(13, 1, 6, '2014 Audi A5  A/C Compressor', 1, 2, 2, 'WMU12775', 12775, 2, 2, 2, 'mpesa', NULL, NULL, 1, '2017-12-21 14:41:18', '2017-12-21 14:41:18'),
(14, 3, 6, '2014 Audi A5  A/C Compressor', 1, 1, 1, 'WMU12776', 12776, 1, 1, 1, 'mpesa', NULL, NULL, 1, '2017-12-21 14:44:20', '2017-12-21 14:44:20'),
(15, 1, 6, '2014 Audi A5  A/C Compressor', 1, 1, 1, 'WMU12777', 12777, 1, 1, 1, 'mpesa', NULL, NULL, 1, '2017-12-23 20:42:34', '2017-12-23 20:42:34'),
(16, 1, 6, '2014 Audi A5  A/C Compressor', 1, 1, 1, 'WMU12778', 12778, 1, 1, 1, 'mpesa', NULL, NULL, 1, '2017-12-23 20:46:31', '2017-12-23 20:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `cmodel`
--

CREATE TABLE `cmodel` (
  `id` int(11) NOT NULL,
  `model_year_id` int(11) DEFAULT NULL,
  `model_make_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cmodel`
--

INSERT INTO `cmodel` (`id`, `model_year_id`, `model_make_id`, `name`) VALUES
(1, 65, 6, 'ILX'),
(2, 65, 6, 'MDX'),
(3, 65, 6, 'RDX'),
(4, 65, 6, 'RLX'),
(5, 65, 6, 'TL'),
(6, 65, 6, 'TSX'),
(7, 66, 11, 'MDX'),
(8, 66, 11, 'RDX'),
(9, 66, 11, 'RLX'),
(10, 66, 11, 'TL'),
(11, 66, 11, 'NSX'),
(12, 65, 6, 'NSX'),
(13, 65, 8, 'A3'),
(14, 65, 8, 'A4'),
(15, 65, 8, 'A5'),
(16, 65, 8, 'A6'),
(17, 65, 26, 'Alliance'),
(18, 65, 26, 'Ambassador'),
(19, 65, 26, 'American'),
(20, 65, 26, 'AMX'),
(21, 65, 26, 'Classic'),
(22, 65, 26, 'Concorde'),
(23, 65, 26, 'Eagle'),
(24, 65, 26, 'Encore'),
(25, 65, 26, 'Gremlin'),
(26, 65, 26, 'Hornet'),
(27, 65, 26, 'Javelin'),
(28, 65, 26, 'Marlin'),
(29, 65, 26, 'Matador'),
(30, 65, 26, 'Pacer'),
(31, 65, 26, 'Rebel'),
(32, 65, 26, 'Rogue'),
(33, 65, 26, 'Spirit'),
(34, 65, 6, 'CL'),
(35, 65, 6, 'CSX'),
(36, 65, 6, 'EL'),
(37, 65, 6, 'Integra'),
(38, 65, 6, 'Legend'),
(39, 65, 6, 'RL'),
(40, 65, 6, 'RSX'),
(41, 65, 6, 'SLX'),
(42, 65, 6, 'Vigor'),
(43, 65, 6, 'ZDX'),
(44, 65, 27, '164'),
(45, 65, 27, 'Alfetta'),
(46, 65, 27, 'Berlina'),
(47, 65, 27, 'GT Veloce'),
(48, 65, 27, 'GTV'),
(49, 65, 27, 'GTV6'),
(50, 65, 27, 'Milano'),
(51, 65, 27, 'Spider'),
(52, 65, 7, 'DB7'),
(53, 65, 7, 'DB9'),
(54, 65, 7, 'V8'),
(55, 65, 7, 'Vanquish'),
(56, 65, 7, 'Virage'),
(57, 65, 8, '100'),
(58, 65, 8, '200'),
(59, 65, 8, '4000'),
(60, 65, 8, '5000'),
(61, 65, 8, '80'),
(62, 65, 8, '90'),
(63, 65, 8, 'A7 Quattro'),
(64, 65, 8, 'A8'),
(65, 65, 8, 'A8'),
(66, 65, 8, 'Allroad Quattro'),
(67, 65, 8, 'Cabriolet'),
(68, 65, 8, 'Coupe'),
(69, 65, 8, 'Fox'),
(70, 65, 8, 'Q5'),
(71, 65, 8, 'Q7'),
(72, 65, 8, 'Quattro'),
(73, 65, 8, 'R8'),
(74, 65, 8, 'RS4'),
(75, 65, 8, 'RS6'),
(76, 65, 8, 'S4'),
(77, 65, 8, 'S5'),
(78, 65, 8, 'S6'),
(79, 65, 8, 'S8'),
(80, 65, 8, 'TT'),
(81, 65, 8, 'V8 Quattro'),
(82, 65, 10, '1 Series M'),
(83, 65, 10, '120i '),
(84, 65, 10, '125i'),
(85, 65, 10, '128i '),
(86, 65, 10, '130i '),
(87, 65, 10, '135i '),
(88, 65, 10, '1500'),
(89, 65, 10, '1600 '),
(90, 65, 10, '1602'),
(91, 65, 10, '1800'),
(92, 65, 10, '1802'),
(93, 65, 10, '1802'),
(94, 65, 10, '2000'),
(95, 65, 10, '2002 '),
(96, 65, 10, '2800 '),
(97, 65, 10, '3.0CS'),
(98, 65, 10, '3.0CSi'),
(99, 65, 10, '3.0CSL '),
(100, 65, 10, '315 '),
(101, 65, 10, '316'),
(102, 65, 10, '318i'),
(103, 65, 10, '318is'),
(104, 65, 10, '318ti'),
(105, 65, 10, '320i'),
(106, 65, 10, '323'),
(107, 65, 10, '323Ci'),
(108, 65, 10, '323i'),
(109, 65, 10, '323is'),
(110, 65, 10, '325'),
(111, 65, 10, '325Ci'),
(112, 65, 10, '325e'),
(113, 65, 10, '325es'),
(114, 65, 10, '325i'),
(115, 65, 10, '325is'),
(116, 65, 10, '325iX'),
(117, 65, 10, '325xi'),
(118, 65, 10, '328'),
(119, 65, 10, '328Ci'),
(120, 65, 10, '328i'),
(121, 65, 10, '328i xDrive'),
(122, 65, 10, '328is'),
(123, 65, 10, '328xi '),
(124, 65, 10, '330'),
(125, 65, 10, '330Ci '),
(126, 65, 10, '330i '),
(127, 65, 10, '330xi '),
(128, 65, 10, '335'),
(129, 65, 10, '335d'),
(130, 65, 10, '335i '),
(131, 65, 10, '335i xDrive'),
(132, 65, 10, '335is'),
(133, 65, 10, '335xi'),
(134, 65, 10, '518'),
(135, 65, 10, '524'),
(136, 65, 10, '525'),
(137, 65, 10, '528'),
(138, 65, 10, '530'),
(139, 65, 10, '533'),
(140, 65, 10, '535'),
(141, 65, 10, '540'),
(142, 65, 10, '545'),
(143, 65, 10, '545'),
(144, 65, 10, '550'),
(145, 65, 10, '630'),
(146, 65, 10, '630csi'),
(147, 65, 10, '633csi'),
(148, 65, 10, '635csi '),
(149, 65, 10, '640i Gran Coupe'),
(150, 65, 10, '645Ci '),
(151, 65, 10, '650'),
(152, 65, 10, '725'),
(153, 65, 10, '728'),
(154, 65, 10, '730'),
(155, 65, 10, '733i'),
(156, 65, 10, '735'),
(157, 65, 10, '740'),
(158, 65, 10, '745'),
(159, 65, 10, '750'),
(160, 65, 10, '750iL'),
(161, 65, 10, '760'),
(162, 65, 10, '840'),
(163, 65, 10, '850'),
(164, 65, 10, 'Alpina B7'),
(165, 65, 10, 'Alpina B7L'),
(166, 65, 10, 'Bavaria'),
(167, 65, 10, 'L6'),
(168, 65, 10, 'L7'),
(169, 65, 10, 'M3'),
(170, 65, 10, 'M5'),
(171, 65, 10, 'M6'),
(172, 65, 10, 'X1'),
(173, 65, 10, 'X3'),
(174, 65, 10, 'X5'),
(175, 65, 10, 'X6'),
(176, 65, 10, 'Z3'),
(177, 65, 10, 'Z4'),
(178, 65, 10, 'Z8'),
(179, 65, 9, 'All Models '),
(180, 65, 9, 'Arnage'),
(181, 65, 9, 'Brookland'),
(182, 65, 9, 'Continental Flying Spur'),
(183, 65, 9, 'Continental GT '),
(184, 65, 9, 'Corniche'),
(185, 65, 9, 'Eight'),
(186, 65, 9, 'Mulsanne'),
(187, 65, 9, 'T-Series'),
(188, 65, 9, 'Turbo R'),
(189, 65, 28, 'Allure'),
(190, 65, 28, 'Apollo'),
(191, 65, 28, 'Century'),
(192, 65, 28, 'Commercial Chassis'),
(193, 65, 28, 'Electra'),
(194, 65, 28, 'Enclave'),
(195, 65, 28, 'Estate Wagon'),
(196, 65, 28, 'GS'),
(197, 65, 28, 'Invicta '),
(198, 65, 28, 'LaCrosse '),
(199, 65, 28, 'LeSabre'),
(200, 65, 28, 'Lucerne '),
(201, 65, 28, 'Park Avenue'),
(202, 65, 28, 'Rainier '),
(203, 65, 28, 'Reatta'),
(204, 65, 28, 'Regal'),
(205, 65, 28, 'Rendezvous '),
(206, 65, 28, 'Riviera'),
(207, 65, 28, 'Roadmaster '),
(208, 65, 28, 'Skyhawk '),
(209, 65, 28, 'Skylark '),
(210, 65, 28, 'Somerset'),
(211, 65, 28, 'Special'),
(212, 65, 28, 'Terraza'),
(213, 65, 28, 'Verano '),
(214, 65, 28, 'Wildcat'),
(215, 65, 29, '60 Special'),
(216, 65, 29, 'Allante'),
(217, 65, 29, 'Brougham '),
(218, 65, 29, 'Calais'),
(219, 65, 29, 'Catera '),
(220, 65, 29, 'Cimarron'),
(221, 65, 29, 'Commercial Chassis '),
(222, 65, 29, 'CTS'),
(223, 65, 29, 'Deville'),
(224, 65, 29, 'DTS'),
(225, 65, 29, 'Eldorado'),
(226, 65, 29, 'Escalade'),
(227, 65, 29, 'Fleetwood '),
(228, 65, 29, 'Seville'),
(229, 65, 29, 'SRX'),
(230, 65, 29, 'STS'),
(231, 65, 29, 'XLR '),
(232, 65, 29, 'XTS '),
(233, 65, 30, '3406 Engine'),
(234, 65, 30, 'All Models'),
(235, 65, 31, 'Astro Van'),
(236, 65, 31, 'Avalanche'),
(237, 65, 31, 'Aveo'),
(238, 65, 31, 'Bel Air'),
(239, 65, 31, 'Beretta'),
(240, 65, 31, 'Biscayne'),
(241, 65, 31, 'Blazer Full-Size'),
(242, 65, 31, 'Blazer S-10 '),
(243, 65, 31, 'C60 Truck'),
(244, 65, 31, 'Camaro'),
(245, 65, 31, 'Caprice'),
(246, 65, 31, 'Captiva Sport'),
(247, 65, 31, 'Cavalier'),
(248, 65, 31, 'Celebrity '),
(249, 65, 31, 'Chevelle'),
(250, 65, 31, 'Chevette'),
(251, 65, 31, 'Chevy II'),
(252, 65, 31, 'Citation'),
(253, 65, 31, 'Classic'),
(254, 65, 31, 'Cobalt'),
(255, 65, 31, 'Colorado'),
(256, 65, 31, 'Corsica'),
(257, 65, 31, 'Corvair'),
(258, 65, 31, 'Corvette'),
(259, 65, 31, 'Cruze'),
(260, 65, 31, 'Delray'),
(261, 65, 31, 'Dump Truck'),
(262, 65, 31, 'El Camino'),
(263, 65, 31, 'Equinox'),
(264, 65, 31, 'Express Van'),
(265, 65, 31, 'Fleetline'),
(266, 65, 31, 'Fleetmaster'),
(267, 65, 31, 'HHR '),
(268, 65, 31, 'Impala  '),
(269, 65, 31, 'Kingswood'),
(270, 65, 31, 'Kodiak'),
(271, 65, 31, 'Laguna '),
(272, 65, 31, 'LLV (Postal Vehicle) '),
(273, 65, 31, 'Lumina'),
(274, 65, 31, 'Lumina APV'),
(275, 65, 31, 'Lumina APV - Minivan '),
(276, 65, 31, 'Luv '),
(277, 65, 31, 'Malibu'),
(278, 65, 31, 'Metro'),
(279, 65, 31, 'Monte Carlo'),
(280, 65, 31, 'Monza'),
(281, 65, 31, 'Motorhome'),
(282, 65, 31, 'Nomad'),
(283, 65, 31, 'Nova '),
(284, 65, 31, 'One-Fifty'),
(285, 65, 31, 'P-Series Chassis'),
(286, 65, 31, 'Pick-up Truck'),
(287, 65, 31, 'Prizm '),
(288, 65, 31, 'S10 Truck '),
(289, 65, 31, 'Sedan '),
(290, 65, 31, 'Silverado '),
(291, 65, 31, 'Sonic '),
(292, 65, 31, 'Spectrum '),
(293, 65, 31, 'Sprint '),
(294, 65, 31, 'SSR'),
(295, 65, 31, 'Styleline'),
(296, 65, 31, 'Suburban '),
(297, 65, 31, 'T-Series Truck '),
(298, 65, 31, 'T5500 Truck'),
(299, 65, 31, 'T60 Truck '),
(300, 65, 31, 'T6000 Truck '),
(301, 65, 31, 'T70 Truck'),
(302, 65, 31, 'T7000 Truck'),
(303, 65, 31, 'T8000 Truck '),
(304, 65, 31, 'Tahoe '),
(305, 65, 31, 'Townsman'),
(306, 65, 31, 'Tracker '),
(307, 65, 31, 'Trailblazer '),
(308, 65, 31, 'Traverse '),
(309, 65, 31, 'Truck- Dump Truck Only '),
(310, 65, 31, 'Two-Ten '),
(311, 65, 31, 'Uplander '),
(312, 65, 31, 'Van '),
(313, 65, 31, 'Vega'),
(314, 65, 31, 'Vega Hot Rod Boxes'),
(315, 65, 31, 'Venture '),
(316, 65, 31, 'Volt'),
(317, 65, 31, 'W-Series Truck '),
(318, 65, 31, 'W3500'),
(319, 65, 31, 'W4 Truck'),
(320, 65, 31, 'W4500 Truck'),
(321, 65, 31, 'W5 Truck '),
(322, 65, 31, 'W5500 Truck'),
(323, 65, 31, 'W6 Truck'),
(324, 65, 31, 'W6500 Truck'),
(325, 65, 31, 'W7500 Truck '),
(326, 65, 31, 'W7H Truck'),
(327, 65, 31, 'W7M Truck'),
(328, 65, 33, '200'),
(329, 65, 33, '300'),
(330, 65, 33, '300M'),
(331, 65, 33, 'Aspen'),
(332, 65, 33, 'Cirrus'),
(333, 65, 33, 'Colt '),
(334, 65, 33, 'Concorde '),
(335, 65, 33, 'Conquest'),
(336, 65, 33, 'Cordoba'),
(337, 65, 33, 'Crossfire'),
(338, 65, 33, 'DeSoto'),
(339, 65, 33, 'E Class'),
(340, 65, 33, 'Fifth Avenue'),
(341, 65, 33, 'Grand Voyager'),
(342, 65, 33, 'Imperial'),
(343, 65, 33, 'Laser'),
(344, 65, 33, 'LeBaron'),
(345, 65, 33, 'LHS'),
(346, 65, 33, 'Neon '),
(347, 65, 33, 'New Yorker'),
(348, 65, 33, 'Newport '),
(349, 65, 33, 'Pacifica '),
(350, 65, 33, 'Prowler'),
(351, 65, 31, 'PT Cruiser'),
(352, 65, 33, 'Royal'),
(353, 65, 33, 'Saratoga '),
(354, 65, 33, 'Sebring'),
(355, 65, 33, 'TC by Maserati '),
(356, 65, 33, 'Town and Country '),
(357, 65, 33, 'Voyager'),
(358, 65, 33, 'Windsor'),
(359, 65, 34, 'Lanos'),
(360, 65, 34, 'Leganza'),
(361, 65, 34, 'Nubira'),
(362, 65, 35, '330'),
(363, 65, 35, '400'),
(364, 65, 35, '440'),
(365, 65, 35, '600'),
(366, 65, 35, '880'),
(367, 65, 35, 'A Series Van'),
(368, 65, 35, 'Aries'),
(369, 65, 35, 'Aspen'),
(370, 65, 35, 'Avenger '),
(371, 65, 35, 'Caliber'),
(372, 65, 35, 'Caravan'),
(373, 65, 35, 'Caravan CV'),
(374, 65, 35, 'Challenger'),
(375, 65, 35, 'Charger'),
(376, 65, 35, 'Colt '),
(377, 65, 35, 'Colt Vista'),
(378, 65, 35, 'Conquest'),
(379, 65, 35, 'Coronet'),
(380, 65, 35, 'Custom 880'),
(381, 65, 35, 'D50 Ram '),
(382, 65, 35, 'Dakota '),
(383, 65, 35, 'Dakota '),
(384, 65, 35, 'Dart'),
(385, 65, 35, 'Daytona '),
(386, 65, 35, 'Deluxe'),
(387, 65, 35, 'Diplomat'),
(388, 65, 35, 'Durango'),
(389, 65, 35, 'Dynasty'),
(390, 65, 35, 'Full Size Van'),
(391, 65, 35, 'Grand Caravan'),
(392, 65, 35, 'Intrepid'),
(393, 65, 35, 'Journey'),
(394, 65, 35, 'Lancer'),
(395, 65, 35, 'Laser'),
(396, 65, 35, 'Magnum'),
(397, 65, 35, 'Mini Motorhome'),
(398, 65, 35, 'Mini-Ram'),
(399, 65, 35, 'Mirada'),
(400, 65, 35, 'Monaco'),
(401, 65, 35, 'Motorhome'),
(402, 65, 35, 'Neon'),
(403, 65, 35, 'Nitro'),
(404, 65, 35, 'Omni '),
(405, 65, 35, 'Pick-up Truck '),
(406, 65, 35, 'Polara'),
(407, 65, 35, 'Power Wagon'),
(408, 65, 35, 'Raider'),
(409, 65, 35, 'Ram Trucks '),
(410, 65, 35, 'Ramcharger'),
(411, 65, 35, 'Rampage '),
(412, 65, 35, 'Royal Monaco'),
(413, 65, 35, 'Shadow '),
(414, 65, 35, 'Spirit'),
(415, 65, 35, 'Sprinter Van '),
(416, 65, 35, 'St Regis'),
(417, 65, 35, 'Stealth'),
(418, 65, 35, 'Stratus'),
(426, 65, 35, 'viper'),
(427, 65, 36, '2000 GTX'),
(428, 65, 36, 'Medallion'),
(429, 65, 36, 'Premier '),
(430, 65, 36, 'Summit'),
(431, 65, 36, 'Talon'),
(432, 65, 36, 'Vision'),
(433, 65, 37, '308'),
(434, 65, 37, '328'),
(435, 65, 37, '348'),
(436, 65, 37, '365'),
(437, 65, 37, '400'),
(438, 65, 37, '412'),
(439, 65, 37, '456'),
(440, 65, 37, '512'),
(441, 65, 37, '550'),
(442, 65, 37, 'Dino'),
(443, 65, 37, 'F355'),
(444, 65, 37, 'F40'),
(445, 65, 37, 'F50'),
(446, 65, 37, 'GT4'),
(447, 65, 37, 'Mondial'),
(448, 65, 37, 'Testarossa'),
(449, 65, 38, '124'),
(450, 65, 38, '124 Spider'),
(451, 65, 38, '128'),
(452, 65, 38, '131'),
(453, 65, 38, '2000 Spider'),
(454, 65, 38, '500'),
(455, 65, 38, 'Brava'),
(456, 65, 38, 'Construction Equipment'),
(457, 65, 38, 'X19'),
(458, 65, 39, 'Aerostar'),
(459, 65, 39, 'Aspire'),
(460, 65, 39, 'Bronco'),
(461, 65, 39, 'Club'),
(462, 65, 39, 'Club Wagon'),
(463, 65, 39, 'Consul '),
(464, 65, 39, 'Contour'),
(465, 65, 39, 'Cortina'),
(466, 65, 39, 'Country Sedan'),
(467, 65, 39, 'Country Squire '),
(468, 65, 39, 'Crestline '),
(469, 65, 39, 'Crown Victoria '),
(470, 65, 39, 'Custom'),
(471, 65, 39, 'Custom 300'),
(472, 65, 39, 'Custom 500 '),
(473, 65, 39, 'Customline '),
(474, 65, 39, 'Del Rio Wagon'),
(475, 65, 39, 'E Series Van'),
(476, 65, 39, 'Edge'),
(477, 65, 39, 'Elite '),
(478, 65, 39, 'Escape '),
(479, 65, 39, 'Escort '),
(480, 65, 39, 'Excursion'),
(481, 65, 39, 'EXP'),
(482, 65, 39, 'Expedition'),
(483, 65, 39, 'Explorer'),
(484, 65, 39, 'F Series Trucks'),
(485, 65, 39, 'F53 '),
(486, 65, 39, 'Fairlane'),
(487, 65, 39, 'Fairmont '),
(488, 65, 39, 'Falcon '),
(489, 65, 39, 'Falcon Ranchero'),
(490, 65, 39, 'Festiva'),
(491, 65, 39, 'Fiesta '),
(492, 65, 39, 'Five Hundred'),
(493, 65, 39, 'Flex'),
(494, 65, 39, 'Focus '),
(495, 65, 39, 'Ford 300'),
(496, 65, 39, 'Freestar'),
(497, 65, 39, 'Freestyle '),
(498, 65, 39, 'Fusion'),
(499, 65, 39, 'Galaxie'),
(500, 65, 39, 'Galaxie 500'),
(501, 65, 39, 'Gran Torino'),
(502, 65, 39, 'Granada '),
(503, 65, 39, 'GT'),
(504, 65, 39, 'Ka'),
(505, 65, 39, 'Ka'),
(506, 65, 39, 'LTD'),
(507, 65, 39, 'Mainline'),
(508, 65, 39, 'Maverick'),
(509, 65, 39, 'Mini Motorhome'),
(510, 65, 39, 'Mondeo'),
(511, 65, 39, 'Motorhome'),
(512, 65, 39, 'Mustang'),
(513, 65, 39, 'Mustang II '),
(514, 65, 39, 'P-350'),
(515, 65, 39, 'Park Lane Wagon '),
(516, 65, 39, 'Pick-up Truck '),
(517, 65, 39, 'Pinto'),
(518, 65, 39, 'Prefect '),
(519, 65, 39, 'Probe'),
(520, 65, 39, 'Ranch Wagon '),
(521, 65, 39, 'Ranchero'),
(522, 65, 39, 'Ranger'),
(523, 65, 39, 'Skyliner'),
(524, 65, 39, 'Sprint '),
(525, 65, 39, 'Squire '),
(526, 65, 39, 'Starliner '),
(527, 65, 39, 'Sunliner'),
(528, 65, 39, 'Taurus'),
(529, 65, 39, 'Tempo'),
(530, 65, 39, 'Thunderbird'),
(531, 65, 39, 'Torino'),
(532, 65, 39, 'Transit '),
(533, 65, 39, 'Windstar'),
(535, 65, 40, 'All Truck Models'),
(536, 65, 40, 'Sprinter Van'),
(537, 65, 41, 'Acadia '),
(538, 65, 41, 'Caballero'),
(539, 65, 41, 'Canyon'),
(540, 65, 41, 'Envoy '),
(541, 65, 41, 'Jimmy '),
(542, 65, 41, 'Jimmy Full Size'),
(543, 65, 41, 'Motorhome'),
(544, 65, 41, 'Pick-up Truck'),
(545, 65, 41, 'S15'),
(546, 65, 41, 'S15 Jimmy'),
(547, 65, 41, 'Safari '),
(548, 65, 41, 'Savana Van'),
(549, 65, 41, 'Sierra'),
(550, 65, 41, 'Sonoma'),
(551, 65, 41, 'Sprint '),
(552, 65, 41, 'Suburban'),
(553, 65, 41, 'Syclone'),
(554, 65, 41, 'T-Series Truck'),
(555, 65, 41, 'T5500 Truck'),
(556, 65, 41, 'T60 Truck'),
(557, 65, 41, 'T6000 Truck'),
(558, 65, 41, 'T70 Truck'),
(559, 65, 41, 'T7000 Truck'),
(560, 65, 41, 'T8000 Truck'),
(564, 65, 41, 'Terrain'),
(565, 65, 41, 'Topkick'),
(566, 65, 41, 'Typhoon'),
(567, 65, 41, 'Van'),
(568, 65, 41, 'W-Series Truck'),
(569, 65, 41, 'W3500'),
(570, 65, 41, 'W4 Truck '),
(571, 65, 41, 'W4500 Truck '),
(572, 65, 41, 'W5 Truck'),
(573, 65, 41, 'W5500 Truck'),
(574, 65, 41, 'W6 Truck'),
(575, 65, 41, 'W6500 Truck'),
(576, 65, 41, 'W7500 Truck'),
(577, 65, 41, 'W7H Truck'),
(578, 65, 41, 'W7M Truck'),
(579, 65, 41, 'Yukon'),
(580, 65, 42, 'Metro'),
(581, 65, 42, 'Prizm'),
(582, 65, 42, 'Spectrum'),
(583, 65, 42, 'Storm'),
(584, 65, 42, 'Tracker '),
(585, 65, 43, 'Accord'),
(586, 65, 42, 'Accord Crosstour '),
(587, 65, 43, 'Civic'),
(588, 65, 43, 'CR-Z'),
(589, 65, 43, 'CRV'),
(590, 65, 43, 'CRX'),
(591, 65, 43, 'Accord Crosstour'),
(592, 65, 43, 'Del Sol'),
(593, 65, 43, 'Element '),
(594, 65, 43, 'EV Plus'),
(595, 65, 43, 'Fit '),
(596, 65, 43, 'Insight '),
(597, 65, 43, 'Odyssey'),
(598, 65, 43, 'Passport'),
(599, 65, 43, 'Pilot'),
(600, 65, 43, 'Prelude'),
(601, 65, 43, 'Ridgeline'),
(602, 65, 43, 'S2000 '),
(603, 65, 44, 'H1'),
(604, 65, 44, 'H2'),
(605, 65, 44, 'H3'),
(606, 65, 44, 'H3T'),
(607, 65, 46, 'Accent '),
(608, 65, 46, 'Azera '),
(609, 65, 46, 'Elantra'),
(610, 65, 46, 'Entourage'),
(611, 65, 46, 'Equus '),
(612, 65, 46, 'Excel '),
(613, 65, 46, 'Genesis'),
(614, 65, 46, 'Genesis Coupe'),
(615, 65, 46, 'Santa Fe'),
(616, 65, 46, 'Scoupe'),
(617, 65, 46, 'Sonata'),
(618, 65, 46, 'Tiburon '),
(619, 65, 46, 'Tucson'),
(620, 65, 46, 'Veloster'),
(621, 65, 46, 'Veracruz'),
(622, 65, 46, 'XG300'),
(623, 65, 46, 'XG350'),
(624, 65, 47, 'EX35'),
(625, 65, 47, 'EX37'),
(626, 65, 47, 'FX35'),
(627, 65, 47, 'FX37'),
(628, 65, 47, 'FX45 '),
(629, 65, 47, 'FX50'),
(630, 65, 47, 'G20'),
(631, 65, 47, 'G25'),
(632, 65, 47, 'G35'),
(633, 65, 47, 'G37'),
(634, 65, 47, 'I30'),
(635, 65, 47, 'I35'),
(636, 65, 47, 'J30 '),
(637, 65, 47, 'JX35'),
(638, 65, 47, 'M30'),
(639, 65, 47, 'M35 '),
(640, 65, 47, 'M35h '),
(641, 65, 47, 'M37'),
(642, 65, 47, 'M45'),
(643, 65, 47, 'M56'),
(644, 65, 47, 'Q45'),
(645, 65, 47, 'Q50'),
(646, 65, 47, 'Q60'),
(647, 65, 47, 'Q70'),
(648, 65, 47, 'Q80'),
(649, 65, 47, 'QX4'),
(650, 65, 47, 'QX50'),
(651, 65, 47, 'QX56'),
(652, 65, 47, 'QX60'),
(653, 65, 48, 'All Models'),
(654, 65, 49, 'Amigo'),
(655, 65, 49, 'Ascender'),
(656, 65, 49, 'Axiom '),
(657, 65, 49, 'F-Series Truck'),
(658, 65, 49, 'FRR Truck'),
(659, 65, 49, 'FSR Truck'),
(660, 65, 49, 'FTR Truck'),
(661, 65, 49, 'FVR Truck'),
(662, 65, 49, 'FXR Truck'),
(663, 65, 49, 'Hombre'),
(664, 65, 49, 'I-Mark'),
(665, 65, 49, 'I-Series Truck'),
(666, 65, 49, 'Impulse'),
(667, 65, 49, 'N-Series Truck '),
(668, 65, 49, 'NPR Truck'),
(669, 65, 49, 'Oasis '),
(670, 65, 49, 'Pick-Up Truck'),
(671, 65, 49, 'Stylus '),
(672, 65, 49, 'Rodeo '),
(673, 65, 49, 'T-Series Truck'),
(674, 65, 49, 'T5500 Truck '),
(675, 65, 49, 'T60 Truck'),
(676, 65, 49, 'T70 Truck'),
(677, 65, 49, 'T6000 Truck '),
(678, 65, 49, 'T7000 Truck '),
(679, 65, 49, 'T8000 Truck'),
(680, 65, 49, 'Trooper'),
(681, 65, 49, 'Vehicross'),
(682, 65, 49, 'W-Series Truck'),
(683, 65, 49, 'W3500'),
(684, 65, 49, 'W5 Truck '),
(685, 65, 49, 'W5500 Truck'),
(686, 65, 49, 'W6500 Truck'),
(687, 65, 49, 'W7500 Truck '),
(688, 65, 49, 'W7H Truck '),
(689, 65, 49, 'W7M Truck '),
(702, 65, 50, 'Mark 1'),
(703, 65, 50, 'Mark 2'),
(704, 65, 50, 'Mark X'),
(705, 65, 50, 'S Type '),
(706, 65, 50, 'Sovereign'),
(707, 65, 50, 'Super V8'),
(708, 65, 50, 'Vanden Plas'),
(709, 65, 50, 'X Type '),
(710, 65, 50, 'XF'),
(711, 65, 50, 'XFR'),
(712, 65, 50, 'XJ '),
(713, 65, 50, 'XJ12'),
(714, 65, 50, 'XJ40'),
(715, 65, 50, 'XJ6'),
(716, 65, 50, 'XJ8'),
(717, 65, 50, 'XJR'),
(718, 65, 50, 'XJRS'),
(719, 65, 50, 'XJS'),
(720, 65, 50, 'XK'),
(721, 65, 50, 'XK8 '),
(722, 65, 50, 'XKE'),
(723, 65, 50, 'XKR '),
(724, 65, 50, 'XKR-S'),
(725, 65, 51, 'Cherokee'),
(726, 65, 51, 'CJ Models'),
(727, 65, 51, 'Comanche'),
(728, 65, 51, 'Commander'),
(729, 65, 51, 'Commando'),
(730, 65, 51, 'Compass'),
(731, 65, 51, 'Dispatcher '),
(732, 65, 51, 'Gladiator '),
(733, 65, 51, 'Grand Cherokee'),
(734, 65, 51, 'Grand Wagoneer '),
(735, 65, 51, 'J Series'),
(736, 65, 51, 'J10 Truck '),
(737, 65, 51, 'J20 Truck '),
(738, 65, 51, 'Jeepster'),
(739, 65, 51, 'Liberty'),
(740, 65, 51, 'Patriot '),
(741, 65, 51, 'Postal Jeep - Right Hand- etc '),
(742, 65, 51, 'Renegade'),
(743, 65, 51, 'Rubicon'),
(744, 65, 51, 'Scrambler '),
(745, 65, 51, 'Wagoneer'),
(746, 65, 51, 'Wrangle'),
(747, 65, 52, 'All Models'),
(748, 65, 53, 'Amanti'),
(749, 65, 53, 'Borrego'),
(750, 65, 53, 'Forte'),
(751, 65, 53, 'Forte'),
(752, 65, 53, 'Magentis '),
(753, 65, 53, 'Optima'),
(754, 65, 53, 'Rio'),
(755, 65, 53, 'Rio5 '),
(756, 65, 53, 'Rondo '),
(757, 65, 53, 'RX-V'),
(758, 65, 53, 'Sedona'),
(759, 65, 53, 'Sephia'),
(760, 65, 53, 'Sephia'),
(761, 65, 53, 'Sorento'),
(762, 65, 53, 'Soul '),
(763, 65, 53, 'Spectra '),
(764, 65, 53, 'Sportage'),
(765, 65, 54, 'All Models'),
(766, 65, 55, 'All Models'),
(767, 65, 56, 'Countach '),
(768, 65, 56, 'Diablo'),
(769, 65, 56, 'Espada'),
(770, 65, 56, 'Gallardo'),
(771, 65, 56, 'Islero'),
(772, 65, 56, 'Jalpa'),
(773, 65, 56, 'Miura'),
(774, 65, 56, 'Murcielago '),
(775, 65, 56, 'Urraco'),
(776, 65, 57, 'Defender'),
(777, 65, 57, 'Discovery'),
(778, 65, 57, 'Freelander '),
(779, 65, 57, 'LR2'),
(780, 65, 57, 'LR3 '),
(781, 65, 57, 'LR4'),
(782, 65, 57, 'Range Rover'),
(783, 65, 57, 'Range Rover Evoque'),
(784, 65, 58, 'Defender'),
(785, 65, 58, 'Discovery'),
(786, 65, 58, 'Freelander'),
(787, 65, 58, 'LR2 '),
(788, 65, 58, 'LR3'),
(789, 65, 58, 'LR4'),
(790, 65, 58, 'Range Rover '),
(791, 65, 58, 'Range Rover Evoque'),
(792, 65, 59, 'CT200h'),
(793, 65, 59, 'ES250'),
(794, 65, 59, 'ES300'),
(795, 65, 59, 'ES330'),
(796, 65, 59, 'ES350'),
(797, 65, 59, 'GS300'),
(798, 65, 59, 'GS350'),
(799, 65, 59, 'GS400'),
(800, 65, 59, 'GS430'),
(801, 65, 59, 'GS450h'),
(802, 65, 59, 'GS460'),
(803, 65, 59, 'GX460'),
(804, 65, 59, 'GX470'),
(805, 65, 59, 'HS250h '),
(806, 65, 59, 'IS F '),
(807, 65, 59, 'IS250'),
(808, 65, 59, 'IS300'),
(809, 65, 59, 'IS350'),
(810, 65, 59, 'LS400 '),
(811, 65, 59, 'LS430'),
(812, 65, 59, 'LS460'),
(813, 65, 59, 'LS600h'),
(814, 65, 59, 'LX450'),
(815, 65, 59, 'LX470 '),
(816, 65, 59, 'LX570'),
(817, 65, 59, 'RX300'),
(818, 65, 59, 'RX330 '),
(819, 65, 59, 'RX350 '),
(820, 65, 59, 'RX400h  '),
(821, 65, 59, 'RX450h'),
(822, 65, 59, 'SC300'),
(823, 65, 59, 'SC400 '),
(824, 65, 59, 'SC430'),
(825, 65, 60, 'Aviator '),
(826, 65, 60, 'Blackwood'),
(827, 65, 60, 'Continental '),
(828, 65, 60, 'LS'),
(829, 65, 60, 'Mark LT'),
(830, 65, 60, 'Mark Series '),
(831, 65, 60, 'MKS '),
(832, 65, 60, 'MKT'),
(833, 65, 60, 'MKX'),
(834, 65, 60, 'MKZ '),
(835, 65, 60, 'Navigator  '),
(836, 65, 60, 'Towncar '),
(837, 65, 60, 'Versailles'),
(838, 65, 60, 'Zephyr'),
(839, 65, 61, 'All Models'),
(840, 65, 62, 'Biturbo '),
(841, 65, 62, 'GranSport'),
(842, 65, 62, 'Quattro'),
(843, 65, 62, 'Quattroporte '),
(844, 65, 62, 'Spyder '),
(845, 65, 63, '2'),
(846, 65, 63, '3'),
(847, 65, 63, '5'),
(848, 65, 63, '323'),
(849, 65, 7, '6'),
(850, 65, 63, '626'),
(851, 65, 63, '929'),
(852, 65, 63, 'B-Series Truck'),
(853, 65, 64, 'Cosmo '),
(854, 65, 63, 'CX-5'),
(855, 65, 63, 'CX-7'),
(856, 65, 63, 'CX-9 '),
(857, 65, 63, 'GLC '),
(858, 65, 63, 'Miata'),
(859, 65, 63, 'Millenia '),
(860, 65, 63, 'MPV'),
(861, 65, 63, 'MX-5 Miata '),
(862, 65, 63, 'MX3'),
(863, 65, 63, 'MX6'),
(864, 65, 63, 'Navajo'),
(865, 65, 63, 'Pick-Up Truck'),
(866, 65, 63, 'Protege'),
(867, 65, 63, 'R100'),
(868, 65, 63, 'RX-2 '),
(869, 65, 63, 'RX-3'),
(870, 65, 63, 'RX4'),
(871, 65, 63, 'RX7'),
(872, 65, 63, 'RX8'),
(873, 65, 63, 'Tribute '),
(874, 65, 64, '190C'),
(875, 65, 64, '190D'),
(876, 65, 64, '190DC '),
(877, 65, 64, '190E '),
(878, 65, 64, '200'),
(879, 65, 64, '200D'),
(880, 65, 64, '220'),
(881, 65, 64, '220B'),
(882, 65, 64, '220D'),
(883, 65, 64, '220SB'),
(884, 65, 64, '220SEB'),
(885, 65, 64, '230'),
(886, 65, 64, '230-6'),
(887, 65, 64, '230S'),
(888, 65, 64, '230SL'),
(889, 65, 64, '240D'),
(890, 65, 64, '250'),
(891, 65, 64, '250C'),
(892, 65, 64, '250S'),
(893, 65, 64, '250SE'),
(894, 65, 64, '250SE convertible'),
(895, 65, 64, '250SEC'),
(896, 65, 64, '250SL'),
(897, 65, 64, '260E '),
(898, 65, 64, '260SE'),
(899, 65, 64, '280'),
(900, 65, 64, '280C'),
(901, 65, 64, '280CE'),
(902, 65, 64, '280E'),
(903, 65, 64, '280S'),
(904, 65, 64, '280SE'),
(905, 65, 64, '280SEC'),
(906, 65, 64, '280SEC 3.5'),
(907, 65, 64, '280SEC Convertible '),
(908, 65, 64, '280SEL'),
(909, 65, 64, '280SL'),
(910, 65, 64, '300CD'),
(911, 65, 64, '300CE'),
(912, 65, 64, '300D'),
(913, 65, 64, '300D Turbo'),
(914, 65, 64, '300E'),
(915, 65, 64, '300SD'),
(916, 65, 64, '300SDL'),
(917, 65, 64, '300SE'),
(918, 65, 64, '300SEL'),
(919, 65, 64, '300SL'),
(920, 65, 64, '300TDT'),
(921, 65, 64, '300TE'),
(922, 65, 64, '350SD'),
(923, 65, 64, '350SDL'),
(924, 65, 64, '380SE'),
(925, 65, 64, '380SEC'),
(926, 65, 64, '380SEL'),
(927, 65, 64, '380SL'),
(928, 65, 64, '380SLC'),
(929, 65, 64, '400E'),
(930, 65, 64, '400SE'),
(931, 65, 64, '400SEL'),
(932, 65, 64, '450SE'),
(933, 65, 64, '450SEL'),
(934, 65, 64, '450SL'),
(935, 65, 64, '450SLC'),
(936, 65, 64, '500E'),
(937, 65, 64, '500SEC'),
(938, 65, 64, '500SEL'),
(939, 65, 64, '500SL'),
(940, 65, 64, '560SEC'),
(941, 65, 64, '560SEL'),
(942, 65, 64, '560SL'),
(943, 65, 64, '600SEC'),
(944, 65, 64, '600SEL'),
(945, 65, 64, '600SL'),
(946, 65, 64, 'C220'),
(947, 65, 64, 'C230'),
(948, 65, 64, 'C240'),
(949, 65, 64, 'C250'),
(950, 65, 64, 'C280'),
(951, 65, 64, 'C300'),
(952, 65, 64, 'C32 AMG '),
(953, 65, 64, 'C320 '),
(954, 65, 64, 'C350'),
(955, 65, 64, 'C36 AMG'),
(956, 65, 64, 'C43 AMG'),
(957, 65, 64, 'C55 AMG'),
(958, 65, 64, 'C63 AMG'),
(959, 65, 64, 'CL500'),
(960, 65, 64, 'CL55'),
(961, 65, 64, 'CL550'),
(962, 65, 64, 'CL600'),
(963, 65, 64, 'CL63 AMG'),
(964, 65, 64, 'CL65 AMG'),
(965, 65, 64, 'CLA250'),
(966, 65, 64, 'CLK320'),
(967, 65, 64, 'CLK350'),
(968, 65, 64, 'CLK430 '),
(969, 65, 64, 'CLK500'),
(970, 65, 64, 'CLK55 AMG'),
(971, 65, 64, 'CLK550 '),
(972, 65, 64, 'CLK63 AMG'),
(973, 65, 64, 'CLS500'),
(974, 65, 64, 'CLS55 AMG'),
(975, 65, 64, 'CLS550 '),
(976, 65, 64, 'CLS63 AMG'),
(977, 65, 64, 'E280'),
(978, 65, 64, 'E300'),
(979, 65, 64, 'E300D'),
(980, 65, 64, 'E320'),
(981, 65, 64, 'E350'),
(982, 65, 64, 'E420 '),
(983, 65, 64, 'E430 '),
(984, 65, 64, 'E500'),
(985, 65, 64, 'E55 AMG'),
(986, 65, 64, 'E550'),
(987, 65, 64, 'E63 AMG'),
(988, 65, 64, 'G500'),
(989, 65, 64, 'G55 AMG '),
(990, 65, 64, 'G550'),
(991, 65, 64, 'G63 AMG'),
(992, 65, 64, 'G63 AMG'),
(993, 65, 64, 'GL320'),
(994, 65, 64, 'GL350'),
(995, 65, 64, 'GL450'),
(996, 65, 64, 'GL500'),
(997, 65, 64, 'GL550'),
(998, 65, 64, 'GLK250'),
(999, 65, 64, 'GLK350'),
(1000, 65, 64, 'ML320'),
(1001, 65, 64, 'ML350'),
(1002, 65, 64, 'ML430'),
(1003, 65, 64, 'ML450 '),
(1004, 65, 64, 'ML500 '),
(1005, 65, 64, 'ML55 AMG'),
(1006, 65, 64, 'ML550'),
(1007, 65, 64, 'ML63 AMG'),
(1008, 65, 64, 'R320'),
(1009, 65, 64, 'R350'),
(1010, 65, 64, 'R500'),
(1011, 65, 64, 'R63 AMG'),
(1012, 65, 64, 'S320'),
(1013, 65, 64, 'S350 '),
(1014, 65, 64, 'S400 '),
(1015, 65, 64, 'S420'),
(1016, 65, 64, 'S430'),
(1017, 65, 64, 'S450'),
(1018, 65, 64, 'S500 '),
(1019, 65, 64, 'S55 AMG'),
(1020, 65, 64, 'S550'),
(1021, 65, 64, 'S600'),
(1022, 65, 64, 'S63 AMG'),
(1023, 65, 64, 'S65 AMG'),
(1024, 65, 64, 'SL320'),
(1025, 65, 64, 'SL500 '),
(1026, 65, 64, 'SL55 AMG'),
(1027, 65, 64, 'SL550'),
(1028, 65, 64, 'SL600 '),
(1029, 65, 64, 'SL63 AMG '),
(1030, 65, 64, 'SL65 AMG '),
(1031, 65, 64, 'SLK230'),
(1032, 65, 64, 'SLK280'),
(1033, 65, 64, 'SLK300'),
(1034, 65, 64, 'SLK32 AMG'),
(1035, 65, 64, 'SLK320'),
(1036, 65, 64, 'SLK350'),
(1037, 65, 64, 'SLK55 AMG'),
(1038, 65, 64, 'SLR McLaren'),
(1039, 65, 64, 'SLS AMG'),
(1040, 65, 64, 'Sprinter Van'),
(1041, 65, 66, 'Bobcat'),
(1042, 65, 66, 'Capri'),
(1043, 65, 66, 'Colony Park'),
(1044, 65, 66, 'Comet'),
(1045, 65, 66, 'Cougar'),
(1046, 65, 66, 'Cyclone'),
(1047, 65, 66, 'Grand Marquis'),
(1048, 65, 66, 'Lynx'),
(1049, 65, 66, 'Marauder'),
(1050, 65, 66, 'Mariner'),
(1051, 65, 66, 'Marquis'),
(1052, 65, 66, 'Merkur Scorpio'),
(1053, 65, 66, 'Merkur XR4Ti'),
(1054, 65, 66, 'Milan'),
(1055, 65, 66, 'Monarch '),
(1056, 65, 66, 'Montclair'),
(1057, 65, 66, 'Montego'),
(1058, 65, 66, 'Monterey'),
(1059, 65, 66, 'Mountaineer'),
(1060, 65, 66, 'Mystique'),
(1061, 65, 66, 'Park Lane'),
(1062, 65, 66, 'Sable'),
(1063, 65, 66, 'Topaz'),
(1064, 65, 66, 'Tracer'),
(1065, 65, 66, 'Villager'),
(1066, 65, 66, 'Zephyr'),
(1067, 65, 67, 'Scorpio'),
(1068, 65, 67, 'XR4TI'),
(1069, 65, 68, 'Clubman'),
(1070, 65, 68, 'Cooper'),
(1071, 65, 68, 'Cooper Paceman'),
(1072, 65, 68, 'Countryman'),
(1073, 65, 69, '3000GT'),
(1074, 65, 69, 'Cordia '),
(1075, 65, 69, 'Diamante'),
(1076, 65, 69, 'Eclipse'),
(1077, 65, 69, 'Endeavor'),
(1078, 65, 69, 'Expo and Expo LRV'),
(1079, 65, 69, 'Fuso Bus And Fuso Truck '),
(1080, 65, 69, 'Galant'),
(1081, 65, 69, 'i-MiEV '),
(1082, 65, 69, 'Lancer '),
(1083, 65, 69, 'Mighty Max'),
(1084, 65, 69, 'Mirage'),
(1085, 65, 69, 'Montero '),
(1086, 65, 69, 'Outlander'),
(1087, 65, 69, 'Pick-up Truck '),
(1088, 65, 69, 'Precis'),
(1089, 65, 69, 'Raider '),
(1090, 65, 69, 'RVR '),
(1091, 65, 69, 'Sigma'),
(1092, 65, 69, 'Starion'),
(1093, 65, 69, 'Tredia '),
(1094, 65, 69, 'Vanwagon'),
(1095, 65, 70, 'All Models'),
(1096, 65, 71, '180SX'),
(1097, 65, 71, '200SX '),
(1098, 65, 71, '2300 Heavy Duty Truck '),
(1099, 65, 71, '240SX '),
(1100, 65, 71, '240Z'),
(1101, 65, 71, '260Z'),
(1102, 65, 71, '280Z'),
(1103, 65, 71, '280ZX'),
(1104, 65, 71, '300ZX'),
(1105, 65, 71, '310'),
(1106, 65, 71, '350Z'),
(1107, 65, 71, '370Z'),
(1108, 65, 71, '720'),
(1109, 65, 71, '810'),
(1110, 65, 71, 'Altima'),
(1111, 65, 71, 'Armada'),
(1112, 65, 71, 'Axxess'),
(1113, 65, 71, 'Axxess'),
(1114, 65, 71, 'Cube '),
(1115, 65, 71, 'Datsun 510'),
(1116, 65, 71, 'Datsun 610'),
(1117, 65, 71, 'Datsun 710'),
(1118, 65, 71, 'Frontier'),
(1119, 65, 71, 'GT-R '),
(1120, 65, 71, 'Juke '),
(1121, 65, 71, 'Leaf'),
(1122, 65, 71, 'Maxima'),
(1123, 65, 71, 'Murano '),
(1124, 65, 71, 'NV'),
(1125, 65, 71, 'NX Coupe'),
(1126, 65, 71, 'Pathfinder '),
(1127, 65, 71, 'Pick-Up Truck '),
(1128, 65, 71, 'Pulsar '),
(1129, 65, 71, 'Quest '),
(1130, 65, 71, 'Rogue'),
(1131, 65, 71, 'Sentra'),
(1132, 65, 71, 'Stanza '),
(1133, 65, 71, 'Titan'),
(1134, 65, 71, 'UD Commercial Truck'),
(1135, 65, 71, 'Van'),
(1136, 65, 71, 'Versa'),
(1137, 65, 71, 'X-Trail '),
(1138, 65, 71, 'Xterra '),
(1139, 65, 74, 'All Peterbilt Trucks'),
(1140, 65, 72, '442 '),
(1141, 65, 72, 'Achieva'),
(1142, 65, 72, 'Achieva'),
(1143, 65, 72, 'Alero'),
(1144, 65, 72, 'Aurora '),
(1145, 65, 72, 'Bravada'),
(1146, 65, 72, 'Calais'),
(1147, 65, 72, 'Ciera '),
(1148, 65, 72, 'Custom Cruiser'),
(1149, 65, 72, 'Custom Cruiser'),
(1150, 65, 72, 'Cutlass Calais'),
(1151, 65, 72, 'Cutlass Ciera'),
(1152, 65, 72, 'Cutlass Cruiser'),
(1153, 65, 72, 'Cutlass Salon'),
(1154, 65, 72, 'Cutlass Supreme '),
(1155, 65, 72, 'Delmont '),
(1156, 65, 72, 'Delta 88'),
(1157, 65, 72, 'Eighty Eight'),
(1158, 65, 72, 'F85 '),
(1159, 65, 72, 'Firenza'),
(1160, 65, 72, 'Intrigue'),
(1161, 65, 72, 'Jetfire '),
(1162, 65, 72, 'Jetstar'),
(1163, 65, 72, 'Jetstar'),
(1164, 65, 72, 'LSS'),
(1165, 65, 72, 'Ninety Eight '),
(1166, 65, 72, 'Omega'),
(1167, 65, 72, 'Regency'),
(1168, 65, 72, 'Silhouette '),
(1169, 65, 72, 'Starfire '),
(1170, 65, 72, 'Toronado '),
(1171, 65, 72, 'Trofeo'),
(1172, 65, 72, 'Vista '),
(1173, 65, 72, 'Vista Cruiser'),
(1174, 65, 75, '206'),
(1175, 65, 75, '405'),
(1176, 65, 75, '504'),
(1177, 65, 75, '505'),
(1178, 65, 75, '604'),
(1179, 65, 76, 'Acclaim '),
(1180, 65, 76, 'Barracuda'),
(1181, 65, 76, 'Belvedere'),
(1182, 65, 76, 'Breeze '),
(1183, 65, 76, 'Caravelle'),
(1184, 65, 76, 'Champ'),
(1185, 65, 76, 'Colt'),
(1186, 65, 76, 'Colt Vista'),
(1187, 65, 76, 'Conquest '),
(1188, 65, 76, 'Cricket '),
(1189, 65, 76, 'Duster'),
(1190, 65, 76, 'Fury '),
(1191, 65, 76, 'Grand Fury'),
(1192, 65, 76, 'Grand Voyager'),
(1193, 65, 76, 'GTX'),
(1194, 65, 76, 'Horizon'),
(1195, 65, 76, 'Laser'),
(1196, 65, 76, 'Neon'),
(1197, 65, 76, 'Plaza'),
(1198, 65, 76, 'Prowler'),
(1199, 65, 76, 'Reliant '),
(1200, 65, 76, 'Road Runner'),
(1201, 65, 76, 'Sapporo'),
(1202, 65, 76, 'Satellite '),
(1203, 65, 76, 'Savoy '),
(1204, 65, 76, 'Scamp'),
(1205, 65, 76, 'Signet'),
(1206, 65, 76, 'Suburban'),
(1207, 65, 76, 'Sundance'),
(1208, 65, 76, 'Superbird'),
(1209, 65, 76, 'TC3'),
(1210, 65, 76, 'Trailduster '),
(1211, 65, 76, 'Turismo'),
(1212, 65, 76, 'Valiant '),
(1213, 65, 76, 'VIP '),
(1214, 65, 76, 'Volare '),
(1215, 65, 76, 'Voyager'),
(1216, 65, 77, '2000'),
(1217, 65, 77, '6000'),
(1218, 65, 77, 'Acadian'),
(1219, 65, 77, 'Astre'),
(1220, 65, 77, 'Aztek'),
(1221, 65, 77, 'Bonneville '),
(1222, 65, 77, 'Catalina'),
(1223, 65, 77, 'Chieftan'),
(1224, 65, 77, 'Executive'),
(1225, 65, 77, 'Fiero'),
(1226, 65, 77, 'Firebird '),
(1227, 65, 77, 'Firebird Trans AM'),
(1228, 65, 77, 'G3'),
(1229, 65, 77, 'G5'),
(1230, 65, 77, 'G6'),
(1231, 65, 77, 'G8'),
(1232, 65, 77, 'Grand AM'),
(1233, 65, 77, 'Grand LeMans'),
(1234, 65, 77, 'Grand Prix'),
(1235, 65, 77, 'Grand Safari'),
(1236, 65, 77, 'Grandville'),
(1237, 65, 77, 'GTO '),
(1238, 65, 77, 'J2000'),
(1239, 65, 77, 'J2000 SUNBIRD'),
(1240, 65, 77, 'Laurentian'),
(1241, 65, 77, 'LeMans'),
(1242, 65, 77, 'Montana'),
(1243, 65, 77, 'Optima'),
(1244, 65, 77, 'Parisienne'),
(1245, 65, 77, 'Phoenix'),
(1246, 65, 77, 'Pursuit'),
(1247, 65, 77, 'Safari '),
(1248, 65, 77, 'Solstice'),
(1249, 65, 77, 'Starchief '),
(1250, 65, 77, 'Sunbird'),
(1251, 65, 77, 'Sunfire'),
(1252, 65, 77, 'T1000'),
(1253, 65, 77, 'Tempest '),
(1254, 65, 77, 'Torrent '),
(1255, 65, 77, 'Trans Sport'),
(1256, 65, 77, 'Ventura'),
(1257, 65, 77, 'Vibe '),
(1258, 65, 77, 'Wave'),
(1259, 65, 77, '356'),
(1260, 65, 77, '911'),
(1261, 65, 77, '912'),
(1262, 65, 77, '912E'),
(1263, 65, 77, '912E'),
(1264, 65, 77, '914'),
(1265, 65, 77, '924'),
(1266, 65, 77, '928'),
(1267, 65, 77, '944'),
(1268, 65, 77, '968'),
(1269, 65, 77, 'Boxster '),
(1270, 65, 77, 'Carrera GT'),
(1271, 65, 77, 'Cayenne'),
(1272, 65, 77, 'Cayman'),
(1273, 65, 77, 'Panamera'),
(1274, 65, 79, 'All Models'),
(1275, 65, 80, '9-2X'),
(1276, 65, 80, '9-3'),
(1277, 65, 80, '9-3X'),
(1278, 65, 80, '9-4X'),
(1279, 65, 80, '9-5'),
(1280, 65, 80, '9-7X'),
(1281, 65, 80, '900'),
(1282, 65, 80, '9000'),
(1283, 65, 80, '99'),
(1284, 65, 81, 'Astra '),
(1285, 65, 81, 'Aura'),
(1286, 65, 81, 'Ion'),
(1287, 65, 81, 'L-Series '),
(1288, 65, 81, 'Outlook'),
(1289, 65, 81, 'Relay'),
(1290, 65, 81, 'S Series'),
(1291, 65, 81, 'Sky '),
(1292, 65, 81, 'Vue'),
(1293, 65, 82, 'FR-S '),
(1294, 65, 82, 'iQ'),
(1295, 65, 82, 'tC'),
(1296, 65, 82, 'xA'),
(1297, 65, 82, 'xB'),
(1298, 65, 82, 'xD'),
(1299, 65, 83, 'ForTwo'),
(1300, 65, 84, '825'),
(1301, 65, 84, '827'),
(1302, 65, 84, 'Heavy Duty Truck'),
(1303, 65, 78, '356'),
(1304, 65, 78, '911'),
(1305, 65, 78, '912'),
(1306, 65, 78, '912E'),
(1307, 65, 78, '914'),
(1308, 65, 78, '924'),
(1309, 65, 78, '928'),
(1310, 65, 78, '944'),
(1311, 65, 78, '968'),
(1312, 65, 78, 'Boxster'),
(1313, 65, 78, 'Carrera GT'),
(1314, 65, 78, 'Cayenne'),
(1315, 65, 78, 'Cayman'),
(1316, 65, 78, 'Panamera'),
(1317, 65, 85, 'B9 Tribeca'),
(1318, 65, 85, 'Baja'),
(1319, 65, 85, 'Brat'),
(1320, 65, 85, 'BRZ '),
(1321, 65, 85, 'DL GF or GL'),
(1322, 65, 85, 'Forester'),
(1323, 65, 85, 'Impreza '),
(1324, 65, 85, 'Justy'),
(1325, 65, 85, 'Legacy '),
(1326, 65, 85, 'Leone'),
(1327, 65, 85, 'Loyale'),
(1328, 65, 85, 'Outback'),
(1329, 65, 85, 'SVX '),
(1330, 65, 85, 'Tribeca '),
(1331, 65, 85, 'WRX '),
(1332, 65, 85, 'XT'),
(1333, 65, 85, 'XT6'),
(1334, 65, 91, 'All Models'),
(1335, 65, 86, 'Aerio'),
(1336, 65, 86, 'Equator'),
(1337, 65, 86, 'Esteem'),
(1338, 65, 86, 'Forenza'),
(1339, 65, 86, 'Forsa'),
(1340, 65, 86, 'Grand Vitara '),
(1341, 65, 86, 'Kizashi '),
(1342, 65, 86, 'Reno'),
(1343, 65, 86, 'Samurai '),
(1344, 65, 86, '	Sidekick '),
(1345, 65, 86, 'Swift '),
(1346, 65, 86, 'Swift Plus'),
(1347, 65, 86, 'SX4'),
(1348, 65, 86, 'Verona '),
(1349, 65, 86, 'Vitara '),
(1350, 65, 86, 'X-90'),
(1351, 65, 86, 'XL-7 '),
(1352, 65, 87, '4 Runner'),
(1353, 65, 87, 'Avalon'),
(1354, 65, 87, 'Camry'),
(1355, 65, 87, 'Celica'),
(1356, 65, 87, 'Corolla '),
(1357, 65, 87, 'Corona '),
(1358, 65, 87, 'Cressida '),
(1359, 65, 87, 'Echo'),
(1360, 65, 87, 'FJ Cruiser '),
(1361, 65, 87, 'Highlander'),
(1362, 65, 87, 'Landcruiser'),
(1363, 65, 87, 'Matrix'),
(1364, 65, 87, 'MR2'),
(1365, 65, 87, 'MR2 Spyder'),
(1366, 65, 87, 'Paseo'),
(1367, 65, 87, 'Pick-Up Truck'),
(1368, 65, 87, 'Previa'),
(1369, 65, 87, 'Prius'),
(1370, 65, 87, 'RAV4'),
(1371, 65, 87, 'Sequoia'),
(1372, 65, 87, 'Sienna'),
(1373, 65, 87, 'Sienna'),
(1374, 65, 87, 'Starlet '),
(1375, 65, 87, 'Supra'),
(1376, 65, 87, 'T100'),
(1377, 65, 87, 'Tacoma'),
(1378, 65, 87, 'Tercel'),
(1379, 65, 87, 'Tundra'),
(1380, 65, 87, 'Van'),
(1381, 65, 87, 'Venza'),
(1382, 65, 87, 'Yaris '),
(1383, 65, 88, 'Beetle'),
(1384, 65, 88, 'Cabrio'),
(1385, 65, 88, 'Cabriolet'),
(1386, 65, 88, 'CC'),
(1387, 65, 88, 'Clasico'),
(1388, 65, 88, 'Corrado'),
(1389, 65, 88, 'Dasher'),
(1390, 65, 88, 'Eos'),
(1391, 65, 88, 'Eurovan '),
(1392, 65, 88, 'Fox'),
(1393, 65, 88, 'GLI '),
(1394, 65, 88, 'Golf '),
(1395, 65, 88, 'GTI'),
(1396, 65, 88, 'Jetta '),
(1397, 65, 88, 'Karmann Ghia'),
(1398, 65, 88, 'Passat '),
(1399, 65, 88, 'Phaeton'),
(1400, 65, 88, 'Polo'),
(1401, 65, 88, 'Quantum '),
(1402, 65, 88, 'Rabbit '),
(1403, 65, 88, 'Super Beetle '),
(1404, 65, 88, 'Thing'),
(1405, 65, 88, 'Tiguan'),
(1406, 65, 88, 'Touareg'),
(1407, 65, 88, 'Type 3 '),
(1408, 65, 88, 'Van or Bus -Type II '),
(1409, 65, 88, 'Vanagon '),
(1413, 65, 90, '122'),
(1414, 65, 90, '142'),
(1415, 65, 90, '144'),
(1416, 65, 90, '145'),
(1417, 65, 90, '240'),
(1418, 65, 90, '244'),
(1419, 65, 90, '245'),
(1420, 65, 90, '260'),
(1421, 65, 90, '264'),
(1422, 65, 90, '740'),
(1423, 65, 90, '760'),
(1424, 65, 90, '780'),
(1425, 65, 90, '850'),
(1426, 65, 90, '940'),
(1427, 65, 90, '960'),
(1428, 65, 90, 'C30'),
(1429, 65, 90, 'C70'),
(1430, 65, 90, 'S40'),
(1431, 65, 90, 'S60'),
(1432, 65, 90, 'S70'),
(1433, 65, 90, 'S80'),
(1434, 65, 90, 'S90'),
(1435, 65, 90, 'V40'),
(1436, 65, 90, 'V50'),
(1437, 65, 90, 'V70'),
(1438, 65, 90, 'V90'),
(1439, 65, 90, 'VN Series '),
(1440, 65, 90, 'XC60 '),
(1441, 65, 90, 'XC60 '),
(1442, 65, 90, 'XC90 '),
(1443, 69, 92, 'A5');

-- --------------------------------------------------------

--
-- Table structure for table `counties`
--

CREATE TABLE `counties` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `counties`
--

INSERT INTO `counties` (`id`, `name`) VALUES
(1, 'mombasa'),
(2, 'kwale'),
(3, 'kilifi'),
(4, 'Tana River'),
(5, 'Lamu'),
(6, 'Taita Taveta'),
(7, 'Garissa'),
(8, 'Wajir'),
(9, 'Mandera'),
(10, 'Marsabit'),
(11, 'Isiolo'),
(12, 'Meru'),
(13, 'Tharaka Nithi'),
(14, 'Embu'),
(15, 'Kitui'),
(16, 'Machakos'),
(17, 'Makueni'),
(18, 'Nyandarua'),
(19, 'Nyeri'),
(20, 'Kirinyaga'),
(21, 'Murang\'a'),
(22, 'Kiambu'),
(23, 'Turkana'),
(24, 'West Pokot'),
(25, 'Samburu'),
(26, 'Trans Nzoia'),
(27, 'Uasin Gishu'),
(28, 'Elgeyo/Marakwet'),
(29, 'Nandi'),
(30, 'Baringo'),
(31, 'Laikipia'),
(32, 'Nakuru'),
(33, 'Narok'),
(34, 'Kajiado'),
(35, 'Kericho'),
(36, 'Bomet'),
(37, 'Kakamega'),
(38, 'Vihiga'),
(39, 'Bungoma'),
(40, 'Busia'),
(41, 'Siaya'),
(42, 'Kisumu'),
(43, 'Homa Bay'),
(44, 'Migori'),
(45, 'Kisii'),
(46, 'Nyamira'),
(47, 'Nairobi');

-- --------------------------------------------------------

--
-- Table structure for table `fitment`
--

CREATE TABLE `fitment` (
  `id` int(11) NOT NULL,
  `fitment_year_id` int(11) DEFAULT NULL,
  `fitment_make_id` int(11) DEFAULT NULL,
  `fitment_model_id` int(11) DEFAULT NULL,
  `fitment_part_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fitment`
--

INSERT INTO `fitment` (`id`, `fitment_year_id`, `fitment_make_id`, `fitment_model_id`, `fitment_part_id`, `name`) VALUES
(1, 65, 8, 14, 10, 'Non-quattro - front'),
(2, 65, 8, 14, 10, 'Non-quattro - rear'),
(3, 65, 8, 14, 10, 'Quattro - front'),
(4, 65, 8, 14, 10, 'Quattro - rear'),
(5, 65, 8, 14, 9, 'Quattro'),
(6, 65, 8, 15, 11, 'Quattro'),
(7, 65, 8, 15, 11, 'Excl. Quattro'),
(8, 65, 8, 15, 12, 'Quattro'),
(9, 65, 8, 15, 12, 'Excl. Quattro'),
(10, 69, 92, 1443, 13, 'Front - wheel');

-- --------------------------------------------------------

--
-- Table structure for table `ipay`
--

CREATE TABLE `ipay` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `cart_id` varchar(34) DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `channel` varchar(100) DEFAULT NULL,
  `hsh` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `make`
--

CREATE TABLE `make` (
  `id` int(11) NOT NULL,
  `make_year_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `make`
--

INSERT INTO `make` (`id`, `make_year_id`, `name`) VALUES
(1, 1, 'Bentley'),
(2, 1, 'Cadillac'),
(3, 1, 'Case'),
(4, 1, 'Chevrolet'),
(5, 1, 'Chrysler'),
(6, 65, 'Acura'),
(7, 65, 'Aston Martin'),
(8, 65, 'Audi'),
(9, 65, 'Bentley'),
(10, 65, 'BMW'),
(11, 66, 'Acura'),
(12, 66, 'Alfa Romeo'),
(13, 66, 'Aston Martin'),
(14, 66, 'Audi'),
(15, 66, 'Bentley'),
(16, 67, 'Acura'),
(17, 67, 'Alfa Romeo'),
(18, 67, 'Aston Martin'),
(19, 67, 'Audi'),
(20, 67, 'Bentley'),
(21, 68, 'Acura'),
(22, 68, 'Alfa Romeo'),
(23, 68, 'Aston Martin'),
(24, 68, 'Audi'),
(25, 68, 'Bentley'),
(26, 65, 'AMC'),
(27, 65, 'Alfa Romeo '),
(28, 65, 'Buick'),
(29, 65, 'Cadillac'),
(30, 65, 'Caterpillar'),
(31, 65, 'Chevrolet'),
(32, 65, 'Chevy'),
(33, 65, 'Chrysler'),
(34, 65, 'Daewoo'),
(35, 65, 'Dodge'),
(36, 65, 'Eagle'),
(37, 65, 'Ferrari '),
(38, 65, 'Fiat '),
(39, 65, 'Ford'),
(40, 65, 'Freightliner '),
(41, 65, 'GMC'),
(42, 65, 'Geo'),
(43, 65, 'Honda'),
(44, 65, 'Hummer'),
(46, 65, 'Hyundai'),
(47, 65, 'Infiniti'),
(48, 65, 'International'),
(49, 65, 'Isuzu'),
(50, 65, 'Jaguar'),
(51, 65, 'Jeep'),
(52, 65, 'John Deere '),
(53, 65, 'Kia'),
(54, 65, 'Kenworth'),
(55, 65, 'Kubota'),
(56, 65, 'Lamborghini'),
(57, 65, 'Land Rover'),
(58, 65, 'Rover'),
(59, 65, 'Lexus'),
(60, 65, 'Lincoln'),
(61, 65, 'Mack'),
(62, 65, 'Maserati'),
(63, 65, 'Mazda'),
(64, 65, 'Mercedes Benz '),
(65, 65, 'Mercedes'),
(66, 65, 'Mercury'),
(67, 65, 'Merkur'),
(68, 65, 'Mini'),
(69, 65, 'Mitsubishi'),
(70, 65, 'New Holland'),
(71, 65, 'Nissan'),
(72, 65, 'Oldsmobile'),
(73, 65, 'Pantera'),
(74, 65, 'Peterbilt'),
(75, 65, 'Peugeot'),
(76, 65, 'Plymouth'),
(77, 65, 'Pontiac'),
(78, 65, 'Porsche'),
(79, 65, 'Rolls Royce'),
(80, 65, 'Saab'),
(81, 65, 'Saturn'),
(82, 65, 'Scion'),
(83, 65, 'Smart'),
(84, 65, 'Sterling'),
(85, 65, 'Subaru'),
(86, 65, 'Suzuki'),
(87, 65, 'Toyota'),
(88, 65, 'Volkswagen'),
(89, 65, 'VW'),
(90, 65, 'Volvo'),
(91, 65, 'Winnebago'),
(92, 69, 'BMW');

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1506682286),
('m140209_132017_init', 1506682289),
('m140403_174025_create_account_table', 1506682289),
('m140504_113157_update_tables', 1506682289),
('m140504_130429_create_token_table', 1506682289),
('m140506_102106_rbac_init', 1506684047),
('m140830_171933_fix_ip_field', 1506682290),
('m140830_172703_change_account_table_name', 1506682290),
('m141222_110026_update_ip_field', 1506682290),
('m141222_135246_alter_username_length', 1506682290),
('m150614_103145_update_social_account_table', 1506682290),
('m150623_212711_fix_username_notnull', 1506682290),
('m151218_234654_add_timezone_to_profile', 1506682290),
('m160117_225613_create_cart_table', 1509492033),
('m160929_103127_add_last_login_at_to_user_table', 1506682290);

-- --------------------------------------------------------

--
-- Table structure for table `mpesa`
--

CREATE TABLE `mpesa` (
  `id` int(11) NOT NULL,
  `transaction_reference` varchar(255) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `transaction_timestamp` varchar(255) DEFAULT NULL,
  `sender_phone` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `used_code` tinyint(1) DEFAULT NULL,
  `cart_code` varchar(255) DEFAULT NULL,
  `internal_transaction_id` int(11) DEFAULT NULL,
  `business_number` varchar(100) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mpesa`
--

INSERT INTO `mpesa` (`id`, `transaction_reference`, `customer_id`, `transaction_timestamp`, `sender_phone`, `first_name`, `last_name`, `amount`, `status`, `used_code`, `cart_code`, `internal_transaction_id`, `business_number`, `signature`, `timestamp`) VALUES
(1, 'LL25H9ARHP', 1, '2017-12-02T09:54:31Z', '+254712966136', 'ANTONY', 'GITAU', 1, NULL, 1, 'WMU12768', 15478605, '856049', 'FwOnZrWcWbVhhJNLhhvGZIczn5o=', '2017-12-02 09:54:33'),
(2, 'LL44INYUXG', 3, '2017-12-04T15:19:02Z', '+254712966136', 'ANTONY', 'GITAU', 1, NULL, 1, 'WMU12769', 15680145, '856049', 'v3hFDjIdXOOFrOyPPT+hbHMR8cU=', '2017-12-04 15:19:05'),
(3, 'LL47IRT4LD', 3, '2017-12-04T17:22:46Z', '+254712966136', 'ANTONY', 'GITAU', 1, NULL, 1, 'WMU12776', 15693123, '856049', 'Emp0ZbXS9WH4W2HxZ83a0z84cXs=', '2017-12-04 17:22:48'),
(4, 'LL48IO6OWO', 3, '2017-12-04T15:26:16Z', '+254712966136', 'ANTONY', 'GITAU', 1, NULL, 1, 'WMU12770', 15680823, '856049', 'HCUmfA3xdJ3nt9sGCKSGhmlYfWE=', '2017-12-04 15:26:18'),
(5, 'LL55J0R1TT', 4, '2017-12-05T08:16:50Z', '+254723350672', 'SAMUEL', 'NDIRITU', 1, NULL, 1, 'WMU12771', 15726204, '856049', '1lna0Aqwk79Jqc0DXoXE2Z75Sjw=', '2017-12-05 08:16:52'),
(6, 'LLJ6RXDTQI', 3, '2017-12-19T17:08:01Z', '+254712966136', 'ANTONY', 'GITAU', 1, NULL, 1, 'WMU12770', 16997555, '856049', 'NygOEx4WzCdrGlIdJ7Q3H6m6WHg=', '2017-12-19 17:11:27'),
(7, 'LLJ7RXYWAV', 3, '2017-12-19T17:28:34Z', '+254712966136', 'ANTONY', 'GITAU', 1, NULL, 1, 'WMU12772', 16999514, '856049', 'HkpVdpsVbYrISBeURpk1m977/KA=', '2017-12-19 17:28:36'),
(8, 'LLK9SEND0V', 4, '2017-12-20T14:43:07Z', '+254723350672', 'SAMUEL', 'NDIRITU', 4, NULL, 1, 'WMU12774', 17055536, '856049', 'Rs+YlDKTTcI3prunPv2WV31d61Y=', '2017-12-20 14:43:09'),
(9, 'LLL1T12LMB', 1, '2017-12-21T14:39:10Z', '+254712966136', 'ANTONY', 'GITAU', 2, NULL, 1, 'WMU12775', 17155843, '856049', 'I14za8uGwQ5CuYt1niFzwK8TUuo=', '2017-12-21 14:39:12'),
(10, 'LLN9UM1RWR', 1, '2017-12-23T20:42:06Z', '+254712966136', 'ANTONY', 'GITAU', 1, NULL, 1, 'WMU12777', 17394005, '856049', 'a2+Siw1YHWpaKznuLghXBiB/a0k=', '2017-12-23 20:42:08'),
(11, 'LLN9UM2GGN', 1, '2017-12-23T20:46:05Z', '+254712966136', 'ANTONY', 'GITAU', 1, NULL, 1, 'WMU12778', 17394284, '856049', 'KZJ/94+YJ8FZOaNliVN6dXde0xU=', '2017-12-23 20:46:06'),
(12, 'MAH39SS6L1', NULL, '2018-01-17T14:50:59Z', '+254718001247', 'Caroline', 'Mukeku', 465, NULL, NULL, NULL, 19368597, '856049', 'qLab8VJzVBL3SFHzsIz190lTtmU=', '2018-01-17 14:51:01');

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `id` int(11) NOT NULL,
  `part_year_id` int(11) DEFAULT NULL,
  `part_make_id` int(11) DEFAULT NULL,
  `part_model_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`id`, `part_year_id`, `part_make_id`, `part_model_id`, `name`) VALUES
(1, 66, 6, 2, 'A/C Accumulator/Drier'),
(2, 66, 6, 2, 'A/C Compressor'),
(3, 66, 6, 2, 'A/C Condenser'),
(4, 66, 6, 2, 'A/C Expansion device'),
(5, 65, 8, 13, 'Brake pad kit - front and rear'),
(6, 65, 8, 13, 'Brake pad set'),
(7, 65, 8, 13, 'Brake Rotor'),
(8, 65, 8, 13, 'Brake Rotor pad'),
(9, 65, 8, 14, 'Brake pad kit - front and rear'),
(10, 65, 8, 14, 'Brake pad set'),
(11, 65, 8, 15, 'A/C Compressor'),
(12, 65, 8, 15, 'A/C Condenser'),
(13, 69, 92, 1443, 'Brake');

-- --------------------------------------------------------

--
-- Table structure for table `pdt_qty`
--

CREATE TABLE `pdt_qty` (
  `id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `product_counter`
--

CREATE TABLE `product_counter` (
  `id` int(11) NOT NULL,
  `counter` int(11) DEFAULT '12765',
  `invoice_counter` int(11) DEFAULT '990011'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_counter`
--

INSERT INTO `product_counter` (`id`, `counter`, `invoice_counter`) VALUES
(1, 12778, 990011);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `order_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `name`, `email`, `phone`, `order_id`, `question`, `created_at`) VALUES
(1, 'Anthony Gitau', 'agitau12@gmail.com', '0712966136', 3, 'How good is the part?', '2018-01-24 16:13:09');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `value` double NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `subject` varchar(100) NOT NULL,
  `review` text NOT NULL,
  `publish_as` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`id`, `value`, `order_id`, `created_at`, `subject`, `review`, `publish_as`) VALUES
(5, 4, 4, '2018-01-24 13:59:16', 'best service', 'the item fits with my car', 'salsa'),
(6, 2, 2, '2018-01-24 14:01:24', 'make improvement', 'i did not enjoy that much', 'gitau'),
(7, 3, 2, '2018-01-24 14:04:00', 'it was just ok', 'the service was just good', 'gits'),
(8, 5, 4, '2018-01-24 14:11:00', 'twas cool', 'keep it up guys', 'tony'),
(9, 1, 4, '2018-01-24 14:29:31', 'hello', 'good', 'hello2'),
(10, 3, 1, '2018-01-24 14:52:02', 'hey', 'hey', 'hey'),
(11, 5, 1, '2018-01-24 14:52:50', 'haiya', 'haiya', 'haiya'),
(12, 2, 1, '2018-01-24 14:53:08', 'sue', 'sue', 'sue'),
(13, 4, 1, '2018-01-24 15:16:39', 'due', 'due', 'due'),
(14, 1, 1, '2018-01-24 15:17:00', 'hi', 'hi', 'hi'),
(15, 1, 1, '2018-01-24 15:17:19', 'hi', 'hi', 'hi'),
(16, 1, 1, '2018-01-24 15:17:47', 'hello', 'hello', 'hello2'),
(17, 5, 5, '2018-01-24 16:34:12', 'cars', 'nice', 'cars'),
(18, 1, 5, '2018-01-24 16:35:04', 'car', 'cars', 'cars'),
(19, 1, 5, '2018-01-24 16:35:07', 'hel', 'hel', 'hel'),
(20, 4, 3, '2018-01-24 16:38:22', 'good', 'good', 'good'),
(21, 5, 8, '2018-01-28 21:27:26', 'good', 'it served me well', 'gitau');

-- --------------------------------------------------------

--
-- Table structure for table `social_account`
--

CREATE TABLE `social_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `email`) VALUES
(8, 'agitau12@gmail.com'),
(7, 'gitau.ag@gmail.com'),
(11, 'hawai@gmail.com'),
(6, 'manager@gmail.com'),
(9, 'my@gmail.com'),
(10, 'pauline@gmail.com'),
(12, 'waceke@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sub_counties`
--

CREATE TABLE `sub_counties` (
  `id` int(11) NOT NULL,
  `county_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_counties`
--

INSERT INTO `sub_counties` (`id`, `county_id`, `name`) VALUES
(1, 47, 'kitisuru'),
(2, 47, ' Parklands/Highridge'),
(3, 47, 'kangemi'),
(4, 47, 'karura'),
(5, 47, 'Mountain View'),
(6, 47, 'Kilimani'),
(7, 47, 'Kawangware'),
(8, 47, 'Gatina'),
(9, 47, 'Kileleshwa'),
(10, 47, 'Kabiro'),
(11, 47, 'Mutu-ini/karen'),
(12, 47, 'Ng\'ando'),
(13, 47, 'Riruta Nyayo Highrise'),
(14, 47, 'Uthiru/Ruthimitu'),
(15, 47, 'Waithaka'),
(16, 47, 'Karen'),
(17, 47, ' Nairobi West '),
(18, 47, 'Nyayo Highrise'),
(19, 47, ' South C'),
(20, 47, 'Laini Saba'),
(21, 47, ' Lindi · Makina'),
(22, 47, ' Woodley-Kenyatta Golf Course'),
(23, 47, ' Sarang\'ombe'),
(24, 47, 'Githurai'),
(25, 47, ' Kahawa West'),
(26, 47, 'Zimmermann'),
(27, 47, 'Roysambu'),
(28, 47, 'Kahawa\r\n'),
(29, 47, 'Clay City'),
(30, 47, 'Mwiki'),
(31, 47, ' Kasarani'),
(32, 47, ' Njiru Shopping Centre'),
(33, 47, 'Ruai'),
(34, 47, 'Babadogo'),
(35, 47, ' Utalii '),
(36, 47, ' Mathare North'),
(37, 47, ' Lucky Summer'),
(38, 47, 'Korogocho'),
(39, 47, 'Imara Daima'),
(40, 47, 'Kwa Njenga'),
(41, 47, 'Kwa Reuben'),
(42, 47, ' Pipeline'),
(43, 47, 'Kware '),
(44, 47, 'Kariobangi North'),
(45, 47, ' Dandora Area I'),
(46, 47, ' Dandora Area II'),
(47, 47, ' Dandora Area III'),
(48, 47, ' Dandora Area IV'),
(49, 47, 'Kayole North'),
(50, 47, ' Kayole NorthCentral'),
(51, 47, 'Kayole South'),
(52, 47, 'Komarock'),
(53, 47, ' Chokaa'),
(54, 47, ' Matopeni/ Spring Valley'),
(55, 47, 'Upper Savanna'),
(56, 47, 'Lower Savanna'),
(57, 47, ' Embakasi'),
(58, 47, 'Utawala'),
(59, 47, 'Mihang\'o'),
(60, 47, 'Umoja I'),
(61, 47, 'Umoja II'),
(62, 47, 'Mowlem'),
(63, 47, 'Kariobangi South'),
(64, 47, 'Maringo/ Hamza'),
(65, 47, 'Viwandani'),
(66, 47, 'Harambee'),
(67, 47, 'Makongeni '),
(68, 47, 'Pumwani'),
(69, 47, 'Eastleigh North'),
(70, 47, 'Eastleigh South'),
(71, 47, 'Airbase'),
(72, 47, 'California'),
(73, 47, 'Nairobi Central'),
(74, 47, ' Ngara'),
(75, 47, ' Pangani'),
(76, 47, 'Ziwani/ Kariokor'),
(77, 47, 'Landimawe'),
(78, 47, 'Nairobi South'),
(79, 47, 'Hospital'),
(80, 47, 'Mabatini'),
(81, 47, 'Huruma'),
(82, 47, ' Ngei'),
(83, 47, ' Mlango Kubwa'),
(84, 47, 'Kiamaiko'),
(85, 32, 'Mariashoni'),
(86, 32, 'Elburgon'),
(87, 32, 'Turi'),
(88, 32, 'Molo'),
(89, 32, 'Mau Narok'),
(90, 32, 'Mauche'),
(91, 32, 'Kihingo'),
(92, 32, 'Nessuit'),
(93, 32, 'Lare'),
(94, 32, 'Njoro'),
(95, 32, 'Biashara'),
(96, 32, 'Hells Gate'),
(97, 32, 'Lake View'),
(98, 32, 'Maiella'),
(99, 32, 'Mai Mahiu'),
(100, 32, 'Olkaria'),
(101, 32, 'Naivasha East'),
(102, 32, 'Viwandani'),
(103, 32, 'Gilgil'),
(104, 32, 'Elementaita'),
(105, 32, 'Mbaruk/Eburu'),
(106, 32, 'Malewa West'),
(107, 32, 'Murindati'),
(108, 32, 'Amalo'),
(109, 32, 'Keringet'),
(110, 32, 'Kiptagich'),
(111, 32, 'Tinet'),
(112, 32, 'Kiptororo'),
(113, 32, ' Nyota'),
(114, 32, 'Sirikwa'),
(115, 32, 'Kamara'),
(116, 32, 'Subukia'),
(117, 32, 'Waseges'),
(118, 32, 'Kabazi'),
(119, 32, 'Menengai West'),
(120, 32, 'Soin'),
(121, 32, 'Visoi'),
(122, 32, 'Mosop'),
(123, 32, ' Solai'),
(124, 32, 'Dundori'),
(125, 32, 'Kabatini'),
(126, 32, 'Kiamaina'),
(127, 32, 'Lanet/Umoja'),
(128, 32, 'Bahati'),
(129, 32, 'Barut'),
(130, 32, 'London'),
(131, 32, 'Kaptembwo'),
(132, 32, 'Kapkures'),
(133, 32, 'Rhoda'),
(134, 32, 'Shaabab'),
(135, 32, 'Biashara'),
(136, 32, 'Kivumbini'),
(137, 32, 'Flamingo'),
(138, 32, 'Menengai'),
(139, 32, 'Nakuru East');

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
(1, 'njQBSh8iodRZoRCWl-WIIcuwm1BkrWWH', 1513671860, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `firstName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` enum('1','2') COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `firstName`, `lastName`, `gender`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) VALUES
(1, 'gits', 'Anthony', 'Gitau', '1', 'gitau.ag@gmail.com', '$2y$12$jBn25UHNrSRIpUT33IBksOQzrxmYFQ.442DKpO74evxRZqR3DbruO', 'rQeCpxiJgUhDCEsJgnXvl6Ibk9D_QTAr', 1506682944, NULL, NULL, '197.237.27.19', 1506682567, 1506682567, 0, 1516710013),
(2, 'client', 'Sals', 'Client', '1', 'agitau12@gmail.com', '$2y$12$MSKz273RrWqUhuQxLD5b8eeq6gLLlK8FseBxAEcdJxecSi4xymqAG', 'LB9lw6J2ITBb6M_Lfd9k_GU47JdcHMkG', 1506686730, NULL, NULL, '197.237.27.19', 1506686606, 1506686606, 0, 1513707921),
(3, 'manager', 'Sals', 'Manager', '2', 'wamultd@gmail.com', '$2y$12$ppZzBvkBFD5.Txw8vGr6AuP6Ay9bPsf.oBhqoDW/qDJOMSkcHZlxC', 'le9VQD9eXb-9s7U4VTcxfWQND_E079rT', 1512400493, NULL, NULL, '197.237.27.19', 1512400439, 1512400439, 0, 1513893064),
(4, 'nderitus@ymail.com', 'Sam', 'Nderitu', '1', 'nderitus@ymail.com', '$2y$12$vnSRrp/BNKpTreHVolHXfeIfFFeDpA5gd.LAQGkZA34rNl501aLvO', 'bPZ3NhFvCWAB1OxqhJTpG1kAIf3bG9hL', 1512461576, NULL, NULL, '105.56.120.144', 1512461476, 1515385537, 0, 1515691244),
(5, 'alfi', 'Alfred', 'Kariuki', '1', 'wacekeli@outlook.com', '$2y$12$GatuHfnSjw4eFvIKTV9dWeMGKFxqe3eV2BDU4u2taGf8IqlJWLdD6', 'asscQE_arTufXGZk-tQkNjTAD8gun_00', 1512989557, NULL, NULL, '197.237.27.19', 1512989458, 1512989458, 0, NULL),
(6, 'mrgitau', 'George', 'Ndungu', '1', 'gitau.ag@outlook.com', '$2y$12$vflELQhO3sZqA3hqeLBew.BoDzehY.k6YPAKPztccF0z6pogTQZ5G', 'evLnB0XxbQiRCQhnWkSiOO9ggKtbNdLA', 1512989949, NULL, NULL, '197.237.27.19', 1512989816, 1512989816, 0, NULL),
(8, 'sammsk7@gmail.com', 'Samuel', 'Musyoki', '1', 'sammsk7@gmail.com', '$2y$12$K2itADQ6GvxWSaNbLoND/eE66IwBP9jUIgQjA5.tbPDowI8bB23Na', 'DfZVW06duxofrfjSIkAoJ-2RaVJ7AfPo', 1515582847, NULL, NULL, '154.123.115.201', 1515582814, 1515582814, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`id`, `name`) VALUES
(1, '1950'),
(2, '1951'),
(3, '1952'),
(4, '1953'),
(5, '1954'),
(6, '1955'),
(7, '1956'),
(8, '1957'),
(9, '1958'),
(10, '1959'),
(11, '1960'),
(12, '1961'),
(13, '1962'),
(14, '1963'),
(15, '1964'),
(16, '1965'),
(17, '1966'),
(18, '1967'),
(19, '1968'),
(20, '1969'),
(21, '1970'),
(22, '1971'),
(23, '1972'),
(24, '1973'),
(25, '1974'),
(26, '1975'),
(27, '1976'),
(28, '1977'),
(29, '1978'),
(30, '1979'),
(31, '1980'),
(32, '1981'),
(33, '1982'),
(34, '1983'),
(35, '1984'),
(36, '1985'),
(37, '1986'),
(38, '1987'),
(39, '1988'),
(40, '1989'),
(41, '1990'),
(42, '1991'),
(43, '1992'),
(44, '1993'),
(45, '1994'),
(46, '1995'),
(47, '1996'),
(48, '1997'),
(49, '1998'),
(50, '1999'),
(51, '2000'),
(52, '2001'),
(53, '2002'),
(54, '2003'),
(55, '2004'),
(56, '2005'),
(57, '2006'),
(58, '2007'),
(59, '2008'),
(60, '2009'),
(61, '2010'),
(62, '2011'),
(63, '2012'),
(64, '2013'),
(65, '2014'),
(66, '2015'),
(67, '2016'),
(68, '2017'),
(69, '2018');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `county_2` (`county`),
  ADD KEY `sub_county` (`sub_county`);

--
-- Indexes for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indexes for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indexes for table `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `autoparts`
--
ALTER TABLE `autoparts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `year_id` (`year_id`,`make_id`,`model_id`,`part_id`,`fitment_id`,`brand_id`),
  ADD KEY `make_id` (`make_id`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `part_id` (`part_id`),
  ADD KEY `fitment_id` (`fitment_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart_payment`
--
ALTER TABLE `cart_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cmodel`
--
ALTER TABLE `cmodel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `model_year_id` (`model_year_id`,`model_make_id`),
  ADD KEY `model_make_id` (`model_make_id`);

--
-- Indexes for table `counties`
--
ALTER TABLE `counties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fitment`
--
ALTER TABLE `fitment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fitment_year_id` (`fitment_year_id`,`fitment_make_id`,`fitment_model_id`,`fitment_part_id`),
  ADD KEY `fitment_make_id` (`fitment_make_id`),
  ADD KEY `fitment_model_id` (`fitment_model_id`),
  ADD KEY `fitment_part_id` (`fitment_part_id`);

--
-- Indexes for table `ipay`
--
ALTER TABLE `ipay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `make`
--
ALTER TABLE `make`
  ADD PRIMARY KEY (`id`),
  ADD KEY `make_year_id` (`make_year_id`);

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `mpesa`
--
ALTER TABLE `mpesa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`id`),
  ADD KEY `part_year_id` (`part_year_id`,`part_make_id`,`part_model_id`),
  ADD KEY `part_make_id` (`part_make_id`),
  ADD KEY `part_model_id` (`part_model_id`);

--
-- Indexes for table `pdt_qty`
--
ALTER TABLE `pdt_qty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_counter`
--
ALTER TABLE `product_counter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `social_account`
--
ALTER TABLE `social_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_unique` (`provider`,`client_id`),
  ADD UNIQUE KEY `account_unique_code` (`code`),
  ADD KEY `fk_user_account` (`user_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- Indexes for table `sub_counties`
--
ALTER TABLE `sub_counties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `county_id` (`county_id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD UNIQUE KEY `token_unique` (`user_id`,`code`,`type`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_unique_username` (`username`),
  ADD UNIQUE KEY `user_unique_email` (`email`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `autoparts`
--
ALTER TABLE `autoparts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `cart_payment`
--
ALTER TABLE `cart_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `cmodel`
--
ALTER TABLE `cmodel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1444;
--
-- AUTO_INCREMENT for table `counties`
--
ALTER TABLE `counties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `fitment`
--
ALTER TABLE `fitment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ipay`
--
ALTER TABLE `ipay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `make`
--
ALTER TABLE `make`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT for table `mpesa`
--
ALTER TABLE `mpesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `part`
--
ALTER TABLE `part`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `pdt_qty`
--
ALTER TABLE `pdt_qty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_counter`
--
ALTER TABLE `product_counter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `social_account`
--
ALTER TABLE `social_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `sub_counties`
--
ALTER TABLE `sub_counties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`county`) REFERENCES `counties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `address_ibfk_2` FOREIGN KEY (`sub_county`) REFERENCES `sub_counties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `autoparts`
--
ALTER TABLE `autoparts`
  ADD CONSTRAINT `autoparts_ibfk_1` FOREIGN KEY (`year_id`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `autoparts_ibfk_2` FOREIGN KEY (`make_id`) REFERENCES `make` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `autoparts_ibfk_3` FOREIGN KEY (`model_id`) REFERENCES `cmodel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `autoparts_ibfk_4` FOREIGN KEY (`part_id`) REFERENCES `part` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `autoparts_ibfk_5` FOREIGN KEY (`fitment_id`) REFERENCES `fitment` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `autoparts_ibfk_6` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cmodel`
--
ALTER TABLE `cmodel`
  ADD CONSTRAINT `cmodel_ibfk_1` FOREIGN KEY (`model_year_id`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cmodel_ibfk_2` FOREIGN KEY (`model_make_id`) REFERENCES `make` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fitment`
--
ALTER TABLE `fitment`
  ADD CONSTRAINT `fitment_ibfk_1` FOREIGN KEY (`fitment_year_id`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fitment_ibfk_2` FOREIGN KEY (`fitment_make_id`) REFERENCES `make` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fitment_ibfk_3` FOREIGN KEY (`fitment_model_id`) REFERENCES `cmodel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fitment_ibfk_4` FOREIGN KEY (`fitment_part_id`) REFERENCES `part` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `make`
--
ALTER TABLE `make`
  ADD CONSTRAINT `make_ibfk_1` FOREIGN KEY (`make_year_id`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `part`
--
ALTER TABLE `part`
  ADD CONSTRAINT `part_ibfk_1` FOREIGN KEY (`part_year_id`) REFERENCES `year` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `part_ibfk_2` FOREIGN KEY (`part_make_id`) REFERENCES `make` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `part_ibfk_3` FOREIGN KEY (`part_model_id`) REFERENCES `cmodel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `autoparts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `autoparts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `social_account`
--
ALTER TABLE `social_account`
  ADD CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_counties`
--
ALTER TABLE `sub_counties`
  ADD CONSTRAINT `sub_counties_ibfk_1` FOREIGN KEY (`county_id`) REFERENCES `counties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
