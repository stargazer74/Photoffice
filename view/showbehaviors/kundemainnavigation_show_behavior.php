<?php

require_once ('./view/showbehavior.php');


class kundemainnavigation_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('NAVIGATIONBLOCK', 'kundemainnaviblock', 'kundemainnavi.tpl');
		$this->tpl->touchBlock('KUNDEMAINNAVI');

	}
}
?>