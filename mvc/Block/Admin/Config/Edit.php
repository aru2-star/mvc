<?php 
namespace Block\Admin\Config;

class Edit extends \Block\Core\Edit
{
    public function __construct()
    {
        parent::__construct();
        $this->setTabClass(\Mage::getBlock('Block\Admin\Config\Edit\Tabs'));     
    }
}