<?php

require_once ('./view/showbehavior.php');

/**
*
* @license LGPL http://www.gnu.org/licenses/lgpl-3.0.html
* @author <a href="mailto:c.wohlbrecht@photoffice.de">Chris Wohlbrecht</a>
*
*/

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
			$applicationstate = application::getInstance();
			$applicationstate->_addRole("customer");
			header("Location:./kundenindex.html");
		}

		$this->tpl->show();

	}
}
?>