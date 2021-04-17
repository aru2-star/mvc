<?php
namespace Block\Admin\Configuration\Edit\Tabs;

class Configuration extends \Block\Core\Edit
{
    protected $configs = [];
    public function __construct()
    {   
        $this->setTemplate('./View/admin/configuration/edit/tabs/configuration.php'); 
    }

    public function setConfigs($configs = NULL) 
    {
        if(!$configs) {
            $configs = \Mage::getModel('Model\Configuration\Config')->fetchAll();
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