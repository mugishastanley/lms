-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 23, 2017 at 02:01 PM
-- Server version: 5.6.35
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alphaug_lms`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `clients_tourns`
-- (See below for the actual view)
--
CREATE TABLE `clients_tourns` (
`client_id` int(11)
,`client` varchar(511)
,`is_active` tinyint(1) unsigned
,`tournament_id` int(11)
,`tournament` varchar(255)
,`is_ended` tinyint(1) unsigned
);

-- --------------------------------------------------------

--
-- Table structure for table `lms_admins`
--

CREATE TABLE `lms_admins` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `login_name` varchar(255) NOT NULL,
  `login_password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `allowed_pages` text NOT NULL,
  `start_page` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_admins`
--

INSERT INTO `lms_admins` (`user_id`, `fname`, `lname`, `login_name`, `login_password`, `email`, `phone`, `allowed_pages`, `start_page`, `is_active`) VALUES
(1, 'Owor', 'Yoakim', 'admin', '2e33a9b0b06aa0a01ede70995674ee23', 'oyoakim@yahoo.com', '0773588888', 'cards.php,clients.php,leagues.php,matches.php,pages.php,rounds.php,selections.php,teams.php,tournaments.php,tournament_report1.php,users.php,rounds_report.php,clients_tournaments.php', 'matches.php', 1),
(6, 'Admin', 'Admin', 'oworyk', 'ee0bd60531db77d1c0151d55473d4f97', 'kakbetty@yahoo.com', '0773588888', 'cards.php,clients.php,leagues.php,matches.php,pages.php,rounds.php,selections.php,teams.php,tournaments.php,tournament_report1.php,users.php,rounds_report.php,clients_tournaments.php', 'clients.php', 1),
(8, 'David', 'David', 'David', '38ad33e2fc083c2843f12f8c6bb6b092', 'david@skytower.ug', '7705974222', '0,cards.php,clients.php,matches.php', 'cards.php', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lms_admin_pages`
--

CREATE TABLE `lms_admin_pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `page_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_cards`
--

CREATE TABLE `lms_cards` (
  `card_id` int(11) NOT NULL,
  `card_serial` int(8) UNSIGNED NOT NULL,
  `card_number` int(8) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_cards`
--

INSERT INTO `lms_cards` (`card_id`, `card_serial`, `card_number`) VALUES
(1, 1001, 92195625),
(2, 1002, 94534723),
(3, 1003, 62267716),
(4, 1004, 61374552),
(5, 1005, 40697727),
(6, 1006, 45415457),
(7, 1007, 24696622),
(8, 1008, 45205841),
(9, 1009, 92624544),
(10, 1010, 76777221),
(11, 1011, 38336753),
(12, 1012, 93537830),
(13, 1013, 33248734),
(14, 1014, 36723729),
(15, 1015, 91506022),
(16, 1016, 62376144),
(17, 1017, 22313537),
(18, 1018, 40565766),
(19, 1019, 27333734),
(20, 1020, 43397440),
(21, 1021, 88425252),
(22, 1022, 48357150),
(23, 1023, 76418354),
(24, 1024, 62606057),
(25, 1025, 68367764),
(26, 1026, 62545057),
(27, 1027, 46634550),
(28, 1028, 30425441),
(29, 1029, 37243160),
(30, 1030, 74645330),
(31, 1031, 75536060),
(32, 1032, 96634933),
(33, 1033, 61202920),
(34, 1034, 40673062),
(35, 1035, 37216316);

-- --------------------------------------------------------

--
-- Table structure for table `lms_card_tournaments`
--

CREATE TABLE `lms_card_tournaments` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `tournament_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_card_tournaments`
--

