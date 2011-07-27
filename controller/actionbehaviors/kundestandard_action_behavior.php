<?php
require_once ('./controller/action.php');

/**
*
* @license LGPL http://www.gnu.org/licenses/lgpl-3.0.html
* @author <a href="mailto:c.wohlbrecht@photoffice.de">Chris Wohlbrecht</a>
*
*/

class kundestandard_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'kundenlogin')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		if($this->controller == 'kundendefaultcontroller')
		{
			$this->controller = 'kundendefault';
		}
		if(class_exists($this->controller.'_view'))
		{
			$class = $this->controller.'_view';
			$viewobject = new $class;
			if($viewobject->_getProtectionState() == false)
			{
				//show view
				$viewobject->_Show();
			}else{
				if($_SESSION['kundelogged'] != md5('customergoforit'))
				{
					//show loginview
					$viewobject = new kundenlogin_view();
					$viewobject->_Show();
				}else{
					//show view
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