<?php

require_once ('./view/showbehavior.php');


class fotografenliste_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		
		$this->tpl->loadTemplatefile("fotografenliste.tpl");
		$this->tpl->touchBlock('FOTOGRAFENLISTE');
		
		$db = new database();
		$alleFotografenInstance = $db->_getFotografen();
		$alleFotografenArray = $alleFotografenInstance->_ausgeben();

			
		foreach ($alleFotografenArray as $key => $data)
		{
			$this->tpl->setCurrentBlock('LISTEFOTOGRAFEN');
			if($key % 2 == 0)
			{
				$this->tpl->setVariable('LISTBACKGROUND', 'lightbackground');
			}		
			$this->tpl->setVariable('NAME', $data['vorname'].' '.$data['name']);
			$this->tpl->setVariable('LOGINNAME', $data['loginname']);
			$this->tpl->setVariable('FOTOGRAFENID', $data['id']);
			$this->tpl->parseCurrentBlock('LISTEFOTOGRAFEN');
		}		
		$this->tpl->show();
	}
}
?>