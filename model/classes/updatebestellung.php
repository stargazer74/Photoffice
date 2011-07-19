<?php
class updatebestellung extends database implements updateinterface
{
	public function __construct()
	{
		
	}
	
	public function update($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'bestellung';
		$bestellung = $object->_ausgeben();

		if (!$_REQUEST['kundeabschliessen'] && !$_SESSION['bestellungid'])
		{
			$field_values = array(	'Kunden_idKunden'		=> $bestellung['idkunde'],
									'datum'					=> $bestellung['datum'],
									'kundeabgeschlossen'	=> $bestellung['kundeabgeschlossen'],
									'fotografabgeschlossen'	=> $bestellung['fotografabgeschlossen'],
									'bestellwert'			=> $bestellung['bestellwert'],
									'anmerkung'				=> $bestellung['anmerkung']);
			
			$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_UPDATE, 'idBestellung='.$bestellung['id']);
	
			if (PEAR::isError($res))
			{
				die($res->getMessage());
			}
			
		}elseif (isset($_REQUEST['kundeabschliessen']) && $_REQUEST['kundeabschliessen'] == '1')
		{
			//print_r($bestellung);
			$field_values = array('kundeabgeschlossen'	=> $bestellung['kundeabgeschlossen']);
			if ($bestellung['anmerkung'] != '')
			{
				$field_values = array_merge($field_values, array('anmerkung' => $bestellung['anmerkung']));
			}
			
			$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_UPDATE, 'idBestellung='.$_SESSION['bestellungid']);
	
			if (PEAR::isError($res))
			{
				if ($res->getMessage() == 'DB Error: syntax error');
				{
					echo 'Ihr Warenkorb ist leer.';
					die;
				}
			}
			
			$_SESSION['bestellungid'] = '';
		}else{				
			$databaseInstance = new database();
			$alleBestellungenInstance = $databaseInstance->_getBestellungen();
			$alleBestellungenArray = $alleBestellungenInstance->_ausgeben();
			$aktuelleBestellung = null;
			foreach ($alleBestellungenArray as $data)
			{
				if ($_SESSION['bestellungid'] == $data['id'])
				{
					$aktuelleBestellung = $data;
				}
			}
			$bestellung['bestellwert'] += $aktuelleBestellung['bestellwert'];
			$field_values = array(	'Kunden_idKunden'		=> $bestellung['idkunde'],
									'datum'					=> $bestellung['datum'],
									'kundeabgeschlossen'	=> $bestellung['kundeabgeschlossen'],
									'fotografabgeschlossen'	=> $bestellung['fotografabgeschlossen'],
									'bestellwert'			=> $bestellung['bestellwert']);
			
			$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_UPDATE, 'idBestellung='.$_SESSION['bestellungid']);
	
			if (PEAR::isError($res))
			{
				die($res->getMessage());
			}
	
			$tablename = 'bestellung_has_bild';
			//print_r($bestellung['bilder']);
			foreach ($bestellung['bilder'] as $key => $data)
			{
				$field_values = array(	'Bild_idBild'						=> $data['id'],
										'Bestellung_idBestellung'			=> $_SESSION['bestellungid'],
										'Anzahl'							=> $data['anzahlbilder'],
										'Preis_Papier_idPapier'				=> $data['papiertyp'],
										'Preis_Bildformate_idBildformate'	=> $data['bildformat']);
				
				$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_INSERT);
		
				if (PEAR::isError($res))
				{
					if ($res->getMessage() == 'DB Error: already exists')
					{
						foreach ($bestellung['bilder'] as $schluessel => $daten)
						{
							//schauen ob format und groesse gleich
							$zuAddierendeAnzahl = null;
							foreach ($aktuelleBestellung['bilder'] as $bilderdaten)
							{
								//print_r($bilderdaten);
								if ($bilderdaten['id'] == $daten['id'] && $bilderdaten['papiertyp'] == $daten['papiertyp'] && $bilderdaten['bildformat'] == $daten['bildformat'])
								{
									$zuAddierendeAnzahl = $bilderdaten['anzahlbilder'];
								}
							}
							$anzahl = $daten['anzahlbilder']+$zuAddierendeAnzahl;
							$field_values = array('Anzahl' =>  $anzahl);
							$resup = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_UPDATE, 'Bestellung_idBestellung='.$_SESSION['bestellungid'].' AND Preis_Papier_idPapier='.$data['papiertyp'].' AND Preis_Bildformate_idBildformate='.$data['bildformat'].' AND Bild_idBild='.$daten['id']);
							if (PEAR::isError($resup))
							{
								die($resup->getMessage());
							}	
	
						}
					}
					
					//die($res->getMessage());
				}
				unset($bestellung['bilder'][$key]);
			}			
		}
	}
}