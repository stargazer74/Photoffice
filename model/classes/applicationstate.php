<?php

/**
*
* Sets the appstate and read/write the values in the  appstate.xml
* file.
* Singletons
* @license LGPL http://www.gnu.org/licenses/lgpl-3.0.html
* @author Chris Wohlbrecht
*
*/

class application
{
	static private $instance = NULL;
	private $GalerieID;

	private function __construct()
	{
		$this->GalerieID = $_SESSION['GalerieID'];
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

/////////////////////////////////////////////////////////////////////
//
//get methods
//
/////////////////////////////////////////////////////////////////////
	public function _getIDKunde()
	{
		return $_SESSION['IDKunde'];
	}

	public function _getSucheNach()
	{
		if (!isset($_SESSION['SucheNach']))
		{
			$_SESSION['SucheNach'] = "nachname";
		}
		return $_SESSION['SucheNach'];
	}

	public function _getSuchbegriff()
	{
		return $_SESSION['Suchbegriff'];
	}

	public function _getHowmany()
	{
		if (!isset($_SESSION['Howmany']))
		{
			$_SESSION['Howmany'] = '20';
		}
		return $_SESSION['Howmany'];
	}

	public function _getPageID()
	{
		return $_SESSION['PageID'];
	}

	public function _getGalerieID()
	{
		return $this->GalerieID;
		//return $_SESSION['GalerieID'];
	}

	public function _getWasserzeichen()
	{
		return true;
		//return $_SESSION['Wasserzeichen'];
	}

	public function _getFotografenID()
	{
		return $_SESSION['FotografenID'];
	}

	public function _getWatermarkTransparency()
	{
		return $_SESSION['WatermarkTransparency'];
	}

	public function _getBestellungID()
	{
		return $_SESSION['BestellungID'];
	}
	
	public function _getNutzerID()
	{
		return $_SESSION['benutzerid'];
	}
	
/**
 * 
 * the current order saved in the session
 * 
 */
	public function _getAktuelleBestellung()
	{
		return $_SESSION['aktuelleBestellung'];
	}

///////////////////////////////////////////////////////////////////////////
//
// set methods
// 
//////////////////////////////////////////////////////////////////////////
	
	public function _setIDKunde($value)
	{
		$_SESSION['IDKunde'] = $value;
	}

	public function _setSucheNach($value)
	{
		$_SESSION['SucheNach'] = $value;
	}

	public function _setSuchbegriff($value)
	{
		$_SESSION['Suchbegriff'] = $value;
	}

	public function _setHowmany($value)
	{
		$_SESSION['Howmany'] = $value;
	}

	public function _setPageID($value)
	{
		$_SESSION['PageID'] = $value;
	}

	public function _setGalerieID($value)
	{
		$_SESSION['GalerieID'] = $value;
	}

	public function _setWasserzeichen($value)
	{
		$_SESSION['Wasserzeichen'] = $value;
	}

	public function _setFotografenID($value)
	{
		$_SESSION['FotografenID'] = $value;
	}

	public function _setWatermarkTransparency($value)
	{
		$_SESSION['WatermarkTransparency'] = $value;
	}

	public function _setBestellungID($value)
	{
		$_SESSION['BestellungID'] = $value;
	}
	
	public function _setNutzerID($value)
	{
		$_SESSION['benutzerid'] = $value;
	}
	
/**
 * 
 * the current order saved in the session
 * @param Array $value
 */
	public function _setAktuelleBestellung($value)
	{
		$_SESSION['aktuelleBestellung'] = $value;
	}
}
?>