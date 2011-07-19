<?php
require_once ('./model/classes/kundenInterface.php');


class kunde extends abstractkunden implements kundenInterface
{
	protected $iteratorEigenschaften = array('id', 'kundennummer', 'firma', 'vorname', 'nachname', 'strasse', 'hausnummer','plz', 'stadt', 'telefonnummer', 'email', 'passwort');
	
	public function __construct($id = null, $kundennummer = null, $firma = null, $vorname = null, $nachname = null, $strasse = null, $hausnummer = null, $plz = null, $stadt = null, $telefonnummer = null, $email = null, $passwort = null)
	{
		$this->id 				= $id;
		$this->kundennummer		= $kundennummer;
		$this->firma			= $firma;
		$this->vorname			= $vorname;
		$this->nachname			= $nachname;
		$this->strasse			= $strasse;
		$this->hausnummer		= $hausnummer;
		$this->plz				= $plz;
		$this->stadt			= $stadt;
		$this->telefonnummer	= $telefonnummer;
		$this->email			= $email;
		$this->passwort			= $passwort;
	}
	
	public function _hinzufuegen($kunde)
	{
		return false;
	}
	
	public function _setKundenAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getKundenAnzahl()
	{
		return false;
	}
}
?>