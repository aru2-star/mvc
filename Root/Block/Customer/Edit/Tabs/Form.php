<?php

Mage::loadFileByClassName('Block_Core_Template');

class Block_Customer_Edit_Tabs_Form extends Block_Core_Template {

	protected $customer = null;

	public function __construct()
    {
        $this->setTemplate('View/customer/form/tabs/form.php');
    }

    public function setCustomer($customer = null)
    {
        if ($customer) {
            $this->customer = $customer;
        }

        $customer = Mage::getModel('Model_Customer');

        if ($id = (int) $this->getRequest()->getGet('id')) {
            $customer = $customer->load($id);
        }

        $this->customer = $customer;
        return $this;
    }

    public function getCustomer()
    {
        if (!$this->customer) {
            $this->setCustomer();
        }

        return $this->customer;
    }
}