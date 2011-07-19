<?php


abstract class abstractbestellungen implements Iterator
{
	protected $id;
	protected $idkunde;
	protected $datum;
	protected $fotografabgeschlossen;
	protected $bestellwert;
	protected $bilder;
	protected $anmerkung;
	
	private $position = 0;
	
	public function _hinzufuegen($bestellung)
	{
		return false;
	}
	
	public function _setBestellungenAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getBestellungenAnzahl()
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
		return $this->iteratorEigenschaften[$this->position];
	}
	
	public function next()
	{
		$this->position++;
	}
	
	public function rewind()
	{
		$this->position = 0;
	}
	
	public function valid()
	{
		if($this->position < count($this->iteratorEigenschaften))
		{
			return true;
		}else{
			return false;
		}
	}
	
	public function _ausgeben()
	{
		$bestellungen = array();
		foreach($this as $key => $value)
		{
			$bestellungen[$key] = $value;
		}
		return $bestellungen;
	}
}
?>