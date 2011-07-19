<?php

require_once ('./view/showbehavior.php');


class allegalerien_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$db = new database();
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		
		$alleGalerienInstance = $db->_getGalerien();
		$alleGalerienArray = $alleGalerienInstance->_ausgeben();
		$this->tpl->loadTemplatefile("allegalerien.tpl");
		
		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();
		
		if (count($alleGalerienArray) == 0)
		{
			$this->tpl->touchBlock('KEINEGALERIEN');
		}else{
			$this->tpl->touchBlock('ALLEGALERIEN');
			foreach ($alleGalerienArray as $data)
			{
				$aktuellerKunde = NULL;
				foreach ($alleKundenArray as $kundendaten)
				{
					if ($kundendaten['id'] == $data['idkunde'])
					{
						$aktuellerKunde = $kundendaten;
					}
				}
				$this->tpl->setCurrentBlock('GALERIEN');
				$this->tpl->setVariable('GALERIENAME', $data['galeriename']);
				$this->tpl->setVariable('BILDANZAHL', $data['bildanzahl']);
				if ($data['online'] == 0)
				{
					$this->tpl->setVariable('ONLINESTATUS', 'offline');
				}else{
					$this->tpl->setVariable('ONLINESTATUS', 'online');
				}
				$this->tpl->setVariable('BESITZER', $aktuellerKunde['vorname'].' '.$aktuellerKunde['nachname']);
				$this->tpl->setVariable('IDGALERIE', $data['id']);
				$this->tpl->parseCurrentBlock('GALERIEN');
			}
		}
		
		$this->tpl->show();
		
	}
}
?>