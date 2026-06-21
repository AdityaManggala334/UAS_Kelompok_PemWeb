-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2026 at 08:20 AM
-- Server version: 10.4.32-MariaDB-log
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_tani`
--

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `durasi` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `metode_bayar` varchar(50) NOT NULL,
  `tanggal` datetime DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `username`, `nama_alat`, `durasi`, `total_bayar`, `metode_bayar`, `tanggal`, `status`) VALUES
(1, 'fidaa', 'Fertilizer Spreader', 1, 650000, 'BCA', '2026-04-26 20:50:04', 'pending'),
(2, 'fidaa', 'Fertilizer Spreader', 5, 3250000, 'GOPAY', '2026-04-26 21:05:25', 'pending'),
(3, 'fidaa', 'Sensor Pertanian', 1, 850000, 'DANA', '2026-04-26 21:23:00', 'pending'),
(7, 'fidaa', 'Traktor', 9, 4050000, 'BCA', '2026-04-26 22:10:44', 'pending'),
(8, 'fidaa', 'Traktor', 1, 450000, 'DANA', '2026-04-26 22:22:27', 'pending'),
(9, 'fidaa', 'Rotavator', 1, 500, 'DANA', '2026-04-26 22:25:54', 'lunas'),
(10, 'fidaa', 'Fertilizer Spreader', 2, 900000, 'GOPAY', '2026-04-26 22:51:01', 'pending'),
(11, 'fidaa', 'Seeder', 5, 2250000, 'BCA', '2026-04-26 22:53:45', 'pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
