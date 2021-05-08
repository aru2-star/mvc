<?php

namespace Block\Admin\Attribute\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');

class Option extends \Block\Core\Template
{
	protected $options = [];
	protected $attribute = null;
	protected $tableRow = null;	
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('./View/admin/attribute/edit/tabs/option.php');
	}

	public function setOptions($options = null)
	{
		if (!$options) {
			$options = \Mage::getModel('Model\Attribute\Option');
			$options = $options->fetchAll();
		}
		$this->options = $options;
		return $this;
	}

	public function getOptions()
	{
		if (!$this->options) {
			$this->setOptions();
		}
		return $this->options;
	}

	public function setTableRow(\Model\Attribute $tableRow)
	{
		$this->tableRow = $tableRow;
		return $this;
	}
	public function getTableRow()
	{
		return $this->tableRow;
	}
	
}


?>