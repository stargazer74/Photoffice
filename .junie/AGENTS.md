# Photoffice Developer Guidelines

This document contains essential project-specific information for developers working on the Photoffice codebase.

---

## 1. Build and Environment Configuration

### Technology Stack & Requirements
- **Runtime**: PHP 5.6 (Apache module or CLI). Note: The codebase relies on PHP 5.6 features and legacy behaviors (such as `session_register`, PEAR package APIs, and PHP 5 OOP model).
- **Database**: MySQL 5.7 (database name: `fotoffice`, default character set UTF-8).
- **Required PHP Extensions**:
  - `mysqli` (database driver used by PEAR DB)
  - `gd` (compiled with FreeType and JPEG support for image processing)
  - `simplexml` (used for loading `model/config.xml`)
  - `session`, `pcre`, `dom`, `tokenizer`
- **Required PEAR Packages**:
  - `DB` (database abstraction layer)
  - `HTML_Template_IT` (provides `HTML/Template/ITX.php` template engine)
  - `HTML_QuickForm` (provides form handling and `HTML/QuickForm/Renderer/ITStatic.php`)
  - `Pager` (pagination component)
  - `Mail` (mail delivery helper)
  - `Event_Dispatcher` (`Event_Dispatcher-beta`)

### Application Configuration (`model/config.xml`)
The application reads its runtime database connection parameters and licensing information from `model/config.xml`:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<config>
    <DatabaseServer>db</DatabaseServer>
    <DatabaseUser>root</DatabaseUser>
    <DatabasePassphrase>root</DatabasePassphrase>
    <DatabaseName>fotoffice</DatabaseName>
    <SerialNumber></SerialNumber>
    <VersionNumber>1.0.2.1</VersionNumber>
    <XmlRpcString>http://www.photoffice.de/photofficevalidate.html</XmlRpcString>
</config>
```
*Note: In local Docker environments where MySQL runs in a container named `db` or `photoffice-db`, set `<DatabaseServer>` to `db`.*

### Database Initialization
The database schema and initial seed data are located in `photoffice.sql`.
To import the schema:
```bash
mysql -u root -p fotoffice < photoffice.sql
```

### Docker Setup Reference
When running containerized services with Docker / Docker Compose:
- **Web Container (`photoffice-web`)**: Uses PHP 5.6 with Apache, with PEAR packages and extensions installed, binding project root to `/var/www/html` and exposing port `8080`.
- **Database Container (`photoffice-db`)**: MySQL 5.7 with initial volume mounting `photoffice.sql` to `/docker-entrypoint-initdb.d/photoffice.sql`, exposing port `3306`.
- **Network**: Both containers connect on the same bridge network (e.g., `photoffice_default`) so `photoffice-web` can resolve the database host `db`.

To start containers via Docker Compose:
```bash
docker compose up -d
```

---

## 2. Testing Guidelines

### Running Tests
Because the host environment may not have PHP 5.6 and PEAR packages installed natively, execute tests inside the Docker PHP container or ephemeral container connected to the Docker network.

#### Option A: Running tests in the existing `photoffice-web` container
```bash
docker exec photoffice-web php /var/www/html/path/to/test.php
```

#### Option B: Running tests in a one-off container attached to the project network
```bash
docker run --rm --network photoffice_default -v $(pwd):/var/www/html -w /var/www/html photoffice-web php test.php
```

### Writing and Adding New Tests
When adding new unit or integration tests, follow this standalone runner structure:

```php
<?php
// Example: test_example.php

// Include necessary models and dependencies
require_once("./model/classes/string.php");
require_once("./model/classes/datum.php");
require_once("./model/classes/abstractfotografen.php");
require_once("./model/classes/fotograf.php");
require_once("./model/classes/fotografen.php");

$failures = 0;
$testsRun = 0;

function assertTrue($condition, $message) {
    global $testsRun, $failures;
    $testsRun++;
    if ($condition) {
        echo "[PASS] $message\n";
    } else {
        echo "[FAIL] $message\n";
        $failures++;
    }
}

function assertEquals($expected, $actual, $message) {
    global $testsRun, $failures;
    $testsRun++;
    if ($expected === $actual) {
        echo "[PASS] $message\n";
    } else {
        echo "[FAIL] $message (Expected: " . var_export($expected, true) . ", Got: " . var_export($actual, true) . ")\n";
        $failures++;
    }
}

