<?php
namespace Block\Admin\Cms\Edit;

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
        $this->addTab('cms',['label'=>'Cms Information','block'=>'Block\Admin\Cms\Edit\Tabs\Form']);
        $this->setDefaultTab('cms');
        return $this;
    }

    
}

?>