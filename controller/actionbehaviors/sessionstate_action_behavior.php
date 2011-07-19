<?php
require_once ('./controller/action.php');


class sessionstate_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'defaultcontroller')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		$registryInstance = registry::getInstance();
		if ($_REQUEST['galerieid'] != '')
		{
			$registryInstance->_setGalerieID($_REQUEST['galerieid']);
		}
		if ($_REQUEST['bildid'] != '')
		{
			$registryInstance->_setBildID($_REQUEST['bildid']);
		}
		if ($_REQUEST['papiertypid'] != '')
		{
			$registryInstance->_setPapiertypID($_REQUEST['papiertypid']);
		}
	}
}
?>