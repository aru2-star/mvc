<?php
namespace Block\Admin\Customer\Edit\Tabs;
\Mage::getBlock("Block\Core\Edit");

class Form extends \Block\Core\Edit
{
    protected $group = Null;
    protected $address = null;

    public function __construct()
    {   
        parent::__construct();
       $this->setTemplate('./View/admin/customer/edit/tabs/form.php'); 
    }
    
    public function setGroup($group = null){
        if($group == null){
            $group = $this->getTableRow()->getAdapter()->fetchAll("SELECT `name`, `groupId` FROM `customer_group`");
        }
        $this->group = $group;
        return $this;
    }

    public function getGroup(){
        if(!$this->group){
            $this->setGroup();
        }
        return $this->group;
    }    
}

?>