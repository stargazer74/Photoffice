<?php

require_once ('./view/showbehavior.php');


class neufotograf_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();	
		$this->tpl->loadTemplatefile("neufotograf.tpl");
		$this->tpl->touchBlock('FOTOGRAFAENDERN');

		
		$neufotografform = new HTML_QuickForm('neufotografform', 'POST', 'neufotograf.html');
		
		$vorname = HTML_QuickForm::createElement('text', 'vorname', 'Vorname', array('class="form"', 'size="45"', 'maxlength="45"'));
		$nachname = HTML_QuickForm::createElement('text', 'nachname', 'Nachname', array('class="form"', 'size="45"', 'maxlength="45"'));
		$loginname = HTML_QuickForm::createElement('text', 'loginname', 'Loginname', array('class="form"', 'size="45"', 'maxlength="45"'));
		$passwort = HTML_QuickForm::createElement('password', 'passwort', 'Passwort', array('class="form"', 'size="45"', 'maxlength="45"'));
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Fotograf eintragen', 'class="form"');
		
		$neufotografform->addElement($vorname);
		$neufotografform->addElement($nachname);
		$neufotografform->addElement($loginname);
		$neufotografform->addElement($passwort);
		$neufotografform->addElement($submit);

		/// @todo Loginname muss unique sein
		$neufotografform->addRule('vorname', 'Bitte geben sie einen Vornamen ein!', 'required');
		$neufotografform->addRule('nachname', 'Bitte geben sie einen Nachnamen ein!', 'required');
		$neufotografform->registerRule('chkIfPasswortIsEmpty', 'callback', '_chkIfPasswortIsEmpty', 'chkfunctions');
		$formulardaten = array($loginname->getValue(), $passwort->getValue());
		$neufotografform->addRule('loginname', 'Wenn Sie ein Loginname vergeben, müssen Sie auch ein Passwort vergeben!', 'chkIfPasswortIsEmpty', $formulardaten);
		$neufotografform->registerRule('chkIfUsernameIsEmpty', 'callback', '_chkIfUsernameIsEmpty', 'chkfunctions');
		$neufotografform->addRule('passwort', 'Wenn Sie ein Passwort vergeben, müssen Sie auch ein Loginname vergeben!', 'chkIfUsernameIsEmpty', $formulardaten);


		if(false == $neufotografform->validate())
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$neufotografform->accept($renderer);
		}else{
			$db = new database();
			/// @todo keinen neuen fotograf anlegen, sondern bestehenden ändern
			$fotograf = new fotograf(NULL, 1, $vorname->getValue(), $nachname->getValue(), $loginname->getValue(), md5($passwort->getValue()));

			if(($db->_insert($fotograf)))
			{

			}else{
				throw new Exception("Kann die Daten nicht eintragen");
			}

		header("Location:./neufotograf.html");
			
		}
		$this->tpl->show();
	}
}
?>