<?php

class singletonTemplate
{
	static private $instance = NULL;
	
	private function __construct()
	{
		
	}
	private function __clone()
	{
		
	}
	
	public static function getInstance()
	{
		if(self::$instance === NULL)
		{
			self::$instance = new HTML_Template_ITX("./view/templates");
		}//end if
		return self::$instance;
	}
}

?>