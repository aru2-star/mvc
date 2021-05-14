<?php
namespace Block\Admin\Question;
\Mage::loadFileByClassName('Block\Core\Grid');

class Grid extends \Block\Core\Grid
{
	protected $question = null;
	protected $filter = null;
	protected $pages = null;
	
	public function prepareCollection()
	{
			
		$question = \Mage::getModel('Model\Question');
		$offset = ($this->getPages()->getCurrentPage() - 1) * $this->getPages()->getRecordsPerPage();
			
		
		$query = "SELECT * FROM {$question->getTableName()}";
		if($this->getFilter()->hasFilters()){
			foreach ($this->getFilter()->getFilters() as $controller => $filters) {
					if($controller == 'question'){
						$query.= " WHERE 1 = 1";
						foreach ($filters as $type => $filter) {
							if ($type == 'text') {
								foreach ($filter as $key => $value) {
									$query.= " AND (`{$key}` LIKE '%{$value}%')";		
								}
							}
						}
					}
				}
			}
		
		$query.= " LIMIT {$offset},{$this->getPages()->getRecordsPerPage()}";
		//echo $query;
		$question = $question->fetchAll($query);
		$this->setCollection($question);
		return $this;
			
		
	}

	public function getFilter()
	{
		if(!$this->filter){
			$this->filter = \Mage::getModel('Model\Admin\Filter');
		}
		return $this->filter;
	}

	public function prepareActions()
	{
		$this->addActions('edit',[
			'label' => 'Edit',
			'method' =>'getEditUrl',
			'ajax' => true
		]);
		$this->addActions('delete',[
			'label' => 'Delete',
			'method' =>'getDeleteUrl',
			'ajax' => true
		]);
		return $this;
	}

	public function prepareButtons()
	{
		$this->addButton('addNew',[
			'label' => 'Add Question',
			'method' => 'getaddNewUrl',
			'ajax' => true
		]);
		$this->addButton('addfilter',[
			'label' => 'Apply filter',
			'method' => 'getaddFilterUrl',
			'ajax' => true
		]);
		return $this;
	}

	public function prepareColumns()
	{
		$this->addColumn('question',[
			'label' => 'Question',
			'field' => 'question',
			'type' => 'text',
			'controller' => 'question'
		]);
		$this->addColumn('choiceId',[
			'label' => 'Choice 1',
			'field' => 'choiceId',
			'type' => 'text',
			'controller' => 'question'
		]);
		$this->addColumn('choiceId',[
			'label' => 'Choice 2',
			'field' => 'choiceId',
			'type' => 'text',
			'controller' => 'question'
		]);
		$this->addColumn('choiceId',[
			'label' => 'Choice 3',
			'field' => 'choiceId',
			'type' => 'text',
			'controller' => 'question'
		]);
		$this->addColumn('choiceId',[
			'label' => 'Choice 4',
			'field' => 'choiceId',
			'type' => 'text',
			'controller' => 'question'
		]);
		$this->addColumn('status',[
		    'label' => 'Status',
		    'field' => 'status',
		    'type' => 'text',
		    'controller' => 'question'
		]);
		$this->addColumn('choiceId',[
		    'label' => 'Correct Answer',
		    'field' => 'choiceId',
		    'type' => 'text',
		    'controller' => 'question'
		]);
		return $this;
	}

	public function getTitle()
	{
		return 'Quiz List';
	}
	
	public function getEditUrl($row)
	{
		$url = $this->getUrl()->getUrl('edit','admin_question',['questionId'=>$row->questionId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}

	public function getDeleteUrl($row)
	{
		$url = $this->getUrl()->getUrl('delete','admin_question',['questionId'=>$row->questionId]);
		return "object.setUrl('{$url}').resetParam().load();";
	}

	public function getaddFilterUrl()
	{
		$url = $this->getUrl()->getUrl('filter','admin_question',null);
		return "object.setUrl('{$url}').resetParam().setParams($('#gridForm').serializeArray()).setMethod('POST').load()";

	}
	
	public function getaddNewUrl()
	{
		$url = $this->getUrl()->getUrl('edit','admin_question',null,true);
		return "object.setUrl('{$url}').resetParam().load()";
	}

	public function getQuestionChoices($question)
	{
		$questionModel = \Mage::getModel('Model\Question');
		$choice = '';
		if (!$this->choices) {
			$query = "SELECT choiceId,choice FROM question_choice";
			$this->choices = $questionModel->getAdapter()->fetchPairs($query);
			
		}
		$questionChoiceId[] = $question->choiceId;
		foreach ($questionChoiceId as $choiceId) {
			if (array_key_exists($choiceId, $this->choices)) {
					$choice = $this->choices[$choiceId];
				}	
		}	
		return $choice;
	}

	public function getStatusName($question)
	{
		if ($question->status == 1)
		{
			return "Enable";
		}
		return "Disable";
	}

	public function setPages(){

		$this->pages = \Mage::getController('Controller\Core\Pager');
		$questionModel = \Mage::getModel('Model\Question');

		$query = "SELECT * FROM `{$questionModel->getTableName()}`";	
		$questionCount = $questionModel->getAdapter()->fetchOne($query);
		$this->pages->setTotalRecords($questionCount);
		$this->pages->setRecordsPerPage(5);
		if(isset($_GET['page'])) {
			$this->pages->setCurrentPage($_GET['page']);	
		} else {
			$this->pages->setCurrentPage(1);	
		}
		
		$this->pages->calculate();


	}

	public function getPages()
	{
		if(!$this->pages){
			$this->setPages();
		}
		return $this->pages;
	}

}

?>