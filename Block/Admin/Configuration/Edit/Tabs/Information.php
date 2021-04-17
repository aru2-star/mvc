<?php
namespace Block\Admin\Configuration\Edit\Tabs;

class Information extends \Block\Core\Edit
{
    public function __construct()
    {   
        $this->setTemplate('./View/admin/configuration/edit/tabs/information.php'); 
    }
}