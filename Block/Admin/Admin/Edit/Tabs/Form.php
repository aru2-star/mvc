<?php
namespace Block\Admin\Admin\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/admin/edit/tabs/form.php'); 
    }
    
}

?>