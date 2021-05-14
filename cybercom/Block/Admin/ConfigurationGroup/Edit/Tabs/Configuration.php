<?php

namespace Block\Admin\ConfigurationGroup\Edit\Tabs;

class Configuration extends \Block\Core\Template
{
	protected $tableRow = null;
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('./View/admin/configuration_group/edit/tabs/configuration.php');
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