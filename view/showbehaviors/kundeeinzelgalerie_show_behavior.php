<?php

require_once ('./view/showbehavior.php');


class kundeeinzelgalerie_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$db = new database();
		
		$galerieid = $_SESSION['galerieid'];
		
		$alleGalerienInstance = $db->_getGalerien();
		$alleGalerienArray = $alleGalerienInstance->_ausgeben();
		
		$aktuelleGalerie = array();
		foreach ($alleGalerienArray as $data)
		{
			if ($data['id'] == $galerieid)
			{
				$aktuelleGalerie = $data;
			}
		}
		
		$this->tpl->loadTemplatefile("mainframekundensicht.tpl");
		$this->tpl->setVariable('PAGETITLE', 'Willkommen ' .$_SESSION['benutzername'] . ' | photoffice Version '.$registryInstance->_getVersionNumber());

		//CSS Includes
		$this->tpl->setCurrentBlock('CSSINCLUDES');
		$this->tpl->setVariable('CSS', 'fancybox');
		$this->tpl->parseCurrentBlock();
		
		
		//JavaScript Includes
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'animatedcollapse');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'kundensicht');
		$this->tpl->parseCurrentBlock();		
				
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.easing-1.3.pack');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.fancybox-1.3.1.pack');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'animatedcollapse');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.checkboxes');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.selectboxes');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->addBlockfile('NAVIGATIONBLOCK', 'kundemainnaviblock', 'kundemainnavi.tpl');
		$this->tpl->touchBlock('KUNDEMAINNAVI');		
		//Mainnavi
		$this->tpl->setVariable('BUTTON_KUNDENGALERIEN', 'bilder_no_button');
		$this->tpl->setVariable('BUTTON_KUNDENAGB', 'kundenagb');
		$this->tpl->setVariable('BUTTON_PREISLISTE', 'preisliste');
		
		$view = view::_getViewInstance();
		$view->_setShowBehavior(new kundenstatusbox_show_behavior);
		$view->_Show();
		
		$this->tpl->addBlockfile('CONTENTBLOCK', 'allecontentbox', 'kundencontentbox.tpl');
		$this->tpl->touchBlock('KUNDENCONTENT');
		
		$breadcrumbInstance = new breadcrumb('Bilder');
		$breadcrumbArray = $breadcrumbInstance->_getBreadcrumbArray();
		$aktuelleGalerieNaviPoint = array($aktuelleGalerie['galeriename'] => 'javascript:void()');
		$breadcrumbArray = array_merge($breadcrumbArray, $aktuelleGalerieNaviPoint);
		foreach($breadcrumbArray as $key => $data)
		{
			$this->tpl->setCurrentBlock('BREADCRUMBNAVI');
			$this->tpl->setVariable('BREADCRUMBLINK', $data);
			$this->tpl->setVariable('BREADCRUMBNAME', $key);
			$this->tpl->parseCurrentBlock("BREADCRUMBNAVI");
		}
		
		$this->tpl->addBlockfile('CONTENT', 'content', 'kundeeinzelgalerie.tpl');
		$this->tpl->touchBlock('KUNDEEINZELGALERIE');	
		
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
		$alleBilderInstance = $db->_getBilder();
		$alleBilderArray = $alleBilderInstance->_ausgeben();
		
		$galerieBilder = array();
		$aktuelleGalerieID = $_SESSION['galerieid'];
		
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
				if ($aktuelleBestellung == null)
				{
					$this->tpl->setVariable('BESTELLANZAHL', 0);	
				}else{
					$i = 0;
					foreach ($aktuelleBestellung['bilder'] as $bild)
					{
						if ($data['id'] == $bild['id'])
						{
							$i += $bild['anzahlbilder'];
						}						
					}
					$this->tpl->setVariable('BESTELLANZAHL', $i);
				}
				$this->tpl->parseCurrentBlock('BILD');
			}
		}
		
		$view->_setShowBehavior(new kundeinformationbox_show_behavior());
		$view->_Show();
		
		$view->_setShowBehavior(new bestellungbox_show_behavior());
		$view->_Show();
		
		$view->_setShowBehavior(new warenkorbbox_show_behavior());
		$view->_Show();
		
		$this->tpl->show();
	}
}
?>