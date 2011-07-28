<?php
require_once('./view/view.php');

/**
*
* @license LGPL http://www.gnu.org/licenses/lgpl-3.0.html
* @author <a href="mailto:c.wohlbrecht@photoffice.de">Chris Wohlbrecht</a>
*
*/

class default_view extends view
{
	public function __construct()
	{
		self::$instance_view = $this;
		$this->show_behavior = new photographerdefault_show_behavior();
		$this->protected = false;
	}
}
?>