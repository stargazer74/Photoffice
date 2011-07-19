<?php

require_once ('./view/showbehavior.php');


class fotodaten_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		
		$this->tpl->loadTemplatefile("fotodaten.tpl");
		$this->tpl->touchBlock('FOTODATEN');		
		
		$db = new database();
		$allePreiseInstance = $db->_getPreise();		
		$allePreiseArray = $allePreiseInstance->_ausgeben();
		
		$alleBildFormateInstance = $db->_getBildFormate();
		$alleBildFormateArray = $alleBildFormateInstance->_ausgeben();
		
		$allePapierFormateInstance = $db->_getPapierFormate();
		$allePapierFormateArray = $allePapierFormateInstance->_ausgeben();

		/**
		 * 
		 * Aufbau der Formulare zum Eintragen
		 * 
		 */		
		
		//Preise
		
		$preisform = new HTML_QuickForm('insertpreisform', 'POST', 'fotodaten.html');
		$preisevent = HTML_QuickForm::createElement('hidden', 'preisevent', 'preis');
		$papierformat = HTML_QuickForm::createElement('select', 'papierformat', 'Papierformat', null, 'class="form"');
		$papierformat->addOption('-- Bitte auswählen --','');
		foreach($allePapierFormateArray as $data)
		{
			$papierformat->addOption($data['papierformat'],$data['idpapierformat']);
		}
		$bildformat = HTML_QuickForm::createElement('select', 'bildformatpreis', 'Bildformat', null, 'class="form"');
		$bildformat->addOption('-- Bitte auswählen --','');
		foreach($alleBildFormateArray as $data)
		{
			$bildformat->addOption($data['bildformat'],$data['idbildformat']);
		}
		$preis = HTML_QuickForm::createElement('text', 'preis', 'Preis', array('class="form"', 'size="5"', 'maxlength="5"'));
		$submitpreis = HTML_QuickForm::createElement('submit', 'submitpreis', 'Preis eintragen', 'class="form"');
		
		$preisform->addElement($preisevent);
		$preisform->addElement($papierformat);
		$preisform->addElement($bildformat);
		$preisform->addElement($preis);
		$preisform->addElement($submitpreis);	

		//Rules
		$preisform->registerRule('chkIfPreisExists', 'callback', '_chkIfPreisExists', 'chkfunctions');
		$formulardaten = array($papierformat->getValue(), $bildformat->getValue());
		$preisform->addRule('submitpreis', 'Die Preiskombination existiert schon!', 'chkIfPreisExists', $formulardaten);
		$preisform->addRule('papierformat', 'Bitte wählen Sie ein Papierformat!', 'required');
		$preisform->addRule('bildformatpreis', 'Bitte wählen Sie ein Bildformat!', 'required');
		$preisform->addRule('preis', 'Sie müssen einen Preis eintragen!', 'required');
		$preisform->addRule('preis', '"Preis" kann nur ein numerischer, durch \'.\' getrennter, Wert sein!', 'numeric');

		if($_POST['preisevent'] != 'preis')
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$preisform->accept($renderer);
		}else{
			if(false == $preisform->validate())
			{
				$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
				$renderer->setErrorTemplate('');
				$preisform->accept($renderer);
			}else{			
				$preisvalue = $preis->getValue();
				$papierformatvalue = $papierformat->getValue();
				$bildformatvalue = $bildformat->getValue();
				$neuerPreis = new preis($preisvalue, $papierformatvalue[0], null, $bildformatvalue[0], null);
				if($db->_insert($neuerPreis))
				{
					header("Location:./fotodaten.html");
				}else{
					throw new Exception("Kann die Daten nicht eintragen");
				}	
			}			
		}		
		
		//Bild
		
		$bildform = new HTML_QuickForm('insertbildformatform', 'POST', 'fotodaten.html');
		$bildevent = HTML_QuickForm::createElement('hidden', 'bildevent', 'bild');
		$bildformat = HTML_QuickForm::createElement('text', 'bildformat', 'Bildformat', array('class="form"', 'size="30"', 'maxlength="25"'));
		$submitbild = HTML_QuickForm::createElement('submit', 'submitbild', 'Neues Bildformat eintragen', 'class="form"');
		
		$bildform->addElement($bildevent);
		$bildform->addElement($bildformat);
		$bildform->addElement($submitbild);	

		//Rules
		$bildform->registerRule('chkIfBildFormatExists', 'callback', '_chkIfBildFormatExists', 'chkfunctions');
		$formulardaten = $bildformat->getValue();
		$bildform->addRule('submitbild', 'Dieses Bildformat existiert schon!', 'chkIfBildFormatExists', $formulardaten);
		$bildform->addRule('bildformat', 'Bitte tragen Sie ein Bildformat ein!', 'required');
		
		if($_POST['bildevent'] != 'bild')
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$bildform->accept($renderer);
		}else{
			if(false == $bildform->validate())
			{
				$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
				$renderer->setErrorTemplate('');
				$bildform->accept($renderer);
			}else{
				$neuesBildFormat = new bildformat(null, $bildformat->getValue());
				if($db->_insert($neuesBildFormat))
				{
					header("Location:./fotodaten.html");
				}else{
					throw new Exception("Kann die Daten nicht eintragen");
				}	
			}
		}
		
		
		//Papier
		
		$papierform = new HTML_QuickForm('insertpapierformatform', 'POST', 'fotodaten.html');
		$papierevent = HTML_QuickForm::createElement('hidden', 'papierevent', 'papier');
		$papierformat = HTML_QuickForm::createElement('text', 'papierformat', 'Papierformat', array('class="form"', 'size="30"', 'maxlength="25"'));
		$submitpapier = HTML_QuickForm::createElement('submit', 'submitpapier', 'Neues Papierformat eintragen', 'class="form"');
		
		$papierform->addElement($papierevent);
		$papierform->addElement($papierformat);
		$papierform->addElement($submitpapier);	

		//Rules
		$papierform->registerRule('chkIfPapierFormatExists', 'callback', '_chkIfPapierFormatExists', 'chkfunctions');
		$formulardaten = $papierformat->getValue();
		$papierform->addRule('submitpapier', 'Dieses Papierformat existiert schon!', 'chkIfPapierFormatExists', $formulardaten);
		$papierform->addRule('papierformat', 'Bitte tragen Sie ein Papierformat ein!', 'required');
		
		if($_POST['papierevent'] != 'papier')
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$papierform->accept($renderer);
		}else{
			if(false == $papierform->validate())
			{
				$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
				$renderer->setErrorTemplate('');
				$papierform->accept($renderer);
			}else{
				$neuesPapierFormat = new papierformat(null, $papierformat->getValue());
				if($db->_insert($neuesPapierFormat))
				{
					header("Location:./fotodaten.html");
				}else{
					throw new Exception("Kann die Daten nicht eintragen");
				}				
			}
		}

		/**
		 * 
		 * Aufbau der Listen
		 * 
		 */

		//Preise
		
		/// @todo Sortierfunktion kapseln
		/*
		$sortArray = array();
    	foreach($allePreiseArray as $key => $array) 
    	{
        	$sortArray[$key] = $array['bildformat'];
    	}
		array_multisort($sortArray, SORT_ASC, SORT_REGULAR, $allePreiseArray); 
		*/
		foreach ($allePreiseArray as $key => $data)
		{
			$this->tpl->setCurrentBlock('LISTEPREISE');
			if($key % 2 == 0)
			{
				$this->tpl->setVariable('LISTBACKGROUND', 'lightbackground');
			}else{
				
			}
			$this->tpl->setVariable('PREISLISTEBILDFORMAT', $data['bildformat']);
			$this->tpl->setVariable('PREISLISTEPAPIERFORMAT', $data['papiertyp']);
			$this->tpl->setVariable('PREIS', $data['preis']);
			$this->tpl->setVariable('WAS', 'preis');
			$this->tpl->setVariable('IDPAPIER', $data['idpapiertyp']);
			$this->tpl->setVariable('IDBILD', $data['idbildformat']);
			$this->tpl->parseCurrentBlock('LISTEPREISE');			
		}
		
		//Bildformate
		
		foreach ($alleBildFormateArray as $key => $data)
		{
			$this->tpl->setCurrentBlock('LISTEBILDFORMATE');
			if($key % 2 == 0)
			{
				$this->tpl->setVariable('LISTBACKGROUND', 'lightbackground');
			}else{
				
			}			
			$this->tpl->setVariable('BILDFORMAT', $data['bildformat']);
			$this->tpl->setVariable('WAS', 'bildformat');
			$this->tpl->setVariable('ID', $data['idbildformat']);
			$this->tpl->parseCurrentBlock('LISTEBILDFORMATE');
		}
		
		//Papierformate
		
		foreach ($allePapierFormateArray as $key => $data)
		{
			$this->tpl->setCurrentBlock('LISTEPAPIERFORMATE');
			if($key % 2 == 0)
			{
				$this->tpl->setVariable('LISTBACKGROUND', 'lightbackground');
			}else{
				
			}			
			$this->tpl->setVariable('PAPIERFORMAT', $data['papierformat']);
			$this->tpl->setVariable('WAS', 'papierformat');
			$this->tpl->setVariable('ID', $data['idpapierformat']);
			$this->tpl->parseCurrentBlock('LISTEPAPIERFORMATE');
		}

		$this->tpl->show();

	}
}
?>