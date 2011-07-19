<?php
require_once ('./model/classes/galerienInterface.php');


class galerie extends abstractgalerien implements galerienInterface 
{
	protected $iteratorEigenschaften = array('id', 'galeriename', 'online', 'verfallsdatum', 'bildanzahl', 'idkunde', 'nurpreise');
	
	public function __construct($id = null, $galeriename = null, $online = null, $verfallsdatum = null, $bildanzahl = null, $idkunde = null, $nurpreise = null)
	{
		$this->id 					= $id;
		$this->galeriename 			= $galeriename;
		$this->online 				= $online;
		$this->verfallsdatum 		= $verfallsdatum;
		$this->bildanzahl			= $bildanzahl;
		$this->idkunde 				= $idkunde;
		$this->nurpreise			= $nurpreise;
	}
	
	public function _hinzufuegen($galerie)
	{
		return false;
	}
	
	public function _setGalerienAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getGalerienAnzahl()
	{
		return false;
	}
}
?>