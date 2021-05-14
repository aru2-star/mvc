<?php
namespace Controller\Admin\Customer;
\Mage::loadFileByClassName('Controller\Core\Admin');

class CustomerGroup extends \Controller\Core\Admin{

	protected $customerGroup = [] ;
	protected $customerGroupModel = null;
	
	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $layout->toHtml();
	}
	
	public function gridAction() {

		$grid = \Mage::getBlock('Block\Admin\Customer\CustomerGroup\Grid')->toHtml();
		$response = [
			'status' => 'success',
			'message' => 'customer displayed',
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

	public function setCustomerGroupModel($customerGroupModel = null) {

		if (!$customerGroupModel) {
			$customerGroupModel = \Mage::getModel('Model\Customer\CustomerGroup');
		}
		$this->customerGroupModel = $customerGroupModel;	
		return $this;
	}

	public function getCustomerGroupModel()
	{
		if (!$this->customerGroupModel) {
			$this->setCustomerGroupModel();
		}
		return $this->customerGroupModel;
	}

	public function setCustomerGroup($customerGroup) {

		$this->customerGroup = $customerGroup;
		return $this;
	}

	public function getCustomerGroup() {

		return $this->customerGroup;
	}

	public function saveAction() {
			
			try{
				if (!$this->getRequest()->isPost()) {
					throw new \Exception("Invalid Request");
					
				}

				date_default_timezone_set('Asia/Kolkata');
				$customerGroup = $this->getCustomerGroupModel();
				if ($id = (int)$this->getRequest()->getGet('groupId')) {
					$customerGroup = $customerGroup->load($id);

					if (!$customerGroup) {
						$this->getMessage()->setFailure("No records found");
					}
					$this->getMessage()->setSuccess("Record Updated Successfully");
				
				} else {

					$customerGroup->createdAt = date('Y-m-d H:i:s');
					$this->getMessage()->setSuccess("Record Inserted Successfully");
				}
				
				$postData = $this->getRequest()->getPost('customerGroup');
				$customerGroup->setData($postData);
				$customerGroup->save();

				$grid = \Mage::getBlock('Block\Admin\Customer\CustomerGroup\Grid')->toHtml();
				$response = [
					'status' => 'success',
					'message' => 'customer displayed',
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
			
			$id = (int)$this->getRequest()->getGet('groupId');
			if (!$id) {
				$this->getMessage()->setFailure("Id Not Found");
			}
			$customerGroup = $this->getCustomerGroupModel();
			$customerGroup->load($id);
			if(!$customerGroup->delete())
			{
				$this->getMessage()->setFailure("Id Invalid");
			}
			$this->getMessage()->setSuccess('Record Deleted Successfully');
			
			$grid = \Mage::getBlock('Block\Admin\Customer\CustomerGroup\Grid')->toHtml();
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
			
		} catch(\Exception $e) { 
			echo $e->getMessage();
		}
	}

	public function editAction() {

		try{
			
			$customerGroup = $this->getCustomerGroupModel();
			$id = $this->getRequest()->getGet('groupId');
			if ($id) {
				
				$customerGroup = $customerGroup->load($id);

				if (!$customerGroup) {
					throw new \Exception("No records found");
					
				}
				
			}
			$edit = \Mage::getBlock('Block\Admin\Customer\CustomerGroup\Edit')->setTableRow($customerGroup)->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'customerGroup grid',
				'element' => [
					[
						'selector' => '#moduleGrid',
						'html' => $edit
					]
				]
			];
			header("Content-type: application/json");
			echo json_encode($response);
			
		} catch(\Exception $e) {
			echo $e->getMessage();
			}
	
	}
			
}


?>