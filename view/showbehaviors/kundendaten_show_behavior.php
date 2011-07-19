<?php

require_once ('./view/showbehavior.php');


class kundendaten_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();		
		$this->tpl->loadTemplatefile("kundendaten.tpl");
		
		
		if(isset($_REQUEST['kundenid']) && $_REQUEST['kundenid'] != null)
		{
			
			
			$db = new database();
			$alleKundenInstance = $db->_getKunden();
			$alleKundenArray = $alleKundenInstance->_ausgeben();
			
			//gesuchten Kunden finden
			$gesuchterKunde = array();
			foreach ($alleKundenArray as $data)
			{
				if($data['id'] == $_REQUEST['kundenid'])
				{
					$gesuchterKunde[] = $data;
				}
			}
			
			//Daten in Template eintragen
			if($gesuchterKunde == null)
			{
				$this->tpl->touchBlock('KUNDENDATENERROR');
			}else{
				$this->tpl->touchBlock('KUNDENDATEN');
				
				$this->tpl->setVariable('KUNDENNUMMER', $gesuchterKunde[0]['kundennummer']);
				$this->tpl->setVariable('FIRMA', $gesuchterKunde[0]['firma']);
				$this->tpl->setVariable('VORNAME', $gesuchterKunde[0]['vorname']);
				$this->tpl->setVariable('NAME', $gesuchterKunde[0]['nachname']);
				$this->tpl->setVariable('STRASSE', $gesuchterKunde[0]['strasse']);
				$this->tpl->setVariable('HAUSNUMMER', $gesuchterKunde[0]['hausnummer']);
				$this->tpl->setVariable('PLZ', $gesuchterKunde[0]['plz']);
				$this->tpl->setVariable('STADT', $gesuchterKunde[0]['stadt']);
				$this->tpl->setVariable('TELEFON', $gesuchterKunde[0]['telefonnummer']);
				$this->tpl->setVariable('EMAIL', $gesuchterKunde[0]['email']);
			}
			
		}else{
			$this->tpl->touchBlock('KUNDENDATENERROR');
		}

		
		$this->tpl->show();
	}
}
?>