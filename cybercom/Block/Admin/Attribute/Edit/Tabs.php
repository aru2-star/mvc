<?php

namespace Block\Admin\Attribute\Edit;
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
        $this->addTab('attribute',['label'=>'Attribute Information','block'=>'Block\Admin\Attribute\Edit\Tabs\Form']);
        $this->addTab('option',['label'=>'Options','block'=>'Block\Admin\Attribute\Edit\Tabs\Option']);
        $this->setDefaultTab('attribute');
        return $this;
    }

    
}

?>