<?php


abstract class abstractporto implements Iterator
{
	protected $idporto;
	protected $porto;
	protected $preis;

	private $position = 0;

	public function _hinzufuegen($porto)
	{
		return false;
	}

	public function _setPortosAnzahl($neuer_zaehler)
	{
		return false;
	}

	public function _getPortosAnzahl()
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
		$portos = array();
		foreach($this as $key => $value)
		{
			$portos[$key] = $value;
		}
		return $portos;
	}
}
?>