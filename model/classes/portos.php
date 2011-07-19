<?php
require_once ('./model/classes/bildformateInterface.php');


class portos implements portosInterface
{
	private $portos = array();
	private $portosAnzahl;

	public function __construct()
	{

	}

	public function _hinzufuegen($porto)
	{
		$this->_setPortosAnzahl($this->_getPortosAnzahl() + 1);
		$this->portos[$this->_getPortosAnzahl()] = $porto;
		return $this->_getPortosAnzahl();
	}

	public function _setPortosAnzahl($neuer_zaehler)
	{
		$this->portosAnzahl = $neuer_zaehler;
	}

	public function _getPortosAnzahl()
	{
		return $this->portosAnzahl;
	}

	public function _ausgeben()
	{
		$portos = array();
		foreach($this->portos as $value)
		{
			array_push($portos, $value->_ausgeben());
		}
		return $portos;
	}
}
?>