<?php
namespace Block\Admin\Customer\CustomerGroup\Edit\Tabs; 
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template 
{
    protected $group = null;
    protected $tableRow = null;
    public function __construct()
    {
		parent::__construct();
		$this->setTemplate('./View/admin/customer/customergroup/edit/tabs/form.php');
    }

    /*public function setCustomerGroup($group = null)
	{
		if ($group) {
			$this->group = $group;
			return $this;
		}
		$group = \Mage::getModel('Model\Customer\CustomerGroup');
		if ($id= $this->getRequest()->getGet('groupId')) {
			$group = $group->load($id);
			if (!$group) {
				echo "No records found";
				$this->setTemplate('./View/admin/customer/customergroup/grid.php');
				
			}
		}
		$this->group = $group;
		return $this;
	}

	public function getCustomerGroups() {
		if (!$this->group) {
			$this->setCustomerGroup();
		}
		return $this->group;
	}*/

	public function setTableRow(\Model\Customer\CustomerGroup $tableRow)
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