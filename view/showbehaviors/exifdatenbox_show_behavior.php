<?php

require_once ('./view/showbehavior.php');


class exifdatenbox_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('EXIFDATEN', 'exifdatenbox', 'exifdatenbox.tpl');
		$this->tpl->touchBlock('EXIFDATENBOX');
	}
}
?>