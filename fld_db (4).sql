-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2026 at 02:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fld_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `password`) VALUES
(4, 'kusal@gmail.com', 'Kusal@001'),
(5, 'imesha@gmail.com', 'Imesha@002'),
(6, 'maleesha@gmail.com', 'Maleesha@003'),
(7, 'methmi@gmail.com', 'Methmi@004');

-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `name`) VALUES
(1, 'Colombo'),
(2, 'Gampaha'),
(3, 'Kalutara'),
(4, 'Kandy'),
(5, 'Matale'),
(6, 'Nuwara Eliya'),
(7, 'Galle'),
(8, 'Matara'),
(9, 'Hambantota'),
(10, 'Jaffna'),
(11, 'Kilinochchi'),
(12, 'Mannar'),
(13, 'Mullaitivu'),
(14, 'Vavuniya'),
(15, 'Trincomalee'),
(16, 'Batticaloa'),
(17, 'Ampara'),
(18, 'Kurunegala'),
(19, 'Puttalam'),
(20, 'Anuradhapura'),
(21, 'Polonnaruwa'),
(22, 'Badulla'),
(23, 'Monaragala'),
(24, 'Ratnapura'),
(25, 'Kegalle');

-- --------------------------------------------------------

--
-- Table structure for table `ds_divisions`
--

