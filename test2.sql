-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 07, 2024 alle 10:07
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `clienti`
--

CREATE TABLE `clienti` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT NULL,
  `partita_iva` varchar(20) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `clienti`
--

INSERT INTO `clienti` (`id`, `nome`, `indirizzo`, `partita_iva`, `telefono`, `email`) VALUES
(1, 'Ciro', 'Via test', '12345678ghaj', '765432345678', 'test@gmail.com'),
(2, 'Pino', 'test2', '123456', '8765432345', 'test456@gmail.com'),
(3, 'Mario', 'via test 90', '0987654345', '2345678765', 'test90@gmail.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `fatture`
--

CREATE TABLE `fatture` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL,
  `quantita` int(11) DEFAULT NULL,
  `prezzo_unitario` decimal(10,2) DEFAULT NULL,
  `totale` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `fatture`
--

INSERT INTO `fatture` (`id`, `cliente_id`, `data`, `descrizione`, `quantita`, `prezzo_unitario`, `totale`) VALUES
(11, 3, '2024-10-07', 'test descrizione', 1, 200.00, 200.00);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `clienti`
--
ALTER TABLE `clienti`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `fatture`
--
ALTER TABLE `fatture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `clienti`
--
ALTER TABLE `clienti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `fatture`
--
ALTER TABLE `fatture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `fatture`
--
ALTER TABLE `fatture`
  ADD CONSTRAINT `fatture_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clienti` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
