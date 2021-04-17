<?php

namespace Block\Admin\Brand;
\Mage::loadFileByClassName('Block\Core\Edit');

class Edit extends \Block\Core\Edit
{
    
    public function __construct()
    {
       parent::__construct();
       $this->setTabClass(\Mage::getBlock('Block\Admin\Brand\Edit\Tabs'));

       //$this->setTemplate('./View/admin/brand/brandUpdate.php'); 
    }
    
}
?>