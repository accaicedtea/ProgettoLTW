-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 28, 2023 alle 09:16
-- Versione del server: 10.4.20-MariaDB
-- Versione PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4money`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categoria`
--

CREATE TABLE `categoria` (
  `colore` varchar(6) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categoria`
--

INSERT INTO `categoria` (`colore`, `nome`) VALUES
('272743', 'Cultura'),
('09C7D9', 'Stipendio');

-- --------------------------------------------------------

--
-- Struttura della tabella `spesa`
--

CREATE TABLE `spesa` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `importo` float NOT NULL,
  `descrizione` varchar(50) NOT NULL,
  `data` datetime NOT NULL,
  `username` varchar(12) NOT NULL,
  `categoria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `spesa`
--

INSERT INTO `spesa` (`id`, `tipo`, `importo`, `descrizione`, `data`, `username`, `categoria`) VALUES
(3, 'ENTRATA', 1400, 'è arrivato lo stipendio', '2023-03-27 16:50:42', 'ricky_sniper', 'Stipendio'),
(4, 'USCITA', 23.54, 'museo egizio Roma', '2023-03-27 16:50:42', 'Acca', 'Cultura');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `username` varchar(12) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `dataN` date NOT NULL,
  `pfp` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`username`, `nome`, `cognome`, `email`, `dataN`, `pfp`, `password`) VALUES
('Acca', 'Hasan', 'Abdel Aziz', 'abdel@gmail.com', '2000-11-25', './image/altradickpic.png', 'semprecoseacasounbotto'),
('Cristyl', 'Cristian ', 'Mai Mihai', 'cristyl.scelgote@gmail.com', '2001-02-14', './image/thirddickpick.png', 'fhuvgaydftfwadfawtyfa78ffr67wfr73f67vr67w3vrtui'),
('ricky_sniper', 'Riccardo', 'Ebene', 'riccardo@gmail.com', '2002-01-16', './image/dickpick.png', 'coseacasosunbotto12');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`nome`);

--
-- Indici per le tabelle `spesa`
--
ALTER TABLE `spesa`
  ADD PRIMARY KEY (`id`,`username`),
  ADD KEY `effettua` (`username`),
  ADD KEY `ha` (`categoria`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `spesa`
--
ALTER TABLE `spesa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `spesa`
--
ALTER TABLE `spesa`
  ADD CONSTRAINT `effettua` FOREIGN KEY (`username`) REFERENCES `user` (`username`),
  ADD CONSTRAINT `ha` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`nome`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
