<?php
require_once ('./model/classes/galerienInterface.php');


class galerien implements galerienInterface 
{
	private $galerien = array();
	private $galerienAnzahl;
	
	public function __construct()
	{
		
	}
	
	public function _hinzufuegen($galerie)
	{
		$this->_setGalerienAnzahl($this->_getGalerienAnzahl() + 1);
		$this->galerien[$this->_getGalerienAnzahl()] = $galerie;
		return $this->_getGalerienAnzahl();
	}
	
	public function _setGalerienAnzahl($neuer_zaehler)
	{
		$this->galerienAnzahl = $neuer_zaehler;
	}
	
	public function _getGalerienAnzahl()
	{
		return $this->galerienAnzahl;
	}
	
	public function _ausgeben()
	{
		$galerien = array();
		foreach($this->galerien as $value)
		{
			array_push($galerien, $value->_ausgeben());
		}
		return $galerien;
	}
}
?>