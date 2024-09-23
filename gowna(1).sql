-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Wrz 2024, 14:30
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
  `model` varchar(30) NOT NULL,
  `marka` varchar(30) NOT NULL,
  `id_klient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `auto`
--

INSERT INTO `auto` (`id_auto`, `rejstracja`, `model`, `marka`, `id_klient`) VALUES
(1, '123', '0', '0', 1),
(2, '123', 'asdgsdgsd', 'safwdsgsd', 2),
(3, '123', 'asdgsdgsd', 'safwdsgsd', 3),
(4, '123', 'asdgsdgsd', 'safwdsgsd', 4),
(5, '', '', '', 5);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cena`
--

CREATE TABLE `cena` (
  `id_cena` int(11) NOT NULL,
  `cena` int(11) NOT NULL,
  `naprawa` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `cena`
--

INSERT INTO `cena` (`id_cena`, `cena`, `naprawa`) VALUES
(1, 2412, 'gsdgdsg'),
(2, 2412, 'gsdgdsg'),
(3, 245333, 'gdsgsdgfsdgdf'),
(4, 2412, 'gsdgdsg'),
(5, 245333, 'gdsgsdgfsdgdf'),
(6, 2412, 'gsdgdsg'),
(7, 245333, 'gdsgsdgfsdgdf'),
(8, 0, '');

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

--
-- Zrzut danych tabeli `klient`
--

INSERT INTO `klient` (`id_klient`, `imie`, `nazwisko`, `tel`) VALUES
(1, 'dgsgefdgsd', 'gsdgsdgdsg', 231451534),
(2, 'dgsgefdgsd', 'gsdgsdgdsg', 231451534),
(3, 'dgsgefdgsd', 'gsdgsdgdsg', 231451534),
(4, 'dgsgefdgsd', 'gsdgsdgdsg', 231451534),
(5, '', '', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `naprawa`
--

CREATE TABLE `naprawa` (
  `id_naprawa` int(11) NOT NULL,
  `id_auto` int(11) NOT NULL,
  `zalecenia` text NOT NULL,
  `data` date NOT NULL,
  `przebieg` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Zrzut danych tabeli `naprawa`
--

INSERT INTO `naprawa` (`id_naprawa`, `id_auto`, `zalecenia`, `data`, `przebieg`) VALUES
(1, 1, 'ascvaxcsahcvbjhkb khjb kjhbd kjsabkfkasj bfkjsab jkf', '0011-11-11', ''),
(2, 2, 'ascvaxcsahcvbjhkb khjb kjhbd kjsabkfkasj bfkjsab jkf', '0011-11-11', ''),
(3, 3, 'ascvaxcsahcvbjhkb khjb kjhbd kjsabkfkasj bfkjsab jkf', '0011-11-11', ''),
(4, 4, 'ascvaxcsahcvbjhkb khjb kjhbd kjsabkfkasj bfkjsab jkf', '0011-11-11', '1111111111'),
(5, 5, 'jkdsbfujdkahflkas hklsahf ljkashlk hwaslk hflkah lkjash kljashf lkashf lkashlkf hsalk fhskla hfkosa jlkasnh flasjkhf lkasffj slak hf lkash flkasj fglkafkasfaskjf liashf oliashn laskh fnlask fnlask fnlask fsilakhlks ahfljkadhfoklasjhfas lkdasfhoasjhfoiashf oish oiuh iohoihoijkl ', '0000-00-00', '');

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
-- Zrzut danych tabeli `naprawa_cena`
--

INSERT INTO `naprawa_cena` (`id_naprawa_cena`, `id_naprawa`, `id_cena`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 3, 4),
(5, 3, 5),
(6, 4, 6),
(7, 4, 7),
(8, 5, 8);

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
  MODIFY `id_auto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `cena`
--
ALTER TABLE `cena`
  MODIFY `id_cena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `klient`
--
ALTER TABLE `klient`
  MODIFY `id_klient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `naprawa`
--
ALTER TABLE `naprawa`
  MODIFY `id_naprawa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `naprawa_cena`
--
ALTER TABLE `naprawa_cena`
  MODIFY `id_naprawa_cena` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
