<?php
require_once ('./model/classes/bestellungenInterface.php');


class bestellung extends abstractbestellungen implements bestellungenInterface 
{
	protected $iteratorEigenschaften = array('id', 'idkunde', 'datum', 'kundeabgeschlossen', 'fotografabgeschlossen', 'bestellwert', 'bilder', 'anmerkung');
	
	public function __construct($id = null, $idkunde = null, $datum = null, $kundeabgeschlossen = null, $fotografabgeschlossen = null, $bestellwert = null, $bilder = null, $anmerkung = null)
	{
		$this->id						= $id;
		$this->idkunde					= $idkunde;
		$this->datum 					= $datum;
		$this->kundeabgeschlossen		= $kundeabgeschlossen;
		$this->fotografabgeschlossen	= $fotografabgeschlossen;
		$this->bestellwert 				= $bestellwert;
		$this->bilder 					= $bilder;
		$this->anmerkung				= $anmerkung;
	}
	
	public function _hinzufuegen($preis)
	{
		return false;
	}
	
	public function _setPreiseAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getPreiseAnzahl()
	{
		return false;
	}
}
?>