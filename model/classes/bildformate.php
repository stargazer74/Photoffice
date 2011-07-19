<?php
require_once ('./model/classes/bildformateInterface.php');


class bildformate implements bildformateInterface 
{
	private $bildFormate = array();
	private $bildFormateAnzahl;
	
	public function __construct()
	{
		
	}
	
	public function _hinzufuegen($bildformat)
	{
		$this->_setBildFormateAnzahl($this->_getBildFormateAnzahl() + 1);
		$this->bildFormate[$this->_getBildFormateAnzahl()] = $bildformat;
		return $this->_getBildFormateAnzahl();
	}
	
	public function _setBildFormateAnzahl($neuer_zaehler)
	{
		$this->bildFormateAnzahl = $neuer_zaehler;
	}
	
	public function _getBildFormateAnzahl()
	{
		return $this->bildFormateAnzahl;
	}
	
	public function _ausgeben()
	{
		$bildformate = array();
		foreach($this->bildFormate as $value)
		{
			array_push($bildformate, $value->_ausgeben());
		}
		return $bildformate;
	}
}
?>