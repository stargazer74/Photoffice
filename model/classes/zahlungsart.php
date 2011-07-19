<?php
require_once ('./model/classes/bildformateInterface.php');


class zahlungsart extends abstractzahlungsarten implements zahlungsartenInterface
{
	protected $iteratorEigenschaften = array('idzahlungsart', 'zahlungsart', 'aktiv');

	public function __construct($idzahlungsart = null, $zahlungsart = null, $aktiv = null)
	{
		$this->idzahlungsart	= $idzahlungsart;
		$this->zahlungsart 		= $zahlungsart;
		$this->aktiv			= $aktiv;
	}

	public function _hinzufuegen($zahlungsart)
	{
		return false;
	}

	public function _setZahlungsartenAnzahl($neuer_zaehler)
	{
		return false;
	}

	public function _getZahlungsartenAnzahl()
	{
		return false;
	}
}
?>