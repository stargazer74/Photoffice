<?php

/**
*
* @license LGPL http://www.gnu.org/licenses/lgpl-3.0.html
* @author <a href="mailto:c.wohlbrecht@photoffice.de">Chris Wohlbrecht</a>
*
*/

abstract class controller
{
	protected $controller = null;
	protected $dispatcher = null;
	protected $actionBehaviorObject;

	protected function __construct()
	{

	}

	protected function __clone()
	{

	}

	public static function _controllerFactory($type)
	{
		$source = $type. '.php';
		if(is_file('./controller/'.$source))
		{
			if(@require_once($source))
			{
				$class = $type;
				$objekt = new $class;
				return $objekt;
			}else{
				throw new Exception(sprintf('Konnte kein Objekt vom Typ %s erzeugen!', 'UserInterface_' .$type));
			}
		}else{
			//@TODO depricated use role instead
			if (isset($_SESSION['kundelogged']) )
			{
				return $object = controller::_controllerFactory('kundendefaultcontroller');
			}elseif (isset($_SESSION['onlineshoplogged']))
			{
				return $object = controller::_controllerFactory('onlineshopdefaultcontroller');
			}else{
				return $object = controller::_controllerFactory('defaultcontroller');
			}
		}
	}//end function factory

	public function _tuaction()
	{
		$this->actionBehaviorObject->_action();
	}
}
?>