-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 18 Wrz 2024, 09:18
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `gowna`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `auto`
--

CREATE TABLE `auto` (
  `id_auto` int(11) NOT NULL,
  `rejstracja` varchar(10) NOT NULL,
  `model` int(20) NOT NULL,
  `marka` int(20) NOT NULL,
  `id_klient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cena`
--

CREATE TABLE `cena` (
  `id_cena` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `naprawa` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `id_klient` int(11) NOT NULL,
  `imie` varchar(20) DEFAULT NULL,
  `nazwisko` varchar(20) DEFAULT NULL,
  `tel` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `naprawa`
--

CREATE TABLE `naprawa` (
  `id_naprawa` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `zalecenia` text NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `naprawa_cena`
--

CREATE TABLE `naprawa_cena` (
  `id_naprawa_cena` int(11) NOT NULL,
  `id_naprawa` int(11) NOT NULL,
  `id_cena` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id_auto`),
  ADD KEY `id_klient` (`id_klient`);

--
-- Indeksy dla tabeli `cena`
--
ALTER TABLE `cena`
  ADD PRIMARY KEY (`id_cena`);

--
-- Indeksy dla tabeli `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`id_klient`);

--
-- Indeksy dla tabeli `naprawa`
--
ALTER TABLE `naprawa`
  ADD PRIMARY KEY (`id_naprawa`),
  ADD KEY `id_auto` (`id_auto`);

--
-- Indeksy dla tabeli `naprawa_cena`
--
ALTER TABLE `naprawa_cena`
  ADD PRIMARY KEY (`id_naprawa_cena`),
  ADD KEY `id_naprawa` (`id_naprawa`),
  ADD KEY `id_cena` (`id_cena`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `auto`
--
ALTER TABLE `auto`
  MODIFY `id_auto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `cena`
--
ALTER TABLE `cena`
  MODIFY `id_cena` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `klient`
--
ALTER TABLE `klient`
  MODIFY `id_klient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `naprawa`
--
ALTER TABLE `naprawa`
  MODIFY `id_naprawa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `naprawa_cena`
--
ALTER TABLE `naprawa_cena`
  MODIFY `id_naprawa_cena` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `auto_ibfk_1` FOREIGN KEY (`id_klient`) REFERENCES `klient` (`id_klient`);

--
-- Ograniczenia dla tabeli `naprawa`
--
ALTER TABLE `naprawa`
  ADD CONSTRAINT `naprawa_ibfk_1` FOREIGN KEY (`id_auto`) REFERENCES `auto` (`id_auto`);

--
-- Ograniczenia dla tabeli `naprawa_cena`
--
ALTER TABLE `naprawa_cena`
  ADD CONSTRAINT `naprawa_cena_ibfk_1` FOREIGN KEY (`id_naprawa`) REFERENCES `naprawa` (`id_naprawa`),
  ADD CONSTRAINT `naprawa_cena_ibfk_2` FOREIGN KEY (`id_cena`) REFERENCES `cena` (`id_cena`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
