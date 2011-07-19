<?php

require_once ('./view/showbehavior.php');


class fotografaendern_show_behavior implements showbehavior
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
		$this->tpl->loadTemplatefile("fotografaendern.tpl");
		$this->tpl->touchBlock('FOTOGRAFAENDERN');
		
		$applicationStateInstance = application::getInstance();
		$fotografenid = $applicationStateInstance->_getFotografenID();
		
		//Kunde finden
		$db = new database();
		$alleFotografenInstance = $db->_getFotografen();
		$alleFotografenArray = $alleFotografenInstance->_ausgeben();
		
		$gesuchterFotograf = NULL;
		foreach ($alleFotografenArray as $data)
		{
			if($data['id'] == $fotografenid)
			{
				$gesuchterFotograf = $data;
			}
		}
		
		$fotografaendernform = new HTML_QuickForm('fotografaendernform', 'POST', 'fotografaendern.html');
		
		$vorname = HTML_QuickForm::createElement('text', 'vorname', 'Vorname', array('class="form"', 'size="45"', 'maxlength="45"'));
		$nachname = HTML_QuickForm::createElement('text', 'nachname', 'Nachname', array('class="form"', 'size="45"', 'maxlength="45"'));
		$loginname = HTML_QuickForm::createElement('text', 'loginname', 'Loginnamename', array('class="form"', 'size="45"', 'maxlength="45"'));
		$passwort = HTML_QuickForm::createElement('password', 'passwort', 'Passwort', array('class="form"', 'size="45"', 'maxlength="45"'));
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Fotografendaten ändern', array('class="form"', 'id="updatefotografendaten"'));
		
		//Formulardaten setzen
		$vorname->setValue($gesuchterFotograf['vorname']);
		$nachname->setValue($gesuchterFotograf['name']);
		$loginname->setValue($gesuchterFotograf['loginname']);
		//$passwort->setValue($gesuchterFotograf['passwort']);
		
		
		$fotografaendernform->addElement($vorname);
		$fotografaendernform->addElement($nachname);
		$fotografaendernform->addElement($loginname);
		$fotografaendernform->addElement($passwort);
		$fotografaendernform->addElement($submit);

		/// @todo Loginname muss unique sein
		$fotografaendernform->addRule('vorname', 'Bitte geben sie einen Vornamen ein!', 'required');
		$fotografaendernform->addRule('nachname', 'Bitte geben sie einen Nachnamen ein!', 'required');


		if(false == $fotografaendernform->validate())
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$fotografaendernform->accept($renderer);
		}else{
			$tmppasswort = null;
			if ($passwort->getValue())
			{
				$tmppasswort = md5($passwort->getValue());
			}
			/// @todo keinen neuen fotograf anlegen, sondern bestehenden ändern
			$fotograf = new fotograf($gesuchterFotograf['id'], NULL, $vorname->getValue(), $nachname->getValue(), $loginname->getValue(), $tmppasswort);

			if($db->_update($fotograf))
			{
				
			}else{
				throw new Exception("Kann die Daten nicht eintragen");
			}

		header("Location:./fotografaendern.html");
			
		}
		$this->tpl->show();
	}
}
?>