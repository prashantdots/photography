-- phpMyAdmin SQL Dump
-- version 3.1.3.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 27, 2013 at 12:54 PM
-- Server version: 5.1.33
-- PHP Version: 5.2.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `photography-new`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_reasons`
--

CREATE TABLE IF NOT EXISTS `booking_reasons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photographer_id` int(11) NOT NULL,
  `shoot_date` datetime DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `booking_reasons`
--

INSERT INTO `booking_reasons` (`id`, `photographer_id`, `shoot_date`, `reason`, `created`, `modified`) VALUES
(1, 2, '2013-08-14 12:00:00', 'available', '2013-08-13 23:33:18', '2013-08-13 23:33:18'),
(2, 1, '2013-09-06 12:00:00', 'Not Available', '2013-08-22 15:09:52', '2013-08-22 15:09:52');

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE IF NOT EXISTS `galleries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `licklist_gallery_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `is_publish` enum('no','yes') NOT NULL DEFAULT 'no',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `job_id`, `licklist_gallery_id`, `title`, `description`, `is_publish`, `created`, `modified`) VALUES
(1, 1, 44304, 'Abbey- Licklist 23/08/13', 'this is test', 'no', '2013-08-13 21:18:15', '2013-08-23 19:17:56'),
(2, 2, 0, 'Abacus Chesterfield- Licklist 23/08/13', 'this is test', 'no', '2013-08-13 21:19:42', '2013-08-23 19:15:37'),
(3, 4, 44305, 'Abbey- Licklist 23/08/13', '', 'yes', '2013-08-13 23:25:27', '2013-08-15 19:39:40'),
(4, 5, 0, 'Abbey- Licklist 23/08/13', '', 'no', '2013-08-23 18:55:45', '2013-08-23 18:55:45'),
(5, 3, 0, 'Abacus Chesterfield- Licklist 24/08/13', NULL, 'no', '2013-08-23 23:32:50', '2013-08-23 23:32:50');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gallery_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` enum('created','publish','rejected') NOT NULL DEFAULT 'created',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `gallery_id`, `image`, `is_active`, `created`, `modified`) VALUES
(22, 1, 'bullet-classib6128e815818e113d53c17a762dc014a.jpg', 'created', '2013-08-16 22:20:49', '2013-08-16 22:20:49'),
(20, 1, '5408_3d_space_scene_hd_wallpaper918319f33e86ad6b79589458537318a8.jpg', 'created', '2013-08-16 22:20:29', '2013-08-16 22:20:29'),
(21, 1, 'classicb6128e815818e113d53c17a762dc014a.jpg', 'created', '2013-08-16 22:20:49', '2013-08-16 22:20:49'),
(5, 2, 'winted02e9ed559db124286cd4a298657cc18.jpg', 'created', '2013-08-13 21:19:43', '2013-08-13 21:19:43'),
(6, 2, 'blue_hill8562552a8fe42437b0379c9790ab4d26.jpg', 'created', '2013-08-13 21:19:43', '2013-08-13 21:19:43'),
(7, 2, 'bullet-classi8562552a8fe42437b0379c9790ab4d26.jpg', 'created', '2013-08-13 21:19:43', '2013-08-13 21:19:43'),
(8, 2, 'sunse8562552a8fe42437b0379c9790ab4d26.jpg', 'created', '2013-08-13 21:19:43', '2013-08-13 21:19:43'),
(9, 2, 'water_lilie8562552a8fe42437b0379c9790ab4d26.jpg', 'created', '2013-08-13 21:19:43', '2013-08-13 21:19:43'),
(11, 3, 'img_797ddddce0227ae183f2214963b5f90e728.jpg', 'created', '2013-08-13 23:25:27', '2013-08-13 23:25:27'),
(12, 3, 'img_798ddddce0227ae183f2214963b5f90e728.jpg', 'created', '2013-08-13 23:25:27', '2013-08-13 23:25:27'),
(13, 3, 'jewel_07255ff32f611696f0d71dff2e701a551.08.13-027.jpg', 'created', '2013-08-15 19:39:40', '2013-08-15 19:39:40'),
(14, 3, 'jewel_07255ff32f611696f0d71dff2e701a551.08.13-034.jpg', 'created', '2013-08-15 19:39:40', '2013-08-15 19:39:40'),
(15, 3, 'jewel_07255ff32f611696f0d71dff2e701a551.08.13-046.jpg', 'created', '2013-08-15 19:39:40', '2013-08-15 19:39:40'),
(16, 3, 'jewel_07255ff32f611696f0d71dff2e701a551.08.13-053.jpg', 'created', '2013-08-15 19:39:40', '2013-08-15 19:39:40'),
(17, 3, 'jewel_07255ff32f611696f0d71dff2e701a551.08.13-056.jpg', 'created', '2013-08-15 19:39:41', '2013-08-15 19:39:41'),
(19, 1, 'bullet-classi65ad15371c57f062f306a549a077ca28.jpg', 'created', '2013-08-16 22:19:46', '2013-08-16 22:19:46'),
(23, 4, 'edited_colour_version-8b96396dec28d9a85eff9b1e8611bd528.jpg', 'created', '2013-08-23 18:55:47', '2013-08-23 18:55:47'),
(24, 4, 'edited_colour_version-8cacfc5a073af2576061a6b824dace428.jpg', 'created', '2013-08-23 18:55:49', '2013-08-23 18:55:49'),
(35, 2, 'edited_colour_version-8a01320788b3a26133aa0e22bea7b3661.jpg', 'created', '2013-08-23 19:15:38', '2013-08-23 19:15:38'),
(34, 2, 'edited_colour_version-8d9b8f89d0ab55f1c48672db66ef72c2d.jpg', 'created', '2013-08-23 19:15:38', '2013-08-23 19:15:38'),
(27, 1, 'sunse831811f90a3694a8d45c8327bf503a59.jpg', 'created', '2013-08-23 19:09:10', '2013-08-23 19:09:10'),
(28, 2, 'chrysanthemu8bbdd76388f32b7c962055cf4b2238f1.jpg', 'created', '2013-08-23 19:10:54', '2013-08-23 19:10:54'),
(29, 2, 'deser8bbdd76388f32b7c962055cf4b2238f1.jpg', 'created', '2013-08-23 19:10:54', '2013-08-23 19:10:54'),
(30, 2, 'hydrangea8bbdd76388f32b7c962055cf4b2238f1.jpg', 'created', '2013-08-23 19:10:55', '2013-08-23 19:10:55'),
(31, 1, 'lighthous5f407e1ae389e8c548c1512701eeb8e7.jpg', 'created', '2013-08-23 19:12:18', '2013-08-23 19:12:18'),
(36, 2, 'edited_colour_version-8a01320788b3a26133aa0e22bea7b3661.jpg', 'created', '2013-08-23 19:15:39', '2013-08-23 19:15:39'),
(37, 1, 'edited_colour_version-814bdcb4c9450666d5d9664429e53c0bc.jpg', 'created', '2013-08-23 19:18:01', '2013-08-23 19:18:01'),
(38, 1, 'edited_colour_version-81de15b49c6fda3bd5d9ff32454665e5e.jpg', 'created', '2013-08-23 19:18:06', '2013-08-23 19:18:06'),
(39, 1, 'edited_colour_version-8f286031a359087decb95072f0b12a26c.jpg', 'created', '2013-08-23 19:18:09', '2013-08-23 19:18:09'),
(40, 1, 'edited_colour_version-8fcf13784ec029d57c4d2053c39f47616.jpg', 'created', '2013-08-23 19:18:12', '2013-08-23 19:18:12'),
(41, 1, 'edited_colour_version-80f81e280aafae4d0b742301e9c8ac268.jpg', 'created', '2013-08-23 19:18:14', '2013-08-23 19:18:14'),
(42, 5, 'blue_hilla8171c0dfe770e433e49f0ed1188cc28.jpg', 'created', '2013-08-23 23:32:50', '2013-08-23 23:32:50'),
(43, 5, 'bullet-classi12b02583f7fb00c56433bfd9221870f2.jpg', 'created', '2013-08-23 23:32:55', '2013-08-23 23:32:55'),
(44, 5, 'classic0ac478c1573bb4bef3b55bb8120c9ea5.jpg', 'created', '2013-08-23 23:33:01', '2013-08-23 23:33:01'),
(45, 1, 'penguincd721feb0cc41db45bcc7d8aabd7c9a4.jpg', 'created', '2013-08-23 23:38:04', '2013-08-23 23:38:04'),
(46, 3, 'edited_colour_version-865b2a0b06491f41d030c3319b7079934.jpg', 'created', '2013-08-23 23:41:11', '2013-08-23 23:41:11'),
(47, 3, 'edited_colour_version-83b6ce87de9c75e247719ec33159f8609.jpg', 'created', '2013-08-23 23:42:07', '2013-08-23 23:42:07'),
(48, 3, 'edited_colour_version-898f86ed1c1ec25a6c102f61ba7ff42a3.jpg', 'created', '2013-08-23 23:43:00', '2013-08-23 23:43:00'),
(49, 3, 'edited_colour_version-82d45591d0c333d4c1c3d08daa9cc2e3b.jpg', 'created', '2013-08-23 23:43:30', '2013-08-23 23:43:30'),
(50, 3, 'edited_colour_version-882d628e24113cdc4be7cc44f34a661be.jpg', 'created', '2013-08-23 23:43:59', '2013-08-23 23:43:59'),
(51, 5, 'bullet-classi5ba45d99eaa81118471cf688b39104d4.jpg', 'created', '2013-08-24 00:06:51', '2013-08-24 00:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `high_resolution_requests`
--

CREATE TABLE IF NOT EXISTS `high_resolution_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photographer_id` int(11) NOT NULL,
  `gallery_image_id` int(11) NOT NULL,
  `status` enum('pending','complete') NOT NULL DEFAULT 'pending',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `high_resolution_requests`
--

INSERT INTO `high_resolution_requests` (`id`, `photographer_id`, `gallery_image_id`, `status`, `created`, `modified`) VALUES
(1, 1, 19, 'complete', '2013-08-16 22:23:05', '2013-08-16 22:23:05'),
(2, 1, 21, 'pending', '2013-08-16 22:28:36', '2013-08-16 22:28:36'),
(3, 2, 11, 'pending', '2013-08-22 14:48:48', '2013-08-22 14:48:48'),
(4, 2, 14, 'pending', '2013-08-22 14:55:22', '2013-08-22 14:55:22'),
(5, 1, 19, 'pending', '2013-08-22 16:24:38', '2013-08-22 16:24:38'),
(6, 1, 22, 'pending', '2013-08-23 18:59:47', '2013-08-23 18:59:47'),
(7, 2, 14, 'pending', '2013-08-23 19:00:23', '2013-08-23 19:00:23');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_id` int(11) NOT NULL,
  `photographer_name` varchar(255) DEFAULT NULL,
  `venue_contact_person` varchar(255) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `issue_date` datetime NOT NULL,
  `is_paid` enum('no','yes') NOT NULL DEFAULT 'no',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `job_id`, `photographer_name`, `venue_contact_person`, `price`, `issue_date`, `is_paid`, `created`, `modified`) VALUES
(1, 1, 'Mr Vijender Rana', 'Abbey', 120, '2013-08-30 12:00:00', 'no', '2013-08-14 23:50:06', '2013-08-14 23:50:06');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_no` varchar(255) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `ordered_by` varchar(255) DEFAULT NULL,
  `agreed_photographer_fee` varchar(255) DEFAULT NULL COMMENT 'For The Photographer',
  `agreed_venue_fee` varchar(255) DEFAULT NULL COMMENT 'For The Venue',
  `licklist_commission` varchar(60) NOT NULL,
  `shoot_date` datetime DEFAULT NULL,
  `venue_id` int(11) DEFAULT NULL COMMENT 'Location / Venue',
  `venue_contact_person` varchar(255) DEFAULT NULL,
  `venue_mobile` varchar(255) DEFAULT NULL,
  `venue_address` text,
  `venue_postcode` varchar(255) DEFAULT NULL,
  `photographer_arrival_time` varchar(255) DEFAULT NULL,
  `shoot_commences` varchar(255) DEFAULT NULL,
  `shoot_concludes` varchar(255) DEFAULT NULL,
  `dress_code` varchar(255) DEFAULT NULL,
  `image_upload_req_by` varchar(255) DEFAULT NULL,
  `photographer_id` int(11) NOT NULL,
  `photographer_name` varchar(255) DEFAULT NULL,
  `photographer_mobile` varchar(255) DEFAULT NULL,
  `photographer_email` varchar(255) DEFAULT NULL,
  `photographer_website` varchar(50) DEFAULT NULL,
  `cover_photographer` varchar(255) DEFAULT NULL,
  `personal_licklist_contact` varchar(255) DEFAULT NULL,
  `secondary_licklist_contact` varchar(255) DEFAULT NULL,
  `mobile1` varchar(255) DEFAULT NULL,
  `mobile2` varchar(255) DEFAULT NULL,
  `email1` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `message` text,
  `is_live` enum('no','yes') NOT NULL DEFAULT 'yes',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_no`, `order_date`, `ordered_by`, `agreed_photographer_fee`, `agreed_venue_fee`, `licklist_commission`, `shoot_date`, `venue_id`, `venue_contact_person`, `venue_mobile`, `venue_address`, `venue_postcode`, `photographer_arrival_time`, `shoot_commences`, `shoot_concludes`, `dress_code`, `image_upload_req_by`, `photographer_id`, `photographer_name`, `photographer_mobile`, `photographer_email`, `photographer_website`, `cover_photographer`, `personal_licklist_contact`, `secondary_licklist_contact`, `mobile1`, `mobile2`, `email1`, `email2`, `message`, `is_live`, `created`, `modified`) VALUES
(1, 'job-101', '2013-08-13 12:00:00', 'Ben Jennings', '120', '150', '30', '2013-08-30 12:00:00', 2, 'Abbey', '441483212223', '30 - 33 Minories ,The City,Greater London', 'GU2 8SG', '12:30 pm', '1:00 pm', '2:00 pm', 'formal', 'yes', 1, 'Mr Vijender Rana', '441483303666', 'vijender.singh@dotsquares.com', 'www.google.com', 'Mr Vijender Rana', 'Ben Jennings', '', '444132345202', '', 'Ben@licklist.co.uk', '', 'this is simple message', 'yes', '2013-08-13 21:14:57', '2013-08-14 23:56:38'),
(2, 'job-102', '2013-08-13 12:00:00', 'Ben Jennings', '120', '160', '', '2013-08-31 12:00:00', 1, 'Abacus Chesterfield', '441485323334', 'York House, ST Marys Gate ,Chesterfield,Derbyshire', 'RG1 8DJ', '12:30 pm', '1:00 pm', '3:00 pm', 'formal', 'yes', 1, 'Mr Vijender Rana', '441483303666', 'vijender.singh@dotsquares.com', 'www.google.com', 'Mr Vijender Rana', 'Ben Jennings', NULL, '444132345202', '', 'Ben@licklist.co.uk', '', 'this is test message', 'yes', '2013-08-13 21:16:59', '2013-08-13 21:16:59'),
(3, '11111', '2013-08-13 12:00:00', 'Ben Jennings', '10', '20', '', '2013-08-15 12:00:00', 1, 'Abacus Chesterfield', '441485323334', 'York House, ST Marys Gate ,Chesterfield,Derbyshire', 'RG1 8DJ', '10', '11', '12', 'w', '12', 1, 'Mr Vijender Rana', '441483303666', 'vijender.singh@dotsquares.com', 'www.google.com', 'Mr Vijender Rana', 'Ben Jennings', NULL, '07989898989', '09090909090', 'Ben@licklist.co.uk', '', 'none', 'yes', '2013-08-13 23:01:53', '2013-08-13 23:01:53'),
(4, 'job-103', '2013-08-13 12:00:00', 'Ben Jennings', '120', '150', '', '2013-08-30 12:00:00', 2, 'Abbey', '441483212223', '30 - 33 Minories ,The City,Greater London', 'GU2 8SG', '12:30 pm', '1:00 pm', '2:00 pm', 'formal', 'yes', 2, 'Mr Brad Nobbs', '447987676512', 'bradleynobbs2@googlemail.com', 'www.w.com', 'Mr Vijender Rana', 'Ben Jennings', NULL, '444132345202', '', 'Ben@licklist.co.uk', '', 'this is simple message', 'yes', '2013-08-13 23:22:47', '2013-08-13 23:22:47'),
(5, 'job-109', '2013-08-13 12:00:00', 'Ben Jennings', '120', '150', '', '2013-08-30 12:00:00', 2, 'Abbey', '441483212223', '30 - 33 Minories ,The City,Greater London', 'GU2 8SG', '12:30 pm', '1:00 pm', '2:00 pm', 'formal', 'yes', 2, 'Mr Brad Nobbs', '447987676512', 'bradleynobbs2@googlemail.com', 'www.w.com', 'Mr Vijender Rana', 'Ben Jennings', '', '444132345202', '', 'Ben@licklist.co.uk', '', 'testing', 'yes', '2013-08-23 18:42:04', '2013-08-23 18:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `photographers`
--

CREATE TABLE IF NOT EXISTS `photographers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(10) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `dob_date` datetime DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `website` varchar(50) DEFAULT NULL,
  `vehicle` enum('Y','N') DEFAULT NULL,
  `distance` varchar(10) DEFAULT NULL,
  `preferred_working_days` text,
  `experience` varchar(20) DEFAULT NULL,
  `post_experience` varchar(20) DEFAULT NULL,
  `skill_score` varchar(255) DEFAULT NULL,
  `note` text,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `photographers`
--

INSERT INTO `photographers` (`id`, `user_id`, `title`, `fname`, `lname`, `image`, `dob_date`, `mobile`, `address1`, `address2`, `town`, `county`, `postcode`, `website`, `vehicle`, `distance`, `preferred_working_days`, `experience`, `post_experience`, `skill_score`, `note`, `created`, `modified`) VALUES
(1, 2, 'Mr', 'Vijender', 'Rana', NULL, '1984-08-20 12:00:00', '441483303666', 'Unit 4, Midleton Gate', 'Guildford Business Park', 'Guildford', 'United Kingdom', 'GU2 8SG', 'www.google.com', 'Y', '10', 'a:5:{i:0;s:3:"Mon";i:1;s:3:"Tue";i:2;s:3:"Wed";i:3;s:3:"Thu";i:4;s:3:"Fri";}', 'Advanced', 'Intermediate', 'best in work', '', '2013-08-13 21:03:53', '2013-08-13 21:03:53'),
(2, 5, 'Mr', 'Brad', 'Nobbs', NULL, '1991-03-23 12:00:00', '447987676512', '1 the road', 't', 'town', 'essex', 'jj89iu', 'www.w.com', 'Y', '10 miles', 'a:2:{i:2;s:3:"Wed";i:5;s:3:"Sat";}', 'Professional', 'Professional', '10', '', '2013-08-13 23:21:07', '2013-08-13 23:21:07'),
(3, 6, 'Mr', 'Bhuvnesh', 'Kumar', NULL, '1985-10-02 12:00:00', '9929265335', 'a', 'b', 'jaipur', 'india', '302004', '', 'Y', '123', 'mon,Tue,wed,thu,fri,sat,sun', 'Intermediate', 'Professional', 'good', '', '2013-08-14 20:20:45', '2013-08-14 20:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `replenishes`
--

CREATE TABLE IF NOT EXISTS `replenishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photographer_name` varchar(255) DEFAULT NULL,
  `card` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `replenishes`
--

INSERT INTO `replenishes` (`id`, `photographer_name`, `card`, `created`, `modified`) VALUES
(1, 'Mr Vijender Rana', 123, '2013-08-14 23:58:08', '2013-08-14 23:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `email1` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `mobile1` varchar(255) DEFAULT NULL,
  `mobile2` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email`, `email1`, `email2`, `mobile`, `mobile1`, `mobile2`, `created`, `modified`) VALUES
(1, 'Ben@licklist.co.uk', 'Hollie@licklist.co.uk', 'brad@licklist.co.uk', '09509566230', '', '', '2013-07-24 11:30:28', '2013-07-26 23:26:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `role` enum('admin','photographer','venue') DEFAULT 'admin',
  `active` smallint(2) NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `active`, `created`, `modified`) VALUES
(1, 'admin', 'admin@photography.com', '74a7851ded68359040372e115cff37282b6204ed', 'admin', 1, '2013-05-21 09:05:28', '2013-05-21 09:05:28'),
(2, 'vijay', 'vijender.singh@dotsquares.com', '74a7851ded68359040372e115cff37282b6204ed', 'photographer', 1, '2013-08-13 21:03:53', '2013-08-13 21:03:53'),
(3, 'abacus', 'abacus.chesterfield@gmail.com', '74a7851ded68359040372e115cff37282b6204ed', 'venue', 1, '2013-08-13 21:06:15', '2013-08-13 21:06:15'),
(4, 'abbey', 'abbey@test.com', '74a7851ded68359040372e115cff37282b6204ed', 'venue', 1, '2013-08-13 21:07:44', '2013-08-23 18:50:38'),
(5, 'brad', 'bradleynobbs2@googlemail.com', '74a7851ded68359040372e115cff37282b6204ed', 'photographer', 1, '2013-08-13 23:21:07', '2013-08-13 23:21:07'),
(6, 'Bhuvnesh', 'bhuvnesh.kumar@dotsquares.com', '74a7851ded68359040372e115cff37282b6204ed', 'photographer', 0, '2013-08-14 20:20:45', '2013-08-14 20:20:45');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE IF NOT EXISTS `venues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `licklist_venue_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `county` varchar(255) DEFAULT NULL,
  `postcode` varchar(255) DEFAULT NULL,
  `watermark_image_type` enum('normal','banner') NOT NULL DEFAULT 'normal',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `user_id`, `licklist_venue_id`, `name`, `mobile`, `address`, `town`, `county`, `postcode`, `watermark_image_type`, `created`, `modified`) VALUES
(1, 3, 342, 'Abacus Chesterfield', '441485323334', 'York House, ST Marys Gate ', 'Chesterfield', 'Derbyshire', 'RG1 8DJ', 'normal', '2013-08-13 21:06:15', '2013-08-13 21:06:15'),
(2, 4, 746, 'Abbey', '441483212223', '30 - 33 Minories ', 'The City', 'Greater London', 'GU2 8SG', 'banner', '2013-08-13 21:07:44', '2013-08-13 21:07:44');
