-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 08, 2019 at 08:23 PM
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
-- Table structure for table `activitylog`
--

CREATE TABLE `activitylog` (
  `actid` int(11) NOT NULL,
  `actdesc` varchar(100) NOT NULL,
  `actuser` varchar(50) NOT NULL,
  `actuserid` int(11) NOT NULL,
  `acttime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activitylog`
--

INSERT INTO `activitylog` (`actid`, `actdesc`, `actuser`, `actuserid`, `acttime`) VALUES
(1, 'Disabled client user', 'Admin', 4, '2019-11-06 10:16:00'),
(2, 'Disabled client user', 'Admin', 4, '2019-11-06 10:17:35'),
(3, 'Enabled client user', 'Admin', 4, '2019-11-06 10:19:28'),
(4, 'Disabled sector user', 'Admin', 3, '2019-11-06 12:27:30'),
(5, 'Enabled sector user', 'Admin', 4, '2019-11-06 12:28:10'),
(6, 'Disabled sector user', 'Admin', 3, '2019-11-06 12:29:41'),
(7, 'Disabled sector user', 'Admin', 3, '2019-11-06 12:29:46'),
(8, 'Disabled sector user', 'Admin', 3, '2019-11-06 12:29:47'),
(9, 'Disabled sector user', 'Admin', 3, '2019-11-06 12:29:49'),
(10, 'Enabled sector user', 'Admin', 4, '2019-11-06 12:29:57'),
(11, 'Created account', 'Client', 10, '2019-11-06 12:37:49');

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
  `clpass` varchar(255) NOT NULL,
  `clphoto` varchar(200) NOT NULL,
  `clstatus` int(11) NOT NULL DEFAULT 1,
  `clregdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`clid`, `clfname`, `cllname`, `clgender`, `clphone`, `clidno`, `clemail`, `claddress`, `clpass`, `clphoto`, `clstatus`, `clregdate`) VALUES
(1, 'Simon', 'NDIZIHIWE', 'Male', '0783988060', 1199980063607186, 'nomis.pro24@gmail.com', 213, '$2y$12$15P598JT3gMV3GbUNlXmzu2f7rzzN0INVnEkGF4qL0tnEo9RVkCzq', 'avatar/UR-LOGO.jpg', 1, '2019-10-01 05:04:08'),
(2, 'Sabato', 'HAKIZIMANA', 'Male', '0788242167', 1199780036218735, 'sabato.ars@gmail.com', 124, '$2y$12$s6DZn4OOqmfJkxnh9ZY8reJBIS9MQoAynWrST42/GF.OYpZBY4Pii', 'avatar/DSC_0091[1].jpg', 1, '2019-10-30 12:25:00'),
(3, 'Nomiso', 'Wazeh', 'Male', '0787080060', 1199980063607000, 'nomiso.pro12@gmail.com', 213, '$2y$12$o3D91qNXGBEgyqUTbuvxNuxmESdTc92Pc9PDFRs/qlT7jhLAHvO8O', '', 1, '2019-09-10 13:16:12'),
(4, 'y', 'i', 'Male', '9', 98765, 'hello@gmail.com', 112, '$2y$12$CyM5.7PJmB9k9LwNjZfrGuyBIbpBZy/FLUgy9183qR9SF8YyfHJeW', '', 1, '2019-10-31 10:31:00'),
(5, 'Hi', 'Boy', 'Male', '987', 98765, 'kjhg@guh.com', 113, '$2y$12$pA68zigWo5VNECqwY166t.XoPstdwwf4vRAntj.j3xn1QbDN9kcni', '', 1, '2019-06-18 04:09:23'),
(6, 'Hi', 'Boy', 'Male', '987', 98765, 'kjhg@guh.com', 113, '$2y$12$Tp25roU/Y5gcRWU4elEEV.LAlQxMHO9cyR5O3bxZ5MS3i.kPHX8Fi', '', 1, '2019-02-27 12:31:25'),
(7, 'Twiso', 'Ishimwe', 'Male', '07890', 12006, 'twiso@gmail.com', 213, '$2y$12$xXRz7ijgk47Tnh/FQ/qseeXMVKBMlvckjoG5z4HhmbzuMhh4fLPOW', 'avatar/avatar1.png', 1, '2019-10-31 11:54:02'),
(8, 'ISHIMWE', 'Teta', 'Female', '200', 12012, 'teta@gmail.com', 213, '$2y$12$trCrTEH2Gs6WuOWh.QnCj.BEqFTogRTo2LThpw/h6aQQLo.pUv.Pi', 'avatar/Gloire 20190207_172458.jpg', 1, '2019-11-06 07:49:05'),
(10, 'Hello', 'Khalm', 'Male', '07880', 120012, 'hello123@gmail.com', 107, '$2y$12$1h.BVFmZI85dxKM1E1FgkuGh2AeUJBkb5fJK3EYYqpXNRUfpxLALy', '', 1, '2019-11-06 12:37:49');

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
  `docuser` varchar(50) NOT NULL,
  `docregdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`docid`, `docowner`, `doctype`, `docno`, `docplace`, `docposter`, `docdeclarer`, `docfound`, `docstate`, `docstatus`, `docuser`, `docregdate`) VALUES
