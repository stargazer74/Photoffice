<?php

class kundenlogincheck
{
	function __construct()
	{

	}
	public static function _chkKundenLogin($fields, $felder)
	{
		$registryInstance = registry::getInstance();
		$database = new database();
		$alleKundenInstance = $database->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();

		$tmp = 0;
		foreach($alleKundenArray as $logindata)
		{
			if($logindata['passwort'] == md5($fields))
			{
				$tmp = 1;
				$registryInstance->_setBenutzerName($logindata['vorname'], $logindata['nachname']);
				$registryInstance->_setBenutzerID($logindata['id']);

			}
		}//end foreach
		if($tmp == 1)
		{
			$applicationstate = application::getInstance();
			$applicationstate->_addRole("customer");
			return TRUE;

		}else{//end if
			return FALSE;
		}//end else

	}

}
?>