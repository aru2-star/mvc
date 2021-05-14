<?php
namespace Model\Question;
\Mage::loadFileByClassName('Model\Core\Table');

class Choice extends \Model\Core\Table{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;
	protected $question = null;

	public function __construct() {
		$this->setTableName('question_choice');
		$this->setPrimaryKey('choiceId');
	}
	
	public function getStatusOptions() {
		return  [
			self::STATUS_ENABLED =>"Enable",
			self::STATUS_DISABLED =>"Disable"
		];
	}

	public function setQuestion($question)
	{
		$this->question = $question;
		return $this;question
	}

	public function getQuestion()
	{
		return $this->question;
	}

	public function getChoices()
	{
		if(!$this->getQuestion()->questionId){
			return null;
		}
		$query = "SELECT * FROM `question_choice` WHERE `questionId` = '{$this->getQuestion()->questionId}' ORDER BY `questionId` ASC";
		return $this->fetchAll($query);
	}
}
?>