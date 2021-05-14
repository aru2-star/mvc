<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Question extends \Controller\Core\Admin
{
	
		public function indexAction()
		{
			$layout = \Mage::getBlock('Block\Admin\Core\Layout');
			echo $this->renderLayout();
		}

		public function gridAction()
		{
			$grid = \Mage::getBlock('Block\Admin\Question\Grid')->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'Displayed',
				'element' => [
					[
						'selector' => '#moduleGrid',
						'html' => $grid
					]
				]
			];

			header('Content-type: application/json');
			echo json_encode($response);
		}

		public function editAction()
		{
			try{
				$question = \Mage::getModel('Model\Question');
				$id = $this->getRequest()->getGet('questionId');
				if ($id) {
					
					$question = $question->load($id);

					if (!$question) {
						throw new \Exception("No records found");
						
					}
					
				}
				$edit = \Mage::getBlock('Block\Admin\Question\Edit')->setTableRow($question)->toHtml();

				$response = [
					'status' => 'success',
					'message' => 'Displayed',
					'element' => [
						[
							'selector' => '#moduleGrid',
							'html' => $edit
						]

					]

				];

				header('Content-type: application/json');
				echo json_encode($response);
			}catch(\Exception $e) {
				echo $e->getMessage();
			}
		}

		public function saveAction()
		{

			date_default_timezone_set('Asia/Kolkata');
			try{
				$question = \Mage::getModel('Model\Question');
				if ($id = $this->getRequest()->getGet('questionId')) {
					$question = $question->load($id);
					if (!$question) {
						$this->getMessage()->setFailure('No records Found');
					}
					$this->getMessage()->setSuccess('Records Updated Successfully');
				} else {
					$this->getMessage()->setSuccess('Records Inserted Successfully');
				}

				$questionData = $this->getRequest()->getPost('question');
				$question->setData($questionData);
				$question->save();

			}catch(Exception $e){
				$this->getMessage()->setFailure($e->getMessage());
			}

			$grid = \Mage::getBlock('Block\Admin\Question\Grid')->toHtml();

			$response = [
				'status' => 'success',
				'message' => 'Displayed',
				'element' => [
					[
						'selector' => '#moduleGrid',
						'html' => $grid
					]
				]
			];

			header('Content-type: application/json');
			echo json_encode($response);


		}
	
		public function deleteAction()
		{
			try{
				$id = $this->getRequest()->getGet('questionId');
				if(!$id){
					$this->getMessage()->setFailure('Id not found');
				}
				$que = \Mage::getModel('Model\Question')->load($id);
				if(!$que->delete()){
					$this->getMessage()->setFailure('Id invalid');
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
					'message' => 'Displayed',
					'element' => [
						[
							'selector' => '#moduleGrid',
							'html' => $edit
						]
					]
				];

				header("Content-type: application/json");
				echo json_encode($response);

				}catch(\Exception $e) {
						echo $e->getMessage();
				}
				$this->redirect("grid", null, null, true);	
			}	
		}

		function filterAction()
		{
			$filters = $this->getRequest()->getPost('filter');
			
			$filterModel = \Mage::getModel('Model\Admin\Filter');
			$filterModel->setFilter($filters);
			
			$grid = \Mage::getBlock('Block\Admin\Question\Grid')->toHtml();
				$response = [
					'status' => 'success',
					'message' => 'Displayed',
					'element' => [
						[
							'selector' => '#moduleGrid',
							'html' => $grid
						]
					]
			];

			header("Content-type: application/json; charset=utf-8");
			echo json_encode($response);
	    }		
	    
?>