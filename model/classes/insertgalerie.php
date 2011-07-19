<?php
class insertgalerie extends database implements insertinterface
{
	public function __construct()
	{
		
	}
	
	public function insert($object)
	{
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");
		$tablename = 'gallerien';
		$galerie = $object->_ausgeben();

		$field_values = array(	'galleriename'		=> $galerie['galeriename'],
								'online'			=> $galerie['online'],
								'verfallsdatum'		=> $galerie['verfallsdatum'],
								'bildanzahl'		=> $galerie['bildanzahl'],
								'Kunden_idKunden' 	=> $galerie['idkunde'],
								'nurpreise' 		=> $galerie['nurpreise']);
		
		$res = $db->autoExecute($tablename, $field_values, DB_AUTOQUERY_INSERT);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}

		$alleGalerienInstance = $this->_getGalerien();
		$alleGalerienArray = $alleGalerienInstance->_ausgeben();
		$letzteID = 0;
		foreach ($alleGalerienArray as $data)
		{
			if ($data['id'] > $letzteID)
			{
				$letzteID = $data['id'];
			}
		}
		
		if (mkdir($_SERVER['DOCUMENT_ROOT'].'/photoffice/view/images/galeriebilder/'.$letzteID) && chmod($_SERVER['DOCUMENT_ROOT'].'/photoffice/view/images/galeriebilder/'.$letzteID, 0777))
		{
			return true;
		}else{
			return false;
		}
	}
}