-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Paź 2022, 11:48
-- Wersja serwera: 10.4.19-MariaDB
-- Wersja PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `sklepkj`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kategoria`
--

CREATE TABLE `kategoria` (
  `ID_kategorie` tinyint(4) DEFAULT NULL,
  `Nazwa_kategorii` varchar(18) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `kategoria`
--

INSERT INTO `kategoria` (`ID_kategorie`, `Nazwa_kategorii`) VALUES
(1, 'monitor'),
(2, 'myszka'),
(3, 'klawiatura'),
(4, 'głośniki'),
(5, 'kamery_internetowe'),
(6, 'mikrofony'),
(7, 'słuchawki'),
(8, 'pendrive'),
(9, 'dysk_zewnetrzny'),
(10, 'kierownice_do_gier');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `producenci`
--

CREATE TABLE `producenci` (
  `ID_producenta` tinyint(4) DEFAULT NULL,
  `Nazwa_producenta` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `producenci`
--

INSERT INTO `producenci` (`ID_producenta`, `Nazwa_producenta`) VALUES
(1, 'Logitech'),
(2, 'Razer'),
(4, 'BenQ'),
(5, 'Samsung'),
(6, 'Seagate'),
(7, 'SanDisk'),
(8, 'JBL'),
(9, 'HyperX'),
(10, 'ASUS'),
(11, 'Philips'),
(12, 'Accura'),
(13, 'Corsair'),
(14, 'Kingston'),
(15, 'Thrustmaster'),
(16, 'KRUX');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `produkty`
--

CREATE TABLE `produkty` (
  `ID_produktu` tinyint(4) DEFAULT NULL,
  `ID_kategorie` tinyint(4) DEFAULT NULL,
  `ID_producenta` tinyint(4) DEFAULT NULL,
  `nazwa_produktu` varchar(49) DEFAULT NULL,
  `typ` varchar(20) DEFAULT NULL,
  `opis` text DEFAULT NULL,
  `fotografia` varchar(29) DEFAULT NULL,
  `data_dodania` date DEFAULT NULL,
  `cena_netto` smallint(6) DEFAULT NULL,
  `promocja` varchar(5) DEFAULT NULL,
  `cena_netto_promocja` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `produkty`
--

INSERT INTO `produkty` (`ID_produktu`, `ID_kategorie`, `ID_producenta`, `nazwa_produktu`, `typ`, `opis`, `fotografia`, `data_dodania`, `cena_netto`, `promocja`, `cena_netto_promocja`) VALUES
(2, 4, 1, 'Logitech Z906', 'głośniki komputerowe', 'Rodzaj: <b>głośniki komputerowe</b><br>Ilość kanałów: <b>5.1</b><br>Moc głośnika satelitarnego RMS: <b>67 W</b><br>Moc głośnika centralnego RMS: <b>67 W</b><br>Moc głośnika niskotonowego RMS: <b>165 W</b><br>Kolor: <b>czarny</b><br>Łączność: <b>przewodowa</b><br>', 'Logitech-Z906.jpg', '2022-10-10', 1499, 'False', 0),
(3, 1, 10, 'ASUS ROG STRIX XG258Q', 'monitor', 'Typ ekranu: <b>płaski</b><br>Przekątna: <b>24.5 cali</b><br>Rozdzielczość nominalna: <b>1920 x 1080 (Full HD) piksele</b><br>Typ matrycy: <b>TN</b><br>Format obrazu: <b>16:9</b><br>Rodzaj podświetlenia: <b>LED</b><br>Obsługiwane technologie: <b>FreeSync, G-Sync</b><br>', 'ASUS-XG258Q.jpg', '2022-10-10', 1899, 'False', 0),
(4, 1, 4, 'BenQ EX3210R', 'monitor', 'Typ ekranu: <b>zakrzywiony</b><br>Przekątna: <b>31.5 cali</b><br>Rozdzielczość nominalna: <b>2560 x 1440 piksele</b><br>Typ matrycy: <b>VA</b><br>Format obrazu: <b>16:9</b><br>Rodzaj podświetlenia: <b>LED</b><br>Obsługiwane technologie: <b>FreeSync Premium Pro</b><br>', 'BenQ-EX3210R.jpg', '2022-10-10', 2399, 'True', 1999),
(5, 1, 11, 'Philips 24M1N3200VS', 'monitor', 'Typ ekranu: <b>płaski</b><br>Przekątna: <b>24 cali</b><br>Rozdzielczość nominalna: <b>1920 x 1080 (Full HD) piksele</b><br>Typ matrycy: <b>VA</b><br>Format obrazu: <b>16:9</b><br>Rodzaj podświetlenia: <b>LED</b><br>Częstotliwość odświeżania: <b>165 Hz</b><br>', 'Philips-24M1N3200VS.jpg', '2022-10-10', 839, 'True', 799),
(6, 2, 1, 'Logitech G502 Hero', 'myszka', 'Typ urządzenia: <b>mysz ergonomiczna</b><br>Przeznaczenie: <b>dla graczy</b><br>Łączność: <b>przewodowa</b><br>Szybkość śledzenia: <b>400 IPS</b><br>Maksymalne przyspieszenie: <b>40 G</b><br>Profil: <b>praworęczny</b><br>Kolory podświetlenia: <b>RGB</b><br>', 'Logitech-G502-Hero.jpg', '2022-10-10', 269, 'False', 0),
(7, 2, 2, 'Razer Viper Ultimate', 'myszka', 'Typ urządzenia: <b>mysz ergonomiczna</b><br>Przeznaczenie: <b>dla graczy</b><br>Łączność: <b>bezprzewodowa, przewodowa</b><br>Obszar odbioru fal: <b>2.4 GHz</b><br>Szybkość śledzenia: <b>650 IPS</b><br>Maksymalne przyspieszenie: <b>50 G</b><br>Profil: <b>praworęczny</b><br>', 'Razer-Viper-Ultimate.jpg', '2022-10-10', 659, 'True', 539),
(8, 2, 2, 'Razer Mamba Elite', 'myszka', 'Typ urządzenia: <b>mysz ergonomiczna</b><br>Przeznaczenie: <b>dla graczy</b><br>Łączność: <b>przewodowa</b><br>Profil: <b>praworęczny</b><br>Liczba przycisków: <b>9 szt.</b><br>Oprogramowanie: <b>Razer Synapse</b><br>Kolor: <b>czarny</b><br>', 'Razer-Mamba-Elite.jpg', '2022-10-10', 319, 'True', 199),
(9, 3, 1, 'Logitech G413 Carbon', 'klawiatura', 'Łączność: <b>przewodowa</b><br>Przeznaczenie: <b>dla graczy</b><br>Typ klawiatury: <b>tradycyjna</b><br>Typ klawiszy: <b>mechaniczne</b><br>Rodzaj przełączników: <b>Logitech Romer-G (sprężynujące)</b><br>Klawisze numeryczne: <b>tak</b><br>Podświetlenie: <b>tak</b><br>', 'Logitech-G413.jpg', '2022-10-10', 349, 'True', 279),
(10, 3, 12, 'Accura Vista ACC-K1411', 'klawiatura', 'Łączność: <b>przewodowa</b><br>Przeznaczenie: <b>do biura</b><br>Typ klawiatury: <b>tradycyjna</b><br>Typ klawiszy: <b>membranowe</b><br>Klawisze numeryczne: <b>tak</b><br>Interfejs: <b>USB</b><br>Kolor: <b>czarny</b><br>', 'Accura-Vista.jpg', '2022-10-10', 49, 'False', 0),
(11, 3, 13, 'Corsair Gaming K55 Pro RGB', 'klawiatura', 'Łączność: <b>przewodowa</b><br>Przeznaczenie: <b>dla graczy</b><br>Typ klawiatury: <b>tradycyjna</b><br>Typ klawiszy: <b>membranowe</b><br>Klawisze numeryczne: <b>tak</b><br>Klawisze multimedialne: <b>tak</b><br>Podpórka pod nadgarstki: <b>tak</b><br>', 'Corsair-K55.jpg', '2022-10-10', 249, 'False', 0),
(12, 9, 6, 'Seagate One Touch HDD 5TB', 'dysk zewnętrzny', 'Typ: <b>HDD (magnetyczny)</b><br>Format: <b>2.5 cala</b><br>Interfejs: <b>USB 3.2</b><br>Pojemność: <b>5000 GB</b><br>Kolor: <b>czarny</b><br>', 'Seagate-One-Touch.jpg', '2022-10-10', 629, 'False', 0),
(13, 9, 6, 'Seagate Expansion Portable 2TB', 'dysk zewnętrzny', 'Typ: <b>HDD (magnetyczny)</b><br>Format: <b>2.5 cala</b><br>Interfejs: <b>USB 3.0</b><br>Pojemność: <b>2000 GB</b><br>Kolor: <b>czarny</b><br>', 'Seagate-Expansion.jpg', '2022-10-10', 299, 'True', 249),
(14, 9, 14, 'Kingston SSD XS2000 1TB', 'dysk zewnętrzny', 'Typ: <b>SSD</b><br>Interfejs: <b>USB 3.2 - typ C</b><br>Pojemność: <b>1000 GB</b><br>Szybkość <b>odczytu: 2000 MB/s</b><br>Szybkość <b>zapisu: 2000 MB/s</b><br>', 'Kingston-XS2000.jpg', '2022-10-10', 679, 'False', 0),
(15, 8, 7, 'SanDisk 256GB Extreme Pro SSD Flash Drive USB 3.1', 'pendrive', 'Interfejs: <b>USB 3.1</b><br>Pojemność: <b>256 GB</b><br>Maks. prędkość zapisu: <b>380 MB/s</b><br>Maks. prędkość odczytu: <b>420 MB/s</b><br>Waga: <b>17 g</b><br>Kolor: <b>czarny</b><br>', 'SanDisk-256GB-Extreme-Pro.jpg', '2022-10-10', 349, 'False', 0),
(16, 8, 7, 'SanDisk 128GB Ultra Dual Drive Go USB Type-C', 'pendrive', 'Interfejs: <b>USB 3.0, USB-C</b><br>Pojemność: <b>128 GB</b><br>Maks. prędkość odczytu: <b>150 MB/s</b><br>Waga: <b>3.7 g</b><br>Kolor: <b>czarny</b><br>', 'SanDisk-128GB-Ultra-Dual.jpg', '2022-10-10', 99, 'False', 0),
(17, 8, 5, 'Samsung 64GB Fit Plus USB 3.1', 'pendrive', 'Interfejs: <b>USB 3.1</b><br>Pojemność: <b>64 GB</b><br>Maks. prędkość odczytu: <b>200 MB/s</b><br>Waga: <b>3.1 g</b><br>Kolor: <b>szary</b><br>', 'Samsung-64GB-Fit-Plus.jpg', '2022-10-11', 69, 'False', 0),
(18, 4, 1, 'Logitech Z200', 'głośniki komputerowe', 'Rodzaj: <b>głośniki komputerowe</b><br>Ilość kanałów: <b>2.0</b><br>Waga: <b>1000 g</b><br>Kolor: <b>czarny</b><br>Łączność: <b>przewodowa</b><br>Ilość głośników: <b>2 szt.</b><br>Ilość głośników satelitarnych: <b>2 szt.</b><br>', 'Logitech-Z200.jpg', '2022-10-11', 219, 'False', 0),
(19, 4, 1, 'Logitech Z120', 'głośniki komputerowe', 'Rodzaj: <b>głośniki komputerowe</b><br>Ilość kanałów: <b>2.0</b><br>Złącza: <b>1 x miniJack (3.5 mm), 1 x USB</b><br>Waga: <b>250 g</b><br>Kolor: <b>biało-czarny</b><br>Łączność: <b>przewodowa</b><br>Ilość głośników: <b>2 szt.</b><br>', 'Logitech-Z120.jpg', '2022-10-11', 79, 'False', 0),
(20, 5, 1, 'Logitech HD Pro C920', 'kamera internetowa', 'Maks. rozdzielczość: <b>1920 x 1080 (FullHD | 30 FPS)</b><br>Kolor: <b>czarny</b><br>Przeznaczenie: <b>dla graczy, do biura, do nauki, streaming</b><br>Funkcja aparatu cyfrowego: <b>tak</b><br>Funkcja kamery internetowej: <b>tak</b><br>Interfejs: <b>USB</b><br>Długość kabla: <b>1.5 m</b><br>', 'Logitech-C920.jpg', '2022-10-11', 499, 'True', 459),
(21, 5, 1, 'Logitech HD C270', 'kamera internetowa', 'Maks. rozdzielczość: <b>1280 x 720 (HD | 30 FPS)</b><br>Przeznaczenie: <b>do biura, do nauki</b><br>Funkcja aparatu cyfrowego: <b>tak</b><br>Funkcja kamery internetowej: <b>tak</b><br>Interfejs: <b>USB</b><br>Mikrofon: <b>tak</b><br>Zasilanie: <b>z urządzenia</b><br>', 'Logitech-C270.jpg', '2022-10-12', 259, 'False', 0),
(22, 5, 2, 'Razer Kiyo X', 'kamera internetowa', 'Maks. rozdzielczość: <b>1920 x 1080 (FullHD | 30 FPS)</b><br>Kolor: <b>czarny</b><br>Przeznaczenie: <b>dla graczy, do biura, do nauki, streaming</b><br>Funkcja aparatu cyfrowego: <b>tak</b><br>Funkcja kamery internetowej: <b>tak</b><br>Interfejs: <b>USB</b><br>Zasilanie: <b>z urządzenia</b><br>', 'Razer-Kiyo-X.jpg', '2022-10-12', 299, 'True', 199),
(23, 10, 1, 'Logitech G920', 'kierownica do gier', 'Gamepad: <b>kierownica, podstawa z pedałami</b><br>Łączność: <b>przewodowa</b><br>Interfejs: <b>USB</b><br>Platforma systemowa: <b>Microsoft Xbox One, Microsoft Xbox Series S, Microsoft Xbox Series X, PC</b><br>', 'Logitech-G920.jpg', '2022-10-12', 1299, 'False', 0),
(24, 10, 1, 'Logitech G29', 'kierownica do gier', 'Gamepad: <b>kierownica, podstawa z pedałami</b><br>Średnica koła kierownicy: <b>26.5 cm</b><br>Łączność: <b>przewodowa</b><br>Programowanie przycisków: <b>tak</b><br>Platforma systemowa: <b>PC, Sony Playstation 3, Sony Playstation 4, Sony Playstation 5</b><br>', 'Logitech-G29.jpg', '2022-10-12', 1299, 'True', 999),
(25, 10, 15, 'Thrustmaster TMX FFB Racing PC/XOne', 'kierownica do gier', 'Gamepad: <b>kierownica</b><br>Liczba przycisków: <b>12 szt.</b><br>Platforma systemowa: <b>Microsoft Xbox One, PC</b><br>', 'Thrustmaster-TMX-FFB.jpg', '2022-10-12', 1059, 'False', 0),
(26, 6, 9, 'HyperX QuadCast S', 'mikrofon', 'Rodzaj mikrofonu: <b>pojemnościowy</b><br>Typ: <b>komputerowy</b><br>Komunikacja z urządzeniem: <b>przewodowa</b><br>Długość przewodu: <b>3 m</b><br>Pasmo przenoszenia: <b>20 - 20000 Hz</b><br>Czułość mikrofonu: <b>-36 dB</b><br>Impedancja mikrofonu: <b>32 Ohm</b><br>', 'HyperX-QuadCast-S.jpg', '2022-10-12', 699, 'True', 599),
(27, 6, 16, 'KRUX Prana USB', 'mikrofon', 'Typ: <b>komputerowy</b><br>Komunikacja z urządzeniem: <b>przewodowa</b><br>Długość przewodu: <b>1.5 m</b><br>Pasmo przenoszenia: <b>20 - 20000 Hz</b><br>Kolor: <b>czarny</b><br>Przeznaczenie: <b>dla graczy</b><br>Kierunkowość: <b>wielokierunkowa</b><br>', 'KRUX-Prana.jpg', '2022-10-13', 49, 'False', 0),
(28, 6, 8, 'JBL Quantum Stream', 'mikrofon', 'Rodzaj mikrofonu: <b>kondensator</b><br>Typ: <b>profesjonalny</b><br>Komunikacja z urządzeniem: <b>przewodowa</b><br>Pasmo przenoszenia: <b>20 - 20000 Hz</b><br>Czułość mikrofonu: <b>-37 dB</b><br>Impedancja mikrofonu: <b>16 Ohm</b><br>Kolor: <b>czarny</b><br>', 'JBL-Quantum-Stream.jpg', '2022-10-13', 399, 'False', 0),
(29, 7, 1, 'Logitech G Pro X', 'słuchawki', 'Przeznaczenie: <b>dla graczy, streaming</b><br>Rodzaj: <b>nauszne</b><br>Łączność: <b>przewodowa</b><br>Interfejs odtwarzania przewodowego: <b>USB + Jack</b><br>Długość przewodu: <b>2 m</b><br>Mikrofon: <b>tak</b><br>Waga: <b>320 g</b><br>', 'Logitech-G-Pro-X.jpg', '2022-10-13', 659, 'False', 0),
(30, 7, 8, 'JBL Tune 510 BT', 'słuchawki', 'Przeznaczenie: <b>do telefonu</b><br>Rodzaj: <b>nauszne</b><br>Łączność: <b>bezprzewodowa</b><br>Pojemność akumulatora: <b>450 mAh</b><br>Czas pracy: <b>40 godz.</b><br>Mikrofon: <b>tak</b><br>Waga: <b>160 g</b><br>', 'JBL-Tune-510-BT.jpg', '2022-10-13', 189, 'False', 0),
(31, 7, 2, 'Razer Kraken V3 X', 'słuchawki', 'Przeznaczenie: <b>dla graczy</b><br>Rodzaj: <b>nauszne</b><br>Łączność: <b>przewodowa</b><br>Interfejs odtwarzania przewodowego: <b>USB</b><br>Długość przewodu: <b>1.8 m</b><br>Mikrofon: <b>tak</b><br>Oprogramowanie: <b>Razer Synapse</b><br>', 'Razer-Kraken-V3-X.jpg', '2022-10-13', 229, 'True', 199);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID_uzytkownika` int(11) NOT NULL,
  `nazwa_uzytkownika` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `haslo` char(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID_uzytkownika`, `nazwa_uzytkownika`, `email`, `haslo`) VALUES
(1, 'Kacperjab', 'naitomea.jab@gmail.com', '$2y$10$4BuZhI/lcOnNQTHxCJFUzO5.InxUo8.IlOJEwKTLL6KmqbD6hHLIO');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zamowienia`
--

CREATE TABLE `zamowienia` (
  `ID_zamowienia` int(11) NOT NULL,
  `ID_uzytkownika` int(11) NOT NULL,
  `ID_produktu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID_uzytkownika`);

--
-- Indeksy dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  ADD PRIMARY KEY (`ID_zamowienia`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID_uzytkownika` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `zamowienia`
--
ALTER TABLE `zamowienia`
  MODIFY `ID_zamowienia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
