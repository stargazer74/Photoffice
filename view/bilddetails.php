<?php
require_once('./view/view.php');

class bilddetails_view extends view
{
	public function __construct()
	{
		self::$instance_view = $this;
		$this->show_behavior = new bilddetails_show_behavior();
		$this->protected = true;
	}

}
?>