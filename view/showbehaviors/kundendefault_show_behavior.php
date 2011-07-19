<?php

require_once ('./view/showbehavior.php');


class kundendefault_show_behavior implements showbehavior
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
		
		$this->tpl->addBlockfile('CONTENTBLOCK', 'allecontentbox', 'kundencontentbox.tpl');
		$this->tpl->touchBlock('KUNDENCONTENT');
		
		$this->tpl->addBlockfile('CAMBACKGROUND', 'cambackground', 'cambackground.tpl');
		$this->tpl->touchBlock('CAMBACKGROUND');
		
		$view = view::_getViewInstance();
		$view->_setShowBehavior(new kundemainnavigation_show_behavior());
		$view->_Show();
		
		//Mainnavi
		$this->tpl->setVariable('BUTTON_KUNDENGALERIEN', 'bilder');
		$this->tpl->setVariable('BUTTON_KUNDENAGB', 'kundenagb');
		$this->tpl->setVariable('BUTTON_PREISLISTE', 'preisliste');

		$view->_setShowBehavior(new kundenstatusbox_show_behavior);
		$view->_Show();
		
		$view->_setShowBehavior(new kundeinformationbox_show_behavior());
		$view->_Show();

		$this->tpl->show();
	}
}
?>