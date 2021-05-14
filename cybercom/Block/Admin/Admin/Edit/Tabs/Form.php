<?php
namespace Block\Admin\Admin\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');

class Form extends \Block\Core\Template
{	
	protected $tableRow = null;
	
	public function __construct() {
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