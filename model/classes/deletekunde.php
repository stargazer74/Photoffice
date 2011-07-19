<?php
class deletekunde extends database implements deleteinterface
{
	public function __construct()
	{
		
	}
	
	public function delete($object, $id)
	{
		//nur löschen wenn keine offenen bestellungen
		$arr = explode(',', $id);
		$db = DBSINGLETON::_getDBInstance();
		$db->Query("SET CHARACTER SET UTF8");
		$db->Query("SET NAMES UTF8");

		$res = $db->query('DELETE FROM kunden WHERE idKunden='.$id);
		
		if (PEAR::isError($res))
		{
			die($res->getMessage());
		}
		
		//delete Galerien
		$databaseInstance = new database();
		$alleGalerienInstance = $databaseInstance->_getGalerien();
		$alleGalerienArray = $alleGalerienInstance->_ausgeben();
		$alleKundenGalerien = null;
		
		foreach ($alleGalerienArray as $galeriedaten)
		{
			if ($galeriedaten['idkunde'] == $id)
			{
				$alleKundenGalerien[] = $galeriedaten;
			}
		}
		if (count($alleKundenGalerien) > 0)
		{
			foreach ($alleKundenGalerien as $kundengalerie)
			{
				$databaseInstance->_delete('galerie', $kundengalerie['id']);
			}	
		}
		//delete Bestellungen
		$alleBestellungenInstance = $databaseInstance->_getBestellungen();
		$alleBestellungenArray = $alleBestellungenInstance->_ausgeben();
		$alleKundenBestellungen = null;
		
		foreach ($alleBestellungenArray as $bestellungsdaten)
		{
			if ($bestellungsdaten['idkunde'] == $id)
			{
				$alleKundenBestellungen[] = $bestellungsdaten;
			}	
		}
		if (count($alleKundenBestellungen) > 0)
		{
			foreach ($alleKundenBestellungen as $kundenbestellung)
			{
				$databaseInstance->_delete('warenkorb', $kundenbestellung['id']);
			}
		}
	}
}