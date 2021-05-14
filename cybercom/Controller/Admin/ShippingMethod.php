<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class ShippingMethod extends \Controller\Core\Admin{

	protected $methods = [] ;
	protected $shippingModel = null;

	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();
	}
	public function gridAction() {

		$grid = \Mage::getBlock('Block\Admin\ShippingMethod\Grid')->toHtml();
		$response = [
			'status' => 'success',
			'message' => 'Displayed',
			'element' =>[
				[
					'selector' => '#moduleGrid',
					'html' => $grid
				]
			]
		];
		header("Content-type: application/json");
		echo json_encode($response);	
	}

	public function setShippingModel($shippingModel = null) {

		if (!$shippingModel) {
			$shippingModel = \Mage::getModel('Model\ShippingMethod');
			
		}
		$this->shippingModel = $shippingModel;
		return $this;
	}

	public function getShippingModel() {
		if (!$this->shippingModel) {
			$this->setShippingModel();
		}
		return $this->shippingModel;
	}

	public function setShippingMethods($methods) {
		$this->methods = $methods;
		return $this;
	}

	public function getShippingMethods() {
		return $this->methods;
	}

	public function saveAction() {
	
		date_default_timezone_set('Asia/Kolkata');
		
		$method = $this->getShippingModel();
		try{
			if (!$this->getRequest()->isPost()) {
				throw new \Exception("Invalid Request");
				
			}

			if ($id = $this->getRequest()->getGet('shippingMethodId')) {
					$method = $method->load($id);
					if (!$method) {
						$this->getMessage()->setFailure("No records Found");
					}
					$this->getMessage()->setSuccess("Record Updated Successfully");
				} else {
					$method->createdAt = date('Y-m-d H:i:s');
					$this->getMessage()->setSuccess("Record Inserted Successfully");
				}
				$postData = $this->getRequest()->getPost('shippingmethod');
				$method->setData($postData);
				$method->save();

				$grid = \Mage::getBlock('Block\Admin\ShippingMethod\Grid')->toHtml();
				$response = [
					'status' => 'success',
					'message' => 'Displayed',
					'element' =>[
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
			$id = (int)$this->getRequest()->getGet('shippingMethodId');
			if(!$id) {
				$this->getMessage()->setFailure('Id Not Found');
			}
			$method = $this->getShippingModel();
			$method->load($id);
			
			if(!$method->delete()) {
				$this->getMessage()->setFailure('Id Invalid');
			}
			$this->getMessage()->setSuccess('Record Deleted Successfully');
			
			$grid = \Mage::getBlock('Block\Admin\ShippingMethod\Grid')->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'Displayed',
				'element' =>[
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

	public function editAction() 
	{
		try{

			$method =$this->getShippingModel();
			$id = $this->getRequest()->getGet('shippingMethodId');
		if ($id) {
			
			$method = $method->load($id);

			if (!$method) {
				throw new \Exception("No records found");
				
			}
			
		}
			$edit = \Mage::getBlock('Block\Admin\ShippingMethod\Edit')->setTableRow($method)->toHtml();
			$response = [
				'status' => 'success',
				'message' => 'shipping grid',
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
		
		$grid = \Mage::getBlock('Block\Admin\ShippingMethod\Grid')->toHtml();
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

	public function clearFilterAction()
	{
		
	}	
			
}

?>