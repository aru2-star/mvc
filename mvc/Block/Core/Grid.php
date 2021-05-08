<?php
namespace Block\Core;
\Mage::loadFileByClassName('Block\Core\Template'); 	

class Grid extends \Block\Core\Template
{
	protected $columns = [];
	protected $collection = [];
	protected $actions = [];
	protected $button = [];
	function __construct() {
		parent::__construct();
		$this->setTemplate('./View/core/grid.php');
		$this->prepareColumns();
		$this->prepareActions();
		$this->prepareCollection();
		$this->prepareButtons();
	}


	public function prepareCollection()
	{
		return $this;
	}

	public function prepareActions()
	{
		return $this;
	}

	public function prepareButtons()
	{
		return $this;
	}

	public function addButton($key,$value)
	{
		$this->button[$key] = $value;
		return $this;
	}

	public function getButton()
	{
		if(!$this->button)
		{
			$this->prepareButtons();
		}
		return $this->button;
	}

	public function getButtonUrl($methodName)
	{
		return $this->$methodName();	
	}
	public function getMethodUrl($row,$methodName)
	{
		return $this->$methodName($row);
	}

	public function addActions($key,$value)
	{
		$this->actions[$key] = $value;
		return $this;
	}

	public function getTitle()
	{
		return 'Set Your Title';
	}
	public function getActions()
	{
		if(!$this->actions)
		{
			$this->prepareActions();
		}
		return $this->actions;
	}
	
	public function setCollection($collection)
	{
		$this->collection = $collection;
		return $this;
	}

	public function getCollection() 
	{
		if(!$this->collection){
			$this->prepareCollection();
		}
		return $this->collection;
	}

	public function prepareColumns()
	{
		return $this;
	}

	public function getFieldValue($row,$fieldName)
	{
		return $row->$fieldName;
	}
	
	public function addColumn($key,$value)
	{
		$this->columns[$key] = $value;
	}

	public function getColumns()
	{
		return $this->columns;		
	}
}

?>