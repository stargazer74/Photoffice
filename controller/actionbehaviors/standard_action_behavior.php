<?php
require_once ('./controller/action.php');

/**
 *
 * @license LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @author <a href="mailto:c.wohlbrecht@photoffice.de">Chris Wohlbrecht</a>
 *
 */

class standard_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'defaultcontroller')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		
		if($this->controller == 'defaultcontroller')
		{
			$this->controller = 'default';
		}

		if(class_exists($this->controller.'_view'))
		{
			application::getInstance()->_setActualView($this->controller);
			$class = $this->controller.'_view';
			$viewobject = new $class;
			if($viewobject->_getProtectionState() == false)
			{
				//show view
				$viewobject->_Show();
			}else
			{
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
					switch ($viewobject->_getAllowedRole()) 
					{
						case "photographer":
							//show loginview for photographer
							$viewobject = new login_view();
							$viewobject->_Show();
							break;
							
						case "customer":
							//show loginview for customer
							$viewobject = new kundenlogin_view();
							$viewobject->_Show();
							break;
						
						default:
							break;
					}					
					//@TODO check wich login page should show

				}else{
					//show view
					$viewobject->_Show();
				}//end if Sessionabfrage
			}//end if Protectionstate abfrage
				
		}else{
			//@TODO don't switch to defaultcontroller, show actuel view instead
			$object = controller::_controllerFactory(application::getInstance()->_getActualView());
			$object->_tuaction();
		}

	}
}
?>