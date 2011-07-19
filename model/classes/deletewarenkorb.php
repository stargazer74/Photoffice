<?php
class deletewarenkorb extends database implements deleteinterface
{
	public function __construct()
	{
		
	}
	
	public function delete($object, $id)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");

		$res = $db->query('DELETE FROM bestellung WHERE idBestellung='.$id);
		
		if (PEAR::isError($res))
		{
			if ($res->getMessage() == 'DB Error: syntax error')
			{
				echo 'Ihr Warenkorb ist leer.';
				die;
			}
		}
		
		$res = $db->query('DELETE FROM bestellung_has_bild WHERE Bestellung_idBestellung='.$id);
		
		if (PEAR::isError($res))
		{
			if ($res->getMessage() == 'DB Error: syntax error')
			{
				echo 'Ihr Warenkorb ist leer.';
				die;
			}
		}


	}
}