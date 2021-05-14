<?php
namespace Block\Admin\Customer\CustomerGroup\Edit\Tabs; 
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template 
{
    protected $tableRow = null;
    public function __construct()
    {
		parent::__construct();
		$this->setTemplate('./View/admin/customer/customergroup/edit/tabs/form.php');
    }

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