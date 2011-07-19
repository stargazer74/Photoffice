<?php
require_once ('./model/classes/bestellungenInterface.php');


class bestellungen implements bestellungenInterface 
{
	private $bestellungen = array();
	private $bestellungenAnzahl;
	
	public function __construct()
	{
		
	}
	
	public function _hinzufuegen($bestellung)
	{
		$this->_setBestellungenAnzahl($this->_getBestellungenAnzahl() + 1);
		$this->bestellungen[$this->_getBestellungenAnzahl()] = $bestellung;
		return $this->_getBestellungenAnzahl();
	}
	
	public function _setBestellungenAnzahl($neuer_zaehler)
	{
		$this->bestellungenAnzahl = $neuer_zaehler;
	}
	
	public function _getBestellungenAnzahl()
	{
		return $this->bestellungenAnzahl;
	}
	
	public function _ausgeben()
	{
		$bestellungen = array();
		foreach($this->bestellungen as $value)
		{
			array_push($bestellungen, $value->_ausgeben());
		}
		return $bestellungen;
	}
}
?>