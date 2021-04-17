<?php

namespace Model\Category;
\Mage::loadFileByClassName('Model\Core\Table');

class Media extends \Model\Core\Table{

	const STATUS_ACTIVE = 1;
	const STATUS_INACTIVE = 0;
	
	public function __construct() {
		$this->setTableName('category_media');
		$this->setPrimaryKey('mediaId');
	}
	public function getStatusOptions() {
		return  [
			self::STATUS_ACTIVE =>"Yes",
			self::STATUS_INACTIVE =>"No"
		];
	}
	
}

?>