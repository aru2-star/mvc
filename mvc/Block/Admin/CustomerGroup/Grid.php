<?php
namespace Block\Admin\CustomerGroup;
\Mage::loadFileByClassName('Block\Core\Template');
\Mage::loadFileByClassName('Model\CustomerGroup');

class Grid extends \Block\Core\Template
{
    protected $customerGroups = [];

    public function __construct() {
        $this->setTemplate('./View/admin/customerGroup/grid.php');
    }

    public function setCustomerGroups($customerGroups = NULL) {
        if(!$customerGroups) {
            $customerGroups = \Mage::getModel('Model\CustomerGroup');
            $customerGroups = $customerGroups->fetchAll();
        }
        $this->customerGroups = $customerGroups;
        return $this;
    }

    public function getCustomerGroups() 
    {
        if (!$this->customerGroups) {
            $this->setCustomerGroups();
        }
        return $this->customerGroups;
    }
    
}
?>
