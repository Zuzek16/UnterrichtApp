-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Mar 2024, 21:30
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `plan_lekcji`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dzien_tygodnia`
--

CREATE TABLE `dzien_tygodnia` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klasa`
--

CREATE TABLE `klasa` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(10) NOT NULL,
  `id_szkola` int(10) UNSIGNED NOT NULL,
  `id_planu_lekcji` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekcja`
--

CREATE TABLE `lekcja` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_sali` int(10) UNSIGNED NOT NULL,
  `id_nauczyciela` int(10) UNSIGNED NOT NULL,
  `id_przedmiotu` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekcje_planu`
--

CREATE TABLE `lekcje_planu` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_planu_lekcji` int(10) UNSIGNED NOT NULL,
  `id_przyporzadkowanej_lekcji` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nauczany_przedmiot`
--

CREATE TABLE `nauczany_przedmiot` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_przedmiotu` int(10) UNSIGNED NOT NULL,
  `id_nauczyciela` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nauczyciel`
--

CREATE TABLE `nauczyciel` (
  `id` int(10) UNSIGNED NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `nauczyciele_szkoly`
--

CREATE TABLE `nauczyciele_szkoly` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_nauczyciela` int(10) UNSIGNED NOT NULL,
  `id_szkoly` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `plan_lekcji`
--

