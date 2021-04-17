<?php
namespace Block\Admin\Customer;
\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Model\Customer');

class Grid extends \Block\Core\Template{
    protected $customers = [];

    public function __construct()
    {
       $this->setTemplate('./View/admin/customer/grid.php'); 
    }
    
    public function setCustomers($customers = null){
        if(!$customers){
            $customers = \Mage::getModel('Model\Customer');
            $query = "SELECT c.`customerId`, c.`groupId`, c.`firstname`, c.`lastname`, c.`email`, c.`password`, c.`status`, c.`createdDate`, c.`updatedDate`,a.`address`, a.`city`, a.`state`, a.`zipCode`, a.`country`,a.`addressType`
                    FROM `customer` AS c 
                    LEFT JOIN `customer_address` a 
                    ON c.`customerId` = a.`customerId`";
            $customers =  $customers->fetchAll($query)->getData();
        }
        $this->customers =$customers;
        return $this;
    }

    public function getCustomers() {
        if (!$this->customers) {
            $this->setCustomers();
        }
        return $this->customers;
    }

}