<?php

require_once ('./view/showbehavior.php');


class einzelgalerie_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$applicationStateInstance = application::getInstance();
		$db = new database();
		
		$galerieid = $applicationStateInstance->_getGalerieID();
		
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
		
		$this->tpl->loadTemplatefile("mainframe.tpl");
		$this->tpl->setVariable('PAGETITLE', 'photoffice Version '.$registryInstance->_getVersionNumber());
		$this->tpl->setVariable('VERSION_NUMBER', $registryInstance->_getVersionNumber());

		//CSS Includes
		$this->tpl->setCurrentBlock('CSSINCLUDES');
		$this->tpl->setVariable('CSS', 'uploadify');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('CSSINCLUDES');
		$this->tpl->setVariable('CSS', 'fancybox');
		$this->tpl->parseCurrentBlock();
		
		//JavaScript Includes
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.form');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.tools.min');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'animatedcollapse');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'bilder');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.livequery');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'swfobject');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.uploadify');
		$this->tpl->parseCurrentBlock();
		
				
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.easing-1.3.pack');
		$this->tpl->parseCurrentBlock();
		
		$this->tpl->setCurrentBlock('JSINCLUDES');
		$this->tpl->setVariable('JAVASCRIPT', 'jquery.fancybox-1.3.1.pack');
		$this->tpl->parseCurrentBlock();
				
		
		$this->tpl->addBlockfile('NAVIGATIONBLOCK', 'mainnaviblock', 'mainnavi.tpl');
		$this->tpl->touchBlock('MAINNAVI');
		$this->tpl->setVariable('BUTTON_GALERIEN', 'galerien_no_button');
		$this->tpl->setVariable('BUTTON_HOMEPAGE', 'homepage_no_button');
		$this->tpl->setVariable('BUTTON_KUNDEN', 'kunden');
		$this->tpl->setVariable('BUTTON_BESTELLUNGEN', 'bestellungen');
		$this->tpl->setVariable('BUTTON_FIRMA', 'firma');
		
		$view = view::_getViewInstance();
		$view->_setShowBehavior(new statusbox_show_behavior);
		$view->_Show();
		
		$this->tpl->addBlockfile('CONTENTBLOCK', 'contentbox', 'contentbox.tpl');
		$this->tpl->touchBlock('CONTENT');
		
		$breadcrumbInstance = new breadcrumb('Galerien');
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
		
		$this->tpl->addBlockfile('CONTENT', 'content', 'einzelgalerie.tpl');
		$this->tpl->touchBlock('EINZELGALERIE');		
		
		$view->_setShowBehavior(new informationbox_show_behavior());
		$view->_Show();		
				
		$view->_setShowBehavior(new galerieeinstellbox_show_behavior());
		$view->_Show();
		
		$view->_setShowBehavior(new bilduploadbox_show_behavior());
		$view->_Show();

		$view->_setShowBehavior(new exifdatenbox_show_behavior());
		$view->_Show();
		
		$this->tpl->show();
	}
}
?>