(1, 'Nomis hellos', 2, '89999999999', 'Kicukiro', 1, 2, '20190916 07:58:40', 0, 1, 'Client', '0000-00-00 00:00:00'),
(2, 'Mihigo hughieeerer', 3, '1223267', 'Gasabo', 1, 2, '20190924 13:42:50', 0, 1, 'Client', '0000-00-00 00:00:00'),
(3, 'Nomis hellos', 1, '1199980063607186', 'Rulindo/Murambi', 2, 1, '0', 1, 1, 'Client', '0000-00-00 00:00:00'),
(4, 'Mihigo hughie', 2, '1223267', 'Mugamba', 2, 1, '2019-11-01 20:26:17', 1, 1, 'Client', '0000-00-00 00:00:00'),
(8, 'Huno Blasir', 2, '3223', 'Ndubaa', 1, 1, '20190924 13:38:37', 1, 1, 'Client', '0000-00-00 00:00:00'),
(9, 'Karim Edoucee', 3, '65433', 'Kicukirooo', 1, 1, '20190924 13:35:54', 1, 1, 'Client', '0000-00-00 00:00:00'),
(10, 'Nomis hellos', 3, '1223267', 'Kicukiro', 1, 1, '20190924 13:42:50', 1, 1, 'Client', '0000-00-00 00:00:00'),
(11, 'Buum', 1, '5433', 'ksss', 1, 2, '20190924 13:48:35', 1, 1, 'Client', '0000-00-00 00:00:00'),
(12, 'Buumu', 1, '5433', 'ksss', 2, 1, '20190924 13:48:35', 0, 1, 'Client', '0000-00-00 00:00:00'),
(13, 'Gakwizi Emma', 3, 'NG1232', 'Rulindo', 1, 0, '0', 0, 0, 'Client', '0000-00-00 00:00:00'),
(14, 'Ndagano Eric', 2, 'YU23321', 'Rwamagana', 1, 0, '0', 1, 0, 'Client', '0000-00-00 00:00:00'),
(15, 'Stroame KAGABA', 3, 'KE23166', 'Canada', 7, 1, '20191009 14:52:13', 1, 1, 'Client', '0000-00-00 00:00:00'),
(16, 'Stroame KAGABA', 3, 'KE23166', 'Canada', 1, 7, '20191009 14:52:13', 0, 1, 'Client', '0000-00-00 00:00:00'),
(17, 'Chris McDonald', 2, '211DE0', 'Kenya', 7, 1, '20191009 15:43:51', 1, 1, 'Admin', '0000-00-00 00:00:00'),
(18, 'Chris McDonald', 2, '211DE0', 'Kenya', 1, 7, '20191009 15:43:51', 0, 1, 'Admin', '0000-00-00 00:00:00'),
(19, 'Fidele HATEGEKIMANA', 1, '4321', 'Rulindo/Masoro', 11, 2, '20191012 09:29:09', 1, 1, 'Admin', '0000-00-00 00:00:00'),
(20, 'Fidele HATEGEKIMANA', 1, '4321', 'Masoro', 2, 11, '20191012 09:29:09', 0, 1, 'Admin', '0000-00-00 00:00:00'),
(21, 'NDIZIHIWE Simon Pierre', 3, '77ND', 'Nyarugenge', 1, 0, '0', 0, 0, '', '0000-00-00 00:00:00'),
(22, 'Mugisha Emmanuel', 2, '11999', 'Gasabo', 1, 7, '2019-10-31 11:55:10', 0, 1, 'Client', '2019-10-31 09:16:17'),
(23, 'Matayo High', 1, '12009', 'RedBlu', 1, 0, '0', 1, 0, 'Client', '2019-10-31 09:50:57'),
(24, 'ISHIMWE RUKUNDO Gad', 1, '120068', 'Rulindo/Murambi', 7, 14, '20191031 11:16:35', 0, 1, 'Client', '2019-10-31 12:10:16'),
(25, 'ISHIMWE RUKUNDO Gad', 1, '120068', 'Rulindo/Murambi', 14, 7, '20191031 11:16:35', 1, 1, 'Admin', '0000-00-00 00:00:00'),
(26, 'Mugisha Emmanuel', 2, '11999', 'Nyarugenge', 7, 1, '2019-10-31 11:55:10', 1, 1, 'Client', '2019-10-31 12:55:10'),
(27, 'FIFI Jasmine', 1, '12345', 'Gasabo', 2, 14, '2019-11-01 14:00:43', 0, 1, 'Client', '2019-11-01 14:38:12'),
(28, 'FIFI Jasmine', 1, '12345', 'Nyarugenge', 14, 2, '2019-11-01 14:00:43', 1, 1, 'Admin', '2019-11-01 15:00:43'),
(29, 'SABATO Anxiri', 3, '1234', 'Frankfurt', 13, 2, '2019-11-01 14:29:25', 1, 1, 'Admin', '2019-11-01 15:27:21'),
(30, 'Anxiri SABATO', 3, '1234', 'German', 2, 13, '2019-11-01 14:29:25', 0, 1, 'Admin', '2019-11-01 15:29:25'),
(31, 'Ishimwe Ganza', 2, '22', 'Kenya', 7, 14, '2019-11-01 16:44:01', 0, 1, 'Admin', '2019-11-01 17:36:23'),
(33, 'Gaza ISHIMWE', 2, '22', 'Nairobi', 14, 7, '2019-11-01 16:44:01', 1, 1, 'Admin', '2019-11-01 17:44:01'),
(34, 'Mugisha Emmanuel', 3, '12345', 'Kenya', 7, 0, '0', 0, 0, 'Client', '2019-11-01 17:58:26'),
(35, 'Mugisha Emmanuel', 2, '1223267', 'Kenya', 2, 2, '2019-11-01 20:26:17', 0, 1, 'Client', '2019-11-01 21:26:18'),
(38, 'Voisine MUHOZA', 2, '224', 'Nyarugenge', 2, 14, '2019-11-05 12:49:16', 0, 1, 'Admin', '2019-11-05 13:48:39'),
(39, 'Voisine MUHOZA', 2, '224', 'Kimisagara', 14, 2, '2019-11-05 12:49:16', 1, 1, 'Admin', '2019-11-05 13:49:16'),
(40, 'FIFI Jasmine', 3, '345678', 'Rulindo/Murambi', 2, 0, '0', 0, 0, 'Client', '2019-11-05 14:20:41'),
(41, 'Ishimwe Ganza', 1, '120068007', 'Nyarugenge', 2, 0, '0', 0, 0, 'Client', '2019-11-05 14:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `documenttype`
--

CREATE TABLE `documenttype` (
  `dtypeid` int(11) NOT NULL,
  `dtypename` varchar(100) NOT NULL,
  `dtypedesc` varchar(200) NOT NULL,
  `dtypestatus` int(11) NOT NULL DEFAULT 1,
  `dtyperegdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `documenttype`
--

INSERT INTO `documenttype` (`dtypeid`, `dtypename`, `dtypedesc`, `dtypestatus`, `dtyperegdate`) VALUES
(1, 'National ID', 'National Identity card', 1, '2019-09-04 20:25:40'),
(2, 'Driving license', 'Vehicle driving license in Rwanda', 1, '2019-09-04 21:01:44'),
(3, 'Passport', 'Document that allows individuals to go or live in foreign country', 1, '2019-09-16 08:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `msg_id` int(11) NOT NULL,
  `msg_content` varchar(200) NOT NULL,
  `msg_sender` int(11) NOT NULL,
  `msg_receiver` int(11) NOT NULL,
  `msg_user` varchar(20) NOT NULL,
  `msg_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`msg_id`, `msg_content`, `msg_sender`, `msg_receiver`, `msg_user`, `msg_date`) VALUES
(1, 'Hello ðŸ‘‹, we have your lost document,\r\nvisit us to get it.', 11, 2, 'Admin', '2019-10-28 12:46:38'),
(2, 'Oohhh  thanks a lot,\r\nI look forward to meeting with you.', 2, 11, 'Admin', '2019-10-28 13:39:33'),
(3, 'Hey brother, how can we meet?\r\nso that i get that document of mine!', 2, 1, 'Client', '2019-10-28 14:51:12'),
(4, 'Ooohh, we appreciated your time\r\nhave nice day.', 11, 2, 'Admin', '2019-10-28 15:25:21'),
(5, 'Ooohh you can contact me on my email or WhatsApp number found on my #Nomiso wall.', 1, 2, 'Client', '2019-10-28 15:56:00'),
(6, 'That\'s easy,\r\ncome on our office by tomorrow morning.', 11, 2, 'Admin', '2019-10-28 15:59:22'),
(7, 'Ohh thanks,\r\nsee you soon', 2, 1, 'Client', '2019-10-28 16:02:09'),
(8, 'Here at MTN rwanda Nyabugogo Headquarters we have you ID card, come to our client office to get it. have a good day.', 14, 7, 'Admin', '2019-10-31 12:21:30'),
(9, 'Thanks a lot , I\'m looking forward to meeting with you next Friday morning. sincerely', 7, 14, 'Client', '2019-10-31 12:23:56'),
(10, 'Actually first message was somehow not correct, but I\'m sure this ones do.', 7, 14, 'Admin', '2019-10-31 12:36:24'),
(11, 'What the hell is happening to me right now, undefined variable again!', 7, 14, 'Admin', '2019-10-31 12:38:24'),
(12, 'Hahhah, no need of apologies just chill  out dude its ðŸ‘Œ', 14, 7, 'Admin', '2019-10-31 12:53:38'),
(13, 'Mwiriwe neza, hano mite icyangobwa cyawe k\'ibinyabiziga (permit), wampamagara kuri iyo  numero yanjye!', 7, 1, 'Client', '2019-10-31 13:06:21'),
(14, 'You have left your  ID card here at our office, be here by tomorrow morning at 08:00 to retrieve it. thank you', 14, 2, 'Admin', '2019-11-01 15:05:24'),
(15, 'Hello ðŸ‘‹ we have your driving licence, visit us at our office to get it.', 14, 2, 'Admin', '2019-11-05 13:50:45'),
(16, 'thank you for helping, i\'ll get there tomorrow', 2, 14, 'Admin', '2019-11-05 13:52:08');

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
  `notuser` varchar(50) NOT NULL,
  `nottime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notid`, `sendernot`, `receivernot`, `notsender`, `notreceiver`, `notdoc`, `notuser`, `nottime`) VALUES
