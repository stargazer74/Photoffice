<?php

require_once ('./view/showbehavior.php');


class agb_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();	
		$this->tpl->loadTemplatefile("agb.tpl");
		$this->tpl->touchBlock('AGB');

		$form = new HTML_QuickForm('agbform', 'POST', 'agb.html');
		
		$agb = HTML_QuickForm::createElement('textarea', 'agb', 'Unsere AGBs:', 'style="width:100%" class="mceEditor"');
		$idFirma = HTML_QuickForm::createElement('hidden', 'idfirma');
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Daten ändern', 'class="form"');
		
		$firmenDatenInstance = company::_getInstance();
		
		$agb->setValue($firmenDatenInstance->_getAGB());
		$idFirma->setValue($firmenDatenInstance->_getIDFirma());
		
		$form->addElement($agb);
		$form->addElement($idFirma);
		$form->addElement($submit);
		
		
		if(false == $form->validate())
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$form->accept($renderer);
		}else{
			$firmenDatenInstance->_setAGB($agb->getValue());
			header("Location:./agb.html");
		}
		$this->tpl->show();
	}
}
?>