<?php

Mage::loadFileByClassName('Controller_Core_Admin');
class Controller_Product_GroupPrice extends Controller_Core_Admin {
	
	public function indexAction() {
		try {

			$productId = (int)$this->getRequest()->getGet('productId');
			$product = Mage::getModel('Model_Product')->load($productId);
			if (!$product) {
				throw new Exception("Record Not Found", 1);
				
			}

			$layout = $this->getLayout();
			$grid = Mage::getBlock('Block_Product_Form_Tabs_GroupPrice')->setProduct($product);
			$content = $this->addChild($grid);

			$this->renderLayout();
		} catch(Exception $e){
			echo $e->getMessage();
		}
		
	}

	public function saveAction() {
		$groupData = $this->getRequest()->getPost('groupPrice');
		echo "<pre>";
		print_r($groupData);
		$productId = $this->getRequest()->getGet('productId');
		print_r($productId);
		foreach ($groupData['exist'] as $groupId => $price) {
			$query = "SELECT * FROM product_group_price WHERE `productId`='{$productId}' AND `customerGroupId` = '{$groupId}'";
			$groupPrice = Mage::getModel('Model_Product_Group_Price');
			$groupPrice->fetchRow($query);
			print_r($groupPrice);
			$groupPrice->price = $price;
			$groupPrice->save();
		}
		foreach ($groupData['new'] as $groupId => $price) {
			$groupPrice = Mage::getModel('Model_Product_Group_Price');
			$groupPrice->customerGroupId = $groupId;
			$groupPrice->productId = $productId;
			$groupPrice->price = $price;
			$groupPrice->save();
		}
		$this->redirect('index');
	}
}

?>
