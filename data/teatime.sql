-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2020 at 11:05 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teatime`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`, `nama`, `tanggalLahir`, `alamat`) VALUES
('admingadung@teatime.com', 'admingadung', 'Admin Gadung', '1990-04-21', 'Jl. Ciumbuleuit No. 95');

-- --------------------------------------------------------

--
-- Table structure for table `kasir`
--

CREATE TABLE `kasir` (
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `isFirstTime` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `tanggalLahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `isFirstTime` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `banyakGula` varchar(15) NOT NULL,
  `banyakEs` varchar(15) NOT NULL,
  `ukuran` varchar(15) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `fkTeh` int(11) NOT NULL,
  `fkKode` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `teh`
--

CREATE TABLE `teh` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `hargaRegular` decimal(7,2) NOT NULL,
  `hargaLarge` decimal(7,2) NOT NULL,
  `gambar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teh`
--

INSERT INTO `teh` (`id`, `nama`, `hargaRegular`, `hargaLarge`, `gambar`) VALUES
(1, 'Original', '17000.00', '17000.00', 'ori.png');

-- --------------------------------------------------------

--
-- Table structure for table `topping`
--

CREATE TABLE `topping` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `harga` decimal(7,2) NOT NULL,
  `gambar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topping`
--

INSERT INTO `topping` (`id`, `nama`, `harga`, `gambar`) VALUES
(1, 'Pearl', '3000.00', 'pearl.png');

-- --------------------------------------------------------

--
-- Table structure for table `topping_pesanan`
--

CREATE TABLE `topping_pesanan` (
  `fkTopping` int(11) NOT NULL,
  `fkPesanan` int(11) NOT NULL,
  `jumlahTopping` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `kode` char(12) NOT NULL,
  `waktu` datetime NOT NULL,
  `totalHarga` decimal(15,2) NOT NULL,
  `namaPemesan` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `kasir`
--
ALTER TABLE `kasir`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkTeh` (`fkTeh`),
  ADD KEY `fkKode` (`fkKode`);

--
-- Indexes for table `teh`
--
ALTER TABLE `teh`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topping`
--
ALTER TABLE `topping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topping_pesanan`
--
ALTER TABLE `topping_pesanan`
  ADD KEY `fkTopping` (`fkTopping`),
  ADD KEY `fkPesanan` (`fkPesanan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teh`
--
ALTER TABLE `teh`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `topping`
--
ALTER TABLE `topping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`fkTeh`) REFERENCES `teh` (`id`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`fkKode`) REFERENCES `transaksi` (`kode`);

--
-- Constraints for table `topping_pesanan`
--
ALTER TABLE `topping_pesanan`
  ADD CONSTRAINT `topping_pesanan_ibfk_1` FOREIGN KEY (`fkTopping`) REFERENCES `topping` (`id`),
  ADD CONSTRAINT `topping_pesanan_ibfk_2` FOREIGN KEY (`fkPesanan`) REFERENCES `pesanan` (`id`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`email`) REFERENCES `kasir` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
