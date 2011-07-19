<?php

require_once ('./view/showbehavior.php');


class bestellungslisteinhalt_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		/// @todo: Nur abgeschlossene Bestellungen anzeigen.
		$db = new database();
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();

		$this->tpl->loadTemplateFile('bestellungslisteinhalt.tpl');
		$this->tpl->touchBlock('BESTELLUNGSLISTE');
					
		$alleBestellungenInstance = $db->_getBestellungen();
		$alleBestellungenArray = $alleBestellungenInstance->_ausgeben();
		
		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();
		$aktuellerKunde = null;
		
		if (count($alleBestellungenArray) > 0)
		{
			$this->tpl->touchBlock('BESTELLUNGSLISTE');	
			foreach ($alleBestellungenArray as $key => $bestelldaten)
			{
				if ($bestelldaten['kundeabgeschlossen'])
				{
					foreach ($alleKundenArray as $kundedaten)
					{
						if ($kundedaten['id'] == $bestelldaten['idkunde'])
						{
							$aktuellerKunde = $kundedaten;
						}
					}
					if($key % 2 == 0)
					{
						$this->tpl->setVariable('LISTBACKGROUND', 'lightbackground');
					}	
					$this->tpl->setCurrentBlock('LISTE');
					$this->tpl->setVariable('KUNDENNUMMER', $aktuellerKunde['kundennummer']);
					$this->tpl->setVariable('NAME', $aktuellerKunde['vorname'] . ' ' . $aktuellerKunde['nachname']);
					$this->tpl->setVariable('PREIS', $bestelldaten['bestellwert'] . ' €');
					if ($bestelldaten['fotografabgeschlossen'] == false)
					{
						$this->tpl->setVariable('FUNKTION', 'mail('.$bestelldaten['id'].')');	
						$this->tpl->setVariable('MAILBUTTONCSS', 'mail_button');	
					}else{
						$this->tpl->setVariable('FUNKTION', 'void()');
						$this->tpl->setVariable('MAILBUTTONCSS', 'finished');
					}
					$this->tpl->setVariable('WAS', 'warenkorb');
					$this->tpl->setVariable('BESTELLID', $bestelldaten['id']);
					$this->tpl->parseCurrentBlock('LISTE');
				}
			}
		}else{
			//$this->tpl->touchBlock('KEINEBESTELLUNG');
		}
		
		$this->tpl->show();
	}
}
?>