<?php

require_once ('./controller/controller.php');

/**
 * @author Chris Wohlbrecht
 *
 */
class oeffentlichegalerien extends controller
{
	public function __construct()
	{
		$this->controller = get_class($this);
		$this->dispatcher = Event_Dispatcher::getInstance();
		$this->actionBehaviorObject = new standard_action_behavior($this->controller);
	}
}
?>