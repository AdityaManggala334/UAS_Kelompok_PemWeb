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
-- Table structure for table `alat`
--

CREATE TABLE `alat` (
  `id` int(11) NOT NULL,
  `nama_alat` varchar(100) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alat`
--

INSERT INTO `alat` (`id`, `nama_alat`, `harga`, `stok`, `deskripsi`, `gambar`) VALUES
(19, 'Rotavator', 250000, 3, 'Rotavator mampu memecah bongkahan tanah yang masih kasar, mencampur sisa-sisa tanaman atau bahan organik ke dalam tanah, serta meratakan permukaan lahan secara merata.', 'Rotavator_1_63037605e0.jpg'),
(20, 'Fertilizer Spreader', 450000, 5, 'Fertilizer Spreader\r\nAlat ini berguna untuk menyebarkan pupuk secara merata di lahan pertanian dan perkebunan.', 'Fertilizer-Spreader.jpg'),
(21, 'Seeder', 450000, 4, 'Seeder mempunyai berbagai ukuran dan spesifikasi. Alat penanam ini akan ditarik dengan traktor untuk menanam benih di lahan pertanian.', 'seeder.jpg'),
(23, 'Cultivator', 300000, 4, 'Cultivator merupakan salah satu peralatan pertanian modern yang digunakan untuk mengolah lahan di tanah yang tidak tergenang air.', 'Cultivator.jpg'),
(24, 'Traktor', 450000, 3, 'Traktor juga bisa diartikan alat pertanian yang menjadi punggung pergiatan pertanian. Dengan tenaga yang besar, traktor memudahkan petani dalam mengolah lahan.', '896.jpg'),
(25, 'Combine Harvester', 450000, 4, 'Fungsi alat ini yaitu untuk memudahkan pemanenan tanaman biji-bijian seperti jagung, padi, dan gandum.', 'Mesin-pertanian-modern.jpg'),
(26, 'Sensor Pertanian', 350000, 3, 'Sensor pertanian membantu petani dalam mengoptimalkan penggunaan air dan pupuk, menjaga keseimbangan ekosistem tanah, menjaga kesehatan tanaman, serta mengurangi perubahan mendadak dalam kondisi tanah.', '6062.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alat`
--
ALTER TABLE `alat`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alat`
--
ALTER TABLE `alat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
