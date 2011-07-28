<?php

require_once ('./view/showbehavior.php');


class login_show_behavior implements showbehavior
{
	public function __construct()
	{

	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->loadTemplatefile("mainframe.tpl");
		$this->tpl->setVariable('PAGETITLE', 'photoffice Version '.$registryInstance->_getVersionNumber());
		$this->tpl->setVariable('VERSION_NUMBER', $registryInstance->_getVersionNumber());

		$this->tpl->addBlockfile('CONTENTBLOCK', 'contenblock', 'login.tpl');
		$this->tpl->touchBlock('LOGIN');

		$form = new HTML_QuickForm('loginform', 'POST', 'login.html');

		//$event = HTML_QuickForm::createElement('hidden', 'loginButtonClicked', 'loginButtonClicked');
		$benutzername = HTML_QuickForm::createElement('text', 'benutzername', 'Benutzername', 'class="form"');
		$passwort = HTML_QuickForm::createElement('password', 'passwort', 'Passwort', 'class="form"');
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Login', 'class="form"');

		$form->addElement($benutzername);
		$form->addElement($passwort);
		$form->addElement($submit);

		$form->addRule('benutzername', 'Bitte geben sie einen Namen ein!', 'required');
		$form->addRule('passwort', 'Bitte geben sie ein Passwort ein!', 'required');


		$felder = array('benutzername' => $benutzername->getValue(),
						'passwort' => $passwort->getValue());

		$parameter = array(	0 => $felder,
							1 => $login);
		//print_r($login);
		$form->registerRule('_chk_login', 'callback', '_chk_login', 'logincheck');
		//print_r($parameter);
		$form->addRule('passwort', 'Falsches Login', '_chk_login', $felder);

		if(false == $form->validate())
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$form->accept($renderer);
		}else{
			header("Location:./index.html");
		}

		$this->tpl->show();

	}
}
?>