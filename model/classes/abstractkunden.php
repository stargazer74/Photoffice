<?php

abstract class abstractkunden implements Iterator
{
	protected $id;
	protected $kundennummer;
	protected $firma;
	protected $vorname;
	protected $nachname;
	protected $strasse;
	protected $hausnummer;
	protected $plz;
	protected $stadt;
	protected $telefonnummer;
	protected $email;
	protected $passwort;
	
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
	
	public function current()
	{
		$key = $this->key();
		return $this->$key;
	}
	
	public function key()
	{
		return $this->iteratorEigenschaften[$this->postition];
	}
	
	public function next()
	{
		$this->postition++;
	}
	
	public function rewind()
	{
		$this->postition = 0;
	}
	
	public function valid()
	{
		if($this->postition < count($this->iteratorEigenschaften))
		{
			return true;
		}else{
			return false;
		}
	}
	
	public function _ausgeben()
	{

		$kunden = array();
		foreach($this as $key => $value)
		{
			$kunden[$key] = $value;
		}
		return $kunden;
	}
}
?>