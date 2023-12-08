-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 08, 2023 at 06:38 AM
-- Server version: 8.0.30
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tokopekita`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `idcart` int NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `userid` int NOT NULL,
  `tglorder` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'Cart'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`idcart`, `orderid`, `userid`, `tglorder`, `status`) VALUES
(83, '17TVhLzPtjINY', 1, '2023-12-06 09:59:54', 'Payment'),
(84, '17dFygUORHAY2', 2, '2023-12-08 06:37:30', 'Payment'),
(85, '17kaW8fTE6srg', 2, '2023-12-08 06:37:43', 'Menunggu Verifikasi Pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `detailorder`
--

CREATE TABLE `detailorder` (
  `detailid` int NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `idproduk` int NOT NULL,
  `qty` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `detailorder`
--

INSERT INTO `detailorder` (`detailid`, `orderid`, `idproduk`, `qty`) VALUES
(102, '17TVhLzPtjINY', 21, 1),
(103, '17dFygUORHAY2', 21, 1),
(104, '17kaW8fTE6srg', 21, 1);

--
-- Triggers `detailorder`
--
DELIMITER $$
CREATE TRIGGER `After-Delete` AFTER DELETE ON `detailorder` FOR EACH ROW UPDATE produk SET produk.stok = produk.stok + old.qty WHERE produk.idproduk = old.idproduk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `After-Insert` AFTER INSERT ON `detailorder` FOR EACH ROW UPDATE produk SET produk.stok = produk.stok - NEW.qty WHERE produk.idproduk = NEW.idproduk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AfterUpdateKurang` AFTER UPDATE ON `detailorder` FOR EACH ROW UPDATE produk SET produk.stok = produk.stok + old.qty WHERE produk.idproduk = old.idproduk
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `AfterUpdateTambah` AFTER UPDATE ON `detailorder` FOR EACH ROW UPDATE produk SET produk.stok = produk.stok - NEW.qty WHERE produk.idproduk = NEW.idproduk
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `idkategori` int NOT NULL,
  `namakategori` varchar(20) NOT NULL,
  `tgldibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`idkategori`, `namakategori`, `tgldibuat`) VALUES
(9, 'Seafood', '2023-12-04 18:10:43'),
(10, 'Ayam', '2023-12-04 18:10:51'),
(11, 'Sop', '2023-12-04 18:10:58');

-- --------------------------------------------------------

--
-- Table structure for table `komplain`
--

CREATE TABLE `komplain` (
  `idkomplain` int NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `idproduk` int NOT NULL,
  `userid` int NOT NULL,
  `komplain` varchar(500) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `komplain`
--

INSERT INTO `komplain` (`idkomplain`, `orderid`, `idproduk`, `userid`, `komplain`, `tanggal`) VALUES
(12, '16VrPDLG6HTmY', 9, 2, 'Ban nya kok 4', '2023-08-11');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `idkonfirmasi` int NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `userid` int NOT NULL,
  `namarekening` varchar(25) NOT NULL,
  `norek` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tglbayar` date NOT NULL,
  `tglsubmit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `konfirmasi`
--

INSERT INTO `konfirmasi` (`idkonfirmasi`, `orderid`, `userid`, `namarekening`, `norek`, `tglbayar`, `tglsubmit`) VALUES
(18, '17p0s3Mvby6fU', 1, 'Joko Sutonso', 'Bank BCA', '2023-12-06', '2023-12-06 07:20:32'),
(19, '17p0s3Mvby6fU', 1, 'Joko Sutonso', 'Bank BCA-', '2023-12-06', '2023-12-06 07:22:21'),
(23, '17kaW8fTE6srg', 2, 'Handoko', 'Bank Mandiri', '2023-12-08', '2023-12-08 06:38:03');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `userid` int NOT NULL,
  `namalengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `notelp` varchar(15) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tgljoin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(8) NOT NULL DEFAULT 'Member',
  `lastlogin` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`userid`, `namalengkap`, `email`, `password`, `notelp`, `alamat`, `tgljoin`, `role`, `lastlogin`) VALUES
