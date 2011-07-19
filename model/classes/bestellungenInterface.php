<?php
interface bestellungenInterface
{
	public function _hinzufuegen($bestellung);
	public function _setBestellungenAnzahl($neuer_zaehler);
	public function _getBestellungenAnzahl();
	public function _ausgeben();
}

?>