<?php
require_once ('./controller/controller.php');

/**
 * 
 * @license GPL http://www.gnu.org/licenses/gpl-3.0.html
 * @author Chris Wohlbrecht
 * 
 */

class ajaxdelete extends controller
{
	public function __construct()
	{
		$this->controller = get_class($this);
		$this->dispatcher = Event_Dispatcher::getInstance();
		$this->actionBehaviorObject = new ajaxdelete_action_behavior($this->controller);
	}
}

?>