-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2016 at 11:57 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `lms`
--
CREATE DATABASE IF NOT EXISTS `lms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lms`;

-- --------------------------------------------------------

--
-- Table structure for table `lms_admins`
--

CREATE TABLE IF NOT EXISTS `lms_admins` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `login_name` varchar(255) NOT NULL,
  `login_password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `allowed_pages` text NOT NULL,
  `start_page` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `lms_admins`
--

INSERT INTO `lms_admins` (`user_id`, `fname`, `lname`, `login_name`, `login_password`, `email`, `phone`, `allowed_pages`, `start_page`, `is_active`) VALUES
(1, 'Owor', 'Yoakim', 'admin', '2e33a9b0b06aa0a01ede70995674ee23', 'oyoakim@yahoo.com', '0773588888', '0,clients.php,matches.php,teams.php', 'matches.php', 0),
(5, 'Yk', 'Yk', 'admin1', '2e33a9b0b06aa0a01ede70995674ee23', 'owor327@gmail.com', '0773588888', '0,clients.php,matches.php,teams.php', 'clients.php', 0),
(6, 'Admin', 'Admin', 'oworyk', 'ee0bd60531db77d1c0151d55473d4f97', 'kakbetty@yahoo.com', '0773588888', '0,cards.php,clients.php,leagues.php,matches.php,rounds.php,selections.php,teams.php,tournaments.php,users.php', 'clients.php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lms_admin_pages`
--

