<?php

require_once ('./view/showbehavior.php');


class kundeinformationbox_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('INFORMATIONBLOCK', 'informatonblock', 'kundeinformationbox.tpl');
		$this->tpl->touchBlock('KUNDEINFORMATIONBLOCK');
	}
}
?>