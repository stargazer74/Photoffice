<?php

require_once ('./view/showbehavior.php');


class warenkorb_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$db = new database();
		$this->tpl->loadTemplateFile('warenkorb.tpl');

		//aktuelle Bestellung liegt (wie in kundeeinzelgalerie_show_behavior.php)
		//ausschliesslich in der Session, nicht in der DB - erst beim
		//endgueltigen Absenden (bestellungabsenden) wird daraus ein
		//DB-Datensatz.
		$applicationStateInstance = application::getInstance();
		$aktuelleBestellungInstance = $applicationStateInstance->_getAktuelleBestellung();
		$aktuelleBestellung = null;
		if ($aktuelleBestellungInstance)
		{
			$aktuelleBestellung = $aktuelleBestellungInstance->_ausgeben();
		}
		if ($aktuelleBestellung == null || count($aktuelleBestellung['bilder']) == 0)
		{
			$this->tpl->setCurrentBlock('WARENKORB');
			$this->tpl->setVariable('GESAMTPREIS', '0.00');
		}else{
			$distinctAktuelleBestellung = array();
			foreach ($aktuelleBestellung['bilder'] as $bestellungdaten)
			{
				$istInArray = false;
				if (count($distinctAktuelleBestellung) == 0)
				{
					$distinctAktuelleBestellung[] = $bestellungdaten;
				}else{
					foreach ($distinctAktuelleBestellung as $key => $data)
					{
						if ($data['papiertyp'] == $bestellungdaten['papiertyp'] && $data['bildformat'] == $bestellungdaten['bildformat'])
						{
							$istInArray = true;						 
						}
					}
					if ($istInArray)
					{
						foreach ($distinctAktuelleBestellung as $key => $data)
						{
							if ($data['papiertyp'] == $bestellungdaten['papiertyp'] && $data['bildformat'] == $bestellungdaten['bildformat'])
							{
								$distinctAktuelleBestellung[$key]['anzahlbilder'] += $bestellungdaten['anzahlbilder'];					 
							}
						}
					}else{
						$distinctAktuelleBestellung[] = $bestellungdaten;
					}
				}
	
			}
			//print_r($distinctAktuelleBestellung);
			
			$allePreiseInstance = $db->_getPreise();
			$allePreiseArray = $allePreiseInstance->_ausgeben();
			
			foreach ($distinctAktuelleBestellung as $data)
			{
				foreach ($allePreiseArray as $preisdaten)
				{
					if ($preisdaten['idpapiertyp'] == $data['papiertyp'] && $preisdaten['idbildformat'] == $data['bildformat'])
					{
						$this->tpl->setCurrentBlock('BESTELLPOSTEN');
						$this->tpl->setVariable('FORMAT', $preisdaten['papiertyp'] .' '. $preisdaten['bildformat']);
						$this->tpl->setVariable('BILDANZAHL', $data['anzahlbilder']);
						$preis = $preisdaten['preis']*$data['anzahlbilder'];
						$preis = string::genPreisString($preis);
						$this->tpl->setVariable('PREIS', $preis);
						$this->tpl->parseCurrentBlock('BESTELLPOSTEN');					
					}
				}
			}
			$this->tpl->setCurrentBlock('WARENKORB');
			$this->tpl->setVariable('GESAMTPREIS', string::genPreisString($aktuelleBestellung['bestellwert']));
		}

		$this->tpl->touchBlock('WARENKORB');
		$this->tpl->show();
	}
}
?>