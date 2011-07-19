<?php

require_once ('./view/showbehavior.php');


class warenkorbbox_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('WARENKORB', 'warenkorbbox', 'warenkorbbox.tpl');
		$this->tpl->touchBlock('WARENKORBBOX');
	}
}
?>