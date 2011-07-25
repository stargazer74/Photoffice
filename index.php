<?php
/**
 * 
 * @license LGPL
 * @author Chris Wohlbrecht
 * 
 */

$my_pear_path = $_SERVER['DOCUMENT_ROOT']."/PEAR";
ini_set("include_path", $my_pear_path . PATH_SEPARATOR . ini_get("include_path"));
/***********************************************************************************
 * Requirements
 ***********************************************************************************/
////////////////////////////////////////////////////////////////////////////////////
//
// PEAR Includes
//
////////////////////////////////////////////////////////////////////////////////////
require_once("HTML/Template/ITX.php");
require_once("Event/Dispatcher.php");
require_once("DB.php");
require_once("HTML/QuickForm.php");
require_once("HTML/QuickForm/Renderer/ITStatic.php");
require_once('Pager.php');
require_once('Mail.php');
////////////////////////////////////////////////////////////////////////////////////
//
// controller Includes
//
////////////////////////////////////////////////////////////////////////////////////
require_once('./controller/actionbehaviors/standard_action_behavior.php');
require_once('./controller/actionbehaviors/onlineshopstandard_action_behavior.php');
require_once('./controller/actionbehaviors/ajaxdelete_action_behavior.php');
require_once('./controller/actionbehaviors/kundedelete_action_behavior.php');
require_once('./controller/actionbehaviors/applicationstate_action_behavior.php');
require_once('./controller/actionbehaviors/sessionstate_action_behavior.php');
require_once('./controller/actionbehaviors/dateiupload_action_behavior.php');
require_once('./controller/actionbehaviors/kundestandard_action_behavior.php');
require_once('./controller/actionbehaviors/getpapierformat_action_behavior.php');
require_once('./controller/actionbehaviors/getbildanzahlen_action_behavior.php');
require_once('./controller/actionbehaviors/bestellungeintragen_action_behavior.php');
require_once('./controller/actionbehaviors/warenkorbeintragen_action_behavior.php');
require_once('./controller/actionbehaviors/ajaxupdate_action_behavior.php');
require_once('./controller/kundendefaultcontroller.php');
require_once('./controller/generierebestellungspdf.php');
require_once('./controller/bestellungeintragen.php');
require_once('./controller/controller.php');
require_once('./controller/defaultcontroller.php');
require_once('./controller/getpapierformat.php');
require_once('./controller/logout.php');
require_once('./controller/firmendaten.php');
require_once('./controller/kunden.php');
require_once('./controller/stammdaten.php');
require_once('./controller/fotodaten.php');
require_once('./controller/agb.php');
require_once('./controller/ajaxdelete.php');
require_once('./controller/kundedelete.php');
require_once('./controller/kundenliste.php');
require_once('./controller/neukunde.php');
require_once('./controller/kundendaten.php');
require_once('./controller/kundeaendern.php');
require_once('./controller/applicationstate.php');
require_once('./controller/sessionstate.php');
require_once('./controller/bilder.php');
require_once('./controller/allegalerien.php');
require_once('./controller/neuegalerie.php');
require_once('./controller/einzelgalerie.php');
require_once('./controller/kundeeinzelgalerie.php');
require_once('./controller/galerieaendern.php');
require_once('./controller/dateiupload.php');
require_once('./controller/bilduebersicht.php');
require_once('./controller/bilddetails.php');
require_once('./controller/fotografenliste.php');
require_once('./controller/fotografaendern.php');
require_once('./controller/neufotograf.php');
require_once('./controller/kundenlogin.php');
require_once('./controller/kundenindex.php');
require_once('./controller/kundenlogout.php');
require_once('./controller/allekundengalerien.php');
require_once('./controller/kundeagb.php');
require_once('./controller/preisliste.php');
require_once('./controller/warenkorb.php');
require_once('./controller/warenkorbeintragen.php');
require_once('./controller/bestellungsliste.php');
require_once('./controller/bestellungslisteinhalt.php');
require_once('./controller/bestellungsdaten.php');
require_once('./controller/bestellungabschliessen.php');
require_once('./controller/oeffentlichegalerien.php');
require_once('./controller/neueoeffentlichegalerie.php');
require_once('./controller/ajaxupdate.php');

