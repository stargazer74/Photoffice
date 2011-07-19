<?php

require_once ('./controller/controller.php');


class warenkorbeintragen extends controller
{
	public function __construct()
	{
		$this->controller = get_class($this);
		$this->dispatcher = Event_Dispatcher::getInstance();
		$this->actionBehaviorObject = new warenkorbeintragen_action_behavior($this->controller);
	}
}

?>