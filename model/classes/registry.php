<?php


class registry {
	
	static private $instance = NULL;
	private $xmlfile;
	private $XMLObject;
	private $DatabaseServer;
	private $DatabaseName;
	private $DatabaseUser;
	private $DatabasePassphrase;
	private $SerialNumber;
	private $VersionNumber;
	private $xmlrpcString;
	
	private function __construct()
	{
		
	}
	
	private function __clone()
	{
		
	}	
	
	public static function getInstance()
	{
		if(self::$instance === NULL)
		{
			self::$instance = new registry();
		}//end if
		return self::$instance;
	}
		
	public function _initApplicationVariables($configfile)
	{
		
		$this->xmlfile = $configfile;
		$xmlfile = file_get_contents($this->xmlfile);
		$xml = new SimpleXMLElement($xmlfile);
		$this->XMLObject = $xml;
		
		$this->DatabaseServer 		= $this->XMLObject->DatabaseServer;
		$this->DatabaseName 		= $this->XMLObject->DatabaseName;
		$this->DatabaseUser			= $this->XMLObject->DatabaseUser;
		$this->DatabasePassphrase 	= $this->XMLObject->DatabasePassphrase;
		$this->SerialNumber			= $this->XMLObject->SerialNumber;
		$this->VersionNumber		= $this->XMLObject->VersionNumber;
		$this->xmlrpcString			= $this->XMLObject->XmlRpcString;
	}
	
	public function _initApplicationStatus()
	{
		$this->_setGaleriesOnOff();
	}

///////////////////////////////////////////////////////////////
//
//getter Methoden
//
//////////////////////////////////////////////////////////////

	public function _getDatabaseServer()
	{
		return strval($this->DatabaseServer);
	}
	
	public function _getDatabaseUser()
	{
		return strval($this->DatabaseUser);
	}
	
	public function _getDatabasePassphrase()
	{
		return strval($this->DatabasePassphrase);
	}
	
	public function _getDatabaseName()
	{
		return strval($this->DatabaseName);
	}
	public function _getSerialNumber()
	{
		return strval($this->SerialNumber);
	}
	
	public function _getVersionNumber()
	{
		return strval($this->VersionNumber);
	}
	
	public function _getXmlRpcString()
	{
		return strval($this->xmlrpcString);
	}
	
///////////////////////////////////////////////////////////////
//
//set Methoden
//
//////////////////////////////////////////////////////////////	

	public function _setBenutzerName($vorname, $nachname)
	{
		$name = $vorname.' '.$nachname;
		session_register('benutzername');
		$_SESSION['benutzername'] = $name;
	}
	
	public function _setBenutzerID($id)
	{
		session_register('benutzerid');
		$_SESSION['benutzerid'] = $id;
	}
	
	public function _registerGalerieID()
	{
		session_register('galerieid');
	}
	
	public function _setGalerieID($id)
	{
		$_SESSION['galerieid'] = $id;
	}
	
	public function _registerBildID()
	{
		session_register('bildid');
	}
	
	public function _setBildID($id)
	{
		$_SESSION['bildid'] = $id;
	}
	
	public function _registerPapiertypID()
	{
		session_register('papiertypid');
	}
	
	public function _setPapiertypID($id)
	{
		$_SESSION['papiertypid'] = $id;
	}
	
	public function _registerBestellungID()
	{
		session_register('bestellungid');
	}
	
	public function _setBestellungID($id)
	{
		$_SESSION['bestellungid'] = $id;
	}

	public function _setVersionNumber($value)
	{
		unset($this->XMLObject->VersionNumber);
		$this->XMLObject->addChild('VersionNumber', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());
	}
	
	public function _setDatabaseServer($value)
	{
		unset($this->XMLObject->DatabaseServer);
		$this->XMLObject->addChild('DatabaseServer', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());
	}
	
	public function _setDatabaseName($value)
	{
		unset($this->XMLObject->DatabaseName);
		$this->XMLObject->addChild('DatabaseName', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());
	}
	
	public function _setDatabaseUser($value)
	{
		unset($this->XMLObject->DatabaseUser);
		$this->XMLObject->addChild('DatabaseUser', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());
	}
	
	public function _setDatabasePassphrase($value)
	{
		unset($this->XMLObject->DatabasePassphrase);
		$this->XMLObject->addChild('DatabasePassphrase', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());
	}
	
	public function _setSerialNumber($value)
	{
		unset($this->XMLObject->SerialNumber);
		$this->XMLObject->addChild('SerialNumber', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());
	}
	
///////////////////////////////////////////////////////////////
//
//private Methoden
//
//////////////////////////////////////////////////////////////

	private function _writeXMLFile($xmldata)
	{
		if (!$fp = fopen($this->xmlfile, 'wb'))
		{
			trigger_error('Cannot open ' . $this->xmlfile);
		}else{
			if ( !fwrite( $fp, $xmldata, strlen($xmldata) )  )
			{
				trigger_error('Cannot write to ' . $this->xmlfile, E_USER_WARNING);
			}else{
				$success = TRUE;
			}
			fclose($fp);
		}
	}

	private function _setGaleriesOnOff()
	{
		$db = new database();
		$alleGalerienInstance = $db->_getGalerien();
		$alleGalerienArray = $alleGalerienInstance->_ausgeben();
		foreach ($alleGalerienArray as $data)
		{
			if (datum::_checkIfDateIsEqualOrSmaller($data['verfallsdatum']))
			{
				$galerie = new galerie($data['id'], $data['galeriename'], 0, $data['verfallsdatum'], $data['bildanzahl'], $data['idkunde']);
				$db->_update($galerie);	
			}
		}
	}
}
?>