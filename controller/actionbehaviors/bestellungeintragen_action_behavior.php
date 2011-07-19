<?php
require_once ('./controller/action.php');
/**
 * 
 * Action Behavior for Bestellung
 * @author Chris Wohlbrecht
 *
 */

class bestellungeintragen_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'kundenlogin')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		/// @todo hier darf keine Bestellung in die Datenbank eingetragen werden (Cookies)
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
		$applicationStateInstance = application::getInstance();
		$benutzerid = $applicationStateInstance->_getNutzerID();
		$bestellung = new bestellung(null, $benutzerid, $datum, false, $uebergebenerPreis, $bilder);
		
		if (!$_SESSION['aktuelleBestellung'])
		{
			/// Bestellung neu anlegen
			$applicationStateInstance->_setAktuelleBestellung($bestellung);
		}else{
			/// Bestelldaten hinzufügen
			/// @todo Bestellung hinzufügen
			$temp_aktuelleBestellung = $applicationStateInstance->_getAktuelleBestellung();
			$neueBestellung = $temp_aktuelleBestellung->_addBestellung($bestellung);
			$applicationStateInstance->_setAktuelleBestellung($neueBestellung);				
		}
	}
}
?>