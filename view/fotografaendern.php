<?php
require_once('./view/view.php');

class fotografaendern_view extends view
{
	public function __construct()
	{
		self::$instance_view = $this;
		$this->show_behavior = new fotografaendern_show_behavior();
		$this->protected = true;
	}

}
?>