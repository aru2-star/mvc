<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Admin extends \Controller\Core\Admin
{
	protected $admin = [];
	protected $adminModel = null;

	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();
	}

	public function gridAction() {
		
		$grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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
		$admin = $this->getAdminModel();
		
		try{
			if (!$this->getRequest()->isPost()) {
				throw new \Exception("Invalid Request");

			}
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

			$grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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
			$grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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


		try{
			
			$admin = $this->getAdminModel();
			$id = $this->getRequest()->getGet('adminId');
			if ($id) {
				$admin = $admin->load($id);

				if (!$admin) {
				throw new \Exception("No records found");
				
				}
				
			}				
			$edit = \Mage::getBlock('Block\Admin\Admin\Edit')->setTableRow($admin)->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'admin grid',
				'element' => [
					[
						'selector' => '#moduleGrid',
						'html' => $edit
					]
				]
			];

			header("Content-type: application/json");
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
			
			$grid = \Mage::getBlock('Block\Admin\Admin\Grid')->toHtml();
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

	public function clearFilterAction()
	{
		
	}

}