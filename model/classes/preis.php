<?php
require_once ('./model/classes/preiseInterface.php');


class preis extends abstractpreise implements preiseInterface 
{
	protected $iteratorEigenschaften = array('preis', 'idpapiertyp', 'papiertyp', 'idbildformat', 'bildformat');
	
	public function __construct($preis = null, $idpapiertyp=null, $papiertyp = null, $idbildformat=null, $bildformat = null)
	{
		$this->preis		= $preis;
		$this->idpapiertyp	= $idpapiertyp;
		$this->papiertyp 	= $papiertyp;
		$this->idbildformat	= $idbildformat;
		$this->bildformat 	= $bildformat;
	}
	
	public function _hinzufuegen($preis)
	{
		return false;
	}
	
	public function _setPreiseAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getPreiseAnzahl()
	{
		return false;
	}
}
?>