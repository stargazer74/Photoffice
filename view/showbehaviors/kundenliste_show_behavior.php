<?php

require_once ('./view/showbehavior.php');


class kundenliste_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		
		if (!isset($_REQUEST['pageID']))
		{
			$_REQUEST['pageID'] = 1;
		}

		$applicationState = application::getInstance();
		$suchbegrifffromXML = $applicationState->_getSuchbegriff();
		$suchenachfromXML = $applicationState->_getSucheNach();
		$howmanyfromXML = $applicationState->_getHowmany();
		$applicationState->_setPageID($_REQUEST['pageID']);
		$howmany;
		if($howmanyfromXML == '')
		{
			$howmany = 10;
			$applicationState->_setHowmany($howmany);
		}
		
		$this->tpl->loadTemplatefile("kundenliste.tpl");
		$this->tpl->touchBlock('KUNDENLISTE');
		
		$db = new database();
		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();
		
		//initialisieren der drei Variablen

		if(!isset($suchbegrifffromXML) || $suchbegrifffromXML == null)
		{
			$howmany = $howmanyfromXML;
			
			$params = array(
	    					'mode' 		=> 'Sliding',
	    					'perPage' 	=> $howmany,
							'append' 	=> false,
							'path'		=> '',
							'fileName' 	=> 'javascript:showPage(%d)',
	    					'delta' 	=> 5,
	    					'itemData' 	=> $alleKundenArray);
			 
			 
			$pager = & Pager::factory($params);
			$daten  = $pager->getPageData();
			$links = $pager->getLinks();
			
			foreach ($daten as $key => $data)
			{
				$this->tpl->setCurrentBlock('LISTEKUNDEN');
				if($key % 2 == 0)
				{
					$this->tpl->setVariable('LISTBACKGROUND', 'lightbackground');
				}		
				$this->tpl->setVariable('KUNDENNUMMER', $data['kundennummer']);
				$this->tpl->setVariable('KUNDENID', $data['id']);
				$this->tpl->setVariable('PAGEID', $_REQUEST['pageID']);				
				$this->tpl->setVariable('NAME', $data['vorname'].' '.$data['nachname']);
				$this->tpl->setVariable('STRASSE', $data['strasse'].' '.$data['hausnummer']);
				$this->tpl->setVariable('STADT', $data['stadt']);
				$this->tpl->setVariable('WAS', 'kunde');
				$this->tpl->setVariable('IDKUNDE', $data['id']);
				$this->tpl->parseCurrentBlock('LISTEBILDFORMATE');
			}
					
		}else{
			$kundenEingeschraenkt = array();
			foreach ($alleKundenArray as $key => $data)
			{
				
				switch ($suchenachfromXML)
				{
					case 'nachname':
						if(strpos(strtolower($data['nachname']), strtolower($suchbegrifffromXML)) === 0)
						{
							$kundenEingeschraenkt[] = $data;
						}
						break;
						
					case 'kundennummer':
						if(strpos(strtolower($data['kundennummer']), strtolower($suchbegrifffromXML)) === 0)
						{
							$kundenEingeschraenkt[] = $data;
						}
						break;
						
					case 'stadt':
						if(strpos(strtolower($data['stadt']), strtolower($suchbegrifffromXML)) === 0)
						{
							$kundenEingeschraenkt[] = $data;
						}
						break;
						
					default:
						if(strpos(strtolower($data['nachname']), strtolower($suchbegrifffromXML)) === 0)
						{
							$kundenEingeschraenkt[] = $data;
						}
						break;
				}

			}			
			$howmany = $howmanyfromXML;
			$suchenach = $suchenachfromXML;
			$suchbegriff = $suchbegrifffromXML;
			$params = array(
	    					'mode' 		=> 'Sliding',
	    					'perPage' 	=> $howmany,
							'append' 	=> false,
							'path'		=> '',
							'fileName' 	=> "javascript:showPage(%d)",
	    					'delta' 	=> 5,
	    					'itemData' 	=> $kundenEingeschraenkt);
			 
			$pager = & Pager::factory($params);
			$daten  = $pager->getPageData();
			$links = $pager->getLinks();
			
			//print_r($daten);
			
			foreach ($daten as $key => $data)
			{
				$this->tpl->setCurrentBlock('LISTEKUNDEN');
				if($key % 2 == 0)
				{
					$this->tpl->setVariable('LISTBACKGROUND', 'lightbackground');
				}else{
					
				}			
				$this->tpl->setVariable('KUNDENNUMMER', $data['kundennummer']);
				$this->tpl->setVariable('KUNDENID', $data['id']);				
				$this->tpl->setVariable('PAGEID', $_REQUEST['pageID']);	
				$this->tpl->setVariable('NAME', $data['vorname'].' '.$data['nachname']);
				$this->tpl->setVariable('STRASSE', $data['strasse'].' '.$data['hausnummer']);
				$this->tpl->setVariable('STADT', $data['stadt']);
				$this->tpl->setVariable('WAS', 'kunde');
				$this->tpl->setVariable('IDKUNDE', $data['id']);								
				$this->tpl->parseCurrentBlock('LISTEBILDFORMATE');
			}
		}		

		$this->tpl->setVariable('objekt_linker', $links['all']);
		
		$this->tpl->show();
		
	}
}
?>