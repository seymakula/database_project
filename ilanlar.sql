-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 26, 2025 at 10:12 AM
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
-- Table structure for table `ilanlar`
--

CREATE TABLE `ilanlar` (
  `ilan_id` int NOT NULL,
  `kurum_id` int DEFAULT NULL,
  `baslik` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `aciklama` text COLLATE utf8mb4_general_ci,
  `sektor` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `son_basvuru_tarihi` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ilanlar`
--

INSERT INTO `ilanlar` (`ilan_id`, `kurum_id`, `baslik`, `aciklama`, `sektor`, `son_basvuru_tarihi`) VALUES
(2, 1, 'yaz stajı', '3 ve 4. sınıflar içindir', 'IT', '2025-10-10'),
(3, 1, 'güz stajı', '2. sınıflar için', 'hizmet', '2025-09-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ilanlar`
--
ALTER TABLE `ilanlar`
  ADD PRIMARY KEY (`ilan_id`),
  ADD KEY `kurum_id` (`kurum_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ilanlar`
--
ALTER TABLE `ilanlar`
  MODIFY `ilan_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ilanlar`
--
ALTER TABLE `ilanlar`
  ADD CONSTRAINT `ilanlar_ibfk_1` FOREIGN KEY (`kurum_id`) REFERENCES `kurumlar` (`kurum_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