(1, 'Admin', 'admin', '$2y$10$GJVGd4ji3QE8ikTBzNyA0uLQhiGd6MirZeSJV1O6nUpjSVp1eaKzS', '01234567890', 'Indonesia', '2020-03-16 11:31:17', 'Admin', NULL),
(2, 'Guest', 'guest', '$2y$10$xXEMgj5pMT9EE0QAx3QW8uEn155Je.FHH5SuIATxVheOt0Z4rhK6K', '01234567890', 'Indonesia', '2020-03-16 11:30:40', 'Member', NULL),
(3, 'arif', 'arif@gmail.com', '$2y$10$SBQDVrVtN2m0Bc63ZNisrOdORoO42mt.YdPtinqyog8qSSUkWt0EO', '089741231', 'cilegon', '2023-07-08 22:07:22', 'Member', NULL),
(4, 'Pimpinan', 'pimpinan', '$2y$10$GJVGd4ji3QE8ikTBzNyA0uLQhiGd6MirZeSJV1O6nUpjSVp1eaKzS', '087775322231', 'Bantar Agung', '2023-07-28 06:32:02', 'Pimpinan', NULL),
(5, 'user', 'user@gmail.com', '$2y$10$JyWXKaCsL9yy6TS6dEAL3eS5lYvvat6VrP//JXCDEk1GPxrl9TlZ6', '0983748', 'Serang', '2023-12-05 02:50:34', 'Member', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `no` int NOT NULL,
  `metode` varchar(25) NOT NULL,
  `norek` varchar(25) NOT NULL,
  `logo` text,
  `an` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`no`, `metode`, `norek`, `logo`, `an`) VALUES
(1, 'Bank BCA', '13131231231312', 'images/bca.jpg', 'Ohan Motor'),
(2, 'Bank Mandiri', '943248844843312', 'images/mandiri.jpg', 'Ohan Motor'),
(4, 'Bank BRI', '123123123', 'images/bri.png', 'Ohan Motor');

-- --------------------------------------------------------

--
-- Table structure for table `pesankomplain`
--

CREATE TABLE `pesankomplain` (
  `idpesankomplain` int NOT NULL,
  `idkomplain` int NOT NULL,
  `userid` int NOT NULL,
  `pesan` varchar(500) NOT NULL,
  `detail` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesankomplain`
--

INSERT INTO `pesankomplain` (`idpesankomplain`, `idkomplain`, `userid`, `pesan`, `detail`) VALUES
(44, 12, 2, 'kok ban nya 4?', '2023-08-10 23:58:40'),
(45, 12, 1, 'ya iyalah bang', '2023-08-10 23:59:05'),
(46, 12, 2, 'bintang 1', '2023-08-10 23:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `idproduk` int NOT NULL,
  `idkategori` int NOT NULL,
  `namaproduk` varchar(30) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `deskripsi` varchar(200) NOT NULL,
  `stok` varchar(10) DEFAULT NULL,
  `rate` int NOT NULL,
  `hargabefore` int NOT NULL,
  `hargaafter` int NOT NULL,
  `tgldibuat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`idproduk`, `idkategori`, `namaproduk`, `gambar`, `deskripsi`, `stok`, `rate`, `hargabefore`, `hargaafter`, `tgldibuat`) VALUES
(21, 9, 'Seafood 01', 'produk/17xGoe7C2X33o.png', 'Seafood 01', '6', 3, 150000, 145000, '2023-12-06 03:41:03');

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `idrating` int NOT NULL,
  `orderid` varchar(100) NOT NULL,
  `idproduk` int NOT NULL,
  `userid` int NOT NULL,
  `rating` int NOT NULL,
  `ulasan` varchar(50) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`idrating`, `orderid`, `idproduk`, `userid`, `rating`, `ulasan`, `tanggal`) VALUES
(19, '16VrPDLG6HTmY', 9, 2, 1, 'Ban nya 4', '2023-08-11'),
(20, '17I6JSzW081U6', 21, 1, 5, 'test', '2023-12-06');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idcart`),
  ADD UNIQUE KEY `orderid` (`orderid`),
  ADD KEY `orderid_2` (`orderid`);

--
-- Indexes for table `detailorder`
--
ALTER TABLE `detailorder`
  ADD PRIMARY KEY (`detailid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `idproduk` (`idproduk`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`idkategori`);

--
-- Indexes for table `komplain`
--
ALTER TABLE `komplain`
  ADD PRIMARY KEY (`idkomplain`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`idkonfirmasi`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `pesankomplain`
--
ALTER TABLE `pesankomplain`
  ADD PRIMARY KEY (`idpesankomplain`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`idproduk`),
  ADD KEY `idkategori` (`idkategori`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`idrating`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `idcart` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `detailorder`
--
ALTER TABLE `detailorder`
  MODIFY `detailid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `idkategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `komplain`
--
ALTER TABLE `komplain`
  MODIFY `idkomplain` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `idkonfirmasi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `userid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `no` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pesankomplain`
--
ALTER TABLE `pesankomplain`
  MODIFY `idpesankomplain` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `idproduk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `idrating` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailorder`
--
ALTER TABLE `detailorder`
  ADD CONSTRAINT `idproduk` FOREIGN KEY (`idproduk`) REFERENCES `produk` (`idproduk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderid` FOREIGN KEY (`orderid`) REFERENCES `cart` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD CONSTRAINT `userid` FOREIGN KEY (`userid`) REFERENCES `login` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `idkategori` FOREIGN KEY (`idkategori`) REFERENCES `kategori` (`idkategori`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
