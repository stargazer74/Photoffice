<?php

class logincheck
{
	function __construct()
	{
		
	}
	public function _chk_login($fields, $felder)
	{
		$registryInstance = registry::getInstance();
		$database = new database();
		$alleFotografenInstance = $database->_getFotografen();
		$alleFotografenArray = $alleFotografenInstance->_ausgeben();
		
		$tmp = 0;
		foreach($alleFotografenArray as $logindata)
		{
			//print_r($logindata);
			if($logindata['loginname'] == $felder['benutzername'] && $logindata['passwort'] == md5($felder['passwort']))
			{
				$tmp = 1;
				$registryInstance->_setBenutzerName($logindata['vorname'], $logindata['name']);
			}
		}//end foreach
		if($tmp == 1)
		{			
			return TRUE;
			
		}else{//end if
			return FALSE;
		}//end else

	}
	
	public function _checkVersionStatus()
	{
		$registryInstance = registry::getInstance();
		$serialNumber = $registryInstance->_getSerialNumber();
		$date = array('mday' => 35, 'mon' => 10, 'year' => 2010);
		$ip = $_SERVER['SERVER_ADDR'];

		$client = new IXR_Client($registryInstance->_getXmlRpcString());
		if (!$client->query('fotoffice.validatecopy', $serialNumber, $date, $ip)) 
		{
			//return false;
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		if($client->getResponse() == TRUE)
		{
			return TRUE;
		}else{
			return FALSE;
		}
	}
}
?>