CREATE TABLE `plan_lekcji` (
  `id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przedmiot`
--

CREATE TABLE `przedmiot` (
  `id` int(11) UNSIGNED NOT NULL,
  `nazwa` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `przyporzadkowanie_lekcji`
--

CREATE TABLE `przyporzadkowanie_lekcji` (
  `id` int(10) UNSIGNED NOT NULL,
  `nr_lekcji` tinyint(3) UNSIGNED NOT NULL,
  `id_dnia_tyg` int(10) UNSIGNED NOT NULL,
  `id_lekcji` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sala`
--

CREATE TABLE `sala` (
  `id` int(10) UNSIGNED NOT NULL,
  `numer` tinyint(3) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `szkola`
--

CREATE TABLE `szkola` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazwa` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uczen`
--

CREATE TABLE `uczen` (
  `id` int(10) UNSIGNED NOT NULL,
  `imie` varchar(50) NOT NULL,
  `nazwisko` varchar(50) NOT NULL,
  `id_klasa` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `dzien_tygodnia`
--
ALTER TABLE `dzien_tygodnia`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `klasa`
--
ALTER TABLE `klasa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_szkola` (`id_szkola`),
  ADD KEY `id_planu_lekcji` (`id_planu_lekcji`);

--
-- Indeksy dla tabeli `lekcja`
--
ALTER TABLE `lekcja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_sali` (`id_sali`),
  ADD KEY `id_nauczyciela` (`id_nauczyciela`),
  ADD KEY `id_przedmiotu` (`id_przedmiotu`);

--
-- Indeksy dla tabeli `lekcje_planu`
--
ALTER TABLE `lekcje_planu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_planu_lekcji` (`id_planu_lekcji`),
  ADD KEY `id_przyporzadkowanej_lekcji` (`id_przyporzadkowanej_lekcji`);

--
-- Indeksy dla tabeli `nauczany_przedmiot`
--
ALTER TABLE `nauczany_przedmiot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_przedmiotu` (`id_przedmiotu`),
  ADD KEY `id_nauczyciela` (`id_nauczyciela`);

--
-- Indeksy dla tabeli `nauczyciel`
--
ALTER TABLE `nauczyciel`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `nauczyciele_szkoly`
--
ALTER TABLE `nauczyciele_szkoly`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_nauczyciela` (`id_nauczyciela`),
  ADD KEY `id_szkoly` (`id_szkoly`);

--
-- Indeksy dla tabeli `plan_lekcji`
--
ALTER TABLE `plan_lekcji`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `przedmiot`
--
ALTER TABLE `przedmiot`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `przyporzadkowanie_lekcji`
--
ALTER TABLE `przyporzadkowanie_lekcji`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_dnia_tyg` (`id_dnia_tyg`),
  ADD KEY `id_lekcji` (`id_lekcji`);

--
-- Indeksy dla tabeli `sala`
--
ALTER TABLE `sala`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `szkola`
--
ALTER TABLE `szkola`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `uczen`
--
ALTER TABLE `uczen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_klasa` (`id_klasa`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `dzien_tygodnia`
--
ALTER TABLE `dzien_tygodnia`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `klasa`
--
ALTER TABLE `klasa`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `lekcja`
--
ALTER TABLE `lekcja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `lekcje_planu`
--
ALTER TABLE `lekcje_planu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `nauczany_przedmiot`
--
ALTER TABLE `nauczany_przedmiot`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `nauczyciel`
--
ALTER TABLE `nauczyciel`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `nauczyciele_szkoly`
--
ALTER TABLE `nauczyciele_szkoly`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `plan_lekcji`
--
ALTER TABLE `plan_lekcji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `przedmiot`
--
ALTER TABLE `przedmiot`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `przyporzadkowanie_lekcji`
--
ALTER TABLE `przyporzadkowanie_lekcji`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `sala`
--
ALTER TABLE `sala`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `szkola`
--
ALTER TABLE `szkola`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `uczen`
--
ALTER TABLE `uczen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `klasa`
--
ALTER TABLE `klasa`
  ADD CONSTRAINT `klasa_ibfk_1` FOREIGN KEY (`id_planu_lekcji`) REFERENCES `plan_lekcji` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `klasa_ibfk_2` FOREIGN KEY (`id_szkola`) REFERENCES `szkola` (`id`) ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `lekcja`
--
ALTER TABLE `lekcja`
  ADD CONSTRAINT `lekcja_ibfk_1` FOREIGN KEY (`id_nauczyciela`) REFERENCES `nauczyciel` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lekcja_ibfk_2` FOREIGN KEY (`id_przedmiotu`) REFERENCES `przedmiot` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lekcja_ibfk_3` FOREIGN KEY (`id_sali`) REFERENCES `sala` (`id`) ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `lekcje_planu`
--
ALTER TABLE `lekcje_planu`
  ADD CONSTRAINT `lekcje_planu_ibfk_1` FOREIGN KEY (`id_planu_lekcji`) REFERENCES `plan_lekcji` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lekcje_planu_ibfk_2` FOREIGN KEY (`id_przyporzadkowanej_lekcji`) REFERENCES `przyporzadkowanie_lekcji` (`id`) ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `nauczany_przedmiot`
--
ALTER TABLE `nauczany_przedmiot`
  ADD CONSTRAINT `nauczany_przedmiot_ibfk_1` FOREIGN KEY (`id_nauczyciela`) REFERENCES `nauczyciel` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nauczany_przedmiot_ibfk_2` FOREIGN KEY (`id_przedmiotu`) REFERENCES `przedmiot` (`id`) ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `nauczyciele_szkoly`
--
ALTER TABLE `nauczyciele_szkoly`
  ADD CONSTRAINT `nauczyciele_szkoly_ibfk_1` FOREIGN KEY (`id_nauczyciela`) REFERENCES `nauczyciel` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `nauczyciele_szkoly_ibfk_2` FOREIGN KEY (`id_szkoly`) REFERENCES `szkola` (`id`) ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `przyporzadkowanie_lekcji`
--
ALTER TABLE `przyporzadkowanie_lekcji`
  ADD CONSTRAINT `przyporzadkowanie_lekcji_ibfk_1` FOREIGN KEY (`id_dnia_tyg`) REFERENCES `dzien_tygodnia` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `przyporzadkowanie_lekcji_ibfk_2` FOREIGN KEY (`id_lekcji`) REFERENCES `lekcja` (`id`) ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `uczen`
--
ALTER TABLE `uczen`
  ADD CONSTRAINT `uczen_ibfk_1` FOREIGN KEY (`id_klasa`) REFERENCES `klasa` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
