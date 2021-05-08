<?php

namespace Controller\Admin;

class Admin extends \Controller\Core\Admin{

	protected $admin = [];
	protected $adminModel = null;

	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();
	}

	public function gridAction() {
		
		$gridHtml = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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

	public function setAdminModel($adminModel = null) {

		if (!$adminModel) {
			$adminModel = \Mage::getModel('Model\Admin');
		}
		$this->adminModel = $adminModel;
		return $this;
	}

	public function getAdminModel() {

		if (!$this->adminModel) {
			$this->setAdminModel();

		}
		return $this->adminModel;
	}

	public function setAdmin($admin) {
		$this->admin = $admin;
		return $this;
	}

	public function getAdmin() {
		return $this->admin;
	}

	public function saveAction() {

		date_default_timezone_set('Asia/Kolkata');
		
		try{
			if (!$this->getRequest()->isPost()) {
				throw new \Exception("Invalid Request");

			}
			$admin = $this->getAdminModel();
			if ($id = $this->getRequest()->getGet('adminId')) 
			{
				$admin = $admin->load($id);
				if (!$admin) {
					$this->getMessage()->setFailure("No records found");
				}
				$this->getMessage()->setSuccess("Records Updated Successfully");
			}
			else {
				$admin->createdAt = date('Y-m-d H:i:s');
				$this->getMessage()->setSuccess("Records Inserted Successfully");
			}
			$postData = $this->getRequest()->getPost('admin');
			$admin->setData($postData);
			$admin->save();
			$gridHtml = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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
			$id = (int)$this->getRequest()->getGet('adminId');
			if (!$id) {
				$this->getMessage()->setFailure('Id Not Found');
			}
			$admin = $this->getAdminModel();
			$admin->load($id);
			
			if(!$admin->delete()){
				
				$this->getMessage()->setFailure("Id Invalid");
			}
			$this->getMessage()->setSuccess("Records Deleted Successfully");
			$gridHtml = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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
			
			$admin = $this->getAdminModel();
			$id = $this->getRequest()->getGet('adminId');
			if (!$id) {
				$gridHtml = \Mage::getBlock('Block\Admin\Admin\Edit\Tabs\Form');
				
			} else {
				$admin = $admin->load($id);
				$gridHtml = \Mage::getBlock('Block\Admin\Admin\Edit');

				if (!$admin) {
					throw new Exception("No records found");
					
				}
				$gridHtml->setTableRow($admin);
			}
				
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
			
			$gridHtml = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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
