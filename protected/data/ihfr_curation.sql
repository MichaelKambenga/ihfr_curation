-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2013 at 05:23 PM
-- Server version: 5.5.28
-- PHP Version: 5.3.10-1ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ihfr_curation`
--

-- --------------------------------------------------------

--
-- Table structure for table `AuthAssignment`
--

DROP TABLE IF EXISTS `AuthAssignment`;
CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Request Change Privilege', '0', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `AuthItem`
--

DROP TABLE IF EXISTS `AuthItem`;
CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('Administrator', 2, 'Administration Privilege', NULL, NULL),
('Approval Change Privilege', 2, 'Approval Change Privilege', NULL, NULL),
('Request Change Privilege', 2, 'Request Change Privilege', NULL, NULL),
('Task 01:-Request New Facility', 1, 'A Request to Create A New Facility', NULL, 'N;'),
('Task 02:-Request Update To Facility', 1, 'A Request to Update A Facility', NULL, 'N;'),
('Task 03:-Request Removal Of Facility', 1, 'A Request to Remove A Facility From Registry', NULL, 'N;'),
('Task 04:-Process Change Requests', 1, 'Processing of Change Requests', NULL, 'N;'),
('Task 05:-User Administration', 1, 'User Administration', NULL, 'N;');

-- --------------------------------------------------------

--
-- Table structure for table `AuthItemChild`
--

DROP TABLE IF EXISTS `AuthItemChild`;
CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('Request Change Privilege', 'Task 01:-Request New Facility'),
('Request Change Privilege', 'Task 02:-Request Update To Facility'),
('Request Change Privilege', 'Task 03:-Request Removal Of Facility'),
('Approval Change Privilege', 'Task 04:-Process Change Requests'),
('Administrator', 'Task 05:-User Administration');

-- --------------------------------------------------------

--
-- Table structure for table `change_request`
--

DROP TABLE IF EXISTS `change_request`;
CREATE TABLE IF NOT EXISTS `change_request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `primary_site_code` varchar(45) DEFAULT NULL COMMENT 'i.e Luhn ID',
  `cc_site_id` int(11) DEFAULT NULL COMMENT 'Curation Collection Site ID',
  `pc_site_id` int(11) DEFAULT NULL,
  `version_id` varchar(45) DEFAULT NULL COMMENT 'Site VersionID',
  `requested_by` int(11) NOT NULL,
  `request_type` varchar(45) NOT NULL COMMENT 'Three Request Types:-\n1.CREATE\n2.UPDATE\n3.DELETE',
  `status` varchar(45) DEFAULT NULL COMMENT 'Three Statuses:-\n1.PENDING\n2.APPROVED\n3.REJECTED',
  `requested_date` datetime NOT NULL,
  `reviewed_date` datetime DEFAULT NULL,
  `reviewed_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_change_request_user` (`requested_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `change_request`
--

INSERT INTO `change_request` (`id`, `primary_site_code`, `cc_site_id`, `pc_site_id`, `version_id`, `requested_by`, `request_type`, `status`, `requested_date`, `reviewed_date`, `reviewed_by`) VALUES
(23, '100000-9', 116169, 116171, '1', 1, '1', '2', '2013-11-06 15:32:00', '2013-11-06 16:19:34', 1),
(24, '100001-8', 116172, 116173, '1', 1, '1', '2', '2013-11-06 16:45:17', '2013-11-06 16:46:51', 1),
(25, '100001-8', 116172, 116173, '2', 1, '2', '2', '2013-11-06 17:06:18', '2013-11-06 17:22:33', 1),
(26, '108464-1', 116169, NULL, '3', 1, '2', '2', '2013-11-07 12:00:30', '2013-11-07 12:17:47', 1),
(27, '108464-1', 116169, NULL, '4', 1, '2', '2', '2013-11-07 12:49:46', '2013-11-07 12:51:42', 1),
(28, '108464-1', 116169, NULL, '5', 1, '2', '2', '2013-11-07 13:38:27', '2013-11-07 13:40:57', 1),
(29, '108464-1', 116169, NULL, '6', 1, '2', '2', '2013-11-07 16:56:02', '2013-11-07 18:07:47', 1),
(33, '108464-1', 116169, NULL, '17', 1, '2', '2', '2013-11-13 10:33:10', '2013-11-13 10:35:12', 1),
(34, '108467-8', 116176, 116177, '1', 1, '1', '2', '2013-11-13 11:03:56', '2013-11-13 11:06:39', 1),
(35, '108466-9', 116176, NULL, '3', 1, '2', '2', '2013-11-13 11:21:37', '2013-11-13 11:23:27', 1),
(36, '108466-9', 116176, NULL, '4', 1, '2', '2', '2013-11-13 11:40:03', '2013-11-13 11:46:06', 1),
(37, '108466-9', 116176, NULL, '5', 1, '2', '2', '2013-11-13 11:59:07', '2013-11-13 12:00:08', 1),
(38, '108466-9', 116176, NULL, '6', 1, '2', '2', '2013-11-13 12:02:18', '2013-11-13 12:03:10', 1),
(39, '108467-8', 116178, 116179, '1', 1, '1', '2', '2013-11-13 12:25:13', '2013-11-13 12:29:01', 1),
(40, '108467-8', 116178, NULL, '2', 1, '2', '2', '2013-11-13 12:34:05', '2013-11-13 12:34:45', 1),
(41, '108467-8', 116178, 116179, '3', 1, '2', '2', '2013-11-13 12:43:54', '2013-11-13 12:45:52', 1),
(42, '108467-8', 116178, 116179, '4', 1, '2', '2', '2013-11-13 13:01:39', '2013-11-13 13:17:43', 1),
(44, '108467-8', 116178, NULL, '6', 1, '2', '2', '2013-11-13 13:20:24', NULL, NULL),
(45, '108467-8', 116178, 116179, '7', 1, '2', '2', '2013-11-13 13:28:04', '2013-11-13 13:29:51', 1),
(46, '108467-8', 116178, 116179, '8', 1, '2', '2', '2013-11-13 19:32:28', '2013-11-13 19:34:56', 1),
(47, '108468-7', 116180, 116181, '1', 1, '1', '2', '2013-11-15 13:00:40', '2013-11-15 13:01:37', 1),
(48, '108469-6', 116182, 116183, '1', 1, '1', '2', '2013-11-15 13:12:55', '2013-11-15 13:13:19', 1),
(49, '108468-7', 116180, 116181, '2', 1, '2', '2', '2013-11-15 13:36:09', '2013-11-15 13:39:55', 1),
(50, '108464-1', 116169, 116171, '18', 1, '2', '2', '2013-11-17 11:08:10', '2013-11-17 11:13:37', 1),
(51, '108464-1', 116169, 116171, '19', 1, '2', '2', '2013-11-17 11:27:29', '2013-11-17 11:31:10', 1),
(52, '108464-1', 116169, 116171, '20', 1, '2', '2', '2013-11-17 11:33:23', '2013-11-17 11:36:26', 1),
(53, '108464-1', 116169, 116171, '21', 1, '2', '2', '2013-11-17 11:41:26', '2013-11-17 11:44:14', 1),
(54, '108470-3', 116184, 116185, '1', 1, '1', '2', '2013-11-18 09:31:37', '2013-11-18 10:19:17', 1),
(55, '108470-3', 116184, NULL, '2', 1, '2', '2', '2013-11-18 10:23:36', NULL, NULL),
(56, '108471-2', 116186, 116187, '1', 1, '1', '2', '2013-11-18 13:52:30', '2013-11-18 13:54:16', 1),
(57, '108471-2', 116186, 116187, '2', 1, '2', '2', '2013-11-18 14:16:05', '2013-11-18 14:17:12', 1),
(58, '108471-2', 116186, 116187, '3', 1, '2', '2', '2013-11-18 14:18:30', '2013-11-18 14:19:53', 1),
(59, '108471-2', 116186, 116187, '5', 1, '2', '2', '2013-11-18 15:19:07', '2013-11-18 15:20:48', 1),
(60, '108472-1', 116192, NULL, '1', 1, '1', '2', '2013-11-20 12:56:55', NULL, NULL),
(61, '108473-0', 116201, 116202, '1', 1, '1', '2', '2013-11-25 11:45:56', '2013-11-25 11:48:00', 1),
(62, '108473-0', 116201, 116202, '2', 1, '2', '2', '2013-11-25 11:51:16', '2013-11-25 11:53:11', 1),
(63, '108473-0', 116201, 116202, '3', 1, '2', '2', '2013-11-25 11:56:37', '2013-11-25 11:57:25', 1),
(70, '108465-6', 116174, 116173, NULL, 1, '3', '2', '2013-11-25 15:23:30', '2013-11-25 15:24:28', 1),
(71, '108471-4', 116186, 116187, NULL, 1, '3', '2', '2013-11-25 15:26:59', '2013-11-25 15:27:48', 1),
(72, '108467-2', 116178, 116179, NULL, 1, '3', '2', '2013-11-25 15:29:11', '2013-11-25 15:30:01', 1),
(73, '108464-9', 116169, 116171, NULL, 1, '3', '2', '2013-11-25 15:32:08', '2013-11-25 15:33:11', 1),
(74, '108470-6', 116184, 116185, NULL, 1, '3', '2', '2013-11-25 15:35:41', '2013-11-25 15:37:14', 1),
(75, '108470-6', 116184, 116185, NULL, 1, '3', '3', '2013-11-25 15:36:18', '2013-11-25 15:45:18', 1),
(76, '108466-4', 116176, 116177, NULL, 1, '3', '2', '2013-11-25 15:51:22', '2013-11-25 15:57:51', 1),
(77, '108468-0', 116180, 116181, NULL, 1, '3', '2', '2013-11-25 15:59:42', '2013-11-25 16:00:12', 1),
(78, '108469-8', 116182, 116183, NULL, 1, '3', '2', '2013-11-25 16:00:51', '2013-11-25 16:02:30', 1),
(79, '100000-9', 116203, 116204, '1', 1, '1', '2', '2013-11-26 10:32:14', '2013-11-26 11:34:54', 1),
(80, '108465-6', 116206, 116207, '1', 1, '1', '2', '2013-11-26 11:57:13', '2013-11-26 12:14:05', 1),
(81, '108465-6', 116206, 116207, '3', 1, '2', '2', '2013-11-26 12:18:21', '2013-11-26 12:21:57', 1),
(82, '108466-4', 116208, 116209, '1', 1, '1', '2', '2013-11-26 12:35:31', '2013-11-26 12:40:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `change_request_fields`
--

DROP TABLE IF EXISTS `change_request_fields`;
CREATE TABLE IF NOT EXISTS `change_request_fields` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `change_request_id` int(11) NOT NULL,
  `field_id` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `change_request_id` (`change_request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=322 ;

--
-- Dumping data for table `change_request_fields`
--

INSERT INTO `change_request_fields` (`id`, `change_request_id`, `field_id`) VALUES
(100, 23, '1815'),
(101, 23, '1814'),
(102, 23, '1840'),
(103, 23, '1841'),
(104, 23, '1813'),
(105, 23, '1838'),
(106, 23, '1881'),
(107, 23, '1858'),
(108, 23, '1862'),
(109, 23, '1864'),
(110, 23, '1866'),
(111, 23, '1870'),
(112, 24, '1815'),
(113, 24, '1814'),
(114, 24, '1840'),
(115, 24, '1841'),
(116, 24, '1813'),
(117, 24, '1838'),
(118, 24, '1854'),
(119, 24, '1858'),
(120, 24, '1887'),
(121, 24, '1862'),
(122, 24, '1864'),
(123, 24, '1866'),
(124, 25, '1840'),
(125, 25, '1841'),
(126, 25, '1813'),
(127, 25, '1862'),
(128, 25, '1864'),
(129, 25, '1814'),
(130, 26, '1884'),
(131, 26, '1868'),
(132, 26, '1814'),
(133, 27, '1813'),
(134, 27, '1875'),
(135, 27, '1876'),
(136, 27, '1814'),
(137, 28, '1872'),
(138, 28, '1840'),
(139, 28, '1873'),
(140, 28, '1841'),
(141, 28, '1813'),
(142, 28, '1814'),
(143, 29, '1813'),
(144, 29, '1887'),
(145, 29, '1866'),
(146, 29, '1814'),
(153, 33, '1840'),
(154, 33, '1841'),
(155, 33, '1813'),
(156, 33, '1814'),
(157, 34, '1815'),
(158, 34, '1814'),
(159, 34, '1840'),
(160, 34, '1841'),
(161, 34, '1813'),
(162, 35, '1838'),
(163, 35, '1858'),
(164, 35, '1887'),
(165, 35, '1864'),
(166, 35, '1814'),
(167, 36, '1814'),
(168, 37, '1814'),
(169, 38, '1873'),
(170, 38, '1874'),
(171, 38, '1814'),
(172, 39, '1814'),
(173, 39, '1840'),
(174, 39, '1841'),
(175, 39, '1813'),
(176, 39, '1838'),
(177, 39, '1881'),
(178, 39, '1862'),
(179, 39, '1864'),
(180, 40, '1883'),
(181, 40, '1814'),
(182, 41, '1813'),
(183, 41, '1814'),
(184, 42, '1813'),
(185, 42, '1814'),
(186, 45, '1843'),
(187, 45, '1814'),
(188, 46, '1813'),
(189, 46, '1878'),
(190, 46, '1884'),
(191, 46, '1814'),
(192, 47, '1814'),
(193, 47, '1840'),
(194, 47, '1841'),
(195, 47, '1813'),
(196, 47, '1838'),
(197, 47, '1887'),
(198, 47, '1862'),
(199, 47, '1864'),
(200, 48, '1814'),
(201, 48, '1840'),
(202, 48, '1841'),
(203, 48, '1813'),
(204, 48, '1838'),
(205, 48, '1887'),
(206, 48, '1862'),
(207, 48, '1864'),
(208, 49, '1840'),
(209, 49, '1813'),
(210, 49, '1881'),
(211, 49, '1858'),
(212, 49, '1864'),
(213, 49, '1870'),
(214, 49, '1814'),
(215, 50, '1840'),
(216, 50, '1841'),
(217, 50, '1813'),
(218, 50, '1814'),
(219, 51, '1840'),
(220, 51, '1841'),
(221, 51, '1886'),
(222, 51, '1864'),
(223, 51, '1866'),
(224, 51, '1814'),
(225, 52, '1839'),
(226, 52, '1833'),
(227, 52, '1837'),
(228, 52, '1882'),
(229, 52, '1870'),
(230, 52, '1814'),
(231, 53, '1878'),
(232, 53, '1879'),
(233, 53, '1853'),
(234, 53, '1854'),
(235, 53, '1883'),
(236, 53, '1814'),
(237, 54, '1814'),
(238, 54, '1840'),
(239, 54, '1841'),
(240, 54, '1813'),
(241, 54, '1838'),
(242, 54, '1858'),
(243, 54, '1864'),
(244, 54, '1870'),
(245, 55, '1886'),
(246, 55, '1862'),
(247, 55, '1866'),
(248, 55, '1814'),
(249, 56, '1810'),
(250, 56, '1814'),
(251, 56, '1811'),
(252, 56, '1812'),
(253, 56, '1813'),
(254, 57, '1810'),
(255, 57, '1814'),
(256, 58, '1814'),
(257, 59, '1810'),
(258, 59, '1814'),
(259, 60, '1810'),
(260, 60, '1814'),
(261, 60, '1811'),
(262, 60, '1812'),
(263, 60, '1840'),
(264, 60, '1841'),
(265, 60, '1813'),
(266, 60, '1838'),
(267, 60, '1887'),
(268, 60, '1862'),
(269, 60, '1864'),
(270, 60, '1866'),
(271, 60, '1868'),
(272, 60, '1870'),
(273, 61, '1810'),
(274, 61, '1814'),
(275, 61, '1811'),
(276, 61, '1812'),
(277, 61, '1840'),
(278, 61, '1841'),
(279, 61, '1813'),
(280, 61, '1838'),
(281, 61, '1858'),
(282, 61, '1887'),
(283, 61, '1862'),
(284, 61, '1864'),
(285, 61, '1866'),
(286, 61, '1870'),
(287, 62, '1840'),
(288, 62, '1814'),
(289, 63, '1841'),
(290, 63, '1814'),
(291, 79, '1810'),
(292, 79, '1815'),
(293, 79, '1814'),
(294, 79, '1811'),
(295, 79, '1812'),
(296, 79, '1840'),
(297, 79, '1873'),
(298, 79, '1841'),
(299, 79, '1813'),
(300, 79, '1838'),
(301, 80, '1810'),
(302, 80, '1815'),
(303, 80, '1811'),
(304, 80, '1812'),
(305, 80, '1840'),
(306, 80, '1841'),
(307, 80, '1813'),
(308, 80, '1838'),
(309, 80, '1858'),
(310, 80, '1864'),
(311, 81, '1814'),
(312, 82, '1810'),
(313, 82, '1815'),
(314, 82, '1811'),
(315, 82, '1812'),
(316, 82, '1840'),
(317, 82, '1841'),
(318, 82, '1813'),
(319, 82, '1881'),
(320, 82, '1862'),
(321, 82, '1864');

-- --------------------------------------------------------

--
-- Table structure for table `change_request_note`
--

DROP TABLE IF EXISTS `change_request_note`;
CREATE TABLE IF NOT EXISTS `change_request_note` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `change_request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_note_user1` (`user_id`),
  KEY `fk_note_change_request1` (`change_request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Change Request Has many Notes and Many User can add Notes on' AUTO_INCREMENT=118 ;

--
-- Dumping data for table `change_request_note`
--

INSERT INTO `change_request_note` (`id`, `change_request_id`, `user_id`, `note`) VALUES
(11, 23, 1, 'New Site'),
(14, 24, 1, 'Built last year'),
(15, 24, 1, 'Ruaha hospital information is correct'),
(16, 25, 1, 'Updating mobile networks and licenses'),
(17, 25, 1, 'Yes everything is fine'),
(18, 25, 1, 'Okay'),
(19, 26, 1, 'Changed'),
(20, 26, 1, 'Approved'),
(21, 27, 1, 'Made some changes'),
(22, 27, 1, 'Approved'),
(23, 28, 1, 'Updated services'),
(24, 28, 1, 'Approved'),
(25, 29, 1, 'Changed'),
(26, 29, 1, 'Approved --double view'),
(30, 33, 1, 'Updated Location and Registration status'),
(31, 33, 1, 'Approved'),
(32, 34, 1, 'New Site'),
(33, 34, 1, 'Okay'),
(34, 35, 1, 'Updated'),
(35, 35, 1, 'Approved'),
(36, 36, 1, 'Updated Location'),
(37, 36, 1, 'Approved'),
(38, 37, 1, 'Updated Location'),
(39, 37, 1, 'Approved'),
(40, 38, 1, 'Updated services offered'),
(41, 38, 1, 'Approved'),
(42, 39, 1, 'New site Snow white created'),
(43, 39, 1, 'Approved'),
(44, 40, 1, 'Updated'),
(45, 40, 1, 'Approved'),
(46, 41, 1, 'Updated to pending status'),
(47, 41, 1, 'Approved'),
(48, 42, 1, 'Updated'),
(49, 42, 1, 'Approved\r\n'),
(51, 44, 1, 'Updated'),
(52, 45, 1, 'Updated'),
(53, 45, 1, 'Approved'),
(54, 46, 1, 'Updated'),
(55, 46, 1, 'Approved'),
(56, 47, 1, 'New Facility near Riverside'),
(57, 48, 1, 'New site near riverside'),
(58, 48, 1, 'Approved'),
(59, 49, 1, 'Updated Bethel'),
(60, 49, 1, 'Approved'),
(61, 50, 1, 'Updated'),
(62, 50, 1, 'Approved'),
(63, 51, 1, 'Updated'),
(64, 51, 1, 'Approved'),
(65, 52, 1, 'Updated'),
(66, 52, 1, 'Approved'),
(67, 53, 1, 'Updated'),
(68, 53, 1, 'Approved'),
(69, 54, 1, 'New Site'),
(70, 54, 1, 'Approved'),
(71, 55, 1, 'Updated'),
(72, 56, 1, 'New Site'),
(73, 56, 1, 'Approved'),
(74, 57, 1, 'Updated'),
(75, 57, 1, 'Approved'),
(76, 58, 1, 'Updated'),
(77, 58, 1, 'Approved'),
(78, 59, 1, 'Updated'),
(79, 59, 1, 'Approved'),
(80, 60, 1, 'New Site'),
(81, 61, 1, 'New site'),
(82, 61, 1, 'Approved'),
(83, 62, 1, 'Updated'),
(84, 62, 1, 'Approved'),
(85, 62, 1, 'Approved'),
(86, 63, 1, 'Updated'),
(87, 63, 1, 'Approved'),
(92, 70, 1, 'Wants to delete'),
(93, 70, 1, 'approved'),
(94, 71, 1, 'Wants to delete'),
(95, 71, 1, 'approved'),
(96, 72, 1, 'Wants to delete'),
(97, 72, 1, 'Approved'),
(98, 73, 1, 'Wants to delete'),
(99, 73, 1, 'Approved'),
(100, 74, 1, 'Wants to delete'),
(101, 75, 1, 'Wants to delete'),
(102, 74, 1, 'Approved'),
(103, 75, 1, 'Already deleted'),
(104, 76, 1, 'Wants to delete'),
(105, 76, 1, 'Approved'),
(106, 77, 1, 'Wants to delete'),
(107, 77, 1, 'Approved'),
(108, 78, 1, 'Wants to delete'),
(109, 78, 1, 'Approved'),
(110, 79, 1, 'This is a new dispensary built by the courtesy of Robert G. Makoye, a renowned engineer of his generation.This is a new dispensary built by the courtesy of Robert G. Makoye, a renowned engineer of his generation.This is a new dispensary built by the court'),
(111, 79, 1, 'Approved'),
(112, 80, 1, 'New site'),
(113, 80, 1, 'Approved'),
(114, 81, 1, 'Updated'),
(115, 81, 1, 'Approved'),
(116, 82, 1, 'New Site'),
(117, 82, 1, 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `field_mapping`
--

DROP TABLE IF EXISTS `field_mapping`;
CREATE TABLE IF NOT EXISTS `field_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_field_id` varchar(45) DEFAULT NULL,
  `pc_field_id` varchar(45) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `semantics` varchar(50) DEFAULT NULL,
  `cc_field_structure` longtext,
  `pc_field_structure` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='This Table Maps the Fields in the Public Collection to the F' AUTO_INCREMENT=80 ;

--
-- Dumping data for table `field_mapping`
--

INSERT INTO `field_mapping` (`id`, `cc_field_id`, `pc_field_id`, `field_name`, `semantics`, `cc_field_structure`, `pc_field_structure`) VALUES
INSERT INTO `field_mapping` (`id`, `cc_field_id`, `pc_field_id`, `field_name`, `semantics`, `cc_field_structure`, `pc_field_structure`) VALUES
(2, '1815', '1623', 'Common Facility Name', NULL, '{"kind":"text","code":"Comm_FacName","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:24Z","id":1815,"layer_id":465,"metadata":null,"name":"Common Facility Name","ord":1,"updated_at":"2013-10-10T16:07:24Z"}', '{"kind":"text","code":"Comm_FacName","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:00Z","id":1623,"layer_id":423,"metadata":null,"name":"Common Facility Name","ord":1,"updated_at":"2013-08-20T15:11:09Z"}'),
(3, '1839', '1626', 'Ownership Detail / Name', NULL, '{"kind":"text","code":"OwnershipDetail","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:26Z","id":1839,"layer_id":468,"metadata":null,"name":"Ownership Detail / Name","ord":1,"updated_at":"2013-10-10T16:07:26Z"}', '{"kind":"text","code":"OwnershipDetail","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:00Z","id":1626,"layer_id":424,"metadata":null,"name":"Ownership Detail / Name","ord":1,"updated_at":"2013-10-09T15:53:19Z"}'),
(4, '1831', '1630', 'Location Description (e.g. Landmarks)', NULL, '{"kind":"text","code":"Location","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:25Z","id":1831,"layer_id":467,"metadata":null,"name":"Location Description (e.g. Landmarks)","ord":1,"updated_at":"2013-10-10T16:07:25Z"}', '{"kind":"text","code":"Location","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:16Z","id":1630,"layer_id":426,"metadata":null,"name":"Location Description (e.g. Landmarks)","ord":1,"updated_at":"2013-09-04T22:33:10Z"}'),
(5, '1819', '1638', 'Postal Address', NULL, '{"kind":"text","code":"PostalAddress","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:24Z","id":1819,"layer_id":466,"metadata":null,"name":"Postal Address","ord":1,"updated_at":"2013-10-10T16:07:24Z"}', '{"kind":"text","code":"PostalAddress","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:16Z","id":1638,"layer_id":427,"metadata":null,"name":"Postal Address","ord":1,"updated_at":"2013-08-09T21:24:16Z"}'),
(6, '1843', '1649', 'Reception Room', NULL, '{"kind":"numeric","code":"ReceptionRoom","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:27Z","id":1843,"layer_id":469,"metadata":null,"name":"Reception Room","ord":1,"updated_at":"2013-10-10T16:07:27Z"}', '{"kind":"numeric","code":"ReceptionRoom","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:17Z","id":1649,"layer_id":428,"metadata":null,"name":"Reception Room","ord":1,"updated_at":"2013-08-09T21:24:17Z"}'),
(7, '1872', '1675', 'General Clinical Services', NULL, '{"kind":"select_many","code":"ClinicalServices_Gen","collection_id":463,"config":{"options":[{"id":1,"code":"OPD","label":"OPD - Outpatient Services"},{"id":20,"code":"IPD","label":"IPD - Inpatient Services"},{"id":21,"code":"IMCI","label":"IMCI - Integrated Management of Childhood Illness "},{"id":22,"code":"DCT","label":"Diabetes Care and Treatment"},{"id":23,"code":"NCD","label":"NCD - Other Non-Communicable Disease Care and Treatment"},{"id":24,"code":"GOPH","label":"General Ophthalmology "},{"id":25,"code":"PHYS","label":"Physiotherapy"},{"id":26,"code":"NTRHB","label":"Nutritional Rehabilitation"},{"id":27,"code":"NTCNS","label":"Nutritional Counseling"},{"id":29,"code":"MJSI","label":"Major Surgical Interventions"},{"id":30,"code":"MNSI","label":"Minor Surgical Interventions"},{"id":34,"code":"MHS","label":"Mental Health Services"}],"next_id":35},"created_at":"2013-10-10T16:07:30Z","id":1872,"layer_id":470,"metadata":null,"name":"General Clinical Services","ord":1,"updated_at":"2013-10-10T16:07:30Z"}', '{"kind":"select_many","code":"ClinicalServices_Gen","collection_id":409,"config":{"options":[{"id":1,"code":"OPD","label":"OPD - Outpatient Services"},{"id":20,"code":"IPD","label":"IPD - Inpatient Services"},{"id":21,"code":"IMCI","label":"IMCI - Integrated Management of Childhood Illness "},{"id":22,"code":"DCT","label":"Diabetes Care and Treatment"},{"id":23,"code":"NCD","label":"NCD - Other Non-Communicable Disease Care and Treatment"},{"id":24,"code":"GOPH","label":"General Ophthalmology "},{"id":25,"code":"PHYS","label":"Physiotherapy"},{"id":26,"code":"NTRHB","label":"Nutritional Rehabilitation"},{"id":27,"code":"NTCNS","label":"Nutritional Counseling"},{"id":29,"code":"MJSI","label":"Major Surgical Interventions"},{"id":30,"code":"MNSI","label":"Minor Surgical Interventions"},{"id":34,"code":"MHS","label":"Mental Health Services"}],"next_id":35},"created_at":"2013-08-09T21:24:20Z","id":1675,"layer_id":429,"metadata":null,"name":"General Clinical Services","ord":1,"updated_at":"2013-09-06T19:55:05Z"}'),
(8, '1814', '1714', 'Facility Identifier Number', 'PSC', '{"kind":"identifier","code":"Fac_IDNumber","collection_id":463,"config":{"context":"Facility Registry","agency":"Tanzania MOH","format":"Luhn"},"created_at":"2013-10-10T16:07:24Z","id":1814,"layer_id":464,"metadata":null,"name":"Facility Identifier Number","ord":1,"updated_at":"2013-10-10T16:07:24Z"}', '{"kind":"identifier","code":"Fac_IDNumber","collection_id":409,"config":{"context":"Facility Registry","agency":"Tanzania MOH","format":"Luhn"},"created_at":"2013-09-04T15:36:14Z","id":1714,"layer_id":433,"metadata":null,"name":"Facility Identifier Number","ord":1,"updated_at":"2013-09-04T15:36:14Z"}'),
(9, '1832', '1794', 'Waypoint No.', NULL, '{"kind":"text","code":"Waypoint","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:25Z","id":1832,"layer_id":467,"metadata":null,"name":"Waypoint No.","ord":2,"updated_at":"2013-10-10T16:07:25Z"}', '{"kind":"text","code":"Waypoint","collection_id":409,"config":null,"created_at":"2013-10-09T15:47:56Z","id":1794,"layer_id":426,"metadata":null,"name":"Waypoint No.","ord":2,"updated_at":"2013-10-09T15:47:56Z"}'),
(10, '1811', '1624', 'Facility Type', NULL, '{"kind":"hierarchy","code":"Fac_Type","collection_id":463,"config":{"hierarchy":[{"order":"1","id":"DSP","name":"Dispensary"},{"order":"2","id":"HLCTR","name":"Health Center"},{"order":"3","id":"CLNC","name":"Clinic","sub":[{"order":"4","id":"EYE","name":"Eye Clinic"},{"order":"5","id":"DENT","name":"Dental Clinic"},{"order":"6","id":"OTHCLIN","name":"Other Clinic"}]},{"order":"7","id":"NUR_HOME","name":"Nursing Home"},{"order":"8","id":"MAT_HOME","name":"Maternity Home"},{"order":"9","id":"LABS","name":"Health Labs"},{"order":"10","id":"HOSP","name":"Hospital","sub":[{"order":"11","id":"NAT","name":"National Hospital"},{"order":"12","id":"ZNL_SPR_SPEC","name":"Zonal Super Specialist Hospital"},{"order":"13","id":"ZNL_REF","name":"Zonal Referral Hospital"},{"order":"14","id":"SPR_SPEC","name":"Super Specialist Hospital"},{"order":"15","id":"REG_REF","name":"Regional Referral Hospital"},{"order":"16","id":"DES_DIS","name":"Designated District Hospital"},{"order":"17","id":"DIS","name":"District Hospital"},{"order":"18","id":"OTHHOS","name":"Other Hospital"}]}]},"created_at":"2013-10-10T16:07:22Z","id":1811,"layer_id":463,"metadata":null,"name":"Facility Type","ord":2,"updated_at":"2013-10-10T16:07:22Z"}', '{"kind":"hierarchy","code":"Fac_Type","collection_id":409,"config":{"hierarchy":[{"order":"1","id":"DSP","name":"Dispensary"},{"order":"2","id":"HLCTR","name":"Health Center"},{"order":"3","id":"CLNC","name":"Clinic","sub":[{"order":"4","id":"EYE","name":"Eye Clinic"},{"order":"5","id":"DENT","name":"Dental Clinic"},{"order":"6","id":"OTHCLIN","name":"Other Clinic"}]},{"order":"7","id":"NUR_HOME","name":"Nursing Home"},{"order":"8","id":"MAT_HOME","name":"Maternity Home"},{"order":"9","id":"LABS","name":"Health Labs"},{"order":"10","id":"HOSP","name":"Hospital","sub":[{"order":"11","id":"NAT","name":"National Hospital"},{"order":"12","id":"ZNL_SPR_SPEC","name":"Zonal Super Specialist Hospital"},{"order":"13","id":"ZNL_REF","name":"Zonal Referral Hospital"},{"order":"14","id":"SPR_SPEC","name":"Super Specialist Hospital"},{"order":"15","id":"REG_REF","name":"Regional Referral Hospital"},{"order":"16","id":"DES_DIS","name":"Designated District Hospital"},{"order":"17","id":"DIS","name":"District Hospital"},{"order":"18","id":"OTHHOS","name":"Other Hospital"}]}]},"created_at":"2013-08-09T21:24:00Z","id":1624,"layer_id":425,"metadata":null,"name":"Facility Type","ord":2,"updated_at":"2013-10-09T15:34:40Z"}'),
(11, '1812', '1625', 'Ownership', NULL, '{"kind":"hierarchy","code":"Ownership","collection_id":463,"config":{"hierarchy":[{"order":"1","id":"Publ","name":"Public","sub":[{"order":"3","id":"MOHSW","name":"MoHSW"},{"order":"4","id":"Milit","name":"Military"},{"order":"5","id":"Polic","name":"Police"},{"order":"6","id":"Pris","name":"Prisons"},{"order":"7","id":"LGA","name":"LGA"},{"order":"8","id":"Paras","name":"Parastal"},{"order":"9","id":"Oth_MDA","name":"Other MDAs"}]},{"order":"2","id":"Priv","name":"Private","sub":[{"order":"10","id":"Profit","name":"For Profit"},{"order":"11","id":"FBO","name":"Faith based organization (FBO)"},{"order":"12","id":"NGO","name":"NGOs"}]}]},"created_at":"2013-10-10T16:07:22Z","id":1812,"layer_id":463,"metadata":null,"name":"Ownership","ord":2,"updated_at":"2013-10-10T16:07:22Z"}', '{"kind":"hierarchy","code":"Ownership","collection_id":409,"config":{"hierarchy":[{"order":"1","id":"Publ","name":"Public","sub":[{"order":"3","id":"MOHSW","name":"MoHSW"},{"order":"4","id":"Milit","name":"Military"},{"order":"5","id":"Polic","name":"Police"},{"order":"6","id":"Pris","name":"Prisons"},{"order":"7","id":"LGA","name":"LGA"},{"order":"8","id":"Paras","name":"Parastal"},{"order":"9","id":"Oth_MDA","name":"Other MDAs"}]},{"order":"2","id":"Priv","name":"Private","sub":[{"order":"10","id":"Profit","name":"For Profit"},{"order":"11","id":"FBO","name":"Faith based organization (FBO)"},{"order":"12","id":"NGO","name":"NGOs"}]}]},"created_at":"2013-08-09T21:24:00Z","id":1625,"layer_id":425,"metadata":null,"name":"Ownership","ord":2,"updated_at":"2013-10-09T15:32:08Z"}'),
(12, '1840', '1628', 'Registration Status', NULL, '{"kind":"select_one","code":"RegistrationStatus","collection_id":463,"config":{"options":[{"id":2,"code":"Reg","label":"Registered"},{"id":8,"code":"Pend_Reg","label":"Registration Pending Certification"},{"id":9,"code":"Susp_Reg","label":"Registration Suspended"},{"id":10,"code":"Canc_Reg","label":"Registration Cancelled"},{"id":11,"code":"Not_Reg","label":"Not Registered"}],"next_id":12},"created_at":"2013-10-10T16:07:26Z","id":1840,"layer_id":468,"metadata":null,"name":"Registration Status","ord":2,"updated_at":"2013-10-10T16:07:26Z"}', '{"kind":"select_one","code":"RegistrationStatus","collection_id":409,"config":{"options":[{"id":2,"code":"Reg","label":"Registered"},{"id":8,"code":"Pend_Reg","label":"Registration Pending Certification"},{"id":9,"code":"Susp_Reg","label":"Registration Suspended"},{"id":10,"code":"Canc_Reg","label":"Registration Cancelled"},{"id":11,"code":"Not_Reg","label":"Not Registered"}],"next_id":12},"created_at":"2013-08-09T21:24:00Z","id":1628,"layer_id":424,"metadata":null,"name":"Registration Status","ord":2,"updated_at":"2013-10-09T15:55:36Z"}'),
(13, '1820', '1639', 'Postal Code', NULL, '{"kind":"numeric","code":"PostalCode","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:24Z","id":1820,"layer_id":466,"metadata":null,"name":"Postal Code","ord":2,"updated_at":"2013-10-10T16:07:24Z"}', '{"kind":"numeric","code":"PostalCode","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:16Z","id":1639,"layer_id":427,"metadata":null,"name":"Postal Code","ord":2,"updated_at":"2013-08-09T21:24:16Z"}'),
(14, '1844', '1650', 'Consultation Room', NULL, '{"kind":"numeric","code":"ConsultationRoom","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:27Z","id":1844,"layer_id":469,"metadata":null,"name":"Consultation Room","ord":2,"updated_at":"2013-10-10T16:07:27Z"}', '{"kind":"numeric","code":"ConsultationRoom","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:18Z","id":1650,"layer_id":428,"metadata":null,"name":"Consultation Room","ord":2,"updated_at":"2013-08-09T21:24:18Z"}'),
(15, '1873', '1676', 'Malaria Diagnosis and Treatment', NULL, '{"kind":"select_many","code":"ClinicalServices_Malaria","collection_id":463,"config":{"options":[{"id":2,"code":"SM","label":"Slide Microscopy"},{"id":3,"code":"mRDT","label":"mRDT - Rapid Diagnostic Tests"},{"id":4,"code":"FLT","label":"First Line Treatment"},{"id":6,"code":"TCM","label":"Treatment of Complicated Malaria"}],"next_id":7},"created_at":"2013-10-10T16:07:30Z","id":1873,"layer_id":470,"metadata":null,"name":"Malaria Diagnosis and Treatment","ord":2,"updated_at":"2013-10-10T16:07:30Z"}', '{"kind":"select_many","code":"ClinicalServices_Malaria","collection_id":409,"config":{"options":[{"id":2,"code":"SM","label":"Slide Microscopy"},{"id":3,"code":"mRDT","label":"mRDT - Rapid Diagnostic Tests"},{"id":4,"code":"FLT","label":"First Line Treatment"},{"id":6,"code":"TCM","label":"Treatment of Complicated Malaria"}],"next_id":7},"created_at":"2013-08-09T21:24:21Z","id":1676,"layer_id":429,"metadata":null,"name":"Malaria Diagnosis and Treatment","ord":2,"updated_at":"2013-10-10T15:37:08Z"}'),
(16, '1816', '1702', 'Registration ID', NULL, '{"kind":"identifier","code":"Registrar_ID","collection_id":463,"config":{"context":"Historical ID","agency":"MOHSW","format":"Normal"},"created_at":"2013-10-10T16:07:24Z","id":1816,"layer_id":465,"metadata":null,"name":"Registration ID","ord":2,"updated_at":"2013-10-10T16:07:24Z"}', '{"kind":"identifier","code":"Registrar_ID","collection_id":409,"config":{"context":"Historical ID","agency":"MOHSW","format":"Normal"},"created_at":"2013-08-20T15:11:09Z","id":1702,"layer_id":423,"metadata":null,"name":"Registration ID","ord":2,"updated_at":"2013-09-04T22:14:54Z"}'),
(17, '1817', '1622', 'CTC ID', NULL, '{"kind":"identifier","code":"CTC_ID","collection_id":463,"config":{"context":"ID''s a specific location that provides HIV care and treatment","agency":"National AIDS Control Program","format":"Normal"},"created_at":"2013-10-10T16:07:24Z","id":1817,"layer_id":465,"metadata":null,"name":"CTC ID","ord":3,"updated_at":"2013-10-10T16:07:24Z"}', '{"kind":"identifier","code":"CTC_ID","collection_id":409,"config":{"context":"ID''s a specific location that provides HIV care and treatment","agency":"National AIDS Control Program","format":"Normal"},"created_at":"2013-08-09T21:24:00Z","id":1622,"layer_id":423,"metadata":null,"name":"CTC ID","ord":3,"updated_at":"2013-09-04T22:14:54Z"}'),
(18, '1833', '1632', 'Altitude (Meters)', NULL, '{"kind":"numeric","code":"Altitude","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:26Z","id":1833,"layer_id":467,"metadata":null,"name":"Altitude (Meters) ","ord":3,"updated_at":"2013-10-10T16:07:26Z"}', '{"kind":"numeric","code":"Altitude","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:16Z","id":1632,"layer_id":426,"metadata":null,"name":"Altitude (Meters) ","ord":3,"updated_at":"2013-10-09T15:47:56Z"}'),
(19, '1822', '1640', 'Official Phone Number', NULL, '{"kind":"phone","code":"OfficialPhone","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:25Z","id":1822,"layer_id":466,"metadata":null,"name":"Official Phone Number","ord":3,"updated_at":"2013-10-10T21:03:44Z"}', '{"kind":"phone","code":"OfficialPhone","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:17Z","id":1640,"layer_id":427,"metadata":null,"name":"Official Phone Number","ord":3,"updated_at":"2013-10-10T21:06:04Z"}'),
(20, '1845', '1651', 'Dressing Room', NULL, '{"kind":"numeric","code":"DressingRoom","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:27Z","id":1845,"layer_id":469,"metadata":null,"name":"Dressing Room","ord":3,"updated_at":"2013-10-10T16:07:27Z"}', '{"kind":"numeric","code":"DressingRoom","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:18Z","id":1651,"layer_id":428,"metadata":null,"name":"Dressing Room","ord":3,"updated_at":"2013-08-09T21:24:18Z"}'),
(21, '1874', '1677', 'TB Diagnosis, Care and Treatment', NULL, '{"kind":"select_many","code":"ClinicalServices_TB","collection_id":463,"config":{"options":[{"id":2,"code":"SM","label":"Smear Microscopy"},{"id":3,"code":"TC","label":"Tuberculosis Culture"},{"id":4,"code":"XRY","label":"X-Ray"},{"id":6,"code":"FLT","label":"First Line Treatment"},{"id":7,"code":"MDR","label":"MDRTB Treatment"}],"next_id":8},"created_at":"2013-10-10T16:07:30Z","id":1874,"layer_id":470,"metadata":null,"name":"TB Diagnosis, Care and Treatment","ord":3,"updated_at":"2013-10-10T16:07:30Z"}', '{"kind":"select_many","code":"ClinicalServices_TB","collection_id":409,"config":{"options":[{"id":2,"code":"SM","label":"Smear Microscopy"},{"id":3,"code":"TC","label":"Tuberculosis Culture"},{"id":4,"code":"XRY","label":"X-Ray"},{"id":6,"code":"FLT","label":"First Line Treatment"},{"id":7,"code":"MDR","label":"MDRTB Treatment"}],"next_id":8},"created_at":"2013-08-09T21:24:21Z","id":1677,"layer_id":429,"metadata":null,"name":"TB Diagnosis, Care and Treatment","ord":3,"updated_at":"2013-10-10T15:37:08Z"}'),
(22, '1841', '1715', 'Licensing Status', NULL, '{"kind":"select_one","code":"LicensingStatus","collection_id":463,"config":{"options":[{"id":1,"code":"Pend_Lic","label":"Pending Licensing"},{"id":2,"code":"Lic","label":"Licensed"},{"id":3,"code":"Susp_Lic","label":"Suspended License"},{"id":4,"code":"Canc_Lic","label":"Cancelled License"}],"next_id":5},"created_at":"2013-10-10T16:07:26Z","id":1841,"layer_id":468,"metadata":null,"name":"Licensing Status","ord":3,"updated_at":"2013-10-10T16:07:26Z"}', '{"kind":"select_one","code":"LicensingStatus","collection_id":409,"config":{"options":[{"id":1,"code":"Pend_Lic","label":"Pending Licensing"},{"id":2,"code":"Lic","label":"Licensed"},{"id":3,"code":"Susp_Lic","label":"Suspended License"},{"id":4,"code":"Canc_Lic","label":"Cancelled License"}],"next_id":5},"created_at":"2013-09-04T22:54:04Z","id":1715,"layer_id":424,"metadata":null,"name":"Licensing Status","ord":3,"updated_at":"2013-10-09T15:53:19Z"}'),
(23, '1842', '1795', 'Other Clinic (Please Specify)', NULL, '{"kind":"text","code":"OtherClin_Specify","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:26Z","id":1842,"layer_id":468,"metadata":null,"name":"Other Clinic (Please Specify)","ord":4,"updated_at":"2013-10-10T16:07:26Z"}', '{"kind":"text","code":"OtherClin_Specify","collection_id":409,"config":null,"created_at":"2013-10-09T15:52:38Z","id":1795,"layer_id":424,"metadata":null,"name":"Other Clinic (Please Specify)","ord":4,"updated_at":"2013-10-10T13:41:43Z"}'),
(24, '1889', '1620', 'Old HFR ID', NULL, '{"kind":"identifier","code":"OldHFR_ID","collection_id":463,"config":{"context":"Historical ID","agency":"Tanzania MOHSW","format":"Normal"},"created_at":"2013-10-10T16:07:32Z","id":1889,"layer_id":471,"metadata":null,"name":"Old HFR ID","ord":4,"updated_at":"2013-10-10T16:07:32Z"}', '{"kind":"identifier","code":"OldHFR_ID","collection_id":409,"config":{"context":"Historical ID","agency":"Tanzania MOHSW","format":"Normal"},"created_at":"2013-08-09T21:24:00Z","id":1620,"layer_id":461,"metadata":null,"name":"Old HFR ID","ord":4,"updated_at":"2013-10-10T16:04:27Z"}'),
(25, '1818', '1621', 'MTUHA Code', NULL, '{"kind":"identifier","code":"MTUHA","collection_id":463,"config":{"context":"An ID to identify a facility within a district ","agency":"HMIS Team - MSIMBO","format":"Normal"},"created_at":"2013-10-10T16:07:24Z","id":1818,"layer_id":465,"metadata":null,"name":"MTUHA Code","ord":4,"updated_at":"2013-10-10T16:07:24Z"}', '{"kind":"identifier","code":"MTUHA","collection_id":409,"config":{"context":"An ID to identify a facility within a district ","agency":"HMIS Team - MSIMBO","format":"Normal"},"created_at":"2013-08-09T21:24:00Z","id":1621,"layer_id":423,"metadata":null,"name":"MTUHA Code","ord":4,"updated_at":"2013-10-09T15:37:44Z"}'),
(26, '1813', '1627', 'Operating Status', NULL, '{"kind":"select_one","code":"OperatingStatus","collection_id":463,"config":{"options":[{"id":1,"code":"Opert","label":"Operating"},{"id":2,"code":"Pend_UC","label":"Pending Operation - Under Construction"},{"id":3,"code":"Pend_CC","label":"Pending Operation - Construction Complete"},{"id":4,"code":"Clos_Temp","label":"Closed (Temporary)"},{"id":5,"code":"Clos","label":"Closed"}],"next_id":7},"created_at":"2013-10-10T16:07:22Z","id":1813,"layer_id":463,"metadata":null,"name":"Operating Status","ord":4,"updated_at":"2013-10-10T16:07:22Z"}', '{"kind":"select_one","code":"OperatingStatus","collection_id":409,"config":{"options":[{"id":1,"code":"Opert","label":"Operating"},{"id":2,"code":"Pend_UC","label":"Pending Operation - Under Construction"},{"id":3,"code":"Pend_CC","label":"Pending Operation - Construction Complete"},{"id":4,"code":"Clos_Temp","label":"Closed (Temporary)"},{"id":5,"code":"Clos","label":"Closed"}],"next_id":7},"created_at":"2013-08-09T21:24:00Z","id":1627,"layer_id":425,"metadata":null,"name":"Operating Status","ord":4,"updated_at":"2013-10-09T15:32:50Z"}'),
(27, '1834', '1633', 'Service Areas (Villages) ', NULL, '{"kind":"text","code":"ServiceArea","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:26Z","id":1834,"layer_id":467,"metadata":null,"name":"Service Areas (Villages) ","ord":4,"updated_at":"2013-10-10T16:07:26Z"}', '{"kind":"text","code":"ServiceArea","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:16Z","id":1633,"layer_id":426,"metadata":null,"name":"Service Areas (Villages) ","ord":4,"updated_at":"2013-10-09T15:47:56Z"}'),
(28, '1823', '1641', 'Official Fax', NULL, '{"kind":"phone","code":"OfficialFax","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:25Z","id":1823,"layer_id":466,"metadata":null,"name":"Official Fax","ord":4,"updated_at":"2013-10-10T21:03:44Z"}', '{"kind":"phone","code":"OfficialFax","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:17Z","id":1641,"layer_id":427,"metadata":null,"name":"Official Fax","ord":4,"updated_at":"2013-10-10T21:06:04Z"}'),
(30, '1875', '1678', 'Cardiovascular Care and Treatment', NULL, '{"kind":"select_many","code":"ClinicalServices_Cariovasc","collection_id":463,"config":{"options":[{"id":2,"code":"ECG","label":"ECG"},{"id":4,"code":"ECH","label":"ECHO"}],"next_id":5},"created_at":"2013-10-10T16:07:30Z","id":1875,"layer_id":470,"metadata":null,"name":"Cardiovascular Care and Treatment","ord":4,"updated_at":"2013-10-10T16:07:30Z"}', '{"kind":"select_many","code":"ClinicalServices_Cariovasc","collection_id":409,"config":{"options":[{"id":2,"code":"ECG","label":"ECG"},{"id":4,"code":"ECH","label":"ECHO"}],"next_id":5},"created_at":"2013-08-09T21:24:21Z","id":1678,"layer_id":429,"metadata":null,"name":"Cardiovascular Care and Treatment","ord":4,"updated_at":"2013-10-10T15:37:08Z"}'),
(31, '1835', '1635', 'Service Area Population', NULL, '{"kind":"numeric","code":"ServicePop","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:26Z","id":1835,"layer_id":467,"metadata":null,"name":"Service Area Population","ord":5,"updated_at":"2013-10-10T16:07:26Z"}', '{"kind":"numeric","code":"ServicePop","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:16Z","id":1635,"layer_id":426,"metadata":null,"name":"Service Area Population","ord":5,"updated_at":"2013-10-09T15:47:56Z"}'),
(32, '1824', '1642', 'Official Email', NULL, '{"kind":"email","code":"OfficialEmail","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:25Z","id":1824,"layer_id":466,"metadata":null,"name":"Official Email","ord":5,"updated_at":"2013-10-10T21:03:44Z"}', '{"kind":"email","code":"OfficialEmail","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:17Z","id":1642,"layer_id":427,"metadata":null,"name":"Official Email","ord":5,"updated_at":"2013-10-10T21:06:04Z"}'),
(33, '1847', '1653', 'Ward Room', NULL, '{"kind":"numeric","code":"WardRoom","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:27Z","id":1847,"layer_id":469,"metadata":null,"name":"Ward Room","ord":5,"updated_at":"2013-10-10T16:07:27Z"}', '{"kind":"numeric","code":"WardRoom","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:18Z","id":1653,"layer_id":428,"metadata":null,"name":"Ward Room","ord":5,"updated_at":"2013-08-09T21:24:18Z"}'),
(34, '1876', '1679', 'HIV/AIDS Prevention', NULL, '{"kind":"select_many","code":"ClinicalServices_HIVPrevent","collection_id":463,"config":{"options":[{"id":2,"code":"mSTI","label":"STI - Management of Sexually Transmitted Illness"},{"id":3,"code":"VCT","label":"VCT - Voluntary Counseling and Testing"},{"id":4,"code":"PITC","label":"PITC - Provider Initiated Testing And Counseling"},{"id":5,"code":"DCT","label":"DCT - Diagnostic Counseling and Testing"},{"id":6,"code":"EID","label":"EID - Early Infant Diagnosis"},{"id":7,"code":"PMTCTA","label":"PMTCT - ANC (ANC PMTCT)"},{"id":8,"code":"PMTCTM","label":"PMTCT - Maternity (MAT PMTCT)"},{"id":9,"code":"VMMC","label":"VMMC - Voluntary Medical Male Circumcision Services"},{"id":11,"code":"PEP","label":"PEP - Post Exposure Prophylaxis"}],"next_id":12},"created_at":"2013-10-10T16:07:30Z","id":1876,"layer_id":470,"metadata":null,"name":"HIV/AIDS Prevention","ord":5,"updated_at":"2013-10-10T16:07:30Z"}', '{"kind":"select_many","code":"ClinicalServices_HIVPrevent","collection_id":409,"config":{"options":[{"id":2,"code":"mSTI","label":"STI - Management of Sexually Transmitted Illness"},{"id":3,"code":"VCT","label":"VCT - Voluntary Counseling and Testing"},{"id":4,"code":"PITC","label":"PITC - Provider Initiated Testing And Counseling"},{"id":5,"code":"DCT","label":"DCT - Diagnostic Counseling and Testing"},{"id":6,"code":"EID","label":"EID - Early Infant Diagnosis"},{"id":7,"code":"PMTCTA","label":"PMTCT - ANC (ANC PMTCT)"},{"id":8,"code":"PMTCTM","label":"PMTCT - Maternity (MAT PMTCT)"},{"id":9,"code":"VMMC","label":"VMMC - Voluntary Medical Male Circumcision Services"},{"id":11,"code":"PEP","label":"PEP - Post Exposure Prophylaxis"}],"next_id":12},"created_at":"2013-08-09T21:24:21Z","id":1679,"layer_id":429,"metadata":null,"name":"HIV/AIDS Prevention","ord":5,"updated_at":"2013-10-10T15:37:08Z"}'),
(35, '1848', '1807', 'Observation Room', NULL, '{"kind":"numeric","code":"ObservationRoom","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:27Z","id":1848,"layer_id":469,"metadata":null,"name":"Observation Room","ord":6,"updated_at":"2013-10-10T16:07:27Z"}', '{"kind":"numeric","code":"ObservationRoom","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T14:44:54Z","id":1807,"layer_id":428,"metadata":null,"name":"Observation Room","ord":6,"updated_at":"2013-10-10T14:44:54Z"}'),
(36, '1836', '1634', 'Catchment Area (Villages)', NULL, '{"kind":"text","code":"CatchmentArea","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:26Z","id":1836,"layer_id":467,"metadata":null,"name":"Catchment Area (Villages)","ord":6,"updated_at":"2013-10-10T16:07:26Z"}', '{"kind":"text","code":"CatchmentArea","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:16Z","id":1634,"layer_id":426,"metadata":null,"name":"Catchment Area (Villages)","ord":6,"updated_at":"2013-10-09T15:47:56Z"}'),
(38, '1877', '1680', 'HIV/AIDS Care and Treatment', NULL, '{"kind":"select_many","code":"ClinicalServices_HIVTreat","collection_id":463,"config":{"options":[{"id":1,"code":"HIVTRTGEN","label":"HIV/AIDS Care and Treatment"},{"id":2,"code":"pART","label":"Ped ART - Pediatric ART Only"},{"id":3,"code":"AART","label":"Adult ART - Adult ART Only"},{"id":4,"code":"BOTH","label":"Both Adult and Pediatric"},{"id":12,"code":"HBC","label":"HBC - Home and Community Based Care "}],"next_id":13},"created_at":"2013-10-10T16:07:30Z","id":1877,"layer_id":470,"metadata":null,"name":"HIV/AIDS Care and Treatment","ord":6,"updated_at":"2013-10-10T16:07:30Z"}', '{"kind":"select_many","code":"ClinicalServices_HIVTreat","collection_id":409,"config":{"options":[{"id":1,"code":"HIVTRTGEN","label":"HIV/AIDS Care and Treatment"},{"id":2,"code":"pART","label":"Ped ART - Pediatric ART Only"},{"id":3,"code":"AART","label":"Adult ART - Adult ART Only"},{"id":4,"code":"BOTH","label":"Both Adult and Pediatric"},{"id":12,"code":"HBC","label":"HBC - Home and Community Based Care "}],"next_id":13},"created_at":"2013-08-09T21:24:21Z","id":1680,"layer_id":429,"metadata":null,"name":"HIV/AIDS Care and Treatment","ord":6,"updated_at":"2013-09-06T20:11:27Z"}'),
(39, '1837', '1636', 'Catchment Population', NULL, '{"kind":"numeric","code":"CatchmentPop","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:26Z","id":1837,"layer_id":467,"metadata":null,"name":"Catchment Population","ord":7,"updated_at":"2013-10-10T16:07:26Z"}', '{"kind":"numeric","code":"CatchmentPop","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:16Z","id":1636,"layer_id":426,"metadata":null,"name":"Catchment Population","ord":7,"updated_at":"2013-10-09T15:47:56Z"}'),
(40, '1826', '1644', 'Facility In-Charge: Name', NULL, '{"kind":"text","code":"InCharge_Name","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:25Z","id":1826,"layer_id":466,"metadata":null,"name":"Facility In-Charge: Name","ord":7,"updated_at":"2013-10-10T21:03:44Z"}', '{"kind":"text","code":"InCharge_Name","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:17Z","id":1644,"layer_id":427,"metadata":null,"name":"Facility In-Charge: Name","ord":7,"updated_at":"2013-10-10T21:06:04Z"}'),
(41, '1849', '1654', 'Remarks', NULL, '{"kind":"text","code":"RoomRemarks","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:27Z","id":1849,"layer_id":469,"metadata":null,"name":"Remarks","ord":7,"updated_at":"2013-10-10T16:07:27Z"}', '{"kind":"text","code":"RoomRemarks","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:18Z","id":1654,"layer_id":428,"metadata":null,"name":"Remarks","ord":7,"updated_at":"2013-10-10T14:44:54Z"}'),
(42, '1878', '1681', 'Therapeutics', NULL, '{"kind":"select_many","code":"Services_Therapeutics","collection_id":463,"config":{"options":[{"id":2,"code":"PHAR","label":"Pharmacy"},{"id":3,"code":"DSRM","label":"Dispensing Room"}],"next_id":4},"created_at":"2013-10-10T16:07:30Z","id":1878,"layer_id":470,"metadata":null,"name":"Therapeutics","ord":7,"updated_at":"2013-10-10T16:07:30Z"}', '{"kind":"select_many","code":"Services_Therapeutics","collection_id":409,"config":{"options":[{"id":2,"code":"PHAR","label":"Pharmacy"},{"id":3,"code":"DSRM","label":"Dispensing Room"}],"next_id":4},"created_at":"2013-08-09T21:24:21Z","id":1681,"layer_id":429,"metadata":null,"name":"Therapeutics","ord":7,"updated_at":"2013-09-06T17:21:55Z"}'),
(43, '1838', '1637', 'Date Opened (dd/mm/yyyy)', NULL, '{"kind":"date","code":"DateOpened","collection_id":463,"config":{"format":"dd_mm_yyyy"},"created_at":"2013-10-10T16:07:26Z","id":1838,"layer_id":467,"metadata":null,"name":"Date Opened (dd/mm/yyyy)","ord":8,"updated_at":"2013-10-10T16:07:26Z"}', '{"kind":"date","code":"DateOpened","collection_id":409,"config":{"format":"dd_mm_yyyy"},"created_at":"2013-08-09T21:24:16Z","id":1637,"layer_id":426,"metadata":null,"name":"Date Opened (dd/mm/yyyy)","ord":8,"updated_at":"2013-10-09T15:47:56Z"}'),
(44, '1827', '1645', 'Facility In-Charge: Cadre', NULL, '{"kind":"text","code":"InCharge_Cadre","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:25Z","id":1827,"layer_id":466,"metadata":null,"name":"Facility In-Charge: Cadre","ord":8,"updated_at":"2013-10-10T21:03:44Z"}', '{"kind":"text","code":"InCharge_Cadre","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:17Z","id":1645,"layer_id":427,"metadata":null,"name":"Facility In-Charge: Cadre","ord":8,"updated_at":"2013-10-10T21:06:04Z"}'),
(45, '1850', '1655', 'Patient Beds', NULL, '{"kind":"numeric","code":"PatientBeds","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:27Z","id":1850,"layer_id":469,"metadata":null,"name":"Patient Beds","ord":8,"updated_at":"2013-10-10T16:07:27Z"}', '{"kind":"numeric","code":"PatientBeds","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:18Z","id":1655,"layer_id":428,"metadata":null,"name":"Patient Beds","ord":8,"updated_at":"2013-10-10T14:44:54Z"}'),
(46, '1879', '1682', 'Prosthetics and Medical Devices', NULL, '{"kind":"select_many","code":"Services_Prosthetics","collection_id":463,"config":{"options":[{"id":1,"code":"PRO","label":"Prosthetics (e.g., Miguu / Mikono Bandia)"},{"id":2,"code":"OTH","label":"Other Medical Devices (e.g., Neck Collar) "}],"next_id":3},"created_at":"2013-10-10T16:07:30Z","id":1879,"layer_id":470,"metadata":null,"name":"Prosthetics and Medical Devices","ord":8,"updated_at":"2013-10-10T16:07:30Z"}', '{"kind":"select_many","code":"Services_Prosthetics","collection_id":409,"config":{"options":[{"id":1,"code":"PRO","label":"Prosthetics (e.g., Miguu / Mikono Bandia)"},{"id":2,"code":"OTH","label":"Other Medical Devices (e.g., Neck Collar) "}],"next_id":3},"created_at":"2013-08-09T21:24:21Z","id":1682,"layer_id":429,"metadata":null,"name":"Prosthetics and Medical Devices","ord":8,"updated_at":"2013-09-06T17:21:55Z"}'),
(47, '1828', '1646', 'Facility In-Charge: Email', NULL, '{"kind":"email","code":"InCharge_Email","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:25Z","id":1828,"layer_id":466,"metadata":null,"name":"Facility In-Charge: Email","ord":9,"updated_at":"2013-10-10T21:03:44Z"}', '{"kind":"email","code":"InCharge_Email","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:17Z","id":1646,"layer_id":427,"metadata":null,"name":"Facility In-Charge: Email","ord":9,"updated_at":"2013-10-10T21:06:04Z"}'),
(48, '1851', '1656', 'Delivery Beds', NULL, '{"kind":"numeric","code":"DeliveryBeds","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:27Z","id":1851,"layer_id":469,"metadata":null,"name":"Delivery Beds","ord":9,"updated_at":"2013-10-10T16:07:27Z"}', '{"kind":"numeric","code":"DeliveryBeds","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:18Z","id":1656,"layer_id":428,"metadata":null,"name":"Delivery Beds","ord":9,"updated_at":"2013-10-10T14:44:54Z"}'),
(49, '1880', '1683', 'Health Promotion and Disease Prevention', NULL, '{"kind":"select_many","code":"Services_HealthPromo","collection_id":463,"config":{"options":[{"id":5,"code":"EPI","label":"Epidemiological Surveillance and Response"},{"id":7,"code":"CM","label":"Community Mobilization"},{"id":8,"code":"SHI","label":"School Health Intervention"},{"id":9,"code":"PSY","label":"Psychosocial Support"}],"next_id":10},"created_at":"2013-10-10T16:07:30Z","id":1880,"layer_id":470,"metadata":null,"name":"Health Promotion and Disease Prevention","ord":9,"updated_at":"2013-10-10T16:07:30Z"}', '{"kind":"select_many","code":"Services_HealthPromo","collection_id":409,"config":{"options":[{"id":5,"code":"EPI","label":"Epidemiological Surveillance and Response"},{"id":7,"code":"CM","label":"Community Mobilization"},{"id":8,"code":"SHI","label":"School Health Intervention"},{"id":9,"code":"PSY","label":"Psychosocial Support"}],"next_id":10},"created_at":"2013-08-09T21:24:21Z","id":1683,"layer_id":429,"metadata":null,"name":"Health Promotion and Disease Prevention","ord":9,"updated_at":"2013-09-06T17:21:55Z"}'),
(50, '1852', '1657', 'Baby Cots', NULL, '{"kind":"numeric","code":"BabyCots","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:27Z","id":1852,"layer_id":469,"metadata":null,"name":"Baby Cots","ord":10,"updated_at":"2013-10-10T16:07:27Z"}', '{"kind":"numeric","code":"BabyCots","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:18Z","id":1657,"layer_id":428,"metadata":null,"name":"Baby Cots","ord":10,"updated_at":"2013-10-10T14:44:54Z"}'),
(51, '1881', '1684', 'Diagnostic Services', NULL, '{"kind":"select_many","code":"Services_Diagnostic","collection_id":463,"config":{"options":[{"id":1,"code":"LABGEN","label":"Laboratory"},{"id":2,"code":"LP","label":"Lab: Parasitology"},{"id":4,"code":"LM","label":"Lab: Microbiology"},{"id":5,"code":"LCC","label":"Lab: Clinical Chemistry"},{"id":8,"code":"LIS","label":"Lab: Immunology and Serology"},{"id":9,"code":"LHM","label":"Lab: Hematology "},{"id":10,"code":"LBT","label":"Lab: Blood Transfusion"},{"id":11,"code":"LPATHGEN","label":"Lab: Pathology"},{"id":12,"code":"LPH","label":"Lab: Pathology Histopathology (Tissue Diagnosis) "},{"id":13,"code":"LPC","label":"Lab: Pathology Cytology"},{"id":14,"code":"RADGEN","label":"Radiology Services"},{"id":16,"code":"RXY","label":"Radiology Services: X-Ray"},{"id":17,"code":"RUL","label":"Radiology Services: Ultrasound"},{"id":18,"code":"RCT","label":"Radiology Services: CT-Scan"},{"id":19,"code":"RMRI","label":"Radiology Services: MRI"}],"next_id":20},"created_at":"2013-10-10T16:07:31Z","id":1881,"layer_id":470,"metadata":null,"name":"Diagnostic Services","ord":10,"updated_at":"2013-10-10T16:07:31Z"}', '{"kind":"select_many","code":"Services_Diagnostic","collection_id":409,"config":{"options":[{"id":1,"code":"LABGEN","label":"Laboratory"},{"id":2,"code":"LP","label":"Lab: Parasitology"},{"id":4,"code":"LM","label":"Lab: Microbiology"},{"id":5,"code":"LCC","label":"Lab: Clinical Chemistry"},{"id":8,"code":"LIS","label":"Lab: Immunology and Serology"},{"id":9,"code":"LHM","label":"Lab: Hematology "},{"id":10,"code":"LBT","label":"Lab: Blood Transfusion"},{"id":11,"code":"LPATHGEN","label":"Lab: Pathology"},{"id":12,"code":"LPH","label":"Lab: Pathology Histopathology (Tissue Diagnosis) "},{"id":13,"code":"LPC","label":"Lab: Pathology Cytology"},{"id":14,"code":"RADGEN","label":"Radiology Services"},{"id":16,"code":"RXY","label":"Radiology Services: X-Ray"},{"id":17,"code":"RUL","label":"Radiology Services: Ultrasound"},{"id":18,"code":"RCT","label":"Radiology Services: CT-Scan"},{"id":19,"code":"RMRI","label":"Radiology Services: MRI"}],"next_id":20},"created_at":"2013-08-09T21:24:21Z","id":1684,"layer_id":429,"metadata":null,"name":"Diagnostic Services","ord":10,"updated_at":"2013-09-06T17:21:55Z"}'),
(52, '1829', '1716', 'Facility In-Charge: NID #', NULL, '{"kind":"text","code":"InCharge_NID","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:25Z","id":1829,"layer_id":466,"metadata":null,"name":"Facility In-Charge: NID #","ord":10,"updated_at":"2013-10-10T21:03:44Z"}', '{"kind":"text","code":"InCharge_NID","collection_id":409,"config":null,"created_at":"2013-09-05T19:32:55Z","id":1716,"layer_id":427,"metadata":null,"name":"Facility In-Charge: NID #","ord":10,"updated_at":"2013-10-10T21:06:04Z"}'),
(53, '1830', '1648', 'Facility In-Charge: Mobile Phone #', NULL, '{"kind":"phone","code":"InCharge_Mobile","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:25Z","id":1830,"layer_id":466,"metadata":null,"name":"Facility In-Charge: Mobile Phone #","ord":11,"updated_at":"2013-10-10T21:03:44Z"}', '{"kind":"phone","code":"InCharge_Mobile","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:17Z","id":1648,"layer_id":427,"metadata":null,"name":"Facility In-Charge: Mobile Phone #","ord":11,"updated_at":"2013-10-10T21:06:04Z"}'),
(54, '1853', '1659', 'Ambulances', NULL, '{"kind":"numeric","code":"Ambulances","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:27Z","id":1853,"layer_id":469,"metadata":null,"name":"Ambulances","ord":11,"updated_at":"2013-10-10T16:07:27Z"}', '{"kind":"numeric","code":"Ambulances","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:18Z","id":1659,"layer_id":428,"metadata":null,"name":"Ambulances","ord":11,"updated_at":"2013-10-10T14:44:54Z"}'),
(55, '1882', '1685', 'Reproductive and Child Health Care Services', NULL, '{"kind":"select_many","code":"Services_Reprod&ChildHealth","collection_id":463,"config":{"options":[{"id":1,"code":"FP","label":"Family Planning"},{"id":2,"code":"FPNI","label":"Family Planning: Non Invasive Method (FP-NON INV)"},{"id":3,"code":"FPI","label":"Family Planning: Invasive Method (FP-INV)"},{"id":5,"code":"FPE","label":"Family Planning: Emergency Contraception"},{"id":18,"code":"ANC","label":"Antenatal Care"},{"id":19,"code":"PNC","label":"Postnatal Care"},{"id":20,"code":"ARHS","label":"Adolescent Reproductive Health Services"},{"id":21,"code":"BEmOC","label":"BEmOC - Basic Emergency Obstetric Care"},{"id":22,"code":"CEmOC","label":"CEmOC - Comprehensive Emergency Obstetric Care"},{"id":23,"code":"PAC","label":"Post-Abortion Care"},{"id":24,"code":"NBC","label":"Newborn Care"},{"id":25,"code":"MHPP","label":"Management of Hypertensive Pregnancies (Pre-eclampsia)"},{"id":26,"code":"RCSMGEN","label":"Reproductive Cancer Screening and Management"},{"id":27,"code":"CVC","label":"Cervical Cancer"},{"id":28,"code":"BSTC","label":"Breast Cancer"},{"id":29,"code":"GBV","label":"GBV Trauma Counseling"},{"id":30,"code":"VAC","label":"VAC Trauma Counseling"},{"id":31,"code":"GBVP","label":"GBV PEP"},{"id":32,"code":"VACP","label":"VAC PEP"}],"next_id":33},"created_at":"2013-10-10T16:07:31Z","id":1882,"layer_id":470,"metadata":null,"name":"Reproductive and Child Health Care Services","ord":11,"updated_at":"2013-10-10T16:07:31Z"}', '{"kind":"select_many","code":"Services_Reprod&ChildHealth","collection_id":409,"config":{"options":[{"id":1,"code":"FP","label":"Family Planning"},{"id":2,"code":"FPNI","label":"Family Planning: Non Invasive Method (FP-NON INV)"},{"id":3,"code":"FPI","label":"Family Planning: Invasive Method (FP-INV)"},{"id":5,"code":"FPE","label":"Family Planning: Emergency Contraception"},{"id":18,"code":"ANC","label":"Antenatal Care"},{"id":19,"code":"PNC","label":"Postnatal Care"},{"id":20,"code":"ARHS","label":"Adolescent Reproductive Health Services"},{"id":21,"code":"BEmOC","label":"BEmOC - Basic Emergency Obstetric Care"},{"id":22,"code":"CEmOC","label":"CEmOC - Comprehensive Emergency Obstetric Care"},{"id":23,"code":"PAC","label":"Post-Abortion Care"},{"id":24,"code":"NBC","label":"Newborn Care"},{"id":25,"code":"MHPP","label":"Management of Hypertensive Pregnancies (Pre-eclampsia)"},{"id":26,"code":"RCSMGEN","label":"Reproductive Cancer Screening and Management"},{"id":27,"code":"CVC","label":"Cervical Cancer"},{"id":28,"code":"BSTC","label":"Breast Cancer"},{"id":29,"code":"GBV","label":"GBV Trauma Counseling"},{"id":30,"code":"VAC","label":"VAC Trauma Counseling"},{"id":31,"code":"GBVP","label":"GBV PEP"},{"id":32,"code":"VACP","label":"VAC PEP"}],"next_id":33},"created_at":"2013-08-09T21:24:22Z","id":1685,"layer_id":429,"metadata":null,"name":"Reproductive and Child Health Care Services","ord":11,"updated_at":"2013-09-06T19:55:05Z"}'),
(56, '1854', '1658', 'Cars', NULL, '{"kind":"numeric","code":"Cars","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:28Z","id":1854,"layer_id":469,"metadata":null,"name":"Cars","ord":12,"updated_at":"2013-10-10T16:07:28Z"}', '{"kind":"numeric","code":"Cars","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:18Z","id":1658,"layer_id":428,"metadata":null,"name":"Cars","ord":12,"updated_at":"2013-10-10T14:44:54Z"}'),
(57, '1883', '1686', 'Growth Monitoring / Nutrition Surveillance', NULL, '{"kind":"select_many","code":"Services_Nutrition","collection_id":463,"config":{"options":[{"id":1,"code":"VACGEN","label":"Vaccination"},{"id":2,"code":"BI","label":"IMM-BASIC - Basic Immunization"},{"id":3,"code":"ADDV","label":"IMM-ADD - With Addition Vaccine"},{"id":4,"code":"PORT","label":"PORT - Port Immunization Services"}],"next_id":6},"created_at":"2013-10-10T16:07:31Z","id":1883,"layer_id":470,"metadata":null,"name":"Growth Monitoring / Nutrition Surveillance","ord":12,"updated_at":"2013-10-10T16:07:31Z"}', '{"kind":"select_many","code":"Services_Nutrition","collection_id":409,"config":{"options":[{"id":1,"code":"VACGEN","label":"Vaccination"},{"id":2,"code":"BI","label":"IMM-BASIC - Basic Immunization"},{"id":3,"code":"ADDV","label":"IMM-ADD - With Addition Vaccine"},{"id":4,"code":"PORT","label":"PORT - Port Immunization Services"}],"next_id":6},"created_at":"2013-08-09T21:24:22Z","id":1686,"layer_id":429,"metadata":null,"name":"Growth Monitoring / Nutrition Surveillance","ord":12,"updated_at":"2013-09-06T20:02:04Z"}'),
(58, '1855', '1660', 'Motorcycles', NULL, '{"kind":"numeric","code":"Motorcycles","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:28Z","id":1855,"layer_id":469,"metadata":null,"name":"Motorcycles","ord":13,"updated_at":"2013-10-10T16:07:28Z"}', '{"kind":"numeric","code":"Motorcycles","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:18Z","id":1660,"layer_id":428,"metadata":null,"name":"Motorcycles","ord":13,"updated_at":"2013-10-10T14:44:54Z"}'),
(59, '1884', '1687', 'Oral Health Service (Dental Services)', NULL, '{"kind":"select_many","code":"Services_Dental","collection_id":463,"config":{"options":[{"id":1,"code":"DLS","label":"Dental Laboratory Services (Prosthesis)"},{"id":3,"code":"EDS","label":"Emergency Dental Services"},{"id":4,"code":"REST","label":"Restoration"},{"id":5,"code":"SCA","label":"Scaling"},{"id":6,"code":"SGI","label":"Surgical Intervetion"}],"next_id":7},"created_at":"2013-10-10T16:07:31Z","id":1884,"layer_id":470,"metadata":null,"name":"Oral Health Service (Dental Services)","ord":13,"updated_at":"2013-10-10T16:07:31Z"}', '{"kind":"select_many","code":"Services_Dental","collection_id":409,"config":{"options":[{"id":1,"code":"DLS","label":"Dental Laboratory Services (Prosthesis)"},{"id":3,"code":"EDS","label":"Emergency Dental Services"},{"id":4,"code":"REST","label":"Restoration"},{"id":5,"code":"SCA","label":"Scaling"},{"id":6,"code":"SGI","label":"Surgical Intervetion"}],"next_id":7},"created_at":"2013-08-09T21:24:22Z","id":1687,"layer_id":429,"metadata":null,"name":"Oral Health Service (Dental Services)","ord":13,"updated_at":"2013-08-09T21:24:22Z"}'),
(60, '1856', '1661', 'Specify, Other Transport', NULL, '{"kind":"text","code":"OtherTransport","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:28Z","id":1856,"layer_id":469,"metadata":null,"name":"Specify, Other Transport","ord":14,"updated_at":"2013-10-10T16:07:28Z"}', '{"kind":"text","code":"OtherTransport","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:18Z","id":1661,"layer_id":428,"metadata":null,"name":"Specify, Other Transport","ord":14,"updated_at":"2013-10-10T14:44:54Z"}'),
(61, '1885', '1717', 'ENT Services', NULL, '{"kind":"select_many","code":"ENT","collection_id":463,"config":{"options":[{"id":1,"code":"ENT","label":"ENT Services"}],"next_id":2},"created_at":"2013-10-10T16:07:31Z","id":1885,"layer_id":470,"metadata":null,"name":"ENT Services","ord":14,"updated_at":"2013-10-10T16:07:31Z"}', '{"kind":"select_many","code":"ENT","collection_id":409,"config":{"options":[{"id":1,"code":"ENT","label":"ENT Services"}],"next_id":2},"created_at":"2013-09-06T20:02:04Z","id":1717,"layer_id":429,"metadata":null,"name":"ENT Services","ord":14,"updated_at":"2013-09-06T20:02:04Z"}'),
(62, '1857', '1662', '# of Other Transport', NULL, '{"kind":"numeric","code":"OtherTransport_Count","collection_id":463,"config":{"allows_decimals":"false"},"created_at":"2013-10-10T16:07:28Z","id":1857,"layer_id":469,"metadata":null,"name":"# of Other Transport","ord":15,"updated_at":"2013-10-10T16:07:28Z"}', '{"kind":"numeric","code":"OtherTransport_Count","collection_id":409,"config":{"allows_decimals":"false"},"created_at":"2013-08-09T21:24:19Z","id":1662,"layer_id":428,"metadata":null,"name":"# of Other Transport","ord":15,"updated_at":"2013-10-10T14:44:54Z"}'),
(63, '1886', '1689', 'Support Services', NULL, '{"kind":"select_many","code":"Services_Support","collection_id":463,"config":{"options":[{"id":1,"code":"KIT","label":"Kitchen Services"},{"id":2,"code":"LND","label":"Laundry Serives"},{"id":3,"code":"MRT","label":"Mortuary Services"}],"next_id":5},"created_at":"2013-10-10T16:07:31Z","id":1886,"layer_id":470,"metadata":null,"name":"Support Services","ord":15,"updated_at":"2013-10-10T16:07:31Z"}', '{"kind":"select_many","code":"Services_Support","collection_id":409,"config":{"options":[{"id":1,"code":"KIT","label":"Kitchen Services"},{"id":2,"code":"LND","label":"Laundry Serives"},{"id":3,"code":"MRT","label":"Mortuary Services"}],"next_id":5},"created_at":"2013-08-09T21:24:22Z","id":1689,"layer_id":429,"metadata":null,"name":"Support Services","ord":15,"updated_at":"2013-09-06T20:02:04Z"}');
INSERT INTO `field_mapping` (`id`, `cc_field_id`, `pc_field_id`, `field_name`, `semantics`, `cc_field_structure`, `pc_field_structure`) VALUES
(64, '1858', '1663', 'Sterilization and Infection Control', NULL, '{"kind":"select_many","code":"SterilizationIC","collection_id":463,"config":{"options":[{"id":1,"code":"Auto","label":"Autoclave"},{"id":2,"code":"Ster","label":"Sterilizer"},{"id":3,"code":"PrssPt","label":"Pressure Pot"},{"id":4,"code":"BoilPot","label":"Boiling Pot"},{"id":6,"code":"Safe","label":"Safety Box"},{"id":7,"code":"NoSter","label":"No Sterilizer"}],"next_id":8},"created_at":"2013-10-10T16:07:28Z","id":1858,"layer_id":469,"metadata":null,"name":"Sterilization and Infection Control","ord":16,"updated_at":"2013-10-10T16:07:28Z"}', '{"kind":"select_many","code":"SterilizationIC","collection_id":409,"config":{"options":[{"id":1,"code":"Auto","label":"Autoclave"},{"id":2,"code":"Ster","label":"Sterilizer"},{"id":3,"code":"PrssPt","label":"Pressure Pot"},{"id":4,"code":"BoilPot","label":"Boiling Pot"},{"id":6,"code":"Safe","label":"Safety Box"},{"id":7,"code":"NoSter","label":"No Sterilizer"}],"next_id":8},"created_at":"2013-08-09T21:24:19Z","id":1663,"layer_id":428,"metadata":null,"name":"Sterilization and Infection Control","ord":16,"updated_at":"2013-10-10T14:44:54Z"}'),
(65, '1887', '1690', 'Emergency Preparedness', NULL, '{"kind":"select_many","code":"Services_EmergencyPrep","collection_id":463,"config":{"options":[{"id":1,"code":"BEP","label":"Basic Emergency Preparedness "},{"id":2,"code":"CEP","label":"Comprehensive Emergency Preparedness "}],"next_id":4},"created_at":"2013-10-10T16:07:31Z","id":1887,"layer_id":470,"metadata":null,"name":"Emergency Preparedness ","ord":16,"updated_at":"2013-10-10T16:07:31Z"}', '{"kind":"select_many","code":"Services_EmergencyPrep","collection_id":409,"config":{"options":[{"id":1,"code":"BEP","label":"Basic Emergency Preparedness "},{"id":2,"code":"CEP","label":"Comprehensive Emergency Preparedness "}],"next_id":4},"created_at":"2013-08-09T21:24:22Z","id":1690,"layer_id":429,"metadata":null,"name":"Emergency Preparedness ","ord":16,"updated_at":"2013-09-06T20:02:04Z"}'),
(66, '1859', '1664', 'Means of Transport to Referral Point', NULL, '{"kind":"text","code":"Transport_ReferralPt","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:28Z","id":1859,"layer_id":469,"metadata":null,"name":"Means of Transport to Referral Point","ord":17,"updated_at":"2013-10-10T16:07:28Z"}', '{"kind":"text","code":"Transport_ReferralPt","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:19Z","id":1664,"layer_id":428,"metadata":null,"name":"Means of Transport to Referral Point","ord":17,"updated_at":"2013-10-10T14:44:54Z"}'),
(67, '1888', '1692', 'Other Services (Please Specify)', NULL, '{"kind":"text","code":"OtherServ_Specify","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:32Z","id":1888,"layer_id":470,"metadata":null,"name":"Other Services (Please Specify)","ord":17,"updated_at":"2013-10-10T16:07:32Z"}', '{"kind":"text","code":"OtherServ_Specify","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:22Z","id":1692,"layer_id":429,"metadata":null,"name":"Other Services (Please Specify)","ord":17,"updated_at":"2013-09-06T20:02:04Z"}'),
(68, '1860', '1808', 'Distance to Referral Point', NULL, '{"kind":"text","code":"Distance_ReferralPt","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:28Z","id":1860,"layer_id":469,"metadata":null,"name":"Distance to Referral Point","ord":18,"updated_at":"2013-10-10T16:07:28Z"}', '{"kind":"text","code":"Distance_ReferralPt","collection_id":409,"config":null,"created_at":"2013-10-10T14:44:54Z","id":1808,"layer_id":428,"metadata":null,"name":"Distance to Referral Point","ord":18,"updated_at":"2013-10-10T14:44:54Z"}'),
(69, '1861', '1809', 'Challenges/Remarks to Reach Referral Point', NULL, '{"kind":"text","code":"Challenges_ReferralPt","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:28Z","id":1861,"layer_id":469,"metadata":null,"name":"Challenges/Remarks to Reach Referral Point","ord":19,"updated_at":"2013-10-10T16:07:28Z"}', '{"kind":"text","code":"Challenges_ReferralPt","collection_id":409,"config":null,"created_at":"2013-10-10T14:44:54Z","id":1809,"layer_id":428,"metadata":null,"name":"Challenges/Remarks to Reach Referral Point","ord":19,"updated_at":"2013-10-10T14:44:54Z"}'),
(70, '1862', '1665', 'Source of Energy', NULL, '{"kind":"select_many","code":"EnergySource","collection_id":463,"config":{"options":[{"id":1,"code":"NatGrid","label":"National Grid"},{"id":2,"code":"Gen","label":"Generator"},{"id":3,"code":"SlrPnl","label":"Solar Panels"},{"id":4,"code":"NoElec","label":"No Electricity"},{"id":5,"code":"Oth","label":"Other"}],"next_id":6},"created_at":"2013-10-10T16:07:28Z","id":1862,"layer_id":469,"metadata":null,"name":"Source of Energy","ord":20,"updated_at":"2013-10-10T16:07:28Z"}', '{"kind":"select_many","code":"EnergySource","collection_id":409,"config":{"options":[{"id":1,"code":"NatGrid","label":"National Grid"},{"id":2,"code":"Gen","label":"Generator"},{"id":3,"code":"SlrPnl","label":"Solar Panels"},{"id":4,"code":"NoElec","label":"No Electricity"},{"id":5,"code":"Oth","label":"Other"}],"next_id":6},"created_at":"2013-08-09T21:24:19Z","id":1665,"layer_id":428,"metadata":null,"name":"Source of Energy","ord":20,"updated_at":"2013-10-10T14:44:54Z"}'),
(71, '1863', '1666', 'Specify Other Energy Source', NULL, '{"kind":"text","code":"OtherEnergy_Specify","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:28Z","id":1863,"layer_id":469,"metadata":null,"name":"Specify Other Energy Source","ord":21,"updated_at":"2013-10-10T16:07:28Z"}', '{"kind":"text","code":"OtherEnergy_Specify","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:19Z","id":1666,"layer_id":428,"metadata":null,"name":"Specify Other Energy Source","ord":21,"updated_at":"2013-10-10T14:44:54Z"}'),
(72, '1864', '1673', 'Mobile Networks', NULL, '{"kind":"select_many","code":"MobileNetworks","collection_id":463,"config":{"options":[{"id":1,"code":"AIRT","label":"Airtel"},{"id":2,"code":"VODA","label":"Vodacom"},{"id":3,"code":"TIGO","label":"Tigo"},{"id":4,"code":"ZANT","label":"Zantel"},{"id":5,"code":"TTCL","label":"TTCL"},{"id":7,"code":"OTH","label":"Other"}],"next_id":8},"created_at":"2013-10-10T16:07:29Z","id":1864,"layer_id":469,"metadata":null,"name":"Mobile Networks","ord":22,"updated_at":"2013-10-10T16:07:29Z"}', '{"kind":"select_many","code":"MobileNetworks","collection_id":409,"config":{"options":[{"id":1,"code":"AIRT","label":"Airtel"},{"id":2,"code":"VODA","label":"Vodacom"},{"id":3,"code":"TIGO","label":"Tigo"},{"id":4,"code":"ZANT","label":"Zantel"},{"id":5,"code":"TTCL","label":"TTCL"},{"id":7,"code":"OTH","label":"Other"}],"next_id":8},"created_at":"2013-08-09T21:24:20Z","id":1673,"layer_id":428,"metadata":null,"name":"Mobile Networks","ord":22,"updated_at":"2013-10-10T14:44:54Z"}'),
(73, '1865', '1674', 'Specify Other Mobile Network', NULL, '{"kind":"text","code":"OtherMobile_Specify","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:29Z","id":1865,"layer_id":469,"metadata":null,"name":"Specify Other Mobile Network","ord":23,"updated_at":"2013-10-10T16:07:29Z"}', '{"kind":"text","code":"OtherMobile_Specify","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:20Z","id":1674,"layer_id":428,"metadata":null,"name":"Specify Other Mobile Network","ord":23,"updated_at":"2013-10-10T14:44:54Z"}'),
(74, '1866', '1669', 'Source of Water', NULL, '{"kind":"select_many","code":"WaterSource","collection_id":463,"config":{"options":[{"id":1,"code":"PWHF","label":"Piped Water into Health Facility"},{"id":2,"code":"PWY","label":"Piped Water to Yard/Plot"},{"id":3,"code":"PubTap","label":"Public Tap or Standpipe"},{"id":4,"code":"TB","label":"Tube Well or Borehole"},{"id":5,"code":"PtDug","label":"Protected Dug Well"},{"id":6,"code":"PtSpr","label":"Protected Spring"},{"id":7,"code":"Rain","label":"Rainwater Harvesting"},{"id":8,"code":"Oth","label":"Other"}],"next_id":9},"created_at":"2013-10-10T16:07:29Z","id":1866,"layer_id":469,"metadata":null,"name":"Source of Water","ord":24,"updated_at":"2013-10-10T16:07:29Z"}', '{"kind":"select_many","code":"WaterSource","collection_id":409,"config":{"options":[{"id":1,"code":"PWHF","label":"Piped Water into Health Facility"},{"id":2,"code":"PWY","label":"Piped Water to Yard/Plot"},{"id":3,"code":"PubTap","label":"Public Tap or Standpipe"},{"id":4,"code":"TB","label":"Tube Well or Borehole"},{"id":5,"code":"PtDug","label":"Protected Dug Well"},{"id":6,"code":"PtSpr","label":"Protected Spring"},{"id":7,"code":"Rain","label":"Rainwater Harvesting"},{"id":8,"code":"Oth","label":"Other"}],"next_id":9},"created_at":"2013-08-09T21:24:19Z","id":1669,"layer_id":428,"metadata":null,"name":"Source of Water","ord":24,"updated_at":"2013-10-10T14:44:54Z"}'),
(75, '1867', '1670', 'Specify Other Water Source', NULL, '{"kind":"text","code":"OtherWater_Specify","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:29Z","id":1867,"layer_id":469,"metadata":null,"name":"Specify Other Water Source","ord":25,"updated_at":"2013-10-10T16:07:29Z"}', '{"kind":"text","code":"OtherWater_Specify","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:20Z","id":1670,"layer_id":428,"metadata":null,"name":"Specify Other Water Source","ord":25,"updated_at":"2013-10-10T14:44:54Z"}'),
(76, '1868', '1667', 'Toilet Facility', NULL, '{"kind":"select_many","code":"Toilet","collection_id":463,"config":{"options":[{"id":1,"code":"FTSS","label":"Flush Toilet Piped into Sewer System"},{"id":2,"code":"FTST","label":"Flush Toilet Piped into Septic Tank"},{"id":4,"code":"FTPP","label":"Flush/Pour Flush to Pit Latrine"},{"id":5,"code":"VIP","label":"Ventilated Improved Pit Latrine (VIP)"},{"id":6,"code":"PLS","label":"Pit Latrine With Slab"},{"id":7,"code":"PL","label":"Pit Latrine"},{"id":9,"code":"CT","label":"Composting Toilet"},{"id":10,"code":"NT","label":"No Toilet"}],"next_id":11},"created_at":"2013-10-10T16:07:29Z","id":1868,"layer_id":469,"metadata":null,"name":"Toilet Facility","ord":26,"updated_at":"2013-10-10T16:07:29Z"}', '{"kind":"select_many","code":"Toilet","collection_id":409,"config":{"options":[{"id":1,"code":"FTSS","label":"Flush Toilet Piped into Sewer System"},{"id":2,"code":"FTST","label":"Flush Toilet Piped into Septic Tank"},{"id":4,"code":"FTPP","label":"Flush/Pour Flush to Pit Latrine"},{"id":5,"code":"VIP","label":"Ventilated Improved Pit Latrine (VIP)"},{"id":6,"code":"PLS","label":"Pit Latrine With Slab"},{"id":7,"code":"PL","label":"Pit Latrine"},{"id":9,"code":"CT","label":"Composting Toilet"},{"id":10,"code":"NT","label":"No Toilet"}],"next_id":11},"created_at":"2013-08-09T21:24:19Z","id":1667,"layer_id":428,"metadata":null,"name":"Toilet Facility","ord":26,"updated_at":"2013-10-10T14:44:54Z"}'),
(77, '1869', '1668', 'Toilet Remarks', NULL, '{"kind":"text","code":"ToiletRemarks","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:29Z","id":1869,"layer_id":469,"metadata":null,"name":"Toilet Remarks","ord":27,"updated_at":"2013-10-10T16:07:29Z"}', '{"kind":"text","code":"ToiletRemarks","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:19Z","id":1668,"layer_id":428,"metadata":null,"name":"Toilet Remarks","ord":27,"updated_at":"2013-10-10T14:44:54Z"}'),
(78, '1870', '1671', 'Waste Management', NULL, '{"kind":"select_many","code":"WasteMgmt","collection_id":463,"config":{"options":[{"id":1,"code":"INC","label":"Incinerator"},{"id":2,"code":"BRC","label":"Burning Chamber"},{"id":3,"code":"BRP","label":"Burning Pit"},{"id":5,"code":"PP","label":"Placenta Pit"},{"id":6,"code":"OTH","label":"Others"}],"next_id":7},"created_at":"2013-10-10T16:07:29Z","id":1870,"layer_id":469,"metadata":null,"name":"Waste Management","ord":28,"updated_at":"2013-10-10T16:07:29Z"}', '{"kind":"select_many","code":"WasteMgmt","collection_id":409,"config":{"options":[{"id":1,"code":"INC","label":"Incinerator"},{"id":2,"code":"BRC","label":"Burning Chamber"},{"id":3,"code":"BRP","label":"Burning Pit"},{"id":5,"code":"PP","label":"Placenta Pit"},{"id":6,"code":"OTH","label":"Others"}],"next_id":7},"created_at":"2013-08-09T21:24:20Z","id":1671,"layer_id":428,"metadata":null,"name":"Waste Management","ord":28,"updated_at":"2013-10-10T14:44:54Z"}'),
(79, '1871', '1672', 'Specify Other Waste Management', NULL, '{"kind":"text","code":"OtherWaste_Specify","collection_id":463,"config":null,"created_at":"2013-10-10T16:07:29Z","id":1871,"layer_id":469,"metadata":null,"name":"Specify Other Waste Management","ord":29,"updated_at":"2013-10-10T16:07:29Z"}', '{"kind":"text","code":"OtherWaste_Specify","collection_id":409,"config":null,"created_at":"2013-08-09T21:24:20Z","id":1672,"layer_id":428,"metadata":null,"name":"Specify Other Waste Management","ord":29,"updated_at":"2013-10-10T14:44:54Z"}');

-- --------------------------------------------------------

--
-- Table structure for table `layer_mapping`
--

DROP TABLE IF EXISTS `layer_mapping`;
CREATE TABLE IF NOT EXISTS `layer_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cc_layer_id` int(11) NOT NULL,
  `pc_layer_id` int(11) DEFAULT NULL,
  `layer_name` varchar(500) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cc_layer_id` (`cc_layer_id`,`pc_layer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `layer_mapping`
--

INSERT INTO `layer_mapping` (`id`, `cc_layer_id`, `pc_layer_id`, `layer_name`) VALUES
(1, 463, 425, 'Priority Fields'),
(2, 464, 433, 'Facility Identifier Number'),
(3, 465, 423, 'Identification'),
(4, 466, 427, 'Contact Information'),
(5, 467, 426, 'Physical Location'),
(6, 468, 424, 'Classification'),
(7, 469, 428, 'Infrastructure'),
(8, 470, 429, 'Services Offered'),
(9, 471, 461, 'Temp Fields');

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`id`, `organization_name`) VALUES
(1, 'UCC');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
CREATE TABLE IF NOT EXISTS `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`id`, `position_name`) VALUES
(1, 'Programmer');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `position_id` int(11) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `openid_identity` varchar(500) DEFAULT NULL,
  `phone_number` varchar(45) DEFAULT NULL,
  `node_id` varchar(45) DEFAULT NULL COMMENT 'Hierachy NodeID',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_user_position1` (`position_id`),
  KEY `fk_user_organization1` (`organization_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COMMENT='Note:-Along with user''s Group|Access Role,the user is also s' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `firstname`, `lastname`, `position_id`, `organization_id`, `email`, `openid_identity`, `phone_number`, `node_id`, `active`) VALUES
(1, 'Michael', 'Kambenga', 1, 1, 'mkambenga@gmail.com', 'http://login-stg.instedd.org/openid/mkambenga@gmail.com', '255712019027', 'TZ.ET.DS', 1),
(4, NULL, NULL, 1, 1, 'jiga', NULL, '5545666755', 'TZ.CL', 0),
(5, 'Robert', 'Gunze', 1, 1, 'robertgunze@gmail.com', 'http://login-stg.instedd.org/openid/robertgunze@gmail.com', '255768406406', '', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `change_request`
--
ALTER TABLE `change_request`
  ADD CONSTRAINT `fk_change_request_user` FOREIGN KEY (`requested_by`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `change_request_fields`
--
ALTER TABLE `change_request_fields`
  ADD CONSTRAINT `change_request_fields_ibfk_2` FOREIGN KEY (`change_request_id`) REFERENCES `change_request` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `change_request_note`
--
ALTER TABLE `change_request_note`
  ADD CONSTRAINT `fk_note_change_request1` FOREIGN KEY (`change_request_id`) REFERENCES `change_request` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_note_user1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_organization1` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_position1` FOREIGN KEY (`position_id`) REFERENCES `position` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;