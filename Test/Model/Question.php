<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

class Question extends \Model\Core\Table{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;
	
	public function __construct() {
		$this->setTableName('question');
		$this->setPrimaryKey('questionId');
	}
	
	public function getStatusOptions() {
		return  [
			self::STATUS_ENABLED =>"Enable",
			self::STATUS_DISABLED =>"Disable"
		];
	}

	public function getChoices()
	{
		if(!$this->questionId)
		{
			return false;
		}
		$query="SELECT * FROM `question_choice`
		WHERE `questionId`='{$this->questionId}'
		ORDER BY `questionId` ASC";
		$choices=\Mage::getModel('Model\Question\Choice')->fetchAll($query);
		if(!$choices){
			return false;
		}
		return $choices;
	
	}

	

}

?>