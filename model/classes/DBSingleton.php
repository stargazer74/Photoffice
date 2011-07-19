<?php
class DBSINGLETON
{
	private static $uniqueDBInstance = NULL;
	private static $user;
	private static $pass;
	private static $host;
	private static $db_name;
	private static $dsn;
	
	protected function __construct()
	{
		
	}
	
	private final function __clone()
	{
		
	}
	
	public static function _getDBInstance()
	{
		$registry 		= registry::getInstance();
		self::$user 	= $registry->_getDatabaseUser();
		self::$pass 	= $registry->_getDatabasePassphrase();
		self::$host 	= $registry->_getDatabaseServer();
		self::$db_name	= $registry->_getDatabaseName();
		if(self::$uniqueDBInstance === NULL)
		{
			self::$dsn = "mysqli://" . self::$user . ":" . self::$pass . "@" . self::$host . "/" . self::$db_name;
			
			self::$uniqueDBInstance = DB::connect(self::$dsn);
			if(DB::isError(self::$uniqueDBInstance))
			{
				echo 'Standard Message: ' . self::$uniqueDBInstance->getMessage() . "\n";
    			echo 'Standard Code: ' . self::$uniqueDBInstance->getCode() . "\n";
    			echo 'DBMS/User Message: ' . self::$uniqueDBInstance->getUserInfo() . "\n";
    			echo 'DBMS/Debug Message: ' . self::$uniqueDBInstance->getDebugInfo() . "\n";

				die(self::$uniqueDBInstance->getMessage());				
			}//end if
		}
		return self::$uniqueDBInstance;
	}
}
?>