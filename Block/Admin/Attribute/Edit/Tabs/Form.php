<?php
namespace Block\Admin\Attribute\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/attribute/edit/tabs/form.php'); 
    }
    
}

?>