CREATE TABLE IF NOT EXISTS `lms_admin_pages` (
  `page_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `page` varchar(255) NOT NULL,
  `access` int(3) DEFAULT NULL,
  PRIMARY KEY (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `lms_admin_pages`
--

INSERT INTO `lms_admin_pages` (`page_id`, `title`, `page`, `access`) VALUES
(1, 'Matches', 'matches.php', NULL),
(2, 'Clients', 'clients.php', NULL),
(3, 'Teams', 'teams.php', NULL),
(4, 'Tournaments', 'tournaments.php', NULL),
(5, 'Cards', 'cards.php', NULL),
(6, 'Users', 'users.php', NULL),
(7, 'Leagues', 'leagues.php', NULL),
(8, 'Rounds', 'rounds.php', NULL),
(9, 'Selections', 'selections.php', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `lms_cards`
--

CREATE TABLE IF NOT EXISTS `lms_cards` (
  `card_id` int(11) NOT NULL AUTO_INCREMENT,
  `card_serial` int(8) unsigned NOT NULL,
  `card_number` int(8) unsigned NOT NULL,
  PRIMARY KEY (`card_id`),
  UNIQUE KEY `card_number` (`card_number`),
  UNIQUE KEY `card_serial` (`card_serial`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `lms_cards`
--

INSERT INTO `lms_cards` (`card_id`, `card_serial`, `card_number`) VALUES
(83, 1001, 83623322),
(84, 1002, 60586251),
(85, 1003, 66747352),
(86, 1004, 50368062),
(87, 1005, 50693047),
(88, 1006, 21712845),
(89, 1007, 88775020),
(90, 1008, 33174342),
(91, 1009, 86305243),
(92, 1010, 88342836),
(93, 1011, 42628623),
(94, 1012, 33325147),
(95, 1013, 51454827),
(96, 1014, 45426230);

-- --------------------------------------------------------

--
-- Table structure for table `lms_card_tournaments`
--

CREATE TABLE IF NOT EXISTS `lms_card_tournaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `card_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `lms_card_tournaments`
--

INSERT INTO `lms_card_tournaments` (`id`, `client_id`, `card_id`, `tournament_id`, `is_active`) VALUES
(26, 1, 83, 44, 1),
(27, 1, 83, 45, 1),
(28, 2, 84, 46, 1),
(29, 2, 84, 47, 1),
(30, 2, 84, 48, 1),
(31, 2, 92, 44, 1),
(32, 2, 92, 45, 1),
(33, 11, 96, 44, 1),
(34, 11, 96, 45, 1),
(35, 11, 96, 46, 1),
(36, 11, 96, 47, 1),
(37, 1, 83, 46, 1),
(38, 1, 83, 47, 1),
(39, 1, 83, 48, 1),
(42, 14, 93, 47, 1),
(43, 12, 91, 45, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_clients`
--

CREATE TABLE IF NOT EXISTS `lms_clients` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `lms_clients`
--

INSERT INTO `lms_clients` (`client_id`, `fname`, `lname`, `phone`, `email`, `is_active`) VALUES
(1, 'Owor', 'Yoakim', '0773586556', 'owor327@gmail.com', 1),
(2, 'Mugisha', 'Stanely', '0411000004', 'oyoakim@yahoo.com', 1),
(11, 'Rogos', 'Yoakim', '0700931351', '', 1),
(12, 'John', 'John', '0773588888', '', 1),
(13, 'Amos', 'Amos', '0773588887', '', 1),
(14, 'Munyagwa', 'Munyagwa', '0773588886', '', 1),
(15, 'Rogers', 'Rogers', '0773588885', '', 1),
(16, 'William', 'William', '0773588884', '', 1),
(17, 'Hilary', 'Hilary', '0773588889', '', 1),
(18, 'James', 'James', '0773588810', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_client_logins`
--

CREATE TABLE IF NOT EXISTS `lms_client_logins` (
  `client_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL,
  PRIMARY KEY (`client_login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `lms_client_selections`
--

CREATE TABLE IF NOT EXISTS `lms_client_selections` (
  `client_selection_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `client_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `round_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `with_draw` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_win` tinyint(1) unsigned DEFAULT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_selection_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=99 ;

--
-- Dumping data for table `lms_client_selections`
--

INSERT INTO `lms_client_selections` (`client_selection_id`, `date_created`, `client_id`, `tournament_id`, `round_id`, `match_id`, `team_id`, `with_draw`, `is_win`, `is_active`, `deleted`) VALUES
(84, '2015-10-12 10:58:56', 1, 44, 253, 52, 5, 0, NULL, 1, 0),
(85, '2015-10-12 10:58:56', 2, 44, 253, 52, 5, 0, NULL, 1, 0),
(86, '2015-10-12 10:58:56', 11, 44, 253, 52, 5, 0, NULL, 1, 0),
(87, '2015-10-12 10:58:56', 1, 45, 254, 52, 5, 0, NULL, 1, 0),
(88, '2015-10-12 10:58:56', 2, 45, 254, 52, 5, 0, NULL, 1, 0),
(89, '2015-10-12 10:58:56', 11, 45, 254, 52, 5, 0, NULL, 1, 0),
(90, '2015-10-12 10:58:56', 1, 46, 255, 52, 5, 0, NULL, 1, 0),
(91, '2015-10-12 10:58:56', 2, 46, 255, 52, 5, 0, NULL, 1, 0),
(92, '2015-10-12 10:58:56', 11, 46, 255, 52, 5, 0, NULL, 1, 0),
(93, '2015-10-12 10:58:56', 11, 47, 256, 52, 5, 0, NULL, 1, 0),
(94, '2015-10-12 10:58:57', 1, 47, 256, 52, 5, 0, NULL, 1, 0),
(95, '2015-10-12 10:58:57', 2, 47, 256, 52, 5, 0, NULL, 1, 0),
(96, '2015-10-12 10:58:57', 14, 47, 256, 52, 5, 0, NULL, 1, 0),
(97, '2015-10-12 10:58:57', 1, 48, 257, 52, 5, 0, NULL, 1, 0),
(98, '2015-10-12 10:58:57', 2, 48, 257, 52, 5, 0, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lms_countries`
--

CREATE TABLE IF NOT EXISTS `lms_countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=302 ;

--
-- Dumping data for table `lms_countries`
--

INSERT INTO `lms_countries` (`country_id`, `title`, `code`) VALUES
(46, 'Afghanistan', '93'),
(47, 'Albania', '355'),
(48, 'Algeria', '213'),
(50, 'Andorra', '376'),
(51, 'Angola', '244'),
(52, 'Anguilla', '809'),
(53, 'Antigua', '268'),
(54, 'Argentina', '54'),
(55, 'Armenia', '374'),
(56, 'Aruba', '297'),
(58, 'Australia', '61'),
(60, 'Austria', '43'),
(61, 'Azerbaijan', '994'),
(63, 'Bahamas', '242'),
(65, 'Bahrain', '973'),
(66, 'Bangladesh', '880'),
(67, 'Belarus', '375'),
(68, 'Belgium', '32'),
(69, 'Belize', '501'),
(70, 'Benin', '229'),
(71, 'Bermuda', '809'),
(72, 'Bhutan', '975'),
(73, 'British Virgin Islands', '284'),
(74, 'Bolivia', '591'),
(75, 'Bosnia and Herzegovina', '387'),
(76, 'Botswana', '267'),
(77, 'Brazil', '55'),
(78, 'British V.I.', '284'),
(79, 'Brunei Darussalm', '673'),
(80, 'Bulgaria', '359'),
(81, 'Burkina Faso', '226'),
(82, 'Burundi', '257'),
(84, 'Cambodia', '855'),
(85, 'Cameroon', '237'),
(86, 'Canada', '1'),
(88, 'Caribbean Nations', '1'),
(89, 'Cayman Islands', '345'),
(90, 'Cape Verdi', '238'),
(91, 'Central African Republic', '236'),
(92, 'Chad', '235'),
(93, 'Chile', '56'),
(94, 'China', '86'),
(95, 'China-Taiwan', '886'),
(96, 'Colombia', '57'),
(97, 'Comoros and Mayotte', '269'),
(98, 'Congo', '242'),
(99, 'Cook Islands', '682'),
(100, 'Costa Rica', '506'),
(101, 'Croatia', '385'),
(102, 'Cuba', '53'),
(103, 'Cyprus', '357'),
(104, 'Czech Republic', '420'),
(105, 'Denmark', '45'),
(106, 'Diego Garcia', '246'),
(107, 'Dominca', '767'),
(108, 'Dominican Republic', '809'),
(109, 'Djibouti', '253'),
(111, 'Ecuador', '593'),
(112, 'Egypt', '20'),
(113, 'El Salvador', '503'),
(114, 'Equatorial Guinea', '240'),
(115, 'Eritrea', '291'),
(116, 'Estonia', '372'),
(117, 'Ethiopia', '251'),
(119, 'Falkland Islands', '500'),
(120, 'Faroe Islands', '298'),
(121, 'Fiji', '679'),
(122, 'Finland', '358'),
(123, 'France', '33'),
(124, 'French Antilles', '596'),
(125, 'French Guiana', '594'),
(127, 'Gabon', '241'),
(128, 'Gambia', '220'),
(129, 'Georgia', '995'),
(130, 'Germany', '49'),
(131, 'Ghana', '233'),
(132, 'Gibraltar', '350'),
(133, 'Greece', '30'),
(134, 'Greenland', '299'),
(135, 'Grenada', '473'),
(136, 'Guam', '671'),
(137, 'Guatemala', '502'),
(138, 'Guinea', '224'),
(139, 'Guinea-Bissau', '245'),
(140, 'Guyana', '592'),
(142, 'Haiti', '509'),
(143, 'Honduras', '504'),
(144, 'Hong Kong', '852'),
(145, 'Hungary', '36'),
(147, 'Iceland', '354'),
(148, 'India', '91'),
(149, 'Indonesia', '62'),
(150, 'Iran', '98'),
(151, 'Iraq', '964'),
(152, 'Ireland Republic', '353'),
(153, 'Israel', '972'),
(154, 'Italy', '39'),
(155, 'Ivory Coast', '225'),
(157, 'Jamaica', '876'),
(158, 'Japan', '81'),
(159, 'Jordan', '962'),
(161, 'Kazakhstan', '7'),
(162, 'Kenya', '254'),
(163, 'Khmer Republic', '855'),
(164, 'Kiribati Republic', '686'),
(165, 'South Korea', '82'),
(166, 'North Korea', '850'),
(167, 'Kuwait', '965'),
(168, 'Kyrgyz Republic', '996'),
(170, 'Latvia', '371'),
(171, 'Laos', '856'),
(172, 'Lebanon', '961'),
(173, 'Lesotho', '266'),
(174, 'Liberia', '231'),
(175, 'Lithuania', '370'),
(176, 'Libya', '218'),
(177, 'Liechtenstein', '423'),
(178, 'Luxembourg', '352'),
(180, 'Macao', '853'),
(181, 'Macedonia', '389'),
(182, 'Madagascar', '261'),
(183, 'Malawi', '265'),
(184, 'Malaysia', '60'),
(185, 'Maldives', '960'),
(186, 'Mali', '223'),
(187, 'Malta', '356'),
(188, 'Marshall Islands', '692'),
(189, 'Martinique', '596'),
(190, 'Mauritania', '222'),
(191, 'Mauritius', '230'),
(192, 'Mayolte', '269'),
(193, 'Mexico', '52'),
(194, 'Micronesia', '691'),
(195, 'Moldova', '373'),
(196, 'Monaco', '33'),
(197, 'Mongolia', '976'),
(198, 'Montserrat', '473'),
(199, 'Morocco', '212'),
(200, 'Mozambique', '258'),
(201, 'Myanmar', '95'),
(203, 'Namibia', '264'),
(204, 'Nauru', '674'),
(205, 'Nepal', '977'),
(206, 'Netherlands', '31'),
(208, 'Nevis', '869'),
(209, 'New Caledonia', '687'),
(210, 'New Zealand', '64'),
(211, 'Nicaragua', '505'),
(212, 'Niger', '227'),
(213, 'Nigeria', '234'),
(214, 'Niue', '683'),
(215, 'North Korea', '850'),
(217, 'Norway', '47'),
(219, 'Oman', '968'),
(221, 'Pakistan', '92'),
(222, 'Palau', '680'),
(223, 'Panama', '507'),
(224, 'Papua New Guinea', '675'),
(225, 'Paraguay', '595'),
(226, 'Peru', '51'),
(227, 'Philippines', '63'),
(228, 'Poland', '48'),
(229, 'Portugal', '351'),
(230, 'Puerto Rico', '1 787'),
(232, 'Qatar', '974'),
(234, 'Reunion', '262'),
(235, 'Romania', '40'),
(236, 'Russia', '7'),
(237, 'Rwanda', '250'),
(239, 'Saipan', '670'),
(240, 'San Marino', '378'),
(242, 'Saudi Arabia', '966'),
(243, 'Senegal', '221'),
(244, 'Serbia', '381'),
(245, 'Seychelles', '248'),
(246, 'Sierra Leone', '232'),
(247, 'Singapore', '65'),
(248, 'Slovakia', '421'),
(249, 'Slovenia', '386'),
(251, 'Somalia', '252'),
(252, 'South Africa', '27'),
(253, 'Spain', '34'),
(254, 'Sri Lanka', '94'),
(255, 'St. Helena', '290'),
(256, 'St. Kitts/Nevis', '869'),
(258, 'Sudan', '249'),
(259, 'Suriname', '597'),
(260, 'Swaziland', '268'),
(261, 'Sweden', '46'),
(262, 'Switzerland', '41'),
(263, 'Syria', '963'),
(265, 'Tahiti', '689'),
(266, 'Taiwan', '886'),
(267, 'Tajikistan', '7'),
(268, 'Tanzania', '255'),
(269, 'Thailand', '66'),
(270, 'Togo', '228'),
(271, 'Tokelau', '690'),
(272, 'Tonga', '676'),
(273, 'Trinidad and Tobago', '1 868'),
(274, 'Tunisia', '216'),
(275, 'Turkey', '90'),
(276, 'Turkmenistan', '993'),
(277, 'Tuvalu', '688'),
(278, 'Uganda', '256'),
(279, 'Ukraine', '380'),
(280, 'United Arab Emirates', '971'),
(281, 'England', '44'),
(282, 'Uruguay', '598'),
(283, 'USA', '1'),
(284, 'Uzbekistan', '7'),
(286, 'Vatican City', '39'),
(287, 'Venezuela', '58'),
(288, 'Viet Nam', '84'),
(289, 'Virgin Islands', '1 340'),
(290, 'Wallis and Futuna', '681'),
(291, 'Western Samoa', '685'),
(292, 'Yemen', '381'),
(293, 'North Yemen', '967'),
(294, 'Yugoslavia', '381'),
(295, 'Zaire', '243'),
(296, 'Zambia', '260'),
(297, 'Zimbabwe', '263'),
(298, 'Montenegro', '382'),
(299, 'Scotland', ''),
(300, 'Wales', '44'),
(301, 'Northern Ireland', '44');

-- --------------------------------------------------------

--
-- Table structure for table `lms_leagues`
--

CREATE TABLE IF NOT EXISTS `lms_leagues` (
  `league_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`league_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `lms_leagues`
--

INSERT INTO `lms_leagues` (`league_id`, `country_id`, `title`, `is_active`, `deleted`) VALUES
(1, 281, ' Premier League', 1, 0),
(12, 253, 'Liga BBVA', 1, 0),
(14, 130, 'Bundesliga', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lms_matches`
--

CREATE TABLE IF NOT EXISTS `lms_matches` (
  `match_id` int(11) NOT NULL AUTO_INCREMENT,
  `match_time` datetime NOT NULL,
  `first_team_id` int(11) NOT NULL,
  `second_team_id` int(11) NOT NULL,
  `league_id` int(11) DEFAULT NULL,
  `first_team_score` int(2) unsigned DEFAULT NULL,
  `second_team_score` int(2) unsigned DEFAULT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_problematic` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `has_started` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`match_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `lms_matches`
--

INSERT INTO `lms_matches` (`match_id`, `match_time`, `first_team_id`, `second_team_id`, `league_id`, `first_team_score`, `second_team_score`, `status`, `is_problematic`, `is_active`, `has_started`) VALUES
(5, '2015-09-26 17:15:00', 31, 15, 1, 1, 2, 1, 0, 0, 0),
(6, '2015-09-26 19:30:00', 29, 5, 1, 2, 2, 1, 0, 0, 0),
(7, '2015-09-26 19:30:00', 18, 27, 1, 3, 3, 1, 0, 0, 0),
(8, '2015-09-26 19:30:00', 8, 19, 1, 3, 1, 1, 1, 0, 2),
(9, '2015-09-26 19:30:00', 30, 26, 1, 3, 1, 1, 0, 0, 0),
(10, '2015-09-26 19:30:00', 22, 24, 1, 0, 3, 1, 0, 0, 0),
(11, '2015-09-26 19:30:00', 9, 25, 1, 1, 0, 1, 0, 0, 0),
(12, '2015-09-26 22:00:00', 28, 1, 1, 0, 0, 1, 0, 0, 0),
(13, '2015-10-30 22:00:00', 16, 10, 1, 1, 2, 1, 0, 0, 0),
(14, '2015-09-29 00:30:00', 32, 17, 1, 2, 2, 1, 0, 0, 0),
(15, '2015-10-03 17:15:00', 10, 32, 1, 3, 0, 1, 0, 0, 0),
(16, '2015-10-03 19:30:00', 27, 22, 1, 1, 1, 1, 0, 0, 0),
(17, '2015-10-03 19:30:00', 24, 16, 1, 2, 1, 1, 0, 0, 0),
(18, '2015-10-03 19:30:00', 15, 28, 1, 6, 1, 1, 0, 0, 0),
(19, '2015-10-03 19:30:00', 25, 29, 1, 1, 1, 1, 0, 0, 0),
(20, '2015-10-03 19:30:00', 19, 9, 1, NULL, NULL, 0, 1, 0, 2),
(21, '2015-10-03 22:00:00', 1, 30, 1, 1, 4, 1, 0, 0, 0),
(22, '2015-10-04 18:00:00', 17, 18, 1, 1, 1, 1, 0, 0, 0),
(23, '2015-10-04 20:30:00', 5, 8, 1, 3, 0, 1, 0, 0, 0),
(24, '2015-10-04 20:30:00', 26, 31, 1, 1, 1, 1, 0, 0, 0),
(25, '2015-10-17 17:15:00', 31, 18, 1, NULL, NULL, 0, 0, 0, 0),
(26, '2015-10-17 19:30:00', 1, 27, 1, NULL, NULL, 0, 0, 0, 0),
(27, '2015-10-17 19:30:00', 10, 9, 1, NULL, NULL, 0, 0, 0, 0),
(28, '2015-10-17 19:30:00', 17, 8, 1, NULL, NULL, 0, 0, 0, 0),
(29, '2015-10-17 19:30:00', 15, 24, 1, NULL, NULL, 0, 0, 0, 0),
(30, '2015-10-17 19:30:00', 30, 29, 1, NULL, NULL, 0, 0, 0, 0),
(31, '2015-10-17 19:30:00', 32, 19, 1, NULL, NULL, 0, 0, 0, 0),
(32, '2015-10-17 22:00:00', 16, 5, 1, NULL, NULL, 0, 0, 0, 0),
(33, '2015-10-18 20:30:00', 28, 25, 1, NULL, NULL, 0, 0, 0, 0),
(34, '2015-10-20 00:30:00', 26, 22, 1, NULL, NULL, 0, 0, 0, 0),
(38, '2015-10-30 18:16:00', 8, 5, 1, NULL, NULL, 0, 0, 0, 0),
(52, '2015-10-12 14:30:00', 5, 27, 1, 3, 3, 1, 0, 0, 1),
(53, '2015-10-12 13:30:00', 15, 1, 1, NULL, NULL, 0, 0, 0, 1),
(54, '2015-10-12 13:30:00', 10, 24, 1, 2, 2, 1, 0, 0, 1),
(55, '2015-10-12 13:30:00', 29, 19, 1, NULL, NULL, 2, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `lms_rounds`
--

CREATE TABLE IF NOT EXISTS `lms_rounds` (
  `round_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `code` varchar(3) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `close_time` datetime NOT NULL,
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_closed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `counter` int(10) unsigned NOT NULL,
  PRIMARY KEY (`round_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=261 ;

--
-- Dumping data for table `lms_rounds`
--

INSERT INTO `lms_rounds` (`round_id`, `title`, `code`, `tournament_id`, `date_created`, `close_time`, `is_active`, `is_closed`, `counter`) VALUES
(253, 'Round 1', 'R1', 44, '2015-10-11 16:13:07', '2015-10-12 13:30:00', 1, 1, 1),
(254, 'Round 1', 'R1', 45, '2015-10-11 16:13:07', '2015-10-12 13:30:00', 1, 1, 1),
(255, 'Round 1', 'R1', 46, '2015-10-11 16:13:07', '2015-10-12 13:30:00', 1, 1, 1),
(256, 'Round 1', 'R1', 47, '2015-10-11 16:13:07', '2015-10-12 13:30:00', 1, 1, 1),
(257, 'Round 1', 'R1', 48, '2015-10-11 16:13:07', '2015-10-12 13:30:00', 1, 1, 1),
(258, 'Round 1', 'R1', 49, '2015-10-11 16:13:07', '2015-10-12 13:30:00', 1, 1, 1),
(259, 'Round 1', 'R1', 50, '2015-10-11 16:13:07', '2015-10-12 13:30:00', 1, 1, 1),
(260, 'Round 1', 'R1', 51, '2015-10-11 16:13:08', '2015-10-12 13:30:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_teams`
--

CREATE TABLE IF NOT EXISTS `lms_teams` (
  `team_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `league_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `logo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`team_id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `lms_teams`
--

INSERT INTO `lms_teams` (`team_id`, `title`, `league_id`, `is_active`, `logo`) VALUES
(1, 'Chelsea FC', 1, 1, 'chelsea.png'),
(2, 'Barcelona', 12, 1, 'barcelona.png'),
(5, 'Arsenal FC', 1, 1, 'arsenal.png'),
(8, 'Manchester United', 1, 1, 'manchester_united.png'),
(9, 'West Ham United', 1, 1, 'westham_united.png'),
(10, 'Crystal Palace', 1, 1, 'crystal_palace.png'),
(11, 'Real Madrid', 12, 1, 'real_madrid.png'),
(12, 'Augsburg FC', 14, 1, 'augsburg.png'),
(15, 'Manchester City', 1, 1, 'manchester_city.png'),
(16, 'Watford FC', 1, 1, 'watford.png'),
(17, 'Everton FC', 1, 1, 'everton.png'),
(18, 'Liverpool FC', 1, 1, 'liverpool.png'),
(19, 'Sunderland', 1, 1, 'sunderland.png'),
(20, 'Borussia Monchengladbach', 14, 1, 'borussia_monchengladbach.png'),
(21, 'Celta Vigo', 12, 1, 'celta_vigo.png'),
(22, 'Stoke City', 1, 1, 'stoke_city.png'),
(23, 'Wolfsburg FC', 14, 1, 'wolfsburg.png'),
(24, 'Bournemouth', 1, 1, 'bournemouth.png'),
(25, 'Norwich City', 1, 1, 'norwich_city.png'),
(26, 'Swansea City', 1, 1, 'swansea_city.png'),
(27, 'Aston Villa', 1, 1, 'aston_villa.png'),
(28, 'Newcastle United', 1, 1, 'newcastle.png'),
(29, 'Leicester City', 1, 1, 'leicester_city.png'),
(30, 'Southampton', 1, 1, 'southampton.png'),
(31, 'Tottenham Hotspurs', 1, 1, 'tottenham.png'),
(32, 'West Bromwich', 1, 1, 'west_brom.png'),
(33, 'Bayern Munich', 14, 1, 'bayern_munich.png'),
(34, 'Elche', 12, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `lms_tournaments`
--

CREATE TABLE IF NOT EXISTS `lms_tournaments` (
  `tournament_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `tournament_code` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `is_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_ended` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `counter` int(10) unsigned NOT NULL,
  PRIMARY KEY (`tournament_id`),
  UNIQUE KEY `tournament_code` (`tournament_code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `lms_tournaments`
--

INSERT INTO `lms_tournaments` (`tournament_id`, `title`, `tournament_code`, `start_date`, `end_date`, `is_active`, `is_ended`, `counter`) VALUES
(44, 'Tournament 1', 'T1', '2015-09-23', '0000-00-00', 1, 0, 8),
(45, 'Tournament 2', 'T2', '2015-10-06', '2015-12-31', 1, 0, 8),
(46, 'Tournament 3', 'T3', '2015-10-03', '2015-10-30', 1, 0, 8),
(47, 'Tournament 4', 'T4', '2015-10-08', '2015-10-13', 1, 0, 8),
(48, 'Tournament 5', 'T5', '2015-10-03', '2015-10-13', 1, 0, 8),
(49, 'Tournament 6', 'T6', '2015-10-06', '2015-10-07', 1, 0, 8),
(50, 'Tournament 7', 'T7', '2015-10-09', '2015-10-29', 1, 0, 8),
(51, 'Tournament 8', 'T8', '2016-03-01', '0000-00-00', 1, 0, 8);

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `check_match_start_time_every_5_mins` ON SCHEDULE EVERY 5 MINUTE STARTS '2015-10-12 00:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Checks every 5 mins and deactivates if match has started' DO UPDATE `lms_matches` SET `lms_matches`.`has_started` = 1 WHERE `lms_matches`.`match_time` < NOW() AND `lms_matches`.`is_active` = 1 AND `lms_matches`.`status` = 0 AND `lms_matches`.`has_started` = 0 AND `lms_matches`.`is_problematic` = 0$$

CREATE DEFINER=`root`@`localhost` EVENT `check_round_close_time_every_5_mins` ON SCHEDULE EVERY 5 MINUTE STARTS '2015-09-26 18:05:03' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Checks every 5 mins and closes round if first match has started' DO UPDATE `lms_rounds` SET `lms_rounds`.`is_closed` = 1 WHERE `lms_rounds`.`close_time` < NOW() AND `lms_rounds`.`is_closed` = 0 AND `lms_rounds`.`is_active` = 1$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
