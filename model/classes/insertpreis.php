<?php
class insertpreis extends database implements insertinterface
{
	public function __construct()
	{
		
	}
	
	public function insert($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'preis';
		$preis = $object->_ausgeben();
		
		if(strpos($preis['preis'], ','))
		{
			$preis['preis'] = str_replace(',', '.', $preis['preis']);
		}

		$field_values = array(	'Papier_idPapier'			=> $preis['idpapiertyp'],
								'Bildformate_idBildformate'	=> $preis['idbildformat'],
								'preis' 					=> $preis['preis']);
		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_INSERT);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
	}
}