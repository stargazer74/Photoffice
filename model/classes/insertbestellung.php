<?php
class insertbestellung extends database implements insertinterface
{
	public function __construct()
	{
		
	}
	
	public function insert($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'bestellung';
		$bestellung = $object->_ausgeben();
		

		$field_values = array(	'Kunden_idKunden'		=> $bestellung['idkunde'],
								'datum'					=> $bestellung['datum'],
								'kundeabgeschlossen'	=> $bestellung['kundeabgeschlossen'],
								'fotografabgeschlossen'	=> $bestellung['fotografabgeschlossen'],
								'bestellwert'			=> $bestellung['bestellwert']);
		
		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_INSERT);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
		$alleBestellungenInstance = $this->_getBestellungen();
		$alleBestellungenArray = $alleBestellungenInstance->_ausgeben();
		$letzteID = 0;
		foreach ($alleBestellungenArray as $data)
		{
			if ($data['id'] > $letzteID)
			{
				$letzteID = $data['id'];
			}
		}
		$_SESSION['bestellungid'] = $letzteID;
		$tablename = 'bestellung_has_bild';
		foreach ($bestellung['bilder'] as $key => $data)
		{
			$field_values = array(	'Bild_idBild'						=> $data['id'],
									'Bestellung_idBestellung'			=> $letzteID,
									'Anzahl'							=> $data['anzahlbilder'],
									'Preis_Papier_idPapier'				=> $data['papiertyp'],
									'Preis_Bildformate_idBildformate'	=> $data['bildformat']);
			
			$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_INSERT);
	
			if (PEAR::isError($res))
			{
				die($res->getMessage());
			}	
		}
	}
}