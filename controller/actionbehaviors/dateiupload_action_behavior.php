<?php
require_once ('./controller/action.php');


class dateiupload_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'defaultcontroller')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		
		if (!empty($_FILES)) 
		{		
			IMAGES::_insert($_FILES);
		}else{
			throw new Exception('Keine Datei zum Upload');
		}
	}
}
?>