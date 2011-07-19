<?php


class company
{
	private $idfirma;
	private $firmenname;
	private $geschaeftsfuehrer;
	private $strasse;
	private $hausnummer;
	private $plz;
	private $stadt;
	private $telefon;
	private $fax;
	private $mobil;
	private $email;
	private $steuernummer;
	private $internet;
	private $bank;
	private $blz;
	private $kontonummer;
	private $agb;
	private static $uniqueInstance = NULL;
	private $changed = FALSE;
	
	private function __construct($idfirma = NULL, $firmenname = NULL, $geschaeftsfuehrer = NULL, $strasse = NULL, $hausnummer = NULL, $plz = NULL, $stadt = NULL, $telefon = NULL, $fax = NULL, $mobil = NULL, $email = NULL, $steuernummer = NULL, $internet = NULL, $bank = NULL, $blz = NULL, $kontonummer = NULL, $agb = NULL)
	{
		$this->idfirma				= $idfirma;
		$this->firmenname 			= $firmenname;
		$this->geschaeftsfuehrer 	= $geschaeftsfuehrer;
		$this->strasse				= $strasse;
		$this->hausnummer			= $hausnummer;
		$this->plz					= $plz;
		$this->stadt				= $stadt;
		$this->telefon				= $telefon;
		$this->fax					= $fax;
		$this->mobil				= $mobil;
		$this->email				= $email;
		$this->steuernummer			= $steuernummer;
		$this->internet				= $internet;
		$this->bank					= $bank;
		$this->blz					= $blz;
		$this->kontonummer			= $kontonummer;
		$this->agb					= $agb;
	}
	
	public function __destruct()
	{
		if($this->changed == true)
		{
			$this->_insertIntoDatabase();
		}
	}
	
	public static function _getInstance()
	{
		$database = new database();
		$result = $database->_getFirmenDaten();
		
		if(self::$uniqueInstance === NULL)
		{				
			self::$uniqueInstance = new  company(	$result[0]['idFirma'],
													$result[0]['firmenname'], 
													$result[0]['geschaeftsfuehrer'],
													$result[0]['strasse'],
													$result[0]['hausnummer'],
													$result[0]['plz'],
													$result[0]['stadt'],
													$result[0]['telefon'],
													$result[0]['fax'],
													$result[0]['mobil'],
													$result[0]['mail'],
													$result[0]['steuernummer'],
													$result[0]['internet'],									
													$result[0]['bankname'],
													$result[0]['blz'],
													$result[0]['kontonummer'],
													$result[0]['agb']);
		}
		return self::$uniqueInstance;
	}
	
	
//////////////////////////////////////////////////////////
//
//get Methoden
//
//////////////////////////////////////////////////////////
	public function _getIDFirma()
	{
		return $this->idfirma;
	}
	
	public function _getFirmenName()
	{
		return $this->firmenname;
	}
	
	public function _getGeschaeftsFuehrer()
	{
		return $this->geschaeftsfuehrer;
	}
	
	public function _getStrasse()
	{
		return $this->strasse;
	}
	
	public function _getHausNummer()
	{
		return $this->hausnummer;
	}
	
	public function _getPostleitZahl()
	{
		return $this->plz;
	}
	
	public function _getStadt()
	{
		return $this->stadt;
	}
	
	public function _getTelefon()
	{
		return $this->telefon;
	}
	
	public function _getFax()
	{
		return $this->fax;
	}
	
	public function _getMobil()
	{
		return $this->mobil;
	}
	
	public function _getMail()
	{
		return $this->email;
	}
	
	public function _getSteuerNummer()
	{
		return $this->steuernummer;
	}
	
	public function _getWebsite()
	{
		return $this->internet;
	}
	
	public function _getBankName()
	{
		return $this->bank;
	}
	
	public function _getBankleitZahl()
	{
		return $this->blz;
	}
	
	public function _getKontoNummer()
	{
		return $this->kontonummer;
	}
	
	public function _getAGB()
	{
		return $this->agb;
	}
	
	public function _getAssocArray()
	{
		$data = array(	'idfirma' 			=> $this->idfirma,
						'firmenname' 		=> $this->firmenname,
						'geschaeftsfuehrer'	=> $this->geschaeftsfuehrer,
						'strasse'			=> $this->strasse,
						'hausnummer'		=> $this->hausnummer,
						'plz'				=> $this->plz,
						'stadt'				=> $this->stadt,
						'telefon'			=> $this->telefon,
						'fax'				=> $this->fax,
						'mobil'				=> $this->mobil,
						'email'				=> $this->email,
						'steuernummer'		=> $this->steuernummer,
						'internet'			=> $this->internet,
						'bank'				=> $this->bank,
						'blz'				=> $this->blz,
						'kontonummer'		=> $this->kontonummer,
						'agb'				=> $this->agb);
		return $data;
	}
	
//////////////////////////////////////////////////////////
//
//set Methoden
//
//////////////////////////////////////////////////////////

	public function _setFirmenName($firmenname)
	{
		$this->firmenname = $firmenname;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setGeschaeftsFuehrer($geschaeftsfuehrer)
	{
		$this->geschaeftsfuehrer = $geschaeftsfuehrer;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setStrasse($strasse)
	{
		$this->strasse = $strasse;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setHausNummer($hausnummer)
	{
		$this->hausnummer = $hausnummer;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setPostleitZahl($postleitzahl)
	{
		$this->plz = $postleitzahl;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setStadt($stadt)
	{
		$this->stadt = $stadt;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setTelefon($telefon)
	{
		$this->telefon = $telefon;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setFax($fax)
	{
		$this->fax = $fax;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setMobil($mobil)
	{
		$this->mobil = $mobil;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setMail($mail)
	{
		$this->email = $mail;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setSteuerNummer($steuernummer)
	{
		$this->steuernummer = $steuernummer;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setWebsite($website)
	{
		$this->internet = $website;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setBankName($bankname)
	{
		$this->bank = $bankname;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setBankleitZahl($bankleitzahl)
	{
		$this->blz = $bankleitzahl;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setKontoNummer($kontonummer)
	{
		$this->kontonummer = $kontonummer;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}
	
	public function _setAGB($agb)
	{
		$this->agb = $agb;
		if(!$this->changed)
		{
			$this->changed = true;
		}
	}

//////////////////////////////////////////////////////////
//
//private Methoden
//
//////////////////////////////////////////////////////////

	private function _insertIntoDatabase()
	{
		$database = new database();
		$database->_updateFirmenDaten($this->_getAssocArray());
	}
}
?>