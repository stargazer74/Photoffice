<?php

require_once ('./view/showbehavior.php');


class bestellungbox_show_behavior implements showbehavior
{
	public function __construct()
	{

	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('BILDBESTELLUNG', 'bestellungbox', 'bestellungbox.tpl');
		$this->tpl->touchBlock('BESTELLUNGBOX');

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

		foreach ($allePreiseArraySort as $key => $data)
		{
			$this->tpl->setCurrentBlock('PAPIERFORMATAUSWAHL');
			$this->tpl->setVariable('PAPIERFORMATID', $key);
			$this->tpl->setVariable('PAPIERFORMAT', $data[0]['papiertyp']);
			$this->tpl->parseCurrentBlock('PAPIERFORMATAUSWAHL');
		}

		if ($_SESSION['papiertypid'] == '')
		{
			$_SESSION['papiertypid'] = key($allePreiseArraySort);
		}
	}
}
?>