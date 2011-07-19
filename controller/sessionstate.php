<?php

require_once ('./controller/controller.php');


class sessionstate extends controller
{
	public function __construct()
	{
		$this->controller = get_class($this);
		$this->dispatcher = Event_Dispatcher::getInstance();
		$this->actionBehaviorObject = new sessionstate_action_behavior($this->controller);
	}
}

?>