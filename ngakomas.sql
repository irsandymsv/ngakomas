-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2018 at 03:53 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngakomas`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`) VALUES
(1, 'Kriminalitas'),
(2, 'Orang hilang'),
(3, 'Buronan'),
(4, 'Bencana alam');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama`) VALUES
(1, 'KENCONG'),
(2, 'GUMUK MAS'),
(3, 'PUGER'),
(4, 'WULUHAN'),
(5, 'AMBULU'),
(6, 'TEMPUREJO'),
(7, 'SILO'),
(8, 'MAYANG'),
(9, 'MUMBULSARI'),
(10, 'JENGGAWAH'),
(11, 'AJUNG'),
(12, 'RAMBIPUJI'),
(13, 'BALUNG'),
(14, 'UMBULSARI'),
(15, 'SEMBORO'),
(16, 'JOMBANG'),
(17, 'SUMBER BARU'),
(18, 'TANGGUL'),
(19, 'BANGSALSARI'),
(20, 'PANTI'),
(21, 'SUKORAMBI'),
(22, 'ARJASA'),
(23, 'PAKUSARI'),
(24, 'KALISAT'),
(25, 'LEDOKOMBO'),
(26, 'SUMBERJAMBE'),
(27, 'SUKOWONO'),
(28, 'JELBUK'),
(29, 'KALIWATES'),
(30, 'SUMBERSARI'),
(31, 'PATRANG');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id` int(11) NOT NULL,
  `id_kecamatan` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `id_kecamatan`, `nama`) VALUES
