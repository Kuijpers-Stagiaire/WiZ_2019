-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 17 jan 2019 om 11:00
-- Serverversie: 5.7.19
-- PHP-versie: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wiz`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `overzicht`
--

CREATE TABLE `overzicht` (
  `ID` int(11) NOT NULL,
  `Mutatiecode` int(11) DEFAULT NULL,
  `productcode_fabrikant` varchar(20) DEFAULT NULL,
  `gln_fabrikant` bigint(13) DEFAULT NULL,
  `gtin_fabrikant` varchar(14) DEFAULT NULL,
  `Ingangsdatum` date DEFAULT NULL,
  `Locatie` varchar(200) DEFAULT NULL,
  `Productomschrijving` varchar(200) DEFAULT NULL,
  `specificaties` varchar(255) DEFAULT NULL,
  `Statuscode` varchar(3) DEFAULT NULL,
  `gtin_fabrikant opvolger` varchar(14) DEFAULT NULL,
  `Productcode opvolger` varchar(20) DEFAULT NULL,
  `gtin_fabrikant voorganger` varchar(14) DEFAULT NULL,
  `Productcode voorganger` int(20) DEFAULT NULL,
  `Netto gewicht` varchar(19) NOT NULL,
  `Eenheid gewicht` varchar(1000) DEFAULT 'Onbekend',
  `Aantal` varchar(150) NOT NULL DEFAULT 'Onbekend',
  `Fabrikaat` varchar(35) DEFAULT NULL,
  `Productserie` varchar(35) DEFAULT NULL,
  `Producttype` varchar(35) DEFAULT NULL,
  `imagelink` varchar(255) DEFAULT '/img/img-placeholder.png',
  `imagelink_2` varchar(255) DEFAULT NULL,
  `imagelink_3` varchar(255) DEFAULT NULL,
  `Code productgroep` varchar(4) DEFAULT NULL,
  `Volgnummer productklasse` varchar(3) DEFAULT NULL,
  `Versie normblad` varchar(2) DEFAULT NULL,
  `Status normblad` varchar(513) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `overzicht`
--

INSERT INTO `overzicht` (`ID`, `Mutatiecode`, `productcode_fabrikant`, `gln_fabrikant`, `gtin_fabrikant`, `Ingangsdatum`, `Locatie`, `Productomschrijving`, `specificaties`, `Statuscode`, `gtin_fabrikant opvolger`, `Productcode opvolger`, `gtin_fabrikant voorganger`, `Productcode voorganger`, `Netto gewicht`, `Eenheid gewicht`, `Aantal`, `Fabrikaat`, `Productserie`, `Producttype`, `imagelink`, `imagelink_2`, `imagelink_3`, `Code productgroep`, `Volgnummer productklasse`, `Versie normblad`, `Status normblad`, `updated_at`) VALUES
(10, NULL, '33333312', NULL, NULL, '2019-01-15', 'Helmond', 'HP ElitePad 900', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '14', 'HP', 'IT', 'Tablet', '/storage/productimages/ElitePad900.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, NULL, '12345614', NULL, NULL, '2019-01-15', 'Helmond', 'HP ElitePad 1000', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '10', 'HP', 'IT', 'Tablet', '/storage/productimages/elite1000.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, NULL, '33333393', NULL, NULL, '2019-01-15', 'Helmond', 'HP Microsoft Surface Pro 2', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '6', 'HP', 'IT', 'Tablet', '/storage/productimages/surfacepro2.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, NULL, '11111333', NULL, NULL, '2019-01-15', 'Helmond', 'HP Elite X2 G1', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', 'HP', 'IT', 'Tablet', '/storage/productimages/elitex2g1.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, NULL, '12345683', NULL, NULL, '2019-01-15', 'Helmond', 'HP Pro X2 612', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', 'HP', 'IT', 'Tablet', '/storage/productimages/HPProX2612.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, NULL, '11111899', NULL, NULL, '2019-01-15', 'Helmond', 'Microsoft Surface Pro 3', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2', 'HP', 'IT', 'Tablet', '/storage/productimages/surfacepro3.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, NULL, '11111131', NULL, NULL, '2019-01-15', 'Helmond', 'HP LaserJet P2055dn', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', 'HP', 'IT', 'Printer', '/storage/productimages/HPprinter.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, NULL, '33333231', NULL, NULL, '2019-01-15', 'Helmond', 'HP XW6400', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '3', 'HP', 'IT', 'PC', '/storage/productimages/hp-xw6400-intel-xeon.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, NULL, '33333349', NULL, NULL, '2019-01-15', 'Helmond', 'HP Z400 Workstation', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '4', 'HP', 'IT', 'PC', '/storage/productimages/71xog01tipL._SX425_.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, NULL, '12345691', NULL, NULL, '2019-01-15', 'Helmond', 'HP Pro 310 MT', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', 'HP', 'IT', 'PC', '/storage/productimages/c04756585.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, NULL, '99933311', NULL, NULL, '2019-01-15', 'Helmond', 'HP 20\" monitor', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '2', 'HP', 'IT', 'Monitor', '/storage/productimages/Z_W2082A.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, NULL, '99345678', NULL, NULL, '2019-01-15', 'Helmond', 'Acer monitoren', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '4', 'Acer', 'IT', 'Monitor', '/storage/productimages/acer_um_qx2aa_a01_k242hyl_abid_23_8_16_9_1364088.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, NULL, '12341678', NULL, NULL, '2019-01-15', 'Helmond', 'Samsung monitor', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', 'Samsung', 'IT', 'Monitor', '/storage/productimages/1348569475.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, NULL, '33733311', NULL, NULL, '2019-01-15', 'Helmond', 'HP ProBook 4530s', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', 'HP', 'IT', 'Laptop', '/storage/productimages/52591901.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, NULL, '53333311', NULL, NULL, '2019-01-15', 'Helmond', 'HP ProBook 470 G2', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', 'HP', 'IT', 'Laptop', '/storage/productimages/1405320318.jpeg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, NULL, '11117111', NULL, NULL, '2019-01-15', 'Helmond', 'HP ProBook 650 G3', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', 'HP', 'IT', 'Laptop', '/storage/productimages/668125.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, NULL, '12340678', NULL, NULL, '2019-01-15', 'Helmond', 'HP ProBook 640 G2', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', 'HP', 'IT', 'Laptop', '/storage/productimages/1350094695_1868658429_notebooks-laptops-hp-640-g2-w6e02awabh.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, NULL, '10045678', NULL, NULL, '2019-01-15', 'Helmond', 'Frama frankeermachine 2005', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '1', 'Frama', 'IT', 'Diversen', '/storage/productimages/Frankeermachine.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, NULL, '12341178', NULL, NULL, '2019-01-15', 'Helmond', 'Sanitair flenzen', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '150', 'Appendages', 'Magazijn', 'Flenzen', '/storage/productimages/20190115_132443.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, NULL, '12345111', NULL, NULL, '2019-01-15', 'Helmond', 'Verschillende afsluiters', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '50', 'TU', 'Magazijn', 'Afsluiters', '/storage/productimages/20190115_133937.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, NULL, '22345678', NULL, NULL, '2019-01-15', 'Helmond', 'Installatie RVS buizen', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '30~', 'TU', 'Magazijn', 'RVS buizen', '/storage/productimages/20190115_133222.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, NULL, '31233333', NULL, NULL, '2019-01-15', 'Helmond', 'Industrie Elektronische onderdelen', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Onbekend', 'TU', 'Magazijn', 'Elektronische onderdelen', '/storage/productimages/20190115_133538.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, NULL, '12321679', NULL, NULL, '2019-01-17', 'Helmond', 'Econ afsluiters', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '30', 'Econ', 'Magazijn', 'Afsluiters', '/storage/productimages/20190115_132622.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, NULL, '33398333', NULL, NULL, '2019-01-17', 'Helmond', 'T stukken RVS', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '200', 'TU', 'Magazijn', 'T stukken', '/storage/productimages/20190115_132729.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, NULL, '13333311', NULL, NULL, '2019-01-17', 'Helmond', 'Elektro data kabels', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Onbekend', 'TU', 'Magazijn', 'Kabels', '/storage/productimages/20190115_134448.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, NULL, '33332312', NULL, NULL, '2019-01-17', 'Helmond', 'Gebruikte Huawei P8 Lite telefoons', 'Exra informatie', NULL, NULL, NULL, NULL, NULL, '', '0.735', '5', 'Huawei', 'IT', 'Telefoon', '/storage/productimages/20190110_140646.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `overzicht`
--
ALTER TABLE `overzicht`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `productcode_fabrikant` (`productcode_fabrikant`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `overzicht`
--
ALTER TABLE `overzicht`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
