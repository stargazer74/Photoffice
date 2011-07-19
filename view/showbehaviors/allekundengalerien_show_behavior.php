<?php

require_once ('./view/showbehavior.php');


class allekundengalerien_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->loadTemplatefile("mainframekundensicht.tpl");
		$this->tpl->setVariable('PAGETITLE', 'Willkommen ' .$_SESSION['benutzername'] . ' | photoffice Version '.$registryInstance->_getVersionNumber());
		$db = new database();

				//CSS Includes
		
		//JavaScript Includes
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'kundensicht');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->addBlockfile('NAVIGATIONBLOCK', 'kundemainnaviblock', 'kundemainnavi.tpl');
		$this->tpl->touchBlock('KUNDEMAINNAVI');		
		//Mainnavi
		$this->tpl->setVariable('BUTTON_KUNDENGALERIEN', 'bilder_no_button');
		$this->tpl->setVariable('BUTTON_KUNDENAGB', 'kundenagb');
		$this->tpl->setVariable('BUTTON_PREISLISTE', 'preisliste');
		$this->tpl->setVariable('BUTTON_HILFE', 'hilfe');
		
		$this->tpl->addBlockfile('CONTENTBLOCK', 'allecontentbox', 'kundencontentbox.tpl');
		$this->tpl->touchBlock('KUNDENCONTENT');
		
		$breadcrumbInstance = new breadcrumb('Bilder');
		$breadcrumbArray = $breadcrumbInstance->_getBreadcrumbArray();
		foreach($breadcrumbArray as $key => $data)
		{
			$this->tpl->setCurrentBlock('BREADCRUMBNAVI');
			$this->tpl->setVariable('BREADCRUMBLINK', $data);
			$this->tpl->setVariable('BREADCRUMBNAME', $key);
			$this->tpl->parseCurrentBlock("BREADCRUMBNAVI");
		}
		
		$this->tpl->addBlockfile('CONTENT', 'content', 'allekundengalerien.tpl');
		$this->tpl->touchBlock('ALLEKUNDENGALERIEN');
		
		$alleGalerienInstance = $db->_getGalerien();
		$alleGalerienArray = $alleGalerienInstance->_ausgeben();		
		
		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();
		
		$aktuellerKunde = null;
		
		foreach ($alleKundenArray as $data)
		{
			if ($_SESSION['benutzerid'] == $data['id'])
			{
				$aktuellerKunde = $data;
			}
		}
		
		$alleKundenGalerien = array();
		
		foreach ($alleGalerienArray as $data)
		{
			if ($_SESSION['benutzerid'] == $data['idkunde'] && $data['online'])
			{
				$alleKundenGalerien[] = $data;
			}
		}
		
		//print_r($alleKundenGalerien);
		
		if (count($alleKundenGalerien) == 0)
		{
			$this->tpl->touchBlock('KEINEGALERIEN');
		}else{
			$this->tpl->touchBlock('ALLEKUNDENGALERIEN');
			foreach ($alleKundenGalerien as $data)
			{
				$this->tpl->setCurrentBlock('GALERIEN');
				$this->tpl->setVariable('GALERIENAME', $data['galeriename']);
				$this->tpl->setVariable('BILDANZAHL', $data['bildanzahl']);
				$this->tpl->setVariable('IDGALERIE', $data['id']);
				$this->tpl->parseCurrentBlock('GALERIEN');
			}
		}
		
		
		$view = view::_getViewInstance();
		$view->_setShowBehavior(new kundenstatusbox_show_behavior);
		$view->_Show();
		
		$view->_setShowBehavior(new kundeinformationbox_show_behavior());
		$view->_Show();
		$this->tpl->show();
		
	}
}
?>