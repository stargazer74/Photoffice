<?php
class insertpapierformat extends database implements insertinterface
{
	public function __construct()
	{
		
	}
	
	public function insert($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'papier';
		$papierformat = $object->_ausgeben();
		$field_values = array('papiertyp' => $papierformat['papierformat']);
		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_INSERT);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
	}
}