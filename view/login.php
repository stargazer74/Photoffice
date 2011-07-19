<?php
require_once('./view/view.php');

class login_view extends view
{
	public function __construct()
	{
		self::$instance_view = $this;
		$this->show_behavior = new login_show_behavior();
		$this->protected = false;
	}

}
?>