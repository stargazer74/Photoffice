<?php
class main
{	
	private $controller;
	private $controllerobject;
	
	public function __construct()
	{
		$this->controller = $_REQUEST['controller'];
	}
	
	public function runApplication()
	{
		$registers = registry::getInstance();
		$registers->_initApplicationVariables('./model/config.xml');
		$registers->_initApplicationStatus();
		$this->controllerobject = controller::_controllerFactory($this->controller);
		$this->controllerobject->_tuaction();
	}
}
?>