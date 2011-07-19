<?php

require_once ('./view/showbehavior.php');


class neukunde_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();	
		$this->tpl->loadTemplatefile("neukunde.tpl");
		$this->tpl->touchBlock('NEUKUNDE');
		
		$form = new HTML_QuickForm('neukundeform', 'POST', 'neukunde.html');
		
		$kundennummer = HTML_QuickForm::createElement('text', 'kundennummer', 'Kundennummer', array('class="form"', 'size="45"', 'maxlength="45"'));
		$firma = HTML_QuickForm::createElement('text', 'firma', 'Firma', array('class="form"', 'size="45"', 'maxlength="45"'));
		$vorname = HTML_QuickForm::createElement('text', 'vorname', 'Vorname', array('class="form"', 'size="45"', 'maxlength="45"'));
		$name = HTML_QuickForm::createElement('text', 'name', 'Name', array('class="form"', 'size="45"', 'maxlength="45"'));
		$strasse = HTML_QuickForm::createElement('text', 'strasse', 'Strasse', array('class="form"', 'size="45"', 'maxlength="45"'));
		$hausnummer = HTML_QuickForm::createElement('text', 'hausnummer', 'Hausnummer', array('class="form"', 'size="5"', 'maxlength="5"'));
		$plz = HTML_QuickForm::createElement('text', 'plz', 'Postleitzahl', array('class="form"', 'size="5"', 'maxlength="5"'));
		$stadt = HTML_QuickForm::createElement('text', 'stadt', 'Stadt', array('class="form"', 'size="45"', 'maxlength="45"'));
		$telefon = HTML_QuickForm::createElement('text', 'telefon', 'Telefonnummer', array('class="form"', 'size="45"', 'maxlength="45"'));
		$mail = HTML_QuickForm::createElement('text', 'mail', 'E-Mail', array('class="form"', 'size="45"', 'maxlength="45"'));
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Kundendaten eintragen', 'class="form"');
		
		$form->addElement($kundennummer);
		$form->addElement($firma);
		$form->addElement($vorname);
		$form->addElement($name);
		$form->addElement($strasse);
		$form->addElement($hausnummer);
		$form->addElement($plz);
		$form->addElement($stadt);
		$form->addElement($telefon);
		$form->addElement($mail);
		$form->addElement($submit);
		
		$form->addRule('plz', 'Bitte geben Sie eine gültige Postleitzahl ein!', 'regex', '/^\d{5}$/');
		$form->registerRule('chkIfCustomerNumberExists', 'callback', '_chkIfCustomerNumberExists', 'chkfunctions');
		$formulardaten = $kundennummer->getValue();
		$form->addRule('kundennummer', 'Diese Kundennummer exisitiert schon!', 'chkIfCustomerNumberExists', $formulardaten);
		$form->addRule('vorname', 'Bitte geben sie einen Vornamen ein!', 'required');
		$form->addRule('name', 'Bitte geben sie einen Nachnamen ein!', 'required');
		$form->addRule('mail', 'Bitte gib eine korrekte E-Mail Adresse ein!', 'email');
		$form->addRule('mail', 'Bitte geben sie eine E-Mail Adresse ein!', 'required');

		
		if(false == $form->validate())
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$form->accept($renderer);
		}else{
			$neuKunde = new kunde(	null,
									$kundennummer->getValue(),
									$firma->getValue(),
									$vorname->getValue(),
									$name->getValue(),
									$strasse->getValue(),
									$hausnummer->getValue(),
									$plz->getValue(),
									$stadt->getValue(),
									$telefon->getValue(),
									$mail->getValue());
									
			$db = new database();
			if($db->_insert($neuKunde))
			{
				header("Location:./neukunde.html");
			}else{
				throw new Exception("Kann die Daten nicht eintragen");
			}	
			
		}
		
		$this->tpl->show();

	}
}
?>