<?php

Mage::loadFileByClassName('Block_Core_Template');

class Block_Product_Edit_Tabs_Media extends Block_Core_Template
{

    public function __construct()
    {
        $this->setTemplate('View/products/form/tabs/media.php');
    }

    public function setImages($images = null) {
    	if (!$this->images) {
    		$image = Mage::getModel('Model_ProductImage');
    		$this->images = $image->fetchAll();
    	}
    	return $this;
    }

    public fucntion getImages() {
    	if (!$this->images) {
    		$this->setImages();
    	}
    	return $this->image;
    }
}
