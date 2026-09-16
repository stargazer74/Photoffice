<?php
// test_breadcrumb.php

require_once("DB.php");
require_once("./model/classes/registry.php");
$reg = registry::getInstance();
$reg->_initApplicationVariables("./model/config.xml");
require_once("./model/classes/DBSingleton.php");
require_once("./model/classes/database.php");
require_once("./model/classes/breadcrumb.php");

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

// Test 1: Breadcrumb for 'Kunden' returns an array with Home and Kunden
$bcKunden = new breadcrumb('Kunden');
$arrayKunden = $bcKunden->_getBreadcrumbArray();
assertTrue(is_array($arrayKunden), "breadcrumb('Kunden')->_getBreadcrumbArray() returns an array");
assertEquals(array('Home' => 'fotografstart.html', 'Kunden' => 'kunden.html'), $arrayKunden, "breadcrumb('Kunden') contains Home and Kunden entries");

// Test 2: Breadcrumb with NULL returns array with Home
$bcNull = new breadcrumb();
$arrayNull = $bcNull->_getBreadcrumbArray();
assertTrue(is_array($arrayNull), "breadcrumb()->_getBreadcrumbArray() returns an array");
assertEquals(array('Home' => 'fotografstart.html'), $arrayNull, "breadcrumb() returns default Home breadcrumb");

// Test 3: Breadcrumb for 'Galerien'
$bcGalerien = new breadcrumb('Galerien');
$arrayGalerien = $bcGalerien->_getBreadcrumbArray();
assertTrue(is_array($arrayGalerien), "breadcrumb('Galerien')->_getBreadcrumbArray() returns an array");
assertEquals(array('Home' => 'fotografstart.html', 'Galerien' => 'galerien.html'), $arrayGalerien, "breadcrumb('Galerien') contains Home and Galerien entries");

// Test 4: Breadcrumb when database navigation entries exist
$db = DBSINGLETON::_getDBInstance();
if (!DB::isError($db)) {
    // Insert temporary navigation points
    $db->query("INSERT INTO navigation (idnavigation, idparent, name, link) VALUES (100, 0, 'ParentNav', 'parent.html'), (101, 100, 'ChildNav', 'child.html')");

    $bcChild = new breadcrumb('ChildNav');
    $arrayChild = $bcChild->_getBreadcrumbArray();
    assertTrue(is_array($arrayChild), "breadcrumb('ChildNav') with DB entries returns an array");
    assertEquals(array('Home' => 'fotografstart.html', 'ParentNav' => 'parent.html', 'ChildNav' => 'child.html'), $arrayChild, "breadcrumb('ChildNav') resolves hierarchy correctly");

    // Clean up temporary rows
    $db->query("DELETE FROM navigation WHERE idnavigation IN (100, 101)");
}

// Summary
echo "\nTotal Tests: $testsRun | Passed: " . ($testsRun - $failures) . " | Failed: $failures\n";
exit($failures > 0 ? 1 : 0);
