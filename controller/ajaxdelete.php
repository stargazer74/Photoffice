<?php

require_once ('./controller/controller.php');


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