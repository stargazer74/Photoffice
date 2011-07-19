<?php
class updatekunde extends database implements updateinterface
{
	public function __construct()
	{
		
	}
	
	public function update($object)
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
								'email' 		=> $kunde['email'],
								'passwort'		=> $kunde['passwort']);
		
		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_UPDATE, 'idKunden='.$kunde['id']);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
	}
}