(1, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 2, 1, 1, 'Client', '2019-09-16 07:58:40'),
(2, 'Document you posted have found its owner, Thank you for helping', 'Your document is found, conglatulations!', 2, 1, 2, 'Client', '2019-09-16 19:35:11'),
(3, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 1, 1, 9, 'Client', '2019-09-24 13:35:54'),
(4, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 1, 1, 8, 'Client', '2019-09-24 13:38:37'),
(5, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 1, 1, 2, 'Client', '2019-09-24 13:42:50'),
(6, 'Here your document is found, conglatulations!', 'Document you posted have found its owner, Thank you for helping', 2, 1, 11, 'Client', '2019-09-24 13:48:35'),
(7, 'Here your document is found, conglatulations!', 'Document you posted have found its owner, Thank you for helping', 1, 7, 15, 'Client', '2019-10-09 14:52:13'),
(8, 'Here your document is found, conglatulations!', 'Document you posted have found its owner, Thank you for helping', 1, 7, 17, 'Admin', '2019-10-09 15:43:51'),
(9, 'Here your document is found, conglatulations!', 'Document you posted have found its owner, Thank you for helping', 2, 11, 19, 'Admin', '2019-10-12 09:29:09'),
(10, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 14, 7, 24, 'Admin', '2019-10-31 12:16:35'),
(11, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 7, 1, 22, 'Client', '2019-10-31 12:55:10'),
(12, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 14, 2, 27, 'Admin', '2019-11-01 15:00:43'),
(13, 'Here your document is found, conglatulations!', 'Document you posted have found its owner, Thank you for helping', 2, 13, 29, 'Admin', '2019-11-01 15:29:25'),
(14, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 14, 7, 31, 'Admin', '2019-11-01 17:36:56'),
(15, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 14, 7, 31, 'Admin', '2019-11-01 17:44:01'),
(16, 'Here your document is found, conglatulations!', 'Document you posted have found its owner, Thank you for helping', 2, 2, 4, 'Client', '2019-11-01 21:26:17'),
(17, 'Document you posted have found its owner, Thank you for helping', 'Here your document is found, conglatulations!', 14, 2, 38, 'Admin', '2019-11-05 13:49:16');

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
  `upass` varchar(255) NOT NULL,
  `uaddress` int(11) NOT NULL,
  `ulocation` varchar(100) NOT NULL,
  `utype` varchar(100) NOT NULL,
  `udistrict` int(11) NOT NULL,
  `usector` int(11) NOT NULL,
  `uphoto` varchar(200) NOT NULL,
  `ustatus` int(11) NOT NULL DEFAULT 1,
  `reguser` int(11) NOT NULL,
  `uregdate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `ufname`, `ulname`, `ugender`, `uidno`, `uemail`, `uphone`, `upass`, `uaddress`, `ulocation`, `utype`, `udistrict`, `usector`, `uphoto`, `ustatus`, `reguser`, `uregdate`) VALUES
(1, 'RITCO LTD', 'Biryogo', '1', 0, 'info@ritcorwanda.com', '0786545122', '$2y$12$Yo5aCtotOetwMCRTABHkAeEQMDLeu3Vv1T0dYLAMtrBDnolzk7g36', 0, 'KN 7 AVE', 'Organization', 0, 0, '', 1, 0, '2019-09-19 14:09:08'),
(2, 'Haruna', 'Emma', 'Male', 1198980026732167, 'huye@gmail.com', '0785454344', '$2y$12$eQ0Peujy7kpAGbYWg5iaYec9bA5q7Cvnqym2v8O8oJR1F2MTUAfoq', 192, 'SH 527 ST', 'District', 17, 0, '', 1, 0, '2019-09-19 14:13:27'),
(3, 'Nomis', 'Wazeh', 'Male', 1199980063607000, 'nomis@gmail.com', '0787080060', '$2y$12$tKElGn.fTYcFPUT1n1gUsO5EOzIA7AWg36jKDvGcNhlTeHXORs0.O', 213, '', 'Super', 0, 0, 'avatar/IMG-20190616-WA0004.jpg', 1, 0, '2019-09-19 14:15:07'),
(4, 'New', 'Member', 'Female', 1198770087452154, 'hello@gmail.com', '0722431232', '$2y$12$vX73ssAjhpxxLTUWye6hMuHB8QU/QnqWjO6uvWxBCnBM4uHwXZQPi', 112, '', 'Super', 0, 0, '', 1, 1, '2019-09-29 13:59:21'),
(5, 'Gakwisi', 'Egide', 'Male', 119918002334881, 'ngoma@gov.rw', '0788453213', '$2y$12$gnp7U8hm.e5FVv9Rybksc.JoYBX1RlUhzdPHeewphkuactBu13xii', 56, 'Karembo mataba', 'District', 5, 0, '', 1, 1, '2019-09-29 14:01:38'),
(6, 'URWUBITSO ese', 'Downtown', '1', 0, 'sina@urwibutso.rw', '0788832141', '$2y$12$I02swPLGyYC9czehEhuTr.Ns9/p6J/84O6IgvciV0UUAQgPajUvlO', 0, 'KN 16 st', 'Organization', 0, 0, '', 1, 1, '2019-09-29 14:05:23'),
(7, 'Ndahiro', 'Eric', 'Male', 1199878002435776, 'ndahiroeg@yahoo.fr', '0784343211', '$2y$12$St7vwmUb6uLSIZa6KZNviesqNt2KN9CwzkQtroCpXWkH8BVILGxPu', 43, 'EG 54 AVE', 'Sector', 17, 1, '', 1, 2, '2019-10-08 18:32:21'),
(8, 'INYANGE LTD', 'Masoro', '', 0, 'info@inyangeindustry.co.rw', '0788893424', '$2y$12$W690oPXe8Nwq7Sj0g7ifkeasGSdJ.0YzTag12BSZ1z/JSmipQc2Zu', 0, 'KG 78 AVE', 'Organization', 0, 0, '', 1, 2, '2019-10-09 12:29:37'),
(9, 'Volks Wagen', 'Masoro', '1', 0, 'info@vw.co.rw', '7880', '$2y$12$Nvo9ox1gBj5KiEZ.brg/k.wo2BbefGw0Bdj4QtXaSRQsJhB8Jgt8W', 0, 'KG 34 AVE', 'Organization', 0, 0, '', 1, 2, '2019-10-09 13:23:21'),
(10, 'INYANGE DAIRY', 'Nyabugogo', '8', 0, 'info@inyangeindustries.co.rw', '07880', '$2y$12$RzrTZ0Jx.LFyBxZHooCckOSh1YQNd9H.NVbFSeidwmJN2B9mBw/p.', 0, 'Amashyirahamwe 1F R003', 'Organization', 0, 0, '', 1, 8, '2019-10-10 09:22:55'),
(11, 'INYANGE MILKZONE', 'Muhima', '8', 0, 'info@inyangeindustrie.co.rw', '07881', '$2y$12$YQtkxs4YT6cCMHcrpag3HuS8zzbSbzuqb0/ILrTjqYW9TDXE/ix5y', 0, 'NORA plaza 2F R012', 'Organization', 0, 0, '', 1, 8, '2019-10-10 09:52:50'),
(12, 'SAFINTRA LTD', 'Muhima', '1', 0, 'safintrarwanda@gmail.com', '0788232378', '$2y$12$MLewKP2ZUr7YB6ZiaBea5ezCPuOyMOPxEjexq7TJFTV5F0pA/hJQi', 0, 'Muhima city plaza', 'Organization', 0, 0, '', 1, 3, '2019-10-11 09:33:09'),
(13, 'Manzi', 'Egide', 'Male', 1199680054312700, 'manziegide24@gmail.com', '0788453221', '$2y$12$mtWCkCNOWG9LIvB0v4EzbewMzaBrv10zD5/WHTo2Ln6GAJt.X3FEK', 243, 'New Police Station', 'Sector', 17, 243, '', 1, 2, '2019-10-15 07:27:21'),
(14, 'MTN', 'Nyabugogo', '1', 0, 'info@mtn.co.rw', '100', '$2y$12$1mQjoTKdoKRFkzsDAYnMJ.YIF9dVC0aMOv4xEKNthfTDiLs/STGcW', 0, 'Ubuto 1F', 'Organization', 0, 0, 'avatar/android-wallpaper5_2560x1600_1.jpg', 1, 3, '2019-10-31 11:41:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activitylog`
--
ALTER TABLE `activitylog`
  ADD PRIMARY KEY (`actid`);

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
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`msg_id`);

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
-- AUTO_INCREMENT for table `activitylog`
--
ALTER TABLE `activitylog`
  MODIFY `actid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `clid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `distid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `docid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `documenttype`
--
ALTER TABLE `documenttype`
  MODIFY `dtypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
