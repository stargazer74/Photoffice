<?php

require_once ('./view/showbehavior.php');


class bestellungsdaten_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();	
		$this->tpl->loadTemplatefile("bestellungsdaten.tpl");
		$this->tpl->touchBlock('BESTELLUNGSDATEN');
		
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

		$tmp = explode(' ', $gesuchteBestellung['datum']);
		$datum = datum::_changeDateFormat('de', $tmp[0]);

		$this->tpl->setVariable('DATUM', $datum);
		$this->tpl->setVariable('UHRZEIT', $tmp[1]);
		
		$allePreiseInstance = $db->_getPreise();
		$allePreiseArray = $allePreiseInstance->_ausgeben();
		
		$alleBilderInstance = $db->_getBilder();
		$alleBilderArray = $alleBilderInstance->_ausgeben();
		
		foreach ($gesuchteBestellung['bilder'] as $key => $bild)
		{
			if($key % 2 == 0)
			{
				$this->tpl->setVariable('LISTBACKGROUND', 'lightbackground');
			}
			$this->tpl->setCurrentBlock('BILDLISTE');
			foreach ($allePreiseArray as $preis)
			{
				if ($preis['idbildformat'] == $bild['bildformat'] && $preis['idpapiertyp'] == $bild['papiertyp'])
				{
					$this->tpl->setVariable('FORMAT', $preis['papiertyp'] . ' ' . $preis['bildformat']);
					$this->tpl->setVariable('PREIS', $preis['preis']);
				}
			}
			$this->tpl->setVariable('BILDANZAHL', $bild['anzahlbilder']);
			foreach ($alleBilderArray as $pictures)
			{
				if ($pictures['id'] == $bild['id'])
				{
					$this->tpl->setVariable('BILDNAME', $pictures['bildname']);
				}
			}
			$this->tpl->parseCurrentBlock('BILDLISTE');
		}
		$this->tpl->show();
	}
}
?>