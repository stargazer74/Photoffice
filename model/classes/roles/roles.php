<?php

/**
* 
* It's the abstract role class.
*
* @license LGPL http://www.gnu.org/licenses/lgpl-3.0.html
* @author <a href="mailto:c.wohlbrecht@photoffice.de">Chris Wohlbrecht</a>
*
*/

abstract class roles
{
	protected $role;
	
	public function GetRole()
	{
		return $this->role;
	}
}
?>