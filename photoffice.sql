-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 30. Mai 2010 um 21:50
-- Server Version: 5.1.41
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `fotoffice`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung`
--

CREATE TABLE IF NOT EXISTS `bestellung` (
  `idBestellung` int(11) NOT NULL AUTO_INCREMENT,
  `Kunden_idKunden` int(11) NOT NULL,
  `datum` datetime NOT NULL,
  `kundeabgeschlossen` tinyint(1) DEFAULT NULL,
  `fotografabgeschlossen` tinyint(1) DEFAULT NULL,
  `bestellwert` decimal(5,2) NOT NULL,
  `anmerkung` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`idBestellung`),
  KEY `fk_Bestellung_Kunden1` (`Kunden_idKunden`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Daten für Tabelle `bestellung`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bestellung_has_bild`
--

CREATE TABLE IF NOT EXISTS `bestellung_has_bild` (
  `Bild_idBild` int(11) NOT NULL,
  `Bestellung_idBestellung` int(11) NOT NULL,
  `Anzahl` int(11) NOT NULL,
  `Preis_Papier_idPapier` int(11) NOT NULL,
  `Preis_Bildformate_idBildformate` int(11) NOT NULL,
  PRIMARY KEY (`Bild_idBild`,`Bestellung_idBestellung`,`Preis_Papier_idPapier`,`Preis_Bildformate_idBildformate`),
  KEY `fk_Bild_has_Bestellung_Bild1` (`Bild_idBild`),
  KEY `fk_Bild_has_Bestellung_Bestellung1` (`Bestellung_idBestellung`),
  KEY `fk_Bestellung_has_Bild_Preis1` (`Preis_Papier_idPapier`,`Preis_Bildformate_idBildformate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `bestellung_has_bild`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bild`
--

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
  PRIMARY KEY (`idBild`),
  KEY `fk_Bild_fotograf1` (`fotograf_idfotograf`),
  KEY `fk_Bild_galerien1` (`gallerien_idgallerien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=258 ;

--
-- Daten für Tabelle `bild`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bildformate`
--

CREATE TABLE IF NOT EXISTS `bildformate` (
  `idBildformate` int(11) NOT NULL AUTO_INCREMENT,
  `bildformat` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idBildformate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `bildformate`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `firma`
--

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
  `mail` varchar(45) NOT NULL,
  `steuernummer` varchar(45) NOT NULL,
  `internet` varchar(45) DEFAULT NULL,
  `bankname` varchar(45) DEFAULT NULL,
  `blz` varchar(8) DEFAULT NULL,
  `kontonummer` varchar(11) DEFAULT NULL,
  `agb` text,
  PRIMARY KEY (`idFirma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `firma`
--

INSERT INTO `firma` (`idFirma`, `firmenname`, `geschaeftsfuehrer`, `strasse`, `hausnummer`, `plz`, `stadt`, `telefon`, `fax`, `mobil`, `mail`, `steuernummer`, `internet`, `bankname`, `blz`, `kontonummer`, `agb`) VALUES
(1, 'Musterfirma', 'Maria Muster', 'Hauptstr.', '1', '01234', 'Musterstadt', '', '', '', 'muster@muster.de', 'muster', '', '', '', '', '<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.&nbsp; &nbsp;<br /><br />Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.&nbsp; &nbsp;<br /><br />Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi.&nbsp; &nbsp;<br /><br />Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.&nbsp; &nbsp;<br /><br />Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis.&nbsp; &nbsp;<br /><br />At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, At accusam aliquyam diam diam dolore dolores duo eirmod eos erat, et nonumy sed tempor et et invidunt justo labore Stet clita ea et gubergren, kasd magna no rebum. sanctus sea sed takimata ut vero voluptua. est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur</p>');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fotograf`
--

CREATE TABLE IF NOT EXISTS `fotograf` (
  `idfotograf` tinyint(4) NOT NULL AUTO_INCREMENT,
  `Firma_idFirma` tinyint(4) NOT NULL,
  `vorname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `loginname` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passwort` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idfotograf`),
  KEY `fk_fotograf_Firma1` (`Firma_idFirma`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `fotograf`
--

INSERT INTO `fotograf` (`idfotograf`, `Firma_idFirma`, `vorname`, `name`, `loginname`, `passwort`) VALUES
(1, 1, 'Max', 'Mustermann', 'admin', 'a3b9c163f6c520407ff34cfdb83ca5c6');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `gallerien`
--

CREATE TABLE IF NOT EXISTS `gallerien` (
  `idgallerien` int(11) NOT NULL AUTO_INCREMENT,
  `galleriename` varchar(45) NOT NULL,
  `online` tinyint(1) NOT NULL,
  `verfallsdatum` date NOT NULL,
  `bildanzahl` int(11) NOT NULL,
  `Kunden_idKunden` int(11) NOT NULL,
  `nurpreise` tinyint(1) NOT NULL,
  PRIMARY KEY (`idgallerien`),
  KEY `fk_gallerien_Kunden1` (`Kunden_idKunden`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

--
-- Daten für Tabelle `gallerien`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `kunden`
--

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
  `passwort` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idKunden`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Daten für Tabelle `kunden`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `navigation`
--

CREATE TABLE IF NOT EXISTS `navigation` (
  `idnavigation` int(11) NOT NULL AUTO_INCREMENT,
  `idparent` int(11) NOT NULL DEFAULT '0',
  `name` varchar(45) NOT NULL,
  `link` varchar(45) NOT NULL,
  PRIMARY KEY (`idnavigation`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `navigation`
--

INSERT INTO `navigation` (`idnavigation`, `idparent`, `name`, `link`) VALUES
(1, 0, 'Galerien', 'bilder.html'),
(3, 0, 'Kunden', 'kunden.html'),
(4, 0, 'Firmendaten', 'firmendaten.html'),
(5, 0, 'Bilder', 'allekundengalerien.html'),
(6, 0, 'Preisliste', 'preisliste.html'),
(7, 0, 'AGB', 'kundeagb.html'),
(8, 0, 'Bestellungen', 'bestellungsliste.html');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `papier`
--

CREATE TABLE IF NOT EXISTS `papier` (
  `idPapier` int(11) NOT NULL AUTO_INCREMENT,
  `papiertyp` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idPapier`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Daten für Tabelle `papier`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `preis`
--

CREATE TABLE IF NOT EXISTS `preis` (
  `Papier_idPapier` int(11) NOT NULL,
  `Bildformate_idBildformate` int(11) NOT NULL,
  `preis` decimal(5,2) NOT NULL,
  PRIMARY KEY (`Papier_idPapier`,`Bildformate_idBildformate`),
  KEY `fk_Preis_Papier1` (`Papier_idPapier`),
  KEY `fk_Preis_Bildformate1` (`Bildformate_idBildformate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `preis`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `rechnung`
--

CREATE TABLE IF NOT EXISTS `rechnung` (
  `idRechnung` int(11) NOT NULL AUTO_INCREMENT,
  `rechnungsnummer` varchar(45) DEFAULT NULL,
  `Kunden_idKunden` int(11) NOT NULL,
  PRIMARY KEY (`idRechnung`),
  KEY `fk_Rechnung_Kunden1` (`Kunden_idKunden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Daten für Tabelle `rechnung`
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
