<?php
namespace Block\Admin\Customer\CustomerGroup\Edit;
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
        $this->addTab('customergroup',['label'=>'Customer Group Information','block'=>'Block\Admin\Customer\CustomerGroup\Edit\Tabs\Form']);
        $this->setDefaultTab('customergroup');
        return $this;
    }

   
}

?>