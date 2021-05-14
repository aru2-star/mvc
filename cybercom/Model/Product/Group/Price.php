<?php

namespace Model\Product\Group;
\Mage::loadFileByClassName('Model\Core\Table');
class Price extends \Model\Core\Table 
{
	public function __construct() {
		
		$this->setTableName('product_group_price');
		$this->setPrimaryKey('entityId');
	}	

}

?>