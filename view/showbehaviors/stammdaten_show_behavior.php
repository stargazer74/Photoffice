<?php

require_once ('./view/showbehavior.php');


class stammdaten_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();	
		$this->tpl->loadTemplatefile("stammdaten.tpl");
		$this->tpl->touchBlock('STAMMDATEN');

		

		
		$form = new HTML_QuickForm('firmaform', 'POST', 'stammdaten.html');
		
		//$event = HTML_QuickForm::createElement('hidden', 'loginButtonClicked', 'loginButtonClicked');
		$firmenname = HTML_QuickForm::createElement('text', 'firmenname', 'Firmenname', array('class="form"', 'size="45"', 'maxlength="45"'));
		$geschaeftsfuehrer = HTML_QuickForm::createElement('text', 'geschaeftsfuehrer', 'Geschäftsführer', array('class="form"', 'size="45"', 'maxlength="45"'));
		$strasse = HTML_QuickForm::createElement('text', 'strasse', 'Straße', array('class="form"', 'size="45"', 'maxlength="45"'));
		$hausnummer = HTML_QuickForm::createElement('text', 'hausnummer', 'Hausnummer', array('class="form"', 'size="4"', 'maxlength="4"'));
		$plz = HTML_QuickForm::createElement('text', 'plz', 'Postleitzahl', array('class="form"', 'size="5"', 'maxlength="5"'));
		$stadt = HTML_QuickForm::createElement('text', 'stadt', 'Stadt', array('class="form"', 'size="45"', 'maxlength="45"'));
		$telefon = HTML_QuickForm::createElement('text', 'telefon', 'Telefon', array('class="form"', 'size="45"', 'maxlength="45"'));
		$fax = HTML_QuickForm::createElement('text', 'fax', 'Fax', array('class="form"', 'size="45"', 'maxlength="45"'));
		$email = HTML_QuickForm::createElement('text', 'email', 'E-Mail', array('class="form"', 'size="45"', 'maxlength="45"'));
		$internet = HTML_QuickForm::createElement('text', 'internet', 'Webseite', array('class="form"', 'size="45"', 'maxlength="45"'));
		$mobil = HTML_QuickForm::createElement('text', 'mobil', 'Mobiltelefon', array('class="form"', 'size="45"', 'maxlength="45"'));
		$bankname = HTML_QuickForm::createElement('text', 'bankname', 'Bankname', array('class="form"', 'size="45"', 'maxlength="45"'));
		$bankleitzahl = HTML_QuickForm::createElement('text', 'bankleitzahl', 'Bankleitzahl', array('class="form"', 'size="8"', 'maxlength="8"'));
		$kontonummer = HTML_QuickForm::createElement('text', 'kontonummer', 'Kontonummer', array('class="form"', 'size="20"', 'maxlength="20"'));
		$steuernummer = HTML_QuickForm::createElement('text', 'steuernummer', 'Steuernummer', array('class="form"', 'size="20"', 'maxlength="13"'));
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Daten ändern', 'class="form"');
		
		$firmenDatenInstance = company::_getInstance();

		$firmenname->setValue($firmenDatenInstance->_getFirmenName());
		$geschaeftsfuehrer->setValue($firmenDatenInstance->_getGeschaeftsFuehrer());
		$strasse->setValue($firmenDatenInstance->_getStrasse());
		$hausnummer->setValue($firmenDatenInstance->_getHausNummer());
		$plz->setValue($firmenDatenInstance->_getPostleitZahl());
		$stadt->setValue($firmenDatenInstance->_getStadt());
		$telefon->setValue($firmenDatenInstance->_getTelefon());
		$fax->setValue($firmenDatenInstance->_getFax());
		$email->setValue($firmenDatenInstance->_getMail());
		$internet->setValue($firmenDatenInstance->_getWebsite());
		$mobil->setValue($firmenDatenInstance->_getMobil());
		$bankname->setValue($firmenDatenInstance->_getBankName());
		$bankleitzahl->setValue($firmenDatenInstance->_getBankleitZahl());
		$kontonummer->setValue($firmenDatenInstance->_getKontoNummer());
		$steuernummer->setValue($firmenDatenInstance->_getSteuerNummer());
		
		
		$form->addElement($firmenname);		
		$form->addElement($geschaeftsfuehrer);
		$form->addElement($strasse);
		$form->addElement($hausnummer);	
		$form->addElement($plz);	
		$form->addElement($stadt);
		$form->addElement($telefon);
		$form->addElement($fax);
		$form->addElement($email);
		$form->addElement($internet);
		$form->addElement($bankname);
		$form->addElement($bankleitzahl);
		$form->addElement($mobil);	
		$form->addElement($kontonummer);
		$form->addElement($steuernummer);
		$form->addElement($submit);

		$form->addRule('firmenname', 'Bitte geben sie einen Namen ein!', 'required');
		$form->addRule('geschaeftsfuehrer', 'Bitte geben sie den Geschäftsführer an!', 'required');
		$form->addRule('strasse', 'Bitte geben sie eine Straße ein!', 'required');
		$form->addRule('hausnummer', 'Bitte geben sie den Geschäftsführer an!', 'required');
		$form->addRule('plz', 'Bitte geben sie eine Postleitzahl an!', 'required');
		$form->addRule('stadt', 'Bitte geben sie eine Stadt an!', 'required');
		$form->addRule('steuernummer', 'Bitte geben sie ihre Steuernummer an!', 'required');
		$form->addRule('email', 'Bitte geben sie ihre E-Mail an!', 'required');
		
		if(false == $form->validate())
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$form->accept($renderer);
		}else{
			$firmenDatenInstance->_setFirmenName($firmenname->getValue());
			$firmenDatenInstance->_setGeschaeftsFuehrer($geschaeftsfuehrer->getValue());
			$firmenDatenInstance->_setStrasse($strasse->getValue());
			$firmenDatenInstance->_setHausNummer($hausnummer->getValue());
			$firmenDatenInstance->_setPostleitZahl($plz->getValue());
			$firmenDatenInstance->_setStadt($stadt->getValue());
			$firmenDatenInstance->_setTelefon($telefon->getValue());
			$firmenDatenInstance->_setFax($fax->getValue());
			$firmenDatenInstance->_setMobil($mobil->getValue());
			$firmenDatenInstance->_setMail($email->getValue());
			$firmenDatenInstance->_setSteuerNummer($steuernummer->getValue());
			$firmenDatenInstance->_setWebsite($internet->getValue());
			$firmenDatenInstance->_setBankName($bankname->getValue());
			$firmenDatenInstance->_setBankleitZahl($bankleitzahl->getValue());
			$firmenDatenInstance->_setKontoNummer($kontonummer->getValue());
			header("Location:./stammdaten.html");
		}
		
		
		$this->tpl->show();

	}
}
?>