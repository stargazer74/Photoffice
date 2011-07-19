<?php
class deletegalerie extends database implements deleteinterface
{
	public function __construct()
	{

	}

	public function delete($object, $id)
	{
		$database = new database();
		$alleBilderInstance = $database->_getBilder();
		$alleBilderArray = $alleBilderInstance->_ausgeben();

		foreach ($alleBilderArray as $data)
		{
			if ($data['galerie'] == $id)
			{
				@unlink('./view/images/galeriebilder/'.$data['galerie'].'/'.$data['bildname']);
				@unlink('./view/images/galeriebilder/'.$data['galerie'].'/'.$data['iconname']);
			}
		}

		rmdir('./view/images/galeriebilder/'.$id);

		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");

		$res = $db->query('DELETE FROM bild WHERE gallerien_idgallerien ='.$id);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}

		$res = $db->query('DELETE FROM kunden_has_gallerien WHERE gallerien_idgallerien ='.$id);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}

		$res = $db->query('DELETE FROM gallerien WHERE idgallerien ='.$id);

		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}

	}
}