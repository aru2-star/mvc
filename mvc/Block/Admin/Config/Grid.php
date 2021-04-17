<?php
namespace Block\Admin\Config;

class Grid extends \Block\Core\Template
{
    protected $configGroups = [];

    public function __construct()
    {
       $this->setTemplate('./View/admin/config/grid.php'); 
    }

    public function setConfigGroups($configGroups =NULL) {

            if(!$configGroups) {
                $configGroups = \Mage::getModel('Model\Config\Group');
                $configGroups = $configGroups->fetchAll();
            }
            $this->configGroups = $configGroups;
            return $this;
    }       

    public function getConfigGroups() {
        if (!$this->configGroups) {
            $this->setConfigGroups();
        }
        return $this->configGroups;
    }

}