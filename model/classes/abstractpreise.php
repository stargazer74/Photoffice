<?php


abstract class abstractpreise implements Iterator
{
	protected $preis;
	protected $idpapiertyp;
	protected $papiertyp;
	protected $idbildformat;
	protected $bildformat;
	
	private $position = 0;
	
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
		$preise = array();
		foreach($this as $key => $value)
		{
			$preise[$key] = $value;
		}
		return $preise;
	}
}
?>