INSERT INTO `lms_card_tournaments` (`id`, `client_id`, `tournament_id`, `is_active`) VALUES
(182, 24, 10, 1),
(183, 52, 10, 1),
(184, 22, 10, 1),
(185, 23, 10, 1),
(186, 53, 10, 1),
(187, 50, 10, 1),
(188, 51, 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_clients`
--

CREATE TABLE `lms_clients` (
  `client_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `login_name` varchar(10) NOT NULL,
  `login_hash` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_clients`
--

INSERT INTO `lms_clients` (`client_id`, `fname`, `lname`, `phone`, `email`, `address`, `login_name`, `login_hash`, `is_active`) VALUES
(22, 'david', 'masembe', '0702008844', 'puyudavids28@gmail.com', NULL, 'masembe', 'e10adc3949ba59abbe56e057f20f883e', 1),
(23, 'davis', 'ampeire', '0705432023', 'ampeiredavis@gmail.com', NULL, 'ampeire', 'e10adc3949ba59abbe56e057f20f883e', 1),
(24, 'a', 'abc', '0702000001', 'abc1@gmail.com', 'abca', 'abca', 'e10adc3949ba59abbe56e057f20f883e', 1),
(50, 'Mugisha', 'Stanley', '0783383534', 'leynsta@gmail.com', 'Mbarara', 'stanley', 'e10adc3949ba59abbe56e057f20f883e', 1),
(51, 'Test', 'Test', '9797979797', 'test@developer.com', 'Mysuru', 'testdev', 'e10adc3949ba59abbe56e057f20f883e', 1),
(52, 'Andrew', 'Andrew', '977777777', 'andy@ymail.com', 'Mysore', 'andym', 'e10adc3949ba59abbe56e057f20f883e', 1),
(53, 'isaac', 'okoth', '0723322820', 'isaacokoth1980@gmail.com', '', 'isaacok', 'f9245c60c3dc29443d37e98a8ad83990', 1),
(54, 'aaa', 'aaa', '09999999', 'oyoakim@yahoo.com', '', 'abcde', '7bc6c31880aeda581aa34e218af25753', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_client_logins`
--

CREATE TABLE `lms_client_logins` (
  `client_login_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lms_client_selections`
--

CREATE TABLE `lms_client_selections` (
  `client_selection_id` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `tournament_id` int(11) DEFAULT NULL,
  `round_id` int(11) DEFAULT NULL,
  `match_id` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `with_draw` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_auto` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `is_win` tinyint(1) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `deleted` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_client_selections`
--

INSERT INTO `lms_client_selections` (`client_selection_id`, `date_created`, `client_id`, `tournament_id`, `round_id`, `match_id`, `team_id`, `with_draw`, `is_auto`, `is_win`, `is_active`, `deleted`) VALUES
(1, '2017-01-10 21:18:48', 24, 10, 54, 86, 31, 0, 0, NULL, 1, 0),
(2, '2017-01-14 15:24:01', 22, 10, 54, 87, 5, 0, 1, NULL, 1, 0),
(3, '2017-01-14 15:24:01', 23, 10, 54, 87, 5, 0, 1, NULL, 1, 0),
(4, '2017-01-14 15:24:01', 53, 10, 54, 87, 5, 0, 1, NULL, 1, 0),
(5, '2017-01-14 15:24:01', 50, 10, 54, 87, 5, 0, 1, NULL, 1, 0),
(6, '2017-01-14 15:24:01', 51, 10, 54, 87, 5, 0, 1, NULL, 1, 0),
(7, '2017-01-14 15:24:01', 52, 10, 54, 87, 5, 0, 1, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lms_countries`
--

CREATE TABLE `lms_countries` (
  `country_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `lms_leagues` (
  `league_id` int(11) NOT NULL,
  `country_id` int(10) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_leagues`
--

INSERT INTO `lms_leagues` (`league_id`, `country_id`, `title`, `code`, `is_active`, `deleted`) VALUES
(1, 281, ' Premier League', 'EngBPL', 1, 0),
(12, 253, 'Liga BBVA', 'LaBBVA', 0, 0),
(14, 130, 'Bundesliga', 'GerBL', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lms_matches`
--

CREATE TABLE `lms_matches` (
  `match_id` int(11) NOT NULL,
  `match_time` datetime DEFAULT NULL,
  `first_team_id` int(11) NOT NULL,
  `second_team_id` int(11) NOT NULL,
  `league_id` int(11) DEFAULT NULL,
  `first_team_score` int(2) UNSIGNED DEFAULT NULL,
  `second_team_score` int(2) UNSIGNED DEFAULT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_problematic` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `has_started` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_matches`
--

INSERT INTO `lms_matches` (`match_id`, `match_time`, `first_team_id`, `second_team_id`, `league_id`, `first_team_score`, `second_team_score`, `status`, `is_problematic`, `is_active`, `has_started`) VALUES
(86, '2017-01-14 15:30:00', 31, 32, 1, NULL, NULL, 0, 0, 1, 1),
(87, '2017-01-14 18:00:00', 26, 5, 1, NULL, NULL, 0, 0, 1, 1),
(88, '2017-01-14 18:00:00', 9, 10, 1, NULL, NULL, 0, 0, 1, 1),
(89, '2017-01-14 20:30:00', 29, 1, 1, NULL, NULL, 0, 0, 1, 1),
(90, '2017-01-14 18:00:00', 35, 30, 1, NULL, NULL, 0, 0, 1, 1),
(91, '2017-01-14 18:00:00', 36, 24, 1, NULL, NULL, 0, 0, 1, 1),
(92, '2017-01-14 18:00:00', 19, 22, 1, NULL, NULL, 0, 0, 1, 1),
(93, '2017-01-14 18:00:00', 16, 37, 1, NULL, NULL, 0, 0, 1, 1),
(94, '2017-01-15 16:30:00', 17, 15, 1, NULL, NULL, 0, 0, 1, 1),
(95, '2017-01-15 19:00:00', 8, 18, 1, NULL, NULL, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_pages`
--

CREATE TABLE `lms_pages` (
  `page_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link_url` varchar(255) NOT NULL DEFAULT '#',
  `parent_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_pages`
--

INSERT INTO `lms_pages` (`page_id`, `title`, `link_url`, `parent_id`) VALUES
(1, 'Matches', 'matches.php', 0),
(2, 'Clients', 'clients.php', 0),
(3, 'Teams', 'teams.php', 1),
(4, 'Tournaments', 'tournaments.php', 0),
(6, 'Users', 'users.php', 0),
(7, 'Leagues', 'leagues.php', 1),
(8, 'Rounds', 'rounds.php', 4),
(9, 'Selections', 'selections.php', 0),
(10, 'Admin Pages', 'pages.php', 6),
(11, 'Tournament Totals', 'tournament_report1.php', 0),
(13, 'Rounds Totals', 'rounds_report.php', 11),
(14, 'Client Tournaments', 'clients_tournaments.php', 2);

-- --------------------------------------------------------

--
-- Table structure for table `lms_rounds`
--

CREATE TABLE `lms_rounds` (
  `round_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `tournament_id` int(11) DEFAULT NULL,
  `date_created` datetime NOT NULL,
  `close_time` datetime NOT NULL,
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `is_closed` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `counter` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_rounds`
--

INSERT INTO `lms_rounds` (`round_id`, `title`, `code`, `tournament_id`, `date_created`, `close_time`, `is_active`, `is_closed`, `counter`) VALUES
(54, 'Round 1', 'R1-T1', 10, '2017-01-10 21:07:33', '2017-01-14 15:30:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_teams`
--

CREATE TABLE `lms_teams` (
  `team_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `league_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_teams`
--

INSERT INTO `lms_teams` (`team_id`, `title`, `league_id`, `is_active`, `logo`) VALUES
(1, 'Chelsea', 1, 1, 'chelsea.png'),
(2, 'Barcelona', 12, 1, 'barcelona.png'),
(5, 'Arsenal', 1, 1, 'arsenal.png'),
(8, 'Manchester United', 1, 1, 'manchester_united.png'),
(9, 'West Ham', 1, 1, 'westham_united.png'),
(10, 'Crystal Palace', 1, 1, 'crystal_palace.png'),
(11, 'Real Madrid', 12, 1, 'real_madrid.png'),
(12, 'Augsburg', 14, 1, 'augsburg.png'),
(15, 'Manchester City', 1, 1, 'manchester_city.png'),
(16, 'Watford', 1, 1, 'watford.png'),
(17, 'Everton', 1, 1, 'everton.png'),
(18, 'Liverpool', 1, 1, 'liverpool.png'),
(19, 'Sunderland', 1, 1, 'sunderland.png'),
(20, 'Borussia Monchengladbach', 14, 1, 'borussia_monchengladbach.png'),
(21, 'Celta Vigo', 12, 1, 'celta_vigo.png'),
(22, 'Stoke City', 1, 1, 'stoke_city.png'),
(23, 'Wolfsburg', 14, 1, 'wolfsburg.png'),
(24, 'Bournemouth', 1, 1, 'bournemouth.png'),
(25, 'Norwich City', 1, 0, 'norwich_city.png'),
(26, 'Swansea City', 1, 1, 'swansea_city.png'),
(27, 'Aston Villa', 1, 0, 'aston_villa.png'),
(28, 'Newcastle United', 1, 0, 'newcastle.png'),
(29, 'Leicester City', 1, 1, 'leicester_city.png'),
(30, 'Southampton', 1, 1, 'southampton.png'),
(31, 'Tottenham', 1, 1, 'tottenham.png'),
(32, 'West Bromwich', 1, 1, 'west_brom.png'),
(33, 'Bayern Munich', 14, 1, 'bayern_munich.png'),
(34, 'Elche', 12, 1, ''),
(35, 'Burnley', 1, 1, 'Burnley.png'),
(36, 'Hull City', 1, 1, 'Hull City.png'),
(37, 'Middlesbrough', 1, 1, 'Middlesbrough.png');

-- --------------------------------------------------------

--
-- Table structure for table `lms_tournaments`
--

CREATE TABLE `lms_tournaments` (
  `tournament_id` int(11) NOT NULL,
  `league_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `tournament_code` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL DEFAULT '0000-00-00',
  `is_active` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `is_ended` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `counter` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lms_tournaments`
--

INSERT INTO `lms_tournaments` (`tournament_id`, `league_id`, `title`, `tournament_code`, `start_date`, `end_date`, `is_active`, `is_ended`, `counter`) VALUES
(10, 1, 'EngBPL Tournament-1', 'EngBPL-T1', '2017-01-10', '0000-00-00', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lms_tournament_winner`
--

CREATE TABLE `lms_tournament_winner` (
  `id` int(11) NOT NULL,
  `tournament_id` int(10) UNSIGNED DEFAULT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Stand-in structure for view `selections`
-- (See below for the actual view)
--
CREATE TABLE `selections` (
`client_selection_id` int(11)
,`date_created` datetime
,`client_id` int(11)
,`tournament_id` int(11)
,`round_id` int(11)
,`match_id` int(11)
,`team_id` int(11)
,`with_draw` tinyint(1) unsigned
,`is_auto` tinyint(3) unsigned
,`is_win` tinyint(1) unsigned
,`is_active` tinyint(1) unsigned
,`deleted` tinyint(1) unsigned
,`client` varchar(511)
,`tournament` varchar(255)
,`round` varchar(255)
,`team` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure for view `clients_tourns`
--
DROP TABLE IF EXISTS `clients_tourns`;

CREATE ALGORITHM=UNDEFINED DEFINER=`alphaug`@`localhost` SQL SECURITY DEFINER VIEW `clients_tourns`  AS  select `c`.`client_id` AS `client_id`,concat_ws(' ',`c`.`fname`,`c`.`lname`) AS `client`,`ct`.`is_active` AS `is_active`,`ct`.`tournament_id` AS `tournament_id`,`t`.`tournament_code` AS `tournament`,`t`.`is_ended` AS `is_ended` from ((`lms_clients` `c` left join `lms_card_tournaments` `ct` on((`c`.`client_id` = `ct`.`client_id`))) left join `lms_tournaments` `t` on((`ct`.`tournament_id` = `t`.`tournament_id`))) ;

-- --------------------------------------------------------

--
-- Structure for view `selections`
--
DROP TABLE IF EXISTS `selections`;

CREATE ALGORITHM=UNDEFINED DEFINER=`alphaug`@`localhost` SQL SECURITY DEFINER VIEW `selections`  AS  select `cs`.`client_selection_id` AS `client_selection_id`,`cs`.`date_created` AS `date_created`,`cs`.`client_id` AS `client_id`,`cs`.`tournament_id` AS `tournament_id`,`cs`.`round_id` AS `round_id`,`cs`.`match_id` AS `match_id`,`cs`.`team_id` AS `team_id`,`cs`.`with_draw` AS `with_draw`,`cs`.`is_auto` AS `is_auto`,`cs`.`is_win` AS `is_win`,`cs`.`is_active` AS `is_active`,`cs`.`deleted` AS `deleted`,concat(`c`.`fname`,' ',`c`.`lname`) AS `client`,`t`.`tournament_code` AS `tournament`,`r`.`code` AS `round`,`tm`.`title` AS `team` from ((((`lms_client_selections` `cs` left join `lms_clients` `c` on((`cs`.`client_id` = `c`.`client_id`))) left join `lms_tournaments` `t` on((`cs`.`tournament_id` = `t`.`tournament_id`))) left join `lms_rounds` `r` on((`cs`.`round_id` = `r`.`round_id`))) left join `lms_teams` `tm` on((`cs`.`team_id` = `tm`.`team_id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lms_admins`
--
ALTER TABLE `lms_admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `lms_admin_pages`
--
ALTER TABLE `lms_admin_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lms_cards`
--
ALTER TABLE `lms_cards`
  ADD PRIMARY KEY (`card_id`),
  ADD UNIQUE KEY `card_number` (`card_number`),
  ADD UNIQUE KEY `card_serial` (`card_serial`);

--
-- Indexes for table `lms_card_tournaments`
--
ALTER TABLE `lms_card_tournaments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `tournament_id` (`tournament_id`);

--
-- Indexes for table `lms_clients`
--
ALTER TABLE `lms_clients`
  ADD PRIMARY KEY (`client_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `login_name` (`login_name`);

--
-- Indexes for table `lms_client_logins`
--
ALTER TABLE `lms_client_logins`
  ADD PRIMARY KEY (`client_login_id`);

--
-- Indexes for table `lms_client_selections`
--
ALTER TABLE `lms_client_selections`
  ADD PRIMARY KEY (`client_selection_id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `round_id` (`round_id`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `lms_countries`
--
ALTER TABLE `lms_countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `lms_leagues`
--
ALTER TABLE `lms_leagues`
  ADD PRIMARY KEY (`league_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `lms_matches`
--
ALTER TABLE `lms_matches`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `first_team_id` (`first_team_id`),
  ADD KEY `second_team_id` (`second_team_id`),
  ADD KEY `lms_matches_ibfk_1` (`league_id`);

--
-- Indexes for table `lms_pages`
--
ALTER TABLE `lms_pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `lms_rounds`
--
ALTER TABLE `lms_rounds`
  ADD PRIMARY KEY (`round_id`),
  ADD KEY `tournament_id` (`tournament_id`);

--
-- Indexes for table `lms_teams`
--
ALTER TABLE `lms_teams`
  ADD PRIMARY KEY (`team_id`),
  ADD UNIQUE KEY `title` (`title`),
  ADD KEY `league_id` (`league_id`);

--
-- Indexes for table `lms_tournaments`
--
ALTER TABLE `lms_tournaments`
  ADD PRIMARY KEY (`tournament_id`),
  ADD UNIQUE KEY `tournament_code` (`tournament_code`);

--
-- Indexes for table `lms_tournament_winner`
--
ALTER TABLE `lms_tournament_winner`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lms_admins`
--
ALTER TABLE `lms_admins`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `lms_admin_pages`
--
ALTER TABLE `lms_admin_pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_cards`
--
ALTER TABLE `lms_cards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `lms_card_tournaments`
--
ALTER TABLE `lms_card_tournaments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;
--
-- AUTO_INCREMENT for table `lms_clients`
--
ALTER TABLE `lms_clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `lms_client_logins`
--
ALTER TABLE `lms_client_logins`
  MODIFY `client_login_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lms_client_selections`
--
ALTER TABLE `lms_client_selections`
  MODIFY `client_selection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `lms_countries`
--
ALTER TABLE `lms_countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=302;
--
-- AUTO_INCREMENT for table `lms_leagues`
--
ALTER TABLE `lms_leagues`
  MODIFY `league_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `lms_matches`
--
ALTER TABLE `lms_matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;
--
-- AUTO_INCREMENT for table `lms_pages`
--
ALTER TABLE `lms_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `lms_rounds`
--
ALTER TABLE `lms_rounds`
  MODIFY `round_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT for table `lms_teams`
--
ALTER TABLE `lms_teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `lms_tournaments`
--
ALTER TABLE `lms_tournaments`
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `lms_tournament_winner`
--
ALTER TABLE `lms_tournament_winner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `lms_card_tournaments`
--
ALTER TABLE `lms_card_tournaments`
  ADD CONSTRAINT `lms_card_tournaments_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `lms_clients` (`client_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lms_card_tournaments_ibfk_2` FOREIGN KEY (`tournament_id`) REFERENCES `lms_tournaments` (`tournament_id`) ON DELETE SET NULL;

--
-- Constraints for table `lms_client_selections`
--
ALTER TABLE `lms_client_selections`
  ADD CONSTRAINT `lms_client_selections_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `lms_clients` (`client_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lms_client_selections_ibfk_2` FOREIGN KEY (`tournament_id`) REFERENCES `lms_tournaments` (`tournament_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lms_client_selections_ibfk_3` FOREIGN KEY (`round_id`) REFERENCES `lms_rounds` (`round_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lms_client_selections_ibfk_4` FOREIGN KEY (`match_id`) REFERENCES `lms_matches` (`match_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `lms_client_selections_ibfk_5` FOREIGN KEY (`team_id`) REFERENCES `lms_teams` (`team_id`) ON DELETE SET NULL;

--
-- Constraints for table `lms_leagues`
--
ALTER TABLE `lms_leagues`
  ADD CONSTRAINT `lms_leagues_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `lms_countries` (`country_id`) ON DELETE SET NULL;

--
-- Constraints for table `lms_matches`
--
ALTER TABLE `lms_matches`
  ADD CONSTRAINT `lms_matches_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `lms_leagues` (`league_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `lms_rounds`
--
ALTER TABLE `lms_rounds`
  ADD CONSTRAINT `lms_rounds_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `lms_tournaments` (`tournament_id`) ON DELETE SET NULL;

--
-- Constraints for table `lms_teams`
--
ALTER TABLE `lms_teams`
  ADD CONSTRAINT `lms_teams_ibfk_1` FOREIGN KEY (`league_id`) REFERENCES `lms_leagues` (`league_id`) ON DELETE SET NULL;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`alphaug`@`localhost` EVENT `check_is_closed_after_5_minutes` ON SCHEDULE EVERY 5 MINUTE STARTS '2015-10-02 20:00:00' ON COMPLETION NOT PRESERVE ENABLE COMMENT 'Checks every 5 mins and closes round if first match has started' DO UPDATE `lms_rounds` SET `lms_rounds`.`is_closed` = 1 WHERE `lms_rounds`.`close_time` < NOW() AND `lms_rounds`.`is_closed` = 0$$

DELIMITER ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
