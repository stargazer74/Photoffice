<?php
require_once ('./controller/controller.php');

/**
 * 
 * @license LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @author <a href="mailto:c.wohlbrecht@photoffice.de">Chris Wohlbrecht</a>
 * 
 */

class kundendaten extends controller
{
	public function __construct()
	{
		$this->controller = get_class($this);
		$this->dispatcher = Event_Dispatcher::getInstance();
		$this->actionBehaviorObject = new standard_action_behavior($this->controller);
	}
}

?>