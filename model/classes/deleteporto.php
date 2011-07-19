<?php
class deleteporto extends database implements deleteinterface
{
	public function __construct()
	{

	}

	public function delete($object, $id)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");

		$res = $db->query('DELETE FROM versandkosten WHERE idVersandkosten='.$id);
		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}


	}
}