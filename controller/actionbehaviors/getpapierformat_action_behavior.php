<?php
require_once ('./controller/action.php');


class getpapierformat_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'kundenlogin')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		$db = new database();
		$allePreiseInstance = $db->_getPreise();
		$allePreiseArray = $allePreiseInstance->_ausgeben();
		
		$sortArray = array();
    	foreach($allePreiseArray as $key => $array) 
    	{
        	$sortArray[$key] = $array['idpapiertyp'];
    	}
		array_multisort($sortArray, SORT_ASC, SORT_REGULAR, $allePreiseArray); 

		$allePreiseArraySort = array();
		foreach ($allePreiseArray as $data)
		{
			$allePreiseArraySort[$data['idpapiertyp']][] = $data;
		}
		
		$aktuelleBildformate = array();
		
		foreach ($allePreiseArraySort as $key => $data)
		{
			if ($key == $_SESSION['papiertypid'])
			{
				foreach ($data as $formate)
				{
					$kombination = array($formate['idbildformat'] => $formate['bildformat']);
					$aktuelleBildformate = $aktuelleBildformate + $kombination;
				}
			}
		}
		echo json_encode($aktuelleBildformate);
	}
}
?>