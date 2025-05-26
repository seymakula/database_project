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
-- Table structure for table `ogrenciler`
--

CREATE TABLE `ogrenciler` (
  `ogrenci_id` int NOT NULL,
  `ad_soyad` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `bolum` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `okul` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sifre` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ogrenciler`
--

INSERT INTO `ogrenciler` (`ogrenci_id`, `ad_soyad`, `email`, `bolum`, `okul`, `sifre`) VALUES
(3, 'efe can seymen', 'efecan@gmail.com', 'pc müh', 'ankara üni', 'efecan seyman'),
(5, 'rabia çetin', 'rabiacetin@gmail.com', 'diş hekimliği', 'ankara üni', 'cetin123'),
(6, 'şeyma kula', 'seyma@gmail.com', 'pc müh', 'ankara üni', 'seyma123'),
(7, 'zeliha kıyak', 'zeliha@gmail.com', 'pc müh', 'ankara üni', 'zeliha123'),
(8, 'Sude Üstal', 'sude@gmail.com', 'Odyoloji', 'SBÜ', 'sude123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ogrenciler`
--
ALTER TABLE `ogrenciler`
  ADD PRIMARY KEY (`ogrenci_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ogrenciler`
--
ALTER TABLE `ogrenciler`
  MODIFY `ogrenci_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