// --- Unit Tests: Helper Methods ---
$randomStr = string::genRandomString(16);
assertEquals(16, strlen($randomStr), "string::genRandomString(16) creates 16-char string");

assertEquals("19.90", string::genPreisString("19.9"), "string::genPreisString formats trailing decimal zero");

assertEquals("16.09.2026", datum::_changeDateFormat("de", "2026-09-16"), "datum::_changeDateFormat transforms ISO to German date");

// --- Unit Tests: OOP Model Collections & Iteration ---
$fotograf = new fotograf(1, 10, "Max", "Mustermann", "admin", "secret_hash");
$fotografen = new fotografen();
$fotografen->_hinzufuegen($fotograf);
assertEquals(1, $fotografen->_getFotografenAnzahl(), "fotografen collection increments count");

$list = $fotografen->_ausgeben();
assertEquals("Max", $list[0]['vorname'], "fotograf attribute matches stored value");

// --- Integration Tests: Database Connectivity ---
require_once("DB.php");
$db = DB::connect('mysqli://root:root@db/fotoffice');
assertTrue(!DB::isError($db), "PEAR DB connection to MySQL container succeeded");

if (!DB::isError($db)) {
    $res = $db->query("SELECT loginname FROM fotograf WHERE idfotograf = 1");
    assertTrue(!DB::isError($res), "Query fotograf table returns successful result");
    $row = $res->fetchRow(DB_FETCHMODE_ASSOC);
    assertEquals("admin", $row['loginname'], "Default photographer loginname is 'admin'");
}

// --- Test Summary ---
echo "\nTotal Tests: $testsRun | Passed: " . ($testsRun - $failures) . " | Failed: $failures\n";
exit($failures > 0 ? 1 : 0);
```

### Verifying Web Endpoints (HTTP Smoke Tests)
You can verify the HTTP response of the running Apache instance using `curl`:
```bash
curl -i http://localhost:8080/
```

---

## 3. Architecture & Code Style Conventions

### MVC Architecture
- **Entry Point**: `index.php` initializes sessions, configures PEAR include paths, imports all controller/model/view classes, loads XML configuration via `registry::getInstance()`, and calls `main->runApplication()`.
- **Controllers (`controller/`)**:
  - Central factory: `controller::_controllerFactory($type)` dynamically instantiates controller classes based on `$_REQUEST['controller']` or user session state (`kundendefaultcontroller` vs `defaultcontroller`).
  - Action delegation: Controllers delegate business logic to action behaviors in `controller/actionbehaviors/` via `$this->actionBehaviorObject->_action()`.
- **Models (`model/classes/`)**:
  - Domain models utilize inheritance and interfaces (`abstractfotografen`, `fotograf`, `fotografen`, `abstractkunden`, `kunde`, `kunden`, `abstractbestellungen`, `bestellung`, `bestellungen`, `papierformat`, `bildformat`, `galerie`).
  - Collection classes implement collection storage and `_ausgeben()` array serialization.
  - Entity classes implement `Iterator` for attribute traversal.
  - `database.php` provides generic query helpers (`_select`, `_getFotografen`, `_getPreise`, `_getGalerien`, etc.).
  - `DBSINGLETON.php` maintains a singleton instance of PEAR DB connection configured with DSN `"mysqli://" . $user . ":" . $pass . "@" . $host . "/" . $db_name`.
  - `registry.php` maintains the singleton application state and XML configuration parameters.
- **Views & Templates (`view/` & `view/templates/`)**:
  - Views delegate display logic to show behaviors (`view/showbehaviors/`).
  - Template rendering uses PEAR `HTML_Template_ITX` and form generation via `HTML_QuickForm`.

### Code Style & Naming Conventions
- **Language**: Domain models, variables, methods, and comments use German terminology (e.g., `kunde`, `fotograf`, `galerie`, `bestellung`, `papierformat`, `bildformat`, `firmendaten`).
- **Method Prefixing**: Internal class methods, action methods, and collection manipulators frequently use a leading underscore (e.g., `_hinzufuegen()`, `_ausgeben()`, `_tuaction()`, `_select()`, `_initApplicationVariables()`, `_changeDateFormat()`).
- **Object Access**: Avoid PHP 7+ syntax (such as null coalescing operator `??`, return type declarations, anonymous classes) to ensure compatibility with PHP 5.6.
- **File Inclusions**: Use relative paths from project root or ensure include paths are configured via `ini_set("include_path", ...)`.
