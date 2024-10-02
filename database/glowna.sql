-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2024 at 10:48 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glowna`
--

-- --------------------------------------------------------

--
-- Table structure for table `auto`
--

CREATE TABLE `auto` (
  `id_auto` int(11) NOT NULL,
  `rejestracja` varchar(10) NOT NULL,
  `model` varchar(32) NOT NULL,
  `marka` varchar(32) NOT NULL,
  `klient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cena`
--

CREATE TABLE `cena` (
  `id_cena` int(11) NOT NULL,
  `naprawa` int(11) NOT NULL,
  `opis` varchar(1024) NOT NULL,
  `cena` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `klient`
--

CREATE TABLE `klient` (
  `id_klient` int(11) NOT NULL,
  `imie` varchar(32) NOT NULL,
  `nazwisko` varchar(32) NOT NULL,
  `tel` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `naprawa`
--

CREATE TABLE `naprawa` (
  `id_naprawa` int(11) NOT NULL,
  `auto` int(11) NOT NULL,
  `zalecenia` mediumtext NOT NULL,
  `data` date NOT NULL DEFAULT current_timestamp(),
  `przebieg` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id_auto`),
  ADD KEY `klient` (`klient`);

--
-- Indexes for table `cena`
--
ALTER TABLE `cena`
  ADD PRIMARY KEY (`id_cena`);

--
-- Indexes for table `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`id_klient`);

--
-- Indexes for table `naprawa`
--
ALTER TABLE `naprawa`
  ADD PRIMARY KEY (`id_naprawa`),
  ADD KEY `auto` (`auto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto`
--
ALTER TABLE `auto`
  MODIFY `id_auto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cena`
--
ALTER TABLE `cena`
  MODIFY `id_cena` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klient`
--
ALTER TABLE `klient`
  MODIFY `id_klient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `naprawa`
--
ALTER TABLE `naprawa`
  MODIFY `id_naprawa` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `auto_ibfk_1` FOREIGN KEY (`klient`) REFERENCES `klient` (`id_klient`);

--
-- Constraints for table `naprawa`
--
ALTER TABLE `naprawa`
  ADD CONSTRAINT `naprawa_ibfk_1` FOREIGN KEY (`auto`) REFERENCES `auto` (`id_auto`);

--
-- Constraints for table `cena`
--
ALTER TABLE `cena`
  ADD CONSTRAINT `cena_ibfk_1` FOREIGN KEY (`naprawa`) REFERENCES `naprawa` (`id_naprawa`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
