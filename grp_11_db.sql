-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mag 11, 2017 alle 23:31
-- Versione del server: 10.1.21-MariaDB
-- Versione PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grp_11_db`
--
CREATE DATABASE IF NOT EXISTS `grp_11_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `grp_11_db`;

-- --------------------------------------------------------

--
-- Struttura della tabella `azienda`
--

CREATE TABLE `azienda` (
  `partitaiva` varchar(255) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL,
  `fax` varchar(10) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `citta` varchar(255) DEFAULT NULL,
  `paese` varchar(255) DEFAULT NULL,
  `settore` varchar(255) DEFAULT NULL,
  `ragionesociale` varchar(255) DEFAULT NULL,
  `descrizione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `username` varchar(255) DEFAULT NULL,
  `idcarrello` varchar(45) NOT NULL,
  `codicepromozione` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `coupon`
--

CREATE TABLE `coupon` (
  `codicecoupon` varchar(255) NOT NULL,
  `usrename` varchar(255) NOT NULL,
  `codicepromozione` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `promozione`
--

CREATE TABLE `promozione` (
  `codicepromozione` varchar(255) NOT NULL,
  `partitaiva` varchar(255) DEFAULT NULL,
  `nomeprodotto` varchar(255) DEFAULT NULL,
  `datainizio` date DEFAULT NULL,
  `datafine` date DEFAULT NULL,
  `tipologia` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  `immagine` varchar(255) DEFAULT NULL,
  `state` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `relazione`
--

CREATE TABLE `relazione` (
  `username` varchar(255) NOT NULL,
  `partitaiva` varchar(255) NOT NULL,
  `idrelazione` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) CHARACTER SET latin1 NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `cognome` varchar(255) DEFAULT NULL,
  `sesso` char(1) DEFAULT NULL,
  `datanascita` date DEFAULT NULL,
  `tipo` char(1) NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `indirizzo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `azienda`
--
ALTER TABLE `azienda`
  ADD PRIMARY KEY (`partitaiva`),
  ADD UNIQUE KEY `partitaiva_UNIQUE` (`partitaiva`);

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`idcarrello`);

--
-- Indici per le tabelle `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`codicecoupon`),
  ADD UNIQUE KEY `idstorico_UNIQUE` (`codicecoupon`),
  ADD KEY `fk_storico_user1_idx` (`usrename`),
  ADD KEY `fk_storico_coupon1_idx` (`codicepromozione`);

--
-- Indici per le tabelle `promozione`
--
ALTER TABLE `promozione`
  ADD PRIMARY KEY (`codicepromozione`),
  ADD KEY `fk_coupon_relazione1_idx` (`partitaiva`);

--
-- Indici per le tabelle `relazione`
--
ALTER TABLE `relazione`
  ADD PRIMARY KEY (`idrelazione`),
  ADD UNIQUE KEY `idrelazione_UNIQUE` (`idrelazione`),
  ADD KEY `fk_relazione_user_idx` (`username`),
  ADD KEY `fk_relazione_azienda1_idx` (`partitaiva`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`);

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `coupon`
--
ALTER TABLE `coupon`
  ADD CONSTRAINT `fk_storico_coupon1` FOREIGN KEY (`codicepromozione`) REFERENCES `promozione` (`codicepromozione`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_storico_user1` FOREIGN KEY (`usrename`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `promozione`
--
ALTER TABLE `promozione`
  ADD CONSTRAINT `fk_coupon_relazione1` FOREIGN KEY (`partitaiva`) REFERENCES `relazione` (`partitaiva`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `relazione`
--
ALTER TABLE `relazione`
  ADD CONSTRAINT `fk_relazione_azienda1` FOREIGN KEY (`partitaiva`) REFERENCES `azienda` (`partitaiva`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_relazione_user` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
