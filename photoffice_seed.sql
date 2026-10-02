-- Beispieldaten für die lokale Entwicklung.
-- Wird von MySQL beim ersten Start des Containers automatisch ausgeführt
-- (docker-entrypoint-initdb.d), sofern das db_data-Volume noch leer ist.
--
-- Jedes Init-Skript läuft als eigene mysql-Client-Session ohne den Charset
-- aus photoffice.sql - ohne dieses SET NAMES würden Umlaute/Sonderzeichen
-- hier doppelt UTF-8-kodiert (Mojibake) abgespeichert.
SET NAMES utf8;

-- Firmenstammdaten (wird u.a. von company::_getInstance() benötigt).
-- Das agb-Feld wird 1:1 als HTML in kundeagb.tpl ausgegeben (siehe
-- view/showbehaviors/kundeagb_show_behavior.php), daher hier einfache
-- <p>-Absätze statt reinem Text.
INSERT INTO `firma` (`idFirma`, `firmenname`, `geschaeftsfuehrer`, `strasse`, `hausnummer`, `plz`, `stadt`, `telefon`, `fax`, `mobil`, `mail`, `steuernummer`, `internet`, `bankname`, `blz`, `kontonummer`, `agb`) VALUES
(1, 'Photoffice Demo GmbH', 'Max Mustermann', 'Musterstraße', '1', '12345', 'Musterstadt', '0123 456789', NULL, NULL, 'info@photoffice.de', 'DE123456789', 'www.photoffice.de', NULL, NULL, NULL,
'<p><strong>1. Geltungsbereich</strong><br>Diese allgemeinen Geschäftsbedingungen gelten für alle Bestellungen von Fotoabzügen und Bildprodukten über dieses Kundenportal.</p>
<p><strong>2. Vertragsschluss</strong><br>Mit Absenden der Bestellung gibt der Kunde ein verbindliches Angebot zum Kauf der ausgewählten Bilder ab. Der Vertrag kommt mit Bestätigung der Bestellung durch den Fotografen zustande.</p>
<p><strong>3. Preise und Versand</strong><br>Es gelten die zum Zeitpunkt der Bestellung in der Preisliste ausgewiesenen Preise zzgl. der angegebenen Versandkosten.</p>
<p><strong>4. Widerrufsrecht</strong><br>Da es sich um individuell angefertigte Produkte handelt, ist ein Widerruf nach Produktionsbeginn ausgeschlossen.</p>
<p><strong>5. Nutzungsrechte</strong><br>Die Bildrechte verbleiben beim Fotografen. Der Kunde erwirbt lediglich das Recht auf die bestellten Abzüge zum privaten Gebrauch.</p>');

-- Weitere Beispiel-Fotografen (idfotograf=1 "Max Mustermann" / Login "admin"
-- kommt bereits aus photoffice.sql). Login-Passwort jeweils wie angegeben.
INSERT INTO `fotograf` (`idfotograf`, `Firma_idFirma`, `vorname`, `name`, `loginname`, `passwort`) VALUES
(2, 1, 'Julia', 'Berger', 'julia', MD5('julia2026')),
(3, 1, 'Tom', 'Klein', 'tom', MD5('tom2026'));

-- Papierarten und Bildformate für die Preisliste
INSERT INTO `papier` (`idPapier`, `papiertyp`) VALUES
(1, 'Glänzend'),
(2, 'Matt');

INSERT INTO `bildformate` (`idBildformate`, `bildformat`) VALUES
(1, '10x15'),
(2, '13x18'),
(3, '15x20'),
(4, '20x30');

-- Preis je Kombination aus Papierart und Bildformat
INSERT INTO `preis` (`Papier_idPapier`, `Bildformate_idBildformate`, `preis`) VALUES
(1, 1, 0.29), (1, 2, 0.49), (1, 3, 0.99), (1, 4, 2.99),
(2, 1, 0.35), (2, 2, 0.59), (2, 3, 1.19), (2, 4, 3.49);

-- Zahlungs- und Versandarten (werden u.a. beim Bestellabschluss benötigt)
INSERT INTO `zahlungsart` (`idZahlungsart`, `zahlungsart`, `aktiv`) VALUES
(1, 'Rechnung', 1),
(2, 'PayPal', 1),
(3, 'Vorkasse', 1),
(4, 'Nachnahme', 0);

INSERT INTO `versandkosten` (`idVersandkosten`, `versandart`, `versandkosten`) VALUES
(1, 'Standardversand', 4.95),
(2, 'Expressversand', 9.95);

-- Beispiel-Galerie mit ID 28 - passt zu den bereits vorhandenen Fotos unter
-- view/images/galeriebilder/28/
INSERT INTO `gallerien` (`idgallerien`, `galleriename`, `online`, `verfallsdatum`, `bildanzahl`, `nurpreise`) VALUES
(28, 'Hochzeit Schmidt', 1, '2026-12-31', 6, 0);

-- Beispiel-Kunden.
-- WICHTIG: Das Kundenlogin (kundenlogin.html) fragt NUR ein Passwort ab -
-- kundenlogincheck::_chkKundenLogin() sucht anhand des Passworts allein den
-- passenden Kunden (kein Benutzername/E-Mail-Abgleich). Bei identischen
-- Passwörtern würde daher immer der zuletzt gefundene Treffer gewinnen -
-- deshalb bekommt hier jeder Kunde ein eigenes Passwort.
INSERT INTO `kunden` (`idKunden`, `kundennummer`, `firma`, `vorname`, `name`, `strasse`, `hausnummer`, `plz`, `stadt`, `telefon`, `email`, `loginname`, `passwort`) VALUES
(1, 'K-1001', NULL, 'Anna', 'Schmidt', 'Beispielweg', '12', '54321', 'Beispielhausen', '0170 1234567', 'anna.schmidt@example.com', 'anna.schmidt@example.com', MD5('anna2026')),
(2, 'K-1002', NULL, 'Thomas', 'Schmidt', 'Beispielweg', '12', '54321', 'Beispielhausen', '0170 1234568', 'thomas.schmidt@example.com', 'thomas.schmidt@example.com', MD5('thomas2026')),
(3, 'K-1003', NULL, 'Laura', 'Meier', 'Musterallee', '7', '60313', 'Frankfurt am Main', '0171 2345678', 'laura.meier@example.com', 'laura.meier@example.com', MD5('laura2026')),
(4, 'K-1004', 'Wagner Immobilien GmbH', 'Peter', 'Wagner', 'Industriering', '3', '70173', 'Stuttgart', '0172 3456789', 'peter.wagner@example.com', 'peter.wagner@example.com', MD5('peter2026'));

-- Galerie 28 den Kunden zuordnen, die auf sie zugreifen dürfen
-- (Anna und Thomas Schmidt teilen sich hier z.B. dieselbe Hochzeitsgalerie,
-- Laura und Peter haben aktuell keine Galerie zugewiesen)
INSERT INTO `kunden_has_gallerien` (`Kunden_idKunden`, `gallerien_idgallerien`) VALUES
(1, 28),
(2, 28);

-- Bilder der Galerie 28 - verweisen auf die bereits im Repo liegenden JPGs
INSERT INTO `bild` (`idBild`, `position`, `fotograf_idfotograf`, `gallerien_idgallerien`, `bildname`, `iconname`, `online`, `blende`, `belichtungszeit`, `brennweite`, `iso`, `blitz`, `marke`, `model`, `aufnahmezeitpunkt`, `aenderungszeit`) VALUES
(1, 1, 1, 28, '_MG_2736.JPG', '_MG_2736_icon.JPG', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 2, 1, 28, '_MG_3405.JPG', '_MG_3405_icon.JPG', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 3, 1, 28, '_MG_3483.JPG', '_MG_3483_icon.JPG', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, 1, 28, '_MG_3593.JPG', '_MG_3593_icon.JPG', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, 1, 28, '_MG_3716.JPG', '_MG_3716_icon.JPG', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 6, 1, 28, '_MG_3733.JPG', '_MG_3733_icon.JPG', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
