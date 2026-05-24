-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 24, 2026 at 01:51 PM
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
-- Database: `si-pepu`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int NOT NULL,
  `code_buku` varchar(255) NOT NULL,
  `nama_buku` varchar(255) NOT NULL,
  `id_kategori` int DEFAULT '4',
  `nama_penerbit` varchar(255) NOT NULL,
  `isbn` varchar(255) NOT NULL,
  `stock` int NOT NULL DEFAULT '10',
  `nama_penulis` varchar(255) NOT NULL,
  `tgl_rilis_buku` date NOT NULL,
  `tgl_masuk` date NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `code_buku`, `nama_buku`, `id_kategori`, `nama_penerbit`, `isbn`, `stock`, `nama_penulis`, `tgl_rilis_buku`, `tgl_masuk`, `deleted_at`) VALUES
(1, 'FS001', 'Dune Part 1', 2, 'Kakatua', '03123asd-231ad-ab', 8, 'Frank Herbert', '2026-05-18', '2026-05-20', NULL),
(2, 'FS002', 'Harry Potter and The Philosopher\'s Stone', 2, 'Gramedia', '0101A-2923N-111J', 11, 'J.K Rowling', '1997-06-27', '2026-05-21', NULL),
(9, 'NV001', 'Metamorphosis', 3, 'Kakatua', '0123KF-102JD-323LK', 8, 'Franz Kafka', '2026-05-29', '2026-05-23', NULL),
(12, 'NV005', 'no longer human', 3, 'Kakatuas', '0123KF-102JD-323JK', 9, 'osamu dazai', '2026-05-08', '2026-05-30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama` varchar(255) NOT NULL,
  `kd_kategori` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `kd_kategori`, `deskripsi`, `deleted_at`) VALUES
(1, 'Sci-fi', 'SF', 'Kategori Buku Scifi', '2026-05-23'),
(2, 'Fantasy', 'FS', 'Kategori Buku Fantasy\r\n', NULL),
(3, 'Novel', 'NV', 'Kategori Novels', NULL),
(4, 'Buku Original', 'BO', 'Kategori untuk buku yang kategorinya di delete', NULL),
(7, 'Sastra', 'ST', 'kategori sastra\r\n', NULL),
(8, 'Sejarah', 'SJ', 'sejarah', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id` int NOT NULL,
  `no_member` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `status` enum('aktif','nonaktif') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'aktif',
  `masa_aktif` date NOT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id`, `no_member`, `nama`, `email`, `no_telp`, `user_id`, `status`, `masa_aktif`, `deleted_at`) VALUES
