<?php

require_once ('./view/showbehavior.php');


class generierebestellungspdf_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$applicationStateInstance = application::getInstance();
		$bestellungsid = $applicationStateInstance->_getBestellungID();
		
		//Bestellung finden
		$db = new database();
		$alleBestellungenInstance = $db->_getBestellungen();
		$alleBestellungenArray = $alleBestellungenInstance->_ausgeben();
		
		$gesuchteBestellung = null;
		foreach ($alleBestellungenArray as $bestellungsdaten)
		{
			if($bestellungsdaten['id'] == $bestellungsid)
			{
				$gesuchteBestellung = $bestellungsdaten;
			}
		}
		
		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();
		$gesuchterKunde = null;
		
		foreach ($alleKundenArray as $kunde)
		{
			if ($gesuchteBestellung['idkunde'] == $kunde['id'])
			{
				$gesuchterKunde = $kunde;
			}
		}		

		$tmp = explode(' ', $gesuchteBestellung['datum']);
		$datum = datum::_changeDateFormat('de', $tmp[0]);
		
		//Uhrzeit ist tmp[1]		
		
		$allePreiseInstance = $db->_getPreise();
		$allePreiseArray = $allePreiseInstance->_ausgeben();
		
		$alleBilderInstance = $db->_getBilder();
		$alleBilderArray = $alleBilderInstance->_ausgeben();
		//Datenarray befüllem
		$data = array();
		foreach ($gesuchteBestellung['bilder'] as $key => $bild)
		{
			$tmp_array = array();
			foreach ($allePreiseArray as $preis)
			{
				if ($preis['idbildformat'] == $bild['bildformat'] && $preis['idpapiertyp'] == $bild['papiertyp'])
				{
					$tmp_array[] = $preis['papiertyp'] . ' ' . $preis['bildformat'];
					$tmp_array[] = $preis['preis'].' EUR';
				}
			}
			$tmp_array[] = $bild['anzahlbilder'];
			foreach ($alleBilderArray as $pictures)
			{
				if ($pictures['id'] == $bild['id'])
				{
					$tmp_array[] = $pictures['bildname'];
				}
			}
			
			$data[] = $tmp_array;
		}
		//print_r($data);
		$pdf = new pdf_bestellung();
		$pdf->_setTitel('Bestellung von '.$gesuchterKunde['vorname'].' '.$gesuchterKunde['nachname'].' vom '.$datum.' '.$tmp[1]);
		$pdf->AliasNbPages();
		$pdf->SetFont('Arial', '', 10);
		$header = array('Bildformat', 'Preis', 'Anzahl', 'Bild');
		$pdf->AddPage();
		$pdf->createTable($header, $data);

		$pdf->Output();
	}
}
?>