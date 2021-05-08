<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Category extends \Controller\Core\Admin{

	protected $categories = [] ;
	protected $categoryModel = null;

	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();
	}
	
	public function gridAction() {

		$gridHtml = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
		$response = [
			'status' => 'success',
			'message' => 'Displayed',
			'element' => [
				[
					'selector' => '#moduleGrid',
					'html' => $gridHtml
				]
			]
		];

		header("Content-type: application/json; charset=utf-8");
		echo json_encode($response);

	}

	public function setCategoryModel($categoryModel = null) {

		if (!$categoryModel) {
			$categoryModel = \Mage::getModel('Model\Category');
		}
		$this->categoryModel = $categoryModel;
		return $this;
	}

	public function getCategoryModel() {

		if (!$this->categoryModel) {
			$this->setCategoryModel();

		}
		return $this->categoryModel;
	}

	public function setCategory($category) {
		$this->categories = $category;
		return $this;
	}

	public function getCategories() {
		return $this->categories;
	}

	public function saveAction() {

		try{
			date_default_timezone_set('Asia/Kolkata');
			if (!$this->getRequest()->isPost()) {
				throw new \Exception("Invalid Request");

			}	
			$category = $this->getCategoryModel();
			if ($id = $this->getRequest()->getGet('categoryId')) {
				$category = $category->load($id);

					if (!$category) {
						$this->getMessage()->setSuccess("No records found");
					}
					$this->getMessage()->setSuccess('Record Updated Successfully');
				} else {
					//$category->createdAt = date('Y-m-d H:i:s');
					$this->getMessage()->setSuccess('Record Inserted Successfully');
				}
				
				$categoryPathId = $category->path;
				$postData = $this->getRequest()->getPost('category');
				$category->setData($postData);
				$category->save();
				$category->updatePathId();
				$category->updateChildrenPathId($categoryPathId);
				$gridHtml = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
				$response = [
					'status' => 'success',
					'message' => 'Displayed',
					'element' => [
						[
							'selector' => '#moduleGrid',
							'html' => $gridHtml
						]
			]
		];

		header("Content-type: application/json; charset=utf-8");
		echo json_encode($response);

				
		} catch (Exception $e){
			echo $e->getMessage();
		}

	}

	public function deleteAction() {
		try{
			
			$id = (int)$this->getRequest()->getGet('categoryId');
			if(!$id) {
				$this->getMessage()->setFailure('Id Not Found');
			}
			$category = $this->getCategoryModel();
			$category->load($id);
			$path = $category->path;
			$parentId = $category->parentId;
			$category->updateChildrenPathId($path,$parentId);
			if(!$category->delete()){
			 	$this->getMessage()->setFailure("Id Invalid");
			}
			$this->getMessage()->setSuccess('Record Deleted Successfully');
			$grid = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
				$response = [
					'status' => 'success',
					'message' => 'category grid',
					'element' => [
						[
							'selector' => '#moduleGrid',
							'html' => $grid
						]
					]
				];
				header("Content-type: application/json");
				echo json_encode($response);
				

		}catch(Exception $e) {
			echo $e->getMessage();
		}

	}

	public function editAction() {


		try{

			$edit = \Mage::getBlock('Block\Admin\Category\Edit');
			$category = $this->getCategoryModel();
			$id = $this->getRequest()->getGet('categoryId');
			if(!$id) {
				$edit = \Mage::getBlock('Block\Admin\Category\Edit\Tabs\Form');
			}	
			else{
				$category = $category->load($id);
				$edit = \Mage::getBlock('Block\Admin\Category\Edit');
				if (!$category) {
					throw new Exception("No records found");	
				}

					
			}
			$edit->setTableRow($category);
			$edit = $edit->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'product grid',
				'element' => [
					[
						'selector' => '#moduleGrid',
						'html' => $edit
					]
				]
			];
			header("Content-type: application/json");
			echo json_encode($response);
		
		} catch (Exception $e){
			echo $e->getMessage();
		}

	}

	public function filterAction()
		{
			$filters = $this->getRequest()->getPost('filter');
			
			$filterModel = \Mage::getModel('Model\Admin\Filter');
			$filterModel->setFilter($filters);
			
			$gridHtml = \Mage::getBlock('Block\Admin\Category\Grid')->toHtml();
				$response = [
					'status' => 'success',
					'message' => 'Displayed',
					'element' => [
						[
							'selector' => '#moduleGrid',
							'html' => $gridHtml
						]
					]
			];

			header("Content-type: application/json; charset=utf-8");
			echo json_encode($response);
	    }
	    
	public function clearFilterAction()
	{
		
	}
	

}

?>
