<?php

Mage::loadFileByClassName('block_core_template');

class Block_Product_Edit_Tabs_Category extends Block_Core_Template
{

    public function __construct()
    {
        $this->setTemplate('View/products/form/tabs/category.php');
    }

    public function setCategory($category = null)
    {
        if ($category) {
            $this->category = $category;
        }

        $category = Mage::getModel('model_category');

        if ($id = (int) $this->getRequest()->getGet('id')) {
            $category = $category->load($id);
        }

        $this->category = $category;
        return $this;
    }

    public function getCategory()
    {
        if (!$this->category) {
            $this->setCategory();
        }

        return $this->category;
    }

	public function getFormUrl() {
		return $this->getUrl('save');
	}

	public function getParentOption() {
		$categories = Mage::getModel('Model_Category')->fetchAll();
		return $categories;
	}
}
