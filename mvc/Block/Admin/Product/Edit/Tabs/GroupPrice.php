<?php

namespace Block\Admin\Product\Edit\Tabs;
\Mage::loadFileByClassName('Block\Core\Template');

class GroupPrice extends \Block\Core\Template
{
    protected $tableRow = null;
    protected $customerGroup = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/product/edit/tabs/group_price.php');
    }

    public function setTableRow(\Model\Product $tableRow)
    {
    	$this->tableRow = $tableRow;
    	return $this;
    }


    public function getTableRow()
    {
        return $this->tableRow;
    }

    public function getCustomerGroup()
    {
        $customerGroup = \Mage::getModel('Model\Customer\CustomerGroup');
    	$query = "SELECT cg.*,pgp.productId,pgp.entityId,pgp.price as groupPrice,
        if(p.price IS NULL, '{$this->getTableRow()->price}',p.price) as price
        FROM customer_group cg 
        LEFT JOIN product_group_price pgp 
            ON pgp.customerGroupId =cg.groupId
            AND pgp.productId = '{$this->getTableRow()->productId}'
        LEFT JOIN product p 
            ON p.productId= pgp.productId";
       
          
         $this->customerGroup = $customerGroup->fetchAll($query);

        return $this->customerGroup;
    }
}
?>