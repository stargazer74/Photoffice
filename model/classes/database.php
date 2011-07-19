<?php
class database
{
	private $sqlstring;
	private $id;
	protected $insertVerhalten;
	protected $updateVerhalten;

	public function __construct($sqlstring = null, $id = null)
	{
		$this->sqlstring = $sqlstring;
		$this->id = $id;
	}

	public function _select()
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$result = $db->getAll($this->sqlstring, DB_FETCHMODE_ASSOC);
		if(DB::isError($result))
		{
			die ($result->getMessage());
		}//end if
		return $result;
	}

	public function _setSqlString($sqlstring)
	{
		$this->sqlstring = $sqlstring;
	}

	public function _getFotografen()
	{
		$this->sqlstring = 'SELECT * FROM fotograf';
		$result = $this->_select();
		$alleFotografen = new fotografen();
		foreach($result as $daten)
		{
			$fotograf = new fotograf($daten['idfotograf'], $daten['Firma_idFirma'], $daten['vorname'], $daten['name'], $daten['loginname'], $daten['passwort']);
			//print_r($fotograf);
			$alleFotografen->_hinzufuegen($fotograf);
		}
		return $alleFotografen;
	}

	public function _getPreise()
	{
		$this->sqlstring = 'SELECT * FROM preis p, papier pa, bildformate b WHERE p.Papier_idPapier = pa.idPapier AND p.Bildformate_idBildformate = b.idBildformate';
		$result = $this->_select();
		$allePreise = new preise();
		foreach($result as $daten)
		{
			$preis = new preis($daten['preis'], $daten['idPapier'], $daten['papiertyp'], $daten['idBildformate'], $daten['bildformat']);
			$allePreise->_hinzufuegen($preis);
		}
		return $allePreise;
	}

	public function _getZahlungsarten()
	{
		$this->sqlstring = 'SELECT * FROM zahlungsart';
		$result = $this->_select();
		$alleZahlungsarten = new zahlungsarten();
		foreach($result as $daten)
		{
			$zahlungsart = new zahlungsart($daten['idZahlungsart'], $daten['zahlungsart'], $daten['aktiv']);
			$alleZahlungsarten->_hinzufuegen($zahlungsart);
		}
		return $alleZahlungsarten;
	}

	public function _getPortos()
	{
		$this->sqlstring = 'SELECT * FROM versandkosten';
		$result = $this->_select();
		$portos = new portos();
		foreach($result as $daten)
		{
			$porto = new porto($daten['idVersandkosten'], $daten['versandart'], $daten['versandkosten']);
			$portos->_hinzufuegen($porto);
		}
		return $portos;
	}

	public function _getBestellungen()
	{
		$this->sqlstring = 'SELECT * FROM bestellung';
		$result = $this->_select();
		$alleBestellungen = new Bestellungen();
		foreach($result as $daten)
		{
			$this->sqlstring = 'SELECT * FROM bestellung_has_bild WHERE Bestellung_idBestellung = '.$daten['idBestellung'];
			$result = $this->_select();
			$bilder = array();
			foreach ($result as $data)
			{
				$bilder[] = array('id' => $data['Bild_idBild'], 'anzahlbilder' => $data['Anzahl'], 'papiertyp' => $data['Preis_Papier_idPapier'], 'bildformat' => $data['Preis_Bildformate_idBildformate']);
			}
			$bestellung = new bestellung($daten['idBestellung'], $daten['Kunden_idKunden'], $daten['datum'], $daten['fotografabgeschlossen'], $daten['bestellwert'], $bilder);
			$alleBestellungen->_hinzufuegen($bestellung);
		}
		return $alleBestellungen;
	}

	public function _getGalerien()
	{
		$this->sqlstring = 'SELECT * FROM gallerien g, kunden_has_gallerien khg WHERE g.idgallerien = khg.gallerien_idgallerien';
		$result = $this->_select();
		$alleGalerien = new galerien();
		foreach($result as $daten)
		{
			$galerie = new galerie($daten['idgallerien'], $daten['galleriename'], $daten['online'], $daten['verfallsdatum'], $daten['bildanzahl'], $daten['Kunden_idKunden'], $daten['nurpreise']);
			$alleGalerien->_hinzufuegen($galerie);
		}
		return $alleGalerien;
	}

	public function _getOeffentlicheGalerien()
	{
		$this->sqlstring = 'SELECT * FROM gallerien g WHERE NOT EXISTS (SELECT * FROM kunden_has_gallerien khg WHERE g.idgallerien = khg.gallerien_idgallerien)';
		$result = $this->_select();
		$alleGalerien = new galerien();
		foreach($result as $daten)
		{
			$galerie = new galerie($daten['idgallerien'], $daten['galleriename'], $daten['online'], $daten['verfallsdatum'], $daten['bildanzahl'], null, $daten['nurpreise']);
			$alleGalerien->_hinzufuegen($galerie);
		}
		return $alleGalerien;
	}

	public function _getBildFormate()
	{
		$this->sqlstring = 'SELECT * FROM bildformate';
		$result = $this->_select();
		$alleBildFormate = new bildformate();
		foreach($result as $daten)
		{
			$bildformat = new bildformat($daten['idBildformate'], $daten['bildformat']);
			$alleBildFormate->_hinzufuegen($bildformat);
		}
		return $alleBildFormate;
	}

	public function _getPapierFormate()
	{
		$this->sqlstring = 'SELECT * FROM papier';
		$result = $this->_select();
		$allePapierFormate = new papierformate();
		foreach($result as $daten)
		{
			$papierformat = new papierformat($daten['idPapier'], $daten['papiertyp']);
			$allePapierFormate->_hinzufuegen($papierformat);
		}
		return $allePapierFormate;
	}

	public function _getKunden()
	{
		$this->sqlstring = 'SELECT * FROM kunden';
		$result = $this->_select();
		$alleKunden = new allekunden();
		foreach($result as $daten)
		{
			$kunde = new kunde($daten['idKunden'], $daten['kundennummer'], $daten['firma'], $daten['vorname'], $daten['name'], $daten['strasse'], $daten['hausnummer'], $daten['plz'], $daten['stadt'], $daten['telefon'], $daten['email'], $daten['passwort']);
			$alleKunden->_hinzufuegen($kunde);
		}
		return $alleKunden;
	}

	public function _getBilder()
	{
		$this->sqlstring = 'SELECT * FROM bild';
		$result = $this->_select();
		$alleBilder = new vielebilder();
		foreach($result as $daten)
		{
			$bild = new bild($daten['idBild'], $daten['bildname'], $daten['iconname'], $daten['fotograf_idfotograf'], $daten['gallerien_idgallerien'], $daten['online'], $daten['blende'], $daten['belichtungszeit'], $daten['brennweite'], $daten['iso'], $daten['blitz'], $daten['marke'], $daten['model'], $daten['aufnahmezeitpunkt'], $daten['aenderungszeit']);
			$alleBilder->_hinzufuegen($bild);
		}
		return $alleBilder;
	}

	public function _getFirmenDaten()
	{
		$this->sqlstring = 'SELECT * FROM firma';
		$result = $this->_select();
		//print_r($result);
		return $result;
	}

	public function _getNavigation()
	{
		$this->sqlstring = 'SELECT * FROM navigation';
		$result = $this->_select();
		//print_r($result);
		return $result;
	}

	public static function _updateFirmenDaten($fields)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'firma';

		$field_values = array(	'idFirma' 			=> $fields['idfirma'],
								'firmenname' 		=> $fields['firmenname'],
								'geschaeftsfuehrer'	=> $fields['geschaeftsfuehrer'],
								'strasse'			=> $fields['strasse'],
								'hausnummer'		=> $fields['hausnummer'],
								'plz'				=> $fields['plz'],
								'stadt'				=> $fields['stadt'],
								'telefon'			=> $fields['telefon'],
								'fax'				=> $fields['fax'],
								'mobil'				=> $fields['mobil'],
								'mail'				=> $fields['email'],
								'steuernummer'		=> $fields['steuernummer'],
								'internet'			=> $fields['internet'],
								'bankname'			=> $fields['bank'],
								'blz'				=> $fields['blz'],
								'kontonummer'		=> $fields['kontonummer'],
								'agb'				=> $fields['agb']);

		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_UPDATE, 'idFirma='.$fields['idfirma']);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
	}

	public function _insert($object)
	{
		$type = get_class($object);
		$type = 'insert' .$type;
		$source = $type. '.php';
		if(is_file('./model/classes/'.$source))
		{
			if(require_once($source))
			{
				$this->insertVerhalten = new $type;
			}else{
				return false;
			}
		}else{
			return false;
		}
		$this->insertVerhalten->insert($object);
		return true;
	}

	public function _update($object)
	{
		$type = get_class($object);
		$type = 'update' .$type;
		$source = $type. '.php';
		if(is_file('./model/classes/'.$source))
		{
			if(require_once($source))
			{
				$this->updateVerhalten = new $type;
			}else{
				return false;
			}
		}else{
			return false;
		}
		$this->updateVerhalten->update($object);
		return true;
	}

	public function _delete($object, $id)
	{
		$type = 'delete' .$object;
		$source = $type. '.php';
		if(is_file('./model/classes/'.$source))
		{
			if(require_once($source))
			{
				$this->deleteVerhalten = new $type;
			}else{
				return false;
			}
		}else{
			return false;
		}
		$this->deleteVerhalten->delete($object, $id);
		return true;
	}
}
?>