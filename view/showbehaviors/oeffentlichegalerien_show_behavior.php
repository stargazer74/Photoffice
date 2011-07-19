<?php
require_once ('./view/showbehavior.php');

class oeffentlichegalerien_show_behavior implements showbehavior
{

	public function __construct()
	{

	}

	public function _show()
	{
		$db = new database();
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();

		$alleGalerienInstance = $db->_getOeffentlicheGalerien();
		$alleGalerienArray = $alleGalerienInstance->_ausgeben();
		$this->tpl->loadTemplatefile("oeffentlichegalerien.tpl");

		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();

		if (count($alleGalerienArray) == 0)
		{
			$this->tpl->touchBlock('KEINEGALERIEN');
		}else{
			$this->tpl->touchBlock('OEFFENTLICHEGALERIEN');
			foreach ($alleGalerienArray as $data)
			{
				$this->tpl->setCurrentBlock('GALERIEN');
				$this->tpl->setVariable('GALERIENAME', $data['galeriename']);
				$this->tpl->setVariable('BILDANZAHL', $data['bildanzahl']);
				if ($data['online'] == 0)
				{
					$this->tpl->setVariable('ONLINESTATUS', 'offline');
				}else{
					$this->tpl->setVariable('ONLINESTATUS', 'online');
				}
				$this->tpl->setVariable('IDGALERIE', $data['id']);
				$this->tpl->parseCurrentBlock('GALERIEN');
			}
		}

		$this->tpl->show();

	}
}
?>