<?php
namespace Controller\Admin;
\Mage::loadFileByClassName('Controller\Core\Admin');

class Product extends \Controller\Core\Admin{

	protected $products = [];
	protected $productModel = null;
	public function indexAction()
	{
		$layout = \Mage::getBlock('Block\Core\Layout');
		echo $this->renderLayout();
			
	}
	public function gridAction() {

		$grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
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
	public function setProductModel($productModel = null) {
		if (!$productModel) {
			$productModel = \Mage::getModel('Model\Product');
		}
		$this->productModel = $productModel;
		return $this;
	}

	public function getProductModel()
	{
		if (!$this->productModel) {
			$this->setProductModel();
		}
		return $this->productModel;
	}
	public function setProducts($products) {
		$this->products = $products;
		return $this;
	}

	public function getProducts() {
		return $this->products;
	}

	public function saveAction() {
			
		date_default_timezone_set('Asia/Kolkata');
		try{
			if (!$this->getRequest()->isPost()) {
				throw new \Exception("Invalid Request");
				
			}
			
			$product = $this->getProductModel();
				if ($id = $this->getRequest()->getGet('productId')) {
						$product = $product->load($id);

						if (!$product) {
							$this->getMessage()->setFailure("No Records Found");	
						}
						$product->updatedAt = date('Y-m-d H:i:s');
						$this->getMessage()->setSuccess('Record Updated Successfully');
				} else {
						$product->createdAt = date('Y-m-d H:i:s');
						$this->getMessage()->setSuccess('Record Inserted Successfully');
					}
					$postData = $this->getRequest()->getPost('product');
					foreach ($postData as &$productDetails) {
						if (is_array($productDetails)) {
							$productDetails = implode(',', $productDetails);
						}
						
					}
					$product->setData($postData);
					$product->save();
			
			$grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
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
			$id = (int)$this->getRequest()->getGet('productId');
			if (!$id) {
				$this->getMessage()->setFailure('Id Not Found');
			}
			$product = $this->getProductModel();
			$product->load($id);
			if(!$product->delete()){
				$this->getMessage()->setFailure('Id Invalid');
			}
			$this->getMessage()->setSuccess('Record Deleted Successfully');	
			$grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
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

			$product = $this->getProductModel();
			$id = $this->getRequest()->getGet('productId');
			if ($id) {
				
				$product = $product->load($id);
				if (!$product) {
					throw new \Exception("No records found");		
				}
				
			}
		} catch (Exception $e){
			$this->getMessage()->setFailure($e->getMessage());
		}
		$edit = \Mage::getBlock('Block\Admin\Product\Edit')->setTableRow($product)->toHtml();

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


		public function productCategoryAction()
		{
			if($productId = $this->getRequest()->getGet('productId'))
			{
				
				$postData = $this->getRequest()->getPost('productCategory');
				
				foreach ($postData as $id) {
					$productCategoryModel = \Mage::getModel('Model\Product\Category');
					$productCategoryModel->categoryId = $id;
					$productCategoryModel->productId = $productId;
					$productCategoryModel->save();	
				}	
			}

			$grid = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
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


		public function filterAction()
		{
			$filters = $this->getRequest()->getPost('filter');
			
			$filterModel = \Mage::getModel('Model\Admin\Filter');
			$filterModel->setFilter($filters);
			
			$gridHtml = \Mage::getBlock('Block\Admin\Product\Grid')->toHtml();
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