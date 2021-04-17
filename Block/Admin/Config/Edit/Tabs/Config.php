<?php
namespace Block\Admin\Config\Edit\Tabs;

class Config extends \Block\Core\Edit
{
    protected $configGroup = [];

    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/config/edit/tabs/config.php'); 
    }
    
    public function setConfigGroup($configGroup = null) 
    {
        if ($configGroup){
            $this->configGroup = $configGroup;
            return $this;
        }
        $configGroup = \Mage::getModel('Model\Config\Group');
        if ($id = $this->getRequest()->getGet('id')){   
            $configGroup = $configGroup->load($id);
        }
        $this->configGroup = $configGroup;
        return $this;
    }

    public function getConfigGroup() 
    {
        if (!$this->configGroup) {
            $this->setConfigGroup();
        }
        return $this->configGroup;
    }
}

?>