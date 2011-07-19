<?php

require_once ('./view/showbehavior.php');


class bestellungabschliessen_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$db = new database();
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();	
		$this->tpl->loadTemplatefile("bestellungabschliessen.tpl");
		$this->tpl->touchBlock('BESTELLUNGABSCHLIESSEN');
		
		$applicationStateInstance = application::getInstance();
		$bestellungid = $applicationStateInstance->_getBestellungID();
		
		$alleBestellungenInstance = $db->_getBestellungen();
		$alleBestellungenArray = $alleBestellungenInstance->_ausgeben();
		$aktuelleBestellung = null;
		
		foreach ($alleBestellungenArray as $bestellung)
		{
			if ($bestellung['id'] == $bestellungid)
			{
				$aktuelleBestellung = $bestellung;
			}
		}
		
		//Kunde finden
		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();
		
		$gesuchterKunde = array();
		foreach ($alleKundenArray as $data)
		{
			if($data['id'] == $aktuelleBestellung['idkunde'])
			{
				$gesuchterKunde = $data;
			}
		}
		
		$bestellungabschliessenform = new HTML_QuickForm('bestellungabschliessenform', 'POST', 'bestellungabschliessen.html');
		
		$betreffzeile = HTML_QuickForm::createElement('text', 'betreff', 'Betreffzeile', array('class="form"', 'size="45"', 'maxlength="45"'));
		$nachricht = HTML_QuickForm::createElement('textarea', 'nachricht', 'Nachricht an den Kunden', array('class="form"', 'cols="47"', 'rows="10"'));
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Nachricht an den Kunden schicken und Bestellung abschliessen', array('class="form mouseoverhand"', 'id="updatekundendaten"'));
				
		$bestellungabschliessenform->addElement($betreffzeile);
		$bestellungabschliessenform->addElement($nachricht);
		$bestellungabschliessenform->addElement($submit);
		
		$bestellungabschliessenform->addRule('betreff', 'Sie müssen mindestens eine Betreffzeile eintragen!', 'required');

		if(false == $bestellungabschliessenform->validate())
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$bestellungabschliessenform->accept($renderer);
		}else{
			//Mail abschicken und als bearbeitet kennzeichnen
			$firmendaten = company::_getInstance();
			$recipients = $gesuchterKunde['email'];
			
			$headers['From']    = $firmendaten->_getMail();
			$headers['To']      = $gesuchterKunde['email'];
			$headers['Subject'] = $betreffzeile->getValue();
			$headers['Mime-Version'] = '1.0';
			$headers['Content-Type'] = 'text/plain; charset=utf-8';
			$headers['Content-Transfer-Encoding'] = 'quoted-printable';
		
			$body = $nachricht->getValue();
			
			$mail_object = Mail::factory('mail');
			
			if ($mail_object->send($recipients, $headers, $body))
			{
				$bestellungtoupdate = new bestellung($aktuelleBestellung['id'], $aktuelleBestellung['idkunde'], $aktuelleBestellung['datum'], 1, 1, $aktuelleBestellung['bestellwert'], $aktuelleBestellung['bilder'], $aktuelleBestellung['anmerkung']);
				$db->_update($bestellungtoupdate);	
			}
			header("Location:./bestellungabschliessen.html");			
		}
		$this->tpl->show();
	}
}
?>