(1, 1, 'PASEBAN'),
(2, 1, 'CAKRU'),
(3, 1, 'KRATON'),
(4, 1, 'WONOREJO'),
(5, 1, 'KENCONG'),
(6, 2, 'KEPANJEN'),
(7, 2, 'MAYANGAN'),
(8, 2, 'MENAMPU'),
(9, 2, 'BAGOREJO'),
(10, 2, 'GUMUKMAS'),
(11, 2, 'PURWOASRI'),
(12, 2, 'TEMBOKREJO'),
(13, 2, 'KARANGREJO'),
(14, 3, 'MOJOMULYO'),
(15, 3, 'MOJOSARI'),
(16, 3, 'PUGER KULON'),
(17, 3, 'PUGER WETAN'),
(18, 3, 'GRENDEN'),
(19, 3, 'MLOKOREJO'),
(20, 3, 'KASIYAN'),
(21, 3, 'KASIYAN TIMUR'),
(22, 3, 'WONOSARI'),
(23, 3, 'JAMBEARUM'),
(24, 3, 'BAGON'),
(25, 3, 'WRINGIN TELU'),
(26, 4, 'LOJEJER'),
(27, 4, 'AMPEL'),
(28, 4, 'TANJUNG REJO'),
(29, 4, 'KESILIR'),
(30, 4, 'DUKUH DEMPOK'),
(31, 4, 'TAMANSARI'),
(32, 4, 'GLUNDENGAN'),
(40, 5, 'SUMBERREJO'),
(41, 5, 'ANDONGSARI'),
(42, 5, 'SABRANG'),
(43, 5, 'AMBULU'),
(44, 5, 'PONTANG'),
(45, 5, 'KARANG ANYAR'),
(46, 5, 'TEGALSARI'),
(47, 6, 'ANDONGREJO'),
(48, 6, 'CURAHNONGKO'),
(49, 6, 'SANENREJO'),
(50, 6, 'WONOASRI'),
(51, 6, 'SIDODADI'),
(52, 6, 'PONDOKREJO'),
(53, 6, 'CURAHTAKIR'),
(54, 6, 'TEMPUREJO'),
(55, 7, 'MULYOREJO'),
(56, 7, 'PACE'),
(57, 7, 'HARJOMULYO'),
(58, 7, 'KARANGHARJO'),
(59, 7, 'SILO'),
(60, 7, 'SEMPOLAN'),
(61, 7, 'SUMBERJATI'),
(62, 7, 'GARAHAN'),
(63, 7, 'SIDOMULYO'),
(64, 8, 'SEPUTIH'),
(65, 8, 'SIDOMUKTI'),
(66, 8, 'SUMBER KEJAYAN'),
(67, 8, 'TEGALREJO'),
(68, 8, 'TEGALWARU'),
(69, 8, 'MAYANG'),
(70, 8, 'MRAWAN'),
(71, 9, 'KAWANGREJO'),
(72, 9, 'TAMANSARI'),
(73, 9, 'SUCO'),
(74, 9, 'LAMPEJI'),
(75, 9, 'MUMBULSARI'),
(76, 9, 'LENGKONG'),
(77, 9, 'KARANGKEDAWUNG'),
(78, 10, 'KEMUNING SARI KIDUL'),
(79, 10, 'KERTONEGORO'),
(80, 10, 'JATISARI'),
(81, 10, 'SRUNI'),
(82, 10, 'CANGKRING'),
(83, 10, 'WONOJATI'),
(84, 10, 'JENGGAWAH'),
(85, 10, 'JATIMULYO'),
(86, 11, 'MANGARAN'),
(87, 11, 'SUKAMAKMUR'),
(88, 11, 'KLOMPANGAN'),
(89, 11, 'PANCAKARYA'),
(90, 11, 'AJUNG'),
(91, 11, 'WIROWONGSO'),
(92, 11, 'ROWO INDAH'),
(93, 12, 'CURAHMALANG'),
(94, 12, 'NOGOSARI'),
(95, 12, 'ROWOTAMTU'),
(96, 12, 'PECORO'),
(97, 12, 'RAMBIPUJI'),
(98, 12, 'KALIWINING'),
(99, 12, 'RAMBIGUNDAM'),
(100, 12, 'GUGUT'),
(101, 13, 'KARANG DUREN'),
(102, 13, 'KARANG SEMANDING'),
(103, 13, 'TUTUL'),
(104, 13, 'BALUNG KULON'),
(105, 13, 'BALUNG KIDUL'),
(106, 13, 'BALUNG LOR'),
(107, 13, 'GUMELAR'),
(108, 13, 'CURAHLELE'),
(109, 14, 'SUKORENO'),
(110, 14, 'GUNUNGSARI'),
(111, 14, 'UMBULSARI'),
(112, 14, 'TANJUNGSARI'),
(113, 14, 'PALERAN'),
(114, 14, 'UMBULREJO'),
(115, 14, 'GADINGREJO'),
(116, 14, 'SIDOREJO'),
(117, 14, 'TEGALWANGI'),
(118, 14, 'MUNDUREJO'),
(119, 15, 'REJO AGUNG'),
(120, 15, 'SEMBORO'),
(121, 15, 'SIDOMEKAR'),
(122, 15, 'SIDOMULYO'),
(123, 15, 'PONDOK JOYO'),
(124, 15, 'PONDOK DALEM'),
(125, 16, 'KETING'),
(126, 16, 'JOMBANG'),
(127, 16, 'PADOMASAN'),
(128, 16, 'NGAMPELREJO'),
(129, 16, 'WRINGIN AGUNG'),
(130, 16, 'SARIMULYO'),
(131, 17, 'SUMBER AGUNG'),
(132, 17, 'ROWO TENGAH'),
(133, 17, 'YOSORATI'),
(134, 17, 'PRINGGOWIRAWAN'),
(135, 17, 'KARANG BAYAT'),
(136, 17, 'GELANG'),
(137, 17, 'JATIROTO'),
(138, 17, 'JAMINTORO'),
(139, 17, 'KALIGLAGAH'),
(140, 17, 'JAMBESARI'),
(141, 18, 'TANGGUL KULON'),
(142, 18, 'TANGGUL WETAN'),
(143, 18, 'KLATAKAN'),
(144, 18, 'SELODAKON'),
(145, 18, 'DARUNGAN'),
(146, 18, 'MANGGISAN'),
(147, 18, 'PATEMON'),
(148, 18, 'KRAMAT SUKOHARJO'),
(149, 19, 'KARANGSONO'),
(150, 19, 'SUKOREJO'),
(151, 19, 'PETUNG'),
(152, 19, 'TISNOGAMBAR'),
(153, 19, 'LANGKAP'),
(154, 19, 'BANGSALSARI'),
(155, 19, 'GAMBIRONO'),
(156, 19, 'CURAH KALONG'),
(157, 19, 'TUGUSARI'),
(158, 19, 'BANJARSARI'),
(159, 19, 'BADEAN'),
(160, 20, 'KEMUNINGSARI LOR'),
(161, 20, 'GLAGAHWERO'),
(162, 20, 'SERUT'),
(163, 20, 'PANTI'),
(164, 20, 'PAKIS'),
(165, 20, 'SUCI'),
(166, 20, 'KEMIRI'),
(167, 21, 'JUBUNG'),
(168, 21, 'DUKUH MENCEK'),
(169, 21, 'SUKORAMBI'),
(170, 21, 'KARANGPRING'),
(171, 21, 'KELUNGKUNG'),
(172, 22, 'KEMUNINGLLOR'),
(173, 22, 'DARSONO'),
(174, 22, 'ARJASA'),
(175, 22, 'BITING'),
(176, 22, 'CANDIJATI'),
(177, 22, 'KAMAL'),
(178, 23, 'KERTOSARI'),
(179, 23, 'PAKUSARI'),
(180, 23, 'JATIAN'),
(181, 23, 'SUBO'),
(182, 23, 'SUMBER PINANG'),
(183, 23, 'BEDADUNG'),
(184, 23, ' PATEMON'),
(185, 24, 'GAMBIRAN'),
(186, 24, 'PLALANGAN'),
(187, 24, 'AJUNG'),
(188, 24, 'GLAGAHWERO'),
(189, 24, 'SUMBER JERUK'),
(190, 24, 'GUMUKSARI'),
(191, 24, 'PATEMPURAN'),
(192, 24, 'KALISAT'),
(193, 24, 'SUMBER KETEMPAH'),
(194, 24, 'SUKORENO'),
(195, 24, 'SUMBER KALONG'),
(196, 24, 'SEBANEN'),
(197, 25, 'SUREN'),
(198, 25, 'SUMBER SALAK'),
(199, 25, 'SUMBER BULUS'),
(200, 25, 'SUMBER LESUNG'),
(201, 25, 'LEMBENGAN'),
(202, 25, 'SUMBER ANGET'),
(203, 25, 'LEDOKOMBO'),
(204, 25, 'SLATENG'),
(205, 25, 'SUKOGIDRI'),
(206, 25, 'KARANG PAITON'),
(207, 26, 'RANDU AGUNG'),
(208, 26, 'CUMEDAK'),
(209, 26, 'GUNUNG MALANG'),
(210, 26, 'ROWOSARI'),
(211, 26, 'SUMBERJAMBE'),
(212, 26, 'SUMBER PAKEM'),
(213, 26, 'PLEREYAN'),
(214, 26, 'PRINGGONDANI'),
(215, 26, 'JAMBE ARUM'),
(216, 27, 'SUMBERWARU'),
(217, 27, 'SUKOREJO'),
(218, 27, 'SUKOSARI'),
(219, 27, 'BALET BARU'),
(220, 27, 'SUMBER WRINGIN'),
(221, 27, 'MOJOGEMI'),
(222, 27, 'SUKOKERTO'),
(223, 27, 'SUKOWONO'),
(224, 27, 'DAWUHAN MANGLI'),
(225, 27, 'ARJASA'),
(226, 27, 'SUMBERDANTI'),
(227, 27, 'POCANGAN'),
(228, 28, 'PANDUMAN'),
(229, 28, 'JELBUK'),
(230, 28, 'SUKOWIRYO'),
(231, 28, 'SUGER KIDUL'),
(232, 28, 'SUKO JEMBER'),
(233, 28, 'SUCO PANGEPOK'),
(234, 29, 'MANGLI'),
(235, 29, 'SEMPUSARI'),
(236, 29, 'KALIWATES'),
(237, 29, 'TEGAL BESAR'),
(238, 29, 'JEMBER KIDUL'),
(239, 29, 'KEPATIHAN'),
(240, 29, 'KEBON AGUNG'),
(241, 30, 'KERANJINGAN'),
(242, 30, 'WIROLEGI'),
(243, 30, 'KARANGREJO'),
(244, 30, 'KEBONSARI'),
(245, 30, 'SUMBERSARI'),
(246, 30, 'TEGAL GEDE'),
(247, 30, 'ANTIROGO'),
(248, 31, 'GEBANG'),
(249, 31, 'JEMBER LOR'),
(250, 31, 'PATRANG'),
(251, 31, 'BARATAN'),
(252, 31, 'BINTORO'),
(253, 31, 'SLAWU'),
(254, 31, 'JUMERTO'),
(255, 31, 'BANJAR SENGON');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `isi` text NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `id_penulis` int(11) NOT NULL,
  `dibuat` datetime NOT NULL,
  `diubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `isi`, `id_laporan`, `id_penulis`, `dibuat`, `diubah`) VALUES
(3, 'Hello, ini komentar dari yanto\r\nedited by me. edited again', 7, 6, '2018-11-02 09:40:45', '2018-11-02 13:36:48'),
(4, 'Ini komentar gan!', 5, 1, '2018-11-02 09:53:40', NULL),
(5, 'coba komentar baru\r\nmengubah komentar', 7, 6, '2018-11-02 13:46:11', '2018-11-02 13:46:48'),
(6, 'ini komentar saya diedit', 17, 2, '2018-11-19 10:12:28', '2018-11-19 10:12:39'),
(8, 'coba lah komentar ini bkjkjh', 27, 1, '2018-12-03 08:24:55', '2018-12-03 08:41:38'),
(10, 'ini telah diubah\r\nubah lagilah', 28, 1, '2018-12-07 16:11:07', '2018-12-09 17:17:26'),
(11, 'Laporan Akan Segera Saya Tangani, kepada pihak terkait. -Admin 1-\r\nedited gan', 29, 1, '2018-12-07 18:30:21', '2018-12-09 13:30:52'),
(12, 'testing', 30, 26, '2018-12-07 19:20:09', NULL),
(13, 'halo 123', 30, 1, '2018-12-07 19:21:48', '2018-12-07 19:22:15'),
(14, '<cript>alert(\'coba\')</script>', 26, 1, '2018-12-09 12:52:31', '2018-12-09 19:58:39'),
(15, 'ini komentar baru gan\r\nedit lagi', 30, 1, '2018-12-09 13:22:06', '2018-12-09 13:34:00'),
(16, 'coba komen lagi gan', 7, 1, '2018-12-09 13:38:56', '2018-12-09 13:50:59'),
(17, 'new comment here', 7, 1, '2018-12-09 13:51:39', '2018-12-09 13:51:54'),
(19, 'coba lagi\r\nedited gan\r\nedit lagi lah gan', 28, 1, '2018-12-09 16:24:28', '2018-12-09 17:22:56'),
(20, 'Ini komen baru\r\ndiubah dulu', 28, 1, '2018-12-09 16:45:09', '2018-12-09 17:15:39'),
(21, 'mencoba lagi komanter\r\nedit gan !', 28, 1, '2018-12-09 17:17:12', '2018-12-09 17:17:50'),
(22, 'ini komentar baru ya\r\ndiubah ya', 27, 2, '2018-12-09 17:28:35', '2018-12-09 17:28:49'),
(23, 'edited gan', 32, 18, '2018-12-09 20:45:06', '2018-12-09 20:45:35'),
(24, 'alert(\"dicoba\");', 26, 2, '2018-12-10 19:49:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `tgl_laporan` datetime NOT NULL,
  `deskripsi` text NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `picture` text,
  `id_kecamatan` int(11) NOT NULL,
  `id_kelurahan` int(11) NOT NULL,
  `id_pelapor` int(11) NOT NULL,
  `status` enum('Belum diverifikasi','Sedang ditangani','Selesai') NOT NULL,
  `id_ubahStatus` int(11) DEFAULT NULL,
  `tgl_ubahStatus` datetime DEFAULT NULL,
  `dibuat` datetime NOT NULL,
  `diubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `judul`, `tgl_laporan`, `deskripsi`, `alamat`, `picture`, `id_kecamatan`, `id_kelurahan`, `id_pelapor`, `status`, `id_ubahStatus`, `tgl_ubahStatus`, `dibuat`, `diubah`) VALUES
