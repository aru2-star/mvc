<?php

Mage::loadFileByClassName('Block_Core_Template');
class Block_Cat_Edit extends Block_Core_Template {

	public function __construct() {
		 $this->templateName  = './View/cat/edit.php';
	}

	public function setCategory($category = null)
    {
        if ($category) {
            $this->category = $category;
        }

        $category = Mage::getModel('Model_Cat');

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
		$categories = Mage::getModel('Model_Cat')->fetchAll();
		return $categories;
	}

    public function getCategoryOptions() {
        if (!$this->categoryOptions) {
            $query = "SELECT `categoryId`, `name` FROM `{$this->getCategory()->getTableName()}`;";
            $this->categoryOptions = $this->getCategory()->getAdapter()->fetchPairs($query);

            $this->categoryOptions = [];
        }

        return $this->categoryOptions;
    }
}
/*
categoryId(int-11), name(varchar-100), parentId(int-11, null), pathId(varchar - 50, null),status(tiny int-4) */

?>
