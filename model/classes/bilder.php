<?php
require_once ('./model/classes/bilderInterface.php');


class vielebilder implements bilderInterface 
{
	private $bilder = array();
	private $bilderAnzahl;
	
	public function __construct()
	{
		
	}
	
	public function _hinzufuegen($bild)
	{
		$this->_setBilderAnzahl($this->_getBilderAnzahl() + 1);
		$this->bilder[$this->_getBilderAnzahl()] = $bild;
		return $this->_getBilderAnzahl();
	}
	
	public function _setBilderAnzahl($neuer_zaehler)
	{
		$this->bilderAnzahl = $neuer_zaehler;
	}
	
	public function _getBilderAnzahl()
	{
		return $this->bilderAnzahl;
	}
	
	public function _ausgeben()
	{
		$bilder = array();
		foreach($this->bilder as $value)
		{
			array_push($bilder, $value->_ausgeben());
		}
		return $bilder;
	}
}
?>