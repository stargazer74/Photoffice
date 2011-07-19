<?php
require_once ('./model/classes/kundenInterface.php');


class allekunden implements kundenInterface
{
	private $kunden = array();
	private $kundenAnzahl;
	
	public function __construct()
	{
		
	}
	
	public function _hinzufuegen($kunde)
	{
		$this->_setKundenAnzahl($this->_getKundenAnzahl() + 1);
		$this->kunden[$this->_getKundenAnzahl()] = $kunde;
		return $this->_getKundenAnzahl();
	}
	
	public function _setKundenAnzahl($neuer_zaehler)
	{
		$this->kundenAnzahl = $neuer_zaehler;
	}
	
	public function _getKundenAnzahl()
	{
		return $this->kundenAnzahl;
	}
	
	public function _ausgeben()
	{
		$kunden = array();
		foreach($this->kunden as $value)
		{
			array_push($kunden, $value->_ausgeben());
		}
		return $kunden;
	}
}
?>