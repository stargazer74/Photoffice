<?php

require_once ('./view/showbehavior.php');


class agb_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		
		$this->tpl->loadTemplatefile("ajaxerror.tpl");
		$this->tpl->touchBlock('AJAXERROR');
			
		$this->tpl->show();
	}
}
?>