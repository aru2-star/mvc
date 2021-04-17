<?php
namespace Block\Admin\Configuration;

class Grid extends \Block\Core\Template
{
    protected $configs = [];
    
    public function __construct()
    {
        $this->setTemplate('./View/admin/configuration/grid.php');
    }

    public function setConfigs($configs = NULL) 
    {
        if(!$configs) {
            $configs = \Mage::getModel('Model\Configuration')->fetchAll();
        }
        $this->configs = $configs;
        return $this;
    }

    public function getConfigs() 
    {
        if (!$this->configs) {
            $this->setConfigs();
        }
        return $this->configs;
    }

}