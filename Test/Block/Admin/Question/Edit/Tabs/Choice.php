<?php
namespace Block\Admin\Question\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');

class Choice extends \Block\Core\Template
{
	protected $choices = [];
	protected $question = null;
	protected $tableRow = null;	

	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('./View/admin/question/edit/tabs/choice.php');
	}

	public function setChoices($choices = null)
	{
		if (!$choices) {
			$choices = \Mage::getModel('Model\Question\Choice');
			$choices = $choices->fetchAll();
		}
		$this->choices = $choices;
		return $this;
	}

	public function getChoices()
	{
		if (!$this->choices) {
			$this->setChoices();
		}
		return $this->choices;
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