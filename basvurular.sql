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
-- Table structure for table `basvurular`
--

CREATE TABLE `basvurular` (
  `basvuru_id` int NOT NULL,
  `ogrenci_id` int DEFAULT NULL,
  `ilan_id` int DEFAULT NULL,
  `basvuru_tarihi` date DEFAULT NULL,
  `onay_durumu` enum('Beklemede','Onaylandı','Reddedildi') COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `basvurular`
--

INSERT INTO `basvurular` (`basvuru_id`, `ogrenci_id`, `ilan_id`, `basvuru_tarihi`, `onay_durumu`) VALUES
(1, 3, 2, '2025-05-21', 'Onaylandı'),
(2, 5, 2, '2025-05-21', 'Onaylandı'),
(4, 3, 3, '2025-05-22', 'Onaylandı'),
(5, 6, 2, '2025-05-22', 'Onaylandı'),
(6, 6, 3, '2025-05-22', 'Onaylandı'),
(7, 8, 2, '2025-05-22', 'Onaylandı');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `basvurular`
--
ALTER TABLE `basvurular`
  ADD PRIMARY KEY (`basvuru_id`),
  ADD KEY `ilan_id` (`ilan_id`),
  ADD KEY `basvurular_ibfk_1` (`ogrenci_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `basvurular`
--
ALTER TABLE `basvurular`
  MODIFY `basvuru_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `basvurular`
--
ALTER TABLE `basvurular`
  ADD CONSTRAINT `basvurular_ibfk_1` FOREIGN KEY (`ogrenci_id`) REFERENCES `ogrenciler` (`ogrenci_id`),
  ADD CONSTRAINT `basvurular_ibfk_2` FOREIGN KEY (`ilan_id`) REFERENCES `ilanlar` (`ilan_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
