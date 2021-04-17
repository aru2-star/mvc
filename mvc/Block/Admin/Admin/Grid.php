<?php
namespace Block\Admin\Admin;
\Mage::loadFileByClassName('Block\Core\Template');

class Grid extends \Block\Core\Template
{
    protected $admins = [];

    public function __construct() {
        $this->setTemplate('./View/admin/admin/grid.php');
    }

    public function setAdmins($admins = NULL) {
        if(!$admins) {
            $admins = \Mage::getModel('Model\Admin');
            $admins = $admins->fetchAll();
           
        }
        $this->admins = $admins;
        //print_r($admins); die();
        return $this;
    }

    public function getAdmins() 
    {
        if (!$this->admins) {
            $this->setAdmins();
        }
        return $this->admins;
    }
    
}
?>
