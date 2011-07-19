<?php
require_once ('./controller/action.php');


class getbildanzahlen_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'kundenlogin')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		$db = new database();
		$alleBestellungenInstance = $db->_getBestellungen();
		$alleBestellungenArray = $alleBestellungenInstance->_ausgeben();
		$aktuelleBestellung = null;
		foreach ($alleBestellungenArray as $bestellung)
		{
			if ($bestellung['id'] == $_SESSION['bestellungid'])
			{
				$aktuelleBestellung = $bestellung;
			}
		}
		$distinctAktuelleBestellung = array();
		foreach ($aktuelleBestellung['bilder'] as $bilder)
		{
			$isInArray = false;
			if (count($distinctAktuelleBestellung) == 0)
			{
				$distinctAktuelleBestellung[$bilder['id']] = $bilder['anzahlbilder'];
			}else{
				foreach ($distinctAktuelleBestellung as $key => $data)
				{
					if ($key == $bilder['id'])
					{
						$isInArray = true;						 
					}
				}
				if ($isInArray)
				{
					foreach ($distinctAktuelleBestellung as $key => $data)
					{
						if ($key == $bilder['id'])
						{
							$distinctAktuelleBestellung[$key] += $bilder['anzahlbilder'];					 
						}
					}
				}else{
					$distinctAktuelleBestellung[$bilder['id']] = $bilder['anzahlbilder'];
				}
			}
		}
		echo json_encode($distinctAktuelleBestellung);
	}
}
?>