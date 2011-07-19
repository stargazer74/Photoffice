<?php
class deletebildformat extends database implements deleteinterface
{
	public function __construct()
	{
		
	}
	
	public function delete($object, $id)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");

		$res = $db->query('DELETE FROM bildformate WHERE idBildformate = '.$id);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
		$res = $db->query('DELETE FROM preis WHERE Bildformate_idBildformate = '.$id);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
	}
}