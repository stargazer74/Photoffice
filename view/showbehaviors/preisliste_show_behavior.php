<?php

require_once ('./view/showbehavior.php');


class preisliste_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->loadTemplatefile("mainframekundensicht.tpl");
		$this->tpl->setVariable('PAGETITLE', 'Willkommen ' .$_SESSION['benutzername'] . ' | photoffice Version '.$registryInstance->_getVersionNumber());
		
		//CSS Includes
		
		//JavaScript Includes
		
		$this->tpl->addBlockfile('NAVIGATIONBLOCK', 'kundemainnaviblock', 'kundemainnavi.tpl');
		$this->tpl->touchBlock('KUNDEMAINNAVI');		
		//Mainnavi
		$this->tpl->setVariable('BUTTON_KUNDENGALERIEN', 'bilder');
		$this->tpl->setVariable('BUTTON_KUNDENAGB', 'kundenagb');
		$this->tpl->setVariable('BUTTON_PREISLISTE', 'preisliste_no_button');
		$this->tpl->setVariable('BUTTON_HILFE', 'hilfe');
		
		$this->tpl->addBlockfile('CONTENTBLOCK', 'allecontentbox', 'kundencontentbox.tpl');
		$this->tpl->touchBlock('KUNDENCONTENT');
		
		$breadcrumbInstance = new breadcrumb('Preisliste');
		$breadcrumbArray = $breadcrumbInstance->_getBreadcrumbArray();
		foreach($breadcrumbArray as $key => $data)
		{
			$this->tpl->setCurrentBlock('BREADCRUMBNAVI');
			$this->tpl->setVariable('BREADCRUMBLINK', $data);
			$this->tpl->setVariable('BREADCRUMBNAME', $key);
			$this->tpl->parseCurrentBlock("BREADCRUMBNAVI");
		}

		$this->tpl->addBlockfile('CONTENT', 'content', 'preisliste.tpl');
		$this->tpl->touchBlock('PREISLISTE');
		
		$db = new database();
		$allePreiseInstance = $db->_getPreise();
		$allePreiseArray = $allePreiseInstance->_ausgeben();
		
		$sortArray = array();
    	foreach($allePreiseArray as $key => $array) 
    	{
        	$sortArray[$key] = $array['papiertyp'];
    	}
		array_multisort($sortArray, SORT_ASC, SORT_REGULAR, $allePreiseArray); 

		$allePreiseArraySort = array();
		foreach ($allePreiseArray as $data)
		{
			$allePreiseArraySort[$data['papiertyp']][] = $data;
		}
		
		//print_r($allePreiseArraySort);
		foreach ($allePreiseArraySort as $key => $data)
		{
			$this->tpl->setVariable('PAPIERTYP', $key);
			foreach ($data as $formate)
			{
				$this->tpl->setCurrentBlock('PREISITEM');
				$this->tpl->setVariable('FORMAT', $formate['bildformat']);
				$this->tpl->setVariable('PREIS', $formate['preis'] . ' €');
				$this->tpl->parseCurrentBlock('PREISITEM');
			}
			$this->tpl->parse('PREISTABELLE');
		}
		
		$view = view::_getViewInstance();
		$view->_setShowBehavior(new kundenstatusbox_show_behavior);
		$view->_Show();
		
		$view->_setShowBehavior(new kundeinformationbox_show_behavior());
		$view->_Show();

		$this->tpl->show();
	}
}
?>