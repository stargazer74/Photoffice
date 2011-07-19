<?php
require_once ('./model/classes/zahlungsartenInterface.php');


class zahlungsarten implements zahlungsartenInterface
{
	private $zahlungsarten = array();
	private $zahlungsartenAnzahl;

	public function __construct()
	{

	}

	public function _hinzufuegen($zahlungsart)
	{
		$this->_setZahlungsartenAnzahl($this->_getZahlungsartenAnzahl() + 1);
		$this->zahlungsarten[$this->_getZahlungsartenAnzahl()] = $zahlungsart;
		return $this->_getZahlungsartenAnzahl();
	}

	public function _setZahlungsartenAnzahl($neuer_zaehler)
	{
		$this->zahlungsartenAnzahl = $neuer_zaehler;
	}

	public function _getZahlungsartenAnzahl()
	{
		return $this->zahlungsartenAnzahl;
	}

	public function _ausgeben()
	{
		$zahlungsarten = array();
		foreach($this->zahlungsarten as $value)
		{
			array_push($zahlungsarten, $value->_ausgeben());
		}
		return $zahlungsarten;
	}
}
?>