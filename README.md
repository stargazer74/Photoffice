# Photoffice

**Photoffice** ist eine webbasierte Verwaltungssoftware für Fotografen und Fotostudios zur Verwaltung von Fotogalerien, Kunden, Bestellungen und Preislisten.

---

## Inhaltsverzeichnis

- [Funktionsübersicht](#funktionsübersicht)
- [Systemvoraussetzungen](#systemvoraussetzungen)
- [Installation & Konfiguration](#installation--konfiguration)
- [Docker-Setup](#docker-setup)
- [Entwicklung & Tests](#entwicklung--tests)
- [Architektur](#architektur)
- [Lizenz](#lizenz)

---

## Funktionsübersicht

- **Galerie- & Bildverwaltung:** Erstellung und Verwaltung von Online-Galerien für Kunden mit Bild-Upload und Voransichten.
- **Kundenbereich:** Geschützter Zugang für Kunden zur Ansicht von Galerien und Auswahl von Abzügen/Formaten.
- **Bestellabwicklung:** Erfassung und Verwaltung von Fotoaufträgen, Papierformaten und individuellen Preislisten.
- **Fotografen- & Benutzerverwaltung:** Rollen- und Rechteverwaltung für Studioinhaber und Mitarbeiter.

---

## Systemvoraussetzungen

### Laufzeitumgebung & Datenbank
- **PHP**: Version 5.6 (mit Apache-Modul oder CLI)
- **MySQL**: Version 5.7 (Datenbankname standardmäßig: `fotoffice`, Zeichensatz UTF-8)

### Erforderliche PHP-Erweiterungen
- `mysqli` (Datenbanktreiber für PEAR DB)
- `gd` (kompiliert mit FreeType- und JPEG-Unterstützung für Bildverarbeitung/Thumbnails)
- `simplexml` (zum Einlesen von `model/config.xml`)
- `session`, `pcre`, `dom`, `tokenizer`

### Erforderliche PEAR-Pakete
- `DB`
- `HTML_Template_IT` (Template-Engine `HTML/Template/ITX.php`)
- `HTML_QuickForm`
- `Pager`
- `Mail`
- `Event_Dispatcher` (`Event_Dispatcher-beta`)

---

## Installation & Konfiguration

### 1. Repository klonen / herunterladen
```bash
git clone https://github.com/chriswohlbrecht/Photoffice.git
cd Photoffice
```

### 2. Datenbank initialisieren
Die Datenbankstruktur sowie initiale Stammdaten befinden sich in `photoffice.sql`. Importieren Sie die Datei in Ihre MySQL-Datenbank:

```bash
mysql -u root -p fotoffice < photoffice.sql
```

### 3. Konfiguration (`model/config.xml`)
Passen Sie die Datenbankzugangsdaten und Parameter in `model/config.xml` an:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<config>
    <DatabaseServer>localhost</DatabaseServer>
    <DatabaseUser>root</DatabaseUser>
    <DatabasePassphrase>ihr_passwort</DatabasePassphrase>
    <DatabaseName>fotoffice</DatabaseName>
    <SerialNumber></SerialNumber>
    <VersionNumber>1.0.2.1</VersionNumber>
    <XmlRpcString>http://www.photoffice.de/photofficevalidate.html</XmlRpcString>
</config>
```

> **Hinweis für Docker-Umgebungen:** Wenn MySQL in einem separaten Container mit Hostnamen `db` läuft, tragen Sie `<DatabaseServer>db</DatabaseServer>` ein.

---

## Docker-Setup

Für eine einfache lokale Entwicklungsumgebung mit PHP 5.6 und MySQL 5.7 kann Docker verwendet werden:

### Container starten
```bash
docker compose up -d
```

- **Web-Container (`photoffice-web`)**: PHP 5.6 mit Apache und allen erforderlichen PEAR-Paketen/Extensions auf Port `8080`.
- **Datenbank-Container (`photoffice-db`)**: MySQL 5.7 auf Port `3306`.

Die Anwendung ist anschließend unter `http://localhost:8080/` im Browser erreichbar.

---

## Entwicklung & Tests

### Tests ausführen
Da auf modernen Hostsystemen oft neuere PHP-Versionen installiert sind, können Tests direkt im Docker-Webcontainer ausgeführt werden:

```bash
docker exec photoffice-web php /var/www/html/path/to/test.php
```

Alternativ über einen temporären Container im selben Docker-Netzwerk:
```bash
docker run --rm --network photoffice_default -v $(pwd):/var/www/html -w /var/www/html photoffice-web php test.php
```

### HTTP Smoke Tests
Prüfen der Erreichbarkeit der Web-Anwendung:
```bash
curl -i http://localhost:8080/
```

---

## Architektur

Die Anwendung folgt dem MVC-Entwurfsmuster (Model-View-Controller):

- **Einstiegspunkt (`index.php`)**: Initialisiert Session, PEAR-Include-Pfade, lädt Klassen und die XML-Konfiguration via `registry::getInstance()` und startet `main->runApplication()`.
- **Controller (`controller/`)**: Instanziiert Controller über `controller::_controllerFactory($type)` und delegiert Aktionen an `controller/actionbehaviors/`.
- **Modelle (`model/classes/`)**: Domain-Modelle und Collections (`fotograf`, `fotografen`, `kunde`, `kunden`, `bestellung`, `galerie` etc.).
- **Datenbank (`model/classes/DBSINGLETON.php` & `database.php`)**: Singleton-Anbindung über PEAR DB (`mysqli://`).
- **Views & Templates (`view/` & `view/templates/`)**: Anzeige-Logik via `view/showbehaviors/` und Template-Rendering über `HTML_Template_ITX` sowie Formulare mit `HTML_QuickForm`.

---

## Lizenz & Copyright

Photoffice ist freie Software lizenziert unter der **GNU General Public License v3 (GPL-3.0)** (bzw. LGPL für Komponenten).

Copyright (C) 2011 Chris Wohlbrecht.
