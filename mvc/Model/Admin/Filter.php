<?php 

namespace Model\Admin;
\Mage::loadFileByClassName('Model\Admin\Session');
class Filter extends \Model\Admin\Session
{
	const FILTER_TYPE_TEXT = 'text';
	const FILTER_TYPE_NUMBER = 'number';

	public function setFilter($filters)
	{
		if(!$filters){
			return false;	
		}
		
		$filters = 	array_filter(array_map(function($value){
			
			$value = array_filter($value);
			return $value;
		},$filters));
		
		$this->filters = $filters;
	}	
	

	public function getFilters()
	{
		return $this->filters;
	}

	public function getFilterType()
	{
		return [

			self::FILTER_TYPE_TEXT => 'text',
			self::FILTER_TYPE_NUMBER => 'number'
		];
	}
	public function hasFilters()
	{
		if(!$this->filters){
			return false;
		}
		return true;
	}


	public function getFilterValue($controller,$type,$key)
	{
		if(!$this->filters){
			return null;
		}
		if(!array_key_exists($controller, $this->filters)){
			return null;
		}
		if(!array_key_exists($type, $this->filters[$controller])){
			return null;
		}
		if (!array_key_exists($key, $this->filters[$controller][$type])) {
			return null;
		}
		return $this->filters[$controller][$type][$key];
	}

	
}
?>