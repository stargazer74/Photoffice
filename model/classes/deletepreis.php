<?php
class deletepreis extends database implements deleteinterface
{
	public function __construct()
	{
		
	}
	
	public function delete($object, $id)
	{
		$arr = explode(',', $id);
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");

		$res = $db->query('DELETE FROM preis WHERE Papier_idPapier = '.$arr[0].' AND Bildformate_idBildformate = '.$arr[1]);
		
		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}


	}
}