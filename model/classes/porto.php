<?php
require_once ('./model/classes/portosInterface.php');


class porto extends abstractporto implements portosInterface
{
	protected $iteratorEigenschaften = array('idporto', 'porto', 'preis');

	public function __construct($idporto = null, $porto = null, $preis = null)
	{
		$this->idporto		= $idporto;
		$this->porto 		= $porto;
		$this->preis		= $preis;
	}

	public function _hinzufuegen($porto)
	{
		return false;
	}

	public function _setPortosAnzahl($neuer_zaehler)
	{
		return false;
	}

	public function _getPortosAnzahl()
	{
		return false;
	}
}
?>