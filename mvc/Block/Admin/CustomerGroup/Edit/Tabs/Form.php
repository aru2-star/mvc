<?php
namespace Block\Admin\CustomerGroup\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/CustomerGroup/edit/tabs/form.php'); 
    }
    
}

?>