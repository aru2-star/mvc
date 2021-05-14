<?php
namespace Controller\Admin\Question;

class Choice extends \Controller\Core\Admin
{
	
	public function saveAction()
	{
		
		$choiceData = $this->getRequest()->getPost();
		
		if(array_key_exists('exist', $choiceData)){
			foreach ($choiceData['exist'] as $choiceId => $question) {
				$choiceModel = \Mage::getModel('Model\Question\Choice');
				$choiceModel->load($choiceId);	
				$choiceModel->choice = $name['choice'];
				$choiceModel->answer = $name['answer'];
				$choiceModel->save();
			}
		}

		if(array_key_exists('new', $choiceData)){
			foreach ($choiceData['new']['choice'] as $key => $value) {
				
				$choiceModel = \Mage::getModel('Model\Question\Choice');
				$choiceModel->groupId = $this->getRequest()->getGet('choiceId');	
				$choiceModel->choice = $choice;
				$choiceModel->answer = $choiceData['new']['answer'][$key];
				$choiceModel->save();
			}
		}

		$question = \Mage::getModel('Model\Question');
			if($id = $this->getRequest()->getGet('questionId')){
				$question = $question->load($id);
				if (!$question) {
					throw new \Exception("No Data Found");
				}
			}
			$edit = \Mage::getBlock('Block\Admin\Question\Edit')->setTableRow($question)->toHtml();

			$response = [
			'status' => 'success',
			'message' => 'you did it',
			'element' => [
				[
					'selector' => '#moduleGrid',
					'html' => $edit
				]
			]
		];

		header("Content-type: application/json; charset=utf-8");
		echo json_encode($response);
	}

	public function deleteAction()
	{
		$id = $this->getRequest()->getGet('choiceId');
		if(!$id){
			$this->getMessage()->setFailure('Id Not Found');
		}
		$choiceModel = \Mage::getModel('Model\Question\Choice')->load($id); 
		if(!$choiceModel->delete()){
			$this->getMessage()->setFailure('Id Invalid');
		}

		$question = \Mage::getModel('Model\Question');
		if($id = $this->getRequest()->getGet('questionId')){
			$question = $question->load($id);
			if (!$question) {
				throw new \Exception("No Data Found");
			}
		}
		$edit = \Mage::getBlock('Block\Admin\Question\Edit')->setTableRow($question)->toHtml();

		$response = [
			'status' => 'success',
			'message' => 'you did it',
			'element' => [
				[
					'selector' => '#moduleGrid',
					'html' => $edit
				]
			]
		];

		header("Content-type: application/json; charset=utf-8");
		echo json_encode($response);

	}		
}
?>