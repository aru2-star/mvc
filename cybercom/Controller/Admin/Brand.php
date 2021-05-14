<?php

namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Brand extends \Controller\Core\Admin{

	protected $brand = [];
	protected $brandModel = null;

	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();
	}

	public function gridAction() {
		
		$gridHtml = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
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

	public function setBrandModel($brandModel = null) {

		if (!$brandModel) {
			$brandModel = \Mage::getModel('Model\Brand');
		}
		$this->brandModel = $brandModel;
		return $this;
	}

	public function getBrandModel() {

		if (!$this->brandModel) {
			$this->setBrandModel();

		}
		return $this->brandModel;
	}

	public function setBrand($brand) {
		$this->brand = $brand;
		return $this;
	}

	public function getBrand() {
		return $this->brand;
	}

	public function saveAction() {

		date_default_timezone_set('Asia/Kolkata');
		
		try{
			if (!$this->getRequest()->isPost()) {
				throw new \Exception("Invalid Request");

			}
			$brand = $this->getBrandModel();
			if ($id = $this->getRequest()->getGet('brandId')) 
			{
				$brand = $brand->load($id);
				if (!$brand) {
					$this->getMessage()->setFailure("No records found");
				}
				$this->getMessage()->setSuccess("Records Updated Successfully");
			}
			else {
				$this->getMessage()->setSuccess("Records Inserted Successfully");
			}
			$name = $this->getRequest()->getPost('name');
			$sortOrder = $this->getRequest()->getPost('sortOrder');
			$status = $this->getRequest()->getPost('status');
			
			$imageName = $_FILES['file']['name'];
			$imagetmpPath = $_FILES['file']['tmp_name'];
			$randomName = 'brand_'.rand(1,6).'_'.$imageName;
			$path = $_SERVER['DOCUMENT_ROOT'].'/cybercom/Images/Brand/';
			if (move_uploaded_file($imagetmpPath, $path.$randomName)) {
					$brand->name = $name;
					$brand->sortOrder = $sortOrder;
					$brand->status = $status;
					$brand->image = $randomName;	
					$brand->save();
					
			}

			$gridHtml = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
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

		} catch (\Exception $e){
			echo $e->getMessage();
		}

	}

	
	public function deleteAction() {
		try{
			$id = (int)$this->getRequest()->getGet('brandId');
			if (!$id) {
				$this->getMessage()->setFailure('Id Not Found');
			}
			$brand = $this->getBrandModel();
			$brand->load($id);
			
			if(!$brand->delete()){
				
				$this->getMessage()->setFailure("Id Invalid");
			}
			$this->getMessage()->setSuccess("Records Deleted Successfully");
			$gridHtml = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
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

		}catch(\Exception $e) {
			echo $e->getMessage();
		}

	}

	public function editAction() {


		try{
			
			$gridHtml = \Mage::getBlock('Block\Admin\Brand\Edit');
			$brand = $this->getBrandModel();
			$id = $this->getRequest()->getGet('brandId');
			if ($id) {
				
				$brand = $brand->load($id);

				if (!$brand) {
					throw new \Exception("No records found");
					
				}
				
			}
			$gridHtml->setTableRow($brand);
			$gridHtml = $gridHtml->toHtml();
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

	} catch (\Exception $e){
		echo $e->getMessage();
	}

	}

	public function filterAction()
		{
			$filters = $this->getRequest()->getPost('filter');
			
			$filterModel = \Mage::getModel('Model\Admin\Filter');
			$filterModel->setFilter($filters);
			$gridHtml = \Mage::getBlock('Block\Admin\Brand\Grid')->toHtml();
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
