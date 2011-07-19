<?php
class datum
{
	public function __construct()
	{
		
	}
	
	public static function _checkIfDateIsEqualOrSmaller($date)
	{
		$aktuellesDatum = getdate();
		$date = explode('-', $date);
		if ($aktuellesDatum['year'] > $date[0])
		{
			return true;
		}elseif ($aktuellesDatum['year'] == $date[0])
		{
			if ($aktuellesDatum['mon'] > $date[1])
			{
				return true;
			}elseif ($aktuellesDatum['mon'] == $date[1])
			{					
				if ($aktuellesDatum['mday'] > $date[2])
				{
					return true;
				}
			}
		}
		
		return false;
	}
	
	public static function _changeDateFormat($changeto, $date)
	{
		$datum = null;
		switch ($changeto)
		{
			case de:
				$datumarray = explode('-', $date);
				$datum = $datumarray[2] . '.' . $datumarray[1] . '.' . $datumarray[0];
				break;
				
			default:
				break;
		}
		return $datum;
	}
}
?>