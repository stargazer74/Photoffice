<?php
class updategalerie extends database implements updateinterface
{
	public function __construct()
	{
		
	}
	
	public function update($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'gallerien';
		$galerie = $object->_ausgeben();
		
		$field_values = array();
		
		if ($galerie['galeriename'] != '')
		{
			$field_values = array_merge($field_values, array('galleriename' => $galerie['galeriename']));
		}
		if (isset($galerie['online']))
		{
			$field_values = array_merge($field_values, array('online' => $galerie['online']));
		}
		if ($galerie['verfallsdatum'] != '')
		{
			$field_values = array_merge($field_values, array('verfallsdatum' => $galerie['verfallsdatum']));
		}
		if ($galerie['bildanzahl'] !== NULL)
		{
			$field_values = array_merge($field_values, array('bildanzahl' => $galerie['bildanzahl']));
		}
		if ($galerie['nurpreise'] !== NULL)
		{
			$field_values = array_merge($field_values, array('nurpreise' => $galerie['nurpreise']));
		}

		/*
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
		*/
		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_UPDATE, 'idgallerien='.$galerie['id']);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
	}
}