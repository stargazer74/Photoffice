<?php


abstract class abstractgalerien implements Iterator
{
	
	
	protected $id;
	protected $galeriename;
	protected $online;
	protected $verfallsdatum;
	protected $bildanzahl;
	protected $idkunde;
	protected $nurpreise;
	
	public function _hinzufuegen($galerie)
	{
		return false;
	}
	
	public function _setGalerieAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getGalerieAnzahl()
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
		$galerien = array();
		foreach($this as $key => $value)
		{
			$galerien[$key] = $value;
		}
		return $galerien;
	}
}
?>