<?php
require_once ('./view/showbehavior.php');


class neueoeffentlichegalerie_show_behavior implements showbehavior
{
	public function __construct()
	{

	}

	public function _show()
	{
		$db = new database();
		$registryInstance = registry::getInstance();
		$this->tpl = singletonTemplate::getInstance();
		$this->tpl->loadTemplatefile("neueoeffentlichegalerie.tpl");
		$this->tpl->touchBlock('NEUOEFFENTLICHEGALERIE');

		$form = new HTML_QuickForm('neueoeffentlichegalerieform', 'POST', 'neueoeffentlichegalerie.html');

		$galeriename = HTML_QuickForm::createElement('text', 'galeriename', 'Galeriename', array('class="form"', 'size="45"', 'maxlength="45"'));
		$submit = HTML_QuickForm::createElement('submit', 'submit', 'Galerie anlegen', 'class="form"');

		$form->addElement($galeriename);
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
										0,
										0);

			if($db->_insert($neueGalerie))
			{
				header("Location:index.php?controller=neueoeffentlichegalerie");
			}else{
				throw new Exception("Kann die Galerie nicht eintragen");
			}
		}

		$this->tpl->show();

	}
}
?>