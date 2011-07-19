<?php

require_once ('./view/showbehavior.php');


class oeffentlichegalerienbox_show_behavior implements showbehavior
{
	public function __construct()
	{

	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('OEFFENTLICHEGALERIENBOX', 'oeffentlichegalerienbox', 'oeffentlichegalerienbox.tpl');
		$this->tpl->touchBlock('OEFFENTLICHEGALERIENBOX');
	}
}
?>