<?php
require_once ('./model/classes/bildformateInterface.php');


class bildformat extends abstractbildformate implements bildformateInterface 
{
	protected $iteratorEigenschaften = array('idbildformat', 'bildformat');
	
	public function __construct($idbildformat = null, $bildformat = null)
	{
		$this->idbildformat	= $idbildformat;
		$this->bildformat 	= $bildformat;
	}
	
	public function _hinzufuegen($bildformat)
	{
		return false;
	}
	
	public function _setBildFormateAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getBildFormateAnzahl()
	{
		return false;
	}
}
?>