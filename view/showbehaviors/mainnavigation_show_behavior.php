<?php

require_once ('./view/showbehavior.php');


class mainnavigation_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('NAVIGATIONBLOCK', 'mainnaviblock', 'mainnavi.tpl');
		$this->tpl->touchBlock('MAINNAVI');
		$this->tpl->setVariable('BUTTON_GALERIEN', 'galerien');
		$this->tpl->setVariable('BUTTON_HOMEPAGE', 'homepage_no_button');
		$this->tpl->setVariable('BUTTON_KUNDEN', 'kunden');
		$this->tpl->setVariable('BUTTON_BESTELLUNGEN', 'bestellungen');
		$this->tpl->setVariable('BUTTON_FIRMA', 'firma');

	}
}
?>