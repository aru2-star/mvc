<?php

namespace Model\Product;
\Mage::loadFileByClassName('Model\Core\Table');
class Category extends \Model\Core\Table
{
	public function __construct(){

		$this->setTableName('product_category');
		$this->setPrimaryKey('id');
	}
}
?>