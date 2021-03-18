<?php

Mage::loadFileByClassName('Block_Core_Template');

class Block_Product_Edit_Tabs_Form extends Block_Core_Template
{
    protected $product = null;

    public function __construct()
    {
        $this->setTemplate('View/products/form/tabs/form.php');
    }

    public function setProduct($product = null)
    {
        if ($product) {
            $this->product = $product;
        }

        $product = Mage::getModel('model_product');

        if ($id = (int) $this->getUrl()->getRequest()->getGet('id')) {
            $product = $product->load($id);
        }

        $this->product = $product;
        return $this;
    }

    public function getProduct()
    {
        if (!$this->product) {
            $this->setProduct();
        }

        return $this->product;
    }
}
