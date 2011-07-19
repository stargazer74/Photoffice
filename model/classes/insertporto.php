<?php
class insertporto extends database implements insertinterface
{
	public function __construct()
	{

	}

	public function insert($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'versandkosten';
		$porto = $object->_ausgeben();
		$field_values = array(	'versandart' 	=> $porto['porto'],
								'versandkosten' => $porto['preis']);
		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_INSERT);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
	}
}