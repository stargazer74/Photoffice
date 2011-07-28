<?php

require_once ('./view/showbehavior.php');


class photographerdefault_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->loadTemplatefile("mainframe.tpl");
		$this->tpl->setVariable('PAGETITLE', 'photoffice Version '.$registryInstance->_getVersionNumber());
		
		$this->tpl->setVariable('VERSION_NUMBER', $registryInstance->_getVersionNumber());
		
		$this->tpl->addBlockfile('CONTENTBLOCK', 'contentbox', 'contentbox.tpl');
		$this->tpl->touchBlock('CONTENT');
		
		$this->tpl->addBlockfile('CAMBACKGROUND', 'cambackground', 'cambackground.tpl');
		$this->tpl->touchBlock('CAMBACKGROUND');
		
		
		$view = view::_getViewInstance();
		$view->_setShowBehavior(new mainnavigation_show_behavior());
		$view->_Show();
		
		$view->_setShowBehavior(new statusbox_show_behavior);
		$view->_Show();
		
		$view->_setShowBehavior(new informationbox_show_behavior());
		$view->_Show();
		
		$this->tpl->show();
	}
}
?>