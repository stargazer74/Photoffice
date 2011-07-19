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
				$db->_delete($_REQUEST['was'], $_SESSION['bestellungid']);
				$_SESSION['bestellungid'] = '';
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
				if($_SESSION['kundelogged'] != md5('customergoforit'))
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