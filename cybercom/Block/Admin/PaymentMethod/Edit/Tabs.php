<?php
namespace Block\Admin\PaymentMethod\Edit;
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
        $this->addTab('payment',['label'=>'Payment Information','block'=>'Block\Admin\PaymentMethod\Edit\Tabs\Form']);
        $this->setDefaultTab('payment');
        return $this;
    }

    
}

?>