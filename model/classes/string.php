<?php
class string
{
	public static function genRandomString($length) 
	{
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $string = '';    
	
	    for ($p = 0; $p < $length; $p++) {
	        $string .= $characters[mt_rand(0, strlen($characters))];
	    }
	
	    return $string;
	}
	
	public static function genPreisString($preis)
	{
		$preis_tmp = explode('.', $preis);
		if (strlen($preis_tmp[1]) == 1)
		{
			$preis = $preis.'0';
		}
		return $preis;
	}
}
?>