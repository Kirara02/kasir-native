-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2022 at 06:38 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasir1`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kdbarang` varchar(10) NOT NULL,
  `nmbarang` varchar(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `tglkedaluarsa` date NOT NULL,
  `kdkategori` varchar(6) NOT NULL,
  `picture` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kdbarang`, `nmbarang`, `stok`, `harga`, `tglkedaluarsa`, `kdkategori`, `picture`) VALUES
('B0001', 'pensil', 19, 3000, '0000-00-00', '3', '05032022033222pensil.png'),
('B0005', 'Coca-cola 330 ml', 18, 7000, '2022-04-22', '2', '22022022022043cocacola330ml.jpg'),
('B0007', 'Indomie Goreng', 47, 3500, '2022-05-14', '1', '22022022022316indomie.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksi`
--

CREATE TABLE `detailtransaksi` (
  `iddetail` int(11) NOT NULL,
  `nomorfaktur` varchar(10) NOT NULL,
  `kdbarang` varchar(20) NOT NULL,
  `jmlbeli` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detailtransaksi`
--

INSERT INTO `detailtransaksi` (`iddetail`, `nomorfaktur`, `kdbarang`, `jmlbeli`, `harga`) VALUES
(286, 'trn0001', 'B0007', 1, 3500),
(288, 'trn0001', 'B0007', 1, 3500),
(289, 'trn0001', 'B0007', 1, 3500),
(290, 'trn0001', 'B0005', 1, 6000),
(291, 'trn0001', 'B0001', 1, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `kategoribarang`
--

CREATE TABLE `kategoribarang` (
  `kdkategori` varchar(5) NOT NULL,
  `nmkategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategoribarang`
--

INSERT INTO `kategoribarang` (`kdkategori`, `nmkategori`) VALUES
('1', 'makanann'),
('2', 'minuman'),
('3', 'ATK'),
('4', 'pakaian');

-- --------------------------------------------------------

--
-- Table structure for table `pembeli`
--

CREATE TABLE `pembeli` (
  `kdpembeli` varchar(5) NOT NULL,
  `nmpembeli` varchar(20) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembeli`
--

INSERT INTO `pembeli` (`kdpembeli`, `nmpembeli`, `jk`, `alamat`, `nohp`) VALUES
('PM001', 'kirara', 'L', 'kyoto', '085574476476'),
('PM002', 'megumi', 'P', 'hokkaido', '085574475342');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `kdpetugas` varchar(5) NOT NULL,
  `nmpetugas` varchar(20) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `alamat` text NOT NULL,
  `nohp` varchar(15) NOT NULL,
  `level` varchar(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`kdpetugas`, `nmpetugas`, `jk`, `alamat`, `nohp`, `level`, `username`, `password`) VALUES
('PT002', 'Kitagawa Marin', 'P', 'Tokyo', '085221067868', 'Pemilik', 'marin', 'marin'),
('PT006', 'zacky', 'L', 'wewet4', '085574476476', 'Pegawai', 'zack', 'zack');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `nomorfaktur` varchar(10) NOT NULL,
  `kdpembeli` varchar(20) NOT NULL,
  `kdpetugas` varchar(20) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`nomorfaktur`, `kdpembeli`, `kdpetugas`, `waktu`) VALUES
('trn0001', 'PM001', 'PT002', '2022-03-05 07:52:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kdbarang`),
  ADD KEY `kdkategori` (`kdkategori`);

--
-- Indexes for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD PRIMARY KEY (`iddetail`),
  ADD KEY `nomorfaktur` (`nomorfaktur`),
  ADD KEY `kdbarang` (`kdbarang`);

--
-- Indexes for table `kategoribarang`
--
ALTER TABLE `kategoribarang`
  ADD PRIMARY KEY (`kdkategori`);

--
-- Indexes for table `pembeli`
--
ALTER TABLE `pembeli`
  ADD PRIMARY KEY (`kdpembeli`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`kdpetugas`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`nomorfaktur`),
  ADD KEY `kdpembeli` (`kdpembeli`),
  ADD KEY `kdpetugas` (`kdpetugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  MODIFY `iddetail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
