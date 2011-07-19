<?php
require_once ('./controller/action.php');


class warenkorbeintragen_action_behavior implements action 
{
	
	private $controller;
	
	public function __construct($controller = 'kundenlogin')
	{
		$this->controller = $controller;
		
	}
	
	public function _action()
	{
		$db = new database();
		$bestellung = new bestellung(null, null, null, true, false, null, null, $_REQUEST['anmerkung']);
		$db->_update($bestellung);
		$_SESSION['bestellungid'] = '';
		
		$alleKundenInstance = $db->_getKunden();
		$alleKundenArray = $alleKundenInstance->_ausgeben();
		$aktuellerKunde = null;
		
		foreach ($alleKundenArray as $kunde)
		{
			if ($kunde['id'] == $_SESSION['benutzerid'])
			{
				$aktuellerKunde = $kunde;
			}
		}
		
		$firma = company::_getInstance();
		
		$recipients = $firma->_getMail();
		
		$headers['From']    = $aktuellerKunde['email'];
		$headers['To']      = $firma->_getMail();
		$headers['Subject'] = 'Eine Bestellung wurde abgegeben.';
		$headers['Mime-Version'] = '1.0';
		$headers['Content-Type'] = 'text/plain; charset=utf-8';
		$headers['Content-Transfer-Encoding'] = 'quoted-printable';
		
		$body = 
		'Der Kunde '.$aktuellerKunde['vorname'].' '.$aktuellerKunde['nachname'].' hat etwas bestellt, und folgende Anmerkung gemacht:
		
		"'.$_REQUEST['anmerkung'].'"';
		
		$mail_object = Mail::factory('mail');
		
		if ($mail_object->send($recipients, $headers, $body))
		{
			$kundeupdate = new kunde($aktuellerKunde['id'], $aktuellerKunde['kundennummer'], $aktuellerKunde['firma'], $aktuellerKunde['vorname'], $aktuellerKunde['nachname'], $aktuellerKunde['strasse'], $aktuellerKunde['hausnummer'], $aktuellerKunde['plz'], $aktuellerKunde['stadt'], $aktuellerKunde['telefonnummer'], $aktuellerKunde['email'], $aktuellerKunde['passwort']);
			$db->_update($kundeupdate);	
		}
		
	}
}
?>