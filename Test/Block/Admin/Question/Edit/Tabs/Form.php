<?php  
namespace Block\Admin\Question\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');

class Form extends \Block\Core\Template
{
	
	protected $question = [];
	protected $tableRow = null;

	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('./View/admin/question/edit/tabs/form.php');
	}
	
	public function setTableRow(\Model\Question $tableRow)
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