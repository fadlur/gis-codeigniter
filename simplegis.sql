-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2015 at 02:54 PM
-- Server version: 5.6.25-0ubuntu0.15.04.1
-- PHP Version: 5.6.4-4ubuntu6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `simplegis`
--

-- --------------------------------------------------------

--
-- Table structure for table `jalan`
--

CREATE TABLE IF NOT EXISTS `jalan` (
`id_jalan` int(11) NOT NULL,
  `namajalan` varchar(32) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jalan`
--

INSERT INTO `jalan` (`id_jalan`, `namajalan`, `keterangan`) VALUES
(1, 'jalan desa kembang', 'keterangan data jalan');

-- --------------------------------------------------------

--
-- Table structure for table `jembatan`
--

CREATE TABLE IF NOT EXISTS `jembatan` (
`id_jembatan` int(11) NOT NULL,
  `namajembatan` varchar(32) DEFAULT NULL,
  `keterangan` text
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jembatan`
--

INSERT INTO `jembatan` (`id_jembatan`, `namajembatan`, `keterangan`) VALUES
(1, 'jembatan gantungan', 'keterngan jembatan gantung');

-- --------------------------------------------------------

--
-- Table structure for table `koordinatjalan`
--

CREATE TABLE IF NOT EXISTS `koordinatjalan` (
`id_koordinatjalan` int(11) NOT NULL,
  `id_jalan` int(11) DEFAULT NULL,
  `latitude` varchar(24) DEFAULT NULL,
  `longitude` varchar(24) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `koordinatjalan`
--

INSERT INTO `koordinatjalan` (`id_koordinatjalan`, `id_jalan`, `latitude`, `longitude`) VALUES
(22, 1, '-6.809238024763568', '110.84383249282837'),
(23, 1, '-6.81247657422648', '110.85366010665894'),
(24, 1, '-6.803954028719589', '110.85705041885376');

-- --------------------------------------------------------

--
-- Table structure for table `koordinatjembatan`
--

CREATE TABLE IF NOT EXISTS `koordinatjembatan` (
`id_koordinatjembatan` int(11) NOT NULL,
  `id_jembatan` int(11) DEFAULT NULL,
  `latitude` varchar(24) DEFAULT NULL,
  `longitude` varchar(24) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `koordinatjembatan`
--

INSERT INTO `koordinatjembatan` (`id_koordinatjembatan`, `id_jembatan`, `latitude`, `longitude`) VALUES
(3, 1, '-6.798225372656344', '110.92573642730713');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(11) NOT NULL,
  `username` varchar(12) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jalan`
--
ALTER TABLE `jalan`
 ADD PRIMARY KEY (`id_jalan`);

--
-- Indexes for table `jembatan`
--
ALTER TABLE `jembatan`
 ADD PRIMARY KEY (`id_jembatan`);

--
-- Indexes for table `koordinatjalan`
--
ALTER TABLE `koordinatjalan`
 ADD PRIMARY KEY (`id_koordinatjalan`);

--
-- Indexes for table `koordinatjembatan`
--
ALTER TABLE `koordinatjembatan`
 ADD PRIMARY KEY (`id_koordinatjembatan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jalan`
--
ALTER TABLE `jalan`
MODIFY `id_jalan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jembatan`
--
ALTER TABLE `jembatan`
MODIFY `id_jembatan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `koordinatjalan`
--
ALTER TABLE `koordinatjalan`
MODIFY `id_koordinatjalan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `koordinatjembatan`
--
ALTER TABLE `koordinatjembatan`
MODIFY `id_koordinatjembatan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
