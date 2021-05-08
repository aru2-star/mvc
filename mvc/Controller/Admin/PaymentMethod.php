<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class PaymentMethod extends \Controller\Core\Admin{

	protected $methods = [] ;
	protected $paymentModel = null;

	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();
	}
	public function gridAction() {

		$grid = \Mage::getBlock('Block\Admin\PaymentMethod\Grid')->toHtml();
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

	public function setPaymentMethodModel($paymentModel = null) {

		if (!$paymentModel) {
			$paymentModel = \Mage::getModel('Model\PaymentMethod');
		
		}
		$this->paymentModel = $paymentModel;	
		return $this;
	}

	public function getPaymentMethodModel()
	{
		if (!$this->paymentModel) {
			$this->setPaymentMethodModel();
		}
		return $this->paymentModel;
	}

	public function setPaymentMethods($methods) {

		$this->methods = $methods;
		return $this;
	}

	public function getPaymentMethods() {

		return $this->methods;
	}

	

	public function saveAction() {

		date_default_timezone_set('Asia/Kolkata');

		try{
			$method = $this->getPaymentMethodModel();

			if ($id = (int)$this->getRequest()->getGet('paymentMethodId')) {
				$method = $method->load($id);
				if (!$method) {
					$this->getMessage()->setFailure("No records Found");
				}
				$this->getMessage()->setSuccess('Record Updated Successfully');
			} else {
				$method->createdAt = date('Y-m-d H:i:s');
				$this->getMessage()->setSuccess('Record Inserted Successfully');
			}
			
			$postData = $this->getRequest()->getPost('paymentmethod');
			$method->setData($postData);
			$method->save();
			
			$grid = \Mage::getBlock('Block\Admin\PaymentMethod\Grid')->toHtml();
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
			$id = (int)$this->getRequest()->getGet('paymentMethodId');
			if(!$id){
				$this->getMessage()->setFailure('Id Not Found');	
			}
			$method = $this->getPaymentMethodModel();
			$method->load($id);
			
			if(!$method->delete()) {
				$this->getMessage()->setFailure('Id Invalid');
			}
			$this->getMessage()->setSuccess('Record Deleted Successfully');
			$grid = \Mage::getBlock('Block\Admin\PaymentMethod\Grid')->toHtml();
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

	public function editAction() {
	
		try{
			
			$method = $this->getPaymentMethodModel();
			$id = $this->getRequest()->getGet('paymentMethodId');
			if ($id) {
				
				$method = $method->load($id);

				if (!$method) {
					throw new \Exception("No records found");
					
				}
				
			}
			$edit = \Mage::getBlock('Block\Admin\PaymentMethod\Edit')->setTableRow($method)->toHtml();
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
		
	} catch (\Exception $e){
		echo $e->getMessage();
	}
	
	}

	public function filterAction()
		{
			$filters = $this->getRequest()->getPost('filter');
			
			$filterModel = \Mage::getModel('Model\Admin\Filter');
			$filterModel->setFilter($filters);
			
			$gridHtml = \Mage::getBlock('Block\Admin\PaymentMethod\Grid')->toHtml();
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