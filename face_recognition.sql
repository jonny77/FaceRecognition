-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2015 at 08:10 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_slovenian_ci AUTO_INCREMENT=9 ;

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
(8, 'dd dd', 'dd@live.com', '1aabac6d068eef6a7bad3fdf50a05cc8');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf32 COLLATE=utf32_slovenian_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `slike`
--

INSERT INTO `slike` (`idSlike`, `korisnikId`, `url`, `velicina`, `format`, `duzina`, `sirina`) VALUES
(8, 4, 'aaaajz', 10000, 'jpg', 300, 500),
(9, 4, 'aaaajz', 10000, 'jpg', 300, 500),
(10, 4, 'aaaajz', 10000, 'jpg', 300, 500),
(11, 4, 'uploads/erd.png', 10000, 'jpg', 300, 500),
(12, 4, 'uploads/erd.png', 49405, 'jpg', 300, 500),
(13, 4, 'uploads/erd.png', 49405, 'image/png', 300, 500),
(14, 4, 'uploads/erd.png', 49405, 'png', 300, 500),
(15, 4, 'uploads/erd.png', 49405, 'png', 764, 522),
(16, 4, 'uploads/erd.png', 49405, 'png', 764, 522),
(17, 4, 'uploads/erd.png', 49405, 'png', 764, 522),
(18, 4, 'uploads/ClassDiagram.jpg', 58045, 'jpg', 750, 405),
(19, 4, 'uploads/erd.png', 49405, 'png', 764, 522),
(20, 4, 'uploads/ClassDiagram.jpg', 58045, 'jpg', 750, 405),
(21, 4, 'uploads/erd.png', 49405, 'png', 764, 522),
(22, 4, 'uploads/erd.png', 49405, 'png', 764, 522);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
