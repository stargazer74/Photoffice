<?php
require_once('./view/view.php');

class bestellungslisteinhalt_view extends view
{
	public function __construct()
	{
		self::$instance_view = $this;
		$this->show_behavior = new bestellungslisteinhalt_show_behavior();
		$this->protected = true;
	}

}
?>