<?php
class chkfunctions
{
	public function __construct()
	{
		
	}
	
	public static function _chkIfPreisExists($fields, $vergleichsdaten)
	{
		$db = new database();
		$allePreiseInstance = $db->_getPreise();		
		$allePreiseArray = $allePreiseInstance->_ausgeben();
		$treffer = false;
		foreach ($allePreiseArray as $data)
		{
			if ($data['idpapiertyp'] == $vergleichsdaten[0][0] && $data['idbildformat'] == $vergleichsdaten[1][0])
			{
				$treffer = true;
			}
		}

		if ($treffer == true)
		{
			return false;
		}else{
			return true;
		}
	}
	
	public static function _chkIfPapierFormatExists($fields, $formulardaten)
	{
		$db = new database();		
		$allePapierFormateInstance = $db->_getPapierFormate();
		$allePapierFormateArray = $allePapierFormateInstance->_ausgeben();

		$treffer = false;
		foreach ($allePapierFormateArray as $data)
		{
			if (strtolower($data['papierformat']) == strtolower($formulardaten))
			{
				$treffer = true;
			}
		}

		if ($treffer == true)
		{
			return false;
		}else{
			return true;
		}
	}
	
	public static function _chkIfBildFormatExists($fields, $formulardaten)
	{
		$db = new database();
		$alleBildFormateInstance = $db->_getBildFormate();
		$alleBildFormateArray = $alleBildFormateInstance->_ausgeben();
		$treffer = false;
		foreach ($alleBildFormateArray as $data)
		{
			if (strtolower($data['bildformat']) == strtolower($formulardaten))
			{
				$treffer = true;
			}
		}

		if ($treffer == true)
		{
			return false;
		}else{
			return true;
		}
	}
	
	public static function _chkIfCustomerNumberExists($fields, $kundennummer)
	{
		$db = new database();
		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();
		$treffer = false;
		foreach ($alleKundenArray as $data)
		{
			if (strtolower($data['kundennummer']) == strtolower($kundennummer))
			{
				$treffer = true;
			}
		}

		if ($treffer == true)
		{
			return false;
		}else{
			return true;
		}
	}
	
	public static function _chkIfCustomerNumberExistsForUpdate($fields, $formdaten)
	{
		$db = new database();
		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();
		$treffer = false;
		foreach ($alleKundenArray as $data)
		{
			if (strtolower($data['kundennummer']) == strtolower($formdaten[0]) &&  $formdaten[1] != $data['id'])
			{
				$treffer = true;
			}
		}

		if ($treffer == true)
		{
			return false;
		}else{
			return true;
		}
	}
	
	public static function _chkIfPasswortIsEmpty($fields, $formdaten)
	{
		if ($formdaten[0] != '' && $formdaten[1] == '')
		{
			return false;
		}else{
			return true;
		}
	}
	
	public static function _chkIfUsernameIsEmpty($fields, $formdaten)
	{
		if ($formdaten[0] == '' && $formdaten[1] != '')
		{
			return false;
		}else{
			return true;
		}
	}
	
	public static function _chkIfOnlineStatusCanChange($fields, $verfallsdatum)
	{
		if (datum::_checkIfDateIsEqualOrSmaller($verfallsdatum))
		{
			return false;
		}else{
			return true;
		}
	}
	
	public static function _chkIfPreisIsAvailable()
	{
		$db = new database();
		$allePreiseInstance = $db->_getPreise();
		$allePreiseArray = $allePreiseInstance->_ausgeben();
		if (count($allePreiseArray) == 0)
		{
			return false;
		}else{
			return true;
		}
	}
}
?>