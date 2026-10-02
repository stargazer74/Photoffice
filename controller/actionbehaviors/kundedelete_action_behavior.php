<?php
require_once ('./controller/action.php');


class kundedelete_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'kundenlogin')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		$db= new database();
		switch ($_REQUEST['was'])
		{				
			case warenkorb:
				// Der Warenkorb liegt ausschliesslich in der Session
				// (application::_getAktuelleBestellung()), nicht in der DB -
				// siehe bestellungeintragen_action_behavior.php.
				application::getInstance()->_setAktuelleBestellung(null);
				$this->controller = 'warenkorb';
				break;
				
			default:
				break;
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
				$allowedRole = $viewobject->_getAllowedRole();
				$sessionRoles = application::getInstance()->_getRoles();
				$match = false;
				foreach ($sessionRoles as $role)
				{
					if (in_array(md5($allowedRole), $sessionRoles))
					{
						$match = true;
					}
				}
				if(!$match)
				{
					//Loginview anzeigen
					$viewobject = new kundenlogin_view();
					$viewobject->_Show();
				}else{
					//View anzeigen
					$viewobject->_Show();
				}//end if Sessionabfrage
			}//end if Protectionstate abfrage
				
		}else{	
			$object = controller::_controllerFactory('kundendefaultcontroller');
			$object->_tuaction();
		}

	}
}
?>