<?php

interface zahlungsartenInterface
{
	public function _hinzufuegen($zahlungsart);
	public function _setZahlungsartenAnzahl($neuer_zaehler);
	public function _getZahlungsartenAnzahl();
	public function _ausgeben();
}

?>