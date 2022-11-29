-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 26, 2022 at 05:31 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banking`
--

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `username` varchar(16) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `no_tlp` varchar(14) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`username`, `nama`, `no_tlp`, `email`, `alamat`) VALUES
('andi1234', 'andi', '081234567895', 'andi@gmail.com', 'jln. mangga no 50 surabaya'),
('nindy123', 'nindy', '083762886399', 'nindy@gmail.com', 'jln. rambutan no. 56 gresik'),
('riki1234', 'riki', '081234557997', 'riki@gmail.com', 'ds gamongan'),
('rizki123', 'rizki alamsyah', '081367273623', 'rizki@gmail.com', 'jln. dukuh no 19 bangkalan'),
('zaenal123', 'Zaenal abidin syah', '081936625870', '210411100186@student.trunojoyo.ac.id', 'jln. mangga no. 2 surabaya');

-- --------------------------------------------------------

--
-- Table structure for table `rekening`
--

CREATE TABLE `rekening` (
  `no_rekening` varchar(10) NOT NULL,
  `username` varchar(16) NOT NULL,
  `saldo` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rekening`
--

INSERT INTO `rekening` (`no_rekening`, `username`, `saldo`) VALUES
('0237846251', 'nindy123', '2500000'),
('0384728635', 'zaenal123', '3500000'),
('0948378346', 'nindy123', '5000000'),
('1234567890', 'andi1234', '1000000'),
('1234567891', 'zaenal123', '-500000'),
('1256373878', 'zaenal123', '3000000'),
('1682635628', 'zaenal123', '5000000'),
('3762982736', 'rizki123', '4000000'),
('4536278905', 'zaenal123', '4500000'),
('5555567464', 'nindy123', '4000000'),
('6732845693', 'riki1234', '3000000'),
('6735283746', 'nindy123', '1000000'),
('6783625638', 'rizki123', '6500000'),
('6785634567', 'zaenal123', '1500000'),
('7643867398', 'rizki123', '6000000'),
('8763526738', 'riki1234', '3000000');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `rekening_pengirim` varchar(10) NOT NULL,
  `rekening_penerima` varchar(10) NOT NULL,
  `jumlah_transaksi` varchar(11) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `rekening_pengirim`, `rekening_penerima`, `jumlah_transaksi`, `tanggal`) VALUES
(4, '0384728635', '1682635628', '1000000', '2022-11-26'),
(6, '1682635628', '0384728635', '4000000', '2022-11-26'),
(8, '1234567891', '1682635628', '3000000', '2022-11-26'),
(9, '1234567891', '3762982736', '1000000', '2022-11-26'),
(11, '1256373878', '6735283746', '4000000', '2022-11-26'),
(12, '1682635628', '0948378346', '2000000', '2022-11-26'),
(13, '1682635628', '6735283746', '1000000', '2022-11-26'),
(14, '0384728635', '1682635628', '1000000', '2022-11-26'),
(16, '1682635628', '0384728635', '4000000', '2022-11-26'),
(18, '1234567891', '1682635628', '3000000', '2022-11-26'),
(19, '1234567891', '3762982736', '1000000', '2022-11-26'),
(21, '1256373878', '6735283746', '4000000', '2022-11-26'),
(22, '1682635628', '0948378346', '2000000', '2022-11-26'),
(23, '1682635628', '1256373878', '1000000', '2022-11-26');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `role` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `role`) VALUES
('admin', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', '1'),
('andi1234', '49727731b2dcb4a0d3afbca9d7de5f50eb52ead08f690d5652ef4f86555835c6', '0'),
('nindy123', '01cca05a57413961c689258457e50b317638e11a4ab2cc54635514b0d7663b6b', '0'),
('riki1234', 'b3212b7a5b04942327d50dd745b890d5c5165e7fe60360339b255e33635ec0ac', '0'),
('rizki123', '9075f3100605afe2b6713a2126ad284ad7e3a866d4fa2ab1a8d3b2c2aba2e3c0', '0'),
('zaenal123', '994b96ea4d9a55f4ba552d75b502c716081fb1d93bce220d6584736f5999a5e4', '0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `rekening`
--
ALTER TABLE `rekening`
  ADD PRIMARY KEY (`no_rekening`),
  ADD KEY `fk_rekening` (`username`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_transaksi_penerima` (`rekening_penerima`),
  ADD KEY `fk_transaksi_pengirim` (`rekening_pengirim`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profil`
--
ALTER TABLE `profil`
  ADD CONSTRAINT `fk_profil` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekening`
--
ALTER TABLE `rekening`
  ADD CONSTRAINT `fk_rekening` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_penerima` FOREIGN KEY (`rekening_penerima`) REFERENCES `rekening` (`no_rekening`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_transaksi_pengirim` FOREIGN KEY (`rekening_pengirim`) REFERENCES `rekening` (`no_rekening`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
