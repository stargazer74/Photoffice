<?php
require_once ('./model/classes/fotografenInterface.php');


class fotografen implements fotografenInterface 
{
	private $fotografen = array();
	private $fotografenAnzahl;
	
	public function __construct()
	{
		
	}
	
	public function _hinzufuegen($fotograf)
	{
		$this->_setFotografenAnzahl($this->_getFotografenAnzahl() + 1);
		$this->fotografen[$this->_getFotografenAnzahl()] = $fotograf;
		return $this->_getFotografenAnzahl();
	}
	
	public function _setFotografenAnzahl($neuer_zaehler)
	{
		$this->fotografenAnzahl = $neuer_zaehler;
	}
	
	public function _getFotografenAnzahl()
	{
		return $this->fotografenAnzahl;
	}
	
	public function _ausgeben()
	{
		$fotografen = array();
		foreach($this->fotografen as $value)
		{
			array_push($fotografen, $value->_ausgeben());
		}
		return $fotografen;
	}
}
?>