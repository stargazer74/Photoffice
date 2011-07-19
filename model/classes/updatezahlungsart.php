<?php
class updatezahlungsart extends database implements updateinterface
{
	public function __construct()
	{

	}

	public function update($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'zahlungsart';

		$zahlungsartArray = $object->_ausgeben();

		$field_values = array(	'aktiv'	=> $zahlungsartArray['aktiv']);

		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_UPDATE, 'idZahlungsart='.$zahlungsartArray['idzahlungsart']);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
	}
}