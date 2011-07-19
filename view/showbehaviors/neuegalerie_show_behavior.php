<?php

require_once ('./view/showbehavior.php');


class neuegalerie_show_behavior implements showbehavior
{
	public function __construct()
	{
		
	}

	public function _show()
	{
		$db = new database();
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();	
		$this->tpl->loadTemplatefile("neuegalerie.tpl");
		$this->tpl->touchBlock('NEUGALERIE');
		
		$form = new HTML_QuickForm('neuegalerieform', 'POST', 'neuegalerie.html');
		
		$galeriename = HTML_QuickForm::createElement('text', 'galeriename', 'Galeriename', array('class="form"', 'size="45"', 'maxlength="45"'));
		$kundenid = HTML_QuickForm::createElement('hidden', 'kundenid', $_REQUEST['kundenid']);
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Galerie anlegen', 'class="form"');
		
		$form->addElement($galeriename);
		$form->addElement($kundenid);
		$form->addElement($submit);
		
		$form->addRule('galeriename', 'Sie müssen einen Namen für die neue Galerie vergeben!', 'required');

		
		if(false == $form->validate())
		{
			$renderer = new HTML_QuickForm_Renderer_ITStatic($this->tpl);
			$renderer->setErrorTemplate('');
			$form->accept($renderer);
		}else{		
			/// @todo Datumsrechner einbauen	
			$heute = getdate();
			if($heute['mon'] < 12)
			{
				$heute['mon']++;
			}else{
				$heute['mon'] = 1;				
				$heute['year']++;
			}
		
			$verfallsdatum = $heute['year'].'-'.$heute['mon'].'-'.$heute['mday'];	
			
			$neueGalerie = new galerie(	null,
										$galeriename->getValue(),
										0,
										$verfallsdatum,
										0,
										$kundenid->getValue(),
										0);
									
			if($db->_insert($neueGalerie))
			{
				header("Location:index.php?controller=neuegalerie&kundenid=".$kundenid->getValue());
			}else{
				throw new Exception("Kann die Galerie nicht eintragen");
			}	
			
		}
		
		$alleGalerienInstance = $db->_getGalerien();
		$alleGalerienArray = $alleGalerienInstance->_ausgeben();
		
		//print_r($alleGalerienArray);
		$kundengalerien = array();
		foreach ($alleGalerienArray as $data)
		{
			if ($data['idkunde'] == $_REQUEST['kundenid'])
			{
				array_push($kundengalerien, $data);
			}
		}
		
		if ($kundengalerien == null)
		{
			$this->tpl->touchBlock('KEININHALT');
		}else{
			foreach ($kundengalerien as $data)
			{
				$this->tpl->setCurrentBlock('GALERIELISTE');
				$this->tpl->setVariable('GALERIENAME', $data['galeriename']);
				$this->tpl->parseCurrentBlock('GALERIELISTE');
			}
		}
		
		$this->tpl->show();

	}
}
?>