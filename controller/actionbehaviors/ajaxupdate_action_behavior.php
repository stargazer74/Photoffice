<?php
require_once ('./controller/action.php');


class ajaxupdate_action_behavior implements action
{

	private $controller;

	public function __construct($controller = 'defaultcontroller')
	{
		$this->controller = $controller;

	}

	public function _action()
	{
		$db= new database();
		switch ($_REQUEST['was'])
		{
			case zahlungsart:
				if ($_REQUEST['aktiv'])
				{
					$aktiv = 0;
				}else{
					$aktiv = 1;
				}
				$zahlungsart = new zahlungsart($_REQUEST['id'], null, $aktiv);
				$db->_update($zahlungsart);
				echo 'Daten eingetragen!';
				break;

			default:
				break;
		}

	}
}
?>