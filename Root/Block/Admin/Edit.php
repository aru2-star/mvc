<?php
Mage::loadFileByClassName('Block_Core_Template');


class Block_Admin_Edit extends Block_Core_Template
{
    protected $admin = null;
    protected $templateName = null;


    public function __construct()
    {
        $this->templateName  = './View/admin/form.php';
    }


    public function setAdmin($admin = null)
    {
        if ($admin) {
            $this->admin = $admin;
        }

        $admin = Mage::getModel('model_admin');

        if ($id = (int) $this->getRequest()->getGet('id')) {
            $admin = $admin->load($id);
        }

        $this->admin = $admin;
        return $this;
    }

    public function getAdmin()
    {
        if (!$this->admin) {
            $this->setAdmin();
        }

        return $this->admin;
    }
}
