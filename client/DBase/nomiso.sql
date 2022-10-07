-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2019 at 02:11 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nomiso`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `clid` int(11) NOT NULL,
  `clfname` varchar(100) NOT NULL,
  `cllname` varchar(100) NOT NULL,
  `clgender` varchar(10) NOT NULL,
  `clphone` varchar(20) NOT NULL,
  `clidno` bigint(20) NOT NULL,
  `clemail` varchar(100) NOT NULL,
  `claddress` int(11) NOT NULL,
  `clpass` varchar(100) NOT NULL,
  `clregdate` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clid`, `clfname`, `cllname`, `clgender`, `clphone`, `clidno`, `clemail`, `claddress`, `clpass`, `clregdate`) VALUES
(1, 'Simon', 'NDIZIHIWE', 'Male', '0783988060', 1199980063607186, 'nomis.pro24@gmail.com', 213, '$2y$12$3FGoHWnBFAaZP8XhLtGlCOfYtAeuvBJyjvF.FwRm1IBUsosOW3YVe', '20190903 09:51:38'),
(2, 'Sabato', 'HAKIZIMANA', 'Male', '0788242167', 1199780036218735, 'sabato.ars@gmail.com', 124, '$2y$12$YSdKdzPhIucqoMjMiJD1wuQr88pFLoa/Eu2wgWKa18/8ItMNdXP.i', '20190903 10:01:15'),
(3, 'Nomiso', 'Wazeh', 'Male', '0787080060', 1199980063607000, 'nomiso.pro12@gmail.com', 213, '$2y$12$o3D91qNXGBEgyqUTbuvxNuxmESdTc92Pc9PDFRs/qlT7jhLAHvO8O', '20190904 09:37:11'),
(4, 'y', 'i', 'Male', '9', 98765, 'hello@gmail.com', 112, '$2y$12$CyM5.7PJmB9k9LwNjZfrGuyBIbpBZy/FLUgy9183qR9SF8YyfHJeW', '20190904 09:40:48'),
(5, 'Hi', 'Boy', 'Male', '987', 98765, 'kjhg@guh.com', 113, '$2y$12$pA68zigWo5VNECqwY166t.XoPstdwwf4vRAntj.j3xn1QbDN9kcni', '20190904 12:36:49'),
(6, 'Hi', 'Boy', 'Male', '987', 98765, 'kjhg@guh.com', 113, '$2y$12$Tp25roU/Y5gcRWU4elEEV.LAlQxMHO9cyR5O3bxZ5MS3i.kPHX8Fi', '20190904 12:36:49');

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `distid` int(11) NOT NULL,
  `distname` varchar(100) NOT NULL,
  `province` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`distid`, `distname`, `province`) VALUES
(1, 'Bugesera', 1),
(2, 'Gatsibo', 1),
(3, 'Kayonza', 1),
(4, 'Kirehe', 1),
(5, 'Ngoma', 1),
(6, 'Nyagatare', 1),
(7, 'Rwamagana', 1),
(8, 'Gasabo', 2),
(9, 'Kicukiro', 2),
(10, 'Nyarugenge', 2),
(11, 'Burera', 3),
(12, 'Gakenke', 3),
(13, 'Gicumbi', 3),
(14, 'Musanze', 3),
(15, 'Rulindo', 3),
(16, 'Gisagara', 4),
(17, 'Huye', 4),
(18, 'Kamonyi', 4),
(19, 'Muhanga', 4),
(20, 'Nyamagabe', 4),
(21, 'Nyanza', 4),
(22, 'Nyaruguru', 4),
(23, 'Ruhango', 4),
(24, 'Karongi', 5),
(25, 'Ngororero', 5),
(26, 'Nyabihu', 5),
(27, 'Nyamasheke', 5),
(28, 'Rubavu', 5),
(29, 'Rusizi', 5),
(30, 'Rutsiro', 5);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `docid` int(11) NOT NULL,
  `docowner` varchar(200) NOT NULL,
  `doctype` int(11) NOT NULL,
  `docno` varchar(100) NOT NULL,
  `docplace` varchar(100) NOT NULL,
  `docposter` int(11) NOT NULL,
  `docdeclarer` int(11) NOT NULL,
  `docfound` varchar(200) NOT NULL DEFAULT '0',
  `docstate` int(11) NOT NULL,
  `docstatus` int(11) NOT NULL,
  `docregdate` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`docid`, `docowner`, `doctype`, `docno`, `docplace`, `docposter`, `docdeclarer`, `docfound`, `docstate`, `docstatus`, `docregdate`) VALUES
