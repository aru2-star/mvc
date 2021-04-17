<?php

namespace Block\Admin\Shipping;
\Mage::loadFileByClassName('Block\Core\Edit');

class Edit extends \Block\Core\Edit
{
    
    public function __construct()
    {
       parent::__construct();
       $this->setTabClass(\Mage::getBlock('Block\Admin\Shipping\Edit\Tabs'));

       //$this->setTemplate('./View/admin/shipping/shippingUpdate.php'); 
    }
    
}
?>