# Photoffice

**Photoffice** ist eine webbasierte Verwaltungssoftware für Fotografen und Fotostudios zur Verwaltung von Fotogalerien, Kunden, Bestellungen und Preislisten.

---

## Inhaltsverzeichnis

- [Funktionsübersicht](#funktionsübersicht)
- [Systemvoraussetzungen](#systemvoraussetzungen)
- [Installation & Konfiguration](#installation--konfiguration)
- [Docker-Setup](#docker-setup)
- [Schnellstart mit Demo-Daten](#schnellstart-mit-demo-daten)
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
- **phpMyAdmin-Container (`photoffice-phpmyadmin`)**: phpMyAdmin auf Port `8081` zur Datenbankverwaltung.

Die Anwendung ist anschließend unter `http://localhost:8080/` und phpMyAdmin unter `http://localhost:8081/` im Browser erreichbar.

Beim ersten Start legt der `db`-Container die Datenbank `fotoffice` an und führt dabei automatisch alle Skripte aus `docker-entrypoint-initdb.d` aus:

1. `photoffice.sql` – Datenbankstruktur inkl. Admin-Login `admin` / `password`.
2. `photoffice_seed.sql` – Demo-/Beispieldaten (Firma, weitere Fotografen, Kunden, Preisliste, Beispielgalerie).

> **Hinweis:** Die Init-Skripte laufen nur, wenn das Volume `db_data` noch leer ist. Wurde der Container bereits zuvor gestartet, müssen Sie das Volume zurücksetzen, um die Demo-Daten neu einzuspielen (siehe [Schnellstart mit Demo-Daten](#schnellstart-mit-demo-daten)).

---

## Schnellstart mit Demo-Daten

Mit `photoffice_seed.sql` steht eine vollständige Demo-Umgebung zur Verfügung, mit der sich die Anwendung direkt nach dem Start ausprobieren lässt – ohne eigene Daten anlegen zu müssen.

### Umgebung frisch aufsetzen

Damit die Demo-Daten eingespielt werden, darf das Datenbank-Volume noch nicht existieren bzw. muss vorher entfernt werden:

```bash
docker compose down -v   # entfernt auch das db_data-Volume
docker compose up -d
```

Anschließend ist die Anwendung unter `http://localhost:8080/` erreichbar.

### Fotografen-/Admin-Login

Zugang für die Studio-/Backend-Verwaltung unter `http://localhost:8080/` (Login-Formular `view/public/login.php`):

| Benutzer | Login       | Passwort     |
|----------|-------------|--------------|
| Admin    | `admin`     | `password`   |
| Julia    | `julia`     | `julia2026`  |
| Tom      | `tom`       | `tom2026`    |

### Kunden-Login (Kundenportal)

Das Kundenportal (`kundenlogin.html`) fragt **ausschließlich ein Passwort** ab (keine Benutzername-/E-Mail-Prüfung) – der passende Kunde wird anhand des Passworts ermittelt:

| Kunde            | Passwort       | Zugriff auf Galerie         |
|-------------------|---------------|------------------------------|
| Anna Schmidt      | `anna2026`    | Galerie 28 „Hochzeit Schmidt“ |
| Thomas Schmidt     | `thomas2026`  | Galerie 28 „Hochzeit Schmidt“ |
| Laura Meier        | `laura2026`   | keine Galerie zugewiesen     |
| Peter Wagner       | `peter2026`   | keine Galerie zugewiesen     |

### Enthaltene Demo-Inhalte

- **Firma:** „Photoffice Demo GmbH“ inkl. Beispiel-AGB.
- **Fotografen:** `admin` (aus `photoffice.sql`) sowie `julia` und `tom` (aus dem Seed).
- **Beispielgalerie:** Galerie 28 „Hochzeit Schmidt“ mit 6 Beispielbildern aus `view/images/galeriebilder/28/`.
- **Kunden:** 4 Beispielkunden, davon 2 mit Zugriff auf die Beispielgalerie.
- **Preisliste:** Papierarten (Glänzend/Matt) × Bildformate (10x15 bis 20x30) mit Preisen.
- **Zahlungs- und Versandarten:** Rechnung, PayPal, Vorkasse (Nachnahme deaktiviert), Standard- und Expressversand.

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
