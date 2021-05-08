<?php
namespace Block\Admin\ShippingMethod\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template'); 	

class Form extends \Block\Core\Template
{
	
	protected $tableRow = null;
	function __construct() {
		parent::__construct();
		$this->setTemplate('./View/admin/shippingmethod/edit/tabs/form.php');
	}

	public function setTableRow(\Model\ShippingMethod $tableRow)
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