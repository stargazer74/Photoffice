SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


CREATE TABLE IF NOT EXISTS `bestellung` (
  `idBestellung` int(11) NOT NULL,
  `Kunden_idKunden` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `fotografabgeschlossen` tinyint(1) DEFAULT NULL,
  `bestellwert` decimal(10,0) NOT NULL,
  `anmerkung` text,
  `Zahlungsart_idZahlungsart` int(11) NOT NULL,
  `Versandkosten_idVersandkosten` int(11) NOT NULL,
  PRIMARY KEY (`idBestellung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `bestellung_has_bild` (
  `Bild_idBild` int(11) NOT NULL,
  `Bestellung_idBestellung` int(11) NOT NULL,
  `Anzahl` int(11) NOT NULL,
  `Preis_Papier_idPapier` int(11) NOT NULL,
  `Preis_Bildformate_idBildformate` int(11) NOT NULL,
  PRIMARY KEY (`Bild_idBild`,`Bestellung_idBestellung`,`Preis_Papier_idPapier`,`Preis_Bildformate_idBildformate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `bild` (
  `idBild` int(11) NOT NULL AUTO_INCREMENT,
  `position` int(11) NOT NULL,
  `fotograf_idfotograf` int(11) NOT NULL,
  `gallerien_idgallerien` int(11) NOT NULL,
  `bildname` varchar(45) NOT NULL,
  `iconname` varchar(45) DEFAULT NULL,
  `online` tinyint(1) NOT NULL,
  `blende` varchar(45) DEFAULT NULL,
  `belichtungszeit` varchar(45) DEFAULT NULL,
  `brennweite` varchar(45) DEFAULT NULL,
  `iso` varchar(45) DEFAULT NULL,
  `blitz` varchar(45) DEFAULT NULL,
  `marke` varchar(45) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  `aufnahmezeitpunkt` varchar(45) DEFAULT NULL,
  `aenderungszeit` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idBild`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

CREATE TABLE IF NOT EXISTS `bildformate` (
  `idBildformate` int(11) NOT NULL AUTO_INCREMENT,
  `bildformat` varchar(45) NOT NULL,
  PRIMARY KEY (`idBildformate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `firma` (
  `idFirma` tinyint(4) NOT NULL AUTO_INCREMENT,
  `firmenname` varchar(45) NOT NULL,
  `geschaeftsfuehrer` varchar(45) NOT NULL,
  `strasse` varchar(45) NOT NULL,
  `hausnummer` varchar(45) NOT NULL,
  `plz` varchar(45) NOT NULL,
  `stadt` varchar(45) NOT NULL,
  `telefon` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `mobil` varchar(45) DEFAULT NULL,
  `mail` varchar(45) DEFAULT NULL,
  `steuernummer` varchar(45) NOT NULL,
  `internet` varchar(45) DEFAULT NULL,
  `bankname` varchar(45) DEFAULT NULL,
  `blz` varchar(8) DEFAULT NULL,
  `kontonummer` varchar(11) DEFAULT NULL,
  `agb` text,
  PRIMARY KEY (`idFirma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `fotograf` (
  `idfotograf` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Firma_idFirma` tinyint(4) NOT NULL,
  `vorname` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `loginname` varchar(45) DEFAULT NULL,
  `passwort` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idfotograf`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `fotograf`
--

INSERT INTO `fotograf` (`idfotograf`, `Firma_idFirma`, `vorname`, `name`, `loginname`, `passwort`) VALUES
(1, 1, 'Max', 'Mustermann', 'admin', 'a3b9c163f6c520407ff34cfdb83ca5c6');

-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `gallerien` (
  `idgallerien` int(11) NOT NULL AUTO_INCREMENT,
  `galleriename` varchar(45) NOT NULL,
  `online` tinyint(1) NOT NULL,
  `verfallsdatum` date NOT NULL,
  `bildanzahl` int(11) NOT NULL,
  `nurpreise` tinyint(1) NOT NULL,
  PRIMARY KEY (`idgallerien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

CREATE TABLE IF NOT EXISTS `kunden` (
  `idKunden` int(11) NOT NULL AUTO_INCREMENT,
  `kundennummer` varchar(45) DEFAULT NULL,
  `firma` varchar(45) DEFAULT NULL,
  `vorname` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `strasse` varchar(45) DEFAULT NULL,
  `hausnummer` varchar(45) DEFAULT NULL,
  `plz` varchar(45) DEFAULT NULL,
  `stadt` varchar(45) DEFAULT NULL,
  `telefon` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `loginname` varchar(45) DEFAULT NULL,
  `passwort` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idKunden`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `kunden_has_gallerien` (
  `Kunden_idKunden` int(11) NOT NULL,
  `gallerien_idgallerien` int(11) NOT NULL,
  PRIMARY KEY (`Kunden_idKunden`,`gallerien_idgallerien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `navigation` (
  `idnavigation` int(11) NOT NULL AUTO_INCREMENT,
  `idparent` int(11) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `link` varchar(45) NOT NULL,
  PRIMARY KEY (`idnavigation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

CREATE TABLE IF NOT EXISTS `papier` (
  `idPapier` int(11) NOT NULL AUTO_INCREMENT,
  `papiertyp` varchar(45) NOT NULL,
  PRIMARY KEY (`idPapier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

CREATE TABLE IF NOT EXISTS `preis` (
  `Papier_idPapier` int(11) NOT NULL,
  `Bildformate_idBildformate` int(11) NOT NULL,
  `preis` decimal(5,2) NOT NULL,
  PRIMARY KEY (`Papier_idPapier`,`Bildformate_idBildformate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `rechnung` (
  `idRechnung` int(11) NOT NULL AUTO_INCREMENT,
  `rechnungsnummer` varchar(45) DEFAULT NULL,
  `Kunden_idKunden` int(11) NOT NULL,
  PRIMARY KEY (`idRechnung`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `versandkosten` (
  `idVersandkosten` int(11) NOT NULL AUTO_INCREMENT,
  `versandart` varchar(45) NOT NULL,
  `versandkosten` decimal(5,2) NOT NULL,
  PRIMARY KEY (`idVersandkosten`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `zahlungsart` (
  `idZahlungsart` int(11) NOT NULL AUTO_INCREMENT,
  `zahlungsart` varchar(45) NOT NULL,
  `aktiv` tinyint(1) NOT NULL,
  PRIMARY KEY (`idZahlungsart`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

