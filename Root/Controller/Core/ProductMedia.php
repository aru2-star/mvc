<?php

Mage::loadFileByClassName('Controller_Core_Admin');
Mage::loadFileByClassName('Model_Core_Adapter');
class Controller_Product_Media extends Controller_Core_Admin {

	public function indexAction() {
		$this->renderLayout():
	}

	public function gridAction() {
		try{
			$grid = Mage::getBlock('Block_Product_Grid');
			$this->getLayout()->getChild('content')->addChild($grid, 'Grid');
		}
	}

	public function saveAction() {
		$productMedia = Mage::getModel('Model_ProductMedia');
		$photo = $_FILES["image"]["name"];

	}
}

?>