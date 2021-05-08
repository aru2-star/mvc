<?php
namespace Block\Admin\Customer\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template'); 	

class Form extends \Block\Core\Template
{
	
	protected $customers = null;
	protected $tableRow = null;
	function __construct() {
		parent::__construct();
		$this->setTemplate('./View/admin/customer/edit/tabs/form.php');
	}


	/*public function setCustomers($customers = null)
	{
		if ($customers) {
			$this->customers = $customers;
			return $this;
		}
		$customers = \Mage::getModel('Model\Customer');
		if ($id= $this->getRequest()->getGet('customerId')) {
			$customers = $customers->load($id);
			if (!$customers) {
				echo "No records found";
				$this->setTemplate('./View/admin/customer/grid.php');
				
			}
		}
		$this->customers = $customers;
		return $this;
	}

	public function getCustomers() {
		if (!$this->customers) {
			$this->setCustomers();
		}
		return $this->customers;
	}*/

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