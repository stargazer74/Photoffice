<?php


class breadcrumb
{
	private $aktuellerNavipunkt;
	private $navigationFromDatabase;
	
	public function __construct($aktuellerNavipunkt = NULL)
	{
		$this->aktuellerNavipunkt = $aktuellerNavipunkt;
		$this->navigationFromDatabase = $this->_getNavigationFromDatabase();
	}
	
	private function _getNavigationFromDatabase()
	{
		$db = new database();
		$resultarray = $db->_getNavigation();
		$breadcrumb = array();
		foreach($resultarray as $data)
		{
			$breadcrumb[$data['name']] = $data;
		}
		//print_r($breadcrumb);
		return $breadcrumb;
	}
	
	private function _checkIfNavigationPointExists()
	{
		//print_r($this->navigationFromDatabase);
		$i = FALSE;
		foreach($this->navigationFromDatabase as $data)
		{
			if(strtolower($data[name]) == strtolower($this->aktuellerNavipunkt))
			{
				$i = TRUE;
			}			
		}
		return $i;
	}
	
	public function _getBreadcrumbArray()
	{
		$breadcrumb = array();
		$breadcrumb = array('Home' => 'index.html');		
		if($this->_checkIfNavigationPointExists())
		{
			//aktuelle ParentID rausfinden
			$aktuelleParentId = $this->navigationFromDatabase[$this->aktuellerNavipunkt]['idparent'];
			$aktuellerName = $this->navigationFromDatabase[$this->aktuellerNavipunkt]['name'];
			$aktuellerLink = strtolower($this->navigationFromDatabase[$this->aktuellerNavipunkt]['link']);
			$temparray = array();
			//Navigation so lange duchlaufen, bis die ParentId Null ist.
			//Dabei das temporäre Array auffüllen.
			do
			{
				foreach($this->navigationFromDatabase as $key => $value)
				{
					if($aktuelleParentId == $value['idnavigation'])
					{
						$temparray[$value['name']] = $value['linkname'];
						$aktuelleParentId = $value['idparent'];
					}
				}
			}while($aktuelleParentId != 0);
			//array in die richtige Reihenfolge bringen
			
			$temparray = array_reverse($temparray);
			//print_r($temparray);
			foreach($temparray as $key => $data)
			{
				$breadcrumb[$key] = $data;
			}
			//Den letzten Navigationspunkt anhängen.
			$breadcrumb[$aktuellerName] = $aktuellerLink;
			return $breadcrumb;
		}
		return FALSE;
	}
	
}
?>