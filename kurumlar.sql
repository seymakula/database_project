-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 26, 2025 at 10:13 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `staj_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `kurumlar`
--

CREATE TABLE `kurumlar` (
  `kurum_id` int NOT NULL,
  `kurum_adi` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `iletisim` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sifre` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kurumlar`
--

INSERT INTO `kurumlar` (`kurum_id`, `kurum_adi`, `email`, `iletisim`, `sifre`) VALUES
(1, 'aselsan', 'aselsan@info.tr', 'aselsan@info.tr', 'aselsan123'),
(2, 'havelsan', 'havelsan@info.tr', 'havelsan@info.tr', 'havlsesan123'),
(3, 'roketsan', 'roketsan@info.tr', 'roketsan@info.tr', 'roketsan123'),
(4, 'roketsan', 'roketsan@info.tr', 'roketsan@info.tr', 'roketsan123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kurumlar`
--
ALTER TABLE `kurumlar`
  ADD PRIMARY KEY (`kurum_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kurumlar`
--
ALTER TABLE `kurumlar`
  MODIFY `kurum_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
