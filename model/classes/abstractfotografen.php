<?php


abstract class abstractfotografen implements Iterator
{
	protected $id;
	protected $firmenid;
	protected $vorname;
	protected $name;
	protected $loginname;
	protected $passwort;
	
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

		$fotografen = array();
		foreach($this as $key => $value)
		{
			$fotografen[$key] = $value;
		}
		return $fotografen;
	}

}
?>