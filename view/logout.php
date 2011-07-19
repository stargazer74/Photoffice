<?php
require_once('./view/view.php');

class logout_view extends view
{
	public function __construct()
	{
		self::$instance_view = $this;
		session_destroy();
		$this->show_behavior = new login_show_behavior();
		$this->protected = false;
	}

}
?>