(1, 'Nomis hellos', 2, '89999999999', 'Kicukiro', 1, 2, '20190916 07:58:40', 0, 1, '20190916 07:56:08'),
(2, 'Mihigo hughieeerer', 3, '1223267', 'Gasabo', 1, 1, '20190924 13:42:50', 0, 1, '20190916 07:56:39'),
(3, 'Nomis hellos', 1, '1199980063607186', 'Rulindo/Murambi', 2, 1, '0', 1, 1, '20190916 07:58:40'),
(4, 'Mihigo hughie', 2, '1223267', 'Mugamba', 2, 1, '20190916 19:35:11', 1, 1, '20190916 19:35:11'),
(7, 'Hello', 2, '123', 'Gatare', 2, 0, '0', 1, 0, '20190924 12:34:09'),
(8, 'Huno Blasir', 2, '3223', 'Ndubaa', 1, 1, '20190924 13:38:37', 1, 1, '20190924 13:30:21'),
(9, 'Karim Edoucee', 3, '65433', 'Kicukirooo', 1, 1, '20190924 13:35:54', 1, 1, '20190924 13:35:10'),
(10, 'Nomis hellos', 3, '1223267', 'Kicukiro', 1, 1, '20190924 13:42:50', 1, 1, '20190924 13:42:50'),
(11, 'Buum', 1, '5433', 'ksss', 1, 2, '20190924 13:48:35', 1, 1, '20190924 13:43:26'),
(12, 'Buumu', 1, '5433', 'ksss', 2, 1, '20190924 13:48:35', 0, 1, '20190924 13:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `documenttype`
--

CREATE TABLE `documenttype` (
  `dtypeid` int(11) NOT NULL,
  `dtypename` varchar(100) NOT NULL,
  `dtypedesc` varchar(200) NOT NULL,
  `dtyperegdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documenttype`
--

INSERT INTO `documenttype` (`dtypeid`, `dtypename`, `dtypedesc`, `dtyperegdate`) VALUES
(1, 'National ID', 'National Identity card', '2019-09-04 20:25:40'),
(2, 'Driving license', 'Vehicle driving license in Rwanda', '2019-09-04 21:01:44'),
(3, 'Passport', 'Document that allows individuals to go or live in foreign country', '2019-09-16 08:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notid` int(11) NOT NULL,
  `sendernot` varchar(200) NOT NULL,
  `receivernot` varchar(200) NOT NULL,
  `notsender` int(11) NOT NULL,
  `notreceiver` int(11) NOT NULL,
  `notdoc` int(11) NOT NULL,
  `nottime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notid`, `sendernot`, `receivernot`, `notsender`, `notreceiver`, `notdoc`, `nottime`) VALUES
(1, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 2, 1, 1, '2019-09-16 07:58:40'),
(2, 'Document you posted have found its owner, Thank you for helping', 'Your document is found, conglatulations!', 2, 1, 2, '2019-09-16 19:35:11'),
(3, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 1, 1, 9, '2019-09-24 13:35:54'),
(4, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 1, 1, 8, '2019-09-24 13:38:37'),
(5, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 1, 1, 2, '2019-09-24 13:42:50'),
(6, 'Here your document is found, conglatulations!', 'Document you posted have found its owner, Thank you for helping', 2, 1, 11, '2019-09-24 13:48:35');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `provid` int(11) NOT NULL,
  `provname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`provid`, `provname`) VALUES
(1, 'Eastern'),
(2, 'Kigali City'),
(3, 'Northern'),
(4, 'Southern'),
(5, 'Western');

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `sectid` int(11) NOT NULL,
  `sectname` varchar(100) NOT NULL,
  `district` int(11) NOT NULL,
  `province` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`sectid`, `sectname`, `district`, `province`) VALUES
(1, 'Gashora', 1, 1),
(2, 'Juru', 1, 1),
(3, 'Kamabuye', 1, 1),
(4, 'Ntarama', 1, 1),
(5, 'Mareba', 1, 1),
(6, 'Mayange', 1, 1),
(7, 'Musenyi', 1, 1),
(8, 'Mwogo', 1, 1),
(9, 'Ngeruka', 1, 1),
(10, 'Nyamata', 1, 1),
(11, 'Nyarugenge', 1, 1),
(12, 'Rilima', 1, 1),
(13, 'Ruhuha', 1, 1),
(14, 'Rweru', 1, 1),
(15, 'Shyara', 1, 1),
(16, 'Gasange', 2, 1),
(17, 'Gatsibo', 2, 1),
(18, 'Gitoki', 2, 1),
(19, 'Kabarore', 2, 1),
(20, 'Kageyo', 2, 1),
(21, 'Kiramuruzi', 2, 1),
(22, 'Kiziguro', 2, 1),
(23, 'Muhura', 2, 1),
(24, 'Murambi', 2, 1),
(25, 'Ngarama', 2, 1),
(26, 'Nyagihanga', 2, 1),
(27, 'Remera', 2, 1),
(28, 'Rugarama', 2, 1),
(29, 'Rwimbogo', 2, 1),
(30, 'Gahini', 3, 1),
(31, 'Kabare', 3, 1),
(32, 'Kabarondo', 3, 1),
(33, 'Mukarange', 3, 1),
(34, 'Murama', 3, 1),
(35, 'Murundi', 3, 1),
(36, 'Mwiri', 3, 1),
(37, 'Ndego', 3, 1),
(38, 'Nyamirama', 3, 1),
(39, 'Rukara', 3, 1),
(40, 'Ruramira', 3, 1),
(41, 'Rwinkwavu', 3, 1),
(42, 'Gahara', 4, 1),
(43, 'Gatore', 4, 1),
(44, 'Kigina', 4, 1),
(45, 'Kirehe', 4, 1),
(46, 'Mahama', 4, 1),
(47, 'Mpaanga', 4, 1),
(48, 'Musaza', 4, 1),
(49, 'Mushikiri', 4, 1),
(50, 'Naasho', 4, 1),
(51, 'Nyamugari', 4, 1),
(52, 'Nyarubuye', 4, 1),
(53, 'Kigarama', 4, 1),
(54, 'Gashanda', 5, 1),
(55, 'Jarama', 5, 1),
(56, 'Karembo', 5, 1),
(57, 'Kazo', 5, 1),
(58, 'Kibungo', 5, 1),
(59, 'Mugesera', 5, 1),
(60, 'Murama', 5, 1),
(61, 'Mutenderi', 5, 1),
(62, 'Remera', 5, 1),
(63, 'Rukira', 5, 1),
(64, 'Rukumberi', 5, 1),
(65, 'Rurenge', 5, 1),
(66, 'Sake', 5, 1),
(67, 'Zaza', 5, 1),
(68, 'Gatunda', 6, 1),
(69, 'Kiyombe', 6, 1),
(70, 'Karama', 6, 1),
(71, 'Karangazi', 6, 1),
(72, 'Katabagemu', 6, 1),
(73, 'Matimba', 6, 1),
(74, 'Mimuli', 6, 1),
(75, 'Mukama', 6, 1),
(76, 'Musheli', 6, 1),
(77, 'Nyagatare', 6, 1),
(78, 'Rukomo', 6, 1),
(79, 'Rwempasha', 6, 1),
(80, 'Rwimiyaga', 6, 1),
(81, 'Tabagwe', 6, 1),
(82, 'Fumbwe', 7, 1),
(83, 'Gahengeri', 7, 1),
(84, 'Gishari', 7, 1),
(85, 'Karenge', 7, 1),
(86, 'Kigabiro', 7, 1),
(87, 'Muhazi', 7, 1),
(88, 'Munyaga', 7, 1),
(89, 'Munyiginya', 7, 1),
(90, 'Musha', 7, 1),
(91, 'Muyumbu', 7, 1),
(92, 'Mwulire', 7, 1),
(93, 'Nyakariro', 7, 1),
(94, 'Nzige', 7, 1),
(95, 'Rubona', 7, 1),
(96, 'Bumbogo', 8, 2),
(97, 'Gatsata', 8, 2),
(98, 'Jali', 8, 2),
(99, 'Gikomero', 8, 2),
(100, 'Gisozi', 8, 2),
(101, 'Jabana', 8, 2),
(102, 'Kinyinya', 8, 2),
(103, 'Ndera', 8, 2),
(104, 'Nduba', 8, 2),
(105, 'Rusororo', 8, 2),
(106, 'Rutunga', 8, 2),
(107, 'Kacyiru', 8, 2),
(108, 'Kimihurura', 8, 2),
(109, 'Kimironko', 8, 2),
(110, 'Remera', 8, 2),
(111, 'Gahanga', 9, 2),
(112, 'Gatenga', 9, 2),
(113, 'Gikondo', 9, 2),
(114, 'Kagarama', 9, 2),
(115, 'Kanombe', 9, 2),
(116, 'Kicukiro', 9, 2),
(117, 'Kigarama', 9, 2),
(118, 'Masaka', 9, 2),
(119, 'Niboye', 9, 2),
(120, 'Nyarugunga', 9, 2),
(121, 'Gitega', 10, 2),
(122, 'Kanyinya', 10, 2),
(123, 'Kigali', 10, 2),
(124, 'Kimisagara', 10, 2),
(125, 'Mageragere', 10, 2),
(126, 'Muhima', 10, 2),
(127, 'Nyakabanda', 10, 2),
(128, 'Nyamirambo', 10, 2),
(129, 'Rwezamenyo', 10, 2),
(130, 'Nyarugenge', 10, 2),
(131, 'Bungwe', 11, 3),
(132, 'Butaro', 11, 3),
(133, 'Cyanika', 11, 3),
(134, 'Cyeru', 11, 3),
(135, 'Gahunga', 11, 3),
(136, 'Gatebe', 11, 3),
(137, 'Gitovu', 11, 3),
(138, 'Kagogo', 11, 3),
(139, 'Kinoni', 11, 3),
(140, 'Kinyababa', 11, 3),
(141, 'Kivuye', 11, 3),
(142, 'Nemba', 11, 3),
(143, 'Rugarama', 11, 3),
(144, 'Rugendabari', 11, 3),
(145, 'Ruhunde', 11, 3),
(146, 'Rusarabuge', 11, 3),
(147, 'Rwerere', 11, 3),
(148, 'Busengo', 12, 3),
(149, 'Coko', 12, 3),
(150, 'Cyabingo', 12, 3),
(151, 'Gakenke', 12, 3),
(152, 'Gashenyi', 12, 3),
(153, 'Mugunga', 12, 3),
(154, 'Janja', 12, 3),
(155, 'Kamubuga', 12, 3),
(156, 'Karambo', 12, 3),
(157, 'Kivuruga', 12, 3),
(158, 'Mataba', 12, 3),
(159, 'Minazi', 12, 3),
(160, 'Muhondo', 12, 3),
(161, 'Muyongwe', 12, 3),
(162, 'Muzo', 12, 3),
(163, 'Nemba', 12, 3),
(164, 'Ruli', 12, 3),
(165, 'Rusasa', 12, 3),
(166, 'Rushashi', 12, 3),
(167, 'Bukure', 13, 3),
(168, 'Bwisige', 13, 3),
(169, 'Byumba', 13, 3),
(170, 'Cyumba', 13, 3),
(171, 'Giti', 13, 3),
(172, 'Kaniga', 13, 3),
(173, 'Manyagiro', 13, 3),
(174, 'Miyove', 13, 3),
(175, 'Kageyo', 13, 3),
(176, 'Mukarange', 13, 3),
(177, 'Muko', 13, 3),
(178, 'Mutete', 13, 3),
(179, 'Nyamiyaga', 13, 3),
(180, 'Nyankenke', 13, 3),
(181, 'Rubaya', 13, 3),
(182, 'Rukomo', 13, 3),
(183, 'Rushaki', 13, 3),
(184, 'Rutare', 13, 3),
(185, 'Ruvune', 13, 3),
(186, 'Rwamiko', 13, 3),
(187, 'Shangasha', 13, 3),
(188, 'Busogo', 14, 3),
(189, 'Cyuve', 14, 3),
(190, 'Gacaca', 14, 3),
(191, 'Gashaki', 14, 3),
(192, 'Gataraga', 14, 3),
(193, 'Kimonyi', 14, 3),
(194, 'Kinigi', 14, 3),
(195, 'Muhoza', 14, 3),
(196, 'Muko', 14, 3),
(197, 'Musanze', 14, 3),
(198, 'Nkotsi', 14, 3),
(199, 'Nyange', 14, 3),
(200, 'Remera', 14, 3),
(201, 'Rwaza', 14, 3),
(202, 'Shingiro', 14, 3),
(203, 'Base', 15, 3),
(204, 'Burega', 15, 3),
(205, 'Bushoki', 15, 3),
(206, 'Buyoga', 15, 3),
(207, 'Cyinzuzi', 15, 3),
(208, 'Cyungo', 15, 3),
(209, 'Kinihira', 15, 3),
(210, 'Kisaro', 15, 3),
(211, 'Masoro', 15, 3),
(212, 'Mbogo', 15, 3),
(213, 'Murambi', 15, 3),
(214, 'Ngoma', 15, 3),
(215, 'Ntarabana', 15, 3),
(216, 'Rukozo', 15, 3),
(217, 'Rusiga', 15, 3),
(218, 'Shyorongi', 15, 3),
(219, 'Tumba', 15, 3),
(220, 'Gikonko', 16, 4),
(221, 'Gishubi', 16, 4),
(222, 'Kansi', 16, 4),
(223, 'Kibilizi', 16, 4),
(224, 'Kigembe', 16, 4),
(225, 'Mamba', 16, 4),
(226, 'Muganza', 16, 4),
(227, 'Mugombwa', 16, 4),
(228, 'Mukindo', 16, 4),
(229, 'Musha', 16, 4),
(230, 'Ndora', 16, 4),
(231, 'Nyanza', 16, 4),
(232, 'Save', 16, 4),
(233, 'Gishamvu', 17, 4),
(234, 'Karama', 17, 4),
(235, 'Kigoma', 17, 4),
(236, 'Kinazi', 17, 4),
(237, 'Maraba', 17, 4),
(238, 'Mbazi', 17, 4),
(239, 'Mukura', 17, 4),
(240, 'Ngoma', 17, 4),
(241, 'Ruhashya', 17, 4),
(242, 'Rusatira', 17, 4),
(243, 'Rwaniro', 17, 4),
(244, 'Simbi', 17, 4),
(245, 'Tumba', 17, 4),
(246, 'Huye', 17, 4),
(247, 'Gacurabwenge', 18, 4),
(248, 'Karama', 18, 4),
(249, 'Kayenzi', 18, 4),
(250, 'Kayumbu', 18, 4),
(251, 'Mugina', 18, 4),
(252, 'Musambira', 18, 4),
(253, 'Ngamba', 18, 4),
(254, 'Nyamiyaga', 18, 4),
(255, 'Nyarubaka', 18, 4),
(256, 'Rugalika', 18, 4),
(257, 'Rukoma', 18, 4),
(258, 'Runda', 18, 4),
(259, 'Cyeza', 19, 4),
(260, 'Kabacuzi', 19, 4),
(261, 'Kibangu', 19, 4),
(262, 'Kiyumba', 19, 4),
(263, 'Muhanga', 19, 4),
(264, 'Mushishiro', 19, 4),
(265, 'Nyabinoni', 19, 4),
(266, 'Nyamabuye', 19, 4),
(267, 'Nyarusange', 19, 4),
(268, 'Rongi', 19, 4),
(269, 'Rugendabari', 19, 4),
(270, 'Shyogwe', 19, 4),
(271, 'Buruhukiro', 20, 4),
(272, 'Cyanika', 20, 4),
(273, 'Gatare', 20, 4),
(274, 'Kaduha', 20, 4),
(275, 'Kamegeli', 20, 4),
(276, 'Kibirizi', 20, 4),
(277, 'Kibumbwe', 20, 4),
(278, 'Kitabi', 20, 4),
(279, 'Mbazi', 20, 4),
(280, 'Mugano', 20, 4),
(281, 'Musange', 20, 4),
(282, 'Musebeya', 20, 4),
(283, 'Mushubi', 20, 4),
(284, 'Nkomane', 20, 4),
(285, 'Gasaka', 20, 4),
(286, 'Tare', 20, 4),
(287, 'Uwinkingi', 20, 4),
(288, 'Busasamana', 21, 4),
(289, 'Busoro', 21, 4),
(290, 'Cyabakamyi', 21, 4),
(291, 'Kibirizi', 21, 4),
(292, 'Kigoma', 21, 4),
(293, 'Mukingo', 21, 4),
(294, 'Rwabicuma', 21, 4),
(295, 'Muyira', 21, 4),
(296, 'Ntyazo', 21, 4),
(297, 'Nyagisozi', 21, 4),
(298, 'Cyahinda', 22, 4),
(299, 'Busanze', 22, 4),
(300, 'Kibeho', 22, 4),
(301, 'Mata', 22, 4),
(302, 'Munini', 22, 4),
(303, 'Kivu', 22, 4),
(304, 'Ngera', 22, 4),
(305, 'Ngoma', 22, 4),
(306, 'Nyabimata', 22, 4),
(307, 'Nyagisozi', 22, 4),
(308, 'Ruheru', 22, 4),
(309, 'Muganza', 22, 4),
(310, 'Ruramba', 22, 4),
(311, 'Rusenge', 22, 4),
(312, 'Bweramana', 23, 4),
(313, 'Byimana', 23, 4),
(314, 'Kabagari', 23, 4),
(315, 'Kinazi', 23, 4),
(316, 'Kinihira', 23, 4),
(317, 'Mbuye', 23, 4),
(318, 'Mwendo', 23, 4),
(319, 'Ntongwe', 23, 4),
(320, 'Ruhango', 23, 4),
(321, 'Bwishyura', 24, 5),
(322, 'Gishari', 24, 5),
(323, 'Gishyita', 24, 5),
(324, 'Gisovu', 24, 5),
(325, 'Gitesi', 24, 5),
(326, 'Murundi', 24, 5),
(327, 'Murambi', 24, 5),
(328, 'Mubuga', 24, 5),
(329, 'Mutuntu', 24, 5),
(330, 'Rugabano', 24, 5),
(331, 'Ruganda', 24, 5),
(332, 'Rwankuba', 24, 5),
(333, 'Twumba', 24, 5),
(334, 'Bwira', 25, 5),
(335, 'Gatumba', 25, 5),
(336, 'Hindiro', 25, 5),
(337, 'Kabaya', 25, 5),
(338, 'Kageyo', 25, 5),
(339, 'Kavumu', 25, 5),
(340, 'Matyazo', 25, 5),
(341, 'Muhanda', 25, 5),
(342, 'Muhororo', 25, 5),
(343, 'Ndaro', 25, 5),
(344, 'Ngororero', 25, 5),
(345, 'Nyange', 25, 5),
(346, 'Sovu', 25, 5),
(347, 'Bigogwe', 26, 5),
(348, 'Jenda', 26, 5),
(349, 'Jomba', 26, 5),
(350, 'Kabatwa', 26, 5),
(351, 'Karago', 26, 5),
(352, 'Kintobo', 26, 5),
(353, 'Mukamira', 26, 5),
(354, 'Muringa', 26, 5),
(355, 'Rambura', 26, 5),
(356, 'Rugera', 26, 5),
(357, 'Rurembo', 26, 5),
(358, 'Shyira', 26, 5),
(359, 'Bushekeri', 27, 5),
(360, 'Bushenge', 27, 5),
(361, 'Cyato', 27, 5),
(362, 'Gihombo', 27, 5),
(363, 'Kagano', 27, 5),
(364, 'Kanjongo', 27, 5),
(365, 'Karambi', 27, 5),
(366, 'Karengera', 27, 5),
(367, 'Kirimbi', 27, 5),
(368, 'Macuba', 27, 5),
(369, 'Mahembe', 27, 5),
(370, 'Nyabitekeri', 27, 5),
(371, 'Rangiro', 27, 5),
(372, 'Ruharambuga', 27, 5),
(373, 'Shangi', 27, 5),
(374, 'Bugeshi', 28, 5),
(375, 'Busasamana', 28, 5),
(376, 'Cyanzarwe', 28, 5),
(377, 'Gisenyi', 28, 5),
(378, 'Kanama', 28, 5),
(379, 'Kanzenze', 28, 5),
(380, 'Mudende', 28, 5),
(381, 'Nyakiliba', 28, 5),
(382, 'Nyamyumba', 28, 5),
(383, 'Nyundo', 28, 5),
(384, 'Rubavu', 28, 5),
(385, 'Rugerero', 28, 5),
(386, 'Bugarama', 29, 5),
(387, 'Butare', 29, 5),
(388, 'Bweyeye', 29, 5),
(389, 'Gikundamvura', 29, 5),
(390, 'Gashonga', 29, 5),
(391, 'Giheke', 29, 5),
(392, 'Gihundwe', 29, 5),
(393, 'Gitambi', 29, 5),
(394, 'Kamembe', 29, 5),
(395, 'Muganza', 29, 5),
(396, 'Mururu', 29, 5),
(397, 'Nkanka', 29, 5),
(398, 'Nkombo', 29, 5),
(399, 'Nkungu', 29, 5),
(400, 'Nyakabuye', 29, 5),
(401, 'Nyakarenzo', 29, 5),
(402, 'Nzahaha', 29, 5),
(403, 'Rwimbogo', 29, 5),
(404, 'Boneza', 30, 5),
(405, 'Gihango', 30, 5),
(406, 'Kigeyo', 30, 5),
(407, 'Kivumu', 30, 5),
(408, 'Manihira', 30, 5),
(409, 'Mukura', 30, 5),
(410, 'Murunda', 30, 5),
(411, 'Musasa', 30, 5),
(412, 'Mushonyi', 30, 5),
(413, 'Mushubati', 30, 5),
(414, 'Nyabirasi', 30, 5),
(415, 'Ruhango', 30, 5),
(416, 'Rusebeya', 30, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `ufname` varchar(100) NOT NULL,
  `ulname` varchar(100) NOT NULL,
  `ugender` varchar(50) NOT NULL,
  `uidno` bigint(20) NOT NULL,
  `uemail` varchar(100) NOT NULL,
  `uphone` varchar(20) NOT NULL,
  `upass` varchar(100) NOT NULL,
  `uaddress` int(11) NOT NULL,
  `ulocation` varchar(100) NOT NULL,
  `utype` varchar(100) NOT NULL,
  `udistrict` int(11) NOT NULL,
  `reguser` int(11) NOT NULL,
  `uregdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `ufname`, `ulname`, `ugender`, `uidno`, `uemail`, `uphone`, `upass`, `uaddress`, `ulocation`, `utype`, `udistrict`, `reguser`, `uregdate`) VALUES
(1, 'RITCO LTD', 'Biryogo', '1', 0, 'info@ritcorwanda.com', '0786545122', '$2y$12$Yo5aCtotOetwMCRTABHkAeEQMDLeu3Vv1T0dYLAMtrBDnolzk7g36', 0, 'KN 7 AVE', 'Organization', 0, 0, '2019-09-19 14:09:08'),
(2, 'Haruna', 'Emma', 'Male', 1198980026732167, 'huye@gmail.com', '0785454344', '$2y$12$.MrOH4ZRDAhhd56gYCm5nuY1AjtLGEUZKWElAi00aouGhvHJJrX9W', 192, 'SH 527 ST', 'District', 17, 0, '2019-09-19 14:13:27'),
(3, 'Nomis', 'Wazeh', 'Male', 1199980063607000, 'nomis@gmail.com', '0787080060', '$2y$12$MEboNpItIVub.h9cX/TxmODO5onOovDTG.cLRZAy/iLHHrLmFtRXS', 213, '', 'Super', 0, 0, '2019-09-19 14:15:07'),
(4, 'New', 'Member', 'Female', 1198770087452154, 'hello@gmail.com', '0722431232', '$2y$12$vX73ssAjhpxxLTUWye6hMuHB8QU/QnqWjO6uvWxBCnBM4uHwXZQPi', 112, '', 'Super', 0, 1, '2019-09-29 13:59:21'),
(5, 'Gakwisi', 'Egide', 'Male', 119918002334881, 'ngoma@gov.rw', '0788453213', '$2y$12$gnp7U8hm.e5FVv9Rybksc.JoYBX1RlUhzdPHeewphkuactBu13xii', 56, 'Karembo mataba', 'District', 5, 1, '2019-09-29 14:01:38'),
(6, 'IRWUBITSO Ese', 'Downtown', '1', 0, 'sina@urwibutso.rw', '0788832141', '$2y$12$I02swPLGyYC9czehEhuTr.Ns9/p6J/84O6IgvciV0UUAQgPajUvlO', 0, 'KN 16 st', 'Organization', 0, 1, '2019-09-29 14:05:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`clid`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`distid`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`docid`);

--
-- Indexes for table `documenttype`
--
ALTER TABLE `documenttype`
  ADD PRIMARY KEY (`dtypeid`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notid`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`provid`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`sectid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `distid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `documenttype`
--
ALTER TABLE `documenttype`
  MODIFY `dtypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `provid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `sectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=417;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
