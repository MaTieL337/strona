-- Zrzut danych tabeli `klient`
INSERT INTO `klient` (`id_klient`, `imie`, `nazwisko`, `tel`) VALUES
(1, 'dgsgefdgsd', 'gsdgsdgdsg', '231451534'),
(2, 'dgsgefdgsd', 'gsdgsdgdsg', '231451534'),
(3, 'dgsgefdgsd', 'gsdgsdgdsg', '231451534'),
(4, 'dgsgefdgsd', 'gsdgsdgdsg', '231451534'),
(5, '', '', '0');

-- Zrzut danych tabeli `auto`
INSERT INTO `auto` (`id_auto`, `rejestracja`, `model`, `marka`, `klient`) VALUES
(1, '123', '0', '0', 1),
(2, '123', 'asdgsdgsd', 'safwdsgsd', 2),
(3, '123', 'asdgsdgsd', 'safwdsgsd', 3),
(4, '123', 'asdgsdgsd', 'safwdsgsd', 4),
(5, '', '', '', 5);

-- Zrzut danych tabeli `naprawa`
INSERT INTO `naprawa` (`id_naprawa`, `auto`, `zalecenia`, `data`, `przebieg`) VALUES
(1, 1, 'ascvaxcsahcvbjhkb khjb kjhbd kjsabkfkasj bfkjsab jkf', '0011-11-11', ''),
(2, 2, 'ascvaxcsahcvbjhkb khjb kjhbd kjsabkfkasj bfkjsab jkf', '0011-11-11', ''),
(3, 3, 'ascvaxcsahcvbjhkb khjb kjhbd kjsabkfkasj bfkjsab jkf', '0011-11-11', ''),
(4, 4, 'ascvaxcsahcvbjhkb khjb kjhbd kjsabkfkasj bfkjsab jkf', '0011-11-11', '1111111111'),
(5, 5, 'jkdsbfujdkahflkas hklsahf ljkashlk hwaslk hflkah lkjash kljashf lkashf lkashlkf hsalk fhskla hfkosa jlkasnh flasjkhf lkasffj slak hf lkash flkasj fglkafkasfaskjf liashf oliashn laskh fnlask fnlask fnlask fsilakhlks ahfljkadhfoklasjhfas lkdasfhoasjhfoiashf oish oiuh iohoihoijkl ', '0000-00-00', '');

-- Zrzut danych tabeli `cena`
INSERT INTO `cena` (`id_cena`, `naprawa`, `cena`, `opis`) VALUES
(1, 1, 2412, 'gsdgdsg'),
(2, 2, 2412, 'gsdgdsg'),
(3, 2, 245333, 'gdsgsdgfsdgdf'),
(4, 3, 2412, 'gsdgdsg'),
(5, 3, 245333, 'gdsgsdgfsdgdf'),
(6, 4, 2412, 'gsdgdsg'),
(7, 4, 245333, 'gdsgsdgfsdgdf'),
(8, 5, 0, '');