<?php  
namespace Block\Admin\Brand\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template
{
	
	protected $brand = [];
	protected $tableRow = null;
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('./View/admin/brand/edit/tabs/form.php');
	}
	
	public function setTableRow(\Model\Brand $tableRow)
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