<?php
class insertfotograf extends database implements insertinterface
{
	public function __construct()
	{
		
	}
	
	public function insert($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'fotograf';
		$fotograf = $object->_ausgeben();
		
		$field_values = array(	'Firma_idFirma'	=> $fotograf['firmenid'],
								'vorname'		=> $fotograf['vorname'],
								'name'			=> $fotograf['name'],
								'loginname'		=> $fotograf['loginname'],
								'passwort'		=> $fotograf['passwort']);
		
		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_INSERT);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
	}
}