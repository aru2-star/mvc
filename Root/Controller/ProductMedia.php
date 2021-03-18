<?php

Mage::loadFileByClassName('Controller_Core_Admin');
class Controller_ProductMedia extends Controller_Core_Admin {

	public function saveAction() {
		$productMedia = Mage::getModel('Model_ProductMedia');
		$photo = $_FILES['photo']['name'];

		$productMedia->image = $photo;
		$productMedia->productId = $this->getRequest()->getGet('id');
		$productMedia->save();
		$this->redirect('ProductMedia', 'form');
	}
}

?>