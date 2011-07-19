<?php

require_once ('./view/showbehavior.php');


class kundendatenbox_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('KUNDENDATENBOX', 'kundendatenbox', 'kundendatenbox.tpl');
		$this->tpl->touchBlock('KUNDENDATENBOX');
	}
}
?>