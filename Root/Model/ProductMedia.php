<?php

Mage::loadFileByClassName('Model_Core_Table');

class Model_ProductMedia extends Model_Core_Table {

	public function __construct() {

	}

	public function getImagePath() {
		return Mage::getBaseDir('Image\Product\\');
	}
}
?>