-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2024 at 07:03 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sena_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Elektronik'),
(2, 'Fashion'),
(9, 'Aksesoris'),
(10, 'Skincare'),
(13, 'Otomotif'),
(14, 'Perlengkapan Rumah'),
(17, 'Makanan dan Minuman'),
(18, 'Hobi dan Hiburan');

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `id_keranjang` int NOT NULL,
  `foto_produk` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `nama_produk` varchar(30) NOT NULL,
  `harga_produk` varchar(30) NOT NULL,
  `jumlah_produk` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_produk` varchar(11) DEFAULT NULL,
  `id_user` varchar(11) NOT NULL,
  `id_toko` varchar(14) NOT NULL,
  `id_produk` int DEFAULT NULL,
  `id_pengiriman` int DEFAULT NULL,
  `id_pembayaran` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`id_keranjang`, `foto_produk`, `nama_produk`, `harga_produk`, `jumlah_produk`, `total_produk`, `id_user`, `id_toko`, `id_produk`, `id_pengiriman`, `id_pembayaran`) VALUES
(110, '65e3614a85cc9.jpg', 'Kaktus Goyang', '70000', '1', '70000', '11', '88', NULL, NULL, 0),
(121, '65e213de59dfb.jpg', 'Estee&#039; Louder Kit', '900000', '1', '900000', '11', '84', 113, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int NOT NULL,
  `nama_pembayaran` varchar(30) NOT NULL,
  `biaya_pembayaran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `nama_pembayaran`, `biaya_pembayaran`) VALUES
(1, 'COD (Bayar di Tempat)', '1000'),
(2, 'COD (Cek Dulu Baru Bayar)', '500'),
(5, 'Tranfer Bank', '2000'),
(6, 'Alfamart', '500'),
(9, 'Indomart', '500'),
(10, 'Kartu Kredit / Debit', '1000');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int NOT NULL,
  `nama_pengiriman` varchar(30) NOT NULL,
  `harga_pengiriman` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `nama_pengiriman`, `harga_pengiriman`) VALUES