(1, 'MB013', 'udi', 'udi@mail.com', '032131231', 13, 'aktif', '2027-05-23', NULL),
(2, 'MB014', 'jie', 'jie@mail.com', '31231231', 14, 'aktif', '2027-05-23', NULL),
(3, 'MB016', 'nie', 'nie@mail.com', '3921831', 16, 'aktif', '2027-05-23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pinjaman`
--

CREATE TABLE `pinjaman` (
  `id` int NOT NULL,
  `id_member` int NOT NULL,
  `id_buku` int NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tenggat_waktu` date NOT NULL,
  `status` enum('dikembalikan','peminjaman') NOT NULL,
  `total_denda` decimal(13,0) DEFAULT NULL,
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pinjaman`
--

INSERT INTO `pinjaman` (`id`, `id_member`, `id_buku`, `tanggal_pinjam`, `tenggat_waktu`, `status`, `total_denda`, `deleted_at`) VALUES
(1, 4, 2, '2026-05-24', '2026-05-30', 'peminjaman', '0', '2026-05-24'),
(2, 8, 1, '2026-05-24', '2026-05-30', 'peminjaman', '0', '2026-05-24'),
(3, 4, 1, '2026-05-24', '2026-05-30', 'peminjaman', '0', '2026-05-24'),
(4, 4, 1, '2026-05-24', '2026-05-30', 'dikembalikan', '0', NULL),
(5, 9, 9, '2026-05-24', '2026-05-30', 'dikembalikan', '0', NULL),
(6, 4, 2, '2026-05-24', '2026-05-30', 'dikembalikan', '0', NULL),
(7, 11, 12, '2026-05-17', '2026-05-24', 'dikembalikan', '0', NULL),
(8, 13, 12, '2026-05-17', '2026-05-24', 'dikembalikan', '0', NULL),
(9, 8, 2, '2026-05-24', '2026-05-18', 'dikembalikan', '30000', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('member','staff','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'member',
  `deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `deleted_at`) VALUES
(1, 'admin01', 'admin@mail.com', 'password', 'admin', '2026-05-22'),
(2, 'Ucups', 'ucup@mail.com', 'password', 'admin', NULL),
(3, 'Budi', 'budi@mail.com', '$2y$10$VwIok4Otn6jeKgy2.SkCIux/lMpYSG...NfFoEkaNUVp9RYo4j/BS', 'staff', NULL),
(4, 'Bara', 'bara@mail.com', '$2y$10$y4qiYf0OuJ20slM2lGTXWeXsVBkRU54WoKOMxz.6Wqhu74fWrw.au', 'member', NULL),
(5, 'Jiba', 'jiba@mail.com', '$2y$10$/vQlxMqNRY5XguKrmNlsvenHhOgI31EUh0WuvsXYYu1b8W/U4Ho3u', 'staff', NULL),
(6, 'fauzan', 'ojan@mail.com', '$2y$10$HqpGY.w6Y9hUj8.xVMbPR.T2uFgzZh9SBVGUDyYEXRUozwQxaJzTK', 'admin', NULL),
(7, 'udin', 'udin@mail.com', '$2y$10$xxeIOtNRTIbr./P7mCzfEendu/Tvt2Id7.uJU6rJzsPM/l1rpTbcy', 'staff', NULL),
(8, 'han', 'han@mail.com', '$2y$10$BMAjGqdcnq/rqJ6grlirf.GqUvmqrB4Oa5J1L4Ks8upUMwkGJLfIi', 'member', NULL),
(9, 'udinus', 'udinus@mail.com', '$2y$10$zAgU/6xdHha1TmD/6sQs8OksW8ZKdDDuYdxoZU7md.JSujIv75tpu', 'member', NULL),
(10, 'jina', 'jina@mail.com', '$2y$10$AJMmxDUnLgHTsB.8OYi7uur1jdbKzv0a43Ri/yG7o6UWxQjWBqc.a', 'member', NULL),
(11, 'niki', 'niki@mail.com', '$2y$10$.dPPlD/eHysEExOL//S7PeQDKdSSpOTmEvCfkb4h36SafNQn1anBG', 'member', NULL),
(12, 'uji', 'uji@mail.com', '$2y$10$B2NGMNyP47L1Z2Vo7PuiSumDNby7aV..PzrPalXD6Vj6scrIUopYi', 'member', NULL),
(13, 'udi', 'udi@mail.com', '$2y$10$tX.xVBaJWHdEBLeo4kpMougtRIMt/DvTc6kfNUOzq9CpONqDH3JaC', 'member', NULL),
(14, 'jie', 'jie@mail.com', '$2y$10$dQQQ8UI4wfQkAb1T80EUseH13BbGCZulDfBUYzJKbcIvhi0ADF1q2', 'member', NULL),
(15, 'kie', 'kie@mail.com', '$2y$10$GpmO9q7Zp0HDrkg1CtQVKOBhJ7.oG3kJZeWc/RKndUGRSpLX13un2', 'admin', NULL),
(16, 'nie', 'nie@mail.com', '$2y$10$EGNP8jAQeq4k90438YlDheoMCqMkHbzb7dNVGTHdOlQKwZQDt6d7y', 'member', NULL),
(17, 'ijo', 'ijo@mail.com', '$2y$10$EU2O7sfkTZispE.5NftPJ.2Z8pD6zU9v5NIZBwELZrNWoriHyU2Yi', 'member', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_buku` (`code_buku`),
  ADD UNIQUE KEY `isbn` (`isbn`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kd_kategori` (`kd_kategori`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_member` (`no_member`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `no_telp` (`no_telp`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pinjaman`
--
ALTER TABLE `pinjaman`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pinjaman`
--
ALTER TABLE `pinjaman`
  ADD CONSTRAINT `pinjaman_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pinjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
