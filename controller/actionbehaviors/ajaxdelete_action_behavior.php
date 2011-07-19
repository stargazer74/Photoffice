<?php
require_once ('./controller/action.php');


class ajaxdelete_action_behavior implements action
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
			case papierformat:
				$db->_delete($_REQUEST['was'], $_REQUEST['id']);
				$this->controller = 'fotodaten';
				break;

			case preis:
				$db->_delete($_REQUEST['was'], $_REQUEST['id']);
				$this->controller = 'fotodaten';
				break;

			case bildformat:
				$db->_delete($_REQUEST['was'], $_REQUEST['id']);
				$this->controller = 'fotodaten';
				break;

			case kunde:
				$db->_delete($_REQUEST['was'], $_REQUEST['id']);
				$this->controller = 'kundenliste';
				break;

			case bild:
				$db->_delete($_REQUEST['was'], $_REQUEST['id']);
				$this->controller = 'bilduebersicht';
				break;

			case galerie:
				$db->_delete($_REQUEST['was'], $_REQUEST['id']);
				$this->controller = 'allegalerien';
				break;

			case fotograf:
				$db = new database();
				$alleFotografenInstance = $db->_getFotografen();
				$alleFotografenArray = $alleFotografenInstance->_ausgeben();
				$aktuellerFotograf = null;

				$anzahl = null;
				foreach ($alleFotografenArray as $fotograf)
				{
					if ($fotograf['loginname'] != null)
					{
						$anzahl++;
						$aktuellerFotograf = $fotograf;
					}
				}

				if (($anzahl > 1) || ($anzahl == 1 && $aktuellerFotograf['id'] != $_REQUEST['id']))
				{
					$db->_delete($_REQUEST['was'], $_REQUEST['id']);
					$this->controller = 'fotografenliste';
				}else{
					$this->controller = 'fotografenliste';
				}
				break;

			case warenkorb:
				$db->_delete($_REQUEST['was'], $_REQUEST['id']);
				$this->controller = 'bestellungslisteinhalt';
				break;

			case porto:
				$db->_delete($_REQUEST['was'], $_REQUEST['id']);
				$this->controller = 'fotodaten';
				break;

			default:
				break;
		}

		if(class_exists($this->controller.'_view'))
		{
			$class = $this->controller.'_view';
			$viewobject = new $class;
			if($viewobject->_getProtectionState() == false)
			{
				//View anzeigen
				$viewobject->_Show();
			}else{
				if($_SESSION['logged'] != md5('goforit'))
				{
					//Loginview anzeigen
					$viewobject = new login_view();
					$viewobject->_Show();
				}else{
					//View anzeigen
					$viewobject->_Show();
				}//end if Sessionabfrage
			}//end if Protectionstate abfrage

		}else{
			$object = controller::_controllerFactory('defaultcontroller');
			$object->_tuaction();
		}

	}
}
?>