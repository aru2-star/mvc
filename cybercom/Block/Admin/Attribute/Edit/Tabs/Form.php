<?php  
namespace Block\Admin\Attribute\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');
class Form extends \Block\Core\Template
{
	
	protected $attribute = [];
	protected $tableRow = null;
	function __construct()
	{
		parent::__construct();
		$this->setTemplate('./View/admin/attribute/edit/tabs/form.php');
	}
	
	public function setTableRow(\Model\Attribute $tableRow)
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