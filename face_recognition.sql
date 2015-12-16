-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2015 at 11:55 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `face_recognition`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
  `idKorisnik` int(11) NOT NULL AUTO_INCREMENT,
  `ime` varchar(100) COLLATE utf32_slovenian_ci NOT NULL,
  `email` varchar(80) COLLATE utf32_slovenian_ci NOT NULL,
  `password` varchar(32) COLLATE utf32_slovenian_ci NOT NULL,
  PRIMARY KEY (`idKorisnik`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_slovenian_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`idKorisnik`, `ime`, `email`, `password`) VALUES
(1, 'Ensar Muratovic', 'ensar.muratovic@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, 'ensar ensar', 'ensar@gmail.com', 'b1b60d922c535ff604333b89aa250e33'),
(3, 'muhamed mujic', 'muhamed@live.com', '87941c253d1b8c5257788d91344013ab'),
(4, 'ensar ensar', 'ensar@live.com', 'b1b60d922c535ff604333b89aa250e33'),
(5, 'aaa aaa', 'aaa@a.a', '47bce5c74f589f4867dbd57e9ca9f808'),
(6, 'nedim nedim', 'nedim@live.com', 'ac1fbc15be73fdcf2d2a36ad2bbc2c91'),
(7, 'aa aa', 'aa@live.com', '4124bc0a9335c27f086f24ba207a4912'),
(8, 'dd dd', 'dd@live.com', '1aabac6d068eef6a7bad3fdf50a05cc8'),
(9, 'Muhamed Mujic', 'mmujic1@etf.unsa.ba', '21232f297a57a5a743894a0e4a801fc3'),
(10, 'Himzo Polovina', 'himzo@live.com', '4ac0ce588b4d4a133e919db65b7df4b9');

-- --------------------------------------------------------

--
-- Table structure for table `lica`
--

CREATE TABLE IF NOT EXISTS `lica` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idSlike` int(11) NOT NULL,
  `ugao` float NOT NULL,
  `visina` float NOT NULL,
  `sirina` float NOT NULL,
  `godine` int(11) NOT NULL,
  `godineSigurnost` float NOT NULL,
  `rasa` varchar(10) COLLATE utf32_slovenian_ci NOT NULL,
  `rasaSigurnost` float NOT NULL,
  `brada` varchar(3) COLLATE utf32_slovenian_ci NOT NULL,
  `bradaSigurnost` float NOT NULL,
  `spol` varchar(6) COLLATE utf32_slovenian_ci NOT NULL,
  `spolSigurnost` float NOT NULL,
  `brkovi` varchar(3) COLLATE utf32_slovenian_ci NOT NULL,
  `brkoviSigurnost` float NOT NULL,
  `naocare` varchar(3) COLLATE utf32_slovenian_ci NOT NULL,
  `naocareSigurnost` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idSlike` (`idSlike`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_slovenian_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lica`
--

INSERT INTO `lica` (`id`, `idSlike`, `ugao`, `visina`, `sirina`, `godine`, `godineSigurnost`, `rasa`, `rasaSigurnost`, `brada`, `bradaSigurnost`, `spol`, `spolSigurnost`, `brkovi`, `brkoviSigurnost`, `naocare`, `naocareSigurnost`) VALUES
(1, 67, -3.7326, 589.05, 589.05, 47, 0.6, 'white', 1, 'no', 0.98, 'male', 1, 'yes', 1, 'no', 1),
(2, 69, -3.7326, 589.05, 589.05, 47, 0.6, 'white', 1, 'no', 0.98, 'male', 1, 'yes', 1, 'no', 1),
(3, 70, -3.7326, 589.05, 589.05, 47, 0.6, 'white', 1, 'no', 0.98, 'male', 1, 'yes', 1, 'no', 1),
(4, 74, 14.2573, 254.86, 254.86, 16, 0.6, 'no', 1, 'no', 1, 'smile', 1, 'no', 1, 'fem', 1),
(5, 74, -7.6866, 234.18, 234.18, 13, 0.6, 'no', 1, 'no', 0.94, 'smile', 0.97, 'no', 1, 'fem', 0.98);

-- --------------------------------------------------------

--
-- Table structure for table `slike`
--

CREATE TABLE IF NOT EXISTS `slike` (
  `idSlike` int(11) NOT NULL AUTO_INCREMENT,
  `korisnikId` int(11) NOT NULL,
  `url` varchar(100) COLLATE utf32_slovenian_ci NOT NULL,
  `velicina` int(11) NOT NULL,
  `format` varchar(20) COLLATE utf32_slovenian_ci NOT NULL,
  `duzina` int(11) NOT NULL,
  `sirina` int(11) NOT NULL,
  PRIMARY KEY (`idSlike`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_slovenian_ci AUTO_INCREMENT=75 ;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`idSlike`, `korisnikId`, `url`, `velicina`, `format`, `duzina`, `sirina`) VALUES
(62, 9, 'uploads/9b95de651f620622f6c041d781e56c67.jpg', 169019, 'jpg', 1280, 720),
(63, 9, 'uploads/69705267608f20651d92b0c22dbe9d80.jpg', 169019, 'jpg', 1280, 720),
(64, 9, 'uploads/24d9f8adbce9236fda5de5a80093f160.jpg', 169019, 'jpg', 1280, 720),
(65, 9, 'uploads/58a24bf07d25c1a45e6cee9981e0b019.jpg', 169019, 'jpg', 1280, 720),
(66, 9, 'uploads/f53b2aa200718545bdda02eb4d36bd32.jpg', 169019, 'jpg', 1280, 720),
(67, 9, 'uploads/e0b338e65c325a1e9fe2b0a80d034d23.jpg', 169019, 'jpg', 1280, 720),
(68, 9, 'uploads/a8dfca10c7c913f9ff93bbea0b6d55fe.jpg', 169019, 'jpg', 1280, 720),
(69, 9, 'uploads/f4ec9e2ad269174b33778577a7568940.jpg', 169019, 'jpg', 1280, 720),
(70, 9, 'uploads/83931828aa5eab5b5d493174c605c734.jpg', 169019, 'jpg', 1280, 720),
(71, 9, 'uploads/67778eaa68c5c61e9abffcfab2b16ac2.png', 7900, 'png', 399, 228),
(72, 9, 'uploads/c1676ec5cad7dba7431783b7a4de833e.png', 7900, 'png', 399, 228),
(73, 9, 'uploads/79a2b7576bf24d01c08377766d96a23e.png', 7900, 'png', 399, 228),
(74, 9, 'uploads/ad5f43939adb44c073ff748d43315d84.png', 7900, 'png', 399, 228);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
