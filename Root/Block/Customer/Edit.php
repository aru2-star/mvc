<?php
Mage::loadFileByClassName('Block_Core_Template');

class Block_Customer_Edit extends Block_Core_Template
{
    protected $templateName = null;


    public function __construct()
    {
        $this->templateName  = './View/customer/form.php';
    }

    public function getTabs()
    {
        return Mage::getBlock('Block_Customer_Edit_Tabs');
    }

    public function getTabContents()
    {
        $tab = $this->getRequest()->getGet('tabs');
        if (!$tab) {
            $tab = $this->getTabs()->getDefaultTab();
        }

        $blockName =  $this->getTabs()->getTabs()[$tab]['block'];

        $carry = Mage::getBlock($blockName);

        echo $carry->toHtml();
    }
}
