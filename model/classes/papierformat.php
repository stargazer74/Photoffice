<?php
require_once ('./model/classes/papierformateInterface.php');


class papierformat extends abstractpapierformate implements papierformateInterface 
{
	protected $iteratorEigenschaften = array('idpapierformat', 'papierformat');
	
	public function __construct($idpapierformat = null, $papierformat = null)
	{
		$this->idpapierformat	= $idpapierformat;
		$this->papierformat 	= $papierformat;
	}
	
	public function _hinzufuegen($papierformat)
	{
		return false;
	}
	
	public function _setPapierFormateAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getPapierFormateAnzahl()
	{
		return false;
	}
}
?>