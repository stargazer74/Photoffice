<?php


abstract class abstractbilder implements Iterator
{
	
	
	protected $id;
	protected $bildname;
	protected $iconname;
	protected $fotograf;
	protected $galerie;
	protected $isonline;
	protected $blende;
	protected $belichtungszeit;
	protected $brennweite;
	protected $iso;
	protected $blitz;
	protected $marke;
	protected $model;
	protected $aufnahmezeitpunkt;
	protected $aenderungszeit;
	
	
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
		$bilder = array();
		foreach($this as $key => $value)
		{
			$bilder[$key] = $value;
		}
		return $bilder;
	}
}
?>