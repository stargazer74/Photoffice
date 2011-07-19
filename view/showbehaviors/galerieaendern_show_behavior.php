<?php

require_once ('./view/showbehavior.php');


class galerieaendern_show_behavior implements showbehavior
{
	public function __construct()
	{

	}

	public function _show()
	{
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$applicationStateInstance = application::getInstance();
		$db = new database();

		//aktuelle Galerie
		$alleGalerienInstance = $db->_getGalerien();
		$alleGalerienArray = $alleGalerienInstance->_ausgeben();

		$galerieid = $applicationStateInstance->_getGalerieID();
		$aktuelleGalerie = array();
		foreach ($alleGalerienArray as $data)
		{
			if ($data['id'] == $galerieid)
			{
				$aktuelleGalerie = $data;
			}
		}

		if (!$aktuelleGalerie)
		{
			$alleGalerienInstance = $db->_getOeffentlicheGalerien();
			$alleGalerienArray = $alleGalerienInstance->_ausgeben();
		}

		foreach ($alleGalerienArray as $data)
		{
			if ($data['id'] == $galerieid)
			{
				$aktuelleGalerie = $data;
			}
		}

		//aktueller Kunde
		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();
		$aktuellerKunde = null;

		foreach ($alleKundenArray as $kunde)
		{
			if ($aktuelleGalerie['idkunde'] == $kunde['id'])
			{
				$aktuellerKunde = $kunde;
			}
		}


		$this->tpl->loadTemplateFile('galerieaendern.tpl');
		$this->tpl->touchBlock('GALERIEAENDERN');

		$form = new HTML_QuickForm('galerieeinstellungenform', 'POST', 'galerieaendern.html');

		$params = array('class' => 'form', 'onClick' => '');
		$onlinestatus[] = HTML_QuickForm::createElement('radio', 'onlinestatus', 'null', 'online', '1', $params);
		$onlinestatus[] = HTML_QuickForm::createElement('radio', 'onlinestatus', 'null', 'offline', '0', $params);
		$galeriename = HTML_QuickForm::createElement('text', 'galeriename', 'Galeriename', array('class="form"', 'size="45"', 'maxlength="45"'));
		$verfallsdatum = HTML_QuickForm::createElement('date', 'verfallsdatum', 'Verfallsdatum der Galerie', array('format'=>'d-m-Y','language'=>'de', 'minYear'=>2010, 'maxYear'=>2015), 'class="form"');
		$kundenmail = HTML_QuickForm::createElement('checkbox', 'kundenmail', '', 'Kundenmail', 'class="form"');
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Daten ändern', 'class="form mouseoverhand"');

		$form->addGroup($onlinestatus, 'onlinestatus', null, '<br />', false);
		$form->addElement($galeriename);
		$form->addElement($verfallsdatum);
		$form->addElement($kundenmail);
		$form->addElement($submit);

		if (!$aktuellerKunde['passwort'])
		{
			$kundenmail->setChecked(true);
		}

		$datum = explode('-', $aktuelleGalerie['verfallsdatum']);
		$form->setDefaults(array('onlinestatus' => $aktuelleGalerie['online'],'galeriename' => $aktuelleGalerie['galeriename'],'verfallsdatum' => array('d' => $datum[2], 'm' => $datum[1], 'Y' => $datum[0])));

		$form->addRule('galeriename', 'Sie müssen einen Namen für die Galerie vergeben!', 'required');

		$verfallsdatumvalue = $verfallsdatum->getValue();
		$verfallsdatumvalue = $verfallsdatumvalue['Y'][0].'-'.$verfallsdatumvalue['m'][0].'-'.$verfallsdatumvalue['d'][0];
		$onlinestatusvalue = $form->getSubmitValue('onlinestatus');
		if ($onlinestatusvalue == 1)
		{
			$form->registerRule('chkIfOnlineStatusCanChange', 'callback', '_chkIfOnlineStatusCanChange', 'chkfunctions');
			$form->addRule('onlinestatus', 'Sie können die Galerie nicht online schalten, da das Verfallsdatum in der vergangenheit liegt.', 'chkIfOnlineStatusCanChange', $verfallsdatumvalue);
			$form->registerRule('chkIfPreisIsAvailable', 'callback', '_chkIfPreisIsAvailable', 'chkfunctions');
			$form->addRule('onlinestatus', 'Sie können die Galerie nicht online schalten, solange keine Preise festgelegt sind.', 'chkIfPreisIsAvailable');
		}

		if(false == $form->validate())
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$form->accept($renderer);
		}else{
			$galerienamevalue = $galeriename->getValue();
			$galerie = new galerie($aktuelleGalerie['id'], $galerienamevalue, $onlinestatusvalue, $verfallsdatumvalue, null, null);
			$db->_update($galerie);

			$checkbox_is_true = $kundenmail->getChecked();

			if(!$aktuelleGalerie['online'] && $onlinestatusvalue && $checkbox_is_true)
			{
				$firmendaten = company::_getInstance();

				$recipients = $aktuellerKunde['email'];

				$headers['From']    = $firmendaten->_getMail();
				$headers['To']      = $aktuellerKunde['email'];
				$headers['Subject'] = 'Eine Galerie wurde für Sie freigeschaltet.';
				$headers['Mime-Version'] = '1.0';
				$headers['Content-Type'] = 'text/plain; charset=utf-8';
				$headers['Content-Transfer-Encoding'] = 'quoted-printable';

				$passphrase = string::genRandomString(8);

				$body = 'Sehr geehrter Kunde,
				dies ist eine automatisch erzeugte Mail. Eine neue Galerie wurde für Sie freigeschaltet.
				Sie können sich unter: '.$_SERVER['HTTP_HOST'].'/photoffice/kundenlogin.html einloggen.
				Ihr Passwort lautet: '.$passphrase;

				$mail_object = Mail::factory('mail');

				if ($mail_object->send($recipients, $headers, $body))
				{
					$kundeupdate = new kunde($aktuellerKunde['id'], $aktuellerKunde['kundennummer'], $aktuellerKunde['firma'], $aktuellerKunde['vorname'], $aktuellerKunde['nachname'], $aktuellerKunde['strasse'], $aktuellerKunde['hausnummer'], $aktuellerKunde['plz'], $aktuellerKunde['stadt'], $aktuellerKunde['telefonnummer'], $aktuellerKunde['email'], md5($passphrase));
					$db->_update($kundeupdate);
				}
			}else{

			}

			header("Location:./galerieaendern.html");
		}

		$this->tpl->show();


	}
}
?>