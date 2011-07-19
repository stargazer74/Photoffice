<?php

require_once ('./view/showbehavior.php');


class galerieeinstellbox_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('GALERIEEINSTELLBOX', 'galerieeinstellbox', 'galerieeinstellungbox.tpl');
		$this->tpl->touchBlock('GALERIEEINSTELLBOX');		
	}
}
?>