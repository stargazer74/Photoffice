<?php

require_once ('./view/showbehavior.php');


class informationbox_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('INFORMATIONBLOCK', 'informatonblock', 'informationbox.tpl');
		$this->tpl->touchBlock('INFORMATIONBLOCK');
	}
}
?>