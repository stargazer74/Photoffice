<?php
require_once ('./controller/action.php');


class onlineshopstandard_action_behavior implements action
{

	private $controller;

	public function __construct($controller = 'onlineshopdefault')
	{
		$this->controller = $controller;

	}

	public function _action()
	{
		$registry = registry::getInstance();
		if (!$_SESSION['registered'])
		{
			$registry->_registerShop();
		}
		if($this->controller == 'onlineshopdefaultcontroller')
		{
			$this->controller = 'onlineshop';
		}
		if(class_exists($this->controller.'_view'))
		{
			$class = $this->controller.'_view';
			$viewobject = new $class;
			if($viewobject->_getProtectionState() == false)
			{
				//View anzeigen
				$viewobject->_Show();
			}else{
				//@TODO depricated use role instead
				if($_SESSION['kundelogged'] != md5('customergoforit'))
				{
					//Loginview anzeigen
					$viewobject = new shoplogin_view();
					$viewobject->_Show();
				}else{
					//View anzeigen
					$viewobject->_Show();
				}//end if Sessionabfrage
			}//end if Protectionstate abfrage

		}else{
			$object = controller::_controllerFactory('onlineshopdefaultcontroller');
			$object->_tuaction();
		}

	}
}
?>