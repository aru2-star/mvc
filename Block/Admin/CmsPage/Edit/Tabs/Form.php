<?php
namespace Block\Admin\CmsPage\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/cmspage/edit/tabs/form.php'); 
    }
    
}

?>