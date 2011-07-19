<?php

require_once ('./view/showbehavior.php');


class bilduebersicht_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$applicationStateInstance = application::getInstance();
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->loadTemplatefile("bilduebersicht.tpl");
		
		
		$db = new database();
		$alleBilderInstance = $db->_getBilder();
		$alleBilderArray = $alleBilderInstance->_ausgeben();
		
		$galerieBilder = array();
		$aktuelleGalerieID = $applicationStateInstance->_getGalerieID();
		
		foreach ($alleBilderArray as $data)
		{
			if ($aktuelleGalerieID == $data['galerie'])
			{
				$galerieBilder[] = $data;
			}
		}
		
		if (count($galerieBilder) == 0)
		{
			$this->tpl->touchBlock('KEINBILD');
		}else{
			$this->tpl->touchBlock('BILDUEBERSICHT');
			foreach ($galerieBilder as $data)
			{
				$this->tpl->setCurrentBlock('BILD');
				$this->tpl->setVariable('GALERIEID', $aktuelleGalerieID);
				$this->tpl->setVariable('EINZELBILD', $data['iconname']);
				$this->tpl->setVariable('PICTUREID', $data['id']);
				$this->tpl->setVariable('BILDNAME', $data['bildname']);
				$this->tpl->parseCurrentBlock('BILD');
			}
		}
		
		$this->tpl->show();
	}
}
?>