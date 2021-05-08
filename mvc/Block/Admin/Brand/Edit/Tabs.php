<?php

namespace Block\Admin\Brand\Edit;
\Mage::loadFileByClassName('Block\Core\Edit\Tabs');
class Tabs extends \Block\Core\Edit\Tabs
{
    protected $tabs = [];
    protected $defaultTab = null;
    public function __construct()
    {
        parent::__construct();
        $this->prepareTabs();
    }

    public function prepareTabs()
    {
        $this->addTab('brand',['label'=>'Brand Information','block'=>'Block\Admin\Brand\Edit\Tabs\Form']);
        $this->setDefaultTab('brand');
        return $this;
    }

    
}

?>