(1, 'Pencurian Rumah Mewah di JL kayu 4 no.12', '2018-10-25 01:30:00', 'Rumah mewah milik bapak Sudarsono kemalingan pada kamis lalu, pelaku diduga masuk lewat pintu belakang yang tidak terkunci', 'JL kayu 4 no.12', '../storage/laporan-pic/1.jpg', 5, 46, 2, 'Belum diverifikasi', NULL, NULL, '2018-10-27 12:31:06', '2018-10-27 23:44:11'),
(2, 'Tabrak lari di Dekat Pom bensin', '2018-10-24 12:30:00', 'Telah terjadi kecelakaan tabrak lari di mana seorang pengendara sepeda motor diserempet oleh mobil box. Korban mengalami luka berat. ', 'JL raya muara ', '', 15, 121, 2, 'Belum diverifikasi', NULL, NULL, '2018-10-27 13:03:55', NULL),
(3, 'mencoba lagi fitur laporan ini', '2018-10-24 13:40:00', 'contoh deskripsi dari percobaan pada fitur laporan ini', 'jl nias 4 no 14', '', 30, 244, 2, 'Sedang ditangani', 1, '2018-10-28 23:01:19', '2018-10-27 17:16:01', '2018-10-28 23:01:19'),
(4, 'sekali lagi mencoba fitur laporan', '2018-10-26 02:50:00', 'ini apa hayo? ini namanya deskripsi !', 'jl kelapa no 16', '', 9, 72, 2, 'Selesai', 1, '2018-10-28 22:51:12', '2018-10-27 17:18:02', '2018-10-28 22:51:12'),
(5, 'Teruslah mencoba hingga bisa, diedit', '2018-10-22 14:15:00', 'terus mencoba tanpa kenal lelah, hingga project ini selesai pada akhirnya', 'jl coba 2 no 10', '../storage/laporan-pic/5.jpg', 13, 105, 2, 'Sedang ditangani', 1, '2018-10-28 22:43:02', '2018-10-27 17:23:33', '2018-11-03 13:28:14'),
(7, 'testing fitur mengubah laporan (lagi, karena bug)2', '2018-10-25 15:15:00', 'kali ini fitur laporan dicoba menggunakan gambar, apakah bisa atau tidak menyimpan gambar\r\nini perubahan terhadap isi laporan', 'jl padi 3 no 10', '../storage/laporan-pic/7.jpg', 24, 190, 6, 'Selesai', 1, '2018-10-28 22:35:38', '2018-10-27 19:30:30', '2018-11-02 16:46:18'),
(15, 'Laporan saya untuk mencoba fitur notif', '2018-11-08 10:30:00', 'Laporan ini dibuat dengan tujuan untuk mencoba fitur notif laporan', 'JL mangga raya no 12', '', 13, 105, 2, 'Sedang ditangani', 1, '2018-11-24 11:28:22', '2018-11-09 10:32:07', '2018-11-24 11:28:22'),
(16, 'Pencurian Perahu nelayan warga', '2018-11-08 03:40:00', 'Telah terjadi pencurian kapal nelayan milik warga, sejumlah 2 kapal lenyap', 'JL pantai panajng 10', '../storage/laporan-pic/16.jpg', 3, 18, 2, 'Selesai', 1, '2018-11-24 10:39:15', '2018-11-09 14:20:29', '2018-11-24 10:39:15'),
(17, 'mari membuat laporan baru', '2018-11-08 20:40:00', 'Ini adalah laporan yang digunakan untuk menguji fitur notifikasi', 'JL jepara 4 no.12', '', 17, 138, 2, 'Selesai', 1, '2018-11-24 09:16:22', '2018-11-09 17:21:49', '2018-11-24 09:16:22'),
(18, 'Tabrak lari di depan bundaran kota', '2018-11-08 08:40:00', 'Telah terjadi kecelakaan antra sepeda motor dan mobil pick-up, pengendara sepeda terluka parah. Mobil pick-up langsung menghilang', 'JL Ahmad yani ', '', 9, 76, 18, 'Selesai', 1, '2018-11-24 09:10:24', '2018-11-09 20:50:39', '2018-11-24 09:10:24'),
(19, 'Mencoba lagi', '2018-11-23 15:30:00', 'ini adalah deskripsi laporan', 'jl buntuk 7', '', 9, 74, 2, 'Belum diverifikasi', NULL, NULL, '2018-11-27 15:33:18', NULL),
(20, 'uji coba laporan', '2018-11-25 16:30:00', 'ini laporan saya pak', 'jl jalan-jalan no.3', '', 13, 105, 2, 'Belum diverifikasi', NULL, NULL, '2018-11-27 15:34:15', NULL),
(21, 'mencoba laporan utk paginate', '2018-11-25 12:30:00', 'ini adalah isi laporan', 'jl bata no.4', '', 1, 2, 6, 'Belum diverifikasi', NULL, NULL, '2018-11-27 16:10:32', NULL),
(22, 'test utk pagination', '2018-11-26 17:40:00', 'ini apa ya?\r\nini deskripsi', 'jl coba lagi no.2', '', 5, 44, 6, 'Belum diverifikasi', NULL, NULL, '2018-11-27 23:17:20', NULL),
(23, 'coba lapor utk pagination', '2018-11-27 10:30:00', 'ini deskrpsinya', 'JL Bambu 2 ', '../storage/laporan-pic/23.jpg', 4, 28, 2, 'Belum diverifikasi', NULL, NULL, '2018-11-28 22:46:35', '2018-12-01 12:11:31'),
(24, 'dadadadad', '2018-11-26 02:12:00', 'mencoba isi deskripsi', 'jl mealti 4', '', 4, 30, 2, 'Belum diverifikasi', NULL, NULL, '2018-12-01 13:41:33', NULL),
(25, 'coba buat laporan 123', '2018-11-29 22:30:00', 'ini adalah deskripsi', 'ji melati 4 no 10', '', 13, 103, 2, 'Belum diverifikasi', NULL, NULL, '2018-12-01 14:01:46', NULL),
(26, 'coba trooooos', '2018-12-01 22:30:00', 'dadasdasdasfa', 'jl melati 5 no 9', '', 13, 103, 2, 'Belum diverifikasi', NULL, NULL, '2018-12-01 14:29:31', '2018-12-10 19:44:49'),
(27, 'lapor gan lapor', '2018-12-01 08:30:00', 'dsadasfafadcxzcafca', 'jl menganti 5 no 10', '', 15, 121, 2, 'Sedang ditangani', 1, '2018-12-03 08:21:12', '2018-12-01 14:33:15', '2018-12-03 08:21:12'),
(28, 'inilah laporan terbaru saya ', '2018-12-05 10:30:00', 'ini deskripsi', 'JL kayu 4 no.1', '../storage/laporan-pic/28.jpg', 29, 236, 2, 'Selesai', 1, '2018-12-07 16:10:09', '2018-12-07 16:07:59', '2018-12-07 16:10:09'),
(29, 'Kebakaran Hutan Doraemon', '2018-12-05 10:09:00', 'Kebakaran Hutan Doraemon disebabkan oleh Nobita yang sedang galau mencari pujaan hati', 'Jalan Ngurah Rai Bali No 17', '../storage/laporan-pic/29.jpg', 12, 97, 25, 'Sedang ditangani', 1, '2018-12-07 18:29:38', '2018-12-07 18:27:06', '2018-12-07 18:29:38'),
(30, 'Jalan Rusak', '2018-06-04 10:09:00', 'testig', 'Jember', '../storage/laporan-pic/30.jpg', 29, 234, 26, 'Selesai', 1, '2018-12-07 19:21:37', '2018-12-07 19:18:10', '2018-12-07 19:21:37'),
(31, 'judulnya gan nih', '2018-12-08 12:10:00', 'coba lagi gan \r\nalert(\'jfaklf\');\r\ntest lagi dan lagi', 'JL alamat saya', '', 29, 237, 2, 'Belum diverifikasi', NULL, NULL, '2018-12-09 19:01:58', '2018-12-09 19:35:00'),
(32, 'ini laporan terbaru milik saya', '2018-11-30 21:30:00', 'masih dicoba gan...', 'alert(\"cobalah..\");', '', 27, 219, 18, 'Belum diverifikasi', NULL, NULL, '2018-12-09 20:44:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `tipe` varchar(25) NOT NULL,
  `id_obyek` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `dilihat` datetime DEFAULT NULL,
  `dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `tipe`, `id_obyek`, `id_penerima`, `dilihat`, `dibuat`) VALUES
(2, 'laporan', 15, 1, '2018-11-09 13:48:38', '2018-11-09 10:32:07'),
(3, 'laporan', 16, 1, '2018-11-09 14:25:19', '2018-11-09 14:20:29'),
(30, 'laporan', 17, 1, '2018-11-09 19:45:17', '2018-11-09 17:21:50'),
(31, 'laporan', 18, 1, '2018-11-09 20:55:15', '2018-11-09 20:50:39'),
(32, 'laporan', 19, 1, '2018-11-27 21:32:31', '2018-11-27 15:33:18'),
(33, 'laporan', 20, 1, '2018-12-01 16:47:29', '2018-11-27 15:34:16'),
(34, 'laporan', 21, 1, '2018-12-01 16:47:35', '2018-11-27 16:10:32'),
(47, 'laporan', 22, 1, '2018-12-01 16:47:43', '2018-11-27 23:17:20'),
(72, 'laporan', 23, 1, '2018-11-29 00:44:52', '2018-11-28 22:46:35'),
(73, 'pengumuman', 11, 2, '2018-11-29 00:52:29', '2018-11-28 23:49:50'),
(74, 'pengumuman', 11, 3, NULL, '2018-11-28 23:49:50'),
(75, 'pengumuman', 11, 5, NULL, '2018-11-28 23:49:50'),
(76, 'pengumuman', 11, 6, NULL, '2018-11-28 23:49:50'),
(77, 'pengumuman', 11, 7, NULL, '2018-11-28 23:49:50'),
(78, 'pengumuman', 11, 11, NULL, '2018-11-28 23:49:50'),
(79, 'pengumuman', 11, 12, NULL, '2018-11-28 23:49:50'),
(80, 'pengumuman', 11, 14, NULL, '2018-11-28 23:49:50'),
(81, 'pengumuman', 11, 15, NULL, '2018-11-28 23:49:50'),
(82, 'pengumuman', 11, 17, NULL, '2018-11-28 23:49:50'),
(83, 'pengumuman', 11, 18, NULL, '2018-11-28 23:49:50'),
(84, 'pengumuman', 11, 19, NULL, '2018-11-28 23:49:50'),
(121, 'laporan', 24, 1, '2018-12-10 20:17:58', '2018-12-01 13:41:33'),
(122, 'laporan', 25, 1, '2018-12-10 20:18:09', '2018-12-01 14:01:46'),
(123, 'laporan', 26, 1, '2018-12-09 12:52:11', '2018-12-01 14:29:31'),
(124, 'laporan', 27, 1, '2018-12-03 07:42:32', '2018-12-01 14:33:15'),
(142, 'laporan', 28, 1, '2018-12-07 16:09:51', '2018-12-07 16:07:59'),
(211, 'pengumuman', 20, 2, '2018-12-10 20:05:36', '2018-12-07 16:30:46'),
(212, 'pengumuman', 20, 3, NULL, '2018-12-07 16:30:46'),
(213, 'pengumuman', 20, 5, NULL, '2018-12-07 16:30:46'),
(214, 'pengumuman', 20, 6, NULL, '2018-12-07 16:30:46'),
(215, 'pengumuman', 20, 7, NULL, '2018-12-07 16:30:46'),
(216, 'pengumuman', 20, 11, NULL, '2018-12-07 16:30:46'),
(217, 'pengumuman', 20, 12, NULL, '2018-12-07 16:30:46'),
(218, 'pengumuman', 20, 14, NULL, '2018-12-07 16:30:46'),
(219, 'pengumuman', 20, 15, NULL, '2018-12-07 16:30:46'),
(220, 'pengumuman', 20, 17, NULL, '2018-12-07 16:30:46'),
(221, 'pengumuman', 20, 18, NULL, '2018-12-07 16:30:46'),
(222, 'pengumuman', 20, 19, NULL, '2018-12-07 16:30:46'),
(223, 'pengumuman', 20, 20, NULL, '2018-12-07 16:30:46'),
(224, 'pengumuman', 20, 21, NULL, '2018-12-07 16:30:46'),
(225, 'pengumuman', 20, 22, NULL, '2018-12-07 16:30:46'),
(226, 'pengumuman', 20, 23, NULL, '2018-12-07 16:30:46'),
(227, 'pengumuman', 20, 24, NULL, '2018-12-07 16:30:46'),
(296, 'laporan', 29, 1, '2018-12-07 18:29:26', '2018-12-07 18:27:06'),
(297, 'laporan', 30, 1, '2018-12-07 19:20:54', '2018-12-07 19:18:10'),
(374, 'pengumuman', 29, 2, '2018-12-10 20:05:31', '2018-12-09 12:04:20'),
(375, 'pengumuman', 29, 3, NULL, '2018-12-09 12:04:20'),
(376, 'pengumuman', 29, 5, NULL, '2018-12-09 12:04:20'),
(377, 'pengumuman', 29, 6, NULL, '2018-12-09 12:04:20'),
(378, 'pengumuman', 29, 7, NULL, '2018-12-09 12:04:20'),
(379, 'pengumuman', 29, 11, NULL, '2018-12-09 12:04:20'),
(380, 'pengumuman', 29, 12, NULL, '2018-12-09 12:04:20'),
(381, 'pengumuman', 29, 14, NULL, '2018-12-09 12:04:20'),
(382, 'pengumuman', 29, 15, NULL, '2018-12-09 12:04:20'),
(383, 'pengumuman', 29, 17, NULL, '2018-12-09 12:04:20'),
(384, 'pengumuman', 29, 18, NULL, '2018-12-09 12:04:20'),
(385, 'pengumuman', 29, 19, NULL, '2018-12-09 12:04:20'),
(386, 'pengumuman', 29, 20, NULL, '2018-12-09 12:04:20'),
(387, 'pengumuman', 29, 21, NULL, '2018-12-09 12:04:20'),
(388, 'pengumuman', 29, 22, NULL, '2018-12-09 12:04:20'),
(389, 'pengumuman', 29, 23, NULL, '2018-12-09 12:04:20'),
(390, 'pengumuman', 29, 24, NULL, '2018-12-09 12:04:20'),
(391, 'pengumuman', 29, 25, NULL, '2018-12-09 12:04:20'),
(392, 'pengumuman', 29, 26, NULL, '2018-12-09 12:04:20'),
(393, 'pengumuman', 30, 2, '2018-12-10 20:05:26', '2018-12-09 12:04:48'),
(394, 'pengumuman', 30, 3, NULL, '2018-12-09 12:04:48'),
(395, 'pengumuman', 30, 5, NULL, '2018-12-09 12:04:48'),
(396, 'pengumuman', 30, 6, NULL, '2018-12-09 12:04:48'),
(397, 'pengumuman', 30, 7, NULL, '2018-12-09 12:04:48'),
(398, 'pengumuman', 30, 11, NULL, '2018-12-09 12:04:48'),
(399, 'pengumuman', 30, 12, NULL, '2018-12-09 12:04:48'),
(400, 'pengumuman', 30, 14, NULL, '2018-12-09 12:04:48'),
(401, 'pengumuman', 30, 15, NULL, '2018-12-09 12:04:48'),
(402, 'pengumuman', 30, 17, NULL, '2018-12-09 12:04:48'),
(403, 'pengumuman', 30, 18, '2018-12-09 21:09:52', '2018-12-09 12:04:48'),
(404, 'pengumuman', 30, 19, NULL, '2018-12-09 12:04:48'),
(405, 'pengumuman', 30, 20, NULL, '2018-12-09 12:04:48'),
(406, 'pengumuman', 30, 21, NULL, '2018-12-09 12:04:48'),
(407, 'pengumuman', 30, 22, NULL, '2018-12-09 12:04:48'),
(408, 'pengumuman', 30, 23, NULL, '2018-12-09 12:04:48'),
(409, 'pengumuman', 30, 24, NULL, '2018-12-09 12:04:48'),
(410, 'pengumuman', 30, 25, NULL, '2018-12-09 12:04:48'),
(411, 'pengumuman', 30, 26, NULL, '2018-12-09 12:04:48'),
(489, 'laporan', 31, 1, '2018-12-09 19:54:55', '2018-12-09 19:01:58'),
(490, 'pengumuman', 35, 2, '2018-12-10 19:43:37', '2018-12-09 20:33:07'),
(491, 'pengumuman', 35, 3, NULL, '2018-12-09 20:33:07'),
(492, 'pengumuman', 35, 5, NULL, '2018-12-09 20:33:07'),
(493, 'pengumuman', 35, 6, NULL, '2018-12-09 20:33:07'),
(494, 'pengumuman', 35, 7, NULL, '2018-12-09 20:33:07'),
(495, 'pengumuman', 35, 11, NULL, '2018-12-09 20:33:07'),
(496, 'pengumuman', 35, 12, NULL, '2018-12-09 20:33:07'),
(497, 'pengumuman', 35, 14, NULL, '2018-12-09 20:33:07'),
(498, 'pengumuman', 35, 15, NULL, '2018-12-09 20:33:07'),
(499, 'pengumuman', 35, 17, NULL, '2018-12-09 20:33:07'),
(500, 'pengumuman', 35, 18, '2018-12-09 21:09:34', '2018-12-09 20:33:07'),
(501, 'pengumuman', 35, 19, NULL, '2018-12-09 20:33:07'),
(502, 'pengumuman', 35, 20, NULL, '2018-12-09 20:33:07'),
(503, 'pengumuman', 35, 21, NULL, '2018-12-09 20:33:07'),
(504, 'pengumuman', 35, 22, NULL, '2018-12-09 20:33:07'),
(505, 'pengumuman', 35, 23, NULL, '2018-12-09 20:33:07'),
(506, 'pengumuman', 35, 24, NULL, '2018-12-09 20:33:07'),
(507, 'pengumuman', 35, 25, NULL, '2018-12-09 20:33:07'),
(508, 'pengumuman', 35, 26, NULL, '2018-12-09 20:33:07'),
(509, 'pengumuman', 35, 27, NULL, '2018-12-09 20:33:07'),
(510, 'laporan', 32, 1, '2018-12-10 20:18:03', '2018-12-09 20:44:29');

-- --------------------------------------------------------

--
-- Table structure for table `notif_pengumuman`
--

CREATE TABLE `notif_pengumuman` (
  `id` int(11) NOT NULL,
  `id_pengumuman` int(11) NOT NULL,
  `id_penerima` int(11) NOT NULL,
  `dilihat` datetime NOT NULL,
  `dibuat` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pengumuman`
--

CREATE TABLE `pengumuman` (
  `id` int(11) NOT NULL,
  `judul` varchar(150) NOT NULL,
  `isi` text NOT NULL,
  `picture` text,
  `id_kategori` int(11) NOT NULL,
  `id_penulis` int(11) NOT NULL,
  `dibuat` datetime NOT NULL,
  `diubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengumuman`
--

INSERT INTO `pengumuman` (`id`, `judul`, `isi`, `picture`, `id_kategori`, `id_penulis`, `dibuat`, `diubah`) VALUES
(7, 'waspada pembunuh berkeliaran', 'dihimbau kepada warga agar berhati-hati terhadap pelaku pembunuhan yang saat ini masih dalam pengejaran', '../storage/pengumuman-pic/7.gif', 3, 1, '2018-11-03 14:54:15', NULL),
(11, 'mencoba lagi ann untuk paginasi', 'deskripsi yg mendeskripsikan laporan', '', 4, 1, '2018-11-28 23:49:50', NULL),
(20, 'mm nnj oo pp ', 'sadnasjkd ajsna\r\nnlaka \r\nadaskal', '', 3, 1, '2018-12-07 16:30:46', NULL),
(29, 'another one more to come', 'ncmncjdsnojwe', '', 1, 1, '2018-12-09 12:04:20', NULL),
(30, 'masih dicoba ', 'dfdlfklwfnw\r\nfsdfnlwk', '', 3, 1, '2018-12-09 12:04:48', NULL),
(35, 'kucoba terus fitur ini', 'alert(\"dicoba gan\");                                                ', '../storage/pengumuman-pic/35.png', 3, 1, '2018-12-09 20:33:07', '2018-12-09 20:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Masyarakat');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gender` enum('Laki-laki','Perempuan') NOT NULL,
  `noHP` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_role` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `dibuat` datetime NOT NULL,
  `diubah` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `nik`, `tgl_lahir`, `gender`, `noHP`, `alamat`, `id_role`, `picture`, `dibuat`, `diubah`) VALUES
(1, 'admin1', 'admin1@admin.com', 'admin321', '1112131415161718', '1980-05-21', 'Laki-laki', '08572341567', 'jl kalimantan gg 3 no.10', 1, NULL, '2018-10-22 13:11:24', '2018-12-09 11:48:23'),
(2, 'budi Harianto', 'budi321@mail.com', 'budi4321', '1144226644886600', '1987-07-22', 'Laki-laki', '08123345678', 'JL Garuda 3 no 16', 2, '../storage/profile-pic/2.jpg', '2018-10-22 20:09:00', '2018-12-10 19:55:34'),
(3, 'Rani Ayu Purnomo', 'rani321@mail.com', 'rani321', '1215141817161910', '1983-06-15', 'Perempuan', '089224551589', 'JL sumatra gg 4 no 18', 2, '../storage/profile-pic/3.jpg', '2018-10-22 20:23:16', '2018-10-26 10:09:17'),
(5, 'Citra  Ningrum', 'citra321@mail.Com', 'citra321', '1019181716171316', '1988-02-20', 'Perempuan', '087521346887', 'JL gajah mada no 18', 2, NULL, '2018-10-22 21:21:17', NULL),
(6, 'Yanto wisnu', 'yanto321@mail.com', 'yanto321', '1021345678141561', '1987-06-10', 'Laki-laki', '087934568932', 'JL halmahera gg 3 no 7', 2, '../storage/profile-pic/6.jpg', '2018-10-22 21:55:06', '2018-11-02 09:28:18'),
(7, 'Pandu  Wahidun', 'pandu321@mail.com', 'pandu321', '1813191210101714', '1985-03-14', 'Laki-laki', '089543216748', 'JL Jawa gg 4 no. 17', 2, '../storage/profile-pic/7.png', '2018-10-23 13:09:09', '2018-12-11 21:19:45'),
(11, 'Nisa Indah Wardani', 'nisa321@mail.com', 'nisa321', '1612181517131011', '1985-06-16', 'Laki-laki', '087531246738', 'JL jawa 4 no.9', 2, NULL, '2018-10-24 08:29:24', NULL),
(12, 'Maya Restu Sari', 'maya321@mail.com', 'maya321', '1018161415131215', '1991-07-12', 'Laki-laki', '08563214785', 'JL gajah mada 2 no 15', 2, NULL, '2018-10-24 20:22:58', NULL),
(14, 'Rudi Kartono', 'rudi321@mail.com', 'rudi321', '1913161518171610', '1980-07-25', 'Laki-laki', '085623186647', 'JL halmahera 4 no 12', 2, NULL, '2018-10-25 07:36:40', NULL),
(15, 'Nurcahyani Ananda', 'nurcahyani321@mail.com', 'nurcahyani321', '1810171312121718', '1981-02-05', 'Perempuan', '087945782214', 'JL Mahakam Raya no 10', 2, NULL, '2018-11-07 19:56:04', NULL),
(17, 'Hakam Darmawan', 'hakam321@mail.com', 'hakam321', '1618101416131718', '1981-08-07', 'Laki-laki', '087943671389', 'JL indah raya no. 15', 2, NULL, '2018-11-07 20:04:48', NULL),
(18, 'Dewi Trikusuma', 'dewi321@mail.com', 'dewi321', '1010171518191312', '1983-05-10', 'Perempuan', '089145672318', 'JL aren 2 no.11', 2, '../storage/profile-pic/18.gif', '2018-11-07 20:08:51', '2018-12-09 21:26:44'),
(19, 'Rano Karno', 'rano321@mail.com', 'rano321', '1012181715191716', '1986-03-08', 'Laki-laki', '089341784567', 'JL maratam 2 no. 11', 2, NULL, '2018-11-24 10:02:15', NULL),
(20, 'adja bfdsjk', 'email@email.com', 'pass12345', '4567', '2018-11-03', 'Laki-laki', '5678', 'dadsad', 2, NULL, '2018-11-30 22:06:35', NULL),
(21, 'adkakf fsbkfbk', 'fbsk@mail.com', 'pass12345', '347623861378', '2018-11-01', 'Laki-laki', '47323438439143', 'qwe', 2, NULL, '2018-11-30 23:24:47', NULL),
(22, 'sfksfkjfb sbsjfk', 'fssjf@mail.com', 'pass12345', '438413684718', '2018-11-06', 'Laki-laki', '468246388278', '1234a', 2, NULL, '2018-11-30 23:26:28', NULL),
(23, 'sdfbkbfd bsdfbkds', 'fsj@mail.com', 'pass12345', '1718171615181610', '2018-11-01', 'Laki-laki', '7424834328829', 'fjdkfajfakfakjf', 2, NULL, '2018-11-30 23:56:20', NULL),
(24, 'Karen Narumi', 'karen321@mail.com', 'karen321', '1917101318161912', '1989-03-02', 'Perempuan', '08923679186', 'JL sumatra 4 no.12', 2, '../storage/profile-pic/24.gif', '2018-12-01 09:54:00', '2018-12-01 11:59:09'),
(25, 'Raditya  Mulya  Nugroho', 'raditya.mn99@gmail.com', 'raditya02', '1234567891234516', '2018-12-04', 'Laki-laki', '081234567654', 'Jalan Slamet Riyadi, Baratan Indah No 17', 2, NULL, '2018-12-07 18:24:12', NULL),
(26, 'Dewa Gede', 'dewa@gmail.com', 'raditya02', '1624101010121314', '2018-12-04', 'Laki-laki', '081232740593', 'Jember', 2, NULL, '2018-12-07 19:15:01', NULL),
(27, 'Romi Ba\'riq', 'romi4321@mail.com', 'romi4321', '1817161415181918', '2018-11-25', 'Laki-laki', '089453237342', 'JL ujung dunia 2 no.1', 2, NULL, '2018-12-09 12:48:08', NULL),
(28, 'nama kamu adalah', 'namakamu321@mail.com', 'namakamu321', '1716161617161819', '2018-11-28', 'Perempuan', '087653636131', 'ini alamat kamu', 2, NULL, '2018-12-11 21:42:30', NULL),
(29, 'Akun  Baru', 'akun321@mail.com', 'akunbaru321', '1615121815181018', '2018-11-25', 'Perempuan', '08563541773', 'JL mangga 4 ', 2, '../storage/profile-pic/29.jpg', '2018-12-11 21:50:58', '2018-12-11 21:53:06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kecamatan` (`id_kecamatan`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_laporan` (`id_laporan`),
  ADD KEY `id_penulis` (`id_penulis`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelapor` (`id_pelapor`),
  ADD KEY `id_kecamatan` (`id_kecamatan`),
  ADD KEY `id_kelurahan` (`id_kelurahan`);

--
-- Indexes for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_penerima` (`id_penerima`);

--
-- Indexes for table `notif_pengumuman`
--
ALTER TABLE `notif_pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_notifP_user` (`id_penerima`),
  ADD KEY `fk_notifP_pengumuman` (`id_pengumuman`);

--
-- Indexes for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori` (`id_kategori`),
  ADD KEY `id_penulis` (`id_penulis`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=511;

--
-- AUTO_INCREMENT for table `notif_pengumuman`
--
ALTER TABLE `notif_pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pengumuman`
--
ALTER TABLE `pengumuman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD CONSTRAINT `fk_kec_kel` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `fk_laporan_komen` FOREIGN KEY (`id_laporan`) REFERENCES `laporan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_laporan_user` FOREIGN KEY (`id_penulis`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `fk_lapor_kec` FOREIGN KEY (`id_kecamatan`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lapor_kel` FOREIGN KEY (`id_kelurahan`) REFERENCES `kelurahan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_lapor_user` FOREIGN KEY (`id_pelapor`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD CONSTRAINT `fk_notif_user` FOREIGN KEY (`id_penerima`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notif_pengumuman`
--
ALTER TABLE `notif_pengumuman`
  ADD CONSTRAINT `fk_notifP_pengumuman` FOREIGN KEY (`id_pengumuman`) REFERENCES `pengumuman` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notifP_user` FOREIGN KEY (`id_penerima`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengumuman`
--
ALTER TABLE `pengumuman`
  ADD CONSTRAINT `fk_pengumuman_ketegori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pengumuman_user1` FOREIGN KEY (`id_penulis`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
