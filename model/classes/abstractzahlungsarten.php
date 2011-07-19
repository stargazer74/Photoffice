<?php


abstract class abstractzahlungsarten implements Iterator
{
	protected $idzahlungsart;
	protected $zahlungsart;
	protected $aktiv;

	private $position = 0;

	public function _hinzufuegen($zahlungsart)
	{
		return false;
	}

	public function _setZahlungsartenAnzahl($neuer_zaehler)
	{
		return false;
	}

	public function _getZahlungsartenAnzahl()
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
		$zahlungsarten = array();
		foreach($this as $key => $value)
		{
			$zahlungsarten[$key] = $value;
		}
		return $zahlungsarten;
	}
}
?>