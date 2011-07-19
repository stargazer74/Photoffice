<?php
interface bestellungenInterface
{
	public function _hinzufuegen($bestellung);
	public function _setBestellungenAnzahl($neuer_zaehler);
	public function _getBestellungenAnzahl();
	public function _ausgeben();

/**
 * 
 * Adds a Bestellung to the current one
 * @param object $bestellung
 * @return object $bestellung
 */
	public function _addBestellung($bestellung);
	
/**
 * 
 * Subs a Bestellung from the current one
 * @param object $bestellung
 * @return object $bestellung
 */
	public function _subBestellung($bestellung);
	
/**
 * 
 * returns a distinct array of all pictures in the current order
 * @param object $bestellung
 */
	public function _getDistinctPictureArray($bestellung);

}

?>