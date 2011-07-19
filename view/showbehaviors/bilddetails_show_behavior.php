<?php

require_once ('./view/showbehavior.php');


class bilddetails_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$db = new database();
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->loadTemplateFile('bilddetails.tpl', TRUE, false);
		//$this->tpl->touchBlock('BILDDETAILS');
		$alleBilderInstance = $db->_getBilder();
		$alleBilderArray = $alleBilderInstance->_ausgeben();
		
		$aktuellesBild = null;
		
		foreach ($alleBilderArray as $data)
		{
			if ($_REQUEST['pictureid'] == $data['id'])
			{
				$aktuellesBild = $data;
			}
		}	
		$this->tpl->setVariable('BILDINFOS', 'Bildinformationen des aktuellen Bildes');
		$this->tpl->setVariable('BLENDE', $aktuellesBild['blende']);
		$this->tpl->setVariable('BELICHTUNGSZEIT', $aktuellesBild['belichtungszeit']);
		$this->tpl->setVariable('BRENNWEITE', $aktuellesBild['brennweite']);
		$this->tpl->setVariable('ISO', $aktuellesBild['iso']);
		$this->tpl->setVariable('BLITZ', $aktuellesBild['blitz']);
		$this->tpl->setVariable('MARKE', $aktuellesBild['marke']);
		$this->tpl->setVariable('MODEL', $aktuellesBild['model']);
		$this->tpl->setVariable('AUFNAHMEZEIT', $aktuellesBild['aufnahmezeitpunkt']);
		$this->tpl->setVariable('AENDERUNG', $aktuellesBild['aenderungszeit']);
		$this->tpl->show();
	}
}
?>