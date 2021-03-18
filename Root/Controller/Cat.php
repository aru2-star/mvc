<?php
/*
1-> prepare the grid - add, edit, delete
	2-> Show category path as a name
3-> category add
	4-> show dropdown for parent category
		5-> show path as name
6-> category edit
	7-> show dropdown for parent category without current category and its sub category
8-> category save(in add case)
	9-> category save
	10-> save the path id
11-> category save(in edit case)
	12-> category save
	13-> save the path id
		14-> update child path id
15-> category delete
	16-> delete category
	17-> shift the child categories to parent categories if child category exists
*/

Mage::loadFileByClassName('Controller_Core_Admin');
class Controller_Cat extends Controller_Core_Admin {

	public function gridAction() {
		$layout = $this->getLayout();
		$gridBlock = Mage::getBlock('Model_Cat');
		$content = $layout->getChild('content');
		$content->addChild($content);
		echo $this->renderLayout();
	}

	public function formAction() {   //this function was addAction() before
		$layout = $this->getLayout();
		$formBlock = Mage::getBlock('Block_Cat_Edit');

        $layout  = $this->getLayout();

        $content = $layout->getChild('content');
		$content->addChild($content);
		echo $this->renderLayout();
	}

	public function saveAction() {
		$postData = $this->getRequest()->getPost('cat');
		//echo "<pre>";
		//print_r($postData);
		$category = Mage::getModel('Model_Cat');
		$category->setData($postData);
		$category->save();

		//save pathID
		if ($category->parentId) {
			# code...
			$parent = Mage::getModel('Model_Cat')->load($category->parentId);
			if ($parent->pathId) {
				# code...
				$category->pathId = $parent->pathId."=".$category->$categoryId;
				$category->save();
			}
		}
		else {
			$category->pathId = $category->categoryId;
			$category->save();
		}
		$this->redirect('grid');
	}

	public function updatePathId() {
		if (!$this->parentId) {
			$pathId = $this->categoryId;
		}
		else {
			$parent = Mage::getModel('Model_Cat')->load($this->parentId);
			if (!$parent) {
				throw new Exception("Unable to load parent", 1);
			}
			$pathId = $parent->pathId.'='.$this->categoryId;
		}
		$this->pathId = $pathId;
		return $this->save();
	}

	public function updateChildrenPathIds($categoryPathId) {
		$categoryPathId = $categoryPathId.'=';
		$query = "SELECT * FROM `cat` WHERE pathId LIKE '{$categoryPathId}%' ORDER BY pathId ASC";
		$categories = $category->getAdapter()->fetchALl($query);

		if ($categories) {
			foreach ($categories as $key => $row) {
				$row = Mage::getModel('Model_Cat')->load($row['categoryId']);
				$row->updatePathId();
			}
		}
	}
}

?>