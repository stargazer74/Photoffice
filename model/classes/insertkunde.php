<?php
class insertkunde extends database implements insertinterface
{
	public function __construct()
	{
		
	}
	
	public function insert($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'kunden';
		$kunde = $object->_ausgeben();
		

		$field_values = array(	'kundennummer'	=> $kunde['kundennummer'],
								'firma'			=> $kunde['firma'],
								'vorname'		=> $kunde['vorname'],
								'name'			=> $kunde['nachname'],
								'strasse'		=> $kunde['strasse'],
								'hausnummer'	=> $kunde['hausnummer'],
								'plz'			=> $kunde['plz'],
								'stadt'			=> $kunde['stadt'],
								'telefon'		=> $kunde['telefonnummer'],
								'email' 		=> $kunde['email']);
		
		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_INSERT);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
	}
}