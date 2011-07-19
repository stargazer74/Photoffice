<?php

require_once ('./view/showbehavior.php');


class statusbox_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('STATUSBOX', 'statusbox', 'statusbox.tpl');
		$this->tpl->touchBlock('STATUSBOX');
		$this->tpl->setVariable('BENUTZERNAME', $_SESSION['benutzername']);
		$versionInstance = new version();
		$this->tpl->setVariable('UPDATE_NOTIFICATION', $versionInstance->_getStatusMessage());
	}
}
?>