<?php
namespace Block\Admin\PaymentMethod\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template'); 	

class Form extends \Block\Core\Template
{
	protected $tableRow = null;
	public function __construct() {
		parent::__construct();
		$this->setTemplate('./View/admin/paymentmethod/edit/tabs/form.php');
	}
	
	public function setTableRow(\Model\PaymentMethod $tableRow)
	{
		$this->tableRow = $tableRow;
		return $this;
	}
	
	public function getTableRow()
	{
		return $this->tableRow;
	}
}
