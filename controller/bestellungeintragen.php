<?php

require_once ('./controller/controller.php');


class bestellungeintragen extends controller
{
	public function __construct()
	{
		$this->controller = get_class($this);
		$this->dispatcher = Event_Dispatcher::getInstance();
		$this->actionBehaviorObject = new bestellungeintragen_action_behavior($this->controller);
	}
}

?>