(1, 'J&amp;T Express', 11000),
(2, 'Ninja Exspress', 11000),
(5, 'Hemat', 9000);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int NOT NULL,
  `invoice` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `total_harga` varchar(11) NOT NULL,
  `tgl_pending` date NOT NULL,
  `tgl_dikemas` date DEFAULT NULL,
  `tgl_dikirim` date DEFAULT NULL,
  `tgl_diterima` date DEFAULT NULL,
  `status` varchar(11) NOT NULL,
  `pesan` varchar(30) NOT NULL,
  `id_pengiriman` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_user` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_produk` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_toko` int DEFAULT NULL,
  `id_pembayaran` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `invoice`, `total_harga`, `tgl_pending`, `tgl_dikemas`, `tgl_dikirim`, `tgl_diterima`, `status`, `pesan`, `id_pengiriman`, `id_user`, `id_produk`, `id_toko`, `id_pembayaran`) VALUES
(12, 'SEN20240302173759', '432000', '2024-03-07', '2024-03-15', '2024-03-16', NULL, 'Diterima', 'Jangan lama', '1', '11', '133', 88, ''),
(20, 'SEN20240303135614', '962500', '2024-03-03', '2024-03-15', '2024-03-21', NULL, 'Diterima', '', '1', '11', '131', 88, '1'),
(21, 'SEN20240303140050', '222500', '2024-03-03', NULL, NULL, NULL, 'pending', '', '1', '18', '133', 88, '1'),
(22, 'SEN20240303140249', '1512500', '2024-03-03', '2024-03-21', '2024-03-22', NULL, 'Diterima', '', '1', '11', '127', 87, '1');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int NOT NULL,
  `foto_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nama_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `berat_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stok_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_toko` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_kategori` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `id_user` int NOT NULL,
  `jumlah_produk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_pengiriman` int NOT NULL,
  `id_pembayaran` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `foto_produk`, `nama_produk`, `harga_produk`, `berat_produk`, `stok_produk`, `id_toko`, `id_kategori`, `id_user`, `jumlah_produk`, `id_pengiriman`, `id_pembayaran`) VALUES
(112, '65e2137d116c5.jpg', 'Coco Foundation Bouge', '2500000', '34', '45', '84', '10', 11, NULL, 0, 0),
(113, '65e213de59dfb.jpg', 'Estee&#039; Louder Kit', '900000', '67 ', '23', '84', '10', 11, NULL, 0, 0),
(121, '65e35c678e92f.jpg', 'Keyboard Pikcles', '200000', '78', '23', '85', '1', 11, NULL, 0, 0),
(122, '65e35c9b2d84b.jpg', 'Pack Power Smart', '350000', '78', '87', '85', '1', 11, NULL, 0, 0),
(123, '65e35d6b61477.jpg', 'Strawberry Shortcake', '200000', '34', '45', '86', '17', 11, NULL, 0, 0),
(124, '65e35d91bb04d.jpg', 'Rice Bowl Blow', '98000', '45', '23', '86', '17', 11, NULL, 0, 0),
(125, '65e35e56ced99.jpg', 'Pick Man&#039;s Gentle', '550000', '67 ', '87', '86', '2', 11, NULL, 0, 0),
(126, '65e35ed74aa9c.jpg', 'Vogue Gentle Fog', '1270000', '45', '45', '87', '2', 11, NULL, 0, 0),
(127, '65e35f4211a83.jpg', 'Wowen Joe Dogh', '300000', '45', '36', '87', '2', 11, NULL, 0, 0),
(128, '65e35fd91701f.jpg', 'Fini Arts Gough', '950000', '935', '45', '88', '14', 11, NULL, 0, 0),
(129, '65e36030aa7e1.jpg', 'Gentle Monster Hough', '90000', '34', '23', '88', '9', 11, NULL, 0, 0),
(131, '65e360f1c3645.jpg', 'Scooter Kids Soe', '950000', '78', '44', '88', '13', 11, NULL, 0, 0),
(133, '65e3614a85cc9.jpg', 'Kaktus Goyang', '70000', '67 ', '55', '88', '18', 11, NULL, 0, 0),
(134, '65e361e5c6cf3.jpg', 'Boneka Pinguin ', '90000', '45', '23', '88', '18', 11, NULL, 0, 0),
(135, '65e362333892c.jpg', 'Fluffy Zuzuzuzuzu', '98000', '45', '23', '88', '18', 11, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int NOT NULL,
  `nama_toko` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat_toko` varchar(30) NOT NULL,
  `hp_toko` varchar(12) NOT NULL,
  `foto_toko` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_user` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `hp_toko`, `foto_toko`, `id_user`) VALUES
(84, 'Skincare', 'Jl. Moh. Hatta', '086755644378', '', '11'),
(85, 'Elektronika', 'Jl. Moh. Yamin', '09087875659', '', '11'),
(86, 'Mie Joe', 'Jl. Soedirman', '08675564436', NULL, '11'),
(87, 'Fashiona', 'Jl. Soedirman', '086755644376', NULL, '11'),
(88, 'Craft', 'Jl. Dr. Soepoemo ', '09087875650', NULL, '11'),
(89, 'jijima', 'Jl. Moh. Hatta', '086755644376', NULL, '12'),
(95, 'Bakso Beranak M', 'Jl. Moh. Yamin', '086755644376', NULL, '13'),
(97, 'Bakso Beranak MJK', 'Jl. Dr. Soepoemo ', '086755644376', NULL, '13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `alamat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `foto_profil` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama`, `email`, `password`, `no_hp`, `alamat`, `user_type`, `foto_profil`) VALUES
(11, 'user', 'user@gmail.com', 'ee11cbb19052e40b07aac0ca060c23ee', '087654543234', 'Jl. Mawar Rejo', 'bisnis', NULL),
(13, 'k', 'k@gmail.com', '8ce4b16b22b58894aa86c421e8759df3', 'k', 'k', 'admin', NULL),
(18, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'mjk', 'admin', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `keranjang`
--
ALTER TABLE `keranjang`
  MODIFY `id_keranjang` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
