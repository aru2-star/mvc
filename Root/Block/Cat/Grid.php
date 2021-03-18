<?php

Mage::loadFileByClassName('Block_Core_Template');
class Block_Category_Grid extends Block_Core_Template {

	protected $categories = null;
	protected $categoriesOptions = [];
	public function __construct() {
		$this->setTemplate('View/Category/grid.php');
	}

	public function setCategories($categories = null) {
		if (!categories) {
			$query = "SELECT * FROM 'category';"
			$categories = Mage::getModel('Model_Category')->fetchAll($query);
		}
		$this->categories = $categories;
		return $this;
	}

	public function getCategories() {
		if (!$this->categories) {
			$this->setCategories();
		}
		return $this->categories;
	}

	public function getCategoriesOptions() {
		if ($this->categoriesOptions) {
			return $this->categoriesOptions;
		}
		$query = "SELECT `categoryId`, `name` FROM `category`;"
		$categories = Mage::getModel('Model_Category')->fetchAll($query);
		if ($categories) {
			# code...
			foreach ($categories->getData() as $category) {
				# code...
				$this->categoriesOptions[$category->name] = $category->name;
			}
		}
		return $this->categoriesOptions;
	}

	public function getName($category) {
		$categoriesData = $this->getCategoriesOptions();
		$pathId = explode("=", $category->pathId);
		foreach ($pathId as &$id) {
			# code...
			if (array_key_exists($id, $categoriesData)) {
				$id = $categoriesData[$id];
			}
		}
		return implode('=>', $pathId);
	}
}

?>