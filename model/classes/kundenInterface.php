<?php
interface kundenInterface
{
	public function _hinzufuegen($kunde);
	public function _setKundenAnzahl($neuer_zaehler);
	public function _getKundenAnzahl();
	public function _ausgeben();	
}
?>