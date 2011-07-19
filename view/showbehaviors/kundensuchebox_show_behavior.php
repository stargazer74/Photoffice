<?php

require_once ('./view/showbehavior.php');


class kundensuchebox_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('KUNDENSUCHEBOX', 'kundensuchebox', 'kundensuchebox.tpl');
		$this->tpl->touchBlock('KUNDENSUCHEBOX');
		
		$applicationStateInstance = application::getInstance();
		$suchenachfromxml = $applicationStateInstance->_getSucheNach();
		$suchbegrifffromxml = $applicationStateInstance->_getSuchbegriff();
		$anzahltrefferfromxml = $applicationStateInstance->_getHowmany();
		
		$sucheform = new HTML_QuickForm('suchkundeform', 'POST', 'kundenliste.html');
		
		$params = array('class' => 'form', 'onClick' => 'kundensuche()');
		$suchenach[] = HTML_QuickForm::createElement('radio', 'suchart', 'null', 'Nachname', 'nachname', $params);
		$suchenach[] = HTML_QuickForm::createElement('radio', 'suchart', 'null', 'Kundennummer', 'kundennummer', $params);
		$suchenach[] = HTML_QuickForm::createElement('radio', 'suchart', 'null', 'Stadt', 'stadt', $params);
		
		$suchbegriff = HTML_QuickForm::createElement('text', 'suchfeld', 'Suchbegriff', array('id' => 'suchfeld', 'class' => 'form', 'onkeyup' => 'kundensuche()'));
		$suchbegriff->setValue($suchbegrifffromxml);
		$anzahltreffer = HTML_QuickForm::createElement('select', 'anzahltreffer', 'Anzahl der Kunden pro Seite', null, array('class' => 'form', 'onchange' => 'kundensuche()'));
		$anzahltreffer->addOption('10', '10');
		$anzahltreffer->addOption('20', '20');
		$anzahltreffer->addOption('40', '40');
		$anzahltreffer->addOption('80', '80');
		$anzahltreffer->addOption('160', '160');
		$anzahltreffer->setSelected($anzahltrefferfromxml);
		
		
		$sucheform->addGroup($suchenach, 'suchart', null, '<br />', false);
		$sucheform->setDefaults(array('suchart' => $suchenachfromxml));
		//$sucheform->addElement($suchenachnachname);
		//$sucheform->addElement($suchenachkundennummer);
		//$sucheform->addElement($suchenachstadt);
		$sucheform->addElement($suchbegriff);
		$sucheform->addElement($anzahltreffer);
		
		$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
		$renderer->setErrorTemplate('');
		$sucheform->accept($renderer);
		
	}
}
?>