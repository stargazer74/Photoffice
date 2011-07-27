<?php

/**
*
* @license LGPL http://www.gnu.org/licenses/lgpl-3.0.html
* @author <a href="mailto:c.wohlbrecht@photoffice.de">Chris Wohlbrecht</a>
*
*/

class customer_role extends roles
{
	public function __construct()
	{
		$this->role = "customer";
	}
}
?>