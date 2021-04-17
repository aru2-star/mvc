<?php
namespace Block\Admin\Shipping\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/Shipping/edit/tabs/form.php'); 
    }
    
}

?>