<?php
require_once ('./model/classes/bilderInterface.php');


class bild extends abstractbilder implements bilderInterface 
{
	protected $iteratorEigenschaften = array('id', 'bildname', 'iconname', 'fotograf','galerie', 'isonline', 'blende', 'belichtungszeit', 'brennweite', 'iso', 'blitz', 'marke', 'model', 'aufnahmezeitpunkt', 'aenderungszeit');
	
	public function __construct($id = null, $bildname = null, $iconname = null, $fotograf = null, $galerie = null, $isonline = null, $blende = null, $belichtungszeit = null, $brennweite = null, $iso = null, $blitz = null, $marke = null, $model = null, $aufnahmezeitpunkt = null, $aenderungszeit = null)
	{
		$this->id 				= $id;
		$this->bildname 		= $bildname;
		$this->iconname 		= $iconname;
		$this->fotograf 		= $fotograf;
		$this->galerie 			= $galerie;
		$this->isonline 		= $isonline;
		$this->blende			= $blende;
		$this->belichtungszeit	= $belichtungszeit;
		$this->brennweite		= $brennweite;
		$this->iso				= $iso;
		$this->blitz			= $blitz;
		$this->marke			= $marke;
		$this->model			= $model;
		$this->aufnahmezeitpunkt= $aufnahmezeitpunkt;
		$this->aenderungszeit	= $aenderungszeit;
	}
	
	public function _hinzufuegen($bild)
	{
		return false;
	}
	
	public function _setBilderAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getBilderAnzahl()
	{
		return false;
	}
}
?>