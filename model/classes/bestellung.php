<?php
require_once ('./model/classes/bestellungenInterface.php');


class bestellung extends abstractbestellungen implements bestellungenInterface 
{
	protected $iteratorEigenschaften = array('id', 'idkunde', 'datum', 'fotografabgeschlossen', 'bestellwert', 'bilder', 'anmerkung');
	
	public function __construct($id = null, $idkunde = null, $datum = null, $fotografabgeschlossen = null, $bestellwert = null, $bilder = null, $anmerkung = null)
	{
		$this->id						= $id;
		$this->idkunde					= $idkunde;
		$this->datum 					= $datum;
		$this->fotografabgeschlossen	= $fotografabgeschlossen;
		$this->bestellwert 				= $bestellwert;
		$this->bilder 					= $bilder;
		$this->anmerkung				= $anmerkung;
	}
	
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
	
	public function _addBestellung($bestellung)
	{
		$zuAddierendeBestellungArray = $bestellung->_ausgeben();
		/// Datum
		$this->datum = $zuAddierendeBestellungArray['datum'];		
		/// Gesamtpreis
		$this->bestellwert += $zuAddierendeBestellungArray['bestellwert'];
		/// Bilder
		foreach ($zuAddierendeBestellungArray['bilder'] as $bild)
		{
			$this->bilder[] = $bild;
		}				
		return $this;
	}
	
	public function _subBestellung($bestellung)
	{
		/// @todo Subtrahieren einer Bestellung
		return $bestellung;
	}
	
	public function _getDistinctPictureArray($bestellung)
	{
		$aktuelleBestellungArray = $bestellung->_ausgeben();

		$distinctAktuelleBestellung = array();
		foreach ($aktuelleBestellungArray['bilder'] as $bilder)
		{
			$isInArray = false;
			if (count($distinctAktuelleBestellung) == 0)
			{
				$distinctAktuelleBestellung[$bilder['id']] = $bilder['anzahlbilder'];
			}else{
				foreach ($distinctAktuelleBestellung as $key => $data)
				{
					if ($key == $bilder['id'])
					{
						$isInArray = true;						 
					}
				}
				if ($isInArray)
				{
					foreach ($distinctAktuelleBestellung as $key => $data)
					{
						if ($key == $bilder['id'])
						{
							$distinctAktuelleBestellung[$key] += $bilder['anzahlbilder'];					 
						}
					}
				}else{
					$distinctAktuelleBestellung[$bilder['id']] = $bilder['anzahlbilder'];
				}
			}
		}
		return $distinctAktuelleBestellung;
	}
}
?>