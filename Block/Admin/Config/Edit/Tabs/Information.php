<?php
namespace Block\Admin\Config\Edit\Tabs;

class Form extends \Block\Core\Edit
{
    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/config/edit/tabs/information.php'); 
    }
    
}

?>