<?php

require_once ('./view/showbehavior.php');


class kundeaendern_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		/// @todo die Liste wird immer neu aufgerufen, vielleicht kann man auch an die Stelle
		/// springen, an der man auf den Ändern Button geklickt hat
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();	
		$this->tpl->loadTemplatefile("kundeaendern.tpl");
		$this->tpl->touchBlock('KUNDEAENDERN');
		
		$applicationStateInstance = application::getInstance();
		$kundenid = $applicationStateInstance->_getIDKunde();
		
		//Kunde finden
		$db = new database();
		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();
		
		$gesuchterKunde = array();
		foreach ($alleKundenArray as $data)
		{
			if($data['id'] == $kundenid)
			{
				$gesuchterKunde[] = $data;
			}
		}
		
		$kundeaendernform = new HTML_QuickForm('kundeaendernform', 'POST', 'kundeaendern.html');
		
		$pass = HTML_QuickForm::createElement('hidden', 'passwort');
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
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Kundendaten ändern', array('class="form"', 'id="updatekundendaten"'));
		
		//Formulardaten setzen
		$pass->setValue($gesuchterKunde[0]['passwort']);
		$kundennummer->setValue($gesuchterKunde[0]['kundennummer']);
		$firma->setValue($gesuchterKunde[0]['firma']);
		$vorname->setValue($gesuchterKunde[0]['vorname']);
		$name->setValue($gesuchterKunde[0]['nachname']);
		$strasse->setValue($gesuchterKunde[0]['strasse']);
		$hausnummer->setValue($gesuchterKunde[0]['hausnummer']);
		$plz->setValue($gesuchterKunde[0]['plz']);
		$stadt->setValue($gesuchterKunde[0]['stadt']);
		$telefon->setValue($gesuchterKunde[0]['telefonnummer']);
		$mail->setValue($gesuchterKunde[0]['email']);
		
		$kundeaendernform->addElement($pass);
		$kundeaendernform->addElement($kundennummer);
		$kundeaendernform->addElement($firma);
		$kundeaendernform->addElement($vorname);
		$kundeaendernform->addElement($name);
		$kundeaendernform->addElement($strasse);
		$kundeaendernform->addElement($hausnummer);
		$kundeaendernform->addElement($plz);
		$kundeaendernform->addElement($stadt);
		$kundeaendernform->addElement($telefon);
		$kundeaendernform->addElement($mail);
		$kundeaendernform->addElement($submit);
		
		$kundeaendernform->addRule('plz', 'Bitte geben Sie eine gültige Postleitzahl ein!', 'regex', '/^\d{5}$/');
		$kundeaendernform->registerRule('chkIfCustomerNumberExistsForUpdate', 'callback', '_chkIfCustomerNumberExistsForUpdate', 'chkfunctions');
		$formulardaten = array($kundennummer->getValue(), $kundenid);
		$kundeaendernform->addRule('kundennummer', 'Diese Kundennummer exisitiert schon!', 'chkIfCustomerNumberExistsForUpdate', $formulardaten);
		$kundeaendernform->addRule('vorname', 'Bitte geben sie einen Vornamen ein!', 'required');
		$kundeaendernform->addRule('name', 'Bitte geben sie einen Nachnamen ein!', 'required');
		$kundeaendernform->addRule('mail', 'Bitte geben sie eine E-Mail ein!', 'required');
		$kundeaendernform->addRule('mail', 'Bitte gib eine korrekte E-Mail Adresse ein!', 'email');


		if(false == $kundeaendernform->validate())
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$kundeaendernform->accept($renderer);
		}else{
			/// @todo keinen neuen Kunde anlegen, sondern bestehenden ändern
			$Kunde = new kunde(	$kundenid,
								$kundennummer->getValue(),
								$firma->getValue(),
								$vorname->getValue(),
								$name->getValue(),
								$strasse->getValue(),
								$hausnummer->getValue(),
								$plz->getValue(),
								$stadt->getValue(),
								$telefon->getValue(),
								$mail->getValue(),
								$pass->getValue());
									
			$db = new database();
			if($db->_update($Kunde))
			{
				
			}else{
				throw new Exception("Kann die Daten nicht eintragen");
			}	

		header("Location:./kundeaendern.html");
			
		}
		$this->tpl->show();
	}
}
?>