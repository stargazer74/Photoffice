<?php
require_once ('./model/classes/papierformateInterface.php');


class papierformate implements papierformateInterface 
{
	private $papierFormate = array();
	private $papierFormateAnzahl;
	
	public function __construct()
	{
		
	}
	
	public function _hinzufuegen($papierformat)
	{
		$this->_setPapierFormateAnzahl($this->_getPapierFormateAnzahl() + 1);
		$this->papierFormate[$this->_getPapierFormateAnzahl()] = $papierformat;
		return $this->_getPapierFormateAnzahl();
	}
	
	public function _setpapierFormateAnzahl($neuer_zaehler)
	{
		$this->papierFormateAnzahl = $neuer_zaehler;
	}
	
	public function _getPapierFormateAnzahl()
	{
		return $this->papierFormateAnzahl;
	}
	
	public function _ausgeben()
	{
		$papierformate = array();
		foreach($this->papierFormate as $value)
		{
			array_push($papierformate, $value->_ausgeben());
		}
		return $papierformate;
	}
}
?>