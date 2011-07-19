<?php

require_once ('./view/showbehavior.php');


class kundenlogin_show_behavior implements showbehavior
{
	public function __construct()
	{

	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->loadTemplatefile("mainframekundensicht.tpl");
		$this->tpl->setVariable('PAGETITLE', $_SESSION['kundenname']);
		$this->tpl->setVariable('VERSION_NUMBER', $registryInstance->_getVersionNumber());

		$this->tpl->addBlockfile('CONTENTBLOCK', 'contentblock', 'kundenlogin.tpl');
		$this->tpl->touchBlock('KUNDENLOGIN');

		$form = new HTML_QuickForm('loginform', 'POST', 'kundenlogin.html');

		$passwort = HTML_QuickForm::createElement('password', 'passwort', 'Passwort', 'class="form"');
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Login', 'class="form"');

		$form->addElement($passwort);
		$form->addElement($submit);

		$form->addRule('passwort', 'Bitte geben sie ein Passwort ein!', 'required');


		$felder = $passwort->getValue();

		$parameter = $passwort->getValue();

		$form->registerRule('chkKundenLogin', 'callback', '_chkKundenLogin', 'kundenlogincheck');
		//print_r($parameter);
		$form->addRule('passwort', 'Falsches Passwort', 'chkKundenLogin', $felder);

		if(false == $form->validate())
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$form->accept($renderer);
		}else{
			$_SESSION['kundelogged'] = md5("customergoforit");
			header("Location:./kundenindex.html");
		}

		$this->tpl->show();

	}
}
?>