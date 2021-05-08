<?php
namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template'); 	

class Form extends \Block\Core\Template
{
	protected $tableRow = null;
	public function __construct() {
		parent::__construct();
		$this->setTemplate('./View/admin/product/edit/tabs/form.php');
	}
	
	public function setTableRow(\Model\Product $tableRow)
    	{
		$this->tableRow = $tableRow;
		return $this;
   	}
	
    	public function getTableRow()
    	{
		return $this->tableRow;
    	}
}
