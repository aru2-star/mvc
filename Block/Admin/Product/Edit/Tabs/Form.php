<?php
namespace Block\Admin\Product\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/product/edit/tabs/form.php'); 
    }
    
}

?>