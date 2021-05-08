<?php

namespace Block\Admin\Admin\Edit\Tabs;

class Form extends \Block\Core\Template
{
	
	protected $admin = null;
	protected $tableRow = null;
	
	function __construct() {
		parent::__construct();
		$this->setTemplate('./View/admin/admin/edit/tabs/form.php');
	}

	public function setTableRow(\Model\Admin $tableRow)
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