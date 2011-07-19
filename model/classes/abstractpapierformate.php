<?php


abstract class abstractpapierformate implements Iterator
{
	protected $idpapierformat;
	protected $papierformat;
	
	private $position = 0;
	
	public function _hinzufuegen($papierformat)
	{
		return false;
	}
	
	public function _setPapierFormateAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getPapierFormateAnzahl()
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
		//echo $this->position;
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
		$papierformate = array();
		foreach($this as $key => $value)
		{
			$papierformate[$key] = $value;
		}
		return $papierformate;
	}
}
?>