////////////////////////////////////////////////////////////////////////////////////
//
// model Includes
//
////////////////////////////////////////////////////////////////////////////////////
require_once('./model/classes/IXR_Library.php');
require_once("./model/fpdf/fpdf.php");
require_once('./model/main.php');
require_once('./model/classes/database.php');
require_once('./model/classes/registry.php');
require_once("./model/classes/singletonTemplate.php");
require_once("./model/classes/DBSingleton.php");
require_once("./model/classes/bilderInterface.php");
require_once("./model/classes/logincheck.php");
require_once("./model/classes/kundenlogincheck.php");
require_once("./model/classes/abstractfotografen.php");
require_once("./model/classes/fotograf.php");
require_once("./model/classes/fotografen.php");
require_once("./model/classes/fotografenInterface.php");
require_once("./model/classes/abstractpreise.php");
require_once("./model/classes/preis.php");
require_once("./model/classes/preise.php");
require_once("./model/classes/preiseInterface.php");
require_once("./model/classes/abstractbestellungen.php");
require_once("./model/classes/bestellung.php");
require_once("./model/classes/bestellungen.php");
require_once("./model/classes/bestellungenInterface.php");
require_once("./model/classes/abstractpapierformate.php");
require_once("./model/classes/papierformate.php");
require_once("./model/classes/papierformat.php");
require_once("./model/classes/papierformateInterface.php");
require_once("./model/classes/abstractbildformate.php");
require_once("./model/classes/bildformat.php");
require_once("./model/classes/bildformate.php");
require_once("./model/classes/bildformateInterface.php");
require_once("./model/classes/abstractgalerien.php");
require_once("./model/classes/galerie.php");
require_once("./model/classes/galerien.php");
require_once("./model/classes/galerienInterface.php");
require_once("./model/classes/version.php");
require_once("./model/classes/firma.php");
require_once("./model/classes/breadcrumb.php");
require_once("./model/classes/chkfunctions.php");
require_once("./model/classes/insertInterface.php");
require_once("./model/classes/updateInterface.php");
require_once("./model/classes/deleteInterface.php");
require_once("./model/classes/abstractkunden.php");
require_once("./model/classes/kundenInterface.php");
require_once("./model/classes/kunde.php");
require_once("./model/classes/kunden.php");
require_once("./model/classes/applicationstate.php");
require_once("./model/classes/abstractbilder.php");
require_once("./model/classes/bild.php");
require_once("./model/classes/bilder.php");
require_once("./model/classes/bilderInterface.php");
require_once("./model/classes/images.php");
require_once("./model/classes/string.php");
require_once("./model/classes/datum.php");
require_once("./model/classes/pdf_bestellung.php");
require_once("./model/classes/abstractporto.php");
require_once("./model/classes/portosInterface.php");
require_once("./model/classes/portos.php");
require_once("./model/classes/porto.php");
require_once("./model/classes/abstractzahlungsarten.php");
require_once("./model/classes/zahlungsartenInterface.php");
require_once("./model/classes/zahlungsarten.php");
require_once("./model/classes/zahlungsart.php");

