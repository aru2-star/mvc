<?php

namespace Block\Admin\Product\Edit;
\Mage::loadFileByClassName('Block\Core\Edit\Tabs');

class Tabs extends \Block\Core\Edit\Tabs
{
    protected $tabs = [];
    protected $defaultTab = null;
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('./View/admin/product/edit/tabs.php');
        $this->prepareTabs();
    }

    public function prepareTabs()
    {
        $this->addTab('product',['label'=>'Product Information','block'=>'Block\Admin\Product\Edit\Tabs\Form']);
        $this->addTab('media',['label'=>'Media','block'=>'Block\Admin\Product\Edit\Tabs\Media']);
        $this->addTab('category',['label'=>'Category','block'=>'Block\Admin\Product\Edit\Tabs\Category']);
        $this->addTab('groupPrice',['label'=>'Group Price','block'=>'Block\Admin\Product\Edit\Tabs\GroupPrice']);
        $this->addTab('attribute',['label'=>'Attribute Options','block'=>'Block\Admin\Product\Edit\Tabs\Attribute']);
        $this->setDefaultTab('product');
        return $this;
    }

    
}

?>