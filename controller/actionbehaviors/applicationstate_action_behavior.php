<?php
require_once ('./controller/action.php');


class applicationstate_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'defaultcontroller')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		$applicationStateInstance = application::getInstance();
		$applicationStateInstance->_setSuchbegriff($_REQUEST['suchbegriff']);
		$applicationStateInstance->_setPageID($_REQUEST['pageID']);
		if ($_REQUEST['idkunde'] != '')
		{
			$applicationStateInstance->_setIDKunde($_REQUEST['idkunde']);
		}
		if ($_REQUEST['suchenach'] != '')
		{
			$applicationStateInstance->_setSucheNach($_REQUEST['suchenach']);
		}
		if ($_REQUEST['howmany'] != '')
		{
			$applicationStateInstance->_setHowmany($_REQUEST['howmany']);
		}
		if ($_REQUEST['galerieid'] != '')
		{
			$applicationStateInstance->_setGalerieID($_REQUEST['galerieid']);
		}
		if ($_REQUEST['idfotograf'] != '')
		{
			$applicationStateInstance->_setFotografenID($_REQUEST['idfotograf']);
		}
		if ($_REQUEST['wasserzeichen'] != '')
		{
			$applicationStateInstance->_setWasserzeichen($_REQUEST['wasserzeichen']);
		}
		if ($_REQUEST['watermarktrans'] != '')
		{
			$applicationStateInstance->_setWatermarkTransparency($_REQUEST['watermarktrans']);
		}
		if ($_REQUEST['idbestellung'] != '')
		{
			$applicationStateInstance->_setBestellungID($_REQUEST['idbestellung']);
		}
	}
}
?>