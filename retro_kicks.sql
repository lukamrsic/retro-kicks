-- XAMPP-Lite
-- version 8.5.5
-- https://xampplite.sf.net/
--
-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2026 at 06:37 PM
-- Server version: 11.4.10-MariaDB-log
-- PHP Version: 8.5.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `retro_kicks`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `korisnicko_ime` varchar(50) NOT NULL,
  `lozinka` varchar(255) NOT NULL,
  `razina` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `ime`, `prezime`, `korisnicko_ime`, `lozinka`, `razina`) VALUES
(1, 'Luka ', 'Mrsic', 'lmrle', '$2y$12$cmrtnl5hcQ1piji6v0aP1.Hf4XoBYPjwl94urhNbs6hZPB8N7Mv2y', 1),
(2, 'marko', 'maric', 'markic', '$2y$12$iFgt.jpbwyT.uPuqMyeghOE3v0i.7R.s1cDi6nhdy5F1lbtV5xJI.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `vijesti`
--

CREATE TABLE `vijesti` (
  `ID` int(11) NOT NULL,
  `datum` varchar(20) NOT NULL,
  `naslov` varchar(255) NOT NULL,
  `sazetak` text NOT NULL,
  `tekst` text NOT NULL,
  `slika` varchar(255) NOT NULL,
  `kategorija` varchar(100) NOT NULL,
  `arhiva` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vijesti`
--

INSERT INTO `vijesti` (`ID`, `datum`, `naslov`, `sazetak`, `tekst`, `slika`, `kategorija`, `arhiva`) VALUES
(1, '21.06.2026.', 'Nike Dunk Low Panda', 'Jedan od najpopularnijih retro modela ponovno je dostupan.', 'Nike Dunk Low Panda vraća se u prodaju tijekom ljeta 2026. godine. Model je poznat po jednostavnoj crno-bijeloj kombinaciji boja i velikoj popularnosti među ljubiteljima tenisica. Očekuje se velika potražnja i brzo rasprodavanje zaliha.', 'panda.jpg', 'Basketball', 0),
(3, '21.06.2026', 'Air Jordan 1 Chicago', 'Najpoznatija Jordan silueta svih vremena.', 'Air Jordan 1 Chicago smatra se jednim od najvažnijih modela u povijesti košarkaških tenisica. Originalno predstavljen osamdesetih godina, model je postao simbol sportske i streetwear kulture.', 'jordan.webp', 'Basketball', 0),
(4, '21.06.2026', 'Adidas Superstar', 'Klasični model koji traje desetljećima.', 'Adidas Superstar jedan je od najprepoznatljivijih modela svih vremena. Zahvaljujući karakterističnoj školjkici na prednjem dijelu tenisice, model je stekao kultni status među generacijama ljubitelja mode i glazbe.', 'superstar.jpg', 'Retro', 0),
(5, '21.06.2026', 'Nike Dunk Low', 'Model koji je obilježio street i skate kulturu.', 'Nike Dunk Low već desetljećima zauzima posebno mjesto među ljubiteljima tenisica. Zahvaljujući velikom broju različitih boja i suradnji s poznatim brendovima, model je postao nezaobilazan dio streetwear scene.', 'dunk.webp', 'Retro', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`);

--
-- Indexes for table `vijesti`
--
ALTER TABLE `vijesti`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vijesti`
--
ALTER TABLE `vijesti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
