-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 24, 2013 at 10:23 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbirigasi`
--

-- --------------------------------------------------------

--
-- Table structure for table `debit_air`
--

CREATE TABLE IF NOT EXISTS `debit_air` (
  `id_debit` int(11) NOT NULL AUTO_INCREMENT,
  `kode_petugas` varchar(10) NOT NULL,
  `tanggal` date NOT NULL,
  `debit_masuk` int(11) NOT NULL,
  `debit_sungai` int(11) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  PRIMARY KEY (`id_debit`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `debit_air`
--

INSERT INTO `debit_air` (`id_debit`, `kode_petugas`, `tanggal`, `debit_masuk`, `debit_sungai`, `keterangan`) VALUES
(31, 'PG001', '2013-08-08', 70, 2003, 'Banjir kecil'),
(30, 'PG001', '2013-08-07', 65, 1792, 'Banjir kecil'),
(29, 'PG001', '2013-08-06', 60, 1589, 'Banjir kecil'),
(28, 'PG002', '2013-08-05', 55, 1395, 'Banjir kecil'),
(27, 'PG002', '2013-08-04', 48, 1137, 'Banjir kecil'),
(26, 'PG002', '2013-08-03', 50, 1209, 'Banjir kecil'),
(24, 'PG002', '2013-08-01', 40, 865, 'Banjir kecil'),
(25, 'PG002', '2013-08-02', 45, 1032, 'Banjir kecil'),
(32, 'PG001', '2013-08-09', 80, 2447, 'Banjir kecil'),
(33, 'PG003', '2013-08-10', 90, 2920, 'Banjir biasa'),
(34, 'PG003', '2013-08-11', 90, 2920, 'Banjir biasa'),
(35, 'PG003', '2013-08-12', 85, 2680, 'Banjir biasa'),
(36, 'PG003', '2013-08-13', 80, 2447, 'Banjir kecil'),
(37, 'PG003', '2013-08-14', 80, 2447, 'Banjir kecil'),
(38, 'PG003', '2013-08-15', 70, 2003, 'Banjir kecil'),
(39, 'PG003', '2013-08-16', 60, 1589, 'Banjir kecil'),
(40, 'PG003', '2013-08-17', 50, 1209, 'Banjir kecil'),
(41, 'PG003', '2013-08-18', 40, 865, 'Banjir kecil'),
(42, 'PG003', '2013-08-19', 35, 708, 'Banjir kecil'),
(43, 'PG003', '2013-08-20', 45, 1032, 'Banjir kecil'),
(44, 'PG003', '2013-08-21', 45, 1032, 'Banjir kecil'),
(45, 'PG003', '2013-08-22', 50, 1209, 'Banjir kecil'),
(46, 'PG003', '2013-08-23', 50, 1209, 'Banjir kecil'),
(47, 'PG003', '2013-08-24', 56, 1433, 'Banjir kecil');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE IF NOT EXISTS `pengguna` (
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(30) NOT NULL,
  `level` varchar(10) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`username`, `password`, `nama_lengkap`, `level`) VALUES
('admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrator', 'admin'),
('akew', '2385fe7c9c5460cd6747255467d5b338', 'akew', 'petugas'),
('ahmad', '61243c7b9a4022cb3f8dc3106767ed12', 'ahmad', 'petugas'),
('abdul', '82027888c5bb8fc395411cb6804a066c', 'abdul', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE IF NOT EXISTS `petugas` (
  `kode_petugas` varchar(5) NOT NULL,
  `nama_petugas` varchar(30) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  PRIMARY KEY (`kode_petugas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`kode_petugas`, `nama_petugas`, `no_telp`, `alamat`) VALUES
('PG003', 'abdul', '6789', 'Mangkubumi'),
('PG002', 'ahmad', '23456', 'Tasik'),
('PG001', 'akew', '1234', 'CIbanjaran');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
