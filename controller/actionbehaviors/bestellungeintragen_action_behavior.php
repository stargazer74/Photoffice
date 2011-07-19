<?php
require_once ('./controller/action.php');


class bestellungeintragen_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'kundenlogin')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		$db = new database();
		$bilder = array();		
		foreach ($_REQUEST['bilder'] as $key => $data)
		{
			$bilder[] = array('id' => $data, 'anzahlbilder' => $_REQUEST['anzahlbilder'], 'papiertyp' => $_REQUEST['papiertypid'], 'bildformat' => $_REQUEST['groesse']);
		}
		
		$allePreiseInstance = $db->_getPreise();
		$allePreiseArray = $allePreiseInstance->_ausgeben();
		$uebergebenerPreis = 0;
		foreach ($bilder as $key => $data)
		{
			foreach ($allePreiseArray as $preise)
			{
				if ($data['papiertyp'] == $preise['idpapiertyp'] && $data['bildformat'] == $preise['idbildformat'])
				{
					$uebergebenerPreis += $preise['preis']*$_REQUEST['anzahlbilder'];
				}
			}
		}
		$datum = getdate();
		$datum = $datum['year'] . '-' . $datum['mon'] . '-' . $datum['mday'] . ' ' . $datum['hours'] . ':' . $datum['minutes'] . ':' . $datum['seconds'];

		$bestellung = new bestellung(null, $_SESSION['benutzerid'], $datum, false, false, $uebergebenerPreis, $bilder);
		if (!$_SESSION['bestellungid'])
		{
			$db->_insert($bestellung);
		}else{
			$db->_update($bestellung);
		}
	}
}
?>