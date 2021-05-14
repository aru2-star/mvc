<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Customer extends \Controller\Core\Admin{

	protected $customers = [] ;
	protected $customerModel = null;
	protected $addressModel = null;
	
	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();
	}
	
	public function gridAction() {

		
		$grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
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

	public function setCustomerModel($customerModel = null) {

		if (!$customerModel) {
			$customerModel = \Mage::getModel('Model\Customer');
		}
		$this->customerModel = $customerModel;	
		return $this;
	}

	public function getCustomerModel()
	{
		if (!$this->customerModel) {
			$this->setCustomerModel();
		}
		return $this->customerModel;
	}

	public function setAddressModel($addressModel = null) {

		if (!$addressModel) {
			$addressModel = \Mage::getModel('Model\Customer\Address');
		}
		$this->addressModel = $addressModel;	
		return $this;
	}

	public function getAddressModel()
	{
		if (!$this->addressModel) {
			$this->setAddressModel();
		}
		return $this->addressModel;
	}

	public function setCustomer($customers) {

		$this->customers = $customers;
		return $this;
	}

	public function getCustomers() {

		return $this->customers;
	}

	public function saveAction() {
			
			try{
				if (!$this->getRequest()->isPost()) {
					throw new \Exception("Invalid Request");
					
				}

				date_default_timezone_set('Asia/Kolkata');

				
				if (!$this->getRequest()->getGet('tab')) {
					$customer = $this->getCustomerModel();
					if ($id = (int)$this->getRequest()->getGet('customerId')) {
						$customer = $customer->load($id);

						if (!$customer) {
							$this->getMessage()->setFailure("No records found");
						}
						 $customer->updatedAt = date('Y-m-d H:i:s');
						 $this->getMessage()->setSuccess("Record Updated Successfully");
					} else {
						 $customer->createdAt = date('Y-m-d H:i:s');
						 $this->getMessage()->setSuccess("Record Inserted Successfully");
					}
					$postData = $this->getRequest()->getPost('customer');
					$customer->setData($postData);
					$customer->save();
					if (!$id = $this->getRequest()->getGet('customerId')) {
						$shipping = \Mage::getModel('Model\Customer\Address');
						$billing = \Mage::getModel('Model\Customer\Address');
						$shipping->address_type = 2;
						$shipping->customerId = $customer->customerId;
						$billing->address_type = 1;
						$billing->customerId = $customer->customerId;
						$shipping->save();
						$billing->save();
						
					}

					
				} else {
						$customer = $this->getCustomerModel();
						if ($id = (int)$this->getRequest()->getGet('customerId')) 
						{
							$customer = $customer->load($id);
							if (!$customer) {
								$this->getMessage()->setFailure("No records found");
							}
						}

						$shippingAddress = \Mage::getModel('Model\Customer\Address');
						$billingAddress = \Mage::getModel('Model\Customer\Address');
						
						$query = "SELECT * FROM `customer_address` WHERE `address_type` = '2' AND `customerId` = {$id}";
						$shippingAddress = $shippingAddress->fetchRow($query);
						if(!$shippingAddress) {
							$shippingAddress = \Mage::getModel('Model\Customer\Address');
						}

						$query = "SELECT * FROM `customer_address` WHERE `address_type` = '1' AND `customerId` = {$id}";
						$billingAddress = $billingAddress->fetchRow($query);
						if (!$billingAddress) {
							$billingAddress = \Mage::getModel('Model\Customer\Address');
						}

						$postShippingData = $this->getRequest()->getPost('shipping_address');
						$shippingAddress->setData($postShippingData);
						$shippingAddress->address_type = 2;
						$shippingAddress->customerId = $this->getRequest()->getGet('customerId');
						$shippingAddress->save();

						$postBillingData = $this->getRequest()->getPost('billing_address');
						$billingAddress->setData($postBillingData);
						$billingAddress->address_type = 1;
						$billingAddress->customerId = $this->getRequest()->getGet('customerId');
						$billingAddress->save();



						
				}
				$grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
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

			
		} catch (\Exception $e){
			echo $e->getMessage();
		}
	}

	
	public function deleteAction() {

		try{
			
			$id = (int)$this->getRequest()->getGet('customerId');
			if (!$id) {
				$this->getMessage()->setFailure("Id Not Found");
			}
			$customer = $this->getCustomerModel();
			$customer->load($id);
			if(!$customer->delete())
			{
				$this->getMessage()->setFailure("Id Invalid");
			}
			$this->getMessage()->setSuccess('Record Deleted Successfully');
			
			$grid = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
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
			
		} catch(\Exception $e) 
		{ 
			echo $e->getMessage();
		}

	}

	public function editAction() {

		try{
			$customer = $this->getCustomerModel();
			$id = $this->getRequest()->getGet('customerId');
			if ($id) {
				$customer = $customer->load($id);

				if (!$customer) {
					throw new \Exception("No records found");
					
				}
				
			}
			$edit = \Mage::getBlock('Block\Admin\Customer\Edit')->setTableRow($customer)->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'customer grid',
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

	public function filterAction()
		{
			$filters = $this->getRequest()->getPost('filter');
			
			$filterModel = \Mage::getModel('Model\Admin\Filter');
			$filterModel->setFilter($filters);
			
			$gridHtml = \Mage::getBlock('Block\Admin\Customer\Grid')->toHtml();
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