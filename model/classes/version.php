<?php


class version 
{
	
	public function __construct()
	{
		
	}
	
	public function _getStatusMessage()
	{
		$registryInstance = registry::getInstance();
		$version = $registryInstance->_getVersionNumber();
		$client = new IXR_Client($registryInstance->_getXmlRpcString());
		if (!$client->query('fotoffice.checkforupdates', $version)) 
		{
			die('An error occurred - '.$client->getErrorCode().":".$client->getErrorMessage());
		}
		return $client->getResponse();
	}
}
?>