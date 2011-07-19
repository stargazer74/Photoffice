<?php

require_once ('./controller/controller.php');


class dateiupload extends controller
{
	public function __construct()
	{
		$this->controller = get_class($this);
		$this->dispatcher = Event_Dispatcher::getInstance();
		$this->actionBehaviorObject = new dateiupload_action_behavior($this->controller);

	}
}

?>