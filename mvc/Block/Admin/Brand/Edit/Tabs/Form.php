<?php
namespace Block\Admin\Brand\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/brand/edit/tabs/form.php'); 
    }
    
}

?>