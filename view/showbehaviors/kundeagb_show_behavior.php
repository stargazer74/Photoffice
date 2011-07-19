<?php

require_once ('./view/showbehavior.php');


class kundeagb_show_behavior implements showbehavior
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
		$this->tpl->setVariable('BUTTON_KUNDENAGB', 'kundenagb_no_button');
		$this->tpl->setVariable('BUTTON_PREISLISTE', 'preisliste');
		$this->tpl->setVariable('BUTTON_HILFE', 'hilfe');
		
		$this->tpl->addBlockfile('CONTENTBLOCK', 'allecontentbox', 'kundencontentbox.tpl');
		$this->tpl->touchBlock('KUNDENCONTENT');
		
		$breadcrumbInstance = new breadcrumb('AGB');
		$breadcrumbArray = $breadcrumbInstance->_getBreadcrumbArray();
		foreach($breadcrumbArray as $key => $data)
		{
			$this->tpl->setCurrentBlock('BREADCRUMBNAVI');
			$this->tpl->setVariable('BREADCRUMBLINK', $data);
			$this->tpl->setVariable('BREADCRUMBNAME', $key);
			$this->tpl->parseCurrentBlock("BREADCRUMBNAVI");
		}

		$this->tpl->addBlockfile('CONTENT', 'content', 'kundeagb.tpl');
		$this->tpl->touchBlock('KUNDEAGB');
		
		$db = new database();
		$agb = $db->_getFirmenDaten();
		$agb = $agb[0]['agb'];
		
		$this->tpl->setVariable('AGB', $agb);
		
		$view = view::_getViewInstance();
		$view->_setShowBehavior(new kundenstatusbox_show_behavior);
		$view->_Show();
		
		$view->_setShowBehavior(new kundeinformationbox_show_behavior());
		$view->_Show();

		$this->tpl->show();
	}
}
?>