<?php

namespace Block\Admin\ConfigurationGroup\Edit\Tabs;

class Form extends \Block\Core\Template
{
	protected $tableRow = null;
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('./View/admin/configuration_group/edit/tabs/form.php');
	}

	public function setTableRow(\Model\ConfigurationGroup $tableRow)
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