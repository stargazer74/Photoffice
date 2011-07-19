<?php


abstract class abstractbildformate implements Iterator
{
	protected $idbildformat;
	protected $bildformat;
	
	private $position = 0;
	
	public function _hinzufuegen($bildformat)
	{
		return false;
	}
	
	public function _setBildFormateAnzahl($neuer_zaehler)
	{
		return false;
	}
	
	public function _getBildFormateAnzahl()
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
		$bildformate = array();
		foreach($this as $key => $value)
		{
			$bildformate[$key] = $value;
		}
		return $bildformate;
	}
}
?>