<?php
class deletebild extends database implements deleteinterface
{
	public function __construct()
	{

	}

	public function delete($object, $id)
	{
		$database = new database();
		$alleBilderInstance = $database->_getBilder();
		$alleBilderArray = $alleBilderInstance->_ausgeben();
		$einzelbild = null;
		foreach ($alleBilderArray as $data)
		{
			if ($data['id'] == $id)
			{
				$einzelbild = $data;
			}
		}

		if ($einzelbild != null)
		{
			@unlink('./view/images/galeriebilder/'.$einzelbild['galerie'].'/'.$einzelbild['bildname']);
			@unlink('./view/images/galeriebilder/'.$einzelbild['galerie'].'/'.$einzelbild['iconname']);
		}

		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");

		$res = $db->query('DELETE FROM bild WHERE idbild ='.$id);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}

		$alleKundenGalerienInstance = $database->_getGalerien();
		$alleKundenGalerienArray = $alleKundenGalerienInstance->_ausgeben();

		$alleOeffentlichenGalerienInstance = $database->_getOeffentlicheGalerien();
		$alleOeffentlichenGalerienArray = $alleOeffentlichenGalerienInstance->_ausgeben();

		$alleGalerienArray = array_merge($alleKundenGalerienArray, $alleOeffentlichenGalerienArray);

		$aktuelleGalerie = null;
		foreach ($alleGalerienArray as $data)
		{
			if ($data['id'] == $einzelbild['galerie'])
			{
				$aktuelleGalerie = $data;
			}
		}
		$aktuelleGalerie['bildanzahl']--;
		$neueGalerie = new galerie($aktuelleGalerie['id'], null, null, null, $aktuelleGalerie['bildanzahl'], null);
		$database->_update($neueGalerie);

	}
}