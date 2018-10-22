-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 19, 2018 at 01:53 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `drivefly`
--

-- --------------------------------------------------------

--
-- Table structure for table `airport`
--

CREATE TABLE `airport` (
  `id` tinyint(4) NOT NULL,
  `acronym` varchar(3) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `airport`
--

INSERT INTO `airport` (`id`, `acronym`, `name`) VALUES
(1, 'LHR', 'Heathrow'),
(2, 'BHX', 'Birmingham'),
(3, 'LTN', 'Luton');

-- --------------------------------------------------------

--
-- Table structure for table `pack_denominator`
--

CREATE TABLE `pack_denominator` (
  `id` tinyint(4) NOT NULL,
  `entity` tinyint(4) NOT NULL COMMENT 'consolidator (ex: 1= DriveFly)',
  `airport` tinyint(4) NOT NULL COMMENT 'airport (ex: 3 = LTN)',
  `service` tinyint(4) NOT NULL COMMENT 'service type (ex: 2 = PR)',
  `day_incremental` varchar(256) NOT NULL COMMENT 'increment for each day starting with day x (ex: 5)',
  `price_incremental` varchar(256) NOT NULL COMMENT 'increment price for each day starting with day x(ex: +2.99 for each day starting with day 16)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pack_denominator`
--

INSERT INTO `pack_denominator` (`id`, `entity`, `airport`, `service`, `day_incremental`, `price_incremental`) VALUES
(1, 1, 1, 1, '{ "A": 11, "B": 12, "C": 14, "D": 12, "E": 14, "F": 15}', '{ 5.00, 3.99, 7.87, 2.50, 1.99, 4.25 }'),
(2, 1, 1, 2, '{ A: 15, B: 13, C: 14, D: 16, E: 14, F: 15}', '{ 5.00, 3.99, 7.87, 2.50, 1.99, 4.25 }'),
(3, 1, 2, 1, '{ A: 15, B: 12, C: 14, D: 12, E: 14, F: 15}', '{ 5.00, 3.99, 7.87, 2.50, 1.99, 4.25 }'),
(4, 1, 2, 2, '{ A: 15, B: 12, C: 14, D: 12, E: 14, F: 15}', '{ 5.00, 3.99, 7.87, 2.50, 1.99, 4.25 }'),
(5, 1, 3, 1, '{ A: 12, B: 16, C: 13, D: 12, E: 14, F: 15}', '{ 5.00, 3.99, 7.87, 2.50, 1.99, 4.25 }'),
(6, 1, 3, 2, '{ A: 15, B: 12, C: 14, D: 12, E: 14, F: 15}', '{ 5.00, 3.99, 7.87, 2.50, 1.99, 4.25 }');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_denominator`
--

CREATE TABLE `pricing_denominator` (
  `id` int(11) NOT NULL,
  `month` tinyint(4) NOT NULL,
  `day` tinyint(4) NOT NULL,
  `pack` tinyint(4) NOT NULL,
  `threshold` varchar(1) NOT NULL COMMENT 'letter assigned'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pricing_denominator`
--

INSERT INTO `pricing_denominator` (`id`, `month`, `day`, `pack`, `threshold`) VALUES
(1, 1, 1, 1, 'A'),
(2, 1, 2, 1, 'A'),
(3, 1, 3, 1, 'A'),
(4, 1, 4, 1, 'A'),
(5, 1, 5, 1, 'A'),
(6, 1, 6, 1, 'A'),
(7, 1, 7, 1, 'A'),
(8, 1, 8, 1, 'A'),
(9, 1, 9, 1, 'A'),
(10, 1, 10, 1, 'A'),
(11, 1, 11, 1, 'A'),
(12, 1, 12, 1, 'A'),
(13, 1, 13, 1, 'A'),
(14, 1, 14, 1, 'A'),
(15, 1, 15, 1, 'A'),
(16, 1, 16, 1, 'A'),
(17, 1, 17, 1, 'A'),
(18, 1, 18, 1, 'A'),
(19, 1, 19, 1, 'A'),
(20, 1, 20, 1, 'A'),
(21, 1, 21, 1, 'A'),
(22, 1, 22, 1, 'A'),
(23, 1, 23, 1, 'A'),
(24, 1, 24, 1, 'A'),
(25, 1, 25, 1, 'A'),
(26, 1, 26, 1, 'A'),
(27, 1, 27, 1, 'A'),
(28, 1, 28, 1, 'A'),
(29, 1, 29, 1, 'A'),
(30, 1, 30, 1, 'A'),
(31, 1, 31, 1, 'A'),
(32, 2, 1, 1, 'A'),
(33, 2, 2, 1, 'A'),
(34, 2, 3, 1, 'A'),
(35, 2, 4, 1, 'A'),
(36, 2, 5, 1, 'A'),
(37, 2, 6, 1, 'A'),
(38, 2, 7, 1, 'E'),
(39, 2, 8, 1, 'E'),
(40, 2, 9, 1, 'E'),
(41, 2, 10, 1, 'E'),
(42, 2, 11, 1, 'E'),
(43, 2, 12, 1, 'E'),
(44, 2, 13, 1, 'E'),
(45, 2, 14, 1, 'E'),
(46, 2, 15, 1, 'E'),
(47, 2, 16, 1, 'E'),
(48, 2, 17, 1, 'E'),
(49, 2, 18, 1, 'E'),
(50, 2, 19, 1, 'A'),
(51, 2, 20, 1, 'A'),
(52, 2, 21, 1, 'A'),
(53, 2, 22, 1, 'A'),
(54, 2, 23, 1, 'A'),
(55, 2, 24, 1, 'A'),
(56, 2, 25, 1, 'A'),
(57, 2, 26, 1, 'A'),
(58, 2, 27, 1, 'A'),
(59, 2, 28, 1, 'A'),
(60, 2, 29, 1, 'A'),
(61, 2, 30, 1, 'A'),
(62, 2, 31, 1, 'A'),
(63, 3, 1, 1, 'B'),
(64, 3, 2, 1, 'B'),
(65, 3, 3, 1, 'B'),
(66, 3, 4, 1, 'B'),
(67, 3, 5, 1, 'B'),
(68, 3, 6, 1, 'B'),
(69, 3, 7, 1, 'B'),
(70, 3, 8, 1, 'B'),
(71, 3, 9, 1, 'B'),
(72, 3, 10, 1, 'B'),
(73, 3, 11, 1, 'B'),
(74, 3, 12, 1, 'B'),
(75, 3, 13, 1, 'B'),
(76, 3, 14, 1, 'B'),
(77, 3, 15, 1, 'B'),
(78, 3, 16, 1, 'B'),
(79, 3, 17, 1, 'B'),
(80, 3, 18, 1, 'B'),
(81, 3, 19, 1, 'B'),
(82, 3, 20, 1, 'B'),
(83, 3, 21, 1, 'B'),
(84, 3, 22, 1, 'B'),
(85, 3, 23, 1, 'B'),
(86, 3, 24, 1, 'D'),
(87, 3, 25, 1, 'D'),
(88, 3, 26, 1, 'D'),
(89, 3, 27, 1, 'D'),
(90, 3, 28, 1, 'E'),
(91, 3, 29, 1, 'E'),
(92, 3, 30, 1, 'E'),
(93, 3, 31, 1, 'E'),
(94, 4, 1, 1, 'E'),
(95, 4, 2, 1, 'E'),
(96, 4, 3, 1, 'C'),
(97, 4, 4, 1, 'C'),
(98, 4, 5, 1, 'C'),
(99, 4, 6, 1, 'C'),
(100, 4, 7, 1, 'C'),
(101, 4, 8, 1, 'C'),
(102, 4, 9, 1, 'C'),
(103, 4, 10, 1, 'B'),
(104, 4, 11, 1, 'B'),
(105, 4, 12, 1, 'E'),
(106, 4, 13, 1, 'E'),
(107, 4, 14, 1, 'E'),
(108, 4, 15, 1, 'E'),
(109, 4, 16, 1, 'E'),
(110, 4, 17, 1, 'E'),
(111, 4, 18, 1, 'E'),
(112, 4, 19, 1, 'E'),
(113, 4, 20, 1, 'E'),
(114, 4, 21, 1, 'E'),
(115, 4, 22, 1, 'E'),
(116, 4, 23, 1, 'E'),
(117, 4, 24, 1, 'E'),
(118, 4, 25, 1, 'E'),
(119, 4, 26, 1, 'E'),
(120, 4, 27, 1, 'E'),
(121, 4, 28, 1, 'E'),
(122, 4, 29, 1, 'E'),
(123, 4, 30, 1, 'E'),
(124, 4, 31, 1, 'E'),
(125, 5, 1, 1, 'A'),
(126, 5, 2, 1, 'A'),
(127, 5, 3, 1, 'A'),
(128, 5, 4, 1, 'A'),
(129, 5, 5, 1, 'A'),
(130, 5, 6, 1, 'A'),
(131, 5, 7, 1, 'E'),
(132, 5, 8, 1, 'E'),
(133, 5, 9, 1, 'E'),
(134, 5, 10, 1, 'E'),
(135, 5, 11, 1, 'E'),
(136, 5, 12, 1, 'E'),
(137, 5, 13, 1, 'E'),
(138, 5, 14, 1, 'E'),
(139, 5, 15, 1, 'E'),
(140, 5, 16, 1, 'E'),
(141, 5, 17, 1, 'E'),
(142, 5, 18, 1, 'E'),
(143, 5, 19, 1, 'A'),
(144, 5, 20, 1, 'A'),
(145, 5, 21, 1, 'A'),
(146, 5, 22, 1, 'A'),
(147, 5, 23, 1, 'A'),
(148, 5, 24, 1, 'A'),
(149, 5, 25, 1, 'A'),
(150, 5, 26, 1, 'A'),
(151, 5, 27, 1, 'A'),
(152, 5, 28, 1, 'A'),
(153, 5, 29, 1, 'A'),
(154, 5, 30, 1, 'A'),
(155, 5, 31, 1, 'A'),
(156, 6, 1, 1, 'A'),
(157, 6, 2, 1, 'A'),
(158, 6, 3, 1, 'A'),
(159, 6, 4, 1, 'A'),
(160, 6, 5, 1, 'A'),
(161, 6, 6, 1, 'A'),
(162, 6, 7, 1, 'E'),
(163, 6, 8, 1, 'E'),
(164, 6, 9, 1, 'E'),
(165, 6, 10, 1, 'E'),
(166, 6, 11, 1, 'E'),
(167, 6, 12, 1, 'E'),
(168, 6, 13, 1, 'E'),
(169, 6, 14, 1, 'E'),
(170, 6, 15, 1, 'E'),
(171, 6, 16, 1, 'E'),
(172, 6, 17, 1, 'E'),
(173, 6, 18, 1, 'E'),
(174, 6, 19, 1, 'A'),
(175, 6, 20, 1, 'A'),
(176, 6, 21, 1, 'A'),
(177, 6, 22, 1, 'A'),
(178, 6, 23, 1, 'A'),
(179, 6, 24, 1, 'A'),
(180, 6, 25, 1, 'A'),
(181, 6, 26, 1, 'A'),
(182, 6, 27, 1, 'A'),
(183, 6, 28, 1, 'A'),
(184, 6, 29, 1, 'A'),
(185, 6, 30, 1, 'A'),
(186, 6, 31, 1, 'A'),
(187, 7, 1, 1, 'A'),
(188, 7, 2, 1, 'A'),
(189, 7, 3, 1, 'A'),
(190, 7, 4, 1, 'A'),
(191, 7, 5, 1, 'A'),
(192, 7, 6, 1, 'A'),
(193, 7, 7, 1, 'E'),
(194, 7, 8, 1, 'E'),
(195, 7, 9, 1, 'E'),
(196, 7, 10, 1, 'E'),
(197, 7, 11, 1, 'E'),
(198, 7, 12, 1, 'E'),
(199, 7, 13, 1, 'E'),
(200, 7, 14, 1, 'E'),
(201, 7, 15, 1, 'E'),
(202, 7, 16, 1, 'E'),
(203, 7, 17, 1, 'E'),
(204, 7, 18, 1, 'E'),
(205, 7, 19, 1, 'A'),
(206, 7, 20, 1, 'A'),
(207, 7, 21, 1, 'A'),
(208, 7, 22, 1, 'A'),
(209, 7, 23, 1, 'A'),
(210, 7, 24, 1, 'A'),
(211, 7, 25, 1, 'A'),
(212, 7, 26, 1, 'A'),
(213, 7, 27, 1, 'A'),
(214, 7, 28, 1, 'A'),
(215, 7, 29, 1, 'A'),
(216, 7, 30, 1, 'A'),
(217, 7, 31, 1, 'A'),
(218, 8, 1, 1, 'A'),
(219, 8, 2, 1, 'A'),
(220, 8, 3, 1, 'A'),
(221, 8, 4, 1, 'A'),
(222, 8, 5, 1, 'A'),
(223, 8, 6, 1, 'A'),
(224, 8, 7, 1, 'E'),
(225, 8, 8, 1, 'E'),
(226, 8, 9, 1, 'E'),
(227, 8, 10, 1, 'E'),
(228, 8, 11, 1, 'E'),
(229, 8, 12, 1, 'E'),
(230, 8, 13, 1, 'E'),
(231, 8, 14, 1, 'E'),
(232, 8, 15, 1, 'E'),
(233, 8, 16, 1, 'E'),
(234, 8, 17, 1, 'E'),
(235, 8, 18, 1, 'E'),
(236, 8, 19, 1, 'A'),
(237, 8, 20, 1, 'A'),
(238, 8, 21, 1, 'A'),
(239, 8, 22, 1, 'A'),
(240, 8, 23, 1, 'A'),
(241, 8, 24, 1, 'A'),
(242, 8, 25, 1, 'A'),
(243, 8, 26, 1, 'A'),
(244, 8, 27, 1, 'A'),
(245, 8, 28, 1, 'A'),
(246, 8, 29, 1, 'A'),
(247, 8, 30, 1, 'A'),
(248, 8, 31, 1, 'A'),
(249, 9, 1, 1, 'A'),
(250, 9, 2, 1, 'A'),
(251, 9, 3, 1, 'A'),
(252, 9, 4, 1, 'A'),
(253, 9, 5, 1, 'A'),
(254, 9, 6, 1, 'A'),
(255, 9, 7, 1, 'E'),
(256, 9, 8, 1, 'E'),
(257, 9, 9, 1, 'E'),
(258, 9, 10, 1, 'E'),
(259, 9, 11, 1, 'E'),
(260, 9, 12, 1, 'E'),
(261, 9, 13, 1, 'E'),
(262, 9, 14, 1, 'E'),
(263, 9, 15, 1, 'E'),
(264, 9, 16, 1, 'E'),
(265, 9, 17, 1, 'E'),
(266, 9, 18, 1, 'E'),
(267, 9, 19, 1, 'A'),
(268, 9, 20, 1, 'A'),
(269, 9, 21, 1, 'A'),
(270, 9, 22, 1, 'A'),
(271, 9, 23, 1, 'A'),
(272, 9, 24, 1, 'A'),
(273, 9, 25, 1, 'A'),
(274, 9, 26, 1, 'A'),
(275, 9, 27, 1, 'A'),
(276, 9, 28, 1, 'A'),
(277, 9, 29, 1, 'A'),
(278, 9, 30, 1, 'A'),
(279, 9, 31, 1, 'A'),
(280, 10, 1, 1, 'D'),
(281, 10, 2, 1, 'D'),
(282, 10, 3, 1, 'D'),
(283, 10, 4, 1, 'D'),
(284, 10, 5, 1, 'D'),
(285, 10, 6, 1, 'D'),
(286, 10, 7, 1, 'D'),
(287, 10, 8, 1, 'D'),
(288, 10, 9, 1, 'D'),
(289, 10, 10, 1, 'D'),
(290, 10, 11, 1, 'D'),
(291, 10, 12, 1, 'D'),
(292, 10, 13, 1, 'D'),
(293, 10, 14, 1, 'D'),
(294, 10, 15, 1, 'D'),
(295, 10, 16, 1, 'D'),
(296, 10, 17, 1, 'D'),
(297, 10, 18, 1, 'D'),
(298, 10, 19, 1, 'A'),
(299, 10, 20, 1, 'A'),
(300, 10, 21, 1, 'A'),
(301, 10, 22, 1, 'A'),
(302, 10, 23, 1, 'A'),
(303, 10, 24, 1, 'A'),
(304, 10, 25, 1, 'A'),
(305, 10, 26, 1, 'A'),
(306, 10, 27, 1, 'A'),
(307, 10, 28, 1, 'D'),
(308, 10, 29, 1, 'D'),
(309, 10, 30, 1, 'D'),
(310, 10, 31, 1, 'D'),
(311, 11, 1, 1, 'D'),
(312, 11, 2, 1, 'D'),
(313, 11, 3, 1, 'D'),
(314, 11, 4, 1, 'D'),
(315, 11, 5, 1, 'D'),
(316, 11, 6, 1, 'D'),
(317, 11, 7, 1, 'D'),
(318, 11, 8, 1, 'D'),
(319, 11, 9, 1, 'D'),
(320, 11, 10, 1, 'D'),
(321, 11, 11, 1, 'D'),
(322, 11, 12, 1, 'D'),
(323, 11, 13, 1, 'D'),
(324, 11, 14, 1, 'D'),
(325, 11, 15, 1, 'D'),
(326, 11, 16, 1, 'D'),
(327, 11, 17, 1, 'D'),
(328, 11, 18, 1, 'D'),
(329, 11, 19, 1, 'D'),
(330, 11, 20, 1, 'D'),
(331, 11, 21, 1, 'D'),
(332, 11, 22, 1, 'D'),
(333, 11, 23, 1, 'D'),
(334, 11, 24, 1, 'D'),
(335, 11, 25, 1, 'D'),
(336, 11, 26, 1, 'D'),
(337, 11, 27, 1, 'D'),
(338, 11, 28, 1, 'D'),
(339, 11, 29, 1, 'D'),
(340, 11, 30, 1, 'D'),
(341, 11, 31, 1, 'D'),
(342, 12, 1, 1, 'D'),
(343, 12, 2, 1, 'D'),
(344, 12, 3, 1, 'D'),
(345, 12, 4, 1, 'D'),
(346, 12, 5, 1, 'D'),
(347, 12, 6, 1, 'D'),
(348, 12, 7, 1, 'D'),
(349, 12, 8, 1, 'D'),
(350, 12, 9, 1, 'D'),
(351, 12, 10, 1, 'D'),
(352, 12, 11, 1, 'D'),
(353, 12, 12, 1, 'D'),
(354, 12, 13, 1, 'D'),
(355, 12, 14, 1, 'D'),
(356, 12, 15, 1, 'D'),
(357, 12, 16, 1, 'D'),
(358, 12, 17, 1, 'D'),
(359, 12, 18, 1, 'D'),
(360, 12, 19, 1, 'A'),
(361, 12, 20, 1, 'A'),
(362, 12, 21, 1, 'A'),
(363, 12, 22, 1, 'A'),
(364, 12, 23, 1, 'A'),
(365, 12, 24, 1, 'A'),
(366, 12, 25, 1, 'A'),
(367, 12, 26, 1, 'A'),
(368, 12, 27, 1, 'A'),
(369, 12, 28, 1, 'A'),
(370, 12, 29, 1, 'A'),
(371, 12, 30, 1, 'A'),
(372, 12, 31, 1, 'A');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  `airport_id` tinyint(4) NOT NULL,
  `service_id` tinyint(4) NOT NULL,
  `product_info` text NOT NULL,
  `product_description` text NOT NULL,
  `product_directions` text NOT NULL,
  `is_amendable` tinyint(4) NOT NULL DEFAULT '1',
  `is_refundable` tinyint(4) NOT NULL DEFAULT '1',
  `show_hide_glag` int(11) NOT NULL DEFAULT '1' COMMENT '0 = hide, 1 = show'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `airport_id`, `service_id`, `product_info`, `product_description`, `product_directions`, `is_amendable`, `is_refundable`, `show_hide_glag`) VALUES
(1, 'Drivefly', 2, 1, 'Accessibility: This service is suitable for customers with limited mobility, as a shuttle bus is not required.  Security: The car park is secured by:  Security barriers CCTV 24-hour patrols The small print: Your car will be parked in a secured off-site compound while you\'re away.  Drivefly is only available to take and return cars between 4am and 12 midnight.  During bank holidays, there may be some changes in how the parking works. Drivefly will tell you about this if it affects you.  All airport fees are included.', 'Drivefly Heathrow Park & Ride offers a great value option. Our easy to find, well protected site close to M4 J4 offers frequent bus transfers which take under 15 minutes (in normal traffic conditions) and are included in the price.    Note - Heathrow T4 transfers are via Heathrow Express.', 'Telephone your driver: 0121 647 3683 or 07935 209 700 If you do NOT receive a call, please call us on the above number when you are 15 - 20 minutes away from the terminal so we can arrange a driver for you.  Departure Procedures sat-nav postcode: B26 3QJ On arriving at the airport, use the \'Drop & Go\' area immediately outside the terminal. Take the ticket from the barrier and immediately turn RIGHT. On the right had side perimeter of the Drop and Go area you will see a number of parking bays. Please park in between bays 9-12. Here you will be greeted by one of our chauffeurs at the prearranged meeting point, who will have all your booking details. Return Procedure Please call us on 0121 647 3683 / 07935 209 700 once you have collected all your luggage. In case of any delays please let us know. Our chauffer will deliver your vehicle to the agreed pick up point at the airport. *Depending on the product you have paid for; you may be required to pay for the airport exit fee on your return. Please ask our driver for clarification.', 1, 1, 1),
(2, 'Drivefly', 1, 1, 'Drop-off and pick-up at Short Stay. Stroll to check-in.  Need to know: Drop your car off at the Short Stay car park. A member of the team will meet you there and park your car while you walk to the terminal.  When you get back walk back to where you were met on arrival and your car will be ready for collection.  Accessibility: This service is suitable for customers with limited mobility, as a shuttle bus is not required.  Security: The car park is secured by:  Security barriers CCTV 24-hour patrols The small print: Your car will be parked in a secured off-site compound while you\'re away.  Drivefly is only available to take and return cars between 4am and 12 midnight.  During bank holidays, there may be some changes in how the parking works. Drivefly will tell you about this if it affects you.  All airport fees are included.', 'Drivefly Meet & Greet offers a smooth and speedy parking experience for all passengers leaving from Heathrow. The drive-in and drop-off service is perfect if you\'re short on time, dragging heavy bags or simply want to swerve the stress of airport transfers.', 'Telephone your driver: 0203 667 2616 or 07545 004 379 If you do NOT receive a call, please call us on the above number when you are 15 - 20 minutes away from the terminal so we can arrange a driver for you.  Terminal 1 - N/A Terminal 2- sat-nav postcode: (TW6 1EW) Terminal 2 Departure Instructions From the M25 exit at Junction 14, follow the signs for Terminals 1, 2 & 3 all the way round following onto the Western Perimeter Road. Go through the main tunnel to the Central Terminal Area for Terminals 1, 2 & 3. Exiting the tunnel, keep right, passing the Central Bus Station, joining the final approaches to Terminal 2 on Cosmopolitan Way. Again, keep right as the road to Terminal 2 will move away from building, before turning back as the road ramps up to Terminal 2 Departures & the Short Stay 2 car park on Constellation Way. On the rising ramp, continue to keep right as the ramp will lead directly into the "Short stay car park" entry barriers. Take the barrier ticket and enter the carpark. Entering the car park on Level 4, keep RIGHT for Level 4 following the signs for Off Airport Parking Meet & Greet and then park your vehicle in "Row B". Here you see one of our chauffeurs who is based near the ticket pay machine, who will have all your booking details and will be wearing a black jacket. Terminal 2 Arrival Instructions Once you have collected your luggage and are about to clear Customs, call the number given when your car was collected. Make your way to the same place where you dropped the vehicle off; Level 4 short stay car park, and the vehicle will be parked in Row B next to the lift/pay machines Terminal 3- sat-nav postcode: TW6 3QG Departure Procedure For Heathrow Terminal 3 From the M25 exit at Junction 14, follow the signs for Terminals 1, 2 & 3 all the way round following onto the Western Perimeter Road. Go through the main tunnel to the Central Terminal Area for Terminals 1, 2 & 3. Exiting the tunnel, keep in the 1st lane and follow signs for Terminal 3 Short Stay Carpark (Carpark 3). Take a ticket from the barrier and take your car to Level 4, then park your vehicle in ROW A Here you see one of our chauffeurs who is based near the ticket pay machine, who will have all your booking details and will be wearing a black jacket. Arrival Procedure For Heathrow Terminal 3 Once you have collected your luggage and are about to clear Customs, call the number given when your car was collected. As you arrive in the arrivals, just before the exit door on the Right Hand Side, take the lift to Level 4 Short Stay Car Park, ROW A. Terminal 4- sat-nav postcode: TW6 3XA Departure Procedure For Heathrow Terminal 4 When Entering Heathrow Airport, following signs for Terminal 4, Departure Passenger Drop Off, as you go on the ramp towards Terminal 4, keep your vehicle in the left hand lane, and enter into Lane 3, which is the furthest lane away from the Terminal. Continue down the lane and at the end of the lane on the left hand side you will see a sign on the floor marked Permit Holders park your vehicle there, here you will be greeted by one of our chauffeurs, who will have all your booking details and will be wearing a black jacket. Arrival Procedure For Heathrow Terminal 4 Once you have collected your luggage and are about to clear Customs, call the number given when your car was collected. As you exit the arrival Hall, cross the road directly towards the Short Stay Car park on the Ground floor. As you walk outside the Arrival building to the short stay car park, walk across to the other side of the car park right by the pay machine which is located next the pedestrian crossing. Your vehicle will be returned where the Black and White signs say Off Air Meet & Greet at the furthest point of the car park away from the Terminal building on the Right hand side. Terminal 5- sat-nav postcode: TW6 2GA Departure Procedure For Heathrow Terminal 5 Follow the signs for "Short stay Car Park" found on the right hand side of the ramp as you enter the exit for Terminal 5 roundabout. After following the signs for Short Stay Car Park, you will see a sign on the left-hand lane marked"LEVEL 4". Stay in this lane which will take you straight to a set of barriers. Take the ticket from the barrier and make your way to Zones R-S. Park your vehicle in these designated areas which is sign posted in these zones as Off Airport Meet & Greet Here you see one of our chauffeurs who is based near the ticket pay machine, who will have all your booking details and will be wearing a black jacket. Arrival Procedure For Heathrow Terminal 5 Once you have collected your luggage and are about to clear Customs, call the number given when your car was collected. Make your way to the same place where you dropped the vehicle off; Level 4 short stay car park, and the vehicle will be parked in Row R OR S.', 1, 1, 1),
(3, 'Drivefly', 3, 1, 'Accessibility: This service is suitable for customers with limited mobility, as a shuttle bus is not required.  Security: The car park is secured by:  Security barriers CCTV 24-hour patrols The small print: Your car will be parked in a secured off-site compound while you\'re away.  Drivefly is only available to take and return cars between 4am and 12 midnight.  During bank holidays, there may be some changes in how the parking works. Drivefly will tell you about this if it affects you.  All airport fees are included.', 'Drivefly Meet & Greet offers a smooth and speedy parking experience for all passengers leaving from Luton. The drive-in and drop-off service is perfect if you\'re short on time, dragging heavy bags or simply want to swerve the stress of airport transfers.', 'Telephone your driver: 07955 055 777 or 07955 055 700 If you do NOT receive a call, please call us on the above number when you are 15 - 20 minutes away from the terminal so we can arrange a driver for you.  Upon arrival to Luton airport Please follow signs to the MULTI STORY CARPAK level 3, you will find allocated parking bays marked "Meet and Greet". One of our representatives will be awaiting you wearing an orange hi-vis', 1, 1, 1),
(4, 'Drivefly', 1, 2, 'Security: The car park is secured by:  Security barriers CCTV 24-hour patrols The small print: Your car will be parked in a secured off-site compound while you\'re away.  Drivefly is only available to take and return cars between 4am and 12 midnight.  During bank holidays, there may be some changes in how the parking works. Drivefly will tell you about this if it affects you.  All airport fees are included.', 'Drivefly Heathrow Park & Ride offers a great value option. Our easy to find, well protected site close to M4 J4 offers frequent bus transfers which take under 15 minutes (in normal traffic conditions) and are included in the price.    Note - Heathrow T4 transfers are via Heathrow Express.', 'Exit M4 at Junction 4  Use the left lane to take the A408 exit to Uxbridge  Keep left and continue straight to Stockley Road/A408 for 0.4 miles  At the roundabout, take the 1st exit and stay on Stockley Road/A408 for 1.1 miles  At the roundabout take the 1st exit and stay on Stockley Road/A408 for 1 mile (Go through two roundabouts)  At the lights, continue straight on to Trout Road for 0.1 miles and Drivefly Park & Ride will be signposted on your left hand side.', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` tinyint(4) NOT NULL,
  `acronym` varchar(2) NOT NULL,
  `name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='MG - meet & greet, PR - park & drive';

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `acronym`, `name`) VALUES
(1, 'MG', 'meet & greet'),
(2, 'PR', 'park & ride');

-- --------------------------------------------------------

--
-- Table structure for table `threshold`
--

CREATE TABLE `threshold` (
  `id` tinyint(4) NOT NULL,
  `letters` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `threshold`
--

INSERT INTO `threshold` (`id`, `letters`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'C'),
(4, 'D'),
(5, 'E'),
(6, 'F');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airport`
--
ALTER TABLE `airport`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pack_denominator`
--
ALTER TABLE `pack_denominator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pricing_denominator`
--
ALTER TABLE `pricing_denominator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `threshold`
--
ALTER TABLE `threshold`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airport`
--
ALTER TABLE `airport`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pack_denominator`
--
ALTER TABLE `pack_denominator`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pricing_denominator`
--
ALTER TABLE `pricing_denominator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=373;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `threshold`
--
ALTER TABLE `threshold`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
