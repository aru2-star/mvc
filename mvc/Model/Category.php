<?php
namespace Model;
\Mage::loadFileByClassName('Model\Core\Table');

class Category extends \Model\Core\Table{

	const STATUS_ENABLED = 1;
	const STATUS_DISABLED = 0;
	const  FEATURED_YES = 1;
	const  FEATURED_NO = 0;
	
	public function __construct() {
		$this->setTableName('category');
		$this->setPrimaryKey('categoryId');
	}
	
	public function getStatusOptions() {
		return  [
			self::STATUS_ENABLED =>"Enable",
			self::STATUS_DISABLED =>"Disable"
		];
	}

	public function getFeatureOptions() {
		return  [
			self::FEATURED_YES =>"Yes",
			self::FEATURED_NO =>"No"
		];
	}

	public function updatePathId()
	{
		if (!$this->parentId) {
			$pathId = $this->categoryId;
		} else {
			$parent = \Mage::getModel('Model\Category')->load($this->parentId);
			if (!$parent) {
				throw new Exception("Unable to load parent");
			}
			$pathId = $parent->path."-".$this->categoryId;
			
		}
		$this->path = $pathId;
		return $this->save();
	}

	public function updateChildrenPathId($categoryPathId,$parentId = null)
	{
		$categoryPathId = $categoryPathId.'-';
		
		$query = "SELECT * FROM `category_table` WHERE `path` LIKE '{$categoryPathId}%' ORDER BY `path` ASC";
		$categories = $this->getAdapter()->fetchAll($query);
		if ($categories) {
			foreach ($categories as $key => $row) {
				$row = \Mage::getModel('Model\Category')->load($row['categoryId']);

				if ($parentId!=null) {
					$row->parentId = $parentId;
				}
				$row->updatePathId();
			}
		}
	}

	
}

?>