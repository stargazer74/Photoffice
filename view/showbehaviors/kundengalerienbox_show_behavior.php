<?php

require_once ('./view/showbehavior.php');


class kundengalerienbox_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('KUNDENGALERIENBOX', 'kundengalerienbox', 'kundengalerienbox.tpl');
		$this->tpl->touchBlock('KUNDENGALERIENBOX');
	}
}
?>