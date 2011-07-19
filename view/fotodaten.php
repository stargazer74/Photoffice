<?php
require_once('./view/view.php');

class fotodaten_view extends view
{
	public function __construct()
	{
		self::$instance_view = $this;
		$this->show_behavior = new fotodaten_show_behavior();
		$this->protected = true;
	}

}
?>