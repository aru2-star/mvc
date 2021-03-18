<?php
Mage::loadFileByClassName('Block_Core_Template');

class Block_Admin_Grid extends Block_Core_Template
{
    protected $admins = null;
    protected $templateName = null;


    public function __construct()
    {
        $this->templateName  = './View/admin/grid.php';
    }

    public function setAdmins($admins = null)
    {
        if (!$admins) {
            $admins = Mage::getModel('model_admin');
            $admins = $admins->fetchAll();
            if ($admins) {
                $admins = $admins->getData();
            }
        }

        $this->admins = $admins;
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
