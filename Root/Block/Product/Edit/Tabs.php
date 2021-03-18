<?php

Mage::loadFileByClassName('Block_Core_Template');

class Block_Product_Edit_Tabs extends Block_Core_Template
{

    protected $tabs = [];
    protected $defaultTab = null;

    public function __construct()
    {
        $this->setTemplate('View/products/form/tabs.php');
        $this->prepareTabs();
    }

    public function prepareTabs()
    {
        $this->addTab('Product', ['label' => 'Product Information', 'block' => 'Block_Product_Edit_Tabs_Form']);
        $this->addTab('Media', ['label' => 'Media', 'block' => 'Block_Product_Edit_Tabs_Media']);
        $this->addTab('Category', ['label' => 'Category', 'block' => 'Block_Product_Edit_Tabs_Category']);
        $this->setDefaultTab('Product');
        return $this;
    }

    public function getDefaultTab()
    {
        return $this->defaultTab;
    }

    public function setDefaultTab($value)
    {
        $this->defaultTab = $value;
        return $this;
    }


    public function setTabs(array $tabs)
    {
        $this->tabs = $tabs;
        return $this;
    }

    public function getTabs()
    {
        return $this->tabs;
    }

    public function addTab($key, $value = [])
    {
        $this->tabs[$key] = $value;
    }

    public function getTab($key)
    {
        if (!array_key_exists($key, $this->tabs)) {
            return null;
        }

        return $this->tabs[$key];
    }

    public function removeTab()
    {
        if (array_key_exists($key, $this->tabs)) {
            unset($this->tabs[$key]);
        }
        return $this;
    }
}
