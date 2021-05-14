<?php
namespace Block\Admin\Customer\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template'); 	

class Form extends \Block\Core\Template
{
	protected $tableRow = null;

	public function __construct() {
		parent::__construct();
		$this->setTemplate('./View/admin/customer/edit/tabs/form.php');
	}

	public function setTableRow(\Model\Customer $tableRow)
	{
		$this->tableRow = $tableRow;
		return $this;
	}
	public function getTableRow()
	{
		return $this->tableRow;
	}

	public function getCustomerGroup()
	{
		$query = "SELECT `groupId`,`name` FROM `customer_group`";
		$groupsOption = $this->getTableRow()->getAdapter()->fetchPairs($query);
		return $groupsOption;
	}
}
?>