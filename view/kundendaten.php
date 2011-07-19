<?php
require_once('./view/view.php');

class kundendaten_view extends view
{
	public function __construct()
	{
		self::$instance_view = $this;
		$this->show_behavior = new kundendaten_show_behavior();
		$this->protected = true;
	}

}
?>