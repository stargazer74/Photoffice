<?php

class application
{
	static private $instance = NULL;
	private $XMLObject;
	private $xmlfile;
	
	private function __construct()
	{
		$this->xmlfile = './model/appstate.xml';
		$xmlfile = file_get_contents($this->xmlfile);
		$xml = new SimpleXMLElement($xmlfile);
		$this->XMLObject = $xml;
	}
	private function __clone()
	{
		
	}
	
	public static function getInstance()
	{
		if(self::$instance === NULL)
		{
			self::$instance = new application();
		}//end if
		return self::$instance;
	}
	
	public function _getIDKunde()
	{
		$idkunde = $this->XMLObject->idkunde;
		return strval($idkunde);
	}
	
	public function _getSucheNach()
	{
		$suchenach = $this->XMLObject->suchenach;
		return strval($suchenach);
	}
	
	public function _getSuchbegriff()
	{
		$suchbegriff = $this->XMLObject->suchbegriff;
		return strval($suchbegriff);
	}
	
	public function _getHowmany()
	{
		$howmany = $this->XMLObject->howmany;
		return strval($howmany);
	}
	
	public function _getPageID()
	{
		$pageid = $this->XMLObject->pageid;
		return strval($pageid);
	}
	
	public function _getGalerieID()
	{
		$galerieid = $this->XMLObject->galerieid;
		return strval($galerieid);
	}
	
	public function _getWasserzeichen()
	{
		$wasserzeichen = $this->XMLObject->wasserzeichen;
		return strval($wasserzeichen);
	}
	
	public function _getFotografenID()
	{
		$idfotograf = $this->XMLObject->idfotograf;
		return strval($idfotograf);
	}

	public function _getWatermarkTransparency()
	{
		$watermarktrans = $this->XMLObject->watermarktrans;
		return strval($watermarktrans);
	}
	
	public function _getBestellungID()
	{
		$idbestellung = $this->XMLObject->idbestellung;
		return strval($idbestellung);
	}
	
	public function _setIDKunde($value)
	{
		unset($this->XMLObject->idkunde);
		$this->XMLObject->addChild('idkunde', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());

	}
	
	public function _setSucheNach($value)
	{
		unset($this->XMLObject->suchenach);
		$this->XMLObject->addChild('suchenach', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());

	}
	
	public function _setSuchbegriff($value)
	{
		unset($this->XMLObject->suchbegriff);
		$this->XMLObject->addChild('suchbegriff', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());

	}
	
	public function _setHowmany($value)
	{
		unset($this->XMLObject->howmany);
		$this->XMLObject->addChild('howmany', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());

	}
	
	public function _setPageID($value)
	{
		unset($this->XMLObject->pageid);
		$this->XMLObject->addChild('pageid', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());

	}
	
	public function _setGalerieID($value)
	{
		unset($this->XMLObject->galerieid);
		$this->XMLObject->addChild('galerieid', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());

	}
	
	public function _setWasserzeichen($value)
	{
		unset($this->XMLObject->wasserzeichen);
		$this->XMLObject->addChild('wasserzeichen', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());

	}
	
	public function _setFotografenID($value)
	{
		unset($this->XMLObject->idfotograf);
		$this->XMLObject->addChild('idfotograf', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());

	}

	public function _setWatermarkTransparency($value)
	{
		unset($this->XMLObject->watermarktrans);
		$this->XMLObject->addChild('watermarktrans', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());

	}
	
	public function _setBestellungID($value)
	{
		unset($this->XMLObject->idbestellung);
		$this->XMLObject->addChild('idbestellung', $value);
		$this->_writeXMLFile($this->XMLObject->asXML());

	}
	
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
	
}
?>