<?php

interface preiseInterface
{
	public function _hinzufuegen($preis);
	public function _setPreiseAnzahl($neuer_zaehler);
	public function _getPreiseAnzahl();
	public function _ausgeben();
}

?>