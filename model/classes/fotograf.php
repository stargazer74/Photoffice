<?php
require_once ('./model/classes/fotografenInterface.php');


class fotograf extends abstractfotografen implements fotografenInterface
{
	protected $iteratorEigenschaften = array('id', 'firmenid', 'vorname', 'name', 'loginname', 'passwort');
	
	public function __construct($id = null, $firmenid = null, $vorname = null, $name = null, $loginname = null, $passwort = null)
	{
		$this->id		= $id;
		$this->firmenid = $firmenid;
		$this->vorname 	= $vorname;
		$this->name 	= $name;
		$this->loginname= $loginname;
		$this->passwort = $passwort;
	}
	
	public function _hinzufuegen($fotograf)
	{
		return false;
	}
	
	public function _setFotografenAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getFotografenAnzahl()
	{
		return false;
	}
}
?>