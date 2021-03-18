<?php

Mage::loadFileByClassName('Block_Core_Template');

class Block_Customer_Edit_Tabs_Addresses extends Block_Core_Template
{

    public function __construct()
    {
        $this->setTemplate('View/customer/form/tabs/addresses.php');
    }
}
?>
