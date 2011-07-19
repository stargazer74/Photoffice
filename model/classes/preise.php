<?php
require_once ('./model/classes/preiseInterface.php');


class preise implements preiseInterface 
{
	private $preise = array();
	private $preiseAnzahl;
	
	public function __construct()
	{
		
	}
	
	public function _hinzufuegen($preis)
	{
		$this->_setPreiseAnzahl($this->_getPreiseAnzahl() + 1);
		$this->preise[$this->_getPreiseAnzahl()] = $preis;
		return $this->_getPreiseAnzahl();
	}
	
	public function _setPreiseAnzahl($neuer_zaehler)
	{
		$this->preiseAnzahl = $neuer_zaehler;
	}
	
	public function _getPreiseAnzahl()
	{
		return $this->preiseAnzahl;
	}
	
	public function _ausgeben()
	{
		$preise = array();
		foreach($this->preise as $value)
		{
			array_push($preise, $value->_ausgeben());
		}
		return $preise;
	}
}
?>