<?php
class updatefotograf extends database implements updateinterface
{
	public function __construct()
	{
		
	}
	
	public function update($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'fotograf';
		$fotograf = $object->_ausgeben();
		
		/// @todo Wenn der Loginname leer ist, muss auch das Passwort gelöscht werden
		
		$field_values = array(	'vorname'	=> $fotograf['vorname'],
								'name'		=> $fotograf['name'],
								'loginname'	=> $fotograf['loginname']);
		
		if ($fotograf['passwort'] != null)
		{
			$field_values = array_merge($field_values, array('passwort' => $fotograf['passwort']));
		}
		
		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_UPDATE, 'idfotograf='.$fotograf['id']);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
	}
}