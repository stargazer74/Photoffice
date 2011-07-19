<?php
class insertbild extends database implements insertinterface
{
	public function __construct()
	{
		
	}
	
	public function insert($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'bild';
		$bild = $object->_ausgeben();
		

		$field_values = array(	'position'				=> 0,
								'fotograf_idfotograf'	=> $bild['fotograf'],
								'gallerien_idgallerien'	=> $bild['galerie'],
								'bildname'				=> $bild['bildname'],
								'iconname'				=> $bild['iconname'],
								'online'				=> $bild['isonline'],
								'blende'				=> $bild['blende'],
								'belichtungszeit'		=> $bild['belichtungszeit'],
								'brennweite'			=> $bild['brennweite'],
								'iso' 					=> $bild['iso'],
								'blitz'					=> $bild['blitz'],
								'marke'					=> $bild['marke'],
								'model'					=> $bild['model'],
								'aufnahmezeitpunkt'		=> $bild['aufnahmezeitpunkt'],
								'aenderungszeit'		=> $bild['aenderungszeit']);
		
		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_INSERT);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
		$database = new database();
		$alleGalerienInstance = $database->_getGalerien();
		$alleGalerienArray = $alleGalerienInstance->_ausgeben();
		$aktuelleGalerie = null;
		foreach ($alleGalerienArray as $data)
		{
			if ($data['id'] == $bild['galerie'])
			{
				$aktuelleGalerie = $data;
			}
		}
		$aktuelleGalerie['bildanzahl']++;
		$neueGalerie = new galerie($aktuelleGalerie['id'], null, null, null, $aktuelleGalerie['bildanzahl'], null);
		$database->_update($neueGalerie);
		return true;
	}
}