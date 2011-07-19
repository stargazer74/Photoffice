<?php
class deletefotograf extends database implements deleteinterface
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
		$res = $db->query('DELETE FROM fotograf WHERE idfotograf='.$id);
		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}			

	}
}