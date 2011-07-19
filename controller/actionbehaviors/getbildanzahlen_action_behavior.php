<?php
require_once ('./controller/action.php');


class getbildanzahlen_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'kundenlogin')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		$applicationStateInstance = application::getInstance();
		$aktuelleBestellung = $applicationStateInstance->_getAktuelleBestellung();		
		$distinctAktuelleBestellung = $aktuelleBestellung->_getDistinctPictureArray($aktuelleBestellung);		
		echo json_encode($distinctAktuelleBestellung);
	}
}
?>