<?php

namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Cms extends \Controller\Core\Admin{

	protected $pages = [];
	protected $cmsModel = null;
	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();
			
	}
	public function gridAction() {

		$grid = \Mage::getBlock('Block\Admin\Cms\Grid')->toHtml();
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
		header("Content-type: application/json");
		echo json_encode($response);		
	
	}
	public function setCmsModel($cmsModel = null) {
		if (!$cmsModel) {
			$cmsModel = \Mage::getModel('Model\Cms');
		}
		$this->cmsModel = $cmsModel;
		return $this;
	}

	public function getCmsModel()
	{
		if (!$this->cmsModel) {
			$this->setCmsModel();
		}
		return $this->cmsModel;
	}
	public function setPages($pages) {
		$this->pages = $pages;
		return $this;
	}

	public function getPages() {
		return $this->pages;
	}

	public function saveAction() {
			
		date_default_timezone_set('Asia/Kolkata');
		try{
			if (!$this->getRequest()->isPost()) {
				throw new \Exception("Invalid Request");
				
			}
		
			$cms = $this->getCmsModel();
			if ($id = $this->getRequest()->getGet('pageId')) {
					$cms = $cms->load($id);

					if (!$cms) {
						$this->getMessage()->setFailure("No Records Found");	
					}
					$this->getMessage()->setSuccess('Record Updated Successfully');
			} else {
					$cms->createdAt = date('Y-m-d H:i:s');
					$this->getMessage()->setSuccess('Record Inserted Successfully');
				}
		
				$postData = $this->getRequest()->getPost('page');
				$cms->setData($postData);
				$cms->save();
				$grid = \Mage::getBlock('Block\Admin\Cms\Grid')->toHtml();
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
				header("Content-type: application/json");
				echo json_encode($response);
		
		} catch (\Exception $e) {

			echo $e->getMessage();
		}

		
	}
		
	public function deleteAction() {

		try{
			$id = (int)$this->getRequest()->getGet('pageId');
			if (!$id) {
				$this->getMessage()->setFailure('Id Not Found');
			}
			$cms = $this->getCmsModel();
			$cms->load($id);
			if(!$cms->delete()){
				$this->getMessage()->setFailure('Id Invalid');
			}
			$this->getMessage()->setSuccess('Record Deleted Successfully');	
		
			$grid = \Mage::getBlock('Block\Admin\Cms\Grid')->toHtml();
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
				header("Content-type: application/json");
				echo json_encode($response);
		}catch(\Exception $e) { 
			echo $e->getMessage();
		}
		
	}

	public function editAction() {
		
		$cms = $this->getCmsModel();
			$id = $this->getRequest()->getGet('pageId');
			if ($id) {
				$cms = $cms->load($id);
				if (!$cms) {
					throw new \Exception("No records found");
					
				}
				
			}
		$edit = \Mage::getBlock('Block\Admin\Cms\Edit')->setTableRow($cms)->toHtml();
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
		
		
		}

		public function filterAction()
		{
			$filters = $this->getRequest()->getPost('filter');
			
			$filterModel = \Mage::getModel('Model\Admin\Filter');
			$filterModel->setFilter($filters);
			
			$gridHtml = \Mage::getBlock('Block\Admin\Cms\Grid')->toHtml();
				$response = [
					'status' => 'success',
					'message' => 'you did it',
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