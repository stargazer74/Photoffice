<?php

require_once ('./view/showbehavior.php');


class bilduploadbox_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}
	
	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->addBlockfile('BILDUPLOAD', 'bilduploadbox', 'bilduploadbox.tpl');
		$this->tpl->touchBlock('BILDUPLOADBOX');
		
		$db = new database();
		$alleFotografenInstance = $db->_getFotografen();
		$alleFotografenArray = $alleFotografenInstance->_ausgeben();
		
		$form = new HTML_QuickForm('dateiuploadform', 'POST', '#');
		
		$fotografenauswahl = HTML_QuickForm::createElement('select', 'fotografenauswahl', 'Wählen Sie einen Fotografen aus!', null, array('class' => 'form', 'id' => 'fotografenauswahl', 'onchange' => 'changePictureStatus()'));
		foreach ($alleFotografenArray as $data)
		{
			$fotografenauswahl->addOption($data['vorname'].' '.$data['name'], $data['id']);
		}
		$fotografenauswahl->setSelected($alleFotografenArray[0]['id']);
		
		$params = array('class' => 'form', 'onClick' => 'changePictureStatus()');
		$wasserzeichen[] = HTML_QuickForm::createElement('radio', 'wasserzeichen', 'null', 'ja', '1', $params);
		$wasserzeichen[] = HTML_QuickForm::createElement('radio', 'Wasserzeichen', 'null', 'nein', '0', $params);
		
		$transparenz = HTML_QuickForm::createElement('select', 'transparenz', 'Legen Sie die Transparenz für das Wasserzeichen fest!', null, array('class' => 'form', 'id' => 'transparenz', 'onchange' => 'changePictureStatus()'));
		$transparenz->addOption('10', '10');
		$transparenz->addOption('20', '20');
		$transparenz->addOption('30', '30');
		$transparenz->addOption('40', '40');
		$transparenz->addOption('50', '50');
		$transparenz->addOption('60', '60');
		$transparenz->addOption('70', '70');
		$transparenz->addOption('80', '80');
		$transparenz->addOption('90', '90');
		$transparenz->addOption('100', '100');
		$transparenz->setSelected('20');
		
		
		
		$form->addElement($fotografenauswahl);
		$form->addGroup($wasserzeichen, 'wasserzeichen', null, '<br />', false);
		$form->addElement($transparenz);
		$form->setDefaults(array('wasserzeichen' => 1));
		
		$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
		$renderer->setErrorTemplate('');
		$form->accept($renderer);
	}
}
?>