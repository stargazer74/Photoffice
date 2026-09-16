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
		if (is_array($resultarray))
		{
			foreach($resultarray as $data)
			{
				$breadcrumb[$data['name']] = $data;
			}
		}
		//print_r($breadcrumb);
		return $breadcrumb;
	}
	
	private function _checkIfNavigationPointExists()
	{
		//print_r($this->navigationFromDatabase);
		$i = FALSE;
		if (is_array($this->navigationFromDatabase))
		{
			foreach($this->navigationFromDatabase as $data)
			{
				if(isset($data['name']) && strtolower($data['name']) == strtolower($this->aktuellerNavipunkt))
				{
					$i = TRUE;
				}			
			}
		}
		return $i;
	}

	private function _getMatchedNaviEntry()
	{
		if (is_array($this->navigationFromDatabase))
		{
			foreach($this->navigationFromDatabase as $data)
			{
				if(isset($data['name']) && strtolower($data['name']) == strtolower($this->aktuellerNavipunkt))
				{
					return $data;
				}
			}
		}
		return null;
	}
	
	public function _getBreadcrumbArray()
	{
		$breadcrumb = array();
		$breadcrumb = array('Home' => 'fotografstart.html');
		if($this->_checkIfNavigationPointExists())
		{
			$matchedEntry = $this->_getMatchedNaviEntry();
			//aktuelle ParentID rausfinden
			$aktuelleParentId = isset($matchedEntry['idparent']) ? $matchedEntry['idparent'] : 0;
			$aktuellerName = isset($matchedEntry['name']) ? $matchedEntry['name'] : $this->aktuellerNavipunkt;
			$aktuellerLink = isset($matchedEntry['link']) ? strtolower($matchedEntry['link']) : strtolower($this->aktuellerNavipunkt).'.html';
			$temparray = array();
			//Navigation so lange duchlaufen, bis die ParentId Null ist.
			//Dabei das temporäre Array auffüllen.
			$visitedIds = array();
			while($aktuelleParentId != 0 && !in_array($aktuelleParentId, $visitedIds))
			{
				$visitedIds[] = $aktuelleParentId;
				$foundParent = false;
				foreach($this->navigationFromDatabase as $key => $value)
				{
					if(isset($value['idnavigation']) && $aktuelleParentId == $value['idnavigation'])
					{
						$link = isset($value['link']) ? $value['link'] : (isset($value['linkname']) ? $value['linkname'] : '');
						$temparray[$value['name']] = $link;
						$aktuelleParentId = isset($value['idparent']) ? $value['idparent'] : 0;
						$foundParent = true;
						break;
					}
				}
				if (!$foundParent)
				{
					break;
				}
			}
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
		else if(!empty($this->aktuellerNavipunkt))
		{
			$breadcrumb[$this->aktuellerNavipunkt] = strtolower($this->aktuellerNavipunkt).'.html';
			return $breadcrumb;
		}
		return $breadcrumb;
	}
	
}
?>