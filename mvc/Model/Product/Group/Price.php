<?php
namespace Model\Product\Group;
\Mage::loadFileByClassName('Model\Core\Table');

class Price extends \Model\Core\Table
{
    public function __construct() {
        $this->primaryKey = 'entityId';
        $this->tableName = 'product_group_price';
    }

}