CREATE TABLE `ds_divisions` (
  `id` int(11) NOT NULL,
  `district_name` varchar(50) NOT NULL,
  `ds_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ds_divisions`
--

INSERT INTO `ds_divisions` (`id`, `district_name`, `ds_name`) VALUES
(1, 'Colombo', 'Maharagama'),
(2, 'Colombo', 'Sri Jayawardenepura Kotte'),
(3, 'Kalutara', 'Beruwala'),
(4, 'Kalutara', 'Panadura'),
(5, 'Colombo', 'Colombo'),
(6, 'Colombo', 'Kolonnawa'),
(7, 'Colombo', 'Kaduwela'),
(8, 'Colombo', 'Homagama'),
(9, 'Colombo', 'Seethawaka (Hanwella)'),
(10, 'Colombo', 'Padukka'),
(11, 'Colombo', 'Maharagama'),
(12, 'Colombo', 'Sri Jayawardanapura Kotte'),
(13, 'Colombo', 'Thimbirigasyaya'),
(14, 'Colombo', 'Dehiwala'),
(15, 'Colombo', 'Ratmalana'),
(16, 'Colombo', 'Moratuwa'),
(17, 'Colombo', 'Kesbewa'),
(18, 'Gampaha', 'Negombo'),
(19, 'Gampaha', 'Katana'),
(20, 'Gampaha', 'Divulapitiya'),
(21, 'Gampaha', 'Mirigama'),
(22, 'Gampaha', 'Minuwangoda'),
(23, 'Gampaha', 'Wattala'),
(24, 'Gampaha', 'Ja-Ela'),
(25, 'Gampaha', 'Gampaha'),
(26, 'Gampaha', 'Attanagalla'),
(27, 'Gampaha', 'Dompe'),
(28, 'Gampaha', 'Mahara'),
(29, 'Gampaha', 'Kelaniya'),
(30, 'Gampaha', 'Biyagama'),
(31, 'Kalutara', 'Panadura'),
(32, 'Kalutara', 'Bandaragama'),
(33, 'Kalutara', 'Horana'),
(34, 'Kalutara', 'Ingiriya'),
(35, 'Kalutara', 'Bulathsinhala'),
(36, 'Kalutara', 'Madurawala'),
(37, 'Kalutara', 'Millaniya'),
(38, 'Kalutara', 'Kalutara'),
(39, 'Kalutara', 'Beruwala'),
(40, 'Kalutara', 'Dodangoda'),
(41, 'Kalutara', 'Mathugama'),
(42, 'Kalutara', 'Agalawatta'),
(43, 'Kalutara', 'Palindanuwara'),
(44, 'Kalutara', 'Walallavita'),
(45, 'Kandy', 'Thumpane'),
(46, 'Kandy', 'Pujapitiya'),
(47, 'Kandy', 'Akurana'),
(48, 'Kandy', 'Pathadumbara'),
(49, 'Kandy', 'Panvila'),
(50, 'Kandy', 'Udadumbara'),
(51, 'Kandy', 'Minipe'),
(52, 'Kandy', 'Medadumbara'),
(53, 'Kandy', 'Kundasale'),
(54, 'Kandy', 'Kandy Four Gravets & Gangawata Korale'),
(55, 'Kandy', 'Harispattuwa'),
(56, 'Kandy', 'Hatharaliyadda'),
(57, 'Kandy', 'Yatinuwara'),
(58, 'Kandy', 'Udunuwara'),
(59, 'Kandy', 'Doluwa'),
(60, 'Kandy', 'Pathahewaheta'),
(61, 'Kandy', 'Deltota'),
(62, 'Kandy', 'Udapalatha'),
(63, 'Kandy', 'Ganga Ihala Korale'),
(64, 'Kandy', 'Pasbage Korale'),
(65, 'Matale', 'Galewela'),
(66, 'Matale', 'Dambulla'),
(67, 'Matale', 'Naula'),
(68, 'Matale', 'Pallepola'),
(69, 'Matale', 'Yatawatta'),
(70, 'Matale', 'Matale'),
(71, 'Matale', 'Ambanganga Korale'),
(72, 'Matale', 'Laggala-Pallegama'),
(73, 'Matale', 'Wilgamuwa'),
(74, 'Matale', 'Rattota'),
(75, 'Matale', 'Ukuwela'),
(76, 'Nuwara Eliya', 'Kothmale'),
(77, 'Nuwara Eliya', 'Hanguranketha'),
(78, 'Nuwara Eliya', 'Walapane'),
(79, 'Nuwara Eliya', 'Nuwara Eliya'),
(80, 'Nuwara Eliya', 'Ambagamuwa'),
(81, 'Galle', 'Bentota'),
(82, 'Galle', 'Balapitiya'),
(83, 'Galle', 'Karandeniya'),
(84, 'Galle', 'Elpitiya'),
(85, 'Galle', 'Niyagama'),
(86, 'Galle', 'Thawalama'),
(87, 'Galle', 'Neluwa'),
(88, 'Galle', 'Nagoda'),
(89, 'Galle', 'Baddegama'),
(90, 'Galle', 'Welivitiya-Divithura'),
(91, 'Galle', 'Ambalangoda'),
(92, 'Galle', 'Gonapeenuwala'),
(93, 'Galle', 'Hikkaduwa'),
(94, 'Galle', 'Galle Four Gravets'),
(95, 'Galle', 'Bope-Poddala'),
(96, 'Galle', 'Akmeemana'),
(97, 'Galle', 'Yakkalamulla'),
(98, 'Galle', 'Imaduwa'),
(99, 'Galle', 'Habaraduwa'),
(100, 'Matara', 'Pitabeddara'),
(101, 'Matara', 'Kotapola'),
(102, 'Matara', 'Pasgoda'),
(103, 'Matara', 'Mulatiyana'),
(104, 'Matara', 'Athuraliya'),
(105, 'Matara', 'Akuressa'),
(106, 'Matara', 'Welipitiya'),
(107, 'Matara', 'Malimbada'),
(108, 'Matara', 'Kamburupitiya'),
(109, 'Matara', 'Hakmana'),
(110, 'Matara', 'Kirinda Puhulwella'),
(111, 'Matara', 'Thihagoda'),
(112, 'Matara', 'Weligama'),
(113, 'Matara', 'Matara Four Gravets'),
(114, 'Matara', 'Devinuwara'),
(115, 'Matara', 'Dickwella'),
(116, 'Hambantota', 'Sooriyawewa'),
(117, 'Hambantota', 'Lunugamvehera'),
(118, 'Hambantota', 'Thissamaharama'),
(119, 'Hambantota', 'Hambantota'),
(120, 'Hambantota', 'Ambalantota'),
(121, 'Hambantota', 'Angunakolapelessa'),
(122, 'Hambantota', 'Weeraketiya'),
(123, 'Hambantota', 'Katuwana'),
(124, 'Hambantota', 'Walasmulla'),
(125, 'Hambantota', 'Okewela'),
(126, 'Hambantota', 'Beliatta'),
(127, 'Hambantota', 'Tangalle'),
(128, 'Jaffna', 'Island North (Kayts)'),
(129, 'Jaffna', 'Karainagar'),
(130, 'Jaffna', 'Valikamam West (Chankanai)'),
(131, 'Jaffna', 'Valikamam South-West (Sandilipay)'),
(132, 'Jaffna', 'Valikamam North (Tellipallai)'),
(133, 'Jaffna', 'Valikamam South (Uduvil)'),
(134, 'Jaffna', 'Valikamam East (Kopay)'),
(135, 'Jaffna', 'Vadamaradchi South-West (Karaveddy)'),
(136, 'Jaffna', 'Vadamaradchi East'),
(137, 'Jaffna', 'Vadamaradchi North (Point Pedro)'),
(138, 'Jaffna', 'Thenmaradchi (Chavakachcheri)'),
(139, 'Jaffna', 'Nallur'),
(140, 'Jaffna', 'Jaffna'),
(141, 'Jaffna', 'Island South (Velanai)'),
(142, 'Jaffna', 'Delft'),
(143, 'Mannar', 'Mannar Town'),
(144, 'Mannar', 'Manthai West'),
(145, 'Mannar', 'Madhu'),
(146, 'Mannar', 'Nanattan'),
(147, 'Mannar', 'Musali'),
(148, 'Vavuniya', 'Vavuniya North'),
(149, 'Vavuniya', 'Vavuniya South'),
(150, 'Vavuniya', 'Vavuniya'),
(151, 'Vavuniya', 'Vengalacheddikulam'),
(152, 'Mullaitivu', 'Thunukkai'),
(153, 'Mullaitivu', 'Manthai East'),
(154, 'Mullaitivu', 'Puthukkudiyiruppu'),
(155, 'Mullaitivu', 'Oddusuddan'),
(156, 'Mullaitivu', 'Maritimepattu'),
(157, 'Mullaitivu', 'Welioya'),
(158, 'Killinochchi', 'Pachchilaipalli'),
(159, 'Killinochchi', 'Kandavalai'),
(160, 'Killinochchi', 'Karachchi'),
(161, 'Killinochchi', 'Poonakary'),
(162, 'Batticaloa', 'Koralai Pattu North (Vaharai)'),
(163, 'Batticaloa', 'Koralai Pattu Central'),
(164, 'Batticaloa', 'Koralai Pattu West (Oddamavadi)'),
(165, 'Batticaloa', 'Koralai Pattu (Valachchenai)'),
(166, 'Batticaloa', 'Koralai Pattu South (Kiran)'),
(167, 'Batticaloa', 'Eravur Pattu'),
(168, 'Batticaloa', 'Eravur Town'),
(169, 'Batticaloa', 'Manmunai North'),
(170, 'Batticaloa', 'Manmunai West'),
(171, 'Batticaloa', 'Kattankudy'),
(172, 'Batticaloa', 'Manmunai Pattu (Araipattai)'),
(173, 'Batticaloa', 'Manmunai South-West'),
(174, 'Batticaloa', 'Porativu Pattu'),
(175, 'Batticaloa', 'Manmunai South & Eruvil Pattu'),
(176, 'Ampara', 'Dehiattakandiya'),
(177, 'Ampara', 'Padiyathalawa'),
(178, 'Ampara', 'Mahaoya'),
(179, 'Ampara', 'Uhana'),
(180, 'Ampara', 'Ampara'),
(181, 'Ampara', 'Navithanveli'),
(182, 'Ampara', 'Sammanthurai'),
(183, 'Ampara', 'Kalmunai Tamil Division'),
(184, 'Ampara', 'Kalmunai'),
(185, 'Ampara', 'Sainthamaruthu'),
(186, 'Ampara', 'Karaitheevu'),
(187, 'Ampara', 'Ninthavur'),
(188, 'Ampara', 'Addalaichchenai'),
(189, 'Ampara', 'Irakkamam'),
(190, 'Ampara', 'Akkaraipattu'),
(191, 'Ampara', 'Alayadiwembu'),
(192, 'Ampara', 'Damana'),
(193, 'Ampara', 'Thirukkovil'),
(194, 'Ampara', 'Pothuvil'),
(195, 'Ampara', 'Lahugala'),
(196, 'Trincomalee', 'Padavi Sri Pura'),
(197, 'Trincomalee', 'Kuchchaveli'),
(198, 'Trincomalee', 'Gomarankadawala'),
(199, 'Trincomalee', 'Morawewa'),
(200, 'Trincomalee', 'Trincomalee Town and Gravets'),
(201, 'Trincomalee', 'Thambalagamuwa'),
(202, 'Trincomalee', 'Kanthale'),
(203, 'Trincomalee', 'Kinniya'),
(204, 'Trincomalee', 'Muttur'),
(205, 'Trincomalee', 'Seruvila'),
(206, 'Trincomalee', 'Verugal (Eachchilampattu)'),
(207, 'Kurunegala', 'Giribawa'),
(208, 'Kurunegala', 'Galgamuwa'),
(209, 'Kurunegala', 'Ehetuwewa'),
(210, 'Kurunegala', 'Ambanpola'),
(211, 'Kurunegala', 'Kotavehera'),
(212, 'Kurunegala', 'Rasnayakapura'),
(213, 'Kurunegala', 'Nikaweratiya'),
(214, 'Kurunegala', 'Maho'),
(215, 'Kurunegala', 'Polpithigama'),
(216, 'Kurunegala', 'Ibbagamuwa'),
(217, 'Kurunegala', 'Ganewatta'),
(218, 'Kurunegala', 'Wariyapola'),
(219, 'Kurunegala', 'Kobeigane'),
(220, 'Kurunegala', 'Bingiriya'),
(221, 'Kurunegala', 'Panduwasnuwara West'),
(222, 'Kurunegala', 'Panduwasnuwara East'),
(223, 'Kurunegala', 'Bamunakotuwa'),
(224, 'Kurunegala', 'Maspotha'),
(225, 'Kurunegala', 'Kurunegala'),
(226, 'Kurunegala', 'Mallawapitiya'),
(227, 'Kurunegala', 'Mawathagama'),
(228, 'Kurunegala', 'Rideegama'),
(229, 'Kurunegala', 'Weerambugedara'),
(230, 'Kurunegala', 'Kuliyapitiya East'),
(231, 'Kurunegala', 'Kuliyapitiya West'),
(232, 'Kurunegala', 'Udubaddawa'),
(233, 'Kurunegala', 'Pannala'),
(234, 'Kurunegala', 'Narammala'),
(235, 'Kurunegala', 'Alawwa'),
(236, 'Kurunegala', 'Polgahawela'),
(237, 'Puttalam', 'Kalpitiya'),
(238, 'Puttalam', 'Vanathawilluwa'),
(239, 'Puttalam', 'Karuwalagaswewa'),
(240, 'Puttalam', 'Nawagattegama'),
(241, 'Puttalam', 'Puttalam'),
(242, 'Puttalam', 'Mundel'),
(243, 'Puttalam', 'Mahakumbukkadawala'),
(244, 'Puttalam', 'Anamaduwa'),
(245, 'Puttalam', 'Pallama'),
(246, 'Puttalam', 'Arachchikattuwa'),
(247, 'Puttalam', 'Chilaw'),
(248, 'Puttalam', 'Madampe'),
(249, 'Puttalam', 'Mahawewa'),
(250, 'Puttalam', 'Nattandiya'),
(251, 'Puttalam', 'Wennappuwa'),
(252, 'Puttalam', 'Dankotuwa'),
(253, 'Anuradhapura', 'Padaviya'),
(254, 'Anuradhapura', 'Kebithigollewa'),
(255, 'Anuradhapura', 'Medawachchiya'),
(256, 'Anuradhapura', 'Mahawilachchiya'),
(257, 'Anuradhapura', 'Nuwaragam Palatha Central'),
(258, 'Anuradhapura', 'Rambewa'),
(259, 'Anuradhapura', 'Kahatagasdigiliya'),
(260, 'Anuradhapura', 'Horowpothana'),
(261, 'Anuradhapura', 'Galenbindunuwewa'),
(262, 'Anuradhapura', 'Mihinthale'),
(263, 'Anuradhapura', 'Nuwaragam Palatha East'),
(264, 'Anuradhapura', 'Nachchaduwa'),
(265, 'Anuradhapura', 'Nochchiyagama'),
(266, 'Anuradhapura', 'Rajanganaya'),
(267, 'Anuradhapura', 'Thambuttegama'),
(268, 'Anuradhapura', 'Thalawa'),
(269, 'Anuradhapura', 'Thirappane'),
(270, 'Anuradhapura', 'Kekirawa'),
(271, 'Anuradhapura', 'Palugaswewa'),
(272, 'Anuradhapura', 'Ipalogama'),
(273, 'Anuradhapura', 'Galnewa'),
(274, 'Anuradhapura', 'Palagala'),
(275, 'Polonnaruwa', 'Hingurakgoda'),
(276, 'Polonnaruwa', 'Medirigiriya'),
(277, 'Polonnaruwa', 'Lankapura'),
(278, 'Polonnaruwa', 'Welikanda'),
(279, 'Polonnaruwa', 'Dimbulagala'),
(280, 'Polonnaruwa', 'Thamankaduwa'),
(281, 'Polonnaruwa', 'Elahera'),
(282, 'Badulla', 'Mahiyanganaya'),
(283, 'Badulla', 'Rideemaliyadda'),
(284, 'Badulla', 'Meegahakivula'),
(285, 'Badulla', 'Kandaketiya'),
(286, 'Badulla', 'Soranathota'),
(287, 'Badulla', 'Passara'),
(288, 'Badulla', 'Lunugala'),
(289, 'Badulla', 'Badulla'),
(290, 'Badulla', 'Hali-Ela'),
(291, 'Badulla', 'Uva Paranagama'),
(292, 'Badulla', 'Welimada'),
(293, 'Badulla', 'Bandarawela'),
(294, 'Badulla', 'Ella'),
(295, 'Badulla', 'Haputale'),
(296, 'Badulla', 'Haldummulla'),
(297, 'Moneragala', 'Bibile'),
(298, 'Moneragala', 'Madulla'),
(299, 'Moneragala', 'Medagama'),
(300, 'Moneragala', 'Siyambalanduwa'),
(301, 'Moneragala', 'Moneragala'),
(302, 'Moneragala', 'Badalkumbura'),
(303, 'Moneragala', 'Wellawaya'),
(304, 'Moneragala', 'Buttala'),
(305, 'Moneragala', 'Katharagama'),
(306, 'Moneragala', 'Thanamalvila'),
(307, 'Moneragala', 'Sevanagala'),
(308, 'Ratnapura', 'Eheliyagoda'),
(309, 'Ratnapura', 'Kuruvita'),
(310, 'Ratnapura', 'Kiriella'),
(311, 'Ratnapura', 'Ratnapura'),
(312, 'Ratnapura', 'Imbulpe'),
(313, 'Ratnapura', 'Balangoda'),
(314, 'Ratnapura', 'Opanayake'),
(315, 'Ratnapura', 'Pelmadulla'),
(316, 'Ratnapura', 'Elapatha'),
(317, 'Ratnapura', 'Ayagama'),
(318, 'Ratnapura', 'Kalawana'),
(319, 'Ratnapura', 'Nivithigala'),
(320, 'Ratnapura', 'Kahawatta'),
(321, 'Ratnapura', 'Godakawela'),
(322, 'Ratnapura', 'Weligepola'),
(323, 'Ratnapura', 'Embilipitiya'),
(324, 'Ratnapura', 'Kolonna'),
(325, 'Kegalle', 'Rambukkana'),
(326, 'Kegalle', 'Mawanella'),
(327, 'Kegalle', 'Aranayaka'),
(328, 'Kegalle', 'Kegalle'),
(329, 'Kegalle', 'Galigamuwa'),
(330, 'Kegalle', 'Warakapola'),
(331, 'Kegalle', 'Ruwanwella'),
(332, 'Kegalle', 'Bulathkohupitiya'),
(333, 'Kegalle', 'Yatiyanthota'),
(334, 'Kegalle', 'Dehiovita'),
(335, 'Kegalle', 'Deraniyagala');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `district` varchar(20) NOT NULL,
  `ds_div` varchar(20) NOT NULL,
  `gn_div` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `no_of_fmembers` int(11) NOT NULL,
  `sev_level` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `req_date` datetime NOT NULL DEFAULT current_timestamp(),
  `act_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `type`, `district`, `ds_div`, `gn_div`, `name`, `telephone`, `address`, `no_of_fmembers`, `sev_level`, `description`, `req_date`, `act_date`, `user_id`, `status`) VALUES
(16, 'food', 'galle', 'nagoda', '800-d', 'Kusal D Ranasinghe', '0345434543', 'galle', 10, 'low', 'test1', '2026-02-06 00:00:00', '2026-03-11', 2, 'accepted'),
(19, 'medicine', 'kalutara', 'nagoda', '800-d', 'Kusal D Ranasinghe', '0345434543', 'colombo', 10, 'medium', 'test', '2026-03-09 00:00:00', '2026-03-16', 9, 'rejected'),
(22, 'food', 'kandy', 'nagoda', '800-d', 'Kusal D Ranasinghe', '0778767787', 'kalutara', 10, 'low', 'tst', '2026-03-11 00:00:00', '2026-03-11', 9, 'accepted'),
(29, 'food', 'Gampaha', 'Mirigama', '800-d', 'Kaveesha Pathirathna', '076978965', 'Panawala , Danowita , Gampaha', 4, 'medium', '', '2026-03-16 01:24:14', '2026-03-16', 13, 'accepted'),
(30, 'food', 'Gampaha', 'Mirigama', '800-d', 'Kaveesha Pathirathna', '077876778', 'Panawala , Danowita , Gampaha', 4, 'high', '', '2026-03-16 01:26:42', '2026-03-16', 13, 'accepted'),
(31, 'shelter', 'Galle', 'Akmeemana', 'Bope Poddala', 'Sasiru putha', '076345677', 'galle', 4, 'high', '', '2026-03-16 01:34:45', '2026-03-16', 14, 'accepted'),
(32, 'food', 'Kalutara', 'Dodangoda', '800-d', 'Kusal Ranasinghe', '078799683', '\"Kusum Sewana\" Kajuduwawatta , Dodangoda', 5, 'high', '', '2026-03-16 15:49:57', '2026-03-16', 17, 'accepted'),
(33, 'medicine', 'Kalutara', 'Dodangoda', '800-d', 'Kusal Ranasinghe', '078799683', '\"Kusum Sewana\" Kajuduwawatta , Dodangoda', 5, 'medium', '', '2026-03-16 16:00:55', NULL, 17, 'pending'),
(34, 'food', 'Colombo', 'Dehiwala', 'Rathmalana', 'Wasanthi Ranasinghe', '034543454', 'No 75 , Rathmalana , colombo', 6, 'high', '', '2026-03-16 16:03:07', '2026-03-16', 17, 'accepted'),
(35, 'food', 'Galle', 'Ambalangoda', 'Aluthwala', 'Imesha Ruwangi', '071234567', 'Aluthwala , Ambalangoda', 4, 'low', '', '2026-03-16 16:08:35', '2026-03-16', 18, 'rejected'),
(36, 'water', 'Galle', 'Ambalangoda', 'Aluthwala', 'Imesha Ruwangi', '077876778', 'Aluthwala , Ambalangoda', 4, 'medium', '', '2026-03-16 16:09:39', '2026-03-16', 18, 'accepted'),
(37, 'shelter', 'Galle', 'Bentota', 'Benthara', 'Maleesha Dilshan', '034543454', 'New road , Benthara', 5, 'high', '', '2026-03-16 16:16:22', '2026-03-16', 19, 'accepted'),
(38, 'medicine', 'Colombo', 'Sri Jayawardanapura ', '710-B', 'Santhushi Fernando', '078799683', 'No.34 , Old Road , Rajagiriya ', 5, 'medium', '', '2026-03-16 16:17:59', NULL, 19, 'pending'),
(39, 'food', 'Kalutara', 'Mathugama', 'Wattewa', 'Irushi Theshala', '078799683', 'No.40 , Ovitigala ,Mathugama', 5, 'high', '', '2026-03-16 16:21:36', NULL, 17, 'pending'),
(40, 'food', 'Colombo', 'Padukka', '710-B', 'Kusal D Ranasinghe', '098765432', 'Panawala , Danowita , Gampaha', 8, 'low', '', '2026-03-16 16:22:38', '2026-03-16', 17, 'rejected'),
(41, 'water', 'Hambantota', 'Tangalle', 'Ranna', 'Tharindi Koshila', '078999999', 'No.70 , Ranna , Tangalle', 4, 'high', '', '2026-03-16 17:04:15', NULL, 20, 'pending'),
(42, 'shelter', 'Anuradhapura', 'Thalawa', 'thalawa', 'Tharindi Koshila', '078999999', 'No.70 , Ranna , Tangalle', 4, 'high', '', '2026-03-16 17:05:17', NULL, 20, 'pending'),
(43, 'food', 'Hambantota', 'Tangalle', 'Ranna', 'Tharindi Koshila', '078999999', 'No.70 , Ranna , Tangalle', 4, 'medium', '', '2026-03-16 17:05:59', NULL, 20, 'pending'),
(44, 'medicine', 'Gampaha', 'Minuwangoda', 'Yatiyana', 'Sathmi Adhikari', '761680700', '47/D/25,Yatiyana,Minnuwangoda', 5, 'low', '', '2026-03-16 17:54:37', NULL, 22, 'pending'),
(45, 'water', 'Kandy', 'Yatinuwara', '98-B', 'Imesh Basnayake', '713763404', '88/C,Yatinuwara,Kandy', 3, 'low', '', '2026-03-16 17:58:43', NULL, 22, 'pending'),
(46, 'shelter', 'Badulla', 'Uva Paranagama', '73', 'Jinadi Fernando', '769532584', '65/5,Uva paranagama,Badulla', 6, 'high', '', '2026-03-16 18:00:08', NULL, 22, 'pending'),
(47, 'food', 'Gampaha', 'Attanagalla', '710-B', 'Imesh basnayake', '077876778', 'No.92 , Wathuragama', 3, 'high', '', '2026-03-16 18:03:19', NULL, 23, 'pending'),
(48, 'medicine', 'Kalutara', 'Dodangoda', '800-d', 'Kusal D Ranasinghe', '078799683', '\"Kusum Sewana\" Kajuduwawatta , Dodangoda', 6, 'high', '', '2026-03-16 18:18:28', NULL, 17, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `district` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nic`, `email`, `telephone`, `address`, `district`, `password`, `created_date`) VALUES
(6, 'dinul', '201831811106', 'd@gmail.com', '0987654321', 'kalutara', 'Kalutara', '111', '2026-02-03 00:00:00'),
(8, 'sadun', '201831811106', 's@gmail.com', '0778767787', 'kandy', 'kandy', 'sss', '2026-02-05 00:00:00'),
(16, 'Maleesha dilshan', '200412345670', 'st@gmail.com', '098765432', 'galle', 'Galle', 'santusii111', '2026-03-16 03:19:03'),
(17, 'Kusal D Ranasinghe', '200331811106', 'kusal@gmail.com', '787996831', '\"Kusum Sewana\" Kajuduwawatta , Dodangoda', 'Kalutara', 'kusal123', '2026-03-16 15:48:35'),
(18, 'Imesha Ruwangi', '200283101538', 'imesha1@gmail.com', '712345678', 'Aluthwala , Ambalangoda', 'Galle', 'imesha123', '2026-03-16 16:07:04'),
(19, 'Maleesha dilshan', '200334810753', 'dila@gmail.com', '784799683', 'No.73 , Benthara , Galle', 'Galle', 'santhushi2207', '2026-03-16 16:12:21'),
(20, 'Tharindi Koshila', '200312343212', 'tharindi@gmail.com', '786731234', 'No.70 , Ranna , Tangalle', 'Hambantota', 'tharindi123', '2026-03-16 17:02:49'),
(21, 'Himaya Perera', '200257571039', 'himaya@gmail.com', '771166633', 'No.116/2,Udugampola,Gampaha.', 'Gampaha', 'maya@123', '2026-03-16 17:18:56'),
(22, 'Sathmi Adhikari', '200264501545', 'sathmi@gmail.com', '761680700', '47/D/25,Yatiyana,Minnuwangoda', 'Gampaha', 'sathmi133', '2026-03-16 17:49:40'),
(23, 'Imesh Basnayake', '200332112332', 'bassa@gmail.com', '768766787', 'No.92 , Wathuragama', 'Gampaha', 'bassa123', '2026-03-16 18:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `v_id` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `nic` varchar(20) NOT NULL,
  `telephone` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`v_id`, `type`, `name`, `nic`, `telephone`) VALUES
(1, 'food', 'Kusal D Ranasinghe', '201831811106', 778767789),
(6, 'medicine', 'dasun', '200412345678', 34543454);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ds_divisions`
--
ALTER TABLE `ds_divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`v_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ds_divisions`
--
ALTER TABLE `ds_divisions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=336;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `v_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
