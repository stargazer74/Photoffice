<?php

require_once ('./view/showbehavior.php');


class firmendaten_show_behavior implements showbehavior
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
		
		
		//JavaScript Includes
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.form');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.tools.min');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'tiny_mce/tiny_mce');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'firmendaten');
		$this->tpl->parseCurrentBlock();
		
		//Versionsnummer setzen
		$this->tpl->setVariable('VERSION_NUMBER', $registryInstance->_getVersionNumber());
		
		
		$this->tpl->addBlockfile('NAVIGATIONBLOCK', 'mainnaviblock', 'mainnavi.tpl');
		$this->tpl->touchBlock('MAINNAVI');
		$this->tpl->setVariable('BUTTON_GALERIEN', 'galerien');
		$this->tpl->setVariable('BUTTON_HOMEPAGE', 'homepage_no_button');
		$this->tpl->setVariable('BUTTON_KUNDEN', 'kunden');
		$this->tpl->setVariable('BUTTON_BESTELLUNGEN', 'bestellungen');
		$this->tpl->setVariable('BUTTON_FIRMA', 'firma_no_button');		
		
		$view = view::_getViewInstance();
		$view->_setShowBehavior(new statusbox_show_behavior);
		$view->_Show();
		
		$this->tpl->addBlockfile('CONTENTBLOCK', 'contentbox', 'contentbox.tpl');
		$this->tpl->touchBlock('CONTENT');
		
		$breadcrumbInstance = new breadcrumb('Firmendaten');
		$breadcrumbArray = $breadcrumbInstance->_getBreadcrumbArray();
		foreach($breadcrumbArray as $key => $data)
		{
			$this->tpl->setCurrentBlock('BREADCRUMBNAVI');
			$this->tpl->setVariable('BREADCRUMBLINK', $data);
			$this->tpl->setVariable('BREADCRUMBNAME', $key);
			$this->tpl->parseCurrentBlock("BREADCRUMBNAVI");
		}
		
		$this->tpl->addBlockfile('CONTENT', 'content', 'firmendaten.tpl');
		$this->tpl->touchBlock('FIRMENDATEN');
		
		$view->_setShowBehavior(new informationbox_show_behavior());
		$view->_Show();
		
		$this->tpl->show();
	}
}
?>