////////////////////////////////////////////////////////////////////////////////////
//
// view Includes
//
////////////////////////////////////////////////////////////////////////////////////
require_once('./view/default.php');
require_once('./view/kundendefault.php');
require_once('./view/view.php');
require_once ('./view/showbehavior.php');
require_once ('./view/showbehaviors/default_show_behavior.php');
require_once ('./view/showbehaviors/mainnavigation_show_behavior.php');
require_once ('./view/showbehaviors/login_show_behavior.php');
require_once ('./view/showbehaviors/statusbox_show_behavior.php');
require_once ('./view/showbehaviors/kundenstatusbox_show_behavior.php');
require_once ('./view/showbehaviors/informationbox_show_behavior.php');
require_once ('./view/showbehaviors/kundeinformationbox_show_behavior.php');
require_once ('./view/showbehaviors/firmendaten_show_behavior.php');
require_once ('./view/showbehaviors/kunden_show_behavior.php');
require_once ('./view/showbehaviors/bilduploadbox_show_behavior.php');
require_once ('./view/showbehaviors/exifdatenbox_show_behavior.php');
require_once ('./view/showbehaviors/bestellungbox_show_behavior.php');
require_once ('./view/showbehaviors/warenkorbbox_show_behavior.php');
require_once ('./view/showbehaviors/stammdaten_show_behavior.php');
require_once ('./view/showbehaviors/fotodaten_show_behavior.php');
require_once ('./view/showbehaviors/agb_show_behavior.php');
require_once ('./view/showbehaviors/kundenliste_show_behavior.php');
require_once ('./view/showbehaviors/neukunde_show_behavior.php');
require_once ('./view/showbehaviors/kundensuchebox_show_behavior.php');
require_once ('./view/showbehaviors/kundendatenbox_show_behavior.php');
require_once ('./view/showbehaviors/kundendaten_show_behavior.php');
require_once ('./view/showbehaviors/kundeaendern_show_behavior.php');
require_once ('./view/showbehaviors/kundengalerienbox_show_behavior.php');
require_once ('./view/showbehaviors/bilder_show_behavior.php');
require_once ('./view/showbehaviors/allegalerien_show_behavior.php');
require_once ('./view/showbehaviors/galerieeinstellbox_show_behavior.php');
require_once ('./view/showbehaviors/neuegalerie_show_behavior.php');
require_once ('./view/showbehaviors/einzelgalerie_show_behavior.php');
require_once ('./view/showbehaviors/kundeeinzelgalerie_show_behavior.php');
require_once ('./view/showbehaviors/galerieaendern_show_behavior.php');
require_once ('./view/showbehaviors/bilduebersicht_show_behavior.php');
require_once ('./view/showbehaviors/bilddetails_show_behavior.php');
require_once ('./view/showbehaviors/fotografenliste_show_behavior.php');
require_once ('./view/showbehaviors/fotografaendern_show_behavior.php');
require_once ('./view/showbehaviors/neufotograf_show_behavior.php');
require_once ('./view/showbehaviors/kundenlogin_show_behavior.php');
require_once ('./view/showbehaviors/kundendefault_show_behavior.php');
require_once ('./view/showbehaviors/kundemainnavigation_show_behavior.php');
require_once ('./view/showbehaviors/allekundengalerien_show_behavior.php');
require_once ('./view/showbehaviors/kundeagb_show_behavior.php');
require_once ('./view/showbehaviors/preisliste_show_behavior.php');
require_once ('./view/showbehaviors/warenkorb_show_behavior.php');
require_once ('./view/showbehaviors/bestellungsliste_show_behavior.php');
require_once ('./view/showbehaviors/bestellungslisteinhalt_show_behavior.php');
require_once ('./view/showbehaviors/bestellungsdaten_show_behavior.php');
require_once ('./view/showbehaviors/bestellungabschliessen_show_behavior.php');
require_once ('./view/showbehaviors/generierebestellungspdf_show_behavior.php');
require_once ('./view/showbehaviors/oeffentlichegalerien_show_behavior.php');
require_once ('./view/showbehaviors/neueoeffentlichegalerie_show_behavior.php');
require_once ('./view/showbehaviors/oeffentlichegalerienbox_show_behavior.php');
require_once ('./view/showbehaviors/onlineshop_show_behavior.php');
require_once('./view/login.php');
require_once('./view/logout.php');
require_once('./view/firmendaten.php');
require_once('./view/kunden.php');
require_once('./view/stammdaten.php');
require_once('./view/fotodaten.php');
require_once('./view/agb.php');
require_once('./view/kundenliste.php');
require_once('./view/neukunde.php');
require_once('./view/kundendaten.php');
require_once('./view/kundeaendern.php');
require_once('./view/bilder.php');
require_once('./view/allegalerien.php');
require_once('./view/neuegalerie.php');
require_once('./view/einzelgalerie.php');
require_once('./view/kundeeinzelgalerie.php');
require_once('./view/galerieaendern.php');
require_once('./view/bilduebersicht.php');
require_once('./view/bilddetails.php');
require_once('./view/fotografenliste.php');
require_once('./view/fotografaendern.php');
require_once('./view/neufotograf.php');
require_once('./view/kundenlogin.php');
require_once('./view/kundenlogout.php');
require_once('./view/allekundengalerien.php');
require_once('./view/kundeagb.php');
require_once('./view/preisliste.php');
require_once('./view/warenkorb.php');
require_once('./view/bestellungsliste.php');
require_once('./view/bestellungslisteinhalt.php');
require_once('./view/bestellungsdaten.php');
require_once('./view/bestellungabschliessen.php');
require_once('./view/generierebestellungspdf.php');
require_once('./view/oeffentlichegalerien.php');
require_once('./view/neueoeffentlichegalerie.php');
require_once('./view/onlineshop.php');

session_start();

$main = new main();
$main->runApplication();
?>